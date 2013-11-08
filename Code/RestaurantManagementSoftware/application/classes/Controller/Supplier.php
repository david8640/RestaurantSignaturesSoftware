<?php

/* 
 *  <copyright file="Controller_Supplier.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2013-10-05</date>
 *  <summary>The controller that handle all the manipulation on suppliers.</summary>
 */
class Controller_Supplier extends Controller_Template_Generic {
    /**
     * Get all the suppliers.
     */
    public function action_findAll() {
        // Get all the informations from the repository.
        $repo = new Repository_Supplier();
        $suppliers = $repo->getAll();
        
        // Transfert the information to the view.
        $view = View::factory('supplier/suppliers')
                    ->set('suppliers', $suppliers);
        
        $this->template->title = __('Suppliers');
        $this->template->content = $view;
    }
    
    /**
     * Initiate the creation of a supplier.
     */
    public function action_create() {
        $view = View::factory('supplier/supplier');
        $this->template->title = __('Create Supplier');
        $this->template->content = $view;
    }
    
    /**
     * Add a supplier.
     */
    public function action_add() {
        if (isset($_POST) && Valid::not_empty($_POST)) {
            $post = $this->getValidationFactory($_POST);
            $supplier = new Model_Supplier(-1, $post['name'], 
                                        $post['contactName'], $post['phoneNumber'], 
                                        $post['faxNumber']);
            
            if ($post->check()) {
                // Add the supplier
                $repo = new Repository_Supplier();
                $success = $repo->add($supplier);
        
                // Redirect if the add was successful
                if ($success) {
                    Session::instance()->set('feedbackMessage', array('The supplier was added.'));
                    $this->redirect('supplier/findAll');
                }
            } else {
                // Invalid fields
                $feedbackMessage = $post->errors('supplier');
            }
            
            $view = View::factory('supplier/supplier')
                    ->set('supplier', $supplier)
                    ->set('submitAction', 'supplier/add');
            $this->template->title = __('Create Supplier');
            $this->template->feedbackMessage = $feedbackMessage;
            $this->template->content = $view;
        } else {
            // Empty POST
            Session::instance()->set('feedbackMessage', array('An error occured.'));
            $this->redirect ('supplier/findAll');
        }
    }
    
    /**
     * Initiate the edition of a supplier.
     */
    public function action_edit() {
        $id = $this->request->param('id');
        // Validate id
        if (!(Valid::not_empty($id) && Valid::numeric($id))) {
            Session::instance()->set('feedbackMessage', array('Invalid supplier id.'));
            $this->redirect ('supplier/findAll');
        }
        
        // Get the supplier to edit
        $repo = new Repository_Supplier();
        $supplier = $repo->get($id);

        // The id do not refer to a valid supplier
        if (!is_object($supplier)) {
            Session::instance()->set('feedbackMessage', array('Invalid supplier id.'));
            $this->redirect ('supplier/findAll');
        }

        $view = View::factory('supplier/supplier')
                ->set('supplier', $supplier)
                ->set('submitAction', 'supplier/update')
                ->set('pageName', 'Edit Supplier');
        
        $this->template->title = __('Edit Supplier');
        $this->template->content = $view;
    }
    
    /**
     * Update a supplier.
     */
    public function action_update() {
        if (isset($_POST) && Valid::not_empty($_POST)) {
            $post = $this->getValidationFactory($_POST);
            $supplier = new Model_Supplier($post['id'], 
                        $post['name'], $post['contactName'], $post['phoneNumber'], 
                        $post['faxNumber']);
            
            if ($post->check()) {
                // Update the supplier
                $repo = new Repository_Supplier();
                $success = $repo->update($supplier);
                
                // Redirect if the update was successful
                if ($success) {
                    Session::instance()->set('feedbackMessage', array('The supplier was updated.'));
                    $this->redirect ('supplier/findAll');
                }
            } else {
                // Invalid fields
                $feedbackMessage = $post->errors('supplier');
            }
            
            $view = View::factory('supplier/supplier')
                    ->set('supplier', $supplier)
                    ->set('submitAction', 'supplier/update')
                    ->set('pageName', 'Edit Supplier');
        
            $this->template->title = __('Edit Supplier');
            $this->template->feedbackMessage = $feedbackMessage;
            $this->template->content = $view;
        } else {
            // Empty POST
            Session::instance()->set('feedbackMessage', array('An error occured.'));
            $this->redirect ('supplier/findAll');
        }
    }
    
    /**
     * Delete a supplier.
     */
    public function action_delete() {
        $id = $this->request->param('id');
        // Validate id
        if (!(Valid::not_empty($id) && Valid::numeric($id))) {
            Session::instance()->set('feedbackMessage', array('Invalid supplier id.'));
            $this->redirect ('supplier/findAll');
        }
        
        // Delete the supplier
        $repo = new Repository_Supplier();
        $success = $repo->delete($id);
        
        // Delete failed
        if (!$success) {
            Session::instance()->set('feedbackMessage', array('An error occuring while deleting the supplier.'));
            $this->redirect ('supplier/findAll');
        }
        
        // Delete succeed
        Session::instance()->set('feedbackMessage', array('The supplier was deleted.'));
        $this->redirect ('supplier/findAll');
    }
    
    /**
     * Get the validation object.
     * @param $_POST The post variable of the request
     * @return Validation::factory
     */
    private function getValidationFactory($post) {
        return Validation::factory($post)
                ->rule('name', 'not_empty')
                ->rule('name', 'max_length', array(':value', 100))
                ->rule('contactName', 'not_empty')
                ->rule('contactName', 'max_length', array(':value', 100))
                ->rule('contactName', 'not_empty')
                ->rule('phoneNumber', 'not_empty')
                ->rule('phoneNumber', 'regex', array(':value', '/^(?:(?:\+?1\s*(?:[.-]\s*)?)?(?:(\s*([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9]‌​)\s*)|([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9]))\s*(?:[.-]\s*)?)?([2-9]1[02-‌​9]|[2-9][02-9]1|[2-9][02-9]{2})\s*(?:[.-]\s*)?([0-9]{4})$/'))
                ->rule('faxNumber', 'regex', array(':value', '/^(?:(?:\+?1\s*(?:[.-]\s*)?)?(?:(\s*([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9]‌​)\s*)|([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9]))\s*(?:[.-]\s*)?)?([2-9]1[02-‌​9]|[2-9][02-9]1|[2-9][02-9]{2})\s*(?:[.-]\s*)?([0-9]{4})$/'));
    }
}

?>