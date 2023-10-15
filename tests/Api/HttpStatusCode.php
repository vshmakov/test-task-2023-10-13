<?php

declare(strict_types=1);

namespace App\Tests\Api;

use Symfony\Component\HttpFoundation\Response;

enum HttpStatusCode: int
{
    case OK = Response::HTTP_OK;
}
