-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2023 at 12:13 AM
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_deleteCustomer` (`cuID` BIGINT)   BEGIN 
	DELETE FROM customer
    
    WHERE
    cust_id = cuID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_deleteProduct` (`proID` BIGINT)   BEGIN
	DELETE FROM products
    WHERE pro_id = proID;
        

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_deleteProductPrice` (`ppID` BIGINT)   BEGIN
	delete from productprice
           
    WHERE
    pp_id = ppID;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_deletePurchaseInvoice` (`pid` BIGINT)   BEGIN
	DELETE FROM purchaseinvoice 
    WHERE pur_id = pid;
        

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_deletePurchaseInvoiceDetails` (`pidID` INT)   BEGIN
	DELETE FROM purchaseinvoicedetails
    WHERE
    pid_id = pidID;
        

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_deleteRoles` (`id` INT)   BEGIN
	DELETE FROM roles
    WHERE roles.r_id = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_deleteSizes` (`id` INT)   BEGIN
	DELETE FROM sizes
	WHERE sizes.si_id = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_deleteStock` (`stoID` BIGINT)   BEGIN
	DELETE from stock
    
    WHERE
    sto_id = stoID;
    

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_deleteSuppliers` (`id` INT)   BEGIN
	DELETE FROM suppliers
    WHERE suppliers.supp_id = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_deleteUser` (`id` INT)   BEGIN
	DELETE FROM users 
    WHERE users.u_id = id;


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_getAllSizes` ()   BEGIN
	SELECT
    s.si_id as 'siID',
    s.si_name as 'Size',
    c.cat_id as 'catID',
    c.cat_name as 'Category'
    
    FROM sizes s
    INNER JOIN categories c
    on c.cat_id = s.si_catID;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_getCategories` ()   BEGIN
	SELECT categories.cat_id AS "ID", categories.cat_name AS "Category"
    FROM categories ORDER BY categories.cat_name ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_getColors` ()   BEGIN
	SELECT colors.col_id AS "ID", colors.col_name AS "Color"
    FROM colors ORDER BY colors.col_name ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_getCustomers` ()   BEGIN 
	SELECT 
    c.cust_id AS 'ID',
    c.cust_name AS 'Name',
    c.cust_cnic AS 'Cnic',
    c.cust_phone AS 'Phone',
    c.cust_address AS 'Address',
    lc.lc_balance AS 'Balance'
    FROM customer c 
    INNER JOIN ledgercustomer lc 
    on c.cust_id = lc.lc_cuid
    WHERE lc.lc_desc = "Opening Balance"   
    
    ORDER BY c.cust_name asc;
    
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_getLastCustomerID` ()   BEGIN
	SELECT c.cust_id AS 'ID' FROM customer c ORDER BY c.cust_id DESC LIMIT 1;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_getLastPurchaseID` ()   BEGIN
	SELECT pi.pur_id AS 'ID' FROM purchaseinvoice pi ORDER BY pi.pur_id DESC LIMIT 1;
      
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_getLastSupplierID` ()   BEGIN
	SELECT s.supp_id as 'ID' FROM suppliers s ORDER BY s.supp_id DESC LIMIT 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_getLoginDetails` (IN `username` VARCHAR(30), IN `pass` VARCHAR(30))   BEGIN
	SELECT 
    r.r_id as "RoleID", 
    r.r_name as "Role", 
    u.u_name AS "Name",
    u.u_id AS "userID"
    FROM users u 
    INNER JOIN roles r 
    on r.r_id = u.u_roleID
    WHERE u.u_username = username AND u.u_pass = pass;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_getProductPrice` ()   BEGIN
	SELECT * FROM products p 
    INNER JOIN productprice pp
    on p.pro_id = pp.pp_proID;
    

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_getProducts` ()   BEGIN
	SELECT p.pro_id as 'PROID', 
   		   p.pro_name as 'Product', 
   		   p.pro_cat as 'CatID', 
   		   p.pro_size as 'SizeID',  
           p.pro_col as 'ColID',
           c.cat_name as 'Category',
           s.si_name as 'Size',
           co.col_name as 'Color'
           
    from products p 
    INNER JOIN categories c
    on p.pro_cat = c.cat_id
    
    INNER JOIN sizes s
    on s.si_id = p.pro_size
    
    inner JOIN colors co 
    on co.col_id = p.pro_col;
    
        

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_getPurchaseInvoiceDetails` ()   BEGIN
	SELECT *  FROM purchaseinvoicedetails pid   
    
    INNER JOIN purchaseinvoice pur 
    on pur.pur_id = pid.pid_purID
    
    INNER JOIN products p 
    on p.pro_id = pid.pid_proID;
                   

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_getRoles` ()   BEGIN
	SELECT roles.r_id, roles.r_name FROM roles ORDER BY roles.r_name ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_getSizes` (`catID` INT)   BEGIN
	SELECT sizes.si_id AS "ID", sizes.si_name AS "Size" FROM sizes 
    INNER JOIN categories
    ON categories.cat_id = sizes.si_catID
    WHERE categories.cat_id = catID
    ORDER BY sizes.si_name ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_getStock` ()   BEGIN
	SELECT * from stock st
    INNER JOIN products p 
    on p.pro_id = st.sto_proID
    
    INNER JOIN purchaseinvoice pur
    on pur.pur_id = st.sto_purID;
    

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_getSuppliers` ()   BEGIN
	SELECT 
        suppliers.supp_id AS "ID", 
        suppliers.supp_name AS "Supplier", 
        suppliers.supp_phone AS "Phone", 
        suppliers.supp_address AS "address",
        ledgersupplier.ls_balance AS "Balance"
    FROM suppliers
    INNER JOIN ledgersupplier
    on suppliers.supp_id = ledgersupplier.ls_sid
    WHERE ledgersupplier.ls_desc = "Opening Balance"
    ORDER BY suppliers.supp_name ASC;
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_insertCustomer` (`name` VARCHAR(30), `cnic` VARCHAR(20), `phone` VARCHAR(15), `addr` VARCHAR(100))   BEGIN 
	INSERT into customer (cust_name, cust_cnic, cust_phone, cust_address)
    VALUES (name, cnic, phone, addr);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_insertCustomerLedger` (IN `dt` DATE, IN `cuid` INT, IN `descr` VARCHAR(100), IN `debit` FLOAT, IN `credit` FLOAT, IN `balance` FLOAT)   BEGIN 
	INSERT into ledgercustomer (lc_date, lc_cuid, lc_desc, lc_debit, lc_credit, lc_balance)
    VALUES (dt, cuid, descr, debit, credit, balance);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_insertProduct` (`proName` VARCHAR(50), `catID` INT, `sizeID` TINYINT, `colID` INT)   BEGIN
	INSERT INTO products (pro_name, pro_cat, pro_size, pro_col) VALUES (proName, catID, sizeID, colID);
        

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_insertProductPrice` (`proID` BIGINT, `price` FLOAT)   BEGIN
	INSERT into productprice (pp_proID, pp_price) VALUES (proID, price);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_insertPurchaseInvoice` (IN `dt` DATE, IN `sid` INT)   BEGIN
	INSERT INTO purchaseinvoice (pur_date, pur_supplierID) VALUES (dt, sid);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_insertPurchaseInvoiceDetails` (`purID` BIGINT, `proID` BIGINT, `ppp` FLOAT, `quan` INT)   BEGIN
	INSERT INTO purchaseinvoicedetails (pid_purID, pid_proID, pid_perPiecePrice, pid_quantity) 
    VALUES (purID, proID, ppp, quan);
    
        

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_insertRoles` (IN `name` VARCHAR(40))   BEGIN
	INSERT into roles (r_name) VALUES (name);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_insertSizes` (IN `name` VARCHAR(20), IN `catID` INT)   BEGIN
	INSERT INTO sizes (sizes.si_name, sizes.si_catID) VALUES (name, catID);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_insertStock` (`proID` BIGINT, `quan` INT, `purID` BIGINT)   BEGIN
	INSERT into stock (sto_proID, sto_quan, sto_purID) VALUES (proID, quan, purID);
    

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_insertSupplier` (`name` VARCHAR(50), `phone` VARCHAR(15), `address` VARCHAR(100))   BEGIN
	INSERT INTO suppliers  (suppliers.supp_name, suppliers.supp_phone, suppliers.supp_address) VALUES (name, phone, address);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_insertSupplierLedger` (IN `dt` DATE, IN `sid` INT, IN `descr` VARCHAR(100), IN `debit` FLOAT, IN `credit` FLOAT, IN `balance` FLOAT)   BEGIN 
	INSERT into ledgersupplier (ls_date, ls_sid, ls_desc, ls_debit, ls_credit, ls_balance)
    VALUES (dt, sid, descr, debit, credit, balance);
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_updateCustomer` (`name` VARCHAR(30), `cnic` VARCHAR(20), `phone` VARCHAR(15), `addr` VARCHAR(100), `cuID` BIGINT)   BEGIN 
	UPDATE customer
    SET
    cust_name = name,
    cust_cnic = cnic, 
    cust_phone = phone,
    cust_address = addr
    
    WHERE
    cust_id = cuID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_updateProduct` (`proName` VARCHAR(50), `catID` INT, `sizeID` TINYINT, `colID` INT, `proID` BIGINT)   BEGIN
	UPDATE products
    set pro_name = proName,
    	pro_cat = catID,
        pro_size = sizeID,
        pro_col = colID
        
    WHERE pro_id = proID;
        

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_updateProductPrice` (`proID` BIGINT, `price` FLOAT, `ppID` BIGINT)   BEGIN
	update productprice
    set pp_proID = proID,
    	pp_price = price
        
    WHERE
    pp_id = ppID;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_updatePurchaseInvoice` (`dt` DATE, `sid` INT, `pid` BIGINT)   BEGIN
	UPDATE purchaseinvoice pur
    SET pur.pur_date = dt,
    	pur.pur_supplierID = sid
    WHERE pur.pur_id = pid;
        

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_updatePurchaseInvoiceDetails` (`purID` BIGINT, `proID` BIGINT, `ppp` FLOAT, `quan` INT, `pidID` INT)   BEGIN
	update purchaseinvoicedetails pid
    set 
    pid.pid_purID = purID,
    pid.pid_proID = proID,
    pid.pid_perPiecePrice = ppp,
    pid.pid_quantity = quan
    
    WHERE
    pid.pid_id = pidID;
        

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_updateRoles` (`id` INT, `name` VARCHAR(40))   BEGIN
	UPDATE roles
    set roles.r_name = name
    WHERE roles.r_id = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_updateSizes` (IN `name` VARCHAR(20), IN `id` TINYINT, IN `catID` INT)   BEGIN
	UPDATE sizes
	SET 
    	sizes.si_name = name,
    	sizes.si_catID = catID
    
    WHERE sizes.si_id= id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_updateStock` (`proID` BIGINT, `quan` INT, `purID` BIGINT, `stoID` BIGINT)   BEGIN
	UPDATE stock
    SET
    sto_proID = proID,
    sto_quan = quan, 
    sto_purID = purID
    
    WHERE
    sto_id = stoID;
    

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

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`) VALUES
(13, 'T-shirt');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `col_id` int(11) NOT NULL,
  `col_name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`col_id`, `col_name`) VALUES
(3, 'Blue'),
(4, 'Red');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cust_id` bigint(20) NOT NULL,
  `cust_name` varchar(30) NOT NULL,
  `cust_cnic` varchar(20) NOT NULL,
  `cust_phone` varchar(15) NOT NULL,
  `cust_address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cust_id`, `cust_name`, `cust_cnic`, `cust_phone`, `cust_address`) VALUES
(1, 'Ali', '111111111111', '1111111', 'district 29'),
(3, 'لطفى محمد', '23234234', '0101111111', 'district 29');

-- --------------------------------------------------------

--
-- Table structure for table `ledgercustomer`
--

CREATE TABLE `ledgercustomer` (
  `lc_id` bigint(20) NOT NULL,
  `lc_date` date NOT NULL,
  `lc_cuid` bigint(20) NOT NULL,
  `lc_desc` varchar(100) NOT NULL,
  `lc_debit` float NOT NULL DEFAULT 0,
  `lc_credit` float NOT NULL DEFAULT 0,
  `lc_balance` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ledgercustomer`
--

INSERT INTO `ledgercustomer` (`lc_id`, `lc_date`, `lc_cuid`, `lc_desc`, `lc_debit`, `lc_credit`, `lc_balance`) VALUES
(1, '2023-10-09', 1, 'Opening Balance', 0, 0, 0),
(3, '2023-10-09', 3, 'Opening Balance', 1000, 0, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `ledgersupplier`
--

CREATE TABLE `ledgersupplier` (
  `ls_id` bigint(20) NOT NULL,
  `ls_date` date NOT NULL,
  `ls_sid` int(11) NOT NULL,
  `ls_desc` varchar(100) NOT NULL,
  `ls_debit` float NOT NULL DEFAULT 0,
  `ls_credit` float NOT NULL DEFAULT 0,
  `ls_balance` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ledgersupplier`
--

INSERT INTO `ledgersupplier` (`ls_id`, `ls_date`, `ls_sid`, `ls_desc`, `ls_debit`, `ls_credit`, `ls_balance`) VALUES
(4, '2023-10-08', 14, 'Opening Balance', 1000, 0, 1000),
(5, '2023-10-08', 17, 'Opening Balance', 0, 5999, -5999);

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
  `pro_id` bigint(20) NOT NULL,
  `pro_name` varchar(50) NOT NULL
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
  `pid_quantity` int(11) NOT NULL,
  `pid_catID` int(11) NOT NULL,
  `pid_sizeID` tinyint(4) NOT NULL,
  `pid_colID` int(11) NOT NULL
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
(18, 'CEO'),
(1, 'Housewife'),
(21, 'Safety Manager'),
(23, 'The Help');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `si_id` tinyint(4) NOT NULL,
  `si_name` varchar(20) NOT NULL,
  `si_catID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`si_id`, `si_name`, `si_catID`) VALUES
(12, 'Large1', 13),
(13, 'smal', 13);

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

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`supp_id`, `supp_name`, `supp_phone`, `supp_address`) VALUES
(8, 'Shaker', '111', 'Badr1'),
(9, 'Hell', '222', 'Badr2'),
(14, 'lotfy', '0101111111', 'district 29'),
(17, 'MariamLove', '1234555555', 'district 29');

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
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cust_id`),
  ADD UNIQUE KEY `cust_cnic` (`cust_cnic`),
  ADD UNIQUE KEY `cust_phone` (`cust_phone`);

--
-- Indexes for table `ledgercustomer`
--
ALTER TABLE `ledgercustomer`
  ADD PRIMARY KEY (`lc_id`),
  ADD KEY `ld_cuid` (`lc_cuid`);

--
-- Indexes for table `ledgersupplier`
--
ALTER TABLE `ledgersupplier`
  ADD PRIMARY KEY (`ls_id`),
  ADD KEY `ld_sid` (`ls_sid`);

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
  ADD UNIQUE KEY `pro_name` (`pro_name`);

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
  ADD KEY `pid_proID` (`pid_proID`),
  ADD KEY `pid_catID` (`pid_catID`),
  ADD KEY `pid_colID` (`pid_colID`),
  ADD KEY `pid_sizeID` (`pid_sizeID`);

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
  ADD KEY `si_catID` (`si_catID`);

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
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `col_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cust_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ledgercustomer`
--
ALTER TABLE `ledgercustomer`
  MODIFY `lc_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ledgersupplier`
--
ALTER TABLE `ledgersupplier`
  MODIFY `ls_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `productprice`
--
ALTER TABLE `productprice`
  MODIFY `pp_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pro_id` bigint(20) NOT NULL AUTO_INCREMENT;

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
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `si_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `sto_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ledgercustomer`
--
ALTER TABLE `ledgercustomer`
  ADD CONSTRAINT `ledgercustomer_ibfk_1` FOREIGN KEY (`lc_cuid`) REFERENCES `customer` (`cust_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ledgersupplier`
--
ALTER TABLE `ledgersupplier`
  ADD CONSTRAINT `ledgersupplier_ibfk_1` FOREIGN KEY (`ls_sid`) REFERENCES `suppliers` (`supp_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `productprice`
--
ALTER TABLE `productprice`
  ADD CONSTRAINT `productprice_ibfk_1` FOREIGN KEY (`pp_proID`) REFERENCES `products` (`pro_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `purchaseinvoicedetails_ibfk_2` FOREIGN KEY (`pid_proID`) REFERENCES `products` (`pro_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `purchaseinvoicedetails_ibfk_3` FOREIGN KEY (`pid_catID`) REFERENCES `categories` (`cat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `purchaseinvoicedetails_ibfk_4` FOREIGN KEY (`pid_colID`) REFERENCES `colors` (`col_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `purchaseinvoicedetails_ibfk_5` FOREIGN KEY (`pid_sizeID`) REFERENCES `sizes` (`si_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sizes`
--
ALTER TABLE `sizes`
  ADD CONSTRAINT `sizes_ibfk_1` FOREIGN KEY (`si_catID`) REFERENCES `categories` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
