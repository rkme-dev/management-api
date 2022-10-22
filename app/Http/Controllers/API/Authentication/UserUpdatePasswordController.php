<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Authentication;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\User\UserEditRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

final class UserUpdatePasswordController extends AbstractAPIController
{
    public function __invoke(UserEditRequest $request, int $id)
    {
        $user = User::find($id);

        if ($user === null) {
            return $this->respondNotFound('User not found.');
        }

        $user->password = Hash::make($request->get('password'));
        $user->save();

        return $this->respondNoContent();
    }
}
