<?php

declare(strict_types=1);

namespace App\Http\Requests\Product;

use App\Enums\ProductTypeEnums;
use App\Enums\RawMaterialTypeEnums;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductUpdateRequest extends FormRequest
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
            'name' => 'required',
            'sku' => 'required',
            'description' => 'required',
            'type' => [
                'string',
                'required',
                Rule::in(array_column(ProductTypeEnums::cases(), 'value')),
            ],
            'raw_material_type' => [
                'string',
                Rule::in(array_column(RawMaterialTypeEnums::cases(), 'value')),
            ],
        ];
    }
}
