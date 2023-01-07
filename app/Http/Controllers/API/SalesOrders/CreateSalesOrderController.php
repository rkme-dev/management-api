<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\SalesOrders;

use App\Enums\SaleOrderStatusesEnum;
use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\SalesOrders\CreateSalesOrderRequest;
use App\Models\OrderItem;
use App\Models\SalesOrder;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

final class CreateSalesOrderController extends AbstractAPIController
{
    public function __invoke(CreateSalesOrderRequest $request): JsonResource
    {
        $salesOrder = SalesOrder::create([
            ...$request->all([
                'area',
                'address',
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
                'date_posted' => $this->generateDateTime($request->get('date_posted')),
                'sales_order_number' => $this->generateNumber(
                    'sales_orders',
                    'SO',
                    'sales_order_number',
                ),
                'status' => SaleOrderStatusesEnum::FOR_REVIEW->value,
                'created_by' => $this->getUser()->getId(),
            ],
        ]);

        $this->setOrderItems($salesOrder, $request->get('order_items'));

        return new JsonResource($salesOrder);
    }

    private function setOrderItems(SalesOrder $order, array $items): void
    {
        foreach ($items as $item) {
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
        }
    }
}
