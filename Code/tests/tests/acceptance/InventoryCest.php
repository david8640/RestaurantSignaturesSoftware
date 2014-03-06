<?php
use \WebGuy;

class InventoryCest {
    // tests
    public function InventoryGetOnToPageSpecificRestaurant(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('INV-3: Go to the inventory page of restaurant 1'); 
        $I->amOnPage('/index.php/index/index');
        $I->click('Inventory');
        $I->see('Inventory of Restaurant 1');
        Codeception\Module\logout($I);
    }
    
    public function InventoryGetOnToPage(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('INV-4: Go to the page of all the inventories'); 
        $I->amOnPage('/index.php/index/index');
        $I->click('Inventories');
        $I->see('Restaurant 1');
        $I->see('Restaurant 2');
        Codeception\Module\logout($I);
    }
    
    public function InventoryGoToEditionPageFromInventories(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('INV-2: Go to the page of all the inventories and click on the edition button of restaurant 1'); 
        $I->amOnPage('/index.php/index/index');
        $I->click('Inventories');
        $I->click('#inventories tr:nth-child(2) td:nth-child(2) a');
        $I->see('Inventory of Restaurant 1');
        Codeception\Module\logout($I);
    }
    
    public function InventoryEdit(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('INV-2: Edit the quantity of an item in an inventory'); 
        $I->amOnPage('/index.php/index/index');
        $I->click('Inventories');
        $I->click('#inventories tr:nth-child(2) td:nth-child(2) a'); // Select Restaurant 1
        // validate that the previous value is 1
        $I->seeInField('#items tr:nth-child(2) td:nth-child(5) input', 1);
        // change the current value to 5
        $I->fillField('#items tr:nth-child(2) td:nth-child(5) input', 5);
        // save
        $I->click('Save');
        // check the feedback message
        $I->see('The inventory was updated.');
        // we stay on the same page and check the content of the field
        $I->seeInField('#items tr:nth-child(2) td:nth-child(5) input', 5);
        // change of page and come back on this page to see if the change has been done
        $I->amOnPage('/index.php/index/index');
        $I->click('Inventories');
        $I->click('#inventories tr:nth-child(2) td:nth-child(2) a'); // Select Restaurant 1
        $I->seeInField('#items tr:nth-child(2) td:nth-child(5) input', 5);
        // change the value back to 1 for the next tests
        $I->fillField('#items tr:nth-child(2) td:nth-child(5) input', 1);
        $I->click('Save');
        Codeception\Module\logout($I);
    }
    
    public function InventoryTryToEditWithInvalidValue(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('INV-2: Edit the quantity of an item in an inventory with an invalid value'); 
        $I->amOnPage('/index.php/index/index');
        $I->click('Inventories');
        $I->click('#inventories tr:nth-child(2) td:nth-child(2) a'); // Select Restaurant 1
        // validate that the previous value is 1
        $I->seeInField('#items tr:nth-child(2) td:nth-child(5) input', 1);
        // change the current value to an invalid value (-1) + check error message
        $I->fillField('#items tr:nth-child(2) td:nth-child(5) input', -1);
        $I->click('Save');
        $I->see('Quantity of Beef of Supplier A must be a positive value');
        // change the current value to an invalid value (test) + check error message
        $I->fillField('#items tr:nth-child(2) td:nth-child(5) input', 'test');
        $I->click('Save');
        $I->see('Quantity of Beef of Supplier A must be numeric');
        // change the current value to an invalid value ('') + check error message
        $I->fillField('#items tr:nth-child(2) td:nth-child(5) input', '');
        $I->click('Save');
        $I->see('Quantity of Beef of Supplier A must not be empty');
    }
}