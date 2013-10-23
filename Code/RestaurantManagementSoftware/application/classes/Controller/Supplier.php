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
    public function action_findAll() {
        $repo = new Repository_Supplier();
        //$repo->update(new Model_Supplier(10, "david bob henry", 123123, 123123));
        //$suppliers = $repo->delete(75);
        //$suppliers = $repo->getAll();
        
        $view = View::factory('suppliers')
                    ->set('suppliers', $suppliers)
                    ->set('title', 'Suppliers');
        
        $this->response->body($view);
    }
}

?>