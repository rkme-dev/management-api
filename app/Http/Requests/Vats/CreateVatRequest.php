<?php

declare(strict_types=1);

namespace App\Http\Requests\Vats;

use App\Http\Requests\BaseRequest;

final class CreateVatRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'is_active' => 'required|boolean',
            'code' => 'string|required|unique:App\Models\Vat,code',
            'percentage' => 'int|required',
            'notes' => 'string|nullable',
            'name' => 'string|required|unique:App\Models\Vat,name',
        ];
    }
}
