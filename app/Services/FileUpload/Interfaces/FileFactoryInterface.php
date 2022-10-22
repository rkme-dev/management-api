<?php

namespace App\Services\FileUpload\Interfaces;

use App\Models\File;
use App\Services\FileUpload\Resources\CreateFileResource;

interface FileFactoryInterface
{
    public function make(CreateFileResource $resource): File;
}
