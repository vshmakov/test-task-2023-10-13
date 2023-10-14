<?php

declare(strict_types=1);

namespace App\Entity;

enum PaymentProcessor: string
{
    case PAYPAL = 'paypal';
}
