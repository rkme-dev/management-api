<?php

declare(strict_types=1);

namespace App\Services\Audit\Resolvers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use OwenIt\Auditing\Models\Audit;

final class AuditsResolver
{
    public function resolve(Model $model, Collection $audits) {

        /** @var Audit $audit*/
        foreach ($audits as $index => $audit) {
            $data = [
                'action' => $audit->getAttribute('event'),
                'message' => \sprintf('%s %s has been %s',
                    $audit->getAttribute('auditable_type'),
                    $model->getAttribute('id'),
                    $audit->getAttribute('event'),
                )
            ];

            $changes = [];

            if ($audit->getAttribute('event') === 'updated') {
                foreach ($audit->getModified() as $field => $values) {
                    $title = Str::title(str_replace('_', ' ', $field));

                    $new = $values['new'];
                    $old = $values['old'];

                    if ($title === 'Status') {
                        $new = Str::title(str_replace('_', ' ', $new));
                        $old = $old !== null ? Str::title(str_replace('_', ' ', $old)) : 'none';
                    }

                    $message = sprintf('%s from %s to %s',
                        $title,
                        $old,
                        $new,
                    );

                    $changes[] = $message;
                }

                $data['changes'] = $changes;
            }

            $results[] = $data;

        }

        return $results;
    }
}
