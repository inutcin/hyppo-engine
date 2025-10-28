<?php
namespace Inutcin\HyppoEngine\Trait\Pattern;

use Inutcin\HyppoEngine\Trait\Attribute;

trait Repository 
{

    use Attribute;

    protected ?string $protocol = null;
    protected ?string $username = null;
    protected ?string $password = null;
    protected ?string $host = null;
    protected ?string $path = null; 

    public function protocol(?string $value = null):string|static
    {
        return (string)$this->attributeAccess("protocol", $value);
    } 

    public function username(?string $value = null):string|static
    {
        return $this->attributeAccess("username", $value);
    } 

    public function password(?string $value = null):string|static
    {
        return $this->attributeAccess("password", $value);
    } 

    public function host(?string $value = null):string|static
    {
        return $this->attributeAccess("host", $value);
    } 

    public function path(?string $value = null):string|static
    {
        return $this->attributeAccess("path", $value);
    } 
}


