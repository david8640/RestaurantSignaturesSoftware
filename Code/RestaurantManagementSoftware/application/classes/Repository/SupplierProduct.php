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
     * @return array of suppliers' products
     */
    public function getAll() {
        // TODO
        $p1 = new Model_SupplierProduct(1, 'product 1', 1, 'supplier 1', 'kg', 25, 0);
        $p2 = new Model_SupplierProduct(2, 'product 2', 3, 'supplier 3', 'L', 10, 0);
        $p3 = new Model_SupplierProduct(3, 'product 3', 2, 'supplier 2', 'g', 5.25, 0);
        
        return array($p1, $p2, $p3);
    }

    /**
     * Constructs an order from an anonymous object.
     * @param object $obj
     * @return \Model_SupplierProduct
     */
    protected function construct($obj) {
        // TODO
    }
}

?>