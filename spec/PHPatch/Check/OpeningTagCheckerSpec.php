<?php

namespace spec\PHPatch\Check;

use PHPatch\Check\StyleError;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Config\FileLocatorInterface;

class OpeningTagCheckerSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith();
    }

    function it_should_be_a_style_checker()
    {
        $this->shouldHaveType('PHPatch\Check\StyleChecker');
    }

    function it_finds_short_tags()
    {
        $this->findErrors(<<<EOS
<?

echo 'test';

?>
EOS
        )->shouldBeLike(
            array(
                new StyleError('Use ONLY <?php and <?= tags', 1, 1)
            )
        );
    }
}
