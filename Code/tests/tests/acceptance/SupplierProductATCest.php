<?php
class SupplierProductATCest {
    private $locationInTable = "//table[@id='SupplierProduct']//tr[last()]//";
    
    // tests
    public function goToAddPage(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('SPR-1: Go to the add supplier product page');
        $I->amOnPage('/index.php/supplierProduct/findAll');
        $I->click('.button_add');
        $I->see("Add Supplier's Product");
        Codeception\Module\logout($I);
    }

    public function add(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('SPR-1: Add a supplier product (Supplier E)');
        $I->amOnPage('/index.php/supplierProduct/create/');
        // fill the fields
        $I->selectOption('#supplier_id', 5);
        $I->selectOption('#product_id', 1);
        $I->fillField('price', '4.50');
        $I->fillField('unit_of_measurement', 'Kg');
        // save the supplier
        $I->click('Save');
        // Check if we are on the good page
     //   $I->canSee("The Suplier's Product was added.");
        Codeception\Module\logout($I);
}
}
/*

    public function checkPageContent(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('SPR-4: Visit the suppliers product page and check content');
        $I->amOnPage('/index.php/supplierProduct/findAll');
        // check if we are on the good page
        $I->see("Suppliers' Products");
        // check if the last supplier is there
        $I->see("Supplier A", $this->locationInTable."td[2]");
        $I->see('Beef', $this->locationInTable."td[4]");
        $I->see('4.50', $this->locationInTable."td[5]");
        $I->see('Kg', $this->locationInTable."td[6]");
        Codeception\Module\logout($I);
} 

    public function edit(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('SPR-2: Edit the first default suppliers product (Supplier A)');
        $I->amOnPage('/index.php/supplierProduct/findAll');
        // Edit first default supplier
        $I->click($this->locationInTable.'*[contains(@class, "button_edit")]');
        // check if we are on the edit page
        $I->see("Edit Supplier's Product");
        $I->selectOption('#supplier_id', 5);
        $I->selectOption('#product_id', 1);
        $I->fillField('price', '2.50');
        $I->fillField('unit_of_measure', 'Kg');
        // save the supplier
        $I->click('Save');
        // Check if we are on the good page
        $I->canSee('The suppliers product was updated.');
        // Check if this supplier has been edited
        $I->canSee('Supplier E', $this->locationInTable."td[2]");
        $I->canSee('Beef', $this->locationInTable."td[4]");
        $I->canSee('2.50', $this->locationInTable."td[5]");
        $I->canSee('Kg', $this->locationInTable."td[6]");
        Codeception\Module\logout($I);
    }

    public function delete(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('SPR-3: Delete the first default supplier product (Supplier A)');
        $I->amOnPage('/index.php/supplierProduct/findAll');
        // Delete first default supplier
        $I->click($this->locationInTable.'*[contains(@class, "button_delete")]');
        // Check if this supplier has been deleted
        $I->cantSee('Supplier E', $this->locationInTable."td[2]");
        $I->cantSee('Beef', $this->locationInTable."td[4]");
        $I->cantSee('2.50', $this->locationInTable."td[5]");
        $I->cantSee('Kg', $this->locationInTable."td[6]");
        Codeception\Module\logout($I);
    }

  

}