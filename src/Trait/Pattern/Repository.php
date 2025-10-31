<?php

declare(strict_types=1);

namespace Inutcin\HyppoEngine\Trait\Pattern;

use Inutcin\HyppoEngine\Trait\Attribute;

/**
 * Трейт для реализации функциональности репозитория.
 *
 * Предоставляет методы для работы с атрибутами подключения к репозиторию:
 * протокол, пользователь, пароль, хост, путь.
 * Использует трейт Attribute для управления значениями атрибутов.
 */
trait Repository 
{
    use Attribute;

    /**
     * Протокол доступа к репозиторию (например, http, https, file).
     *
     * @var ?string
     */
    protected ?string $protocol = null;

    /**
     * Имя пользователя для аутентификации.
     *
     * @var ?string
     */
    protected ?string $username = null;

    /**
     * Пароль для аутентификации.
     *
     * @var ?string
     */
    protected ?string $password = null;

    /**
     * Хост репозитория (например, example.com).
     *
     * @var ?string
     */
    protected ?string $host = null;

    /**
     * Путь к репозиторию.
     *
     * @var ?string
     */
    protected ?string $path = null; 

    /**
     * Устанавливает или возвращает протокол репозитория.
     *
     * @param ?string $value Новое значение протокола
     * @return string|static Значение протокола или текущий объект для цепочки вызовов
     */
    public function protocol(?string $value = null): string|static
    {
        return (string)$this->attributeAccess("protocol", $value);
    } 

    /**
     * Устанавливает или возвращает имя пользователя.
     *
     * @param ?string $value Новое значение имени пользователя
     * @return string|static Значение имени пользователя или текущий объект для цепочки вызовов
     */
    public function username(?string $value = null): string|static
    {
        return $this->attributeAccess("username", $value);
    } 

    /**
     * Устанавливает или возвращает пароль.
     *
     * @param ?string $value Новое значение пароля
     * @return string|static Значение пароля или текущий объект для цепочки вызовов
     */
    public function password(?string $value = null): string|static
    {
        return $this->attributeAccess("password", $value);
    } 

    /**
     * Устанавливает или возвращает хост репозитория.
     *
     * @param ?string $value Новое значение хоста
     * @return string|static Значение хоста или текущий объект для цепочки вызовов
     */
    public function host(?string $value = null): string|static
    {
        return $this->attributeAccess("host", $value);
    } 

    /**
     * Устанавливает или возвращает путь к репозиторию.
     *
     * @param ?string $value Новое значение пути
     * @return string|static Значение пути или текущий объект для цепочки вызовов
     */
    public function path(?string $value = null): string|static
    {
        return $this->attributeAccess("path", $value);
    } 
}

