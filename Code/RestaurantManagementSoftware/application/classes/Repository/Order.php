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
        //return $this->fetchNConstruct('SELECT * FROM v_getorders', array());
        $order1 = new Model_Order(1, 1, 'Restaurant 1', '2014-01-29', 0, 0, 0, 0, Constants_OrderState::IN_PROGRESS, 'In Progress');
        $order3 = new Model_Order(3, 1, 'Restaurant 1', '2014-01-29', 0, 0, 0, 0, Constants_OrderState::IN_PROGRESS, 'In Progress');
        $order2 = new Model_Order(2, 2, 'Restaurant 2', '2014-01-29', 0, 0, 0, 0, Constants_OrderState::IN_PROGRESS, 'In Progress');
        return array($order1, $order2, $order3);
    }
    
    /**
     * Get all the orders for a restaurant.
     * @param int $idRestaurant
     * @return array of orders
     */
    public function getRestaurantOrders($idRestaurant) {
        if ($idRestaurant == 5) {
            $order1 = new Model_Order(1, 1, '', '2014-01-29', 0, 0, 0, 0, Constants_OrderState::IN_PROGRESS, 'In Progress');
            $order2 = new Model_Order(2, 1, '', '2014-01-29', 0, 0, 0, 0, Constants_OrderState::IN_PROGRESS, 'In Progress');
        } else {
            $order1 = new Model_Order(1, 2, '', '2014-01-29', 0, 0, 0, 0, Constants_OrderState::IN_PROGRESS, 'In Progress');
            $order2 = new Model_Order(2, 2, '', '2014-01-29', 0, 0, 0, 0, Constants_OrderState::IN_PROGRESS, 'In Progress');
        }
        return array($order1, $order2);
    }
    
    /**
     * Add an order.
     * @param Model_Order $order
     * @return int orderId or -1 (Error)
     */
    public function save($order) {
        // TODO 
        // return -1 if error
        // otherwise return orderId
    }
    
    /**
     * Delete an order.
     * @param int $orderId
     * @return int 0 or 1
     */
    public function delete($orderId) {
        // TODO 
    }

    /**
     * Constructs an order from an anonymous object.
     * @param object $obj
     * @return \Model_Order
     */
    protected function construct($obj) {
        return new Model_Order(
            $obj->id_order,
            $obj->id_restaurant,    
            $obj->rname, 
            $obj->dateOrdered, 
            $obj->subtotal,
            $obj->shipping_cost, 
            $obj->taxes,
            $obj->total_cost, 
            $obj->state,
            $obj->sname);
    }
}

?>