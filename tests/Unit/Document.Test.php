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
        $repository = HyppoEngine\Repository::create("File");
        $repository->path(realpath(dirname(__DIR__."/../Data/README.md")));
        $obj = HyppoEngine\Document::create("Article", $repository);
        $this->assertTrue($obj instanceof HyppoEngine\Document);
    }

}
