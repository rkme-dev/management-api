<?php

declare(strict_types=1);

namespace App\Http\Resources\RawMaterial;

use App\Exceptions\InvalidResourceTypeException;
use App\Http\Resources\Resource;
use App\Models\ProductReleaseOrder;
final class ProductReleaseOrderResource extends Resource
{
    /**
     * @throws InvalidResourceTypeException
     */
    protected function getResponse(): array
    {
        if (($this->resource instanceof ProductReleaseOrder) === false) {
            throw new InvalidResourceTypeException(
                ProductReleaseOrder::class
            );
        }

        $productReleaseOrder = $this->resource;

        return [
            'id' => $productReleaseOrder->id,
            'total_boxes' => $productReleaseOrder->total_boxes,
            'total_pieces' => $productReleaseOrder->total_pieces,
            'product_id' => $productReleaseOrder->product_id,
            'product_name' => $productReleaseOrder->getProduct()->getAttribute('name'),
        ];
    }
}
