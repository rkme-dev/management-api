<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\FinishProducts;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\FinishProduct\UpdateFinishProductRequest;
use App\Models\Product;
use App\Models\ProductRawMaterial;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

final class UpdateFinishProductController extends AbstractAPIController
{
    public function __invoke(UpdateFinishProductRequest $request, int $id): JsonResource
    {
        $product = Product::with('units')->where('id', $id)->first();

        $data = $request->all([
            'name',
            'sku',
            'description',
            'grouping',
            'brand',
            'unit_id',
            'price',
            'active',
        ]);

        $data = [
            ...$data,
            ...[
                'slug' => Str::slug($request->get('name')),
                'updated_by' => $this->getUser()->getId(),
            ],
        ];

        $product->update($data);

        $product->units()->detach();

        $syncData = [];

        foreach ($request->get('units') as $unit) {
            $syncData[$unit['id']]['packing'] = $unit['pivot']['packing'];
        }

        if (count($request->get('raw_materials')) > 0) {
            // Delete all and then recreate
            ProductRawMaterial::where('product_id', $product->getAttribute('id'))->delete();

            foreach ($request->get('raw_materials') as $rawMaterialId) {
                ProductRawMaterial::create([
                    'raw_material_id' => $rawMaterialId,
                    'product_id' => $product->getAttribute('id'),
                ]);
            }
        }

        $product->units()->sync($syncData);

        $product->refresh();

        return new JsonResource($product);
    }
}
