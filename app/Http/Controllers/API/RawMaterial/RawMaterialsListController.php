<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\RawMaterial;

use App\Enums\ProductTypeEnums;
use App\Http\Controllers\API\AbstractAPIController;
use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

final class RawMaterialsListController extends AbstractAPIController
{
    public function __invoke(): JsonResource
    {
        return new JsonResource([
            'data' => Product::where('type', ProductTypeEnums::RAW_MATERIAL->value)
                ->orderBy('created_at', 'desc')
                ->get(),
        ]);
    }
}
