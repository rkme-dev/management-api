<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\AccessLevel;

use App\Enums\DepartmentStatusesEnum;
use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\AccessLevel\AccessLevelCreateRequest;
use App\Http\Resources\AccessLevel\AccessLevelResource;
use App\Models\AccessLevel;
use Illuminate\Http\Resources\Json\JsonResource;
use Silber\Bouncer\Database\Ability;
use Silber\Bouncer\Database\Role;

final class AccessLevelCreateController extends AbstractAPIController
{
    public function __invoke(AccessLevelCreateRequest $request): JsonResource
    {
        $accessLevel = AccessLevel::create([
            'name' => $request->getName(),
            'status' => DepartmentStatusesEnum::ACTIVE->value,
            'created_by' => $this->getUser()->id,
        ]);

        if (\count($request->getRoleIds() ?? []) > 0) {
            $roles = Role::whereIn('id', $request->getRoleIds())->get();
        }

        if (\count($request->getAbilityIds() ?? []) > 0) {
            $abilities = Ability::whereIn('id', $request->getAbilityIds())->get();
        }

        foreach ($abilities ?? [] as $ability) {
            $accessLevel->allow($ability->name);
        }

        foreach ($roles ?? [] as $role) {
            $accessLevel->assign($role->name);
        }

        return new AccessLevelResource($accessLevel);
    }
}
