<?php

namespace PHPatch\Peg;

class NotPredicate implements Parser
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

        if ($result instanceof Failure) {
            $iterator->rewind($start);

            $result = new Success(array());
        } else {
            $result = new Failure();
        }

        return $result;
    }
}
