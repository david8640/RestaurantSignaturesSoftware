<?php
class ProductCategoryATCest {
    /*private $locationInTable = "//table[@id='product_category']//td[text()='Category 2']/ancestor::tr/";
    private $parentLocationInTable = "//table[@id='product_category']//td[text()='Category 3']/ancestor::tr/";
    	
    // tests
    public function goToAddPage(\WebGuy $I) {
        $I->wantTo('Go to the product category add page');
        $I->amOnPage('/index.php/product_category/findAll');
        $I->click('Add');
        $I->see('Add Product Category');
    }

    public function add(\WebGuy $I) {
        $I->wantTo('Add a product category (Category 2) without parent');
        $I->amOnPage('/index.php/product_category/create/');
        // fill the fields
        $I->fillField('name', 'Category 2');
        $I->selectOption('parent', 0);
        // save the supplier
        $I->click('Save');
        // Check if we are on the good page
        $I->canSee('The category was added.');
    }

    public function addParent(\WebGuy $I) {
        $I->wantTo('Add a product category (Category 3) (will be the parent of Category 2)');
        $I->amOnPage('/index.php/product_category/create/');
        // fill the fields
        $I->fillField('name', 'Category 3');
        $I->selectOption('parent', 0);
        // save the supplier
        $I->click('Save');
        // Check if we are on the good page
        $I->canSee('The category was added.');
    }

    public function checkPageContent(\WebGuy $I) {
        $I->wantTo('Visit the product category page and check content');
        $I->amOnPage('/index.php/product_category/findAll');
        // check if we are on the good page
        $I->see('Product Categories');
        // check if the first default supplier is there
        $I->see("Category 2", $this->locationInTable."td[2]");
        $I->see('none', $this->locationInTable."td[3]");
        // check if the add, edit and delete links exists
        $I->seeLink('Add');
        $I->seeLink('Edit');
        $I->seeLink('Delete');
    } 

    public function edit(\WebGuy $I) {
        $I->wantTo('Edit the first default product category (Category 2)');
        $I->amOnPage('/index.php/product_category/findAll');
        // Delete first default supplier
        $I->click('Edit', $this->locationInTable.'td[4]');
        // check if we are on the edit page
        $I->see('Edit Product Category');
        $I->fillField('name', 'Category 2');
        $I->selectOption('parent', 1);
        // save the supplier
        $I->click('Save');
        // Check if we are on the good page
        $I->canSee('The category was updated.');
        // Check if this supplier has been edited
        $I->canSee('Category 2', $this->locationInTable."td[2]");
        $I->canSee('Category 3', $this->locationInTable."td[3]");
    }

    public function checkIfFieldReloadedAfterError(\WebGuy $I) {
        $I->wantTo('Verify the fields are reload after error');
        $I->amOnPage('/index.php/product_category/create/');
        $I->fillField('name', 'davidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidforti1');
        $I->selectOption('parent', 1);              
        $I->click('Save');
        // check for error messages
        $I->canSeeInField('name', 'davidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidforti1');
        $I->canSeeInField('parent', 'Category 3');
    }

    public function moveDownProductCategory(\WebGuy $I) {
        $I->wantTo('Change the order of 2 categories');
        $I->amOnPage('/index.php/product_category/findAll/');
        $I->canSee('1', $this->locationInTable.'td[6]');
        $I->canSee('2', $this->parentLocationInTable.'td[6]');
        $I->click('moveDown', $this->locationInTable.'td[3]');
        // check for error messages
        $I->canSee('2', $this->locationInTable.'td[6]');
        $I->canSee('1', $this->parentLocationInTable.'td[6]');
    }

    public function moveUpProductCategory(\WebGuy $I) {
        $I->wantTo('Change the order of 2 categories');
        $I->amOnPage('/index.php/product_category/findAll/');
        $I->canSee('1', $this->locationInTable.'td[6]');
        $I->canSee('2', $this->parentLocationInTable.'td[6]');
        $I->click('moveUp', $this->parentLocationInTable.'td[3]');
        // check for error messages
        $I->canSee('2', $this->locationInTable.'td[6]');
        $I->canSee('1', $this->parentLocationInTable.'td[6]');
    }

    public function deleteParentError(\WebGuy $I) {
        $I->wantTo('Delete the the parent of (Category 2)');
        $I->amOnPage('/index.php/product_category/findAll');
        // Delete first default supplier
        $I->click('Delete', $this->parentLocationInTable.'td[5]');
        // Check if this supplier has been deleted
        $I->canSee('Error we cannot delete the parent category because there is some subcategories.');
    }

    public function delete(\WebGuy $I) {
        $I->wantTo('Delete the first default product category (Category 2)');
        $I->amOnPage('/index.php/product_category/findAll');
        // Delete first default supplier
        $I->click('Delete', $this->locationInTable.'td[5]');
        // Check if this supplier has been deleted
        $I->cantSee('Category 2', $this->locationInTable."td[2]");
        $I->cantSee('Category 3', $this->locationInTable."td[3]");
    }

   public function deleteParent(\WebGuy $I) {
        $I->wantTo('Delete the parent of (Category 2)');
        $I->amOnPage('/index.php/product_category/findAll');
        // Delete first default supplier
        $I->click('Delete', $this->parentLocationInTable.'td[5]');
        // Check if this supplier has been deleted
        $I->cantSee('Category 3', $this->parentLocationInTable."td[2]");
        $I->cantSee('none', $this->parentLocationInTable."td[3]");
    }

    public function editInvalidProductCategory(\WebGuy $I) {
        $I->wantTo('Edit an invalid category (a)');
        $I->amOnPage('/index.php/product_category/edit/a');
        $I->canSee('Invalid category id.');
        $I->wantTo('Edit an invalid category (9999999)');
        $I->amOnPage('/index.php/product_category/edit/9999999');
        $I->canSee('Invalid category id.');
    }

    public function deleteInvalidProductCategory(\WebGuy $I) {
        $I->wantTo('Delete an invalid category (a)');
        $I->amOnPage('/index.php/product_category/delete/a');
        $I->canSee('Invalid category id.');
        $I->wantTo('Delete an invalid category (9999999)');
        $I->amOnPage('/index.php/product_category/delete/9999999');
        $I->canSee('An error occured while deleting the category.');
    }

    public function invalidFieldProductCategory(\WebGuy $I) {
        $I->wantTo('Verify the fields validations');
        $I->amOnPage('/index.php/product_category/create/');
        // try to add empty supplier
        $I->click('Save');
        // check for error messages
        $I->canSee('Name must not be empty');
        $I->canSeeInField('parent', 'none');

        // fill fields with invalid data
        // 101 chars
        $I->fillField('name', 'davidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidforti1');
        // try to add a supplier with invalid fields
        $I->click('Save');
        // check error message
        $I->canSee('Name must not exceed 100 characters long');
    }*/
    
    // TODO add a test to be sure to avoid deleting a category that has some product link to it.
}