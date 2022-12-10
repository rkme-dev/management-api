<?php

declare(strict_types=1);

namespace App\Http\Requests\Documents;

use App\Enums\DocumentsEnums;
use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

final class CreateDocumentRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'is_active' => 'required|boolean',
            'document_name' => 'string|required|unique:App\Models\Document,document_name',
            'module' => [
                'string',
                'required',
                Rule::in(array_column(DocumentsEnums::cases(), 'value')),
            ],
            'notes' => 'string|nullable',
            'description' => 'string|required',
        ];
    }
}
