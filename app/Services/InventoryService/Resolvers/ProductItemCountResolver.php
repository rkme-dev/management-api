<?php

declare(strict_types=1);

namespace App\Services\InventoryService\Resolvers;

use App\Models\Product;
use App\Services\InventoryService\Interfaces\ProductItemCountResolverInterface;
use App\Services\InventoryService\Resources\ProductItemCountResource;
use Illuminate\Database\Eloquent\Collection;

final class ProductItemCountResolver implements ProductItemCountResolverInterface
{
    public function resolve(ProductItemCountResource $resource): void
    {
        $product = Product::find($resource->getProductId());

        /** @var Collection $units */
        $units = $product->units;

        $unit = $units->where('name', $resource->getUnit())->first();

        $unit->pivot->setAttribute('actual_balance', $resource->getQuantity());
        $unit->pivot->setAttribute('reserved_balance', $resource->getQuantity());

        $unit->pivot->save();
        $unit->pivot->refresh();
    }
}
