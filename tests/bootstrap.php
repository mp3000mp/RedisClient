<?php

declare(strict_types=1);

if (!is_file(__DIR__.'/../config.php') || !is_readable(__DIR__.'/../config.php')) {
    echo 'Missing config.php';
    exit();
}

include __DIR__.'/../config.php';

echo "\n";
echo 'Please wait... These tests will spend less than one minute...';
echo "\n";
echo "\n";
