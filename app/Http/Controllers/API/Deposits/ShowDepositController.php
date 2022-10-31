<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Deposits;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\Deposit;
use Illuminate\Http\Resources\Json\JsonResource;

final class ShowDepositController extends AbstractAPIController
{
    public function __invoke(int $id): JsonResource
    {
        $deposit = Deposit::with([
            'checks',
            'document',
            'account',
            'createdBy',
        ])->where('id', $id)->first();

        if ($deposit === null) {
            return $this->respondNotFound('Deposit not found');
        }

        return new JsonResource($deposit);
    }
}
