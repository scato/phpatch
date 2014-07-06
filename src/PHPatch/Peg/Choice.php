<?php

namespace PHPatch\Peg;

class Choice implements Parser
{
    private $first;
    private $second;

    public function __construct(Parser $first, Parser $second)
    {
        $this->first = $first;
        $this->second = $second;
    }

    public function parse(TokenIterator $iterator)
    {
        $start = $iterator->pos();
        $result = $this->first->parse($iterator);

        if ($result instanceof Failure) {
            $iterator->rewind($start);

            $result = $this->second->parse($iterator);
        }

        return $result;
    }
}
