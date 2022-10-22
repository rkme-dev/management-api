<?php

declare(strict_types=1);

namespace App\Http\Requests\Supplier;

use Illuminate\Foundation\Http\FormRequest;

class SupplierUpdateRequest extends FormRequest
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
            'contact_person' => 'required',
            'address' => 'required',
            'bank_name' => 'required',
            'bank_account_no' => 'required|alpha_dash',
            'bank_account_address' => 'required',
            'product_ids' => 'array|nullable',
            'product_ids.*' => 'integer|exists:App\Models\Product,id',
        ];
    }
}
