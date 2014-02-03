<?php

/* 
 *  <copyright file="Product.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>Omar Hijazi</author>
 *  <date>2013-11-07</date>
 *  <summary>
 *      Manage all the interaction between the database and the application
 *      for the product.
 *  </summary>
 */
class Repository_Product extends Repository_AbstractRepository {
   /**
    * Get all the product.
    * @return array of product
    */ 
    public function getAll() {
        return $this->fetchNConstruct('SELECT * FROM v_getProducts', array()); 
    }
    
    /**
     * Get the product with the id pass in parameter.
     * @param int $id
     * @return a product
     */
    public function get($id) {
        $params = array (
            new Database_StatementParameter(':pid', $id, PDO::PARAM_INT, 11)
        );
        
        $products = $this->fetchNConstruct('CALL sp_getProduct(:pid)', $params);
        return (sizeof($products) > 0) ? $products[0] : null;
    }
    
    /**
     * Add a Product
     * @param Model_Product $Product
     * @return int
     */
    public function add($product) {
        $params = array (
            new Database_StatementParameter(':pname', $product->getName(), PDO::PARAM_STR, 100),
        );
        
        return $this->execute('CALL sp_saveProduct(-1, :pname)', $params);
    }
    
    /**
     * Update a product
     * @param Model_Product $product
     * @return int
     */
    public function update($product) {
        $params = array (
            new Database_StatementParameter(':pid', $product->getId(), PDO::PARAM_INT, 11),
            new Database_StatementParameter(':pname', $product->getName(), PDO::PARAM_STR, 100),
        );

        return $this->execute('CALL sp_saveProduct(:sid, :pname)', $params);
    }
    
    /**
     * Delete a Product
     * @param Model_Product $product
     * @return int
     */
    public function delete($id) {
       $params = array (
            new Database_StatementParameter(':pid', $id, PDO::PARAM_INT, 11)
        );

        return $this->execute('CALL sp_deleteProduct(:pid)', $params);
    }
    
    /**
     * Constructs a product from an anonymous object.
     * @param object $obj
     * @return \Model_Product
     */
    protected function construct($obj) {
        return new Model_Product($obj->id_product, $obj->p_name, 
                                $obj->id_category, $obj->pc_name, $obj->unitOfMeasurment);
    }
}

?>