<?php

namespace App\Services\FileUpload\Interfaces;

use App\Models\File;
use Illuminate\Http\UploadedFile;

interface FileUploaderInterface
{
    public function upload(File $file, UploadedFile $uploadedFile): string;
}
