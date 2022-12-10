<?php

declare(strict_types=1);

namespace App\Http\Requests\Role;

use App\Http\Requests\BaseRequest;

final class RoleCreateRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function getAbilityIds(): ?array
    {
        return $this->getArray('abilities');
    }

    public function getName(): string
    {
        return $this->getString('name');
    }

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'name' => 'string|required|unique:Silber\Bouncer\Database\Role,title',
            'abilities' => 'array|nullable',
        ];
    }
}
