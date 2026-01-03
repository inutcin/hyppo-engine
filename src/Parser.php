<?php

declare(strict_types=1);

namespace Inutcin\HyppoEngine;

use Inutcin\HyppoEngine\Exception\FileNotFound;

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
    public function parse(DTO\RepositoryNode $repositoryNode, ?string $language = null ): SyntaxTree
    {
        // Устанавливаем язык документа
        $language = $language ?? static::class;
        $path = explode("\\", $language);
        $language = array_pop($path);
        $langBnfFilename = __DIR__ . "/Parser/Bnf/".$language. ".bnf";
        if(!file_exists($langBnfFilename)) {
            throw new FileNotFound("$langBnfFilename not fount");
        }
        $this->loadRules($langBnfFilename);
        // Получаем контент из репозитория
        $content = $repositoryNode->get("content");
        
        return new SyntaxTree;
    }    

    protected function addRule(string $type, string $key, array $variants): static
    {
        if(!isset($this->rules[$type][$key])) {
            $this->rules[$type][$key] = [];
        }
        $this->rules[$type][$key][] = $variants;
        return $this;
    }

    protected function loadRules(string $rulesFilename): static 
    {
        $fd = fopen($rulesFilename, "r");
        while(!feof($fd)) {
            $line = (string)fgets($fd);
            $line = trim($line);
            // Если строка - правило и содержит только нетерминалы
            if(preg_match("#^<([\w\d]+)>\s*::=\s*(<[\w\d><]+>)$#i", $line, $matches)) {
                $key = $matches[1];
                $nonTerminals = $matches[2];
                if(!preg_match_all("#<([\w\d]+)>#", $nonTerminals, $matches)) {
                    continue;
                } 
                $this->addRule("nonterms", $key, $matches[1]);
            }
            // Если строка - правило и содержит только терминалы
            elseif(preg_match("#^<([\w\d]+)>\s*::=\s*/(.*)/$#", $line, $matches)) {
                $key = $matches[1];
                $terminal = $matches[2];
                $this->addRule("terms", $key, [$terminal]);
             }
            // Если строка не является правилом - пропускаем
            else {
                continue;
            }
        }
        fclose($fd);
        return $this;
    }


}
