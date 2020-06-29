<?php
namespace App\Services;

use App\Photo;
use App\Repositories\Impl\PhotoRepositoryImpl;
use App\Services\Impl\PhotoServiceImpl;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PhotoService implements PhotoServiceImpl {

    private $photoRepository;

    public function __construct(PhotoRepositoryImpl $photoRepository)
    {
        $this->photoRepository = $photoRepository;
    }

    public function getById($id): ?Photo
    {
        return $this->photoRepository->getById($id);
    }

    public function create(array $data): ?Photo
    {
        return $this->photoRepository->create($data);
    }

    public function save(Photo $model): bool
    {
        return $this->photoRepository->save($model);
    }

    public function delete(Photo $model): bool
    {
        return $this->photoRepository->delete($model);
    }

    public function updateLike(Request $request): bool
    {
        $userId = $request->user()->id;
        $photoId = $request->get('photo_id');

        if ($request->get('is_delete')) {
            return $this->photoRepository->delLike($photoId, $userId);
        } else {
            return $this->photoRepository->addLike($photoId, $userId);
        }
    }

    public function deletePhoto(Request $request, $id): bool
    {
        $userId = $request->user()->id;
        $photo = $this->photoRepository->getById($id);
        $user = $photo->newsUser()->first();
        if ($userId === $user->id) {
            return $this->photoRepository->delete($id);
        }
        return false;
    }

    public function savePhoto(Request $request): ?Photo
    {
        if ($request->hasFile('photo')) {
            $request->validate([
                'photo' => 'mimes:jpeg,jpg,png|max:1000'
            ]);
            $fileName = $request->file('photo')->getClientOriginalName();
            $formatImage = explode('.', $fileName);
            $fileName = time() . '_' . md5($fileName) . '.' . $formatImage[count($formatImage) - 1];
            $path = '/img/';
            $publicPath = public_path($path) . $fileName;
            Image::make($request->file('photo'))->fit(300)->save($publicPath);
            return $this->photoRepository->create([
                'url' => $fileName,
                'news_id' => $request->get('news_id')
            ]);
        }

        return null;
    }
}
