<?php

declare(strict_types=1);

namespace App\Http\Resources\RawMaterial;

use App\Http\Resources\Resource;
use App\Models\ReleaseOrder;

final class ReleaseOrdersResource extends Resource
{
    protected function getResponse(): array
    {
        $releaseOrders = [];

        foreach ($this->resource as $releaseOrder) {
            $releaseOrders['data'][] = new ReleaseOrderResource($releaseOrder);
        }

        return $releaseOrders;
    }
}
