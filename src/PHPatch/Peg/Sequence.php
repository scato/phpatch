<?php

namespace PHPatch\Peg;

class Sequence implements Parser
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
        $result = $this->first->parse($iterator);

        if ($result instanceof Success) {
            $first = $result;

            $result = $this->second->parse($iterator);

            if ($result instanceof Success) {
                $result = $first->concat($result);
            }
        }

        return $result;
    }
}
