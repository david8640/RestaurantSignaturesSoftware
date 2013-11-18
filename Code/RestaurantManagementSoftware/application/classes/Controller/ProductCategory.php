<?php

/* 
 *  <copyright file="Controller_ProductCategory.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2013-11-17</date>
 *  <summary>The controller that handle all the manipulation on product category.</summary>
 */
class Controller_ProductCategory extends Controller_Template_Generic {
    /**
     * Get all the product category.
     */
    public function action_findAll() {
        // Get all the informations from the repository.
        $repo = new Repository_ProductCategory();
        $categories = $repo->getAll();
        
        // Transfert the information to the view.
        $view = View::factory('product/categories')
                    ->set('categories', $categories);
        
        $this->template->title = __('Product Categories');
        $this->template->content = $view;
    }
    
    /**
     * Initiate the creation of a product category.
     */
    public function action_create() {
        $repo = new Repository_ProductCategory();
        $parents = $repo->getAll();
        
        $view = View::factory('product/category')->set('parents', $parents);
        $this->template->title = __('Create Product Category');
        $this->template->content = $view;
    }
    
    /**
     * Add a product category.
     */
    public function action_add() {
        if (isset($_POST) && Valid::not_empty($_POST)) {
            $post = $this->getValidationFactory($_POST);
            $category = new Model_ProductCategory(-1, $post['name'], 
                                        $post['parent'], '', 
                                        $post['order']);
            $repo = new Repository_ProductCategory();
            $parents = $repo->getAll();
            
            if ($post->check()) {
                // Add the a product category
                $success = $repo->add($category);
        
                // Redirect if the add was successful
                if ($success) {
                    Session::instance()->set('feedbackMessage', array('The product category was added.'));
                    $this->redirect('productCategory/findAll');
                } else {
                    $feedbackMessage = array('An error occured.');
                }
            } else {
                // Invalid fields
                $feedbackMessage = $post->errors('productCategories');
            }
            
            $view = View::factory('product/category')
                    ->set('category', $category)
                    ->set('parents', $parents)
                    ->set('submitAction', 'productCategory/add');
            $this->template->title = __('Create Product Category');
            $this->template->feedbackMessage = $feedbackMessage;
            $this->template->content = $view;
        } else {
            // Empty POST
            Session::instance()->set('feedbackMessage', array('An error occured.'));
            $this->redirect ('productCategory/findAll');
        }
    }
    
    /**
     * Initiate the edition of a product category.
     */
    public function action_edit() {
        $id = $this->request->param('id');
        // Validate id
        if (!(Valid::not_empty($id) && Valid::numeric($id))) {
            Session::instance()->set('feedbackMessage', array('Invalid product category id.'));
            $this->redirect ('productCategory/findAll');
        }
        
        // Get the product category to edit
        $repo = new Repository_ProductCategory();
        $category = $repo->get($id);
        $parents = $repo->getParents($id);

        // The id do not refer to a valid product category
        if (!is_object($category)) {
            Session::instance()->set('feedbackMessage', array('Invalid product category id.'));
            $this->redirect ('productCategory/findAll');
        }

        $view = View::factory('product/category')
                ->set('category', $category)
                ->set('parents', $parents)
                ->set('submitAction', 'productCategory/update')
                ->set('pageName', 'Edit Product Category');
        
        $this->template->title = __('Edit Product Category');
        $this->template->content = $view;
    }
    
    /**
     * Update a product category.
     */
    public function action_update() {
        if (isset($_POST) && Valid::not_empty($_POST)) {
            $post = $this->getValidationFactory($_POST);
            $category = new Model_ProductCategory($post['id'], 
                        $post['name'], $post['parent'], '', 
                        $post['order']);
            $repo = new Repository_ProductCategory();
            $parents = $repo->getParents($post['id']);
            
            if ($post->check()) {
                // Update the supplier
                $success = $repo->update($category);
                
                // Redirect if the update was successful
                if ($success) {
                    Session::instance()->set('feedbackMessage', array('The product category was updated.'));
                    $this->redirect ('productCategory/findAll');
                } else {
                    $feedbackMessage = array('An error occured.');
                }
            } else {
                // Invalid fields
                $feedbackMessage = $post->errors('productCategories');
            }
            
            $view = View::factory('product/category')
                    ->set('category', $category)
                    ->set('parents', $parents)
                    ->set('submitAction', 'productCategory/update')
                    ->set('pageName', 'Edit Product Category');
        
            $this->template->title = __('Edit Product Category');
            $this->template->feedbackMessage = $feedbackMessage;
            $this->template->content = $view;
        } else {
            // Empty POST
            Session::instance()->set('feedbackMessage', array('An error occured.'));
            $this->redirect ('productCategory/findAll');
        }
    }
    
    /**
     * Delete a product category.
     */
    public function action_delete() {
        $id = $this->request->param('id');
        // Validate id
        if (!(Valid::not_empty($id) && Valid::numeric($id))) {
            Session::instance()->set('feedbackMessage', array('Invalid product category id.'));
            $this->redirect ('productCategory/findAll');
        }
        
        // Delete the product category
        $repo = new Repository_ProductCategory();
        $success = $repo->delete($id);
        
        // Delete failed
        if (!$success) {
            Session::instance()->set('feedbackMessage', array('An error occurred while deleting the product category.'));
            $this->redirect ('productCategory/findAll');
        }
        
        // Delete succeed
        Session::instance()->set('feedbackMessage', array('The product category was deleted.'));
        $this->redirect ('productCategory/findAll');
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
                ->rule('parent', 'not_empty')
                ->label('parent', 'Parent')
                ->rule('order', 'not_empty')
                ->label('order', 'Order');
    }
}

?>