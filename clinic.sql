-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 28, 2024 at 01:21 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE clinic;
USE clinic;
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clinic`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `dateofbirth` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `phone_number`, `address`, `dateofbirth`) VALUES
(4, 'Admin Name', 'admin1@example.com', '$2y$10$8iVGkjAc6qJM6.QOz6Y/ZOUho2thwXSozyXDKx8mWolYqhyUTVsqu', '1234567899', ' Addres', '1990-01-01');

--
-- Triggers `admin`
--
DELIMITER $$
CREATE TRIGGER `admin_phone_number_check` BEFORE INSERT ON `admin` FOR EACH ROW BEGIN
    IF CHAR_LENGTH(NEW.phone_number) != 10 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Phone number should be exactly 10 digits long';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(10) NOT NULL,
  `specialty_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `dateofbirth` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`id`, `name`, `email`, `password`, `phone_number`, `specialty_id`, `address`, `dateofbirth`) VALUES
(1, 'Dr. Khouane.S.M', 'khouane@example.com', '$2y$10$mkJPMcDvM6ERz97LQr3/f.jDGDXF2.9yZ..1O3vp8JVJPw6x0u.rG', '1234567890', 1, 'mascara', '1984-02-23');

-- --------------------------------------------------------

--
-- Table structure for table `nurse`
--

CREATE TABLE `nurse` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `dateofbirth` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nurse`
--

INSERT INTO `nurse` (`id`, `name`, `email`, `password`, `phone_number`, `address`, `dateofbirth`) VALUES
(4, 'Nurse Name', 'nurse@example.com', '$2y$10$sGoYtjguL0B2SVI/SHl4zOefCWLY/Vvb1EW2hAcyDOKZ906Rb//wW', '1234567890', 'Nurse Addres', '1990-01-01');

--
-- Triggers `nurse`
--
DELIMITER $$
CREATE TRIGGER `nurse_phone_number_check` BEFORE INSERT ON `nurse` FOR EACH ROW BEGIN
    IF CHAR_LENGTH(NEW.phone_number) != 10 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Phone number should be exactly 10 digits long';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `dateofbirth` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `name`, `email`, `password`, `phone_number`, `address`, `dateofbirth`) VALUES
(30, 'yacine', 'y@gmail.com', '$2y$10$gJatFWEJ.cT7SUVPCjwtVeKPYrSkEnXJrjGGtt9SDjBEA12YQBzvC', '0796441833', 'mascara', '2004-03-23');

--
-- Triggers `patients`
--
DELIMITER $$
CREATE TRIGGER `patients_phone_number_check` BEFORE INSERT ON `patients` FOR EACH ROW BEGIN
    IF CHAR_LENGTH(NEW.phone_number) != 10 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Phone number should be exactly 10 digits long';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `reception`
--

CREATE TABLE `reception` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `dateofbirth` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reception`
--

INSERT INTO `reception` (`id`, `name`, `email`, `password`, `phone_number`, `address`, `dateofbirth`) VALUES
(4, 'yacine', 'reception@example.com', '$2y$10$zduIGXE/eybtSqj1pswe2.QwslgFHD613YlSejffp37zgz0Hdck1C', '0796441833', 'mascaraa', '2024-04-04');

--
-- Triggers `reception`
--
DELIMITER $$
CREATE TRIGGER `reception_phone_number_check` BEFORE INSERT ON `reception` FOR EACH ROW BEGIN
    IF CHAR_LENGTH(NEW.phone_number) != 10 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Phone number should be exactly 10 digits long';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone_number` varchar(10) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `status` bit(1) DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `firstname`, `lastname`, `address`, `phone_number`, `doctor_id`, `patient_id`, `status`) VALUES
(7, 'aaa', 'yoyo', 'mascara', '0796441833', 1, 30, b'0'),
(17, 'aaa', 'yoyo', 'mascara', '0796441831', 1, 30, b'0');

-- --------------------------------------------------------

--
-- Table structure for table `specialty`
--

CREATE TABLE `specialty` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `specialty`
--

INSERT INTO `specialty` (`id`, `name`) VALUES
(1, 'Optometry'),
(2, 'Medecine and surgery of the nose throat and ear'),
(3, 'Request anesthesia and resuscitation');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `unique_email` (`email`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `unique_email` (`email`),
  ADD KEY `doctor_ibfk_1` (`specialty_id`);

--
-- Indexes for table `nurse`
--
ALTER TABLE `nurse`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `unique_email` (`email`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `unique_email` (`email`);

--
-- Indexes for table `reception`
--
ALTER TABLE `reception`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `unique_email` (`email`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_id` (`doctor_id`),
  ADD KEY `fk_patient_id` (`patient_id`);

--
-- Indexes for table `specialty`
--
ALTER TABLE `specialty`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `nurse`
--
ALTER TABLE `nurse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `reception`
--
ALTER TABLE `reception`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `specialty`
--
ALTER TABLE `specialty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `doctor`
--
ALTER TABLE `doctor`
  ADD CONSTRAINT `doctor_ibfk_1` FOREIGN KEY (`specialty_id`) REFERENCES `specialty` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_specialty_id` FOREIGN KEY (`specialty_id`) REFERENCES `specialty` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `fk_patient_id` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
