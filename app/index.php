<?php
// Error Handling
error_reporting(-1);
ini_set('display_errors', 1);

// require_once 'vendor/autoload.php';
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;

require_once __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

// Add error middleware
$app->addErrorMiddleware(true, true, true); // ?

// Add parse body
$app->addBodyParsingMiddleware(); // ?

$app->get('[/]', function (Request $request, Response $response) {
    $response->getBody()->write("main");
    return $response;
});

$app->run();
?>