<?php


class BadRouteException extends Exception
{
    protected $message = 'Route - not correct';
    protected $code = 404;
}