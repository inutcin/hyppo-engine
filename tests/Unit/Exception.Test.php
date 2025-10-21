<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Inutcin\HyppoEngine as HyppoEngine;

class Exception extends TestCase
{
    /**
     */
    public function test_create()
    {
        $obj = HyppoEngine\Exception::create("RenderNotExists");
        $this->assertTrue($obj instanceof HyppoEngine\Exception);
    }

}
