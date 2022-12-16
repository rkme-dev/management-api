<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\RawMaterial;

use App\Enums\RawMaterialTypeEnums;
use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\RawMaterial\CreateRawMaterialRequest;
use App\Models\RawMaterial;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

final class CreateRawMaterialController extends AbstractAPIController
{
    public function __invoke(CreateRawMaterialRequest $request): JsonResource
    {
        $data = $request->all([
            'name',
            'sku',
            'description',
            'grouping',
            'brand',
            'unit_id',
            'price',
            'active',
            'type',
        ]);

        $data = [
            ...$data,
            ...[
                'active' => true,
                'slug' => Str::slug($request->get('name')),
                'created_by' => $this->getUser()->getId(),
            ],
        ];

        if ($request->get('type') === RawMaterialTypeEnums::PREFORM->value) {
            $data['raw_material_id'] = $request->get('raw_material_id');
        }

        $rawMaterial = RawMaterial::create($data);

        $syncData = [];

        foreach ($request->get('units') as $unit) {
            $syncData[$unit['id']]['packing'] = $unit['pivot']['packing'];
        }

        $rawMaterial->units()->sync($syncData);

        $rawMaterial->refresh();

        return new JsonResource($rawMaterial);
    }
}
