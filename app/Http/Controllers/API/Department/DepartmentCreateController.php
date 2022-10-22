<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Department;

use App\Enums\DepartmentStatusesEnum;
use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\Department\DepartmentCreateRequest;
use App\Http\Resources\Department\DepartmentResource;
use App\Models\Department;
use Illuminate\Http\Resources\Json\JsonResource;
use Silber\Bouncer\Database\Ability;
use Silber\Bouncer\Database\Role;

final class DepartmentCreateController extends AbstractAPIController
{
    public function __invoke(DepartmentCreateRequest $request): JsonResource
    {
        $department = Department::create([
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
            $department->allow($ability->name);
        }

        foreach ($roles ?? [] as $role) {
            $department->assign($role->name);
        }

        return new DepartmentResource($department);
    }
}
