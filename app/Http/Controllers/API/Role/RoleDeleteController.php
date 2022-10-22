<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Role;

use App\Http\Controllers\API\AbstractAPIController;
use Illuminate\Http\Resources\Json\JsonResource;
use Silber\Bouncer\Database\Role;

final class RoleDeleteController extends AbstractAPIController
{
    public function __invoke(int $id): \Illuminate\Http\JsonResponse
    {
        $role = Role::find($id);

        if ($role === null) {
            return $this->respondNoContent();
        }

        Role::destroy($id);

        return $this->respondNoContent();
    }
}
