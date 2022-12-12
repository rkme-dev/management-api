<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\AccessLevel;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Resources\AccessLevel\AccessLevelResource;
use App\Models\AccessLevel;
use Illuminate\Http\Resources\Json\JsonResource;

final class AccessLevelShowController extends AbstractAPIController
{
    public function __invoke(int $id): JsonResource
    {
        $accessLevel = AccessLevel::with(['roles', 'abilities'])->find($id);

        if ($accessLevel === null) {
            return $this->respondNotFound('Access Level not found');
        }

        return new AccessLevelResource($accessLevel);
    }
}
