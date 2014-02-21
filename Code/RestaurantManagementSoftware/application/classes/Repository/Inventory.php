<?php

/*
 *  <copyright file="Inventory.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2014-02-20</date>
 *  <summary>
 *      Manage all the interaction between the database and the application
 *      for an inventory.
 *  </summary>
 */

class Repository_Inventory extends Repository_AbstractRepository {
    /**
     * Get all the restaurant's inventory.
     * @return array of inventory
     */
    public function getAll() {
        return $this->fetchNConstruct('SELECT * FROM v_getRestaurantsInventory', array());
    }
    
    /**
    * Get the inventory of a restaurant.
    * @param int restaurant id
    * @return an inventory
    */ 
    public function get($restaurantId) {
        $params = array (
            new Database_StatementParameter(':restaurantId', $restaurantId, PDO::PARAM_INT, 11)
        );
        
        $inventory = $this->fetchNConstruct('CALL sp_getRestaurantInventory(:restaurantId)', $params);
        
        return (sizeof($inventory) > 0) ? $inventory[0] : null;;
    }
    
    /**
     * Add an inventory.
     * @param \Model_Inventory $inventory
     * @return int id
     */
    public function add($inventory) {
        $params = array (
            new Database_StatementParameter(':restaurantId', $inventory->getRestaurantId(), PDO::PARAM_INT, 11)
        );
        
        return $this->executeNReturnId('CALL sp_addInventory(:restaurantId)', $params);
    }
            
    /**
     * Constructs an inventory from an anonymous object.
     * @param object $obj
     * @return \Model_Inventory
     */
    protected function construct($obj) {
        $inventoryId = $obj->id_inventory;
        
        $repoInventoryItem= new Repository_InventoryItem();
        $items = $repoInventoryItem->getAll($inventoryId);
        
        return new Model_Inventory($inventoryId, $obj->id_restaurant, 
                                       $obj->restaurantName, $items);
    }
}

?>