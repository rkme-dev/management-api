<?php

declare(strict_types=1);

namespace App\Enums;

enum PhysicalCountStatusesEnum: string
{
    case CANCELLED = 'cancelled';

    case POSTED = 'posted';

    case FOR_REVIEW = 'for_review';
}
