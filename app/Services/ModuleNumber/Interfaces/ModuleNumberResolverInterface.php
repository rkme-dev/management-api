<?php

namespace App\Services\ModuleNumber\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface ModuleNumberResolverInterface
{
    public function resolve(string $table, string $key, bool $withYear = true): string;
}
