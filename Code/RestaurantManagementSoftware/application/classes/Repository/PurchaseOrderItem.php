<?php

/*
 *  <copyright file="PurchaseOrderItem.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2014-02-11</date>
 *  <summary>
 *      Manage all the interaction between the database and the application
 *      for each purchase order item.
 *  </summary>
 */

class Repository_PurchaseOrderItem extends Repository_AbstractRepository { 
    public function save($purchaseOrderItems) {       
        foreach ($purchaseOrderItems as $poItem) {
            // Insert PO
            $successInsertPoItem = $this->add($poItem);
            if (!$successInsertPoItem) {
                return false;
            }
        }
        return true;
    }
    
    private function add($poItem) {
        $params = array (
            new Database_StatementParameter(':poiPoNumber', $poItem->getPONumber(), PDO::PARAM_STR, 20),
            new Database_StatementParameter(':poiIdProduct', $poItem->getProductID(), PDO::PARAM_INT, 11),
            new Database_StatementParameter(':poiQty', $poItem->getQty(), PDO::PARAM_INT, 11),
            new Database_StatementParameter(':poiCostPerUnit', $poItem->getCostPerUnit(), PDO::PARAM_STR, 20)
        );
        
        return $this->execute('CALL sp_addPurchaseOrderItem(:poiPoNumber, :poiIdProduct, :poiQty, :poiCostPerUnit)', $params);
    }
    
    /**
     * Constructs an order from an anonymous object.
     * @param object $obj
     * @return \Model_PurchaseOrder
     */
    protected function construct($obj) {
        // TODO
    }
}

?>