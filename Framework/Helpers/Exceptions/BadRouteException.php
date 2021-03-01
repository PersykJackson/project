<?php

namespace Liloy\Framework\Helpers\Exceptions;

class BadRouteException extends FrameworkException
{
    protected $message = 'Route - not correct';
    protected $code = 404;
}
