<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\TripTickets;

use App\Enums\TripTicketStatusesEnum;
use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\TripTickets\CreateTripTicketRequest;
use App\Models\SalesDr;
use App\Models\TripTicket;
use Illuminate\Http\Resources\Json\JsonResource;

final class CreateTripTicketController extends AbstractAPIController
{
    public function __invoke(CreateTripTicketRequest $request)
    {
        $data = $request->only([
            'date_posted',
            'area',
            'driver',
            'assistant',
            'truck',
            'plate_number',
            'document_id',
            'remarks',
            'departed_date',
            'departed_time',
        ]);

        $data = [
            ...$data,
            ...[
                'trip_ticket_number' => $this->generateNumber('trip_tickets', 'TR'),
                'status' => TripTicketStatusesEnum::FOR_TRANSIT->value,
                'created_by' => $this->getUser()->getId(),
                'departed_at' => $data['departed_date'].' '.$data['departed_time'],
            ],
        ];

        $tripTicket = TripTicket::create($data);
        $this->saveDrItems($tripTicket, $request->get('dr_items'));

        $tripTicket->salesDrItems;

        return new JsonResource($tripTicket);
    }

    private function saveDrItems(TripTicket $tripTicket, array $orderItemIds)
    {
        $salesDRs = SalesDr::whereIn('id', $orderItemIds)->get();

        foreach ($salesDRs as $salesDr) {
            $salesDrItem = $salesDr->salesDrItems()->update([
                'trip_ticket_id' => $tripTicket->getAttribute('id'),
                'is_linked' => 1,
            ]);
        }
        SalesDr::whereIn('id', $orderItemIds)->update([
            'is_linked' => 1,
        ]);
    }
}
