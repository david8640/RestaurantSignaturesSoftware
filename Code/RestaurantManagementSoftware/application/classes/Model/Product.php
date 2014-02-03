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
    private $categoryId;
    private $categoryName;
    private $unitOfMeasurement;
    
    /**
     * Constructor of a product model
     * @param int $id the id of the product
     * @param string $name the name of the product
     * @param int $categoryId the id of the product's category
     * @param string $categoryName the name of the product's category
     * @param string $unitOfMeasurement the unit of measurement of the product
     */
    public function __construct($id, $name, $categoryId, $categoryName, $unitOfMeasurement) {
        $this->setId($id);
        $this->setName($name);
        $this->setCategoryId($categoryId);
        $this->setCategoryName($categoryName);
        $this->setUnitOfMeasurement($unitOfMeasurement);
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
     * Get the category id of the product
     * @return int
     */
    
    public function getCategoryId() {
        return $this->categoryId;
    }
    
    /**
     * Set the category id of the product
     * @param int $categoryId
     */
    public function setCategoryId($categoryId) {
        $this->categoryId = $categoryId;
    }
    
    /**
     * Get the category name of the product
     * @return string
     */
    
    public function getCategoryName() {
        return $this->categoryName;
    }
    
    /**
     * Set the category name of the product
     * @param string $categoryName
     */
    public function setCategoryName($categoryName) {
        $this->categoryName = $categoryName;
    }  
    
    /**
     * Get the unit of measurement of the product
     * @return string
     */
    
    public function getUnitOfMeasurement() {
        return $this->unitOfMeasurement;
    }
    
    /**
     * Set the unit of measurement of the product
     * @param string $unitOfMeasurement
     */
    public function setUnitOfMeasurement($unitOfMeasurement) {
        $this->unitOfMeasurement = $unitOfMeasurement;
    } 
}

?>