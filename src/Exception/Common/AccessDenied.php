<?php
namespace Inutcin\HyppoEngine\Exception\common;

use Inutcin\HyppoEngine\Exception\Common as AbstractException;

class AccessDenied extends AbstractException
{
    protected $code = 11000;
}

