USE `restaurantManagementSoftware`;

DELIMITER GO

-- -----------------------------------------------------
-- View `v_getSuppliers`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `v_getSuppliers`
GO
CREATE VIEW v_getSuppliers
AS
	SELECT id_supplier, contact_name, phone_number, fax_number
	FROM supplier;
GO

-- -----------------------------------------------------
-- Stored Procedure `sp_getSupplier`
-- -----------------------------------------------------
DROP PROCEDURE IF EXISTS `sp_getSupplier`
GO
CREATE PROCEDURE sp_getSupplier(
    IN s_supplier_id INT
)
BEGIN
 	SELECT id_supplier, contact_name, phone_number, fax_number
 	FROM supplier
 	WHERE id_supplier = s_supplier_id;
END
GO

-- -----------------------------------------------------
-- Stored Procedure `sp_deleteSupplier`
-- -----------------------------------------------------
DROP PROCEDURE IF EXISTS `sp_deleteSupplier`
GO
CREATE PROCEDURE sp_deleteSupplier(
	IN s_supplier_id INT(11)
)
BEGIN
	DELETE FROM supplier 
	WHERE id_supplier = s_supplier_id;
END
GO

-- -----------------------------------------------------
-- Stored Procedure `sp_saveSupplier`
-- -----------------------------------------------------
DROP PROCEDURE IF EXISTS `sp_saveSupplier`
GO
CREATE PROCEDURE sp_saveSupplier(
	IN s_id_supplier INT(11),
	IN s_contact_name VARCHAR(100),
	IN s_phone_number INT(11),
	IN s_fax_number INT(11)
)
BEGIN
	IF EXISTS (SELECT * FROM supplier WHERE id_supplier = s_id_supplier) THEN
		UPDATE supplier SET	
			contact_name = s_contact_name,
			phone_number = s_phone_number,
			fax_number = s_fax_number
		WHERE id_supplier = s_id_supplier;
	ELSE
		INSERT INTO `supplier` (`contact_name`, `phone_number`, `fax_number`) 
		VALUES (s_contact_name, s_phone_number, s_fax_number);
	END IF;
END
GO

DELIMITER ;