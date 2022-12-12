<?php

declare(strict_types=1);

namespace App\Http\Requests\Accounts;

use App\Enums\AccountsNormalEnums;
use App\Enums\AccountsTypeEnums;
use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

final class UpdateAccountRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'is_active' => 'required|boolean',
            'account_code' => 'string|required',
            'account_title' => 'string|required',
            'type' => [
                'string',
                'required',
                Rule::in(array_column(AccountsTypeEnums::cases(), 'value')),
            ],
            'normal' => [
                'string',
                'required',
                Rule::in(array_column(AccountsNormalEnums::cases(), 'value')),
            ],
        ];
    }
}
