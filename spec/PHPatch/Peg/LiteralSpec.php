<?php

namespace spec\PHPatch\Peg;

use PHPatch\Peg\Failure;
use PHPatch\Peg\Success;
use PHPatch\Peg\TokenIterator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LiteralSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('test');
    }

    function it_is_a_parser()
    {
        $this->shouldHaveType('PHPatch\Peg\Parser');
    }

    function it_matches_an_array_token_with_the_same_string(TokenIterator $iterator)
    {
        $token = array(T_STRING, 'test', 1);

        $iterator->next()->shouldBeCalled()->willReturn($token);

        $this->parse($iterator)->shouldBeLike(new Success(array($token)));
    }

    function it_matches_a_string_token_with_the_same_string(TokenIterator $iterator)
    {
        $token = 'test';

        $iterator->next()->shouldBeCalled()->willReturn($token);

        $this->parse($iterator)->shouldBeLike(new Success(array($token)));
    }

    function it_does_not_match_a_token_with_a_different_string(TokenIterator $iterator)
    {
        $token = array(T_ECHO, 'echo', 1);

        $iterator->next()->shouldBeCalled()->willReturn($token);

        $this->parse($iterator)->shouldBeLike(new Failure());
    }
}
