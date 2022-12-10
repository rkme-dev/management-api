<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Ability;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\Ability\AbilityCreateRequest;
use Illuminate\Http\JsonResponse;
use Silber\Bouncer\Bouncer;

final class AbilityCreateController extends AbstractAPIController
{
    private Bouncer $bouncer;

    public function __construct(Bouncer $bouncer)
    {
        $this->bouncer = $bouncer;
    }

    public function __invoke(AbilityCreateRequest $request): JsonResponse
    {
        $ability = $this->bouncer->ability()->firstOrCreate([
            'name' => \sprintf(
                '%s-%s',
                \lcfirst($request->getAction()),
                \lcfirst($request->getModule()),
            ),
            'title' => \sprintf(
                '%s %s',
                \ucfirst($request->getAction()),
                \ucfirst($request->getModule()),
            ),
        ]);

        return $this->respondCreated([
            'data' => $ability,
        ]);
    }
}
