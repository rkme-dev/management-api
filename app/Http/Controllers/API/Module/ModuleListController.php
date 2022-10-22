<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Module;

use App\Enums\ModulesEnum;
use App\Http\Controllers\API\AbstractAPIController;
use Illuminate\Http\JsonResponse;

final class ModuleListController extends AbstractAPIController
{
    public function __invoke(): JsonResponse
    {
        return $this->respondCreated([
            'data' => ModulesEnum::cases(),
        ]);
    }
}
