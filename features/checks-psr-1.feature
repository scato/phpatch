Feature: Checking for PSR-1 compliance
  In order to keep my code up to standard
  As a developer
  I want to check my code for compliance of the PSR-1 standard

  Scenario: My code has no errors
    Given I have a file containing "<?php echo 'test'; ?>"
    When I run "check"
    Then I should see "No errors"

