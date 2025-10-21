<?php
namespace Inutcin\HyppoEngine\Trait\Pattern;

use Inutcin\HyppoEngine\Exception;

trait Factory
{
    public static function create( string $className):static
    {
        $classFullName = (static::class)."\\".$className;
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

