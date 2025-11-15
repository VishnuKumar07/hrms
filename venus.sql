-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 14, 2025 at 08:49 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `venus`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank_details`
--

DROP TABLE IF EXISTS `bank_details`;
CREATE TABLE IF NOT EXISTS `bank_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `bank_name` varchar(195) DEFAULT NULL,
  `branch_name` varchar(195) DEFAULT NULL,
  `account_number` varchar(195) DEFAULT NULL,
  `ifsc_code` varchar(195) DEFAULT NULL,
  `uan_number` varchar(195) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bloodgroups`
--

DROP TABLE IF EXISTS `bloodgroups`;
CREATE TABLE IF NOT EXISTS `bloodgroups` (
  `id` int NOT NULL AUTO_INCREMENT,
  `bloodgroup` varchar(195) NOT NULL,
  `created_by` varchar(195) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bloodgroups`
--

INSERT INTO `bloodgroups` (`id`, `bloodgroup`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'A+', 'Super Admin', '2025-11-05 03:15:39', '2025-11-05 03:31:37', NULL),
(2, 'A−', 'Super Admin', '2025-11-08 04:42:23', '2025-11-08 04:42:23', NULL),
(3, 'B+', 'Super Admin', '2025-11-08 04:42:28', '2025-11-08 04:42:28', NULL),
(4, 'B−', 'Super Admin', '2025-11-08 04:42:34', '2025-11-08 04:42:34', NULL),
(5, 'AB+', 'Super Admin', '2025-11-08 04:42:39', '2025-11-08 04:42:39', NULL),
(6, 'AB−', 'Super Admin', '2025-11-08 04:42:48', '2025-11-08 04:42:48', NULL),
(7, 'O+', 'Super Admin', '2025-11-08 04:42:56', '2025-11-08 04:42:56', NULL),
(8, 'O−', 'Super Admin', '2025-11-08 04:43:02', '2025-11-08 04:43:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
CREATE TABLE IF NOT EXISTS `countries` (
  `id` int NOT NULL AUTO_INCREMENT,
  `country` varchar(195) NOT NULL,
  `created_by` varchar(195) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=196 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Afghanistan', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(2, 'Albania', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(3, 'Algeria', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(4, 'Andorra', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(5, 'Angola', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(6, 'Antigua and Barbuda', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(7, 'Argentina', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(8, 'Armenia', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(9, 'Australia', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(10, 'Austria', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(11, 'Azerbaijan', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(12, 'Bahamas', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(13, 'Bahrain', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(14, 'Bangladesh', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(15, 'Barbados', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(16, 'Belarus', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(17, 'Belgium', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(18, 'Belize', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(19, 'Benin', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(20, 'Bhutan', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(21, 'Bolivia', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(22, 'Bosnia and Herzegovina', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(23, 'Botswana', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(24, 'Brazil', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(25, 'Brunei', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(26, 'Bulgaria', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(27, 'Burkina Faso', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(28, 'Burundi', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(29, 'Cabo Verde', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(30, 'Cambodia', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(31, 'Cameroon', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(32, 'Canada', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(33, 'Central African Republic', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(34, 'Chad', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(35, 'Chile', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(36, 'China', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(37, 'Colombia', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(38, 'Comoros', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(39, 'Congo, Democratic Republic of the', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(40, 'Congo, Republic of the', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(41, 'Costa Rica', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(42, 'Croatia', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(43, 'Cuba', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(44, 'Cyprus', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(45, 'Czech Republic (Czechia)', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(46, 'Denmark', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(47, 'Djibouti', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(48, 'Dominica', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(49, 'Dominican Republic', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(50, 'Ecuador', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(51, 'Egypt', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(52, 'El Salvador', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(53, 'Equatorial Guinea', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(54, 'Eritrea', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(55, 'Estonia', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(56, 'Eswatini', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(57, 'Ethiopia', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(58, 'Fiji', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(59, 'Finland', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(60, 'France', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(61, 'Gabon', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(62, 'Gambia', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(63, 'Georgia', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(64, 'Germany', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(65, 'Ghana', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(66, 'Greece', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(67, 'Grenada', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(68, 'Guatemala', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(69, 'Guinea', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(70, 'Guinea-Bissau', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(71, 'Guyana', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(72, 'Haiti', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(73, 'Honduras', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(74, 'Hungary', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(75, 'Iceland', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(76, 'India', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(77, 'Indonesia', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(78, 'Iran', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(79, 'Iraq', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(80, 'Ireland', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(81, 'Israel', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(82, 'Italy', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(83, 'Jamaica', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(84, 'Japan', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(85, 'Jordan', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(86, 'Kazakhstan', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(87, 'Kenya', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(88, 'Kiribati', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(89, 'North Korea', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(90, 'South Korea', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(91, 'Kuwait', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(92, 'Kyrgyzstan', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(93, 'Laos', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(94, 'Latvia', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(95, 'Lebanon', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(96, 'Lesotho', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(97, 'Liberia', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(98, 'Libya', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(99, 'Liechtenstein', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(100, 'Lithuania', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(101, 'Luxembourg', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(102, 'Madagascar', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(103, 'Malawi', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(104, 'Malaysia', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(105, 'Maldives', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(106, 'Mali', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(107, 'Malta', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(108, 'Marshall Islands', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(109, 'Mauritania', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(110, 'Mauritius', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(111, 'Mexico', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(112, 'Micronesia', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(113, 'Moldova', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(114, 'Monaco', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(115, 'Mongolia', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(116, 'Montenegro', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(117, 'Morocco', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(118, 'Mozambique', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(119, 'Myanmar', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(120, 'Namibia', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(121, 'Nauru', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(122, 'Nepal', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(123, 'Netherlands', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(124, 'New Zealand', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(125, 'Nicaragua', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(126, 'Niger', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(127, 'Nigeria', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(128, 'North Macedonia', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(129, 'Norway', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(130, 'Oman', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(131, 'Pakistan', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(132, 'Palau', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(133, 'Palestine', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(134, 'Panama', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(135, 'Papua New Guinea', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(136, 'Paraguay', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(137, 'Peru', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(138, 'Philippines', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(139, 'Poland', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(140, 'Portugal', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(141, 'Qatar', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(142, 'Romania', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(143, 'Russia', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(144, 'Rwanda', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(145, 'Saint Kitts and Nevis', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(146, 'Saint Lucia', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(147, 'Saint Vincent and the Grenadines', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(148, 'Samoa', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(149, 'San Marino', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(150, 'São Tomé and Príncipe', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(151, 'Saudi Arabia', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(152, 'Senegal', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(153, 'Serbia', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(154, 'Seychelles', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(155, 'Sierra Leone', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(156, 'Singapore', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(157, 'Slovakia', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(158, 'Slovenia', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(159, 'Solomon Islands', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(160, 'Somalia', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(161, 'South Africa', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(162, 'South Sudan', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(163, 'Spain', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(164, 'Sri Lanka', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(165, 'Sudan', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(166, 'Suriname', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(167, 'Sweden', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(168, 'Switzerland', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(169, 'Syria', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(170, 'Taiwan', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(171, 'Tajikistan', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(172, 'Tanzania', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(173, 'Thailand', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(174, 'Timor-Leste', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(175, 'Togo', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(176, 'Tonga', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(177, 'Trinidad and Tobago', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(178, 'Tunisia', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(179, 'Turkey', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(180, 'Turkmenistan', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(181, 'Tuvalu', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(182, 'Uganda', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(183, 'Ukraine', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(184, 'United Arab Emirates', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(185, 'United Kingdom', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(186, 'United States', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(187, 'Uruguay', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(188, 'Uzbekistan', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(189, 'Vanuatu', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(190, 'Vatican City', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(191, 'Venezuela', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(192, 'Vietnam', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(193, 'Yemen', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(194, 'Zambia', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL),
(195, 'Zimbabwe', 'Super Admin', '2025-11-05 16:53:54', '2025-11-05 16:53:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

DROP TABLE IF EXISTS `designations`;
CREATE TABLE IF NOT EXISTS `designations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `designation` varchar(195) DEFAULT NULL,
  `created_by` varchar(195) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `designation`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'HR Manager', 'Super Admin', '2025-11-04 09:02:30', '2025-11-04 09:19:19', NULL),
(2, 'Web Developer', 'Super Admin', '2025-11-04 13:45:16', '2025-11-04 13:45:16', NULL),
(3, 'UX/UI Designer', 'Super Admin', '2025-11-06 09:38:20', '2025-11-06 09:38:20', NULL),
(4, 'Project Co-ordinator', 'Super Admin', '2025-11-06 09:38:35', '2025-11-06 09:38:35', NULL),
(5, 'Software Tester', 'Super Admin', '2025-11-06 09:38:45', '2025-11-06 09:38:45', NULL),
(6, 'Digital Marketing', 'Super Admin', '2025-11-06 09:39:06', '2025-11-06 09:39:06', NULL),
(7, 'App Developer', 'Super Admin', '2025-11-06 09:39:19', '2025-11-06 09:39:19', NULL),
(8, 'Graphic Designer', 'Super Admin', '2025-11-06 09:40:50', '2025-11-06 09:40:50', NULL),
(9, 'Tester Lead', 'Super Admin', '2025-11-06 09:41:16', '2025-11-06 09:41:16', NULL),
(10, 'Developer Lead', 'Super Admin', '2025-11-06 09:41:25', '2025-11-06 09:41:25', NULL),
(11, 'Accountant', 'Super Admin', '2025-11-06 09:41:47', '2025-11-06 09:41:47', NULL),
(12, 'Data Analyst', 'Super Admin', '2025-11-06 09:42:47', '2025-11-06 09:42:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

DROP TABLE IF EXISTS `districts`;
CREATE TABLE IF NOT EXISTS `districts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `district` varchar(195) NOT NULL,
  `state_id` int DEFAULT NULL,
  `country_id` int DEFAULT NULL,
  `created_by` varchar(195) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=131 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `district`, `state_id`, `country_id`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Ariyalur', 31, 76, 'Super Admin', '2025-11-07 18:09:04', '2025-11-07 18:09:04', NULL),
(2, 'Chengalpattu', 31, 76, 'Super Admin', '2025-11-07 18:09:04', '2025-11-07 18:09:04', NULL),
(3, 'Chennai', 31, 76, 'Super Admin', '2025-11-07 18:09:04', '2025-11-07 18:09:04', NULL),
(4, 'Coimbatore', 31, 76, 'Super Admin', '2025-11-07 18:09:04', '2025-11-07 18:09:04', NULL),
(5, 'Cuddalore', 31, 76, 'Super Admin', '2025-11-07 18:09:04', '2025-11-07 18:09:04', NULL),
(6, 'Dharmapuri', 31, 76, 'Super Admin', '2025-11-07 18:09:04', '2025-11-07 18:09:04', NULL),
(7, 'Dindigul', 31, 76, 'Super Admin', '2025-11-07 18:09:04', '2025-11-07 18:09:04', NULL),
(8, 'Erode', 31, 76, 'Super Admin', '2025-11-07 18:09:04', '2025-11-07 18:09:04', NULL),
(9, 'Kallakurichi', 31, 76, 'Super Admin', '2025-11-07 18:09:04', '2025-11-07 18:09:04', NULL),
(10, 'Kanchipuram', 31, 76, 'Super Admin', '2025-11-07 18:09:04', '2025-11-07 18:09:04', NULL),
(11, 'Karur', 31, 76, 'Super Admin', '2025-11-07 18:09:04', '2025-11-07 18:09:04', NULL),
(12, 'Krishnagiri', 31, 76, 'Super Admin', '2025-11-07 18:09:04', '2025-11-07 18:09:04', NULL),
(13, 'Madurai', 31, 76, 'Super Admin', '2025-11-07 18:09:04', '2025-11-07 18:09:04', NULL),
(14, 'Mayiladuthurai', 31, 76, 'Super Admin', '2025-11-07 18:09:04', '2025-11-07 18:09:04', NULL),
(15, 'Nagapattinam', 31, 76, 'Super Admin', '2025-11-07 18:09:04', '2025-11-07 18:09:04', NULL),
(16, 'Kanyakumari', 31, 76, 'Super Admin', '2025-11-07 18:09:04', '2025-11-07 18:09:04', NULL),
(17, 'Namakkal', 31, 76, 'Super Admin', '2025-11-07 18:09:04', '2025-11-07 18:09:04', NULL),
(18, 'Perambalur', 31, 76, 'Super Admin', '2025-11-07 18:09:04', '2025-11-07 18:09:04', NULL),
(19, 'Pudukottai', 31, 76, 'Super Admin', '2025-11-07 18:09:04', '2025-11-07 18:09:04', NULL),
(20, 'Ramanathapuram', 31, 76, 'Super Admin', '2025-11-07 18:09:04', '2025-11-07 18:09:04', NULL),
(21, 'Ranipet', 31, 76, 'Super Admin', '2025-11-07 18:09:04', '2025-11-07 18:09:04', NULL),
(22, 'Salem', 31, 76, 'Super Admin', '2025-11-07 18:09:04', '2025-11-07 18:09:04', NULL),
(23, 'Sivaganga', 31, 76, 'Super Admin', '2025-11-07 18:09:04', '2025-11-07 18:09:04', NULL),
(24, 'Tenkasi', 31, 76, 'Super Admin', '2025-11-07 18:09:04', '2025-11-07 18:09:04', NULL),
(25, 'Thanjavur', 31, 76, 'Super Admin', '2025-11-07 18:09:04', '2025-11-07 18:09:04', NULL),
(26, 'Theni', 31, 76, 'Super Admin', '2025-11-07 18:09:04', '2025-11-07 18:09:04', NULL),
(27, 'Tiruvallur', 31, 76, 'Super Admin', '2025-11-07 18:09:04', '2025-11-07 18:09:04', NULL),
(28, 'Thiruvarur', 31, 76, 'Super Admin', '2025-11-07 18:09:04', '2025-11-07 18:09:04', NULL),
(29, 'Thoothukudi', 31, 76, 'Super Admin', '2025-11-07 18:09:04', '2025-11-07 18:09:04', NULL),
(30, 'Tiruchirappalli', 31, 76, 'Super Admin', '2025-11-07 18:09:04', '2025-11-07 18:09:04', NULL),
(31, 'Tirunelveli', 31, 76, 'Super Admin', '2025-11-07 18:09:04', '2025-11-07 18:09:04', NULL),
(32, 'Tirupathur', 31, 76, 'Super Admin', '2025-11-07 18:09:04', '2025-11-07 18:09:04', NULL),
(33, 'Tiruppur', 31, 76, 'Super Admin', '2025-11-07 18:09:04', '2025-11-07 18:09:04', NULL),
(34, 'Tiruvannamalai', 31, 76, 'Super Admin', '2025-11-07 18:09:04', '2025-11-07 18:09:04', NULL),
(35, 'The Nilgiris', 31, 76, 'Super Admin', '2025-11-07 18:09:04', '2025-11-07 18:09:04', NULL),
(36, 'Vellore', 31, 76, 'Super Admin', '2025-11-07 18:09:04', '2025-11-07 18:09:04', NULL),
(37, 'Viluppuram', 31, 76, 'Super Admin', '2025-11-07 18:09:04', '2025-11-07 18:09:04', NULL),
(38, 'Virudhunagar', 31, 76, 'Super Admin', '2025-11-07 18:09:04', '2025-11-07 18:09:04', NULL),
(39, 'Bagalkote', 16, 76, 'Super Admin', '2025-11-07 18:38:16', '2025-11-07 18:38:16', NULL),
(40, 'Ballari', 16, 76, 'Super Admin', '2025-11-07 18:38:16', '2025-11-07 18:38:16', NULL),
(41, 'Belagavi', 16, 76, 'Super Admin', '2025-11-07 18:38:16', '2025-11-07 18:38:16', NULL),
(42, 'Bengaluru Rural', 16, 76, 'Super Admin', '2025-11-07 18:38:16', '2025-11-07 18:38:16', NULL),
(43, 'Bengaluru Urban', 16, 76, 'Super Admin', '2025-11-07 18:38:16', '2025-11-07 18:38:16', NULL),
(44, 'Bidar', 16, 76, 'Super Admin', '2025-11-07 18:38:16', '2025-11-07 18:38:16', NULL),
(45, 'Vijayapura', 16, 76, 'Super Admin', '2025-11-07 18:38:16', '2025-11-07 18:38:16', NULL),
(46, 'Chamarajanagar', 16, 76, 'Super Admin', '2025-11-07 18:38:16', '2025-11-07 18:38:16', NULL),
(47, 'Chikkaballapura', 16, 76, 'Super Admin', '2025-11-07 18:38:16', '2025-11-07 18:38:16', NULL),
(48, 'Chikkamagaluru', 16, 76, 'Super Admin', '2025-11-07 18:38:16', '2025-11-07 18:38:16', NULL),
(49, 'Chitradurga', 16, 76, 'Super Admin', '2025-11-07 18:38:16', '2025-11-07 18:38:16', NULL),
(50, 'Dakshina Kannada', 16, 76, 'Super Admin', '2025-11-07 18:38:16', '2025-11-07 18:38:16', NULL),
(51, 'Davanagere', 16, 76, 'Super Admin', '2025-11-07 18:38:16', '2025-11-07 18:38:16', NULL),
(52, 'Dharwad', 16, 76, 'Super Admin', '2025-11-07 18:38:16', '2025-11-07 18:38:16', NULL),
(53, 'Gadag', 16, 76, 'Super Admin', '2025-11-07 18:38:16', '2025-11-07 18:38:16', NULL),
(54, 'Hassan', 16, 76, 'Super Admin', '2025-11-07 18:38:16', '2025-11-07 18:38:16', NULL),
(55, 'Haveri', 16, 76, 'Super Admin', '2025-11-07 18:38:16', '2025-11-07 18:38:16', NULL),
(56, 'Kalaburagi', 16, 76, 'Super Admin', '2025-11-07 18:38:16', '2025-11-07 18:38:16', NULL),
(57, 'Kodagu', 16, 76, 'Super Admin', '2025-11-07 18:38:16', '2025-11-07 18:38:16', NULL),
(58, 'Kolar', 16, 76, 'Super Admin', '2025-11-07 18:38:16', '2025-11-07 18:38:16', NULL),
(59, 'Koppal', 16, 76, 'Super Admin', '2025-11-07 18:38:16', '2025-11-07 18:38:16', NULL),
(60, 'Mandya', 16, 76, 'Super Admin', '2025-11-07 18:38:16', '2025-11-07 18:38:16', NULL),
(61, 'Mysuru', 16, 76, 'Super Admin', '2025-11-07 18:38:16', '2025-11-07 18:38:16', NULL),
(62, 'Raichur', 16, 76, 'Super Admin', '2025-11-07 18:38:16', '2025-11-07 18:38:16', NULL),
(63, 'Ramanagara', 16, 76, 'Super Admin', '2025-11-07 18:38:16', '2025-11-07 18:38:16', NULL),
(64, 'Shivamogga', 16, 76, 'Super Admin', '2025-11-07 18:38:16', '2025-11-07 18:38:16', NULL),
(65, 'Tumakuru', 16, 76, 'Super Admin', '2025-11-07 18:38:16', '2025-11-07 18:38:16', NULL),
(66, 'Udupi', 16, 76, 'Super Admin', '2025-11-07 18:38:16', '2025-11-07 18:38:16', NULL),
(67, 'Uttara Kannada', 16, 76, 'Super Admin', '2025-11-07 18:38:16', '2025-11-07 18:38:16', NULL),
(68, 'Vijayanagara', 16, 76, 'Super Admin', '2025-11-07 18:38:16', '2025-11-07 18:38:16', NULL),
(69, 'Yadgir', 16, 76, 'Super Admin', '2025-11-07 18:38:16', '2025-11-07 18:38:16', NULL),
(70, 'Alappuzha', 17, 76, 'Super Admin', '2025-11-07 18:39:43', '2025-11-07 18:39:43', NULL),
(71, 'Ernakulam', 17, 76, 'Super Admin', '2025-11-07 18:39:43', '2025-11-07 18:39:43', NULL),
(72, 'Idukki', 17, 76, 'Super Admin', '2025-11-07 18:39:43', '2025-11-07 18:39:43', NULL),
(73, 'Kannur', 17, 76, 'Super Admin', '2025-11-07 18:39:43', '2025-11-07 18:39:43', NULL),
(74, 'Kasaragod', 17, 76, 'Super Admin', '2025-11-07 18:39:43', '2025-11-07 18:39:43', NULL),
(75, 'Kollam', 17, 76, 'Super Admin', '2025-11-07 18:39:43', '2025-11-07 18:39:43', NULL),
(76, 'Kottayam', 17, 76, 'Super Admin', '2025-11-07 18:39:43', '2025-11-07 18:39:43', NULL),
(77, 'Kozhikode', 17, 76, 'Super Admin', '2025-11-07 18:39:43', '2025-11-07 18:39:43', NULL),
(78, 'Malappuram', 17, 76, 'Super Admin', '2025-11-07 18:39:43', '2025-11-07 18:39:43', NULL),
(79, 'Palakkad', 17, 76, 'Super Admin', '2025-11-07 18:39:43', '2025-11-07 18:39:43', NULL),
(80, 'Pathanamthitta', 17, 76, 'Super Admin', '2025-11-07 18:39:43', '2025-11-07 18:39:43', NULL),
(81, 'Thiruvananthapuram', 17, 76, 'Super Admin', '2025-11-07 18:39:43', '2025-11-07 18:39:43', NULL),
(82, 'Thrissur', 17, 76, 'Super Admin', '2025-11-07 18:39:43', '2025-11-07 18:39:43', NULL),
(83, 'Wayanad', 17, 76, 'Super Admin', '2025-11-07 18:39:43', '2025-11-07 18:39:43', NULL),
(84, 'Anantapur', 2, 76, 'Super Admin', '2025-11-07 18:40:47', '2025-11-07 18:40:47', NULL),
(85, 'Chittoor', 2, 76, 'Super Admin', '2025-11-07 18:40:47', '2025-11-07 18:40:47', NULL),
(86, 'East Godavari', 2, 76, 'Super Admin', '2025-11-07 18:40:47', '2025-11-07 18:40:47', NULL),
(87, 'Guntur', 2, 76, 'Super Admin', '2025-11-07 18:40:47', '2025-11-07 18:40:47', NULL),
(88, 'Krishna', 2, 76, 'Super Admin', '2025-11-07 18:40:47', '2025-11-07 18:40:47', NULL),
(89, 'Kurnool', 2, 76, 'Super Admin', '2025-11-07 18:40:47', '2025-11-07 18:40:47', NULL),
(90, 'Prakasam', 2, 76, 'Super Admin', '2025-11-07 18:40:47', '2025-11-07 18:40:47', NULL),
(91, 'Srikakulam', 2, 76, 'Super Admin', '2025-11-07 18:40:47', '2025-11-07 18:40:47', NULL),
(92, 'Nellore', 2, 76, 'Super Admin', '2025-11-07 18:40:47', '2025-11-07 18:40:47', NULL),
(93, 'Visakhapatnam', 2, 76, 'Super Admin', '2025-11-07 18:40:47', '2025-11-07 18:40:47', NULL),
(94, 'Vizianagaram', 2, 76, 'Super Admin', '2025-11-07 18:40:47', '2025-11-07 18:40:47', NULL),
(95, 'West Godavari', 2, 76, 'Super Admin', '2025-11-07 18:40:47', '2025-11-07 18:40:47', NULL),
(96, 'YSR Kadapa', 2, 76, 'Super Admin', '2025-11-07 18:40:47', '2025-11-07 18:40:47', NULL),
(97, 'Adilabad', 32, 76, 'Super Admin', '2025-11-07 18:41:43', '2025-11-07 18:41:43', NULL),
(98, 'Bhadradri Kothagudem', 32, 76, 'Super Admin', '2025-11-07 18:41:43', '2025-11-07 18:41:43', NULL),
(99, 'Hanamkonda', 32, 76, 'Super Admin', '2025-11-07 18:41:43', '2025-11-07 18:41:43', NULL),
(100, 'Hyderabad', 32, 76, 'Super Admin', '2025-11-07 18:41:43', '2025-11-07 18:41:43', NULL),
(101, 'Jagtial', 32, 76, 'Super Admin', '2025-11-07 18:41:43', '2025-11-07 18:41:43', NULL),
(102, 'Jangaon', 32, 76, 'Super Admin', '2025-11-07 18:41:43', '2025-11-07 18:41:43', NULL),
(103, 'Jayashankar Bhupalpally', 32, 76, 'Super Admin', '2025-11-07 18:41:43', '2025-11-07 18:41:43', NULL),
(104, 'Jogulamba Gadwal', 32, 76, 'Super Admin', '2025-11-07 18:41:43', '2025-11-07 18:41:43', NULL),
(105, 'Kamareddy', 32, 76, 'Super Admin', '2025-11-07 18:41:43', '2025-11-07 18:41:43', NULL),
(106, 'Karimnagar', 32, 76, 'Super Admin', '2025-11-07 18:41:43', '2025-11-07 18:41:43', NULL),
(107, 'Khammam', 32, 76, 'Super Admin', '2025-11-07 18:41:43', '2025-11-07 18:41:43', NULL),
(108, 'Komaram Bheem Asifabad', 32, 76, 'Super Admin', '2025-11-07 18:41:43', '2025-11-07 18:41:43', NULL),
(109, 'Mahabubabad', 32, 76, 'Super Admin', '2025-11-07 18:41:43', '2025-11-07 18:41:43', NULL),
(110, 'Mahabubnagar', 32, 76, 'Super Admin', '2025-11-07 18:41:43', '2025-11-07 18:41:43', NULL),
(111, 'Mancherial', 32, 76, 'Super Admin', '2025-11-07 18:41:43', '2025-11-07 18:41:43', NULL),
(112, 'Medak', 32, 76, 'Super Admin', '2025-11-07 18:41:43', '2025-11-07 18:41:43', NULL),
(113, 'Medchal–Malkajgiri', 32, 76, 'Super Admin', '2025-11-07 18:41:43', '2025-11-07 18:41:43', NULL),
(114, 'Mulugu', 32, 76, 'Super Admin', '2025-11-07 18:41:43', '2025-11-07 18:41:43', NULL),
(115, 'Nagarkurnool', 32, 76, 'Super Admin', '2025-11-07 18:41:43', '2025-11-07 18:41:43', NULL),
(116, 'Nalgonda', 32, 76, 'Super Admin', '2025-11-07 18:41:43', '2025-11-07 18:41:43', NULL),
(117, 'Narayanpet', 32, 76, 'Super Admin', '2025-11-07 18:41:43', '2025-11-07 18:41:43', NULL),
(118, 'Nirmal', 32, 76, 'Super Admin', '2025-11-07 18:41:43', '2025-11-07 18:41:43', NULL),
(119, 'Nizamabad', 32, 76, 'Super Admin', '2025-11-07 18:41:43', '2025-11-07 18:41:43', NULL),
(120, 'Peddapalli', 32, 76, 'Super Admin', '2025-11-07 18:41:43', '2025-11-07 18:41:43', NULL),
(121, 'Rajanna Sircilla', 32, 76, 'Super Admin', '2025-11-07 18:41:43', '2025-11-07 18:41:43', NULL),
(122, 'Ranga Reddy', 32, 76, 'Super Admin', '2025-11-07 18:41:43', '2025-11-07 18:41:43', NULL),
(123, 'Sangareddy', 32, 76, 'Super Admin', '2025-11-07 18:41:43', '2025-11-07 18:41:43', NULL),
(124, 'Siddipet', 32, 76, 'Super Admin', '2025-11-07 18:41:43', '2025-11-07 18:41:43', NULL),
(125, 'Suryapet', 32, 76, 'Super Admin', '2025-11-07 18:41:43', '2025-11-07 18:41:43', NULL),
(126, 'Vikarabad', 32, 76, 'Super Admin', '2025-11-07 18:41:43', '2025-11-07 18:41:43', NULL),
(127, 'Wanaparthy', 32, 76, 'Super Admin', '2025-11-07 18:41:43', '2025-11-07 18:41:43', NULL),
(128, 'Warangal', 32, 76, 'Super Admin', '2025-11-07 18:41:43', '2025-11-07 18:41:43', NULL),
(129, 'Yadadri Bhuvanagiri', 32, 76, 'Super Admin', '2025-11-07 18:41:43', '2025-11-08 04:56:28', NULL),
(130, 'test', 1, 76, 'Super Admin', '2025-11-08 05:03:42', '2025-11-08 05:04:16', '2025-11-08 05:04:16');

-- --------------------------------------------------------

--
-- Table structure for table `employee_list`
--

DROP TABLE IF EXISTS `employee_list`;
CREATE TABLE IF NOT EXISTS `employee_list` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `role_id` int NOT NULL,
  `employee_id` varchar(195) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `designation_id` int DEFAULT NULL,
  `worktype_id` int DEFAULT NULL,
  `employee_status` varchar(195) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `relievng_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `employee_list`
--

INSERT INTO `employee_list` (`id`, `user_id`, `role_id`, `employee_id`, `designation_id`, `worktype_id`, `employee_status`, `joining_date`, `relievng_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 10, 3, 'ABC01', 2, 1, 'Active', NULL, NULL, '2025-11-07 09:02:01', '2025-11-07 09:36:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employee_salary_details`
--

DROP TABLE IF EXISTS `employee_salary_details`;
CREATE TABLE IF NOT EXISTS `employee_salary_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `basic_pay` int DEFAULT NULL,
  `hra` int DEFAULT NULL,
  `other_allowance` int DEFAULT NULL,
  `gross_salary` int DEFAULT NULL,
  `pf_deduction` int DEFAULT NULL,
  `esi_deduction` int DEFAULT NULL,
  `tds_deduction` int DEFAULT NULL,
  `remarks` varchar(195) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2025_10_29_150534_create_role_user_table', 1),
(3, '2025_10_29_150922_create_permission_role_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(195) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'authentication_access', '2025-10-30 13:18:45', '2025-10-30 13:18:45'),
(2, 'permission_access', '2025-10-31 09:53:24', '2025-10-31 09:53:24'),
(3, 'permission_create', '2025-10-31 10:03:42', '2025-10-31 10:03:42'),
(4, 'permission_view', '2025-10-31 10:03:42', '2025-10-31 10:03:42'),
(5, 'permission_edit', '2025-10-31 10:03:42', '2025-10-31 10:03:42'),
(6, 'permission_delete', '2025-10-31 17:52:28', '2025-10-31 17:52:28'),
(7, 'role_access', '2025-10-31 17:57:50', '2025-10-31 17:57:50'),
(8, 'role_create', '2025-10-31 17:57:50', '2025-10-31 17:57:50'),
(9, 'role_edit', '2025-10-31 17:57:50', '2025-10-31 17:57:50'),
(10, 'role_delete', '2025-10-31 17:57:50', '2025-10-31 17:57:50'),
(11, 'user_access', '2025-10-31 17:57:50', '2025-10-31 17:57:50'),
(12, 'user_create', '2025-10-31 18:15:28', '2025-10-31 18:15:28'),
(13, 'user_show', '2025-10-31 18:15:28', '2025-10-31 18:15:28'),
(14, 'user_edit', '2025-10-31 18:15:28', '2025-10-31 18:15:28'),
(15, 'user_delete', '2025-10-31 18:15:28', '2025-10-31 18:15:28'),
(16, 'master_tool_access', '2025-11-01 10:32:59', '2025-11-01 10:32:59'),
(17, 'project_access', '2025-11-01 10:32:59', '2025-11-01 10:32:59'),
(18, 'project_create', '2025-11-01 10:32:59', '2025-11-01 10:32:59'),
(19, 'project_view', '2025-11-01 15:06:15', '2025-11-01 15:06:15'),
(20, 'project_edit', '2025-11-01 15:06:15', '2025-11-01 15:06:15'),
(21, 'project_delete', '2025-11-01 15:06:15', '2025-11-01 15:06:15'),
(22, 'designation_access', '2025-11-01 09:42:08', '2025-11-01 09:42:08'),
(23, 'designation_create', '2025-11-04 06:21:43', '2025-11-04 06:21:43'),
(24, 'designation_view', '2025-11-04 12:59:41', '2025-11-04 12:59:41'),
(25, 'designation_edit', '2025-11-04 12:59:41', '2025-11-04 12:59:41'),
(26, 'designation_delete', '2025-11-04 12:59:41', '2025-11-04 12:59:41'),
(27, 'worktype_access', '2025-11-04 09:25:34', '2025-11-04 09:28:36'),
(28, 'worktype_create', '2025-11-04 09:50:49', '2025-11-04 09:50:49'),
(29, 'worktype_view', '2025-11-04 09:50:58', '2025-11-04 09:50:58'),
(30, 'worktype_edit', '2025-11-04 09:51:06', '2025-11-04 09:51:06'),
(31, 'worktype_delete', '2025-11-04 09:51:14', '2025-11-04 09:51:14'),
(32, 'state_access', '2025-11-04 14:01:06', '2025-11-04 14:01:06'),
(33, 'state_create', '2025-11-04 14:01:29', '2025-11-04 14:01:29'),
(34, 'state_view', '2025-11-04 14:01:40', '2025-11-04 14:01:40'),
(35, 'state_edit', '2025-11-04 14:01:49', '2025-11-04 14:01:49'),
(36, 'state_delete', '2025-11-04 14:02:05', '2025-11-04 14:02:05'),
(37, 'bloodgroup_access', '2025-11-05 06:59:36', '2025-11-05 06:59:36'),
(38, 'bloodgroup_create', '2025-11-05 06:59:36', '2025-11-05 06:59:36'),
(39, 'bloodgroup_view', '2025-11-05 06:59:36', '2025-11-05 06:59:36'),
(40, 'bloodgroup_edit', '2025-11-05 06:59:36', '2025-11-05 06:59:36'),
(41, 'bloodgroup_delete', '2025-11-05 06:59:36', '2025-11-05 06:59:36'),
(42, 'country_access', '2025-11-05 09:25:44', '2025-11-05 09:25:44'),
(43, 'country_create', '2025-11-05 09:25:44', '2025-11-05 09:25:44'),
(44, 'country_view', '2025-11-05 09:25:44', '2025-11-05 09:25:44'),
(45, 'country_edit', '2025-11-05 09:25:44', '2025-11-05 09:25:44'),
(46, 'country_delete', '2025-11-05 09:25:44', '2025-11-05 09:25:44'),
(47, 'user_change_password_access', '2025-11-06 08:57:55', '2025-11-07 10:38:14'),
(48, 'employee_access', '2025-11-06 09:27:47', '2025-11-06 09:27:47'),
(49, 'employee_create', '2025-11-07 17:50:30', '2025-11-07 17:50:30'),
(50, 'employee_view', '2025-11-07 17:50:30', '2025-11-07 17:50:30'),
(51, 'employee_edit', '2025-11-07 17:50:30', '2025-11-07 17:50:30'),
(52, 'employee_delete', '2025-11-07 17:50:30', '2025-11-07 17:50:30'),
(53, 'district_access', '2025-11-07 17:50:30', '2025-11-07 17:50:30'),
(54, 'district_create', '2025-11-07 17:50:30', '2025-11-07 17:50:30'),
(55, 'district_view', '2025-11-07 17:50:30', '2025-11-07 17:50:30'),
(56, 'district_edit', '2025-11-07 17:50:30', '2025-11-07 17:50:30'),
(57, 'district_delete', '2025-11-07 17:50:30', '2025-11-07 17:50:30'),
(58, 'change_employee_password', '2025-11-11 00:14:16', '2025-11-11 00:14:16');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE IF NOT EXISTS `permission_role` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_role_permission_id_foreign` (`permission_id`),
  KEY `permission_role_role_id_foreign` (`role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(43, 4, 1),
(44, 5, 1),
(6, 7, 1),
(7, 8, 1),
(8, 9, 1),
(9, 10, 1),
(10, 11, 1),
(45, 6, 1),
(12, 13, 1),
(13, 14, 1),
(14, 15, 1),
(15, 16, 1),
(16, 17, 1),
(17, 18, 1),
(18, 19, 1),
(19, 20, 1),
(20, 21, 1),
(21, 22, 1),
(22, 23, 1),
(23, 24, 1),
(24, 25, 1),
(25, 26, 1),
(26, 27, 1),
(27, 12, 1),
(28, 28, 1),
(29, 29, 1),
(30, 30, 1),
(31, 31, 1),
(32, 32, 1),
(33, 33, 1),
(42, 34, 1),
(41, 36, 1),
(40, 35, 1),
(46, 37, 1),
(47, 38, 1),
(48, 39, 1),
(49, 40, 1),
(50, 41, 1),
(51, 42, 1),
(52, 43, 1),
(53, 44, 1),
(54, 45, 1),
(55, 46, 1),
(56, 47, 1),
(57, 48, 1),
(58, 49, 1),
(66, 51, 1),
(65, 50, 1),
(71, 52, 1),
(63, 53, 1),
(67, 54, 1),
(68, 55, 1),
(69, 56, 1),
(70, 57, 1),
(72, 58, 1);

-- --------------------------------------------------------

--
-- Table structure for table `personal_details`
--

DROP TABLE IF EXISTS `personal_details`;
CREATE TABLE IF NOT EXISTS `personal_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `role_id` int NOT NULL,
  `name` varchar(195) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(195) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `gender` varchar(195) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `mobile_number` bigint DEFAULT NULL,
  `image` varchar(195) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `alternate_number` bigint DEFAULT NULL,
  `whatsapp_number` bigint DEFAULT NULL,
  `marital_status` varchar(195) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `bloodgroup_id` int DEFAULT NULL,
  `address` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `city_village` varchar(195) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `district_id` int DEFAULT NULL,
  `state_id` int DEFAULT NULL,
  `country_id` int DEFAULT NULL,
  `pincode` int DEFAULT NULL,
  `aadhar_number` varchar(195) DEFAULT NULL,
  `pan_number` varchar(195) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `driving_license` varchar(195) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `emergency_contact_name` varchar(195) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `emergency_contact_relationship` varchar(195) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `emergency_contact_number` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `personal_details`
--

INSERT INTO `personal_details` (`id`, `user_id`, `role_id`, `name`, `email`, `gender`, `mobile_number`, `image`, `date_of_birth`, `alternate_number`, `whatsapp_number`, `marital_status`, `bloodgroup_id`, `address`, `city_village`, `district_id`, `state_id`, `country_id`, `pincode`, `aadhar_number`, `pan_number`, `driving_license`, `emergency_contact_name`, `emergency_contact_relationship`, `emergency_contact_number`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 10, 3, 'Lenin A', 'lenin@gmail.com', 'Male', 9876543210, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-07 09:02:01', '2025-11-07 09:45:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
CREATE TABLE IF NOT EXISTS `projects` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(195) NOT NULL,
  `created_by` varchar(195) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Project-1\r\n', 'Super Admin', '2025-11-01 15:03:31', '2025-11-01 15:03:31', NULL),
(2, 'Project-2', 'Super Admin', '2025-11-01 09:52:07', '2025-11-01 09:52:07', NULL),
(3, 'Project-3', 'Super Admin', '2025-11-01 09:53:50', '2025-11-01 10:15:08', NULL),
(4, 'Project-4', 'Super Admin', '2025-11-01 09:56:43', '2025-11-01 10:15:03', NULL),
(5, 'Project-5', 'Super Admin', '2025-11-03 11:19:01', '2025-11-03 11:19:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(195) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2025-11-04 15:05:45', '2025-11-04 15:05:45'),
(2, 'Hr', '2025-10-30 13:20:23', '2025-10-31 13:13:26'),
(3, 'Employee', '2025-10-30 13:20:32', '2025-10-30 13:20:32');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
CREATE TABLE IF NOT EXISTS `role_user` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_user_user_id_foreign` (`user_id`),
  KEY `role_user_role_id_foreign` (`role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2025-10-30 19:01:35', '2025-10-30 19:01:35'),
(2, 2, 3, NULL, NULL),
(3, 3, 3, NULL, NULL),
(4, 4, 3, NULL, NULL),
(5, 5, 3, NULL, NULL),
(6, 6, 3, NULL, NULL),
(7, 7, 3, NULL, NULL),
(8, 8, 3, NULL, NULL),
(9, 9, 3, NULL, NULL),
(10, 10, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

DROP TABLE IF EXISTS `states`;
CREATE TABLE IF NOT EXISTS `states` (
  `id` int NOT NULL AUTO_INCREMENT,
  `state` varchar(195) NOT NULL,
  `country_id` int NOT NULL,
  `created_by` varchar(195) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `state`, `country_id`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Andaman and Nicobar Islands', 76, 'Super Admin', '2025-11-04 14:18:55', '2025-11-04 14:22:21', NULL),
(2, 'Andhra Pradesh', 76, 'Super Admin', '2025-11-04 14:22:33', '2025-11-04 14:22:33', NULL),
(3, 'Arunachal Pradesh', 76, 'Super Admin', '2025-11-04 14:22:40', '2025-11-04 14:22:40', NULL),
(4, 'Assam', 76, 'Super Admin', '2025-11-04 14:22:46', '2025-11-04 14:22:46', NULL),
(5, 'Bihar', 76, 'Super Admin', '2025-11-04 14:22:53', '2025-11-04 14:22:53', NULL),
(6, 'Chandigarh', 76, 'Super Admin', '2025-11-04 14:23:00', '2025-11-04 14:23:00', NULL),
(7, 'Chhattisgarh', 76, 'Super Admin', '2025-11-04 14:23:08', '2025-11-04 14:23:08', NULL),
(8, 'Daman and Diu', 76, 'Super Admin', '2025-11-04 14:23:16', '2025-11-04 14:23:31', NULL),
(9, 'Delhi', 76, 'Super Admin', '2025-11-04 14:23:43', '2025-11-04 14:23:43', NULL),
(10, 'Goa', 76, 'Super Admin', '2025-11-04 14:23:49', '2025-11-04 14:23:49', NULL),
(11, 'Gujarat', 76, 'Super Admin', '2025-11-04 14:23:54', '2025-11-04 14:23:54', NULL),
(12, 'Haryana', 76, 'Super Admin', '2025-11-04 14:24:07', '2025-11-04 14:24:07', NULL),
(13, 'Himachal Pradesh', 76, 'Super Admin', '2025-11-04 14:24:15', '2025-11-04 14:24:15', NULL),
(14, 'Jammu and Kashmir', 76, 'Super Admin', '2025-11-04 14:24:23', '2025-11-04 14:24:23', NULL),
(15, 'Jharkhand', 76, 'Super Admin', '2025-11-04 14:24:30', '2025-11-04 14:24:30', NULL),
(16, 'Karnataka', 76, 'Super Admin', '2025-11-04 14:24:33', '2025-11-04 14:24:48', NULL),
(17, 'Kerala', 76, 'Super Admin', '2025-11-04 14:25:04', '2025-11-04 14:25:04', NULL),
(18, 'Ladakh', 76, 'Super Admin', '2025-11-04 14:25:09', '2025-11-04 14:25:09', NULL),
(19, 'Lakshadweep', 76, 'Super Admin', '2025-11-04 14:25:15', '2025-11-04 14:25:15', NULL),
(20, 'Madhya Pradesh', 76, 'Super Admin', '2025-11-04 14:25:22', '2025-11-04 14:25:22', NULL),
(21, 'Maharashtra', 76, 'Super Admin', '2025-11-04 14:25:28', '2025-11-04 14:25:28', NULL),
(22, 'Manipur', 76, 'Super Admin', '2025-11-04 14:25:34', '2025-11-04 14:25:34', NULL),
(23, 'Meghalaya', 76, 'Super Admin', '2025-11-04 14:25:44', '2025-11-04 14:25:44', NULL),
(24, 'Mizoram', 76, 'Super Admin', '2025-11-04 14:25:54', '2025-11-04 14:25:54', NULL),
(25, 'Nagaland', 76, 'Super Admin', '2025-11-04 14:26:03', '2025-11-04 14:26:03', NULL),
(26, 'Odisha', 76, 'Super Admin', '2025-11-04 14:26:10', '2025-11-04 14:26:10', NULL),
(27, 'Puducherry', 76, 'Super Admin', '2025-11-04 14:26:19', '2025-11-04 14:26:19', NULL),
(28, 'Punjab', 76, 'Super Admin', '2025-11-04 14:26:25', '2025-11-04 14:26:25', NULL),
(29, 'Rajasthan', 76, 'Super Admin', '2025-11-04 14:26:35', '2025-11-04 14:26:35', NULL),
(30, 'Sikkim', 76, 'Super Admin', '2025-11-04 14:26:42', '2025-11-04 14:26:42', NULL),
(31, 'Tamil Nadu', 76, 'Super Admin', '2025-11-04 14:26:48', '2025-11-04 14:26:48', NULL),
(32, 'Telangana', 76, 'Super Admin', '2025-11-04 14:26:57', '2025-11-04 14:26:57', NULL),
(33, 'Tripura', 76, 'Super Admin', '2025-11-04 14:27:06', '2025-11-04 14:27:06', NULL),
(34, 'Uttar Pradesh', 76, 'Super Admin', '2025-11-04 14:27:16', '2025-11-04 14:27:16', NULL),
(35, 'Uttarakhand', 76, 'Super Admin', '2025-11-04 14:27:27', '2025-11-05 11:27:11', NULL),
(36, 'West Bengal', 76, 'Super Admin', '2025-11-04 14:27:35', '2025-11-05 12:08:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'superadmin@gmail.com', NULL, '$2y$12$JG7c6ra7PZ0cEx33NcNAfeb5tI1gb5bqarKd1UB5arSp1sFk1r5km', NULL, '2025-10-29 05:32:33', '2025-11-07 10:44:22'),
(10, 'Lenin', 'lenin@gmail.com', NULL, '$2y$12$GyWxrLLbdT4fsOmsoTcGWOFPc59rNo7CjlFq3uhry860/enjad2Fe', NULL, '2025-11-07 09:02:01', '2025-11-11 00:14:54');

-- --------------------------------------------------------

--
-- Table structure for table `worktypes`
--

DROP TABLE IF EXISTS `worktypes`;
CREATE TABLE IF NOT EXISTS `worktypes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `worktype` varchar(195) NOT NULL,
  `created_by` varchar(195) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `worktypes`
--

INSERT INTO `worktypes` (`id`, `worktype`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Regular', 'Super Admin', '2025-11-04 10:01:34', '2025-11-04 10:09:11', NULL),
(2, 'Work from Home', 'Super Admin', '2025-11-04 10:06:26', '2025-11-04 10:06:26', NULL),
(3, 'Hybrid', 'Super Admin', '2025-11-04 10:13:17', '2025-11-04 10:13:17', NULL),
(4, 'Client OD', 'Super Admin', '2025-11-04 10:13:26', '2025-11-04 10:13:26', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
