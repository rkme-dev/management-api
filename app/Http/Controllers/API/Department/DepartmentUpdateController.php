<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Department;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\Department\DepartmentUpdateRequest;
use App\Http\Resources\Department\DepartmentResource;
use App\Models\Department;
use App\Models\User;
use Illuminate\Support\Facades\Response;
use Silber\Bouncer\Bouncer;
use Silber\Bouncer\Database\Ability;
use Silber\Bouncer\Database\Role;

final class DepartmentUpdateController extends AbstractAPIController
{
    private Bouncer $bouncer;

    public function __construct(Bouncer $bouncer)
    {
        $this->bouncer = $bouncer;
    }

    public function __invoke(int $id, DepartmentUpdateRequest $request)
    {
        $department = Department::find($id);

        $exist = null;

        if ($department->name !== $request->getName()) {
            $exist = Department::where('name', $request->getName())->first();
        }

        if ($exist !== null) {
            return Response::json([
                'name' => 'Department name already exist.',
            ], 422);
        }

        if ($department === null) {
            return $this->respondNotFound('Department not found.');
        }

        $roles = [];

        if (\count($request->getRoleIds() ?? []) > 0) {
            $roles = Role::whereIn('id', $request->getRoleIds())->get();
        }

        $abilities = [];

        if (\count($request->getAbilityIds() ?? []) > 0) {
            $abilities = Ability::whereIn('id', $request->getAbilityIds())->get();
        }

        foreach ($department->getAbilities() ?? [] as $ability) {
            $department->disallow($ability->name);
        }

        foreach ($department->getRoles() ?? [] as $role) {
            $department->retract($role);
        }

        $department->refresh();

        foreach ($abilities ?? [] as $ability) {
            $department->allow($ability->name);
            $department->refresh();
        }

        foreach ($roles ?? [] as $role) {
            $department->assign($role->name);
            $department->refresh();
        }

        $this->bouncer->refresh();

        // Had to delete users token for user to log in again
        foreach ($department->getUsers() as $user) {
            // Except for the super admin
            if ($user->can('*')) {
                continue;
            }

            $user->tokens()->delete();
        }

        return new DepartmentResource($department);
    }
}
