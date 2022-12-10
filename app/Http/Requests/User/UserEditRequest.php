<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

use App\Enums\UserStatusesEnum;
use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

final class UserEditRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'role_id' => 'int|nullable',
            'password' => 'nullable|min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6',
            'name' => 'nullable|string',
            'email' => 'nullable|string',
            'status' => Rule::in(array_column(UserStatusesEnum::cases(), 'value')),
            'abilities' => 'array',
        ];
    }
}
