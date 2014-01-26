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
     * Step 1 of the order wizards.
     */
    public function action_getInfoStep1() {
        // Get all the information from the repository.
        $repo = new Repository_SupplierProduct();
        $products = $repo->getProducts();
        
        // Transfer the information to the view.
        $view = View::factory('order/step1')
                    ->set('products', $products);
        
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