<?php

/* 
 * <copyright file="InventoryItem.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 * </copyright>
 * <author>David Fortin</author>
 * <date>2014-02-20</date>
 * <summary>Model representing an inventory item.</summary>
 */
class Model_InventoryItem extends Model {
    // Private members
    private $itemId;
    private $inventoryId;
    private $idProduct;
    private $productName;
    private $costPerUnit;
    private $qty;
    private $unitOfMeasurement;
    private $idSupplier;
    private $supplierName;
     
    /**
     * Constructor of an Inventory Item model
     * @param int $itemId the id of the item
     * @param int $inventoryId the id of the inventory
     * @param int $idProduct the id of the product
     * @param string $productName the name of the product
     * @param double $costPerUnit the cost per unit for this item
     * @param int $qty the quatity of this item
     * @param string $unitOfMeasurement the unit of measurement of the product
     * @param int $idSupplier the supplier id of the this item
     * @param string $supplierName the supplier name of this item
     */
    public function __construct($itemId, $inventoryId, $idProduct, $productName, $costPerUnit, 
                                $qty, $unitOfMeasurement, $idSupplier, $supplierName) {
        $this->setItemID($itemId);
        $this->setInventoryID($inventoryId);
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
     * get the item id
     * @return int
     */
    public function getItemID() {
        return $this->itemId;
    }

    /**
     * Set the item id
     * @param int $itemId 
     */
    public function setItemID($itemId) {
        $this->itemId = $itemId;
    }
    
    /**
     * get the inventory id
     * @return int
     */
    public function getInventoryID() {
        return $this->inventoryId;
    }

    /**
     * Set the inventory id
     * @param int $inventoryId 
     */
    public function setInventoryID($inventoryId) {
        $this->inventoryId = $inventoryId;
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
}

?>