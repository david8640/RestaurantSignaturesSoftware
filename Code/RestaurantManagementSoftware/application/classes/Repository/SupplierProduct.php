<?php

/*
 *  <copyright file="SupplierProduct.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2014-01-29</date>
 *  <summary>
 *      Manage all the interaction between the database and the application
 *      for each suppliers' products.
 *  </summary>
 */

class Repository_SupplierProduct extends Repository_AbstractRepository {
    /**
    * Get all the suppliers' products.
    * @return array of SupplierProduct
    */ 
    public function getAll() {
        return $this->fetchNConstruct('SELECT * FROM v_getSuppliersProducts', array()); 
    }
    
    /**
     * Get the supplier product with the product id and suppler id pass in parameter.
     * @param int $supplierId
     * @param int $productId
     * @return a SupplierProduct
     */
    public function get($supplierId, $productId) {
        $params = array (
            new Database_StatementParameter(':spsupplierId', $supplierId, PDO::PARAM_INT, 11),
            new Database_StatementParameter(':spproductId', $productId, PDO::PARAM_INT, 11)
        );
        
        $supplierProduct = $this->fetchNConstruct('CALL sp_getSupplierProduct(:spsupplierId, :spproductId)', $params);
        return (sizeof($supplierProduct) > 0) ? $supplierProduct[0] : null;
    }
    
    /**
     * Save a supplierProduct
     * @param Model_SupplierProduct $supplierProduct
     * @return int
     */
    public function save($supplierProduct) {
        $params = array (
            new Database_StatementParameter(':spsupplierId', $supplierProduct->getSupplierID(), PDO::PARAM_INT, 11),
            new Database_StatementParameter(':spproductId', $supplierProduct->getProductID(), PDO::PARAM_INT, 11),
            new Database_StatementParameter(':spprice', $supplierProduct->getCostPerUnit(), PDO::PARAM_STR, 20),
            new Database_StatementParameter(':spUnitOfMeasurement', $supplierProduct->getUnit(), PDO::PARAM_STR, 30)
        );
        
        return $this->execute('CALL sp_saveSupplier(:spsupplierId, :spproductId, :spprice, :spUnitOfMeasurement)', $params);
    }
   
    /**
     * Delete a supplier product
     * @param int $supplierId
     * @param int $productId
     * @return int
     */
    public function delete($supplierId, $productId) {
       $params = array (
            new Database_StatementParameter(':spsupplierId', $supplierId, PDO::PARAM_INT, 11),
            new Database_StatementParameter(':spproductId', $productId, PDO::PARAM_INT, 11)
        );

        return $this->execute('CALL sp_deleteSupplierProduct(:spsupplierId, :spproductId)', $params);
    }
    
    /**
     * Constructs a supplier product from an anonymous object.
     * @param object $obj
     * @return \Model_SupplierProduct
     */
    protected function construct($obj) {
        return new Model_SupplierProduct($obj->id_product, $obj->pname, 
                                         $obj->id_supplier, $obj->sname, 
                                         $obj->unitOfMeasurement, $obj->price, 0);
    }
}

?>