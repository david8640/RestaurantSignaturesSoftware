<?php
use \WebGuy;

class OrderCest {
    private $postUrl = "/seg4910-project/Code/RestaurantManagementSoftware/index.php/";
    /*private $locationInTable = "//table[@id='suppliers_products']//tr[last()]//";

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
    }*/

    public function OrderViewOrderInProgress(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('ORD-11: View an order in progress.');
        $I->amOnPage('/index.php/order/findAll');
        $I->click('#orders tr:nth-child(2) td:nth-child(9) a');
        $I->see('View Order');
        $I->see('Restaurant: Restaurant 1');
        
        // First PO informations
        $I->see('Supplier A: PO# ABCC');      
        $I->see('State: In Progress');
        // items
        $I->see('Beef', 'table:nth-of-type(1) tr:nth-child(2) td:nth-child(1)');
        $I->see('kg', 'table:nth-of-type(1) tr:nth-child(2) td:nth-child(2)');
        $I->see('50.00', 'table:nth-of-type(1) tr:nth-child(2) td:nth-child(3)');
        $I->see('10', 'table:nth-of-type(1) tr:nth-child(2) td:nth-child(4)');
        $I->see('500.00', 'table:nth-of-type(1) tr:nth-child(2) td:nth-child(5)');
        // summary table
        $I->see('500.00', 'table:nth-of-type(2) tr:nth-child(1) td:nth-child(2)');
        $I->see('1,000.00', 'table:nth-of-type(2) tr:nth-child(2) td:nth-child(2)');
        $I->see('25.00', 'table:nth-of-type(2) tr:nth-child(3) td:nth-child(2)');
        $I->see('1,525.00', 'table:nth-of-type(2) tr:nth-child(4) td:nth-child(2)');
        
        // Second PO informations
        $I->see('Supplier B: PO# ABCE');
        $I->see('State: In Progress');
        // items
        $I->see('Pork', 'table:nth-of-type(3) tr:nth-child(2) td:nth-child(1)');
        $I->see('kg', 'table:nth-of-type(3) tr:nth-child(2) td:nth-child(2)');
        $I->see('25.00', 'table:nth-of-type(3) tr:nth-child(2) td:nth-child(3)');
        $I->see('10', 'table:nth-of-type(3) tr:nth-child(2) td:nth-child(4)');
        $I->see('250.00', 'table:nth-of-type(3) tr:nth-child(2) td:nth-child(5)');
        // Second summary table
        $I->see('250.00', 'table:nth-of-type(4) tr:nth-child(1) td:nth-child(2)');
        $I->see('25.00', 'table:nth-of-type(4) tr:nth-child(2) td:nth-child(2)');
        $I->see('600.00', 'table:nth-of-type(4) tr:nth-child(3) td:nth-child(2)');
        $I->see('875.00', 'table:nth-of-type(4) tr:nth-child(4) td:nth-child(2)');
        
        // Check total
        $I->see('2,400.00', '.orderTotal');
        Codeception\Module\logout($I);
    }
    
    public function OrderViewOrderInSubmitted(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('ORD-11: View an order submitted.');
        $I->amOnPage('/index.php/order/findAll');
        $I->click('#orders tr:nth-child(3) td:nth-child(9) a');
        $I->see('View Order');
        $I->see('Restaurant: Restaurant 2');
        
        // First PO informations
        $I->see('Supplier A: PO# ABCD');      
        $I->see('State: Ordered');
        // items
        $I->see('Beef', 'table:nth-of-type(1) tr:nth-child(2) td:nth-child(1)');
        $I->see('kg', 'table:nth-of-type(1) tr:nth-child(2) td:nth-child(2)');
        $I->see('50.00', 'table:nth-of-type(1) tr:nth-child(2) td:nth-child(3)');
        $I->see('10', 'table:nth-of-type(1) tr:nth-child(2) td:nth-child(4)');
        $I->see('500.00', 'table:nth-of-type(1) tr:nth-child(2) td:nth-child(5)');
        // summary table
        $I->see('500.00', 'table:nth-of-type(2) tr:nth-child(1) td:nth-child(2)');
        $I->see('150.00', 'table:nth-of-type(2) tr:nth-child(2) td:nth-child(2)');
        $I->see('25.00', 'table:nth-of-type(2) tr:nth-child(3) td:nth-child(2)');
        $I->see('675.00', 'table:nth-of-type(2) tr:nth-child(4) td:nth-child(2)');
        
        // Second PO informations
        $I->see('Supplier B: PO# ABCF');
        $I->see('State: Ordered');
        // items
        $I->see('Pork', 'table:nth-of-type(3) tr:nth-child(2) td:nth-child(1)');
        $I->see('kg', 'table:nth-of-type(3) tr:nth-child(2) td:nth-child(2)');
        $I->see('25.00', 'table:nth-of-type(3) tr:nth-child(2) td:nth-child(3)');
        $I->see('10', 'table:nth-of-type(3) tr:nth-child(2) td:nth-child(4)');
        $I->see('250.00', 'table:nth-of-type(3) tr:nth-child(2) td:nth-child(5)');
        // Second summary table
        $I->see('250.00', 'table:nth-of-type(4) tr:nth-child(1) td:nth-child(2)');
        $I->see('25.00', 'table:nth-of-type(4) tr:nth-child(2) td:nth-child(2)');
        $I->see('50.00', 'table:nth-of-type(4) tr:nth-child(3) td:nth-child(2)');
        $I->see('325.00', 'table:nth-of-type(4) tr:nth-child(4) td:nth-child(2)');
        
        // Check total
        $I->see('1,000.00', '.orderTotal');
        Codeception\Module\logout($I);
    }
    
    /******************************************************************************/
    // With codeception we will not be able to manipulate page with javascript
    // bcs it's not emulating the javascript. We will create post and look at
    // what the server give us as feedback message.
    /******************************************************************************/
    public function OrderCreateStep1Save(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('ORD-1: Create step 1 + save.');
        $I->amOnPage('/index.php/order/findAll');
        $I->click('.button_add');
        $I->see('Step 1 : Choose Products');
        $I->see('Restaurant: Restaurant 1');
        
        $I->sendAjaxPostRequest($this->postUrl . 'order/saveStep1', $this->getStep1PostParams());
        
        $I->see('The order has been saved.');
        
        // Delete the created order
        $I->amOnPage('/index.php/order/findAll');
        $I->click('#orders tr:last-child td:nth-child(11) a');
        $I->see('The order was deleted.');
        
        Codeception\Module\logout($I);
    }
    
    public function OrderCreateStep1SaveInvalidParams(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('ORD-1: Create step 1 + next.');
        $I->amOnPage('/index.php/order/findAll');
        $I->click('.button_add');
        $I->see('Step 1 : Choose Products');
        $I->see('Restaurant: Restaurant 1');
        
        $params = $this->getStep1PostParams();
        
        // Invalid Cost/unit
        $params['costPerUnit[0]'] = '-1.20';
        $I->sendAjaxPostRequest($this->postUrl . 'order/saveStep1', $params);
        $I->see('Beef of Supplier A: Cost/Unit must be a positive value');
        
        $params['costPerUnit[0]'] = 'asdasd';
        $I->sendAjaxPostRequest($this->postUrl . 'order/saveStep1', $params);
        $I->see('Beef of Supplier A: Cost/Unit must be numeric');
        
        $params['costPerUnit[0]'] = '';
        $I->sendAjaxPostRequest($this->postUrl . 'order/saveStep1', $params);
        $I->see('Beef of Supplier A: Cost/Unit must not be empty');
        
        // Reset to a valid cost/unit
        $params['costPerUnit[0]'] = '1.25';
        
        // Invalid Qty
        $params['qty[0]'] = '-1.20';
        $I->sendAjaxPostRequest($this->postUrl . 'order/saveStep1', $params);
        $I->see('Beef of Supplier A: Quantity must be a positive value');
        
        $params['qty[0]'] = 'asdasd';
        $I->sendAjaxPostRequest($this->postUrl . 'order/saveStep1', $params);
        $I->see('Beef of Supplier A: Quantity must be numeric');
        
        $params['qty[0]'] = '';
        $I->sendAjaxPostRequest($this->postUrl . 'order/saveStep1', $params);
        $I->see('Beef of Supplier A: Quantity must not be empty');
        
        $params['qty[0]'] = '0.25';
        $I->sendAjaxPostRequest($this->postUrl . 'order/saveStep1', $params);
        $I->see('Beef of Supplier A: Quantity must not an integer');
       
        Codeception\Module\logout($I);
    }
    
    public function OrderCreateStep1Next(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('ORD-1: Create step 1 + next.');
        $I->amOnPage('/index.php/order/findAll');
        $I->click('.button_add');
        $I->see('Step 1 : Choose Products');
        $I->see('Restaurant: Restaurant 1');
        
        $I->sendAjaxPostRequest($this->postUrl . 'order/nextStep1', $this->getStep1PostParams());
        
        $I->see('Step 2 : Purchase Orders');
       
        Codeception\Module\logout($I);
    }
    
    public function OrderCreateStep1NextInvalidParams(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('ORD-1: Create step 1 + next.');
        $I->amOnPage('/index.php/order/findAll');
        $I->click('.button_add');
        $I->see('Step 1 : Choose Products');
        $I->see('Restaurant: Restaurant 1');
        
        $params = $this->getStep1PostParams();
        
        // Invalid Cost/unit
        $params['costPerUnit[0]'] = '-1.20';
        $I->sendAjaxPostRequest($this->postUrl . 'order/nextStep1', $params);
        $I->see('Beef of Supplier A: Cost/Unit must be a positive value');
        
        $params['costPerUnit[0]'] = 'asdasd';
        $I->sendAjaxPostRequest($this->postUrl . 'order/nextStep1', $params);
        $I->see('Beef of Supplier A: Cost/Unit must be numeric');
        
        $params['costPerUnit[0]'] = '';
        $I->sendAjaxPostRequest($this->postUrl . 'order/nextStep1', $params);
        $I->see('Beef of Supplier A: Cost/Unit must not be empty');
        
        // Reset to a valid cost/unit
        $params['costPerUnit[0]'] = '1.25';
        
        // Invalid Qty
        $params['qty[0]'] = '-1.20';
        $I->sendAjaxPostRequest($this->postUrl . 'order/nextStep1', $params);
        $I->see('Beef of Supplier A: Quantity must be a positive value');
        
        $params['qty[0]'] = 'asdasd';
        $I->sendAjaxPostRequest($this->postUrl . 'order/nextStep1', $params);
        $I->see('Beef of Supplier A: Quantity must be numeric');
        
        $params['qty[0]'] = '';
        $I->sendAjaxPostRequest($this->postUrl . 'order/nextStep1', $params);
        $I->see('Beef of Supplier A: Quantity must not be empty');
        
        $params['qty[0]'] = '0.25';
        $I->sendAjaxPostRequest($this->postUrl . 'order/nextStep1', $params);
        $I->see('Beef of Supplier A: Quantity must not an integer');
       
        Codeception\Module\logout($I);
    }
    
    public function OrderCreateFullOrderValidateView(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('ORD-1 et 11: Create full order (step 1-3) and validate the information in view page.');
        // TODO DAVE
    }
    
    private function getStep1PostParams() {
        return array(
                'costPerUnit[0]' =>	'2.50',
                'costPerUnit[1]' =>	'2.40',
                'locationId' => '5',
                'locationName' => 'Restaurant 1',
                'orderId' => '-1',
                'originAction' => 'findAll',
                'productId[0]' => '1',
                'productId[1]' => '1',
                'productName[0]' =>	'Beef',
                'productName[1]' =>	'Beef',
                'qty[0]' =>	'1.00',
                'qty[1]' =>	'1.00',
                'subtotal' => '4.9',
                'supplierId[0]' =>	'1',
                'supplierId[1]' =>	'2',
                'supplierName[0]' => 'Supplier A',
                'supplierName[1]' => 'Supplier B',
                'unit[0]' => 'Kg',
                'unit[1]' => 'Kg');
    }
    
    // ANDREW
    // step 2 : save + verify feedback message
    // step 2 : enter invalid values + verify messages
    // step 2 -> 3 : next -> check if everything is ok
    // step 3 -> submit + save (verify that order has been add and save in order list)
}