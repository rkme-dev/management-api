<?php

declare(strict_types=1);

namespace App\Http\Resources\Product;

use App\Exceptions\InvalidResourceTypeException;
use App\Http\Resources\Resource;
use App\Models\Product;

final class ProductResource extends Resource
{
    /**
     * @throws InvalidResourceTypeException
     */
    protected function getResponse(): array
    {
        if (($this->resource instanceof Product) === false) {
            throw new InvalidResourceTypeException(
                Product::class
            );
        }

        $product = $this->resource;

        $productNumber = \str_pad((string) $product->id, 8, '0', STR_PAD_LEFT);

        $productNumber = sprintf('RM-%s', $productNumber);

        return [
            'id' => $product->id,
            'name' => $product->name,
            'product_number' => $productNumber,
            'sku' => $product->sku,
            'description' => $product->description,
            'raw_material_type' => $product->raw_material_type,
            'type' => $product->type,
        ];
    }
}
