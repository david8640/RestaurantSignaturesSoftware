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
-- View `v_getUsers`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `v_getUsers`
GO
CREATE VIEW v_getUsers
AS
	SELECT id_user, username, first_name, last_name, email, password, salt
	FROM users;
GO

-- -----------------------------------------------------
-- View `v_getLoginAttempts`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `v_getLoginAttempts`
GO
CREATE VIEW v_getLoginAttempts
AS
	SELECT id_user, timeOfAttempt, ip_address
	FROM login_attempts;
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


-- -----------------------------------------------------
-- Stored Procedure `sp_getUser`
-- -----------------------------------------------------
DROP PROCEDURE IF EXISTS `sp_getUser`
GO
CREATE PROCEDURE sp_getUser(
    IN s_user_id INT
)
BEGIN
 	SELECT id_user, username, first_name, last_name, email, password, salt
 	FROM users
 	WHERE id_user = s_user_id;
END
GO

-- -----------------------------------------------------
-- Stored Procedure `sp_delete_User`
-- -----------------------------------------------------
DROP PROCEDURE IF EXISTS `sp_delete_User`
GO
CREATE PROCEDURE sp_delete_User(
	IN s_user_id INT
)
BEGIN
	DELETE FROM users 
	WHERE id_user = s_user_id;
	DELETE FROM login_attempts 
	WHERE id_user = s_user_id;
END
GO

-- -----------------------------------------------------
-- Stored Procedure `sp_saveUser`
-- -----------------------------------------------------
DROP PROCEDURE IF EXISTS `sp_saveUser`
GO
CREATE PROCEDURE sp_saveUser(
	IN id_user INT(11),
	IN username VARCHAR(30),
	IN first_name VARCHAR(75),
	IN last_name VARCHAR(50),
	IN email VARCHAR(50),
	IN password VARCHAR(128),
	IN salt VARCHAR(128)
)
BEGIN
	IF EXISTS (SELECT * FROM users WHERE id_user = s_id_user) THEN
		UPDATE users SET
			username = s_username,
			first_name = s_first_name,
			last_name = s_last_name,
			email = s_email,
			password = s_password,
			salt = s_salt
		WHERE id_user = s_id_user;
	ELSE
		INSERT INTO `users` (`username`, `first_name`, `last_name`, `email`, `password`, `salt`) 
		VALUES (s_username, s_first_name, s_last_name, s_email, s_password, s_salt);
	END IF;
END
GO
