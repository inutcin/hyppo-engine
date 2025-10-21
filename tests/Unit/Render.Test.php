<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Inutcin\HyppoEngine;

class Render extends TestCase
{
    /**
     */
    public function test_create()
    {
        $obj = HyppoEngine\Render::create("Html");
        $this->assertTrue($obj instanceof HyppoEngine\Render);

        try{
            $obj = HyppoEngine\Render::create("UnexpectedRehder");
        }
        catch(\Throwable $e) {
            $this->assertTrue($e instanceof HyppoEngine\Exception\RenderNotExists);
            $this->assertEquals($e->getCode(), 2);
        }
    }

}

