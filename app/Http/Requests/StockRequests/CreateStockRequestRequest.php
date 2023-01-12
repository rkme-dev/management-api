<?php

declare(strict_types=1);

namespace App\Http\Requests\StockRequests;

use App\Enums\ProductionTypesEnum;
use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

final class CreateStockRequestRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'date' => 'date|required',
            'remarks' => 'string|nullable',
            'document_id' => 'int|required|exists:App\Models\Document,id',
            'location_id' => 'required|exists:App\Models\Location,id',
            'items_to_produce' => 'array|nullable',
            'stock_items' => 'array|required',
        ];
    }
}
