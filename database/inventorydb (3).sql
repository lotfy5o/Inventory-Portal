-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2023 at 03:08 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventorydb`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `st_deleteCategories` (`id` INT)   BEGIN
	DELETE FROM categories
	WHERE categories.cat_id = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_deleteColors` (`id` INT)   BEGIN
	DELETE FROM colors
	WHERE colors.col_id = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_deleteRoles` (`id` INT)   BEGIN
	DELETE FROM roles
    WHERE roles.r_id = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_deleteSizes` (`id` INT)   BEGIN
	DELETE FROM sizes
	WHERE sizes.si_id = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_deleteSuppliers` (`id` INT)   BEGIN
	DELETE FROM suppliers
    WHERE suppliers.supp_id = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_deleteUser` (`id` INT)   BEGIN
	DELETE FROM users 
    WHERE users.u_id = id;


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_getCategories` ()   BEGIN
	SELECT categories.cat_id AS "ID", categories.cat_name AS "Category"
    FROM categories ORDER BY categories.cat_name ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_getColors` ()   BEGIN
	SELECT colors.col_id AS "ID", colors.col_name AS "Color"
    FROM colors ORDER BY colors.col_name ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_getLoginDetails` (`username` VARCHAR(30), `pass` VARCHAR(30))   BEGIN
	SELECT r.r_id as "RoleID", r.r_name as "Role"
    FROM users u 
    INNER JOIN roles r 
    on r.r_id = u.u_roleID
    WHERE u.u_username = username AND u.u_pass = pass;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_getRoles` ()   BEGIN
	SELECT roles.r_id, roles.r_name FROM roles ORDER BY roles.r_name ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_getSizes` ()   BEGIN
	SELECT sizes.si_id AS "ID", sizes.si_name AS "Color"
    FROM sizes ORDER BY sizes.si_name ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_getSuppliers` ()   BEGIN
	SELECT 
        suppliers.supp_id AS "ID", 
        suppliers.supp_name AS "Supplier", 
        suppliers.supp_phone AS "Phone", 
        suppliers.supp_address AS "address"
    FROM suppliers;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_getUsers` ()   BEGIN
SELECT
u.u_id as "UserID",
u.u_name as "Name",
u.u_email as "Email",
u.u_phone as "Phone",
u.u_username as "Username",
u.u_pass as "pass",
r.r_id as "RoleID",
r.r_name as "Role"


FROM users u INNER JOIN roles r 
on r.r_id = u.u_roleID;


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_insertCategories` (`name` VARCHAR(40))   BEGIN
	INSERT INTO categories (categories.cat_name) VALUES (name);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_insertColors` (`name` VARCHAR(40))   BEGIN
	INSERT INTO colors (colors.col_name) VALUES (name);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_insertRoles` (IN `name` VARCHAR(40))   BEGIN
	INSERT into roles (r_name) VALUES (name);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_insertSizes` (IN `name` VARCHAR(20))   BEGIN
	INSERT INTO sizes (sizes.si_name) VALUES (name);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_insertSupplier` (`name` VARCHAR(50), `phone` VARCHAR(15), `address` VARCHAR(100))   BEGIN
	INSERT INTO suppliers  (suppliers.supp_name, suppliers.supp_phone, suppliers.supp_address) VALUES (name, phone, address);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_insertUser` (IN `name` VARCHAR(40), IN `email` VARCHAR(50), IN `phone` VARCHAR(15), IN `roleID` INT, IN `pass` VARCHAR(30), IN `username` VARCHAR(30))   BEGIN
	INSERT into users (u_name, u_email, u_phone, u_roleID, u_pass, u_username) 
    VALUES (name, email, phone, roleID, pass, username);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_updateCategories` (`name` VARCHAR(40), `id` INT)   BEGIN
	UPDATE categories
	SET categories.cat_name = name
    WHERE categories.cat_id = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_updateColors` (`name` VARCHAR(40), `id` INT)   BEGIN
	UPDATE colors
	SET colors.col_name = name
    WHERE colors.col_id= id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_updateRoles` (`id` INT, `name` VARCHAR(40))   BEGIN
	UPDATE roles
    set roles.r_name = name
    WHERE roles.r_id = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_updateSizes` (`name` VARCHAR(20), `id` INT)   BEGIN
	UPDATE sizes
	SET sizes.si_name = name
    WHERE sizes.si_id= id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_updateSuppliers` (`name` VARCHAR(50), `phone` VARCHAR(15), `address` VARCHAR(100), `id` INT)   BEGIN
	UPDATE suppliers s
    SET s.supp_name = name,
    	s.supp_phone = phone, 
        s.supp_address = address
        
    WHERE s.supp_id = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_updateUsers` (`name` VARCHAR(40), `email` VARCHAR(40), `phone` VARCHAR(15), `roleID` INT, `username` VARCHAR(15), `pass` VARCHAR(15), `id` INT)   BEGIN
	UPDATE users u 
    set u.u_name = name,
    	u.u_email = email,
        u.u_phone = phone,
        u.u_roleID = roleID,
        u.u_username = username,
        u.u_pass = pass
        
    WHERE u.u_id = id;


END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `col_id` int(11) NOT NULL,
  `col_name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `productprice`
--

CREATE TABLE `productprice` (
  `pp_id` bigint(20) NOT NULL,
  `pp_proID` bigint(20) NOT NULL,
  `pp_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pro_id` bigint(11) NOT NULL,
  `pro_name` varchar(50) NOT NULL,
  `pro_cat` int(11) NOT NULL,
  `pro_size` tinyint(4) NOT NULL,
  `pro_col` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchaseinvoice`
--

CREATE TABLE `purchaseinvoice` (
  `pur_id` bigint(20) NOT NULL,
  `pur_date` date NOT NULL,
  `pur_supplierID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchaseinvoicedetails`
--

CREATE TABLE `purchaseinvoicedetails` (
  `pid_id` int(11) NOT NULL,
  `pid_purID` bigint(20) NOT NULL,
  `pid_proID` bigint(20) NOT NULL,
  `pid_perPiecePrice` float NOT NULL,
  `pid_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `r_id` int(11) NOT NULL,
  `r_name` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`r_id`, `r_name`) VALUES
(16, 'admin'),
(19, 'Brother'),
(1, 'Housewife'),
(18, 'Manager');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `si_id` tinyint(4) NOT NULL,
  `si_name` varchar(20) NOT NULL,
  `si_catID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `sto_id` bigint(20) NOT NULL,
  `sto_proID` bigint(20) NOT NULL,
  `sto_quan` int(11) NOT NULL,
  `sto_purID` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `supp_id` int(11) NOT NULL,
  `supp_name` varchar(50) NOT NULL,
  `supp_phone` varchar(15) NOT NULL,
  `supp_address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(11) NOT NULL,
  `u_name` varchar(40) NOT NULL,
  `u_email` varchar(50) NOT NULL,
  `u_phone` varchar(15) NOT NULL,
  `u_roleID` int(11) NOT NULL,
  `u_username` varchar(40) NOT NULL,
  `u_pass` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `u_name`, `u_email`, `u_phone`, `u_roleID`, `u_username`, `u_pass`) VALUES
(1, 'MariamWife', 'mariam2062000@gmail.com', '01021416832', 1, 'romi', '12345'),
(3, 'lotfy', 'lotfymoh1235o@gmail.com', '01064624648', 16, 'lotfy5o', '12345'),
(21, 'ahmed', 'ahmed.lotfy@gmail.com', '0101111111', 19, 'ahmed1', '12345'),
(23, 'menna', 'mennalotfy@gmail.com', '0102222222', 19, 'menna5o', '12345');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`),
  ADD UNIQUE KEY `cat_name` (`cat_name`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`col_id`),
  ADD UNIQUE KEY `col_name` (`col_name`);

--
-- Indexes for table `productprice`
--
ALTER TABLE `productprice`
  ADD PRIMARY KEY (`pp_id`),
  ADD KEY `pp_proID` (`pp_proID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pro_id`),
  ADD UNIQUE KEY `pro_name` (`pro_name`),
  ADD KEY `pro_cat` (`pro_cat`),
  ADD KEY `pro_size` (`pro_size`),
  ADD KEY `pro_col` (`pro_col`);

--
-- Indexes for table `purchaseinvoice`
--
ALTER TABLE `purchaseinvoice`
  ADD PRIMARY KEY (`pur_id`),
  ADD KEY `pur_supplierID` (`pur_supplierID`);

--
-- Indexes for table `purchaseinvoicedetails`
--
ALTER TABLE `purchaseinvoicedetails`
  ADD PRIMARY KEY (`pid_id`),
  ADD KEY `pid_purID` (`pid_purID`),
  ADD KEY `pid_proID` (`pid_proID`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`r_id`),
  ADD UNIQUE KEY `r_name` (`r_name`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`si_id`),
  ADD UNIQUE KEY `si_name` (`si_name`),
  ADD KEY `fk_sizes` (`si_catID`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`sto_id`),
  ADD KEY `sto_purID` (`sto_purID`),
  ADD KEY `sto_proID` (`sto_proID`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supp_id`),
  ADD UNIQUE KEY `supp_name` (`supp_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`),
  ADD UNIQUE KEY `u_email` (`u_email`),
  ADD KEY `u_roleID` (`u_roleID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `col_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `productprice`
--
ALTER TABLE `productprice`
  MODIFY `pp_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pro_id` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchaseinvoice`
--
ALTER TABLE `purchaseinvoice`
  MODIFY `pur_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchaseinvoicedetails`
--
ALTER TABLE `purchaseinvoicedetails`
  MODIFY `pid_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `si_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `sto_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `productprice`
--
ALTER TABLE `productprice`
  ADD CONSTRAINT `productprice_ibfk_1` FOREIGN KEY (`pp_proID`) REFERENCES `products` (`pro_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`pro_cat`) REFERENCES `categories` (`cat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`pro_size`) REFERENCES `sizes` (`si_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `products_ibfk_3` FOREIGN KEY (`pro_col`) REFERENCES `colors` (`col_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `purchaseinvoice`
--
ALTER TABLE `purchaseinvoice`
  ADD CONSTRAINT `purchaseinvoice_ibfk_1` FOREIGN KEY (`pur_supplierID`) REFERENCES `suppliers` (`supp_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `purchaseinvoicedetails`
--
ALTER TABLE `purchaseinvoicedetails`
  ADD CONSTRAINT `purchaseinvoicedetails_ibfk_1` FOREIGN KEY (`pid_purID`) REFERENCES `purchaseinvoice` (`pur_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `purchaseinvoicedetails_ibfk_2` FOREIGN KEY (`pid_proID`) REFERENCES `products` (`pro_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sizes`
--
ALTER TABLE `sizes`
  ADD CONSTRAINT `fk_sizes` FOREIGN KEY (`si_catID`) REFERENCES `categories` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`sto_purID`) REFERENCES `purchaseinvoice` (`pur_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_ibfk_2` FOREIGN KEY (`sto_proID`) REFERENCES `products` (`pro_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`u_roleID`) REFERENCES `roles` (`r_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
