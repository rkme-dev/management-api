<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\SalesDrs;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\SalesDr;
use Illuminate\Http\Resources\Json\JsonResource;

final class AreaListBySalesDRController extends AbstractAPIController
{
    public function __invoke(): JsonResource
    {
        $salesDrs = SalesDr::distinct()->get('area');

        $areas = [];

        foreach ($salesDrs as $salesDr) {
            $areas[] = $salesDr->area;
        }

        return new JsonResource($areas);
    }
}
