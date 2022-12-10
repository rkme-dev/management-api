<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Ability;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Resources\Ability\AbilitiesResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Silber\Bouncer\Database\Ability;

final class AbilityListController extends AbstractAPIController
{
    public function __invoke(Request $request): JsonResource
    {
        $byModule = $request->get('order_by_module');

        $byModule = filter_var($byModule, FILTER_VALIDATE_BOOLEAN);

        return new JsonResource([
            'data' => new AbilitiesResource(Ability::all(), $byModule),
        ]);
    }
}
