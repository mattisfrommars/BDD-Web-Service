Feature: Web API heartbeat
  Allows clients to check the api is ok

  Scenario: Checking API status
    When I visit '/heartbeat'
    Then the status is '200'
    And the response is 'application/json'