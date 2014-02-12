<?php

/* 
 *  <copyright file="Repository_Restaurant.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2014-01-09</date>
 *  <summary>
 *      Manage all the interaction between the database and the application
 *      for the restaurant.
 *  </summary>
 */
class Repository_Restaurant extends Repository_AbstractRepository {
   /**
    * Get all the restaurants.
    * @return array of restaurants
    */ 
    public function getAll() {
        return $this->fetchNConstruct('SELECT * FROM v_getRestaurants', array()); 
    }
    
    /**
     * Get the restaurant with the id pass in parameter.
     * @param int $id
     * @return a restaurant
     */
    public function get($id) {
        $params = array (
            new Database_StatementParameter(':rid', $id, PDO::PARAM_INT, 11)
        );
        
        $restaurant = $this->fetchNConstruct('CALL sp_getRestaurant(:rid)', $params);
        return (sizeof($restaurant) > 0) ? $restaurant[0] : null;
    }
    
     /**
     * Get the restaurants in which the user has access.
     * @param int $userId
     * @return a list of restaurants
     */
    public function getUserLocations($userId) {
        $params = array(
            new Database_StatementParameter(':id_user', $userId, PDO::PARAM_INT, 11)
        );

        return $this->fetchNConstruct('CALL sp_getUserLocations(:id_user)', $params);
    }
    
    /**
     * Add a restaurant
     * @param Model_Restaurant $restaurant
     * @return int
     */
    public function add($restaurant) {
        $params = array (
            new Database_StatementParameter(':rname', $restaurant->getName(), PDO::PARAM_STR, 100),
            new Database_StatementParameter(':raddress', $restaurant->getAddress(), PDO::PARAM_STR, 250)
        );
        
        return $this->execute('CALL sp_saveRestaurant(-1, :rname, :raddress)', $params);
    }
    
    /**
     * Update a restaurant
     * @param Model_Restaurant $restaurant
     * @return int
     */
    public function update($restaurant) {
        $params = array (
            new Database_StatementParameter(':rid', $restaurant->getId(), PDO::PARAM_INT, 11),
            new Database_StatementParameter(':rname', $restaurant->getName(), PDO::PARAM_STR, 100),
            new Database_StatementParameter(':raddress', $restaurant->getAddress(), PDO::PARAM_STR, 250)
        );
       
        return $this->execute('CALL sp_saveRestaurant(:rid, :rname, :raddress)', $params);
    }
    
    /**
     * Delete a restaurant
     * @param Model_Restaurant $restaurant
     * @return int
     */
    public function delete($id) {
       $params = array (
            new Database_StatementParameter(':rid', $id, PDO::PARAM_INT, 11)
        );

        return $this->execute('CALL sp_deleteRestaurant(:rid)', $params);
    }
    
    /**
     * Constructs a restaurant from an anonymous object.
     * @param object $obj
     * @return \Model_Restaurant
     */
    protected function construct($obj) {
        return new Model_Restaurant($obj->id_restaurant, $obj->name, 
                                    (isset($obj->address)) ? $obj->address : '');
                                    
    }
}

?>