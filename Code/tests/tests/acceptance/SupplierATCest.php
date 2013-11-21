<?php
class SupplierATCest {
    private $locationInTable = "//table[@id='suppliers']//td[text()='Supplier 2']/ancestor::tr/";

    // tests
    public function goToAddPage(\WebGuy $I) {
        $I->wantTo('SUP-1 Go to the add supplier page');
        $I->amOnPage('/index.php/supplier/findAll');
        $I->click('Add');
        $I->see('Add Supplier');
    }

    public function add(\WebGuy $I) {
        $I->wantTo('SUP-1 Add a supplier (Supplier 2)');
        $I->amOnPage('/index.php/supplier/create/');
        // fill the fields
        $I->fillField('name', 'Supplier 2');
        $I->fillField('contactName', 'David Fortin');
        $I->fillField('phoneNumber', '450-450-4500');
        $I->fillField('faxNumber', '450-450-4000');
        // save the supplier
        $I->click('Save');
        // Check if we are on the good page
        $I->canSee('The supplier was added.');
    }

    public function checkPageContent(\WebGuy $I) {
        $I->wantTo('SUP-8 Visit the suppliers page and check content');
        $I->amOnPage('/index.php/supplier/findAll');
        // check if we are on the good page
        $I->see('Suppliers');
        // check if the first default supplier is there
        $I->see("Supplier 2", $this->locationInTable."td[2]");
        $I->see('David Fortin', $this->locationInTable."td[3]");
        $I->see('450-450-4500', $this->locationInTable."td[4]");
        $I->see('450-450-4000', $this->locationInTable."td[5]");
        // check if the add, edit and delete links exists
        $I->seeLink('Add');
        $I->seeLink('Edit');
        $I->seeLink('Delete');
    } 

    public function edit(\WebGuy $I) {
        $I->wantTo('SUP-2 Edit the first default supplier (Supplier 2)');
        $I->amOnPage('/index.php/supplier/findAll');
        // Delete first default supplier
        $I->click('Edit', $this->locationInTable.'td[6]');
        // check if we are on the edit page
        $I->see('Edit Supplier');
        $I->fillField('name', 'Supplier 2');
        $I->fillField('contactName', 'David Fortin1');
        $I->fillField('phoneNumber', '450-450-4501');
        $I->fillField('faxNumber', '450-450-4001');
        // save the supplier
        $I->click('Save');
        // Check if we are on the good page
        $I->canSee('The supplier was updated.');
        // Check if this supplier has been edited
        $I->canSee('Supplier 2', $this->locationInTable."td[2]");
        $I->canSee('David Fortin1', $this->locationInTable."td[3]");
        $I->canSee('450-450-4501', $this->locationInTable."td[4]");
        $I->canSee('450-450-4001', $this->locationInTable."td[5]");
    }

    public function delete(\WebGuy $I) {
        $I->wantTo('SUP-4 Delete the first default supplier (Supplier 2)');
        $I->amOnPage('/index.php/supplier/findAll');
        // Delete first default supplier
        $I->click('Delete', $this->locationInTable.'td[7]');
        // Check if this supplier has been deleted
        $I->cantSee('Supplier 2', $this->locationInTable."td[2]");
        $I->cantSee('David Fortin1', $this->locationInTable."td[3]");
        $I->cantSee('450-450-4501', $this->locationInTable."td[4]");
        $I->cantSee('450-450-4001', $this->locationInTable."td[5]");
    }

    public function editInvalidSupplier(\WebGuy $I) {
        $I->wantTo('SUP-2 Edit an invalid supplier (a)');
        $I->amOnPage('/index.php/supplier/edit/a');
        $I->canSee('Invalid supplier id.');
        $I->wantTo('Edit an invalid supplier (9999999)');
        $I->amOnPage('/index.php/supplier/edit/9999999');
        $I->canSee('Invalid supplier id.');
    }

    public function deleteInvalidSupplier(\WebGuy $I) {
        $I->wantTo('SUP-5 Delete an invalid supplier (a)');
        $I->amOnPage('/index.php/supplier/delete/a');
        $I->canSee('Invalid supplier id.');
        $I->wantTo('SUP-5 Delete an invalid supplier (9999999)');
        $I->amOnPage('/index.php/supplier/delete/9999999');
        $I->canSee('An error occurred while deleting the supplier.');
    }

    public function invalidFieldSupplier(\WebGuy $I) {
        $I->wantTo('Verify the fields validations');
        $I->amOnPage('/index.php/supplier/create/');
        // try to add empty supplier
        $I->click('Save');
        // check for error messages
        $I->canSee('Name must not be empty');
        $I->canSee('Contact name must not be empty');
        $I->canSee('Phone number must not be empty');

        // fill fields with invalid data
        // 101 chars
        $I->fillField('name', 'davidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidforti1');
        $I->fillField('contactName', 'davidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidforti1');
        // Invalid phone number format
        $I->fillField('phoneNumber', '450-450-45000');
        $I->fillField('faxNumber', '450-450-45000');
        // try to add a supplier with invalid fields
        $I->click('Save');
        // check error message
        $I->canSee('Name must not exceed 100 characters long');
        $I->canSee('Contact name must not exceed 100 characters long');
        $I->canSee('Phone number does not match the required format');
        $I->canSee('Fax number does not match the required format');

        // fill valid values for name and contactName
        $I->fillField('name', 'Supplier');
        $I->fillField('contactName', 'David Fortin');

        // Invalid phone number format
        $I->fillField('phoneNumber', '(450-450-4500');
        $I->fillField('faxNumber', '(450-450-4500');
        // try to add a supplier with invalid fields
        $I->click('Save');
        $I->canSee('Phone number does not match the required format');
        $I->canSee('Fax number does not match the required format');

        // Invalid phone number format
        $I->fillField('phoneNumber', '450 450 450000');
        $I->fillField('faxNumber', '450 450 450000');
        // try to add a supplier with invalid fields
        $I->click('Save');
        $I->canSee('Phone number does not match the required format');
        $I->canSee('Fax number does not match the required format');

        // Invalid phone number format
        $I->fillField('phoneNumber', '(450)-450-450000');
        $I->fillField('faxNumber', '(450)-450-450000');
        // try to add a supplier with invalid fields
        $I->click('Save');
        $I->canSee('Phone number does not match the required format');
        $I->canSee('Fax number does not match the required format');
    }

    public function checkIfFieldReloadedAfterError(\WebGuy $I) {
        $I->wantTo('Verify the fields are reload after error');
        $I->amOnPage('/index.php/supplier/create/');
        $I->fillField('name', 'davidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidforti1');
        $I->fillField('contactName', 'davidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidforti1');
        // Invalid phone number format
        $I->fillField('phoneNumber', '450-450-45000');
        $I->fillField('faxNumber', '450-450-45000');                
        $I->click('Save');
        // check for error messages
        $I->canSeeInField('name', 'davidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidforti1');
        $I->canSeeInField('contactName', 'davidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidfortidavidforti1');
        $I->canSeeInField('phoneNumber', '450-450-45000');
        $I->canSeeInField('faxNumber', '450-450-45000');
    }
}