<?php

declare(strict_types=1);

namespace App\Http\Requests\SalesDrs;

use App\Http\Requests\BaseRequest;

final class CreateSalesDrRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'address' => 'string|nullable',
            'area' => 'string|nullable',
            'amount' => 'nullable',
            'date_posted' => 'date|required',
            'remarks' => 'string|nullable',
            'customer_id' => 'required|exists:App\Models\Customer,id',
            'document_id' => 'int|required|exists:App\Models\Document,id',
            'salesman_id_1' => 'int|nullable|exists:App\Models\Salesman,id',
            'salesman_id_2' => 'int|nullable|exists:App\Models\Salesman,id',
            'term_id' => 'int|nullable|exists:App\Models\Term,id',
            'vat_id' => 'int|nullable|exists:App\Models\Vat,id',
            'qr_code' => 'string|nullable',
            'order_item_ids' => 'array|required',
            'order_item_ids.*' => 'int|required|exists:App\Models\OrderItem,id',
        ];
    }
}
