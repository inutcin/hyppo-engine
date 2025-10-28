<?php
namespace Inutcin\HyppoEngine;

abstract class Repository
{
    use Trait\Pattern\Factory;
    use Trait\Pattern\Repository;

    abstract public function getByPrimaryKey(?string $primaryKey): DTO;
}


