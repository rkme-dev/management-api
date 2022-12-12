<?php

declare(strict_types=1);

namespace App\Services\FileUpload;

use App\Models\File;
use App\Services\FileUpload\Interfaces\FileUploaderInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\URL;

final class FileUploader implements FileUploaderInterface
{
    public function upload(File $file, UploadedFile $uploadedFile): string
    {
        $uploadedFile->storeAs(
            $file->getFilepath() ?? '',
            $file->getFilename(),
            'public'
        );

        return \sprintf(
            '%s/storage/%s/%s',
            URL::to('/'),
            $file->getFilepath() ?? '',
            $file->getFileName()
        );
    }
}
