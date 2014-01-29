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
    private $supplierPONumber;
    private $idOrder;
    private $supplierId;
    private $supplierName;
    private $dateOrdered;
    private $dateDelivered;
    private $subtotal;
    private $shipping;
    private $taxes;
    private $totalCost;
    private $state;
     
    /**
     * Constructor of a Purchase Order model
     * @param int $poNumber the purchase order number
     * @param int $idOrder the id of the order
     * @param int $idSupplier the id of the supplier of the purchase order
     * @param string $supplierPONumber the purchase order number of the supplier
     * @param string $supplierName the name of the supplier of the purchase order
     * @param string $dateOrdered the date ordered
     * @param string $dateDelivered the date delivered
     * @param double $subtotal the subtotal of the order
     * @param double $shipping the shipping cost of the purchase order
     * @param double $taxes the taxes of the purchase order
     * @param double $totalCost the total cost of the purchase order
     * @param int $state the state of the purchase order
     */
    public function __construct($poNumber, $idOrder, $idSupplier, $supplierPONumber,  
                                $supplierName, $dateOrdered, $dateDelivered, $subtotal,   
                                $shipping, $taxes, $totalCost, $state) {
        $this->setPONumber($poNumber);
        $this->setSupplierPONumber($supplierPONumber);
        $this->setOrderID($idOrder);
        $this->setSupplierID($idSupplier);
        $this->setSupplierName($supplierName);
        $this->setDateOrdered($dateOrdered);
        $this->setDateDelivered($dateDelivered);
        $this->setSubtotal($subtotal);
        $this->setShipping($shipping);
        $this->setTaxes($taxes);
        $this->setTotalCost($totalCost);
        $this->setState($state);
    }
   
    // Getters and setters
    /**
     * get the po number
     * @return int
     */
    public function getPONumber() {
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
     * @return int 
     */
    public function getOrderID() {
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
     * @return int
     */
    public function getSupplierID() {
        return $this->supplierId;
    }

    /**
     * Set the id of the supplier
     * @param int $supplierId 
     */
    public function setSupplierID($supplierId) {
        $this->supplierId = $supplierId;
    }
    
    /**
     * get the supplier po number
     * @return string
     */
    public function getSupplierPONumber() {
        return $this->supplierPONumber;
    }

    /**
     * Set the supplier po number
     * @param int $supplierPONumber
     */
    public function setSupplierPONumber($supplierPONumber) {
        $this->supplierPONumber = $supplierPONumber;
    }
    
    /**
     * get the supplier name
     * @return string
     */
    public function getSupplierName() {
        return $this->supplierName;
    }

    /**
     * Set the supplier name
     * @param int $supplierName
     */
    public function setSupplierName($supplierName) {
        $this->supplierName = $supplierName;
    }
    
    /**
     * get the date the product was ordered
     * @return string
     */
    public function getDateOrdered() {
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
     * @return string
     */
    public function getDateDelivered() {
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
    public function getShipping() {
        return $this->shipping;
    }
    
    /**
     * Set the shipping cost of the order
     * @param double $shipping
     */
    public function setShipping($shipping) {
        $this->shipping = $shipping;
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
}

?>