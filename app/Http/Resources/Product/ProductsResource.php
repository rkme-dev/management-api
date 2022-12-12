<?php

declare(strict_types=1);

namespace App\Http\Resources\Product;

use App\Http\Resources\Resource;

final class ProductsResource extends Resource
{
    protected function getResponse(): array
    {
        $products = [];

        foreach ($this->resource as $product) {
            $products['data'][] = new ProductResource($product);
        }

        return $products;
    }
}
