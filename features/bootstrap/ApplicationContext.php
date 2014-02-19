<?php

use Symfony\Component\Console\Tester\ApplicationTester;

require_once 'PHPUnit/Autoload.php';
require_once 'PHPUnit/Framework/Assert/Functions.php';

trait ApplicationContext
{
    /**
     * @var ApplicationTester|null
     */
    private $applicationTester = null;

    /**
     * @When /^I run "([^"]*)"$/
     */
    public function iRun($command)
    {
        $this->run($command);
    }

    /**
     * @Then /^I should see "(?P<message>[^"]*)"$/
     */
    public function iShouldSee($message)
    {
        assertRegExp('/'.preg_quote($message, '/').'/sm', $this->applicationTester->getDisplay());
    }

    /**
     * @return \Symfony\Component\Console\Application
     */
    abstract protected function createApplication();

    /**
     * @param string $command
     *
     * @return integer
     */
    private function run($command)
    {
        $application = $this->createApplication();
        $application->setAutoExit(false);

        $this->applicationTester = new ApplicationTester($application);

        return $this->applicationTester->run(array('command' => $command));
    }
}

