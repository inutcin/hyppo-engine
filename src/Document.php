<?php

declare(strict_types=1);

namespace Inutcin\HyppoEngine;

use Inutcin\HyppoEngine\Repository;

abstract class Document
{
    use Trait\Pattern\Factory {
        create as abstractCreate;
    }
    use Trait\Pattern\Builder;

    protected Repository $repository;
    protected DTO\Document $document;

    /**
     * Создание документа
     *
     * @param  string $className Имя класса документа. Например: "Article"
     * @param  Repository $repository Репозиторий в котором хранится документ
     * @return Document Объект созданного документа
     */
    public static function create(string $className, Repository $repository): Document
    {
        return static::abstractCreate($className)->setRepository($repository);
    }

    /**
     * Назначение репозитория документа
     *
     * @param Repository $repository Объект репозитория
     * @return static
     */
    public function setRepository(Repository $repository): static
    {
        $this->repository = $repository;
        return $this;
    }

    /**
     * Назначение парсера документа
     *
     * @param Parser $parser Объект парсера
     * @return static
     */
    public function parser(Parser $parser): static
    {
        return $this->build("parser", $parser);
    }

    /**
     * Загрузка документа по первичному ключу во внутренний объект
     *
     * @param string $primaryKey Первичный ключ документа (например, имя файла)
     * @return static
     */
    public function load(string $primaryKey): static
    {
        $this->document = $this->extract("parser")->parse(
            $this->repository->getByPrimaryKey($primaryKey)
        );
        return $this;
    }

    /**
     * Получает DTO-объект документа.
     *
     * Возвращает внутренний объект DTO, содержащий структурированные данные документа,
     * которые были загружены и обработаны парсером.
     *
     * @return DTO\Document Объект данных документа
     */
    public function getDTO(): DTO\Document
    {
        return $this->document;
    }
}

