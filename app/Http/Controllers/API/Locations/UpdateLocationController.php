<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Locations;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\Locations\UpdateLocationRequest;
use App\Models\Location;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Response;

final class UpdateLocationController extends AbstractAPIController
{
    public function __invoke(UpdateLocationRequest $request, int $id)
    {
        $location = Location::find($id);

        if ($request->get('location_code') !== $location->location_code) {
            $exist = Location::where('location_code', $request->get('location_code'))->first();

            if ($exist !== null) {
                return Response::json([
                    'location_code' => 'Location code already exist.',
                ], 422);
            }
        }

        $data = \array_merge($request->all(), ['updated_by' => $this->getUser()->getId()]);

        $location->update($data);

        $location->refresh();

        return new JsonResource($location);
    }
}
