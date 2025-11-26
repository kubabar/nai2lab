<?php

use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use Dotenv\Dotenv;

require __DIR__ . '/../vendor/autoload.php';

// Load environment variables
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Create App
$app = AppFactory::create();

// Add error middleware
$app->addErrorMiddleware(true, true, true);

// Load global data
$globalData = require __DIR__ . '/../config/data.php';

// Create Twig
$twig = Twig::create(__DIR__ . '/../templates', [
    'cache' => false
]);

// Add global variables to Twig
$env = $twig->getEnvironment();
foreach ($globalData as $key => $value) {
    $env->addGlobal($key, $value);
}

// Add Twig-View Middleware
$app->add(TwigMiddleware::create($app, $twig));

// Register routes
require __DIR__ . '/../config/routes.php';

$app->run();