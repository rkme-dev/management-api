<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Deposits;

use App\Enums\CheckStatusEnums;
use App\Enums\SaleOrderStatusesEnum;
use App\Http\Controllers\API\AbstractAPIController;
use App\Models\CollectionPaymentTypes\CheckPayment;
use App\Models\Deposit;
use Illuminate\Http\Resources\Json\JsonResource;

final class PostDepositController extends AbstractAPIController
{
    public function __invoke(int $id): JsonResource
    {
        $deposit = Deposit::with(['account', 'document', 'checks'])->where('id', $id)->first();

        if ($deposit === null) {
            return $this->respondNotFound('Deposit not found');
        }

        $deposit->setAttribute('status', SaleOrderStatusesEnum::POSTED->value);
        $deposit->save();

        // @TODO put in a service and run each check in a job
        /** @var CheckPayment $check */
        foreach ($deposit->checks as $check) {
            $check->setAttribute('status', CheckStatusEnums::DEPOSITED->value);
            $check->save();
        }

        return new JsonResource($deposit);
    }
}
