<?php

declare(strict_types=1);

namespace App\Http\Requests\Documents;

use App\Http\Requests\BaseRequest;
use App\Enums\DocumentsEnums;
use Illuminate\Validation\Rule;

final class UpdateDocumentRequest extends BaseRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'is_active' => 'required|boolean',
            'document_name' => 'string|required',
            'notes' => 'string|nullable',
            'module' => [
                'string',
                'required',
                Rule::in(array_column(DocumentsEnums::cases(), 'value')),
            ],
            'description' => 'string|required',
        ];
    }
}
