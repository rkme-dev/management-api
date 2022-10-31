<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Deposits;

use App\Enums\CheckStatusEnums;
use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\Deposits\UpdateDepositRequest;
use App\Models\CollectionPaymentTypes\CheckPayment;
use App\Models\Deposit;
use Illuminate\Http\Resources\Json\JsonResource;

final class UpdateDepositController extends AbstractAPIController
{
    public function __invoke(UpdateDepositRequest $request, int $id): JsonResource
    {
        $deposit = Deposit::where('id', $id)
            ->with('checks')
            ->first();

        $data = [
            ...$request->all([
                'deposit_number',
                'status',
                'amount',
                'date_posted',
                'clearing_date',
                'remarks',
                'document_id',
                'account_id',
            ]),
            ...[
                'updated_by' => $this->getUser()->getId(),
            ],
        ];

        $deposit->update($data);

        // If the check payment has been removed in update, untagged the check payment
        CheckPayment::where('deposit_id', $deposit->getAttribute('id'))
            ->whereNotIn('id', $request->get('check_ids'))
            ->update([
                'deposit_id' => null,
                'status' => CheckStatusEnums::UNCOLLECTED->value,
            ]);

        $checks = CheckPayment::whereIn('id', $request->get('check_ids'))->get();

        // @TODO each check update should be trigger thru an event or job
        /** @var CheckPayment $check */
        foreach ($checks as $check) {
            $check->deposit()->associate($deposit);
            $check->setAttribute('status', CheckStatusEnums::FOR_REVIEW);
            $check->save();
        }

        return new JsonResource($deposit);
    }
}
