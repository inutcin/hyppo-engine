<?php

declare(strict_types=1);

namespace Inutcin\HyppoEngine;

/**
 * Абстрактный класс репозитория.
 *
 * Определяет общий интерфейс для работы с хранилищами документов.
 * Поддерживает фабричный метод и паттерн Repository.
 */
abstract class Repository
{
    use Trait\Pattern\Factory;
    use Trait\Pattern\Repository;

    /**
     * Имя класса по умолчанию для создания через фабрику.
     *
     * @var string
     */
    protected static string $createDefaultClassName = "File";

    /**
     * Получает элемент репозитория по его первичному ключу.
     *
     * Абстрактный метод, который должен быть реализован в дочерних классах.
     * Возвращает объект DTO, содержащий данные найденного элемента.
     *
     * @param ?string $primaryKey Первичный ключ элемента (например, имя файла или идентификатор)
     * @return DTO Объект данных найденного элемента
     */
    abstract public function getByPrimaryKey(?string $primaryKey): DTO;
}

