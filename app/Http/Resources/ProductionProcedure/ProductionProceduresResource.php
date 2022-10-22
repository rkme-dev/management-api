<?php

declare(strict_types=1);

namespace App\Http\Resources\ProductionProcedure;

use App\Http\Resources\Resource;

final class ProductionProceduresResource extends Resource
{
    protected function getResponse(): array
    {
        $productionProcedures = [];

        foreach ($this->resource as $productionProcedure) {
            $productionProcedures[] = new ProductionProcedureResource($productionProcedure);
        }

        return $productionProcedures;
    }
}
