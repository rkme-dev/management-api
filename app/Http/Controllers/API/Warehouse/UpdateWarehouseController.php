<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Warehouse;

use App\Enums\WarehouseStatusesEnum;
use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\Warehouse\UpdateWarehouseRequest;
use App\Models\Warehouse;
use Illuminate\Http\Resources\Json\JsonResource;

final class UpdateWarehouseController extends AbstractAPIController
{
    public function __invoke(UpdateWarehouseRequest $request, int $id): JsonResource
    {
        $warehouse = Warehouse::find($id);

        $data = $request->all();

        $data['updated_by'] = $this->getUser()->getId();

        $warehouse->update($data);

        if ($request->get('status') === WarehouseStatusesEnum::DEACTIVATED->value) {
            $warehouse->delete();
        }

        return new JsonResource($warehouse);
    }
}
