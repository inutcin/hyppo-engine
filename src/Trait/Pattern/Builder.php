<?php
namespace Inutcin\HyppoEngine\Trait\Pattern;

trait Builder 
{
    public function build(string $attribute, mixed $value): static 
    {
        $this->buildParts[$attribute] = $value;
        return $this;
    }

    public function extract(string $attribute): mixed 
    {
        return $this->buildParts[$attribute]; 
    }

}



