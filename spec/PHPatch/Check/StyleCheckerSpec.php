<?php

namespace spec\PHPatch\Check;

use PHPatch\Check\StyleError;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Config\FileLocatorInterface;

class StyleCheckerSpec extends ObjectBehavior
{
    const FILENAME = 'test.php';
    const LINE = 42;
    const CHAR = 5;
    const MESSAGE = 'You SHOULD do this';

    function let()
    {
        $this->beConstructedWith();
    }

    /*function it_finds_errors()
    {
        $this->findErrors(self::FILENAME)->shouldReturn(
            array(
                new StyleError(self::FILENAME, self::LINE, self::CHAR, self::MESSAGE)
            )
        );
    }*/
}
