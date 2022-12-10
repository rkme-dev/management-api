<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\TripTickets;

use App\Enums\TripTicketStatusesEnum;
use App\Http\Controllers\API\AbstractAPIController;
use App\Models\TripTicket;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class UpdateTripTicketStatusController extends AbstractAPIController
{
    public function __invoke(Request $request, int $id): JsonResource
    {
        try {
            $status = TripTicketStatusesEnum::from($request->get('status'));

            $tripTicket = TripTicket::where('id', $id)->first();

            $tripTicket->setAttribute('status', $status->value);
            $tripTicket->save();

            return new JsonResource($tripTicket);
        } catch (\Exception $exception) {
            $this->respondInternalError($exception->getMessage());
        }
    }
}
