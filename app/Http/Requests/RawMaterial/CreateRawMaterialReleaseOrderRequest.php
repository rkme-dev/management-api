<?php

declare(strict_types=1);

namespace App\Http\Requests\RawMaterial;

use App\Http\Requests\BaseRequest;
use App\Models\ProductReleaseOrder;

final class CreateRawMaterialReleaseOrderRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'description' => 'string|nullable',
            'raw_materials' => 'array|required',
            'raw_materials.*.id' => 'int|nullable|exists:App\Models\ProductReleaseOrder,id',
            'raw_materials.*.product_id' => 'int|required|exists:App\Models\Product,id',
            'raw_materials.*.total_pieces' => 'int|required',
            'raw_materials.*.total_boxes' => 'int|nullable',
            'raw_materials.*.description' => 'string|nullable',
        ];
    }
}
