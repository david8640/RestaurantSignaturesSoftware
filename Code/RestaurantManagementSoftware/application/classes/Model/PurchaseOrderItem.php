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
    private $productName;
    private $costPerUnit;
    private $qty;
    private $unitOfMeasurement;
    private $idSupplier;
    private $supplierName;
     
    /**
     * Constructor of a Purchase Order Item model
     * @param int $poId the purchase order id
     * @param int $idProduct the id of the product
     * @param string $productName the name of the product
     * @param double $costPerUnit the cost per unit for this item
     * @param int $qty the quatity of this item
     * @param string $unitOfMeasurement the unit of measurement of the product
     * @param int $idSupplier the supplier id of the po item
     * @param string $supplierName the supplier name of the po item
     */
    public function __construct($poId, $idProduct, $productName, $costPerUnit, 
                                $qty, $unitOfMeasurement, $idSupplier, $supplierName) {
        $this->setPOID($poId);
        $this->setProductID($idProduct);
        $this->setProductName($productName);
        $this->setCostPerUnit($costPerUnit);
        $this->setQty($qty);
        $this->setUnitOfMeasurement($unitOfMeasurement);
        $this->setSupplierID($idSupplier);
        $this->setSupplierName($supplierName);
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
     * Get the name of the product
     * @return string
     */
    public function getProductName() {
        return $this->productName;
    }
    
    /**
     * Set the name of the product
     * @param string $productName
     */
    public function setProductName($productName) {
        $this->productName = $productName;
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
     * Get the unit of the product
     * @return string
     */
    public function getUnitOfMeasurement() {
        return $this->unitOfMeasurement;
    }
    
    /**
     * Set the unit of the product
     * @param string $unitOfMeasurement
     */
    public function setUnitOfMeasurement($unitOfMeasurement) {
        $this->unitOfMeasurement = $unitOfMeasurement;
    }
    
    /**
     * Get the id of the supplier
     * @return int
     */
    public function getSupplierID() {
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
     * Get the name of the supplier
     * @return string
     */
    public function getSupplierName() {
        return $this->supplierName;
    }
    
    /**
     * Set the name of the supplier
     * @param string $supplierName
     */
    public function setSupplierName($supplierName) {
        $this->supplierName = $supplierName;
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