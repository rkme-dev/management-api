<?php

declare(strict_types=1);

namespace App\Http\Requests\Line;

use App\Enums\ProductionProcedureTypesEnum;
use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

final class CreateLineRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'string|required|unique:App\Models\Line,name',
            'description' => 'string|nullable',
            'procedure_type' => [
                'string',
                'required',
                Rule::in(array_column(ProductionProcedureTypesEnum::cases(), 'value')),
            ],
        ];
    }
}
