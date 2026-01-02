<?php
declare(strict_types=1);

namespace Inutcin\HyppoEngine\SyntaxTree;
use Inutcin\HyppoEngine\SyntaxTree as AbstractSyntaxTree;
use Inutcin\HyppoEngine\DTO;

class Bnf extends AbstractSyntaxTree 
{
    public function parse(string $content): DTO\SyntaxTree
    {
        return new DTO\SyntaxTree;
    }
}


