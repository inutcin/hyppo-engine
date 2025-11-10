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
        $content = file_get_contents($this->getFilename($primaryKey));
        $stat = stat($this->getFilename($primaryKey));
        $dto
            ->set("content", $content)
            ->set("ctime",  $stat["ctime"])
            ->set("mtime",  $stat["mtime"])
            ->set("atime",  $stat["atime"])
            ->set("mode",   $stat["mode"])
            ->set("group",  $stat["gid"])
            ->set("owner",  $stat["uid"])
            ->set("size",   $stat["size"])
        ;
        return $dto;
    }

    private function getFilename(string $primaryKey):string
    {
        $filename =  $this->path().$primaryKey;
        if(!file_exists($filename)) {
            throw Exception::create("FileNotFound");
        }
        // Если имя файла выходит за пределы пути репозитория
        // (после попыски заменить path на пустоту остался прежним)
        $path = $this->path();
        $realPath = realpath($path);
        $realFilenamePath = realpath($filename);
        $strReplaced = str_replace($path, "", $realFilenamePath);
        if($strReplaced === $realPath){
            throw Exception::create("AccessDenied");
        }

        return $filename;
    }

}


