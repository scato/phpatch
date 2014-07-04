<?php

namespace PHPatch\Peg;

class Literal implements Parser
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function parse(TokenIterator $iterator)
    {
        $token = $iterator->next();

        if (is_array($token) && $token[1] === $this->value) {
            return new Success(array($token));
        }

        if (is_string($token) && $token === $this->value) {
            return new Success(array($token));
        }

        return new Failure();
    }
}
