<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\SalesDrs;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\SalesDr;
use App\Services\ModuleNumber\Interfaces\ModuleNumberResolverInterface;
use Illuminate\Http\Resources\Json\JsonResource;

final class ShowSalesDrController extends AbstractAPIController
{
    private ModuleNumberResolverInterface $moduleNumberResolver;

    public function __construct(ModuleNumberResolverInterface $moduleNumberResolver)
    {
        $this->moduleNumberResolver = $moduleNumberResolver;
    }

    public function __invoke(int $id): JsonResource
    {
        $dr = SalesDr::with([
            'customer',
            'orderItems',
            'salesDrItems',
            'document',
            'vat',
            'term',
        ])->where('id', $id)->first();

        if ($dr === null) {
            return $this->respondNotFound('Sales DR not found');
        }

        return new JsonResource($dr);
    }
}
