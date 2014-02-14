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
     * Initiate the edition of an order.
     */
    public function action_edit() {
        $id = $this->request->param('id');
        $lastAction = $this->request->param('lastAction');
        // Validate id
        if (!(Valid::not_empty($id) && Valid::numeric($id))) {
            Session::instance()->set('feedbackMessage', array('Invalid product id.'));
            $this->redirect ('order/' . $lastAction);
        }
        
        // Get the order to edit
        $repoOrder = new Repository_Order();
        $order = $repoOrder->get($id);

        // The id do not refer to a valid order
        if (!is_object($order)) {
            Session::instance()->set('feedbackMessage', array('Invalid order id.'));
            $this->redirect ('order/' . $lastAction);
        }
        
        // Get all the products
        $repoProd = new Repository_SupplierProduct();
        $products = $repoProd->getAll();
        // Get all the products ordered
        $repoPOI = new Repository_PurchaseOrderItem();
        $purchaseOrderItems = $repoPOI->getAll($order->getOrderID());
        $productsOrdered = $this->convertPurchaseOrderItemsToSupplierProducts($purchaseOrderItems);        
        
        $view = View::factory('order/step1')
                ->set('products', $products)
                ->set('productsOrdered', $productsOrdered)
                ->set('orderId', $order->getOrderID())
                ->set('restaurants', $this->template->locations)
                ->set('global_selected_location', $order->getRestaurantID());
        
        $this->template->title = __('');
        $this->template->content = $view;
    }
    
    /**
     * Delete an order.
     */
    public function action_delete() {
        $id = $this->request->param('id');
        $lastAction = $this->request->param('lastAction');
        
        // Validate id
        if (!(Valid::not_empty($id) && Valid::numeric($id))) {
            Session::instance()->set('feedbackMessage', array('Invalid order id.'));
            $this->redirect ('order/' . $lastAction);
        }
        
        // Delete the product
        $repo = new Repository_Order();
        $success = $repo->delete($id);
        
        // Delete failed
        if (!$success) {
            Session::instance()->set('feedbackMessage', array('An error occuring while deleting the order.'));
            $this->redirect ('order/' . $lastAction);
        }
        
        // Delete succeed
        Session::instance()->set('feedbackMessage', array('The order was deleted.'));
        $this->redirect ('order/' . $lastAction);
    }
    
    /*****************************************************************************/
    /*/ Step 1
    /*****************************************************************************/
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
            
            // Initialize
            $orderSavedId = -1;
            $restaurantId = $_POST['locationId'];
                    
            // if there is any errors in the products ordered a feedback message
            // is send and the elements are not save in the database.
            if (count($errors) == 0) {
                // Get the current date
                $now = date(Constants_Constants::dateFormat); 
                // Get the restaurant id an validate it.
                $returnValues = $this->getRestaurant($_POST);
                $restaurant = $returnValues[0];
                $errors = $returnValues[1];
                
                // if the location id is invalid a feedback message is send 
                // and nothing is save in the database.
                if (count($errors) == 0) {
                    // Get the order id if exists
                    $orderId = (isset($_POST['orderId'])) ? $_POST['orderId'] : -1;
                    
                    // Save the order to the database.
                    $order = new Model_Order($orderId, $restaurantId, '', $now, $total, 0, 0, 0, Constants_OrderState::IN_PROGRESS, '');
                    $orderRepo = new Repository_Order();
                    $orderSavedId = $orderRepo->save($order);

                    $feedbackMessage = array();
                    // Check that the order was insert properly.
                    if ($orderSavedId == -1) {
                        // if the order as not been create add an error message.
                        array_push($feedbackMessage, 'An error occured.');
                    } else {
                        $purchaseOrders = $this->createPurchaseOrders($orderSavedId, $now, $productsOrdered);
                        // Save the purchase orders and purchase order items to the database.
                        $poRepo = new Repository_PurchaseOrder();
                        $success = $poRepo->save($orderSavedId, $purchaseOrders);    

                        // If there was a problem remove the order from the database
                        // and add a feedback message.
                        if (!$success) {
                            array_push($feedbackMessage, 'The purchases orders cannot be created.');

                            // Delete the order save earlier to avoid problem
                            $removeSuccess = $poRepo->deleteAllPurchaseOrdersOfOrder($orderSavedId);
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
                        ->set('orderId', $orderSavedId)
                        ->set('restaurants', $this->template->locations)
                        ->set('global_selected_location', $restaurant->getId());

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
        if (isset($_POST) && Valid::not_empty($_POST)) {
            // Get the products ordered and validate it.
            $returnValues = $this->getProductsOrdered($_POST);
            $productsOrdered = $returnValues[0];
            $total = $returnValues[1];
            $errors = $returnValues[2];
            
            // Initialize
            $orderId = -1;
            $restaurantId = $_POST['locationId'];
            $feedbackMessage = array();
            
            // if there is any errors in the products ordered a feedback message
            // is send and the elements are not save in the database.
            if (count($errors) == 0) {
                // Get the current date
                $now = date(Constants_Constants::dateFormat); 
                // Get the restaurant id an validate it.
                $returnValues = $this->getRestaurant($_POST);
                $restaurant = $returnValues[0];
                $errors = $returnValues[1];
                
                // if the location id is invalid a feedback message is send 
                // and nothing is save in the database.
                if (count($errors) == 0) {
                    // Get the order id if exists
                    $orderId = (isset($_POST['orderId'])) ? $_POST['orderId'] : -1;

                    // Create an order from the first step
                    $order = new Model_Order($orderId, $restaurant->getId(), $restaurant->getName(), $now, $total, 0, 0, 0, Constants_OrderState::IN_PROGRESS, '');
                    
                    // Create the list of purchase order from the first step
                    $purchaseOrders = $this->createPurchaseOrders($orderId, $now, $productsOrdered);
                    
                    // Update the information of all the purchase orders from the existing one
                    $this->updatePurchaseOrderInformations($orderId, $purchaseOrders);
                } else {
                    $feedbackMessage = $errors;
                }
            } else {
                $feedbackMessage = $errors;
            }
            
            // Transfer the information to the view.
            if (!empty($feedbackMessage)) {
                $repo = new Repository_SupplierProduct();
                $products = $repo->getAll();
                
               $view = View::factory('order/step1')
                           ->set('products', $products)
                           ->set('productsOrdered', $productsOrdered)
                           ->set('orderId', $orderId)
                           ->set('restaurants', $this->template->locations)
                           ->set('global_selected_location', $restaurant->getId());
               $this->template->feedbackMessage = $feedbackMessage;
            } else {
                 $view = View::factory('order/step2')
                                    ->set('order', $order)    
                                    ->set('purchaseOrders', $purchaseOrders);
            }

            $this->template->title = __('');
            $this->template->content = $view;
        } else {
            // Empty POST
            Session::instance()->set('feedbackMessage', array('An error occured.'));
            $this->redirect ('index/index');
        }
    }
    
    /**
     * Get the existing purchase order from the database. Compare the existing one 
     * with the new one and update the new according to the existing one.
     * @param int $orderId
     * @param list Purchase Orders $purchaseOrders
     */
    private function updatePurchaseOrderInformations($orderId, $purchaseOrders) {
        $repo = new Repository_PurchaseOrder();
        $existingPOs = $repo->getAllByOrderId($orderId);
        
        foreach ($purchaseOrders as $po) {
            foreach ($existingPOs as $epo) {
                if ($po->getOrderID() == $epo->getOrderID() && $po->getSupplierID() == $epo->getSupplierID()) {
                    $po->setSupplierPONumber($epo->getSupplierPONumber());
                }
            }   
        }
    }
    
    /**
     * Convert a purchase order item to a supplier product 
     * @param list $purchaseOrderItems
     * @return list of SupplierProduct
     */
    private function convertPurchaseOrderItemsToSupplierProducts($purchaseOrderItems) {
        $products = array();
        foreach ($purchaseOrderItems as $poi) {
            $p = new Model_SupplierProduct($poi->getProductID(), $poi->getProductName(),
                            $poi->getSupplierID(), $poi->getSupplierName(), 
                            $poi->getUnitOfMeasurement(), $poi->getCostPerUnit(), 
                            $poi->getQty());
            array_push($products, $p);   
        }
        return $products;
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
     * Get the restaurant from the post. It also validate it.
     * @param $_POST $post
     * @return [0] : Restaurant
     *         [1] : array containing errors if the field is not valid
     */
    private function getRestaurant($post) {
        $vf = $this->getRestaurantValidationFactory($post);
        $errors = array();
        
        if(!$vf->check()) {
            $errors = $vf->errors('restaurant');
        }
        $restaurant = new Model_Restaurant($vf['locationId'], $vf['locationName'], '');
        
        return array($restaurant, $errors);
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
            $supplierName = $p->getSupplierName();
            if (!array_key_exists($supplierId, $purchaseOrders)) { 
                $purchaseOrders[$supplierId] = new Model_PurchaseOrder(-1, $orderId, $supplierId, NULL, $supplierName, $now, '', 0, 0, 0, 0, Constants_PurchaseOrderState::IN_PROGRESS, array());
            }
            
            $purchaseOrderItem = new Model_PurchaseOrderItem(-1, $p->getProductID(), $p->getProductName(), 
                                                            $p->getCostPerUnit(), $p->getQty(), 
                                                            $p->getUnitOfMeasurement(), -1, '');
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
    private function getRestaurantValidationFactory($post) {
        return Validation::factory($post)
                ->rule('locationId', 'not_empty')
                ->label('locationId', 'Location Id')
                ->rule('locationName', 'not_empty')
                ->label('locationName', 'Location Name');
    }
    
    /*****************************************************************************/
    /*/ Step 2
    /*****************************************************************************/
    /**
     * Save step 2 of the order wizards.
     */
    public function action_saveStep2() {
        if (isset($_POST) && Valid::not_empty($_POST)) {
            // Get the order
            $returnValues = $this->getOrder($_POST);
            $order = $returnValues[0];
            $errors = $returnValues[1];
            
            if (count($errors) == 0) {
                // Get the products ordered and validate it.
                $returnValues = $this->getPurchaseOrders($_POST);
                $purchaseOrders = $returnValues[0];
                $subtotal = $returnValues[1];
                $shipping = $returnValues[2];
                $taxes = $returnValues[3];
                $total = $returnValues[4];
                $errors = $returnValues[5];
                
                $feedbackMessage = array();
                if (count($errors) == 0) {
                    // Update the order variables accordint to the purchase orders
                    $order->setSubtotal($subtotal);
                    $order->setShippingCost($shipping);
                    $order->setTaxes($taxes);
                    $order->setTotalCost($total);
                    
                    // Save the order to the database.
                    $orderRepo = new Repository_Order();
                    $orderSavedId = $orderRepo->save($order);
                    
                    // Check that the order was insert properly.
                    if ($orderSavedId == -1) {
                        // if the order as not been create add an error message.
                        array_push($feedbackMessage, 'An error occured.');
                    } else {
                        // Set the order id
                        $order->setOrderID($orderSavedId);
                        
                        // Save the purchase orders and purchase order items to the database.
                        $poRepo = new Repository_PurchaseOrder();
                        $success = $poRepo->save($orderSavedId, $purchaseOrders);    

                        // If there was a problem remove the order from the database
                        // and add a feedback message.
                        if (!$success) {
                            array_push($feedbackMessage, 'The purchases orders cannot be created.');

                            // Delete the order save earlier to avoid problem
                            $removeSuccess = $poRepo->deleteAllPurchaseOrdersOfOrder($orderSavedId);
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

            // Transfer the information to the view.
            $view = View::factory('order/step2')
                                ->set('order', $order)    
                                ->set('purchaseOrders', $purchaseOrders);

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
     * Next step 2 of the order wizards.
     */
    public function action_nextStep2() {
        if (isset($_POST) && Valid::not_empty($_POST)) {
            // Get the order
            $returnValues = $this->getOrder($_POST);
            $order = $returnValues[0];
            $errors = $returnValues[1];
            
            $feedbackMessage = array();
            if (count($errors) == 0) {
                // Get the products ordered and validate it.
                $returnValues = $this->getPurchaseOrders($_POST);
                $purchaseOrders = $returnValues[0];
                $subtotal = $returnValues[1];
                $shipping = $returnValues[2];
                $taxes = $returnValues[3];
                $total = $returnValues[4];
                $errors = $returnValues[5];
                
                $feedbackMessage = array();
                if (count($errors) == 0) {
                    // Update the order variables accordint to the purchase orders
                    $order->setSubtotal($subtotal);
                    $order->setShippingCost($shipping);
                    $order->setTaxes($taxes);
                    $order->setTotalCost($total);                  
                } else {
                    $feedbackMessage = $errors;
                } 
            } else {
                $feedbackMessage = $errors;
            }
            
            $nextPage = 'order/step3';
            // Transfer the information to the view.
            if (!empty($feedbackMessage)) {
                $nextPage = 'order/step2';
            }       
                
            $view = View::factory($nextPage)
                        ->set('order', $order)    
                        ->set('purchaseOrders', $purchaseOrders);

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
     * Get the order from the post. It also validate the fields.
     * @param $_POST $post
     * @return [0] : order
     *         [2] : array containing errors if some fields are not valid
     */
    private function getOrder($post) {
        $vf = $this->getOrderValidationFactory($post);
        $errors = array();
        
        // Get the current date
        $now = date(Constants_Constants::dateFormat);
        $order = new Model_Order($vf['orderId'], $vf['restaurantId'], $vf['restaurantName'], 
                                $now, 0, 0, 0, $vf['total'], 
                                Constants_OrderState::IN_PROGRESS);
        
        if(!$vf->check()) {
            $errors = $vf->errors('order');
        }
        return array($order, $errors);
    }
    
    /**
     * Get the validation object for order.
     * @param $_POST The post variable of the request
     * @return Validation::factory
     */
    private function getOrderValidationFactory($post) {
        return Validation::factory($post)
                ->rule('orderId', 'not_empty')
                ->label('orderId', 'Order Id')
                ->rule('restaurantId', 'not_empty')
                ->label('restaurantId', 'Restaurant Id')
                ->rule('total', 'not_empty')
                ->label('total', 'Total');
    }
    
    /**
     * Get the purchase orders from the post. It also validate the fields.
     * @param $_POST $post
     * @return [0] : purchase order list
     *         [1] : subtotal sum of all prochase orders
     *         [2] : shipping sum of all prochase orders
     *         [3] : taxes sum of all prochase orders
     *         [4] : total sum of all prochase orders
     *         [5] : array containing errors if some fields are not valid
     */
    private function getPurchaseOrders($post) {
        $index = 0;
        
        // Initialize values
        $subtotal = 0;
        $shipping = 0;
        $taxes = 0;
        $total = 0;
        
        // Get the current date
        $now = date(Constants_Constants::dateFormat);
        
        // Validate that the po number is unique
        $repo = new Repository_PurchaseOrder();
        
        $purchaseOrders = array();
        $errors = array();
        while (isset($post['poNumber'][$index])) {
            // Validate a purchase order 
            $vf = $this->getPurchaseOrderValidationFactory($post, $index);
            if (!$vf->check()) {
                // Add the messages to the errors array
                foreach ($vf->errors('po') as $i) {
                    array_push($errors, $i);
                }
            }
            
            // Check if PO# is unique
            if (!$repo->isSupplierPONumberUnique($vf['idOrder'], $vf['idSupplier'], $vf['supplierPONumber'])) {
                array_push($errors, $vf['supplierName'] . ': PO# must be unique.');
            }
            
            // Get and validate purchase order items
            $returnValues = $this->getPurchaseOrderItems($post, $index);
            $items = $returnValues[0];
            $errorsPOI = $returnValues[1];
            // Add the messages to the errors array (poi errors)
            foreach ($errorsPOI as $i) {
                array_push($errors, $i);
            }
                      
            // Add the po to the list
            $purchaseOrder = new Model_PurchaseOrder($vf['poNumber'],
                    $vf['idOrder'], $vf['idSupplier'], $vf['supplierPONumber'], $vf['supplierName'],
                    $now, '', $vf['subtotal'], $vf['shipping'], $vf['taxes'],
                    $vf['totalCost'], Constants_PurchaseOrderState::IN_PROGRESS, 
                    $items);
            array_push($purchaseOrders, $purchaseOrder);
            
            // Sum for the order variables
            $subtotal += $purchaseOrder->getSubtotal();
            $shipping += $purchaseOrder->getShipping();
            $taxes += $purchaseOrder->getTaxes();
            $total += $purchaseOrder->getTotalCost();
                
            $index++;
        }
        return array($purchaseOrders, $subtotal, $shipping, $taxes, $total, $errors);
    }
    
    /**
     * Get the validation object.
     * @param $_POST The post variable of the request
     * @param int The index of the current element in the post (fields are in arrays)
     * @return Validation::factory
     */
    private function getPurchaseOrderValidationFactory($post, $index) {
        $textIdentifyingSupplier = $post['supplierName'][$index] . ': ';
        return Validation::factory(
                array('poNumber' => $post['poNumber'][$index],
                    'idOrder' => $post['idOrder'][$index],
                    'idSupplier' => $post['idSupplier'][$index],
                    'supplierName' => $post['supplierName'][$index],
                    'supplierPONumber' => $post['supplierPONumber'][$index],
                    'subtotal' => $post['subtotal'][$index],
                    'shipping' => $post['shipping'][$index],
                    'taxes' => $post['taxes'][$index],
                    'totalCost' => $post['totalCost'][$index]))
                ->rule('poNumber', 'not_empty')
                ->label('poNumber',  $textIdentifyingSupplier . 'Purchase Order Id')
                ->rule('idSupplier', 'not_empty')
                ->label('idSupplier',  $textIdentifyingSupplier . 'Supplier Id')
                ->rule('supplierPONumber', 'not_empty')
                ->rule('supplierPONumber', 'max_length', array(':value', 20))
                ->label('supplierPONumber',  $textIdentifyingSupplier . 'PO#')        
                ->rule('subtotal', 'numeric')
                ->rule('subtotal', 'ValidationExtension::positive_number')
                ->label('subtotal',  $textIdentifyingSupplier . 'Subtotal')
                ->rule('shipping', 'numeric')
                ->rule('shipping', 'ValidationExtension::positive_number')
                ->label('shipping', $textIdentifyingSupplier . 'Shipping')      
                ->rule('taxes', 'numeric')
                ->rule('taxes', 'ValidationExtension::positive_number')
                ->label('taxes',  $textIdentifyingSupplier . 'Taxes')       
                ->rule('totalCost', 'numeric')
                ->rule('totalCost', 'ValidationExtension::positive_number')
                ->label('totalCost',  $textIdentifyingSupplier . 'Total');
    }
    
     /**
     * Get the purchase orders items from the post. It also validate the fields.
     * @param $_POST $post
     * @return [0] : purchase order items
     *         [1] : array containing errors if some fields are not valid
     */
    private function getPurchaseOrderItems($post, $poIndex) {
        $index = 0;
        
        $items = array();
        $errors = array();
        while (isset($post['poItemPOID'][$poIndex][$index])) {
            // Validate a purchase order item
            $vf = $this->getPurchaseOrderItemValidationFactory($post, $poIndex, $index);
            if (!$vf->check()) {
                // Add the messages to the errors array
                foreach ($vf->errors('poi') as $i) {
                    array_push($errors, $i);
                }
            }
            
            // Add the poi to the list
            $item = new Model_PurchaseOrderItem($vf['poItemPOID'], 
                    $vf['poItemProductID'], $vf['poItemProductName'], $vf['poItemCostPerUnit'], 
                    $vf['poItemQty'], $vf['poItemProductUnitOfMeasurement'], '', '');
            array_push($items, $item);
            
            $index++;
        }
        return array($items, $errors);
    }
    
    /**
     * Get the validation object.
     * @param $_POST The post variable of the request
     * @param int The index of the current po in the post (fields are in arrays)
     * @param int The index of the current element in the post (fields are in arrays)
     * @return Validation::factory
     */
    private function getPurchaseOrderItemValidationFactory($post, $poIndex, $index) {
        return Validation::factory(
                array('poItemPOID' => $post['poItemPOID'][$poIndex][$index], 
                      'poItemProductID' => $post['poItemProductID'][$poIndex][$index], 
                      'poItemProductName' => $post['poItemProductName'][$poIndex][$index],
                      'poItemCostPerUnit' => $post['poItemCostPerUnit'][$poIndex][$index],
                      'poItemQty' => $post['poItemQty'][$poIndex][$index], 
                      'poItemProductUnitOfMeasurement' => $post['poItemProductUnitOfMeasurement'][$poIndex][$index]))
                ->rule('poItemPOID', 'not_empty')
                ->label('poItemPOID', 'Purchase Order Id')
                ->rule('poItemProductID', 'not_empty')
                ->label('poItemProductID', 'Product Id')
                ->rule('poItemCostPerUnit', 'not_empty')
                ->label('poItemCostPerUnit', 'Cost/Unit')
                ->rule('poItemQty', 'not_empty')
                ->label('poItemQty', 'Quantity');
    }
    
    /*****************************************************************************/
    /*/ Step 3
    /*****************************************************************************/
    /**
     * Save step 3 of the order wizards.
     */
}

?>