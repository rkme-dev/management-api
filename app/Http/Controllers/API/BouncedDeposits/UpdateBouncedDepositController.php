<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\BouncedDeposits;

use App\Enums\CheckStatusEnums;
use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\BouncedDeposits\UpdateBouncedDepositRequest;
use App\Http\Requests\Deposits\UpdateDepositRequest;
use App\Models\BouncedDeposit;
use App\Models\CollectionPaymentTypes\CheckPayment;
use Illuminate\Http\Resources\Json\JsonResource;

final class UpdateBouncedDepositController extends AbstractAPIController
{
    public function __invoke(UpdateBouncedDepositRequest $request, int $id): JsonResource
    {
        $bouncedDeposit = BouncedDeposit::where('id', $id)
            ->with('checks')
            ->first();

        $data = [
            ...$request->all([
                'bounced_number',
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

        $bouncedDeposit->update($data);

        // If the check payment has been removed in update, untagged the check payment
        CheckPayment::where('bounced_deposit_id', $bouncedDeposit->getAttribute('id'))
            ->whereNotIn('id', $request->get('check_ids'))
            ->update([
                'bounced_deposit_id' => null,
                'status' => CheckStatusEnums::UNCOLLECTED->value,
            ]);

        $checks = CheckPayment::whereIn('id', $request->get('check_ids'))->get();

        // @TODO each check update should be trigger thru an event or job
        /** @var CheckPayment $check */
        foreach ($checks as $check) {
            $check->bouncedDeposit()->associate($bouncedDeposit);
            $check->setAttribute('status', CheckStatusEnums::FOR_REVIEW);
            $check->save();
        }

        return new JsonResource($bouncedDeposit);
    }
}
