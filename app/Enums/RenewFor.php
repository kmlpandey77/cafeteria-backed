<?php

namespace App\Enums;

enum RenewFor: int
{
    case OneMonth = 1;
    case TwoMonths = 2;
    case ThreeMonths = 3;
    case SixMonths = 6;
    case OneYear = 12;
    case TwoYears = 24;
}

