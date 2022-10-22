<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Product;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

final class ProductDeleteController extends AbstractAPIController
{
    public function __invoke(string $id): JsonResponse
    {
        $customer = Product::find($id);
        $customer->delete();

        return $this->respondNoContent();
    }
}
