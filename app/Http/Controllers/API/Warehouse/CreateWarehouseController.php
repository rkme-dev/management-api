<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Warehouse;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\Warehouse\CreateWarehouseRequest;
use App\Models\Warehouse;
use Illuminate\Http\Resources\Json\JsonResource;

final class CreateWarehouseController extends AbstractAPIController
{
    public function __invoke(CreateWarehouseRequest $request): JsonResource
    {
        $data = $request->all([
            'name',
            'status',
            'address',
            'contact_number',
            'is_main',
        ]);

        $data['created_by'] = $this->getUser()->getId();

        return new JsonResource(Warehouse::create($data));
    }
}
