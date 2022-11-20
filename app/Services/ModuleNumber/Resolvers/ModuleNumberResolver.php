<?php

declare(strict_types=1);

namespace App\Services\ModuleNumber\Resolvers;

use App\Services\ModuleNumber\Interfaces\ModuleNumberResolverInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

final class ModuleNumberResolver implements ModuleNumberResolverInterface
{
    public function resolve(string $table, string $key, bool $withYear = true): string
    {
        $id = DB::table($table)->latest()->first()?->id;

        if ($id === null) {
            $id = 0;
        }

        $id++;

        $id = \str_pad((string) $id,7,"0",STR_PAD_LEFT);

        if ($withYear === true) {
            $year = (new Carbon())->format('Y');

            return \sprintf('%s-%s-%s', $key, $year, $id);
        }

        return \sprintf('%s%s', $key, $id);
    }
}
