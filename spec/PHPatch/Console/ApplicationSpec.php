<?php

namespace spec\PHPatch\Console;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ApplicationSpec extends ObjectBehavior
{
    function let(ContainerInterface $container)
    {
        $this->beConstructedWith($container);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('PHPatch\Console\Application');
    }

    function it_should_have_a_check_command()
    {
        $this->get('check')->shouldBeAnInstanceOf('PHPatch\Console\CheckCommand');
    }
}
