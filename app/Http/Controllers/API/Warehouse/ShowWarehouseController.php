<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Warehouse;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\Warehouse;
use Illuminate\Http\Resources\Json\JsonResource;

final class ShowWarehouseController extends AbstractAPIController
{
    public function __invoke(int $id): JsonResource
    {
        return new JsonResource(Warehouse::find($id));
    }
}
