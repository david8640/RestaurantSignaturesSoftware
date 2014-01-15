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

-- -----------------------------------------------------
-- View `v_getRestaurants`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `v_getRestaurants`
GO
CREATE VIEW v_getRestaurants
AS
	SELECT R.id_restaurant, R.name, R.address
	FROM restaurant R;
GO

-- -----------------------------------------------------
-- View `v_getRestaurantsUsers`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `v_getRestaurantsUsers`
GO
CREATE VIEW v_getRestaurantsUsers
AS
	SELECT R.id_restaurant, R.name AS name_restaurant, U.id_user, U.name AS name_user, NULL AS is_check
	FROM restaurant R 
		LEFT JOIN users_restaurants UR ON R.id_restaurant = UR.id_restaurant
		LEFT JOIN users U ON U.id_user = UR.id_user
	ORDER BY R.id_restaurant;
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
	BEGIN
		DECLARE orderOfItemToDelete INT;
		
		SELECT orderof INTO orderOfItemToDelete
		FROM product_category
		WHERE id_category = c_id_category;
	
		DELETE FROM product_category 
		WHERE id_category = c_id_category;
	
		UPDATE product_category SET orderof = orderof - 1 WHERE orderof > orderOfItemToDelete;
	END;
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
		IF (fct_isNotChildOf(c_id_category, c_parent)) THEN
		BEGIN
			UPDATE product_category SET	
				name = c_name,
				parent = c_parent,
				orderof = c_orderof
			WHERE id_category = c_id_category;
		END;
		ELSE
			CALL raise_error;
		END IF;
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

-- -----------------------------------------------------
-- Stored Procedure `sp_getRestaurant`
-- -----------------------------------------------------
DROP PROCEDURE IF EXISTS `sp_getRestaurant`
GO
CREATE PROCEDURE sp_getRestaurant(
    IN r_id_restaurant INT
)
BEGIN
 	SELECT id_restaurant, name, address
 	FROM restaurant
 	WHERE id_restaurant = r_id_restaurant;
END
GO

-- -----------------------------------------------------
-- Stored Procedure `sp_deleteRestaurant`
-- -----------------------------------------------------
DROP PROCEDURE IF EXISTS `sp_deleteRestaurant`
GO
CREATE PROCEDURE sp_deleteRestaurant(
	IN r_id_restaurant INT(11)
)
BEGIN
	IF EXISTS (SELECT * FROM restaurant WHERE id_restaurant = r_id_restaurant) THEN
		DELETE FROM restaurant 
		WHERE id_restaurant = r_id_restaurant;
	ELSE
		CALL raise_error;
	END IF;
END
GO

-- -----------------------------------------------------
-- Stored Procedure `sp_saveRestaurant`
-- -----------------------------------------------------
DROP PROCEDURE IF EXISTS `sp_saveRestaurant`
GO
CREATE PROCEDURE sp_saveRestaurant(
	IN r_id_restaurant INT(11),
	IN r_name VARCHAR(100),
	IN r_address VARCHAR(250)
)
BEGIN
	IF EXISTS (SELECT * FROM restaurant WHERE id_restaurant = r_id_restaurant) THEN
		UPDATE restaurant SET	
			name = r_name,
			address = r_address
		WHERE id_restaurant = r_id_restaurant;
	ELSE
		INSERT INTO `restaurant` (`name`, `address`) 
		VALUES (r_name, r_address);
	END IF;
END
GO

-- -----------------------------------------------------
-- Stored Procedure `sp_getRestaurantUsers`
-- -----------------------------------------------------
DROP PROCEDURE IF EXISTS `sp_getRestaurantUsers`
GO
CREATE PROCEDURE sp_getRestaurantUsers(
    IN ru_id_restaurant INT
)
BEGIN
 	SELECT U.id_user, U.name AS name_user, (IF (id_user_check = U.id_user, 1, 0)) AS is_check, NULL AS id_restaurant, NULL AS name_restaurant
	FROM users U LEFT JOIN (SELECT U1.id_user as id_user_check
 							FROM users U1 
 							WHERE EXISTS (SELECT UR.id_user
 					  						FROM users_restaurants UR
 					  						WHERE UR.id_user = U1.id_user AND UR.id_restaurant = ru_id_restaurant)) AS U
 	ON U.id_user = id_user_check;				 
END
GO

-- -----------------------------------------------------
-- Stored Procedure `sp_subscribOrUnSubscribUsersToRestaurant`
-- -----------------------------------------------------
DROP PROCEDURE IF EXISTS `sp_subscribOrUnSubscribUsersToRestaurant`
GO
CREATE PROCEDURE sp_subscribOrUnSubscribUsersToRestaurant(
	IN r_id_restaurant INT(11),
	IN r_users VARCHAR(1000)
)
BEGIN
	DECLARE pos INT DEFAULT 0;
	DECLARE cur_user VARCHAR(1000);
	DECLARE cur_op INT;

	-- LOOP
	manip_loop: LOOP
		-- Get the current user
		SET pos = pos + 1;
    	SET cur_user = split(r_users, ",", pos);
    	-- Get the operation related (1-add, 0-delete)
    	SET pos = pos + 1;
    	SET cur_op = split(r_users, ",", pos);
	
		-- Loop exit
		/****************************/
		IF cur_user = '' THEN
			LEAVE manip_loop;
		END IF;
		/****************************/
		
		-- Loop manipulation
		
		-- Check if subscribe or unsubscribe operation
		-- Subscribe
		IF (cur_op = 1) THEN
		BEGIN
			IF NOT EXISTS (SELECT * FROM users_restaurants WHERE id_restaurant = r_id_restaurant AND id_user = cur_user) THEN
			BEGIN
				INSERT INTO users_restaurants (`id_restaurant`, `id_user`)  
				VALUES (r_id_restaurant, cur_user);
			END;
			END IF;
		END;
		-- Unsubscribe
		ELSEIF (cur_op = 0) THEN
		BEGIN
			IF EXISTS (SELECT * FROM users_restaurants WHERE id_restaurant = r_id_restaurant AND id_user = cur_user) THEN
			BEGIN
				DELETE FROM users_restaurants 
				WHERE id_restaurant = r_id_restaurant AND id_user = cur_user;			
			END;
			END IF;
		END;
		-- Invalid operation
		ELSE
			CALL raise_error;
		END IF;
	END LOOP manip_loop;
END
GO

-- -----------------------------------------------------
-- Stored Procedure `sp_getUserLocations`
-- -----------------------------------------------------
DROP PROCEDURE IF EXISTS `sp_getUserLocations`
GO
CREATE PROCEDURE sp_getUserLocations(
    IN ur_id_user INT
)
BEGIN
	DECLARE selectedLocation INT;
	DECLARE defaultSelectedLocation INT;
	
	SET selectedLocation = -1;
	
	SELECT location_selected INTO selectedLocation
	FROM users
	WHERE id_user = ur_id_user;
	
	IF (selectedLocation IS NULL) THEN
	BEGIN
		SELECT R.id_restaurant INTO defaultSelectedLocation
 		FROM restaurant R, users_restaurants RU
 	 	WHERE R.id_restaurant = RU.id_restaurant AND RU.id_user = ur_id_user
 	 	LIMIT 0,1;
	
	 	UPDATE users SET location_selected = defaultSelectedLocation
	 	WHERE id_user = ur_id_user;
	END;
	END IF;
	
	SELECT R.id_restaurant, R.name, NULL AS address
 	FROM restaurant R, users_restaurants RU
 	WHERE R.id_restaurant = RU.id_restaurant AND RU.id_user = ur_id_user;
END
GO

-- -----------------------------------------------------
-- Stored Procedure `sp_selectLocation`
-- -----------------------------------------------------
DROP PROCEDURE IF EXISTS `sp_selectLocation`
GO
CREATE PROCEDURE sp_selectLocation(
	IN u_id_user INT,
    IN u_id_location INT
)
BEGIN
	UPDATE users SET	
		location_selected = u_id_location
	WHERE id_user = u_id_user;
END
GO

-- ---------------------------------------------------------------------------------------
-- Functions
-- ---------------------------------------------------------------------------------------
-- -----------------------------------------------------
-- Stored Procedure `fct_isNotChildOf`
-- Validate that there is no child->parent->child loop
-- for 1 or 2 or 3 level of indentations
-- *** This solution is temporary until we find a better solution ***
-- -----------------------------------------------------
DROP FUNCTION IF EXISTS `fct_isNotChildOf`;
GO
CREATE FUNCTION fct_isNotChildOf(
	c_id_category INT(11),
	c_parent INT(11)
)
RETURNS INT
BEGIN
	DECLARE cpt INT;
	SET cpt = 0;
	
	SELECT cpt + COUNT(P1.id_category) INTO cpt
	FROM product_category P1		
	WHERE P1.id_category = c_parent AND P1.parent = c_id_category;
	
	SELECT cpt + COUNT(P1.id_category) INTO cpt
	FROM product_category P1, 
		product_category P2
	WHERE P1.id_category = c_parent AND P1.parent = P2.id_category AND P2.parent = c_id_category;

	SELECT cpt + COUNT(P1.id_category) INTO cpt
	FROM product_category P1, 
		product_category P2,
		product_category P3
	WHERE P1.id_category = c_parent AND P1.parent = P2.id_category AND P2.parent = P3.id_category AND P3.parent = c_id_category;

	RETURN cpt = 0;
END
GO

-- -----------------------------------------------------
-- Stored Procedure `split`
-- source : http://stackoverflow.com/questions/11835155/mysql-split-comma-seperated-string-into-temp-table
-- -----------------------------------------------------
DROP FUNCTION IF EXISTS `split`;
GO
CREATE FUNCTION split(
  x VARCHAR(1000),
  delim VARCHAR(12),
  pos INT
)
RETURNS VARCHAR(25)
RETURN REPLACE(SUBSTRING(SUBSTRING_INDEX(x, delim, pos),
       LENGTH(SUBSTRING_INDEX(x, delim, pos -1)) + 1),
       delim, '');
GO

DELIMITER ;