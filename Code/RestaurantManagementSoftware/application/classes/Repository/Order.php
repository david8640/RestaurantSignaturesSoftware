<?php

/*
 *  <copyright file="Order.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>Andrew Assaly</author>
 *  <date>2013-10-19</date>
 *  <summary>
 *      Manage all the interaction between the database and the application
 *      for each order.
 *  </summary>
 */

class Repository_Order extends Repository_AbstractRepository {

    /**
     * Get all the orders.
     * @return array of orders
     */
    public function getAll() {
        return $this->fetchNConstruct('SELECT * FROM v_getorders', array());
    }

    /**
     * Constructs an order from an anonymous object.
     * @param object $obj
     * @return \Model_Order
     */
    protected function construct($obj) {
        return new Model_Order(
            $obj->id_order, 
            $obj->rname, 
            $obj->pname, 
            $obj->po_Number,
            $obj->qty, 
            $obj->cost,
            $obj->dateOrdered, 
            $obj->dateDelivered);
    }

}

?>