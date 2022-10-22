<?php

declare(strict_types=1);

namespace App\Http\Requests\FinishProduct;

use App\Http\Requests\BaseRequest;

final class RemoveUnitAndPackingToProductRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'unit_id' => 'required|int|exists:App\Models\UnitPacking,id',
        ];
    }
}
