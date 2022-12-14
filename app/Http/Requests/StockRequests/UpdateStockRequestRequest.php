<?php

declare(strict_types=1);

namespace App\Http\Requests\StockRequests;

use App\Enums\ProductionTypesEnum;
use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

final class UpdateStockRequestRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'date' => 'date|required',
            'process_type' => [
                'string',
                'required',
                Rule::in(array_column(ProductionTypesEnum::cases(), 'value')),
            ],
            'remarks' => 'string|nullable',
            'document_id' => 'int|required|exists:App\Models\Document,id',
            'location_id' => 'int|required|exists:App\Models\Location,id',
            'items_to_produce' => 'array|nullable',
            'stock_items' => 'array|required',
        ];
    }
}
