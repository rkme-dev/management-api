<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Ability;

use App\Http\Controllers\API\AbstractAPIController;
use Illuminate\Http\JsonResponse;
use Silber\Bouncer\Database\Ability;

final class AbilityDeleteController extends AbstractAPIController
{
    public function __invoke(int $id): JsonResponse
    {
        $ability = Ability::find($id);

        $ability->delete();

        return $this->respondNoContent();
    }
}
