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
    /**
     * Save a list of purchase order items
     * @param int purchase order id
     * @param list $purchaseOrderItems
     * @return boolean success
     */
    public function save($poId, $purchaseOrderItems) {
        foreach ($purchaseOrderItems as $poItem) {
            // Insert PO
            $successInsertPoItem = $this->add($poId, $poItem);
            if (!$successInsertPoItem) {
                return false;
            }
        }
        return true;
    }
    
    /**
     * Add a purchase order item in database
     * @param int purchase order id
     * @param \Model_PurchaseOrderItem $poItem
     * @return boolean success
     */
    private function add($poId, $poItem) {
        $params = array (
            new Database_StatementParameter(':poiPoId', $poId, PDO::PARAM_INT, 11),
            new Database_StatementParameter(':poiIdProduct', $poItem->getProductID(), PDO::PARAM_INT, 11),
            new Database_StatementParameter(':poiQty', $poItem->getQty(), PDO::PARAM_INT, 11),
            new Database_StatementParameter(':poiCostPerUnit', $poItem->getCostPerUnit(), PDO::PARAM_STR, 20)
        );
        
        return $this->execute('CALL sp_addPurchaseOrderItem(:poiPoId, :poiIdProduct, :poiQty, :poiCostPerUnit)', $params);
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