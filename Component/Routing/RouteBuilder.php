<?php

namespace Component\Routing;

use Exception;

class RouteBuilder
{
    private string $path;

    private array $controller;

    private string $method;

    public function __construct(string $method, string $path, array $controller)
    {
        $this->method = $method;
        $this->path = $path;
        $this->controller = $controller;
    }

    /**
     * @throws Exception
     */
    public function create(): Route
    {
        $uri = explode("/", $this->path);

        $paramsKey = $this->getParamsKey($this->path);
        $keyIndex = $this->getKeyIndex($uri);
        $paramsData = array_combine($keyIndex, $paramsKey);

        $pattern = $this->makePattern($paramsData, $uri);

        return new Route($this->method, $this->path, $paramsData, $pattern, $this->getControllerClass(), $this->getAction());
    }

    private function makePattern(array $paramsData, $uri): string
    {
        $pattern = $this->replaceParamToPattern($paramsData, $uri);
        $strPattern = implode("/", $pattern);
        return $this->replaceSlash($strPattern);
    }

    private function replaceSlash(string $str): string
    {
        return str_replace("/", '\\/', $str);
    }

    private function replaceParamToPattern(array $paramsData, array $uri): array
    {
        foreach ($paramsData as $index => $key) {
            if (!empty($uri[$index])) {
                $uri[$index] = "[0-9]+";
            }
        }
        return $uri;
    }

    private function getParamsKey($path): array
    {
        $paramsKey = [];
        preg_match_all("/(?<={).+?(?=})/", $path, $paramMatches);
        foreach ($paramMatches[0] as $key) {
            $paramsKey[] = $key;
        }
        return $paramsKey;
    }

    private function getKeyIndex(array $uri): array
    {
        $indexKeys = [];
        foreach ($uri as $index => $part) {
            if (preg_match("/{.*}/", $part)) {
                $indexKeys[] = $index;
            }
        }
        return $indexKeys;
    }

    /**
     * @return string
     * @throws Exception
     */
    private function getControllerClass(): string
    {
        if (empty($this->controller[0])) {
            throw new Exception('Controller is undefined!');
        }
        return $this->controller[0];
    }

    /**
     * @return string
     * @throws Exception
     */
    private function getAction(): string
    {
        if (empty($this->controller[1])) {
            throw new Exception('Method is undefined!');
        }
        return $this->controller[1];
    }
}