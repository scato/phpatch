<?php

namespace PHPatch\Console;

use Symfony\Component\Console\Application as BaseApplication;

class Application extends BaseApplication
{
    const VERSION = '0.1';

    public function __construct()
    {
        parent::__construct('PHPatch', self::VERSION);
        $this->add(new CheckCommand('check'));
    }
}
