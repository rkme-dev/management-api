<?php

declare(strict_types=1);

namespace App\Enums;

enum PrintCopyEnums: string
{
    case OFFICE = 'office';

    case CUSTOMER = 'customer';

    case ACCOUNTING = 'accounting';
}
