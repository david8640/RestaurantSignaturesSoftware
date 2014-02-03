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
        
        var_dump($orders);

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
        $selectedLocation = $this->template->global_selected_location;
        $this->RedirectIfInvalidSelectedLocation($selectedLocation, 'access the orders list');
        
        // Get all the information from the repository.
        $repo = new Repository_Order();
        $orders = $repo->getRestaurantOrders($selectedLocation);
        
        // Transfer the information to the view.
        $view = View::factory('order/restaurantOrders')
                    ->set('orders', $orders);
        
        $this->template->title = __('Orders');
        $this->template->content = $view;
    }
    
    /**
     * Setup step 1 of the order wizards.
     */
    public function action_getStep1() {
        $selectedLocation = $this->template->global_selected_location;
        $this->RedirectIfInvalidSelectedLocation($selectedLocation, 'create an order');
        
        // Get all the information from the repository.
        $repo = new Repository_SupplierProduct();
        $products = $repo->getAll();
        
        // Transfer the information to the view.
        $view = View::factory('order/step1')
                    ->set('products', $products)
                    ->set('restaurants', $this->template->locations)
                    ->set('global_selected_location', $selectedLocation);
        
        $this->template->title = __('');
        $this->template->content = $view;
    }
    
    /**
     * Save step 1 of the order wizards.
     */
    public function action_saveStep1() {
        if (isset($_POST) && Valid::not_empty($_POST)) {
            // Get the products ordered and validate it.
            $returnValues = $this->getProductsOrdered($_POST);
            $productsOrdered = $returnValues[0];
            $total = $returnValues[1];
            $errors = $returnValues[2];
            
            // if there is any errors in the products ordered a feedback message
            // is send and the elements are not save in the database.
            if (count($errors) == 0) {
                // Get the current date
                $now = date('d/m/Y'); 
                // Get the location id an validate it.
                $returnValues = $this->getLocationId($_POST);
                $restaurantId = $returnValues[0];
                $errors = $returnValues[1];
                
                // if the location id is invalid a feedback message is send 
                // and nothing is save in the database.
                if (count($errors) == 0) {
                    // Save the order to the database.
                    $order = new Model_Order(-1, $restaurantId, '', $now, $total, 0, 0, 0, Constants_OrderState::IN_PROGRESS, '');
                    $orderRepo = new Repository_Order();
                    $orderId = $orderRepo->save($order);

                    $feedbackMessage = array();
                    // Check that the order was insert properly.
                    if ($orderId == -1) {
                        // if the order as not been create add an error message.
                        array_push($feedbackMessage, 'An error occured.');
                    } else {
                        $purchaseOrders = $this->createPurchaseOrders($orderId, $now, $productsOrdered);
                        // Save the purchase orders and purchase order items to the database.
                        $poRepo = new Repository_PurchaseOrder();
                        $success = $poRepo->save($purchaseOrders);    

                        // If there was a problem remove the order from the database
                        // and add a feedback message.
                        if (!$success) {
                            array_push($feedbackMessage, 'The purchases orders cannot be created.');

                            // Delete the order save earlier to avoid problem
                            $removeSuccess = $orderRepo->delete($orderId);
                            if (!$removeSuccess) {
                                array_push($feedbackMessage, 'The order cannot be deleted successfully.');
                            }
                        } else {
                            array_push($feedbackMessage, 'The order has been saved.');
                        }
                    }
                } else {
                    $feedbackMessage = $errors;
                }
            } else {
                $feedbackMessage = $errors;
            }

            // Get all the information from the repository about the products
            $repo = new Repository_SupplierProduct();
            $products = $repo->getAll();

            // Transfer the information to the view.
            $view = View::factory('order/step1')
                        ->set('products', $products)
                        ->set('productsOrdered', $productsOrdered)
                        ->set('restaurants', $this->template->locations)
                        ->set('global_selected_location', $this->template->global_selected_location);

            $this->template->feedbackMessage = $feedbackMessage;
            $this->template->title = __('');
            $this->template->content = $view;
        } else {
            // Empty POST
            Session::instance()->set('feedbackMessage', array('An error occured.'));
            $this->redirect ('index/index');
        }
    }

    /**
     * Next step 1 of the order wizards.
     */
    public function action_nextStep1() {
        // TODO - IMPLEMENTATION SIMILAR TO saveStep1
        
        /* TO REMOVE */
        /* START */
        $po1 = new Model_PurchaseOrder(1, 1, 1, 'DAV5658', 'Supplier 1', '29-01-14', '', 500, 0, 0, 500, 0);
        $po2 = new Model_PurchaseOrder(2, 2, 5, 'DAV2525', 'Supplier 2', '29-01-14', '', 250, 0, 0, 250, 0);
        $po3 = new Model_PurchaseOrder(3, 3, 4, 'DAV4040', 'Supplier 3', '29-01-14', '', 30, 0, 0, 30, 0);
        
        $purchaseOrders = array($po1, $po2, $po3);
        /* END */
        
        // Transfer the information to the view.
        $view = View::factory('order/step2')
                    ->set('purchaseOrders', $purchaseOrders);
        
        $this->template->title = __('');
        $this->template->content = $view;
    }
    
    /**
     * Redirect to the index if the selected location is invalid.
     * @param type $selectedLocation The selected location id
     * @param type $errorMessage The error message.
     */
    private function RedirectIfInvalidSelectedLocation($selectedLocation, $errorMessage) {
        if (!isset($selectedLocation) || $selectedLocation == -1) {
            Session::instance()->set('feedbackMessage', array('You cannot ' . $errorMessage . ' because you don\'t have access to at least one restaurant.'));
            $this->redirect('index/index');
        }
    }
    
    /**
     * Get the products ordered from the post. It also validate the fields.
     * @param $_POST $post
     * @return [0] : products ordered list
     *         [1] : total cost of all products ordered
     *         [2] : array containing errors if some fields are not valid
     */
    private function getProductsOrdered($post) {
        $index = 0;
        $total = 0;
        $productsOrdered = array();
        $errors = array();
        while (isset($post['productId'][$index])) {
            $vf = $this->getSupplierProductValidationFactory($post, $index);
            
            $product = new Model_SupplierProduct($vf['productId'], 
                    $vf['productName'], $vf['supplierId'], 
                    $vf['supplierName'], $vf['unit'], 
                    $vf['costPerUnit'], $vf['qty']);
            array_push($productsOrdered, $product);
            $total = $product->getQty() * $product->getCostPerUnit();
                
            if (!$vf->check()) {
                // Add the messages to the errors array
                foreach ($vf->errors('orders') as $i) {
                    array_push($errors, $i);
                }
            }
            $index++;
        
        }
        return array($productsOrdered, $total, $errors);
    }
    
    /**
     * Get the location id from the post. It also validate it.
     * @param $_POST $post
     * @return [0] : LocationId
     *         [1] : array containing errors if the field is not valid
     */
    private function getLocationId($post) {
        $vf = $this->getLocationValidationFactory($post);
        $errors = array();
        
        if(!$vf->check()) {
            $errors = $vf->errors('location');
        }
        return array($vf['locationId'], $errors);
    }
    
    /**
     * Build all the purchase orders from the orderId, date and products ordered.
     * @param int $orderId
     * @param string $now (date)
     * @param list of SupplierProducts $productsOrdered
     * @return \Model_PurchaseOrder
     */
    private function createPurchaseOrders($orderId, $now, $productsOrdered) {
        $purchaseOrders = array();
        foreach ($productsOrdered as $p) {
            $supplierId = $p->getSupplierID();
            if (!array_key_exists($supplierId, $purchaseOrders)) { 
                $purchaseOrders[$supplierId] = new Model_PurchaseOrder(-1, $orderId, $supplierId, '', '', $now, '', 0, 0, 0, 0, Constants_PurchaseOrderState::IN_PROGRESS);
            }
            $purchaseOrderItem = new Model_PurchaseOrderItem(-1, $p->getProductID(), $p->getQty(), $p->getCostPerUnit());
            $purchaseOrders[$supplierId]->addToSubtotal($purchaseOrderItem->getSubtotal());
            $purchaseOrders[$supplierId]->addItem($purchaseOrderItem);
        }
        return $purchaseOrders;
    }
    
    /**
     * Get the validation object.
     * @param $_POST The post variable of the request
     * @param int The index of the current element in the post (fields are in arrays)
     * @return Validation::factory
     */
    private function getSupplierProductValidationFactory($post, $index) {
        $textIdentifyingSupplierProduct = $post['productName'][$index] . ' of ' . $post['supplierName'][$index] . ': ';
        return Validation::factory(
                array('productId' => $post['productId'][$index], 
                      'productName' => $post['productName'][$index], 
                      'supplierId' => $post['supplierId'][$index],
                      'supplierName' => $post['supplierName'][$index], 
                      'unit' => $post['unit'][$index], 
                      'costPerUnit' => $post['costPerUnit'][$index], 
                      'qty' => $post['qty'][$index]))
                ->rule('productId', 'not_empty')
                ->label('productId', $textIdentifyingSupplierProduct . 'Product Id')
                ->rule('supplierId', 'not_empty')
                ->label('supplierId', $textIdentifyingSupplierProduct . 'Supplier Id')
                ->rule('costPerUnit', 'not_empty')
                ->rule('costPerUnit', 'numeric')
                ->rule('costPerUnit', 'ValidationExtension::positive_number')
                ->label('costPerUnit', $textIdentifyingSupplierProduct . 'Cost/Unit')
                ->rule('qty', 'not_empty')
                ->rule('qty', 'numeric')
                ->rule('qty', 'ValidationExtension::positive_number')
                ->label('qty', $textIdentifyingSupplierProduct . 'Quantity');
    }
    
    /**
     * Get the validation object.
     * @param $_POST The post variable of the request
     * @return Validation::factory
     */
    private function getLocationValidationFactory($post) {
        return Validation::factory($post)
                ->rule('locationId', 'not_empty')
                ->label('locationId', 'Location Id');
    }
}

?>