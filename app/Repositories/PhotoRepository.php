<?php

namespace App\Repositories;

use App\Photo;
use App\PhotoLike;
use App\Repositories\Impl\PhotoRepositoryImpl;
use Illuminate\Support\Facades\DB;

class PhotoRepository implements PhotoRepositoryImpl {

    public function getById($id): ?Photo
    {
        return Photo::findOrFail($id);
    }

    public function create(array $data): ?Photo
    {
        return Photo::create($data);
    }

    public function save(Photo $model): bool
    {
        return $model->save();
    }

    public function delete($id): bool
    {
        return $this->getById($id)->delete();
    }

    public function addLike($photoId, $userId): bool
    {
        try {
            DB::transaction(function () use ($photoId, $userId) {
                $photo = PhotoLike::create([
                    'user_id' => $userId,
                    'photo_id' => $photoId
                ]);
                $inc = Photo::where('id', $photoId)->increment('like_count');
            }, 2);
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }

    public function delLike($photoId, $userId)
    {
        try {
            DB::transaction(function () use ($photoId, $userId) {
                $photo = PhotoLike::where('user_id', $userId)
                    ->where('photo_id', $photoId)->delete();
                $dec = Photo::where('id', $photoId)->decrement('like_count');
            }, 2);
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }
}
