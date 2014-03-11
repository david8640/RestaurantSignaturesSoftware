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
        $I->click('#inventories tr:nth-child(1) td:nth-child(2) a');
        $I->see('Inventory of Restaurant 1');
        Codeception\Module\logout($I);
    }
    
    public function InventoryEdit(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('INV-2: Edit the quantity of an item in an inventory'); 
        $I->amOnPage('/index.php/index/index');
        $I->click('Inventories');
        $I->click('#inventories tr:nth-child(1) td:nth-child(2) a'); // Select Restaurant 1

        // By pass the the modification of a field and save action because it's using some javascript.
        // check the feedback message
        $params = $this->getInventoryItem();
        $params['qty[0]'] = '5';
        $I->sendAjaxPostRequest(Codeception\Module\getUrl() . 'inventory/update', $params);
        
        $I->see('The inventory was updated.');
        // we stay on the same page and check the content of the field
        $I->seeInField('#items tr:nth-child(1) td:nth-child(5) input', 5);
        // change of page and come back on this page to see if the change has been done
        $I->amOnPage('/index.php/index/index');
        $I->click('Inventories');
        $I->click('#inventories tr:nth-child(1) td:nth-child(2) a'); // Select Restaurant 1
        $I->seeInField('#items tr:nth-child(1) td:nth-child(5) input', 5);
        // change the value back to 1 for the next tests
        // By pass the the modification of a field and save action because it's using some javascript.
        $I->sendAjaxPostRequest(Codeception\Module\getUrl() . 'inventory/update', $this->getInventoryItem());
        
        Codeception\Module\logout($I);
    }
    
    public function InventoryTryToEditWithInvalidValue(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('INV-2: Edit the quantity of an item in an inventory with an invalid value'); 
        $I->amOnPage('/index.php/index/index');
        $I->click('Inventories');
        $I->click('#inventories tr:nth-child(1) td:nth-child(2) a'); // Select Restaurant 1
        // validate that the previous value is 1
        $I->seeInField('#items tr:nth-child(1) td:nth-child(5) input', 1);
        // change the current value to an invalid value (-1) + check error message
        // By pass the the modification of a field and save action because it's using some javascript.
        $params = $this->getInventoryItem();
        $params['qty[0]'] = -1;
        $I->sendAjaxPostRequest(Codeception\Module\getUrl() . 'inventory/update', $params);
        $I->see('Quantity of Beef of Supplier A must be a positive value');
        // change the current value to an invalid value (test) + check error message
        // By pass the the modification of a field and save action because it's using some javascript.
        $params = $this->getInventoryItem();
        $params['qty[0]'] = 'test';
        $I->sendAjaxPostRequest(Codeception\Module\getUrl() . 'inventory/update', $params);
        $I->see('Quantity of Beef of Supplier A must be numeric');
        // change the current value to an invalid value ('') + check error message
        // By pass the the modification of a field and save action because it's using some javascript.
        $params = $this->getInventoryItem();
        $params['qty[0]'] = '';
        $I->sendAjaxPostRequest(Codeception\Module\getUrl() . 'inventory/update', $params);
        $I->see('Quantity of Beef of Supplier A must not be empty');
        Codeception\Module\logout($I);
    }
    
    private function getInventoryItem() {
        return array(
            'costPerUnit[0]' => '50.00',
            'inventoryId' => '1',
            'itemId[0]' => '1',
            'originAction' => '',
            'productId[0]' => '1',
            'productName[0]' => 'Beef',
            'qty[0]' => '1',
            'restaurantId' => '5',
            'restaurantName' => 'Restaurant 1',
            'supplierId[0]' => '1',
            'supplierName[0]' => 'Supplier A',
            'unit[0]' => 'kg'
        );
    }
}