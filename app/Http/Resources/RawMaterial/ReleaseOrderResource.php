<?php

declare(strict_types=1);

namespace App\Http\Resources\RawMaterial;

use App\Exceptions\InvalidResourceTypeException;
use App\Http\Resources\Resource;
use App\Models\ReleaseOrder;

final class ReleaseOrderResource extends Resource
{
    /**
     * @throws InvalidResourceTypeException
     */
    protected function getResponse(): array
    {
        if (($this->resource instanceof ReleaseOrder) === false) {
            throw new InvalidResourceTypeException(
                ReleaseOrder::class
            );
        }

        $releaseOrder = $this->resource;

        return [
            'id' => $releaseOrder->id,
            'status' => $releaseOrder->status,
            'description' => $releaseOrder->description,
            'raw_materials' => new ProductReleaseOrdersResource($releaseOrder->getProductReleaseOrders()),
            'created_by' => $releaseOrder->createdBy->getFullName(),
            'released_by' => $releaseOrder->releasedBy?->getFullName(),
            'received_by' => $releaseOrder->receivedBy?->getFullName(),
            'created_at' => $releaseOrder->created_at->toDateTimestring(),
        ];
    }
}
