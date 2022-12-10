<?php

declare(strict_types=1);

namespace App\Http\Requests\Warehouse;

use App\Enums\WarehouseStatusesEnum;
use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

final class CreateWarehouseRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'string|required|unique:App\Models\Warehouse,name',
            'status' => [
                'string',
                'required',
                Rule::in(array_column(WarehouseStatusesEnum::cases(), 'value')),
            ],
            'address' => 'string|required',
            'contact_number' => 'string|required',
            'is_main' => 'boolean|required  ',
        ];
    }
}
