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
    private $name;
    private $email;
    private $password;
    private $salt;
    private $session_id;
    private $session_expiry_time;
    private $location;

    // Ctr
    /**
     * Constructor of a user model
     * @param int $id the id of the user
     * @param string $name the name of the user
     * @param string $email the email of the user
     * @param string $password the Hashed password
     * @param string $salt the Hashed random salt used to calculate the hashed password
     * @param int $location the selected location
     */
    public function __construct($id, $username, $name, $email, $password, $salt, $session_id, $session_expiry_time, $location) {
        $this->setId($id);
        $this->setUsername($username);
        $this->setName($name);
        $this->setEmail($email);
        $this->setPassword($password);
        $this->setSalt($salt);
        if ($session_id == '') {
            $this->setSessionId(Constants_Constants::BlankHash);
        } else {
            $this->setSessionId($session_id);
        }   
        $this->setSessionId($session_expiry_time);
        $this->setLocation($location);
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
     * Get the username of the user
     * @return string
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * Set the username of the user
     * @param string $username
     */
    public function setUsername($username) {
        $this->username = $username;
    }

    /**
     * Get the name of the user
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set the name of the user
     * @param string $name
     */
    public function setName($name) {
        $this->name = $name;
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
    public function setPassword($password) {
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

    /**
     * Get the getSessionId of the user
     * @return int
     */
    public function getSessionId() {
        return $this->session_id;
    }

    /**
     * Get the fax number of the user
     * @param char $getSessionId
     */
    public function setSessionId($session_id) {
        $this->session_id = $session_id;
    }

    /**
     * Get the fax number of the user
     * @return int
     */
    public function getSessionExpiryTime() {
        return $this->session_expiry_time;
    }

    /**
     * Get the fax number of the user
     * @param int $faxNumber
     */
    public function setSessionExpiryTime($session_expiry_time) {
        $this->session_expiry_time = $session_expiry_time;
    }
    
    /**
     * Get the location of the user
     * @return int
     */
    public function getLocation() {
        return $this->location;
    }
    
     /**
     * Get the location of the user
     * @param int $location
     */
    public function setLocation($location) {
        $this->location = $location;
    }
}

?>