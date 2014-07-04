<?php

namespace spec\PHPatch\Peg;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FailureSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('PHPatch\Peg\Failure');
    }
}
