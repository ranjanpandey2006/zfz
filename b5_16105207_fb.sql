-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: sql111.byethost5.com
-- Generation Time: Dec 12, 2015 at 08:14 AM
-- Server version: 5.6.25-73.1
-- PHP Version: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `b5_16105207_fb`
--

-- --------------------------------------------------------

--
-- Table structure for table `menutable`
--

CREATE TABLE IF NOT EXISTS `menutable` (
  `menuId` int(11) NOT NULL AUTO_INCREMENT,
  `todayMenu` varchar(3000) DEFAULT NULL,
  `tomorrowMenu` varchar(3000) DEFAULT NULL,
  `todayMenuUnitPrice` double DEFAULT NULL,
  `tomorrowMenuUnitPrice` double DEFAULT NULL,
  `menuAddDate` datetime NOT NULL,
  `userId` int(11) NOT NULL,
  `imageUrl` varchar(3000) DEFAULT NULL,
  `imgUrlTomorrow` varchar(3000) DEFAULT NULL,
  PRIMARY KEY (`menuId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `menutable`
--

INSERT INTO `menutable` (`menuId`, `todayMenu`, `tomorrowMenu`, `todayMenuUnitPrice`, `tomorrowMenuUnitPrice`, `menuAddDate`, `userId`, `imageUrl`, `imgUrlTomorrow`) VALUES
(1, 'tate Biryaani, Raita, Mirchi salan', '3 Roti, Veg curry, Sweet taste', 4, 3, '2015-12-08 01:43:12', 2, 'http://blog.gyanlab.com/wp-content/uploads/2015/09/Chicken-Biryani1.jpg', 'https://myjourneythroughindia.files.wordpress.com/2013/10/roti-sabji.jpg'),
(2, 'Fruit salad', 'Spring Roll with sauce', 2, 2, '2015-11-15 16:23:52', 3, 'http://images.media-allrecipes.com/images/52895.jpg', 'http://www.evernewrecipes.com/wp-content/uploads/2010/05/spring-rolls-recipe.jpg'),
(3, 'Daal Makahani', 'No Food', 18, 186, '2015-11-19 00:11:25', 5, '', ''),
(4, 'roti sabzi', 'test', 2, 5, '2015-12-10 14:20:41', 9, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetailstable`
--

CREATE TABLE IF NOT EXISTS `orderdetailstable` (
  `orderdetailsid` int(11) NOT NULL AUTO_INCREMENT,
  `orderid` int(11) DEFAULT NULL,
  `todaysmenu` varchar(2500) DEFAULT NULL,
  `todaysqty` int(11) DEFAULT NULL,
  `todayspaid` decimal(10,3) DEFAULT NULL,
  `todaysdue` decimal(10,3) DEFAULT NULL,
  `todaystotal` decimal(10,3) DEFAULT NULL,
  `todayscomment` varchar(700) DEFAULT NULL,
  `tomorrowsmenu` varchar(2500) DEFAULT NULL,
  `tomorrowsqty` int(11) DEFAULT NULL,
  `tomorrowspaid` decimal(10,3) DEFAULT NULL,
  `tomorrowsdue` decimal(10,3) DEFAULT NULL,
  `tomorrowstotal` decimal(10,3) DEFAULT NULL,
  `tomorrowscomment` varchar(700) DEFAULT NULL,
  `provideremailid` varchar(100) DEFAULT NULL,
  `providerphone` varchar(30) DEFAULT NULL,
  `providername` varchar(200) NOT NULL,
  `orderstatus` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`orderdetailsid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `orderdetailstable`
--

INSERT INTO `orderdetailstable` (`orderdetailsid`, `orderid`, `todaysmenu`, `todaysqty`, `todayspaid`, `todaysdue`, `todaystotal`, `todayscomment`, `tomorrowsmenu`, `tomorrowsqty`, `tomorrowspaid`, `tomorrowsdue`, `tomorrowstotal`, `tomorrowscomment`, `provideremailid`, `providerphone`, `providername`, `orderstatus`) VALUES
(1, 1, 'Biryaani, Raita, Mirchi salan', 1, NULL, NULL, '4.000', 'NA', '3 Roti, Veg curry, Sweet', 1, NULL, NULL, '3.000', 'NA', 'provider1@gmail.com', '2222222222222', 'provider1', 'In progress'),
(2, 2, 'Fruit salad', 1, NULL, NULL, '2.000', 'NA', 'Spring Roll with sauce', 1, NULL, NULL, '2.000', 'NA', 'provider2@gmail.com', '33333333333', 'Provider2', 'In progress'),
(3, 2, 'Biryaani, Raita, Mirchi salan', 1, NULL, NULL, '4.000', 'NA', '3 Roti, Veg curry, Sweet', 1, NULL, NULL, '3.000', 'NA', 'provider1@gmail.com', '2222222222222', 'provider1', 'In progress'),
(4, 3, 'Fruit salad', 1, NULL, NULL, '2.000', 'NA', 'Spring Roll with sauce', 1, NULL, NULL, '2.000', 'NA', 'provider2@gmail.com', '33333333333', 'Provider2', 'In progress'),
(5, 3, 'Biryaani, Raita, Mirchi salan', 1, NULL, NULL, '4.000', 'NA', '3 Roti, Veg curry, Sweet', 1, NULL, NULL, '3.000', 'NA', 'provider1@gmail.com', '2222222222222', 'provider1', 'In progress'),
(6, 4, 'Ghee Shakar', 1, NULL, NULL, '8.000', 'NA', '', 1, NULL, NULL, '6.000', 'NA', 'itsdiggu@gmail.com', '8165296965', 'Test', 'In progress'),
(7, 4, 'Fruit salad', 1, NULL, NULL, '2.000', 'NA', 'Spring Roll with sauce', 1, NULL, NULL, '2.000', 'NA', 'provider2@gmail.com', '33333333333', 'Provider2', 'In progress'),
(8, 4, 'Biryaani, Raita, Mirchi salan', 1, NULL, NULL, '4.000', 'NA', '3 Roti, Veg curry, Sweet', 1, NULL, NULL, '3.000', 'NA', 'provider1@gmail.com', '2222222222222', 'provider1', 'In progress'),
(9, 5, 'Ghee Shakar', 1, NULL, NULL, '8.000', 'NA', '', 1, NULL, NULL, '6.000', 'NA', 'itsdiggu@gmail.com', '8165296965', 'Test', 'In progress'),
(10, 5, 'Fruit salad', 1, NULL, NULL, '2.000', 'NA', 'Spring Roll with sauce', 1, NULL, NULL, '2.000', 'NA', 'provider2@gmail.com', '33333333333', 'Provider2', 'In progress'),
(11, 5, 'Biryaani, Raita, Mirchi salan', 1, NULL, NULL, '4.000', 'NA', '3 Roti, Veg curry, Sweet', 1, NULL, NULL, '3.000', 'NA', 'provider1@gmail.com', '2222222222222', 'provider1', 'In progress'),
(12, 6, 'NA', 0, NULL, NULL, '0.000', 'NA', '', 5, NULL, NULL, '30.000', 'Dhin chak', 'itsdiggu@gmail.com', '8165296965', 'Test', 'In progress'),
(13, 6, 'Fruit salad', 1, NULL, NULL, '2.000', 'NA', 'Spring Roll with sauce', 1, NULL, NULL, '2.000', 'NA', 'provider2@gmail.com', '33333333333', 'Provider2', 'In progress'),
(14, 6, 'Biryaani, Raita, Mirchi salan', 1, NULL, NULL, '4.000', 'NA', '3 Roti, Veg curry, Sweet', 1, NULL, NULL, '3.000', 'NA', 'provider1@gmail.com', '2222222222222', 'provider1', 'In progress'),
(15, 7, 'Ghee Shakar', 1, NULL, NULL, '8.000', 'NA', '', 1, NULL, NULL, '6.000', 'NA', 'itsdiggu@gmail.com', '8165296965', 'Test', 'In progress'),
(16, 7, 'Fruit salad', 1, NULL, NULL, '2.000', 'NA', 'Spring Roll with sauce', 1, NULL, NULL, '2.000', 'NA', 'provider2@gmail.com', '33333333333', 'Provider2', 'In progress'),
(17, 7, 'Biryaani, Raita, Mirchi salan', 1, NULL, NULL, '4.000', 'NA', '3 Roti, Veg curry, Sweet', 1, NULL, NULL, '3.000', 'NA', 'provider1@gmail.com', '2222222222222', 'provider1', 'In progress'),
(18, 8, 'NA', 0, NULL, NULL, '0.000', 'NA', 'No Food', 1, NULL, NULL, '186.000', 'NA', 'itsdiggu@gmail.com', '8165296965', 'Test', 'In progress'),
(19, 8, 'Fruit salad', 1, NULL, NULL, '2.000', 'NA', 'NA', 0, NULL, NULL, '0.000', 'NA', 'provider2@gmail.com', '33333333333', 'Provider2', 'In progress'),
(20, 8, 'Biryaani, Raita, Mirchi salan', 1, NULL, NULL, '4.000', 'NA', '3 Roti, Veg curry, Sweet', 1, NULL, NULL, '3.000', 'NA', 'provider1@gmail.com', '2222222222222', 'provider1', 'In progress'),
(21, 9, 'tate Biryaani, Raita, Mirchi salan', 1, NULL, NULL, '4.000', 'NA', '3 Roti, Veg curry, Sweet taste', 1, NULL, NULL, '3.000', 'NA', 'provider1@gmail.com', '2222222222222', 'provider1', 'In progress'),
(22, 9, 'Daal Makahani', 1, NULL, NULL, '18.000', 'NA', 'No Food', 1, NULL, NULL, '186.000', 'NA', 'itsdiggu@gmail.com', '8165296965', 'Test', 'In progress'),
(23, 9, 'Fruit salad', 1, NULL, NULL, '2.000', 'NA', 'Spring Roll with sauce', 1, NULL, NULL, '2.000', 'NA', 'provider2@gmail.com', '33333333333', 'Provider2', 'In progress'),
(24, 10, 'NA', 0, NULL, NULL, '0.000', 'NA', 'test', 1, NULL, NULL, '5.000', 'extra 2 roti', 'test2@gmail.com', '111111111111', 'test2', 'In progress'),
(25, 10, 'tate Biryaani, Raita, Mirchi salan', 1, NULL, NULL, '4.000', 'NA', '3 Roti, Veg curry, Sweet taste', 1, NULL, NULL, '3.000', 'NA', 'provider1@gmail.com', '2222222222222', 'provider1', 'In progress'),
(26, 10, 'Daal Makahani', 1, NULL, NULL, '18.000', 'NA', 'No Food', 1, NULL, NULL, '186.000', 'NA', 'itsdiggu@gmail.com', '8165296965', 'Test', 'In progress'),
(27, 10, 'Fruit salad', 1, NULL, NULL, '2.000', 'NA', 'Spring Roll with sauce', 1, NULL, NULL, '2.000', 'NA', 'provider2@gmail.com', '33333333333', 'Provider2', 'In progress');

-- --------------------------------------------------------

--
-- Table structure for table `ordertable`
--

CREATE TABLE IF NOT EXISTS `ordertable` (
  `orderId` int(11) NOT NULL AUTO_INCREMENT,
  `numberOfLunchForToday` int(11) DEFAULT NULL,
  `numberOfLunchForTomorrow` int(11) DEFAULT NULL,
  `isTodayLunchRequired` varchar(10) DEFAULT NULL,
  `isTomorrowLunchRequired` varchar(10) DEFAULT NULL,
  `commentsToday` varchar(3000) DEFAULT NULL,
  `commentsTomorrow` varchar(3000) NOT NULL,
  `isPaymentDoneForToday` varchar(10) DEFAULT NULL,
  `paymentDueAmountToday` decimal(10,3) NOT NULL,
  `paymentClearedAmountToday` decimal(10,3) NOT NULL,
  `orderDateTime` datetime DEFAULT NULL,
  `userId` int(11) DEFAULT NULL,
  `menuId` int(200) NOT NULL,
  `deliveryAddress` varchar(50000) NOT NULL,
  `totalPriceToday` decimal(10,3) NOT NULL,
  `totalPriceTomorrow` decimal(10,3) NOT NULL,
  `todaysMenu` varchar(2000) NOT NULL,
  `tomorrowsMenu` varchar(2000) NOT NULL,
  `grandTotal` decimal(10,3) NOT NULL,
  `paymentDueAmountTomorrow` decimal(10,3) NOT NULL,
  `paymentClearedAmountTomorrow` decimal(10,3) NOT NULL,
  PRIMARY KEY (`orderId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ordertablenew`
--

CREATE TABLE IF NOT EXISTS `ordertablenew` (
  `orderid` int(11) NOT NULL AUTO_INCREMENT,
  `orderdate` datetime NOT NULL,
  `totalpaid` decimal(10,3) NOT NULL,
  `totaldue` decimal(10,3) NOT NULL,
  `totalorderprice` decimal(10,3) NOT NULL,
  `userid` int(11) NOT NULL,
  `address` varchar(3000) DEFAULT NULL,
  `orderstatus` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`orderid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `ordertablenew`
--

INSERT INTO `ordertablenew` (`orderid`, `orderdate`, `totalpaid`, `totaldue`, `totalorderprice`, `userid`, `address`, `orderstatus`) VALUES
(1, '2015-11-15 16:18:45', '0.000', '0.000', '7.000', 2, 'Name - Test, Email - test@gmail.com, Phone - 12121212121, Address Line 1 - k, Address Line 2 - k, City - k, State - k, Pin - k, Country - k', 'In progress'),
(2, '2015-11-15 16:25:33', '0.000', '0.000', '11.000', 1, 'Name - k, Email - k, Phone - k, Address Line 1 - k, Address Line 2 - k, City - k, State - k, Pin - k, Country - k', 'In progress'),
(3, '2015-11-15 16:48:47', '0.000', '0.000', '8.000', 1, 'Name - A, Email - A, Phone - 34, Address Line 1 - Y, Address Line 2 - T, City - U, State - I, Pin - 77, Country - E', 'In progress'),
(4, '2015-11-15 17:00:09', '0.000', '0.000', '25.000', 6, 'Name - abc, Email - , Phone - , Address Line 1 - , Address Line 2 - OB3, City - , State - , Pin - , Country - ', 'In progress'),
(5, '2015-11-17 00:12:30', '0.000', '0.000', '25.000', 1, 'Name - , Email - , Phone - , Address Line 1 - , Address Line 2 - , City - , State - , Pin - , Country - ', 'In progress'),
(6, '2015-11-18 20:53:50', '0.000', '0.000', '30.000', 6, 'Name - , Email - , Phone - , Address Line 1 - , Address Line 2 - , City - , State - , Pin - , Country - ', 'In progress'),
(7, '2015-11-19 00:10:07', '0.000', '0.000', '19.000', 6, 'Name - , Email - , Phone - , Address Line 1 - , Address Line 2 - , City - , State - , Pin - , Country - ', 'In progress'),
(8, '2015-11-21 06:53:03', '0.000', '0.000', '5.000', 7, 'Name - vb,mn, Email - ffhkgjhlltyu, Phone - gjb., Address Line 1 - vjhbjh, Address Line 2 - gjhgj, City - hgjhg, State - gjhglj, Pin - gghjl, Country - cvbkj', 'In progress'),
(9, '2015-12-08 01:48:18', '0.000', '0.000', '215.000', 8, 'Name - , Email - , Phone - , Address Line 1 - , Address Line 2 - , City - , State - , Pin - , Country - ', 'In progress'),
(10, '2015-12-10 14:23:11', '0.000', '0.000', '30.000', 10, 'Name - r, Email - r, Phone - 555, Address Line 1 - t, Address Line 2 - g, City - t, State - yy, Pin - 66, Country - gg', 'In progress');

-- --------------------------------------------------------

--
-- Table structure for table `usertable`
--

CREATE TABLE IF NOT EXISTS `usertable` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(200) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `emailId` varchar(200) DEFAULT NULL,
  `mobileNo` varchar(50) DEFAULT NULL,
  `dateOfRegistration` datetime DEFAULT NULL,
  `provider` varchar(10) NOT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `usertable`
--

INSERT INTO `usertable` (`userId`, `userName`, `password`, `emailId`, `mobileNo`, `dateOfRegistration`, `provider`) VALUES
(1, 'Laaptu Laaptu', 'laaptu', 'laaptulaaptu1@gmail.com', '111111111111', '2015-11-15 16:02:06', 'NO'),
(2, 'provider1', 'provider1', 'provider1@gmail.com', '2222222222222', '2015-11-15 16:13:52', 'YES'),
(3, 'Provider2', 'provider2', 'provider2@gmail.com', '33333333333', '2015-11-15 16:20:20', 'YES'),
(4, 'Test', 'test', 'abc@1234.com', 'iieieiere', '2015-11-15 16:48:59', 'YES'),
(5, 'Test', 'digamber', 'itsdiggu@gmail.com', '8165296965', '2015-11-15 16:49:44', 'YES'),
(6, 'Kiran', 'digamber', 'kiran1130@gmail.com', '6232516565', '2015-11-15 16:54:32', 'NO'),
(7, 'maddy', 'sambalpur9', 'mango@gmail.com', '1234567890', '2015-11-21 06:37:06', 'NO'),
(8, 'maddy', '12345678', 'madhuripandeyb1993@gmail.com', '9988776655', '2015-12-08 01:45:29', 'NO'),
(9, 'test2', 'test2', 'test2@gmail.com', '111111111111', '2015-12-10 14:19:40', 'YES'),
(10, 'cust1', 'cust1', 'cust1@gmail.com', '3333333333333333', '2015-12-10 14:21:17', 'NO');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
