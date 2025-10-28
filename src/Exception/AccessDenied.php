<?php
namespace Inutcin\HyppoEngine\Exception;

use Inutcin\HyppoEngine\Exception as AbstractException;

class AccessDenied extends AbstractException
{
    protected $code = 3;
}

