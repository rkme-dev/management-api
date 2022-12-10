<?php

declare(strict_types=1);

namespace App\Enums;

enum TripTicketStatusesEnum: string
{
    case FOR_TRANSIT = 'For Transit';

    case IN_TRANSIT = 'In Transit';

    case DELIVERED = 'Delivered';
}
