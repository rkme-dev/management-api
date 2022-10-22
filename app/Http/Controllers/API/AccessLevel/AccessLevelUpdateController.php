<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\AccessLevel;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\AccessLevel\AccessLevelUpdateRequest;
use App\Http\Resources\AccessLevel\AccessLevelResource;
use App\Models\AccessLevel;
use Illuminate\Support\Facades\Response;
use Silber\Bouncer\Bouncer;
use Silber\Bouncer\Database\Ability;
use Silber\Bouncer\Database\Role;

final class AccessLevelUpdateController extends AbstractAPIController
{
    private Bouncer $bouncer;

    public function __construct(Bouncer $bouncer) {
        $this->bouncer = $bouncer;
    }

    public function __invoke(int $id, AccessLevelUpdateRequest $request)
    {
        $accessLevel = AccessLevel::find($id);

        $exist = null;

        if ($accessLevel->name !== $request->getName()) {
            $exist = AccessLevel::where('name', $request->getName())->first();
        }

        if ($exist !== null) {
            return Response::json(array(
                'name' => 'AccessLevel name already exist.',
            ), 422);
        }

        if ($accessLevel === null) {
            return $this->respondNotFound('Access Level not found.');
        }

        $roles = [];

        if (\count($request->getRoleIds() ?? []) > 0) {
            $roles = Role::whereIn('id', $request->getRoleIds())->get();

        }

        $abilities = [];

        if (\count($request->getAbilityIds() ?? []) > 0) {
            $abilities = Ability::whereIn('id', $request->getAbilityIds())->get();
        }

        foreach ($accessLevel->getAbilities() ?? [] as $ability) {
            $accessLevel->disallow($ability->name);
        }

        foreach ($accessLevel->getRoles() ?? [] as $role) {
            $accessLevel->retract($role);
        }

        $accessLevel->refresh();

        foreach ($abilities ?? [] as $ability) {
            $accessLevel->allow($ability->name);
            $accessLevel->refresh();
        }

        foreach ($roles ?? [] as $role) {
            $accessLevel->assign($role->name);
            $accessLevel->refresh();
        }

        $this->bouncer->refresh();

        return new AccessLevelResource($accessLevel);
    }
}
