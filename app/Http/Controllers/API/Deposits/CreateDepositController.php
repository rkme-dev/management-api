<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Deposits;

use App\Enums\SaleOrderStatusesEnum;
use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\Deposits\CreateDepositRequest;
use App\Models\Deposit;
use Illuminate\Http\Resources\Json\JsonResource;

final class CreateDepositController extends AbstractAPIController
{
    public function __invoke(CreateDepositRequest $request)
    {
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
                'status' => SaleOrderStatusesEnum::FOR_REVIEW->value,
                'created_by' => $this->getUser()->getId(),
            ],
        ]);

        return new JsonResource($deposit);
    }
}
