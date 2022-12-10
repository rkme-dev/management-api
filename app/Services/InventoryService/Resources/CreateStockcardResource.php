<?php

declare(strict_types=1);

namespace App\Services\InventoryService\Resources;

use App\Helpers\InitialisableTrait;
use App\Helpers\Interfaces\Initialisable;

final class CreateStockcardResource implements Initialisable
{
    use InitialisableTrait;

    public string $type;

    public int $productId;

    public ?int $typeId;

    public ?string $date = null;

    public ?string $event = null;

    public ?string $document = null;

    public ?string $documentNumber = null;

    public ?string $remarks = null;

    public ?string $quantity = null;

    public ?string $unit = null;

    public ?string $price = null;

    public ?string $status = null;

    public ?string $quantityIn = null;

    public ?string $quantityOut = null;

    public ?string $balance = null;

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function setProductId(int $productId): self
    {
        $this->productId = $productId;

        return $this;
    }

    public function getTypeId(): int
    {
        return $this->typeId;
    }

    public function setTypeId(int $typeId): self
    {
        $this->typeId = $typeId;

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(?string $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getEvent(): ?string
    {
        return $this->event;
    }

    public function setEvent(?string $event): self
    {
        $this->event = $event;

        return $this;
    }

    public function getDocument(): ?string
    {
        return $this->document;
    }

    public function setDocument(?string $document): self
    {
        $this->document = $document;

        return $this;
    }

    public function getDocumentNumber(): ?string
    {
        return $this->documentNumber;
    }

    public function setDocumentNumber(?string $documentNumber): self
    {
        $this->documentNumber = $documentNumber;

        return $this;
    }

    public function getRemarks(): ?string
    {
        return $this->remarks;
    }

    public function setRemarks(?string $remarks): self
    {
        $this->remarks = $remarks;

        return $this;
    }

    public function getQuantity(): ?string
    {
        return $this->quantity;
    }

    public function setQuantity(?string $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getUnit(): ?string
    {
        return $this->unit;
    }

    public function setUnit(?string $unit): self
    {
        $this->unit = $unit;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(?string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getQuantityIn(): ?string
    {
        return $this->quantityIn;
    }

    public function setQuantityIn(?string $quantityIn): self
    {
        $this->quantityIn = $quantityIn;

        return $this;
    }

    public function getQuantityOut(): ?string
    {
        return $this->quantityOut;
    }

    public function setQuantityOut(?string $quantityOut): self
    {
        $this->quantityOut = $quantityOut;

        return $this;
    }

    public function getBalance(): ?string
    {
        return $this->balance;
    }

    public function setBalance(?string $balance): self
    {
        $this->balance = $balance;

        return $this;
    }
}
