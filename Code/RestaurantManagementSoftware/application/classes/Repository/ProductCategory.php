<?php

/* 
 *  <copyright file="ProductCategory.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2013-11-17</date>
 *  <summary>
 *      Manage all the interaction between the database and the application
 *      for the product category.
 *  </summary>
 */
class Repository_ProductCategory extends Repository_AbstractRepository {
   /**
    * Get all the product categories.
    * @return array of product categories
    */ 
    public function getAll() {
        return $this->fetchNConstruct('SELECT * FROM v_getProductCategories', array()); 
    }
    
   /**
    * Get all the possible parents of a product category.
    * @param int $id
    * @return array of product categories possible parents
    */ 
    public function getParents($id) {
        $params = array (
            new Database_StatementParameter(':cid', $id, PDO::PARAM_INT, 11)
        );
        
        return $this->fetchNConstruct('CALL sp_getProductCategoryParents(:cid)', $params); 
    }
    
    /**
     * Get the product category with the id pass in parameter.
     * @param int $id
     * @return a product category
     */
    public function get($id) {
        $params = array (
            new Database_StatementParameter(':cid', $id, PDO::PARAM_INT, 11)
        );
        
        $productCategory = $this->fetchNConstruct('CALL sp_getProductCategory(:cid)', $params);
        return (sizeof($productCategory) > 0) ? $productCategory[0] : null;
    }
    
    /**
     * Add a product category
     * @param Model_ProductCategory $productCategory
     * @return int
     */
    public function add($productCategory) {
        $params = array (
            new Database_StatementParameter(':cname', $productCategory->getName(), PDO::PARAM_STR, 100),
            new Database_StatementParameter(':cparent', 
                    (($productCategory->getParent() == -1) ? null : $productCategory->getParent()), 
                    (($productCategory->getParent() == -1) ? PDO::PARAM_NULL : PDO::PARAM_INT), 11),
            new Database_StatementParameter(':corder', $productCategory->getOrder(), PDO::PARAM_INT, 11)
        );
        
        return $this->execute('CALL sp_saveProductCategory(-1, :cname, :cparent, :corder)', $params);
    }
    
    /**
     * Update a category
     * @param Model_ProductCategory $productCategory
     * @return int
     */
    public function update($productCategory) {
        $params = array (
            new Database_StatementParameter(':cid', $productCategory->getId(), PDO::PARAM_INT, 11),
            new Database_StatementParameter(':cname', $productCategory->getName(), PDO::PARAM_STR, 100),
            new Database_StatementParameter(':cparent', 
                    (($productCategory->getParent() == -1) ? null : $productCategory->getParent()), 
                    (($productCategory->getParent() == -1) ? PDO::PARAM_NULL : PDO::PARAM_INT), 11),
            new Database_StatementParameter(':corder', $productCategory->getOrder(), PDO::PARAM_INT, 11)
        );
       
        return $this->execute('CALL sp_saveProductCategory(:cid, :cname, :cparent, :corder)', $params);
    }
    
    /**
     * Delete a category
     * @param Model_ProductCategory $productCategory
     * @return int
     */
    public function delete($id) {
       $params = array (
            new Database_StatementParameter(':cid', $id, PDO::PARAM_INT, 11)
        );

        return $this->execute('CALL sp_deleteProductCategory(:cid)', $params);
    }
    
    /**
     * Constructs a product category from an anonymous object.
     * @param object $obj
     * @return \Model_ProductCategory
     */
    protected function construct($obj) {
        return new Model_ProductCategory($obj->id_category, $obj->name, $obj->parent, $obj->parent_name, $obj->orderof);
    }
}

?>