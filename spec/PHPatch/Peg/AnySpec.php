<?php

namespace spec\PHPatch\Peg;

use PHPatch\Peg\Failure;
use PHPatch\Peg\Parser;
use PHPatch\Peg\Success;
use PHPatch\Peg\TokenIterator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AnySpec extends ObjectBehavior
{
    function let(Parser $first)
    {
        $this->beConstructedWith($first);
    }

    function it_is_a_parser()
    {
        $this->shouldHaveType('PHPatch\Peg\Parser');
    }

    function it_should_always_succeed(TokenIterator $iterator, Parser $first)
    {
        $first->parse($iterator)->willReturn(new Failure());

        $this->parse($iterator)->shouldBeLike(new Success(array()));
    }

    function it_should_match_one_token(TokenIterator $iterator, Parser $first)
    {
        $token = '!';

        $first->parse($iterator)->will(function () use ($iterator, $first, $token) {
            $first->parse($iterator)->willReturn(new Failure());

            return new Success(array($token));
        });

        $this->parse($iterator)->shouldBeLike(new Success(array($token)));
    }

    function it_should_match_and_concatenate_more_tokens(TokenIterator $iterator, Parser $first)
    {
        $token1 = '!';
        $token2 = array(T_VARIABLE, '$a', 1);


        $first->parse($iterator)->will(function () use ($iterator, $first, $token1, $token2) {
            $first->parse($iterator)->will(function () use ($iterator, $first, $token2) {
                $first->parse($iterator)->willReturn(new Failure());

                return new Success(array($token2));
            });

            return new Success(array($token1));
        });

        $this->parse($iterator)->shouldBeLike(new Success(array($token1, $token2)));
    }

    function it_should_not_consume_more_that_it_matches(TokenIterator $iterator, Parser $first)
    {
        $token = '!';

        $iterator->pos()->willReturn(0);
        $first->parse($iterator)->will(function () use ($iterator, $first, $token) {
            $iterator->pos()->willReturn(1);
            $first->parse($iterator)->willReturn(new Failure());

            return new Success(array($token));
        });

        $iterator->rewind(1)->shouldBeCalled();
        $this->parse($iterator)->shouldBeLike(new Success(array($token)));
    }
}
