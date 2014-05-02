<?php

class SupplierProduct {
    // Private members
    private $productId;
    private $supplierId;
    private $unitOfMeasurement;
    private $costPerUnit;
    
    /**
     * Constructor of a product model
     * @param int $productId the id of the product
     * @param int $supplierId the id of the supplier
     * @param string $unitOfMeasurement the unit of the product
     * @param double $costPerUnit the cost/unit of the product
     */
    public function __construct($productId, $supplierId, $unitOfMeasurement, $costPerUnit) {
        $this->setProductID($productId);
        $this->setSupplierID($supplierId);
        $this->setUnitOfMeasurement($unitOfMeasurement);
        $this->setCostPerUnit($costPerUnit);
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
}

?>