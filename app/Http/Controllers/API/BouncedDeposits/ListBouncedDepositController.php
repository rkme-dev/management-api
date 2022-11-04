<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\BouncedDeposits;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\BouncedDeposit;
use Illuminate\Http\Resources\Json\JsonResource;

final class ListBouncedDepositController extends AbstractAPIController
{
    public function __invoke(): JsonResource
    {
        return new JsonResource(BouncedDeposit::with([
                'document',
                'account',
                'createdBy',
            ])
            ->orderBy('created_at', 'desc')
            ->get()
        );
    }
}
