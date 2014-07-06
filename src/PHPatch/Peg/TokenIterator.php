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
        if ($this->pos >= count($this->tokens)) {
            return null;
        }

        return $this->tokens[$this->pos++];
    }

    public function rewind($pos)
    {
        $this->pos = $pos;
    }

    public function pos()
    {
        return $this->pos;
    }
}
