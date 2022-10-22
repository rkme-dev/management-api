<?php

declare(strict_types=1);

namespace App\Http\Resources\Department;

use App\Http\Resources\Resource;

final class DepartmentsResource extends Resource
{
    protected function getResponse(): array
    {
        $departments = [];

        foreach ($this->resource as $department) {
            $departments['data'][] = new DepartmentResource($department);
        }

        return $departments;
    }
}
