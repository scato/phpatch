<?php

namespace PHPatch\Peg;

class Proxy implements Parser
{
    private $first;

    public function __construct(Parser $first)
    {
        $this->first = $first;
    }

    public function parse(TokenIterator $iterator)
    {
        return $this->first->parse($iterator);
    }
}
