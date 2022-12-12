<?php

declare(strict_types=1);

namespace App\Http\Requests\Locations;

use App\Enums\LocationTypeEnums;
use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

final class UpdateLocationRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'is_active' => 'required|boolean',
            'location_code' => 'string|required',
            'description' => 'string',
            'address' => 'string|nullable',
            'type' => [
                'string',
                'required',
                Rule::in(array_column(LocationTypeEnums::cases(), 'value')),
            ],
        ];
    }
}
