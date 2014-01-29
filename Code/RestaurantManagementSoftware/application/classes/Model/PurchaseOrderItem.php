<?php

/* 
 * <copyright file="PurchaseOrderItem.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 * </copyright>
 * <author>David Fortin</author>
 * <date>2014-01-24</date>
 * <summary>Model representing a purchase order item.</summary>
 */
class Model_PurchaseOrderItem extends Model {
    // Private members
    private $poNumber;
    private $idProduct;
    private $qty;
    private $costPerUnit;
     
    /**
     * Constructor of a Purchase Order Item model
     * @param string $poNumber the purchase order number
     * @param int $idProduct the id of the purchase order
     * @param int $qty the quatity of this item
     * @param double $costPerUnit the cost per unit for this item
     */
    public function __construct($poNumber, $idProduct, $qty, $costPerUnit) {
        $this->setPONumber($poNumber);
        $this->setProductID($idProduct);
        $this->setQty($qty);
        $this->setCostPerUnit($costPerUnit);
    }
   
    // Getters and setters
    /**
     * get the po number
     * @return string
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
     * get the id of the product
     * @return int 
     */
    public function getProductID() {
        return $this->idProduct;
    }

    /**
     * Set the id of the product
     * @param int $idProduct 
     */
    public function setProductID($idProduct) {
        $this->idProduct = $idProduct;
    }
    
    /**
     * get the quatity of this item
     * @return int
     */
    public function getQty() {
        return $this->qty;
    }

    /**
     * Set the quatity of this item
     * @param int $qty 
     */
    public function setQty($qty) {
        $this->qty = $qty;
    }
    
    /**
     * get the cost per unit for this item
     * @return double 
     */
    public function getCostPerUnit() {
        return $this->costPerUnit;
    }
    
    /**
     * Set the cost per unit for this item
     * @param double $costPerUnit 
     */
    public function setCostPerUnit($costPerUnit) {
        $this->costPerUnit = $costPerUnit;
    }
}

?>