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
        $I->click('#suppliers_products tr:nth-child(2) td:nth-child(5) input');
        $I->wantTo('ORD-13: The system shall allow users to visually see the entire list of order-able items when creating the order. ');
        // done visually
        // add a second item to check ORD-8
        $I->click('#suppliers_products tr:nth-child(3) td:nth-child(5) input');
        $I->wantTo('ORD-8: The system shall allow items from any number of suppliers to be included in an order.');
            //------------------------------------------------------------------------------------------------------------THIS NEEDS TO BE DONE
        // click next
        //$I->click('Next');
            //------------------------------------------------------------------------------------------------------------THIS NEEDS TO BE DONE

        // enter PO number
        $I->wantTo('ORD-12: The system shall allow the user to record a PO number (unique to each supplier\'s own list of PO numbers) for each supplier included in the order.');
            //------------------------------------------------------------------------------------------------------------THIS NEEDS TO BE DONE
        // next
            //------------------------------------------------------------------------------------------------------------THIS NEEDS TO BE DONE
        // submit
            //------------------------------------------------------------------------------------------------------------THIS NEEDS TO BE DONE
        Codeception\Module\logout($I);
    }

    public function Ord2(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('ORD-2: The system shall allow for users to update an order.');
        // view all orders
        $I->amOnPage('/index.php/order/findAll');
        // check out 11 too...
        $I->wantTo('ORD-11: The system shall allow users to view saved orders.');
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


    public function Ord4(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('ORD-4: The system shall allow the price of individual items in an order to be adjusted manually directly within the order.');
        // view all orders
        $I->amOnPage('/index.php/order/findAll');
        // edit an order
        $I->click('.button_edit');
        // verify edit was pressed
        $I->seeInCurrentUrl('/index.php/order/edit/1/findAll');
        // modify quantity
        // $I->fillField('','20.00'); -------------------------------------------------------------------THIS NEEDS TO BE DONE
        $I->click('Save');
        // verify the order was modified
        // $I->seeInField('error_message','The order has been saved.'); ----------------------------------THIS NEEDS TO BE DONE
        Codeception\Module\logout($I);
    }

    public function Ord6(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('ORD-6: The system shall display the total price of the order.');
        // view all orders
        $I->amOnPage('/index.php/order/findAll');
        // view a total column?
        $I->see('Total');
        // check ord-7 while here ...
        $I->wantTo('ORD-7: The system shall save the time each order was placed.');
        // check to see if ordered date is present within the table
        $I->see('Ordered Date');
        // check ord-9 while here...
        $I->wantTo('ORD-9: The system shall display the order number.');
        //check to see if ID is a column that is populated?
        $I->see('Id');
        Codeception\Module\logout($I);
    }

    public function Ord14(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('ORD-14: The system shall update a price-list with any newly modified prices in the current order without losing the record of the old prices in history. DO MANUALLY');
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

}