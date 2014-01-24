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
    private $idOrder;
    private $idRestaurant;
    private $nameRestaurant;
    private $dateOrdered;
    private $subtotal;
    private $shippingCost;
    private $taxes;
    private $totalCost;
    private $state;
    private $stateName;
     
    /**
     * Constructor of a Order model
     * @param int $idOrder the id of the order
     * @param int $idRestaurant the id of the restaurant
     * @param string $nameRestaurant the name of the restaurant
     * @param string $dateOrdered the date ordered
     * @param string $dateOrdered the date ordered
     * @param string $dateDelivered the date delivered
     * @param double $subtotal the subtotal of the order
     * @param double $shippingCost the shipping cost of the order
     * @param double $taxes the taxes of the order
     * @param double $totalCost the total cost of the order
     * @param int $state the state of the order
     * @param string $stateName the name of the state
     */
    public function __construct($idOrder, $idRestaurant, $nameRestaurant, $dateOrdered,
                                $subtotal, $shippingCost, $taxes, $totalCost, 
                                $state, $stateName) {
        $this->setOrderID($idOrder);
        $this->setRestaurantID($idRestaurant);
        $this->setRestaurantName($nameRestaurant);
        $this->setDateOrdered($dateOrdered);
        $this->setSubtotal($subtotal);
        $this->setShippingCost($shippingCost);
        $this->setTaxes($taxes);
        $this->setTotalCost($totalCost);
        $this->setState($state);
        $this->setStateName($stateName);
    }
   
    // Getters and setters
    /**
     * get the id of the order
     * @param int $idOrder 
     */
    public function getOrderID($idOrder) {
        return $this->idOrder;
    }

    /**
     * Set the id of the order
     * @param int $idOrder 
     */
    public function setOrderID($idOrder) {
        $this->idOrder = $idOrder;
    }
    
    /**
     * get the id of the restaurant
     * @param int $idRestaurant 
     */
    public function getRestaurantID($idRestaurant) {
        return $this->idRestaurant;
    }

    /**
     * Set the id of the restaurant
     * @param int $idRestaurant 
     */
    public function setRestaurantID($idRestaurant) {
        $this->idRestaurant = $idRestaurant;
    }
    
    /**
     * get the name of the restaurant
     * @param string $nameRestaurant 
     */
    public function getRestaurantName($nameRestaurant) {
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
     * @param string $dateOrdered 
     */
    public function getDateOrdered($dateOrdered) {
        return $this->dateOrdered;
    }
    
    /**
     * Set the date the order was submit
     * @param string $dateOrdered 
     */
    public function setDateOrdered($dateOrdered) {
        $this->dateOrdered = $dateOrdered;
    }
    
    /**
     * get the subtotal of the order
     * @param double $subtotal 
     */
    public function getSubtotal($subtotal) {
        return $this->dateDelivered;
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
     * @param double $shippingCost 
     */
    public function getShippingCost($shippingCost) {
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
     * @param double $taxes 
     */
    public function getTaxes($taxes) {
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
     * @param double $totalCost 
     */
    public function getTotalCost($totalCost) {
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
     * @param int $state
     */
    public function getState($state) {
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
     * @param string $stateName
     */
    public function getStateName($stateName) {
        return $this->stateName;
    }
    
    /**
     * Set the state name of the order
     * @param string $stateName
     */
    public function setStateName($stateName) {
        $this->stateName = $stateName;
    }
}

?>