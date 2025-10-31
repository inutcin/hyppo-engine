<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Inutcin\HyppoEngine;

class Parser extends TestCase
{
    /**
     */
    public function test_create()
    {
        $obj = HyppoEngine\Parser::create("Markdown");
        $this->assertTrue($obj instanceof HyppoEngine\Parser);

        try{
            $obj = HyppoEngine\Parser::create("UnexpectedParser");
        }
        catch(\Throwable $e) {
            $this->assertTrue($e instanceof HyppoEngine\Exception\ParserNotExists);
            $this->assertEquals($e->getCode(), 5);
        }
    }

    public function test_parse()
    {
        $obj = HyppoEngine\Parser::create("Markdown");
       
    }

}


