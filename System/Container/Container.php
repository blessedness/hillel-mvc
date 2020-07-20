<?php

declare(strict_types=1);

namespace System\Container;

use System\Container\Exceptions\ServiceContainerInvalidArgumentException;

class Container implements ContainerInterface
{
    private $definitions = [];

    private $results = [];

    public function __construct(array $definitions = [])
    {
        $this->definitions = $definitions;
    }

    public function set(string $id, $value)
    {
        $this->removeResult($id);

        $this->definitions[$id] = $value;
    }

    public function removeResult($id)
    {
        if ($this->issetResults($id)) {
            unset($this->results[$id]);
        }
    }

    /**
     * @param  string  $class
     * @param  string  $name
     * @return array
     * @throws \ReflectionException
     */
    public function methodParams(string $class, string $name): array
    {
        $reflection = new \ReflectionMethod($class, $name);

        $arguments = [];

        if (!empty($params = $reflection->getParameters())) {
            foreach ($params as $parameter) {
                if ($class = $parameter->getClass()) {
                    $arguments[] = $this->get($class->getName());
                } elseif ($parameter->isArray()) {
                    $arguments[] = [];
                } else {
                    if (!$parameter->isDefaultValueAvailable()) {
                        throw new ServiceContainerInvalidArgumentException(
                            sprintf('Unable to resolve "%s" in service "%s"', $parameter->getName(), $class.':'.$name)
                        );
                    }

                    $arguments[] = $parameter->getDefaultValue();
                }
            }
        }

        return $arguments;
    }

    public function get(string $id)
    {
        if (!$this->has($id)) {
            if (class_exists($id)) {
                return $this->buildClass($id);
            }

            throw new ServiceContainerInvalidArgumentException(sprintf('Invalid service "%s"', $id));
        }

        if ($this->issetResults($id)) {
            return $this->results[$id];
        }

        $definition = $this->definitions[$id];

        if ($definition instanceof \Closure) {
            $this->results[$id] = $definition($this);
        } else {
            $this->results[$id] = $definition;
        }

        if (is_string($this->results[$id]) && class_exists($this->results[$id])) {
            return $this->buildClass($this->results[$id]);
        }

        return $this->results[$id];
    }

    public function has(string $id): bool
    {
        return array_key_exists($id, $this->definitions);
    }

    /**
     * @param  string  $id
     * @return object
     * @throws \ReflectionException
     */
    private function buildClass(string $id)
    {
        $reflection = new \ReflectionClass($id);

        $arguments = [];

        if (($constructor = $reflection->getConstructor()) !== null) {
            foreach ($constructor->getParameters() as $parameter) {
                if ($class = $parameter->getClass()) {
                    $arguments[] = $this->get($class->getName());
                } elseif ($parameter->isArray()) {
                    $arguments[] = [];
                } else {
                    if (!$parameter->isDefaultValueAvailable()) {
                        throw new ServiceContainerInvalidArgumentException(
                            sprintf('Unable to resolve "%s" in service "%s"', $parameter->getName(), $id)
                        );
                    }

                    $arguments[] = $parameter->getDefaultValue();
                }
            }
        }

        return $this->results[$id] = $this->definitions[$id] = $reflection->newInstanceArgs($arguments);
    }

    protected function issetResults(string $id): bool
    {
        return array_key_exists($id, $this->results);
    }
}
