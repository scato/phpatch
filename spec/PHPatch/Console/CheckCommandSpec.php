<?php

namespace spec\PHPatch\Console;

use PHPatch\Check\StyleChecker;
use PHPatch\Check\StyleError;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\Container;

class CheckCommandSpec extends ObjectBehavior
{
    function let(Container $container, StyleChecker $checker)
    {
        $this->beConstructedWith('check');

        $container->get('phpatch.check.style_checker')->willReturn($checker);

        $this->setContainer($container);
    }

    function it_should_report_success(StyleChecker $checker, InputInterface $input, OutputInterface $output)
    {
        $checker->findErrors('test.php')->willReturn(array());
        $input->bind(Argument::type('Symfony\Component\Console\Input\InputDefinition'))->willReturn();
        $input->isInteractive()->willReturn(false);
        $input->validate()->willReturn(true);
        $input->getArgument('filename')->willReturn('test.php');

        $output->writeln('No errors')->shouldBeCalled();

        $this->run($input, $output);
    }

    function it_should_report_failure(StyleChecker $checker, InputInterface $input, OutputInterface $output)
    {
        $checker->findErrors('test.php')->willReturn(array(new StyleError('You SHOULD do this', 0, 0)));
        $input->bind(Argument::type('Symfony\Component\Console\Input\InputDefinition'))->willReturn();
        $input->isInteractive()->willReturn(false);
        $input->validate()->willReturn(true);
        $input->getArgument('filename')->willReturn('test.php');

        $output->writeln('You SHOULD do this')->shouldBeCalled();

        $this->run($input, $output);
    }
}
