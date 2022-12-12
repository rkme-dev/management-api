<?php

declare(strict_types=1);

namespace App\Enums;

enum ProductionTypesEnum: string
{
    case BOTTLE_BLOWING = 'Bottle Blowing';

    case BOTTLE_FILLING = 'Bottle Filling';
}
