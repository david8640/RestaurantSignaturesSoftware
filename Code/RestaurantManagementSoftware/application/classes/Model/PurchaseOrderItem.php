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
    private $poId;
    private $idProduct;
    private $qty;
    private $costPerUnit;
     
    /**
     * Constructor of a Purchase Order Item model
     * @param int $poId the purchase order id
     * @param int $idProduct the id of the purchase order
     * @param int $qty the quatity of this item
     * @param double $costPerUnit the cost per unit for this item
     */
    public function __construct($poId, $idProduct, $qty, $costPerUnit) {
        $this->setPOID($poId);
        $this->setProductID($idProduct);
        $this->setQty($qty);
        $this->setCostPerUnit($costPerUnit);
    }
   
    // Getters and setters
    /**
     * get the po id
     * @return int
     */
    public function getPOID() {
        return $this->poId;
    }

    /**
     * Set the po id
     * @param int $poId 
     */
    public function setPOID($poId) {
        $this->poId = $poId;
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
    
    /**
     * get the subtotal for this item
     * @return double 
     */
    public function getSubtotal() {
        return $this->costPerUnit * $this->qty;
    }
}

?>