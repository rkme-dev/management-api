<?php

declare(strict_types=1);

namespace App\Http\Requests\Product;

use App\Enums\ProductTypeEnums;
use App\Enums\RawMaterialTypeEnums;
use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class ProductCreateRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'type' => [
              'string',
              'required',
                Rule::in(array_column(ProductTypeEnums::cases(), 'value')),
            ],
            'raw_material_type' => [
                'string',
                'required',
                Rule::in(array_column(RawMaterialTypeEnums::cases(), 'value')),
            ],
            'name' => 'required|unique:App\Models\Product,name',
            'sku' => 'required|unique:App\Models\Product,sku|string',
            'description' => 'string|nullable',
        ];
    }
}
