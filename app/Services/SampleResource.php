<?php

declare(strict_types=1);

namespace App\Services;

use App\Helpers\InitialisableTrait;
use App\Helpers\Interfaces\Initialisable;

final class SampleResource implements Initialisable
{
    use InitialisableTrait;

    private ?string $createdAt = null;

    private ?string $deletedAt = null;

    private ?string $updatedAt = null;

    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    public function getDeletedAt(): ?string
    {
        return $this->deletedAt;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }

    public function setCreatedAt(?string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function setDeletedAt(?string $deletedAt): void
    {
        $this->deletedAt = $deletedAt;
    }

    public function setUpdatedAt(?string $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}
