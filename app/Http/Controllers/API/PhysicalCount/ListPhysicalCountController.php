<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\PhysicalCount;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\PhysicalCount;
use Illuminate\Http\Resources\Json\JsonResource;

final class ListPhysicalCountController extends AbstractAPIController
{
    public function __invoke(): JsonResource
    {
        $physicalCount = PhysicalCount::with(
            'document',
            'location',
            'createdBy',
            'countItems'
        )
        ->orderBy('created_at', 'desc')
        ->get();

        return new JsonResource($physicalCount);
    }
}
