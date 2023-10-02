<?php

namespace Component\AppCore;

use Component\AppCore\Exceptions\DefinitionNotFoundException;
use Psr\Container\ContainerInterface;
use ReflectionClass;
use ReflectionNamedType;

class Container implements ContainerInterface
{
    private array $definitions = [];

    public function get(string $id)
    {
        if ($this->has($id)) {
            return $this->definitions[$id];
        }
        throw new DefinitionNotFoundException("Non-existent service " . $id);
    }

    public function has(string $id): bool
    {
        if (isset($this->definitions[$id])) {
            return true;
        }
        return false;
    }

    public function set(string $id, string $definition)
    {
        $this->definitions[$id] = $definition;
    }

    public function make($class, array $parameters = [])
    {
        return $this->resolve($class, $parameters);
    }

    protected function resolve($class, $parameters = [])
    {
        $reflector = new ReflectionClass($class);

        $constructor = $reflector->getConstructor();

        if (is_null($constructor)) {
            return new $class;
        }

        $dependencies = $constructor->getParameters();

        $instances = $this->resolveDependencies($dependencies);

        return $reflector->newInstanceArgs($instances);

    }

    private function resolveDependencies(array $dependencies)
    {
        $nameDependencies = [];

        foreach ($dependencies as $dependency) {

            // will need check parent class if has dependencies
            $type = $dependency->getType();

            echo "<pre>";
            print_r($type);
            echo "</pre>";

            if (!$type instanceof ReflectionNamedType || $type->isBuiltin()) {
                continue;
            }

            $nameDependencies[] = $type->getName();
        }

        return $nameDependencies;
    }
}