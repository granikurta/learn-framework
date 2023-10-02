<?php

require __DIR__ . '/../vendor/autoload.php';

use Component\AppCore\Core;
use Component\Routing\Router;
use Component\Http\Request;

$router = new Router();
$request = Request::createFromGlobals();

$config = require __DIR__ . '/../config/services.php';

$app = new Core($config);

$app->handle();



//$router->add('get', '/test/{id}/update/', [RecipeController::class, 'index']);
//$router->add('get', '/test/{id}', [RecipeController::class, 'show']);
//$router->handle($request);

