<?php

class DatabaseManager {
    private $host = 'db517666264.db.1and1.com';
    private $database = 'db517666264';
    private $username = 'dbo517666264';
    private $password = 'Restaurant1_';
    
    public function insertSupplier($suppliers) {
        $query = "INSERT INTO `supplier` (`id_supplier`, `name`) VALUES ";
        foreach ($suppliers as $s) {
            $query .= " (".$s->getId().", '".$s->getName()."'),";
        }
        $query = substr($query, 0, strlen($query) - 1).';';
        
        $this->execQuery($query);
    }
    
    public function insertCategories($categories) {
        $query = 'INSERT INTO `product_category` (`id_category`, `name`, `parent`, `orderof`) VALUES ';
        foreach ($categories as $c) {
            $query .= ' ('.$c->getId().', "'.$c->getName().'", '.(($c->getParent() == -1) ? 'NULL': $c->getParent()).', '.$c->getId().'),';
        }
        $query = substr($query, 0, strlen($query) - 1).';';
        
        $this->execQuery($query);
    }
    
    public function insertProducts($products) {
        $query = 'INSERT INTO `product` (`id_product`, `name`, `id_category`, `unitOfMeasurement`) VALUES ';
        foreach ($products as $p) {
            $query .= ' ('.$p->getId().', "'.$p->getName().'", '.$p->getCategoryId().', "'.$p->getUnitOfMeasurement().'"),';
        }
        $query = substr($query, 0, strlen($query) - 1).';';
        
        $this->execQuery($query);
    }
    
    public function insertSuppliersProducts($suppliersProducts) {
        $query = 'INSERT INTO `supplier_product` (`id_product`, `id_supplier`, `price`, `unitOfMeasurement`) VALUES ';
        foreach ($suppliersProducts as $ps) {
             $query .= ' ('.$ps->getProductID().', '.$ps->getSupplierID().', '.$ps->getCostPerUnit().', "'.$ps->getUnitOfMeasurement().'"),';
        }
        $query = substr($query, 0, strlen($query) - 1).';';
        
        $this->execQuery($query);
    }   
    
    function execQuery($query) {
        echo "Executing query : <br />".$query."<br /><br />";

        $link = mysql_connect($this->host, $this->username, $this->password);
        mysql_select_db($this->database);
        $result=mysql_query($query);
        $error = mysql_error();	
        mysql_close($link);

        if (strlen($error) > 0) {
            echo "ERROR : <br />".$error."<br /><br />";
        } else {
            echo "Executed query with success.<br /><br />";
        }
    }
}
