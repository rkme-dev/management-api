<?php

declare(strict_types=1);

namespace App\Http\Requests\Warehouse;

use App\Enums\WarehouseStatusesEnum;
use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

final class UpdateWarehouseRequest extends BaseRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'string|nullable',
            'status' => [
                'string',
                'nullable',
                Rule::in(array_column(WarehouseStatusesEnum::cases(), 'value')),
            ],
            'address' => 'string|nullable',
            'contact_number' => 'string|nullable',
            'is_main' => 'boolean|nullable',
        ];
    }
}
