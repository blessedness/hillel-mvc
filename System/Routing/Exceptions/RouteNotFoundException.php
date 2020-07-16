<?php

declare(strict_types=1);

namespace System\Routing\Exceptions;

class RouteNotFoundException extends \Exception
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var array
     */
    private $params;

    public function __construct(string $name, array $params = [])
    {
        parent::__construct("The route [".$name.'] not found.');
        $this->name = $name;
        $this->params = $params;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }
}
