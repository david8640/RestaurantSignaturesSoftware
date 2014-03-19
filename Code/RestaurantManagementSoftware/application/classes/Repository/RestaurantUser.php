<?php

/* 
 *  <copyright file="Repository_RestaurantUser.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2014-01-09</date>
 *  <summary>
 *      Manage all the interaction between the database and the application
 *      for the restaurants users.
 *  </summary>
 */
class Repository_RestaurantUser extends Repository_AbstractRepository {
   /**
    * Get all the restaurants users.
    * @return array of restaurants users
    */ 
    public function getAll() {
        return $this->fetchNConstruct('SELECT * FROM v_getRestaurantsUsers', array()); 
    }
    
    /**
     * Get the restaurant with the id pass in parameter.
     * @param int $id
     * @return a list of users of the restaurant
     */
    public function getRestaurantUsers($id) {
        $params = array (
            new Database_StatementParameter(':ruid', $id, PDO::PARAM_INT, 11)
        );
        
        return $this->fetchNConstruct('CALL sp_getRestaurantUsers(:ruid)', $params);
    }
    
    /**
     * Subscribe or unsubscribe users to a restaurant for all restaurants
     * @param array of array of \Model_RestaurantUser $restaurantUsers
     * @return int
     */
    public function subscribeOrUnsubcribeUsersToRestaurants($restaurantsUsers) {
        foreach ($restaurantsUsers as $rus) {
            $users = $this->getRestaurantUsersFormatted($rus);
            $params = array (
                new Database_StatementParameter(':ruid', $rus[0]->getIdRestaurant(), PDO::PARAM_INT, 11),
                new Database_StatementParameter(':ruusers', $users, PDO::PARAM_STR, 1000)
            );
            $success = $this->execute('CALL sp_subscribOrUnSubscribUsersToRestaurant(:ruid, :ruusers)', $params);
            if (!$success) {
                return false;
            }
        }
        return true;
    }
    
   /**
     * Constructs a restaurant user from an anonymous object.
     * @param object $obj
     * @return \Model_RestaurantUser
     */
    protected function construct($obj) {
        return new Model_RestaurantUser((isset($obj->id_restaurant)) ? $obj->id_restaurant : -1, 
                                        (isset($obj->name_restaurant)) ? $obj->name_restaurant : '', 
                                        (isset($obj->id_user)) ? $obj->id_user : -1, 
                                        (isset($obj->name_user)) ? $obj->name_user : '', 
                                        (isset($obj->is_check)) ? $obj->is_check : -1);
    }
    
    /**
     * Returns a formatted string that will be manipulated by the database.(idUser, op)
     * @param Model_RestaurantUser $restaurantUsers
     * @return string
     */
    private function getRestaurantUsersFormatted($restaurantUsers) {
        $users = '';
        $isFirst = true;
        foreach ($restaurantUsers as $ru) {
            $users .= (($isFirst)?'':',').$ru->getIdUser().','.(($ru->getIsCheck()) ? '1' /*subscribe*/ : '0' /*unsubscribe*/);
            if($isFirst) { $isFirst = false; }
        }
        
        return $users;
    }
}

?>