<?php
namespace Inutcin\HyppoEngine;

abstract class Exception extends \Exception
{
    use Trait\Pattern\Factory;

    protected $message = "";
    protected $code = 0;

    public function __construct(string $message = null, int $code = null)
    {
        $this->message = $message ?? static::class." exception";
        $this->code = $code ?? $this->code;
    }
}
