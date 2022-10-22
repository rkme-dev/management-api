<?php

declare(strict_types=1);

namespace App\Helpers\Interfaces;

interface Initialisable
{
    /**
     * Initialisable constructor should be implement along with \App\Helpers\InitialisableTrait
     *
     * @param mixed[]|null $payload
     */
    public function __construct(?array $payload = []);
}
