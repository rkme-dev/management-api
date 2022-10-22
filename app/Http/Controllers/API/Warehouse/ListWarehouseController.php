<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Warehouse;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\Warehouse;
use Illuminate\Http\Resources\Json\JsonResource;

final class ListWarehouseController extends AbstractAPIController
{
    public function __invoke(): JsonResource
    {
        $data = Warehouse::all();

        $results = [];

        /** @var Warehouse $warehouse */
        foreach ($data as $warehouse) {
            $warehouseArray = $warehouse->toArray();

            $warehouseArray['created_by'] = $warehouse->getCreatedBy()->getFullName();
            $results[] = $warehouseArray;
        }

        return new JsonResource($results);
    }
}
