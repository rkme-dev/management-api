<?php

declare(strict_types=1);

namespace App\Http\Requests\Ability;

use App\Http\Requests\BaseRequest;

final class AbilityCreateRequest extends BaseRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function getAction(): string
    {
        return $this->getString('action');
    }

    public function getModule(): string
    {
        return $this->getString('module');
    }

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'action' => 'required|string',
            'module' => 'required|string',
        ];
    }
}
