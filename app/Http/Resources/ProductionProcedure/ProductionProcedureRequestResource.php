<?php

declare(strict_types=1);

namespace App\Http\Resources\ProductionProcedure;

use App\Exceptions\InvalidResourceTypeException;
use App\Http\Resources\Resource;
use App\Models\ProductionProcedureRequest;

final class ProductionProcedureRequestResource extends Resource
{
    /**
     * @throws InvalidResourceTypeException
     */
    protected function getResponse(): array
    {
        $productionProcedureRequest = $this->resource;

        if (($productionProcedureRequest instanceof ProductionProcedureRequest) === false) {
            throw new InvalidResourceTypeException(
                ProductionProcedureRequest::class
            );
        }

        return [
            'id' => $productionProcedureRequest->id,
            'status' => $productionProcedureRequest->status,
            'total_pieces' => $productionProcedureRequest->total_pieces,
            'total_boxes' => $productionProcedureRequest->total_boxes,
            'created_by' => $productionProcedureRequest->getCreatedBy()->getFullName(),
            'updated_by' => $productionProcedureRequest->getUpdatedBy()?->getFullName(),
            'released_by' => $productionProcedureRequest->getReleasedBy()?->getFullName(),
        ];
    }
}
