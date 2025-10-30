<?php
namespace Inutcin\HyppoEngine;

abstract class Parser 
{
    use Trait\Pattern\Factory;

    // Создаваемый по умолчанию класс для фабричного метода
    protected static string $createDefaultClassName = "Markdown";


    public function parse(DTO\RepositoryNode $content):DTO\Document
    {
        return new DTO\Document;
    }
}


