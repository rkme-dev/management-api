<?php

namespace App\Services\ModuleNumber\Interfaces;

interface ModuleNumberResolverInterface
{
    public function resolve(
        string $table,
        string $key,
        string $column,
        bool $withYear = true
    ): string;
}
