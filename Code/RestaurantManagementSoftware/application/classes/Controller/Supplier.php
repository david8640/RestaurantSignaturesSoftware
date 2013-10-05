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
        $supplier1 = new Model_Supplier(1, 'David', 1234);
        $supplier2 = new Model_Supplier(2, 'David', 1234);
        $supplier3 = new Model_Supplier(3, 'David', 1234);
        $suppliers = array($supplier1, $supplier2, $supplier3);
        
        $view = View::factory('suppliers')
                    ->set('suppliers', $suppliers)
                    ->set('title', 'Suppliers');
        
        $this->response->body($view);
    }
}
