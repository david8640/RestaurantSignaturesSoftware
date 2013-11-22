<?php

mysql_connect('db498909085.db.1and1.com', 'dbo498909085', 'davidfortin8640');
mysql_select_db('db498909085');

$query= "
CALL sp_getUser('dfortin')
";

//echo $query;
$result=mysql_query($query);	
echo mysql_error();
?>