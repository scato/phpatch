<?php

namespace PHPatch\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class FixBracesCommand extends Command
{
    use ContainerAwareTrait;

    protected function configure()
    {
        $this->addArgument('filename', InputArgument::REQUIRED);
    }

    /**
     * {@inheritDoc}
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $fixer = $this->container->get('phpatch.fix.braces_fixer');
        $filename = $input->getArgument('filename');
        $contents = file_get_contents($filename);

        $contents = $fixer->fixErrors($contents);

        file_put_contents($filename, $contents);
    }
} 
