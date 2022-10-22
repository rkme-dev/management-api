<?php

declare(strict_types=1);

namespace App\Http\Requests\Salesman;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

final class CreateSalesmanRequest extends BaseRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'is_active' => 'required|boolean',
            'quota' => 'nullable',
            'salesman_code' => 'string|required|unique:App\Models\Salesman,salesman_code',
            'salesman_name' => 'string|required',

        ];
    }
}
