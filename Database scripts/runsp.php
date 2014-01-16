<?php

$bdAutoReset = new DatabaseAutoReset();
$bdAutoReset->main();

class DatabaseAutoReset {
    /*******************************************************************************/
    // Local Settings
    /*******************************************************************************/
    private $filePathTables = '/Applications/MAMP/htdocs/seg4910-project/Database scripts/1-restaurantManagementSoftware.sql';
    private $filePathProcedures = '/Applications/MAMP/htdocs/seg4910-project/Database scripts/2-restaurantManagementSoftware_sp.sql';
    private $filePathInit = '/Applications/MAMP/htdocs/seg4910-project/Database scripts/3-restaurantManagementSoftware_init.sql';
    private $host = 'localhost:8889';
    private $database = 'restaurantManagementSoftware';
    private $username = 'root';
    private $password = 'root';
    /*******************************************************************************/
    // Server Settings
    /*******************************************************************************/
    //private $filePathTables = 'Database scripts/1-restaurantManagementSoftware.sql';
    //private $filePathProcedures = 'Database scripts/2-restaurantManagementSoftware_sp.sql';
    //private $filePathInit = 'Database scripts/3-restaurantManagementSoftware_init.sql';
    //private $host = 'db498909085.db.1and1.com';
    //private $database = 'db498909085';
    //private $username = 'dbo498909085';
    //private $password = 'davidfortin8640';
    
    function main() {
        $valuesTbl = $this->runTableScript();
        echo '<div style="margin-bottom: 20px"><b>Tables</b><br/>';
        $this->displaySummary($valuesTbl[0]);
        echo '</div>';
        $this->displayErrors($valuesTbl[1]);
        if (count($valuesTbl[1]) > 0) {
            echo '<div style="margin-bottom: 20px"><b>Errors</b><br/>';
            $this->displayErrors($valuesTbl[1]);
            echo '</div>';
        }
        
        $valuesProc = $this->runViewStoredProcedureFunction();
        echo '<div style="margin-bottom: 20px"><b>Procedures</b><br/>';
        $this->displaySummary($valuesProc[0]);
        echo '</div>';
        if (count($valuesProc[1]) > 0) {
            echo '<div style="margin-bottom: 20px"><b>Errors</b><br/>';
            $this->displayErrors($valuesProc[1]);
            echo '</div>';
        }
        
        $this->runInits();
    }
    
    function runInits() {
        $inits = $this->getInits();
        $errors = '';
        foreach ($inits as $i) {
            $error = $this->execQuery($i);
            if ($error != '') {
                $errors .= $error.'<br/>';
            }
        }
        echo '<div style="margin-bottom: 20px"><b>Inits</b><br/>Done';
        if (strlen($errors) > 0) {
            echo '<div style="margin-bottom: 20px"><b>Errors</b><br/>'.$errors.'</div>';
        }
    }
    
    function runTableScript() {
        $tables = $this->getTables();
        
        $errorNumber = 1;
        $tbs = array();
        $errors = array();
        $lastName = '';
        foreach ($tables as $t) {
            if (strlen($t) > 0) {
                $pos = strpos($t, '`');
                $name = substr($t, $pos+1, strpos($t, '`', $pos+1) - $pos - 1);
                $isDrop = strpos($t, 'DROP') > 0;
                
                if ($name != '') {
                    if ($lastName != $name) {
                        $tb = new Item($name, -1, -1);
                        array_push($tbs, $tb);
                    }

                    $error = $this->execQuery($t);

                    if ($error != '') {
                        if ($isDrop) {
                            $tb->setDrop($errorNumber);
                        } else {
                            $tb->setCreate($errorNumber);
                        }
                        array_push($errors, '#'.$errorNumber.' - '.$error.'<br />');
                        $errorNumber += 1;
                    }
                    $lastName = $name;
                }
            }
        }
        return array($tbs, $errors);
    }
            
    function runViewStoredProcedureFunction() {
        $procedures = $this->getProcedures();

        $errors = array();
        $procs = array();
        //$proc = new Procedure('', -1, -1);
        $lastName = '';
        $errorNumber = 1;
        foreach ($procedures as $p) {
            $isDrop  = FALSE;
            if (strpos($p, 'DROP') !== FALSE) {
                $isDrop = TRUE;	
            }

            $name = '';
            $start = 0;
            $length = 0;

            // Stored procedure
            $pos_fct = strpos($p, 'fct_');
            if ($pos_fct !== FALSE) {
                $start = $pos_fct;
                if ($isDrop) {
                    $length = strpos($p, '`', $pos_fct) - $pos_fct;
                } else {
                    $length = strpos($p, '(', $pos_fct) - $pos_fct;
                }
            } 

            // Stored procedure
            $pos_sp = strpos($p, 'sp_');
            if ($pos_sp !== FALSE) {
                $start = $pos_sp;
                if ($isDrop) {
                    $length = strpos($p, '`', $pos_sp) - $pos_sp;
                } else {
                    $length = strpos($p, '(', $pos_sp) - $pos_sp;
                }
            }

            // View
            $pos_v = strpos($p, 'v_');
            if ($pos_v !== FALSE) {
                $start = $pos_v;
                if ($isDrop) {
                    $length = strpos($p, '`', $pos_v) - $pos_v;
                } else {
                    $length = strpos($p, 'SELECT') - $pos_v - 4;
                }
            } 

            $name = trim(substr($p, $start, $length));
            
            if ($name != '') {
                if ($lastName != $name) {
                    $proc = new Item($name, -1, -1);
                    array_push($procs, $proc);
                }
                
                $error = $this->execQuery($p);
                
                if ($error != '') {
                    if ($isDrop) {
                        $proc->setDrop($errorNumber);
                    } else {
                        $proc->setCreate($errorNumber);
                    }
                    array_push($errors, '#'.$errorNumber.' - '.$error.'<br />');
                    $errorNumber += 1;
                }
                $lastName = $name;
            }
        }
        return array($procs, $errors);
    }

    function displaySummary($items) {
        $output = '<table border="1px"><tr><th>Name</th><th>Drop</th><th>Create</th></tr>';
        foreach ($items as $i) {
            $output .= '<tr><td>'.$i->getName().'</td><td>'.
                    (($i->getDrop() == -1) ? 'OK' : $i->getDrop()).'</td><td>'.
                    (($i->getCreate() == -1) ? 'OK' : $i->getCreate()).'</td></tr>';
        }
        $output .= '</table>';
        echo $output;
    }
    
    function displayErrors($errors) {
        $errorNumber = 1;
        $output = '';
        foreach ($errors as $e) {
            $output .= $e;
        }
        echo $output;
    }

    // Get All the views, functions and procedures
    function getProcedures() {
        // Remove all comments and not useful stuff
        $fileContent = '';
        $fh = fopen($this->filePathProcedures, 'r');
        while ($line = fgets($fh)) {
            $begin = substr($line, 0 , 11);

            if (strpos($begin, '-- ') === FALSE && strpos($begin, 'USE') === FALSE &&
                strpos($begin, 'DELIMITER') === FALSE) { 
                $fileContent .= $line;
            }
        }
        fclose($fh);

        return explode('GO', $fileContent);
    }
    
    function getTables() {
        $fileContent = '';
        $fh = fopen($this->filePathTables, 'r');
        while ($line = fgets($fh)) {
            $begin = substr($line, 0 , 15);

            if (strpos($begin, 'SET @OLD') === FALSE && strpos($begin, 'SET SQL') === FALSE 
                && strpos($begin, 'SET TIME') === FALSE && strpos($begin, '-- ') === FALSE
                && strpos($begin, 'DROP DATABASE') === FALSE && strpos($begin, 'CREATE DATAB') === FALSE
                && strpos($begin, 'USE ') === FALSE 
                && strpos($begin, '/*!40101') === FALSE && strpos($begin, 'DELIMITER') === FALSE) { 
                $fileContent .= $line;
            }
        }
        fclose($fh);

        return explode('GO', $fileContent);
    }

    function getInits() {
        $fileContent = '';
        $fh = fopen($this->filePathInit, 'r');
        while ($line = fgets($fh)) {
            $begin = substr($line, 0 , 15);

            if (strpos($begin, '-- ') === FALSE && strpos($begin, 'USE ') === FALSE 
                    && strpos($begin, 'DELIMITER') === FALSE) { 
                $fileContent .= $line;
            }
        }
        fclose($fh);

        return explode('GO', $fileContent);
    }
    
    // Execute a query on the current database
    function execQuery($query) {
        $link = mysql_connect($this->host, $this->username, $this->password);
        mysql_select_db($this->database);
        $result=mysql_query($query);
        $error = mysql_error();	
        mysql_close($link);
        return $error;
    }
}

class Item {
    // Private members
    private $name;
    private $drop;
    private $create;
    
    // Ctr
    public function __construct($name, $drop, $create) {
        $this->setName($name);
        $this->setDrop($drop);
        $this->setCreate($create);
    }
   
    // Getters and setters
    public function getName() {
        return $this->name;
    }
    public function setName($name) {
        $this->name = $name;
    }
    
    public function getDrop() {
        return $this->drop;
    }
    public function setDrop($drop) {
        $this->drop = $drop;
    }
    
    public function getCreate() {
        return $this->create;
    }
    public function setCreate($create) {
        $this->create = $create;
    }
}
?>
