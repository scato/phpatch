<?php

namespace spec\PHPatch\Peg;

use PHPatch\Peg\Success;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SuccessSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(array('test'));
    }

    function it_has_a_value()
    {
        $this->getValue()->shouldReturn(array('test'));
    }

    function it_can_concat_other_values(Success $success)
    {
        $success->getValue()->willReturn(array('!'));

        $this->concat($success)->getValue()->shouldReturn(array('test', '!'));
    }
}
