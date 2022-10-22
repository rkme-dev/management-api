<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Role;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Resources\Role\RolesResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Silber\Bouncer\Database\Role;

final class RoleListController extends AbstractAPIController
{
    public function __invoke(): JsonResource
    {
        return new RolesResource(Role::with('abilities')->get());
    }
}
