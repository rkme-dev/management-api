<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\RawMaterial;

use App\Enums\ProductTypeEnums;
use App\Http\Controllers\API\AbstractAPIController;
use App\Models\RawMaterial;
use Illuminate\Http\Resources\Json\JsonResource;

final class ListRawMaterialController extends AbstractAPIController
{
    public function __invoke(): JsonResource
    {
        return new JsonResource(RawMaterial::whereNull('deleted_at')
        // where('type', ProductTypeEnums::FINISHED_PRODUCT->value)
        ->with('units')
            ->orderBy('created_at', 'desc')
            ->get());
    }
}
