<?php

class Product {
    // Private members
    private $id;
    private $name;
    private $categoryId;
    private $categoryName;
    private $unitOfMeasurement;
    private $supplierId;
    private $supplierName;
    
    public function __construct($id, $name, $categoryId, $categoryName, $unitOfMeasurement, $supplierId, $supplierName) {
        $this->setId($id);
        $this->setName($name);
        $this->setCategoryId($categoryId);
        $this->setCategoryName($categoryName);
        $this->setUnitOfMeasurement($unitOfMeasurement);
        $this->setSupplierId($supplierId);
        $this->setSupplierName($supplierName);
    }
   
    // Getters and setters
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function setName($name) {
        $this->name = $name;
    }
   
    public function getCategoryId() {
        return $this->categoryId;
    }

    public function setCategoryId($categoryId) {
        $this->categoryId = $categoryId;
    }
    
    public function getCategoryName() {
        return $this->categoryName;
    }
    
    public function setCategoryName($categoryName) {
        $this->categoryName = $categoryName;
    }  
    
    public function getUnitOfMeasurement() {
        return $this->unitOfMeasurement;
    }
    
    public function setUnitOfMeasurement($unitOfMeasurement) {
        $this->unitOfMeasurement = $unitOfMeasurement;
    } 
    
    public function getSupplierId() {
        return $this->supplierId;
    }

    public function setSupplierId($supplierId) {
        $this->supplierId = $supplierId;
    }
    
    public function getSupplierName() {
        return $this->supplierName;
    }
    
    public function setSupplierName($supplierName) {
        $this->supplierName = $supplierName;
    }  
}

?>