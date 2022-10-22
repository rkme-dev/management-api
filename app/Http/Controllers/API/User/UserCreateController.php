<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\User;

use App\Enums\UserStatusesEnum;
use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\User\UserCreateRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Hash;
use Silber\Bouncer\Database\Role;

final class UserCreateController extends AbstractAPIController
{
    public function __invoke(UserCreateRequest $request): JsonResource
    {
        $data = $request->all();

        $data['password'] = Hash::make($request->get('password'));
        $data['status'] = ucfirst($request->get('status'));
        $data['is_active'] = ucfirst($request->get('status')) === UserStatusesEnum::ACTIVE->value;

        $data['birth_date'] = ($request->get('birth_date') !== null) ? new Carbon($request->get('birth_date'))  : null;
        $data['date_hired'] = ($request->get('date_hired') !== null) ? new Carbon($request->get('date_hired'))  : null;

        $user = User::create($data);

        if ($request->get('role_id')) {
            $role = Role::find($request->get('role_id'));

            $user->assign($role->name);
        }

        return new JsonResource([
            'data' => $user,
        ]);
    }
}
