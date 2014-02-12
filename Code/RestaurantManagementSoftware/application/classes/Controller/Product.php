<?php

/* 
 *  <copyright file="Controller_Product.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>Omar Hijazi</author>
 *  <date>2013-11-07</date>
 *  <summary>The controller that handle all the manipulation on products.</summary>
 */
class Controller_Product extends Controller_Template_Generic {
    /**
     * Get all the products.
     */
    public function action_findAll() {
        // Get all the informations from the repository.
        $repo = new Repository_Product();
        $products = $repo->getAll();
        
        // Transfert the information to the view.
        $view = View::factory('product/products')
                    ->set('products', $products);
        
        $this->template->title = __('Products');
        $this->template->content = $view;
    }
    
    /**
     * Initiate the creation of a product.
     */
    public function action_create() {
        // Get all the categories
        $repo = new Repository_ProductCategory();
        $categories = $repo->getAll();
        
        $view = View::factory('product/product')
                ->set('categories', $categories);
        
        $this->template->title = __('Create Product');
        $this->template->content = $view;
    }
    
    /**
     * Add a product.
     */
    public function action_add() {
        if (isset($_POST) && Valid::not_empty($_POST)) {
            $post = $this->getValidationFactory($_POST);
            $product = new Model_Product(-1, $post['name'], $post['id_category'], 
                                        '', $post['unit_of_measurement']);
                                        
            if ($post->check()) {
                // Add the product
                $repo = new Repository_Product();
                $success = $repo->add($product);
        
                // Redirect if the add was successful
                if ($success) {
                    Session::instance()->set('feedbackMessage', array('The product was added.'));
                    $this->redirect ('product/findAll');
                } else {
                    $feedbackMessage = array('An error occured.');
                }
            } else {
                // Invalid fields
                $feedbackMessage = $post->errors('product');
            }
            
            $repoCat = new Repository_ProductCategory();
            $categories = $repoCat->getAll();
            
            $view = View::factory('product/product')
                    ->set('product', $product)
                    ->set('submitAction', 'product/add')
                    ->set('categories', $categories);
            
            $this->template->title = __('Create Product');
            $this->template->feedbackMessage = $feedbackMessage;
            $this->template->content = $view;
        } else {
            // Empty POST
            Session::instance()->set('feedbackMessage', array('An error occured.'));
            $this->redirect ('product/findAll');
        }
    }
    
    /**
     * Initiate the edition of a product.
     */
    public function action_edit() {
        $id = $this->request->param('id');
        // Validate id
        if (!(Valid::not_empty($id) && Valid::numeric($id))) {
            Session::instance()->set('feedbackMessage', array('Invalid product id.'));
            $this->redirect ('index/index');
        }
        
        // Get the product to edit
        $repo = new Repository_Product();
        $product = $repo->get($id);

        // The id do not refer to a valid product
        if (!is_object($product)) {
            Session::instance()->set('feedbackMessage', array('Invalid product id.'));
            $this->redirect ('index/index');
        }
        
        // Get all the list of categories
        $repoCat = new Repository_ProductCategory();
        $categories = $repoCat->getAll();
        

        $view = View::factory('product/product')
                ->set('product', $product)
                ->set('submitAction', 'product/update')
                ->set('categories', $categories)
                ->set('pageName', 'Edit Product');;
        
        $this->template->title = __('Edit Product');
        $this->template->content = $view;
    }
    
    /**
     * Update a product.
     */
    public function action_update() {
        if (isset($_POST) && Valid::not_empty($_POST)) {
            $post = $this->getValidationFactory($_POST);
            $product = new Model_Product($post['product_id'], $post['name'], 
                                         $post['id_category'], '', 
                                         $post['unit_of_measurement']);
            
            if ($post->check()) {
                // Update the product
                $repo = new Repository_Product();
                $success = $repo->update($product);
                
                // Redirect if the update was successful
                if ($success) {
                    Session::instance()->set('feedbackMessage', array('The product was updated.'));
                    $this->redirect ('product/findAll');
                } else {
                    $feedbackMessage = array('An error occured.');
                }
            } else {
                // Invalid fields
                $feedbackMessage = $post->errors('product');
            }
            
            // Get all the list of categories
            $repoCat = new Repository_ProductCategory();
            $categories = $repoCat->getAll();
            
            $view = View::factory('product/product')
                    ->set('product', $product)
                    ->set('submitAction', 'product/update')
                    ->set('pageName', 'Edit Product')
                    ->set('categories', $categories);
        
            $this->template->title = __('Edit Product');
            $this->template->feedbackMessage = $feedbackMessage;
            $this->template->content = $view;
        } else {
            // Empty POST
            Session::instance()->set('feedbackMessage', array('An error occured.'));
            $this->redirect ('product/findAll');
        }
    }
    
    /**
     * Delete a product.
     */
    public function action_delete() {
        $id = $this->request->param('id');
        // Validate id
        if (!(Valid::not_empty($id) && Valid::numeric($id))) {
            Session::instance()->set('feedbackMessage', array('Invalid product id.'));
            $this->redirect ('product/findAll');
        }
        
        // Delete the product
        $repo = new Repository_Product();
        $success = $repo->delete($id);
        
        // Delete failed
        if (!$success) {
            Session::instance()->set('feedbackMessage', array('An error occuring while deleting the product.'));
            $this->redirect ('product/findAll');
        }
        
        // Delete succeed
        Session::instance()->set('feedbackMessage', array('The product was deleted.'));
        $this->redirect ('product/findAll');
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
                ->label('name', 'Name')
                ->rule('id_category', 'ValidationExtension::category_selected')
                ->label('id_category', 'Category')
                ->rule('unit_of_measurement', 'max_length', array(':value', 30))
                ->label('unit_of_measurement', 'Unit Of Measurement');
    }
}

?>