<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class CustomerCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'address' => 'nullable|string',
            'delivery_address' => 'nullable|string',
            'email' => 'nullable|email:rfc,dns|unique:customers',
            'contact_person' => 'nullable|string',
            'contact_no' => 'nullable|string',
            'credit_limit' => 'nullable',
            'is_active' => 'boolean',
            'salesman_id_1' => 'nullable|integer|exists:App\Models\Salesman,id',
            'salesman_id_2' => 'nullable|integer|exists:App\Models\Salesman,id',
            'area' => 'nullable|string',
            'term_id' => 'nullable|integer|exists:App\Models\Term,id',
            'vat_id' => 'nullable|integer|exists:App\Models\Vat,id',
            'type' => 'required|string',
            'notes' => 'string|nullable',
            'tin' => 'nullable|string',
            'is_bad_account' => 'boolean',
        ];
    }
}
