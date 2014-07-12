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

    private function substr()
    {
        $substr = '';

        for ($i = 0; $i < $this->pos - 1; $i++) {
            $token = $this->tokens[$i];

            if (is_array($token)) {
                $substr .= $token[1];
            } else {
                $substr .= $token;
            }
        }

        return $substr;
    }

    public function line()
    {
        $lines = explode("\n", $this->substr());

        return count($lines);
    }

    public function char()
    {
        $lines = explode("\n", $this->substr());

        return strlen(array_pop($lines)) + 1;
    }
}
