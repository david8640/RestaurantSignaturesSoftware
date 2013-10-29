<?php

/* 
 * <copyright file="User.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 * </copyright>
 * <author>David Fortin</author>
 * <date>2013-10-05</date>
 * <summary>Model representing a user.</summary>
 */
class Model_User extends Model {
    // Private members
    private $id;
    private $username;
    private $first_name;
    private $last_name;
    private $email;
    private $password;
    private $salt;
    // Ctr
    /**
     * Constructor of a user model
     * @param int $id the id of the user
     * @param string $name the name of the user
     * @param int $phoneNumber the phone number of the user
     * @param int $faxNumber the fax number of the user
     */
    public function __construct($id, $username, $name, $email, $password, $salt) {
        $this->setId($id);
        $this->setUsername($username);
        $this->setFirstName($name);
        $this->setEmail($email);
        $this->setPassword($password);
        $this->setSalt($salt);
    }
   
    // Getters and setters
    /**
     * Get the id of the user
     * @return int
     */
    public function getId() {
        return $this->id;
    }
    
    /**
     * Set the id of the user
     * @param int $id 
     */
    public function setId($id) {
        $this->id = $id;
    }
    
    /**
     * Get the id of the user
     * @return int
     */
    public function getUsername() {
        return $this->id;
    }
    
    /**
     * Set the id of the user
     * @param int $id 
     */
    public function setUsername($username) {
        $this->username = $username;
    }
    
    /**
     * Get the name of the user
     * @return string
     */
    public function getFirstName() {
        return $this->first_name;
    }
    
    /**
     * Set the name of the user
     * @param string $name
     */
    public function setFirstName($first_name) {
        $this->first_name = $first_name;
    }
    
     /**
     * Get the name of the user
     * @return string
     */
    public function getLastName() {
        return $this->last_name;
    }
    
    /**
     * Set the name of the user
     * @param string $name
     */
    public function setLastName($last_name) {
        $this->last_name = $last_name;
    }
            
    
    /**
     * Get the number of the user
     * @return int
     */
    public function getEmail() {
        return $this->email;
    }
    
    /**
     * Get the number of the user
     * @param int $phoneNumber
     */
    public function setEmail($email) {
        $this->email = $email;
    }
    
    /**
     * Get the fax number of the user
     * @return int
     */
    public function getPassword() {
        return $this->password;
    }
    
    /**
     * Get the fax number of the user
     * @param int $faxNumber
     */
    public function setFaxNumber($password) {
        $this->password = $password;
    }
    
     /**
     * Get the fax number of the user
     * @return int
     */
    public function getSalt() {
        return $this->salt;
    }
    
    /**
     * Get the fax number of the user
     * @param int $faxNumber
     */
    public function setSalt($salt) {
        $this->salt = $salt;
    }
}

?>