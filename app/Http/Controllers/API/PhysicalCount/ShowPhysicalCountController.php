<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\PhysicalCount;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\PhysicalCount;
use Illuminate\Http\Resources\Json\JsonResource;

final class ShowPhysicalCountController extends AbstractAPIController
{
    public function __invoke(PhysicalCount $physicalCount): JsonResource
    {
        return new JsonResource($physicalCount->load('document', 'createdBy', 'countItems'));
    }
}
