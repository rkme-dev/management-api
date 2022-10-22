<?php

declare(strict_types=1);

namespace App\Services\FileUpload\Factories;

use App\Models\File;
use App\Services\FileUpload\Interfaces\FileFactoryInterface;
use App\Services\FileUpload\Resources\CreateFileResource;

final class FileFactory implements FileFactoryInterface
{
    public function make(CreateFileResource $resource): File
    {
        return File::create([
            'filename' => $resource->getFilename(),
            'filepath' => $resource->getFilepath(),
            'format' => $resource->getFormat(),
            'morphable_type' => \get_class($resource->getMorphable()),
            'morphable_id' => $resource->getMorphable()->id,
            'created_by' => $resource->getCreatedBy()->getId(),
        ]);
    }
}
