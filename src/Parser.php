<?php

declare(strict_types=1);

namespace Inutcin\HyppoEngine;

/**
 * Абстрактный класс парсера.
 *
 * Определяет общий интерфейс для парсеров документов.
 * Использует фабричный метод для создания экземпляров конкретных парсеров.
 */
abstract class Parser 
{
    // Этот класс реализует паттерн Factory
    use Trait\Pattern\Factory;

    /**
     * Имя класса по умолчанию для создания через фабрику.
     *
     * @var string
     */
    protected static string $createDefaultClassName = "Markdown";
    protected DTO\SyntaxTree $syntaxTree;

    /**
     * Преобразует узел репозитория в DTO документа.
     *
     * Метод должен быть реализован в дочерних классах.
     *
     * @param DTO\RepositoryNode $repositoryNode Узел репозитория, который нужно распарсить
     * @return DTO\Document - синтаксическое дерево разбора документа
     */
    public function parse(DTO\RepositoryNode $repositoryNode): DTO\Document
    {
        // Создаём синтаксическое дерево разбора, с помощью которого будет построен документ
        $this->syntaxTree = SyntaxTree::create("Bnf")
            // Задаём язык документа
            ->setLang(static::class)
            // Соззаём синтаксическое дерево разбора
            ->parse(
                // Передаём текст для разбора 
                $repositoryNode->get("content")
            );
        return new DTO\Document;
    }
}
