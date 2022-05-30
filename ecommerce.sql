-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2022 at 11:49 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `ID` int(11) NOT NULL,
  `data` text NOT NULL,
  `Modified_At` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`ID`, `data`, `Modified_At`) VALUES
(1, '.<p>&nbsp;</p>\r\n\r\n<div class=\"row\">\r\n<div class=\"about-us col-sm-9\">\r\n<h1>&lt;h1&gt; display style&nbsp;</h1>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<h2>&lt;h2&gt; display style</h2>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>\r\n\r\n<div class=\"row\">\r\n<div class=\"col-sm-6\">\r\n<div class=\"img-block\"><img alt=\"\" src=\"http://localhost/ecommerce/admin_panel/assets/uploads/cms-img1.jpg\" /></div>\r\n\r\n<div class=\"content-block\">\r\n<h3>&lt;h3&gt; display style</h3>\r\n\r\n<ul>\r\n	<li>Listing 1</li>\r\n	<li>Listing 2</li>\r\n	<li>Listing 3</li>\r\n	<li>Listing 4</li>\r\n</ul>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-sm-6\">\r\n<div class=\"img-block\"><img alt=\"\" src=\"http://localhost/ecommerce/admin_panel/assets/uploads/cms-img2.jpg\" /></div>\r\n\r\n<div class=\"content-block\">\r\n<h3>&lt;h3&gt; display style</h3>\r\n\r\n<ul>\r\n	<li>Listing 1</li>\r\n	<li>Listing 2</li>\r\n	<li>Listing 3</li>\r\n	<li>Listing 4</li>\r\n</ul>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<h2>&lt;h2&gt; display style</h2>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>\r\n\r\n<div class=\"row\">\r\n<div class=\"col-sm-4\">\r\n<div class=\"img-block\"><img alt=\"\" src=\"http://localhost/ecommerce/admin_panel/assets/uploads/cms-img3.jpg\" /></div>\r\n\r\n<div class=\"text-block\">\r\n<h4>&lt;h4&gt; display style</h4>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor</p>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-sm-4\">\r\n<div class=\"img-block\"><img alt=\"\" src=\"http://localhost/ecommerce/admin_panel/assets/uploads/cms-img4.jpg\" /></div>\r\n\r\n<div class=\"text-block\">\r\n<h4>&lt;h4&gt; display style</h4>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor</p>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-sm-4\">\r\n<div class=\"img-block\"><img alt=\"\" src=\"http://localhost/ecommerce/admin_panel/assets/uploads/cms-img5.jpg\" /></div>\r\n\r\n<div class=\"text-block\">\r\n<h4>&lt;h4&gt; display style</h4>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor</p>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<h2>&lt;h2&gt; display style</h2>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>\r\n\r\n<div class=\"row\">\r\n<div class=\"col-sm-6\">\r\n<div class=\"img-block\"><img alt=\"\" src=\"http://localhost/ecommerce/admin_panel/assets/uploads/cms-img6.jpg\" /></div>\r\n\r\n<div class=\"content-block\">\r\n<h5>&lt;h5&gt; display style</h5>\r\n\r\n<ol>\r\n	<li>Listing 1</li>\r\n	<li>Listing 2</li>\r\n	<li>Listing 3</li>\r\n	<li>Listing 4</li>\r\n</ol>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-sm-6\">\r\n<div class=\"img-block\"><img alt=\"\" src=\"http://localhost/ecommerce/admin_panel/assets/uploads/cms-img7.jpg\" /></div>\r\n\r\n<div class=\"content-block\">\r\n<h6>&lt;h6&gt; display style</h6>\r\n\r\n<ol>\r\n	<li>Listing 1</li>\r\n	<li>Listing 2</li>\r\n	<li>Listing 3</li>\r\n	<li>Listing 4</li>\r\n</ol>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-sm-3\">\r\n<div class=\"promo-block\"><a href=\"product.html\" title=\"Promotion\"><img alt=\"promo1.jpg\" class=\"img-responsive\" src=\"http://localhost/ecommerce/admin_panel/assets/uploads/promo1.jpg\" /> </a></div>\r\n\r\n<div class=\"promo-block\"><a href=\"product.html\" title=\"Promotion\"><img alt=\"promo1.jpg\" class=\"img-responsive\" src=\"http://localhost/ecommerce/admin_panel/assets/uploads/promo2.jpg\" /> </a></div>\r\n</div>\r\n</div>\r\n\r\n<p>.</p>\r\n.', '2022-05-24 06:00:08');

-- --------------------------------------------------------

--
-- Table structure for table `admin_details`
--

CREATE TABLE `admin_details` (
  `ID` int(10) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Modified_at` datetime NOT NULL,
  `Created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_details`
--

INSERT INTO `admin_details` (`ID`, `UserName`, `Password`, `Email`, `Modified_at`, `Created_at`) VALUES
(1, 'Admin', '$2y$10$XdoEAwY0QqtxL.RyNqSOQ.I31QQVpR6HhKHnAKNyuc/6deOiSWsAW', 'admin@gmail.com', '2022-04-05 00:00:00', '2022-04-05 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `all_newsletter`
--

CREATE TABLE `all_newsletter` (
  `ID` int(11) NOT NULL,
  `Title` varchar(50) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Created_At` timestamp NOT NULL DEFAULT current_timestamp(),
  `Modified_At` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `all_newsletter`
--

INSERT INTO `all_newsletter` (`ID`, `Title`, `Description`, `Created_At`, `Modified_At`) VALUES
(1, 'About new arrival', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printe', '2022-05-23 09:43:54', '2022-05-23 09:43:54'),
(2, 'new product', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printe', '2022-05-23 10:00:44', '2022-05-23 10:00:44'),
(10, 'test', 'testing', '2022-05-27 05:26:20', '2022-05-27 05:26:20');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `ID` int(10) NOT NULL,
  `City` varchar(20) NOT NULL,
  `State_ID` int(10) NOT NULL,
  `Country_ID` int(10) NOT NULL,
  `Created_At` timestamp NOT NULL DEFAULT current_timestamp(),
  `Modified_At` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`ID`, `City`, `State_ID`, `Country_ID`, `Created_At`, `Modified_At`) VALUES
(1, 'AHMEDABAD', 1, 1, '2022-04-08 09:05:38', '2022-04-13 04:47:38'),
(6, 'SULTANPUR', 3, 1, '2022-04-12 05:38:48', '2022-04-12 05:38:48'),
(7, 'texas', 8, 4, '2022-05-02 10:51:29', '2022-05-02 10:51:29'),
(8, 'janakpur', 7, 2, '2022-05-02 10:52:00', '2022-05-02 10:52:00');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Subject` varchar(255) NOT NULL,
  `Message` varchar(255) NOT NULL,
  `Reply` varchar(255) NOT NULL,
  `Created_At` timestamp NOT NULL DEFAULT current_timestamp(),
  `Modified_At` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`ID`, `Name`, `Email`, `Subject`, `Message`, `Reply`, `Created_At`, `Modified_At`) VALUES
(1, 'kenil', 'jay@yopmail.com', 'abc', 'change ui', 'change successfully', '2022-05-13 05:44:29', '2022-05-13 07:09:56'),
(2, 'kenil', 'abcd@yopmail.com', 'change abc', 'change abc', 'ok', '2022-05-17 07:14:38', '2022-05-23 13:47:09'),
(3, 'kps', 'kenil@yopmail.com', 'ok', 'ok', '', '2022-05-17 07:17:42', '2022-05-17 07:17:42'),
(6, 'kenil', 'devarsh@yopmail.com', 'check data', 'add data', '', '2022-05-24 11:55:05', '2022-05-24 11:55:05'),
(7, 'kenil', 'devarsh@yopmail.com', 'check data', 'add data', '', '2022-05-24 11:55:05', '2022-05-24 11:55:05'),
(8, 'kenil', 'kenil@yopmail.com', 'mail', 'packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (in', 'ok', '2022-05-25 13:10:44', '2022-05-25 13:12:31');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `ID` int(10) NOT NULL,
  `Country` varchar(20) NOT NULL,
  `IsActive` int(2) NOT NULL,
  `Created_At` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Modified_At` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`ID`, `Country`, `IsActive`, `Created_At`, `Modified_At`) VALUES
(1, 'INDIA', 0, '2022-04-13 04:41:24', '2022-04-13 04:41:24'),
(2, 'NEPAL', 0, '2022-04-08 11:49:14', '2022-04-08 11:49:14'),
(4, 'USA', 0, '2022-04-12 05:09:00', '2022-04-11 06:31:55'),
(6, 'CHINA', 0, '2022-05-16 10:59:28', '2022-05-16 10:59:28');

-- --------------------------------------------------------

--
-- Table structure for table `forgot_password`
--

CREATE TABLE `forgot_password` (
  `ID` int(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `OTP` int(11) NOT NULL,
  `IsExpire` int(11) NOT NULL,
  `Created_At` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forgot_password`
--

INSERT INTO `forgot_password` (`ID`, `Email`, `OTP`, `IsExpire`, `Created_At`) VALUES
(1, 'jay@yopmail.com', 10181, 1, '2022-05-17 09:37:54'),
(2, 'jay@yopmail.com', 20306, 1, '2022-05-17 10:00:01'),
(6, 'jay@yopmail.com', 66206, 1, '2022-05-17 12:03:43'),
(10, 'jay@yopmail.com', 24731, 1, '2022-05-17 14:26:16'),
(18, 'jay@yopmail.com', 61093, 1, '2022-05-20 13:38:03'),
(19, 'jay@yopmail.com', 95291, 1, '2022-05-20 13:52:24'),
(28, 'jay@yopmail.com', 82890, 1, '2022-05-24 06:31:11'),
(29, 'jay@yopmail.com', 29078, 1, '2022-05-24 06:32:19'),
(30, 'jay@yopmail.com', 34824, 1, '2022-05-24 06:32:51'),
(31, 'jay@yopmail.com', 37283, 1, '2022-05-24 06:35:25'),
(32, 'jay@yopmail.com', 56685, 1, '2022-05-24 06:36:37'),
(33, 'jay@yopmail.com', 69218, 1, '2022-05-24 06:37:51'),
(34, 'jay@yopmail.com', 37491, 1, '2022-05-24 06:45:14'),
(35, 'jay@yopmail.com', 80330, 1, '2022-05-24 08:11:58'),
(36, 'jay@yopmail.com', 90480, 1, '2022-05-25 13:18:19');

-- --------------------------------------------------------

--
-- Table structure for table `order_address`
--

CREATE TABLE `order_address` (
  `ID` int(11) NOT NULL,
  `Order_ID` int(11) NOT NULL,
  `Street_Name` varchar(255) NOT NULL,
  `City_ID` int(11) NOT NULL,
  `State_ID` int(11) NOT NULL,
  `Country_ID` int(11) NOT NULL,
  `Created_At` timestamp NOT NULL DEFAULT current_timestamp(),
  `Modified_At` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `ID` int(11) NOT NULL,
  `Order_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Product_ID` varchar(100) NOT NULL,
  `Quantity` varchar(100) NOT NULL,
  `Color` varchar(100) NOT NULL,
  `Size` varchar(100) NOT NULL,
  `Total` float NOT NULL,
  `Payment_ID` varchar(255) NOT NULL,
  `Status` int(11) NOT NULL COMMENT '1 for pending 2 for complete',
  `Created_At` timestamp NOT NULL DEFAULT current_timestamp(),
  `Modified_At` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`ID`, `Order_ID`, `User_ID`, `Product_ID`, `Quantity`, `Color`, `Size`, `Total`, `Payment_ID`, `Status`, `Created_At`, `Modified_At`) VALUES
(5, 36210, 36, '39,38', '1,2', '7,3', '6,1', 5066.04, 'pi_3KzzyWSJ5Q50OIO50FbhOV6b', 2, '2021-05-16 09:13:05', '2022-05-16 09:13:05'),
(7, 49652, 36, '31,27', '1,1', '3,2', '1,6', 2962.59, 'pi_3L001PSJ5Q50OIO50O9OYkzE', 1, '2022-04-18 09:15:55', '2022-05-16 09:15:55'),
(9, 56883, 36, '31,40', '1,1', '3,2', '1,1', 4149.18, 'pi_3L005tSJ5Q50OIO51nHR7OOc', 1, '2022-05-16 09:20:38', '2022-05-16 09:20:38'),
(12, 77367, 36, '27', '1', '2', '6', 1616.16, 'pi_3L0I8XSJ5Q50OIO50WKROpv2', 1, '2022-05-17 04:36:37', '2022-05-17 04:36:37'),
(13, 23392, 36, '27,40', '2,1', '2,2', '6,1', 6035.07, 'pi_3L1SbPSJ5Q50OIO50mNyzUOh', 1, '2022-05-20 09:59:10', '2022-05-20 09:59:10'),
(15, 12375, 36, '25', '2', '2', '6', 11100, 'pi_3L1Sm8SJ5Q50OIO50TVtMErR', 1, '2022-05-20 10:10:11', '2022-05-20 10:10:11'),
(34, 92941, 36, '25,31', '1,1', '2,3', '6,1', 6896.43, 'pi_3L1Up6SJ5Q50OIO51RuotLXi', 1, '2022-05-20 12:21:18', '2022-05-20 12:21:18'),
(39, 43621, 36, '41', '1', '3', '6', 2804.97, 'pi_3L2S5iSJ5Q50OIO50V6wVvvu', 1, '2022-05-23 03:38:38', '2022-05-23 03:38:38'),
(40, 19787, 36, '31,40', '1,1', '3,2', '1,1', 3734.27, 'pi_3L3K7cSJ5Q50OIO51hTpvWtI', 1, '2022-05-25 13:21:01', '2022-05-25 13:21:01'),
(41, 84715, 36, '53', '1', '3', '1', 1110, 'pi_3L4JQXSJ5Q50OIO50nux7NdJ', 1, '2022-05-28 06:47:38', '2022-05-28 06:47:38'),
(42, 82719, 36, '40,41', '2,3', '2,3', '1,6', 14020.4, 'pi_3L4JTvSJ5Q50OIO51zOWEseL', 1, '2022-05-28 06:51:07', '2022-05-28 06:51:07'),
(43, 90966, 36, '40,41', '2,3', '2,3', '6,6', 14020.4, 'pi_3L4JZqSJ5Q50OIO51lwjil4L', 1, '2022-05-28 06:57:15', '2022-05-28 06:57:15'),
(44, 89032, 36, '40,41', '2,3', '2,3', '1,6', 14020.4, 'pi_3L4JdWSJ5Q50OIO50kACOQJH', 1, '2022-05-28 07:00:58', '2022-05-28 07:00:58');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ID` int(10) NOT NULL,
  `Product_Name` varchar(100) NOT NULL,
  `Product_Description` varchar(255) NOT NULL,
  `Product_Price` int(10) NOT NULL,
  `Product_Quantity` int(10) NOT NULL,
  `Product_Color_ID` varchar(10) NOT NULL,
  `IsTrending` int(2) DEFAULT NULL,
  `Product_Size` varchar(10) NOT NULL,
  `Category_ID` int(10) NOT NULL,
  `Subcategory_ID` int(10) NOT NULL,
  `SKU` varchar(50) DEFAULT NULL,
  `Created_At` timestamp NOT NULL DEFAULT current_timestamp(),
  `Modified_At` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ID`, `Product_Name`, `Product_Description`, `Product_Price`, `Product_Quantity`, `Product_Color_ID`, `IsTrending`, `Product_Size`, `Category_ID`, `Subcategory_ID`, `SKU`, `Created_At`, `Modified_At`) VALUES
(23, 'Boys\' Cotton Track Pant', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected', 1000, 1, '7', 0, '1', 53, 14, NULL, '2022-04-13 06:51:01', '2022-04-25 07:33:44'),
(24, ' Symbol Men\'s Regular Shirt', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected', 2000, 2, '3', 1, '1', 9, 4, NULL, '2022-04-13 06:54:28', '2022-04-25 09:03:50'),
(25, ' Womens Solid Bodycon Black Dress', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected', 5000, 11, '2', 1, '6', 10, 6, NULL, '2022-04-13 07:38:58', '2022-04-13 07:38:58'),
(26, 'accessories wallet', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected', 2556, 12, '3', 0, '1', 69, 15, NULL, '2022-04-18 09:45:08', '2022-04-18 09:45:08'),
(27, 'Men\'s Slim Casual Shirt', 'packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (in', 1456, 12, '2', 1, '6', 9, 4, NULL, '2022-04-19 03:44:38', '2022-05-28 08:24:40'),
(28, 'Men\'s Regular Fit T-Shirt', 'packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (in', 2554, 14, '3', 0, '1', 9, 12, NULL, '2022-04-19 03:52:40', '2022-05-28 08:21:08'),
(29, 'Ben Martin Men\'s Relaxed Jeans', 'packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (in', 4444, 44, '2', 0, '1', 9, 16, NULL, '2022-04-19 03:52:40', '2022-04-19 03:52:40'),
(30, 'Diverse Men\'s Regular Formal Shirt', 'packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (in', 1212, 11, '2', 0, '1', 9, 4, NULL, '2022-04-19 03:52:40', '2022-04-19 03:52:40'),
(31, 'Men\'s Cotton Casual Shirt for Men', 'packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (in', 1213, 22, '2', 1, '1', 9, 4, NULL, '2022-04-19 03:52:40', '2022-05-28 08:22:00'),
(32, 'Men\'s Printed Cotton Formal Shirt', 'packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (in', 2121, 11, '2', 0, '1', 9, 4, NULL, '2022-04-19 03:52:40', '2022-05-28 08:22:28'),
(33, 'Men\'s Classic Collar Cotton Shirt', 'packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (in', 2131, 12, '2', 1, '6', 9, 4, NULL, '2022-04-19 03:52:40', '2022-05-28 08:25:33'),
(34, 'Women\'s Fit and Flare Mini Dress', 'packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (in', 2154, 12, '7', 0, '1', 10, 6, NULL, '2022-04-19 03:52:40', '2022-05-28 08:23:58'),
(35, 'Women\'s  A-Line Midi Dress', 'packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (in', 2563, 12, '3', 0, '1', 10, 6, NULL, '2022-04-19 03:52:40', '2022-05-28 08:31:11'),
(36, 'Women\'s Cotton Straight Kurta', 'packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (in', 1232, 12, '2', 1, '1', 10, 18, NULL, '2022-04-19 03:52:40', '2022-05-28 08:23:38'),
(37, 'Women\'s Pure Cotton Printed Kurti', 'packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (in', 2563, 21, '3', 0, '6', 10, 18, NULL, '2022-04-19 03:52:40', '2022-05-28 08:22:49'),
(38, 'Women\'s Denim Dress', 'packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (in', 1000, 12, '7', 1, '6', 10, 6, NULL, '2022-04-19 03:56:28', '2022-05-28 08:21:18'),
(39, 'Women Kurta With Print Design', 'packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (in', 2564, 11, '7', 0, '6', 10, 18, NULL, '2022-04-19 03:56:28', '2022-04-19 03:56:28'),
(40, 'Men Denim Jackets', 'packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (in', 2525, 55, '2,3,7', 1, '1,6', 9, 17, NULL, '2022-04-19 04:03:34', '2022-04-19 04:03:34'),
(41, 'Men Biker Jacket ', 'packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (in', 2527, 11, '3', 1, '6', 9, 17, NULL, '2022-04-19 04:03:34', '2022-04-19 04:03:34'),
(53, 'Men\'s Regular Fit T-Shirt', 'The product will be an excellent pick for you. It ensures an easy maintenance.', 1000, 1, '3', 0, '1', 9, 12, NULL, '2022-05-13 11:20:35', '2022-05-13 11:20:35'),
(55, 'Women Kruta New', 'Packages And Web Page Editors Now Use Lorem Ipsum As Their Default Model Text, And A Search For \'Lorem Ipsum\' Will Uncover Many Web Sites Still In Their Infancy. Various Versions Have Evolved Over The Years, Sometimes By Accident, Sometimes On Purpose (In', 2234, 222, '3', 0, '1', 10, 18, NULL, '2022-05-28 08:30:25', '2022-05-28 08:30:25');

-- --------------------------------------------------------

--
-- Table structure for table `product_cart`
--

CREATE TABLE `product_cart` (
  `ID` int(11) NOT NULL,
  `Product_ID` int(11) NOT NULL,
  `Product_Name` varchar(255) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Unit_Price` int(11) NOT NULL,
  `Color_ID` int(11) NOT NULL,
  `Size_ID` int(11) NOT NULL,
  `Product_Image` varchar(255) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Total_Amount` int(11) NOT NULL,
  `Created_At` timestamp NOT NULL DEFAULT current_timestamp(),
  `Modified_At` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_cart`
--

INSERT INTO `product_cart` (`ID`, `Product_ID`, `Product_Name`, `Quantity`, `Unit_Price`, `Color_ID`, `Size_ID`, `Product_Image`, `User_ID`, `Total_Amount`, `Created_At`, `Modified_At`) VALUES
(135, 39, 'product 22 women tshirt', 1, 2564, 7, 6, '1945108369.jpg', 1, 2564, '2022-05-25 03:49:49', '2022-05-25 03:49:49'),
(173, 53, 'Men\'s Regular Fit T-Shirt', 1, 1000, 3, 1, '155455116.jpg', 36, 1000, '2022-05-30 04:10:27', '2022-05-30 04:10:27'),
(174, 40, 'Men Denim Jackets', 2, 2525, 2, 1, '1945108370.jpg', 36, 5050, '2022-05-30 04:25:59', '2022-05-30 05:57:57');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `ID` int(11) NOT NULL,
  `Category_Name` varchar(255) NOT NULL,
  `Category_desc` varchar(255) NOT NULL,
  `Created_At` timestamp NOT NULL DEFAULT current_timestamp(),
  `Modified_At` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`ID`, `Category_Name`, `Category_desc`, `Created_At`, `Modified_At`) VALUES
(9, 'MEN', 'abcdd', '2022-04-07 15:33:33', '2022-04-15 14:02:46'),
(10, 'WOMEN', 'efg', '2022-04-07 15:33:41', '2022-04-15 14:02:52'),
(53, 'KIDS', 'hij', '2022-04-08 06:25:55', '2022-04-15 14:02:57'),
(69, 'ACCESSORIES', 'aa', '2022-04-15 04:09:16', '2022-04-15 04:09:16');

-- --------------------------------------------------------

--
-- Table structure for table `product_color`
--

CREATE TABLE `product_color` (
  `ID` int(10) NOT NULL,
  `Product_Color` varchar(255) NOT NULL,
  `Color_Code` varchar(25) NOT NULL,
  `Created_At` timestamp NOT NULL DEFAULT current_timestamp(),
  `Modified_At` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_color`
--

INSERT INTO `product_color` (`ID`, `Product_Color`, `Color_Code`, `Created_At`, `Modified_At`) VALUES
(2, 'PINK', '#fb09e7', '2022-04-09 05:57:48', '2022-04-13 04:35:35'),
(3, 'BLUE', '#2a5ccf', '2022-04-11 06:29:04', '2022-04-11 06:29:04'),
(7, 'RED', '#ff0000', '2022-04-18 05:50:45', '2022-04-18 05:50:45');

-- --------------------------------------------------------

--
-- Table structure for table `product_coupan`
--

CREATE TABLE `product_coupan` (
  `ID` int(11) NOT NULL,
  `Stripe_ID` varchar(255) NOT NULL,
  `Coupan_ID` varchar(255) NOT NULL,
  `Discount` varchar(255) NOT NULL,
  `Created_At` date NOT NULL DEFAULT current_timestamp(),
  `Expiry` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_coupan`
--

INSERT INTO `product_coupan` (`ID`, `Stripe_ID`, `Coupan_ID`, `Discount`, `Created_At`, `Expiry`) VALUES
(7, '3DhCSVy6', 'H3H0G7VE', '10', '2022-05-13', '2022-07-13');

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE `product_image` (
  `ID` int(11) NOT NULL,
  `Product_ID` int(11) NOT NULL,
  `Image_Path` varchar(255) NOT NULL,
  `Created_At` timestamp NOT NULL DEFAULT current_timestamp(),
  `Modified_At` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`ID`, `Product_ID`, `Image_Path`, `Created_At`, `Modified_At`) VALUES
(26, 24, '1945108353.jpg', '2022-04-13 06:54:28', '2022-04-13 06:54:28'),
(33, 25, '1945108354.jpg', '2022-04-13 07:38:58', '2022-04-13 07:38:58'),
(34, 25, '1945108355.jpg', '2022-04-13 07:44:58', '2022-04-13 07:44:58'),
(38, 26, '1945108356.jpg', '2022-04-22 04:05:58', '2022-04-22 04:05:58'),
(39, 27, '1945108370.jpg', '2022-04-22 04:05:58', '2022-04-22 04:05:58'),
(40, 28, '1945108358.jpg', '2022-04-22 04:05:58', '2022-04-22 04:05:58'),
(41, 29, '1945108359.jpg', '2022-04-22 04:05:58', '2022-04-22 04:05:58'),
(42, 30, '1945108360.jpg', '2022-04-22 04:05:58', '2022-04-22 04:05:58'),
(43, 31, '1945108361.jpg', '2022-04-22 04:05:58', '2022-04-22 04:05:58'),
(44, 32, '1945108371.jpg', '2022-04-22 04:05:58', '2022-04-22 04:05:58'),
(45, 33, '1956705689.jpg', '2022-04-22 04:05:58', '2022-04-22 04:05:58'),
(46, 34, '1945108364.jpg', '2022-04-22 04:05:58', '2022-04-22 04:05:58'),
(47, 35, '1945108365.jpg', '2022-04-22 04:05:58', '2022-04-22 04:05:58'),
(48, 36, '1945108366.jpg', '2022-04-22 04:05:58', '2022-04-22 04:05:58'),
(49, 37, '1945108367.jpg', '2022-04-22 04:05:58', '2022-04-22 04:05:58'),
(50, 38, '1945108368.jpg', '2022-04-22 04:05:58', '2022-04-22 04:05:58'),
(51, 39, '1945108369.jpg', '2022-04-22 04:05:58', '2022-04-22 04:05:58'),
(52, 40, '1562564789.jpg', '2022-04-22 04:05:58', '2022-04-22 04:05:58'),
(53, 41, '5678956596.jpg', '2022-04-22 04:06:15', '2022-04-22 04:06:15'),
(61, 24, '1667808863.jpg', '2022-04-23 11:56:17', '2022-04-23 11:56:17'),
(62, 31, '1768152966.jpg', '2022-04-25 06:00:03', '2022-04-25 06:00:03'),
(70, 23, '345592999.jpg', '2022-04-25 07:33:44', '2022-04-25 07:33:44'),
(71, 24, '1036872047.jpg', '2022-04-25 09:03:49', '2022-04-25 09:03:49'),
(72, 24, '1012979694.jpg', '2022-04-25 09:03:50', '2022-04-25 09:03:50'),
(83, 53, '155455116.jpg', '2022-05-13 11:20:35', '2022-05-13 11:20:35'),
(85, 55, '1597771984.jpg', '2022-05-28 08:30:25', '2022-05-28 08:30:25');

-- --------------------------------------------------------

--
-- Table structure for table `product_review`
--

CREATE TABLE `product_review` (
  `ID` int(11) NOT NULL,
  `Product_ID` int(11) NOT NULL,
  `IsApprove` int(2) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Product_Rate` int(11) NOT NULL,
  `Product_Review` varchar(255) NOT NULL,
  `Created_At` timestamp NULL DEFAULT current_timestamp(),
  `Modified_At` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_review`
--

INSERT INTO `product_review` (`ID`, `Product_ID`, `IsApprove`, `User_ID`, `Product_Rate`, `Product_Review`, `Created_At`, `Modified_At`) VALUES
(60, 27, 1, 1, 2, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor', '2022-05-20 07:17:49', '2022-05-20 07:17:49'),
(70, 27, 1, 36, 3, 'addd', '2022-05-20 09:55:00', '2022-05-20 09:55:00'),
(71, 36, 1, 36, 4, 'nice product', '2022-05-24 04:06:21', '2022-05-24 04:06:21'),
(72, 36, 1, 1, 3, 'ewewewew', '2022-05-24 09:52:03', '2022-05-24 09:52:03'),
(73, 27, 1, 2, 3, 'ok good', '2022-05-26 08:38:51', '2022-05-26 08:38:51'),
(74, 36, 1, 36, 3, 'nice service', '2022-05-26 12:40:18', '2022-05-26 12:40:18'),
(75, 36, 1, 36, 5, 'fweerwrw', '2022-05-26 12:42:28', '2022-05-26 12:42:28'),
(76, 27, 1, 36, 3, 'ant ', '2022-05-27 10:54:16', '2022-05-27 10:54:16');

-- --------------------------------------------------------

--
-- Table structure for table `product_size`
--

CREATE TABLE `product_size` (
  `ID` int(10) NOT NULL,
  `Product_Size` varchar(255) NOT NULL,
  `Created_At` timestamp NOT NULL DEFAULT current_timestamp(),
  `Modified_At` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_size`
--

INSERT INTO `product_size` (`ID`, `Product_Size`, `Created_At`, `Modified_At`) VALUES
(1, 'M', '2022-04-09 06:25:10', '2022-04-13 04:38:17'),
(6, 'XL', '2022-04-13 06:52:51', '2022-04-13 06:52:51');

-- --------------------------------------------------------

--
-- Table structure for table `product_subcategory`
--

CREATE TABLE `product_subcategory` (
  `ID` int(10) NOT NULL,
  `Category_ID` int(10) NOT NULL,
  `Subcategory_Name` varchar(255) NOT NULL,
  `Subcategory_desc` varchar(255) NOT NULL,
  `Created_At` timestamp NOT NULL DEFAULT current_timestamp(),
  `Modified_At` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_subcategory`
--

INSERT INTO `product_subcategory` (`ID`, `Category_ID`, `Subcategory_Name`, `Subcategory_desc`, `Created_At`, `Modified_At`) VALUES
(4, 9, 'Shirt', 'bg', '2022-04-08 08:32:02', '2022-05-23 07:27:01'),
(6, 10, 'Dress', 'dd', '2022-04-08 10:43:18', '2022-05-23 07:30:32'),
(12, 9, 'Tshirt', 'abcd', '2022-04-12 05:50:25', '2022-05-23 07:27:28'),
(14, 53, 'Track', 'aws', '2022-04-15 04:18:06', '2022-05-23 07:34:18'),
(15, 69, 'WALLET', 'Abc', '2022-04-15 04:23:43', '2022-04-15 04:23:43'),
(16, 9, 'Jeans', 'aa', '2022-04-18 14:42:41', '2022-05-23 07:28:53'),
(17, 9, 'Jacket', 'dd', '2022-04-18 14:43:53', '2022-05-23 07:29:03'),
(18, 10, 'Kurta', 'aa', '2022-04-18 14:44:26', '2022-05-23 07:32:12');

-- --------------------------------------------------------

--
-- Table structure for table `product_wishlist`
--

CREATE TABLE `product_wishlist` (
  `ID` int(11) NOT NULL,
  `Product_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Created_At` timestamp NOT NULL DEFAULT current_timestamp(),
  `Modified_At` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_wishlist`
--

INSERT INTO `product_wishlist` (`ID`, `Product_ID`, `User_ID`, `Created_At`, `Modified_At`) VALUES
(76, 27, 36, '2022-05-16 14:06:07', '2022-05-16 14:06:07'),
(82, 26, 36, '2022-05-24 03:50:29', '2022-05-24 03:50:29'),
(88, 31, 36, '2022-05-24 04:03:04', '2022-05-24 04:03:04'),
(89, 53, 36, '2022-05-27 13:57:13', '2022-05-27 13:57:13');

-- --------------------------------------------------------

--
-- Table structure for table `service_tax`
--

CREATE TABLE `service_tax` (
  `ID` int(11) NOT NULL,
  `Country_ID` int(11) NOT NULL,
  `State_ID` int(11) NOT NULL,
  `tax_percent` float NOT NULL,
  `tax_stripe` varchar(255) NOT NULL,
  `Created_At` timestamp NOT NULL DEFAULT current_timestamp(),
  `Modified_At` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service_tax`
--

INSERT INTO `service_tax` (`ID`, `Country_ID`, `State_ID`, `tax_percent`, `tax_stripe`, `Created_At`, `Modified_At`) VALUES
(7, 1, 1, 11, 'txr_1KyzJVSJ5Q50OIO5yuJWENON', '2022-05-13 14:17:53', '2022-05-13 14:17:53'),
(8, 4, 8, 5, 'txr_1KyzoNSJ5Q50OIO5vl0QmoDG', '2022-05-13 14:49:47', '2022-05-13 14:49:47'),
(9, 1, 3, 6, 'txr_1KyzwnSJ5Q50OIO55i5N16L3', '2022-05-13 14:58:29', '2022-05-13 14:58:29');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `ID` int(11) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Image_Path` varchar(255) NOT NULL,
  `Created_At` timestamp NOT NULL DEFAULT current_timestamp(),
  `Modified_At` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`ID`, `Description`, `Image_Path`, `Created_At`, `Modified_At`) VALUES
(14, 'test1', '1404612648.jpg', '2022-05-11 06:32:12', '2022-05-11 06:32:12'),
(15, 'test2', '1333605579.jpg', '2022-05-11 06:32:25', '2022-05-11 06:32:25'),
(16, 'test3', '138529224.jpg', '2022-05-11 06:33:45', '2022-05-11 06:33:45');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `ID` int(11) NOT NULL,
  `Country_ID` int(10) NOT NULL,
  `State` varchar(20) NOT NULL,
  `Created_At` timestamp NOT NULL DEFAULT current_timestamp(),
  `Modified_At` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`ID`, `Country_ID`, `State`, `Created_At`, `Modified_At`) VALUES
(1, 1, 'GUJARAT', '2022-04-08 09:03:52', '2022-04-13 04:44:39'),
(3, 1, 'DELHI', '2022-04-08 12:42:46', '2022-04-08 12:42:46'),
(7, 2, 'JANAKPUR', '2022-04-12 05:09:47', '2022-04-12 05:09:47'),
(8, 4, 'TEXAS', '2022-04-12 05:10:18', '2022-04-12 05:10:18');

-- --------------------------------------------------------

--
-- Table structure for table `testimonial`
--

CREATE TABLE `testimonial` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Designation` varchar(255) NOT NULL,
  `Image_Path` varchar(255) NOT NULL,
  `Created_At` timestamp NOT NULL DEFAULT current_timestamp(),
  `Modified_At` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `testimonial`
--

INSERT INTO `testimonial` (`ID`, `Name`, `Description`, `Designation`, `Image_Path`, `Created_At`, `Modified_At`) VALUES
(1, 'Taksh Patel', 'lorem ipsum suffered alteration in aome from, by injected humor , or randomized words which don\'t look even slightly believable.There are many varation of passenger randomized words which don\'t look even slightly believable', 'Developer', '1541427429.jpg', '2022-05-12 05:22:53', '2022-05-12 06:39:06'),
(3, 'John Clay', 'lorem ipsum suffered alteration in aome from, by injected humor , or randomized words which don\'t look even slightly believable.There are many varation of passenger randomized words which don\'t look even slightly believable', 'Cyclist', '947350655.jpg', '2022-05-12 06:49:23', '2022-05-26 07:02:09'),
(4, 'Akash Patel', 'lorem ipsum suffered alteration in aome from, by injected humor , or randomized words which don\'t look even slightly believable.There are many varation of passenger randomized words which don\'t look even slightly believable', 'Doctor', '1256322501.jpg', '2022-05-17 06:41:04', '2022-05-17 06:41:04');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(10) NOT NULL,
  `UserName` varchar(20) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Gender` enum('M','F') NOT NULL,
  `Phone` varchar(12) NOT NULL,
  `Mobile` varchar(12) NOT NULL,
  `Intrest` varchar(50) DEFAULT NULL,
  `Created_At` datetime NOT NULL,
  `Modified_At` datetime NOT NULL,
  `Status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `UserName`, `FirstName`, `LastName`, `Email`, `Password`, `Gender`, `Phone`, `Mobile`, `Intrest`, `Created_At`, `Modified_At`, `Status`) VALUES
(1, 'kps', 'test1', 'soni', 'abcss@gmail.com', 'an7oiltGds/I9oXIguqGAw==', 'M', '11111111', '11111111', NULL, '2022-04-13 12:00:00', '2022-04-13 12:00:00', 1),
(2, 'aaa', 'test2', 'soni', 'abc@gmail.com', 'an7oiltGds/I9oXIguqGAw==', 'M', '1111111111', '5478965478', NULL, '2022-04-13 12:00:00', '2022-04-13 12:00:00', 1),
(35, 'kenilll', 'test3', 'soni', 'andd@gmskf.vom', 'an7oiltGds/I9oXIguqGAw==', 'M', '3333333333', '2323232323', 'NULL', '2022-04-25 10:05:34', '2022-04-25 10:05:34', 1),
(36, 'kenil', 'kenil', 'soni', 'jay@yopmail.com', 'an7oiltGds/I9oXIguqGAw==', 'F', '2222222223', '5555555555', 'NULL', '2022-04-28 12:25:15', '2022-05-25 18:49:01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_address`
--

CREATE TABLE `user_address` (
  `ID` int(10) NOT NULL,
  `User_ID` int(10) NOT NULL,
  `Street` varchar(50) NOT NULL,
  `Country_ID` int(10) NOT NULL,
  `State_ID` int(10) NOT NULL,
  `City_ID` int(10) NOT NULL,
  `Address_Type` enum('Billing','Shipping') NOT NULL,
  `Created_At` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_address`
--

INSERT INTO `user_address` (`ID`, `User_ID`, `Street`, `Country_ID`, `State_ID`, `City_ID`, `Address_Type`, `Created_At`) VALUES
(1, 1, 'abc', 1, 1, 1, 'Shipping', '2022-04-12 13:12:44'),
(2, 2, 'abcdef', 1, 1, 1, 'Billing', '2022-04-08 10:33:17'),
(3, 1, 'fgh', 1, 3, 6, 'Billing', '2022-04-13 05:05:51'),
(4, 36, 'testbill', 4, 8, 7, 'Billing', '2022-05-03 05:15:44'),
(5, 36, 'testship', 1, 1, 1, 'Shipping', '2022-05-27 07:01:31'),
(10, 35, 'abcd', 1, 1, 1, 'Shipping', '2022-05-02 16:26:06'),
(11, 35, 'abcd', 1, 1, 1, 'Billing', '2022-05-02 16:31:32'),
(12, 2, 'ship2', 1, 1, 1, 'Shipping', '2022-05-03 04:09:30');

-- --------------------------------------------------------

--
-- Table structure for table `user_newsletter`
--

CREATE TABLE `user_newsletter` (
  `ID` int(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Created_At` timestamp NOT NULL DEFAULT current_timestamp(),
  `Modified_At` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_newsletter`
--

INSERT INTO `user_newsletter` (`ID`, `Email`, `Created_At`, `Modified_At`) VALUES
(1, 'jay@yopmail.com', '2022-05-23 09:44:19', '2022-05-23 09:44:19'),
(2, 'kenil@yopmail.com', '2022-05-23 09:44:31', '2022-05-23 09:44:31'),
(5, 'taksh@yopmail.com', '2022-05-23 12:45:09', '2022-05-23 12:45:09'),
(6, 'devarsh@yopmail.com', '2022-05-23 12:46:04', '2022-05-23 12:46:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `admin_details`
--
ALTER TABLE `admin_details`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `all_newsletter`
--
ALTER TABLE `all_newsletter`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `city_ibfk_1` (`State_ID`),
  ADD KEY `Country_ID` (`Country_ID`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `forgot_password`
--
ALTER TABLE `forgot_password`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `order_address`
--
ALTER TABLE `order_address`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `City_ID` (`City_ID`),
  ADD KEY `Country_ID` (`Country_ID`),
  ADD KEY `State_ID` (`State_ID`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `User_ID` (`User_ID`),
  ADD KEY `Product_ID` (`Product_ID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `product_ibfk_1` (`Category_ID`),
  ADD KEY `product_ibfk_2` (`Subcategory_ID`),
  ADD KEY `product_ibfk_3` (`Product_Color_ID`),
  ADD KEY `product_ibfk_4` (`Product_Size`);

--
-- Indexes for table `product_cart`
--
ALTER TABLE `product_cart`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `product_cart_ibfk_1` (`Color_ID`),
  ADD KEY `product_cart_ibfk_2` (`Size_ID`),
  ADD KEY `product_cart_ibfk_3` (`Product_ID`),
  ADD KEY `product_cart_ibfk_4` (`User_ID`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `product_color`
--
ALTER TABLE `product_color`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `product_coupan`
--
ALTER TABLE `product_coupan`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `product_image_ibfk_1` (`Product_ID`);

--
-- Indexes for table `product_review`
--
ALTER TABLE `product_review`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Product_ID` (`Product_ID`),
  ADD KEY `User_ID` (`User_ID`);

--
-- Indexes for table `product_size`
--
ALTER TABLE `product_size`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `product_subcategory`
--
ALTER TABLE `product_subcategory`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `product_subcategory_ibfk_1` (`Category_ID`);

--
-- Indexes for table `product_wishlist`
--
ALTER TABLE `product_wishlist`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Product_ID` (`Product_ID`),
  ADD KEY `User_ID` (`User_ID`);

--
-- Indexes for table `service_tax`
--
ALTER TABLE `service_tax`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `service_tax_ibfk_1` (`Country_ID`),
  ADD KEY `service_tax_ibfk_2` (`State_ID`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Country_ID` (`Country_ID`);

--
-- Indexes for table `testimonial`
--
ALTER TABLE `testimonial`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user_address`
--
ALTER TABLE `user_address`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `user_address_ibfk_1` (`User_ID`),
  ADD KEY `Country_ID` (`Country_ID`),
  ADD KEY `State_ID` (`State_ID`),
  ADD KEY `City_ID` (`City_ID`);

--
-- Indexes for table `user_newsletter`
--
ALTER TABLE `user_newsletter`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_details`
--
ALTER TABLE `admin_details`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `all_newsletter`
--
ALTER TABLE `all_newsletter`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `forgot_password`
--
ALTER TABLE `forgot_password`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `order_address`
--
ALTER TABLE `order_address`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `product_cart`
--
ALTER TABLE `product_cart`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `product_color`
--
ALTER TABLE `product_color`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_coupan`
--
ALTER TABLE `product_coupan`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product_image`
--
ALTER TABLE `product_image`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `product_review`
--
ALTER TABLE `product_review`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `product_size`
--
ALTER TABLE `product_size`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_subcategory`
--
ALTER TABLE `product_subcategory`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `product_wishlist`
--
ALTER TABLE `product_wishlist`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `service_tax`
--
ALTER TABLE `service_tax`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `testimonial`
--
ALTER TABLE `testimonial`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `user_address`
--
ALTER TABLE `user_address`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_newsletter`
--
ALTER TABLE `user_newsletter`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `city`
--
ALTER TABLE `city`
  ADD CONSTRAINT `city_ibfk_1` FOREIGN KEY (`State_ID`) REFERENCES `state` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `city_ibfk_2` FOREIGN KEY (`Country_ID`) REFERENCES `country` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `order_address`
--
ALTER TABLE `order_address`
  ADD CONSTRAINT `order_address_ibfk_1` FOREIGN KEY (`City_ID`) REFERENCES `city` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `order_address_ibfk_2` FOREIGN KEY (`Country_ID`) REFERENCES `country` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `order_address_ibfk_3` FOREIGN KEY (`State_ID`) REFERENCES `state` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `user` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`Category_ID`) REFERENCES `product_category` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`Subcategory_ID`) REFERENCES `product_subcategory` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `product_cart`
--
ALTER TABLE `product_cart`
  ADD CONSTRAINT `product_cart_ibfk_1` FOREIGN KEY (`Color_ID`) REFERENCES `product_color` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `product_cart_ibfk_3` FOREIGN KEY (`Product_ID`) REFERENCES `product` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `product_cart_ibfk_4` FOREIGN KEY (`User_ID`) REFERENCES `user` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `product_image`
--
ALTER TABLE `product_image`
  ADD CONSTRAINT `product_image_ibfk_1` FOREIGN KEY (`Product_ID`) REFERENCES `product` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_review`
--
ALTER TABLE `product_review`
  ADD CONSTRAINT `product_review_ibfk_1` FOREIGN KEY (`Product_ID`) REFERENCES `product` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `product_review_ibfk_2` FOREIGN KEY (`User_ID`) REFERENCES `user` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `product_subcategory`
--
ALTER TABLE `product_subcategory`
  ADD CONSTRAINT `product_subcategory_ibfk_1` FOREIGN KEY (`Category_ID`) REFERENCES `product_category` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `product_wishlist`
--
ALTER TABLE `product_wishlist`
  ADD CONSTRAINT `product_wishlist_ibfk_1` FOREIGN KEY (`Product_ID`) REFERENCES `product` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `product_wishlist_ibfk_2` FOREIGN KEY (`User_ID`) REFERENCES `user` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `service_tax`
--
ALTER TABLE `service_tax`
  ADD CONSTRAINT `service_tax_ibfk_1` FOREIGN KEY (`Country_ID`) REFERENCES `country` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `service_tax_ibfk_2` FOREIGN KEY (`State_ID`) REFERENCES `state` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `state`
--
ALTER TABLE `state`
  ADD CONSTRAINT `state_ibfk_1` FOREIGN KEY (`Country_ID`) REFERENCES `country` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_address`
--
ALTER TABLE `user_address`
  ADD CONSTRAINT `user_address_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `user` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_address_ibfk_2` FOREIGN KEY (`Country_ID`) REFERENCES `country` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_address_ibfk_3` FOREIGN KEY (`State_ID`) REFERENCES `state` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_address_ibfk_4` FOREIGN KEY (`City_ID`) REFERENCES `city` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
