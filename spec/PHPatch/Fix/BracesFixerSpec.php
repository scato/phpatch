<?php

namespace spec\PHPatch\Fix;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BracesFixerSpec extends ObjectBehavior
{
    function it_should_fix_opening_braces_for_classes()
    {
        $this->fixErrors(<<<EOS
<?php

class A {
}
EOS
        )->shouldReturn(<<<EOS
<?php

class A
{
}
EOS
        );
    }
}
