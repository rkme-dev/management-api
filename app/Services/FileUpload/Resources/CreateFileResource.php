<?php

declare(strict_types=1);

namespace App\Services\FileUpload\Resources;

use App\Helpers\InitialisableTrait;
use App\Helpers\Interfaces\Initialisable;
use App\Models\User;

final class CreateFileResource implements Initialisable
{
    use InitialisableTrait;

    public User $createdBy;

    public mixed $morphable;

    public string $filename;

    public ?string $filepath = null;

    public ?string $format = null;

    public function getCreatedBy(): User
    {
        return $this->createdBy;
    }

    public function getMorphable(): mixed
    {
        return $this->morphable;
    }

    public function getFilename(): string
    {
        return $this->filename;
    }

    public function getFilepath(): ?string
    {
        return $this->filepath;
    }

    public function getFormat(): ?string
    {
        return $this->format;
    }

    public function setCreatedBy(User $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function setMorphable(mixed $morphable): self
    {
        $this->morphable = $morphable;

        return $this;
    }

    public function setFilename(string $filename): self
    {
        $this->filename = $filename;

        return $this;
    }

    public function setFilepath(?string $filepath): self
    {
        $this->filepath = $filepath;

        return $this;
    }

    public function setFormat(?string $format): self
    {
        $this->format = $format;

        return $this;
    }
}
