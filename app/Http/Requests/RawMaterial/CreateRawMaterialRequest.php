<?php

declare(strict_types=1);

namespace App\Http\Requests\RawMaterial;

use App\Enums\ProductTypeEnums;
use App\Enums\RawMaterialTypeEnums;
use Illuminate\Validation\Rule;
use App\Http\Requests\BaseRequest;

final class CreateRawMaterialRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'string|required|unique:App\Models\Product,name',
            'sku' => 'nullable|unique:App\Models\Product,sku|string',
            'description' => 'string|nullable',
            'grouping' => 'string|nullable',
            'brand' => 'string|nullable',
            'price' => 'nullable',
            'unit_id' => 'nullable|int|exists:App\Models\UnitPacking,id',
            'active' => '',
            'units' => 'array|nullable',
            'type' => [
                'string',
                'required',
                Rule::in(array_column(RawMaterialTypeEnums::cases(), 'value')),
            ],
        ];
    }
}
