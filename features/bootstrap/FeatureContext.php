<?php

use Behat\Behat\Context\Context;
use Behat\MinkExtension\Context\RawMinkContext;

class FeatureContext extends RawMinkContext implements Context
{
    public function __construct()
    {
    }

    /**
     * @BeforeScenario
     */
    public function resetDatabase()
    {
        exec('bin/console doctrine:schema:drop --force');
        exec('bin/console doctrine:schema:create');
    }

    /**
     * @When dump last response
     */
    public function dumpLastResponse()
    {
        $content = $this->getMink()->getSession()->getPage()->getContent();
        $folder = sprintf('%s/../dump', __DIR__);

        if (false === is_dir($folder)) {
            mkdir($folder);
        }

        file_put_contents(sprintf('%s/%s.html', $folder, uniqid()), $content);
    }

    /**
     * @Then I should see the banner :name
     */
    public function iShouldSeeTheBanner(string $name)
    {
        $labels = $this->getMink()->getSession()->getPage()->findAll('css', 'article label');

        foreach ($labels as $label) {
            if ($name === $label->getText()) {
                return;
            }
        }

        throw new \Exception(sprintf('Banner "%s" not found.', $name));
    }
}
