<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\RawMaterial;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\RawMaterial\AddUnitAndPackingToRawMaterialRequest;
use App\Models\RawMaterial;
use Illuminate\Http\Resources\Json\JsonResource;

final class AddUnitAndPackingToRawMaterialController extends AbstractAPIController
{
    public function __invoke(AddUnitAndPackingToRawMaterialRequest $request, int $id): JsonResource
    {
        $rawMaterial = RawMaterial::find($id);

        $data[$request->get('unit_id')]['packing'] =  $request->get('packing');

        $rawMaterial->units()->sync($data);

        $rawMaterial->refresh();

        $rawMaterial->units;

        return new JsonResource($rawMaterial);
    }
}
