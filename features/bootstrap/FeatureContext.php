<?php


use Behat\Behat\Context\BehatContext;
use Httpful\Request;
use Httpful\Response;

//
// Require 3rd-party libraries here:
//
//   require_once 'PHPUnit/Autoload.php';
//   require_once 'PHPUnit/Framework/Assert/Functions.php';


//

/**
 * Features context.
 */
class FeatureContext extends BehatContext
{
    /**
     * @var Request
     */
    private $httpRequest;
    /**
     * @var Response
     */
    private $httpResponse;

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
     * @When /^I visit \'([^\']*)\'$/
     */
    public function iVisit($arg1)
    {
        $this->httpRequest = Request::get("http://localhost:3000/".ltrim($arg1, "/"));
        $this->httpRequest->expects("application/json");
        return $this->httpResponse = $this->httpRequest->send();
    }

    /**
     * @Then /^the status is \'([^\']*)\'$/
     */
    public function theStatusIs($arg1)
    {

        if ( $this->httpResponse->code !== intval( $arg1 ) ) {
            throw new Exception("Code should be 200");
        }
    }

    /**
     * @Given /^the response is \'([^\']*)\'$/
     */
    public function theResponseIs($arg1)
    {
        if ( strpos($this->httpResponse->content_type, "json") === FALSE ) {
            throw new Exception("This wasn't json");
        }
    }
}
