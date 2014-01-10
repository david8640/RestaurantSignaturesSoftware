
<?php

/* 
 * <copyright file="Model_RestaurantUser.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 * </copyright>
 * <author>David Fortin</author>
 * <date>2014-01-09</date>
 * <summary>Model representing a restaurant user.</summary>
 */
class Model_RestaurantUser extends Model {
    // Private members
    private $idRestaurant;
    private $nameRestaurant;
    private $idUser;
    private $nameUser;
    private $isCheck;
     
    /**
     * Constructor of a restaurant user model
     * @param int $idRestaurant the id of the restaurant
     * @param string $nameRestaurant the name of the restaurant
     * @param int $idUser the id of the user
     * @param string $nameUser the name of the user
     * @param bool $isCheck is true if the user has the access to the restaurant
     */
    public function __construct($idRestaurant, $nameRestaurant, $idUser, $nameUser, $isCheck) {
        $this->setIdRestaurant($idRestaurant);
        $this->setNameRestaurant($nameRestaurant);
        $this->setIdUser($idUser);
        $this->setNameUser($nameUser);
        $this->setIsCheck($isCheck);
    }
   
    // Getters and setters
    /**
     * Get the id of the restaurant
     * @return int
     */
    public function getIdRestaurant() {
        return $this->idRestaurant;
    }
    
    /**
     * Set the id of the restaurant
     * @param int $idRestaurant 
     */
    public function setIdRestaurant($idRestaurant) {
        $this->idRestaurant = $idRestaurant;
    }
    
    /**
     * Get the name of the restaurant
     * @return string
     */
    public function getNameRestaurant() {
        return $this->nameRestaurant;
    }
    
    /**
     * Set the name of the restaurant
     * @param string $nameRestaurant
     */
    public function setNameRestaurant($nameRestaurant) {
        $this->nameRestaurant = $nameRestaurant;
    }

    /**
     * Get the id of the user
     * @return int
     */
    public function getIdUser() {
        return $this->idUser;
    }
    
    /**
     * Set the id of the user
     * @param int $idUser 
     */
    public function setIdUser($idUser) {
        $this->idUser = $idUser;
    }
    
    /**
     * Get the name of the user
     * @return string
     */
    public function getNameUser() {
        return $this->nameUser;
    }
    
    /**
     * Set the name of the user
     * @param string $nameUser
     */
    public function setNameUser($nameUser) {
        $this->nameUser = $nameUser;
    }
    
    /**
     * Get true if the user has access to the restaurant
     * @return bool
     */
    public function getIsCheck() {
        return $this->isCheck;
    }
    
    /**
     * Set to true if the user has access to the restaurant
     * @param bool $isCheck
     */
    public function setIsCheck($isCheck) {
        $this->isCheck = $isCheck;
    }
}

?>