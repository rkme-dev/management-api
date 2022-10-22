<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Role;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\Role\RoleUpdateRequest;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Silber\Bouncer\Bouncer;
use Silber\Bouncer\Database\Ability;
use Silber\Bouncer\Database\Role;

final class RoleUpdateController extends AbstractAPIController
{
    private Bouncer $bouncer;

    public function __construct(Bouncer $bouncer) {
        $this->bouncer = $bouncer;
    }

    public function __invoke(RoleUpdateRequest $request, int $id): JsonResource
    {
        $role = Role::find($id);

        if ($role === null) {
            return $this->respondNotFound('Role not found');
        }

        foreach ($role->abilities as $ability) {
            if (\in_array($ability->id , $request->getAbilityIds()) === false) {
                $this->bouncer->disallow($role)->to($ability);
            }
        }

        foreach ($request->getAbilityIds() as $abilityId) {
            $ability = Ability::find($abilityId);

            $this->bouncer->allow($role)->to($ability);
        }

        if ($role->title !== $request->getName() && $request->getName() !== null ) {
            $role->title = $request->getName();
            $role->name = str_replace(' ', '-', strtolower($request->getName()));
            $role->save();
        }

        $this->bouncer->refresh();

        // @TODO Line 52 to 62 can be written in a service class
        $users = User::all();

        // Had to delete users token for user to log in again
        foreach ($users as $user) {
            // Except for the super admin
            if ($user->can('*')) {
                continue;
            }

            $user->tokens()->delete();
        }

        return new JsonResource([
            'data' => $role->refresh(),
        ]);
    }
}
