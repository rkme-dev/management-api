<?php

declare(strict_types=1);

namespace App\Enums;

enum AccountsTypeEnums: string
{
    case AR = 'Accounts Receivable';

    case AP = 'Accounts Payable';

    case BANK = 'Bank';

    case CASH = 'Cash';

    case FA = 'Fixed Asset';

    case COGS = 'Cost of Goods Sold';

    case INCOME = 'Income';

    case EXPENSES = 'Expenses';

    case OI = 'Other Income';

    case OE = 'Other Expenses';
}
