<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Line;

use App\Http\Controllers\API\AbstractAPIController;
use Illuminate\Http\JsonResponse;

final class DeleteLineController extends AbstractAPIController
{
    public function __invoke(): JsonResponse
    {
        return $this->respondNoContent();
    }
}
