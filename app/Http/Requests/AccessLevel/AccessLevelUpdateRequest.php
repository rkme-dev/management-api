<?php

declare(strict_types=1);

namespace App\Http\Requests\AccessLevel;

use App\Http\Requests\BaseRequest;

final class AccessLevelUpdateRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function getName(): ?string
    {
        return $this->getString('name');
    }

    public function getRoleIds(): ?array
    {
        return $this->getArray('role_ids');
    }

    public function getAbilityIds(): ?array
    {
        return $this->getArray('ability_ids');
    }

    public function rules(): array
    {
        return [
            'name' => 'nullable|string',
            'role_ids' => 'array|nullable',
            'ability_ids' => 'array|nullable',
        ];
    }
}
