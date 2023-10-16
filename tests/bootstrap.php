<?php

declare(strict_types=1);

use Symfony\Component\Dotenv\Dotenv;

require dirname(__DIR__) . '/vendor/autoload.php';

if (file_exists(dirname(__DIR__) . '/config/bootstrap.php')) {
    require dirname(__DIR__) . '/config/bootstrap.php';
} elseif (method_exists(Dotenv::class, 'bootEnv')) {
    $_ENV['APP_ENV'] = 'test';
    (new Dotenv())->bootEnv(dirname(__DIR__) . '/.env');
}

if ($_SERVER['APP_DEBUG']) {
    umask(0000);
}
