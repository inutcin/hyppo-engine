<?php

declare(strict_types=1);

namespace Inutcin\HyppoEngine\Trait\Pattern;

/**
 * Трейт для реализации паттерна Строитель (Builder).
 *
 * Позволяет пошагово строить объект, добавляя к нему различные компоненты.
 */
trait Builder 
{
    /**
     * Добавляет компонент в строитель.
     *
     * Устанавливает значение для указанного атрибута в массиве частей построения.
     *
     * @param string $attribute Имя атрибута
     * @param mixed $value Значение атрибута
     * @return static Текущий объект для цепочки вызовов
     */
    public function build(string $attribute, mixed $value): static 
    {
        $this->buildParts[$attribute] = $value;
        return $this;
    }

    /**
     * Извлекает компонент из строителя.
     *
     * Получает значение ранее установленного атрибута.
     *
     * @param string $attribute Имя атрибута
     * @return mixed Значение атрибута или null, если не найдено
     */
    public function extract(string $attribute): mixed 
    {
        return $this->buildParts[$attribute]; 
    }
}

