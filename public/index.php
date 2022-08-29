<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/routes.php';

use Alisson04\Nis\Config\Routes;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7Server\ServerRequestCreator;
use Psr\Http\Server\RequestHandlerInterface as RequestHandlerInterfaceAlias;

$path = $_SERVER['PATH_INFO'];
$routes = Routes::getRoutes();

if (!array_key_exists($path, $routes)) {
    http_response_code(404);
    exit();
}

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$psr17Factory = new Psr17Factory();
$creator = new ServerRequestCreator($psr17Factory, $psr17Factory, $psr17Factory, $psr17Factory);

$request = $creator->fromGlobals();

$controllerClass = $routes[$path];

/** @var RequestHandlerInterfaceAlias $controller */
$controller = new $controllerClass();
$response = $controller->handle($request);

foreach ($response->getHeaders() as $name => $values) {
    foreach ($values as $value) {
        header(sprintf('%s: %s', $name, $value), false);
    }
}

echo $response->getBody();
