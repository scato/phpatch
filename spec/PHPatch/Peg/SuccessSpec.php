<?php

namespace spec\PHPatch\Peg;

use PHPatch\Peg\Success;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SuccessSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(array('test', array(T_WHITESPACE, ' ', 1)));
    }

    function it_has_a_value()
    {
        $this->getValue()->shouldReturn(array('test', array(T_WHITESPACE, ' ', 1)));
    }

    function it_should_concat_other_values(Success $success)
    {
        $success->getValue()->willReturn(array('it'));

        $this->concat($success)->getValue()->shouldReturn(array('test', array(T_WHITESPACE, ' ', 1), 'it'));
    }

    function it_should_produce_a_string()
    {
        $this->createString()->shouldReturn('test ');
    }
}
