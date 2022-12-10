<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\User\UploadProfilePhotoRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Services\FileUpload\Interfaces\FileFactoryInterface;
use App\Services\FileUpload\Interfaces\FileUploaderInterface;
use App\Services\FileUpload\Resources\CreateFileResource;
use Illuminate\Http\Resources\Json\JsonResource;

final class UserUploadProfilePhotoController extends AbstractAPIController
{
    public const PROFILE_PICTURE_PATH = 'profile_pictures';

    private FileFactoryInterface $fileFactory;

    private FileUploaderInterface $fileUploader;

    public function __construct(
        FileFactoryInterface $fileFactory,
        FileUploaderInterface $fileUploader
    ) {
        $this->fileFactory = $fileFactory;
        $this->fileUploader = $fileUploader;
    }

    public function __invoke(UploadProfilePhotoRequest $request, int $id): JsonResource
    {
        $user = User::find($id);

        if ($user === null) {
            return $this->respondNotFound('User not found');
        }

        $originalFileName = trim(
            preg_replace(
                '/[^a-zA-Z0-9._ -]/',
                '',
                $request->getFile()->getClientOriginalName()
            )
        );

        $file = $this->fileFactory->make(new CreateFileResource([
            'createdBy' => $this->getUser(),
            'morphable' => $user,
            'filename' => $originalFileName,
            'filepath' => self::PROFILE_PICTURE_PATH,
            'format' => $request->getFile()->getClientMimeType() ?? '',
        ]));

        $url = $this->fileUploader->upload($file, $request->getFile());

        $user->profile_url = $url;
        $user->save();

        return new UserResource($user);
    }
}
