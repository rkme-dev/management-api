<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\SalesOrders;

use App\Enums\SaleOrderStatusesEnum;
use App\Http\Controllers\API\AbstractAPIController;
use App\Models\SalesOrder;
use Illuminate\Http\Resources\Json\JsonResource;

final class UnpostSalesOrderController extends AbstractAPIController
{
    public function __invoke(int $id): JsonResource
    {
        /** @var SalesOrder $salesOrder */
        $salesOrder = SalesOrder::with('orderItems')->where('id', $id)->first();

        $salesOrder->update([
            'status' => SaleOrderStatusesEnum::FOR_REVIEW->value,
            'updated_by' => $this->getUser()->getId(),
        ]);

        $salesOrder->refresh();

        return new JsonResource($salesOrder);
    }
}
