<?php

namespace App\Enums;

enum OrderStatus: string
{
    case DRAFT = 'draft';
    case CONFIRMED = 'confirmed';
    case EXECUTE = 'execute';
    case FINISHED = 'finished';
    case REJECTED = 'rejected';
}
