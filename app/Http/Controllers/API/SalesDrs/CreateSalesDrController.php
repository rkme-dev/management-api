<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\SalesDrs;

use App\Enums\SaleOrderStatusesEnum;
use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\SalesDrs\CreateSalesDrRequest;
use App\Models\OrderItem;
use App\Models\SalesDr;
use App\Models\SalesDrItem;
use App\Models\SalesOrder;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

final class CreateSalesDrController extends AbstractAPIController
{
    public function __invoke(CreateSalesDrRequest $request): JsonResource
    {
        $salesDr = SalesDr::create([
            ...$request->all([
                'sales_invoice_number',
                'area',
                'address',
                'remarks',
                'customer_id',
                'document_id',
                'salesman_id_1',
                'salesman_id_2',
                'term_id',
                'vat_id',
                'promo_code',
                'amount',
            ]),
            ...[
                'date_posted' => $this->generateDateTime($request->get('date_posted')),
                'sales_dr_number' => $this->generateNumber('sales_drs', 'DR'),
                'remaining_balance' => $request->get('amount'),
                'status' => SaleOrderStatusesEnum::FOR_REVIEW->value,
                'created_by' => $this->getUser()->getId(),
            ],
        ]);

        $salesDr->qr_code = \sprintf('/collections/dr/%s', $salesDr->id);

        $salesDr->save();

        $this->setOrderItems($salesDr, $request->get('order_item_ids'));

        return new JsonResource($salesDr);
    }

    private function setOrderItems(SalesDr $order, ?array $orderItemIds): void
    {
        $orderItems = OrderItem::whereIn('id', $orderItemIds)
            ->where('orderable_type', 'App\Models\SalesOrder')
            ->with('orderable')
            ->get();


        $salesOrderIds = array_column($orderItems->toArray(), 'orderable_id');

        SalesOrder::whereIn('id', $salesOrderIds)->update([
            'has_dr' => 1,
        ]);

        // Basically convert SO items to DR Items
        foreach ($orderItems as $orderItem) {
            $orderDrItem = new OrderItem();
            $orderDrItem->setAttribute('orderable_type', $order::class);
            $orderDrItem->setAttribute('orderable_id', $order->getAttribute('id'));
            $orderDrItem->setAttribute('product_id', $orderItem->getAttribute('product_id'));
            $orderDrItem->setAttribute('quantity', $orderItem->getAttribute('quantity'));
            $orderDrItem->setAttribute('unit', $orderItem->getAttribute('unit'));
            $orderDrItem->setAttribute('actual_quantity', $orderItem->getAttribute('actual_quantity'));
            $orderDrItem->setAttribute('total_amount', $orderItem->getAttribute('total_amount'));
            $orderDrItem->setAttribute('price',  $orderItem->getAttribute('price'));
            $orderDrItem->save();

            SalesDrItem::create([
                'sales_dr_id' => $order->getAttribute('id'),
                'sales_order_item_id' => $orderItem->getAttribute('id'),
                'sales_dr_item_id' => $orderDrItem->getAttribute('id'),
            ]);
        }
    }
}
