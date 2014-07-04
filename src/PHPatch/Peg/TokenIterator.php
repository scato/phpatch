<?php

namespace PHPatch\Peg;

class TokenIterator
{
    private $pos;
    private $tokens;

    public function __construct($string)
    {
        $this->pos = 0;
        $this->tokens = token_get_all($string);
    }

    public function next()
    {
        if ($this->eos()) {
            return null;
        }

        return $this->tokens[$this->pos++];
    }

    public function peek()
    {
        if ($this->eos()) {
            return null;
        }

        return $this->tokens[$this->pos];
    }

    private function eos()
    {
        return $this->pos >= count($this->tokens);
    }
}
