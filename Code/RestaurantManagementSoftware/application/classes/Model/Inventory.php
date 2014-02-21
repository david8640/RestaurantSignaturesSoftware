<?php

/* 
 * <copyright file="Model_Inventory.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 * </copyright>
 * <author>David Fortin</author>
 * <date>2014-02-20</date>
 * <summary>Model representing an inventory.</summary>
 */
class Model_Inventory extends Model {
    // Private members
    private $id;
    private $restaurantId;
    private $restaurantName;
    private $items;
    
    /**
     * Constructor of an inventory model
     * @param int $id the id of the inventory
     * @param int $restaurantId the id of the restaurant
     * @param string $restaurantName the name of the restaurant
     * @param list of InventoryItem $items A list of Inventory Items    
     */
    public function __construct($id, $restaurantId, $restaurantName, $items) {
        $this->setId($id);
        $this->setRestaurantId($restaurantId);
        $this->setRestaurantName($restaurantName);
        $this->items = $items;
    }
   
    // Getters and setters
    /**
     * Get the id of the inventory
     * @return int
     */
    public function getId() {
        return $this->id;
    }
    
    /**
     * Set the id of the inventory
     * @param int $id 
     */
    public function setId($id) {
        $this->id = $id;
    }
   
    /**
     * Get the id of the restaurant
     * @return int
     */
    public function getRestaurantId() {
        return $this->restaurantId;
    }
    
    /**
     * Set the id of the restaurant
     * @param int $restaurantId 
     */
    public function setRestaurantId($restaurantId) {
        $this->restaurantId = $restaurantId;
    }
    
    /**
     * Get the name of the restaurant
     * @return string
     */
    public function getRestaurantName() {
        return $this->restaurantName;
    }
    
    /**
     * Set the name of the restaurant
     * @param string $restaurantName
     */
    public function setRestaurantName($restaurantName) {
        $this->restaurantName = $restaurantName;
    }
    
    /**
     * Get the items of the inventory
     * @return list of items
     */
    public function getItems() {
        return $this->items;
    }
    
    /**
     * Add an item in the inventory
     * @param InventoryItem $item
     */
    public function addItem($item) {
        array_push($this->items, $item);
    }
}

?>