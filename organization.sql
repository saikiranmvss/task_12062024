-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2024 at 06:15 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `organization`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `doj` date NOT NULL,
  `blood_group` varchar(5) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `designation`, `dob`, `doj`, `blood_group`, `mobile`, `email`, `address`) VALUES
(1, 'John Doe', 'Software Engineer', '1990-01-15', '2015-06-01', 'O+', '1234567890', 'john.doe@example.com', '1234 Elm Street, Springfield'),
(2, 'Jane Smith', 'Project Manager', '1985-03-22', '2010-04-15', 'A-', '2345678901', 'jane.smith@example.com', '5678 Oak Avenue, Springfield'),
(3, 'Mike Johnson', 'Data Scientist', '1988-07-30', '2017-08-21', 'B+', '3456789012', 'mike.johnson@example.com', '9101 Pine Road, Springfield'),
(4, 'Emily Davis', 'UI/UX Designer', '1992-11-05', '2018-10-11', 'AB-', '4567890123', 'emily.davis@example.com', '1112 Maple Lane, Springfield'),
(5, 'David Wilson', 'DevOps Engineer', '1984-02-14', '2011-12-09', 'O-', '5678901234', 'david.wilson@example.com', '1314 Birch Drive, Springfield'),
(6, 'Sophia Brown', 'Business Analyst', '1991-05-25', '2016-01-30', 'A+', '6789012345', 'sophia.brown@example.com', '1516 Cedar Court, Springfield'),
(7, 'Chris Miller', 'Frontend Developer', '1993-09-10', '2019-04-19', 'B-', '7890123456', 'chris.miller@example.com', '1718 Walnut Street, Springfield'),
(8, 'Olivia Jones', 'Backend Developer', '1989-12-28', '2013-07-23', 'AB+', '8901234567', 'olivia.jones@example.com', '1920 Chestnut Avenue, Springfield'),
(9, 'James Taylor', 'System Administrator', '1986-04-16', '2012-03-05', 'O+', '9012345678', 'james.taylor@example.com', '2122 Cypress Boulevard, Springfield'),
(10, 'Isabella Lee', 'Product Manager', '1994-06-21', '2020-02-14', 'A-', '0123456789', 'isabella.lee@example.com', '2324 Fir Street, Springfield'),
(11, 'John Doe', 'Software Engineer', '1990-01-15', '2015-06-01', 'O+', '1234567890', 'john.doe@example.com', '1234 Elm Street, Springfield'),
(12, 'Jane Smith', 'Project Manager', '1985-03-22', '2010-04-15', 'A-', '2345678901', 'jane.smith@example.com', '5678 Oak Avenue, Springfield'),
(13, 'Mike Johnson', 'Data Scientist', '1988-07-30', '2017-08-21', 'B+', '3456789012', 'mike.johnson@example.com', '9101 Pine Road, Springfield'),
(14, 'Emily Davis', 'UI/UX Designer', '1992-11-05', '2018-10-11', 'AB-', '4567890123', 'emily.davis@example.com', '1112 Maple Lane, Springfield'),
(15, 'David Wilson', 'DevOps Engineer', '1984-02-14', '2011-12-09', 'O-', '5678901234', 'david.wilson@example.com', '1314 Birch Drive, Springfield'),
(16, 'Sophia Brown', 'Business Analyst', '1991-05-25', '2016-01-30', 'A+', '6789012345', 'sophia.brown@example.com', '1516 Cedar Court, Springfield'),
(17, 'Chris Miller', 'Frontend Developer', '1993-09-10', '2019-04-19', 'B-', '7890123456', 'chris.miller@example.com', '1718 Walnut Street, Springfield'),
(18, 'Olivia Jones', 'Backend Developer', '1989-12-28', '2013-07-23', 'AB+', '8901234567', 'olivia.jones@example.com', '1920 Chestnut Avenue, Springfield'),
(19, 'James Taylor', 'System Administrator', '1986-04-16', '2012-03-05', 'O+', '9012345678', 'james.taylor@example.com', '2122 Cypress Boulevard, Springfield'),
(20, 'Isabella Lee', 'Product Manager', '1994-06-21', '2020-02-14', 'A-', '0123456789', 'isabella.lee@example.com', '2324 Fir Street, Springfield');

-- --------------------------------------------------------

--
-- Table structure for table `identity_files`
--

CREATE TABLE `identity_files` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `upload_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `identity_files`
--

INSERT INTO `identity_files` (`id`, `employee_id`, `file_name`, `file_path`, `upload_date`) VALUES
(1, 1, 'john_doe_aadhar.jpg', 'uploads/john_doe_aadhar.jpg', '2024-06-13 04:09:11'),
(2, 2, 'jane_smith_aadhar.jpg', 'uploads/jane_smith_aadhar.jpg', '2024-06-13 04:09:11'),
(3, 3, 'mike_johnson_aadhar.jpg', 'uploads/mike_johnson_aadhar.jpg', '2024-06-13 04:09:11'),
(4, 4, 'emily_davis_aadhar.jpg', 'uploads/emily_davis_aadhar.jpg', '2024-06-13 04:09:11'),
(5, 5, 'david_wilson_aadhar.jpg', 'uploads/david_wilson_aadhar.jpg', '2024-06-13 04:09:11'),
(6, 6, 'sophia_brown_aadhar.jpg', 'uploads/sophia_brown_aadhar.jpg', '2024-06-13 04:09:11'),
(7, 7, 'chris_miller_aadhar.jpg', 'uploads/chris_miller_aadhar.jpg', '2024-06-13 04:09:11'),
(8, 8, 'olivia_jones_aadhar.jpg', 'uploads/olivia_jones_aadhar.jpg', '2024-06-13 04:09:11'),
(9, 9, 'james_taylor_aadhar.jpg', 'uploads/james_taylor_aadhar.jpg', '2024-06-13 04:09:11'),
(10, 10, 'isabella_lee_aadhar.jpg', 'uploads/isabella_lee_aadhar.jpg', '2024-06-13 04:09:11'),
(11, 1, '1709272333_fbb3161beb7b7b6c72ab-min.png', 'uploads/1709272333_fbb3161beb7b7b6c72ab-min.png', '2024-06-13 04:14:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `identity_files`
--
ALTER TABLE `identity_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `identity_files`
--
ALTER TABLE `identity_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `identity_files`
--
ALTER TABLE `identity_files`
  ADD CONSTRAINT `identity_files_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
