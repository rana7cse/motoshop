-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2015 at 10:42 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `eshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `car_loan`
--

CREATE TABLE IF NOT EXISTS `car_loan` (
  `id` int(10) unsigned NOT NULL,
  `sold_id` int(11) NOT NULL,
  `rate` float NOT NULL,
  `total_inst` int(11) NOT NULL,
  `current_inst` int(11) NOT NULL,
  `current_paid` int(11) NOT NULL,
  `current_due` int(11) NOT NULL,
  `next_pay_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `car_loan`
--

INSERT INTO `car_loan` (`id`, `sold_id`, `rate`, `total_inst`, `current_inst`, `current_paid`, `current_due`, `next_pay_date`, `end_date`, `created_at`, `updated_at`) VALUES
(1, 3, 1250, 4, 1, 4000, 5000, '2015-12-22', '2016-03-22', '2015-11-21 20:32:24', '2015-11-21 20:32:24');

-- --------------------------------------------------------

--
-- Table structure for table `customars`
--

CREATE TABLE IF NOT EXISTS `customars` (
  `id` int(10) unsigned NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fat_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `thana` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `zilla` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `division` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `ref` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'NA',
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nid_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'NA',
  `img` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customars`
--

INSERT INTO `customars` (`id`, `first_name`, `fat_name`, `address`, `thana`, `zilla`, `division`, `ref`, `phone`, `phone2`, `email`, `nid_no`, `img`, `created_at`, `updated_at`) VALUES
(16, 'Salahuddin RanaX', 'Jalaluddin Ahmed', 'GoalChamot,Sriaungon', 'Faridpur Sadar', 'Faridpur', 'Dhaka', 'NA', '01754258222', '01686355405', 'rana7cse@gmail.com', 'NA', '', '2015-11-19 20:54:57', '2015-11-19 21:11:59'),
(17, 'Ibrahim Molla', 'Jasim Mollah', 'Vora Pukur', 'Khali Pukur', 'Nai Pukur', 'Dhaka', 'NA', '01756895456', '124557445', 'vora@gmail.com', 'NA', '', '2015-11-19 21:22:14', '2015-11-19 21:22:14');

-- --------------------------------------------------------

--
-- Table structure for table `customar_payment`
--

CREATE TABLE IF NOT EXISTS `customar_payment` (
  `id` int(10) unsigned NOT NULL,
  `car_sold_id` int(11) NOT NULL,
  `cus_id` int(11) NOT NULL,
  `paid` double NOT NULL,
  `interest` float NOT NULL,
  `due_date` date NOT NULL,
  `transection_id` int(11) NOT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customar_payment`
--

INSERT INTO `customar_payment` (`id`, `car_sold_id`, `cus_id`, `paid`, `interest`, `due_date`, `transection_id`, `comment`, `created_at`, `updated_at`) VALUES
(1, 1, 17, 35000, 0, '2015-11-22', 0, 'sold with cash', '2015-11-21 20:20:34', '2015-11-21 20:20:34'),
(2, 2, 16, 37000, 0, '2015-11-22', 1, 'sold with cash', '2015-11-21 20:30:19', '2015-11-21 20:30:19'),
(3, 3, 17, 4000, 0, '2015-11-22', 1, 'sold with due', '2015-11-21 20:32:24', '2015-11-21 20:32:24');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE IF NOT EXISTS `inventory` (
  `id` int(10) unsigned NOT NULL,
  `product_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `eng_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `chs_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_sell` enum('1','0') COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `buy_rate` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sell_rate` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comision_tk` double NOT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `item_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `supplyir_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `product_id`, `eng_no`, `chs_no`, `is_sell`, `color`, `quantity`, `buy_rate`, `sell_rate`, `comision_tk`, `img`, `item_no`, `supplyir_id`, `created_at`, `updated_at`) VALUES
(4, '18', '20015', '2004', '1', 'red', 1, '20000', '30000', 0, 'NA', 'NA', 'NA', '2015-08-01 19:19:59', '2015-08-01 19:19:59'),
(5, '18', '20015', '2004', '1', 'red', 1, '20000', '30000', 0, 'NA', 'NA', 'NA', '2015-08-01 19:20:01', '2015-08-01 19:20:01'),
(6, '18', '20015', '2004', '0', 'red', 1, '20000', '30000', 0, 'NA', 'NA', 'NA', '2015-08-01 19:20:02', '2015-08-01 19:20:02'),
(7, '18', '20015', '2004', '0', 'red', 1, '20000', '30000', 0, 'NA', 'NA', 'NA', '2015-08-01 19:22:53', '2015-08-01 19:22:53'),
(8, '18', '123456', '2325', '0', 'green', 1, '2000', '30000', 0, 'NA', 'NA', 'NA', '2015-08-01 19:23:58', '2015-08-01 19:23:58'),
(9, '19', '123456', '123457', '1', 'green', 1, '1000', '2000', 0, 'NA', 'NA', 'NA', '2015-08-01 19:24:44', '2015-08-01 19:24:44'),
(10, '18', '8954584', '5644521', '0', 'red', 1, '1800000', '2500000', 0, 'NA', 'NA', 'NA', '2015-08-01 21:02:45', '2015-08-01 21:02:45'),
(12, '19', '215642', '245145', '0', 'red', 1, '20000', '200000', 0, 'NA', 'NA', 'NA', '2015-08-02 17:32:14', '2015-08-02 17:32:14'),
(13, '26', '444', '444', '0', 'red', 1, '200', '200', 0, 'NA', 'NA', 'NA', '2015-08-07 15:30:38', '2015-08-07 15:30:38'),
(14, '18', '2895484', '123457', '0', 'red', 1, '1000', '1110', 0, 'NA', 'NA', 'NA', '2015-08-09 12:10:27', '2015-08-09 12:10:27'),
(15, '27', '800', '100', '0', 'red', 1, '200', '1200', 0, 'NA', 'NA', 'NA', '2015-08-12 13:05:05', '2015-08-12 13:05:05'),
(16, '', 'aaaaaaa', 'aaaa', '0', '', 1, '', '', 0, 'NA', 'NA', 'NA', '2015-08-29 09:00:35', '2015-08-29 09:00:35'),
(17, '18', '254555', '24566', '0', 'red', 1, '20000', '20000', 0, 'NA', 'NA', '3', '2015-09-01 13:21:16', '2015-09-01 13:21:16'),
(18, '19', '4445', '445', '0', 'red', 1, '1200000', '140000', 0, 'NA', 'NA', '4', '2015-09-15 16:16:13', '2015-09-15 16:16:13'),
(19, '19', '2014', '2014X', '0', 'red', 1, '2000', '3000', 200, 'NA', 'NA', '2', '2015-11-15 18:32:40', '2015-11-15 18:32:40');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2015_07_23_184907_create_table_product', 1),
('2015_07_30_203439_create_inventory_table', 2),
('2015_08_03_144229_create_customar_table', 3),
('2015_08_03_145523_create_customars_table', 4),
('2015_08_08_010536_supplier_table', 5),
('2015_08_17_021801_moto_sold_table', 6),
('2015_08_17_022821_customar_payment_table', 6),
('2015_08_17_023835_loan_info_table', 6),
('2015_08_17_024140_car_loan_table', 6),
('2015_08_17_025808_supplier_payment_table', 7),
('2015_08_17_030235_product_buy_info', 7),
('2015_09_01_040300_user_table_migration', 8),
('2015_11_19_001625_refetance_table', 9),
('2015_11_21_064717_create_table_transection_status', 10),
('2015_11_21_071200_create_table_transectio_status', 10);

-- --------------------------------------------------------

--
-- Table structure for table `moto_sold`
--

CREATE TABLE IF NOT EXISTS `moto_sold` (
  `id` int(10) unsigned NOT NULL,
  `inv_id` int(11) NOT NULL,
  `cus_id` int(11) NOT NULL,
  `ref_id` int(11) NOT NULL,
  `price` double NOT NULL,
  `vat` double NOT NULL,
  `bank_int` double NOT NULL,
  `sold_date` date NOT NULL,
  `payment_status` enum('cash','due') COLLATE utf8_unicode_ci NOT NULL,
  `total_billed` double NOT NULL,
  `installments` int(11) NOT NULL,
  `paid` int(11) NOT NULL,
  `due` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `moto_sold`
--

INSERT INTO `moto_sold` (`id`, `inv_id`, `cus_id`, `ref_id`, `price`, `vat`, `bank_int`, `sold_date`, `payment_status`, `total_billed`, `installments`, `paid`, `due`, `created_at`, `updated_at`) VALUES
(2, 5, 16, 1, 30000, 4000, 3000, '2015-11-22', 'cash', 37000, 0, 37000, 0, '2015-11-21 20:30:19', '2015-11-21 20:30:19'),
(3, 9, 17, 1, 2000, 3000, 4000, '2015-11-22', 'due', 9000, 4, 4000, 5000, '2015-11-21 20:32:24', '2015-11-21 20:32:24');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(10) unsigned NOT NULL,
  `product_name` char(255) COLLATE utf8_unicode_ci NOT NULL,
  `bike_cc` int(11) NOT NULL,
  `model` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_name`, `bike_cc`, `model`, `created_at`, `updated_at`) VALUES
(18, 'Palsure', 255, 0, '2015-07-30 06:37:12', '2015-10-31 08:08:10'),
(19, 'Pulsure', 0, 0, '2015-07-30 06:38:19', '2015-07-30 06:38:19'),
(20, 'Rana', 0, 0, '2015-07-30 06:39:38', '2015-07-30 14:19:13'),
(21, 'Hiron', 0, 0, '2015-07-30 06:41:13', '2015-07-30 14:19:35'),
(25, 'Workers', 0, 0, '2015-07-30 14:28:19', '2015-07-31 03:07:29'),
(26, 'BAJAJ', 0, 0, '2015-08-07 15:29:43', '2015-08-07 15:29:54'),
(27, 'Xinfu', 0, 0, '2015-08-12 13:04:36', '2015-08-12 13:04:36'),
(28, 'Bajaj Pulsar', 150, 2015, '2015-08-29 20:07:21', '2015-08-29 20:07:21'),
(29, 'pulsur', 200, 2015, '2015-10-31 08:07:21', '2015-10-31 08:07:21');

-- --------------------------------------------------------

--
-- Table structure for table `pro_buy_info`
--

CREATE TABLE IF NOT EXISTS `pro_buy_info` (
  `id` int(10) unsigned NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ammount` double NOT NULL,
  `pay` double NOT NULL,
  `due` double NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pro_buy_info`
--

INSERT INTO `pro_buy_info` (`id`, `supplier_id`, `comment`, `ammount`, `pay`, `due`, `date`, `created_at`, `updated_at`) VALUES
(1, 3, 'test purpose', 20000, 20000, 0, '2015-08-20', '2015-08-20 09:27:27', '2015-08-20 09:37:13'),
(2, 4, '10 pal', 200000, 120000, 80000, '2015-08-01', '2015-08-20 09:44:48', '2015-08-20 09:45:43');

-- --------------------------------------------------------

--
-- Table structure for table `referance`
--

CREATE TABLE IF NOT EXISTS `referance` (
  `id` int(10) unsigned NOT NULL,
  `ref_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Father_Name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `thana` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zilla` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `division` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact` int(11) NOT NULL,
  `contact2` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `referance`
--

INSERT INTO `referance` (`id`, `ref_name`, `Father_Name`, `address`, `thana`, `zilla`, `division`, `country`, `contact`, `contact2`, `created_at`, `updated_at`) VALUES
(1, 'Rafuqul Amin', 'Tafiqul Amin', 'Jizak Road', 'Thana Pong', 'DinajPur', '', '', 1654875, 12456, '2015-11-19 22:36:40', '2015-11-19 22:36:40'),
(2, 'Samiul Alam', 'Rajon', 'vps', 'hps', 'zillama', '', '', 1724568978, 1712458465, '2015-11-19 22:39:45', '2015-11-19 22:39:45'),
(3, 'Farabi Rahman', 'Jamal Uddin Mollah', 'Rahmatpur', 'RamGong', 'Pula Khali', '', '', 1724058171, 1686355405, '2015-11-21 00:45:26', '2015-11-21 00:45:26'),
(4, 'Samiul Alam', 'Ibrahim Mollah', 'Villegers', 'Thana', 'Zilla', '', '', 1724058171, 1724058171, '2015-11-21 00:59:27', '2015-11-21 00:59:27'),
(5, 'Referance', 'Ref Father', 'Ref Village', 'Ref Thana', 'Ref Zilla', '', '', 11912584, 11912584, '2015-11-21 01:10:23', '2015-11-21 01:10:23'),
(6, 'Hamid Mollah', 'Rajib Mollah', 'Ibrahim Pu', 'Kafrul', 'Dhaka', '', '', 1724058475, 1686355405, '2015-11-21 01:27:02', '2015-11-21 01:27:02');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
  `id` int(10) unsigned NOT NULL,
  `supp_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `supp_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `supp_add` text COLLATE utf8_unicode_ci NOT NULL,
  `supp_mgm` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `contact_f` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `contact_s` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `supp_name`, `supp_type`, `supp_add`, `supp_mgm`, `contact_f`, `contact_s`, `email`, `created_at`, `updated_at`) VALUES
(2, 'Ibrahim Motors', 'Retailer', 'SonarGaon Road Dhaka', 'Mizan vai', '8801724058171', '', 'ibmotors@gmail.com', '2015-08-14 20:38:07', '2015-08-14 20:38:07'),
(3, 'Samsul Islam', 'Bajaj Dealear', 'Goalchamot, Mollabari Sarak', 'Tuhin Vai', '01685456985', '', 'laban@gmail.com', '2015-08-17 21:43:54', '2015-08-17 21:43:54'),
(4, 'Rana Motors', 'Dealer', 'Faridpur', '', '017240258171', '', 'rana@gmail.com', '2015-08-20 09:42:44', '2015-08-20 09:42:44');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_payment`
--

CREATE TABLE IF NOT EXISTS `supplier_payment` (
  `id` int(10) unsigned NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ammount` double NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `supplier_payment`
--

INSERT INTO `supplier_payment` (`id`, `supplier_id`, `order_id`, `comment`, `ammount`, `date`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 'test purpose', 20000, '2015-08-20', '2015-08-20 09:27:28', '2015-08-20 09:27:28'),
(2, 3, 1, 'Paid on Order-1', 10000, '2015-08-13', '2015-08-20 09:34:43', '2015-08-20 09:34:43'),
(3, 3, 1, 'Paid on Order-1', 5000, '2015-08-01', '2015-08-20 09:37:13', '2015-08-20 09:37:13'),
(4, 4, 2, '10 pal', 200000, '2015-08-01', '2015-08-20 09:44:48', '2015-08-20 09:44:48'),
(5, 4, 2, 'Paid on Order-2', 20000, '2015-08-20', '2015-08-20 09:45:43', '2015-08-20 09:45:43');

-- --------------------------------------------------------

--
-- Table structure for table `transection_type`
--

CREATE TABLE IF NOT EXISTS `transection_type` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `desc` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `transection_type`
--

INSERT INTO `transection_type` (`id`, `name`, `desc`, `created_at`, `updated_at`) VALUES
(1, 'payment', 'payment make for sell', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'payment for installment', 'installment pay for due bill', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL,
  `user_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rolw` enum('1','2','3','4','5') COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_name`, `password`, `full_name`, `rolw`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', '123456', 'Administrator', '1', 'sYfQggaFYordH0dN5QazGe1dnkGb97NnJHZxBo54nSGLUeJaNPoexoY8em20', '0000-00-00 00:00:00', '2015-12-04 17:49:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `car_loan`
--
ALTER TABLE `car_loan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customars`
--
ALTER TABLE `customars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customar_payment`
--
ALTER TABLE `customar_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `moto_sold`
--
ALTER TABLE `moto_sold`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pro_buy_info`
--
ALTER TABLE `pro_buy_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `referance`
--
ALTER TABLE `referance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier_payment`
--
ALTER TABLE `supplier_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transection_type`
--
ALTER TABLE `transection_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `user_user_name_unique` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `car_loan`
--
ALTER TABLE `car_loan`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `customars`
--
ALTER TABLE `customars`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `customar_payment`
--
ALTER TABLE `customar_payment`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `moto_sold`
--
ALTER TABLE `moto_sold`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `pro_buy_info`
--
ALTER TABLE `pro_buy_info`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `referance`
--
ALTER TABLE `referance`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `supplier_payment`
--
ALTER TABLE `supplier_payment`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `transection_type`
--
ALTER TABLE `transection_type`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
