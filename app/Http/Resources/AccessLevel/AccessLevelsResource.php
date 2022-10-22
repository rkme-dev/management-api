<?php

declare(strict_types=1);

namespace App\Http\Resources\AccessLevel;

use App\Http\Resources\Resource;

final class AccessLevelsResource extends Resource
{
    protected function getResponse(): array
    {
        $departments = [];

        foreach ($this->resource as $department) {
            $departments['data'][] = new AccessLevelResource($department);
        }

        return $departments;
    }
}
