<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Department;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Resources\Department\DepartmentResource;
use App\Models\Department;
use Illuminate\Http\Resources\Json\JsonResource;
use Silber\Bouncer\Database\Role;

final class DepartmentShowController extends AbstractAPIController
{
    public function __invoke(int $id): JsonResource
    {
        $department = Department::with(['roles','abilities'])->find($id);

        if ($department === null) {
            return $this->respondNotFound('Department not found');
        }

        return new DepartmentResource($department);
    }
}
