<?php

/* 
 * <copyright file="Model_ProductCategory.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 * </copyright>
 * <author>David Fortin</author>
 * <date>2013-11-17</date>
 * <summary>Model representing a product category.</summary>
 */
class Model_ProductCategory extends Model {
    // Private members
    private $id;
    private $name;
    private $parent;
    private $parentName;
    private $order;
    
    // Ctr
    /**
     * Constructor of a product category model
     * @param int $id the id of the product category
     * @param string $name the name of the product category
     * @param string $parent the name of the contact
     * @param string $parentName the phone number of the product category
     * @param string $order the fax number of the product category
     */
    public function __construct($id, $name, $parent, $parentName, $order) {
        $this->setId($id);
        $this->setName($name);
        $this->setParent($parent);
        $this->setParentName($parentName);
        $this->setOrder($order);
    }
   
    // Getters and setters
    /**
     * Get the id of the product category
     * @return int
     */
    public function getId() {
        return $this->id;
    }
    
    /**
     * Set the id of the product category
     * @param int $id 
     */
    public function setId($id) {
        $this->id = $id;
    }
    
    /**
     * Get the name of the product category
     * @return string
     */
    public function getName() {
        return $this->name;
    }
    
    /**
     * Set the name of the product category
     * @param string $name
     */
    public function setName($name) {
        $this->name = $name;
    }
    
    /**
     * Get the parent id of the product category
     * @return string
     */
    public function getParent() {
        return $this->parent;
    }
    
    /**
     * Set the parent of the product category
     * @param string $parent
     */
    public function setParent($parent) {
        $this->parent = $parent;
    }
    
    /**
     * Get the parent name of the product category
     * @return string
     */
    public function getParentName() {
        return $this->parentName;
    }
    
    /**
     * Get the parent name of the product category
     * @param string $parentName
     */
    public function setParentName($parentName) {
        $this->parentName = $parentName;
    }
    
    /**
     * Get the order of the product category
     * @return string
     */
    public function getOrder() {
        return $this->order;
    }
    
    /**
     * Get the order of the product category
     * @param string $order
     */
    public function setOrder($order) {
        $this->order = $order;
    }
}

?>