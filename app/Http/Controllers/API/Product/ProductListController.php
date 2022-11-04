<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Product;

use App\Enums\ProductTypeEnums;
use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Resources\Product\ProductsResource;
use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

final class ProductListController extends AbstractAPIController
{
    public function __invoke(): JsonResource
    {
        $products = Product::where('type', ProductTypeEnums::RAW_MATERIAL->value)
            ->orderBy('created_at', 'desc')
            ->get();

        return new ProductsResource($products);
    }
}
