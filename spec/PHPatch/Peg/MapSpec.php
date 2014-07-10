<?php

namespace spec\PHPatch\Peg;

use PHPatch\Peg\Failure;
use PHPatch\Peg\Parser;
use PHPatch\Peg\Success;
use PHPatch\Peg\TokenIterator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MapSpec extends ObjectBehavior
{
    function let(Parser $first, Parser $second, Parser $third)
    {
        $this->beConstructedWith(array(
            $first,
            'key' => $second,
            'value' => $third
        ), '"{$key[0]}: {$value[0]}"');
    }

    function it_is_a_parser()
    {
        $this->shouldHaveType('PHPatch\Peg\Parser');
    }

    function it_should_fail_if_any_of_its_parts_fail(TokenIterator $iterator, Parser $first, Parser $second, Parser $third)
    {
        $first->parse($iterator)->willReturn(new Failure());

        $this->parse($iterator)->shouldBeLike(new Failure());
    }

    function it_should_evaluate_the_expression_if_all_parts_succeed(TokenIterator $iterator, Parser $first, Parser $second, Parser $third)
    {
        $first->parse($iterator)->willReturn(new Success(array('foo')));
        $second->parse($iterator)->willReturn(new Success(array('bar')));
        $third->parse($iterator)->willReturn(new Success(array('ber')));

        $this->parse($iterator)->shouldBeLike(new Success(array('bar: ber')));
    }
}
