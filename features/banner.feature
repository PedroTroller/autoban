Feature: I can add a banner

  Scenario: I can add a banner with a new client
      Given I am on the homepage
        And I follow "Add a banner"
       When I fill in "Name" with "Bruce Banner"
        And I fill in "New" with "The client name"
        And I attach the file "image.png" to "Banner image"
        And I press "Submit"
        And dump last response
       Then I should be on the homepage
        And I should see the banner "Bruce Banner"
