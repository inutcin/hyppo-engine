<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Inutcin\HyppoEngine as HyppoEngine;

class Document extends TestCase
{
    protected static string $documentType = "Article";

    protected static string $path = __DIR__."/../Data";
    protected static string $item = "/README.md";

    public function test_create()
    {
        // Создаём репозиторий
        $repository = HyppoEngine\Repository::create();
        // Создаём объект документа
        $document = HyppoEngine\Document::create(static::$documentType, $repository);
        // Проверяем, что объект является экземпляром класса
        $this->assertContainsOnlyInstancesOf(HyppoEngine\Document::class, [$document]);
    }

    public function test_load()
    {
        // Создаём репозиторий
        $repository = HyppoEngine\Repository::create()
            ->path(realpath(static::$path))
        ;
        // Создаём парсер для загрузки
        $parser = HyppoEngine\Parser::create();

        // Создаём объект документа
        $document = HyppoEngine\Document::create(static::$documentType, $repository);
        // Загружаем в документ содержимое из репозитория
        $object = $document->parser($parser)->load(static::$item);
        // Проверяем, что объект является экземпляром класса
        $this->assertContainsOnlyInstancesOf(HyppoEngine\Document::class, [$object]);
    }

    public function test_getDTO()
    {
        // Создаём объект документа, определяем для него репозиторий, парсер
        // закружаем содержимое и возвращаем в виде объекта
        $dto = 
            HyppoEngine\Document::create(
                static::$documentType,
                HyppoEngine\Repository::create()->path(realpath(static::$path))
            )->parser(
                HyppoEngine\Parser::create()
            )->load(
                static::$item
            )->getDTO(

            )
        ;
        // Проерем что объект получился нужного класса
        $this->assertContainsOnlyInstancesOf(HyppoEngine\DTO\Document::class, [$dto]);
    }

}
