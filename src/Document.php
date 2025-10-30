<?php
namespace Inutcin\HyppoEngine;

use Inutcin\HyppoEngine\Repository;

abstract class Document
{
    use Trait\Pattern\Factory{
        create as abstractCreate;
    }
    use Trait\Pattern\Builder;

    protected Repository $repository;
    protected DTO\Document $document;

    public static function create(string $className, Repository $repository):Document
    {
       return static::abstractCreate($className)->setRepository($repository);
    }

    public function setRepository(Repository $repository):static
    {
        $this->repository = $repository;
        return $this;
    }

    public function parser(Parser $parser):static
    {
        return $this->build("parser", $parser);
    }

    public function load(string $primaryKey):static
    {
        $this->document = $this->extract("parser")->parse(
            $this->repository->getByPrimaryKey($primaryKey)
        );
        return $this;
    }

    public function getDTO():DTO\Document{
        return $this->document;
    }

}

