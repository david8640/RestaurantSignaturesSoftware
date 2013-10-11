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
        return $this->fetchNConstruct('select * from supplier', array());
        //return $this->fetchNConstruct('CALL sp_getSuppliers()', array()); 
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
        
        return $this->fetchNConstruct('select * from supplier where id_supplier=:sid', $params);
        //return $this->fetchNConstruct('CALL sp_getSupplier(:sid)', $params);
    }
    
    /**
     * Add a supplier
     * @param Model_Supplier $supplier
     * @return int
     */
    public function add($supplier) {
        $params = array (
            new Database_StatementParameter(':sname', $supplier->getName(), PDO::PARAM_STR, 50),
            new Database_StatementParameter(':sphoneNumber', $supplier->getPhoneNumber(), PDO::PARAM_INT, 11)
        );
        
        return $this->execute('insert into supplier (name, phoneNumber) values(:sname, :sphoneNumber)', $params);
        //return $this->execute('CALL sp_addSupplier(:sname, :sphoneNumber)', $params);
    }
    
    /**
     * Constructs a supplier from an anonymous object.
     * @param object $obj
     * @return \Model_Supplier
     */
    protected function construct($obj) {
        return new Model_Supplier($obj->id_supplier, $obj->name, $obj->phoneNumber);
    }
}

?>