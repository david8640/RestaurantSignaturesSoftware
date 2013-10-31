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
    private $contactName;
    private $phoneNumber;
    private $faxNumber;
    
    // Ctr
    /**
     * Constructor of a supplier model
     * @param int $id the id of the supplier
     * @param string $name the name of the supplier
     * @param string $contactName the name of the contact
     * @param string $phoneNumber the phone number of the supplier
     * @param string $faxNumber the fax number of the supplier
     */
    public function __construct($id, $name, $contactName, $phoneNumber, $faxNumber) {
        $this->setId($id);
        $this->setName($name);
        $this->setContactName($contactName);
        $this->setPhoneNumber($phoneNumber);
        $this->setFaxNumber($faxNumber);
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
     * Get the contact name of the supplier
     * @return string
     */
    public function getContactName() {
        return $this->contactName;
    }
    
    /**
     * Set the contact name of the supplier
     * @param string $contactName
     */
    public function setContactName($contactName) {
        $this->contactName = $contactName;
    }
    
    /**
     * Get the number of the supplier
     * @return string
     */
    public function getPhoneNumber() {
        return $this->phoneNumber;
    }
    
    /**
     * Get the number of the supplier
     * @param string $phoneNumber
     */
    public function setPhoneNumber($phoneNumber) {
        $this->phoneNumber = $phoneNumber;
    }
    
    /**
     * Get the fax number of the supplier
     * @return string
     */
    public function getFaxNumber() {
        return $this->faxNumber;
    }
    
    /**
     * Get the fax number of the supplier
     * @param string $faxNumber
     */
    public function setFaxNumber($faxNumber) {
        $this->faxNumber = $faxNumber;
    }
}

?>