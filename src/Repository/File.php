<?php
namespace Inutcin\HyppoEngine\Repository;

use Inutcin\HyppoEngine\Repository as AbstractRepository;
use Inutcin\HyppoEngine\DTO;
use Inutcin\HyppoEngine\Exception;

class File extends AbstractRepository
{
    protected ?string $protocol = "file";
    protected ?string $host = "";

    public function getByPrimaryKey(?string $primaryKey): DTO
    {
        $dto = new DTO\RepositoryNode;
        return $dto;
    }

    private function getFilename(string $primaryKey):string
    {
        $filename =  $this->path().$primaryKey;
        // Если имя файла выходит за пределы пути репозитория
        // (после попыски заменить path на пустоту остался прежним)
        if(str_replace($this->path(), "", realpath($filename)) === realpath($filename)){
            throw Exception::create("AccessDenied");
        }

        return $filename;
    }

}


