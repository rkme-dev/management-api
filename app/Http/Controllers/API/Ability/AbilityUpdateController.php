<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Ability;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\Ability\AbilityCreateRequest;
use App\Http\Resources\Ability\AbilityResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Silber\Bouncer\Database\Ability;

final class AbilityUpdateController extends AbstractAPIController
{
    public function __invoke(AbilityCreateRequest $request, int $id): JsonResource
    {
        $ability = Ability::find($id);

        if ($ability === null) {
            return $this->respondNotFound('Ability not found');
        }

        $abilityName = \sprintf(
            '%s-%s',
            \lcfirst($request->getAction()),
            \lcfirst($request->getModule()),
        );

        $changeExist = Ability::where('name', '=', $abilityName)->first();

        if ($changeExist !== null) {
            return $this->respondConflict('Ability name and module already exist');
        }

        $ability->name = $abilityName;

        $ability->title = \sprintf(
            '%s %s',
            \ucfirst($request->getAction()),
            \ucfirst($request->getModule()),
        );

        $ability->save();

        return new AbilityResource($ability);
    }
}
