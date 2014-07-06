<?php

namespace PHPatch\Peg;

class Success
{
    private $value;

    public function __construct(array $value)
    {
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function concat(Success $success)
    {
        return new Success(array_merge($this->getValue(), $success->getValue()));
    }
}
