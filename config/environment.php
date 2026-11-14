<?php
declare(strict_types=1);

$environmentFile = dirname(__DIR__) . '/.env';

$environment = is_readable($environmentFile)
    ? parse_ini_file($environmentFile, false, INI_SCANNER_RAW)
    : [];

if ($environment === false) {
    throw new RuntimeException('Failed to load environment configuration.');
}

foreach ($environment as $key => $value) {
    if (getenv($key) === false) {
        putenv("$key=$value");
    }
}
