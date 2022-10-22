<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\UnitPackings;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\UnitPackings\UpdateUnitPackingRequest;
use App\Models\UnitPacking;
use Illuminate\Http\Resources\Json\JsonResource;

final class ShowUnitPackingController extends AbstractAPIController
{
    public function __invoke(int $id): JsonResource
    {
        $unit = UnitPacking::find($id);

        return new JsonResource($unit);
    }
}
