<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\BouncedDeposits;

use App\Enums\SaleOrderStatusesEnum;
use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\BouncedDeposits\CreateBouncedDepositRequest;
use App\Models\BouncedDeposit;
use App\Models\CollectionPaymentTypes\CheckPayment;
use App\Models\Deposit;
use Illuminate\Http\Resources\Json\JsonResource;

final class CreateBouncedDepositController extends AbstractAPIController
{
    public function __invoke(CreateBouncedDepositRequest $request)
    {
        /** @var BouncedDeposit $bouncedDeposit */
        $bouncedDeposit = BouncedDeposit::create([
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
                'bounced_number' => $this->generateNumber('bounced_deposits', 'BC'),
                'status' => SaleOrderStatusesEnum::FOR_REVIEW->value,
                'created_by' => $this->getUser()->getId(),
            ],
        ]);

        $checks = CheckPayment::whereIn('id', $request->get('check_ids'))->get();

        // @TODO each check update should be trigger thru an event or job
        /** @var CheckPayment $check */
        foreach ($checks as $check) {
            $check->bouncedDeposit()->associate($bouncedDeposit);
            $check->setAttribute('status', 'for_review');
            $check->save();
        }

        return new JsonResource($bouncedDeposit);
    }
}
