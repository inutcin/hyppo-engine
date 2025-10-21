<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Inutcin\HyppoEngine as HyppoEngine;

class Exception extends TestCase
{
    /**
     */
    public function test_construct()
    {
        $obj = new HyppoEngine\Exception;
        $this->assertEquals($obj::class, "Inutcin\HyppoEngine\Exception");
    }

}
