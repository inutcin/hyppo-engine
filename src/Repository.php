<?php
namespace Inutcin\HyppoEngine;

abstract class Repository
{
    use Trait\Pattern\Factory;
    use Trait\Pattern\Repository;

    // Создаваемый по умолчанию класс для фабричного метода
    protected static string $createDefaultClassName = "File";

    /**
     *  Получение элемента репозитория по ключу
     */
    abstract public function getByPrimaryKey(?string $primaryKey): DTO;
}


