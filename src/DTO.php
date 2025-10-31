<?php

declare(strict_types=1);

namespace Inutcin\HyppoEngine;

/**
 * Абстрактный класс DTO (Data Transfer Object).
 *
 * Определяет базовую структуру объекта передачи данных.
 * Использует трейт DTO для предоставления функциональности
 * динамического доступа к свойствам (get/set).
 */
abstract class DTO
{
    use Trait\Pattern\DTO;
}

