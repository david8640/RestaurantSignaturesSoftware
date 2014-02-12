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
    * Get all the purchase order items.
    * @param int order id
    * @return array of purchase order items
    */ 
    public function getAll($orderId) {
        $params = array (
            new Database_StatementParameter(':orderId', $orderId, PDO::PARAM_INT, 11)
        );
        
        return $this->fetchNConstruct('CALL sp_getPurchaseOrderItemsByOrderId(:orderId)', $params);
    }
    
    /**
     * Get all the purchase order items.
     * @param int purchase order id
     * @return array of purchase order items
     */
    public function getAllByPOId($poId) {
        $params = array (
            new Database_StatementParameter(':poid', $poId, PDO::PARAM_INT, 11)
        );
        
        return $this->fetchNConstruct('CALL sp_getPurchaseOrderItems(:poid)', $params);
    }
    
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
     * Constructs an purchase order item from an anonymous object.
     * @param object $obj
     * @return \Model_PurchaseOrderItem
     */
    protected function construct($obj) {
        return new Model_PurchaseOrderItem($obj->id_po, 
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