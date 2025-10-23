<?php

namespace App\Enums;

enum ServiceType: string
{
    case DEPO = 'depo';
    case DOCUMENTATION = 'documentation';
    case BALANCE = 'balance';
}
