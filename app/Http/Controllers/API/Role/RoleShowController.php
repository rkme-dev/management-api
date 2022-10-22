<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Role;

use App\Http\Controllers\API\AbstractAPIController;
use Illuminate\Http\Resources\Json\JsonResource;
use Silber\Bouncer\Database\Role;

final class RoleShowController extends AbstractAPIController
{
    public function __invoke(int $id): JsonResource
    {
        $role = Role::with('abilities')->find($id);

        if ($role === null) {
            return $this->respondNotFound('Role not found');
        }

        return new JsonResource([
            'data' => $role,
        ]);
    }
}
