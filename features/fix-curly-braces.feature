Feature: Checking for PSR-1 compliance
  In order to keep my code up to standard
  As a developer
  I want to fix my curly braces

  Scenario: My code has curly braces that are on the same line as the "class" keyword
    Given I have a file containing:
    """
    <?php

    class A {
    }
    """
    When I run "fix-braces"
    Then My file should contain:
    """
    <?php

    class A
    {
    }
    """

