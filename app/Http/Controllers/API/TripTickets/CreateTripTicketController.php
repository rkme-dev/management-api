<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\TripTickets;

use App\Enums\TripTicketStatusesEnum;
use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\TripTickets\CreateTripTicketRequest;
use App\Models\OrderItem;
use App\Models\SalesDrItem;
use App\Models\TripTicket;
use Illuminate\Http\Resources\Json\JsonResource;

final class CreateTripTicketController extends AbstractAPIController
{
    public function __invoke(CreateTripTicketRequest $request): JsonResource
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
        ]);

        $data = [
            ...$data,
            ...[
                'trip_ticket_number' => $this->generateNumber('trip_tickets', 'TR'),
                'status' => TripTicketStatusesEnum::FOR_TRANSIT->value,
                'created_by' => $this->getUser()->getId(),
            ],
        ];

        $tripTicket = TripTicket::create($data);

        $this->saveDrItems($tripTicket, $request->get('dr_items'));

        $tripTicket->salesDrItems;

        return new JsonResource($tripTicket);
    }

    private function saveDrItems(TripTicket $tripTicket, array $orderItemIds): void
    {
        $orderItems = OrderItem::whereIn('id', $orderItemIds)->get();

        /** @var OrderItem $orderItem */
        foreach ($orderItems as $orderItem) {
            /** @var SalesDrItem $salesDrItem */
            $salesDrItem = $orderItem->salesDrItem;

            $salesDrItem->setAttribute('trip_ticket_id', $tripTicket->getAttribute('id'));

            $salesDrItem->setAttribute('is_linked', 1);

            $salesDrItem->salesDr->setAttribute('is_linked', 1)->save();

            $salesDrItem->save();
        }
    }
}
