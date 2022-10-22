<?php

declare(strict_types=1);

namespace App\Http\Requests\ProductPackageType;

use App\Http\Requests\BaseRequest;

final class CreateProductPackageTypeRequest extends BaseRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'string|required',
            'quantity' => 'string|required',
        ];
    }
}
