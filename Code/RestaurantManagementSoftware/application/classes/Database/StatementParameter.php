<?php

/* 
 *  <copyright file="StatementParameter.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2013-10-10</date>
 *  <summary>This class is use to bind the parameter in a prepare statement.</summary>
 */
class Database_StatementParameter {
    private $columnName;
    private $value;
    private $type;
    private $length;
    
    /**
     * Construct a StatementParameter object.
     * @param string $columnName
     * @param any $value
     * @param PDO::PARAM_X $type
     * @param int $length
     */
    public function __construct($columnName, $value, $type, $length) {
        $this->columnName = $columnName;
        $this->value = $value;
        $this->type =  $type;
        $this->length = $length;
    }
    
    /**
     * Returns the column name.
     * @return string
     */
    public function getColumnName() {
        return $this->columnName;
    }
    
    /**
     * Returns the value
     * @return type
     */
    public function getValue() {
        return $this->value;
    }
    
    /**
     * Returns the type
     * @return PDO::PARAM_X
     */
    public function getType() {
        return $this->type;
    }
    
    /**
     * Returns the length
     * @return int
     */
    public function getLength() {
        return $this->length;
    }
}

?>