<?php

/* 
 * <copyright file="Model_Product.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 * </copyright>
 * <author>Omar Hijazi</author>
 * <date>2013-10-05</date>
 * <summary>Model representing a product.</summary>
 */
class Model_Product extends Model {
    // Private members
    private $id;
    private $name;
    
    
    
    /**
     * Constructor of a product model
     * @param int $id the id of the product
     * @param string $name the name of the product
     */
    public function __construct($id, $name) {
        $this->setId($id);
        $this->setName($name);
    }
   
    // Getters and setters
    /**
     * Get the id of the product
     * @return int
     */
    public function getId() {
        return $this->id;
    }
    
    /**
     * Set the id of the product
     * @param int $id 
     */
    public function setId($id) {
        $this->id = $id;
    }
    
    /**
     * Get the name of the product
     * @return string
     */
    public function getName() {
        return $this->name;
    }
    
    /**
     * Set the name of the product
     * @param string $name
     */
    public function setName($name) {
        $this->name = $name;
    }
   
    /**
     * Get the supplier id of the product
     * @return string
     */
    
    public function getSupplierID() {
        return $this->supplierID;
    }
    
    /**
     * Set the name of the product
     * @param string $name
     */
    public function setSupplierID($supplierID) {
        $this->name = $supplierID;
    }
    
    
   
}

?>