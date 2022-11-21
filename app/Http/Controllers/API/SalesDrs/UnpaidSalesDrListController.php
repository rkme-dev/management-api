<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\SalesDrs;

use App\Enums\SaleOrderStatusesEnum;
use App\Http\Controllers\API\AbstractAPIController;
use App\Models\OrderItem;
use App\Models\SalesDr;
use Illuminate\Http\Resources\Json\JsonResource;

final class UnpaidSalesDrListController extends AbstractAPIController
{
    public function __invoke(): JsonResource
    {
        $orderItems = OrderItem::whereHasMorph('orderable', [SalesDr::class], function ($query) {
            $query->where('status', '=', SaleOrderStatusesEnum::POSTED->value);
            $query->where('remaining_balance', '>', 0);
        })
            ->with(['orderable', 'product',])
            ->orderBy('created_at', 'desc')
            ->get();

        $result = [];

        /** @var OrderItem $orderItem */
        foreach ($orderItems as $orderItem) {
            /** @var SalesDr $salesDr */
            $salesDr = $orderItem->orderable;

            $result[] = [
                'order_item_id' => $orderItem->getAttribute('id'),
                'sales_dr_id' => $salesDr->getAttribute('id'),
                'date_posted' => $salesDr->getAttribute('date_posted'),
                'sales_dr_number' => $salesDr->getAttribute('sales_dr_number'),
                'product_name' => $orderItem->product->getAttribute('name'),
                'quantity' => $orderItem->getAttribute('quantity'),
                'unit' => $orderItem->getAttribute('unit'),
                'price' => $orderItem->getAttribute('price'),
                'customer' => $salesDr->customer,
                'total_amount' => $orderItem->getAttribute('total_amount'),
            ];
        }

        return new JsonResource($result);
    }
}
