<?php
namespace Inutcin\HyppoEngine\Exception\Repository\File;

use Inutcin\HyppoEngine\Exception\Repository\File as AbstractException;

class FileNotExists extends AbstractException
{
    protected $code = 41100;
}

