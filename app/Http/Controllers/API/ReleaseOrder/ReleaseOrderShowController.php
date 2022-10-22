<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\ReleaseOrder;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Resources\RawMaterial\ReleaseOrderResource;
use App\Models\ReleaseOrder;
use Illuminate\Http\Resources\Json\JsonResource;

final class ReleaseOrderShowController extends AbstractAPIController
{
    public function __invoke(int $id): JsonResource
    {
        return new ReleaseOrderResource(ReleaseOrder::with('productReleaseOrders')->find($id));
    }
}
