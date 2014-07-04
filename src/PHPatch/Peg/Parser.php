<?php

namespace PHPatch\Peg;

interface Parser
{
    public function parse(TokenIterator $iterator);
} 
