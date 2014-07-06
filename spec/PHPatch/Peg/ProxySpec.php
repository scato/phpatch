<?php

namespace spec\PHPatch\Peg;

use PHPatch\Peg\Failure;
use PHPatch\Peg\Parser;
use PHPatch\Peg\Success;
use PHPatch\Peg\TokenIterator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ProxySpec extends ObjectBehavior
{
    function let(Parser $first)
    {
        $this->beConstructedWith($first);
    }

    function it_is_a_parser()
    {
        $this->shouldHaveType('PHPatch\Peg\Parser');
    }

    function it_should_succeed_if_the_sub_expression_succeeds(TokenIterator $iterator, Parser $first)
    {
        $first->parse($iterator)->willReturn(new Success(array('!')));

        $this->parse($iterator)->shouldBeLike(new Success(array('!')));
    }

    function it_should_fail_if_the_sub_expression_fails(TokenIterator $iterator, Parser $first)
    {
        $first->parse($iterator)->willReturn(new Failure());

        $this->parse($iterator)->shouldBeLike(new Failure());
    }
}
