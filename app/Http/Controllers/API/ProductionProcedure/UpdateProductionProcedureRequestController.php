<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\ProductionProcedure;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\ProductionProcedure\ProductionProcedureRequestUpdateRequest;
use Illuminate\Http\Resources\Json\JsonResource;

final class UpdateProductionProcedureRequestController extends AbstractAPIController
{
    public function __invoke(ProductionProcedureRequestUpdateRequest $request, int $id): JsonResource
    {

    }
}
