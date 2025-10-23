<?php

namespace App\Enums;

enum CustomerType: string
{
    case PHYSICAL = 'physical';
    case OWNER = 'owner';
    case LEGAL = 'legal';
}
