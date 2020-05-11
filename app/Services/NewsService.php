<?php
namespace App\Services;

use App\News;
use App\Repositories\Impl\NewsRepositoryImpl;
use App\Services\Impl\NewsServiceImpl;
use Illuminate\Http\Request;

class NewsService implements NewsServiceImpl {

    private $newsRepository;

    public function __construct(NewsRepositoryImpl $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    public function getById($id): ?News
    {
        return $this->newsRepository->getById($id);
    }

    public function create(array $data): ?News
    {
        return $this->newsRepository->create($data);
    }

    public function save(News $model): bool
    {
        return $this->newsRepository->save($model);
    }

    public function delete(News $model): bool
    {
        return $this->newsRepository->delete($model);
    }

    public function getNewsList()
    {
        return $this->newsRepository->getNewsList();
    }

    public function getByIdWithPhotosAndLikes($id, Request $request): ?array
    {
        $userId = $request->user()->id;
        $news = $this->newsRepository->getByIdWithPhotosAndLikes($id, $userId);
        $isAuthor = $userId === $news->user_id;
        return [
            'isAuthor' => $isAuthor,
            'news'  => $news
        ];
    }

    public function updateLike(Request $request, $newsId): bool
    {
        $userId = $request->user()->id;
        if ($request->get('is_delete')) {
            return $this->newsRepository->delLike($newsId, $userId);
        } else {
            return $this->newsRepository->addLike($newsId, $userId);
        }
    }

    public function deleteNews(Request $request, $id): bool
    {
        $userId = $request->user()->id;
        $news = $this->newsRepository->getById($id);
        $user = $news->user()->first();
        if ($userId === $user->id) {
            return $this->newsRepository->delete($id);
        }
        return false;
    }

    public function saveNews(Request $request, $id)
    {
        if ($id == 0) {
            return $this->newsRepository->create([
                'title' => $request->get('title'),
                'description' => $request->get('desc'),
                'user_id' => $request->user()->id
            ]);
        } else {
            return $this->newsRepository->save($id, [
                'title' => $request->get('title'),
                'description' => $request->get('desc')
            ]);
        }
    }

}
