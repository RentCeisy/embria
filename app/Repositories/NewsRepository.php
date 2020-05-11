<?php

namespace App\Repositories;

use App\News;
use App\NewsLike;
use App\Repositories\Impl\NewsRepositoryImpl;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsRepository implements NewsRepositoryImpl {

    public function getById($id): ?News
    {
        return News::findOrFail($id);
    }

    public function create(array $data): ?News
    {
        return News::create($data);
    }

    public function save($id, array $data): bool
    {
        $model = $this->getById($id);
        return $model->fill($data)->save();
    }

    public function delete($id): bool
    {
        return $this->getById($id)->delete();
    }

    public function getNewsList()
    {
        return News::with('photo')
            ->orderBy('created_at', 'desc')
            ->paginate(12);
    }

    public function getByIdWithPhotosAndLikes($id, $userId): ?News
    {
        return News::where('id', $id)
            ->with(['photos' => function($q) use ($userId) {
                $q->orderBy('created_at', 'asc')
                    ->with(['like' => function ($q) use ($userId) {
                        $q->where('user_id', $userId);
                    }]);
            }])
            ->with(['like' => function ($q) use ($userId) {
                $q->where('user_id', $userId)->count();
            }])
            ->first();
    }

    public function addLike($newsId, $userId): bool
    {
        try {
            DB::transaction(function () use ($newsId, $userId) {
                $news = NewsLike::create([
                    'user_id' => $userId,
                    'news_id' => $newsId
                ]);
                $inc = News::where('id', $newsId)->increment('like_count');
            }, 2);
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }

    public function delLike($newsId, $userId)
    {
        try {
            DB::transaction(function () use ($newsId, $userId) {
                $news = NewsLike::where('user_id', $userId)
                    ->where('news_id', $newsId);
                $dec = News::where('id', $newsId)->decrement('like_count');
            }, 2);
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }
}
