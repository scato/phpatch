<?php

namespace spec\PHPatch\Peg;

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
}
