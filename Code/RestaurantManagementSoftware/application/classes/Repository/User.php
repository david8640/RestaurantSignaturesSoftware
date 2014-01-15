<?php

/*
 *  <copyright file="User.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2013-10-10</date>
 *  <summary>
 *      Manage all the interaction between the database and the application
 *      for the user.
 *  </summary>
 */

class Repository_User extends Repository_AbstractRepository {

    /**
     * Get all the users.
     * @return array of users
     */
    public function getAll() {
        return $this->fetchNConstruct('SELECT * FROM v_getusers', array());
        ;
    }

    /**
     * Get the user with the username in parameter.
     * @param string $username
     * @return a user
     */
    public function getViaUsername($username) {
        $params = array(
            new Database_StatementParameter(':username', $username, PDO::PARAM_STR, 30),
        );
        //$users = $this->fetchNConstruct('CALL sp_getUser(:username)', $params);
        //return $users;
        try {
        return $this->fetchNConstruct('CALL sp_getUser(:username)', $params);
        } catch (Exception $e) {
        	echo $e;
	         
	         exit();
        }
    }

    /**
     * Get the user's salt
     * @param int $username
     * @return a user
     */
    public function getSalt($username) {
        $params = array(
            new Database_StatementParameter(':username', $username, PDO::PARAM_STR, 30)
        );

        return $this->fetchNConstruct('CALL sp_getSalt(:username)', $params);
    }

    /**
     * Get the user's salted password
     * @param int $username
     * @return a user
     */
    public function getPassword($username) {
        $params = array(
            new Database_StatementParameter(':username', $username, PDO::PARAM_STR, 30)
        );

        return $this->fetchNConstruct('CALL sp_getPassword(:username)', $params);
    }
    
    /**
     * Set the session vars
     * @param Model_User $user
     * @return success
     */
    public function setSessionVars($user) {
        $params = array(
            new Database_StatementParameter(':id_user', $user->getId(), PDO::PARAM_INT, 11),
            new Database_StatementParameter(':session_id', $user->getSessionId(), PDO::PARAM_STR, 128),
            new Database_StatementParameter(':session_expiry_time', $user->getSessionExpiryTime(), PDO::PARAM_INT, 25)
        );

        return $this->execute('CALL sp_updateUserSession(:id_user, :session_id, :session_expiry_time)', $params);
    }
    
    /**
     * Get the session vars
     * @param int session_id
     * @return a user
     */
    public function getBySessionID($session_id) {
        $params = array(
            new Database_StatementParameter(':session_id', $session_id, PDO::PARAM_STR, 128)
        );

        return $this->fetchNConstruct('CALL sp_getUserBySessionID(:session_id)', $params);
    }

    /**
     * Select location
     * @param int userId
     * @param int locationId
     * @return int
     */
    public function selectLocation($userId, $locationId) {
        $params = array(
        new Database_StatementParameter(':uuserid', $userId, PDO::PARAM_INT, 11),
        new Database_StatementParameter(':ulocationid', $locationId, PDO::PARAM_INT, 11)
        );

        return $this->execute('CALL sp_selectLocation(:uuserid, :ulocationid)', $params);
    }
    
    /**
     * Add a user
     * @param Model_User $user
     * @return int
     */
    public function add($user) {
        $params = array(
        new Database_StatementParameter(':uusername', $user->getUsername(), PDO::PARAM_STR, 30),
        new Database_StatementParameter(':uname', $user->getName(), PDO::PARAM_STR, 75),
        new Database_StatementParameter(':uemail', $user->getEmail(), PDO::PARAM_STR, 50),
        new Database_StatementParameter(':upassword', $user->getPassword(), PDO::PARAM_STR, 128),
        new Database_StatementParameter(':usalt', $user->getSalt(), PDO::PARAM_STR, 128),
        );

        return $this->execute('CALL sp_saveUser(-1, :uusername, :uname, :uemail, :upassword, :usalt)', $params);
    }

    /**
     * Update a user
     * @param Model_User $user
     * @return int
     */
    public function update($user) {
        $params = array(
        new Database_StatementParameter(':username', $user->getUsername(), PDO::PARAM_STR, 30),
        new Database_StatementParameter(':name', $user->getUsername(), PDO::PARAM_STR, 75),
        new Database_StatementParameter(':email', $user->getEmail(), PDO::PARAM_STR, 50),
        new Database_StatementParameter(':password', $user->getPassword(), PDO::PARAM_CHAR, 128),
        new Database_StatementParameter(':salt', $user->getSalt(), PDO::PARAM_CHAR, 128),
        new Database_StatementParameter(':usessionId', $user->getSessionId(), PDO::PARAM_STR, 128),
        new Database_StatementParameter(':usessionExpire', $user->getSessionExpiryTime(), PDO::PARAM_INT, 25)
        );

        return $this->execute('CALL sp_saveUser(-1, :uusername, :uname, :uemail, :upassword, :usalt)', $params);
    }

    /**
     * Delete a user
     * @param Model_User $user
     * @return int
     */
    public function delete($id) {
        $params = array(
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
        return new Model_User($obj->id_user, $obj->username, $obj->name, 
                $obj->email, $obj->password, $obj->salt, $obj->session_id, 
                $obj->session_expiry_time, 
                (($obj->location_selected == NULL) ? -1 : $obj->location_selected));
    }

}

?>