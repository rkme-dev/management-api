<?php

declare(strict_types=1);

namespace App\Http\Requests\Authentication;

use App\Http\Requests\BaseRequest;

final class LoginRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return false;
    }

    public function getEmail(): string
    {
        return $this->getString('email');
    }

    public function getPassword(): string
    {
        return $this->getPassword();
    }

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'email' => 'required|string',
            'password' => 'required|string',
        ];
    }
}
