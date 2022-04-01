-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2022 at 04:26 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpmotors`
--

-- --------------------------------------------------------

--
-- Table structure for table `carclassification`
--

CREATE TABLE `carclassification` (
  `classificationId` int(11) NOT NULL,
  `classificationName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carclassification`
--

INSERT INTO `carclassification` (`classificationId`, `classificationName`) VALUES
(1, 'SUV'),
(2, 'Classic'),
(3, 'Sports'),
(4, 'Trucks'),
(5, 'Used'),
(13, 'Mini');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `clientId` int(10) UNSIGNED NOT NULL,
  `clientFirstname` varchar(15) NOT NULL,
  `clientLastname` varchar(25) NOT NULL,
  `clientEmail` varchar(40) NOT NULL,
  `clientPassword` varchar(255) NOT NULL,
  `clientLevel` enum('1','2','3') NOT NULL DEFAULT '1',
  `comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`clientId`, `clientFirstname`, `clientLastname`, `clientEmail`, `clientPassword`, `clientLevel`, `comment`) VALUES
(1, 'Steve ', 'Rogers', 'cap@stevie.io', 'Qwerty12#', '1', NULL),
(5, 'Avril', 'Daphne', 'test123@gmail.com', '$2y$10$XoPY0Zqkyj5ZWlqQgAdbUOpcvtj2m9if46s1BudhcoME.lLVij3hm', '1', NULL),
(6, 'test', 'test', 'test@gmm.com', '$2y$10$XL59TMUFyJuaZucGO1CL7e1JNRo0nWLSm5PMX2IN.3UeBxJ/R0Cku', '1', NULL),
(7, 'dd', 'dd', 'dd@gmail.com', '$2y$10$.60E9Do4bz2n/A6EW9iXguWGFfrmvAWUY/q9zNmtdjTUDTprMga3C', '3', NULL),
(8, 'Admin', 'User', 'admin@cse340.net', '$2y$10$vGLu/d2qLnKZRfa0oO6d1OPrLoO0tlYwVLiJw4ig/YlqvRY81GvV6', '3', NULL),
(9, 'Harley', 'Quinn', 'harley@cse340.net', '$2y$10$MOb75JM1sFqjlN/zm0hl3.pnBcqvjpycCSoLQZr8H550aEU/j8C4O', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `imgId` int(11) NOT NULL,
  `invId` int(11) NOT NULL,
  `imgName` varchar(100) NOT NULL,
  `imgPath` varchar(150) NOT NULL,
  `imgDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `imgPrimary` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`imgId`, `invId`, `imgName`, `imgPath`, `imgDate`, `imgPrimary`) VALUES
(3, 1, 'wrangler.jpg', '/phpmotors/images/vehicles/wrangler.jpg', '2022-03-20 04:02:34', 1),
(4, 1, 'wrangler-tn.jpg', '/phpmotors/images/vehicles/wrangler-tn.jpg', '2022-03-20 04:02:34', 1),
(5, 2, 'model-t.jpg', '/phpmotors/images/vehicles/model-t.jpg', '2022-03-20 04:06:08', 0),
(6, 2, 'model-t-tn.jpg', '/phpmotors/images/vehicles/model-t-tn.jpg', '2022-03-20 04:06:08', 0),
(7, 15, 'no-image.png', '/phpmotors/images/vehicles/no-image.png', '2022-03-20 04:06:29', 0),
(8, 15, 'no-image-tn.png', '/phpmotors/images/vehicles/no-image-tn.png', '2022-03-20 04:06:29', 0),
(9, 7, 'mystery-van.jpg', '/phpmotors/images/vehicles/mystery-van.jpg', '2022-03-20 04:07:18', 1),
(10, 7, 'mystery-van-tn.jpg', '/phpmotors/images/vehicles/mystery-van-tn.jpg', '2022-03-20 04:07:18', 1),
(11, 12, 'hummer.jpg', '/phpmotors/images/vehicles/hummer.jpg', '2022-03-20 04:08:32', 1),
(12, 12, 'hummer-tn.jpg', '/phpmotors/images/vehicles/hummer-tn.jpg', '2022-03-20 04:08:32', 1),
(13, 9, 'crwn-vic.jpg', '/phpmotors/images/vehicles/crwn-vic.jpg', '2022-03-20 04:08:55', 1),
(14, 9, 'crwn-vic-tn.jpg', '/phpmotors/images/vehicles/crwn-vic-tn.jpg', '2022-03-20 04:08:55', 1),
(15, 5, 'mechanic.jpg', '/phpmotors/images/vehicles/mechanic.jpg', '2022-03-20 04:09:16', 1),
(16, 5, 'mechanic-tn.jpg', '/phpmotors/images/vehicles/mechanic-tn.jpg', '2022-03-20 04:09:16', 1),
(17, 4, 'monster-truck.jpg', '/phpmotors/images/vehicles/monster-truck.jpg', '2022-03-20 04:10:02', 1),
(18, 4, 'monster-truck-tn.jpg', '/phpmotors/images/vehicles/monster-truck-tn.jpg', '2022-03-20 04:10:02', 1),
(19, 10, 'camaro.jpg', '/phpmotors/images/vehicles/camaro.jpg', '2022-03-20 04:10:26', 1),
(20, 10, 'camaro-tn.jpg', '/phpmotors/images/vehicles/camaro-tn.jpg', '2022-03-20 04:10:26', 1),
(21, 11, 'escalade.jpg', '/phpmotors/images/vehicles/escalade.jpg', '2022-03-20 04:10:39', 1),
(22, 11, 'escalade-tn.jpg', '/phpmotors/images/vehicles/escalade-tn.jpg', '2022-03-20 04:10:39', 1),
(23, 14, 'van.jpg', '/phpmotors/images/vehicles/van.jpg', '2022-03-20 04:10:55', 1),
(24, 14, 'van-tn.jpg', '/phpmotors/images/vehicles/van-tn.jpg', '2022-03-20 04:10:55', 1),
(25, 6, 'batmobile.jpg', '/phpmotors/images/vehicles/batmobile.jpg', '2022-03-20 04:11:33', 1),
(26, 6, 'batmobile-tn.jpg', '/phpmotors/images/vehicles/batmobile-tn.jpg', '2022-03-20 04:11:33', 1),
(27, 3, 'adventador.jpg', '/phpmotors/images/vehicles/adventador.jpg', '2022-03-20 04:11:46', 1),
(28, 3, 'adventador-tn.jpg', '/phpmotors/images/vehicles/adventador-tn.jpg', '2022-03-20 04:11:46', 1),
(29, 13, 'aerocar.jpg', '/phpmotors/images/vehicles/aerocar.jpg', '2022-03-20 04:12:36', 1),
(30, 13, 'aerocar-tn.jpg', '/phpmotors/images/vehicles/aerocar-tn.jpg', '2022-03-20 04:12:36', 1),
(31, 8, 'fire-truck.jpg', '/phpmotors/images/vehicles/fire-truck.jpg', '2022-03-20 04:13:02', 1),
(32, 8, 'fire-truck-tn.jpg', '/phpmotors/images/vehicles/fire-truck-tn.jpg', '2022-03-20 04:13:02', 1),
(33, 25, 'delorean.jpg', '/phpmotors/images/vehicles/delorean.jpg', '2022-03-20 04:24:14', 0),
(35, 21, 'i8.jpg', '/phpmotors/images/vehicles/i8.jpg', '2022-03-20 04:28:12', 1),
(36, 21, 'i8-tn.jpg', '/phpmotors/images/vehicles/i8-tn.jpg', '2022-03-20 04:28:12', 1),
(37, 21, 'i81.jpg', '/phpmotors/images/vehicles/i81.jpg', '2022-03-20 04:28:25', 0),
(38, 21, 'i81-tn.jpg', '/phpmotors/images/vehicles/i81-tn.jpg', '2022-03-20 04:28:25', 0),
(39, 3, 'red-adventor.jpg', '/phpmotors/images/vehicles/red-adventor.jpg', '2022-03-20 04:28:40', 0),
(40, 3, 'red-adventor-tn.jpg', '/phpmotors/images/vehicles/red-adventor-tn.jpg', '2022-03-20 04:28:40', 0),
(41, 11, 'escalad.jpg', '/phpmotors/images/vehicles/escalad.jpg', '2022-03-20 04:29:52', 0),
(42, 11, 'escalad-tn.jpg', '/phpmotors/images/vehicles/escalad-tn.jpg', '2022-03-20 04:29:52', 0),
(43, 25, 'mini.jpg', '/phpmotors/images/vehicles/mini.jpg', '2022-03-20 05:57:34', 1),
(44, 25, 'mini-tn.jpg', '/phpmotors/images/vehicles/mini-tn.jpg', '2022-03-20 05:57:34', 1),
(45, 25, 'mini4.jpg', '/phpmotors/images/vehicles/mini4.jpg', '2022-03-20 05:57:51', 0),
(46, 25, 'mini4-tn.jpg', '/phpmotors/images/vehicles/mini4-tn.jpg', '2022-03-20 05:57:51', 0),
(47, 25, 'mini2.jpg', '/phpmotors/images/vehicles/mini2.jpg', '2022-03-20 05:58:01', 0),
(48, 25, 'mini2-tn.jpg', '/phpmotors/images/vehicles/mini2-tn.jpg', '2022-03-20 05:58:01', 0);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `invId` int(11) NOT NULL,
  `invMake` varchar(30) NOT NULL,
  `invModel` varchar(30) NOT NULL,
  `invDescription` text NOT NULL,
  `invImage` varchar(50) NOT NULL,
  `invThumbnail` varchar(50) NOT NULL,
  `invPrice` decimal(10,0) NOT NULL,
  `invStock` smallint(6) NOT NULL,
  `invColor` varchar(20) NOT NULL,
  `classificationId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`invId`, `invMake`, `invModel`, `invDescription`, `invImage`, `invThumbnail`, `invPrice`, `invStock`, `invColor`, `classificationId`) VALUES
(1, 'Jeep ', 'Wrangler', '    The Jeep Wrangler is small and compact with enough power to get you where you want to go. It is great for everyday driving as well as off-roading whether that be on the rocks or in the mud!', '/phpmotors/images/vehicles/wrangler.jpg', '/phpmotors/images/vehicles/wrangler-tn.jpg', '28045', 4, 'Orange', 1),
(2, 'Ford', 'Model T', 'The Ford Model T can be a bit tricky to drive. It was the first car to be put into production. You can get it in any color you want if it is black.', '/phpmotors/images/vehicles/model-t.jpg', '/phpmotors/images/vehicles/model-t-tn.jpg', '30000', 2, 'Black', 2),
(3, 'Lamborghini', 'Adventador', '      This V-12 engine packs a punch in this sporty car. Make sure you wear your seatbelt and obey all traffic laws.', '/phpmotors/images/vehicles/adventador.jpg', '/phpmotors/images/vehicles/adventador-tn.jpg', '417650', 1, 'Blue', 3),
(4, 'Monster', 'Truck', '  Most trucks are for working, this one is for fun. This beast comes with 60 inch tires giving you the traction needed to jump and roll in the mud.', '/phpmotors/images/vehicles/monster-truck.jpg	', '/phpmotors/images/vehicles/monster-truck-tn.jpg', '150000', 3, 'purple', 4),
(5, 'Mechanic', 'Special', ' Not sure where this car came from. However, with a little tender loving care it will run as good a new.', '/phpmotors/images/vehicles/mechanic.jpg', '/phpmotors/images/vehicles/mechanic-tn.jpg', '100', 1, 'Rust', 5),
(6, 'Batmobile', 'Custom', 'Ever want to be a superhero? Now you can with the bat mobile. This car allows you to switch to bike mode allowing for easy maneuvering through traffic during rush hour.', '/phpmotors/images/vehicles/batmobile.jpg', '/phpmotors/images/vehicles/batmobile-tn.jpg', '65000', 1, 'Black', 3),
(7, 'Mystery', 'Machine', ' Scooby and the gang always found luck in solving their mysteries because of their 4 wheel drive Mystery Machine. This Van will help you do whatever job you are required to with a success rate of 100%.', '/phpmotors/images/vehicles/mystery-van.jpg', '/phpmotors/images/vehicles/mystery-van-tn.jpg', '10000', 12, 'Green', 1),
(8, 'Spartan', 'Fire Truck', 'Emergencies happen often. Be prepared with this Spartan fire truck. Comes complete with 1000 ft. of hose and a 1000-gallon tank.', '/phpmotors/images/vehicles/fire-truck.jpg', '/phpmotors/images/vehicles/fire-truck-tn.jpg', '50000', 1, 'Red', 2),
(9, 'Ford', 'Crown Victoria', ' After the police force updated their fleet these cars are now available to the public! These cars come equipped with the siren which is convenient for college students running late to class.', '/phpmotors/images/vehicles/crwn-vic.jpg', '/phpmotors/images/vehicles/crwn-vic-tn.jpg', '10000', 5, 'White', 5),
(10, 'Chevy', 'Camaro', ' If you want to look cool this is the car you need! This car has great performance at an affordable price. Own it today!', '/phpmotors/images/vehicles/camaro.jpg', '/phpmotors/images/vehicles/camaro-tn.jpg', '25000', 10, 'Silver', 3),
(11, 'Cadillac', 'Escalade', ' This styling car is great for any occasion from going to the beach to meeting the president. The luxurious inside makes this car a home away from home.', '/phpmotors/images/vehicles/escalade.jpg', '/phpmotors/images/vehicles/escalade-tn.jpg', '75195', 4, 'Black', 1),
(12, 'GM', 'Hummer', ' Do you have 6 kids and like to go off-roading? The Hummer gives you the small interiors with an engine to get you out of any muddy or rocky situation.', '/phpmotors/images/vehicles/hummer.jpg', '/phpmotors/images/vehicles/hummer-tn.jpg', '58800', 5, 'Yellow', 5),
(13, 'Aerocar International', 'Aerocar', ' Are you sick of rush hour traffic? This car converts into an airplane to get you where you are going fast. Only 6 of these were made, get this one while it lasts!', '/phpmotors/images/vehicles/aerocar.jpg', '/phpmotors/images/vehicles/aerocar-tn.jpg', '1000000', 1, 'Red', 2),
(14, 'FBI', 'Surveillance Van', ' Do you like police shows? You will feel right at home driving this van. Comes complete with surveillance equipment for an extra fee of $2,000 a month. ', '/phpmotors/images/vehicles/van.jpg', '/phpmotors/images/vehicles/van-tn.jpg', '20000', 1, 'Green', 1),
(15, 'Dog ', 'Car', ' Do you like dogs? Well, this car is for you straight from the 90s from Aspen, Colorado we have the original Dog Car complete with fluffy ears.', '/phpmotors/images/vehicles/no-image.png', '/phpmotors/images/vehicles/no-image-tn.png', '35000', 1, 'Brown', 2),
(21, 'BMW', 'i8', ' test data here', '/phpmotors/images/vehicles/i81.jpg', '/phpmotors/images/vehicles/i81-tn.jpg', '25000', 4, 'Red', 3),
(25, 'Mini', 'Cooper', '   test to be deleted', '/phpmotors/images/vehicles/mini.jpg', '/phpmotors/images/vehicles/mini-tn.jpg', '2313', 2, 'red', 13);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `reviewId` int(10) NOT NULL,
  `reviewText` text NOT NULL,
  `reviewDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `invId` int(10) NOT NULL,
  `clientId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`reviewId`, `reviewText`, `reviewDate`, `invId`, `clientId`) VALUES
(1, 'This a great machine, I am telling you.....', '2022-03-31 20:23:47', 2, 8),
(2, 'My super small car.........', '2022-03-31 21:18:42', 25, 8),
(3, 'The i8 is one of the quietest and most environmentally friendly supercars around, but it’s certainly not a car for shrinking violets – just check out those ludicrous doors! ', '2022-03-31 22:24:52', 21, 8),
(4, 'If you find yourself disappointed by the lack of door pockets in the i8, just imagine swinging the door open and being biffed in the head by your bottle of water... ', '2022-03-31 22:25:16', 21, 8),
(5, 'From buzzing electric motors to growling three-cylinder engines and whizzing turbochargers, the i8 serves up a comprehensive A to Z of interesting automotive noises ', '2022-03-31 22:25:33', 21, 8),
(6, 'Colorful van.............', '2022-04-01 10:58:48', 7, 8),
(7, 'Oh my gosh.............I want this car!!!', '2022-04-01 11:14:55', 2, 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carclassification`
--
ALTER TABLE `carclassification`
  ADD PRIMARY KEY (`classificationId`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`clientId`),
  ADD UNIQUE KEY `clientEmail` (`clientEmail`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`imgId`),
  ADD KEY `images_ibfk_1` (`invId`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`invId`),
  ADD KEY `classificationId` (`classificationId`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`reviewId`),
  ADD KEY `inventory` (`invId`),
  ADD KEY `client` (`clientId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carclassification`
--
ALTER TABLE `carclassification`
  MODIFY `classificationId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `clientId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `imgId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `invId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `reviewId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`classificationId`) REFERENCES `carclassification` (`classificationId`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `client` FOREIGN KEY (`clientId`) REFERENCES `clients` (`clientId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inventory` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
