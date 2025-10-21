<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Inutcin\HyppoEngine as HyppoEngine;

class Document extends TestCase
{
    /**
     */
    public function test_create()
    {
        $obj = HyppoEngine\Document::create("Article");
        $this->assertTrue($obj instanceof HyppoEngine\Document);
    }

}
