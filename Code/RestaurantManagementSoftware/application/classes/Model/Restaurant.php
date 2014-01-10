<?php

/* 
 * <copyright file="Model_Restaurant.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 * </copyright>
 * <author>David Fortin</author>
 * <date>2014-01-09</date>
 * <summary>Model representing a restaurant.</summary>
 */
class Model_Restaurant extends Model {
    // Private members
    private $id;
    private $name;
    private $address;
     
    /**
     * Constructor of a restaurant model
     * @param int $id the id of the restaurant
     * @param string $name the name of the restaurant
     * @param string $address the address of the restaurant
     */
    public function __construct($id, $name, $address) {
        $this->setId($id);
        $this->setName($name);
        $this->setAddress($address);
    }
   
    // Getters and setters
    /**
     * Get the id of the restaurant
     * @return int
     */
    public function getId() {
        return $this->id;
    }
    
    /**
     * Set the id of the restaurant
     * @param int $id 
     */
    public function setId($id) {
        $this->id = $id;
    }
    
    /**
     * Get the name of the restaurant
     * @return string
     */
    public function getName() {
        return $this->name;
    }
    
    /**
     * Set the name of the restaurant
     * @param string $name
     */
    public function setName($name) {
        $this->name = $name;
    }
   
    /**
     * Get the address of the restaurant
     * @return string
     */
    
    public function getAddress() {
        return $this->address;
    }
    
    /**
     * Set the address of the restaurant
     * @param string $address
     */
    public function setAddress($address) {
        $this->address = $address;
    }
}

?>