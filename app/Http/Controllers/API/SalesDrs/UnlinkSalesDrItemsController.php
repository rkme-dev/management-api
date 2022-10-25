<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\SalesDrs;

use App\Enums\SaleOrderStatusesEnum;
use App\Http\Controllers\API\AbstractAPIController;
use App\Models\OrderItem;
use App\Models\SalesDr;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class UnlinkSalesDrItemsController extends AbstractAPIController
{
    public function __invoke(Request $request): JsonResource
    {
        $area = $request->get('area');

        $tripTicketId = $request->get('trip_ticket_id') ?? null;

        $tripTicketId = is_numeric($tripTicketId) ? $tripTicketId : null;

        $items = OrderItem::with(['salesDrItem.salesDr.customer', 'product',])
            ->whereHas('salesDrItem', function ($query) use ($area, $tripTicketId) {

                $query->whereHas('salesDr', function ($query) use ($area) {
                   $query->where('area', $area);
                });

                if ($tripTicketId !== null) {
                    $query->orWhere('trip_ticket_id', $tripTicketId);
                } else {
                    $query->whereNull('trip_ticket_id');
                }
            })
            ->whereHasMorph('orderable', [SalesDr::class], function($query) {
                $query->where('status', SaleOrderStatusesEnum::POSTED);
            })
            ->where('orderable_type', 'App\Models\SalesDr')
            ->get();

        return new JsonResource($items);
    }
}
