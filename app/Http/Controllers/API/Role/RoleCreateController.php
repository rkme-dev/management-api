<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Role;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\Role\RoleCreateRequest;
use App\Http\Resources\Role\RoleResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Silber\Bouncer\Bouncer;
use Silber\Bouncer\Database\Ability;

final class RoleCreateController extends AbstractAPIController
{
    public function __construct(Bouncer $bouncer) {
        $this->bouncer = $bouncer;
    }

    public function __invoke(RoleCreateRequest $request): JsonResource
    {
        $roleFactory = $this->bouncer->role();

        $role = $roleFactory->firstOrCreate([
            'name' => str_replace(' ', '-', strtolower($request->getName())),
            'title' => $request->getName(),
        ]);

        $abilities = Ability::whereIn('id', $request->getAbilityIds() ?? [])->get();

        foreach ($abilities as $ability) {
            $role->allow($ability->name);
        }

        $role->refresh();

        $this->bouncer->refresh();

        return new RoleResource($role);
    }
}
