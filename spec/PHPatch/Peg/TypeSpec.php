<?php

namespace spec\PHPatch\Peg;

use PHPatch\Peg\Failure;
use PHPatch\Peg\Success;
use PHPatch\Peg\TokenIterator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TypeSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(T_STRING);
    }

    function it_is_a_parser()
    {
        $this->shouldHaveType('PHPatch\Peg\Parser');
    }

    function it_matches_an_array_token_with_the_same_type(TokenIterator $iterator)
    {
        $token = array(T_STRING, 'test', 1);

        $iterator->next()->shouldBeCalled()->willReturn($token);

        $this->parse($iterator)->shouldBeLike(new Success(array($token)));
    }

    function it_does_not_match_a_string_token(TokenIterator $iterator)
    {
        $token = 'test';

        $iterator->next()->shouldBeCalled()->willReturn($token);

        $this->parse($iterator)->shouldBeLike(new Failure($token));
    }

    function it_does_not_match_a_token_with_a_different_type(TokenIterator $iterator)
    {
        $token = array(T_ECHO, 'echo', 1);

        $iterator->next()->shouldBeCalled()->willReturn($token);

        $this->parse($iterator)->shouldBeLike(new Failure());
    }
}
