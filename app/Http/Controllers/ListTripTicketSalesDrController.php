<?php

namespace App\Http\Controllers;

use App\Models\SalesDr;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ListTripTicketSalesDrController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, int $tripTicketId): JsonResource
    {
        $area = $request->get('area');
        $items = SalesDr::with('customer')
            ->with('salesDrItems', function ($query) use ($tripTicketId) {
                if ($tripTicketId > 0) {
                    $query->where('trip_ticket_id', $tripTicketId);
                } else {
                    $query->whereNull('trip_ticket_id');
                }
            })
            ->where('area', $area)
            ->where('remaining_balance', '>', 0)
            ->where('is_linked', $tripTicketId > 0 ? 1 : 0)
            ->get();

        return new JsonResource($items);
    }
}
