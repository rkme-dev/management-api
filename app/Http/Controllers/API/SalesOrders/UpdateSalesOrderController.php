<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\SalesOrders;

use App\Enums\SaleOrderStatusesEnum;
use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\SalesOrders\UpdateSalesOrderRequest;
use App\Models\OrderItem;
use App\Models\SalesOrder;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

final class UpdateSalesOrderController extends AbstractAPIController
{
    public function __invoke(UpdateSalesOrderRequest $request, int $id): JsonResource
    {
        /** @var SalesOrder $salesOrder */
        $salesOrder = SalesOrder::with('orderItems')->where('id', $id)->first();

        $data = [
            ...$request->all([
                'area',
                'address',
                'date_posted',
                'sales_order_number',
                'remarks',
                'customer_id',
                'document_id',
                'salesman_id_1',
                'salesman_id_2',
                'term_id',
                'vat_id',
                'qr_code',
                'promo_code',
                'amount',
            ]),
            ...[
                'updated_by' => $this->getUser()->getId(),
            ],
        ];

        $salesOrder->update($data);

        $this->setOrderItems($salesOrder, $request->get('order_items'));

        return new JsonResource($salesOrder);
    }

    private function setOrderItems(SalesOrder $order, array $items): void
    {
        $ids = array_column($items, 'id');

        // Delete order items that is not in the payload
        OrderItem::where('orderable_type', 'App\Models\SalesOrder')
            ->whereNotIn('id', $ids)
            ->where('orderable_id', $order->getAttribute('id'))
            ->delete();

        $existingOrderItems = OrderItem::whereIn('id', $ids)->get();

        foreach ($items as $item) {
            if (Arr::get($item, 'id') === null) {
                $orderItem = new OrderItem();
                $orderItem->setAttribute('orderable_type', $order::class);
                $orderItem->setAttribute('orderable_id', $order->getAttribute('id'));
                $orderItem->setAttribute('product_id', Arr::get($item, 'product_id'));
                $orderItem->setAttribute('quantity', Arr::get($item, 'quantity'));
                $orderItem->setAttribute('unit', Arr::get($item, 'unit'));
                $orderItem->setAttribute('actual_quantity', Arr::get($item, 'quantity'));
                $orderItem->setAttribute('total_amount', Arr::get($item, 'total_amount'));
                $orderItem->setAttribute('price', Arr::get($item, 'price'));
                $orderItem->save();

                continue;
            }

            $existingOrderItem = $existingOrderItems->where('id', Arr::get($item, 'id'))->first();

            if ($existingOrderItem === null) {
                continue;
            }

            $existingOrderItem->update($item);
        }

        $order->refresh();
    }
}
