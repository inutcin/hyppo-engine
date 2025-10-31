<?php

declare(strict_types=1);

namespace Inutcin\HyppoEngine\Trait\Pattern;

use Inutcin\HyppoEngine\Exception;

/**
 * Трейт реализации фабричного метода.
 *
 * Позволяет создавать объекты подклассов через статический метод create(),
 * автоматически определяя нужный класс на основе переданного имени.
 */
trait Factory
{
    /**
     * Создаёт экземпляр класса-наследника фабрики.
     *
     * Логика работы:
     * 1. Если имя класса не передано — используется значение $createDefaultClassName или "Default"
     * 2. Формируется полное имя класса как {пространство_имени_наследника}\{className}
     * 3. Создаётся и возвращается экземпляр указанного класса
     * 4. Если класс не найден — генерируется исключение {тип_фабрики}NotExists
     *
     * @param ?string $className Имя создаваемого класса (например, "Markdown", "File")
     * @return static Экземпляр запрашиваемого класса
     * @throws Exception Если класс с указанным именем не существует
     */
    public static function create(?string $className = null): static
    {
        // Если имя создаваемого класса не указано - берём умолчальное для
        // этой фабрики
        if (is_null($className)) {
            $className = static::$createDefaultClassName ?? "Default";
        }
        // Формируем полное имя создаваемого класса
        $classFullName = (static::class) . "\\" . $className;

        // Пробуем создать объект нужного класса
        try {
            return new ($classFullName);
        } catch (\Throwable $e) {
            $parts = explode("\\", static::class);
            $exceptionClassName = Exception::class . "\\" . end($parts) . "NotExists";
            throw new $exceptionClassName();
        }
    }
}

