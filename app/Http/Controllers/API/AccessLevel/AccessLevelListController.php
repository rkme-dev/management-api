<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\AccessLevel;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Resources\AccessLevel\AccessLevelsResource;
use App\Models\AccessLevel;
use Illuminate\Http\Resources\Json\JsonResource;

final class AccessLevelListController extends AbstractAPIController
{
    public function __invoke(): JsonResource
    {
        return new AccessLevelsResource(AccessLevel::with(['roles', 'abilities'])->get());
    }
}
