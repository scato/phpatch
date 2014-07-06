<?php

namespace spec\PHPatch\Peg;

use PHPatch\Peg\Failure;
use PHPatch\Peg\Parser;
use PHPatch\Peg\Success;
use PHPatch\Peg\TokenIterator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SequenceSpec extends ObjectBehavior
{
    function let(Parser $first, Parser $second)
    {
        $this->beConstructedWith($first, $second);
    }

    function it_is_a_parser()
    {
        $this->shouldHaveType('PHPatch\Peg\Parser');
    }

    function it_should_fail_if_the_left_part_fails(TokenIterator $iterator, Parser $first, Parser $second)
    {
        $first->parse($iterator)->willReturn(new Failure());

        $this->parse($iterator)->shouldBeLike(new Failure());
    }

    function it_should_fail_if_the_right_part_fails(TokenIterator $iterator, Parser $first, Parser $second)
    {
        $token1 = '!';

        $first->parse($iterator)->willReturn(new Success(array($token1)));
        $second->parse($iterator)->willReturn(new Failure());

        $this->parse($iterator)->shouldBeLike(new Failure());
    }

    function it_should_concatenate_the_results_if_both_parts_succeed(TokenIterator $iterator, Parser $first, Parser $second)
    {
        $token1 = '!';
        $token2 = array(T_VARIABLE, '$a', 1);

        $first->parse($iterator)->willReturn(new Success(array($token1)));
        $second->parse($iterator)->willReturn(new Success(array($token2)));

        $this->parse($iterator)->shouldBeLike(new Success(array($token1, $token2)));
    }
}
