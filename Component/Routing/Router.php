<?php

namespace Component\Routing;

use Component\Http\Request;
use Component\Http\Response;

class Router
{
    /**
     * @todo replace implementation with Collection
     * @var Route []
     */
    public static array $routes;

    public function add(string $method, string $path, array $controller)
    {
        $path = trim($path, '/');
        $routeBuilder = new RouteBuilder($method, $path, $controller);
        self::$routes[] = $routeBuilder->create();
    }

    public function handle(Request $request)
    {
        $requestUrl = trim($request->getPath(), '/');
        foreach (self::$routes as $route) {

            $patch = $route->getPattern();

            if (preg_match("/$patch$/", $requestUrl) && $request->getMethod() == $route->getMethod()) {
                $params = $this->matchParamsRequestRoute($requestUrl, $route->getParameters());
                $controller = $route->getController();
                //@todo check return call_user_fn_array
                $response = call_user_func_array([new $controller, $route->getAction()], [$request ,$params]);
                if ($response instanceof Response) {
                    $response->send();
                }
                exit();
            }
        }
        //@todo move to new class maybe
        header("HTTP/1.1 404 Not Found");
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['error' => 'Page not found']);
    }

    /** @todo maybe rework to matcherService */
    private function matchParamsRequestRoute(string $request, array $routeParams): array
    {
        $requestParams = [];

        $requestSeparated = explode('/', $request);

        foreach ($requestSeparated as $index => $item) {

            if (empty($routeParams[$index])) {
                continue;
            }
            $requestParams[$routeParams[$index]] = $item;
        }
        return $requestParams;
    }
}