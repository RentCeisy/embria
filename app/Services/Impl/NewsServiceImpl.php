<?php

namespace App\Services\Impl;

use App\News;
use Illuminate\Http\Request;

interface NewsServiceImpl {
    public function getById($id): ?News;
    public function create(array $data): ?News;
    public function save(News $model): bool;
    public function delete(News $model): bool;
    public function getNewsList();
    public function getByIdWithPhotosAndLikes($id, Request $request): ?array;
    public function updateLike(Request $request, $newsId): bool;
    public function deleteNews(Request $request, $id): bool;
    public function saveNews(Request $request, $id);
}
