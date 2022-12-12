<?php

namespace App\Http\Controllers\Logistics;

use App\Http\Controllers\Controller;
use App\Models\TripTicket;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TripTicketsController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, string $id)
    {
        $ticket = TripTicket::with('salesDrItems.salesDr.customer', 'document', 'orderItems')
                            ->where('id', $id)->first()?->toArray();

        $ticket['date_posted'] = Carbon::parse($ticket['date_posted'])->format('Y-m-d');
        $ticket['timestamp'] = Carbon::parse($ticket['created_at'])->format('H:i:s');

        $salesDrArr = collect([]);

        foreach ($ticket['sales_dr_items'] as $salesDr) {
            $salesDrArr[] = $salesDr['sales_dr'];
        }

        $pdf = PDF::loadView('logistics/trip-ticket', [
            'ticket' => $ticket,
            'salesDr' => $salesDrArr->unique(),
        ]
        );

        return $pdf->stream();
    }
}
