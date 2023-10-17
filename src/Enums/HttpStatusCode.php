<?php

declare(strict_types=1);

namespace App\Enums;

use Symfony\Component\HttpFoundation\Response;

enum HttpStatusCode: int
{
    case OK = Response::HTTP_OK;
}
