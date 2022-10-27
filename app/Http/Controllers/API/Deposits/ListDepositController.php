<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Deposits;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\Deposit;
use Illuminate\Http\Resources\Json\JsonResource;

final class ListDepositController extends AbstractAPIController
{
    public function __invoke(): JsonResource
    {
        return new JsonResource(Deposit::with([
                'orderItems',
                'document',
                'account',
                'createdBy',
            ])->get()
        );
    }
}
