<?php

declare(strict_types=1);

namespace App\Http\Resources\Ability;

use App\Http\Resources\Resource;

final class AbilitiesResource extends Resource
{
    private bool $orderByModule;

    public function __construct($resource, bool $orderByModule = false)
    {
        $this->orderByModule = $orderByModule;
        parent::__construct($resource);
    }

    /**
     * @throws \App\Exceptions\InvalidResourceTypeException
     */
    protected function getResponse(): array
    {
        $abilities = [];

        foreach ($this->resource as $ability) {
            if ($ability->title === 'All') {
                continue;
            }

            if ($this->orderByModule === false) {
                $abilities[] = new AbilityResource($ability);
                continue;
            }

            $arrayName = explode('-', $ability->name);

            $name = $arrayName[0] === '*' && isset($arrayName[1]) === false ? 'All' : ucfirst($arrayName[1] ?? $ability->title);
            $abilities[$name]['name'] = $name;
            $abilities[$name]['locked'] = false;
            $abilities[$name]['id'] = $name;
            $abilities[$name]['abilities'][] = [
                'id' => $ability->id,
                'name' => $ability->title,
                'locked' => false,
                'value' => $ability->name,
            ];
        }

        return array_values($abilities);
    }
}
