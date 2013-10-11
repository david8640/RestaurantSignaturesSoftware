<?php

/* 
 * <copyright file="Model_Supplier.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 * </copyright>
 * <author>David Fortin</author>
 * <date>2013-10-05</date>
 * <summary>Model representing a supplier.</summary>
 */
class Model_Supplier extends Model {
    // Private members
    private $id;
    private $name;
    private $phoneNumber;
    
    // Ctr
    /**
     * Constructor of a supplier model
     * @param type $id the id of the supplier
     * @param type $name the name of the supplier
     * @param type $phoneNumber the phone number of the supplier
     */
    public function __construct($id, $name, $phoneNumber) {
        $this->setId($id);
        $this->setName($name);
        $this->setPhoneNumber($phoneNumber);
    }
   
    // Getters and setters
    /**
     * Get the id of the supplier
     * @return int
     */
    public function getId() {
        return $this->id;
    }
    
    /**
     * Set the id of the supplier
     * @param int $id 
     */
    public function setId($id) {
        $this->id = $id;
    }
    
    /**
     * Get the name of the supplier
     * @return string
     */
    public function getName() {
        return $this->name;
    }
    
    /**
     * Set the name of the supplier
     * @param string $name
     */
    public function setName($name) {
        $this->name = $name;
    }
    
    /**
     * Get the number of the supplier
     * @return int
     */
    public function getPhoneNumber() {
        return $this->phoneNumber;
    }
    
    /**
     * Get the number of the supplier
     * @param int $phoneNumber
     */
    public function setPhoneNumber($phoneNumber) {
        $this->phoneNumber = $phoneNumber;
    }
}

?>