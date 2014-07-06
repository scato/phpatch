<?php

namespace PHPatch\Peg;

class AndPredicate implements Parser
{
    private $first;

    public function __construct(Parser $first)
    {
        $this->first = $first;
    }

    public function parse(TokenIterator $iterator)
    {
        $start = $iterator->pos();

        $result = $this->first->parse($iterator);

        if ($result instanceof Success) {
            $iterator->rewind($start);

            $result = new Success(array());
        }

        return $result;
    }
}
