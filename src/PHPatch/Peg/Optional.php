<?php

namespace PHPatch\Peg;

class Optional extends Proxy
{
    public function __construct(Parser $first)
    {
        parent::__construct(new Choice($first, new Void()));
    }
}
