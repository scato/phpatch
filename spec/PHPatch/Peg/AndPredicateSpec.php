<?php

namespace spec\PHPatch\Peg;

use PHPatch\Peg\Failure;
use PHPatch\Peg\Parser;
use PHPatch\Peg\Success;
use PHPatch\Peg\TokenIterator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AndPredicateSpec extends ObjectBehavior
{
    function let(Parser $first)
    {
        $this->beConstructedWith($first);
    }

    function it_is_a_parser()
    {
        $this->shouldHaveType('PHPatch\Peg\Parser');
    }

    function it_should_succeed_if_the_sub_expression_succeeds_but_not_consume_anything(TokenIterator $iterator, Parser $first)
    {
        $iterator->pos()->willReturn(42);
        $first->parse($iterator)->willReturn(new Success(array('!')));

        $iterator->rewind(42)->shouldBeCalled();
        $this->parse($iterator)->shouldBeLike(new Success(array()));
    }

    function it_should_fail_if_the_sub_expression_fails(TokenIterator $iterator, Parser $first)
    {
        $first->parse($iterator)->willReturn(new Failure());

        $this->parse($iterator)->shouldBeLike(new Failure());
    }
}
