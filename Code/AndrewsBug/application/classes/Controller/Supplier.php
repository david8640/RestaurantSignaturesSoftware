<?php

/* 
 *  <copyright file="Controller_Supplier.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2013-10-05</date>
 *  <summary>The controller that handle all the manipulation on suppliers.</summary>
 */
class Controller_Supplier extends Controller {
    /**
     * Get all the suppliers.
     */
    public function action_findAll() {
        // Get all the informations from the repository.
        $repo = new Repository_Supplier();
        $suppliers = $repo->getAll();
        
        // Transfert the information to the view.
        $view = View::factory('suppliers')
                    ->set('suppliers', $suppliers);
        
        $this->response->body($view);
    }
    
    /**
     * Get a supplier.
     * @param int $id
     */
    public function action_find($id) {
        // Get all the informations from the repository.
        $repo = new Repository_Supplier();
        $supplier = $repo->get($id);
        
        // Transfert the information to the view.
        $view = View::factory('suppliers')
                    ->set('suppliers', $supplier);
        
        $this->response->body($view);
    }
    
    /**
     * Add a supplier.
     * @param string $name
     * @param int $phoneNumber
     * @param int $faxNumber
     */
    public function action_add($name, $phoneNumber, $faxNumber) {
        // Get all the informations from the repository.
        $repo = new Repository_Supplier();
        $success = $repo->add(new Model_Supplier(-1, $name, $phoneNumber, $faxNumber));
        
        // Transfert the information to the view.
        $view = View::factory('suppliers')
                    ->set('success', $success);
        
        $this->response->body($view);
    }
    
    /**
     * Update a supplier.
     * @param int $id
     * @param string $name
     * @param int $phoneNumber
     * @param int $faxNumber
     */
    public function action_update($id, $name, $phoneNumber, $faxNumber) {
        // Get all the informations from the repository.
        $repo = new Repository_Supplier();
        $success = $repo->update(new Model_Supplier($id, $name, $phoneNumber, $faxNumber));
        
        // Transfert the information to the view.
        $view = View::factory('suppliers')
                    ->set('success', $success);
        
        $this->response->body($view);
    }
    
    /**
     * Delete a supplier.
     * @param int $id
     */
    public function action_delete($id) {
        // Get all the informations from the repository.
        $repo = new Repository_Supplier();
        $success = $repo->delete($id);
        
        // Transfert the information to the view.
        $view = View::factory('suppliers')
                    ->set('success', $success);
        
        $this->response->body($view);
    }
}

?>