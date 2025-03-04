<?php

namespace App\Enums;

enum RenewType: int
{
    case Register = 1;
    case Renew = 2;
    case Adjustment = 3;
    case GracePeriod = 4;
}
