<?php

/*
 *  <copyright file="PurchaseOrder.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2014-01-29</date>
 *  <summary>
 *      Manage all the interaction between the database and the application
 *      for each purchase order.
 *  </summary>
 */

class Repository_PurchaseOrder extends Repository_AbstractRepository { 
    public function save($orderId, $purchaseOrders) {
        $successDeleteAll = $this->deleteAllPurchaseOrderOfOrder($orderId);
        if (!$successDeleteAll) {
            return false;
        }
        
        $repoPOItem = new Repository_PurchaseOrderItem();
        foreach ($purchaseOrders as $po) {
            // Insert PO
            $successInsertPo = $this->add($po);
            if (!$successInsertPo) {
                return false;
            }
            
            // Insert PO Items
            $successInsertPoItem = $repoPOItem->save($po->getItems());
            if (!$successInsertPoItem) {
                return false;
            }
        }
        return true;
    }
    
    private function add($po) {
        $params = array (
            new Database_StatementParameter(':poPoNumber', $po->getPONumber(), PDO::PARAM_STR, 20),
            new Database_StatementParameter(':poIdOrder', $po->getOrderID(), PDO::PARAM_INT, 11),
            new Database_StatementParameter(':poIdSupplier', $po->getSupplierID(), PDO::PARAM_INT, 11),
            new Database_StatementParameter(':poDateOrdered', $po->getDateOrdered(), PDO::PARAM_STR, 19), //date  needs to be passed as a string
            new Database_StatementParameter(':poDateDelivered', $po->getDateDelivered(), PDO::PARAM_STR, 19),
            new Database_StatementParameter(':poSubtotal', $po->getSubtotal(), PDO::PARAM_STR, 20),
            new Database_StatementParameter(':poTaxes', $po->getTaxes(), PDO::PARAM_STR, 20),
            new Database_StatementParameter(':poTotalCost', $po->getTotalCost(), PDO::PARAM_STR, 20),
            new Database_StatementParameter(':poShippingCost', $po->getShipping(), PDO::PARAM_STR, 20),
            new Database_StatementParameter(':poState', $po->getState(), PDO::PARAM_INT, 3)
        );
        
        return $this->execute('CALL sp_addPurchaseOrder(:poPoNumber, :poIdOrder, '
                                . ':poIdSupplier, :poDateOrdered, :poDateDelivered,'
                                . ':poSubtotal, :poTaxes, :poTotalCost, :poShippingCost'
                                . ':poState)', $params);
    }
    
    private function deleteAllPurchaseOrderOfOrder($orderId) {
        // TODO
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