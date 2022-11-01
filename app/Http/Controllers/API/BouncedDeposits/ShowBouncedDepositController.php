<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\BouncedDeposits;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\BouncedDeposit;
use Illuminate\Http\Resources\Json\JsonResource;

final class ShowBouncedDepositController extends AbstractAPIController
{
    public function __invoke(int $id): JsonResource
    {
        $bouncedDeposit = BouncedDeposit::with([
            'checks',
            'document',
            'account',
            'createdBy',
        ])->where('id', $id)->first();

        if ($bouncedDeposit === null) {
            return $this->respondNotFound('Bounced Deposit not found');
        }

        return new JsonResource($bouncedDeposit);
    }
}
