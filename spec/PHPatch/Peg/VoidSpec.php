<?php

namespace spec\PHPatch\Peg;

use PHPatch\Peg\Success;
use PHPatch\Peg\TokenIterator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class VoidSpec extends ObjectBehavior
{
    function it_is_a_parser()
    {
        $this->shouldHaveType('PHPatch\Peg\Parser');
    }

    function it_parses_anything_and_consumes_nothing(TokenIterator $iterator)
    {
        $this->parse($iterator)->shouldBeLike(new Success(array()));
    }
}
