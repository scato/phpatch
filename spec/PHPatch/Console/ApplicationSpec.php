<?php

namespace spec\PHPatch\Console;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ApplicationSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('PHPatch\Console\Application');
    }

    function it_should_have_a_check_command()
    {
        $this->get('check')->shouldBeAnInstanceOf('PHPatch\Console\CheckCommand');
    }
}
