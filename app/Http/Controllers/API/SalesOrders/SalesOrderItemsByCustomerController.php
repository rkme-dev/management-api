<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\SalesOrders;

use App\Enums\SaleOrderStatusesEnum;
use App\Http\Controllers\API\AbstractAPIController;
use App\Models\OrderItem;
use App\Models\SalesOrder;
use Illuminate\Http\Resources\Json\JsonResource;

final class SalesOrderItemsByCustomerController extends AbstractAPIController
{
    public function __invoke(int $id): JsonResource
    {
        $orderItems = OrderItem::whereHasMorph('orderable', [SalesOrder::class], function ($query) use ($id) {
            $query->where('status', '=', SaleOrderStatusesEnum::POSTED->value);
            $query->where('customer_id', $id);
        })
            ->orderBy('id', 'desc')
            ->get();

        $result = [];

        /** @var OrderItem $orderItem */
        foreach ($orderItems as $orderItem) {
            $salesOrder = $orderItem->orderable;

            $result[] = [
                'has_dr' => $salesOrder->getAttribute('has_dr'),
                'order_item_id' => $orderItem->getAttribute('id'),
                'sales_order_id' => $salesOrder->getAttribute('id'),
                'date_posted' => $salesOrder->getAttribute('date_posted'),
                'sales_order_number' => $salesOrder->getAttribute('sales_order_number'),
                'product_name' => $orderItem->product->getAttribute('name'),
                'quantity' => $orderItem->getAttribute('quantity'),
                'unit' => $orderItem->getAttribute('unit'),
                'price' => $orderItem->getAttribute('price'),
                'total_amount' => $orderItem->getAttribute('total_amount'),
            ];
        }

        return new JsonResource($result);
    }
}
