<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\FinishProducts;

use App\Enums\ProductTypeEnums;
use App\Http\Controllers\API\AbstractAPIController;
use App\Models\Product;
use App\Models\RawMaterial;
use Illuminate\Http\Resources\Json\JsonResource;

final class ListAllItemsController extends AbstractAPIController
{
    public function __invoke(): JsonResource
    {
        $finishedProducts = Product::where('type', ProductTypeEnums::FINISHED_PRODUCT->value)
            ->whereNull('deleted_at')
            ->with(['units'])
            ->orderBy('created_at', 'desc')
            ->get();

        $rawMaterials = RawMaterial::whereNull('deleted_at')
            ->with('units')
            ->orderBy('created_at', 'desc')
            ->get();

        $results = [
            ...$rawMaterials,
            ...$finishedProducts,
        ];


        return new JsonResource(array_values($results));
    }
}
