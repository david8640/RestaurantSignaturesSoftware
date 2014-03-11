<?php

/* 
 *  <copyright file="ConfigurationManager.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2013-10-08</date>
 *  <summary>This class manage all kind of configurations</summary>
 */
class Lib_ConfigurationManager {
    /**
     * Get the database configurations.
     * @return xml database configurations
     */
    public static function getDatabaseConfigurations() {
        $configs = Kohana::$config->load('config'); 
        
        return (object) array (
            'Host' => $configs->db['Host'],
            'User' => $configs->db['User'],
            'Password' => $configs->db['Password'],
            'Database' => $configs->db['Database'],
            'Port' => intval($configs->db['Port'])
        );
    }
    
    /**
     * Get the taxes configurations.
     * @return xml database configurations
     */
    public static function getTaxesConfigurations() {
        $configs = Kohana::$config->load('config'); 
        
        return floatval($configs->taxes['default'])/100;
    } 
}

?>
