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

    public function test_path()
    {
        // Создаём репозиторий типа файл
        $repository = HyppoEngine\Repository::create();
        $repository->path(Document::PATH);
        $this->assertEquals($repository->path(), Document::PATH);
    }

    public function test_getByPrimaryKey()
    {
        // Создаём репозиторий типа файл
        $repository = HyppoEngine\Repository::create();
        $repositoryNode = $repository->path(Document::PATH)->getByPrimaryKey("/README.md");
        // Убеждаемся что получили объект нужного класса
        $this->assertContainsOnlyInstancesOf(HyppoEngine\DTO\RepositoryNode::class, [$repositoryNode]);

    }

}

