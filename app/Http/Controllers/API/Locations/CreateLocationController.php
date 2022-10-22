<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Locations;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\Locations\CreateLocationRequest;
use App\Models\Location;
use Illuminate\Http\Resources\Json\JsonResource;

final class CreateLocationController extends AbstractAPIController
{
    public function __invoke(CreateLocationRequest $request): JsonResource
    {
        $data = \array_merge($request->all(), ['created_by' => $this->getUser()->getId()]);

        return new JsonResource(Location::create($data));
    }
}
