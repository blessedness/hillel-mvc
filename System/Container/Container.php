<?php

declare(strict_types=1);

namespace System\Container;

class Container implements ContainerInterface
{
    private $definition = [];

    private $results = [];

    public function __construct(array $definition = [])
    {
        $this->definition = $definition;
    }

    public function get(string $id)
    {
        if (!$this->has($id)) {
            if (class_exists($id)) {
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
                                dd($parameter);
                            }

                            $arguments[] = $parameter->getDefaultValue();
                        }
                    }
                }

                return $this->results[$id] = $this->definition[$id] = $reflection->newInstanceArgs($arguments);
            }
        }

        if ($this->issetResult($id)) {
            return $this->results[$id];
        }

        $definition = $this->definition[$id];

        if ($definition instanceof \Closure) {
            $this->results[$id] = $definition($this);
        } else {
            $this->results[$id] = $definition;
        }

        if (is_string($this->results[$id]) && class_exists($this->results[$id])) {
            $this->results[$id] = $this->get($this->results[$id]);
        }

        return $this->results[$id];
    }

    public function has(string $id): bool
    {
        return array_key_exists($id, $this->definition);
    }

    private function issetResult(string $id): bool
    {
        return array_key_exists($id, $this->results);
    }

    public function set(string $id, $value): void
    {
        $this->definition[$id] = $value;
    }
}
