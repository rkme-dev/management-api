<?php

namespace App\Services\Collections\Interfaces;

use App\Models\Collection;

interface CollectionUnpostResolverInterface
{
    public function resolve(Collection $collection): void;
}
