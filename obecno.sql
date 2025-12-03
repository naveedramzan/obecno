-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 03, 2025 at 06:52 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `obecno`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int NOT NULL,
  `session_id` int NOT NULL,
  `appointment_date` date NOT NULL,
  `slot_id` int NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `company_id` int NOT NULL,
  `category_id` int NOT NULL,
  `service_id` int NOT NULL,
  `user_id` int NOT NULL,
  `appointmentstatus_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `appointmentstatuses`
--

CREATE TABLE `appointmentstatuses` (
  `id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointmentstatuses`
--

INSERT INTO `appointmentstatuses` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`, `status`) VALUES
(1, 'Just Booked', '2024-11-28 18:05:15', NULL, NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `company_id` int DEFAULT NULL,
  `assettype_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`id`, `title`, `description`, `company_id`, `assettype_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Google Meet', NULL, 1, 1, '2024-12-21 12:27:23', NULL, NULL),
(2, 'Laptop', NULL, 1, 3, '2024-12-21 12:27:59', NULL, NULL),
(3, 'Room 121', NULL, 1, 6, '2024-12-21 12:28:10', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `assets_sessions`
--

CREATE TABLE `assets_sessions` (
  `id` int NOT NULL,
  `asset_id` int NOT NULL,
  `session_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assettypes`
--

CREATE TABLE `assettypes` (
  `id` int NOT NULL,
  `title` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `assettypes`
--

INSERT INTO `assettypes` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`, `status`) VALUES
(1, 'Tools', '2024-12-21 10:37:03', NULL, NULL, '1'),
(2, 'Equipment', '2024-12-21 10:37:11', NULL, NULL, '1'),
(3, 'Machinery', '2024-12-21 10:37:18', NULL, NULL, '1'),
(4, 'IT Hardware', '2024-12-21 10:37:25', NULL, NULL, '1'),
(5, 'IT Software', '2024-12-21 10:37:33', NULL, NULL, '1'),
(6, 'Rooms', '2024-12-21 12:08:42', NULL, NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `attendance_date` date NOT NULL,
  `checkin` time NOT NULL,
  `breakout` time DEFAULT NULL,
  `breakin` time DEFAULT NULL,
  `checkout` time DEFAULT NULL,
  `location_id` int DEFAULT NULL,
  `expected_hours` int DEFAULT NULL,
  `hours_worked` time DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `status` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `user_id`, `attendance_date`, `checkin`, `breakout`, `breakin`, `checkout`, `location_id`, `expected_hours`, `hours_worked`, `created_at`, `updated_at`, `deleted_at`, `status`) VALUES
(2, 4, '2025-11-24', '00:20:25', NULL, NULL, '15:42:00', 0, 8, '00:00:05', '2025-11-24 05:18:00', '2025-11-24 10:42:56', NULL, ''),
(3, 10, '2025-11-24', '00:20:25', NULL, NULL, '18:30:00', 0, 8, '00:00:05', '2025-11-24 08:20:00', '2025-11-24 13:31:23', NULL, ''),
(4, 10, '2025-11-26', '08:52:41', NULL, NULL, NULL, 0, 8, '00:00:00', '2025-11-26 03:52:41', '2025-11-26 03:52:41', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `slug` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `parent_id` int NOT NULL,
  `photo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `description`, `slug`, `parent_id`, `photo`, `created_at`, `updated_at`, `deleted_at`, `status`) VALUES
(1, 'Consultancy', 'Consultants provide strategic advice to organizations by applying their in-depth industry expertise. They meet with company stakeholders to assist with both short-term and long-term projects, during which they offer a fresh perspective and guidance.', 'consultancy', 0, 'consultancy.jpg', '2024-10-07 11:07:45', '2024-12-02 13:50:49', NULL, '1'),
(2, 'Travel & Transportation', NULL, 'traveling', 0, NULL, '2024-10-16 21:20:51', '2024-12-02 12:19:25', NULL, '1'),
(3, 'Real Estate', NULL, 'realestate', 0, NULL, '2024-10-16 21:20:51', '2024-12-02 12:19:19', NULL, '1'),
(4, 'Personal Care & Services', NULL, 'personalcare', 0, NULL, '2024-10-16 21:20:51', '2024-12-02 12:19:38', NULL, '1'),
(5, 'Miscellaneous', NULL, 'miscellaneous', 0, NULL, '2024-10-16 21:20:51', '2024-12-02 12:16:33', NULL, '1'),
(6, 'Merchants (Retail)', NULL, 'merchants', 0, NULL, '2024-10-16 21:20:51', '2024-12-02 12:16:28', NULL, '1'),
(7, 'Manufacturing, Wholesale, Distribution', NULL, 'manufacturing', 0, NULL, '2024-10-16 21:20:51', '2024-12-02 12:16:23', NULL, '1'),
(8, 'Legal & Financial', NULL, 'legal-financials', 0, NULL, '2024-10-16 21:20:51', '2024-12-02 12:16:12', NULL, '1'),
(9, 'Gardening', NULL, 'gardening', 0, NULL, '2024-10-16 21:20:51', '2024-12-02 12:15:59', NULL, '1'),
(10, 'Healthcare', NULL, 'healthcare', 0, NULL, '2024-10-16 21:20:51', '2024-12-02 12:13:14', NULL, '1'),
(11, 'Food', NULL, 'food', 0, NULL, '2024-10-16 21:20:52', '2024-12-02 12:13:06', NULL, '1'),
(12, 'Entertainment', NULL, 'entertainment', 0, NULL, '2024-10-16 21:20:52', '2024-12-02 12:12:58', NULL, '1'),
(13, 'Education', NULL, 'education', 0, NULL, '2024-10-16 21:20:52', '2024-12-02 12:12:55', NULL, '1'),
(14, 'Constructions and Contractors', NULL, 'constructions', 0, NULL, '2024-10-16 21:20:52', '2024-12-02 12:21:14', NULL, '1'),
(15, 'Computer and Electronics', NULL, 'electonics', 0, NULL, '2024-10-16 21:20:52', '2024-12-02 12:21:03', NULL, '1'),
(16, 'Business Support & Supplies', NULL, 'business', 0, NULL, '2024-10-16 21:20:52', '2024-12-02 12:20:55', NULL, '1'),
(17, 'Automotive', NULL, 'automotive', 0, NULL, '2024-10-16 21:20:52', '2024-12-02 12:11:24', NULL, '1'),
(18, 'Human Development', 'Human development and human services is the study of the physical, mental and social-emotional development of individuals across the lifespan, and the application of this knowledge to improve the lives of individuals, families and communities.', 'humandevelopment', 0, 'human-development.jpg', '2024-11-14 19:19:41', '2024-12-02 14:03:28', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `categories_companies`
--

CREATE TABLE `categories_companies` (
  `id` int NOT NULL,
  `company_id` int NOT NULL,
  `category_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories_companies`
--

INSERT INTO `categories_companies` (`id`, `company_id`, `category_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 1, 18, '2024-11-14 19:20:01', NULL, NULL),
(3, 2, 18, '2024-12-03 11:58:27', NULL, NULL),
(4, 2, 1, '2024-12-03 12:10:39', NULL, NULL),
(5, 1, 1, '2024-12-05 08:41:57', NULL, NULL),
(8, 3, 18, '2024-12-05 16:50:31', '2024-12-05 16:50:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `country_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `title`, `country_id`, `created_at`, `updated_at`, `deleted_at`, `status`) VALUES
(1, 'Islamabad', 1, '2024-10-06 18:48:51', NULL, NULL, '1'),
(2, 'Newyork', 2, '2024-12-02 18:05:44', NULL, NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `cms`
--

CREATE TABLE `cms` (
  `id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `company_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `slug` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `website` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `expertise` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `team_size` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `photo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `Founded` char(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `title`, `slug`, `description`, `website`, `expertise`, `team_size`, `photo`, `Founded`, `created_at`, `updated_at`, `deleted_at`, `status`) VALUES
(1, 'obecno', 'obecno', 'Simplify Attendance - it\'s all about time and management', 'https://www.obecno.com', NULL, '2', '1763560587_obecno-icon.png', '2025', '2025-11-17 10:47:07', '2025-11-20 17:14:42', NULL, '1'),
(2, 'Ahmed Solutions', 'ahmed-solutions', 'Failed to create company. Please try again. Failed to create company.', 'https://www.ahmedsolutions.com', NULL, '4', '1763560627_AH-icon.png', '2020', '2025-11-19 10:32:02', '2025-11-20 17:15:11', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `companies_modules`
--

CREATE TABLE `companies_modules` (
  `id` int NOT NULL,
  `company_id` int NOT NULL,
  `module_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `companies_modules`
--

INSERT INTO `companies_modules` (`id`, `company_id`, `module_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 1, 12, '2025-11-24 08:42:14', '2025-11-24 08:42:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `companysettings`
--

CREATE TABLE `companysettings` (
  `id` int NOT NULL,
  `company_id` int NOT NULL,
  `check_in_time` time DEFAULT NULL,
  `check_out_time` time DEFAULT NULL,
  `grace_period` enum('no-grace','5-min','10-min','15-min','30-min') DEFAULT NULL,
  `working_days` json DEFAULT NULL,
  `break_time` int DEFAULT NULL,
  `calendar_country_id` int DEFAULT NULL,
  `year_start_date` date DEFAULT NULL,
  `casual_leaves` int DEFAULT NULL,
  `sick_leaves` int DEFAULT NULL,
  `emergency_leaves` int DEFAULT NULL,
  `maternity_leaves` int DEFAULT NULL,
  `paternity_leaves` int DEFAULT NULL,
  `bereavement_leave` int DEFAULT NULL,
  `compensation_leaves` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `companysettings`
--

INSERT INTO `companysettings` (`id`, `company_id`, `check_in_time`, `check_out_time`, `grace_period`, `working_days`, `break_time`, `calendar_country_id`, `year_start_date`, `casual_leaves`, `sick_leaves`, `emergency_leaves`, `maternity_leaves`, `paternity_leaves`, `bereavement_leave`, `compensation_leaves`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '10:00:00', '19:00:00', '15-min', '[\"mon\", \"tue\", \"wed\", \"thr\", \"fri\"]', 60, 1, '2025-01-01', 10, 10, 5, 45, 10, 5, NULL, '2025-11-24 08:42:14', '2025-11-24 08:42:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `code2` char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `title`, `code2`, `created_at`, `updated_at`, `deleted_at`, `status`) VALUES
(1, 'Pakistan', 'pk', '2024-10-06 14:25:30', '2024-10-20 13:28:28', NULL, '1'),
(2, 'United States of America', 'US', '2024-12-02 18:04:57', NULL, NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int NOT NULL,
  `title` varchar(100) NOT NULL,
  `code` varchar(10) NOT NULL,
  `symbol` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `title`, `code`, `symbol`, `created_at`, `updated_at`, `deleted_at`, `status`) VALUES
(1, 'US Dollar', 'USD', '$', '2025-09-25 11:38:14', NULL, NULL, 1),
(2, 'Euro', 'EUR', '€', '2025-09-25 11:38:14', NULL, NULL, 1),
(3, 'British Pound', 'GBP', '£', '2025-09-25 11:38:14', NULL, NULL, 1),
(4, 'Japanese Yen', 'JPY', '¥', '2025-09-25 11:38:14', NULL, NULL, 1),
(5, 'Pakistani Rupee', 'PKR', '₨', '2025-09-25 11:38:14', NULL, NULL, 1),
(6, 'Indian Rupee', 'INR', '₹', '2025-09-25 11:38:14', NULL, NULL, 1),
(7, 'Chinese Yuan', 'CNY', '¥', '2025-09-25 11:38:14', NULL, NULL, 1),
(8, 'Saudi Riyal', 'SAR', '﷼', '2025-09-25 11:38:14', NULL, NULL, 1),
(9, 'UAE Dirham', 'AED', 'د.إ', '2025-09-25 11:38:14', NULL, NULL, 1),
(10, 'Canadian Dollar', 'CAD', '$', '2025-09-25 11:38:14', NULL, NULL, 1),
(11, 'Australian Dollar', 'AUD', '$', '2025-09-25 11:38:14', NULL, NULL, 1),
(12, 'Swiss Franc', 'CHF', 'CHF', '2025-09-25 11:38:14', NULL, NULL, 1),
(13, 'Kuwaiti Dinar', 'KWD', 'د.ك', '2025-09-25 11:38:14', NULL, NULL, 1),
(14, 'Qatari Riyal', 'QAR', '﷼', '2025-09-25 11:38:14', NULL, NULL, 1),
(15, 'Bangladeshi Taka', 'BDT', '৳', '2025-09-25 11:38:14', NULL, NULL, 1),
(16, 'Sri Lankan Rupee', 'LKR', 'Rs', '2025-09-25 11:38:14', NULL, NULL, 1),
(17, 'South Korean Won', 'KRW', '₩', '2025-09-25 11:38:14', NULL, NULL, 1),
(18, 'Turkish Lira', 'TRY', '₺', '2025-09-25 11:38:14', NULL, NULL, 1),
(19, 'Russian Ruble', 'RUB', '₽', '2025-09-25 11:38:14', NULL, NULL, 1),
(20, 'South African Rand', 'ZAR', 'R', '2025-09-25 11:38:14', NULL, NULL, 1),
(21, 'Egyptian Pound', 'EGP', '£', '2025-09-25 11:38:14', NULL, NULL, 1),
(22, 'Malaysian Ringgit', 'MYR', 'RM', '2025-09-25 11:38:14', NULL, NULL, 1),
(23, 'Singapore Dollar', 'SGD', '$', '2025-09-25 11:38:14', NULL, NULL, 1),
(24, 'Hong Kong Dollar', 'HKD', '$', '2025-09-25 11:38:14', NULL, NULL, 1),
(25, 'New Zealand Dollar', 'NZD', '$', '2025-09-25 11:38:14', NULL, NULL, 1),
(26, 'Iranian Rial', 'IRR', '﷼', '2025-09-25 11:38:14', NULL, NULL, 1),
(27, 'Afghan Afghani', 'AFN', '؋', '2025-09-25 11:38:14', NULL, NULL, 1),
(28, 'Nepalese Rupee', 'NPR', '₨', '2025-09-25 11:38:14', NULL, NULL, 1),
(29, 'Indonesian Rupiah', 'IDR', 'Rp', '2025-09-25 11:38:14', NULL, NULL, 1),
(30, 'Philippine Peso', 'PHP', '₱', '2025-09-25 11:38:14', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int NOT NULL,
  `title` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`, `status`) VALUES
(1, 'Human Resources', '2025-09-23 12:22:37', NULL, NULL, '1'),
(2, 'Finance', '2025-09-23 12:22:37', NULL, NULL, '1'),
(3, 'Sales', '2025-09-23 12:22:37', NULL, NULL, '1'),
(4, 'Accounting', '2025-09-23 12:22:37', NULL, NULL, '1'),
(5, 'Information Technology', '2025-09-23 12:22:37', NULL, NULL, '1'),
(6, 'Purchasing', '2025-09-23 12:22:37', NULL, NULL, '1'),
(7, 'Research and development', '2025-09-23 12:22:37', NULL, NULL, '1'),
(8, 'Marketing', '2025-09-23 12:22:37', NULL, NULL, '1'),
(9, 'Production', '2025-09-23 12:22:37', NULL, NULL, '1'),
(10, 'Quality Management', '2025-09-23 12:22:37', NULL, NULL, '1'),
(11, 'Customer service', '2025-09-23 12:22:37', NULL, NULL, '1'),
(12, 'Management', '2025-09-23 12:22:37', NULL, NULL, '1'),
(13, 'Operations management', '2025-09-23 12:22:37', NULL, NULL, '1'),
(14, 'Training and development', '2025-09-23 12:22:37', NULL, NULL, '1'),
(15, 'Business Administration', '2025-09-23 12:22:37', NULL, NULL, '1'),
(16, 'Store department', '2025-09-23 12:22:38', NULL, NULL, '1'),
(17, 'Designing department', '2025-09-23 12:22:38', NULL, NULL, '1'),
(18, 'Inspection Department', '2025-09-23 12:22:38', NULL, NULL, '1'),
(19, 'Marketing & proposals department', '2025-09-23 12:22:38', NULL, NULL, '1'),
(20, 'Planning', '2025-09-23 12:22:38', NULL, NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `discount_type` enum('percentage','fixed') NOT NULL,
  `value` float(11,2) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `subscriptionplan_id` int NOT NULL,
  `coupon_code` char(8) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  `status` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employmenttypes`
--

CREATE TABLE `employmenttypes` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` enum('Monthly','Hourly') DEFAULT NULL,
  `base_salary` float(11,2) DEFAULT NULL,
  `hourly_salary` float(11,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  `status` char(1) NOT NULL DEFAULT '1',
  `overtime` float(11,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `employmenttypes`
--

INSERT INTO `employmenttypes` (`id`, `title`, `type`, `base_salary`, `hourly_salary`, `created_at`, `updated_at`, `deleted_at`, `status`, `overtime`) VALUES
(1, 'Permanent', 'Monthly', NULL, NULL, '2025-09-23 12:30:41', NULL, NULL, '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `country_id` int NOT NULL,
  `holiday_date` date NOT NULL,
  `reoccuring` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  `status` char(1) NOT NULL DEFAULT '1',
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `holidays`
--

INSERT INTO `holidays` (`id`, `title`, `country_id`, `holiday_date`, `reoccuring`, `created_at`, `updated_at`, `deleted_at`, `status`, `description`) VALUES
(1, 'Iqbal Day', 1, '2025-11-09', 'yearly', '2025-09-23 12:44:36', '2025-11-24 16:56:49', NULL, '1', NULL),
(2, 'Quaid Day', 1, '2025-12-25', 'yearly', '2025-11-24 16:57:41', NULL, NULL, '1', NULL),
(3, 'Pakistan Day', 1, '2025-03-23', 'yearly', '2025-11-24 16:57:41', NULL, NULL, '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int NOT NULL,
  `company_id` int NOT NULL,
  `subscriptionplan_id` int NOT NULL,
  `subscription_id` int NOT NULL,
  `discount_id` int DEFAULT NULL,
  `invoice_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  `no_of_users` int NOT NULL,
  `total_amount` float(11,2) NOT NULL,
  `any_discount` float(11,2) DEFAULT NULL,
  `final_payable` float(11,2) NOT NULL,
  `currency_id` int NOT NULL,
  `status` varchar(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  `comments` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `company_id`, `subscriptionplan_id`, `subscription_id`, `discount_id`, `invoice_date`, `expiry_date`, `no_of_users`, `total_amount`, `any_discount`, `final_payable`, `currency_id`, `status`, `created_at`, `updated_at`, `deleted_at`, `comments`) VALUES
(1, 3, 1, 1, NULL, '2025-09-01', '2025-09-10', 10, 800.00, 0.00, 800.00, 5, '1', '2025-09-25 11:19:31', '2025-09-25 18:22:04', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `leavetype_id` int NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `description` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  `status` char(1) NOT NULL,
  `approved_user_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `user_id`, `leavetype_id`, `start_date`, `end_date`, `description`, `created_at`, `updated_at`, `deleted_at`, `status`, `approved_user_id`) VALUES
(1, 9, 4, '2025-11-24', '2025-11-24', NULL, '2025-11-21 16:50:43', '2025-11-24 08:06:22', NULL, 'a', 4),
(2, 10, 4, '2025-11-26', '2025-11-26', NULL, '2025-11-24 11:04:07', '2025-11-24 11:04:07', NULL, 'p', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `leavetypes`
--

CREATE TABLE `leavetypes` (
  `id` int NOT NULL,
  `title` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `leavetypes`
--

INSERT INTO `leavetypes` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`, `status`) VALUES
(1, 'Bereavement leave', '2025-09-23 11:22:46', NULL, NULL, '1'),
(2, 'Maternity leave', '2025-09-23 11:22:46', NULL, NULL, '1'),
(3, 'Sick leave', '2025-09-23 11:22:46', NULL, NULL, '1'),
(4, 'Casual leave', '2025-09-23 11:22:46', NULL, NULL, '1'),
(5, 'Comp off', '2025-09-23 11:22:46', NULL, NULL, '1'),
(6, 'Compound leaf', '2025-09-23 11:22:46', NULL, NULL, '1'),
(7, 'Loss of Pay', '2025-09-23 11:22:46', NULL, NULL, '1'),
(8, 'Marriage leave', '2025-09-23 11:22:46', NULL, NULL, '1'),
(9, 'Miscellaneous leave', '2025-09-23 11:22:46', NULL, NULL, '1'),
(10, 'Paternity leave', '2025-09-23 11:22:46', NULL, NULL, '1'),
(11, 'Privilege leaves or earned leaves', '2025-09-23 11:22:46', NULL, NULL, '1'),
(12, 'Sabbatical leave', '2025-09-23 11:22:46', NULL, NULL, '1'),
(13, 'Bank holidays', '2025-09-23 11:22:46', NULL, NULL, '1'),
(14, 'Leaf shapes', '2025-09-23 11:22:46', NULL, NULL, '1'),
(15, 'Simple leaf', '2025-09-23 11:22:47', NULL, NULL, '1'),
(16, 'Unpaid leave', '2025-09-23 11:22:47', NULL, NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int NOT NULL,
  `company_id` int NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `lat_lon` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `timezone_id` int NOT NULL,
  `user_id` int NOT NULL,
  `city_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `company_id`, `address`, `phone`, `email`, `lat_lon`, `title`, `timezone_id`, `user_id`, `city_id`, `created_at`, `updated_at`, `deleted_at`, `status`) VALUES
(1, 1, 'Office 2-A, Cowork24, Gulberg Green, Islamabad', '+3155193534', 'naveed.ramzan@gmail.com', '33.5714237,73.1442313', 'Head Office', 18, 1, 1, '2025-09-23 09:10:15', '2025-11-17 11:26:57', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` int DEFAULT NULL,
  `status` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`, `status`) VALUES
(1, 'Location Tracking', '2025-11-18 06:00:55', NULL, NULL, '1'),
(2, 'Groups & Teams ', '2025-11-18 06:00:55', NULL, NULL, '1'),
(3, 'Shifts & Scheduling', '2025-11-18 06:00:55', NULL, NULL, '1'),
(4, 'Task Management', '2025-11-18 06:00:55', NULL, NULL, '1'),
(5, 'Payroll', '2025-11-18 06:00:55', NULL, NULL, '1'),
(6, 'Breaks Management', '2025-11-18 06:00:55', NULL, NULL, '1'),
(7, 'Leaves & Holidays', '2025-11-18 06:00:55', NULL, NULL, '1'),
(8, 'Activity Tracking ', '2025-11-18 06:00:55', NULL, NULL, '1'),
(9, 'Overtime', '2025-11-18 06:00:55', NULL, NULL, '1'),
(10, 'Milage Tracking', '2025-11-18 06:00:55', NULL, NULL, '1'),
(11, 'Tax Filing', '2025-11-18 06:00:55', NULL, NULL, '1'),
(12, 'Attendance', '2025-11-18 16:28:15', NULL, NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int NOT NULL,
  `invoice_id` int NOT NULL,
  `payment_date` date NOT NULL,
  `payment_method` enum('credit_card','bank_transfer','paypal','cash') NOT NULL,
  `transactionid` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `paid_amount` float(11,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  `status` char(1) NOT NULL,
  `comments` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `invoice_id`, `payment_date`, `payment_method`, `transactionid`, `paid_amount`, `created_at`, `updated_at`, `deleted_at`, `status`, `comments`) VALUES
(1, 1, '2025-09-10', 'credit_card', 'juhje689767', 800.00, '2025-09-25 18:22:42', '2025-09-25 18:23:27', NULL, '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `slug` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `parent_id` int DEFAULT NULL,
  `photo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `category_id` int NOT NULL,
  `company_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `slug`, `description`, `parent_id`, `photo`, `created_at`, `updated_at`, `deleted_at`, `status`, `category_id`, `company_id`) VALUES
(1, 'Idea Transformation', 'idea-transformation', 'We have a team of expert who helps your idea to convert into the product and helps the customer base and generate value', 0, 'idea-transformation.jpg', '2024-10-06 19:06:44', '2024-11-27 13:14:57', NULL, '1', 1, 1),
(2, 'Agile Awareness', 'agile-awareness', NULL, 0, 'agile-awareness.jpg', '2024-11-14 19:20:40', '2024-11-27 13:00:56', NULL, '1', 18, 1),
(4, 'Team Building', 'team-building', 'I will conduct team building sessions for your office team up to 15 people', NULL, 'team-building.jpg', '2024-12-09 07:12:17', '2024-12-11 12:58:57', NULL, '1', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `company_id` int NOT NULL,
  `service_id` int NOT NULL,
  `slot_duration` int NOT NULL,
  `session_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `title`, `value`, `created_at`, `updated_at`, `deleted_at`, `status`) VALUES
(1, 'siteTitle', 'obecno', '2024-10-05 19:04:24', '2025-09-25 17:19:33', NULL, '1'),
(2, 'siteSlogan', 'Simplifying Attendance', '2024-10-05 19:08:37', '2025-09-25 17:19:39', NULL, '1'),
(3, 'adminPagination', '20', '2024-10-06 14:12:07', NULL, NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `slots`
--

CREATE TABLE `slots` (
  `id` int NOT NULL,
  `session_id` int NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscriptionplanhistory`
--

CREATE TABLE `subscriptionplanhistory` (
  `id` int NOT NULL,
  `subscriptionplan_id` int NOT NULL,
  `old_price` float(11,2) NOT NULL,
  `new_price` float(11,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscriptionplans`
--

CREATE TABLE `subscriptionplans` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `billing_cycle` enum('Monthly','Yearly') NOT NULL,
  `price_per_cycle` float(11,2) NOT NULL,
  `features` text,
  `price_per_employee` float(11,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  `status` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `subscriptionplans`
--

INSERT INTO `subscriptionplans` (`id`, `title`, `billing_cycle`, `price_per_cycle`, `features`, `price_per_employee`, `created_at`, `updated_at`, `deleted_at`, `status`) VALUES
(1, 'Basic', 'Monthly', 250.00, 'Basic features', 150.00, '2025-09-24 16:59:24', NULL, NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` int NOT NULL,
  `company_id` int NOT NULL,
  `subscriptionplan_id` int NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `referral_user_id` int DEFAULT NULL,
  `comments` text,
  `status` char(1) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `company_id`, `subscriptionplan_id`, `start_date`, `end_date`, `referral_user_id`, `comments`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, '2025-10-01', '2025-10-31', 1, NULL, '0', '0000-00-00 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `timezones`
--

CREATE TABLE `timezones` (
  `id` int NOT NULL,
  `title` varchar(100) NOT NULL,
  `timezone` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `timezones`
--

INSERT INTO `timezones` (`id`, `title`, `timezone`, `created_at`, `updated_at`, `deleted_at`, `status`) VALUES
(1, 'UTC-12:00 – Baker Island', '-12:00', '2025-09-25 11:33:35', NULL, NULL, 1),
(2, 'UTC-11:00 – American Samoa', '-11:00', '2025-09-25 11:33:35', NULL, NULL, 1),
(3, 'UTC-10:00 – Hawaii', '-10:00', '2025-09-25 11:33:35', NULL, NULL, 1),
(4, 'UTC-09:00 – Alaska', '-09:00', '2025-09-25 11:33:35', NULL, NULL, 1),
(5, 'UTC-08:00 – Los Angeles', '-08:00', '2025-09-25 11:33:35', NULL, NULL, 1),
(6, 'UTC-07:00 – Denver', '-07:00', '2025-09-25 11:33:35', NULL, NULL, 1),
(7, 'UTC-06:00 – Chicago', '-06:00', '2025-09-25 11:33:35', NULL, NULL, 1),
(8, 'UTC-05:00 – New York', '-05:00', '2025-09-25 11:33:35', NULL, NULL, 1),
(9, 'UTC-04:00 – Santiago', '-04:00', '2025-09-25 11:33:35', NULL, NULL, 1),
(10, 'UTC-03:00 – Buenos Aires', '-03:00', '2025-09-25 11:33:35', NULL, NULL, 1),
(11, 'UTC-02:00 – South Georgia', '-02:00', '2025-09-25 11:33:35', NULL, NULL, 1),
(12, 'UTC-01:00 – Azores', '-01:00', '2025-09-25 11:33:35', NULL, NULL, 1),
(13, 'UTC+00:00 – London', '+00:00', '2025-09-25 11:33:35', NULL, NULL, 1),
(14, 'UTC+01:00 – Berlin', '+01:00', '2025-09-25 11:33:35', NULL, NULL, 1),
(15, 'UTC+02:00 – Cairo', '+02:00', '2025-09-25 11:33:35', NULL, NULL, 1),
(16, 'UTC+03:00 – Moscow', '+03:00', '2025-09-25 11:33:35', NULL, NULL, 1),
(17, 'UTC+04:00 – Dubai', '+04:00', '2025-09-25 11:33:35', NULL, NULL, 1),
(18, 'UTC+05:00 – Karachi', '+05:00', '2025-09-25 11:33:35', NULL, NULL, 1),
(19, 'UTC+05:30 – India Standard Time', '+05:30', '2025-09-25 11:33:35', NULL, NULL, 1),
(20, 'UTC+06:00 – Dhaka', '+06:00', '2025-09-25 11:33:35', NULL, NULL, 1),
(21, 'UTC+07:00 – Bangkok', '+07:00', '2025-09-25 11:33:35', NULL, NULL, 1),
(22, 'UTC+08:00 – Singapore', '+08:00', '2025-09-25 11:33:35', NULL, NULL, 1),
(23, 'UTC+09:00 – Tokyo', '+09:00', '2025-09-25 11:33:35', NULL, NULL, 1),
(24, 'UTC+10:00 – Sydney', '+10:00', '2025-09-25 11:33:35', NULL, NULL, 1),
(25, 'UTC+11:00 – Solomon Islands', '+11:00', '2025-09-25 11:33:35', NULL, NULL, 1),
(26, 'UTC+12:00 – Auckland', '+12:00', '2025-09-25 11:33:35', NULL, NULL, 1),
(27, 'UTC+13:00 – Tonga', '+13:00', '2025-09-25 11:33:35', NULL, NULL, 1),
(28, 'UTC+14:00 – Kiritimati Island', '+14:00', '2025-09-25 11:33:35', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `userroles`
--

CREATE TABLE `userroles` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_id` int DEFAULT NULL,
  `is_show` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `userroles`
--

INSERT INTO `userroles` (`id`, `title`, `company_id`, `is_show`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Administrator', NULL, '0', NULL, NULL, NULL),
(2, 'Customer', NULL, '0', NULL, NULL, NULL),
(3, 'Company Admin', NULL, '1', NULL, NULL, NULL),
(4, 'Company Office Admin', NULL, '0', NULL, NULL, NULL),
(5, 'Employee', NULL, '0', NULL, NULL, NULL),
(6, 'Customer Support', NULL, '0', NULL, NULL, NULL),
(7, 'Software Developer', NULL, '0', '2025-11-20 17:17:38', '2025-11-20 17:17:38', NULL),
(8, 'Project Manager', NULL, '0', '2025-11-20 17:17:38', '2025-11-20 17:17:38', NULL),
(9, 'HR Manager', NULL, '0', '2025-11-20 17:17:38', '2025-11-20 17:17:38', NULL),
(10, 'QA Engineer', NULL, '0', '2025-11-20 17:27:12', '2025-11-20 17:27:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `country_id` bigint UNSIGNED DEFAULT NULL,
  `city_id` bigint UNSIGNED DEFAULT NULL,
  `cnic` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `title`, `email`, `username`, `password`, `phone`, `photo`, `country_id`, `city_id`, `cnic`, `date_of_birth`, `created_at`, `updated_at`, `deleted_at`, `status`, `remember_token`) VALUES
(1, 'Naveed Ramzan', 'naveed.ramzan@gmail.com', NULL, '$2y$10$HR9R/iIHwyb3fmrecy8mhO.v/jBpL6F7l8LHBG/I/zup8Usaklsme', '+923335430621', 'naveed-ramzan.png', 1, 1, NULL, '1982-04-16', NULL, '2025-11-26 03:47:57', NULL, '1', 'je0NA3qCx8tLirC4ZXeAib7C10Dr9JKZ2pfy3i0AWG1sO3XNME5kNNp4wGw7'),
(4, 'Ahmed Hassan', 'me2ahmedhassan@gmail.com', 'ahmed-hassan', '$2y$10$HR9R/iIHwyb3fmrecy8mhO.v/jBpL6F7l8LHBG/I/zup8Usaklsme', NULL, '1763534307_ahmad-hassan.jpg', 1, 1, NULL, NULL, '2025-11-17 13:12:27', '2025-11-26 05:02:15', NULL, '', '1c00bhDxLMdARaNfKzTz1Pz0IoauhkhFT9ExznmZ80e3f9h0oO60SRmiWcke'),
(5, 'John Doe', 'john.doe@obecno.com', 'john-doe', '$2y$10$TblGmR7vifszxqMxFwy3uewOqF9vdNwh.9IyHTxWL/l7h6gcJqiNu', NULL, NULL, 1, 1, NULL, NULL, '2025-11-20 17:17:38', '2025-11-20 17:17:38', NULL, '', ''),
(6, 'Jane Smith', 'jane.smith@obecno.com', 'jane-smith', '$2y$10$xi7GLy.FvpPH5hfnvFjGk.k941mktiaIE99ggO/jzq/2rC7k0QtrG', NULL, NULL, 1, 1, NULL, NULL, '2025-11-20 17:17:38', '2025-11-20 17:17:38', NULL, '', ''),
(7, 'Mike Johnson', 'mike.johnson@obecno.com', 'mike-johnson', '$2y$10$wf2Zm4y5Dj7HBEUR1qOUP.Oh56tPt7CnO5n8LPCyQKnTzL8joHSw.', NULL, NULL, 1, 1, NULL, NULL, '2025-11-20 17:17:39', '2025-11-20 17:17:39', NULL, '', ''),
(8, 'John Doen', 'john.doen@obecno.com', 'john-doen', '$2y$10$amu76OeFNNaiZuKxr6r7Rueoz4Gj7iwE.sNMODClPj7eVpm2R0ox.', NULL, NULL, 1, 1, NULL, NULL, '2025-11-20 17:27:12', '2025-11-20 17:27:12', NULL, '', ''),
(9, 'Janey Smith', 'janey.smith@obecno.com', 'janey-smith', '$2y$10$HR9R/iIHwyb3fmrecy8mhO.v/jBpL6F7l8LHBG/I/zup8Usaklsme', NULL, '1763982129_joney.jpg', 1, 1, NULL, NULL, '2025-11-20 17:27:12', '2025-11-26 03:53:27', NULL, '', 'idBdn1n9QtQGI4dzDp1RZCZLiiksX561eROZUoLTNjStRYt1OD3dBjAN1lAC'),
(10, 'Boby Johnson', 'boby.johnson@obecno.com', 'boby-johnson', '$2y$10$HR9R/iIHwyb3fmrecy8mhO.v/jBpL6F7l8LHBG/I/zup8Usaklsme', NULL, '1763724259_boby-johnson.jpeg', 1, 1, NULL, NULL, '2025-11-20 17:27:12', '2025-11-26 03:53:13', NULL, '', 'UjmdzelqLrzfTieJ9AALjPHInZIPgPvpwdoYkcbi4upHjDdmRgTyMECqX1w4');

-- --------------------------------------------------------

--
-- Table structure for table `users_userroles`
--

CREATE TABLE `users_userroles` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `userrole_id` bigint UNSIGNED NOT NULL,
  `company_id` int NOT NULL,
  `department_id` int DEFAULT NULL,
  `location_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_userroles`
--

INSERT INTO `users_userroles` (`id`, `user_id`, `userrole_id`, `company_id`, `department_id`, `location_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 0, NULL, 0, NULL, NULL, NULL),
(6, 4, 3, 1, 15, 1, '2025-11-17 13:12:27', '2025-11-24 08:01:02', NULL),
(7, 4, 3, 2, 15, NULL, '2025-11-19 10:32:02', '2025-11-19 10:32:02', NULL),
(8, 5, 7, 1, 5, 1, '2025-11-20 17:17:38', '2025-11-20 17:19:01', NULL),
(9, 6, 8, 1, 13, 1, '2025-11-20 17:17:38', '2025-11-20 17:18:52', NULL),
(10, 7, 9, 1, 1, 1, '2025-11-20 17:17:39', '2025-11-20 17:18:42', NULL),
(11, 8, 7, 1, 5, 1, '2025-11-20 17:27:12', '2025-11-20 17:29:39', NULL),
(12, 9, 10, 1, 5, 1, '2025-11-20 17:27:12', '2025-11-20 17:29:32', NULL),
(13, 10, 8, 1, 20, 1, '2025-11-20 17:27:12', '2025-11-20 17:28:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wages`
--

CREATE TABLE `wages` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `wage_month` date NOT NULL,
  `base_salary` float(11,2) NOT NULL,
  `overtime` float(11,2) DEFAULT NULL,
  `bonus` float(11,2) DEFAULT NULL,
  `pf_deducation` float(11,2) DEFAULT NULL,
  `tax_deduction` float(11,2) DEFAULT NULL,
  `other_deduction` float(11,2) DEFAULT NULL,
  `final_payment` float(11,2) NOT NULL,
  `payment_date` date DEFAULT NULL,
  `paid_via` text,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointmentstatuses`
--
ALTER TABLE `appointmentstatuses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `assets_sessions`
--
ALTER TABLE `assets_sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assettypes`
--
ALTER TABLE `assettypes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `categories_companies`
--
ALTER TABLE `categories_companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms`
--
ALTER TABLE `cms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `companies_modules`
--
ALTER TABLE `companies_modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companysettings`
--
ALTER TABLE `companysettings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employmenttypes`
--
ALTER TABLE `employmenttypes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leavetypes`
--
ALTER TABLE `leavetypes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `slots`
--
ALTER TABLE `slots`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptionplanhistory`
--
ALTER TABLE `subscriptionplanhistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptionplans`
--
ALTER TABLE `subscriptionplans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timezones`
--
ALTER TABLE `timezones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `userroles`
--
ALTER TABLE `userroles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `users_country_id_foreign` (`country_id`),
  ADD KEY `users_city_id_foreign` (`city_id`);

--
-- Indexes for table `users_userroles`
--
ALTER TABLE `users_userroles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wages`
--
ALTER TABLE `wages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `appointmentstatuses`
--
ALTER TABLE `appointmentstatuses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `assets`
--
ALTER TABLE `assets`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `assets_sessions`
--
ALTER TABLE `assets_sessions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assettypes`
--
ALTER TABLE `assettypes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `categories_companies`
--
ALTER TABLE `categories_companies`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cms`
--
ALTER TABLE `cms`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `companies_modules`
--
ALTER TABLE `companies_modules`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `companysettings`
--
ALTER TABLE `companysettings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employmenttypes`
--
ALTER TABLE `employmenttypes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `leavetypes`
--
ALTER TABLE `leavetypes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `slots`
--
ALTER TABLE `slots`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscriptionplanhistory`
--
ALTER TABLE `subscriptionplanhistory`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscriptionplans`
--
ALTER TABLE `subscriptionplans`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `timezones`
--
ALTER TABLE `timezones`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `userroles`
--
ALTER TABLE `userroles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users_userroles`
--
ALTER TABLE `users_userroles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `wages`
--
ALTER TABLE `wages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
