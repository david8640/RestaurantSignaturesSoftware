USE `restaurantManagementSoftware`;

DELIMITER GO


-- ---------------------------------------------------------------------------------------
-- Views
-- ---------------------------------------------------------------------------------------
-- -----------------------------------------------------
-- View `v_getSuppliers`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `v_getSuppliers`
GO
CREATE VIEW v_getSuppliers
AS
	SELECT id_supplier, name, contact_name, phone_number, fax_number
	FROM supplier;
GO

-- -----------------------------------------------------
-- View `v_getProductCategories`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `v_getProductCategories`
GO
CREATE VIEW v_getProductCategories
AS
	SELECT P.id_category, P.name, P.parent, PA.name AS parent_name, P.orderof
	FROM product_category P LEFT JOIN product_category PA
	ON P.parent = PA.id_category;
GO
-- ---------------------------------------------------------------------------------------
-- Stored Procedures
-- ---------------------------------------------------------------------------------------
-- -----------------------------------------------------
-- Stored Procedure `sp_getSupplier`
-- -----------------------------------------------------
DROP PROCEDURE IF EXISTS `sp_getSupplier`
GO
CREATE PROCEDURE sp_getSupplier(
    IN s_supplier_id INT
)
BEGIN
 	SELECT id_supplier, name, contact_name, phone_number, fax_number
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
	IF EXISTS (SELECT * FROM supplier WHERE id_supplier = s_supplier_id) THEN
		DELETE FROM supplier 
		WHERE id_supplier = s_supplier_id;
	ELSE
		CALL raise_error;
	END IF;
END
GO

-- -----------------------------------------------------
-- Stored Procedure `sp_saveSupplier`
-- -----------------------------------------------------
DROP PROCEDURE IF EXISTS `sp_saveSupplier`
GO
CREATE PROCEDURE sp_saveSupplier(
	IN s_id_supplier INT(11),
	IN s_name VARCHAR(100),
	IN s_contact_name VARCHAR(100),
	IN s_phone_number VARCHAR(14),
	IN s_fax_number VARCHAR(14)
)
BEGIN
	IF EXISTS (SELECT * FROM supplier WHERE id_supplier = s_id_supplier) THEN
		UPDATE supplier SET	
			name = s_name,
			contact_name = s_contact_name,
			phone_number = s_phone_number,
			fax_number = s_fax_number
		WHERE id_supplier = s_id_supplier;
	ELSE
		INSERT INTO `supplier` (`name`, `contact_name`, `phone_number`, `fax_number`) 
		VALUES (s_name, s_contact_name, s_phone_number, s_fax_number);
	END IF;
END
GO

-- -----------------------------------------------------
-- Stored Procedure `sp_getUser`
-- -----------------------------------------------------
DROP PROCEDURE IF EXISTS `sp_getUser`
GO
CREATE PROCEDURE sp_getUser(
    IN u_username VARCHAR(30)
)
BEGIN
 	SELECT DISTINCT *
 	FROM users
 	WHERE u_username = username;
END
GO

-- -----------------------------------------------------
-- Stored Procedure `sp_getSalt`
-- -----------------------------------------------------
DROP PROCEDURE IF EXISTS `sp_getSalt`
GO
CREATE PROCEDURE sp_getSalt(
    IN u_username VARCHAR(30)
)
BEGIN
 	SELECT salt
 	FROM users
 	WHERE username = u_username;
END
GO

-- -----------------------------------------------------
-- Stored Procedure `sp_getPassword`
-- -----------------------------------------------------
DROP PROCEDURE IF EXISTS `sp_getPassword`
GO
CREATE PROCEDURE sp_getPassword(
    IN u_username VARCHAR(30)
)
BEGIN
 	SELECT password
 	FROM users
 	WHERE username = u_username;
END
GO

-- -----------------------------------------------------
-- Stored Procedure `sp_deleteUser`
-- -----------------------------------------------------
DROP PROCEDURE IF EXISTS `sp_deleteUser`
GO
CREATE PROCEDURE sp_deleteUser(
	IN u_user_id INT
)
BEGIN
	DELETE FROM users 
	WHERE id_user = u_user_id;
	DELETE FROM login_attempts 
	WHERE id_user = u_user_id;
END
GO

-- -----------------------------------------------------
-- Stored Procedure `sp_saveUser`
-- -----------------------------------------------------
DROP PROCEDURE IF EXISTS `sp_saveUser`
GO
CREATE PROCEDURE sp_saveUser(
	IN u_id_user INT(11),
	IN u_username VARCHAR(30),
	IN u_name VARCHAR(75),
	IN u_email VARCHAR(50),
	IN u_password VARCHAR(128),
	IN u_salt VARCHAR(128)
)
BEGIN
	IF EXISTS (SELECT * FROM users WHERE id_user = u_id_user) THEN
		UPDATE users SET
			username = u_username,
			name = u_name,
			email = u_email,
			password = u_password,
			salt = u_salt
		WHERE id_user = u_id_user;
	ELSE
		INSERT INTO `users` (`username`, `name`, `email`, `password`, `salt`) 
		VALUES (u_username, u_name, u_email, u_password, u_salt);
	END IF;
END
GO

-- -----------------------------------------------------
-- Stored Procedure `sp_updateUserSession`
-- -----------------------------------------------------
DROP PROCEDURE IF EXISTS `sp_updateUserSession`
GO
CREATE PROCEDURE sp_updateUserSession(
	IN current_userid INT(11),
	IN new_sessionId char(128),
	IN new_sessionExpiryTime int(25)
)
BEGIN
	IF EXISTS (SELECT * FROM users WHERE id_user = current_userid) THEN
		UPDATE users SET
			session_id = new_sessionId,
			session_expiry_time = new_sessionExpiryTime
		WHERE id_user = current_userid;
	END IF;
END
GO


-- -----------------------------------------------------
-- Stored Procedure `sp_getUserBySessionID`
-- -----------------------------------------------------
DROP PROCEDURE IF EXISTS `sp_getUserBySessionID`
GO
CREATE PROCEDURE sp_getUserBySessionID(
	IN sessionId char(128)
)
BEGIN
	SELECT * 
	FROM users 
	WHERE session_id = sessionId;
END
GO

-- -----------------------------------------------------
-- Stored Procedure `sp_getProductCategory`
-- -----------------------------------------------------
DROP PROCEDURE IF EXISTS `sp_getProductCategory`
GO
CREATE PROCEDURE sp_getProductCategory(
    IN c_id_category INT
)
BEGIN
 	SELECT P.id_category, P.name, P.parent, PA.name AS parent_name, P.orderof
	FROM product_category P LEFT JOIN product_category PA
	ON P.parent = PA.id_category
 	WHERE P.id_category = c_id_category;
END
GO

-- -----------------------------------------------------
-- Stored Procedure `sp_getProductCategoryParents`
-- -----------------------------------------------------
DROP PROCEDURE IF EXISTS `sp_getProductCategoryParents`
GO
CREATE PROCEDURE sp_getProductCategoryParents(
    IN c_id_category INT
)
BEGIN
 	SELECT P.id_category, P.name, P.parent, PA.name AS parent_name, P.orderof
	FROM product_category P LEFT JOIN product_category PA
	ON P.parent = PA.id_category
 	WHERE P.id_category <> c_id_category;
END
GO

-- -----------------------------------------------------
-- Stored Procedure `sp_deleteProductCategory`
-- -----------------------------------------------------
DROP PROCEDURE IF EXISTS `sp_deleteProductCategory`
GO
CREATE PROCEDURE sp_deleteProductCategory(
	IN c_id_category INT(11)
)
BEGIN
	IF EXISTS (SELECT * FROM product_category WHERE id_category = c_id_category) THEN
		DELETE FROM product_category 
		WHERE id_category = c_id_category;
	ELSE
		CALL raise_error;
	END IF;
END
GO

-- -----------------------------------------------------
-- Stored Procedure `sp_saveProductCategory`
-- -----------------------------------------------------
DROP PROCEDURE IF EXISTS `sp_saveProductCategory`
GO
CREATE PROCEDURE sp_saveProductCategory(
	IN c_id_category INT(11),
	IN c_name VARCHAR(100),
	IN c_parent INT(22),
	IN c_orderof INT(11)
)
BEGIN
	IF EXISTS (SELECT * FROM product_category WHERE id_category = c_id_category) THEN
	BEGIN
		UPDATE product_category SET	
			name = c_name,
			parent = c_parent,
			orderof = c_orderof
		WHERE id_category = c_id_category;
	END;
	ELSE
	BEGIN
		DECLARE nextOrder INT;
		SET @nextOrder = 1;
		IF ((SELECT COUNT(*) FROM product_category) > 0) THEN		
			SELECT @nextOrder := MAX(`orderof`) + 1 FROM `product_category`;
		END IF;
		INSERT INTO `product_category` (`name`, `parent`, `orderof`) 
		VALUES (c_name, c_parent, @nextOrder);
	END;
	END IF;
END
GO

DELIMITER ;
