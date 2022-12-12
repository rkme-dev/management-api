<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Authentication;

use App\Enums\UserStatusesEnum;
use App\Http\Controllers\API\AbstractAPIController;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Silber\Bouncer\Database\Role;

final class LoginController extends AbstractAPIController
{
    public function __invoke(Request $request)
    {
        $user = User::where('email', $request['email'])->with('roles')->first();

        if ($user === null) {
            return $this->respondNotFound('Invalid Credentials');
        }

        if ($user->status !== UserStatusesEnum::ACTIVE->value) {
            return $this->respondForbidden(\sprintf(
                'Your account status is %s',
                lcfirst($user->status)
            ));
        }

        $authenticate = Auth::attempt([
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ]);

        $role = Role::where('name', $user->getRoles()->first())->first();

        $user->role_title = $role->title;

        if ($authenticate === false) {
            return $this->respondUnauthorised();
        }

        return new JsonResponse([
            'user' => $user,
            'abilities' => $user->getAbilities(),
            'ability_names' => array_column($user->getAbilities()->toArray() ?? [], 'name'),
            'access_token' => $user->createToken('token')->plainTextToken,
            'token_type' => 'Bearer',
            'expiration' => 525600,
        ]);
    }
}
