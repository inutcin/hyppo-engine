<?php
namespace Inutcin\HyppoEngine\DTO;

use Inutcin\HyppoEngine\DTO as AbstractDTO;

class RepositoryNode extends AbstractDTO
{
    protected ?int $ctime = null;
    protected ?int $mtime = null;
    protected ?int $owner = null;
    protected ?int $group = null;
    protected ?int $mode = null;
    protected ?int $atime = null;
    protected ?int $size = null;
    protected ?string $content = null;
}


