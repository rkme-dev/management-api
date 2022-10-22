<?php

namespace App\Services\Collections\Interfaces;

use App\Models\Collection;

interface CollectionPostedResolverInterface
{
    public function resolve(Collection $collection): void;
}
