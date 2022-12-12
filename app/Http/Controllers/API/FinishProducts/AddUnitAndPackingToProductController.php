<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\FinishProducts;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\FinishProduct\AddUnitAndPackingToProductRequest;
use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

final class AddUnitAndPackingToProductController extends AbstractAPIController
{
    public function __invoke(AddUnitAndPackingToProductRequest $request, int $id): JsonResource
    {
        $product = Product::find($id);

        $data[$request->get('unit_id')]['packing'] = $request->get('packing');

        $product->units()->sync($data);

        $product->refresh();

        $product->units;

        return new JsonResource($product);
    }
}
