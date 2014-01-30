<?php

/*
 *  <copyright file="PurchaseOrder.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2014-01-29</date>
 *  <summary>
 *      Manage all the interaction between the database and the application
 *      for each purchase order.
 *  </summary>
 */

class Repository_PurchaseOrder extends Repository_AbstractRepository { 
    public function save($purchaseOrders) {
        // TODO
        return true;
    }
    
    /**
     * Constructs an order from an anonymous object.
     * @param object $obj
     * @return \Model_PurchaseOrder
     */
    protected function construct($obj) {
        // TODO
    }
}

?>