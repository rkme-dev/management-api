<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\BouncedDeposits;

use App\Enums\CheckStatusEnums;
use App\Enums\SaleOrderStatusesEnum;
use App\Http\Controllers\API\AbstractAPIController;
use App\Models\BouncedDeposit;
use App\Models\CollectionPaymentTypes\CheckPayment;
use App\Models\Deposit;
use Illuminate\Http\Resources\Json\JsonResource;

final class PostBouncedDepositController extends AbstractAPIController
{
    public function __invoke(int $id): JsonResource {
        $bouncedDeposit = BouncedDeposit::with(['account','document','checks'])->where('id', $id)->first();

        if ($bouncedDeposit === null) {
            return $this->respondNotFound('Bounced Deposit not found');
        }

        $bouncedDeposit->setAttribute('status', SaleOrderStatusesEnum::POSTED->value);
        $bouncedDeposit->save();

        // @TODO put in a service and run each check in a job
        /** @var CheckPayment $check */
        foreach ($bouncedDeposit->checks as $check) {
            $check->setAttribute('status', CheckStatusEnums::BOUNCED->value);
            $check->save();
        }

        return new JsonResource($bouncedDeposit);
    }
}
