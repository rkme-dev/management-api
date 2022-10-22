<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

final class UserShowController extends AbstractAPIController
{
    public function __invoke(int $id): JsonResource
    {
        $user = User::find($id);

        if ($user === null || $user->id === 1) {
            return $this->respondNotFound('User not found');
        }

        return new UserResource($user);
    }
}
