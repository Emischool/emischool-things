-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2026 at 10:00 AM
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
-- Database: `genta_dental`
--

-- --------------------------------------------------------

--
-- Table structure for table `dentistet`
--

CREATE TABLE `dentistet` (
  `dentist_id` int(11) NOT NULL,
  `emri` varchar(50) NOT NULL,
  `mbiemri` varchar(50) NOT NULL,
  `specialiteti` varchar(80) DEFAULT NULL,
  `telefoni` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pacientet`
--

CREATE TABLE `pacientet` (
  `pacient_id` int(11) NOT NULL,
  `emri` varchar(50) NOT NULL,
  `mbiemri` varchar(50) NOT NULL,
  `ditelindja` date DEFAULT NULL,
  `telefoni` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `adresa` text DEFAULT NULL,
  `data_regjistrimit` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sherbimet`
--

CREATE TABLE `sherbimet` (
  `sherbim_id` int(11) NOT NULL,
  `emri_sherbimit` varchar(100) NOT NULL,
  `pershkrimi` text DEFAULT NULL,
  `cmimi` decimal(8,2) NOT NULL,
  `kohezgjatja_min` int(11) DEFAULT 30
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vizitat`
--

CREATE TABLE `vizitat` (
  `vizita_id` int(11) NOT NULL,
  `pacient_id` int(11) NOT NULL,
  `dentist_id` int(11) NOT NULL,
  `sherbim_id` int(11) NOT NULL,
  `data_vizites` datetime NOT NULL,
  `statusi` enum('planifikuar','kryer','anuluar') DEFAULT 'planifikuar',
  `shenime` text DEFAULT NULL,
  `cmimi_paguar` decimal(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dentistet`
--
ALTER TABLE `dentistet`
  ADD PRIMARY KEY (`dentist_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `pacientet`
--
ALTER TABLE `pacientet`
  ADD PRIMARY KEY (`pacient_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `sherbimet`
--
ALTER TABLE `sherbimet`
  ADD PRIMARY KEY (`sherbim_id`);

--
-- Indexes for table `vizitat`
--
ALTER TABLE `vizitat`
  ADD PRIMARY KEY (`vizita_id`),
  ADD KEY `pacient_id` (`pacient_id`),
  ADD KEY `dentist_id` (`dentist_id`),
  ADD KEY `sherbim_id` (`sherbim_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dentistet`
--
ALTER TABLE `dentistet`
  MODIFY `dentist_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pacientet`
--
ALTER TABLE `pacientet`
  MODIFY `pacient_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sherbimet`
--
ALTER TABLE `sherbimet`
  MODIFY `sherbim_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vizitat`
--
ALTER TABLE `vizitat`
  MODIFY `vizita_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `vizitat`
--
ALTER TABLE `vizitat`
  ADD CONSTRAINT `vizitat_ibfk_1` FOREIGN KEY (`pacient_id`) REFERENCES `pacientet` (`pacient_id`),
  ADD CONSTRAINT `vizitat_ibfk_2` FOREIGN KEY (`dentist_id`) REFERENCES `dentistet` (`dentist_id`),
  ADD CONSTRAINT `vizitat_ibfk_3` FOREIGN KEY (`sherbim_id`) REFERENCES `sherbimet` (`sherbim_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
