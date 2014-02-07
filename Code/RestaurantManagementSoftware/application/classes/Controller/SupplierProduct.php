<?php

/* 
 *  <copyright file="Controller_SupplierProduct.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2014-02-06</date>
 *  <summary>The controller that handle all the manipulation on suppliers' products.</summary>
 */
class Controller_SupplierProduct extends Controller_Template_Generic {
    /**
     * Get all the suppliers' products.
     */
    public function action_findAll() {
        // Get all the informations from the repository.
        $repo = new Repository_SupplierProduct();
        $suppliersProducts = $repo->getAll();
        
        // Transfert the information to the view.
        $view = View::factory('supplierProduct/suppliersProducts')
                    ->set('suppliersProducts', $suppliersProducts);
        
        $this->template->title = __('Suppliers\' Products');
        $this->template->content = $view;
    }
    
    /**
     * Initiate the creation of a supplier's product.
     */
    public function action_create() {
        // Get all the suppliers
        $repoSup = new Repository_Supplier();
        $suppliers = $repoSup->getAll();
        
        // Get all the products
        $repoProd = new Repository_Product();
        $products = $repoProd->getAll();
        
        $view = View::factory('supplierProduct/supplierProduct')
                    ->set('suppliers', $suppliers)
                    ->set('products', $products);
        
        $this->template->title = __("Create Supplier's Product");
        $this->template->content = $view;
    }
    
    /**
     * Add a supplier's product.
     */
    public function action_add() {
        if (isset($_POST) && Valid::not_empty($_POST)) {
            $post = $this->getValidationFactory($_POST);
            $supplierProduct = new Model_SupplierProduct($post['product_id'], '',
                    $post['supplier_id'], '', $post['unit_of_measurement'], 
                    $post['price'], 0);
                    
            if ($post->check()) {
                $repo = new Repository_SupplierProduct();
                // Validate that the combination of supplier id and product id
                // doesn't alreay exists
                $sp = $repo->get($supplierProduct->getSupplierID(), $supplierProduct->getProductID());
                
                if (!isset($sp)) {
                    // Add the supplier's product
                    $success = $repo->save($supplierProduct);

                    // Redirect if the add was successful
                    if ($success) {
                        Session::instance()->set('feedbackMessage', array("The supplier's product was added."));
                        $this->redirect('supplierProduct/findAll');
                    } else {
                        $feedbackMessage = array('An error occured.');
                    }
                } else {
                   $feedbackMessage = array("This supplier's product already exists"); 
                }
            } else {
                // Invalid fields
                $feedbackMessage = $post->errors('supplierProduct');
            }
            
            // Get all the suppliers
            $repoSup = new Repository_Supplier();
            $suppliers = $repoSup->getAll();
        
            // Get all the products
            $repoProd = new Repository_Product();
            $products = $repoProd->getAll();
            
            $view = View::factory('supplierProduct/supplierProduct')
                    ->set('supplierProduct', $supplierProduct)
                    ->set('submitAction', 'supplierProduct/add')
                    ->set('suppliers', $suppliers)
                    ->set('products', $products);
            $this->template->title = __("Create Supplier's Product");
            $this->template->feedbackMessage = $feedbackMessage;
            $this->template->content = $view;
        } else {
            // Empty POST
            Session::instance()->set('feedbackMessage', array('An error occured.'));
            $this->redirect ('supplierProduct/findAll');
        }
    }
    
    /**
     * Initiate the edition of a supplier.
     */
    public function action_edit() {
        $ids = $this->getSupplierIdNProductId();
        $supplierId = $ids[0];
        $productId = $ids[1];
        
        // Validate supplier id
        $this->validateId($supplierId, 'Invalid supplier id.');
        
        // Validate product id
        $this->validateId($productId, 'Invalid product id.');
        
        // Get the supplier's product to edit
        $repo = new Repository_SupplierProduct();
        $supplierProduct = $repo->get($supplierId, $productId);
        
        // The supplier id and product id do not refer to a valid supplier product
        if (!is_object($supplierProduct)) {
            Session::instance()->set('feedbackMessage', array("Invalid supplier's product."));
            $this->redirect ('supplierProduct/findAll');
        }

        $view = View::factory('supplierProduct/supplierProduct')
                ->set('supplierProduct', $supplierProduct)
                ->set('submitAction', 'supplierProduct/update')
                ->set('pageName', "Edit Supplier's Product");
        
        $this->template->title = __("Edit Supplier's Product");
        $this->template->content = $view;
    }
    
    /**
     * Update a supplier.
     */
    public function action_update() {
        if (isset($_POST) && Valid::not_empty($_POST)) {
            $post = $this->getValidationFactory($_POST);
            $supplierProduct = new Model_SupplierProduct($post['product_id'], $post['product_name'],
                    $post['supplier_id'], $post['supplier_name'], $post['unit_of_measurement'], 
                    $post['price'], 0);
            
            if ($post->check()) {
                // Update the supplier
                $repo = new Repository_SupplierProduct();
                $success = $repo->save($supplierProduct);
                
                // Redirect if the update was successful
                if ($success) {
                    Session::instance()->set('feedbackMessage', array("The supplier's product was updated."));
                    $this->redirect ('supplierProduct/findAll');
                }
            } else {
                // Invalid fields
                $feedbackMessage = $post->errors('supplierProduct');
            }
            
            $view = View::factory('supplierProduct/supplierProduct')
                    ->set('supplierProduct', $supplierProduct)
                    ->set('submitAction', 'supplierProduct/update')
                    ->set('pageName', "Edit Supplier's Product");
        
            $this->template->title = __("Edit Supplier's Product");
            $this->template->feedbackMessage = $feedbackMessage;
            $this->template->content = $view;
        } else {
            // Empty POST
            Session::instance()->set('feedbackMessage', array('An error occured.'));
            $this->redirect ('supplierProduct/findAll');
        }
    }
    
    /**
     * Delete a supplier's product.
     */
    public function action_delete() {
        $ids = $this->getSupplierIdNProductId();
        $supplierId = $ids[0];
        $productId = $ids[1];
        
        // Validate supplier id
        $this->validateId($supplierId, 'Invalid supplier id.');
        
        // Validate product id
        $this->validateId($productId, 'Invalid product id.');
        
        // Delete the supplier
        $repo = new Repository_SupplierProduct();
        $success = $repo->delete($supplierId, $productId);
        
        // Delete failed
        if (!$success) {
            Session::instance()->set('feedbackMessage', array("An error occurred while deleting the supplier's product."));
            $this->redirect ('supplierProduct/findAll');
        }
        
        // Delete succeed
        Session::instance()->set('feedbackMessage', array("The supplier's product was deleted."));
        $this->redirect ('supplierProduct/findAll');
    }
    
    /**
     * Get the validation object.
     * @param $_POST The post variable of the request
     * @return Validation::factory
     */
    private function getValidationFactory($post) {
        return Validation::factory($post)
                ->rule('supplier_id', 'not_empty')
                ->label('supplier_id', 'Supplier')
                ->rule('product_id', 'not_empty')
                ->label('product_id', 'Product')
                ->rule('price', 'not_empty')
                ->rule('price', 'decimal', array(':digits', '2'))
                ->rule('price', 'ValidationExtension::positive_number')
                ->label('price', 'Price')
                ->rule('unit_of_measurement', 'not_empty')
                ->rule('unit_of_measurement', 'max_length', array(':value', 30))
                ->label('unit_of_measurement', 'Unit Of Measurement');
    }
    
    /**
     * Get the supplier id and the product id.
     * @return array containing 
     *              [0] : supplierId
     *              [1] : productId
     */
    private function getSupplierIdNProductId() {
        $ids = $this->request->param('id');
        return explode('_', $ids);
    }
    
    /**
     * Validate an id.
     * @param int $id
     * @param string $errorMessage
     */
    private function validateId($id, $errorMessage) {
        if (!(Valid::not_empty($id) && Valid::numeric($id))) {
            Session::instance()->set('feedbackMessage', array($errorMessage));
            $this->redirect ('supplierProduct/findAll');
        }
    }
}

?>