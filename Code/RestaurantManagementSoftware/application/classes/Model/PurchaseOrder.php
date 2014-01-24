<?php

/* 
 * <copyright file="PurchaseOrder.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 * </copyright>
 * <author>David Fortin</author>
 * <date>2014-01-24</date>
 * <summary>Model representing a purchase order.</summary>
 */
class Model_PurchaseOrder extends Model {
    // Private members
    private $poNumber;
    private $idOrder;
    private $idSupplier;
    private $dateOrdered;
    private $dateDelivered;
    private $subtotal;
    private $shippingCost;
    private $taxes;
    private $totalCost;
    private $state;
     
    /**
     * Constructor of a Purchase Order model
     * @param string $poNumber the purchase order number
     * @param int $idOrder the id of the order
     * @param int $idSupplier the id of the supplier of the purchase order
     * @param string $dateOrdered the date ordered
     * @param string $dateDelivered the date delivered
     * @param double $subtotal the subtotal of the order
     * @param double $shippingCost the shipping cost of the purchase order
     * @param double $taxes the taxes of the purchase order
     * @param double $totalCost the total cost of the purchase order
     * @param int $state the state of the purchase order
     */
    public function __construct($poNumber, $idOrder, $idSupplier, $dateOrdered, 
                                $dateDelivered, $subtotal, $shippingCost, $taxes, 
                                $totalCost, $state) {
        $this->setPONumber($poNumber);
        $this->setOrderID($idOrder);
        $this->setSupplierID($idSupplier);
        $this->setDateOrdered($dateOrdered);
        $this->setDateDelivered($dateDelivered);
        $this->setSubtotal($subtotal);
        $this->setShippingCost($shippingCost);
        $this->setTaxes($taxes);
        $this->setTotalCost($totalCost);
        $this->setState($state);
    }
   
    // Getters and setters
    /**
     * get the po number
     * @param string $poNumber 
     */
    public function getPONumber($poNumber) {
        return $this->poNumber;
    }

    /**
     * Set the po number
     * @param int $poNumber 
     */
    public function setPONumber($poNumber) {
        $this->poNumber = $poNumber;
    }
    
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
     * get the id of the supplier
     * @param int $idSupplier
     */
    public function getSupplierID($idSupplier) {
        return $this->idSupplier;
    }

    /**
     * Set the id of the supplier
     * @param int $idSupplier 
     */
    public function setSupplierID($idSupplier) {
        $this->idSupplier = $idSupplier;
    }
    
    /**
     * get the date the product was ordered
     * @param string $dateOrdered 
     */
    public function getDateOrdered($dateOrdered) {
        return $this->dateOrdered;
    }
    
    /**
     * Set the date the product was ordered
     * @param string $dateOrdered 
     */
    public function setDateOrdered($dateOrdered) {
        $this->dateOrdered = $dateOrdered;
    }

    /**
     * get the date the product was deliveredd
     * @param string $dateDelivered 
     */
    public function getDateDelivered($dateDelivered) {
        return $this->dateDelivered;
    }
    
    /**
     * Set the date the product was delivered
     * @param string $dateDelivered 
     */
    public function setDateDelivered($dateDelivered) {
        $this->dateDelivered = $dateDelivered;
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
}

?>