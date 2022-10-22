<?php

declare(strict_types=1);

namespace App\Http\Resources\RawMaterial;

use App\Http\Resources\Resource;

final class ProductReleaseOrdersResource extends Resource
{
    protected function getResponse(): array
    {
        $results = [];

        foreach ($this->resource as $productReleaseOrder) {
            $results[] = new ProductReleaseOrderResource($productReleaseOrder);
        }

        return $results;
    }
}
