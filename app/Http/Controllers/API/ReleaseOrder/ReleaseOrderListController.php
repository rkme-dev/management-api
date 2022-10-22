<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\ReleaseOrder;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Resources\RawMaterial\ReleaseOrdersResource;
use App\Models\ReleaseOrder;

final class ReleaseOrderListController extends AbstractAPIController
{
    public function __invoke() {
        return new ReleaseOrdersResource(ReleaseOrder::all());
    }
}
