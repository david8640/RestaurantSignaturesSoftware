<?php

/* 
 *  <copyright file="Supplier.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2013-10-10</date>
 *  <summary>
 *      Manage all the interaction between the database and the application
 *      for the supplier.
 *  </summary>
 */
class Repository_Supplier extends Repository_AbstractRepository {
   /**
    * Get all the suppliers.
    * @return array of suppliers
    */ 
    public function getAll() {
        return $this->fetchNConstruct('SELECT * FROM v_getSuppliers', array()); 
    }
    
    /**
     * Get the supplier with the id pass in parameter.
     * @param int $id
     * @return a supplier
     */
    public function get($id) {
        $params = array (
            new Database_StatementParameter(':sid', $id, PDO::PARAM_INT, 11)
        );
        
        return $this->fetchNConstruct('CALL sp_getSupplier(:sid)', $params);
    }
    
    /**
     * Add a supplier
     * @param Model_Supplier $supplier
     * @return int
     */
    public function add($supplier) {
        $params = array (
            new Database_StatementParameter(':sname', $supplier->getName(), PDO::PARAM_STR, 100),
            new Database_StatementParameter(':sphoneNumber', $supplier->getPhoneNumber(), PDO::PARAM_INT, 11),
            new Database_StatementParameter(':sfaxNumber', $supplier->getFaxNumber(), PDO::PARAM_INT, 11)
        );
        
        return $this->execute('CALL sp_saveSupplier(-1, :sname, :sphoneNumber, :sfaxNumber)', $params);
    }
    
    /**
     * Update a supplier
     * @param Model_Supplier $supplier
     * @return int
     */
    public function update($supplier) {
        $params = array (
            new Database_StatementParameter(':sid', $supplier->getId(), PDO::PARAM_INT, 11),
            new Database_StatementParameter(':sname', $supplier->getName(), PDO::PARAM_STR, 100),
            new Database_StatementParameter(':sphoneNumber', $supplier->getPhoneNumber(), PDO::PARAM_INT, 11),
            new Database_StatementParameter(':sfaxNumber', $supplier->getFaxNumber(), PDO::PARAM_INT, 11)
        );

        return $this->execute('CALL sp_saveSupplier(:sid, :sname, :sphoneNumber, :sfaxNumber)', $params);
    }
    
    /**
     * Delete a supplier
     * @param Model_Supplier $supplier
     * @return int
     */
    public function delete($id) {
       $params = array (
            new Database_StatementParameter(':sid', $id, PDO::PARAM_INT, 11)
        );

        return $this->execute('CALL sp_deleteSupplier(:sid)', $params);
    }
    
    /**
     * Constructs a supplier from an anonymous object.
     * @param object $obj
     * @return \Model_Supplier
     */
    protected function construct($obj) {
        return new Model_Supplier($obj->id_supplier, $obj->contact_name, $obj->phone_number, $obj->fax_number);
    }
}

?>