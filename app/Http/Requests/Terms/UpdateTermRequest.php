<?php

declare(strict_types=1);

namespace App\Http\Requests\Terms;

use App\Http\Requests\BaseRequest;

final class UpdateTermRequest extends BaseRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'is_active' => 'required|boolean',
            'code' => 'string|required',
            'notes' => 'string|nullable',
            'description' => 'string|nullable',
            'days' => 'int|required',
        ];
    }
}
