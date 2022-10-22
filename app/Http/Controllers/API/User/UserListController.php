<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Resources\User\UsersResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

final class UserListController extends AbstractAPIController
{
    public function __invoke(): JsonResource
    {
        return new UsersResource(User::where('id', '<>', 1)->get());
    }
}
