<?php
namespace Inutcin\HyppoEngine\Parser;

use Inutcin\HyppoEngine\Parser as AbstractParser;

class Bnf extends AbstractParser
{
    public function addRule(string $type, string $key, array $variants): static
    {
        if(!isset($this->rules[$type][$key])) {
            $this->rules[$type][$key] = [];
        }
        $this->rules[$type][$key][] = $variants;
        return $this;
    }

    public function loadRules(string $rulesFilename): static 
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
