<?php

declare(strict_types=1);

namespace App\Http\Requests\UnitPackings;

use App\Http\Requests\BaseRequest;

final class CreateUnitPackingRequest extends BaseRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'is_active' => 'required|boolean',
            'name' => 'string|required|unique:App\Models\UnitPacking,name',
        ];
    }
}
