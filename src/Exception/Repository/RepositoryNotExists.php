<?php
namespace Inutcin\HyppoEngine\Exception\Repository;

use Inutcin\HyppoEngine\Exception\Repository as AbstractException;

class RepositoryNotExists extends AbstractException
{
    protected $code = 42000;
}

