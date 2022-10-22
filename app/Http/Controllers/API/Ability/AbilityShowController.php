<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Ability;

use App\Http\Controllers\API\AbstractAPIController;
use Illuminate\Http\Resources\Json\JsonResource;
use Silber\Bouncer\Database\Ability;

final class AbilityShowController extends AbstractAPIController
{
    public function __invoke(int $id): JsonResource
    {
        $ability = Ability::find($id);

        if ($ability === null) {
            return $this->respondNotFound('Ability not found');
        }

        return new JsonResource([
            'data' => $ability,
        ]);
    }
}
