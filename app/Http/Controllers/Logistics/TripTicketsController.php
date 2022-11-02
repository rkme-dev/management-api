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

        $pdf = PDF::loadView('logistics/trip-ticket', [
                'order' => $ticket,
            ]
        );
        
        return $pdf->stream();
    }
}