-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2023 at 10:42 PM
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `st_deleteRoles` (`id` INT)   BEGIN
	DELETE FROM roles
    WHERE roles.r_id = id;
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_insertRoles` (IN `name` VARCHAR(40))   BEGIN
	INSERT into roles (r_name) VALUES (name);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_insertUser` (IN `name` VARCHAR(40), IN `email` VARCHAR(50), IN `phone` VARCHAR(15), IN `roleID` INT, IN `pass` VARCHAR(30))   BEGIN
	INSERT into users (u_name, u_email, u_phone, u_roleID, u_pass) 
    VALUES (name, email, phone, roleID, pass);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `st_updateRoles` (`id` INT, `name` VARCHAR(40))   BEGIN
	UPDATE roles
    set roles.r_name = name
    WHERE roles.r_id = id;
END$$

DELIMITER ;

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
(18, 'CEO'),
(20, 'Office Boy'),
(16, 'Safety Manager'),
(19, 'The Help');

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
(3, 'lotfy', 'lotfymoh1235o@gmail.com', '01064624648', 16, '', '12345');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`r_id`),
  ADD UNIQUE KEY `r_name` (`r_name`);

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
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`u_roleID`) REFERENCES `roles` (`r_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
