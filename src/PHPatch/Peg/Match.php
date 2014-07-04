<?php

namespace PHPatch\Peg;

class Match implements Parser
{
    private $pattern;

    public function __construct($expr)
    {
        $this->pattern = '/' . $expr . '/';
    }

    public function parse(TokenIterator $iterator)
    {
        $token = $iterator->next();

        if (is_array($token) && preg_match($this->pattern, $token[1])) {
            return new Success(array($token));
        }

        if (is_string($token) && preg_match($this->pattern, $token)) {
            return new Success(array($token));
        }

        return new Failure();
    }
}
