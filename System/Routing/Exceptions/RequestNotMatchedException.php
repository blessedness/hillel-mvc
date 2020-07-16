<?php

declare(strict_types=1);

namespace System\Routing\Exceptions;

use Symfony\Component\HttpFoundation\Request;
use Throwable;

class RequestNotMatchedException extends \Exception
{
    /**
     * @var Request
     */
    private $request;

    public function __construct(Request $request, $message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct('Route not founded', $code, $previous);
        $this->request = $request;
    }

    /**
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }
}
