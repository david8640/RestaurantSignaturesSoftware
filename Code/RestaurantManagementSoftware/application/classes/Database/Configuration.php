<?php

/* 
 *  <copyright file="Configuration.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2013-10-08</date>
 *  <summary>
 *      This class manage all the configuration parameters to access 
 *      the database.
 *  </summary>
 */
class Database_Configuration {
    // private members
    private $hostname;
    private $username;
    private $password;
    private $databaseName;
    private $port;

    /**
     * Recuperate the configuration from the configuration manager and set the
     * values.
     */
    public function __construct() {
        // Get configuration from the configuration manager 
        $configuration = Lib_ConfigurationManager::getDatabaseConfigurations();
        // Set the configuration
        $this->hostname = $configuration->Host;
        $this->username = $configuration->User;
        $this->password = $configuration->Password;
        $this->databaseName = $configuration->Database;
        $this->port = $configuration->Port;
    }
    
    /**
     * Returns the connection string.
     * @return string connection string
     */
    public function getConnectionString() {
        return 'mysql:host='.$this->hostname.';dbname='.$this->databaseName;
    }
    
    /**
     * Returns the username;
     * @return string
     */
    public function getUsername() {
        return $this->username;
    }
    
    /**
     * Returns the password.
     * @return string
     */
    public function getPassword() {
        return $this->password;   
    }
}

?>