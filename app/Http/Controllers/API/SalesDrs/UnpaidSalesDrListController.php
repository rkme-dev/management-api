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
        $unpaidSalesDRs = SalesDr::where('status', '=', SaleOrderStatusesEnum::POSTED->value)
            ->where('remaining_balance', '>', 0)
            ->with('customer')
            ->orderBy('id', 'desc')
            ->get();

        $orderItems = OrderItem::whereHasMorph('orderable', [SalesDr::class], function ($query) {
            $query->where('status', '=', SaleOrderStatusesEnum::POSTED->value);
            $query->where('remaining_balance', '>', 0);
        })
            ->with(['orderable', 'product',])
            ->orderBy('created_at', 'desc')
            ->get();

        $result = [];

        /** @var SalesDr $salesDr */
        foreach ($unpaidSalesDRs as $salesDr) {
            $result[] = [
                'sales_dr_id' => $salesDr->getAttribute('id'),
                'date_posted' => $salesDr->getAttribute('date_posted'),
                'sales_dr_number' => $salesDr->getAttribute('sales_dr_number'),
                'customer' => $salesDr->customer,
                'total_amount' => $salesDr->getAttribute('amount'),
                'remaining_balance' => $salesDr->getAttribute('remaining_balance'),
            ];
        }

        return new JsonResource($result);
    }
}
