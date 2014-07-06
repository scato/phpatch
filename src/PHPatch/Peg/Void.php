<?php

namespace PHPatch\Peg;

class Void implements Parser
{
    public function parse(TokenIterator $iterator)
    {
        return new Success(array());
    }
}
