<?php
/* 
 *  <copyright file="Order.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>Andrew Assaly</author>
 *  <date>2014-01-19</date>
 *  <summary>The controller that handle all the manipulation with regards to orders.</summary>
 */
class Controller_Order extends Controller_Template_Generic {
    /**
     * Get all the orders.
     */
    public function action_findAll() {
        // Get all the information from the repository.
        $repo = new Repository_Order();
        $orders = $repo->getAll();
        
        // Transfer the information to the view.
        $view = View::factory('order/orders')
                    ->set('orders', $orders);
        
        $this->template->title = __('Orders');
        $this->template->content = $view;
    }

    /**
     * Get all the orders for a restaurant.
     */
    public function action_getRestaurantOrders() {
        // Get all the information from the repository.
        $repo = new Repository_Order();
        $orders = $repo->getRestaurantOrders();
        
        // Transfer the information to the view.
        $view = View::factory('order/orders')
                    ->set('orders', $orders);
        
        $this->template->title = __('Orders');
        $this->template->content = $view;
    }
    
    /**
     * Setup step 1 of the order wizards.
     */
    public function action_getInfoStep1() {
        // Get all the information from the repository.
        /*$repo = new Repository_SupplierProduct();
        $products = $repo->getProducts();*/
        $p1 = new Model_SupplierProduct(1, 'product 1', 1, 'supplier 1', 'kg', 25, 0);
        $p2 = new Model_SupplierProduct(2, 'product 2', 3, 'supplier 3', 'L', 10, 0);
        $p3 = new Model_SupplierProduct(3, 'product 3', 2, 'supplier 2', 'g', 5.25, 0);
        
        $products = array($p1, $p2, $p3);
        
        // Transfer the information to the view.
        $view = View::factory('order/step1')
                    ->set('products', $products);
        
        $this->template->title = __('Place Order : Step 1');
        $this->template->content = $view;
    }
    
    /**
     * Save step 1 of the order wizards.
     */
    public function action_saveStep1() {
        $productsOrdered = array();
        $index = 0;
        while (isset($_POST['productId'][$index])) {
            $product = new Model_SupplierProduct($_POST['productId'][$index], 
                    $_POST['productName'][$index], $_POST['supplierId'][$index], 
                    $_POST['supplierName'][$index], $_POST['unit'][$index], 
                    $_POST['costPerUnit'][$index], $_POST['qty'][$index]);
            array_push($productsOrdered, $product);
            $index++;
        }
        
        // Get all the information from the repository.
        /*$repo = new Repository_SupplierProduct();
        $products = $repo->getProducts();*/
        $p1 = new Model_SupplierProduct(1, 'product 1', 1, 'supplier 1', 'kg', 25, 0);
        $p2 = new Model_SupplierProduct(2, 'product 2', 3, 'supplier 3', 'L', 10, 0);
        $p3 = new Model_SupplierProduct(3, 'product 3', 2, 'supplier 2', 'g', 5.25, 0);
        
        $products = array($p1, $p2, $p3);
        
        // Transfer the information to the view.
        $view = View::factory('order/step1')
                    ->set('products', $products)
                    ->set('productsOrdered', $productsOrdered);
        
        $this->template->title = __('Place Order : Step 1');
        $this->template->content = $view;
    }

    /**
     * Get the check users in a specific format (userid1, userid2, ...)
     */
    /*private function getformattedCheckUsers($checkedValues) {
        $formattedStr = '';
        foreach($checkedValues as $value){
            $formattedStr .= $value.',';
        }
        return $formattedStr;
    }*/
    
    /**
     * Place an order.
     */
    /*public function action_order() {
        // Get all the information from the repository.
        $repo = new Repository_Order();
        $orders = $repo->getProducts();
        
        // Transfer the information to the view.
        $view = View::factory('order/orderList')
                    ->set('orders', $orders);
        
        $this->template->title = __('Order List');
        $this->template->content = $view;
    }*/
}

?>