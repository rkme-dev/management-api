<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\UnitPackings;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\UnitPackings\CreateUnitPackingRequest;
use App\Models\UnitPacking;
use Illuminate\Http\Resources\Json\JsonResource;

final class CreateUnitPackingController extends AbstractAPIController
{
    public function __invoke(CreateUnitPackingRequest $request): JsonResource
    {
        $data = $request->all([
            'is_active',
            'name',
        ]);

        $data['created_by'] = $this->getUser()->getId();

        return new JsonResource(UnitPacking::create($data));
    }
}
