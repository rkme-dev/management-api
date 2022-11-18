<?php

namespace App\Http\Controllers\Logistics;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\TripTicket;
use Carbon\Carbon;

class TripTicketsController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, string $id)
    {   
        $ticket = TripTicket::with('salesDrItems.drOrderItem.product','salesDrItems.salesDr.customer','document', 'orderItems')
                            ->where('id', $id)->first()?->toArray();

        $ticket['date_posted'] = Carbon::parse($ticket['date_posted'])->format('Y-m-d');
        $ticket['timestamp'] = Carbon::parse($ticket['created_at'])->format('H:i:s');

        $pdf = PDF::loadView('logistics/trip-ticket', [
                'order' => $ticket,
            ]
        );
        
        return $pdf->stream();
    }
}