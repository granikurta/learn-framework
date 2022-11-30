<?php

require __DIR__ . '/../vendor/autoload.php';

use Component\Routing\Router;
use App\Controllers\RecipeController;
use Component\Http\Request;

$router = new Router();
$request = Request::createFromGlobals();

$router->add('get', '/test/{id}/update/', [RecipeController::class, 'index']);
$router->add('get', '/test/{id}', [RecipeController::class, 'show']);
$router->handle($request);

