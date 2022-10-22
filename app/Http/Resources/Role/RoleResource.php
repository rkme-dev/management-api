<?php

declare(strict_types=1);

namespace App\Http\Resources\Role;

use App\Exceptions\InvalidResourceTypeException;
use App\Http\Resources\Ability\AbilitiesResource;
use App\Http\Resources\Resource;
use Silber\Bouncer\Database\Role;

final class RoleResource extends Resource
{
    /**
     * @throws InvalidResourceTypeException
     */
    protected function getResponse(): array
    {
        if (($this->resource instanceof Role) === false) {
            throw new InvalidResourceTypeException(
                Role::class
            );
        }

        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'abilities' => new AbilitiesResource($this->resource->getAbilities()),
            'title' => $this->resource->title,
            'scope' => $this->resource->scope,
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at,
        ];
    }
}
