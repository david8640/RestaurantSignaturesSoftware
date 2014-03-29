<?php
use \WebGuy;

class OrderCest {
    private $locationInTable = "//table[@id='suppliers_products']//tr[last()]//";

    public function OrderViewOrderInProgress(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('ORD-11: View an order in progress.');
        $I->amOnPage('/index.php/order/findAll');
        $I->click('#orders tr:nth-child(1) td:nth-child(9) a');
        $I->see('View Order');
        $I->see('Restaurant: Restaurant 1');
        
        // First PO informations
        $I->see('Supplier A: PO# ABCC');      
        $I->see('State: In Progress');
        // items
        $I->see('Beef', 'table:nth-of-type(1) tr:nth-child(1) td:nth-child(1)');
        $I->see('kg', 'table:nth-of-type(1) tr:nth-child(1) td:nth-child(2)');
        $I->see('50.00', 'table:nth-of-type(1) tr:nth-child(1) td:nth-child(3)');
        $I->see('10', 'table:nth-of-type(1) tr:nth-child(1) td:nth-child(4)');
        $I->see('500.00', 'table:nth-of-type(1) tr:nth-child(1) td:nth-child(5)');
        // summary table
        $I->see('500.00', 'table:nth-of-type(2) tr:nth-child(1) td:nth-child(2)');
        $I->see('1,000.00', 'table:nth-of-type(2) tr:nth-child(2) td:nth-child(2)');
        $I->see('25.00', 'table:nth-of-type(2) tr:nth-child(3) td:nth-child(2)');
        $I->see('1,525.00', 'table:nth-of-type(2) tr:nth-child(4) td:nth-child(2)');
        
        // Second PO informations
        $I->see('Supplier B: PO# ABCE');
        $I->see('State: In Progress');
        // items
        $I->see('Pork', 'table:nth-of-type(3) tr:nth-child(1) td:nth-child(1)');
        $I->see('kg', 'table:nth-of-type(3) tr:nth-child(1) td:nth-child(2)');
        $I->see('25.00', 'table:nth-of-type(3) tr:nth-child(1) td:nth-child(3)');
        $I->see('10', 'table:nth-of-type(3) tr:nth-child(1) td:nth-child(4)');
        $I->see('250.00', 'table:nth-of-type(3) tr:nth-child(1) td:nth-child(5)');
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
        $I->click('#orders tr:nth-child(2) td:nth-child(9) a');
        $I->see('View Order');
        $I->see('Restaurant: Restaurant 2');
        
        // First PO informations
        $I->see('Supplier A: PO# ABCD');      
        $I->see('State: Ordered');
        // items
        $I->see('Beef', 'table:nth-of-type(1) tr:nth-child(1) td:nth-child(1)');
        $I->see('kg', 'table:nth-of-type(1) tr:nth-child(1) td:nth-child(2)');
        $I->see('50.00', 'table:nth-of-type(1) tr:nth-child(1) td:nth-child(3)');
        $I->see('10', 'table:nth-of-type(1) tr:nth-child(1) td:nth-child(4)');
        $I->see('500.00', 'table:nth-of-type(1) tr:nth-child(1) td:nth-child(5)');
        // summary table
        $I->see('500.00', 'table:nth-of-type(2) tr:nth-child(1) td:nth-child(2)');
        $I->see('150.00', 'table:nth-of-type(2) tr:nth-child(2) td:nth-child(2)');
        $I->see('25.00', 'table:nth-of-type(2) tr:nth-child(3) td:nth-child(2)');
        $I->see('675.00', 'table:nth-of-type(2) tr:nth-child(4) td:nth-child(2)');
        
        // Second PO informations
        $I->see('Supplier B: PO# ABCF');
        $I->see('State: Ordered');
        // items
        $I->see('Pork', 'table:nth-of-type(3) tr:nth-child(1) td:nth-child(1)');
        $I->see('kg', 'table:nth-of-type(3) tr:nth-child(1) td:nth-child(2)');
        $I->see('25.00', 'table:nth-of-type(3) tr:nth-child(1) td:nth-child(3)');
        $I->see('10', 'table:nth-of-type(3) tr:nth-child(1) td:nth-child(4)');
        $I->see('250.00', 'table:nth-of-type(3) tr:nth-child(1) td:nth-child(5)');
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
        
        $I->sendAjaxPostRequest(Codeception\Module\getUrl() . 'order/saveStep1', $this->getStep1PostParams());
        
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
        $I->sendAjaxPostRequest(Codeception\Module\getUrl() . 'order/saveStep1', $params);
        $I->see('Beef of Supplier A: Cost/Unit must be a positive value');
        
        $params['costPerUnit[0]'] = 'asdasd';
        $I->sendAjaxPostRequest(Codeception\Module\getUrl() . 'order/saveStep1', $params);
        $I->see('Beef of Supplier A: Cost/Unit must be numeric');
        
        $params['costPerUnit[0]'] = '';
        $I->sendAjaxPostRequest(Codeception\Module\getUrl() . 'order/saveStep1', $params);
        $I->see('Beef of Supplier A: Cost/Unit must not be empty');
        
        // Reset to a valid cost/unit
        $params['costPerUnit[0]'] = '1.25';
        
        // Invalid Qty
        $params['qty[0]'] = '-1.20';
        $I->sendAjaxPostRequest(Codeception\Module\getUrl() . 'order/saveStep1', $params);
        $I->see('Beef of Supplier A: Quantity must be a positive value');
        
        $params['qty[0]'] = 'asdasd';
        $I->sendAjaxPostRequest(Codeception\Module\getUrl() . 'order/saveStep1', $params);
        $I->see('Beef of Supplier A: Quantity must be numeric');
        
        $params['qty[0]'] = '';
        $I->sendAjaxPostRequest(Codeception\Module\getUrl() . 'order/saveStep1', $params);
        $I->see('Beef of Supplier A: Quantity must not be empty');
        
        $params['qty[0]'] = '0.25';
        $I->sendAjaxPostRequest(Codeception\Module\getUrl() . 'order/saveStep1', $params);
        $I->see('Beef of Supplier A: Quantity must be a digit');

        Codeception\Module\logout($I);
    }
    
    public function OrderCreateStep1Next(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('ORD-1: Create step 1 + next.');
        $I->amOnPage('/index.php/order/findAll');
        $I->click('.button_add');
        $I->see('Step 1 : Choose Products');
        $I->see('Restaurant: Restaurant 1');
        
        $I->sendAjaxPostRequest(Codeception\Module\getUrl() . 'order/nextStep1', $this->getStep1PostParams());
        
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
        $I->sendAjaxPostRequest(Codeception\Module\getUrl() . 'order/nextStep1', $params);
        $I->see('Beef of Supplier A: Cost/Unit must be a positive value');
        
        $params['costPerUnit[0]'] = 'asdasd';
        $I->sendAjaxPostRequest(Codeception\Module\getUrl() . 'order/nextStep1', $params);
        $I->see('Beef of Supplier A: Cost/Unit must be numeric');
        
        $params['costPerUnit[0]'] = '';
        $I->sendAjaxPostRequest(Codeception\Module\getUrl() . 'order/nextStep1', $params);
        $I->see('Beef of Supplier A: Cost/Unit must not be empty');
        
        // Reset to a valid cost/unit
        $params['costPerUnit[0]'] = '1.25';
        
        // Invalid Qty
        $params['qty[0]'] = '-1.20';
        $I->sendAjaxPostRequest(Codeception\Module\getUrl() . 'order/nextStep1', $params);
        $I->see('Beef of Supplier A: Quantity must be a positive value');
        
        $params['qty[0]'] = 'asdasd';
        $I->sendAjaxPostRequest(Codeception\Module\getUrl() . 'order/nextStep1', $params);
        $I->see('Beef of Supplier A: Quantity must be numeric');
        
        $params['qty[0]'] = '';
        $I->sendAjaxPostRequest(Codeception\Module\getUrl() . 'order/nextStep1', $params);
        $I->see('Beef of Supplier A: Quantity must not be empty');
        
        $params['qty[0]'] = '0.25';
        $I->sendAjaxPostRequest(Codeception\Module\getUrl() . 'order/nextStep1', $params);
        $I->see('Beef of Supplier A: Quantity must be a digit');

        Codeception\Module\logout($I);
    }
    
    public function OrderCreateFullOrderValidateViewDeleteEdit(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('ORD-1, 4, 6, 7, 8, 11 & 15: Create full order (step 1-3) and validate the information in view and edit page.');
        
        $I->amOnPage('/index.php/order/findAll');
        $I->click('.button_add');
        
        // Next Step 1
        $I->see('Step 1 : Choose Products');
        $I->see('Restaurant: Restaurant 1');
        $I->sendAjaxPostRequest(Codeception\Module\getUrl() . 'order/nextStep1', $this->getStep1PostParams());
        
        // Next Step 2
        $I->see('Step 2 : Purchase Orders');
        $I->sendAjaxPostRequest(Codeception\Module\getUrl() . 'order/nextStep2', $this->getStep2PostParams());
        
        // Check step 3 content before submitting
        //////////////////////////////////////////
        $I->see('Restaurant: Restaurant 1');
        // First PO informations
        $I->see('Supplier A: PO#');      
        // items
        $I->see('Beef', 'table:nth-of-type(1) tr:nth-child(1) td:nth-child(1)');
        $I->see('kg', 'table:nth-of-type(1) tr:nth-child(1) td:nth-child(2)');
        $I->see('2.00', 'table:nth-of-type(1) tr:nth-child(1) td:nth-child(3)');
        $I->see('6', 'table:nth-of-type(1) tr:nth-child(1) td:nth-child(4)');
        $I->see('12.00', 'table:nth-of-type(1) tr:nth-child(1) td:nth-child(5)');
        // summary table
        $I->see('12.00', 'table:nth-of-type(2) tr:nth-child(1) td:nth-child(2)');
        $I->see('4.60', 'table:nth-of-type(2) tr:nth-child(2) td:nth-child(2)');
        $I->see('1.00', 'table:nth-of-type(2) tr:nth-child(3) td:nth-child(2)');
        $I->see('17.60', 'table:nth-of-type(2) tr:nth-child(4) td:nth-child(2)');
        
        // Second PO informations
        $I->see('Supplier B: PO#');
        // items
        $I->see('Beef', 'table:nth-of-type(3) tr:nth-child(1) td:nth-child(1)');
        $I->see('kg', 'table:nth-of-type(3) tr:nth-child(1) td:nth-child(2)');
        $I->see('3.00', 'table:nth-of-type(3) tr:nth-child(1) td:nth-child(3)');
        $I->see('8', 'table:nth-of-type(3) tr:nth-child(1) td:nth-child(4)');
        $I->see('24.00', 'table:nth-of-type(3) tr:nth-child(1) td:nth-child(5)');
        // Second summary table
        $I->see('24.00', 'table:nth-of-type(4) tr:nth-child(1) td:nth-child(2)');
        $I->see('6.00', 'table:nth-of-type(4) tr:nth-child(2) td:nth-child(2)');
        $I->see('3.00', 'table:nth-of-type(4) tr:nth-child(3) td:nth-child(2)');
        $I->see('33.00', 'table:nth-of-type(4) tr:nth-child(4) td:nth-child(2)');
        
        // Check total
        $I->see('50.60', '.orderTotal');
        //////////////////////////////////////////
        
        // Save & Submit
        $I->click('Save & Submit');
        $I->see('The order has been submitted.');
        
        // check if information is correct on orders page
        $I->see('Restaurant 1', '#orders tr:last-child td:nth-child(2)');
        $I->see('36.00', '#orders tr:last-child td:nth-child(4)');
        $I->see('10.60', '#orders tr:last-child td:nth-child(5)');
        $I->see('4.00', '#orders tr:last-child td:nth-child(6)');
        $I->see('50.60', '#orders tr:last-child td:nth-child(7)');
        $I->see('Submitted', '#orders tr:last-child td:nth-child(8)');
        
        // Go to view page
        $I->click('#orders tr:last-child td:nth-child(9) a');

        // Check view content after submitting
        //////////////////////////////////////////
        $I->see('Restaurant: Restaurant 1');
        // First PO informations
        $I->see('Supplier A: PO#');   
        $I->see('State: Ordered');   
        // items
        $I->see('Beef', 'table:nth-of-type(1) tr:nth-child(1) td:nth-child(1)');
        $I->see('kg', 'table:nth-of-type(1) tr:nth-child(1) td:nth-child(2)');
        $I->see('2.00', 'table:nth-of-type(1) tr:nth-child(1) td:nth-child(3)');
        $I->see('6', 'table:nth-of-type(1) tr:nth-child(1) td:nth-child(4)');
        $I->see('12.00', 'table:nth-of-type(1) tr:nth-child(1) td:nth-child(5)');
        // summary table
        $I->see('12.00', 'table:nth-of-type(2) tr:nth-child(1) td:nth-child(2)');
        $I->see('4.60', 'table:nth-of-type(2) tr:nth-child(2) td:nth-child(2)');
        $I->see('1.00', 'table:nth-of-type(2) tr:nth-child(3) td:nth-child(2)');
        $I->see('17.60', 'table:nth-of-type(2) tr:nth-child(4) td:nth-child(2)');
        
        // Second PO informations
        $I->see('Supplier B: PO#'); 
        $I->see('State: Ordered');   
        // items
        $I->see('Beef', 'table:nth-of-type(3) tr:nth-child(1) td:nth-child(1)');
        $I->see('kg', 'table:nth-of-type(3) tr:nth-child(1) td:nth-child(2)');
        $I->see('3.00', 'table:nth-of-type(3) tr:nth-child(1) td:nth-child(3)');
        $I->see('8', 'table:nth-of-type(3) tr:nth-child(1) td:nth-child(4)');
        $I->see('24.00', 'table:nth-of-type(3) tr:nth-child(1) td:nth-child(5)');
        // Second summary table
        $I->see('24.00', 'table:nth-of-type(4) tr:nth-child(1) td:nth-child(2)');
        $I->see('6.00', 'table:nth-of-type(4) tr:nth-child(2) td:nth-child(2)');
        $I->see('3.00', 'table:nth-of-type(4) tr:nth-child(3) td:nth-child(2)');
        $I->see('33.00', 'table:nth-of-type(4) tr:nth-child(4) td:nth-child(2)');
        
        // Check total
        $I->see('50.60', '.orderTotal');
        //////////////////////////////////////////
        
        // Impossible to delete this order
        $I->amOnPage('/index.php/order/findAll');
        $I->cantSeeElement('#orders tr:last-child td:nth-child(11) a');
        
        // Go to edit page
        $I->click('#orders tr:last-child td:nth-child(10) a');
        
        // check if information is correct on the edit page
        $I->see('Restaurant: Restaurant 1 ');
        // First row
        $I->see('Supplier A', 'table tr:nth-child(1) td:nth-child(1)');
        $I->see('12.00', 'table tr:nth-child(1) td:nth-child(3)');
        $I->see('4.60', 'table tr:nth-child(1) td:nth-child(4)');
        $I->see('1.00', 'table tr:nth-child(1) td:nth-child(5)');
        $I->see('17.60', 'table tr:nth-child(1) td:nth-child(6)');
        // Second row
        $I->see('Supplier B', 'table tr:nth-child(2) td:nth-child(1)');
        $I->see('24.00', 'table tr:nth-child(2) td:nth-child(3)');
        $I->see('6.00', 'table tr:nth-child(2) td:nth-child(4)');
        $I->see('3.00', 'table tr:nth-child(2) td:nth-child(5)');
        $I->see('33.00', 'table tr:nth-child(2) td:nth-child(6)');
        
        Codeception\Module\logout($I);
    }
    
    private function getStep1PostParams() {
        return array(
            'costPerUnit[0]' => '2',
            'costPerUnit[1]' => '3',
            'locationId' => '5',
            'locationName' => 'Restaurant 1',
            'orderId' => '-1',
            'originAction' => 'findAll',
            'productId[0]' => '1',
            'productId[1]' => '1',
            'productName[0]' => 'Beef',
            'productName[1]' => 'Beef',
            'qty[0]' => '6',
            'qty[1]' => '8',
            'subtotal' => '36.00',
            'supplierId[0]' => '1',
            'supplierId[1]' => '2',
            'supplierName[0]' => 'Supplier A',
            'supplierName[1]' => 'Supplier B',
            'unit[0]' => 'Kg',

            'unit[1]' => 'Kg');
    }
    
    private function getStep2PostParams() {
        return array(
            'poItemCostPerUnit[0]' => '2',
            'poItemCostPerUnit[1]' => '3',
            'restaurantId' => '5',
            'restaurantName' => 'Restaurant 1',
            'orderId' => '-1',
            'originAction' => 'findAll',
            'idOrder[0]' => '-1',
            'idOrder[1]' => '-1',
            'idSupplier[0]' => '1',
            'idSupplier[1]' => '2',
            'poItemPOID[0][0]' => '-1',
            'poItemPOID[1][0]' => '-1',
            'poItemProductID[0][0]' => '1',
            'poItemProductID[1][0]' => '1',
            'poItemProductName[0][0]' => 'Beef',
            'poItemProductName[1][0]' => 'Beef',
            'poItemProductUnitOfMeasurement[0][0]' => 'Kg',
            'poItemProductUnitOfMeasurement[1][0]' => 'Kg',
            'poItemQty[0][0]' => '6',
            'poItemQty[1][0]' => '8',
            'poNumber[0]' => '-1',
            'poNumber[1]' => '-1',
            'shipping[0]' => '4.60',
            'shipping[1]' => '6.00',
            'subtotal[0]' => '12',
            'subtotal[1]' => '24',
            'supplierName[0]' => 'Supplier A',
            'supplierName[1]' => 'Supplier B',
            'supplierPONumber[0]' => date("Y-m-dH:i:s"),
            'supplierPONumber[1]' => date("Y-m-dH:i:s") . ' 1',
            'taxes[0]' => '1.00',
            'taxes[1]' => '3.00',
            'total' => '50.60',
            'totalCost[0]' => '17.6',
            'totalCost[1]' => '33.0');
    }

    private function getStep1PostParamsv2() { // This is a sample POST for step 1
        return array(
            'costPerUnit[0]' => '50.00',
            'costPerUnit[1]' => '25.00',
            'locationId' =>  '5',
            'locationName'  =>  'Restaurant 1',
            'orderId' => '1',
            'originAction'  =>  'findAll',
            'productId[0]'  =>  '1',
            'productId[1]'  =>  '2',
            'productName[0]' => 'Beef',
            'productName[1]' => 'Pork',
            'qty[0]' => '10',
            'qty[1]' => '10',
            'search_cost_per_unit'  =>  'Search cost/unit',
            'search_product' => 'Search product',
            'search_supplier' => 'Search supplier',
            'search_unit' => 'Search unit',
            'subtotal'  =>  '750',
            'supplierId[0]' =>  '1',
            'supplierId[1]' =>  '2',
            'supplierName[0]' =>  'Supplier A',
            'supplierName[1]' =>  'Supplier B',
            'suppliers_products_length' => '10',
            'unit[0]' => 'kg',
            'unit[1]' => 'kg');
    }

    private function getStep2PostParamsv2() { // This is a sample POST for Step 2 and 3
        return array(
            'idOrder[0]' => '1',
            'idOrder[1]' => '1',
            'idSupplier[0]' =>  '1',
            'idSupplier[1]'  => '2',
            'orderId' =>'1',
            'originAction'  =>  'findAll',
            'poItemCostPerUnit[0][0]' =>'50.00',
            'poItemCostPerUnit[1][0]'=> '25.00',
            'poItemPOID[0][0]'  =>  '-1',
            'poItemPOID[1][0]'  =>  '-1',
            'poItemProductID[0][0]'  => '1',
            'poItemProductID[1][0]' =>  '2',
            'poItemProductName[0][0]' =>'Beef',
            'poItemProductName[1][0]' =>'Pork',
            'poItemProductUnitOfMeasurement' =>   'kg',
            'poItemProductUnitOfMeasurement'  =>  'kg',
            'poItemQty[0][0]' =>'10',
            'poItemQty[1][0]'=> '10',
            'poNumber[0]' =>'-1',
            'poNumber[1]' =>'-1',
            'restaurantId'  => '5',
            'restaurantName' => 'Restaurant 1',
            'shipping[0]' =>'0.00',
            'shipping[1]' =>'0.00',
            'subtotal[0]' =>'500',
            'subtotal[1]' =>'250',
            'supplierName[0]'=> 'Supplier A',
            'supplierName[1]' =>'Supplier B',
            'supplierPONumber[0]'=> 'DCBA1',
            'supplierPONumber[1]'=> 'DCBA2',
            'taxes[0]' =>   '65.00',
            'taxes[1]' =>   '32.50',
            'total'   =>'847.5',
            'totalCost[0]'   => '565',
            'totalCost[1]'  =>  '282.5');
    }


    // step 2 : save + verify feedback message
    public function OrderModifyAndVerifyInStep2(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('ORD-2, 7, 10, 11, & 12: Modify an order in step 2, save the modification, and verify.');

        $I->amOnPage('/index.php/order/findAll');
        $I->click('#orders tr:nth-child(1) td:nth-child(10) a'); //I click to edit the first order in the list.
        $I->see('Step 1 : Choose Products');

        // Move on to step 2
        $I->see('Restaurant: Restaurant 1');
        $I->sendAjaxPostRequest(Codeception\Module\getUrl() . 'order/nextStep1', $this->getStep1PostParamsv2());
        $I->see('Step 2 : Purchase Orders');

        // Modify both PO#'s, and save.
        $I->sendAjaxPostRequest(Codeception\Module\getUrl() . 'order/saveStep2', $this->getStep2PostParamsv2());
        // Verify the system's feedback beleives the changes were saved.
        $I->see('The order has been saved.');

        Codeception\Module\logout($I);
    }

    // step 2 : enter invalid values + verify messages
    public function OrderModifyInvalidValuesInStep2(\WebGuy $I) {
        Codeception\Module\login($I);
        $I->wantTo('ORD-2, 7, 10, 11, & 12: Modify an order in Step 2 with invalid data and try to save');

        $I->amOnPage('/index.php/order/findAll');
        $I->click('#orders tr:nth-child(1) td:nth-child(10) a'); //I click to edit the first order in the list.
        $I->see('Step 1 : Choose Products');

        // Move on to step 2
        $params =  $this->getStep1PostParamsv2();
        $I->sendAjaxPostRequest(Codeception\Module\getUrl() . 'order/nextStep1', $params);
        $I->see('Step 2 : Purchase Orders');

        //setup params for saving step 2
        $params =  $this->getStep2PostParamsv2();

        // INVALID PO#s
        $params['supplierPONumber[0]'] = ''; // null
        $I->sendAjaxPostRequest(Codeception\Module\getUrl() . 'order/saveStep2', $params);
        $I->see('Supplier A: PO# must not be empty');
        $params['supplierPONumber[0]'] = 'DCBA1'; // reset to oringal value

        $params['supplierPONumber[0]'] = 'ABCD'; // duplicate
        $I->sendAjaxPostRequest(Codeception\Module\getUrl() . 'order/saveStep2', $params);
        $I->see('Supplier A: PO# must be unique.');
        $params['supplierPONumber[1]'] = 'DCBA1'; // reset to original value


        //INVALID SHIPPING VALUES (non-numeric, and negative)
        $params['shipping[0]'] = '-10.00'; // negative
        $I->sendAjaxPostRequest(Codeception\Module\getUrl() . 'order/saveStep2', $params);
        $I->see('Supplier A: Shipping must be a positive value');

        $params['shipping[0]'] = 'abcd'; // non-numeric should be replaced by 0.00
        $I->sendAjaxPostRequest(Codeception\Module\getUrl() . 'order/saveStep2', $params);
        $I->see('Supplier A: Shipping must be numeric');


        Codeception\Module\logout($I);
    }

    // step 2 -> 3 : next -> check if everything is ok
    public function OrderStep2To3TransitionVerification(\WebGuy $I) {
        Codeception\Module\login($I);

        //I want to...
        $I->wantTo('ORD-12: The system shall allow the user to record a PO number');

        //Go to '/index.php/order/findAll'
        $I->amOnPage('/index.php/order/findAll');

        // Move on to step 2
        $I->click('#orders tr:nth-child(1) td:nth-child(10) a'); //I click to edit the first order in the list.
        $I->see('Step 1 : Choose Products');
        $params =  $this->getStep1PostParamsv2();
        $I->sendAjaxPostRequest(Codeception\Module\getUrl() . 'order/nextStep1', $params);
        $I->see('Step 2 : Purchase Orders');

        // setup params for moving on to step 3.
        $params =  $this->getStep2PostParamsv2();
        

        // Change PO#
        $params['supplierPONumber[0]'] = '666';

        // Change Shipping cost
        $params['shipping[0]'] = '69.99';

        // Change Taxes
        $params['taxes[0]'] = '13.33';

        // Press next
        $I->sendAjaxPostRequest(Codeception\Module\getUrl() . 'order/nextStep2', $params);

        // Verify PO#
        $I->See('666');

        // Verify shipping cost
        $I->See('69.99');

        // Verify taxes
        $I->See('13.33');

        Codeception\Module\logout($I);
    }


    // step 3 -> submit + save (verify that order has been add and save in order list)
    public function OrderCreateAndVerifyCreation(\WebGuy $I) {
        Codeception\Module\login($I);

        //I want to...
        $I->wantTo('ORD-1, 2, 3: create and delete an order, and verify it was created and deleted.');

        //Go to '/index.php/order/findAll'
        $I->amOnPage('/index.php/order/findAll');

        // Create a new order
        $I->click('.button_add');
        $I->see('Step 1 : Choose Products');

        // Get Params to fill in data in table:
        $params =  $this->getStep1PostParams();

        // Move on to Step 2
        $I->sendAjaxPostRequest(Codeception\Module\getUrl() . 'order/nextStep1', $params);
        $I->see('Step 2 : Purchase Orders');

        // Get Params for POST from step 2 --> step 3
        $params =  $this->getStep2PostParams();

        // Move on to Step 3
        $I->sendAjaxPostRequest(Codeception\Module\getUrl() . 'order/nextStep2', $params);
        $I->see('Step 3 : Review');
        
        // Save step 3
        $I->sendAjaxPostRequest(Codeception\Module\getUrl() . 'order/saveStep3', $params);

        // Verify
        $I->see('The order has been submitted.');

        // Verify there is an order with the correct total present
        $I->see('50.60');

        Codeception\Module\logout($I);
    }

}