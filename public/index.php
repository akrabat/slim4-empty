<?php

declare(strict_types=1);

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

// Create app
$app = AppFactory::create();

// Register middleware
$app->addRoutingMiddleware();
$app->addBodyParsingMiddleware();
$app->addErrorMiddleware(true, true, true);

// Register routes
$app->get('/[{name}]', function (
    ServerRequestInterface $request,
    ResponseInterface $response,
    array $args
): ResponseInterface {
    $name = $args['name'] ?? 'world';
    $response->getBody()->write("hello $name");
    return $response;
});

// Run app
$app->run();
