<?php
namespace Inutcin\HyppoEngine\DTO;

use Inutcin\HyppoEngine\DTO as AbstractDTO;

class Document extends AbstractDTO
{
    protected ?string $title = null;
    protected ?Document\Author $author = null;
    protected ?array $blocks;
}


