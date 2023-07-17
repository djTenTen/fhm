-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2023 at 04:50 AM
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
-- Database: `db_furniturehouse`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_access_control_list`
--

CREATE TABLE `tbl_access_control_list` (
  `access_control_list_id` int(11) NOT NULL,
  `user_group_id` int(11) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_access_control_list`
--

INSERT INTO `tbl_access_control_list` (`access_control_list_id`, `user_group_id`, `module_id`) VALUES
(1, 3, 51),
(2, 3, 11),
(3, 3, 12),
(4, 3, 13),
(5, 3, 52),
(6, 3, 53),
(7, 3, 38),
(8, 3, 39),
(9, 3, 40),
(10, 3, 34),
(11, 3, 35),
(12, 3, 36),
(13, 3, 37),
(14, 3, 33),
(15, 3, 20),
(16, 3, 21),
(17, 3, 22),
(18, 3, 23),
(19, 3, 47),
(20, 3, 48),
(21, 3, 49),
(22, 3, 50),
(23, 3, 24),
(24, 3, 25),
(25, 3, 26),
(26, 3, 27),
(27, 3, 42),
(28, 3, 54),
(29, 3, 45),
(30, 3, 46),
(31, 3, 44),
(32, 3, 43),
(33, 3, 28),
(34, 3, 29),
(35, 3, 32),
(36, 3, 31),
(37, 3, 17),
(38, 3, 18),
(39, 3, 19),
(40, 3, 8),
(41, 3, 9),
(42, 3, 10),
(43, 3, 2),
(44, 3, 7),
(45, 3, 3),
(46, 3, 6),
(47, 3, 5),
(48, 3, 4),
(49, 3, 14),
(50, 3, 15),
(51, 3, 16),
(72, 6, 52),
(73, 6, 53),
(74, 6, 33),
(75, 6, 20),
(76, 6, 42),
(77, 6, 45),
(78, 6, 28),
(79, 6, 29),
(81, 6, 17),
(82, 6, 18),
(83, 6, 19),
(84, 3, 30),
(87, 3, 41),
(88, 6, 38),
(89, 3, 55),
(90, 3, 56),
(97, 7, 8),
(98, 7, 9),
(99, 7, 20),
(100, 7, 21),
(101, 7, 24),
(102, 7, 25),
(103, 8, 11),
(104, 8, 12),
(105, 8, 13),
(106, 10, 2),
(107, 10, 3),
(108, 10, 4),
(109, 10, 8),
(110, 10, 9),
(111, 10, 10),
(112, 10, 11),
(113, 10, 12),
(114, 10, 13),
(547, 4, 11),
(548, 4, 12),
(549, 4, 13),
(550, 4, 17),
(551, 4, 18),
(552, 4, 19),
(553, 4, 20),
(554, 4, 28),
(555, 4, 29),
(556, 4, 30),
(557, 4, 31),
(558, 4, 33),
(559, 4, 34),
(560, 4, 35),
(561, 4, 36),
(562, 4, 37),
(563, 4, 38),
(564, 4, 39),
(565, 4, 40),
(566, 4, 42),
(567, 4, 45),
(568, 4, 52),
(569, 4, 53),
(570, 4, 55),
(571, 4, 56),
(572, 11, 2),
(573, 11, 8),
(574, 11, 9),
(575, 11, 10),
(576, 11, 20),
(577, 11, 21),
(578, 11, 22),
(579, 11, 23),
(1071, 12, 2),
(1072, 12, 3),
(1073, 12, 4),
(1074, 12, 5),
(1075, 12, 6),
(1076, 12, 7),
(1077, 12, 20),
(1078, 12, 21),
(1079, 12, 22),
(1080, 12, 23);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_access_log`
--

CREATE TABLE `tbl_access_log` (
  `access_log_id` int(11) NOT NULL,
  `type` text DEFAULT NULL,
  `id` int(11) DEFAULT NULL,
  `log_time` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_access_log`
--

INSERT INTO `tbl_access_log` (`access_log_id`, `type`, `id`, `log_time`) VALUES
(1, 'admin', 2, '2023-05-24 17:38:52'),
(2, 'admin', 2, '2023-05-25 09:19:22'),
(3, 'admin', 2, '2023-05-25 09:19:28'),
(4, 'admin', 2, '2023-05-25 10:35:50'),
(5, 'admin', 2, '2023-05-25 10:36:18'),
(6, 'admin', 2, '2023-05-25 10:50:20'),
(7, 'admin', 2, '2023-05-25 13:18:12'),
(8, 'admin', 2, '2023-05-29 14:13:55'),
(9, 'admin', 2, '2023-05-29 14:14:00'),
(10, 'admin', 2, '2023-05-31 13:50:32'),
(11, 'Adminstrator', 22, '06/01/2023 09:40:19am'),
(12, 'Adminstrator', 22, '06/01/2023 09:41:20am'),
(13, 'Adminstrator', 22, '06/01/2023 10:19:41am'),
(14, 'Adminstrator', 22, '06/01/2023 10:20:33am'),
(15, 'Adminstrator', 22, '06/01/2023 10:28:58am'),
(16, 'Adminstrator', 22, '06/01/2023 10:29:03am'),
(17, 'Adminstrator', 22, '06/01/2023 10:29:51am'),
(18, 'Adminstrator', 22, '06/01/2023 10:31:38am'),
(19, 'Adminstrator', 22, '06/01/2023 10:32:11am'),
(20, 'Adminstrator', 22, '06/01/2023 10:34:00am'),
(21, 'Adminstrator', 22, '06/01/2023 10:39:55am'),
(22, 'Adminstrator', 22, '06/01/2023 10:41:07am'),
(23, 'Adminstrator', 22, '06/01/2023 10:43:27am'),
(24, 'Adminstrator', 22, '06/01/2023 10:47:21am'),
(25, 'Adminstrator', 22, '06/01/2023 10:51:07am'),
(26, 'Adminstrator', 22, '06/01/2023 10:55:32am'),
(27, 'Adminstrator', 22, '06/01/2023 10:55:56am'),
(28, 'Adminstrator', 22, '06/01/2023 10:56:42am'),
(29, 'admin', 2, '2023-06-01 10:58:02'),
(30, 'Adminstrator', 22, '06/01/2023 11:08:04am'),
(31, 'Adminstrator', 22, '06/01/2023 11:08:30am'),
(32, 'admin', 2, '2023-06-01 13:17:06'),
(33, 'Adminstrator', 22, '06/01/2023 01:22:46pm'),
(34, 'admin', 2, '2023-06-01 13:59:37'),
(35, 'admin', 2, '2023-06-01 15:11:49'),
(36, 'Sample 5', 22, '06/01/2023 03:13:39pm'),
(37, 'admin', 2, '2023-06-01 15:46:35'),
(38, 'Sample 5', 22, '06/01/2023 03:51:09pm'),
(39, 'Sample 5', 22, '06/01/2023 03:52:50pm'),
(40, 'Sample 5', 22, '06/01/2023 03:56:54pm'),
(41, 'Sample 5', 22, '06/01/2023 03:58:56pm'),
(42, 'Sample 5', 22, '06/01/2023 04:03:34pm'),
(43, 'Sample 5', 22, '06/01/2023 04:06:42pm'),
(44, 'Sample 5', 22, '06/01/2023 04:07:15pm'),
(45, 'Sample 5', 22, '06/01/2023 04:08:01pm'),
(46, 'Sample 5', 22, '06/01/2023 04:08:51pm'),
(47, 'Sample 5', 22, '06/01/2023 04:20:37pm'),
(48, 'Sample 5', 22, '06/01/2023 04:21:04pm'),
(49, 'Sample 5', 22, '06/01/2023 04:21:30pm'),
(50, 'Sample 5', 22, '06/01/2023 04:23:34pm'),
(51, 'Sample 5', 22, '06/01/2023 04:23:55pm'),
(52, 'Sample 5', 22, '06/01/2023 04:24:26pm'),
(53, 'Sample 5', 22, '06/01/2023 04:31:57pm'),
(54, 'Sample 5', 22, '06/01/2023 04:32:28pm'),
(55, 'Sample 5', 22, '06/01/2023 04:33:12pm'),
(56, 'Sample 5', 22, '06/01/2023 04:35:32pm'),
(57, 'Sample 5', 22, '06/01/2023 04:36:01pm'),
(58, 'Sample 5', 22, '06/01/2023 04:37:26pm'),
(59, 'Sample 5', 22, '06/01/2023 04:41:53pm'),
(60, 'Sample 5', 22, '06/01/2023 04:44:56pm'),
(61, 'Sample 5', 22, '06/01/2023 04:52:59pm'),
(62, 'Sample 5', 22, '06/01/2023 04:56:17pm'),
(63, 'Sample 5', 22, '06/02/2023 08:49:09am'),
(64, 'Sample 5', 22, '06/02/2023 08:59:20am'),
(65, 'Sample 5', 22, '06/02/2023 10:29:43am'),
(66, 'Sample 5', 22, '06/02/2023 01:31:16pm'),
(67, 'admin', 2, '2023-06-02 13:55:41'),
(68, 'admin', 2, '2023-06-02 14:32:49'),
(69, 'Sample 5', 22, '06/05/2023 08:52:15am'),
(70, 'admin', 2, '2023-06-05 09:03:32'),
(71, 'admin', 2, '2023-06-05 10:40:48'),
(72, 'admin', 2, '2023-06-05 11:41:39'),
(73, 'admin', 2, '2023-06-05 14:00:37'),
(74, 'admin', 2, '2023-06-05 14:38:10'),
(75, 'admin', 2, '2023-06-05 16:42:39'),
(76, 'Sample 5', 22, '06/06/2023 09:08:31am'),
(77, 'admin', 2, '2023-06-06 09:40:11'),
(78, 'admin', 2, '2023-06-06 11:30:23'),
(79, 'admin', 2, '2023-06-06 13:11:18'),
(80, 'admin', 2, '2023-06-06 16:35:46'),
(81, 'admin', 2, '2023-06-06 17:12:38'),
(82, 'Sample 5', 22, '06/06/2023 05:24:37pm'),
(83, 'Sample 5', 22, '06/07/2023 09:12:57am'),
(84, 'Sample 5', 22, '06/07/2023 09:17:52am');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_agency`
--

CREATE TABLE `tbl_agency` (
  `agency_id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `contact_number` text DEFAULT NULL,
  `contact_person` text DEFAULT NULL,
  `username` text DEFAULT NULL,
  `password` text DEFAULT NULL,
  `status` text DEFAULT NULL,
  `added_by` text DEFAULT NULL,
  `added_on` datetime DEFAULT NULL,
  `updated_by` text DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_agency`
--

INSERT INTO `tbl_agency` (`agency_id`, `name`, `address`, `contact_number`, `contact_person`, `username`, `password`, `status`, `added_by`, `added_on`, `updated_by`, `updated_on`) VALUES
(1, 'In-house', NULL, NULL, NULL, NULL, NULL, 'active', NULL, NULL, NULL, NULL),
(2, 'LMC Management Services', NULL, NULL, NULL, NULL, NULL, 'active', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bank_account`
--

CREATE TABLE `tbl_bank_account` (
  `bank_account_id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `account_number` text DEFAULT NULL,
  `status` text DEFAULT NULL,
  `added_by` text DEFAULT NULL,
  `added_on` datetime DEFAULT NULL,
  `updated_by` text DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `customer_id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `contact_number` text DEFAULT NULL,
  `email_address` text DEFAULT NULL,
  `type` text DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `status` text DEFAULT NULL,
  `added_by` text DEFAULT NULL,
  `added_on` varchar(50) DEFAULT NULL,
  `updated_by` text DEFAULT NULL,
  `updated_on` varchar(50) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `discount` varchar(20) NOT NULL,
  `website` varchar(200) NOT NULL,
  `facebook` varchar(100) NOT NULL,
  `instagram` varchar(100) NOT NULL,
  `lazada` varchar(100) NOT NULL,
  `shopee` varchar(100) NOT NULL,
  `representative_name` varchar(100) NOT NULL,
  `representative_contact_number` varchar(100) NOT NULL,
  `representative_email_address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`customer_id`, `name`, `address`, `contact_number`, `email_address`, `type`, `remarks`, `status`, `added_by`, `added_on`, `updated_by`, `updated_on`, `username`, `password`, `discount`, `website`, `facebook`, `instagram`, `lazada`, `shopee`, `representative_name`, `representative_contact_number`, `representative_email_address`) VALUES
(1, 'MULDONG, EDWINA G.', 'Luzon Ave QC Bulacan', '9999999', 'myemai@email.com', 'personal', 'Good', 'active', '2', '2023-05-24 17:51:05', '22', '06/05/2023 11:19:18am', '', '', '', '', '', '', '', '', '', '', ''),
(2, 'Dhay Dhay Mski', 'Pampanga', '09055407457', 'myemail2@mail.com', 'corporate', 'Good', 'active', '2', '2023-05-24 17:52:49', '22', '06/05/2023 12:03:42pm', 'samplecorp', '$2y$10$992whRjCHMFnhmVS8q7BJu.QI240iqZgE6I6FV9YUijMGq37Izal2', '10', 'www', 'fff', 'iii', 'laz', 'shop', 'Speaker of the house', '0999995', 'samplemail@yahoo.com'),
(3, 'Sample', 'Sample customer', '195135549', 'dj@hayoo.com', 'personal', 'Good', 'active', '22', '06/05/2023 01:43:24pm', NULL, NULL, '', '', '', '', '', '', '', '', '', '', ''),
(4, 'Sample corporate', 'Sample 2 corporate', '095484721654', 'myemail@yahoo.com', 'corporate', 'Good', 'active', '22', '06/05/2023 01:48:18pm', '22', '06/05/2023 01:50:51pm', 'mycorpun', '$2y$10$KgBHMhPjCTI4pDtkmIYz0.maLRSlJyoUUe5Q4k6ZOnGO9BrDh.sGW', '15', 'asdf', 'asf', 'asdf', 'asdf', 'asdfasd', 'DJ', '19857847', 'dj@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer_corporate`
--

CREATE TABLE `tbl_customer_corporate` (
  `customer_corporate_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `username` text DEFAULT NULL,
  `password` text DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `website` text DEFAULT NULL,
  `facebook` text DEFAULT NULL,
  `instagram` text DEFAULT NULL,
  `lazada` text DEFAULT NULL,
  `shopee` text DEFAULT NULL,
  `representative_name` text DEFAULT NULL,
  `representative_contact_number` text DEFAULT NULL,
  `representative_email_address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_customer_corporate`
--

INSERT INTO `tbl_customer_corporate` (`customer_corporate_id`, `customer_id`, `username`, `password`, `discount`, `website`, `facebook`, `instagram`, `lazada`, `shopee`, `representative_name`, `representative_contact_number`, `representative_email_address`) VALUES
(1, 2, 'djrboco', 'RS9JN0xhY2ZheXZZVXlyWkJkU1JSUT09OjqukKy3Gzbx49Dk4Yy11XFd', 10, '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_daily_time_record`
--

CREATE TABLE `tbl_daily_time_record` (
  `daily_time_record_id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `device_id` int(11) DEFAULT NULL,
  `log` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_damage_item`
--

CREATE TABLE `tbl_damage_item` (
  `damage_item_id` int(11) NOT NULL,
  `reference_number` text DEFAULT NULL,
  `warehouse_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `classification` text DEFAULT NULL,
  `status` text DEFAULT NULL,
  `added_by` text DEFAULT NULL,
  `added_on` datetime DEFAULT NULL,
  `updated_by` text DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_damage_item`
--

INSERT INTO `tbl_damage_item` (`damage_item_id`, `reference_number`, `warehouse_id`, `item_id`, `description`, `classification`, `status`, `added_by`, `added_on`, `updated_by`, `updated_on`) VALUES
(1, 'DMG2023052500532000001', 1, 532, 'sira', 'a', 'pending', '2', '2023-05-25 10:02:58', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_display_item`
--

CREATE TABLE `tbl_display_item` (
  `display_item_id` int(11) NOT NULL,
  `reference_number` text DEFAULT NULL,
  `warehouse_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `status` text DEFAULT NULL,
  `added_by` text DEFAULT NULL,
  `added_on` datetime DEFAULT NULL,
  `updated_by` text DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_display_item`
--

INSERT INTO `tbl_display_item` (`display_item_id`, `reference_number`, `warehouse_id`, `item_id`, `status`, `added_by`, `added_on`, `updated_by`, `updated_on`) VALUES
(1, 'DP2023052500532000001', 1, 532, 'displayed', '2', '2023-05-25 10:00:04', NULL, NULL),
(2, 'DP2023052500532000002', 1, 532, 'displayed', '2', '2023-05-25 10:00:21', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee`
--

CREATE TABLE `tbl_employee` (
  `employee_id` int(11) NOT NULL,
  `warehouse_id` int(11) DEFAULT NULL,
  `agency_id` int(11) DEFAULT NULL,
  `id_number` text DEFAULT NULL,
  `first_name` text DEFAULT NULL,
  `middle_name` text DEFAULT NULL,
  `last_name` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `gender` text DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `contact_number` text DEFAULT NULL,
  `salary` double(10,2) DEFAULT NULL,
  `salary_type` text DEFAULT NULL,
  `date_hired` date DEFAULT NULL,
  `position` text DEFAULT NULL,
  `sss_number` text DEFAULT NULL,
  `philhealth_number` text DEFAULT NULL,
  `pagibig_number` text DEFAULT NULL,
  `barangay_clearance` date DEFAULT NULL,
  `nbi_clearance` date DEFAULT NULL,
  `police_clearance` text DEFAULT NULL,
  `emergency_contact_name` text DEFAULT NULL,
  `emergency_contact_number` text DEFAULT NULL,
  `emergency_contact_relation` text DEFAULT NULL,
  `status` text DEFAULT NULL,
  `added_by` text DEFAULT NULL,
  `added_on` datetime DEFAULT NULL,
  `updated_by` text DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_exchange`
--

CREATE TABLE `tbl_exchange` (
  `exchange_id` int(11) NOT NULL,
  `query` text DEFAULT NULL,
  `status` text DEFAULT NULL,
  `added_on` datetime DEFAULT NULL,
  `remarks` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_expense`
--

CREATE TABLE `tbl_expense` (
  `expense_id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `status` text DEFAULT NULL,
  `added_by` text DEFAULT NULL,
  `added_on` datetime DEFAULT NULL,
  `updated_by` text DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_expense_category`
--

CREATE TABLE `tbl_expense_category` (
  `expense_category_id` int(11) NOT NULL,
  `name` mediumtext DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  `status` mediumtext DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `added_on` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_expense_item`
--

CREATE TABLE `tbl_expense_item` (
  `expense_item_id` int(11) NOT NULL,
  `expense_id` int(11) DEFAULT NULL,
  `expense_category_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `amount` double(10,2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_fleet`
--

CREATE TABLE `tbl_fleet` (
  `fleet_id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `number` text DEFAULT NULL,
  `status` text DEFAULT NULL,
  `added_by` text DEFAULT NULL,
  `added_on` datetime DEFAULT NULL,
  `updated_by` text DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_fleet`
--

INSERT INTO `tbl_fleet` (`fleet_id`, `name`, `number`, `status`, `added_by`, `added_on`, `updated_by`, `updated_on`) VALUES
(1, 'THEPENTHOUSE', '+639338153007', 'active', NULL, NULL, NULL, NULL),
(2, 'FURNITUREHOUSEMANILA', '+639237031099', 'active', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_fleet_location`
--

CREATE TABLE `tbl_fleet_location` (
  `fleet_location_id` int(11) NOT NULL,
  `fleet_id` int(11) DEFAULT NULL,
  `latitude` text DEFAULT NULL,
  `longitude` text DEFAULT NULL,
  `speed` text DEFAULT NULL,
  `provider_timestamp` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item`
--

CREATE TABLE `tbl_item` (
  `item_id` int(11) NOT NULL,
  `item_category_id` int(11) DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  `name` text DEFAULT NULL,
  `color` varchar(50) NOT NULL,
  `carton_quantity` int(11) DEFAULT NULL,
  `stock_level` int(11) DEFAULT NULL,
  `wholesale_price` double(10,2) DEFAULT NULL,
  `retail_price` double(10,2) DEFAULT NULL,
  `inventory_age` date DEFAULT NULL,
  `hidden_wholesale` text DEFAULT NULL,
  `status` text DEFAULT NULL,
  `added_by` text DEFAULT NULL,
  `added_on` datetime DEFAULT NULL,
  `updated_by` text DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_item`
--

INSERT INTO `tbl_item` (`item_id`, `item_category_id`, `parent`, `name`, `color`, `carton_quantity`, `stock_level`, `wholesale_price`, `retail_price`, `inventory_age`, `hidden_wholesale`, `status`, `added_by`, `added_on`, `updated_by`, `updated_on`) VALUES
(1, 1, 0, 'Steel Chair with Painted Wooden Finish', '', 4, 0, 1.00, 1.00, NULL, 'no', 'inactive', '3', '2021-02-09 19:51:48', '3', '2021-06-04 01:14:35'),
(2, 0, 1, 'Black', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-09 19:51:48', '3', '2021-02-16 09:34:32'),
(3, 0, 1, 'Dark Brown', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-09 19:51:48', '3', '2021-02-16 09:34:32'),
(4, 0, 1, 'White', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-09 19:51:48', '3', '2021-02-16 09:34:32'),
(5, 1, 0, 'Scandinavian Eames Basic Chair', '', 10, 20, 1.00, 1.00, NULL, 'no', 'active', '3', '2021-02-10 16:40:24', '3', '2022-08-31 17:21:43'),
(6, 0, 5, 'Black', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-10 16:40:24', '3', '2022-08-31 17:21:43'),
(7, 0, 5, 'White', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-10 16:40:24', '3', '2022-08-31 17:21:43'),
(8, 0, 5, 'Grey', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-10 16:40:24', '3', '2022-08-31 17:21:43'),
(9, 0, 5, 'Red', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-10 16:40:24', '3', '2022-08-31 17:21:43'),
(10, 0, 5, 'Blue', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-10 16:40:24', '3', '2022-08-31 17:21:43'),
(11, 0, 5, 'Pink', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-10 16:40:24', '3', '2022-08-31 17:21:43'),
(12, 1, 0, 'Scandinavian Eames Tulip Chair', '', 4, 20, 1.00, 1.00, NULL, 'no', 'active', '3', '2021-02-10 16:43:30', '4', '2022-01-05 21:21:34'),
(13, 0, 12, 'Black', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-10 16:43:30', '4', '2022-01-05 21:21:34'),
(14, 0, 12, 'White', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-10 16:43:30', '4', '2022-01-05 21:21:34'),
(15, 0, 12, 'Grey', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-10 16:43:30', '4', '2022-01-05 21:21:34'),
(16, 0, 12, 'Blue', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-10 16:43:30', '4', '2022-01-05 21:21:34'),
(17, 0, 12, 'Pink', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-10 16:43:30', '4', '2022-01-05 21:21:34'),
(18, 1, 0, 'Office Mesh Chair with Back Support', '', 0, 0, 1.00, 1.00, NULL, 'no', 'inactive', '3', '2021-02-10 16:44:56', '3', '2021-06-04 00:30:34'),
(19, 0, 18, 'Black', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-10 16:44:56', NULL, NULL),
(20, 1, 0, 'Scandinavian Butterfly Fabric Chair', '', 4, 20, 1.00, 1.00, NULL, 'no', 'active', '3', '2021-02-10 16:53:54', '3', '2022-08-31 13:52:51'),
(21, 0, 20, 'Black', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2021-02-10 16:53:54', '3', '2022-08-31 13:52:51'),
(22, 0, 20, 'Beige', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2021-02-10 16:53:54', '3', '2022-08-31 13:52:51'),
(23, 0, 20, 'Denim Blue', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-10 16:53:54', '3', '2022-08-31 13:52:51'),
(24, 0, 20, 'Yellow', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2021-02-10 16:53:54', '3', '2022-08-31 13:52:51'),
(25, 0, 20, 'Lavender', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2021-02-10 16:53:54', '3', '2022-08-31 13:52:51'),
(26, 0, 20, 'Grey', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2021-02-10 16:53:54', '3', '2022-08-31 13:52:51'),
(27, 0, 20, 'Avocado', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2021-02-10 16:53:54', '3', '2022-08-31 13:52:51'),
(28, 0, 20, 'Burgundy', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-10 16:53:54', '3', '2022-08-31 13:52:51'),
(29, 0, 20, 'Dusty Blue', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2021-02-10 16:53:54', '3', '2022-08-31 13:52:51'),
(30, 0, 20, 'Red Orange', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2021-02-10 16:53:54', '3', '2022-08-31 13:52:51'),
(31, 0, 20, 'Pink', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2021-02-10 16:53:54', '3', '2022-08-31 13:52:51'),
(32, 0, 20, 'Orange', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2021-02-10 16:53:54', '3', '2022-08-31 13:52:51'),
(33, 0, 20, 'Purple', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-10 16:53:54', '3', '2022-08-31 13:52:51'),
(34, 0, 20, 'Brown', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2021-02-10 16:53:54', '3', '2022-08-31 13:52:51'),
(35, 0, 20, 'White', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2021-02-10 16:53:54', '3', '2022-08-31 13:52:51'),
(36, 1, 0, 'Scandinavian Butterfly Leather Chair', '', 4, 20, 1.00, 1.00, NULL, 'no', 'active', '3', '2021-02-10 16:59:35', '3', '2022-08-31 13:52:31'),
(37, 0, 36, 'Black', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2021-02-10 16:59:35', '3', '2022-08-31 13:52:31'),
(38, 0, 36, 'White', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-10 16:59:35', '3', '2022-08-31 13:52:31'),
(39, 0, 36, 'Pink', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-10 16:59:35', '3', '2022-08-31 13:52:31'),
(40, 0, 36, 'Blue', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-10 16:59:35', '3', '2022-08-31 13:52:31'),
(41, 0, 36, 'Orange', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2021-02-10 16:59:35', '3', '2022-08-31 13:52:31'),
(42, 0, 36, 'Beige', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2021-02-10 16:59:35', '3', '2022-08-31 13:52:31'),
(43, 0, 36, 'Red', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-10 16:59:35', '3', '2022-08-31 13:52:31'),
(44, 0, 36, 'Brown', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-10 16:59:35', '3', '2022-08-31 13:52:31'),
(45, 0, 36, 'Yellow', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-10 16:59:35', '3', '2022-08-31 13:52:31'),
(46, 0, 36, 'Grey', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2021-02-10 16:59:35', '3', '2022-08-31 13:52:31'),
(47, 1, 0, 'Office Mesh Chair', '', 0, 0, 1.00, 1.00, NULL, 'no', 'inactive', '3', '2021-02-10 23:52:17', '3', '2021-06-04 00:30:11'),
(48, 0, 47, 'Black', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-10 23:52:17', NULL, NULL),
(49, 1, 0, 'Wooden Barstool 50cm', '', 0, 0, 1.00, 1.00, NULL, 'no', 'active', '3', '2021-02-10 23:53:52', '3', '2021-10-22 12:06:52'),
(50, 0, 49, 'Natural Wood', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-10 23:53:52', '3', '2021-10-22 12:06:52'),
(51, 1, 0, 'Wooden Barstool 60cm', '', 0, 0, 1.00, 1.00, NULL, 'no', 'active', '3', '2021-02-10 23:54:39', '3', '2021-10-22 12:07:00'),
(52, 0, 51, 'Natural Wood', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-10 23:54:39', '3', '2021-10-22 12:07:00'),
(53, 1, 0, 'Wooden Barstool 70cm', '', 0, 0, 1.00, 1.00, NULL, 'no', 'active', '3', '2021-02-10 23:55:32', '3', '2021-10-22 12:07:06'),
(54, 0, 53, 'Natural Wood', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-10 23:55:32', '3', '2021-10-22 12:07:06'),
(55, 1, 0, 'Wooden Barstool 80cm', '', 0, 0, 1.00, 1.00, NULL, 'no', 'active', '3', '2021-02-10 23:59:14', '3', '2021-10-22 12:07:11'),
(56, 0, 55, 'Natural Wood', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-10 23:59:14', '3', '2021-10-22 12:07:11'),
(57, 1, 0, 'Eames Lounge Chair with Ottoman', '', 0, 0, 1.00, 1.00, NULL, 'no', 'active', '3', '2021-02-11 00:15:07', '3', '2022-05-01 14:28:18'),
(58, 0, 57, 'Walnut / Black', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-11 00:15:07', '3', '2022-05-01 14:28:18'),
(59, 1, 0, 'Eames Low Back Conference Chair', '', 0, 0, 1.00, 1.00, NULL, 'no', 'active', '3', '2021-02-11 00:15:58', '3', '2023-03-03 10:17:14'),
(60, 0, 59, 'Walnut / Black', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-11 00:15:58', '3', '2023-03-03 10:17:14'),
(61, 1, 0, 'Eames Mid-Back Conference Chair', '', 0, 0, 1.00, 1.00, NULL, 'no', 'inactive', '3', '2021-02-11 00:16:33', '3', '2022-12-14 17:08:46'),
(62, 0, 61, 'Walnut / Black', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2021-02-11 00:16:33', '3', '2022-12-14 17:08:46'),
(63, 1, 0, 'Eames High-Back Conference Chair', '', 5, 0, 1.00, 1.00, NULL, 'no', 'active', '3', '2021-02-11 00:17:15', '4', '2022-06-07 12:44:43'),
(64, 0, 63, 'Walnut / Black', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-11 00:17:15', '4', '2022-06-07 12:44:43'),
(65, 2, 0, 'Scandinavian Eames Dining Table Rectangular 120 x 80', '', 1, 10, 1.00, 1.00, NULL, 'no', 'active', '3', '2021-02-12 10:04:39', '4', '2021-04-28 21:49:42'),
(66, 0, 65, 'White', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-12 10:04:39', '4', '2021-04-28 21:49:42'),
(67, 0, 65, 'Wooden', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-12 10:05:33', '4', '2021-04-28 21:49:42'),
(68, 2, 0, 'Scandinavian Eames Dining Table Rectangular 120 x 60', '', 1, 10, 1.00, 1.00, NULL, 'no', 'active', '3', '2021-02-12 10:06:26', '4', '2021-06-11 16:52:48'),
(69, 0, 68, 'White', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-12 10:06:26', '4', '2021-06-11 16:52:48'),
(70, 0, 68, 'Wooden', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-12 10:06:26', '4', '2021-06-11 16:52:48'),
(71, 2, 0, 'Scandinavian Eames Dining Table Rectangular 140 x 80', '', 1, 10, 1.00, 1.00, NULL, 'no', 'active', '3', '2021-02-12 10:07:24', '4', '2021-04-28 21:49:47'),
(72, 0, 71, 'White', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-12 10:07:24', '4', '2021-04-28 21:49:47'),
(73, 0, 71, 'Wooden', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-12 10:07:24', '4', '2021-04-28 21:49:47'),
(74, 2, 0, 'Scandinavian Eames Dining Table Square 80 x 80', '', 1, 10, 1.00, 1.00, NULL, 'no', 'active', '3', '2021-02-12 10:09:01', '4', '2021-08-02 16:24:22'),
(75, 0, 74, 'Black', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-12 10:09:01', '4', '2021-08-02 16:24:22'),
(76, 0, 74, 'White', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-12 10:09:01', '4', '2021-08-02 16:24:22'),
(77, 0, 74, 'Wooden', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-12 10:09:01', '4', '2021-08-02 16:24:22'),
(78, 2, 0, 'Scandinavian Eames Round Table 60cm', '', 1, 20, 1.00, 1.00, NULL, 'no', 'active', '3', '2021-02-12 10:10:52', '4', '2021-06-12 12:07:27'),
(79, 0, 78, 'Black', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-12 10:10:52', '4', '2021-06-12 12:07:27'),
(80, 0, 78, 'White', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-12 10:10:52', '4', '2021-06-12 12:07:27'),
(81, 0, 78, 'Wooden', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-12 10:10:52', '4', '2021-06-12 12:07:27'),
(82, 2, 0, 'Scandinavian Eames Round Table 70cm', '', 1, 20, 1.00, 1.00, NULL, 'no', 'active', '3', '2021-02-12 10:12:40', '4', '2021-06-12 12:10:39'),
(83, 0, 82, 'Black', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-12 10:12:40', '4', '2021-06-12 12:10:39'),
(84, 0, 82, 'White', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-12 10:12:40', '4', '2021-06-12 12:10:39'),
(85, 0, 82, 'Wooden', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-12 10:12:40', '4', '2021-06-12 12:10:39'),
(86, 2, 0, 'Scandinavian Eames Round Table 80cm', '', 1, 20, 1.00, 1.00, NULL, 'no', 'active', '3', '2021-02-12 10:14:04', '4', '2021-06-12 12:11:10'),
(87, 0, 86, 'Black', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-12 10:14:04', '4', '2021-06-12 12:11:10'),
(88, 0, 86, 'White', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-12 10:14:04', '4', '2021-06-12 12:11:10'),
(89, 0, 86, 'Wooden', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-12 10:14:04', '4', '2021-06-12 12:11:10'),
(90, 0, 49, 'White', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2021-02-12 12:13:34', '3', '2021-10-22 12:06:52'),
(91, 0, 49, 'Dark Oak', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2021-02-12 12:13:34', '3', '2021-10-22 12:06:52'),
(92, 0, 51, 'Dark Oak', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2021-02-12 12:13:54', '3', '2021-10-22 12:07:00'),
(93, 0, 51, 'White', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2021-02-12 12:13:54', '3', '2021-10-22 12:07:00'),
(94, 0, 53, 'Dark Oak', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2021-02-12 12:14:11', '3', '2021-10-22 12:07:06'),
(95, 0, 53, 'White', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2021-02-12 12:14:11', '3', '2021-10-22 12:07:06'),
(96, 0, 55, 'Dark Oak', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2021-02-12 12:14:37', '3', '2021-10-22 12:07:11'),
(97, 0, 55, 'White', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2021-02-12 12:14:37', '3', '2021-10-22 12:07:11'),
(98, 1, 0, 'Scandinavian Eames Infinity Chair', '', 4, 20, 1.00, 1.00, NULL, 'no', 'active', '3', '2021-02-12 13:11:06', '3', '2022-09-28 12:00:09'),
(99, 0, 98, 'White', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-12 13:11:06', '3', '2022-09-28 12:00:09'),
(100, 0, 98, 'Black', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-12 13:11:06', '3', '2022-09-28 12:00:09'),
(101, 1, 0, 'Scandinavian Eames Grid Chair', '', 4, 20, 1.00, 1.00, NULL, 'no', 'active', '3', '2021-02-12 13:12:21', '4', '2021-04-23 23:19:14'),
(102, 0, 101, 'Black', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-12 13:12:21', '4', '2021-04-23 23:19:14'),
(103, 0, 101, 'White', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-12 13:12:21', '4', '2021-04-23 23:19:14'),
(104, 1, 0, 'Scandinavian Eames Mesh Chair', '', 4, 20, 1.00, 1.00, NULL, 'no', 'active', '3', '2021-02-12 13:13:26', '4', '2021-06-11 16:50:13'),
(105, 0, 104, 'Black', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-12 13:13:26', '4', '2021-06-11 16:50:13'),
(106, 0, 104, 'White', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-12 13:13:26', '4', '2021-06-11 16:50:13'),
(107, 3, 0, 'Solid Wood Bed Side Table', '', 1, 0, 1.00, 1.00, NULL, 'no', 'inactive', '3', '2021-02-12 13:19:52', '3', '2021-06-04 01:17:55'),
(108, 0, 107, 'Wooden', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-12 13:19:52', NULL, NULL),
(109, 2, 0, 'Scandinavian Study Table with Drawer 120 x 55', '', 0, 10, 1.00, 1.00, NULL, 'no', 'inactive', '3', '2021-02-12 13:25:09', '3', '2022-07-03 10:04:14'),
(110, 0, 109, 'Natural Wood', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2021-02-12 13:25:09', '3', '2022-07-03 10:04:14'),
(111, 0, 109, 'Dark Oak', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2021-02-12 13:25:09', '3', '2022-07-03 10:04:14'),
(112, 0, 109, 'White', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2021-02-12 13:25:09', '3', '2022-07-03 10:04:14'),
(113, 2, 0, 'Computer Desk Wooden Steel with Book Shelf', '', 1, 0, 1.00, 1.00, NULL, 'no', 'inactive', '3', '2021-02-12 13:29:14', '3', '2021-06-04 01:19:11'),
(114, 0, 113, 'Black', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-12 13:29:14', NULL, NULL),
(115, 0, 113, 'White', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-12 13:29:14', NULL, NULL),
(116, 2, 0, 'Scandinavian Study Table 120 x 55', '', 1, 0, 1.00, 1.00, NULL, 'no', 'inactive', '3', '2021-02-12 13:32:04', '3', '2021-06-04 01:19:58'),
(117, 0, 116, 'White', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-12 13:32:04', NULL, NULL),
(118, 0, 116, 'Wooden', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-12 13:32:04', NULL, NULL),
(119, 2, 0, 'Modern Study Table 120 x 60', '', 1, 0, 1.00, 1.00, NULL, 'no', 'inactive', '3', '2021-02-12 15:54:10', '3', '2021-06-04 01:19:44'),
(120, 0, 119, 'White', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-12 15:54:10', NULL, NULL),
(121, 0, 119, 'Wooden', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-12 15:54:10', NULL, NULL),
(122, 1, 0, 'Solid Wood Swivel Barstool Chair', '', 0, 0, 1.00, 1.00, NULL, 'no', 'active', '3', '2021-02-12 16:02:43', '3', '2022-06-05 12:48:14'),
(123, 0, 122, 'Dark Brown', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-12 16:02:43', '3', '2022-06-05 12:48:14'),
(124, 0, 122, 'Light Grey', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-12 16:02:43', '3', '2022-06-05 12:48:14'),
(125, 0, 122, 'Beige', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-12 16:02:43', '3', '2022-06-05 12:48:14'),
(126, 2, 0, 'Movable Laptop Table 60 x 40', '', 0, 0, 1.00, 1.00, NULL, 'no', 'inactive', '3', '2021-02-12 16:07:01', '3', '2021-06-04 01:20:11'),
(127, 0, 126, 'White', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-12 16:07:01', NULL, NULL),
(128, 0, 126, 'Black', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-12 16:07:01', NULL, NULL),
(129, 0, 126, 'Oak', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-12 16:07:01', NULL, NULL),
(130, 4, 0, 'Modern TV Stand 120 x 30', '', 0, 0, 1.00, 1.00, NULL, 'no', 'inactive', '3', '2021-02-12 16:09:11', '3', '2021-06-04 01:20:36'),
(131, 0, 130, 'Wood', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-12 16:09:11', NULL, NULL),
(132, 4, 0, 'Modern TV Stand 120 x 30', '', 0, 0, 1.00, 1.00, NULL, 'no', 'inactive', '3', '2021-02-12 16:09:34', '3', '2021-06-04 01:20:42'),
(133, 0, 132, 'Wooden', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-12 16:09:34', NULL, NULL),
(134, 4, 0, 'Modern TV Stand 140 x 34', '', 0, 0, 1.00, 1.00, NULL, 'no', 'inactive', '3', '2021-02-12 16:09:55', '3', '2021-10-12 17:09:56'),
(135, 0, 134, 'Wooden', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2021-02-12 16:09:55', '3', '2021-10-12 17:09:56'),
(136, 4, 0, 'Modern TV Stand Expandable 160 x 35', '', 0, 0, 1.00, 1.00, NULL, 'no', 'inactive', '3', '2021-02-12 16:10:41', '3', '2021-06-04 01:20:58'),
(137, 0, 136, 'Wooden', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-12 16:10:41', NULL, NULL),
(138, 4, 0, 'Modern TV Stand 120 x 35', '', 1, 0, 1.00, 1.00, NULL, 'no', 'inactive', '3', '2021-02-13 10:04:51', '3', '2021-06-04 01:20:50'),
(139, 0, 138, 'Wooden', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-13 10:04:51', NULL, NULL),
(140, 4, 0, 'Modern TV Stand 120 x 30', '', 1, 0, 1.00, 1.00, NULL, 'no', 'inactive', '3', '2021-02-13 10:08:50', '3', '2021-06-04 01:20:46'),
(141, 0, 140, 'Wooden', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-13 10:08:50', NULL, NULL),
(142, 4, 0, 'Modern TV Stand 140 x 30', '', 1, 0, 1.00, 1.00, NULL, 'no', 'inactive', '3', '2021-02-13 10:11:59', '3', '2021-06-04 01:20:54'),
(143, 0, 142, 'Wooden', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-13 10:11:59', NULL, NULL),
(144, 5, 0, 'Metal Shelves with Wheels', '', 1, 0, 1.00, 1.00, NULL, 'no', 'inactive', '3', '2021-02-13 10:20:11', '3', '2021-06-04 01:17:50'),
(145, 0, 144, 'Silver', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-13 10:20:11', NULL, NULL),
(146, 5, 0, 'Boltless Metal Storage Rack 90 x 30', '', 1, 0, 1.00, 1.00, NULL, 'no', 'inactive', '3', '2021-02-13 10:22:01', '3', '2021-06-04 01:15:27'),
(147, 0, 146, 'Black', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-13 10:22:01', NULL, NULL),
(148, 5, 0, 'Boltless Metal Storage Rack 120 x 30', '', 1, 0, 1.00, 1.00, NULL, 'no', 'inactive', '3', '2021-02-13 10:23:57', '3', '2021-06-04 01:15:21'),
(149, 0, 148, 'Black', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-13 10:23:57', NULL, NULL),
(150, 5, 0, 'Wooden Display Shelf 3 Layers 60 x 30', '', 0, 0, 1.00, 1.00, NULL, 'no', 'inactive', '3', '2021-02-13 10:27:06', '3', '2021-06-04 01:20:18'),
(151, 0, 150, 'Black', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-13 10:27:06', '3', '2021-03-04 19:13:11'),
(152, 0, 150, 'White', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-13 10:27:06', '3', '2021-03-04 19:13:11'),
(153, 5, 0, 'Wooden Display Shelf 4 Layers 80 x 30', '', 1, 0, 1.00, 1.00, NULL, 'no', 'inactive', '3', '2021-02-13 10:28:29', '3', '2021-06-04 01:21:05'),
(154, 0, 153, 'Black', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-13 10:28:29', '3', '2021-04-18 12:32:09'),
(155, 0, 153, 'White', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-13 10:28:29', '3', '2021-04-18 12:32:09'),
(156, 5, 0, 'Wooden Display Shelf 5 Layers 80 x 30', '', 1, 0, 1.00, 1.00, NULL, 'no', 'active', '3', '2021-02-13 10:29:39', '4', '2021-06-11 16:51:27'),
(157, 0, 156, 'Black', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-13 10:29:39', '4', '2021-06-11 16:51:27'),
(158, 0, 156, 'White', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-13 10:29:39', '4', '2021-06-11 16:51:27'),
(159, 1, 0, 'Scandinavian Eames Helmet Chair', '', 4, 20, 1.00, 1.00, NULL, 'no', 'active', '2', '2021-02-16 13:48:39', '3', '2022-09-28 12:00:33'),
(160, 0, 159, 'Black', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '2', '2021-02-16 13:48:39', '3', '2022-09-28 12:00:33'),
(161, 0, 159, 'White', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '2', '2021-02-16 13:48:39', '3', '2022-09-28 12:00:33'),
(162, 0, 159, 'Grey', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '2', '2021-02-16 13:48:39', '3', '2022-09-28 12:00:33'),
(163, 1, 0, 'Scandinavian Bucket Velvet Accent Chair', '', 2, 20, 1.00, 1.00, NULL, 'no', 'active', '3', '2021-02-17 17:53:28', '3', '2022-09-02 23:44:48'),
(164, 0, 163, 'Mint Green', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-17 17:53:28', '3', '2022-09-02 23:44:48'),
(165, 0, 163, 'Blush Pink', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-17 17:53:28', '3', '2022-09-02 23:44:48'),
(166, 0, 163, 'Ocean Blue', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-17 17:53:28', '3', '2022-09-02 23:44:48'),
(167, 0, 163, 'Grey', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-17 17:53:28', '3', '2022-09-02 23:44:48'),
(168, 2, 0, 'Solid Wooden Nordic Computer Desk 140 x 55', '', 1, 0, 1.00, 1.00, NULL, 'no', 'inactive', '3', '2021-02-23 12:43:36', '3', '2021-06-04 01:20:05'),
(169, 0, 168, 'White', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-23 12:43:36', NULL, NULL),
(170, 0, 168, 'Wooden', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-23 12:43:36', NULL, NULL),
(171, 5, 0, 'Wooden Display Shelf 3 Layers 80 x 30', '', 1, 0, 1.00, 1.00, NULL, 'no', 'inactive', '3', '2021-02-23 12:51:19', '3', '2021-06-04 01:20:26'),
(172, 0, 171, 'White', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-23 12:51:19', '3', '2021-04-18 12:32:19'),
(173, 0, 171, 'Black', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-02-23 12:51:19', '3', '2021-04-18 12:32:19'),
(174, 1, 0, 'Scandinavian Eames Basic Ghost Chair', '', 4, 20, 1.00, 1.00, NULL, 'no', 'active', '4', '2021-03-08 19:12:53', '3', '2022-01-14 13:29:34'),
(175, 0, 174, 'Clear', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '4', '2021-03-08 19:12:53', '3', '2022-01-14 13:29:34'),
(176, 0, 174, 'Black', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '4', '2021-03-08 19:12:53', '3', '2022-01-14 13:29:34'),
(177, 1, 0, 'Scandinavian Eames Basic Patchwork Chair', '', 4, 20, 1.00, 1.00, NULL, 'no', 'active', '4', '2021-03-11 13:12:09', '4', '2021-06-11 16:47:45'),
(178, 0, 177, 'Design A', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '4', '2021-03-11 13:12:09', '4', '2021-06-11 16:47:45'),
(179, 0, 104, 'Grey', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '4', '2021-03-15 21:18:17', '4', '2021-06-11 16:50:13'),
(180, 0, 5, 'Yellow', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-03-26 14:52:38', '3', '2022-08-31 17:21:43'),
(181, 2, 0, 'Scandinavian Study Table with Drawer 100 x 55', '', 1, 10, 1.00, 1.00, NULL, 'no', 'inactive', '3', '2021-03-26 15:01:14', '3', '2022-07-03 10:04:08'),
(182, 0, 181, 'Natural Wood', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2021-03-26 15:01:14', '3', '2022-07-03 10:04:08'),
(183, 0, 101, 'Grey', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-03-26 15:03:34', '4', '2021-04-23 23:19:14'),
(184, 0, 65, 'Black', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-03-26 15:10:56', '4', '2021-04-28 21:49:42'),
(185, 0, 68, 'Black', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-03-26 15:11:06', '4', '2021-06-11 16:52:48'),
(186, 0, 71, 'Black', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-03-26 15:11:15', '4', '2021-04-28 21:49:47'),
(187, 5, 0, 'Scandinavian Flip Shoe Cabinet 50 x 17', '', 0, 0, 1.00, 1.00, NULL, 'no', 'inactive', '3', '2021-03-26 15:19:50', '3', '2021-10-12 17:10:02'),
(188, 0, 187, 'White', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2021-03-26 15:19:50', '3', '2021-10-12 17:10:02'),
(189, 0, 187, 'Wooden', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2021-03-26 15:19:50', '3', '2021-10-12 17:10:02'),
(190, 0, 122, 'Black', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-03-26 15:27:05', '3', '2022-06-05 12:48:14'),
(191, 0, 122, 'White', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-03-26 15:27:05', '3', '2022-06-05 12:48:14'),
(192, 0, 163, 'Lavender', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-04-16 17:09:55', '3', '2022-09-02 23:44:48'),
(193, 0, 163, 'Purple', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-04-16 17:09:55', '3', '2022-09-02 23:44:48'),
(194, 0, 163, 'Hot Pink', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-04-16 17:09:55', '3', '2022-09-02 23:44:48'),
(195, 0, 163, 'Red', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-04-16 17:09:55', '3', '2022-09-02 23:44:48'),
(196, 0, 163, 'Yellow', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-04-16 17:09:55', '3', '2022-09-02 23:44:48'),
(197, 0, 163, 'Olive Green', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-04-16 17:09:55', '3', '2022-09-02 23:44:48'),
(198, 0, 163, 'Emerald Green', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-04-16 17:09:55', '3', '2022-09-02 23:44:48'),
(199, 0, 163, 'Midnight Blue', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-04-16 17:09:55', '3', '2022-09-02 23:44:48'),
(200, 0, 163, 'Stone Blue', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-04-16 17:09:55', '3', '2022-09-02 23:44:48'),
(201, 0, 63, 'White / Orange', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-05-01 12:18:59', '4', '2022-06-07 12:44:43'),
(202, 0, 63, 'Red Mahogany / Black', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-05-01 12:18:59', '4', '2022-06-07 12:44:43'),
(203, 0, 63, 'Pine / White', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-05-01 12:18:59', '4', '2022-06-07 12:44:43'),
(204, 1, 0, 'Scandinavian Eames Doily Chair', '', 4, 20, 1.00, 1.00, NULL, 'no', 'inactive', '3', '2021-05-25 21:46:46', '3', '2022-07-20 18:28:57'),
(205, 0, 204, 'Black', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2021-05-25 21:46:46', '3', '2022-07-20 18:28:57'),
(206, 0, 204, 'White', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2021-05-25 21:46:46', '3', '2022-07-20 18:28:57'),
(207, 0, 204, 'Grey', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2021-05-25 21:46:46', '3', '2022-07-20 18:28:57'),
(208, 1, 0, 'Scandinavian Eames Doily Patchwork Chair', '', 4, 20, 1.00, 1.00, NULL, 'no', 'active', '3', '2021-05-25 21:49:00', '3', '2022-09-28 12:00:58'),
(209, 0, 208, 'Design A', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-05-25 21:49:00', '3', '2022-09-28 12:00:58'),
(210, 1, 0, 'Scandinavian Eames Helmet Padded Chair', '', 4, 20, 1.00, 1.00, NULL, 'no', 'active', '3', '2021-05-25 21:49:57', '4', '2022-05-15 22:26:31'),
(211, 0, 210, 'White / Dark Grey', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-05-25 21:49:57', '4', '2022-05-15 22:26:31'),
(212, 0, 20, 'Sage Green', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2021-07-16 14:20:31', '3', '2022-08-31 13:52:51'),
(213, 2, 0, 'Scandinavian Study Table with Drawer 80 x 50', '', 1, 10, 1.00, 1.00, NULL, 'no', 'inactive', '5', '2021-07-16 14:34:21', '3', '2022-07-03 10:04:17'),
(214, 0, 213, 'Natural Wood', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '5', '2021-07-16 14:34:21', '3', '2022-07-03 10:04:17'),
(215, 0, 63, 'Dark Oak / Black', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '5', '2021-08-05 16:00:54', '4', '2022-06-07 12:44:43'),
(216, 0, 122, 'Light Blue', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '5', '2021-08-22 18:01:18', '3', '2022-06-05 12:48:14'),
(217, 2, 0, 'Scandinavian Eames Tulip Round Table 60cm', '', 0, 0, 1.00, 1.00, NULL, 'no', 'active', '3', '2021-08-31 17:21:29', '4', '2022-01-26 14:55:29'),
(218, 0, 217, 'Black', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-08-31 17:21:29', '4', '2022-01-26 14:55:29'),
(219, 0, 217, 'White', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-08-31 17:21:29', '4', '2022-01-26 14:55:29'),
(220, 0, 217, 'Wood', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-08-31 17:21:29', '4', '2022-01-26 14:55:29'),
(221, 2, 0, 'Scandinavian Eames Tulip Round Table 70cm', '', 0, 0, 1.00, 1.00, NULL, 'no', 'active', '3', '2021-08-31 17:25:13', '4', '2022-01-26 14:55:35'),
(222, 0, 221, 'Black', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-08-31 17:25:13', '4', '2022-01-26 14:55:35'),
(223, 0, 221, 'White', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-08-31 17:25:13', '4', '2022-01-26 14:55:35'),
(224, 0, 221, 'Wood', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-08-31 17:25:13', '4', '2022-01-26 14:55:35'),
(225, 2, 0, 'Scandinavian Eames Tulip Round Table 80cm', '', 0, 0, 1.00, 1.00, NULL, 'no', 'active', '3', '2021-08-31 17:25:49', '4', '2022-01-26 14:55:41'),
(226, 0, 225, 'Black', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-08-31 17:25:49', '4', '2022-01-26 14:55:41'),
(227, 0, 225, 'White', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-08-31 17:25:49', '4', '2022-01-26 14:55:41'),
(228, 0, 225, 'Wood', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-08-31 17:25:49', '4', '2022-01-26 14:55:41'),
(229, 0, 163, 'Beige', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-06 16:13:59', '3', '2022-09-02 23:44:48'),
(230, 0, 122, 'Green', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-06 16:14:52', '3', '2022-06-05 12:48:14'),
(231, 0, 98, 'Grey', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-06 16:16:06', '3', '2022-09-28 12:00:09'),
(232, 0, 210, 'White / Avocado', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 15:35:32', '4', '2022-05-15 22:26:31'),
(233, 0, 210, 'White / Blue', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 15:35:58', '4', '2022-05-15 22:26:31'),
(234, 0, 210, 'White / Yellow', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 15:35:58', '4', '2022-05-15 22:26:31'),
(235, 1, 0, 'Scandinavian Eames Helmet Padded Swivel Chair', '', 4, 20, 1.00, 1.00, NULL, 'no', 'active', '3', '2021-10-12 15:37:19', '4', '2022-04-26 22:31:50'),
(236, 0, 235, 'White / Blue', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 15:37:19', '4', '2022-04-26 22:31:50'),
(237, 0, 235, 'White / Avocado', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 15:37:19', '4', '2022-04-26 22:31:50'),
(238, 0, 235, 'White / Light Grey', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 15:37:19', '4', '2022-04-26 22:31:50'),
(239, 0, 235, 'White / Yellow', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 15:37:19', '4', '2022-04-26 22:31:50'),
(240, 1, 0, 'Scandinavian Bucket Velvet Accent Swivel Chair', '', 0, 20, 1.00, 1.00, NULL, 'no', 'active', '3', '2021-10-12 15:47:29', '3', '2022-08-31 13:50:54'),
(241, 0, 240, 'Beige', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2021-10-12 15:47:29', '3', '2022-08-31 13:50:54'),
(242, 0, 240, 'Blush Pink', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 15:47:29', '3', '2022-08-31 13:50:54'),
(243, 0, 240, 'Emerald Green', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 15:47:29', '3', '2022-08-31 13:50:54'),
(244, 0, 240, 'Grey', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 15:47:29', '3', '2022-08-31 13:50:54'),
(245, 0, 240, 'Hot Pink', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2021-10-12 15:47:29', '3', '2022-08-31 13:50:54'),
(246, 0, 240, 'Lavender', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2021-10-12 15:47:29', '3', '2022-08-31 13:50:54'),
(247, 0, 240, 'Midnight Blue', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2021-10-12 15:47:29', '3', '2022-08-31 13:50:54'),
(248, 0, 240, 'Mint Green', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2021-10-12 15:47:29', '3', '2022-08-31 13:50:54'),
(249, 0, 240, 'Ocean Blue', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 15:47:29', '3', '2022-08-31 13:50:54'),
(250, 0, 240, 'Olive Green', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 15:47:29', '3', '2022-08-31 13:50:54'),
(251, 0, 240, 'Purple', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2021-10-12 15:47:29', '3', '2022-08-31 13:50:54'),
(252, 0, 240, 'Red', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 15:47:29', '3', '2022-08-31 13:50:54'),
(253, 0, 240, 'Stone Blue', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2021-10-12 15:47:29', '3', '2022-08-31 13:50:54'),
(254, 0, 240, 'Yellow', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 15:47:29', '3', '2022-08-31 13:50:54'),
(255, 1, 0, 'Scandinavian Shell Petal Velvet Accent Chair', '', 2, 20, 1.00, 1.00, NULL, 'no', 'active', '3', '2021-10-12 15:50:37', '3', '2022-08-31 13:50:27'),
(256, 0, 255, 'Beige', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 15:50:37', '3', '2022-08-31 13:50:27'),
(257, 0, 255, 'Blush Pink', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 15:50:37', '3', '2022-08-31 13:50:27'),
(258, 0, 255, 'Emerald Green', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 15:50:37', '3', '2022-08-31 13:50:27'),
(259, 0, 255, 'Grey', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 15:50:37', '3', '2022-08-31 13:50:27'),
(260, 0, 255, 'Hot Pink', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 15:50:37', '3', '2022-08-31 13:50:27'),
(261, 0, 255, 'Lavender', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 15:50:37', '3', '2022-08-31 13:50:27'),
(262, 0, 255, 'Midnight Blue', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 15:50:37', '3', '2022-08-31 13:50:27'),
(263, 0, 255, 'Mint Green', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 15:50:37', '3', '2022-08-31 13:50:27'),
(264, 0, 255, 'Ocean Blue', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 15:50:37', '3', '2022-08-31 13:50:27'),
(265, 0, 255, 'Olive Green', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 15:50:37', '3', '2022-08-31 13:50:27'),
(266, 0, 255, 'Purple', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 15:50:37', '3', '2022-08-31 13:50:27'),
(267, 0, 255, 'Red', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 15:50:37', '3', '2022-08-31 13:50:27'),
(268, 0, 255, 'Stone Blue', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 15:50:37', '3', '2022-08-31 13:50:27'),
(269, 0, 255, 'Yellow', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 15:50:37', '3', '2022-08-31 13:50:27'),
(270, 1, 0, 'Scandinavian Shell Petal Velvet Accent Swivel Chair', '', 2, 20, 1.00, 1.00, NULL, 'no', 'active', '3', '2021-10-12 15:51:47', '3', '2022-08-31 13:49:50'),
(271, 0, 270, 'Beige', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2021-10-12 15:51:47', '3', '2022-08-31 13:49:50'),
(272, 0, 270, 'Blush Pink', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2021-10-12 15:51:47', '3', '2022-08-31 13:49:50'),
(273, 0, 270, 'Emerald Green', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 15:51:47', '3', '2022-08-31 13:49:50'),
(274, 0, 270, 'Grey', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 15:51:47', '3', '2022-08-31 13:49:50'),
(275, 0, 270, 'Hot Pink', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2021-10-12 15:51:47', '3', '2022-08-31 13:49:50'),
(276, 0, 270, 'Lavender', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2021-10-12 15:51:47', '3', '2022-08-31 13:49:50'),
(277, 0, 270, 'Midnight Blue', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 15:51:47', '3', '2022-08-31 13:49:50'),
(278, 0, 270, 'Mint Green', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 15:51:47', '3', '2022-08-31 13:49:50'),
(279, 0, 270, 'Ocean Blue', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 15:51:47', '3', '2022-08-31 13:49:50'),
(280, 0, 270, 'Olive Green', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 15:51:47', '3', '2022-08-31 13:49:50'),
(281, 0, 270, 'Purple', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2021-10-12 15:51:47', '3', '2022-08-31 13:49:50'),
(282, 0, 270, 'Red', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2021-10-12 15:51:47', '3', '2022-08-31 13:49:50'),
(283, 0, 270, 'Stone Blue', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 15:51:47', '3', '2022-08-31 13:49:50'),
(284, 0, 270, 'Yellow', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 15:51:47', '3', '2022-08-31 13:49:50'),
(285, 1, 0, 'Scandinavian Modern Metal Barstool Wooden Legs', '', 4, 20, 1.00, 1.00, NULL, 'no', 'active', '3', '2021-10-12 16:13:08', '3', '2022-09-28 12:01:29'),
(286, 0, 285, 'Black', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 16:13:08', '3', '2022-09-28 12:01:29'),
(287, 0, 285, 'Grey', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 16:13:08', '3', '2022-09-28 12:01:29'),
(288, 0, 285, 'White', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 16:13:08', '3', '2022-09-28 12:01:29'),
(289, 1, 0, 'Scandinavian Eames Tulip High Chair', '', 4, 20, 1.00, 1.00, NULL, 'no', 'active', '3', '2021-10-12 16:17:18', '3', '2022-09-28 15:19:37'),
(290, 0, 289, 'Black', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 16:17:18', '3', '2022-09-28 15:19:37'),
(291, 0, 289, 'Grey', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 16:17:18', '3', '2022-09-28 15:19:37'),
(292, 0, 289, 'White', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 16:17:18', '3', '2022-09-28 15:19:37'),
(293, 0, 12, 'Yellow', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 17:56:33', '4', '2022-01-05 21:21:34'),
(294, 1, 0, 'Modern Metal Design Tolix Chair', '', 5, 10, 1.00, 1.00, NULL, 'no', 'active', '3', '2021-10-12 20:07:57', '3', '2022-11-26 12:23:41'),
(295, 0, 294, 'Matte Black', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2021-10-12 20:07:57', '3', '2022-11-26 12:23:41'),
(296, 0, 294, 'Semi Gloss Red', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 20:07:57', '3', '2022-11-26 12:23:41'),
(297, 0, 294, 'Matte Grey', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2021-10-12 20:07:57', '3', '2022-11-26 12:23:41'),
(298, 0, 294, 'Semi Gloss Black', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 20:07:57', '3', '2022-11-26 12:23:41'),
(299, 0, 294, 'Semi Gloss White', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 20:07:57', '3', '2022-11-26 12:23:41'),
(300, 0, 294, 'Semi Gloss Grey', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 20:07:57', '3', '2022-11-26 12:23:41'),
(301, 1, 0, 'Modern Metal Design Tolix Chair with Wooden Padding', '', 0, 10, 1.00, 1.00, NULL, 'no', 'active', '3', '2021-10-12 20:10:39', '3', '2022-11-26 12:24:26'),
(302, 0, 301, 'Semi Gloss Rust', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 20:10:39', '3', '2022-11-26 12:24:26'),
(303, 0, 301, 'Matte Grey', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2021-10-12 20:10:39', '3', '2022-11-26 12:24:26'),
(304, 0, 301, 'Semi Gloss Red', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 20:10:39', '3', '2022-11-26 12:24:26'),
(305, 0, 301, 'Semi Gloss Black', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 20:10:39', '3', '2022-11-26 12:24:26'),
(306, 0, 301, 'Semi Gloss Grey', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 20:10:39', '3', '2022-11-26 12:24:26'),
(307, 0, 301, 'Semi Gloss White', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 20:10:39', '3', '2022-11-26 12:24:26'),
(308, 1, 0, 'Modern Metal Design Tolix Armrest Chair', '', 4, 10, 1.00, 1.00, NULL, 'no', 'active', '3', '2021-10-12 20:11:39', '3', '2022-11-13 16:01:14'),
(309, 0, 308, 'Semi Gloss Red', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 20:11:39', '3', '2022-11-13 16:01:14'),
(310, 0, 308, 'Semi Gloss Rust', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 20:11:39', '3', '2022-11-13 16:01:14'),
(311, 0, 308, 'Matte White', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2021-10-12 20:11:39', '3', '2022-11-13 16:01:14'),
(312, 0, 308, 'Semi Gloss Black', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 20:11:39', '3', '2022-11-13 16:01:14'),
(313, 0, 308, 'Semi Gloss Grey', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 20:11:39', '3', '2022-11-13 16:01:14'),
(314, 0, 308, 'Semi Gloss White', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 20:11:39', '3', '2022-11-13 16:01:14'),
(315, 1, 0, 'Modern Metal Design Tolix Armrest Chair with Wooden Padding', '', 4, 10, 1.00, 1.00, NULL, 'no', 'active', '3', '2021-10-12 20:14:59', '3', '2022-11-13 16:01:22'),
(316, 0, 315, 'Semi Gloss Red', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 20:14:59', '3', '2022-11-13 16:01:22'),
(317, 0, 315, 'Semi Gloss Rust', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 20:14:59', '3', '2022-11-13 16:01:22'),
(318, 0, 315, 'Matte White', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2021-10-12 20:14:59', '3', '2022-11-13 16:01:22'),
(319, 0, 315, 'Semi Gloss Black', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 20:14:59', '3', '2022-11-13 16:01:22'),
(320, 0, 315, 'Semi Gloss Grey', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 20:14:59', '3', '2022-11-13 16:01:22'),
(321, 0, 315, 'Semi Gloss White', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 20:14:59', '3', '2022-11-13 16:01:22'),
(322, 1, 0, 'Modern Metal Design Tolix Barstool Chair with Wooden Padding', '', 0, 10, 1.00, 1.00, NULL, 'no', 'active', '3', '2021-10-12 20:16:35', '3', '2022-11-13 16:02:00'),
(323, 0, 322, 'Semi Gloss Rust', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 20:16:35', '3', '2022-11-13 16:02:00'),
(324, 0, 322, 'Matte Grey', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2021-10-12 20:16:35', '3', '2022-11-13 16:02:00'),
(325, 0, 322, 'Semi Gloss Red', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 20:16:35', '3', '2022-11-13 16:02:00'),
(326, 0, 322, 'Semi Gloss Black', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 20:16:35', '3', '2022-11-13 16:02:00'),
(327, 0, 322, 'Semi Gloss Grey', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 20:16:35', '3', '2022-11-13 16:02:00'),
(328, 0, 322, 'Semi Gloss White', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 20:16:35', '3', '2022-11-13 16:02:00'),
(329, 1, 0, 'Modern Metal Design Tolix Barstool Chair', '', 0, 10, 1.00, 1.00, NULL, 'no', 'active', '3', '2021-10-12 20:16:38', '3', '2022-11-13 16:01:29'),
(330, 0, 329, 'Semi Gloss Rust', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 20:16:38', '3', '2022-11-13 16:01:29'),
(331, 0, 329, 'Matte Grey', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2021-10-12 20:16:38', '3', '2022-11-13 16:01:29'),
(332, 0, 329, 'Semi Gloss Red', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 20:16:38', '3', '2022-11-13 16:01:29'),
(333, 0, 329, 'Semi Gloss Black', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 20:16:38', '3', '2022-11-13 16:01:29'),
(334, 0, 329, 'Semi Gloss Grey', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 20:16:38', '3', '2022-11-13 16:01:29'),
(335, 0, 329, 'Semi Gloss White', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-12 20:16:38', '3', '2022-11-13 16:01:29'),
(336, 0, 174, 'Green', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-22 11:53:28', '3', '2022-01-14 13:29:34'),
(337, 0, 174, 'Yellow', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-22 11:53:28', '3', '2022-01-14 13:29:34'),
(338, 0, 235, 'Black / Black', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-22 11:54:24', '4', '2022-04-26 22:31:50'),
(339, 0, 210, 'Black / Black', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-22 11:55:06', '4', '2022-05-15 22:26:31'),
(340, 0, 12, 'Sea Green', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-10-25 12:41:09', '4', '2022-01-05 21:21:34'),
(341, 0, 235, 'White / Dark Grey', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2021-12-11 17:36:16', '4', '2022-04-26 22:31:50'),
(342, 0, 12, 'Apple Green', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '4', '2021-12-12 15:02:35', '4', '2022-01-05 21:21:34'),
(343, 0, 122, 'Yellow', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-01-05 17:52:21', '3', '2022-06-05 12:48:14'),
(344, 0, 174, 'Grey', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-01-14 13:29:11', '3', '2022-01-14 13:29:34'),
(345, 0, 122, 'Off White', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-02-04 13:16:41', '3', '2022-06-05 12:48:14'),
(346, 0, 63, 'White / Black', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-02-05 16:34:01', '4', '2022-06-07 12:44:43'),
(347, 0, 98, 'Blue', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2022-03-04 09:55:50', '3', '2022-09-28 12:00:09'),
(348, 0, 294, 'Semi Gloss Rust', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-03-18 16:05:52', '3', '2022-11-26 12:23:41'),
(349, 1, 0, 'Scandinavian Hendrik Leatherette Chair', '', 0, 10, 1.00, 1.00, NULL, 'no', 'active', '3', '2022-03-24 17:41:27', '3', '2022-11-16 12:50:11'),
(350, 0, 349, 'Beige', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-03-24 17:41:27', '3', '2022-11-16 12:50:11'),
(351, 0, 349, 'Blue', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-03-24 17:41:27', '3', '2022-11-16 12:50:11'),
(352, 0, 349, 'Dark Brown', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-03-24 17:41:27', '3', '2022-11-16 12:50:11'),
(354, 0, 349, 'Green', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-03-24 17:41:27', '3', '2022-11-16 12:50:11'),
(355, 0, 349, 'Coffee', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-03-24 17:41:27', '3', '2022-11-16 12:50:11'),
(357, 0, 349, 'Black', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-03-24 17:41:27', '3', '2022-11-16 12:50:11'),
(358, 1, 0, 'Scandinavian Boden Chair', '', 0, 10, 1.00, 1.00, NULL, 'no', 'active', '3', '2022-03-24 18:50:28', '4', '2022-08-07 14:48:52'),
(359, 0, 358, 'Beige', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-03-24 18:50:28', '4', '2022-08-07 14:48:52'),
(360, 0, 358, 'Blue', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-03-24 18:50:28', '4', '2022-08-07 14:48:52'),
(361, 0, 358, 'Dark Grey', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-03-24 18:50:28', '4', '2022-08-07 14:48:52'),
(362, 0, 358, 'Grey', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-03-24 18:50:28', '4', '2022-08-07 14:48:52'),
(363, 0, 358, 'Green', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-03-24 18:50:28', '4', '2022-08-07 14:48:52'),
(364, 0, 358, 'Yellow', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-03-24 18:50:28', '4', '2022-08-07 14:48:52'),
(365, 2, 0, 'Scandinavian Asmund Bar Table', '', 1, 1, 1.00, 1.00, NULL, 'no', 'inactive', '3', '2022-03-25 10:58:26', '3', '2022-12-14 17:12:55'),
(366, 0, 365, 'White 1.0M', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2022-03-25 10:58:26', '3', '2022-12-14 17:12:55'),
(367, 0, 365, 'White 1.2M', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2022-03-25 10:58:26', '3', '2022-12-14 17:12:55'),
(368, 0, 365, 'Wood 1.0M', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2022-03-25 10:58:26', '3', '2022-12-14 17:12:55'),
(369, 0, 365, 'Wood 1.2M', '', 0, 0, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2022-03-25 10:58:26', '3', '2022-12-14 17:12:55'),
(370, 7, 0, 'Scandinavian Muji Inspired Sofa 1 Seater', '', 1, 0, 1.00, 1.00, NULL, 'no', 'active', '3', '2022-03-30 16:58:55', '3', '2022-05-24 12:39:04'),
(371, 0, 370, 'Beige', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-03-30 16:58:55', '3', '2022-05-24 12:39:04'),
(372, 0, 370, 'Grey', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-03-30 16:58:55', '3', '2022-05-24 12:39:04'),
(374, 7, 0, 'Scandinavian Muji Inspired Sofa 2 Seater', '', 1, 0, 1.00, 1.00, NULL, 'no', 'active', '3', '2022-03-30 17:00:02', '3', '2022-05-24 12:39:36'),
(375, 0, 374, 'Beige', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-03-30 17:00:02', '3', '2022-05-24 12:39:36'),
(376, 0, 374, 'Grey', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-03-30 17:00:02', '3', '2022-05-24 12:39:36'),
(378, 7, 0, 'Scandinavian Muji Inspired Sofa 3 Seater (150cm)', '', 1, 0, 1.00, 1.00, NULL, 'no', 'active', '3', '2022-03-30 17:00:45', '3', '2022-05-24 12:39:53'),
(379, 0, 378, 'Beige', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-03-30 17:00:45', '3', '2022-05-24 12:39:53'),
(380, 0, 378, 'Grey', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-03-30 17:00:45', '3', '2022-05-24 12:39:53'),
(382, 7, 0, 'Scandinavian Muji Inspired Sofa 3 Seater (180cm)', '', 1, 0, 1.00, 1.00, NULL, 'no', 'active', '3', '2022-03-30 17:01:56', '3', '2022-05-24 12:55:25'),
(383, 0, 382, 'Beige', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-03-30 17:01:56', '3', '2022-05-24 12:55:25'),
(384, 0, 382, 'Grey', '', 0, 0, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-03-30 17:01:56', '3', '2022-05-24 12:55:25'),
(386, 2, 0, 'Scandinavian Anderson Round V Legged Center Table', '', 1, 0, 1.00, 1.00, NULL, 'no', 'active', '3', '2022-04-12 12:00:45', '4', '2022-05-23 01:19:24'),
(387, NULL, 386, 'Wooden', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-04-12 12:00:45', '4', '2022-05-23 01:19:24'),
(388, 2, 0, 'Scandinavian Bodie Double Deck Center Table', '', 1, 0, 1.00, 1.00, NULL, 'no', 'active', '3', '2022-04-12 12:29:11', '4', '2022-05-23 01:20:58'),
(389, NULL, 388, 'Wooden', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-04-12 12:29:11', '4', '2022-05-23 01:20:58');
INSERT INTO `tbl_item` (`item_id`, `item_category_id`, `parent`, `name`, `color`, `carton_quantity`, `stock_level`, `wholesale_price`, `retail_price`, `inventory_age`, `hidden_wholesale`, `status`, `added_by`, `added_on`, `updated_by`, `updated_on`) VALUES
(390, 2, 0, 'Scandinavian Osman V Legged Center Table', '', 1, 0, 1.00, 1.00, NULL, 'no', 'active', '3', '2022-04-12 12:40:41', '4', '2022-05-23 01:21:10'),
(391, NULL, 390, 'Wooden', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-04-12 12:40:41', '4', '2022-05-23 01:21:10'),
(392, 1, 0, 'Eames Gunnar Accent Chair', '', 1, 0, 1.00, 1.00, NULL, 'no', 'inactive', '3', '2022-04-25 16:34:23', '3', '2022-12-14 17:08:35'),
(393, NULL, 392, 'Walnut / Leather Black', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2022-04-25 16:34:23', '3', '2022-12-14 17:08:35'),
(394, NULL, 392, 'Pine / Leather White', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2022-04-25 16:34:23', '3', '2022-12-14 17:08:35'),
(395, NULL, 392, 'Walnut / Leather Grey', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2022-04-25 16:34:23', '3', '2022-12-14 17:08:35'),
(396, NULL, 392, 'Walnut / Fabric Dark Grey', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2022-04-25 16:34:23', '3', '2022-12-14 17:08:35'),
(397, NULL, 392, 'Walnut / Fabric Light Grey', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2022-04-25 16:34:23', '3', '2022-12-14 17:08:35'),
(398, NULL, 392, 'Walnut / Fabric White', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2022-04-25 16:34:23', '3', '2022-12-14 17:08:35'),
(399, 1, 0, 'Eames Ivan Accent Chair', '', 1, 0, 1.00, 1.00, NULL, 'no', 'inactive', '3', '2022-04-25 17:10:41', '3', '2022-12-14 17:08:40'),
(400, NULL, 399, 'Walnut / Leather Black', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2022-04-25 17:10:41', '3', '2022-12-14 17:08:40'),
(401, NULL, 399, 'Pine / Leather White', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2022-04-25 17:10:41', '3', '2022-12-14 17:08:40'),
(402, 1, 0, 'Scandinavian Solid Wood Horn Chair', '', 2, 0, 1.00, 1.00, NULL, 'no', 'active', '3', '2022-04-26 16:55:41', '3', '2022-09-01 15:03:01'),
(403, NULL, 402, 'Pine Wood / Black Leather', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2022-04-26 16:55:41', '3', '2022-09-01 15:03:01'),
(404, NULL, 402, 'Pine Wood / White Leather', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2022-04-26 16:55:41', '3', '2022-09-01 15:03:01'),
(405, NULL, 402, 'Dark Walnut Wood / Black Leather', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2022-04-26 16:55:41', '3', '2022-09-01 15:03:01'),
(406, NULL, 402, 'Dark Walnut Wood / White Leather', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2022-04-26 16:55:41', '3', '2022-09-01 15:03:01'),
(407, 1, 0, 'Scandinavian Solid Wood Raynell Chair', '', 1, 0, 1.00, 1.00, NULL, 'no', 'active', '3', '2022-04-26 18:01:17', '4', '2022-05-23 01:16:27'),
(408, NULL, 407, 'Wooden / Grey (Fabric)', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-04-26 18:01:17', '4', '2022-05-23 01:16:27'),
(409, NULL, 407, 'Wooden / Black (Leather)', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-04-26 18:01:17', '4', '2022-05-23 01:16:27'),
(410, NULL, 407, 'Walnut / Grey (Fabric)', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-04-26 18:01:17', '4', '2022-05-23 01:16:27'),
(411, NULL, 210, 'White / Light Grey', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-04-28 17:17:48', '4', '2022-05-15 22:26:31'),
(412, NULL, 57, 'Dark Oak / Black', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-05-01 14:28:18', NULL, NULL),
(413, 1, 0, 'Eames Executive Conference Chair', '', 1, 0, 1.00, 1.00, NULL, 'no', 'inactive', '3', '2022-05-01 14:48:06', '3', '2022-12-14 17:08:32'),
(414, NULL, 413, 'Dark Oak / Black', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2022-05-01 14:48:06', '3', '2022-12-14 17:08:32'),
(415, NULL, 413, 'Dark Oak / White', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2022-05-01 14:48:06', '3', '2022-12-14 17:08:32'),
(416, 1, 0, 'Scandinavian Kali Chair', '', 4, 8, 1.00, 1.00, NULL, 'no', 'active', '3', '2022-07-07 11:17:14', '4', '2022-08-07 14:53:42'),
(417, NULL, 416, 'Black / White', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-07-07 11:17:14', '4', '2022-08-07 14:53:42'),
(418, NULL, 416, 'Black / Grey', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-07-07 11:17:14', '4', '2022-08-07 14:53:42'),
(419, NULL, 416, 'Brown / Grey', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-07-07 11:17:14', '4', '2022-08-07 14:53:42'),
(420, NULL, 416, 'Dark Grey / Grey', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-07-07 11:17:14', '4', '2022-08-07 14:53:42'),
(421, NULL, 416, 'Dark Grey / White', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-07-07 11:17:14', '4', '2022-08-07 14:53:42'),
(422, NULL, 416, 'Grey / White', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-07-07 11:17:14', '4', '2022-08-07 14:53:42'),
(423, NULL, 416, 'Brown / White', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-07-07 11:17:14', '4', '2022-08-07 14:53:42'),
(424, NULL, 402, 'Walnut Wood / Black Leather', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2022-07-17 01:10:49', '3', '2022-09-01 15:03:01'),
(425, NULL, 402, 'Walnut Wood / White Leather', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2022-07-17 01:10:49', '3', '2022-09-01 15:03:01'),
(426, NULL, 402, 'Black Wood / Black Leather', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2022-07-17 01:10:49', '3', '2022-09-01 15:03:01'),
(427, NULL, 402, 'Black Wood / White Leather', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'inactive', '3', '2022-07-17 01:10:49', '3', '2022-09-01 15:03:01'),
(428, 1, 0, 'Stackable Horn Plastic Chair', '', 1, 0, 1.00, 1.00, NULL, 'no', 'active', '3', '2022-07-18 15:13:02', '3', '2022-09-14 14:55:13'),
(429, NULL, 428, 'Black', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-07-18 15:13:02', '3', '2022-09-14 14:55:13'),
(430, NULL, 428, 'White', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-07-18 15:13:02', '3', '2022-09-14 14:55:13'),
(431, NULL, 428, 'Grey', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-07-18 15:13:02', '3', '2022-09-14 14:55:13'),
(432, NULL, 428, 'Apple Green', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-07-18 15:13:02', '3', '2022-09-14 14:55:13'),
(433, NULL, 428, 'Yellow', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-07-18 15:13:02', '3', '2022-09-14 14:55:13'),
(434, NULL, 428, 'Brown', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-07-18 15:13:02', '3', '2022-09-14 14:55:13'),
(435, NULL, 428, 'Green', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-07-18 15:13:02', '3', '2022-09-14 14:55:13'),
(436, NULL, 428, 'Blue', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-07-18 15:13:02', '3', '2022-09-14 14:55:13'),
(437, 1, 0, 'Stackable Aksel Plastic Chair', '', 1, 0, 1.00, 1.00, NULL, 'no', 'active', '3', '2022-07-18 15:32:21', '3', '2022-09-14 15:14:02'),
(438, NULL, 437, 'Black', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-07-18 15:32:21', '3', '2022-09-14 15:14:02'),
(439, NULL, 437, 'White', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-07-18 15:32:21', '3', '2022-09-14 15:14:02'),
(440, NULL, 437, 'Grey', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-07-18 15:32:21', '3', '2022-09-14 15:14:02'),
(441, NULL, 437, 'Sea Green', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-07-18 15:32:21', '3', '2022-09-14 15:14:02'),
(442, NULL, 437, 'Yellow', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-07-18 15:32:21', '3', '2022-09-14 15:14:02'),
(443, NULL, 437, 'Brown', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-07-18 15:32:21', '3', '2022-09-14 15:14:02'),
(444, NULL, 437, 'Mint Green', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-07-18 15:32:21', '3', '2022-09-14 15:14:02'),
(445, NULL, 437, 'Blue', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-07-18 15:32:21', '3', '2022-09-14 15:14:02'),
(446, 1, 0, 'Stackable Bernie Plastic Chair', '', 1, 0, 1.00, 1.00, NULL, 'no', 'active', '3', '2022-07-18 15:46:07', '3', '2022-09-14 15:01:53'),
(447, NULL, 446, 'Black', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-07-18 15:46:07', '3', '2022-09-14 15:01:53'),
(448, NULL, 446, 'White', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-07-18 15:46:07', '3', '2022-09-14 15:01:53'),
(449, NULL, 446, 'Grey', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-07-18 15:46:07', '3', '2022-09-14 15:01:53'),
(450, NULL, 446, 'Green', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-07-18 15:46:07', '3', '2022-09-14 15:01:53'),
(451, NULL, 446, 'Yellow', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-07-18 15:46:07', '3', '2022-09-14 15:01:53'),
(452, NULL, 446, 'Brown', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-07-18 15:46:07', '3', '2022-09-14 15:01:53'),
(453, NULL, 446, 'Apple Green', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-07-18 15:46:07', '3', '2022-09-14 15:01:53'),
(454, NULL, 446, 'Blue', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-07-18 15:46:07', '3', '2022-09-14 15:01:53'),
(455, 1, 0, 'Stackable Danby Plastic Chair', '', 1, 0, 1.00, 1.00, NULL, 'no', 'active', '3', '2022-07-18 15:52:48', '3', '2022-09-14 15:18:53'),
(456, NULL, 455, 'Black', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-07-18 15:52:48', '3', '2022-09-14 15:18:53'),
(457, NULL, 455, 'White', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-07-18 15:52:48', '3', '2022-09-14 15:18:53'),
(458, NULL, 455, 'Yellow', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-07-18 15:52:48', '3', '2022-09-14 15:18:53'),
(459, NULL, 455, 'Mint Green', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-07-18 15:52:48', '3', '2022-09-14 15:18:53'),
(460, NULL, 455, 'Orange', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-07-18 15:52:48', '3', '2022-09-14 15:18:53'),
(461, NULL, 455, 'Blue', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-07-18 15:52:48', '3', '2022-09-14 15:18:53'),
(462, NULL, 455, 'Red', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-07-18 15:52:48', '3', '2022-09-14 15:18:53'),
(463, NULL, 455, 'Pink', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-07-18 15:52:48', '3', '2022-09-14 15:18:53'),
(464, NULL, 402, 'Frame - Pine Wood', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-08-22 15:37:33', '3', '2022-09-01 15:03:01'),
(465, NULL, 402, 'Frame - Dark Walnut Wood', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-08-22 15:37:33', '3', '2022-09-01 15:03:01'),
(466, NULL, 402, 'Frame - Black Wood', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-08-22 15:37:33', '3', '2022-09-01 15:03:01'),
(467, NULL, 402, 'Frame - Walnut Wood', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-08-22 15:37:33', '3', '2022-09-01 15:03:01'),
(468, NULL, 402, 'Seat - Black Leather', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-08-22 15:37:33', '3', '2022-09-01 15:03:01'),
(469, NULL, 402, 'Seat - White Leather', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-08-22 15:37:33', '3', '2022-09-01 15:03:01'),
(470, NULL, 402, 'Frame - Chestnut', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-08-25 13:54:53', '3', '2022-09-01 15:03:01'),
(471, 2, 0, 'Scandinavian Dining Table Solid Rubberwood', '', 1, 0, 1.00, 1.00, NULL, 'no', 'active', '3', '2022-10-12 12:38:29', NULL, NULL),
(472, NULL, 471, '120 x 70', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-10-12 12:38:29', NULL, NULL),
(473, NULL, 471, '130 x 80', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-10-12 12:38:29', NULL, NULL),
(474, NULL, 471, '140 x 80', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-10-12 12:38:29', NULL, NULL),
(475, NULL, 471, '150 x 80', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-10-12 12:38:29', NULL, NULL),
(476, NULL, 471, '160 x 80', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-10-12 12:38:29', NULL, NULL),
(477, 1, 0, 'Scandinavian Windsor Solid Rubberwood Chair', '', 2, 0, 1.00, 1.00, NULL, 'no', 'active', '3', '2022-10-12 12:54:24', NULL, NULL),
(478, NULL, 477, 'Wood', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-10-12 12:54:24', NULL, NULL),
(479, 1, 0, 'Modern Metal Design Tolix Barstool Low Chair', '', 18, 1, 1.00, 1.00, NULL, 'no', 'active', '3', '2022-11-02 13:52:08', '3', '2022-11-13 16:02:08'),
(480, NULL, 479, 'Semi Gloss Black', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-11-02 13:52:08', '3', '2022-11-13 16:02:08'),
(481, NULL, 479, 'Semi Gloss Grey', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-11-02 13:52:08', '3', '2022-11-13 16:02:08'),
(482, NULL, 479, 'Semi Gloss Red', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-11-02 13:52:08', '3', '2022-11-13 16:02:08'),
(483, NULL, 479, 'Semi Gloss White', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-11-02 13:52:08', '3', '2022-11-13 16:02:08'),
(484, 1, 0, 'Modern Metal Design Tolix Barstool Chair Backrest', '', 17, 1, 1.00, 1.00, NULL, 'no', 'active', '3', '2022-11-02 14:02:30', '3', '2022-11-13 16:01:39'),
(485, NULL, 484, 'Semi Gloss Black', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-11-02 14:02:30', '3', '2022-11-13 16:01:39'),
(486, NULL, 484, 'Semi Gloss Grey', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-11-02 14:02:30', '3', '2022-11-13 16:01:39'),
(487, NULL, 484, 'Semi Gloss Red', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-11-02 14:02:30', '3', '2022-11-13 16:01:39'),
(488, NULL, 484, 'Semi Gloss White', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-11-02 14:02:30', '3', '2022-11-13 16:01:39'),
(489, 1, 0, 'Modern Metal Design Tolix Barstool Chair Backrest with Wood Padding', '', 17, 1, 1.00, 1.00, NULL, 'no', 'active', '3', '2022-11-02 14:03:11', '3', '2022-11-13 16:01:50'),
(490, NULL, 489, 'Semi Gloss Black', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-11-02 14:03:11', '3', '2022-11-13 16:01:50'),
(491, NULL, 489, 'Semi Gloss Grey', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-11-02 14:03:11', '3', '2022-11-13 16:01:50'),
(492, NULL, 489, 'Semi Gloss Red', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-11-02 14:03:11', '3', '2022-11-13 16:01:50'),
(493, NULL, 489, 'Semi Gloss White', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-11-02 14:03:11', '3', '2022-11-13 16:01:50'),
(494, 1, 0, 'Scandinavian Bread Chair', '', 2, 1, 1.00, 1.00, NULL, 'no', 'active', '3', '2022-11-03 11:28:44', NULL, NULL),
(495, NULL, 494, 'Beige', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-11-03 11:28:44', NULL, NULL),
(496, NULL, 494, 'Grey', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-11-03 11:28:44', NULL, NULL),
(497, NULL, 484, 'Semi Gloss Rust', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-11-13 16:01:39', NULL, NULL),
(498, NULL, 489, 'Semi Gloss Rust', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-11-13 16:01:50', NULL, NULL),
(499, NULL, 479, 'Semi Gloss Rust', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-11-13 16:02:08', NULL, NULL),
(500, NULL, 349, 'Orange', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-11-16 12:50:11', NULL, NULL),
(501, 1, 0, 'Scandinavian Nixon Dining Chair', '', 2, 10, 1.00, 1.00, NULL, 'no', 'active', '3', '2022-12-14 18:00:29', NULL, NULL),
(502, NULL, 501, '[FRAME] Dark Walnut', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-12-14 18:00:29', NULL, NULL),
(503, NULL, 501, '[FRAME] Pine Wood', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-12-14 18:00:29', NULL, NULL),
(504, NULL, 501, '[SEAT] Light Brown', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-12-14 18:00:29', NULL, NULL),
(505, NULL, 501, '[SEAT] Light Grey', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-12-14 18:00:29', NULL, NULL),
(506, 1, 0, 'Scandinavian Olivia Barstool', '', 4, 0, 1.00, 1.00, NULL, 'no', 'active', '3', '2022-12-27 09:59:07', '3', '2022-12-27 10:01:06'),
(507, NULL, 506, 'Beige', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-12-27 09:59:07', '3', '2022-12-27 10:01:06'),
(508, NULL, 506, 'Grey', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2022-12-27 09:59:07', '3', '2022-12-27 10:01:06'),
(509, 2, 0, 'Sebastian Round Table', '', 1, 0, 1.00, 1.00, NULL, 'no', 'active', '3', '2023-01-12 16:11:00', '3', '2023-01-12 16:22:59'),
(510, NULL, 509, '50cm', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2023-01-12 16:11:00', '3', '2023-01-12 16:22:59'),
(511, NULL, 509, '60cm', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2023-01-12 16:11:00', '3', '2023-01-12 16:22:59'),
(512, NULL, 509, '70cm', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2023-01-12 16:11:00', '3', '2023-01-12 16:22:59'),
(513, NULL, 509, '80cm', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2023-01-12 16:11:00', '3', '2023-01-12 16:22:59'),
(514, 2, 0, 'Sebastian Sqaure Table', '', 1, 0, 1.00, 1.00, NULL, 'no', 'active', '3', '2023-01-12 16:22:37', '3', '2023-01-12 16:23:51'),
(515, NULL, 514, '70 x 70', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2023-01-12 16:22:37', '3', '2023-01-12 16:23:51'),
(516, NULL, 514, '80 x 80', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2023-01-12 16:22:37', '3', '2023-01-12 16:23:51'),
(517, 1, 0, 'Lucas Stool', '', 1, 1, 1.00, 1.00, NULL, 'no', 'active', '3', '2023-01-23 17:04:33', '3', '2023-02-02 12:01:10'),
(518, NULL, 517, 'Round', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2023-01-23 17:04:33', '3', '2023-02-02 12:01:10'),
(519, NULL, 517, 'Square', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2023-01-23 17:04:33', '3', '2023-02-02 12:01:10'),
(520, 1, 0, 'Elias Chair', '', 4, 1, 1.00, 1.00, NULL, 'no', 'active', '3', '2023-02-02 12:06:11', NULL, NULL),
(521, NULL, 520, 'Beige', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2023-02-02 12:06:11', NULL, NULL),
(522, NULL, 520, 'Grey', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2023-02-02 12:06:11', NULL, NULL),
(523, 1, 0, 'Andy Chair', '', 2, 1, 1.00, 1.00, NULL, 'no', 'active', '3', '2023-02-02 13:13:41', '3', '2023-02-02 13:21:48'),
(524, NULL, 523, 'Black', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2023-02-02 13:13:41', '3', '2023-02-02 13:21:48'),
(525, NULL, 523, 'Brown', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2023-02-02 13:13:41', '3', '2023-02-02 13:21:48'),
(526, NULL, 523, 'Grey', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2023-02-02 13:13:41', '3', '2023-02-02 13:21:48'),
(527, 1, 0, 'Harvey Barstool', '', 2, 1, 1.00, 1.00, NULL, 'no', 'active', '3', '2023-02-02 13:17:29', NULL, NULL),
(528, NULL, 527, 'Black', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2023-02-02 13:17:29', NULL, NULL),
(529, NULL, 527, 'Grey', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2023-02-02 13:17:29', NULL, NULL),
(530, NULL, 527, 'Orange', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2023-02-02 13:17:29', NULL, NULL),
(531, 1, 0, 'Andy Barstool', '', 2, 1, 1.00, 1.00, NULL, 'no', 'active', '3', '2023-02-02 13:39:08', NULL, NULL),
(532, NULL, 531, 'Black', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2023-02-02 13:39:08', NULL, NULL),
(533, NULL, 531, 'Grey', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2023-02-02 13:39:08', NULL, NULL),
(534, NULL, 531, 'Orange', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2023-02-02 13:39:08', NULL, NULL),
(535, 1, 0, 'Talya Chair', '', 1, 1, 1.00, 1.00, NULL, 'no', 'active', '3', '2023-02-02 14:00:58', NULL, NULL),
(536, NULL, 535, 'Black', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2023-02-02 14:00:58', NULL, NULL),
(537, NULL, 535, 'White', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2023-02-02 14:00:58', NULL, NULL),
(538, 1, 0, 'Talya Armrest Chair', '', 1, 1, 1.00, 1.00, NULL, 'no', 'active', '3', '2023-02-02 14:02:36', '3', '2023-02-02 14:07:26'),
(539, NULL, 538, 'Black', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2023-02-02 14:02:36', '3', '2023-02-02 14:07:26'),
(540, NULL, 538, 'White', '', NULL, NULL, 1.00, 1.00, NULL, NULL, 'active', '3', '2023-02-02 14:02:36', '3', '2023-02-02 14:07:26'),
(559, 2, 0, 'Sample2', '', NULL, 100, NULL, NULL, NULL, NULL, 'active', '22', '0000-00-00 00:00:00', '22', '0000-00-00 00:00:00'),
(560, NULL, 559, 'samplevar1', '#ff0000', NULL, NULL, 100.00, 150.00, NULL, NULL, NULL, '22', '0000-00-00 00:00:00', '22', '0000-00-00 00:00:00'),
(561, NULL, 559, 'samplevar2', '#0752e9', NULL, NULL, 150.00, 200.00, NULL, NULL, NULL, '22', '0000-00-00 00:00:00', '22', '0000-00-00 00:00:00'),
(562, NULL, 559, 'samplevar3', '#00f5e4', NULL, NULL, 200.00, 250.00, NULL, NULL, NULL, '22', '0000-00-00 00:00:00', '22', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item_category`
--

CREATE TABLE `tbl_item_category` (
  `item_category_id` int(11) NOT NULL,
  `name` mediumtext DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  `status` mediumtext DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `added_on` varchar(50) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_on` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_item_category`
--

INSERT INTO `tbl_item_category` (`item_category_id`, `name`, `parent`, `status`, `added_by`, `added_on`, `updated_by`, `updated_on`) VALUES
(1, 'Chair', 0, 'active', 3, '2021-01-31 15:59:37', 22, '06/06/2023 11:03:26am'),
(2, 'Table', 0, 'active', 3, '2021-01-31 16:00:47', NULL, NULL),
(3, 'Side Table', 0, 'active', 3, '2021-02-12 13:18:31', NULL, NULL),
(4, 'TV Stand', 0, 'active', 3, '2021-02-12 13:18:46', NULL, NULL),
(5, 'Organizer Shelf', 0, 'active', 3, '2021-02-12 13:19:01', NULL, NULL),
(6, 'Shelves', 0, 'active', 3, '2021-02-13 10:19:34', NULL, NULL),
(7, 'Sofa', 0, 'active', 3, '2022-03-30 16:57:42', NULL, NULL),
(9, 'Sample2', NULL, 'active', 22, '06/06/2023 11:09:43am', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_module`
--

CREATE TABLE `tbl_module` (
  `module_id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `parent` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_module`
--

INSERT INTO `tbl_module` (`module_id`, `name`, `parent`) VALUES
(2, 'user-management', 0),
(3, 'add-user', 2),
(4, 'edit-user', 2),
(5, 'delete-user', 2),
(6, 'change-user-password', 2),
(7, 'access-control-list', 2),
(8, 'supplier-management', 0),
(9, 'add-supplier', 8),
(10, 'edit-supplier', 8),
(11, 'customer-management', 0),
(12, 'add-customer', 11),
(13, 'edit-customer', 11),
(14, 'warehouse-management', 0),
(15, 'add-warehouse', 14),
(16, 'edit-warehouse', 14),
(17, 'stock-transfer-management', 0),
(18, 'add-stock-transfer', 17),
(19, 'edit-stock-transfer', 17),
(20, 'item-management', 0),
(21, 'add-item', 20),
(22, 'edit-item', 20),
(23, 'item-category', 20),
(24, 'purchase-management', 0),
(25, 'add-purchase', 24),
(26, 'edit-purchase', 24),
(27, 'update-purchase-status', 24),
(28, 'sales-management', 0),
(29, 'add-sales', 28),
(30, 'edit-sales', 28),
(31, 'update-sales-status', 28),
(33, 'inventory-management', 0),
(34, 'expense-management', 0),
(35, 'add-expense', 34),
(36, 'edit-expense', 34),
(37, 'update-expense-status', 34),
(38, 'employee-management', 0),
(39, 'add-employee', 38),
(40, 'edit-employee', 38),
(41, 'bank-account-management', 0),
(42, 'report-management', 0),
(43, 'sales-report', 42),
(44, 'net-sales-report', 42),
(45, 'inventory-report', 42),
(46, 'inventory-value-report', 42),
(47, 'payment-management', 0),
(48, 'add-payment', 47),
(49, 'edit-payment', 47),
(50, 'verify-payment', 47),
(51, 'chart-management', 0),
(52, 'damage-item-management', 0),
(53, 'display-item-management', 0),
(54, 'expense-report', 42),
(55, 'fleet-management', 0),
(56, 'fleet-tracking', 55);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_note`
--

CREATE TABLE `tbl_note` (
  `note_id` int(11) NOT NULL,
  `type` mediumtext DEFAULT NULL,
  `id` int(11) DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `added_by` mediumtext DEFAULT NULL,
  `added_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_option`
--

CREATE TABLE `tbl_option` (
  `option_id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_option`
--

INSERT INTO `tbl_option` (`option_id`, `name`, `value`) VALUES
(1, 'site-name', 'Furniture House Manila'),
(2, 'site-logo', '[{\"light\":\"<svg version=\'1.1\' id=\'Layer_1\' xmlns=\'http://www.w3.org/2000/svg\' xmlns:xlink=\'http://www.w3.org/1999/xlink\' x=\'0px\' y=\'0px\' width=\'300px\' height=\'75px\' viewBox=\'0 0 300 75\' enable-background=\'new 0 0 300 75\' xml:space=\'preserve\'><g><path fill=\'#FFFFFF\' d=\'M6.646,62.376C25.268,44.221,43.898,26.071,62.494,7.887c1.096-1.072,2.181-1.614,3.749-1.554c3.061,0.117,6.129,0.035,9.448,0.035c0,3.606,0.048,7.118-0.05,10.626c-0.015,0.545-0.626,1.148-1.086,1.597c-18.392,17.962-36.79,35.917-55.236,53.824c-0.663,0.644-1.81,1.047-2.753,1.093c-3.301,0.161-6.612,0.117-9.919,0.149C6.646,69.896,6.646,66.137,6.646,62.376z\'/><path fill=\'#FFFFFF\' d=\'M6.646,5.974c5.38-0.917,9.599,0.89,12.708,5.369c0.334,0.481,0.851,0.834,1.516,1.468c1.627-1.659,3.328-3.207,4.797-4.95c1.289-1.529,2.768-2.066,4.704-1.89c1.472,0.134,2.964,0.026,4.695,0.026c0,5.502,0.011,10.806-0.023,16.11c-0.002,0.396-0.238,0.884-0.524,1.171c-4.498,4.506-9.022,8.986-13.683,13.613c-4.777-4.787-9.483-9.505-14.189-14.222C6.646,17.104,6.646,11.539,6.646,5.974z\'/><path fill=\'#FFFFFF\' d=\'M213.758,74.107c-1.705-0.873-3.598-1.504-5.078-2.662c-4.932-3.855-5.971-12.149-2.388-17.615c3.267-4.982,10.627-6.639,16.31-3.67c4.476,2.339,6.726,7.318,5.733,13.053c-5.841,0-11.735,0-17.759,0c0.172,2.568,1.193,4.294,3.313,5.212c1.971,0.856,4.364,1.101,5.69-0.538c1.772-2.193,3.851-1.869,6.039-1.892c0.665-0.006,1.331-0.001,2.278-0.001c-1.373,4.639-4.703,6.744-8.726,8.113C217.366,74.107,215.563,74.107,213.758,74.107z M222.018,59.014c-0.26-3.406-2.649-5.406-6.045-5.201c-2.998,0.183-5.144,2.396-5.078,5.201C214.602,59.014,218.305,59.014,222.018,59.014z\'/><path fill=\'#FFFFFF\' d=\'M292.721,25.827c-5.979,0-11.959,0-18.043,0c0.194,2.728,1.389,4.538,3.734,5.326c2.359,0.793,4.52,0.408,6.37-1.538c0.603-0.632,1.741-0.916,2.675-1.028c1.396-0.168,2.827-0.043,4.26-0.043c-0.482,3.79-3.947,6.945-8.543,7.914c-5.492,1.159-11.104-1.438-13.479-6.239c-2.609-5.273-1.416-12.481,2.555-16.017c5.51-4.909,17.848-4.024,20.066,5.897c0.062,0.271,0.267,0.511,0.404,0.766C292.721,22.519,292.721,24.173,292.721,25.827z M286.227,21.639c-0.528-3.495-2.634-5.317-5.813-5.278c-3.129,0.04-5.238,2.032-5.546,5.278C278.607,21.639,282.342,21.639,286.227,21.639z\'/><path fill=\'#FFFFFF\' d=\'M135.696,74.107c-4.311-1.409-7.741-3.729-9.166-8.36c-2.006-6.524,0.612-13.192,6.33-15.831c5.994-2.766,13.19-0.748,16.445,4.609c3.817,6.285,1.893,17.135-7.849,19.205c-0.28,0.061-0.532,0.248-0.796,0.377C139.004,74.107,137.35,74.107,135.696,74.107z M144.731,61.492c0.024-4.21-2.216-7.071-5.696-7.271c-3.59-0.207-5.866,1.58-6.664,5.236c-0.883,4.052,0.68,7.658,3.834,8.85C140.595,69.964,144.701,66.682,144.731,61.492z\'/><path fill=\'#FFFFFF\' d=\'M162.318,74.107c-6.478-2.678-7.973-4.986-7.976-12.308c-0.002-4.112,0-8.225,0-12.485c2.146,0,4.048,0,6.183,0c0,4.131-0.024,8.166,0.016,12.201c0.011,1.112,0.083,2.258,0.355,3.332c0.727,2.851,2.834,4.156,5.965,3.846c2.523-0.254,4.38-2.064,4.492-4.786c0.162-3.896,0.104-7.806,0.135-11.707c0.008-0.89,0-1.779,0-2.851c2.098,0,3.996,0,6.061,0c0,7.98,0,15.979,0,24.149c-1.863,0-3.771,0-5.852,0c-0.119-0.671-0.254-1.424-0.369-2.067c-1.855,0.92-3.629,1.797-5.4,2.676C164.725,74.107,163.521,74.107,162.318,74.107z\'/><path fill=\'#FFFFFF\' d=\'M189.393,74.107c-1.463-0.698-3.022-1.252-4.367-2.133c-2.02-1.322-3.361-3.18-3.424-5.988c1.687,0,3.326-0.104,4.939,0.057c0.566,0.059,1.188,0.684,1.58,1.201c1.389,1.833,4.011,2.66,6.029,1.559c0.723-0.395,1.463-1.386,1.522-2.158c0.048-0.605-0.812-1.629-1.487-1.886c-2.516-0.95-5.17-1.536-7.685-2.493c-3.851-1.465-5.416-4.961-4.013-8.524c1.457-3.705,6.103-5.655,11.566-4.858c4.307,0.631,7.11,3.574,7.381,7.881c-1.777,0-3.551,0-5.537,0c-0.824-2.633-2.918-3.505-5.555-2.91c-0.853,0.191-2.013,1.103-2.137,1.836c-0.117,0.689,0.771,1.973,1.523,2.307c1.968,0.879,4.111,1.357,6.17,2.039c4.107,1.363,5.889,3.41,5.882,6.699c-0.005,3.406-2.082,5.721-6.22,6.961c-0.27,0.082-0.506,0.273-0.76,0.414C193.001,74.107,191.195,74.107,189.393,74.107z\'/><path fill=\'#FFFFFF\' d=\'M202.025,1.461c1.483,0.956,2.85,2.042,2.543,4.058c-0.258,1.702-1.28,2.861-3.039,3.122c-1.758,0.262-3.313-0.2-4.119-1.931c-0.77-1.651-0.496-3.183,0.934-4.419c0.322-0.279,0.649-0.553,0.975-0.829C200.221,1.461,201.123,1.461,202.025,1.461z\'/><path fill=\'#FFFFFF\' d=\'M47.248,73.609c0-5.248-0.028-10.338,0.04-15.428c0.008-0.572,0.46-1.236,0.885-1.689c4.203-4.492,8.444-8.95,12.797-13.549c5.068,4.957,9.614,9.385,14.125,13.849c0.331,0.328,0.58,0.907,0.583,1.371c0.041,5.092,0.025,10.185,0.025,15.446C66.22,73.609,56.888,73.609,47.248,73.609z\'/><path fill=\'#FFFFFF\' d=\'M97.893,42.869c1.861,0,3.705,0,5.862,0c0,4.123,0,8.203,0,12.466c4.537,0,8.771,0,13.272,0c0-4.03,0-8.118,0-12.408c2.152,0,4.045,0,6.14,0c0,10.146,0,20.304,0,30.604c-1.927,0-3.833,0-5.919,0c0-4.234,0-8.414,0-12.782c-4.48,0-8.789,0-13.375,0c0,4.192,0,8.437,0,12.798c-2.118,0-3.964,0-5.979,0C97.893,63.359,97.893,53.188,97.893,42.869z\'/><path fill=\'#FFFFFF\' d=\'M103.621,23.492c0,4.551,0,8.734,0,13.032c-2.09,0-4.01,0-6.088,0c0-10.228,0-20.42,0-30.802c7.847,0,15.769,0,23.86,0c0,1.464,0,2.992,0,4.703c-5.833,0-11.596,0-17.545,0c0,2.744,0,5.313,0,8.093c4.81,0,9.591,0,14.524,0c0,1.725,0,3.246,0,4.975C113.505,23.492,108.725,23.492,103.621,23.492z\'/><path fill=\'#FFFFFF\' d=\'M175.706,36.118c-2.132,0-3.988,0-6.021,0c0-7.999,0-15.994,0-24.178c1.844,0,3.748,0,5.797,0c0.127,0.632,0.265,1.326,0.33,1.653c2.256-0.745,4.439-1.954,6.699-2.118c6.072-0.441,9.834,2.941,10.271,9.331c0.342,5,0.068,10.042,0.068,15.239c-1.988,0-3.9,0-6.168,0c0-1.528,0.002-3.145,0-4.762c-0.008-3.156,0.105-6.317-0.062-9.465c-0.177-3.347-2.343-5.221-5.587-5.159c-3.168,0.061-5.125,1.894-5.241,5.224c-0.138,3.903-0.067,7.813-0.088,11.72C175.703,34.409,175.706,35.216,175.706,36.118z\'/><path fill=\'#FFFFFF\' d=\'M241.811,11.892c2.156,0,4.069,0,6.117,0c0,8.063,0,16.065,0,24.198c-1.974,0-3.894,0-5.979,0c-0.078-0.708-0.157-1.424-0.24-2.175c-1.44,0.76-2.772,1.742-4.269,2.201c-6.53,2.009-12.023-1.965-12.729-9.09c-0.059-0.597-0.045-1.202-0.045-1.802c-0.004-4.353-0.002-8.705-0.002-13.263c2.091,0,4.05,0,6.24,0c0,4.526-0.047,9.018,0.016,13.509c0.051,3.706,2.068,5.787,5.443,5.79c3.193,0.002,5.279-1.868,5.378-5.086c0.118-3.906,0.055-7.817,0.069-11.727C241.813,13.64,241.811,12.833,241.811,11.892z\'/><path fill=\'#FFFFFF\' d=\'M141.493,11.861c2.194,0,4.05,0,6.043,0c0,8.113,0,16.12,0,24.244c-2.031,0-3.955,0-5.928,0c-0.076-0.781-0.146-1.499-0.244-2.503c-2.962,2.401-6.038,3.603-9.701,2.694c-4.107-1.019-7.073-4.188-7.209-8.399c-0.169-5.249-0.041-10.509-0.041-15.953c1.945,0,3.84,0,6.052,0c0,2.174-0.02,4.326,0.005,6.477c0.03,2.703-0.052,5.419,0.189,8.104c0.27,3.013,2.164,4.65,5.001,4.729c3.135,0.086,5.123-1.292,5.527-4.375c0.359-2.737,0.248-5.539,0.298-8.313C141.525,16.402,141.493,14.234,141.493,11.861z\'/><path fill=\'#FFFFFF\' d=\'M221.407,11.636c0,1.918,0,3.396,0,5.115c-1.765,0-3.451,0-5.359,0c0,4.197-0.097,8.159,0.089,12.108c0.033,0.724,1.096,1.673,1.898,2.015c0.908,0.388,2.059,0.21,3.281,0.289c0,1.622,0,3.214,0,4.991c-1.89,0-3.762,0.164-5.596-0.036c-3.26-0.355-5.263-2.169-5.611-5.472c-0.36-3.419-0.252-6.888-0.332-10.335c-0.026-1.107-0.004-2.216-0.004-3.403c-0.965-0.076-1.695-0.134-2.621-0.207c0-1.569,0-3.155,0-4.839c0.769-0.066,1.5-0.128,2.5-0.214c0-1.923,0-3.828,0-5.916c2.178,0,4.086,0,6.248,0c0,1.806,0,3.715,0,5.904C217.816,11.636,219.494,11.636,221.407,11.636z\'/><path fill=\'#FFFFFF\' d=\'M266.734,17.595c-6.808,0.85-7.416,1.558-7.418,8.439c0,3.292,0,6.583,0,10.03c-2.051,0-3.965,0-6.064,0c0-7.932,0-15.914,0-24.104c1.896,0,3.859,0,5.994,0c0.045,0.906,0.09,1.824,0.152,3.132c2.135-2.262,4.233-3.854,7.336-3.623C266.734,13.502,266.734,15.482,266.734,17.595z\'/><path fill=\'#FFFFFF\' d=\'M152.887,11.835c2.037,0,3.827,0,5.778,0c0.11,0.97,0.213,1.882,0.325,2.867c4.217-3.159,4.584-3.319,7.285-3.171c0,1.997,0,4,0,5.971c-0.201,0.104-0.323,0.218-0.451,0.226c-5.771,0.383-6.977,1.68-6.982,7.537c-0.004,3.531-0.001,7.062-0.001,10.774c-2.01,0-3.909,0-5.954,0C152.887,28.023,152.887,20.027,152.887,11.835z\'/><path fill=\'#FFFFFF\' d=\'M197.748,11.907c0.5-0.061,0.863-0.139,1.229-0.142c1.496-0.014,2.992-0.006,4.672-0.006c0,8.13,0,16.165,0,24.332c-1.916,0-3.828,0-5.899,0C197.748,28.086,197.748,20.111,197.748,11.907z\'/></g></svg>\", \"dark\":\"<svg version=\'1.1\' id=\'Layer_1\' xmlns=\'http://www.w3.org/2000/svg\' xmlns:xlink=\'http://www.w3.org/1999/xlink\' x=\'0px\' y=\'0px\' width=\'300px\' height=\'75px\' viewBox=\'0 0 300 75\' enable-background=\'new 0 0 300 75\' xml:space=\'preserve\'><g><path fill-rule=\'evenodd\' clip-rule=\'evenodd\' d=\'M6.646,62.376C25.268,44.221,43.898,26.071,62.494,7.887c1.096-1.072,2.181-1.614,3.749-1.554c3.061,0.117,6.129,0.035,9.448,0.035c0,3.606,0.048,7.118-0.05,10.626c-0.015,0.545-0.626,1.148-1.086,1.597c-18.392,17.962-36.79,35.917-55.236,53.824c-0.663,0.643-1.81,1.047-2.753,1.093c-3.301,0.161-6.612,0.117-9.919,0.149C6.646,69.896,6.646,66.137,6.646,62.376z\'/><path fill-rule=\'evenodd\' clip-rule=\'evenodd\' d=\'M6.646,5.974c5.38-0.917,9.599,0.89,12.708,5.369c0.334,0.481,0.851,0.834,1.516,1.468c1.627-1.659,3.328-3.207,4.797-4.95c1.289-1.529,2.768-2.066,4.704-1.89c1.472,0.134,2.964,0.026,4.695,0.026c0,5.502,0.011,10.806-0.023,16.11c-0.002,0.396-0.238,0.884-0.524,1.171c-4.498,4.506-9.022,8.986-13.683,13.613c-4.777-4.787-9.483-9.505-14.189-14.222C6.646,17.104,6.646,11.539,6.646,5.974z\'/><path fill-rule=\'evenodd\' clip-rule=\'evenodd\' d=\'M213.758,74.108c-1.705-0.874-3.598-1.504-5.079-2.663c-4.931-3.855-5.97-12.149-2.387-17.615c3.266-4.983,10.627-6.639,16.309-3.67c4.476,2.339,6.726,7.319,5.734,13.053c-5.841,0-11.736,0-17.759,0c0.172,2.568,1.193,4.294,3.312,5.212c1.972,0.856,4.365,1.101,5.691-0.538c1.772-2.193,3.85-1.87,6.039-1.892c0.665-0.006,1.331-0.001,2.278-0.001c-1.372,4.639-4.703,6.744-8.725,8.114C217.366,74.108,215.563,74.108,213.758,74.108z M222.017,59.013c-0.259-3.406-2.649-5.406-6.044-5.2c-2.999,0.182-5.144,2.396-5.079,5.2C214.602,59.013,218.305,59.013,222.017,59.013z\'/><path fill-rule=\'evenodd\' clip-rule=\'evenodd\' d=\'M292.721,25.827c-5.98,0-11.96,0-18.043,0c0.194,2.728,1.389,4.538,3.734,5.326c2.36,0.793,4.519,0.408,6.37-1.538c0.603-0.632,1.741-0.916,2.675-1.028c1.396-0.168,2.827-0.043,4.26-0.043c-0.482,3.79-3.948,6.945-8.543,7.914c-5.492,1.159-11.103-1.438-13.479-6.239c-2.609-5.273-1.415-12.481,2.555-16.017c5.51-4.909,17.847-4.024,20.066,5.897c0.062,0.271,0.267,0.511,0.404,0.766C292.721,22.519,292.721,24.173,292.721,25.827z M286.226,21.639c-0.528-3.495-2.633-5.317-5.812-5.278c-3.129,0.04-5.238,2.032-5.546,5.278C278.607,21.639,282.342,21.639,286.226,21.639z\'/><path fill-rule=\'evenodd\' clip-rule=\'evenodd\' d=\'M135.696,74.108c-4.311-1.41-7.741-3.729-9.166-8.361c-2.006-6.525,0.612-13.193,6.33-15.831c5.994-2.765,13.19-0.748,16.445,4.609c3.817,6.285,1.893,17.135-7.849,19.206c-0.28,0.06-0.532,0.248-0.796,0.377C139.004,74.108,137.35,74.108,135.696,74.108z M144.731,61.492c0.024-4.21-2.216-7.071-5.696-7.272c-3.59-0.207-5.866,1.581-6.664,5.237c-0.883,4.052,0.68,7.658,3.834,8.85C140.595,69.964,144.701,66.681,144.731,61.492z\'/><path fill-rule=\'evenodd\' clip-rule=\'evenodd\' d=\'M162.318,74.108c-6.477-2.678-7.973-4.987-7.975-12.308c-0.002-4.112,0-8.225,0-12.485c2.146,0,4.047,0,6.183,0c0,4.13-0.025,8.165,0.015,12.2c0.011,1.113,0.083,2.259,0.355,3.332c0.727,2.851,2.835,4.157,5.965,3.846c2.524-0.253,4.38-2.064,4.492-4.786c0.163-3.896,0.104-7.805,0.135-11.707c0.008-0.89,0.001-1.779,0.001-2.85c2.097,0,3.996,0,6.06,0c0,7.98,0,15.979,0,24.149c-1.863,0-3.772,0-5.851,0c-0.12-0.671-0.255-1.424-0.37-2.068c-1.856,0.921-3.629,1.798-5.4,2.677C164.724,74.108,163.521,74.108,162.318,74.108z\'/><path fill-rule=\'evenodd\' clip-rule=\'evenodd\' d=\'M189.392,74.108c-1.463-0.699-3.022-1.253-4.367-2.134c-2.019-1.322-3.361-3.179-3.424-5.987c1.687,0,3.327-0.105,4.94,0.056c0.567,0.059,1.188,0.683,1.58,1.201c1.389,1.833,4.011,2.661,6.03,1.559c0.722-0.395,1.462-1.386,1.522-2.158c0.048-0.606-0.811-1.63-1.487-1.886c-2.516-0.95-5.171-1.537-7.685-2.493c-3.851-1.465-5.416-4.961-4.013-8.525c1.458-3.705,6.103-5.655,11.566-4.858c4.307,0.63,7.111,3.574,7.381,7.88c-1.777,0-3.55,0-5.536,0c-0.825-2.632-2.918-3.504-5.555-2.91c-0.853,0.192-2.013,1.103-2.137,1.836c-0.117,0.69,0.771,1.973,1.523,2.307c1.968,0.879,4.112,1.357,6.17,2.039c4.108,1.363,5.889,3.41,5.882,6.7c-0.005,3.405-2.082,5.72-6.219,6.961c-0.27,0.081-0.507,0.273-0.76,0.414C193.001,74.108,191.195,74.108,189.392,74.108z\'/><path fill-rule=\'evenodd\' clip-rule=\'evenodd\' d=\'M202.025,1.461c1.484,0.956,2.85,2.042,2.544,4.058c-0.258,1.702-1.281,2.861-3.039,3.122c-1.759,0.262-3.313-0.2-4.12-1.931c-0.77-1.651-0.496-3.183,0.934-4.419c0.322-0.279,0.649-0.553,0.974-0.829C200.22,1.461,201.123,1.461,202.025,1.461z\'/><path fill-rule=\'evenodd\' clip-rule=\'evenodd\' d=\'M47.248,73.609c0-5.248-0.028-10.338,0.04-15.427c0.008-0.573,0.46-1.236,0.885-1.69c4.203-4.492,8.444-8.95,12.797-13.548c5.068,4.956,9.614,9.384,14.125,13.848c0.331,0.328,0.58,0.907,0.583,1.371c0.041,5.092,0.025,10.184,0.025,15.446C66.22,73.609,56.888,73.609,47.248,73.609z\'/><path fill-rule=\'evenodd\' clip-rule=\'evenodd\' d=\'M97.893,42.869c1.861,0,3.705,0,5.862,0c0,4.123,0,8.203,0,12.466c4.537,0,8.771,0,13.272,0c0-4.031,0-8.118,0-12.408c2.152,0,4.045,0,6.14,0c0,10.146,0,20.304,0,30.604c-1.927,0-3.833,0-5.919,0c0-4.234,0-8.414,0-12.782c-4.48,0-8.789,0-13.375,0c0,4.193,0,8.436,0,12.798c-2.118,0-3.964,0-5.979,0C97.893,63.359,97.893,53.188,97.893,42.869z\'/><path fill-rule=\'evenodd\' clip-rule=\'evenodd\' d=\'M103.621,23.492c0,4.551,0,8.734,0,13.032c-2.09,0-4.01,0-6.088,0c0-10.228,0-20.42,0-30.802c7.847,0,15.769,0,23.86,0c0,1.464,0,2.992,0,4.703c-5.833,0-11.596,0-17.545,0c0,2.744,0,5.313,0,8.093c4.81,0,9.591,0,14.524,0c0,1.725,0,3.246,0,4.975C113.505,23.492,108.725,23.492,103.621,23.492z\'/><path fill-rule=\'evenodd\' clip-rule=\'evenodd\' d=\'M175.706,36.118c-2.132,0-3.988,0-6.021,0c0-7.999,0-15.994,0-24.178c1.844,0,3.748,0,5.798,0c0.126,0.632,0.264,1.326,0.329,1.653c2.257-0.745,4.44-1.954,6.7-2.118c6.072-0.441,9.834,2.941,10.271,9.331c0.342,5,0.068,10.042,0.068,15.239c-1.988,0-3.9,0-6.168,0c0-1.528,0.003-3.145,0-4.762c-0.007-3.156,0.106-6.317-0.061-9.465c-0.177-3.347-2.343-5.221-5.587-5.159c-3.168,0.061-5.125,1.894-5.241,5.224c-0.138,3.903-0.068,7.813-0.088,11.72C175.703,34.409,175.706,35.216,175.706,36.118z\'/><path fill-rule=\'evenodd\' clip-rule=\'evenodd\' d=\'M241.811,11.892c2.156,0,4.069,0,6.117,0c0,8.063,0,16.065,0,24.198c-1.974,0-3.894,0-5.98,0c-0.078-0.708-0.157-1.424-0.24-2.175c-1.441,0.76-2.773,1.742-4.268,2.201c-6.531,2.009-12.024-1.965-12.729-9.09c-0.059-0.597-0.045-1.202-0.045-1.802c-0.004-4.353-0.002-8.705-0.002-13.263c2.091,0,4.05,0,6.241,0c0,4.526-0.047,9.018,0.015,13.509c0.05,3.706,2.068,5.787,5.444,5.79c3.192,0.002,5.279-1.868,5.377-5.086c0.119-3.906,0.055-7.817,0.069-11.727C241.813,13.64,241.811,12.833,241.811,11.892z\'/><path fill-rule=\'evenodd\' clip-rule=\'evenodd\' d=\'M141.493,11.861c2.194,0,4.05,0,6.043,0c0,8.113,0,16.12,0,24.244c-2.031,0-3.955,0-5.928,0c-0.076-0.781-0.146-1.499-0.244-2.503c-2.962,2.401-6.038,3.603-9.701,2.694c-4.107-1.019-7.073-4.188-7.209-8.399c-0.169-5.249-0.041-10.509-0.041-15.953c1.945,0,3.84,0,6.052,0c0,2.174-0.02,4.326,0.005,6.477c0.03,2.703-0.052,5.419,0.189,8.104c0.27,3.013,2.164,4.65,5.001,4.729c3.135,0.086,5.123-1.292,5.527-4.375c0.359-2.737,0.248-5.539,0.298-8.313C141.525,16.402,141.493,14.234,141.493,11.861z\'/><path fill-rule=\'evenodd\' clip-rule=\'evenodd\' d=\'M221.407,11.636c0,1.918,0,3.395,0,5.115c-1.764,0-3.451,0-5.359,0c0,4.197-0.097,8.159,0.088,12.108c0.034,0.724,1.097,1.673,1.899,2.015c0.908,0.388,2.059,0.21,3.281,0.289c0,1.622,0,3.214,0,4.991c-1.889,0-3.762,0.164-5.596-0.036c-3.259-0.355-5.262-2.169-5.61-5.472c-0.361-3.419-0.252-6.888-0.333-10.335c-0.026-1.107-0.004-2.216-0.004-3.403c-0.964-0.076-1.695-0.134-2.62-0.207c0-1.569,0-3.155,0-4.839c0.768-0.066,1.499-0.128,2.499-0.214c0-1.923,0-3.828,0-5.916c2.178,0,4.086,0,6.248,0c0,1.806,0,3.715,0,5.904C217.817,11.636,219.494,11.636,221.407,11.636z\'/><path fill-rule=\'evenodd\' clip-rule=\'evenodd\' d=\'M266.735,17.595c-6.808,0.85-7.417,1.558-7.418,8.439c0,3.292,0,6.583,0,10.03c-2.052,0-3.965,0-6.065,0c0-7.932,0-15.914,0-24.104c1.896,0,3.86,0,5.994,0c0.045,0.906,0.09,1.824,0.153,3.132c2.134-2.262,4.233-3.854,7.336-3.623C266.735,13.502,266.735,15.482,266.735,17.595z\'/><path fill-rule=\'evenodd\' clip-rule=\'evenodd\' d=\'M152.887,11.835c2.037,0,3.827,0,5.778,0c0.11,0.97,0.213,1.882,0.325,2.867c4.217-3.159,4.584-3.319,7.285-3.171c0,1.997,0,4,0,5.971c-0.201,0.104-0.323,0.218-0.451,0.226c-5.771,0.383-6.977,1.68-6.982,7.537c-0.004,3.531-0.001,7.062-0.001,10.774c-2.01,0-3.909,0-5.954,0C152.887,28.023,152.887,20.027,152.887,11.835z\'/><path fill-rule=\'evenodd\' clip-rule=\'evenodd\' d=\'M197.748,11.907c0.5-0.061,0.864-0.139,1.229-0.142c1.495-0.014,2.992-0.006,4.671-0.006c0,8.13,0,16.165,0,24.332c-1.916,0-3.828,0-5.899,0C197.748,28.086,197.748,20.111,197.748,11.907z\'/></g></svg>\", \"icon\" : \"<svg version=\'1.1\' id=\'Layer_1\' xmlns=\'http://www.w3.org/2000/svg\' xmlns:xlink=\'http://www.w3.org/1999/xlink\' x=\'0px\' y=\'0px\' width=\'1000px\' height=\'1000px\' viewBox=\'0 0 1000 1000\' enable-background=\'new 0 0 1000 1000\' xml:space=\'preserve\'><path fill=\'#010101\' d=\'M79.109,910.453c0-44.187-0.431-86.115,0.465-128.043c0.144-6.061,5.415-13.127,10.187-17.791 C317.44,543.538,545.338,322.638,773.376,101.878c4.411-4.267,10.652-9.288,16.142-9.396c44.867-0.752,89.734-0.429,136.756-0.429 c0,43.506,0.358,86.115-0.432,128.689c-0.105,5.379-5.304,11.583-9.684,15.815C687.941,458.141,459.616,679.616,231.04,900.842 c-4.734,4.588-12.124,9.036-18.363,9.146C169.098,910.813,125.556,910.453,79.109,910.453z\'/><path fill=\'#010101\' d=\'M926.311,914.073c-117.501,0-232.165,0-349.84,0c0-26.43,0-52.221,0-77.971 c0-35.509-0.469-71.019,0.355-106.489c0.182-7.819,2.942-17.503,8.072-23.026c52.361-56.31,105.479-111.939,158.385-167.781 c4.34,0.25,8.679,0.5,13.021,0.753c15.494,18.04,29.982,37.086,46.66,53.977c36.689,37.195,74.639,73.17,111.652,110.075 c5.202,5.201,11.081,12.91,11.19,19.512C926.632,786.033,926.311,848.979,926.311,914.073z\'/><path fill=\'#010101\' d=\'M253.958,465.098c-35.006-34.862-68.432-68.003-101.681-101.284C128.174,339.672,94.817,319.158,82.911,290 c-12.231-29.948-3.516-68.4-3.696-103.153c-0.177-31.813-0.033-63.665-0.033-98.632c29.052,0,57.097-0.54,85.11,0.465 c5.343,0.18,11.189,5.918,15.603,10.292c23.67,23.565,46.912,47.489,71.982,72.953c24.282-24.461,46.483-48.42,70.585-70.262 c8.034-7.282,20.767-12.088,31.776-12.984c23.673-1.937,47.632-0.609,73.922-0.609c0,50.249-2.618,98.776,0.825,146.875 c2.869,40.203-9.073,68.971-39.489,96.011C342.906,372.385,300.548,418.509,253.958,465.098z\'/></svg>\" }]'),
(3, 'key', 'mqlJP5I3LVNYS2bMPU5uJmRiAA+Buk51SNOWhSw4UKQ='),
(4, 'session-timeout', '1800'),
(5, 'failed-login-timeout', '1800'),
(6, 'failed-login-attempt', '5'),
(7, 'rows-per-page', '500'),
(8, 'payment-method', '[{\"name\":\"cash\"}, {\"name\":\"check\"}, {\"name\":\"cash-on-delivery\"}, {\"name\":\"gcash\"}, {\"name\":\"BDO Deposit\"}, {\"name\":\"BPI Deposit\"}, {\"name\":\"paymongo\"}]'),
(9, 'allow-negative-inventory', 'yes'),
(10, 'item-has-own-sku', 'no'),
(11, 'item-has-barcode', 'no'),
(12, 'purchase-status', '[{\"name\":\"pending\",\"editable\":\"yes\",\"inventory\":\"no\",\"class\":\"primary\"},{\"name\":\"delivered\",\"editable\":\"yes\",\"inventory\":\"yes\",\"class\":\"success\"},{\"name\":\"cancelled\",\"editable\":\"no\",\"inventory\":\"no\",\"class\":\"danger\"}]'),
(13, 'purchase-default-warehouse', '1'),
(14, 'purchase-default-payment', 'cash'),
(15, 'sales-status', '[{\"name\":\"delivered\",\"editable\":\"yes\",\"inventory\":\"yes\",\"class\":\"success\"},{\"name\":\"cancelled\",\"editable\":\"no\",\"inventory\":\"no\",\"class\":\"danger\"},{\"name\":\"missing\",\"editable\":\"no\",\"inventory\":\"yes\",\"class\":\"danger\"}]'),
(16, 'sales-default-warehouse', '1'),
(17, 'sales-default-payment', 'cash'),
(18, 'lazada-settings', ''),
(19, 'lazada-status', '[{\"name\":\"pending\",\"editable\":\"yes\",\"inventory\":\"yes\",\"class\":\"primary\"},{\"name\":\"delivered\",\"editable\":\"yes\",\"inventory\":\"yes\",\"class\":\"success\"},{\"name\":\"cancelled\",\"editable\":\"no\",\"inventory\":\"no\",\"class\":\"danger\"},{\"name\":\"missing\",\"editable\":\"no\",\"inventory\":\"yes\",\"class\":\"danger\"}]'),
(20, 'lazada-default-warehouse', '1'),
(21, 'lazada-default-payment', 'cash-on-delivery'),
(22, 'shopee-settings', ''),
(23, 'shopee-status', '[{\"name\":\"pending\",\"editable\":\"yes\",\"inventory\":\"yes\",\"class\":\"primary\"},{\"name\":\"delivered\",\"editable\":\"yes\",\"inventory\":\"yes\",\"class\":\"success\"},{\"name\":\"cancelled\",\"editable\":\"no\",\"inventory\":\"no\",\"class\":\"danger\"},{\"name\":\"missing\",\"editable\":\"no\",\"inventory\":\"yes\",\"class\":\"danger\"}]'),
(24, 'shopee-default-warehouse', '1'),
(25, 'shopee-default-payment', 'cash-on-delivery'),
(26, 'stock-transfer-status', '[{\"name\":\"pending\",\"editable\":\"yes\",\"inventory\":\"no\",\"class\":\"primary\"},{\"name\":\"completed\",\"editable\":\"yes\",\"inventory\":\"yes\",\"class\":\"success\"},{\"name\":\"cancelled\",\"editable\":\"no\",\"inventory\":\"no\",\"class\":\"danger\"}]'),
(27, 'reservation-status', '[{\"name\":\"open\",\"editable\":\"yes\",\"class\":\"primary\"},{\"name\":\"ready\",\"editable\":\"yes\",\"class\":\"warning\"},{\"name\":\"completed\",\"editable\":\"no\",\"class\":\"success\"},{\"name\":\"cancelled\",\"editable\":\"no\",\"class\":\"danger\"}]'),
(28, 'damage-item-status', '[{\"name\":\"pending\",\"editable\":\"yes\",\"inventory\":\"yes\",\"class\":\"primary\"},{\"name\":\"sold\",\"editable\":\"no\",\"inventory\":\"no\",\"class\":\"success\"},{\"name\":\"replaced\",\"editable\":\"no\",\"inventory\":\"no\",\"class\":\"warning\"}]'),
(29, 'display-item-status', '[{\"name\":\"displayed\",\"editable\":\"yes\",\"inventory\":\"yes\",\"class\":\"primary\"},{\"name\":\"sold\",\"editable\":\"no\",\"inventory\":\"no\",\"class\":\"success\"}]'),
(30, 'cloud-sync', 'no'),
(31, 'expense-status', '[{\"name\":\"pending\",\"class\":\"primary\"},{\"name\":\"completed\",\"class\":\"success\"},{\"name\":\"cancelled\",\"class\":\"danger\"}]'),
(32, 'private-key', 'MvvDAW4HJ2hX87N5lgcVH/2EdznABn54EpeY7mKJX+8=');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `payment_id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `type` text DEFAULT NULL,
  `status` text DEFAULT NULL,
  `added_by` text DEFAULT NULL,
  `added_on` datetime DEFAULT NULL,
  `updated_by` text DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment_detail`
--

CREATE TABLE `tbl_payment_detail` (
  `payment_detail_id` int(11) NOT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `method` text DEFAULT NULL,
  `bank_account_id` int(11) DEFAULT NULL,
  `check_payee` text DEFAULT NULL,
  `check_number` text DEFAULT NULL,
  `amount` double(10,2) DEFAULT NULL,
  `status` text DEFAULT NULL,
  `validated_by` int(11) DEFAULT NULL,
  `validated_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment_item`
--

CREATE TABLE `tbl_payment_item` (
  `payment_item_id` int(11) NOT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `id` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase`
--

CREATE TABLE `tbl_purchase` (
  `purchase_id` int(11) NOT NULL,
  `invoice_no` text DEFAULT NULL,
  `invoice_date` date DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `warehouse_id` int(11) DEFAULT NULL,
  `payment_method` text DEFAULT NULL,
  `payment_status` text DEFAULT NULL,
  `arrival_date` date DEFAULT NULL,
  `status` text DEFAULT NULL,
  `added_by` text DEFAULT NULL,
  `added_on` datetime DEFAULT NULL,
  `updated_by` text DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase_item`
--

CREATE TABLE `tbl_purchase_item` (
  `purchase_item_id` int(11) NOT NULL,
  `purchase_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` double(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quotation`
--

CREATE TABLE `tbl_quotation` (
  `quotation_id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `custom_header` text DEFAULT NULL,
  `custom_footer` text DEFAULT NULL,
  `discount` text DEFAULT NULL,
  `delivery_fee` double(10,2) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `added_by` text DEFAULT NULL,
  `added_on` datetime DEFAULT NULL,
  `updated_by` text DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_quotation`
--

INSERT INTO `tbl_quotation` (`quotation_id`, `name`, `address`, `custom_header`, `custom_footer`, `discount`, `delivery_fee`, `remarks`, `added_by`, `added_on`, `updated_by`, `updated_on`) VALUES
(1, 'MULDONG, EDWINA g.', 'Pampanga', '<p>this is header sadfasdfasdf</p>', '', '', NULL, '', '2', '2023-05-25 10:09:12', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quotation_item`
--

CREATE TABLE `tbl_quotation_item` (
  `quotation_item_id` int(11) NOT NULL,
  `quotation_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` double(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_quotation_item`
--

INSERT INTO `tbl_quotation_item` (`quotation_item_id`, `quotation_id`, `item_id`, `quantity`, `price`) VALUES
(1, 1, 532, 1, 1.00),
(2, 1, 533, 1, 1.00);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reservation`
--

CREATE TABLE `tbl_reservation` (
  `reservation_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `contact_number` text DEFAULT NULL,
  `delivery_method` text DEFAULT NULL,
  `delivery_fee` double(10,2) DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `warehouse_id` int(11) DEFAULT NULL,
  `remark` text DEFAULT NULL,
  `status` text DEFAULT NULL,
  `added_by` text DEFAULT NULL,
  `added_on` datetime DEFAULT NULL,
  `updated_by` text DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reservation_item`
--

CREATE TABLE `tbl_reservation_item` (
  `reservation_item_id` int(11) NOT NULL,
  `reservation_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` double(10,2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sales`
--

CREATE TABLE `tbl_sales` (
  `sales_id` int(11) NOT NULL,
  `channel` text DEFAULT NULL,
  `invoice_no` text DEFAULT NULL,
  `invoice_date` date DEFAULT NULL,
  `official_receipt` text DEFAULT NULL,
  `official_receipt_no` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `contact_number` text DEFAULT NULL,
  `warehouse_id` int(11) DEFAULT NULL,
  `delivery_method` text DEFAULT NULL,
  `delivery_fee` double(10,2) DEFAULT NULL,
  `payment_method` text DEFAULT NULL,
  `payment_status` text DEFAULT NULL,
  `status` text DEFAULT NULL,
  `added_by` text DEFAULT NULL,
  `added_on` datetime DEFAULT NULL,
  `updated_by` text DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sales_ecommerce`
--

CREATE TABLE `tbl_sales_ecommerce` (
  `sales_ecommerce_id` int(11) NOT NULL,
  `sales_id` int(11) DEFAULT NULL,
  `added_by` text DEFAULT NULL,
  `added_on` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sales_item`
--

CREATE TABLE `tbl_sales_item` (
  `sales_item_id` int(11) NOT NULL,
  `sales_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `purchase_price` double(10,2) DEFAULT NULL,
  `price` double(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sales_lazada`
--

CREATE TABLE `tbl_sales_lazada` (
  `sales_lazada_id` int(11) NOT NULL,
  `sales_item_id` int(11) DEFAULT NULL,
  `delivered_date` date DEFAULT NULL,
  `shipping_fee_collected` double(10,2) DEFAULT NULL,
  `shipping_fee_charged` double(10,2) DEFAULT NULL,
  `commission_fee` double(10,2) DEFAULT NULL,
  `payment_fee` double(10,2) DEFAULT NULL,
  `other_fee` double(10,2) DEFAULT NULL,
  `other_credit` double(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sales_shopee`
--

CREATE TABLE `tbl_sales_shopee` (
  `sales_shopee_id` int(11) NOT NULL,
  `sales_item_id` int(11) DEFAULT NULL,
  `delivered_date` date DEFAULT NULL,
  `shipping_fee_collected` double(10,2) DEFAULT NULL,
  `shipping_fee_charged` double(10,2) DEFAULT NULL,
  `transaction_fee` double(10,2) DEFAULT NULL,
  `other_fee` double(10,2) DEFAULT NULL,
  `other_credit` double(10,2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sms_log`
--

CREATE TABLE `tbl_sms_log` (
  `sms_log_id` int(11) NOT NULL,
  `sender` text DEFAULT NULL,
  `text` text DEFAULT NULL,
  `status` text DEFAULT NULL,
  `date_received` datetime DEFAULT NULL,
  `added_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stock_transfer`
--

CREATE TABLE `tbl_stock_transfer` (
  `stock_transfer_id` int(11) NOT NULL,
  `transfer_from` int(11) DEFAULT NULL,
  `transfer_to` int(11) DEFAULT NULL,
  `transfer_date` date DEFAULT NULL,
  `status` mediumtext DEFAULT NULL,
  `added_by` mediumtext DEFAULT NULL,
  `added_on` datetime DEFAULT NULL,
  `updated_by` mediumtext DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stock_transfer_item`
--

CREATE TABLE `tbl_stock_transfer_item` (
  `stock_transfer_item_id` int(11) NOT NULL,
  `stock_transfer_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier`
--

CREATE TABLE `tbl_supplier` (
  `supplier_id` int(11) NOT NULL,
  `name` mediumtext DEFAULT NULL,
  `address` mediumtext DEFAULT NULL,
  `contact_number` mediumtext DEFAULT NULL,
  `contact_person` mediumtext DEFAULT NULL,
  `position` mediumtext DEFAULT NULL,
  `remarks` mediumtext DEFAULT NULL,
  `status` mediumtext DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `added_on` varchar(50) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_on` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`supplier_id`, `name`, `address`, `contact_number`, `contact_person`, `position`, `remarks`, `status`, `added_by`, `added_on`, `updated_by`, `updated_on`) VALUES
(1, 'supp1', 'QC', '0909090909', 'DJ', 'Stand', 'Good', 'active', 2, '2023-05-24 17:47:27', 2, '2023-05-24 17:49:48'),
(2, 'DJ metal works', 'Pampanga', '29885778578', 'Don Don boco', 'Owner', 'good', 'active', 2, '2023-05-25 09:22:36', 22, '06/02/2023 03:27:48pm'),
(8, 'Asdfas', 'Dfas', 'fasdfa', 'Fasdf', 'Sdfasdf', 'Fasdfasdf', 'active', 22, '06/02/2023 03:57:12pm', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `user_group_id` int(11) DEFAULT NULL,
  `username` text DEFAULT NULL,
  `password` text DEFAULT NULL,
  `name` text DEFAULT NULL,
  `status` text DEFAULT NULL,
  `added_by` text DEFAULT NULL,
  `added_on` datetime DEFAULT NULL,
  `updated_by` text DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `isdeleted` int(11) NOT NULL DEFAULT 0,
  `islogin` varchar(50) NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_group_id`, `username`, `password`, `name`, `status`, `added_by`, `added_on`, `updated_by`, `updated_on`, `isdeleted`, `islogin`) VALUES
(2, 2, 'admin', 'YmhyR0hqVUNOWjQwbVdxZHo5RnlwZz09Ojpak+hrnoOqBdplTDq97PTD', 'System Administrator', 'active', NULL, NULL, NULL, NULL, 0, 'No'),
(3, 3, 'earvin', '', 'Earvin Bryan Co', 'active', '2', '2020-07-31 13:33:10', '22', '0000-00-00 00:00:00', 0, 'No'),
(4, 3, 'candie', '', 'Candie Remie Co', 'active', '3', '2020-07-31 13:35:21', '2', '2021-02-15 11:41:18', 0, 'No'),
(5, 3, 'kunwei', '', 'Emmanuel Ang', 'inactive', '3', '2020-08-19 23:29:10', '3', '2022-03-13 15:21:58', 0, 'No'),
(6, 4, 'j.caresosa', '', 'Jeive Lou Romano Caresosa', 'inactive', '3', '2020-12-18 13:13:53', '3', '2022-11-03 14:57:38', 0, 'No'),
(7, 5, 'c.molinay', '', 'Charlie Molinay', 'inactive', '3', '2021-04-07 14:58:14', '3', '2021-10-03 12:50:04', 0, 'No'),
(8, 4, 'd.cantre', '', 'Dimple Cantre', 'inactive', '3', '2021-04-12 15:45:38', '2', '2021-05-24 13:05:00', 0, 'No'),
(9, 5, 'j.ecija', '', 'Jimmy Ecija', 'inactive', '3', '2021-04-13 16:31:38', '3', '2021-04-26 18:36:04', 0, 'No'),
(10, 6, 'm.gomez', '', 'Mary Guinnevere Gomez', 'inactive', '2', '2021-05-24 13:05:37', '3', '2021-07-27 13:09:44', 0, 'No'),
(11, 6, 'velasco.m', '', 'Ma. Franchesca Mae - Velasco', 'inactive', '3', '2021-07-26 16:16:40', '3', '2022-11-03 14:58:08', 0, 'No'),
(12, 5, 'warehouse-a', '', 'Warehouse Team A', 'active', '3', '2021-10-03 12:51:55', NULL, NULL, 0, 'No'),
(13, 6, 'bunsalan.a', '', 'Andrea Mae Frias Bunsalan', 'inactive', '3', '2022-03-01 14:21:24', '3', '2022-04-26 12:53:05', 0, 'No'),
(14, 6, 'villanueva.c', '', 'Christine Villanueva', 'active', '3', '2022-06-21 13:38:01', '3', '2022-06-25 11:57:47', 0, 'No'),
(15, 6, 'collera.cja', '', 'Christelle Joyce Ann Collera', 'inactive', '3', '2022-06-25 12:01:02', '2', '0000-00-00 00:00:00', 0, 'No'),
(16, 4, 'fabian.me', '', 'Maria Elaine Fabian', 'active', '3', '2022-07-08 16:08:02', NULL, NULL, 0, 'No'),
(17, 4, 'cinco.nc', '', 'NATHALEE CANDELA CINCO', 'inactive', '3', '2022-11-03 17:02:08', '3', '2022-11-19 13:58:39', 0, 'No'),
(18, 6, 'chevez.ma', '', 'Mehealanie Agdoro Chavez', 'active', '3', '2022-11-19 13:59:07', '3', '2022-11-19 14:00:22', 0, 'No'),
(19, 6, 'bautista.lf', '', 'Lazaleth Ferran Bautista', 'active', '3', '2022-11-24 17:59:59', '3', '2022-11-24 18:00:36', 0, 'No'),
(22, 12, 'djrboco', '$2y$10$DakenCruuwcTrSWoVL9dZONrgBnPM27wosHYi3kb2y.EMtD79XFm6', 'DJ', 'active', '2', '2023-05-25 11:00:54', '2', '0000-00-00 00:00:00', 0, 'Yes'),
(23, 3, 'testadmin', '$2y$10$I18LFBZCSvvknpJj0Qh.QueehOR3ldIfCOxC/4ZccaiwDIhRMXE8C', 'Testadmin', 'active', '2', '0000-00-00 00:00:00', '22', '0000-00-00 00:00:00', 1, 'No');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_group`
--

CREATE TABLE `tbl_user_group` (
  `user_group_id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `status` text DEFAULT NULL,
  `added_by` text DEFAULT NULL,
  `added_on` varchar(50) DEFAULT NULL,
  `updated_by` text DEFAULT NULL,
  `updated_on` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user_group`
--

INSERT INTO `tbl_user_group` (`user_group_id`, `name`, `level`, `status`, `added_by`, `added_on`, `updated_by`, `updated_on`) VALUES
(2, 'System Administrator', 11, 'active', '2', NULL, NULL, NULL),
(3, 'Adminstrator', 10, 'active', '2', '2020-07-31 13:30:59', '2', '2022-08-26 00:49:31'),
(4, 'Supervisor', 8, 'active', '3', '2020-12-18 13:07:17', '2', '06/02/2023 10:38:26am'),
(5, 'Warehouse', 1, 'active', '3', '2021-04-06 18:33:14', NULL, NULL),
(6, 'Manager', 7, 'active', '2', '2021-05-24 13:04:37', '3', '2022-06-25 13:12:47'),
(7, 'sample', 1, 'active', '2', '2023-05-25 10:35:05', '2', '2023-05-25 10:53:24'),
(8, 'sample2', 1, 'active', '2', '2023-05-31 14:01:45', NULL, NULL),
(10, 'Sample3', 2, 'active', '2', '0000-00-00 00:00:00', NULL, NULL),
(11, 'Sample4', 3, 'active', '2', '0000-00-00 00:00:00', '2', '06/02/2023 10:38:41am'),
(12, 'Sample 5', 4, 'active', '2', '0000-00-00 00:00:00', '22', '06/06/2023 09:10:49am');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_warehouse`
--

CREATE TABLE `tbl_warehouse` (
  `warehouse_id` int(11) NOT NULL,
  `name` mediumtext DEFAULT NULL,
  `address` mediumtext DEFAULT NULL,
  `contact_number` mediumtext DEFAULT NULL,
  `email_address` mediumtext DEFAULT NULL,
  `status` mediumtext DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `added_on` varchar(50) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_on` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_warehouse`
--

INSERT INTO `tbl_warehouse` (`warehouse_id`, `name`, `address`, `contact_number`, `email_address`, `status`, `added_by`, `added_on`, `updated_by`, `updated_on`) VALUES
(1, '189 Speaker Perez', '', '', '', 'active', 4, '2020-07-31 23:23:46', 22, '06/05/2023 03:17:33pm'),
(2, '211 Speaker Perez', '', '', '', 'active', 3, '2021-04-29 09:47:08', NULL, NULL),
(3, '167 Kanlaon Street', 'Address', '999595', 'sample@email.com', 'active', 3, '2021-04-29 09:47:28', 22, '06/05/2023 03:42:44pm'),
(7, 'Sample2', 'Fasdf', '192168167567', 'sample@email.com', 'active', 22, '06/05/2023 03:41:57pm', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_access_control_list`
--
ALTER TABLE `tbl_access_control_list`
  ADD PRIMARY KEY (`access_control_list_id`);

--
-- Indexes for table `tbl_access_log`
--
ALTER TABLE `tbl_access_log`
  ADD PRIMARY KEY (`access_log_id`);

--
-- Indexes for table `tbl_agency`
--
ALTER TABLE `tbl_agency`
  ADD PRIMARY KEY (`agency_id`);

--
-- Indexes for table `tbl_bank_account`
--
ALTER TABLE `tbl_bank_account`
  ADD PRIMARY KEY (`bank_account_id`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `tbl_customer_corporate`
--
ALTER TABLE `tbl_customer_corporate`
  ADD PRIMARY KEY (`customer_corporate_id`);

--
-- Indexes for table `tbl_daily_time_record`
--
ALTER TABLE `tbl_daily_time_record`
  ADD PRIMARY KEY (`daily_time_record_id`);

--
-- Indexes for table `tbl_damage_item`
--
ALTER TABLE `tbl_damage_item`
  ADD PRIMARY KEY (`damage_item_id`);

--
-- Indexes for table `tbl_display_item`
--
ALTER TABLE `tbl_display_item`
  ADD PRIMARY KEY (`display_item_id`);

--
-- Indexes for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `tbl_exchange`
--
ALTER TABLE `tbl_exchange`
  ADD PRIMARY KEY (`exchange_id`);

--
-- Indexes for table `tbl_expense`
--
ALTER TABLE `tbl_expense`
  ADD PRIMARY KEY (`expense_id`);

--
-- Indexes for table `tbl_expense_category`
--
ALTER TABLE `tbl_expense_category`
  ADD PRIMARY KEY (`expense_category_id`);

--
-- Indexes for table `tbl_expense_item`
--
ALTER TABLE `tbl_expense_item`
  ADD PRIMARY KEY (`expense_item_id`);

--
-- Indexes for table `tbl_fleet`
--
ALTER TABLE `tbl_fleet`
  ADD PRIMARY KEY (`fleet_id`);

--
-- Indexes for table `tbl_fleet_location`
--
ALTER TABLE `tbl_fleet_location`
  ADD PRIMARY KEY (`fleet_location_id`);

--
-- Indexes for table `tbl_item`
--
ALTER TABLE `tbl_item`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `tbl_item_category`
--
ALTER TABLE `tbl_item_category`
  ADD PRIMARY KEY (`item_category_id`);

--
-- Indexes for table `tbl_module`
--
ALTER TABLE `tbl_module`
  ADD PRIMARY KEY (`module_id`);

--
-- Indexes for table `tbl_note`
--
ALTER TABLE `tbl_note`
  ADD PRIMARY KEY (`note_id`);

--
-- Indexes for table `tbl_option`
--
ALTER TABLE `tbl_option`
  ADD PRIMARY KEY (`option_id`);

--
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `tbl_payment_detail`
--
ALTER TABLE `tbl_payment_detail`
  ADD PRIMARY KEY (`payment_detail_id`);

--
-- Indexes for table `tbl_payment_item`
--
ALTER TABLE `tbl_payment_item`
  ADD PRIMARY KEY (`payment_item_id`);

--
-- Indexes for table `tbl_purchase`
--
ALTER TABLE `tbl_purchase`
  ADD PRIMARY KEY (`purchase_id`);

--
-- Indexes for table `tbl_purchase_item`
--
ALTER TABLE `tbl_purchase_item`
  ADD PRIMARY KEY (`purchase_item_id`);

--
-- Indexes for table `tbl_quotation`
--
ALTER TABLE `tbl_quotation`
  ADD PRIMARY KEY (`quotation_id`);

--
-- Indexes for table `tbl_quotation_item`
--
ALTER TABLE `tbl_quotation_item`
  ADD PRIMARY KEY (`quotation_item_id`);

--
-- Indexes for table `tbl_reservation`
--
ALTER TABLE `tbl_reservation`
  ADD PRIMARY KEY (`reservation_id`);

--
-- Indexes for table `tbl_reservation_item`
--
ALTER TABLE `tbl_reservation_item`
  ADD PRIMARY KEY (`reservation_item_id`);

--
-- Indexes for table `tbl_sales`
--
ALTER TABLE `tbl_sales`
  ADD PRIMARY KEY (`sales_id`);

--
-- Indexes for table `tbl_sales_ecommerce`
--
ALTER TABLE `tbl_sales_ecommerce`
  ADD PRIMARY KEY (`sales_ecommerce_id`);

--
-- Indexes for table `tbl_sales_item`
--
ALTER TABLE `tbl_sales_item`
  ADD PRIMARY KEY (`sales_item_id`);

--
-- Indexes for table `tbl_sales_lazada`
--
ALTER TABLE `tbl_sales_lazada`
  ADD PRIMARY KEY (`sales_lazada_id`);

--
-- Indexes for table `tbl_sales_shopee`
--
ALTER TABLE `tbl_sales_shopee`
  ADD PRIMARY KEY (`sales_shopee_id`);

--
-- Indexes for table `tbl_sms_log`
--
ALTER TABLE `tbl_sms_log`
  ADD PRIMARY KEY (`sms_log_id`);

--
-- Indexes for table `tbl_stock_transfer`
--
ALTER TABLE `tbl_stock_transfer`
  ADD PRIMARY KEY (`stock_transfer_id`);

--
-- Indexes for table `tbl_stock_transfer_item`
--
ALTER TABLE `tbl_stock_transfer_item`
  ADD PRIMARY KEY (`stock_transfer_item_id`);

--
-- Indexes for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_user_group`
--
ALTER TABLE `tbl_user_group`
  ADD PRIMARY KEY (`user_group_id`);

--
-- Indexes for table `tbl_warehouse`
--
ALTER TABLE `tbl_warehouse`
  ADD PRIMARY KEY (`warehouse_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_access_control_list`
--
ALTER TABLE `tbl_access_control_list`
  MODIFY `access_control_list_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1081;

--
-- AUTO_INCREMENT for table `tbl_access_log`
--
ALTER TABLE `tbl_access_log`
  MODIFY `access_log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `tbl_agency`
--
ALTER TABLE `tbl_agency`
  MODIFY `agency_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_bank_account`
--
ALTER TABLE `tbl_bank_account`
  MODIFY `bank_account_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_customer_corporate`
--
ALTER TABLE `tbl_customer_corporate`
  MODIFY `customer_corporate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_daily_time_record`
--
ALTER TABLE `tbl_daily_time_record`
  MODIFY `daily_time_record_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_damage_item`
--
ALTER TABLE `tbl_damage_item`
  MODIFY `damage_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_display_item`
--
ALTER TABLE `tbl_display_item`
  MODIFY `display_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_exchange`
--
ALTER TABLE `tbl_exchange`
  MODIFY `exchange_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_expense`
--
ALTER TABLE `tbl_expense`
  MODIFY `expense_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_expense_category`
--
ALTER TABLE `tbl_expense_category`
  MODIFY `expense_category_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_expense_item`
--
ALTER TABLE `tbl_expense_item`
  MODIFY `expense_item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_fleet`
--
ALTER TABLE `tbl_fleet`
  MODIFY `fleet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_fleet_location`
--
ALTER TABLE `tbl_fleet_location`
  MODIFY `fleet_location_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_item`
--
ALTER TABLE `tbl_item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=563;

--
-- AUTO_INCREMENT for table `tbl_item_category`
--
ALTER TABLE `tbl_item_category`
  MODIFY `item_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_module`
--
ALTER TABLE `tbl_module`
  MODIFY `module_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `tbl_note`
--
ALTER TABLE `tbl_note`
  MODIFY `note_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_option`
--
ALTER TABLE `tbl_option`
  MODIFY `option_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_payment_detail`
--
ALTER TABLE `tbl_payment_detail`
  MODIFY `payment_detail_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_payment_item`
--
ALTER TABLE `tbl_payment_item`
  MODIFY `payment_item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_purchase`
--
ALTER TABLE `tbl_purchase`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_purchase_item`
--
ALTER TABLE `tbl_purchase_item`
  MODIFY `purchase_item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_quotation`
--
ALTER TABLE `tbl_quotation`
  MODIFY `quotation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_quotation_item`
--
ALTER TABLE `tbl_quotation_item`
  MODIFY `quotation_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_reservation`
--
ALTER TABLE `tbl_reservation`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_reservation_item`
--
ALTER TABLE `tbl_reservation_item`
  MODIFY `reservation_item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_sales`
--
ALTER TABLE `tbl_sales`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_sales_ecommerce`
--
ALTER TABLE `tbl_sales_ecommerce`
  MODIFY `sales_ecommerce_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_sales_item`
--
ALTER TABLE `tbl_sales_item`
  MODIFY `sales_item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_sales_lazada`
--
ALTER TABLE `tbl_sales_lazada`
  MODIFY `sales_lazada_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_sales_shopee`
--
ALTER TABLE `tbl_sales_shopee`
  MODIFY `sales_shopee_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_stock_transfer`
--
ALTER TABLE `tbl_stock_transfer`
  MODIFY `stock_transfer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_stock_transfer_item`
--
ALTER TABLE `tbl_stock_transfer_item`
  MODIFY `stock_transfer_item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_user_group`
--
ALTER TABLE `tbl_user_group`
  MODIFY `user_group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_warehouse`
--
ALTER TABLE `tbl_warehouse`
  MODIFY `warehouse_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
