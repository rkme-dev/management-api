<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\User;

use App\Enums\UserStatusesEnum;
use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\User\UserEditRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;
use Silber\Bouncer\Bouncer;
use Silber\Bouncer\Database\Ability;
use Silber\Bouncer\Database\Role;

final class UserEditController extends AbstractAPIController
{
    private Bouncer $bouncer;

    public function __construct(Bouncer $bouncer)
    {
        $this->bouncer = $bouncer;
    }

    public function __invoke(UserEditRequest $request, int $id)
    {
        $user = User::find($id);

        if ($user === null) {
            return $this->respondNotFound('User not found');
        }

        $emailExist = null;

        if ($user->email !== $request->get('email') && $request->get('email') !== null) {
            $emailExist = User::where('email', '=', $request->get('email'))->first();
        }

        if ($emailExist !== null) {
            return Response::json([
                'email' => 'Email already exist',
            ], 422);
        }

        $data = \array_filter($request->all());

        if ($request->get('role_id') !== null) {
            $role = $user->getRoles()[0] ?? null;

            if ($role !== null) {
                $user->retract($role);
            }

            $role = Role::find($request->get('role_id'));

            if ($role === null) {
                return Response::json([
                    'role_id' => 'Invalid Role selected',
                ], 422);
            }

            $user->assign($role->name);
        }

        $data['is_active'] = $request->get('status') === UserStatusesEnum::ACTIVE->value;

        $data['birth_date'] = ($request->get('birth_date') !== null) ? new Carbon($request->get('birth_date')) : null;
        $data['date_hired'] = ($request->get('date_hired') !== null) ? new Carbon($request->get('date_hired')) : null;

        $user->update($data);

        $abilityIds = $request->abilities;

        // Remove all abilities to set new abilities
        if ($abilityIds !== null) {
            foreach ($user->getAbilities() ?? [] as $ability) {
                $user->disallow($ability->name);
            }

            $user->refresh();
        }

        $abilities = Ability::whereIn('id', $request->get('abilities') ?? [])->get();

        foreach ($abilities as $ability) {
            $user->allow($ability->name);
        }

        $this->bouncer->refresh();

        $user->tokens()->delete();

        return new UserResource($user);
    }
}
