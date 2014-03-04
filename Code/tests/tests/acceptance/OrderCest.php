<?php
use \WebGuy;

class OrderCest {
    private $locationInTable = "//table[@id='suppliers_products']//tr[last()]//";

    public function _before()
    {
    }

    public function _after()
    {
    }

    // tests
    public function Ord1(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('ORD-1: The system shall allow for users to create an order.');
        // go to page to click add new order
        $I->amOnPage('/index.php/order/findAll');
        $I->click('.button_add');
        // verify next was pressed correctly
        $I->seeInCurrentUrl('/index.php/order/getStep1/-1/findAll');
        // add an item
            //------------------------------------------------------------------------------------------------------------THIS NEEDS TO BE DONE
        // click next
        //$I->click('Next');
        

        // enter PO number

        // next

        // submit

        Codeception\Module\logout($I);
    }

    public function Ord2(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('ORD-2: The system shall allow for users to update an order.');
        // view all orders
        $I->amOnPage('/index.php/order/findAll');
        // edit an order
        $I->click('.button_edit');
        // verify edit was pressed
        $I->seeInCurrentUrl('/index.php/order/edit/1/findAll');
        // modify quantity or price or remove item
        // $I->fillField('','20.00'); ------------Only one of these two lines needs implementation-----------THIS NEEDS TO BE DONE
        // $I->click('Remove'); --------------------------------------------------------------------------------------------THIS NEEDS TO BE DONE
        $I->click('Save');
        // verify the order was modified
        // $I->seeInField('error_message','The order has been saved.'); ----------------------------------------------------THIS NEEDS TO BE DONE
        Codeception\Module\logout($I);
    }

    public function Ord3(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('ORD-3: The system shall allow for users to delete an order.');
        // view all orders
        $I->amOnPage('/index.php/order/findAll');
        // remove an order
        $I->click('.button_delete');
        // verify it was removed
        $I->see('The order was deleted.');
        Codeception\Module\logout($I);
    }
    public function Ord4(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('ORD-4: The system shall allow the price of individual items in an order to be adjusted manually directly within the order.');
        Codeception\Module\logout($I);
    }

    public function Ord5(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('ORD-5: The system shall allow products to be added to an order.');
        Codeception\Module\logout($I);
    }

    public function Ord6(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('ORD-6: The system shall display the total price of the order.');
        Codeception\Module\logout($I);
    }

    public function Ord7(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('ORD-7: The system shall save the time each order was placed.');
        Codeception\Module\logout($I);
    }

    public function Ord8(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('ORD-8: The system shall allow items from any number of suppliers to be included in an order.');
        Codeception\Module\logout($I);
    }

    public function Ord9(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('ORD-9: The system shall display the order number.');
        Codeception\Module\logout($I);
    }

    public function Ord10(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('ORD-10: The system shall store all previously saved orders.');
        Codeception\Module\logout($I);
    }

    public function Ord11(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('ORD-11: The system shall allow users to view saved orders.');
        Codeception\Module\logout($I);
    }

    public function Ord12(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('ORD-12: The system shall allow the user to record a PO number (unique to each supplier\'s own list of PO numbers) for each supplier included in the order.');
        Codeception\Module\logout($I);
    }

    public function Ord13(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('ORD-13: The system shall allow users to visually see the entire list of order-able items when creating the order. ');
        Codeception\Module\logout($I);
    }

    public function Ord14(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('ORD-14: The system shall update a price-list with any newly modified prices in the current order without losing the record of the old prices in history.');
        Codeception\Module\logout($I);
    }

    public function Ord15(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('ORD-15: The system shall record multiple Purchase Order (PO) numbers in each order; one PO per supplier.');
        Codeception\Module\logout($I);
    }

    public function Ord16(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('ORD-16: The system shall allow a user to choose which supplier to order each product from.');
        Codeception\Module\logout($I);
    }







    public function AddMassiveOrder(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->amOnPage('/index.php/order/findAll');
        $I->click('.button_add');
        $I->wantTo('ORD-13: The system shall allow users to visually see the entire list of order-able items');
        $I->see('Beef Supplier A');
        $I->see('Beef Supplier B');
        $I->see('Pork Supplier A');
        $I->see('Pork Supplier B');
        //add 2 orders from 2 different suppliers
        //$I->click('Add', $this->locationInTable."td[1]");
        Codeception\Module\logout($I);
    }

}