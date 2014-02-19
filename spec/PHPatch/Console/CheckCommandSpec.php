<?php

namespace spec\PHPatch\Console;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CheckCommandSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('check');
    }

    function it_should_report_success(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('No errors')->shouldBeCalled();

        $this->run($input, $output);
    }
}
