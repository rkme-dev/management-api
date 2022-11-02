<?php

declare(strict_types=1);

namespace App\Http\Requests\BouncedDeposits;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

final class UpdateBouncedDepositRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'check_ids' => 'array',
            'bounced_number' => [
                'string',
                'required',
                Rule::unique('bounced_deposits','bounced_number')->ignore($this->id),
            ],
            'amount' => 'required',
            'date_posted' => 'required',
            'clearing_date' => 'required',
            'remarks' => 'string|nullable',
            'document_id' => 'int|required|exists:App\Models\Document,id',
            'account_id' => 'int|required|exists:App\Models\Account,id',
        ];
    }
}
