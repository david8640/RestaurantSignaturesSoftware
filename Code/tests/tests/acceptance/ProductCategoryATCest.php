<?php
class ProductCategoryATCest {
    private $locationInTable = "//table[@id='productCategories']//tr[last()]//";
    private $childlocationInTable = "//table[@id='productCategories']//tr[last()-1]//";
    private $parentLocationInTable = "//table[@id='productCategories']//td[text()='Category 3']/ancestor::tr/";
    	
    // tests
    public function goToAddPage(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('CAT-1: Go to the product category add page');
        $I->amOnPage('/index.php/productCategory/findAll');
        $I->click('.button_add');
        $I->see('Add Product Category');
        Codeception\Module\logout($I);
    }

    public function add(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('CAT-1: Add a product category (Category 2) without parent');
        $I->amOnPage('/index.php/productCategory/create/');
        // fill the fields
        $I->fillField('name', 'Category 2');
        $I->selectOption('//select[@name="parent"]', -1);
        // save the supplier
        $I->click('Save');
        // Check if we are on the good page
        $I->canSee('The product category was added.');
        Codeception\Module\logout($I);
    }

    public function addParent(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('CAT-11: Add a product category (Category 3) (will be the parent of Category 2)');
        $I->amOnPage('/index.php/productCategory/create/');
        // fill the fields
        $I->fillField('name', 'Category 3');
        $I->selectOption('//select[@name="parent"]', -1);
        // save the supplier
        $I->click('Save');
        // Check if we are on the good page
        $I->canSee('The product category was added.');
        Codeception\Module\logout($I);
    }

    public function checkPageContent(\WebGuy $I) {
        Codeception\Module\login($I);   
        $I->wantTo('CAT-5 & 6: Visit the product category page and check content');
        $I->amOnPage('/index.php/productCategory/findAll');
        // check if we are on the good page
        $I->see('Product Categories');
        // check if the first default supplier is there
        $I->see("Category 3", $this->locationInTable."td[2]");
        $I->see('none', $this->locationInTable."td[3]");
        Codeception\Module\logout($I);
    } 

    public function edit(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('CAT-2: Edit the first default product category (Category 2)');
        $I->amOnPage('/index.php/productCategory/findAll');
        // Edit first default supplier
        $I->click($this->childlocationInTable.'*[contains(@class, "button_edit")]');
        // check if we are on the edit page
        $I->see('Edit Product Category');
        $I->fillField('name', 'Category 2');
        $I->selectOption('//select[@name="parent"]', 'Category 3');
        // save the supplier
        $I->click('Save');
        // Check if we are on the good page
        $I->canSee('The product category was updated.');
        // Check if this supplier has been edited
        $I->canSee('Category 2', $this->childlocationInTable."td[2]");
        $I->canSee('Category 3', $this->childlocationInTable."td[3]");
        Codeception\Module\logout($I);
    }

    public function checkIfFieldReloadedAfterError(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('CAT-5 & 6: Verify the fields are reload after error');
        $I->amOnPage('/index.php/productCategory/create/');
        $I->fillField('name', 'davidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidforti1');
        $I->selectOption('//select[@name="parent"]', 'Category 3');              
        $I->click('Save');
        // check for error messages
        $I->canSeeInField('name', 'davidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidforti1');
        $I->canSee('Name must not exceed 100 characters long');
        Codeception\Module\logout($I);
    }

    // NOT Implemented
    /*public function moveDownProductCategory(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('Change the order of 2 categories');
        $I->amOnPage('/index.php/productCategory/findAll/');
        $I->canSee('1', $this->locationInTable.'td[6]');
        $I->canSee('2', $this->parentLocationInTable.'td[6]');
        $I->click('moveDown', $this->locationInTable.'td[3]');
        // check for error messages
        $I->canSee('2', $this->locationInTable.'td[6]');
        $I->canSee('1', $this->parentLocationInTable.'td[6]');
        Codeception\Module\logout($I);
    }

    public function moveUpProductCategory(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('Change the order of 2 categories');
        $I->amOnPage('/index.php/productCategory/findAll/');
        $I->canSee('1', $this->locationInTable.'td[6]');
        $I->canSee('2', $this->parentLocationInTable.'td[6]');
        $I->click('moveUp', $this->parentLocationInTable.'td[3]');
        // check for error messages
        $I->canSee('2', $this->locationInTable.'td[6]');
        $I->canSee('1', $this->parentLocationInTable.'td[6]');
        Codeception\Module\logout($I);
    }*/

    // CANCEL
    /*public function deleteParentError(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('Delete the the parent of (Category 2)');
        $I->amOnPage('/index.php/productCategory/findAll');
        // Delete first default supplier
        $I->click($this->locationInTable.'*[contains(@class, "button_delete")]');
        // Check if this supplier has been deleted
        $I->canSee('An error occurred while deleting the product category.');
        Codeception\Module\logout($I);
    }*/

    public function delete(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('CAT-3: Delete the first default product category (Category 2)');
        $I->amOnPage('/index.php/productCategory/findAll');
        // Delete first default supplier
        $I->click($this->childlocationInTable.'*[contains(@class, "button_delete")]');
        // Check if this supplier has been deleted
        $I->cantSee('Category 2', $this->childlocationInTable."td[2]");
        $I->cantSee('Category 3', $this->childlocationInTable."td[3]");
        Codeception\Module\logout($I);
    }

   public function deleteParent(\WebGuy $I) {
       Codeception\Module\login($I); 
       $I->wantTo('CAT-3: Delete the parent of (Category 2)');
       $I->amOnPage('/index.php/productCategory/findAll');
        // Delete first default supplier
        $I->click($this->locationInTable.'*[contains(@class, "button_delete")]');
        // Check if this supplier has been deleted
        $I->cantSee('Category 3', $this->locationInTable."td[2]");
        Codeception\Module\logout($I);
    }

    public function editInvalidProductCategory(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('CAT-2: Edit an invalid category (a)');
        $I->amOnPage('/index.php/productCategory/edit/a');
        $I->canSee('Invalid product category id.');
        $I->wantTo('CAT-2: Edit an invalid category (9999999)');
        $I->amOnPage('/index.php/productCategory/edit/9999999');
        $I->canSee('Invalid product category id.');
        Codeception\Module\logout($I);
    }

    public function deleteInvalidProductCategory(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('CAT-3: Delete an invalid category (a)');
        $I->amOnPage('/index.php/productCategory/delete/a');
        $I->canSee('Invalid product category id.');
        $I->wantTo('CAT-3: Delete an invalid category (9999999)');
        $I->amOnPage('/index.php/productCategory/delete/9999999');
        $I->canSee('An error occurred while deleting the product category.');
        Codeception\Module\logout($I);
    }

    public function invalidFieldProductCategory(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('CAT-5 & 6: Verify the fields validations');
        $I->amOnPage('/index.php/productCategory/create/');
        // try to add empty supplier
        $I->click('Save');
        // check for error messages
        $I->canSee('Name must not be empty');
        $I->canSee('none');

        // fill fields with invalid data
        // 101 chars
        $I->fillField('name', 'davidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidforti1');
        // try to add a supplier with invalid fields
        $I->click('Save');
        // check error message
        $I->canSee('Name must not exceed 100 characters long');
        Codeception\Module\logout($I);
    }
    
    // NOT Implemented
    // Test to be sure to avoid deleting a category that has some product link to it.
}