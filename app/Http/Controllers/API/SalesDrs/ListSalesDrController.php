<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\SalesDrs;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\SalesDr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class ListSalesDrController extends AbstractAPIController
{
    public function __invoke(Request $request): JsonResource
    {
        $todayOnly = $request->get('today_only') ?? false;

        $todayOnly = filter_var($todayOnly, FILTER_VALIDATE_BOOLEAN);

        $dateToday = new Carbon();

        $salesDr = SalesDr::with('customer', 'document', 'orderItems', 'salesDrItems')
            ->where(function($query) use ($todayOnly, $dateToday) {
                if ($todayOnly === true) {
                    $query->whereDate('date_posted', $dateToday);
                }
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return new JsonResource($salesDr);
    }
}
