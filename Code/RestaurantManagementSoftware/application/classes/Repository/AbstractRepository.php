<?php

/* 
 *  <copyright file="AbstractRepository.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2013-10-10</date>
 *  <summary>Manage all the interactions between the database and the application.</summary>
 */
abstract class  Repository_AbstractRepository {
    /**
     * Database configuration
     * @var Database_Configuration 
     */
    private $configuration;
    
    /**
     * Construction of an abstract repository.
     */
    public function __construct() {
        $this->configuration = new Database_Configuration();
    }
    
    /**
     *  Fetch the result of a query and construct all the object returned this way.
     *  (select, call view, call stored procedure that returns object(s))
     * @param string $query
     * @param array(StatementParameter) $params
     * @return array
     */
    protected function fetchNConstruct($query, $params) {
        $connection = null;
        try {
            $connection = $this->connect();
            $objects = $this->fetchAll($connection, $query, $params); 
            $this->close($connection);
            return $objects;
        } catch (Exception $e) {
            $this->close($connection);
            throw new Exception('Fetching the query result and constructing '
                                . 'object failed.', $e->getCode(), $e);
        } 
    }
    
    /**
     * Execute a query and return the result (insert, update, 
     * delete or stored procedure that do not return objects
     * (returns only message code)).
     * @param string $query
     * @param array(StatementParameter) $params
     * @return result
     */
    protected function execute($query, $params) {
        $connection = null;
        try {
            $connection = $this->connect();
            $result = $this->exec($connection, $query, $params);
            $this->close($connection);
            return $result;
        } catch (Exception $e) {
            $this->close($connection);
            throw new Exception('Executing query failed.\n'.$e->getMessage(), 
                                $e->getCode(), $e);
        }
    }
        
    /**
     * Connect to the database.
     * @return connection to database
     * @throws Exception
     */
    private function connect() {
        try {
            $connection = new PDO($this->configuration->getConnectionString(), 
                                $this->configuration->getUsername(), 
                                $this->configuration->getPassword());
            return $connection;
        } catch(PDOException $e) {
            throw new Exception('Connection to database failed.\n'.$e);
        }
    }
    
    /**
     * Close database connection.
     * @param connection $connection
     * @throws Exception
     */
    private function close($connection) {
        try {
            $connection = null;
        } catch (Exception $ex) {
            throw new Exception('Closing connection to database failed.\n'.$e);
        }
    }
    
    /**
     * Bind all the parameters with the statement.
     * @param statement $statement
     * @param array(StatementParameter) $params
     */
    private function bindParameters($statement, $params) {        
        foreach ($params as $param) {
            $value = $param->getValue();    // We have to do this because bindParam 
                                            // keep a reference to the object and
                                            // we cannot do it with the function call
                                            // getValue();
            $statement->bindParam($param->getColumnName(), $value, 
                                    $param->getType(), $param->getLength());
            unset($value);  // unset the variable to remove the reference to avoid
                            // problem in the next loop iteration
        }
    }
    
    /**
     * Execute the query and return the results.
     * @param connection $connection
     * @param string $query
     * @param array(StatementParameter) $params
     * @return result
     */
    private function exec($connection, $query, $params) {
        $statement = $connection->prepare($query);
        $this->bindParameters($statement, $params);
        $result = $statement->execute();
        
        return $result;
    }
    
    /**
     * Fetch all the results of the query, construct all objects in a subclass 
     * and return the results.
     * @param connection $connection
     * @param string $query
     * @param array(StatementParameter) $params
     * @return array of object of the construct by the subclass.
     */
    private function fetchAll($connection, $query, $params) {
        $objects = array();
        
        $statement = $connection->prepare($query);
        $this->bindParameters($statement, $params);
        $statement->execute();
        
        while($obj = $statement->fetch(PDO::FETCH_OBJ)){
            array_push($objects, $this->construct($obj));
        }
        
        return $objects;
    }
    
    /**
     * Construct an object of a concrete type.
     */
    abstract protected function construct($params);
}


/* Execute a query and return the sql error or single result.
protected function executeNGetSingleResult($query) {
    try {
        $response = $this->databaseAccess->executeStoredProcedure($query);
        $singleResult = $response->fetch_assoc();
        $this->databaseAccess->freeResults($response);
        return $singleResult;
    } catch (Exception $e) {
        return $e->getMessage();
        die('Error : ' . $e->getMessage());
    }
}

// Get the first element
protected function first($elements) {
    if (count($elements) == 1)
            return $elements[0];
    else
            return null;
}
    /**
     * Execute a stored procedure that do not return objects. The procedure
     * returns only a message code.
     * @param string $query
     * @return array
     */
/*   protected function executeStoredProcedure($query) {
       $connection = null;
       try {
           $connection = $this->connect();
           //$result = $this->fetch($connection, $query); 
           $this->close($connection);
           return $result;
       } catch (Exception $e) {
           $this->close($connection);
           throw new Exception('Fetching the query result failed.', $e->getCode(), $e);
       } 
   }



*/ 
/**
 * Fetch the result of the query and return it.
 * @param connection $connection
 * @param string $query
 * @return result
 */
/*private function fetch($connection, $query) {
    $statement = $connection->fetch($query);
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    return $result;
}*/

?>