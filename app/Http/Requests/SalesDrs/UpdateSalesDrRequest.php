<?php

declare(strict_types=1);

namespace App\Http\Requests\SalesDrs;

use App\Http\Requests\BaseRequest;

final class UpdateSalesDrRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'sales_invoice_number' => 'nullable',
            'area' => 'string|nullable',
            'amount' => 'nullable',
            'date_posted' => 'date',
            'remarks' => 'string|nullable',
            'customer_id' => 'required|exists:App\Models\Customer,id',
            'document_id' => 'int|required|exists:App\Models\Document,id',
            'salesman_id_1' => 'int|nullable|exists:App\Models\Salesman,id',
            'salesman_id_2' => 'int|nullable|exists:App\Models\Salesman,id',
            'term_id' => 'int|nullable|exists:App\Models\Term,id',
            'vat_id' => 'int|nullable|exists:App\Models\Vat,id',
            'qr_code' => 'string|nullable',
            'order_items' => 'array|required',
            'order_items.*.id' => 'int|nullable|exists:App\Models\OrderItem,id',
            'order_items.*.product_id' => 'int|required|exists:App\Models\Product,id',
            'order_items.*.quantity' => 'int|required',
            'order_items.*.price' => 'required',
            'order_items.*.total_amount' => 'required',
            'order_items.*.unit' => 'string|required',
            'promo_code' => 'string|nullable',
        ];
    }
}
