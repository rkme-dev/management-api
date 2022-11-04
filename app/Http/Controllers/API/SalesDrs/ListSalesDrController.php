<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\SalesDrs;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\SalesDr;
use App\Models\SalesOrder;
use Illuminate\Http\Resources\Json\JsonResource;

final class ListSalesDrController extends AbstractAPIController
{
    public function __invoke(): JsonResource
    {
        $salesDr = SalesDr::with('customer', 'document', 'orderItems', 'salesDrItems')
            ->orderBy('created_at', 'desc')
            ->get();

        return new JsonResource($salesDr);
    }
}
