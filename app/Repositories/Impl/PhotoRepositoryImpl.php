<?php
namespace App\Repositories\Impl;

use App\Photo;

interface PhotoRepositoryImpl {
    public function getById($id): ?Photo;
    public function create(array $data): ?Photo;
    public function save(Photo $model): bool;
    public function delete($id): bool;
    public function addLike($photoId, $userId): bool;
    public function delLike($photoId, $userId);
}
