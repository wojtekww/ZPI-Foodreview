-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2019 at 07:15 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodreview`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbadditionalphoto`
--

CREATE TABLE `tbadditionalphoto` (
  `additionalPhotoID` int(1) NOT NULL,
  `additionalPhotoPath` varchar(255) NOT NULL,
  `restaurantID` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbaddress`
--

CREATE TABLE `tbaddress` (
  `addressID` int(1) NOT NULL,
  `city` varchar(20) NOT NULL,
  `street` varchar(25) NOT NULL,
  `buildingNumber` varchar(4) NOT NULL,
  `localNumber` varchar(4) DEFAULT NULL,
  `postCode` varchar(6) NOT NULL,
  `postCity` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbistype`
--

CREATE TABLE `tbistype` (
  `isTypeID` int(1) NOT NULL,
  `restaurantID` int(1) NOT NULL,
  `typeID` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbrate`
--

CREATE TABLE `tbrate` (
  `rateID` int(1) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `createdDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rate` int(1) NOT NULL,
  `userID` int(1) NOT NULL,
  `restaurantID` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbrating`
--

CREATE TABLE `tbrating` (
  `rateValue` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbrating`
--

INSERT INTO `tbrating` (`rateValue`) VALUES
(1),
(2),
(3),
(4),
(5);

-- --------------------------------------------------------

--
-- Table structure for table `tbrestaurant`
--

CREATE TABLE `tbrestaurant` (
  `restaurantID` int(1) NOT NULL,
  `restaurantName` varchar(30) NOT NULL,
  `restaurantDescription` varchar(255) DEFAULT NULL,
  `createdDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `mainPhotoPath` varchar(255) DEFAULT NULL,
  `addressID` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbrestauranttype`
--

CREATE TABLE `tbrestauranttype` (
  `typeID` int(1) NOT NULL,
  `typeName` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbadditionalphoto`
--
ALTER TABLE `tbadditionalphoto`
  ADD PRIMARY KEY (`additionalPhotoID`),
  ADD KEY `fk_tbAdditionalPhoto_tbRestaurant` (`restaurantID`);

--
-- Indexes for table `tbaddress`
--
ALTER TABLE `tbaddress`
  ADD PRIMARY KEY (`addressID`),
  ADD UNIQUE KEY `uq_tbAddress_location` (`city`,`street`,`buildingNumber`,`postCode`);

--
-- Indexes for table `tbistype`
--
ALTER TABLE `tbistype`
  ADD PRIMARY KEY (`isTypeID`),
  ADD KEY `fk_tbIsType_tbRestaurant` (`restaurantID`),
  ADD KEY `fk_tbIsType_tbRestaurantType` (`typeID`);

--
-- Indexes for table `tbrate`
--
ALTER TABLE `tbrate`
  ADD PRIMARY KEY (`rateID`),
  ADD KEY `fk_tbRate_tbRating` (`rate`),
  ADD KEY `fk_tbRate_tbUser` (`userID`),
  ADD KEY `fk_tbRate_tbRestaurant` (`restaurantID`);

--
-- Indexes for table `tbrating`
--
ALTER TABLE `tbrating`
  ADD UNIQUE KEY `uq_tbRating_rateValue` (`rateValue`);

--
-- Indexes for table `tbrestaurant`
--
ALTER TABLE `tbrestaurant`
  ADD PRIMARY KEY (`restaurantID`),
  ADD UNIQUE KEY `uq_tbRestaurant_mainPhotoPath` (`mainPhotoPath`);

--
-- Indexes for table `tbrestauranttype`
--
ALTER TABLE `tbrestauranttype`
  ADD PRIMARY KEY (`typeID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbadditionalphoto`
--
ALTER TABLE `tbadditionalphoto`
  MODIFY `additionalPhotoID` int(1) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbaddress`
--
ALTER TABLE `tbaddress`
  MODIFY `addressID` int(1) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbistype`
--
ALTER TABLE `tbistype`
  MODIFY `isTypeID` int(1) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbrate`
--
ALTER TABLE `tbrate`
  MODIFY `rateID` int(1) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbrestaurant`
--
ALTER TABLE `tbrestaurant`
  MODIFY `restaurantID` int(1) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbrestauranttype`
--
ALTER TABLE `tbrestauranttype`
  MODIFY `typeID` int(1) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbadditionalphoto`
--
ALTER TABLE `tbadditionalphoto`
  ADD CONSTRAINT `fk_tbAdditionalPhoto_tbRestaurant` FOREIGN KEY (`restaurantID`) REFERENCES `tbrestaurant` (`restaurantID`);

--
-- Constraints for table `tbistype`
--
ALTER TABLE `tbistype`
  ADD CONSTRAINT `fk_tbIsType_tbRestaurant` FOREIGN KEY (`restaurantID`) REFERENCES `tbrestaurant` (`restaurantID`),
  ADD CONSTRAINT `fk_tbIsType_tbRestaurantType` FOREIGN KEY (`typeID`) REFERENCES `tbrestauranttype` (`typeID`);

--
-- Constraints for table `tbrate`
--
ALTER TABLE `tbrate`
  ADD CONSTRAINT `fk_tbRate_tbRating` FOREIGN KEY (`rate`) REFERENCES `tbrating` (`rateValue`),
  ADD CONSTRAINT `fk_tbRate_tbRestaurant` FOREIGN KEY (`restaurantID`) REFERENCES `tbrestaurant` (`restaurantID`),
  ADD CONSTRAINT `fk_tbRate_tbUser` FOREIGN KEY (`userID`) REFERENCES `tbuser` (`userid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
