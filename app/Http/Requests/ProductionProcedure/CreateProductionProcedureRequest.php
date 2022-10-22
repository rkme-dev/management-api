<?php

declare(strict_types=1);

namespace App\Http\Requests\ProductionProcedure;

use App\Enums\ProductionProcedureTypesEnum;
use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

final class CreateProductionProcedureRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'procedure_type' => [
                'string',
                'required',
                Rule::in(array_column(ProductionProcedureTypesEnum::cases(), 'value')),
            ],
            'report_description' => 'string|nullable',
            'total_package_output' => 'string|nullable',
            'total_output' => 'string|nullable',
            'total_rejected' => 'string|nullable',
        ];
    }
}
