<?php

declare(strict_types=1);

namespace App\Http\Requests\UnitPackings;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

final class UpdateUnitPackingRequest extends BaseRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'is_active' => 'required|boolean',
            'name' => [
                'string',
                'required',
                Rule::unique('unit_packings', 'name')->ignore($this->id),
            ],
        ];
    }
}
