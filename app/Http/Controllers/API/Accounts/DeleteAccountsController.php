<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Accounts;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\Account;

final class DeleteAccountsController extends AbstractAPIController
{
    public function __invoke(int $id)
    {
        $account = Account::find($id);

        $account->update([
            'is_active' => 0,
        ]);

        return $this->respondNoContent();
    }
}
