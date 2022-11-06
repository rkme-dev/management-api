<?php

namespace App\Http\Requests\PhysicalCount;

use App\Http\Requests\BaseRequest;

class UpdatePhysicalCountRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'date_posted' => 'date',
            'document_id' => 'int|required|exists:documents,id',
            'location' => 'string|nullable',
            'group_1' => 'string|nullable',
            'group_2' => 'string|nullable',
            'remarks' => 'string|nullable',
            'count_by' => 'string|nullable',
            'count_date' => 'date',
            'account_title' => 'string|nullable',
            'count_items' => 'array|required',
            'count_items.*.id' => 'int|nullable|exists:count_items,id',
            'count_items.*.brand' => 'string|nullable',
            'count_items.*.product_id' => 'int|required|exists:products,id',
            'count_items.*.group_1' => 'string|nullable',
            'count_items.*.group_2' => 'string|nullable',
            'count_items.*.unit' => 'required',
            'count_items.*.quantity' => 'int|required',
            'count_items.*.price' => 'required',
            'count_items.*.total_amount' => 'required',
        ];
    }
}
