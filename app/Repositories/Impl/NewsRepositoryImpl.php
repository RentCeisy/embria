<?php
namespace App\Repositories\Impl;

use App\News;

interface NewsRepositoryImpl {
    public function getById($id): ?News;
    public function create(array $data): ?News;
    public function save($id, array $data): bool;
    public function delete($id): bool;
    public function getNewsList();
    public function getByIdWithPhotosAndLikes($id, $userId): ?News;
    public function addLike($newsId, $userId): bool;
    public function delLike($newsId, $userId);
}
