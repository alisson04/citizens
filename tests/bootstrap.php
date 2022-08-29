<?php

use Alisson04\Nis\Tests\TestInterface as TestInterface;
use Alisson04\Nis\Tests\Unit\Repositories\PdoCitizenRepositoryTest;

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$tests = [new PdoCitizenRepositoryTest()];

echo 'PROGRESS: ';

/** @var TestInterface $test */
foreach ($tests as $test) {
    $errorMessage = $test->runTests();

    if ($errorMessage) {
        break;
    }
}

if ($errorMessage) {
    echo PHP_EOL . $errorMessage;
    exit();
}

echo PHP_EOL . 'EVERYTHING OK';