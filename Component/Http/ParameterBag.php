<?php

namespace Component\Http;

class ParameterBag implements \IteratorAggregate
{
    /**
     * @var array
     */
    protected array $parameters;

    /**
     * @param array $parameters
     */
    public function __construct(array $parameters = [])
    {
        $this->parameters = $parameters;
    }

    /**
     * @param string $key
     * @param $default
     * @return mixed
     */
    public function get(string $key, $default = null): mixed
    {
        return array_key_exists($key, $this->parameters) ? $this->parameters[$key] : $default;
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function set(string $key, mixed $value): void
    {
        $this->parameters[$key] = $value;
    }

    /**
     * @return \ArrayIterator<string, mixed>
     */
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator();
    }
}