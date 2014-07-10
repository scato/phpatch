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

    public function createString()
    {
        $string = '';

        foreach ($this->value as $token) {
            if (is_array($token)) {
                $string .= $token[1];
            } else {
                $string .= $token;
            }
        }

        return $string;
    }
}
