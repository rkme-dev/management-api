<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Department;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Resources\Department\DepartmentsResource;
use App\Models\Department;
use Illuminate\Http\Resources\Json\JsonResource;

final class DepartmentListController extends AbstractAPIController
{
    public function __invoke(): JsonResource
    {
        return new DepartmentsResource(Department::with(['roles', 'abilities'])
            ->orderBy('created_at', 'desc')
            ->get());
    }
}
