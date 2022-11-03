<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\RawMaterial;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\RawMaterial;
use Illuminate\Http\Resources\Json\JsonResource;

final class ShowRawMaterialController extends AbstractAPIController
{
    public function __invoke(int $id): JsonResource
    {
        $rawMaterial = RawMaterial::find($id);

        return new JsonResource($rawMaterial);
    }
}
