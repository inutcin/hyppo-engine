<?php
namespace Tests\Unit\Parser;

use PHPUnit\Framework\TestCase;
use Inutcin\HyppoEngine;
use Tests\Unit\Document;

class Markdown extends TestCase
{
    /**
     */
    public function test_create()
    {
        // Создаём парсер Markdown
        $obj = HyppoEngine\Parser::create("Markdown");
        // Убеждаемся, что создан объект класса Parser
        $this->assertTrue($obj instanceof HyppoEngine\Parser);

        // Пытаемся создать парсер несущесвующего типа
        try{
            $obj = HyppoEngine\Parser::create("UnexpectedParser");
        }
        catch(\Throwable $e) {
            // Убеждаемся, что выброшено исключение ParserNotExists
            $this->assertTrue($e instanceof HyppoEngine\Exception\ParserNotExists);
            // Убеждаемся, что код исключения равен 5
            $this->assertEquals($e->getCode(), 5);
        }
    }

    public function test_parse()
    {
        // Создаём репозиторий, так как тип репозитория не указан по умолчанию
        // будет использован тип "File"
        $repository = HyppoEngine\Repository::create();
        // Задаём путь к корню репозитория
        $repository->path(Document::PATH);
    
        // Получаем узел репозитория по первичному ключу (в данном случае по 
        // пути к файлу, относительно корня репозитория)
        $repositoryNode = $repository->getByPrimaryKey("/README.md");
        // Убеждаемся что получили объект нужного класса
        $this->assertContainsOnlyInstancesOf(HyppoEngine\DTO\RepositoryNode::class, [$repositoryNode]);
        
        // Создаём объект парсера Markdown
        $markdownParser = HyppoEngine\Parser::create("Markdown");

        // Парсим документ Markdown и получаем объект структуры документа 
        $documentDTO = $markdownParser->parse($repositoryNode);
        // Убеждаемся, что получили объект нужного класса (DTO документ)
        $this->assertContainsOnlyInstancesOf(HyppoEngine\DTO\Document::class, [$documentDTO]);

        // Убеждаемся, что в документе есть заголовок
        $this->assertEquals(trim($documentDTO->get("Title")), "Тестовые данные");
        
    }

}


