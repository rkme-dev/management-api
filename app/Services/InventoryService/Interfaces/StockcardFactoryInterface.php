<?php

namespace App\Services\InventoryService\Interfaces;

use App\Models\StockcardReport;
use App\Services\InventoryService\Resources\CreateStockcardResource;

interface StockcardFactoryInterface
{
    public function make(CreateStockcardResource $resource): StockcardReport;
}
