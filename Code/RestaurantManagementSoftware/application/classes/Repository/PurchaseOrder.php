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
    /**
     * Get all the purchase orders.
     * @return array of purchase orders
     */
    public function getAll() {
        return $this->fetchNConstruct('SELECT * FROM v_getPurchaseOrders', array());
    }
    
    /**
     * Save a list of purchase orders of an order.
     * @param int $orderId
     * @param list $purchaseOrders
     * @return boolean success
     */
    public function save($orderId, $purchaseOrders) {
        $successDeleteAll = $this->deleteAllPurchaseOrdersOfOrder($orderId);
        if (!$successDeleteAll) {
            return false;
        }
        
        $repoPOItem = new Repository_PurchaseOrderItem();
        foreach ($purchaseOrders as $po) {
            // Insert PO
            $poId = $this->add($orderId, $po);
            if ($poId == -1) {
                return false;
            }
            
            // Insert PO Items
            $successInsertPoItem = $repoPOItem->save($poId, $po->getItems());
            if (!$successInsertPoItem) {
                return false;
            }
        }
        return true;
    }
    
        /**
     * Delete All the purchase orders from an order.
     * @param int $orderId
     * @return boolean success
     */
    public function deleteAllPurchaseOrdersOfOrder($orderId) {
        $params = array (
            new Database_StatementParameter(':poOrderid', $orderId, PDO::PARAM_INT, 11)
        );

        return $this->execute('CALL sp_deleteAllPurcaseOrdersOfOrder(:poOrderid)', $params);
    }
    
    /**
     * Checks if the poNumber is unique. 
     * @param string $poNumber
     * @return boolean true = po number is unique
     */
    public function isSupplierPONumberUnique($poNumber) {
        $params = array (
            new Database_StatementParameter(':poNumber', $poNumber, PDO::PARAM_STR, 20)
        );
        
        return $this->execute('CALL sp_isSupplierPONumberUnique(:poNumber)', $params);
    }
    
    /**
     * Add a purchase order element in database and return the id.
     * @param int $orderId
     * @param \Model_PurchaseOrder $po
     * @return int id
     */
    private function add($orderId, $po) {
        $params = array (
            new Database_StatementParameter(':poSupplierNumber', $po->getSupplierPONumber(), PDO::PARAM_STR, 20),
            new Database_StatementParameter(':poIdOrder', $orderId, PDO::PARAM_INT, 11),
            new Database_StatementParameter(':poIdSupplier', $po->getSupplierID(), PDO::PARAM_INT, 11),
            new Database_StatementParameter(':poDateOrdered', $po->getDateOrdered(), PDO::PARAM_STR, 19), //date  needs to be passed as a string
            new Database_StatementParameter(':poDateDelivered', $po->getDateDelivered(), PDO::PARAM_STR, 19),
            new Database_StatementParameter(':poSubtotal', $po->getSubtotal(), PDO::PARAM_STR, 20),
            new Database_StatementParameter(':poTaxes', $po->getTaxes(), PDO::PARAM_STR, 20),
            new Database_StatementParameter(':poTotalCost', $po->getTotalCost(), PDO::PARAM_STR, 20),
            new Database_StatementParameter(':poShippingCost', $po->getShipping(), PDO::PARAM_STR, 20),
            new Database_StatementParameter(':poState', $po->getState(), PDO::PARAM_INT, 3)
        );
        
        return $this->executeNReturnId('CALL sp_addPurchaseOrder(:poSupplierNumber, :poIdOrder, '
                                . ':poIdSupplier, :poDateOrdered, :poDateDelivered,'
                                . ':poSubtotal, :poTaxes, :poTotalCost, :poShippingCost,'
                                . ':poState)', $params);
    }
        
    /**
     * Constructs an purchase order from an anonymous object.
     * @param object $obj
     * @return \Model_PurchaseOrder
     */
    protected function construct($obj) {
        $poId = $obj->id_po;
        
        $repoPOItem = new Repository_PurchaseOrderItem();
        $items = $repoPOItem->getAllByPOId($poId);
        
        return new Model_PurchaseOrder($poId, $obj->id_order, $obj->id_supplier, 
                                        $obj->po_NumberSupplier, $obj->supplierName, 
                                        $obj->dateOrdered, $obj->dateDelivered, 
                                        $obj->subtotal, $obj->shippingCost, 
                                        $obj->taxes, $obj->totalCost, $obj->state,
                                        $items);
    }
}

?>