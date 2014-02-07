<?php

/* 
 * <copyright file="Model_SupplierProduct.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 * </copyright>
 * <author>David Fortin</author>
 * <date>2014-01-25</date>
 * <summary>Model representing a supplier product.</summary>
 */
class Model_SupplierProduct extends Model {
    // Private members
    private $productId;
    private $productName;
    private $supplierId;
    private $supplierName;
    private $unitOfMeasurement;
    private $costPerUnit;
    private $qty;
    
    /**
     * Constructor of a product model
     * @param int $productId the id of the product
     * @param string $productName the name of the product
     * @param int $supplierId the id of the supplier
     * @param string $supplierName the name of the supplier
     * @param string $unitOfMeasurement the unit of the product
     * @param double $costPerUnit the cost/unit of the product
     * @param int $qty the quantity of the product
     */
    public function __construct($productId, $productName, $supplierId, $supplierName,
                                $unitOfMeasurement, $costPerUnit, $qty) {
        $this->setProductID($productId);
        $this->setProductName($productName);
        $this->setSupplierID($supplierId);
        $this->setSupplierName($supplierName);
        $this->setUnitOfMeasurement($unitOfMeasurement);
        $this->setCostPerUnit($costPerUnit);
        $this->setQty($qty);
    }
   
    // Getters and setters
    /**
     * Get the id of the product
     * @return int
     */
    public function getProductID() {
        return $this->productId;
    }
    
    /**
     * Set the id of the product
     * @param int $productId 
     */
    public function setProductID($productId) {
        $this->productId = $productId;
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
     * Get the id of the supplier
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
     * Get the cost/unit of the product
     * @return double
     */
    public function getCostPerUnit() {
        return $this->costPerUnit;
    }
    
    /**
     * Set the cost/unit of the product
     * @param double $costPerUnit
     */
    public function setCostPerUnit($costPerUnit) {
        $this->costPerUnit = $costPerUnit;
    }
    
    /**
     * Get the quantity of the product
     * @return int
     */
    public function getQty() {
        return $this->qty;
    }
    
    /**
     * Set the quantity of the product
     * @param int $qty
     */
    public function setQty($qty) {
        $this->qty = $qty;
    }
}

?>