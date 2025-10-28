<?php
namespace Inutcin\HyppoEngine\Trait\Pattern;

trait DTO 
{
    public function get(string $key): mixed {
        return $this->$key ?? null;
    }

    public function set(string $key, mixed $value): static 
    {
        $this->$key = $value;
        return $this;
    }

}



