<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Department;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Resources\Ability\AbilitiesResource;
use App\Models\Department;
use Illuminate\Http\Resources\Json\JsonResource;

final class DepartmentAbilitiesController extends AbstractAPIController
{
    public function __invoke(int $id): JsonResource
    {
        $department = Department::find($id);

        $abilities = $department->getAbilities();

        return new AbilitiesResource($abilities, true);
    }
}
