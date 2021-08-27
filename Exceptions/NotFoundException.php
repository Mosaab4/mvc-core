<?php

namespace Mosaab\MVC\Exceptions;

class NotFoundException extends \Exception
{
    protected $code = 404;
    protected $message = 'Not Found';
}