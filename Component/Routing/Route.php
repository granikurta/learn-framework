<?php


namespace Component\Routing;


class Route
{
    private string $path;

    private array $parameters;

    private string $pattern;

    private string $controller;

    private string $action;

    private string $method;

    public function __construct(string $method, string $path, array $parameters, string $pattern, string $controller, string $action)
    {
        $this->method = strtoupper($method);
        $this->path = $path;
        $this->parameters = $parameters;
        $this->pattern = $pattern;
        $this->controller = $controller;
        $this->action = $action;
    }

    /**
     * @return array
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * @return string
     */
    public function getPattern(): string
    {
        return $this->pattern;
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return $this->controller;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

}