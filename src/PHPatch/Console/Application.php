<?php

namespace PHPatch\Console;

use PHPatch\Check\OpeningTagChecker;
use PHPatch\Fix\BracesFixer;
use Symfony\Component\Console\Application as BaseApplication;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Application extends BaseApplication
{
    const VERSION = '0.1';

    public function __construct(ContainerInterface $container)
    {
        parent::__construct('PHPatch', self::VERSION);

        $this->setupParameters($container);
        $this->setupServices($container);
        $this->setupCommands($container);
    }

    private function setupParameters(ContainerInterface $container)
    {
        //$container->setParameter();
    }

    private function setupServices(ContainerInterface $container)
    {
        $container->set('phpatch.check.opening_tag_checker', new OpeningTagChecker());
        $container->set('phpatch.fix.braces_fixer', new BracesFixer());
    }

    private function setupCommands(ContainerInterface $container)
    {
        $check = new CheckCommand('check');
        $check->setContainer($container);
        $this->add($check);

        $fixBraces = new FixBracesCommand('fix-braces');
        $fixBraces->setContainer($container);
        $this->add($fixBraces);
    }
}
