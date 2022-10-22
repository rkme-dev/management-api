<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Department;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\Department;
use Illuminate\Http\JsonResponse;

final class DepartmentDeleteController extends AbstractAPIController
{
    public function __invoke(int $id): JsonResponse
    {
        $department = Department::find($id);

        if ($department === null) {
            return $this->respondNoContent();
        }

        $department->delete();

        $department->updated_by = $this->getUser()->id;

        $department->save();

        return $this->respondNoContent();
    }
}
