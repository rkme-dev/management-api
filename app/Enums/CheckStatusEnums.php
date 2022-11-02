<?php

declare(strict_types=1);

namespace App\Enums;

enum CheckStatusEnums: string
{
    case UNCOLLECTED = 'uncollected';

    case FOR_REVIEW = 'for_review';

    case DEPOSITED = 'deposited';

    case BOUNCED = 'bounced';
}
