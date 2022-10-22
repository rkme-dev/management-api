<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\FinishProducts;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\FinishProduct\RemoveUnitAndPackingToProductRequest;
use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

final class RemoveUnitAndPackingToProductController extends AbstractAPIController
{
    public function __invoke(RemoveUnitAndPackingToProductRequest $request, int $id): JsonResource
    {
        $product = Product::find($id);

        $product->units()->detach([$request->get('unit_id')]);

        $product->refresh();

        $product->units;

        return new JsonResource($product);
    }
}
