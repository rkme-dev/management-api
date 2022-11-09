<?php

declare(strict_types=1);

namespace App\Http\Requests\Deposits;

use App\Http\Requests\BaseRequest;

final class CreateDepositRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'check_ids' => 'array',
            'date_posted' => 'required',
            'clearing_date' => 'required',
            'remarks' => 'string|nullable',
            'document_id' => 'int|required|exists:App\Models\Document,id',
            'account_id' => 'int|required|exists:App\Models\Account,id',
        ];
    }
}
