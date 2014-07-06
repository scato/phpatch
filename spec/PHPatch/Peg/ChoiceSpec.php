<?php

namespace spec\PHPatch\Peg;

use PHPatch\Peg\Failure;
use PHPatch\Peg\Parser;
use PHPatch\Peg\Success;
use PHPatch\Peg\TokenIterator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ChoiceSpec extends ObjectBehavior
{
    function let(Parser $first, Parser $second)
    {
        $this->beConstructedWith($first, $second);
    }

    function it_is_a_parser()
    {
        $this->shouldHaveType('PHPatch\Peg\Parser');
    }

    function it_should_succeed_if_the_first_part_succeeds(TokenIterator $iterator, Parser $first, Parser $second)
    {
        $token = '!';

        $first->parse($iterator)->willReturn(new Success(array($token)));

        $this->parse($iterator)->shouldBeLike(new Success(array($token)));
    }

    function it_should_succeed_if_the_second_part_succeeds(TokenIterator $iterator, Parser $first, Parser $second)
    {
        $token = array(T_VARIABLE, '$a', 1);

        $iterator->pos()->willReturn(42);

        $first->parse($iterator)->will(function () use ($iterator) {
            $iterator->pos()->willReturn(43);

            return new Failure();
        });

        $iterator->rewind(42)->will(function () use ($iterator, $second, $token) {
            $second->parse($iterator)->willReturn(new Success(array($token)));
        });

        $this->parse($iterator)->shouldBeLike(new Success(array($token)));
    }

    function it_should_fail_if_both_parts_fail(TokenIterator $iterator, Parser $first, Parser $second)
    {
        $first->parse($iterator)->willReturn(new Failure());
        $second->parse($iterator)->willReturn(new Failure());

        $this->parse($iterator)->shouldBeLike(new Failure());
    }
}
