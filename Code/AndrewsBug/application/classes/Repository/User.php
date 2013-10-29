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
class Repository_User extends Repository_AbstractRepository {
   /**
    * Get all the users.
    * @return array of users
    */ 
    public function getAll() {
        return $this->fetchNConstruct('SELECT * FROM v_getusers', array()); 
    }
    
    /**
     * Get the user with the id pass in parameter.
     * @param int $id
     * @return a user
     */
    public function get($id) {
        $params = array (
            new Database_StatementParameter(':id_user', $id_user, PDO::PARAM_INT, 11)
        );
        
        return $this->fetchNConstruct('CALL sp_getuser(:id_user)', $params);
    }
    
    /**
     * Add a supplier
     * @param Model_User $user
     * @return int
     */
    public function add($user) {
        $params = array (
            new Database_StatementParameter(':uusername', $user->getUsername(), PDO::PARAM_STR),
            new Database_StatementParameter(':uname', $user->getUsername(), PDO::PARAM_STR, 75),
            new Database_StatementParameter(':uemail', $user->getEmail(), PDO::PARAM_STR, 50),
            new Database_StatementParameter(':upassword', $user->getPassword(), PDO::PARAM_CHAR, 128),
            new Database_StatementParameter(':usalt', $user->getSalt(),PDO::PARAM_CHAR, 128)
        );
        
        return $this->execute('CALL sp_saveUser(-1, :uusername, :uname, :uemail, :upassword, :usalt)', $params);
    }
    
    /**
     * Update a user
     * @param Model_User $user
     * @return int
     */
    public function update($user) {
        $params = array (
            new Database_StatementParameter(':uusername', $user->getUsername(), PDO::PARAM_STR),
            new Database_StatementParameter(':uname', $user->getUsername(), PDO::PARAM_STR, 75),
            new Database_StatementParameter(':uemail', $user->getEmail(), PDO::PARAM_STR, 50),
            new Database_StatementParameter(':upassword', $user->getPassword(), PDO::PARAM_CHAR, 128),
            new Database_StatementParameter(':usalt', $user->getSalt(),PDO::PARAM_CHAR, 128)
        );

        return $this->execute('CALL sp_saveUser(-1, :uusername, :uname, :uemail, :upassword, :usalt)', $params);
    }
    
    /**
     * Delete a user
     * @param Model_User $user
     * @return int
     */
    public function delete($id) {
       $params = array (
            new Database_StatementParameter(':id_user', $id, PDO::PARAM_INT, 11)
        );

        return $this->execute('CALL sp_deleteUser(:id_user)', $params);
    }
    
    /**
     * Constructs a supplier from an anonymous object.
     * @param object $obj
     * @return \Model_User
     */
    protected function construct($obj) {
        return new Model_User($obj->id_user, $obj->username, $obj->name, $obj->password, $obj->salt);
    }
}

?>