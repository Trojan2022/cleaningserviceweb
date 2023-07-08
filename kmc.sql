-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2023 at 08:18 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kmc`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `AdID` int(11) NOT NULL,
  `adFirstName` varchar(100) DEFAULT NULL,
  `adLastName` varchar(100) DEFAULT NULL,
  `adImage` varchar(255) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdID`, `adFirstName`, `adLastName`, `adImage`, `Email`, `Password`) VALUES
(1, 'Ko Aung', 'Thura', 'w09.jpg', 'admin@gmail.com', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `assign`
--

CREATE TABLE `assign` (
  `assignID` int(11) NOT NULL,
  `scID` int(11) DEFAULT NULL,
  `adID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assign`
--

INSERT INTO `assign` (`assignID`, `scID`, `adID`) VALUES
(1, 1, 1),
(3, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `bookingID` int(11) NOT NULL,
  `bookingDate` date DEFAULT NULL,
  `bookingAddress` varchar(200) DEFAULT NULL,
  `bookingStatus` varchar(100) DEFAULT NULL,
  `cusID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`bookingID`, `bookingDate`, `bookingAddress`, `bookingStatus`, `cusID`) VALUES
(1, '2023-06-01', 'Mandalay', 'Pending', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bookingservice`
--

CREATE TABLE `bookingservice` (
  `bsID` int(11) NOT NULL,
  `tpID` int(11) DEFAULT NULL,
  `csID` int(11) DEFAULT NULL,
  `bookingID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookingservice`
--

INSERT INTO `bookingservice` (`bsID`, `tpID`, `csID`, `bookingID`) VALUES
(1, 2, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cleaningservice`
--

CREATE TABLE `cleaningservice` (
  `csID` int(11) NOT NULL,
  `csName` varchar(100) DEFAULT NULL,
  `csInfo` text DEFAULT NULL,
  `scID` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cleaningservice`
--

INSERT INTO `cleaningservice` (`csID`, `csName`, `csInfo`, `scID`, `price`) VALUES
(1, 'Window Cleaning Service', 'Cleaning windows with professional glasses cleaner (For four window)', 1, 43000),
(2, 'Deep Cleaning Service', 'Cleaning deeply like new one (For one floor)', 1, 60000),
(3, 'House Cleaning Service', 'Cleaning the whole house with the professional maid (For one house)', 1, 70000),
(4, 'Office cleaning Service', 'Cleaning office room (For one office)', 1, 89000);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cusID` int(11) NOT NULL,
  `cusFirstName` varchar(50) DEFAULT NULL,
  `cusLastName` varchar(50) DEFAULT NULL,
  `cusImage` varchar(255) DEFAULT NULL,
  `cusEmail` varchar(50) DEFAULT NULL,
  `cusPassword` varchar(50) DEFAULT NULL,
  `cusPhone` varchar(50) DEFAULT NULL,
  `cusAddress` varchar(50) DEFAULT NULL,
  `cusJoinDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cusID`, `cusFirstName`, `cusLastName`, `cusImage`, `cusEmail`, `cusPassword`, `cusPhone`, `cusAddress`, `cusJoinDate`) VALUES
(1, 'Ko', 'Mg Mg', 'w03.jpg', 'kmm@gmail.com', '123456', '096554422111', 'Mandalay', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `fbID` int(11) NOT NULL,
  `fbMessage` text DEFAULT NULL,
  `cusID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`fbID`, `fbMessage`, `cusID`) VALUES
(1, 'hell0', 1);

-- --------------------------------------------------------

--
-- Table structure for table `servicecategory`
--

CREATE TABLE `servicecategory` (
  `scID` int(11) NOT NULL,
  `scName` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `servicecategory`
--

INSERT INTO `servicecategory` (`scID`, `scName`) VALUES
(1, 'Cleaning Service'),
(3, 'Transportation Service');

-- --------------------------------------------------------

--
-- Table structure for table `transportationservice`
--

CREATE TABLE `transportationservice` (
  `tpID` int(11) NOT NULL,
  `tpName` varchar(100) DEFAULT NULL,
  `tpDescription` text DEFAULT NULL,
  `tpPrice` int(11) DEFAULT NULL,
  `scID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transportationservice`
--

INSERT INTO `transportationservice` (`tpID`, `tpName`, `tpDescription`, `tpPrice`, `scID`) VALUES
(1, 'Silver package', 'Five Employee and One Truck', NULL, 3),
(2, 'Gold Package', 'Nine Employee and Two Trucks', NULL, 3),
(3, 'Diamond Package', 'Sixteen Employee and Three Trucks', NULL, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdID`);

--
-- Indexes for table `assign`
--
ALTER TABLE `assign`
  ADD PRIMARY KEY (`assignID`),
  ADD KEY `scID` (`scID`),
  ADD KEY `adID` (`adID`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`bookingID`),
  ADD KEY `cusID` (`cusID`);

--
-- Indexes for table `bookingservice`
--
ALTER TABLE `bookingservice`
  ADD PRIMARY KEY (`bsID`),
  ADD KEY `tpID` (`tpID`),
  ADD KEY `csID` (`csID`),
  ADD KEY `bookingID` (`bookingID`);

--
-- Indexes for table `cleaningservice`
--
ALTER TABLE `cleaningservice`
  ADD PRIMARY KEY (`csID`),
  ADD KEY `scID` (`scID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cusID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`fbID`),
  ADD KEY `cusID` (`cusID`);

--
-- Indexes for table `servicecategory`
--
ALTER TABLE `servicecategory`
  ADD PRIMARY KEY (`scID`);

--
-- Indexes for table `transportationservice`
--
ALTER TABLE `transportationservice`
  ADD PRIMARY KEY (`tpID`),
  ADD KEY `scID` (`scID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `AdID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `assign`
--
ALTER TABLE `assign`
  MODIFY `assignID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `bookingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bookingservice`
--
ALTER TABLE `bookingservice`
  MODIFY `bsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cleaningservice`
--
ALTER TABLE `cleaningservice`
  MODIFY `csID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cusID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `fbID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `servicecategory`
--
ALTER TABLE `servicecategory`
  MODIFY `scID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transportationservice`
--
ALTER TABLE `transportationservice`
  MODIFY `tpID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assign`
--
ALTER TABLE `assign`
  ADD CONSTRAINT `assign_ibfk_1` FOREIGN KEY (`scID`) REFERENCES `servicecategory` (`scID`) ON DELETE CASCADE,
  ADD CONSTRAINT `assign_ibfk_2` FOREIGN KEY (`adID`) REFERENCES `admin` (`AdID`) ON DELETE CASCADE;

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`cusID`) REFERENCES `customer` (`cusID`) ON DELETE CASCADE;

--
-- Constraints for table `bookingservice`
--
ALTER TABLE `bookingservice`
  ADD CONSTRAINT `bookingservice_ibfk_1` FOREIGN KEY (`tpID`) REFERENCES `transportationservice` (`tpID`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookingservice_ibfk_2` FOREIGN KEY (`csID`) REFERENCES `cleaningservice` (`csID`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookingservice_ibfk_3` FOREIGN KEY (`bookingID`) REFERENCES `booking` (`bookingID`) ON DELETE CASCADE;

--
-- Constraints for table `cleaningservice`
--
ALTER TABLE `cleaningservice`
  ADD CONSTRAINT `cleaningservice_ibfk_1` FOREIGN KEY (`scID`) REFERENCES `servicecategory` (`scID`) ON DELETE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`cusID`) REFERENCES `customer` (`cusID`) ON DELETE CASCADE;

--
-- Constraints for table `transportationservice`
--
ALTER TABLE `transportationservice`
  ADD CONSTRAINT `transportationservice_ibfk_1` FOREIGN KEY (`scID`) REFERENCES `servicecategory` (`scID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
