<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\FinishProducts;

use App\Enums\ProductTypeEnums;
use App\Http\Controllers\API\AbstractAPIController;
use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

final class ListFinishProductController extends AbstractAPIController
{
    public function __invoke(): JsonResource
    {
        $finishedProducts = Product::where('type', ProductTypeEnums::FINISHED_PRODUCT->value)
            ->whereNull('deleted_at')
            ->with(['units', 'rawMaterials.rawMaterial'])
            ->orderBy('created_at', 'desc')
            ->get();

        $results = [];

        foreach ($finishedProducts as $finishedProduct) {
            $computed = $finishedProduct->toArray();

            if (count($finishedProduct->rawMaterials ?? []) > 0) {
                $computedRawMaterials = [];

                foreach ($finishedProduct->rawMaterials as $rawMaterial) {
                    $computedRawMaterials[] = $rawMaterial->rawMaterial;
                }

                $computed['raw_materials'] = $computedRawMaterials;
            }

            $results[] = $computed;
        }

        return new JsonResource($results);
    }
}
