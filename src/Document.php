<?php
namespace Inutcin\HyppoEngine;

use Inutcin\HyppoEngine\Repository;

abstract class Document
{
    use Trait\Pattern\Factory{
        create as abstractCreate;
    }

    protected Repository $repository;

    public static function create(string $className, Repository $repository):Document
    {
       return static::abstractCreate($className)->setRepository($repository);
    }

    public function setRepository(Repository $repository):static
    {
        $this->repository = $repository;
        return $this;
    }

}

