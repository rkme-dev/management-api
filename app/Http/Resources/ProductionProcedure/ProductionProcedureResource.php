<?php

declare(strict_types=1);

namespace App\Http\Resources\ProductionProcedure;

use App\Exceptions\InvalidResourceTypeException;
use App\Http\Resources\Resource;
use App\Models\ProductionProcedure;

final class ProductionProcedureResource extends Resource
{
    /**
     * @throws InvalidResourceTypeException
     */
    protected function getResponse(): array
    {
        $productionProcedure = $this->resource;

        if (($productionProcedure instanceof ProductionProcedure) === false) {
            throw new InvalidResourceTypeException(
                ProductionProcedure::class
            );
        }

        return [
            'id' => $productionProcedure->id,
            'report_description' => $productionProcedure->report_description,
            'procedure_type' => $productionProcedure->procedure_type,
            'status' => $productionProcedure->status,
            'total_package_output' => $productionProcedure->total_package_output,
            'total_output' => $productionProcedure->total_output,
            'total_rejected' => $productionProcedure->total_rejected,
            'production_procedure_requests' => new ProductionProcedureRequestsResource(
                $productionProcedure->getProductionProcedureRequests()
            ),
            'created_by' => $productionProcedure->getCreatedBy()->getFullName(),
            'updated_by' => $productionProcedure->getUpdatedBy()?->getFullName(),
            'received_by' => $productionProcedure->getReceivedBy()?->getFullName(),
            'released_by' => $productionProcedure->getReleasedBy()?->getFullName(),
        ];
    }
}
