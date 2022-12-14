<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\FinishProducts;

use App\Enums\ProductTypeEnums;
use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\FinishProduct\CreateFinishProductRequest;
use App\Models\Product;
use App\Models\ProductRawMaterial;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

final class CreateFinishProductController extends AbstractAPIController
{
    public function __invoke(CreateFinishProductRequest $request): JsonResource
    {
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
                'active' => true,
                'slug' => Str::slug($request->get('name')),
                'type' => ProductTypeEnums::FINISHED_PRODUCT->value,
                'created_by' => $this->getUser()->getId(),
            ],
        ];

        $product = Product::create($data);

        $syncData = [];

        foreach ($request->get('units') as $unit) {
            $syncData[$unit['id']]['packing'] = $unit['pivot']['packing'];
        }

        // Arrays of raw material ids
        if (count($request->get('raw_materials')) > 0) {
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
