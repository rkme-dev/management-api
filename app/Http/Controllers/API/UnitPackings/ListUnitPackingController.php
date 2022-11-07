<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\UnitPackings;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\UnitPacking;
use Illuminate\Http\Resources\Json\JsonResource;

final class ListUnitPackingController extends AbstractAPIController
{
    public function __invoke(): JsonResource
    {
        $unitPackings = UnitPacking::with(['product.units'])->get();

        return new JsonResource($unitPackings);
    }
}
