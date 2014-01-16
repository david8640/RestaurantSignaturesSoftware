<?php
class RestaurantATCest {
    private $locationInTable = "//table[@id='restaurants']//tr[last()]//";
    
    // tests
    public function goToAddPage(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('RES-9: Go to the add restaurant page');
        $I->amOnPage('/index.php/restaurant/findAll');
        $I->click('.button_add');
        $I->see('Add Restaurant');
        Codeception\Module\logout($I);
    }

    public function add(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('RES-9: Add a restaurant (New Restaurant)');
        $I->amOnPage('/index.php/restaurant/create/');
        // fill the fields
        $I->fillField('name', 'New Restaurant');
        $I->fillField('address', '543 Laurier Avenue East, Ottawa, Ontario, K1N 6R4, Canada');
        // save the restaurant
        $I->click('Save');
        // Check if we are on the good page
        $I->canSee('The restaurant was added.');
        Codeception\Module\logout($I);
    }

    public function checkPageContent(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('RES-12: Visit the restaurants page and check content');
        $I->amOnPage('/index.php/restaurant/findAll');
        // check if we are on the good page
        $I->see('Restaurants');
        // check if the default restaurant is there
        $I->see("New Restaurant", $this->locationInTable."td[2]");
        $I->see('543 Laurier Avenue East, Ottawa, Ontario, K1N 6R4, Canada', $this->locationInTable."td[3]");
        Codeception\Module\logout($I);
    } 

    public function edit(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('RES-10: Edit the default restaurant (New Restaurant)');
        $I->amOnPage('/index.php/restaurant/findAll');
        // Edit default restaurant
        $I->click($this->locationInTable.'*[contains(@class, "button_edit")]');
        // check if we are on the edit page
        $I->see('Edit Restaurant');
        $I->fillField('name', 'New Restaurant 2');
        $I->fillField('address', '200 King, Ottawa, Ontario, K1N 6R4, Canada');
        // save the restaurant
        $I->click('Save');
        // Check if we are on the good page
        $I->canSee('The restaurant was updated.');
        // Check if this supplier has been edited
        $I->canSee('New Restaurant 2', $this->locationInTable."td[2]");
        $I->canSee('200 King, Ottawa, Ontario, K1N 6R4, Canada', $this->locationInTable."td[3]");
        Codeception\Module\logout($I);
    }

    public function delete(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('RES-11: Delete the default restaurant (New Restaurant 2)');
        $I->amOnPage('/index.php/restaurant/findAll');
        // Delete first default supplier
        $I->click($this->locationInTable.'*[contains(@class, "button_delete")]');
        // Check if this supplier has been deleted
        $I->cantSee('New Restaurant 2', $this->locationInTable."td[2]");
        $I->cantSee('200 King, Ottawa, Ontario, K1N 6R4, Canada', $this->locationInTable."td[3]");
        Codeception\Module\logout($I);
    }

    public function editInvalidRestaurant(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('RES-10: Edit an invalid restaurant (a)');
        $I->amOnPage('/index.php/restaurant/edit/a');
        $I->canSee('Invalid restaurant id.');
        $I->wantTo('RES-10: Edit an invalid restaurant (9999999)');
        $I->amOnPage('/index.php/restaurant/edit/9999999');
        $I->canSee('Invalid restaurant id.');
        Codeception\Module\logout($I);
    }

    public function deleteInvalidRestaurant(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('RES-11: Delete an invalid restaurant (a)');
        $I->amOnPage('/index.php/restaurant/delete/a');
        $I->canSee('Invalid restaurant id.');
        $I->wantTo('SUP-5: Delete an invalid restaurant (9999999)');
        $I->amOnPage('/index.php/restaurant/delete/9999999');
        $I->canSee('An error occurred while deleting the restaurant.');
        Codeception\Module\logout($I);
    }

    public function invalidFieldRestaurant(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('RES-13: Verify the fields validations');
        $I->amOnPage('/index.php/restaurant/create/');
        // try to add empty restaurant
        $I->click('Save');
        // check for error messages
        $I->canSee('Name must not be empty');
        $I->cantSee('Address must not be empty');

        // fill fields with invalid data
        // 101 chars
        $I->fillField('name', 'davidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidforti1');
        // 251 chars
        $I->fillField('address', 'davidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidforti1davidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortiortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidforti');
        // try to add a restaurant with invalid fields
        $I->click('Save');
        // check error message
        $I->canSee('Name must not exceed 100 characters long');
        $I->canSee('Address must not exceed 250 characters long');
        Codeception\Module\logout($I);
    }

    public function checkIfFieldReloadedAfterError(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('RES-13: Verify the fields are reload after error');
        $I->amOnPage('/index.php/restaurant/create/');
        $I->fillField('name', 'davidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidforti1');
        $I->fillField('address', '150 boul lanaudière, mascouche, qc, J2R 5T6');
        $I->click('Save');
        // check for error messages
        $I->canSeeInField('name', 'davidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidforti1');
        $I->canSeeInField('address', '150 boul lanaudière, mascouche, qc, J2R 5T6');
        
        $I->fillField('name', 'davidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidforti');
        $I->fillField('address', 'davidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidforti1davidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortiortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidforti');
        $I->click('Save');
        // check for error messages
        $I->canSeeInField('name', 'davidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidforti');
        $I->canSeeInField('address', 'davidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidforti1davidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortiortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidforti');
        Codeception\Module\logout($I);
    }
    
    // Tests TODO
    // RES-1
    // RES-6
    // RES-7
    
    // NOT Implemented
    // RES-2
    // RES-3
    // RES-4
    // RES-5
    // RES-8
}