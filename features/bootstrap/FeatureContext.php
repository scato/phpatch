<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

//
// Require 3rd-party libraries here:
//
//   require_once 'PHPUnit/Autoload.php';
//   require_once 'PHPUnit/Framework/Assert/Functions.php';
//
require_once 'ApplicationContext.php';
require_once 'WorkDirContext.php';

/**
 * Features context.
 */
class FeatureContext extends BehatContext
{
    use ApplicationContext;
    use WorkDirContext;

    protected function createApplication()
    {
        $parameterBag = new \Symfony\Component\DependencyInjection\ParameterBag\ParameterBag();
        $container = new \Symfony\Component\DependencyInjection\Container($parameterBag);

        return new \PHPatch\Console\Application($container);
    }

    /**
     * Initializes context.
     * Every scenario gets it's own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
        // Initialize your context here
    }

    /**
     * @Given /^I have a file containing "([^"]*)"$/
     */
    public function iHaveAFileContaining($contents)
    {
        $this->filename = tempnam('.', 'phpatch');

        file_put_contents($this->filename, $contents);
    }

    /**
     * @Given /^I have a file containing:$/
     */
    public function iHaveAFileContaining2(PyStringNode $string)
    {
        $this->filename = tempnam('.', 'phpatch');

        file_put_contents($this->filename, $string->getRaw());
    }

    /**
     * @Then /^My file should contain:$/
     */
    public function myFileShouldContain(PyStringNode $string)
    {
        assertSame($string->getRaw(), file_get_contents($this->filename));
    }
}
