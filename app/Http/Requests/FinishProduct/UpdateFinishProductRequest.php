<?php

declare(strict_types=1);

namespace App\Http\Requests\FinishProduct;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

final class UpdateFinishProductRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'active' => '',
            'name' => [
                'string',
                'required',
                Rule::unique('products', 'name')->ignore($this->id),
            ],
            'sku' => [
                'string',
                'nullable',
                Rule::unique('products', 'sku')->ignore($this->id),
            ],
            'description' => 'string|nullable',
            'grouping' => 'string|nullable',
            'brand' => 'string|nullable',
            'price' => 'nullable',
            'unit_id' => 'nullable|int|exists:App\Models\UnitPacking,id',
            'units' => 'array|nullable',
        ];
    }
}
