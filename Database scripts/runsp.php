<?php

mysql_connect('db498909085.db.1and1.com', 'dbo498909085', 'davidfortin8640');
mysql_select_db('db498909085');

$query= "
CREATE PROCEDURE sp_deleteSupplier(
	IN s_supplier_id INT(11)
)
BEGIN
	IF EXISTS (SELECT * FROM supplier WHERE id_supplier = s_supplier_id) THEN
		DELETE FROM supplier 
		WHERE id_supplier = s_supplier_id;
	ELSE
		CALL raise_error;
	END IF;
END
";

//echo $query;
$result=mysql_query($query);	
echo mysql_error();
?>