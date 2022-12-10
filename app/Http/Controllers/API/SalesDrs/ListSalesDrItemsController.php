<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\SalesDrs;

use App\Enums\SaleOrderStatusesEnum;
use App\Http\Controllers\API\AbstractAPIController;
use App\Models\OrderItem;
use App\Models\SalesDr;
use Illuminate\Http\Resources\Json\JsonResource;

final class ListSalesDrItemsController extends AbstractAPIController
{
    public function __invoke(int $id): JsonResource
    {
        $orderItems = OrderItem::whereHasMorph('orderable', [SalesDr::class], function ($query) use ($id) {
            $query->where('status', '=', SaleOrderStatusesEnum::POSTED->value);
            $query->where('customer_id', $id);
        })
            ->orderBy('created_at', 'desc')
            ->get();

        $result = [];

        /** @var OrderItem $orderItem */
        foreach ($orderItems as $orderItem) {
            $salesOrder = $orderItem->orderable;

            $result[] = [
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
