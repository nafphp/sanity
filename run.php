<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use Naf\Sanity\Runtime;

$runtime = new Runtime();
$runtime->run();

echo getcwd();
