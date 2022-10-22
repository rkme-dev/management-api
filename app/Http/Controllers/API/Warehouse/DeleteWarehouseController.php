<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Warehouse;

use App\Enums\WarehouseStatusesEnum;
use App\Http\Controllers\API\AbstractAPIController;
use App\Models\Warehouse;
use Illuminate\Http\JsonResponse;

final class DeleteWarehouseController extends AbstractAPIController
{
    public function __invoke(int $id): JsonResponse
    {
        $warehouse = Warehouse::find($id);

        if ($warehouse === null) {
            return $this->respondNoContent();
        }

        $warehouse->update([
            'status' => WarehouseStatusesEnum::DEACTIVATED->value,
        ]);

        $warehouse->save();
        $warehouse->delete();

        return $this->respondNoContent();
    }
}
