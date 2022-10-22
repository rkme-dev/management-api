<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Product;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

final class ProductSupplierListController extends AbstractAPIController
{
    public function __invoke(string $supplierId): JsonResponse
    {
        $products = Product::where('supplier_id', $supplierId)->get();

        return $this->respondOK(
            [
                'data' => $products,
            ]
        );
    }
}
