<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\RawMaterial;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\RawMaterial\RemoveUnitAndPackingToRawMaterialRequest;
use App\Models\RawMaterial;
use Illuminate\Http\Resources\Json\JsonResource;

final class RemoveUnitAndPackingToRawMaterialController extends AbstractAPIController
{
    public function __invoke(RemoveUnitAndPackingToRawMaterialRequest $request, int $id): JsonResource
    {
        $rawMaterial = RawMaterial::find($id);

        $rawMaterial->units()->detach([$request->get('unit_id')]);

        $rawMaterial->refresh();

        $rawMaterial->units;

        return new JsonResource($rawMaterial);
    }
}
