<?php

/*
 *  <copyright file="InventoryItem.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2014-02-20</date>
 *  <summary>
 *      Manage all the interaction between the database and the application
 *      for each inventory item.
 *  </summary>
 */
class Repository_InventoryItem extends Repository_AbstractRepository {
    /**
    * Get all the inventory items.
    * @param int inventory id
    * @return array of inventory items
    */ 
    public function getAll($inventoryId) {
        $params = array (
            new Database_StatementParameter(':inventoryId', $inventoryId, PDO::PARAM_INT, 11)
        );
        
        return $this->fetchNConstruct('CALL sp_getInventoryItems(:inventoryId)', $params);
    }
    
    /**
     * Save a list of inventory items
     * @param \Model_Inventory $inventory
     * @return boolean success
     */
    public function save($inventory) {
        foreach ($inventory->getItems() as $i) {
            // Insert item
            $successSaveItem = $this->saveItem($inventory->getId(), $i);
            if (!$successSaveItem) {
                return false;
            }
        }
        return true;
    }
    
    /**
     * Save a inventory item in database
     * @param int inventory id
     * @param \Model_InventoryItem $item
     * @return boolean success
     */
    public function saveItem($inventoryId, $item) {
        $params = array (
            new Database_StatementParameter(':itemId', $item->getItemID(), PDO::PARAM_INT, 11),
            new Database_StatementParameter(':inventoryId', $inventoryId, PDO::PARAM_INT, 11),
            new Database_StatementParameter(':idProduct', $item->getProductID(), PDO::PARAM_INT, 11),
            new Database_StatementParameter(':idSupplier', $item->getSupplierID(), PDO::PARAM_INT, 11),
            new Database_StatementParameter(':qty', $item->getQty(), PDO::PARAM_INT, 11),
            new Database_StatementParameter(':costPerUnit', $item->getCostPerUnit(), PDO::PARAM_STR, 20),
            new Database_StatementParameter(':unitOfMeasurement', $item->getUnitOfMeasurement(), PDO::PARAM_STR, 30)
        );
        
        return $this->execute('CALL sp_saveInventoryItem(:itemId, :inventoryId, :idProduct, :idSupplier, :qty, :costPerUnit, :unitOfMeasurement)', $params);
    }
    
    /**
     * Constructs an inventory item from an anonymous object.
     * @param object $obj
     * @return \Model_InventoryItem
     */
    protected function construct($obj) {
        return new Model_InventoryItem($obj->id_item, $obj->id_inventory, 
                                    $obj->id_product,
                                    (isset($obj->productName)) ? $obj->productName : '',
                                    $obj->costPerUnit,
                                    $obj->qty,
                                    (isset($obj->unitOfMeasurement)) ? $obj->unitOfMeasurement : '',
                                    (isset($obj->id_supplier)) ? $obj->id_supplier : '',
                                    (isset($obj->supplierName)) ? $obj->supplierName : '');
    }
}

?>