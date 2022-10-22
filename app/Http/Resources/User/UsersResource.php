<?php

declare(strict_types=1);

namespace App\Http\Resources\User;

use App\Http\Resources\Resource;

final class UsersResource extends Resource
{
    protected function getResponse(): array
    {
        $users = [];

        foreach ($this->resource as $user) {
            $users['data'][] = new UserResource($user);
        }

        return $users;
    }
}
