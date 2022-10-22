<?php

declare(strict_types=1);

namespace App\Http\Requests\Collection;

use App\Enums\PaymentTypesEnum;
use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

final class UpdateCollectionRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'address' => 'string|nullable',
            'amount' => 'nullable',
            'date_posted' => 'date|required',
            'collection_order_number' => [
                'string',
                'required',
                Rule::unique('collections', 'collection_order_number')->ignore($this->id),
            ],
            'remarks' => 'string|nullable',
            'customer_id' => 'required|exists:App\Models\Customer,id',
            'document_id' => 'int|required|exists:App\Models\Document,id',
            'salesman_id_1' => 'int|nullable|exists:App\Models\Salesman,id',
            'salesman_id_2' => 'int|nullable|exists:App\Models\Salesman,id',
            'term_id' => 'int|nullable|exists:App\Models\Term,id',
            'vat_id' => 'int|nullable|exists:App\Models\Vat,id',
            'qr_code' => 'string|nullable',
            'payment_items' => 'array|required',
            'payment_items.*.type' => [
                'string',
                'required',
                Rule::in(array_column(PaymentTypesEnum::cases(), 'value')),
            ],
            'payment_items.*.account_id' => [
                'int',
                'required',
                'exists:App\Models\Account,id'
            ],
            'payment_items.*.amount' => [
                'required',
            ],
            'payment_items.*.payment_date' => [
                'required',
                'date',
            ],
            'dr_items' => 'array|required',
            'dr_items.*.sales_dr_id' => 'int|required|exists:App\Models\SalesDr,id',
            'dr_items.*.amount_to_pay' => '',
            'promo_code' => 'string|nullable',
        ];
    }
}
