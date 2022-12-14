<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Deposits;

use App\Enums\SaleOrderStatusesEnum;
use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\Deposits\CreateDepositRequest;
use App\Models\CollectionPaymentTypes\CheckPayment;
use App\Models\Deposit;
use Illuminate\Http\Resources\Json\JsonResource;

final class CreateDepositController extends AbstractAPIController
{
    public function __invoke(CreateDepositRequest $request)
    {
        /** @var Deposit $deposit */
        $deposit = Deposit::create([
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
                'deposit_number' => $this->generateNumber(
                    'deposits',
                    'DP',
                    'deposit_number',
                ),
                'status' => SaleOrderStatusesEnum::FOR_REVIEW->value,
                'created_by' => $this->getUser()->getId(),
            ],
        ]);

        $checks = CheckPayment::whereIn('id', $request->get('check_ids'))->get();

        // @TODO each check update should be trigger thru an event or job
        /** @var CheckPayment $check */
        foreach ($checks as $check) {
            $check->collectionPayment->collection->setAttribute('has_deposit', true);
            $check->collectionPayment->collection->save();
            $check->deposit()->associate($deposit);
            $check->setAttribute('status', 'for_review');
            $check->save();
        }

        return new JsonResource($deposit);
    }
}
