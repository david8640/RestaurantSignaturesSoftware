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
        $config = Lib_ConfigurationManager::loadConfigFile('./application/config/config.xml');
        return (object) array (
            'Host' => $config->db->Host,
            'User' => $config->db->User,
            'Password' => $config->db->Password,
            'Database' => $config->db->Database,
            'Port' => intval($config->db->Port)
        );
    }
    
    /**
     * Load all the configuration in an object and returns it.
     * @return xml configurations
     */
    private static function loadConfigFile($filename) {
        if (!file_exists($filename)) {
            throw new Exception("Configuration file do not exists.");
        } else {
            return $xmlConfig = simplexml_load_file($filename);
        }
    } 
}

?>
