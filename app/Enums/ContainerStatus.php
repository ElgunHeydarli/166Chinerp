<?php

namespace App\Enums;

enum ContainerStatus : string{
    case PENDING = 'pending';
    case ACCEPTED = 'accepted';
    case REJECTED = 'rejected';
}
