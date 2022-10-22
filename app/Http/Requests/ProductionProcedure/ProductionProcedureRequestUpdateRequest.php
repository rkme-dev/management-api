<?php

declare(strict_types=1);

namespace App\Http\Requests\ProductionProcedure;

use App\Http\Requests\BaseRequest;

final class ProductionProcedureRequestUpdateRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id' => 'int|required|exists:App\Models\Product,id',
            'total_pieces' => 'string|nullable',
            'total_boxes' => 'string|nullable',
        ];
    }
}
