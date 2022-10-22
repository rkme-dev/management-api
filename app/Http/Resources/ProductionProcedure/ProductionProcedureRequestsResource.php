<?php

declare(strict_types=1);

namespace App\Http\Resources\ProductionProcedure;

use App\Http\Resources\Resource;

final class ProductionProcedureRequestsResource extends Resource
{
    protected function getResponse(): array
    {
        $productionProcedureRequests = [];

        foreach ($this->resource as $productionProcedureRequest) {
            $productionProcedureRequests[] = new ProductionProcedureRequestResource($productionProcedureRequest);
        }

        return $productionProcedureRequests;
    }
}
