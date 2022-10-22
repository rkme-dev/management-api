<?php

namespace App\Http\Requests\PurchaseOrder;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseOrderApproveRequest extends FormRequest
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
            'fx_number' => 'required|alpha_dash',
            'usd_conversion' => 'required',
            'peso_conversion' => 'required',
            'dp_percentage' => 'required',
            'paid_amount' => 'required',
            'supplier_id' => 'required',
            'total' => 'required',
            'conversion_rate' => 'required',
        ];
    }
}
