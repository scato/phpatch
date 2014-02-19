<?php

namespace spec\PHPatch\Console;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CheckCommandSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('PHPatch\Console\CheckCommand');
    }
}
