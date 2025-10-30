<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Inutcin\HyppoEngine as HyppoEngine;

class Repository extends TestCase
{
    public function test_create()
    {
        // Создаём репозиторий типа файл
        $repository = HyppoEngine\Repository::create();
        // Убеждаемся что создан объект нужного класса
        $this->assertContainsOnlyInstancesOf(HyppoEngine\Repository::class, [$repository]);
    }

}

