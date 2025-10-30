<?php
namespace Inutcin\HyppoEngine\Trait\Pattern;

use Inutcin\HyppoEngine\Exception;

trait Factory
{
    public static function create(?string $className = null):static
    {
        // Если имя создаваемого класса не указано - берём умолчальное для
        // этой фабрики
        if(is_null($className)) {
            $className = static::$createDefaultClassName ?? "Default";
        }
        // Формируем полное имя создаваемого класса
        $classFullName = (static::class)."\\".$className;

        // Пробуем создать объект нужного класса
        try{
            return new ($classFullName);
        }
        catch(\Throwable $e) {
            $parts = explode("\\", static::class);
            $exceptionClassName = Exception::class."\\".end($parts)."NotExists";
            throw new $exceptionClassName();
        }
    }
}

