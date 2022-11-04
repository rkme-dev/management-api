<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Collections;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

final class ListCollectionsController extends AbstractAPIController
{
    public function __invoke(): JsonResource
    {
        $collections = Collection::with('salesDrPayments.salesDr', 'payments', 'salesDrPayments', 'customer', 'document')
            ->orderBy('created_at', 'desc')
            ->get();

        return new JsonResource($collections);
    }
}
