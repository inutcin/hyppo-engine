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
    use Trait\Pattern\Factory;

    /**
     * Имя класса по умолчанию для создания через фабрику.
     *
     * @var string
     */
    protected static string $createDefaultClassName = "Markdown";

    /**
     * Преобразует узел репозитория в DTO документа.
     *
     * Метод должен быть реализован в дочерних классах.
     *
     * @param DTO\RepositoryNode $content Содержимое узла репозитория
     * @return DTO\Document Объект данных документа
     */
    public function parse(DTO\RepositoryNode $content): DTO\Document
    {
        return new DTO\Document;
    }
}
