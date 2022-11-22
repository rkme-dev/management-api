<?php

declare(strict_types=1);

namespace App\Http\Requests\Salesman;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

final class UpdateSalesmanRequest extends BaseRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'is_active' => 'required|boolean',
            'salesman_name' => 'string|required',
            'quota' => 'nullable',

        ];
    }
}
