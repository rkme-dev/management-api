<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Department;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Resources\Role\RoleResource;
use App\Http\Resources\Role\RolesResource;
use App\Models\Department;
use Illuminate\Http\Resources\Json\JsonResource;
use Silber\Bouncer\Database\Role;

final class DepartmentRolesController extends AbstractAPIController
{
    public function __invoke(int $id): JsonResource
    {
        $department = Department::find($id);

        $roles = Role::whereIn('name', $department->getRoles()->toArray())->get();

        return new RolesResource($roles);
    }
}
