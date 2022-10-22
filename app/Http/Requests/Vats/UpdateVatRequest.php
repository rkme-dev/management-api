<?php

declare(strict_types=1);

namespace App\Http\Requests\Vats;

use App\Http\Requests\BaseRequest;

final class UpdateVatRequest extends BaseRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'is_active' => 'required|boolean',
            'code' => 'string|nullable',
            'notes' => 'string|nullable',
            'percentage' => 'int',
            'name' => 'string',
        ];
    }
}
