<?php

declare(strict_types=1);

namespace Inutcin\HyppoEngine\Trait\Pattern;

/**
 * Трейт для реализации простой структуры DTO (Data Transfer Object).
 *
 * Предоставляет базовые методы для получения и установки произвольных полей данных.
 * Позволяет работать с объектом как с контейнером атрибутов.
 */
trait DTO 
{
    /**
     * Получает значение по ключу.
     *
     * Возвращает значение указанного свойства объекта.
     * Если свойство не существует — возвращает null.
     *
     * @param string $key Имя свойства
     * @return mixed Значение свойства или null, если не найдено
     */
    public function get(string $key): mixed 
    {
        return $this->$key ?? null;
    }

    /**
     * Устанавливает значение по ключу.
     *
     * Присваивает значение указанному свойству объекта.
     * Поддерживает цепочку вызовов, возвращая текущий объект.
     *
     * @param string $key Имя свойства
     * @param mixed $value Значение для установки
     * @return static Текущий объект для цепочки вызовов
     */
    public function set(string $key, mixed $value): static 
    {
        $this->$key = $value;
        return $this;
    }
}
