<?php
class ProductATCest {
    private $locationInTable = "//table[@id='products']//tr[last()]//";
    
    // tests
    public function goToAddPage(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('PRD-1: Go to the add products page');
        $I->amOnPage('/index.php/product/findAll');
        $I->click('.button_add');
        $I->see('Add Product');
        Codeception\Module\logout($I);
    }

    public function add(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('PRD-1: Add a product (Chicken)');
        $I->amOnPage('/index.php/product/create/');
        // fill the fields and select options necessary 
        $I->fillField('name', 'Chicken');
        $I->selectOption('#id_category', 4);
        $I->fillField('unit_of_measurement', 'Kg');
        // save the product
        $I->click('Save');
        // Check if we are on the good page
        $I->canSee('The product was added.');
        Codeception\Module\logout($I);
    }

    public function checkPageContent(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('PRD-4: Visit the products page and check content');
        $I->amOnPage('/index.php/product/findAll');
        // check if we are on the good page
        $I->see('Products');
        // check if the last added product 
        $I->see('Chicken', $this->locationInTable."td[2]");
        $I->see('Meats', $this->locationInTable."td[3]");
        $I->see('Kg', $this->locationInTable."td[4]");
        Codeception\Module\logout($I);
} 
    public function edit(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('PRD-2: Edit the first default product (Beef)');
        $I->amOnPage('/index.php/product/findAll');
        // Edit first default product
        $I->click($this->locationInTable.'*[contains(@class, "button_edit")]');
        // check if we are on the edit page
        $I->see('Edit Product');
        $I->fillField('name', 'Pork');
        $I->selectOption('#id_category', 4);
        $I->fillField('unit_of_measurement', 'Kg');
        // save the product
        $I->click('Save');
        // Check if we are on the good page
        $I->canSee('The product was updated.');
        // Check if this supplier has been edited
        $I->canSee('Pork', $this->locationInTable."td[2]");
        $I->canSee('Meats', $this->locationInTable."td[3]");
        $I->canSee('Kg', $this->locationInTable."td[4]");
        Codeception\Module\logout($I);
    }

    public function delete(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('PRD-4: Delete the first default product (Product 1)');
        $I->amOnPage('/index.php/product/findAll');
        // Delete first default supplier
        $I->click($this->locationInTable.'*[contains(@class, "button_delete")]');
        // Check if this product has been deleted
        $I->cantSee('Beef', $this->locationInTable."td[2]");
        Codeception\Module\logout($I);
    }
    public function invalidField(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('PRD-2: Verify the fields validations');
        $I->amOnPage('/index.php/product/create/');
        // try to add empty supplier
        $I->click('Save');
        // check for error messages
        $I->canSee('Name must not be empty');
        // fill fields with invalid data
        // 101 chars
        $I->fillField('name', '000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000');
                // try to add a product with invalid fields
        $I->click('Save');
        // check error message
        $I->canSee('Name must not exceed 100 characters long');
        Codeception\Module\logout($I);
    }
   
}