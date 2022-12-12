<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\SalesDrs;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\SalesDr;
use Illuminate\Http\Resources\Json\JsonResource;

final class ListDrByCustomerController extends AbstractAPIController
{
    public function __invoke(int $id): JsonResource
    {
        return new JsonResource(SalesDr::where('customer_id', $id)->where('remaining_balance', '>', 0)->get());
    }
}
