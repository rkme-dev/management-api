<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\UnitPackings;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\UnitPackings\UpdateUnitPackingRequest;
use App\Models\UnitPacking;
use Illuminate\Http\Resources\Json\JsonResource;

final class UpdateUnitPackingController extends AbstractAPIController
{
    public function __invoke(UpdateUnitPackingRequest $request, int $id): JsonResource
    {
        $unit = UnitPacking::find($id);

        $data = $request->all([
            'is_active',
            'name',
        ]);

        $data['updated_by'] = $this->getUser()->getId();

        $unit->update($data);

        $unit->refresh();

        return new JsonResource($unit);
    }
}
