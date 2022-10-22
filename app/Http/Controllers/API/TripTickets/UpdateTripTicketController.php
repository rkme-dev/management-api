<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\TripTickets;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\TripTickets\UpdateTripTicketRequest;
use App\Models\OrderItem;
use App\Models\SalesDr;
use App\Models\SalesDrItem;
use App\Models\SalesDrPayment;
use App\Models\TripTicket;
use Illuminate\Http\Resources\Json\JsonResource;

final class UpdateTripTicketController extends AbstractAPIController
{
    public function __invoke(UpdateTripTicketRequest $request, int $id): JsonResource
    {
        $tripTicket = TripTicket::where('id', $id)->first();

        $data = $request->only([
            'trip_ticket_number',
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
                'updated_by' => $this->getUser()->getId(),
            ],
        ];

        $tripTicket->update($data);

        $this->createOrUpdateSalesDrItems($tripTicket, $request->get('dr_items'));

        $tripTicket->refresh();

        return new JsonResource($tripTicket);
    }

    private function createOrUpdateSalesDrItems(TripTicket $tripTicket, array $ids): void
    {
        // @TODO each iteration can be transferred to a job.
        // @TODO database query should not be inside a loop.
        foreach ($tripTicket->salesDrItems as $salesDrItem) {
            $salesDrItemId = $salesDrItem->getAttribute('sales_dr_item_id');
            // Remove relationship to trip tickets and change status not linked if it has no collections as well
            if (in_array($salesDrItemId, $ids) === false) {
                $salesDrItem->setAttribute('trip_ticket_id', null);
                $salesDrItem->setAttribute('is_linked', 0);
                $salesDrItem->save();

                /** @var SalesDr $salesDr */
                $salesDr = $salesDrItem->salesDr;

                $collectionCountByDr = SalesDrPayment::where('sales_dr_id', $salesDr->getAttribute('id'))
                    ->count();

                $salesDrItemCountByDr = SalesDrItem::where('sales_dr_id', $salesDr->getAttribute('id'))
                    ->whereNotNull('trip_ticket_id')
                    ->count();

                if ($collectionCountByDr > 0 || $salesDrItemCountByDr > 0) {
                    $salesDrItem->save();
                    continue;
                }

                $salesDr->setAttribute('is_linked', 0);
                $salesDr->save();
                continue;
            }

            unset($ids[$salesDrItemId]);
        }

        $orderItems = OrderItem::whereIn('id', $ids)->get();

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
