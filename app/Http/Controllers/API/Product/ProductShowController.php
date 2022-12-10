<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Product;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

final class ProductShowController extends AbstractAPIController
{
    public function __invoke(string $id): JsonResource
    {
        $customer = Product::findOrFail($id);

        return new ProductResource($customer);
    }
}
