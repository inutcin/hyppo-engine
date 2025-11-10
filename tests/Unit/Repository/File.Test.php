<?php

namespace Tests\Unit\Repository;

use PHPUnit\Framework\TestCase;
use Inutcin\HyppoEngine as HyppoEngine;

use Tests\Unit\Document;

class File extends TestCase
{
    public function test_construct()
    {
        // Создаём репозиторий типа файл
        $repository = HyppoEngine\Repository::create("file");
        // Убеждаемся что создан объект нужного класса
        $this->assertContainsOnlyInstancesOf(HyppoEngine\Repository\File::class, [$repository]);
    }

    public function test_getByPrimaryKey()
    {
        // Создаём репозиторий типа файл и задаём путь до него

        $repository = HyppoEngine\Repository::create("file")->path(
            Document::PATH
        );
       
        try {
            $repositoryNode = $repository->getByPrimaryKey("/Readme.md");
        }
        catch (\Throwable $e) {
            $this->assertContainsOnlyInstancesOf(HyppoEngine\Exception\FileNotFound::class, [$e]);
            $this->assertEquals($e->getCode(), 7);
        }

        $repositoryNode = $repository->getByPrimaryKey("/README.md");
        $this->assertEquals($repositoryNode->get("content"), "Тестовые данные\n===============\n");

    }

}


