<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\SalesOrders;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\SalesOrder;
use Illuminate\Http\Resources\Json\JsonResource;

final class ShowSalesOrderController extends AbstractAPIController
{
    public function __invoke(int $id): JsonResource
    {
        /** @var SalesOrder $salesOrder */
        $salesOrder = SalesOrder::with('orderItems')->where('id', $id)->first();

        if ($salesOrder === null) {
            return $this->respondNotFound('Sales order not found');
        }

        return new JsonResource($salesOrder);
    }
}
