<?php

use Alisson04\Nis\Infrastructure\Persistence\ConnectionCreator;

require_once '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$dbName = $_ENV['DB_NAME'];
$dbTestName = $_ENV['DB_TEST_NAME'];

# DROP DATABASES
if (file_exists($dbName)) {
    unlink($dbName);
}
if (file_exists($dbTestName)) {
    unlink($dbTestName);
}

# CREATE DATABASES
$query = "CREATE TABLE citizens (id INTEGER PRIMARY KEY, name TEXT, nis TEXT)";

$pdo = ConnectionCreator::createConnection();
$pdo->exec($query);

$pdo = ConnectionCreator::createTestConnection();
$pdo->exec($query);
