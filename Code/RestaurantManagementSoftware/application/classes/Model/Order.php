<?php

/* 
 * <copyright file="Order.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 * </copyright>
 * <author>Andrew Assaly</author>
 * <date>2014-01-19</date>
 * <summary>Model representing an order.</summary>
 */
class Model_Order extends Model {
    // Private members
    private $id_order;
    private $id_restaurant;
    private $nameRestaurant;
    private $dateCreated; //the creation date of the order
    private $subtotal;
    private $shippingCost;
    private $taxes;
    private $totalCost;
    private $state;
    private $stateName;
     
    /**
     * Constructor of a Order model
     * @param int $id_order the id of the order
     * @param int $id_restaurant the id of the restaurant
     * @param string $nameRestaurant the name of the restaurant
     * @param string $dateCreated the date ordered
     * @param double $subtotal the subtotal of the order
     * @param double $shippingCost the shipping cost of the order
     * @param double $taxes the taxes of the order
     * @param double $totalCost the total cost of the order
     * @param int $state the state of the order
     */
    public function __construct($id_order, $id_restaurant, $nameRestaurant, $dateCreated,
                                $subtotal, $shippingCost, $taxes, $totalCost, $state) {
        $this->setOrderID($id_order);
        $this->setRestaurantID($id_restaurant);
        $this->setRestaurantName($nameRestaurant);
        $this->setdateCreated($dateCreated);
        $this->setSubtotal($subtotal);
        $this->setShippingCost($shippingCost);
        $this->setTaxes($taxes);
        $this->setTotalCost($totalCost);
        $this->setState($state);
        $this->setStateName($state);
    }
   
    // Getters and setters
    /**
     * get the id of the order
     * @return int
     */
    public function getOrderID() {
        return $this->id_order;
    }

    /**
     * Set the id of the order
     * @param int $id_order 
     */
    public function setOrderID($id_order) {
        $this->id_order = $id_order;
    }
    
    /**
     * get the id of the restaurant
     * @return int 
     */
    public function getRestaurantID() {
        return $this->id_restaurant;
    }

    /**
     * Set the id of the restaurant
     * @param int $id_restaurant 
     */
    public function setRestaurantID($id_restaurant) {
        $this->id_restaurant = $id_restaurant;
    }
    
    /**
     * get the name of the restaurant
     * @return string 
     */
    public function getRestaurantName() {
        return $this->nameRestaurant;
    }

    /**
     * Set the name of the restaurant
     * @param string $nameRestaurant 
     */
    public function setRestaurantName($nameRestaurant) {
        $this->nameRestaurant = $nameRestaurant;
    }
  
    /**
     * get the date the order was submit
     * @return string 
     */
    public function getdateCreated() {
        return $this->dateCreated;
    }
    
    /**
     * Set the date the order was submit
     * @param string $dateCreated 
     */
    public function setdateCreated($dateCreated) {
        $this->dateCreated = $dateCreated;
    }
    
    /**
     * get the subtotal of the order
     * @return double 
     */
    public function getSubtotal() {
        return $this->subtotal;
    }
    
    /**
     * Set the subtotal of the order
     * @param double $subtotal
     */
    public function setSubtotal($subtotal) {
        $this->subtotal = $subtotal;
    }
    
    /**
     * get the shipping cost of the order
     * @return double 
     */
    public function getShippingCost() {
        return $this->shippingCost;
    }
    
    /**
     * Set the shipping cost of the order
     * @param double $shippingCost
     */
    public function setShippingCost($shippingCost) {
        $this->shippingCost = $shippingCost;
    }
    
    /**
     * get the taxes of the order
     * @return double 
     */
    public function getTaxes() {
        return $this->taxes;
    }
    
    /**
     * Set the taxes of the order
     * @param double $taxes
     */
    public function setTaxes($taxes) {
        $this->taxes = $taxes;
    }
    
    /**
     * get the total cost of the order
     * @return double 
     */
    public function getTotalCost() {
        return $this->totalCost;
    }
    
    /**
     * Set the total cost of the order
     * @param double $totalCost
     */
    public function setTotalCost($totalCost) {
        $this->totalCost = $totalCost;
    }
    
    /**
     * get the state of the order
     * @return int
     */
    public function getState() {
        return $this->state;
    }
    
    /**
     * Set the state of the order
     * @param int $state
     */
    public function setState($state) {
        $this->state = $state;
    }
    
    /**
     * get the state name of the order
     * @return string
     */
    public function getStateName() {
        return $this->stateName;
    }
    
    /**
     * Set the state name of the order
     * @param int $state
     */
    public function setStateName($state) {
        if ($state == 0) { //saved
            $this->stateName = "In Progress";
        } else if ($state == 1) { //ordered
            $this->stateName = "Ordered";
        } else  {
            $this->stateName = "In Progress";
        }
    }
}

?>