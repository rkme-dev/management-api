<?php

namespace App\Http\Requests\PurchaseOrder;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseOrderInTransitRequest extends FormRequest
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
            'paid_amount' => 'required',
            'peso_conversion' => 'required',
            'usd_conversion' => 'required',
            'fx_number' => 'required|alpha_dash',
            'conversion_rate' => 'required',
        ];
    }
}
