<?php

declare(strict_types=1);

namespace App\Http\Resources\AccessLevel;

use App\Http\Resources\Resource;

final class AccessLevelResource extends Resource
{
    protected function getResponse(): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'title' => $this->resource->name,
            'status' => $this->resource->status,
            'roles' => $this->resource->roles,
            'abilities' => $this->resource->getAbilities(),
        ];
    }
}
