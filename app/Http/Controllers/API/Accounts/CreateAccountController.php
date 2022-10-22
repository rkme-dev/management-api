<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Accounts;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\Accounts\CreateAccountRequest;
use App\Models\Account;
use Illuminate\Http\Resources\Json\JsonResource;

final class CreateAccountController extends AbstractAPIController
{
    public function __invoke(CreateAccountRequest $request): JsonResource
    {
        $data = $request->all([
            'is_active',
            'account_code',
            'account_title',
            'type',
            'normal',
        ]);

        $data['created_by'] = $this->getUser()->getId();

        return new JsonResource(Account::create($data));
    }
}
