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
            new Database_StatementParameter(':cid', $id, PDO::PARAM_INT, 11)
        );
        
        $restaurant = $this->fetchNConstruct('CALL sp_getRestaurant(:cid)', $params);
        return (sizeof($restaurant) > 0) ? $restaurant[0] : null;
    }
    
    /**
     * Add a restaurant
     * @param Model_Restaurant $restaurant
     * @return int
     */
    public function add($restaurant) {
        $params = array (
            new Database_StatementParameter(':cname', $restaurant->getName(), PDO::PARAM_STR, 100),
            new Database_StatementParameter(':caddress', $restaurant->getAddress(), PDO::PARAM_STR, 250)
        );
        
        return $this->execute('CALL sp_saveRestaurant(-1, :cname, :caddress)', $params);
    }
    
    /**
     * Update a restaurant
     * @param Model_Restaurant $restaurant
     * @return int
     */
    public function update($restaurant) {
        $params = array (
            new Database_StatementParameter(':cid', $restaurant->getId(), PDO::PARAM_INT, 11),
            new Database_StatementParameter(':cname', $restaurant->getName(), PDO::PARAM_STR, 100),
            new Database_StatementParameter(':caddress', $restaurant->getAddress(), PDO::PARAM_STR, 250)
        );
       
        return $this->execute('CALL sp_saveRestaurant(:cid, :cname, :caddress)', $params);
    }
    
    /**
     * Delete a restaurant
     * @param Model_Restaurant $restaurant
     * @return int
     */
    public function delete($id) {
       $params = array (
            new Database_StatementParameter(':cid', $id, PDO::PARAM_INT, 11)
        );

        return $this->execute('CALL sp_deleteRestaurant(:cid)', $params);
    }
    
    /**
     * Constructs a restaurant from an anonymous object.
     * @param object $obj
     * @return \Model_Restaurant
     */
    protected function construct($obj) {
        return new Model_Restaurant($obj->id_restaurant, $obj->name, $obj->address);
    }
}

?>