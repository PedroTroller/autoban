<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

class FeatureContext implements Context
{
    public function __construct()
    {
    }

    /**
     * @Given I am on the homepage
     */
    public function iAmOnTheHomepage()
    {
        throw new PendingException();
    }

    /**
     * @Given I click on :arg1
     */
    public function iClickOn($arg1)
    {
        throw new PendingException();
    }

    /**
     * @When I fill in :arg1 with :arg2
     */
    public function iFillInWith($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @When I attach an image to :arg1
     */
    public function iAttachAnImageTo($arg1)
    {
        throw new PendingException();
    }

    /**
     * @When I press :arg1
     */
    public function iPress($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then I should be on the homepage
     */
    public function iShouldBeOnTheHomepage()
    {
        throw new PendingException();
    }

    /**
     * @Then I should see the banner :arg1
     */
    public function iShouldSeeTheBanner($arg1)
    {
        throw new PendingException();
    }
}
