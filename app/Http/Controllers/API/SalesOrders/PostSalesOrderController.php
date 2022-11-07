<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\SalesOrders;

use App\Enums\SaleOrderStatusesEnum;
use App\Http\Controllers\API\AbstractAPIController;
use App\Models\OrderItem;
use App\Models\SalesOrder;
use Illuminate\Http\Resources\Json\JsonResource;

final class PostSalesOrderController extends AbstractAPIController
{
    public function __invoke(int $id): JsonResource
    {
        /** @var SalesOrder $salesOrder */
        $salesOrder = SalesOrder::with('orderItems')->where('id', $id)->first();

        $salesOrder->update([
            'status' => SaleOrderStatusesEnum::POSTED->value,
            'updated_by' => $this->getUser()->getId(),
        ]);

        $salesOrder->refresh();

        /** @var OrderItem $orderItem */
        foreach ($salesOrder->orderItems as $orderItem) {
            $unit = $orderItem->product->units->where('name', $orderItem->getAttribute('unit'))->first();;

            $remaining = (float) $unit->pivot->getAttribute('reserved_balance') - (float) $orderItem->getAttribute('actual_quantity');

            $unit->pivot->setAttribute('reserved_balance', $remaining);

            $unit->pivot->save();

            $unit->pivot->refresh();
        }

        return new JsonResource($salesOrder);
    }
}
