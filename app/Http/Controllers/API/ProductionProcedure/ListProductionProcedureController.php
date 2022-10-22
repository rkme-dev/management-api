<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\ProductionProcedure;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Resources\ProductionProcedure\ProductionProceduresResource;
use App\Models\ProductionProcedure;
use Illuminate\Http\Resources\Json\JsonResource;

final class ListProductionProcedureController extends AbstractAPIController
{
    public function __invoke(): JsonResource
    {
        return new ProductionProceduresResource(ProductionProcedure::all());
    }
}
