<?php

namespace PHPatch\Peg;

class Type implements Parser
{
    private $type;

    public function __construct($type)
    {
        $this->type = $type;
    }

    public function parse(TokenIterator $iterator)
    {
        $token = $iterator->next();

        if ($token[0] === $this->type) {
            return new Success(array($token));
        }

        return new Failure();
    }
}
