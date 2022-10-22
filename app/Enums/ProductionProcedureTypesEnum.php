<?php

declare(strict_types=1);

namespace App\Enums;

enum ProductionProcedureTypesEnum: string
{
    case AUTOMATED = 'automated';

    case BOTTLE_BLOWING = 'bottle blowing';

    case BOTTLE_FILLING = 'bottle filling';
}
