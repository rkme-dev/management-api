<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\FinishProducts;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

final class ShowFinishProductController extends AbstractAPIController
{
    public function __invoke(int $id): JsonResource
    {
        $product = Product::find($id);

        return new JsonResource($product);
    }
}
