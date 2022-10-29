<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Deposits;

use App\Enums\SaleOrderStatusesEnum;
use App\Http\Controllers\API\AbstractAPIController;
use App\Models\CollectionPayment;
use App\Models\CollectionPaymentTypes\CheckPayment;
use Illuminate\Http\Resources\Json\JsonResource;

final class ListCheckPaymentController extends AbstractAPIController
{
    public function __invoke(): JsonResource
    {
        $checks = CheckPayment::with(['collectionPayment', 'collection'])
            ->whereHas('collection', function ($query) {
                $query->where('status', SaleOrderStatusesEnum::POSTED);
            })
            ->whereNull('deposit_id')
            ->get();

        return new JsonResource($checks);
    }
}
