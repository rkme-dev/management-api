<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Locations;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\Location;
use Illuminate\Http\Resources\Json\JsonResource;

final class ListLocationController extends AbstractAPIController
{
    public function __invoke(): JsonResource
    {
        return new JsonResource(Location::all());
    }
}
