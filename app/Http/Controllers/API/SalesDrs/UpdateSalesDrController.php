<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\SalesDrs;

use App\Enums\SaleOrderStatusesEnum;
use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\SalesDrs\UpdateSalesDrRequest;
use App\Http\Requests\SalesOrders\UpdateSalesOrderRequest;
use App\Models\OrderItem;
use App\Models\SalesDr;
use App\Models\SalesDrItem;
use App\Models\SalesOrder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

final class UpdateSalesDrController extends AbstractAPIController
{
    public function __invoke(UpdateSalesDrRequest $request, int $id): JsonResource
    {
        /** @var SalesDr $salesDr */
        $salesDr = SalesDr::with('orderItems')->where('id', $id)->first();

        $data = [
            ...$request->all([
                'sales_invoice_number',
                'address',
                'area',
                'date_posted',
                'sales_dr_number',
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
                'remaining_balance' => $request->get('amount'),
                'updated_by' => $this->getUser()->getId(),
            ],
        ];

        $salesDr->update($data);

        $orderItems = $this->resolveOrderItems($salesDr, $request->get('order_item_ids'));

        $this->processSalesOrderItems($salesDr, $orderItems);


        return new JsonResource($salesDr);
    }

    /**
     * Update and remove order_item_ids that does not exist anymore in the request.
     * Remove  ids the order item ids that already exist.
     * Return sales order item that needs to be created for DR.
     *
     * @TODO refactor for Single Responsibility and much readable service
     *
     * @return Collection
     */
    private function resolveOrderItems(SalesDr $order, array $orderItemIds): Collection
    {
        $salesDrItems = SalesDrItem::where('sales_dr_id', $order->getAttribute('id'))->get();

        $orderItemsIdsToDelete = [];

        foreach ($salesDrItems as $salesDrItem) {
            $orderItemId = $salesDrItem->getAttribute('sales_dr_item_id');

            if (in_array($orderItemId, $orderItemIds) === true) {
                // If Already exist remove in this array, this array will be used to create new records
                unset($orderItemIds[$orderItemId]);

                continue;
            }

            $orderItemsIdsToDelete[] = $orderItemId;

            $salesDrItem->delete();
        }

        // Delete sales dr order items
        OrderItem::whereIn('id', $orderItemsIdsToDelete)->delete();

        $orderItems = OrderItem::whereIn('id', $orderItemIds)
            ->where('orderable_type', 'App\Models\SalesOrder')
            ->with('orderable')
            ->get();

        $salesOrderIds = array_column($orderItems->toArray(), 'orderable_id');

        SalesOrder::whereIn('id', $salesOrderIds)->update([
            'has_dr' => 1,
        ]);

        return $orderItems;
    }

    private function processSalesOrderItems(SalesDr $order, Collection $orderItems): void
    {
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
