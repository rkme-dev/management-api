<?php

declare(strict_types=1);

namespace App\Services\InventoryService\Resources;

use App\Helpers\InitialisableTrait;
use App\Helpers\Interfaces\Initialisable;

final class ProductItemCountResource implements Initialisable
{
    use InitialisableTrait;

    public int $productId;

    public string $unit;

    public string $quantity;

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->productId;
    }

    /**
     * @param int $productId
     */
    public function setProductId(int $productId): void
    {
        $this->productId = $productId;
    }

    /**
     * @return string
     */
    public function getUnit(): string
    {
        return $this->unit;
    }

    /**
     * @param string $unit
     */
    public function setUnit(string $unit): void
    {
        $this->unit = $unit;
    }

    /**
     * @return string
     */
    public function getQuantity(): string
    {
        return $this->quantity;
    }

    /**
     * @param string $quantity
     */
    public function setQuantity(string $quantity): void
    {
        $this->quantity = $quantity;
    }
}
