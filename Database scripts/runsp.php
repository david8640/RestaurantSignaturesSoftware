<?php
$filePath = 'Database scripts/2-restaurantManagementSoftware_sp.sql';
//$filePath = '/Applications/MAMP/htdocs/seg4910-project/Database scripts/2-restaurantManagementSoftware_sp.sql';

// Remove all comments and not useful stuff
$fileContent = '';
$fh = fopen($filePath, 'r');
while ($line = fgets($fh)) {
	$begin = substr($line, 0 , 11);
	
	if (strpos($begin, '-- ') === FALSE && strpos($begin, 'USE') === FALSE &&
		strpos($begin, 'DELIMITER') === FALSE) { 
		$fileContent .= $line;
	}
}
fclose($fh);

$parts = explode('GO', $fileContent);

$output = '<table border="1px"><tr><th>Name</th><th>Drop</th><th>Create</th></tr>';
$lastName = '';
$errorNumber = 1;
$errors = '';
foreach ($parts as $p) {
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
		if ($lastName == '' || $lastName != $name) {
			if ($lastName != '') {
				$output .= '</tr>';
			}
			$output .= '<tr><td>'.$name.'</td>';
		}
		$error = '';
		if (!$isDrop) {
			$error = execQuery($p);
		}
		$text = 'OK';
		if ($error != '') {
			$errors .= '#'.$errorNumber.' - '.$error.'<br />';
			$text = $errorNumber;
			$errorNumber += 1;
		}
		$output .= '<td>'.$text.'</td>';
		$lastName = $name;
	}
}
echo '<div style="margin-bottom: 20px"><b>Errors</b><br/>'.$errors.'</div>';
echo '<div style="margin-bottom: 20px"><b>Procedures</b><br/>'.$output.'</div>';

function execQuery($query) {
	/*try {
		/*$connection = new PDO('mysql:host=db498909085.db.1and1.com;port:3306;dbname=db498909085', 'dbo498909085', 'davidfortin8640', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		$statement = $connection->prepare($query);
    	$result = $statement->execute();
		$connection = null;
	 } catch (Exception $ex) {
            echo $ex;
    }*/
    $link = mysql_connect('db498909085.db.1and1.com', 'dbo498909085', 'davidfortin8640');
	mysql_select_db('db498909085');
	
	//$link = mysql_connect('localhost:8889', 'root', 'root');
	//mysql_select_db('restaurantManagementSoftware');
	$result=mysql_query($query);
	$error = mysql_error();	
	mysql_close($link);
	return $error;
}
?>
