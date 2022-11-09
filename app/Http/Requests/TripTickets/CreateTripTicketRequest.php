<?php

declare(strict_types=1);

namespace App\Http\Requests\TripTickets;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

final class CreateTripTicketRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'date_posted' => 'required',
            'area' => 'required|string',
            'driver' => 'required|string',
            'assistant' => 'string|nullable',
            'truck' => 'string|nullable',
            'plate_number' => 'string|required',
            'document_id' => 'required|int|exists:App\Models\Document,id',
            'remarks' => 'string|nullable',
            'dr_items' => 'array|required',
            'dr_items.*' => [
                'int',
                'required',
                Rule::exists('order_items', 'id')
                    ->where('orderable_type', 'App\Models\SalesDr'),
            ],
        ];
    }
}
