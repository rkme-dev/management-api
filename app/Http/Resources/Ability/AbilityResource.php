<?php

declare(strict_types=1);

namespace App\Http\Resources\Ability;

use App\Exceptions\InvalidResourceTypeException;
use App\Http\Resources\Resource;
use App\Models\User;
use Silber\Bouncer\Database\Ability;

final class AbilityResource extends Resource
{
    /**
     * @throws InvalidResourceTypeException
     */
    protected function getResponse(): array
    {
        if (($this->resource instanceof Ability) === false) {
            throw new InvalidResourceTypeException(
                Ability::class
            );
        }

        $arrayName = explode('-', $this->resource->name);

        return [
            'id' => $this->resource->id,
            'is_disabled' => $arrayName[0] === '*',
            'action' => $arrayName[0],
            'module' => $arrayName[0] === '*' ? 'All' : ucfirst($arrayName[1] ?? $this->resource->name),
            'name' => $this->resource->name,
            'title' => $this->resource->title,
            'entity_id' => $this->resource->entity_id,
            'entity_type' => $this->resource->entity_type,
            'only_owned' => $this->resource->only_owned,
            'options' => $this->resource->options,
            'scope' => $this->resource->scope,
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at,
        ];
    }
}
