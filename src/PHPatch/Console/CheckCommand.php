<?php

namespace PHPatch\Console;

use PHPatch\Check\StyleChecker;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class CheckCommand extends Command
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
        $checker = $this->container->get('phpatch.check.style_checker');
        $filename = $input->getArgument('filename');

        $errors = $checker->findErrors($filename);

        if (count($errors) === 0) {
            $output->writeln('No errors');

            return;
        }

        foreach ($errors as $error) {
            $output->writeln($error->getMessage());
        }
    }
}
