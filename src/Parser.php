<?php

declare(strict_types=1);

namespace Inutcin\HyppoEngine;

use Inutcin\HyppoEngine\Exception;

/**
 * Абстрактный класс парсера.
 *
 * Определяет общий интерфейс для парсеров документов.
 * Использует фабричный метод для создания экземпляров конкретных парсеров.
 */
abstract class Parser 
{
    // Этот класс реализует паттерн Factory
    use Trait\Pattern\Factory;

    /**
     * Имя класса по умолчанию для создания через фабрику.
     *
     * @var string
     */
    protected static string $createDefaultClassName = "Markdown";

    // Правила для синтаксического дерева
    protected array $rules = ["nonterms"=>[], "terms"=>[]];

    /**
     * Преобразует узел репозитория в DTO документа.
     *
     * Метод должен быть реализован в дочерних классах.
     *
     * @param DTO\RepositoryNode $repositoryNode Узел репозитория, который нужно распарсить
     * @return DTO\Document - синтаксическое дерево разбора документа
     */
    public function parse(
        DTO\RepositoryNode $repositoryNode, 
        Parser $parser = null 
        string|null $language = null
    ): SyntaxTree
    {
        // Устанавливаем язык документа
        $language = $language ?? static::class;
        $path = explode("\\", $language);
        $language = array_pop($path);
        // Устанавливаем имя парсера 
        $parserName = 'Bnf'; // FIXME dinamic name of parser
        $langBnfFilename = __DIR__ . "/Parser/$parserName/".$language. ".bnf";
        if(!file_exists($langBnfFilename)) {
            throw new Exception::create("Parser\$parserName\BnfNotExists", "$langBnfFilename not exists"));
        }
        $this->loadRules($langBnfFilename);
        // Получаем контент из репозитория
        $content = $repositoryNode->get("content");
        
        return new SyntaxTree;
    }    

    abstract public function addRule(string $type, string $key, array $variants): static;
    abstract public function loadRules(string $rulesFilename): static ;
}
