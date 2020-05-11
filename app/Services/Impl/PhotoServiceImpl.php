<?php

namespace App\Services\Impl;

use App\Photo;
use Illuminate\Http\Request;

interface PhotoServiceImpl {
    public function getById($id): ?Photo;
    public function create(array $data): ?Photo;
    public function save(Photo $model): bool;
    public function delete(Photo $model): bool;
    public function updateLike(Request $request): bool;
    public function deletePhoto(Request $request, $id): bool;
    public function savePhoto(Request $request): ?Photo;
}
