<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\TripTickets;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\TripTicket;
use Illuminate\Http\Resources\Json\JsonResource;

final class ListTripTicketsController extends AbstractAPIController
{
    public function __invoke(): JsonResource
    {
        $tickets = TripTicket::with('salesDrItems.salesDr','document', 'orderItems')
            ->orderBy('created_at', 'desc')
            ->get();

        return new JsonResource($tickets);
    }
}
