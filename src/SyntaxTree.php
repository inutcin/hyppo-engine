<?php
declare(strict_types=1);

namespace Inutcin\HyppoEngine;
use Inutcin\HyppoEngine\Exception\FileNotFound;
use Inutcin\HyppoEngine\Repository\File;

/**
 * Абстрактный класс репозитория.
 *
 * Определяет общий интерфейс для работы с хранилищами документов.
 * Поддерживает фабричный метод и паттерн Repository.
 */
abstract class SyntaxTree 
{
    // Этот класс реализует паттерн Factory
    use Trait\Pattern\Factory;
    // Этот класс реализует паттерн Builder
    use Trait\Pattern\Builder;
    // Язык документа, для которого строитс синтексиеское дерево
    protected string $language;
    // Правила для синтаксического дерева
    protected array $rules = ["nonterms"=>[], "terms"=>[]];

    /**
     * Имя класса по умолчанию для создания через фабрику.
     *
     * @var string
     */
    protected static string $createDefaultClassName = "Bnf";

    protected function addRule(string $type, string $key, array $variants): static
    {
        if(!isset($this->rules[$type][$key])) {
            $this->rules[$type][$key] = [];
        }
        $this->rules[$type][$key][] = $variants;
        return $this;
    }

    protected function loadRules(): static 
    {
        $fd = fopen($this->extract("languageRulesFilename"), "r");
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

    public function setLang(string $language): static
    {
        // Устанавливаем язык документа
        $this->build("language", $language = array_pop(explode("\\", $language)));
        $langBnfFilename = __DIR__ . "/SyntaxTree/Bnf/".$language. ".bnf";
        if(!file_exists($langBnfFilename)) {
            throw new FileNotFound("$langBnfFilename not fount");
        }
        // Устанавливаем имя файла с правилами для языка
        $this->build("languageRulesFilename", $langBnfFilename);
        $this->loadRules($this->extract("languageRulesFilename"));
        return $this;
    }

    abstract public function parse(string $content): DTO\SyntaxTree;
}


