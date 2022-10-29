<?php

declare(strict_types=1);

namespace App\Http\Requests\Deposits;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

final class UpdateDepositRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'check_ids' => 'array',
            'deposit_number' => [
                'string',
                'required',
                Rule::unique('deposits','deposit_number')->ignore($this->id),
            ],
            'amount' => 'required',
            'date_posted' => 'required',
            'clearing_date' => 'required',
            'remarks' => 'string|nullable',
            'document_id' => 'string|required|exists:App\Models\Document,id',
            'account_id' => 'string|required|exists:App\Models\Account,id',
        ];
    }
}
