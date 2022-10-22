<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\FileUpload\Factories\FileFactory;
use App\Services\FileUpload\FileUploader;
use App\Services\FileUpload\Interfaces\FileFactoryInterface;
use App\Services\FileUpload\Interfaces\FileUploaderInterface;
use Illuminate\Support\ServiceProvider;

final class FileUploadServiceProvider extends ServiceProvider
{
    /**
     * Register the application factories as services.
     */
    public function register(): void
    {
        $services = [
            FileFactoryInterface::class => FileFactory::class,
            FileUploaderInterface::class => FileUploader::class,
        ];

        foreach ($services as $abstract => $concrete) {
            $this->app->bind($abstract, $concrete);
        }
    }
}
