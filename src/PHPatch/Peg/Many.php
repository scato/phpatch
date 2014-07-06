<?php

namespace PHPatch\Peg;

class Many extends Proxy
{
    public function __construct(Parser $first)
    {
        parent::__construct(new Sequence($first, new Any($first)));
    }
}
