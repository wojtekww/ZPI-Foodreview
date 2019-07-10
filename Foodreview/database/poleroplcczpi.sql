-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: poleroplcczpi.mysql.db
-- Generation Time: May 15, 2019 at 07:33 PM
-- Server version: 5.6.42-log
-- PHP Version: 7.0.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `poleroplcczpi`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbadditionalphoto`
--

CREATE TABLE `tbadditionalphoto` (
  `additionalPhotoID` int(1) NOT NULL,
  `additionalPhotoPath` varchar(255) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `restaurantID` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbadditionalphoto`
--

INSERT INTO `tbadditionalphoto` (`additionalPhotoID`, `additionalPhotoPath`, `restaurantID`) VALUES
(1, '/images/food.jpg', 3),
(2, '/images/food.jpg', 3),
(3, '/images/food.jpg', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbaddress`
--

CREATE TABLE `tbaddress` (
  `addressID` int(1) NOT NULL,
  `city` varchar(255) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `street` varchar(255) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `buildingNumber` varchar(255) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `localNumber` varchar(255) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `postCode` varchar(255) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `postCity` varchar(255) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbaddress`
--

INSERT INTO `tbaddress` (`addressID`, `city`, `street`, `buildingNumber`, `localNumber`, `postCode`, `postCity`) VALUES
(1, 'Wroclaw', 'Kaliska', '111', NULL, '11-111', 'Wroclaw'),
(2, 'Wroclaw', 'Wroclawska', '222', NULL, '22-222', 'Wroclaw'),
(3, 'Wroclaw', 'Warszawska', '333', NULL, '33-333', 'Wroclaw'),
(4, 'Wroclaw', 'Szczecinska', '44', NULL, '44-444', 'Wroclaw'),
(5, 'Wroclaw', 'Gdanska', '55', NULL, '55-555', 'Wroclaw'),
(6, 'Wroclaw', 'Torunska', '666', NULL, '66-666', 'Wroclaw'),
(7, 'Wroclaw', 'Ostrowska', '77', NULL, '77-777', 'Wroclaw'),
(8, 'Wrocław', 'Holenderska ', '12', '390147', '54-404', 'Wrocław'),
(10, 'Wrocław', 'Długa ', '2', '', '56-x564', 'Wrocław'),
(11, 'Testowe', 'Testowa', '26', '999999999', '25-555', 'Test'),
(12, 'Wrocław', 'Testowa', '12', '12', '54-130', 'Wrocław');

-- --------------------------------------------------------

--
-- Table structure for table `tbistype`
--

CREATE TABLE `tbistype` (
  `isTypeID` int(1) NOT NULL,
  `restaurantID` int(1) NOT NULL,
  `typeID` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbistype`
--

INSERT INTO `tbistype` (`isTypeID`, `restaurantID`, `typeID`) VALUES
(1, 8, 1),
(2, 3, 4),
(4, 10, 4),
(5, 11, 1),
(7, 1, 4),
(8, 7, 3),
(9, 2, 2),
(10, 12, 1),
(11, 12, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbrate`
--

CREATE TABLE `tbrate` (
  `rateID` int(1) NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `createdDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rate` int(1) NOT NULL,
  `userID` int(1) NOT NULL,
  `restaurantID` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbrate`
--

INSERT INTO `tbrate` (`rateID`, `description`, `createdDate`, `rate`, `userID`, `restaurantID`) VALUES
(2, 'Nie polecam, niemiła obsługa, zimne kotlety. A papryki to oni na oczy nie widzieli.', '2019-04-11 21:07:20', 1, 1, 10),
(3, 'No generalnie to elegancko, klasa sama w sobie. Kelnerka w blond włosach 11/10.', '2019-04-11 21:26:46', 5, 1, 8),
(4, 'taka se szczerze muwionc, pozdro janusz', '2019-04-12 06:19:49', 2, 4, 11),
(5, 'Drogi Januszu, powiedz mi proszę co ci się nie podoba w Restauracji Testowej? U was na Podlasiu to  w ogóle są jakieś restauracje?! Poza tym kto by się przejmował twoją opinią! Wszyscy wiedzą, że Restauracja Testowa to perła w kulinariach wrocławskich. Na', '2019-04-12 15:34:21', 5, 1, 11),
(9, '3/10 asd', '2019-05-14 13:15:49', 4, 4, 8),
(10, 'moze byc', '2019-05-14 13:48:29', 3, 4, 12),
(11, 'ale beka tam jes', '2019-05-14 14:02:26', 5, 4, 10);

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
  `restaurantName` varchar(255) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `restaurantDescription` varchar(255) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `createdDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `restaurantOwner` int(1) NOT NULL,
  `mainPhotoPath` varchar(255) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `addressID` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbrestaurant`
--

INSERT INTO `tbrestaurant` (`restaurantID`, `restaurantName`, `restaurantDescription`, `createdDate`, `restaurantOwner`, `mainPhotoPath`, `addressID`) VALUES
(1, 'Jakas pizzeria', 'Wspaniała włoska restauracja w samym centrum zjawiskowego Wrocławia. Zapraszamy na prawdziwe, włoskie makarony, pizze i wiele innych tradycyjnych dań, które sprawią, że poczujecie się jak w stolicy kulinarnej Europy!', '2019-03-31 07:08:16', 1, 'images/food.jpg', 1),
(2, 'Inna pizzeria', 'Wspaniała włoska restauracja w samym centrum zjawiskowego Wrocławia. Zapraszamy na prawdziwe, włoskie makarony, pizze i wiele innych tradycyjnych dań, które sprawią, że poczujecie się jak w stolicy kulinarnej Europy!', '2019-03-31 07:08:16', 1, 'images/food2.jpg', 2),
(3, 'Bernard', 'Wspaniała włoska restauracja w samym centrum zjawiskowego Wrocławia. Zapraszamy na prawdziwe, włoskie makarony, pizze i wiele innych tradycyjnych dań, które sprawią, że poczujecie się jak w stolicy kulinarnej Europy!', '2019-03-31 07:08:16', 1, 'images/food3.jpg', 3),
(4, 'Yemsetu', 'Wspaniała włoska restauracja w samym centrum zjawiskowego Wrocławia. Zapraszamy na prawdziwe, włoskie makarony, pizze i wiele innych tradycyjnych dań, które sprawią, że poczujecie się jak w stolicy kulinarnej Europy!', '2019-03-31 07:08:16', 1, 'images/food4.jpg', 4),
(5, 'KFC', 'Restauracja przyciąga niepowtarzalnym klimatem i doskonałym jedzeniem. Nasi kucharze oraz kelnerzy zadbają o Państwa dobry nastrój. Potrawy przyrządzane od podstaw w oparciu o naturalne i świeże produkty zaspokajają od lat podniebienia naszych gości.', '2019-03-31 07:08:16', 1, 'images/food5.jpg', 5),
(6, 'Valdi plus', 'Restauracja przyciąga niepowtarzalnym klimatem i doskonałym jedzeniem. Nasi kucharze oraz kelnerzy zadbają o Państwa dobry nastrój. Potrawy przyrządzane od podstaw w oparciu o naturalne i świeże produkty zaspokajają od lat podniebienia naszych gości.', '2019-03-31 07:08:16', 1, 'images/food6.jpg', 6),
(7, 'Sphinx', 'Restauracja przyciąga niepowtarzalnym klimatem i doskonałym jedzeniem. Nasi kucharze oraz kelnerzy zadbają o Państwa dobry nastrój. Potrawy przyrządzane od podstaw w oparciu o naturalne i świeże produkty zaspokajają od lat podniebienia naszych gości.', '2019-03-31 07:08:16', 1, 'images/food7.jpg', 7),
(8, 'Testowa restauracja', 'Najlepsza restauracja w mieście serwujemy wiadomo co', '2019-04-10 16:19:35', 1, NULL, 8),
(10, 'Paprykowa mama', 'Restauracja z długą tradycją paprykową. Papryka zawsze, papryka dużo, papryka wszędzie. Restauracja z długą tradycją paprykową. Papryka zawsze, papryka dużo, papryka wszędzie. Restauracja z długą tradycją paprykową. Papryka zawsze, papryka dużo, papryka w', '2019-04-11 19:47:03', 1, NULL, 10),
(11, 'Restauracja Testowa', 'Restauracja Testowa jest od lat cenionym miejscem kameralnych spotkań, znanym ze znakomitej kuchni. Zapraszamy na  wyśmienity lunch w przerwie w pracy, wykwintny obiad z rodziną lub romantyczny wieczór na tarasach przy lampce wina.', '2019-04-11 21:53:05', 1, NULL, 11),
(12, 'Restauracja ZPI', 'Testowa restauracja zpi\r\n', '2019-04-14 15:15:00', 1, NULL, 12);

-- --------------------------------------------------------

--
-- Table structure for table `tbrestauranttype`
--

CREATE TABLE `tbrestauranttype` (
  `typeID` int(1) NOT NULL,
  `typeName` varchar(255) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbrestauranttype`
--

INSERT INTO `tbrestauranttype` (`typeID`, `typeName`) VALUES
(1, 'chińskie'),
(2, 'wegetariańskie'),
(3, 'tajskie'),
(4, 'polskie'),
(5, 'niemieckie');

-- --------------------------------------------------------

--
-- Table structure for table `tbuser`
--

CREATE TABLE `tbuser` (
  `userid` int(4) NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `usersurname` varchar(255) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `usermail` varchar(255) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `userlogin` varchar(255) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `userpassword` varchar(255) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `userverified` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbuser`
--

INSERT INTO `tbuser` (`userid`, `username`, `usersurname`, `usermail`, `userlogin`, `userpassword`, `userverified`) VALUES
(1, 'Sebastian', 'Hanowski', 'hanowskis@gmail.com', 'sebhan', '$2y$10$z/FTIuqPh1PmSq7.xxqGpOEKVgNbENCapzCnL9a0CcfuyCsKDWKSC', 0),
(2, 'Mateusz', 'Wesołowski', 'mati@mati.pl', 'mati', '$2y$10$ZMyD9eBV7AvwKQlfGl7r3.SepWl2Yv/YtjJAhgeMdK6xlU/M5H0ZG', 0),
(3, 'Patryk', 'Konopka', 'konopkapatryk2@gmail.com', 'patryk', '$2y$10$mMS/AA8j8qO6EXmVJdZ/ueeh.raM2X2g/0LfocYJXYhOV1DARUz4C', 0),
(4, 'Test', 'Test', 'test@test.pl', 'test', '$2y$10$wNMcyOM/B4jXtq7hpYHdp.QTAbOrUk8kILylhts.B5fjkZXr0T/ui', 0),
(5, 'Jan', 'Kowalski', 'jan@kowalski.pl', 'jkowalski', '$2y$10$WQ8Dt1YirLejbyiTw13he.yWdtJKrFmR/7Ae1evXqxF0K6RVnUEuu', 0),
(6, 'Patryk', 'Konopka', 'test@test.test', 'pkonopka', '$2y$10$8qyDtl72aFzeRJs1W3YTy.y5e9jYxsvqgKrlirsp.p0M5MZw55aTG', 0),
(8, 'Franek', 'Kimono', 'sads@dsad', 'fkimono', '$2y$10$qroDEi5Sb8BZniCVHLxcXOIZ2WKqL7KA0LVZvoMhJXFfr0y.qiNlq', 0),
(9, 'Testomir', 'Testalski', 'testomir@test.com', 'testek', '$2y$10$a4kIHInnpBy2GTGZlH/sS.tiimGaUOR.Us4v9u.DKIykYLdZAcYou', 0);

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
-- Indexes for table `tbuser`
--
ALTER TABLE `tbuser`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `usermail` (`usermail`,`userlogin`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbadditionalphoto`
--
ALTER TABLE `tbadditionalphoto`
  MODIFY `additionalPhotoID` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbaddress`
--
ALTER TABLE `tbaddress`
  MODIFY `addressID` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `tbistype`
--
ALTER TABLE `tbistype`
  MODIFY `isTypeID` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `tbrate`
--
ALTER TABLE `tbrate`
  MODIFY `rateID` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tbrestaurant`
--
ALTER TABLE `tbrestaurant`
  MODIFY `restaurantID` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `tbrestauranttype`
--
ALTER TABLE `tbrestauranttype`
  MODIFY `typeID` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbuser`
--
ALTER TABLE `tbuser`
  MODIFY `userid` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
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
