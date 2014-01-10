<?php

mysql_connect('db498909085.db.1and1.com', 'dbo498909085', 'davidfortin8640');
mysql_select_db('db498909085');

$query= "
CREATE PROCEDURE sp_deleteUser(
	IN u_user_id INT
)
BEGIN
	DELETE FROM users 
	WHERE id_user = u_user_id;
	DELETE FROM login_attempts 
	WHERE id_user = u_user_id;
END
";

//echo $query;
$result=mysql_query($query);	
echo mysql_error();
?>