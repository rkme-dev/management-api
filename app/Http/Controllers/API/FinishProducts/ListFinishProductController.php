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
        return new JsonResource(Product::where('type', ProductTypeEnums::FINISHED_PRODUCT->value)
            ->whereNull('deleted_at')
        ->with(['units', 'rawMaterials.rawMaterial'])
            ->orderBy('created_at', 'desc')
            ->get());
    }
}
