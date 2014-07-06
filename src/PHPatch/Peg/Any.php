<?php

namespace PHPatch\Peg;

class Any implements Parser
{
    private $first;

    public function __construct(Parser $first)
    {
        $this->first = $first;
    }

    public function parse(TokenIterator $iterator)
    {
        $result = new Success(array());

        while (true) {
            $previous = $result;
            $start = $iterator->pos();

            $result = $this->first->parse($iterator);

            if ($result instanceof Failure) {
                $result = $previous;
                $iterator->rewind($start);

                break;
            }

            $result = $previous->concat($result);
        }

        return $result;
    }
}
