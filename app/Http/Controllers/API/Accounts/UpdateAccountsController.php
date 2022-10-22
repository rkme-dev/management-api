<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Accounts;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\Accounts\UpdateAccountRequest;
use App\Models\Account;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Response;

final class UpdateAccountsController extends AbstractAPIController
{
    public function __invoke(UpdateAccountRequest $request, int $id)
    {
        $data = $request->all([
            'is_active',
            'account_code',
            'account_title',
            'type',
            'normal',
        ]);

        $account = Account::find($id);

        if ($request->get('account_code') !== $account->account_code) {

            $exist = Account::where('account_code', $request->get('account_code'))->first();

            if ($exist !== null) {
                return Response::json(array(
                    'account_code' => 'Account code already exist.',
                ), 422);
            }
        }

        $data['updated_by'] = $this->getUser()->getId();

        $account->update($data);

        $account->refresh();

        return new JsonResource($account);
    }
}
