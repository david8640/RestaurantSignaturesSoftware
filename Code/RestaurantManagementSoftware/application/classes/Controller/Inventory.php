<?php

/* 
 *  <copyright file="Controller_Inventory.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2014-02-20</date>
 *  <summary>The controller that handle all the manipulation on inventory.</summary>
 */
class Controller_Inventory extends Controller_Template_Generic {
    /**
     * Get all the restaurant's inventory.
     */
    public function action_findAll() {
        // Get all the informations from the repository.
        $repo = new Repository_Inventory();
        $restaurantsInventory = $repo->getAll();
        
        // Transfert the information to the view.
        $view = View::factory('inventory/restaurantsInventory')
                    ->set('restaurantsInventory', $restaurantsInventory);
        
        $this->template->title = __('Inventories');
        $this->template->content = $view;
    }
    
    /**
     * Initiate the edition of an inventory.
     */
    public function action_edit() {       
        $lastAction = $this->request->param('lastAction');
        if (isset($lastAction)) {
            $redirect = 'inventory/' . $lastAction;
            $id = $this->request->param('id');
        } else {
            $redirect = 'index/index'; 
            $id = $this->template->global_selected_location;
        }
        
        // Validate id
        if (!(Valid::not_empty($id) && Valid::numeric($id))) {
            Session::instance()->set('feedbackMessage', array('Invalid restaurant id.'));
            $this->redirect ($redirect);
        }
        
        // Get the inventory to edit
        $repo = new Repository_Inventory();
        $inventory = $repo->get($id);
        
        // The id do not refer to a valid inventory
        if (!is_object($inventory)) {
            Session::instance()->set('feedbackMessage', array('Invalid restaurant id.'));
            $this->redirect ($redirect);
        }

        $view = View::factory('inventory/inventory')
                            ->set('inventory', $inventory)
                            ->set('originAction', $lastAction);
        
        $this->template->title = __('Inventory of ' . $inventory->getRestaurantName());
        $this->template->content = $view;
    }
    
    /**
     * Update all inventory quantities.
     */
    public function action_update() {
        if (isset($_POST) && Valid::not_empty($_POST)) {
            if (isset($_POST['originAction']) && isset($_POST['restaurantId'])) {
                $id = $_POST['restaurantId'];
                $redirect = 'inventory/edit/' . $id . '/' . $_POST['originAction'];
            } else {
                $redirect = 'inventory/edit'; 
            }
            
            $returnValues = $this->getInventoryFactory($_POST);
            $inventory = $returnValues[0];
            $errors = $returnValues[1];
            
            if (count($errors) == 0) {
                // Update the inventory
                $repo = new Repository_InventoryItem();
                $success = $repo->save($inventory);
                
                // Redirect if the update was successful
                if ($success) {
                    Session::instance()->set('feedbackMessage', array('The inventory was updated.'));
                    $this->redirect ($redirect);
                }
            } else {
                // Invalid fields
                $feedbackMessage = $errors;
            }
            
            $view = View::factory('inventory/inventory')
                            ->set('inventory', $inventory);
        
            $this->template->title = __('Inventory of ' . $inventory->getRestaurantName());
            $this->template->feedbackMessage = $feedbackMessage;
            $this->template->content = $view;
        } else {
            // Empty POST
            Session::instance()->set('feedbackMessage', array('An error occured.'));
            $this->redirect ('index/index');
        }
    }
    
    /**
     * Get the inventory from the post. It also validate the fields.
     * @param $_POST $post
     * @param int The index of the current element in the post (fields are in arrays)
     * @return [0] : inventory
     *         [1] : array containing errors if some fields are not valid
     */
    private function getInventoryFactory($post) {
        $vf = $this->getInventoryValidationFactory ($post);
        
        $returnValues = $this->getInventoryItemsFactory($post, $vf['inventoryId']);
        $items = $returnValues[0];
        $errors = $returnValues[1];
        
        $inventory = new Model_Inventory($vf['inventoryId'], $vf['restaurantId'], $vf['restaurantName'], $items);
        
        if (!$vf->check()) {
            // Add the messages to the errors array
            foreach ($vf->errors('inventory') as $i) {
                array_push($errors, $i);
            }
        }
        
        return array($inventory, $errors);
    }
    
    /**
     * Get the inventory items from the post. It also validate the fields.
     * @param $_POST $post
     * @param int The index of the current element in the post (fields are in arrays)
     * @param int $inventoryId the inventory id
     * @return [0] : list of inventory items
     *         [1] : array containing errors if some fields are not valid
     */
    private function getInventoryItemsFactory($post, $inventoryId) {      
        $index = 0;
        $items = array();
        $errors = array();
        while (isset($post['itemId'][$index])) {
            $vf = $this->getInventoryItemValidationFactory($post, $index);
            
            $item = new Model_InventoryItem($vf['itemId'], $inventoryId, $vf['productId'], 
                                    $vf['productName'], $vf['costPerUnit'], $vf['qty'], 
                                    $vf['unit'], $vf['supplierId'], $vf['supplierName']);
                    
            array_push($items, $item);
                
            if (!$vf->check()) {
                // Add the messages to the errors array
                foreach ($vf->errors('item') as $i) {
                    array_push($errors, $i);
                }
            }
            $index++;
        
        }
        return array($items, $errors);
    }
    
    /**
     * Get the validation object.
     * @param $_POST The post variable of the request
     * @return Validation::factory
     */
    private function getInventoryValidationFactory($post) {
        return Validation::factory($post)
                ->rule('inventoryId', 'not_empty')
                ->label('inventoryId', 'Inventory Id')
                ->rule('restaurantId', 'not_empty')
                ->label('restaurantId', 'Restaurant Id');
    }
    
    /**
     * Get the validation object.
     * @param $_POST The post variable of the request
     * @param int The index of the current element in the post (fields are in arrays)
     * @return Validation::factory
     */
    private function getInventoryItemValidationFactory($post, $index) {
        return Validation::factory(
                array('itemId' => $post['itemId'][$index],
                      'productId' => $post['productId'][$index], 
                      'productName' => $post['productName'][$index],
                      'costPerUnit' => $post['costPerUnit'][$index],
                      'qty' => $post['qty'][$index], 
                      'unit' => $post['unit'][$index],
                      'supplierId' => $post['supplierId'][$index],
                      'supplierName' => $post['supplierName'][$index]))
                ->rule('qty', 'not_empty')    
                ->rule('qty', 'numeric')
                ->rule('qty', 'ValidationExtension::positive_number')
                ->label('qty', 'Quantity of ' . $post['productName'][$index] . ' of ' . $post['supplierName'][$index]);
    }
}

?>