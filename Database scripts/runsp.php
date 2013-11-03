<?php

mysql_connect('db498909085.db.1and1.com', 'dbo498909085', 'davidfortin8640');
mysql_select_db('db498909085');

$query= "
CREATE PROCEDURE sp_saveUser(
	IN id_user INT(11),
	IN username VARCHAR(30),
	IN name VARCHAR(75),
	IN email VARCHAR(50),
	IN password VARCHAR(128),
	IN salt VARCHAR(128)
)
BEGIN
	IF EXISTS (SELECT * FROM users WHERE id_user = u_id_user) THEN
		UPDATE users SET
			username = u_username,
			first_name = u_name,
			email = u_email,
			password = u_password,
			salt = u_salt
		WHERE id_user = u_id_user;
	ELSE
		INSERT INTO `users` (`username`, `name`, `email`, `password`, `salt`) 
		VALUES (u_username, u_name, u_email, u_password, u_salt);
	END IF;
END
";

//echo $query;
$result=mysql_query($query);	
echo mysql_error();
?>