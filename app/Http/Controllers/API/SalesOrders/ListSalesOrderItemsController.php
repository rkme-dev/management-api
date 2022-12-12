<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\SalesOrders;

use App\Enums\SaleOrderStatusesEnum;
use App\Http\Controllers\API\AbstractAPIController;
use App\Models\OrderItem;
use App\Models\SalesOrder;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

final class ListSalesOrderItemsController extends AbstractAPIController
{
    public function __invoke(): JsonResource
    {
        $orderItems = OrderItem::whereHasMorph('orderable', [SalesOrder::class], function ($query) {
            $query->where('status', '=', SaleOrderStatusesEnum::POSTED->value);
        })
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('sales_dr_items')
                    ->whereRaw('sales_dr_items.sales_order_item_id = order_items.id');
            })
            ->with(['orderable.customer'])
            ->orderBy('created_at', 'desc')
            ->get();

        $result = [];

        /** @var OrderItem $orderItem */
        foreach ($orderItems as $orderItem) {
            $salesOrder = $orderItem->orderable;

            $result[] = [
                'area' => $salesOrder->getAttribute('area'),
                'customer' => $salesOrder->customer,
                'salesman_id_1' => $salesOrder->getAttribute('salesman_id_1'),
                'salesman_id_2' => $salesOrder->getAttribute('salesman_id_2'),
                'address' => $salesOrder->getAttribute('address'),
                'remarks' => $salesOrder->getAttribute('remarks'),
                'vat_id' => $salesOrder->getAttribute('vat_id'),
                'promo_code' => $salesOrder->getAttribute('promo_code'),
                'term_id' => $salesOrder->getAttribute('term_id'),
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
