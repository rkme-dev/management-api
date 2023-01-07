<?php

declare(strict_types=1);

namespace App\Services\ModuleNumber\Resolvers;

use App\Services\ModuleNumber\Interfaces\ModuleNumberResolverInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

final class ModuleNumberResolver implements ModuleNumberResolverInterface
{
    public function resolve(string $table, string $key, string $column, bool $withYear = true): string
    {
        $id = DB::table($table)->count();

        if ($id === null) {
            $id = 0;
        }

        $id = $id + 1;

        $existingCode = \str_pad((string) $id, 7, '0', STR_PAD_LEFT);

        $count = DB::table($table)->where($column, 'LIKE', '%'.$existingCode.'%')->count();

        if ($count > 0) {
            $id = $id + 1;
        }

        $id = \str_pad((string) $id, 7, '0', STR_PAD_LEFT);

        if ($withYear === true) {
            $year = (new Carbon())->format('Y');

            return \sprintf('%s-%s-%s', $key, $year, $id);
        }

        return \sprintf('%s%s', $key, $id);
    }

    public function validateId(int &$id, string $table): int
    {
        $exist = DB::table($table)->latest()->first()?->id;

        if ($exist !== null) {
            $id = $id + 1;

            $this->validateId($id, $table);
        }

        return $id;
    }
}
