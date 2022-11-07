<?php

namespace App\Services\InventoryService\Interfaces;

use App\Services\InventoryService\Resources\ProductItemCountResource;

interface ProductItemCountResolverInterface
{
    public function resolve(ProductItemCountResource $resource): void;
}
