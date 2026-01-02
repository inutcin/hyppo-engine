<?php
declare(strict_types=1);

namespace Inutcin\HyppoEngine;

/**
 * Абстрактный класс репозитория.
 *
 * Определяет общий интерфейс для работы с хранилищами документов.
 * Поддерживает фабричный метод и паттерн Repository.
 */
abstract class SyntaxTree 
{
    // Этот класс реализует паттерн Factory
    use Trait\Pattern\Factory;

    /**
     * Имя класса по умолчанию для создания через фабрику.
     *
     * @var string
     */
    protected static string $createDefaultClassName = "Bnf";

    public function parse(string $lang, DTO\RepositoryNode $repositoryNode): DTO\SyntaxTree
    {
        return new DTO\SyntaxTree;
    }
}


