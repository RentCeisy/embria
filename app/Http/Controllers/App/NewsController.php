<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Repositories\Impl\PhotoRepositoryImpl;
use App\Services\Impl\NewsServiceImpl;
use App\Services\Impl\PhotoServiceImpl;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function getNews(Request $request, $id, NewsServiceImpl $newsService)
    {
        return $newsService->getByIdWithPhotosAndLikes($id, $request);
    }

    public function updateLike(Request $request, $id, NewsServiceImpl $newsService, PhotoServiceImpl $photoService)
    {
        $request->validate([
            'type' => 'required|string',
            'is_delete' => 'required|boolean'
        ]);

        if ($request->get('type') === 'photo') {
            $request->validate([
                'photo_id' => 'required|numeric'
            ]);
            return $photoService->updateLike($request);
        } elseif ($request->get('type') === 'news') {
            return $newsService->updateLike($request, $id);
        }
    }

    public function deletePhoto(Request $request, $id, PhotoServiceImpl $photoService)
    {
        return $photoService->deletePhoto($request, $id);
    }

    public function savePhoto(Request $request, PhotoServiceImpl $photoService)
    {
        return $photoService->savePhoto($request);
    }

    public function deleteNews(Request $request, $id, NewsServiceImpl $newsService)
    {
        return $newsService->deleteNews($request, $id);
    }

    public function saveNews(Request $request, $id, NewsServiceImpl $newsService)
    {
        $request->validate([
            'title' => 'required|string',
            'desc' => 'required|string'
        ]);

        return $newsService->saveNews($request, $id);
    }
}
