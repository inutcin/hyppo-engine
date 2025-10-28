<?php
namespace Inutcin\HyppoEngine\Trait;

trait Attribute 
{
    protected function attributeAccess(
        string $attribute, 
        mixed $value
    ):mixed
    {
        if(is_null($value)) {
            return $this->$attribute;   
        }
        $this->$attribute = $value;
        return $this;
    }
}
