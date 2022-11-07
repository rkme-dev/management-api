<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\SalesOrders;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\SalesOrder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

final class ListSalesOrderController extends AbstractAPIController
{
    public function __invoke(): JsonResource
    {
        $salesOrder = SalesOrder::with('customer', 'document', 'orderItems')
            ->orderBy('created_at', 'desc')
            ->get();

        return new JsonResource($salesOrder);
    }
}
