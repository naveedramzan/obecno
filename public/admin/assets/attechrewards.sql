-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2023 at 09:34 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `attechrewards`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `project_id` int(11) NOT NULL,
  `expected_hours` varchar(255) NOT NULL,
  `actual_hours` varchar(255) NOT NULL,
  `tenure` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bonuscredits`
--

CREATE TABLE `bonuscredits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `comments` varchar(255) NOT NULL,
  `credits` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bonuscredits`
--

INSERT INTO `bonuscredits` (`id`, `user_id`, `comments`, `credits`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 7, 'Sprint: Testing of EZA and EZW with SSO - rating and credits', 33, 1, '2023-05-18 06:15:26', '2023-05-18 06:15:26', NULL),
(5, 12, 'Sprint: Testing of EZA and EZW with SSO - rating and credits', 33, 1, '2023-05-18 06:15:26', '2023-05-18 06:15:26', NULL),
(6, 22, 'Sprint: Testing of EZA and EZW with SSO - rating and credits', 33, 1, '2023-05-18 06:15:26', '2023-05-18 06:15:26', NULL),
(7, 37, 'Sprint: Testing of EZA and EZW with SSO - rating and credits', 33, 1, '2023-05-18 06:15:26', '2023-05-18 06:15:26', NULL),
(8, 65, 'Sprint: Testing of EZA and EZW with SSO - rating and credits', 33, 1, '2023-05-18 06:15:26', '2023-05-18 06:15:26', NULL),
(9, 75, 'Sprint: Testing of EZA and EZW with SSO - rating and credits', 33, 1, '2023-05-18 06:15:26', '2023-05-18 06:15:26', NULL),
(10, 1, 'Sprint: Testing of EZA and EZW with SSO - rating and credits', 33, 1, '2023-05-18 06:15:26', '2023-05-18 06:15:26', NULL),
(12, 1, 'Weekend Time Adjustment', 100, 1, '2023-05-18 06:26:26', '2023-05-18 06:26:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `photo` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `title`, `photo`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'A4Tech', 'a4tech-logo.jpg', NULL, NULL, NULL),
(2, 'Saeed Ghani', 'saeed-ghani-logo.webp', NULL, NULL, NULL),
(3, 'Polo', 'polo-logo.png', NULL, NULL, NULL),
(4, 'Philips', 'philips-logo.svg', NULL, NULL, NULL),
(5, 'No Brand', 'no-image.jpg', NULL, NULL, NULL),
(6, 'AT Technology', 'attech-logo.png', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `title`, `country_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Islamabad', 1, NULL, NULL, NULL),
(2, 'London', 2, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cms`
--

CREATE TABLE `cms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `flag` varchar(255) NOT NULL,
  `code` varchar(3) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `title`, `flag`, `code`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Pakistan', '', 'PAK', NULL, NULL, NULL),
(2, 'United Kingdom', 'united-kingdom.png', 'UK', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Development', NULL, NULL, NULL),
(3, 'Project Management Office', NULL, NULL, NULL),
(4, 'Quality Assurance', NULL, NULL, NULL),
(5, 'Creative', NULL, NULL, NULL),
(6, 'DevOps', NULL, NULL, NULL),
(7, 'Human Resource', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedbackcategories`
--

CREATE TABLE `feedbackcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feedbackcategories`
--

INSERT INTO `feedbackcategories` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Punctuality', NULL, NULL, NULL),
(2, 'Quality of Work', NULL, NULL, NULL),
(3, 'Quantity of Work', NULL, NULL, NULL),
(4, 'Product Knowledge', NULL, NULL, NULL),
(5, 'Working Relationship', NULL, NULL, NULL),
(6, 'Follow Coding Practices', NULL, NULL, NULL),
(7, 'Communication', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `holiday_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `holidays`
--

INSERT INTO `holidays` (`id`, `title`, `holiday_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Pakistan Day', '2023-03-23', NULL, NULL, NULL),
(2, 'Eid Ul Fitr', '2023-04-21', NULL, NULL, NULL),
(3, 'Eid Ul Fitr', '2023-04-24', NULL, NULL, NULL),
(4, 'Eid Ul Fitr', '2023-04-25', NULL, NULL, NULL),
(5, 'Labour Day', '2023-05-01', NULL, NULL, NULL),
(6, 'Independence Day', '2023-08-14', NULL, NULL, NULL),
(7, 'Eid Ul Azha', '2023-06-28', NULL, NULL, NULL),
(8, 'Eid Ul Azha', '2023-06-29', NULL, NULL, NULL),
(9, 'Eid Ul Azha', '2023-06-30', NULL, NULL, NULL),
(10, 'Ashura', '2023-07-28', NULL, NULL, NULL),
(11, 'Ashura', '2023-07-27', NULL, NULL, NULL),
(12, 'Eid Milad un Nabi', '2023-09-27', NULL, NULL, NULL),
(13, 'Iqbal Day', '2023-11-09', NULL, NULL, NULL),
(14, 'Quaid Day', '2023-12-25', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2022_09_30_000000_settings', 1),
(5, '2022_09_30_085814_countries', 1),
(6, '2022_09_30_090103_cities', 1),
(7, '2022_09_30_091819_userroles', 1),
(8, '2022_09_30_999990_users', 1),
(9, '2022_09_30_999991_users_userroles', 1),
(10, '2022_11_03_155337_cms', 1),
(11, '2022_11_04_043536_tickets', 1),
(12, '2022_11_23_084515_departments', 1),
(13, '2022_11_23_102931_feedbackcategories', 2),
(14, '2022_11_23_102931_shopcategories', 2),
(15, '2022_11_23_154785_pointsettings', 2),
(16, '2022_11_23_122649_projects', 3),
(17, '2022_11_24_092835_users_projects', 4),
(18, '2022_11_28_053746_skills', 5),
(19, '2022_11_28_142519_milestones', 6),
(20, '2022_11_28_142707_users_milestones', 6),
(21, '2022_12_01_113443_attendance', 7),
(22, '2023_05_10_145325_brands', 8),
(23, '2023_05_10_145847_photos', 9),
(24, '2023_05_12_092149_holidays', 10),
(25, '2023_05_16_195903_bonuscredits', 11),
(26, '2023_05_18_123301_wishlist', 12),
(27, '2023_05_18_162703_cart', 13),
(28, '2023_05_18_163001_orders', 14),
(29, '2023_05_18_163113_orderdetails', 15);

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `credits` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `total_credits` int(11) NOT NULL,
  `total_quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pointsettings`
--

CREATE TABLE `pointsettings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `feedbackcategory_id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `percentage` float(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pointsettings`
--

INSERT INTO `pointsettings` (`id`, `feedbackcategory_id`, `project_id`, `percentage`, `created_at`, `updated_at`, `deleted_at`) VALUES
(8, 7, 4, 20.00, NULL, NULL, NULL),
(9, 6, 4, 20.00, NULL, NULL, NULL),
(10, 4, 4, 20.00, NULL, NULL, NULL),
(11, 2, 4, 20.00, NULL, NULL, NULL),
(12, 5, 4, 20.00, NULL, NULL, NULL),
(14, 7, 7, 15.00, NULL, NULL, NULL),
(15, 6, 7, 10.00, NULL, NULL, NULL),
(16, 4, 7, 20.00, NULL, NULL, NULL),
(17, 1, 7, 10.00, NULL, NULL, NULL),
(18, 2, 7, 15.00, NULL, NULL, NULL),
(19, 3, 7, 15.00, NULL, NULL, NULL),
(20, 5, 7, 15.00, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `shopcategory_id` bigint(20) UNSIGNED NOT NULL,
  `photo` text DEFAULT NULL,
  `description` text NOT NULL,
  `min_price` bigint(11) NOT NULL,
  `max_price` int(11) NOT NULL,
  `credits` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `brand_id`, `shopcategory_id`, `photo`, `description`, `min_price`, `max_price`, `credits`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'A4Tech G7-NX250 2.4G Wireless Mouse', 1, 4, 'a4tech-mouse.jpg', 'Brand: A4 Tech \r\nModel: G7-NX250 \r\nConnectivity: USB \r\nWireless: 2.4G Power Saving DPI Adjustment Single indication  Channel lock setting 4-way wheel 16 Gestures \r\nOperating Range: 15m Synch RF Technology System \r\nRequirements: window 2000, XP, 2003, vista Window 7 \r\nPacking include: wireless mouse & Multi-link receiver', 2200, 2500, 4700, NULL, NULL, NULL),
(2, 'Neem Face Wash', 2, 2, 'neem-face-wash.webp', 'For dry skin type, it is recommended to apply a light moisturizer afterwards for soft, supple & glowing skin.\r\n\r\nSaeed Ghani presents you with its all in one best face wash for oily skin. This herbal neem face wash helps fight acne efficiently with its antibacterial and antifungal properties, keeping skin clear, elegant, and smooth. It delves deep into the texture of your skin, removing excess oil and dirt from your pores and leaving behind a layer of moisture. Regular use of this acne clear neem face wash helps bring you closer to beautiful, soft and hydrated skin. (60ml)', 300, 400, 700, NULL, NULL, NULL),
(4, 'Polo T Shirt For Men', 3, 1, 'polo-t-shirt.webp', 'Shirts for Men\r\nPolo Shirts\r\nPOLO T SHIRT Half SLEEVE\r\nFashionable\r\nExport Quality\r\nSoft & Comfortable Men’s, Boys T Shirt Style: Fashion\r\nMachine Washable', 2000, 1600, 3600, NULL, NULL, NULL),
(5, 'Philips Air Fryer HD-9200', 4, 3, 'philips-airfryer.webp', 'Sustainability Packaging > 90% recycled materials User manual 100% recycled paper Country of origin Made in China Capacity Basket (kg) 0.8 kg Pan (liter*) 4.1 L', 55400, 55600, 111000, NULL, NULL, NULL),
(6, 'Night Vision & Day Glasses Aviator For Men', 5, 1, 'men-glasses.webp', 'Night Vision & Day Glasses Aviator For Men Polarized With Uv Protection Driving GlassesNight Vision & Day Glasses Aviator For Men Polarized With Uv Protection Driving Glasses', 145, 300, 445, NULL, NULL, NULL),
(7, 'Work From Home', 6, 5, 'work_from_home.png', 'Less Commute Stress - Location Independence - Money Savings - A Customizable Office - No Healthy Relationship with office colleague', 20, 30, 50, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `expected_start_date` date DEFAULT NULL,
  `expected_end_date` date DEFAULT NULL,
  `actual_start_date` date DEFAULT NULL,
  `actual_end_date` date DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `title`, `slug`, `expected_start_date`, `expected_end_date`, `actual_start_date`, `actual_end_date`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'EZ Web V2- 2020', 'ez-web-v2--2020', NULL, NULL, '2022-08-01', NULL, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(3, 'Quality Assurance', 'quality-assurance', NULL, NULL, '2021-07-01', NULL, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(4, 'AT Tech SSO', 'at-tech-sso', '2019-12-01', '2020-12-01', '2021-07-01', NULL, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(5, 'Dr.iQ new', 'dr.iq-new', NULL, NULL, '2021-01-01', NULL, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(6, 'Product Support Management', 'product-support-management-', NULL, NULL, '2022-11-01', NULL, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(7, 'Dr.IQ', 'dr.iq', NULL, NULL, '2017-04-01', NULL, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(8, 'Design Team', 'design-team', NULL, NULL, '2020-05-01', NULL, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(9, 'Dr. iQ Architectural Revamp', 'dr.-iq-architectural-revamp', NULL, NULL, '2022-09-01', NULL, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(10, 'PMO Planning & Operations', 'pmo-planning-&-operations', NULL, NULL, '2022-07-01', NULL, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(11, 'CHG_CMS-RV', 'chg_cms-rv', NULL, NULL, '2022-07-01', NULL, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(12, 'EZ_Doc', 'ez_doc', NULL, NULL, '2017-01-01', NULL, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(13, 'EZ ANALYTICS', 'ez-analytics-', NULL, NULL, '2021-01-01', NULL, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(14, 'AT Tech Messaging Service', 'at-tech-messaging-service', NULL, NULL, '2022-11-01', NULL, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(45, 'EZ WEB REVAMP', 'ez-web-revamp', NULL, NULL, NULL, NULL, NULL, '2023-01-10 01:58:29', '2023-01-10 01:58:29', NULL),
(229, 'DevSecOps', 'devsecops', NULL, NULL, NULL, NULL, NULL, '2023-03-03 02:48:50', '2023-03-03 02:48:50', NULL),
(364, 'Data Automation ', 'data-automation-', NULL, NULL, NULL, NULL, NULL, '2023-03-07 01:35:37', '2023-03-07 01:35:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `title`, `value`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'siteTitle', 'AT Tech - Rewards System', NULL, NULL, NULL),
(2, 'siteSlogan', 'facilitating Employees', NULL, NULL, NULL),
(3, 'perDayHours', '7.5', NULL, NULL, NULL),
(4, 'adminPagination', '30', NULL, NULL, NULL),
(5, 'showAttendanceDashboard', '20', NULL, NULL, NULL),
(6, 'topAttendanceUsers', '65', NULL, NULL, NULL),
(7, 'creditUnit', '2.5', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shopcategories`
--

CREATE TABLE `shopcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `photo` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shopcategories`
--

INSERT INTO `shopcategories` (`id`, `title`, `photo`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Male Beauty', 'men-beauty-banner.jpg', NULL, NULL, NULL),
(2, 'Female Beauty', 'female-beauty-banner.jpeg', NULL, NULL, NULL),
(3, 'House Hold Electornics', 'house-hold-banner.jpg', NULL, NULL, NULL),
(4, 'Computer Accessories', 'computer-accessories-banner.jpg', NULL, NULL, NULL),
(5, 'Family Support', 'family-time.jpg', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'PHP', NULL, NULL, NULL),
(2, 'Python', NULL, NULL, NULL),
(3, 'React', NULL, NULL, NULL),
(4, 'Scrum Master', NULL, NULL, NULL),
(5, 'Testing', NULL, NULL, NULL),
(6, 'Android', NULL, NULL, NULL),
(7, 'iOS', NULL, NULL, NULL),
(8, 'UI-UX', NULL, NULL, NULL),
(9, 'Database Administrator', NULL, NULL, NULL),
(10, 'Human Resource', NULL, NULL, NULL),
(11, 'DevOps', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sprints`
--

CREATE TABLE `sprints` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `goal` varchar(255) NOT NULL,
  `calculated_credits` double(10,2) DEFAULT NULL,
  `category_wise_points_json` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `overall_percentage` float(10,2) DEFAULT NULL,
  `feedback_comments` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sprints`
--

INSERT INTO `sprints` (`id`, `project_id`, `start_date`, `end_date`, `goal`, `calculated_credits`, `category_wise_points_json`, `overall_percentage`, `feedback_comments`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 4, '2023-05-01', '2023-05-31', 'Multiple Accounts Integration with evoX', NULL, NULL, NULL, NULL, NULL, '2023-05-10 02:47:49', NULL),
(3, 4, '2023-02-01', '2023-02-28', 'SSO IDP Integration with EZW SP', NULL, NULL, NULL, NULL, NULL, '2023-05-12 02:57:48', NULL),
(4, 4, '2023-04-17', '2023-05-10', 'Testing of EZA and EZW with SSO', 33.00, '{\"8___20\":\"5\",\"9___20\":\"5\",\"10___20\":\"5\",\"11___20\":\"5\",\"12___20\":\"5\"}', 95.00, 'Great delivery guys', NULL, '2023-05-18 06:15:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `from_email` varchar(255) NOT NULL,
  `from_name` varchar(255) NOT NULL,
  `from_phone` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userroles`
--

CREATE TABLE `userroles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `userroles`
--

INSERT INTO `userroles` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Administrator', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `jobtitle` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `photo` text DEFAULT NULL,
  `slug` text NOT NULL,
  `linkedin` text DEFAULT NULL,
  `credits` bigint(20) DEFAULT NULL,
  `about` text DEFAULT NULL,
  `country_id` bigint(20) UNSIGNED DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `city_id` bigint(20) UNSIGNED DEFAULT NULL,
  `skill_id` bigint(20) UNSIGNED DEFAULT NULL,
  `promoted_on` date DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `promoted_from` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `title`, `email`, `email_verified_at`, `jobtitle`, `password`, `phone`, `gender`, `photo`, `slug`, `linkedin`, `credits`, `about`, `country_id`, `department_id`, `city_id`, `skill_id`, `promoted_on`, `date_of_birth`, `promoted_from`, `remember_token`, `created_at`, `updated_at`, `deleted_at`, `status`) VALUES
(1, 'Naveed Ramzan', 'naveed.ramzan@attech-ltd.com', NULL, 'Development Manager', '$2y$10$ziVusJ84F4nAKbbdNWsp6.B9L/7D2uGYKTWetmesCcaq7KGuZMrZm', '+923335430621', 'Male', 'naveed-ramzan-casual.jpg', 'naveedramzan', 'https://www.linkedin.com/in/naveedramzan/', 133, 'Enabling People | HealthCare/eCommerce | Idea Transformation | Business Analyst | Scrum Master | Project Manager | Product Owner | Agile Coach | Training & Development | Digital Transformation | Remote Available', 1, 1, 1, 1, '2022-02-01', '1982-04-16', 'Integrations Team Lead', 'ZVxluUZ4SGqdUAjW9Qb5gCVo5fSv8600yn4akukFKDUCKCufCzXmSCWA1bjf', NULL, '2023-05-18 06:26:26', NULL, '1'),
(4, 'Waleed Ahmed', 'waleed.ahmed@attech-ltd.com', NULL, 'QA Engineer', '1', '+92 312 1535070', 'Male', '1', 'waleed-ahmed', '1', 0, '1', 1, 4, 1, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1'),
(5, 'Bakhtawar Rubab', 'bakhtawar.rubab@attech-ltd.com', NULL, 'QA Engineer', '1', '+92 313 5445548', 'Female', 'https://media-exp1.licdn.com/dms/image/D4D35AQH8YA2qJNPfGA/profile-framedphoto-shrink_800_800/0/1661328695140?e=1670230800&v=beta&t=rRwFpQGbtjN0XAs_DP5tJ-Roh_Jt53_rRiCDQ639e_Y', 'bakhtawar-rubab', 'https://www.linkedin.com/in/bakhtawar-rubab-83bb73124/', 0, 'Software Quality Assurance Engineer at AT TECH', 1, 4, 1, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0'),
(6, 'Abbas Akhter', 'abbas.akhter@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'abbas-akhter', NULL, 0, NULL, 1, 1, 1, 1, NULL, NULL, NULL, NULL, '2022-12-05 02:52:13', '2022-12-05 02:52:13', NULL, '1'),
(7, 'Abdullah Haider', 'abdullah.haider@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'abdullah-haider', NULL, 33, NULL, 1, 4, 1, 5, NULL, NULL, NULL, NULL, '2022-12-05 05:27:01', '2023-05-18 06:15:26', NULL, '1'),
(8, 'Adeel Irfan', 'adeel.irfan@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'adeel-irfan', NULL, 0, NULL, 1, 1, 1, 1, NULL, NULL, NULL, NULL, '2022-12-05 05:27:01', '2022-12-05 05:27:01', NULL, '1'),
(9, 'Adnan Yousaf', 'adnan.yousaf@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'adnan-yousaf', NULL, 0, NULL, 1, 1, 1, 7, NULL, NULL, NULL, NULL, '2022-12-05 05:27:01', '2022-12-05 05:27:01', NULL, '1'),
(10, 'Ahmed Ali', 'ahmed.ali@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'ahmed-ali', NULL, 0, NULL, 1, 1, 1, 3, NULL, NULL, NULL, NULL, '2022-12-05 05:27:01', '2022-12-05 05:27:01', NULL, '1'),
(11, 'Ahsan Duriman', 'ahsan.duriman@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'ahsan-duriman', NULL, 0, NULL, 1, 1, 1, 3, NULL, NULL, NULL, NULL, '2022-12-05 05:27:01', '2022-12-05 05:27:01', NULL, '1'),
(12, 'Ahsan Zahid', 'ahsan.zahid@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'ahsan-zahid', NULL, 33, NULL, 1, 1, 1, 1, NULL, NULL, NULL, NULL, '2022-12-05 05:27:01', '2023-05-18 06:15:26', NULL, '1'),
(13, 'Aimen Nasir', 'aimen.nasir@attech-ltd.com', NULL, NULL, NULL, NULL, 'Female', NULL, 'aimen-nasir', NULL, 0, NULL, 1, 4, 1, 5, NULL, NULL, NULL, NULL, '2022-12-05 05:27:01', '2022-12-05 05:27:01', NULL, '1'),
(14, 'Ali Khokhar', 'ali.khokhar@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'ali-khokhar', NULL, 0, NULL, 1, 4, 1, 5, NULL, NULL, NULL, NULL, '2022-12-05 05:27:01', '2022-12-05 05:27:01', NULL, '1'),
(15, 'Aqib Nawaz', 'aqib.nawaz@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'aqib-nawaz', NULL, 0, NULL, 1, 5, 1, 8, NULL, NULL, NULL, NULL, '2022-12-05 05:27:01', '2022-12-05 05:27:01', NULL, '1'),
(16, 'Aqsa Maryam', 'aqsa.maryam@attech-ltd.com', NULL, NULL, NULL, NULL, 'Female', NULL, 'aqsa-maryam', NULL, 0, NULL, 1, 1, 1, 6, NULL, NULL, NULL, NULL, '2022-12-05 05:27:01', '2022-12-05 05:27:01', NULL, '1'),
(17, 'Asad.abbas', 'asad.abbas@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'asad.abbas', NULL, 0, NULL, 1, 1, 1, 2, NULL, NULL, NULL, NULL, '2022-12-05 05:27:01', '2023-05-12 02:57:48', NULL, '0'),
(18, 'bisma sultan', 'bisma.sultan@attech-ltd.com', NULL, NULL, NULL, NULL, 'Female', NULL, 'bisma-sultan', NULL, 0, NULL, 1, 4, 1, 5, NULL, NULL, NULL, NULL, '2022-12-05 05:27:01', '2022-12-05 05:27:01', NULL, '1'),
(19, 'danish mehmood', 'danish.mehmood@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'danish-mehmood', NULL, 0, NULL, 1, 1, 1, 3, NULL, NULL, NULL, NULL, '2022-12-05 05:27:01', '2022-12-05 05:27:01', NULL, '1'),
(20, 'Dijle Kasimoglu Olmez', 'dijle.kasimoglu.olmez@attech-ltd.com', NULL, NULL, NULL, NULL, 'Female', NULL, 'dijle-kasimoglu-olmez', NULL, 0, NULL, 2, 3, 2, 4, NULL, NULL, NULL, NULL, '2022-12-05 05:27:01', '2022-12-05 05:27:01', NULL, '1'),
(21, 'Ehtesham Ali', 'ehtesham.ali@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'ehtesham-ali', NULL, 0, NULL, 1, 4, 1, 5, NULL, NULL, NULL, NULL, '2022-12-05 05:27:01', '2022-12-05 05:27:01', NULL, '1'),
(22, 'Fahad Sohail', 'fahad.sohail@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'fahad-sohail', NULL, 33, NULL, 1, 1, 1, 3, NULL, NULL, NULL, NULL, '2022-12-05 05:27:01', '2023-05-18 06:15:26', NULL, '1'),
(23, 'faham.fasihi', 'faham.fasihi@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'faham.fasihi', NULL, 0, NULL, 1, 5, 1, 8, NULL, NULL, NULL, NULL, '2022-12-05 05:27:01', '2022-12-05 05:27:01', NULL, '1'),
(24, 'Faheem Ahmad', 'faheem.ahmad@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'faheem-ahmad', NULL, 0, NULL, 1, 1, 1, 1, NULL, NULL, NULL, NULL, '2022-12-05 05:27:01', '2022-12-05 05:27:01', NULL, '1'),
(25, 'Fakhra Jabeen', 'fakhra.jabeen@attech-ltd.com', NULL, NULL, NULL, NULL, 'Female', NULL, 'fakhra-jabeen', NULL, 0, NULL, 1, 3, 1, 4, NULL, NULL, NULL, NULL, '2022-12-05 05:27:01', '2022-12-05 05:27:01', NULL, '0'),
(26, 'Fatina Shahzad', 'fatina.shahzad@attech-ltd.com', NULL, NULL, NULL, NULL, 'Female', NULL, 'fatina-shahzad', NULL, 0, NULL, 1, 1, 1, 2, NULL, NULL, NULL, NULL, '2022-12-05 05:27:01', '2022-12-05 05:27:01', NULL, '1'),
(27, 'Ghufran Awan', 'ghufran.awan@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'ghufran-awan', NULL, 0, NULL, 1, 3, 1, 4, NULL, NULL, NULL, NULL, '2022-12-05 05:27:01', '2022-12-05 05:27:01', NULL, '0'),
(28, 'Haseeb Ayub', 'haseeb.ayub@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'haseeb-ayub', NULL, 0, NULL, 1, 4, 1, 5, NULL, NULL, NULL, NULL, '2022-12-05 05:27:01', '2022-12-05 05:27:01', NULL, '0'),
(29, 'Hasnain Ali Baloch', 'hasnain.ali.baloch@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'hasnain-ali-baloch', NULL, 0, NULL, 1, 1, 1, 3, NULL, NULL, NULL, NULL, '2022-12-05 05:27:01', '2022-12-05 05:27:01', NULL, '1'),
(30, 'Hassan Javed', 'hassan.javed@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'hassan-javed', NULL, 0, NULL, 1, 1, 1, 7, NULL, NULL, NULL, NULL, '2022-12-05 05:27:01', '2022-12-05 05:27:01', NULL, '1'),
(31, 'Hina ilyas', 'hina.ilyas@attech-ltd.com', NULL, NULL, NULL, NULL, 'Female', NULL, 'hina-ilyas', NULL, 0, NULL, 1, 4, 1, 5, NULL, NULL, NULL, NULL, '2022-12-05 05:27:01', '2022-12-05 05:27:01', NULL, '1'),
(32, 'Ibaad Ur Rahman', 'ibaad.ur.rahman@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'ibaad-ur-rahman', NULL, 0, NULL, 1, 1, 1, 1, NULL, NULL, NULL, NULL, '2022-12-05 05:27:01', '2022-12-05 05:27:01', NULL, '1'),
(33, 'Ibra Noor', 'ibra.noor@attech-ltd.com', NULL, NULL, NULL, NULL, 'Female', NULL, 'ibra-noor', NULL, 0, NULL, 1, 1, 1, 6, NULL, NULL, NULL, NULL, '2022-12-05 05:27:01', '2022-12-05 05:27:01', NULL, '1'),
(34, 'Idrees', 'idrees@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'idrees', NULL, 0, NULL, 1, 3, 1, 4, NULL, NULL, NULL, NULL, '2022-12-05 05:27:01', '2022-12-05 05:27:01', NULL, '1'),
(35, 'Imran Ali', 'imran.ali@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'imran-ali', NULL, 0, NULL, 1, 1, 1, 2, NULL, NULL, NULL, NULL, '2022-12-05 05:27:01', '2022-12-05 05:27:01', NULL, '0'),
(36, 'Ishaq Orakzai', 'ishaq.orakzai@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'ishaq-orakzai', NULL, 0, NULL, 1, 1, 1, 3, NULL, NULL, NULL, NULL, '2022-12-05 05:27:01', '2022-12-05 05:27:01', NULL, '1'),
(37, 'Jahanzaib Naazir', 'jahanzaib.naazir@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'jahanzaib-naazir', NULL, 33, NULL, 1, 4, 1, 5, NULL, NULL, NULL, NULL, '2022-12-05 05:27:01', '2023-05-18 06:15:26', NULL, '1'),
(38, 'Jawad Shabbir', 'jawad.shabbir@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'jawad-shabbir', NULL, 0, NULL, 1, 1, 1, 1, NULL, NULL, NULL, NULL, '2022-12-05 05:27:01', '2022-12-05 05:27:01', NULL, '1'),
(39, 'Junaid Ahmad', 'junaid.ahmad@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'junaid-ahmad', NULL, 0, NULL, 1, 5, 1, 8, NULL, NULL, NULL, NULL, '2022-12-05 05:27:01', '2022-12-05 05:27:01', NULL, '1'),
(40, 'Kamil Karim', 'kamil.karim@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'kamil-karim', NULL, 0, NULL, 1, 1, 1, 6, NULL, NULL, NULL, NULL, '2022-12-05 05:27:01', '2022-12-05 05:27:01', NULL, '1'),
(41, 'kashif mehmood', 'kashif.mehmood@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'kashif-mehmood', NULL, 0, NULL, 1, 1, 1, 6, NULL, NULL, NULL, NULL, '2022-12-05 05:27:01', '2022-12-05 05:27:01', NULL, '1'),
(42, 'Khawaja Hammad', 'khawaja.hammad@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'khawaja-hammad', NULL, 0, NULL, 1, 5, 1, 8, NULL, NULL, NULL, NULL, '2022-12-05 05:27:01', '2022-12-05 05:27:01', NULL, '1'),
(43, 'Maryam Khan', 'maryam.khan@attech-ltd.com', NULL, NULL, NULL, NULL, 'Female', NULL, 'maryam-khan', NULL, 0, NULL, 1, 3, 1, 4, NULL, NULL, NULL, NULL, '2022-12-05 05:27:01', '2022-12-05 05:27:01', NULL, '0'),
(44, 'Mehreen Akhtar', 'mehreen.akhtar@attech-ltd.com', NULL, NULL, NULL, NULL, 'Female', NULL, 'mehreen-akhtar', NULL, 0, NULL, 1, 1, 1, 1, NULL, NULL, NULL, NULL, '2022-12-05 05:27:01', '2022-12-05 05:27:01', NULL, '1'),
(45, 'Minahil Rashid', 'minahil.rashid@attech-ltd.com', NULL, NULL, NULL, NULL, 'Female', NULL, 'minahil-rashid', NULL, 0, NULL, 1, 5, 1, 8, NULL, NULL, NULL, NULL, '2022-12-05 05:27:01', '2022-12-05 05:27:01', NULL, '1'),
(46, 'Mishal Gillani', 'mishal.gillani@attech-ltd.com', NULL, NULL, NULL, NULL, 'Female', NULL, 'mishal-gillani', NULL, 0, NULL, 1, 4, 1, 5, NULL, NULL, NULL, NULL, '2022-12-05 05:27:01', '2022-12-05 05:27:01', NULL, '1'),
(47, 'Mohsin Ali Raza', 'mohsin.ali.raza@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'mohsin-ali-raza', NULL, 0, NULL, 1, 3, 1, 4, NULL, NULL, NULL, NULL, '2022-12-05 05:27:01', '2022-12-05 05:27:01', NULL, '1'),
(48, 'Monica.garcia', 'monica.garcia@attech-ltd.com', NULL, NULL, NULL, NULL, 'Female', NULL, 'monica.garcia', NULL, 0, NULL, 2, 3, 2, 4, NULL, NULL, NULL, NULL, '2022-12-05 05:27:01', '2022-12-05 05:27:01', NULL, '1'),
(49, 'Mubashir Ali', 'mubashir.ali@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'mubashir-ali', NULL, 0, NULL, 1, 1, 1, 1, NULL, NULL, NULL, NULL, '2022-12-05 05:27:01', '2022-12-05 05:27:01', NULL, '1'),
(50, 'Muhammad Ahsan', 'muhammad.ahsan@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'muhammad-ahsan', NULL, 0, NULL, 1, 1, 1, 1, NULL, NULL, NULL, NULL, '2022-12-05 05:27:01', '2022-12-05 05:27:01', NULL, '1'),
(51, 'Muhammad Aqib Maqsood', 'muhammad.aqib.maqsood@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'muhammad-aqib-maqsood', NULL, 0, NULL, 1, 4, 1, 5, NULL, NULL, NULL, NULL, '2022-12-05 05:27:01', '2022-12-05 05:27:01', NULL, '1'),
(52, 'Muhammad Asim', 'muhammad.asim@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'muhammad-asim', NULL, 0, NULL, 1, 1, 1, 7, NULL, NULL, NULL, NULL, '2022-12-05 05:27:01', '2022-12-05 05:27:01', NULL, '1'),
(53, 'Muhammad Farooq', 'muhammad.farooq@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'muhammad-farooq', NULL, 0, NULL, 1, 1, 1, 2, NULL, NULL, NULL, NULL, '2022-12-05 05:27:01', '2022-12-05 05:27:01', NULL, '1'),
(54, 'Muhammad Ikram Ulhaq', 'muhammad.ikram.ulhaq@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'muhammad-ikram-ulhaq', NULL, 0, NULL, 1, 1, 1, 6, NULL, NULL, NULL, NULL, '2022-12-05 05:27:01', '2022-12-05 05:27:01', NULL, '1'),
(55, 'Muhammad Mubeen', 'muhammad.mubeen@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'muhammad-mubeen', NULL, 0, NULL, 1, 4, 1, 5, NULL, NULL, NULL, NULL, '2022-12-05 05:27:01', '2022-12-05 05:27:01', NULL, '0'),
(56, 'Muhammad Raheel', 'muhammad.raheel@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'muhammad-raheel', NULL, 0, NULL, 1, 5, 1, 8, NULL, NULL, NULL, NULL, '2022-12-05 05:27:01', '2022-12-05 05:27:01', NULL, '1'),
(57, 'Muhammad Shahbaz', 'muhammad.shahbaz@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'muhammad-shahbaz', NULL, 0, NULL, 1, 1, 1, 1, NULL, NULL, NULL, NULL, '2022-12-05 05:27:01', '2022-12-05 05:27:01', NULL, '1'),
(58, 'Muhammad Umair', 'muhammad.umair@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'muhammad-umair', NULL, 0, NULL, 1, 1, 1, 2, NULL, NULL, NULL, NULL, '2022-12-05 05:27:01', '2022-12-05 05:27:01', NULL, '0'),
(59, 'Muhammad Wajahat', 'muhammad.wajahat@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'muhammad-wajahat', NULL, 0, NULL, 1, 3, 1, 4, NULL, NULL, NULL, NULL, '2022-12-05 05:27:01', '2022-12-05 05:27:01', NULL, '1'),
(60, 'muhammad wasah muteh', 'muhammad.wasah.muteh@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'muhammad-wasah-muteh', NULL, 0, NULL, 1, 1, 1, 1, NULL, NULL, NULL, NULL, '2022-12-05 05:27:01', '2022-12-05 05:27:01', NULL, '1'),
(61, 'Nabeel Khan', 'nabeel.khan@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'nabeel-khan', NULL, 0, NULL, 1, 1, 1, 7, NULL, NULL, NULL, NULL, '2022-12-05 05:27:01', '2022-12-05 05:27:01', NULL, '1'),
(64, 'Osama Shahbaz', 'osama.shahbaz@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'osama-shahbaz', NULL, 0, NULL, 1, 1, 1, 2, NULL, NULL, NULL, NULL, '2022-12-05 05:28:21', '2022-12-05 05:28:21', NULL, '1'),
(65, 'Qasim Ali', 'qasim.ali@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'qasim-ali', NULL, 33, NULL, 1, 1, 1, 2, NULL, NULL, NULL, NULL, '2022-12-05 05:28:21', '2023-05-18 06:15:26', NULL, '1'),
(66, 'Ramsha Shahzad', 'ramsha.shahzad@attech-ltd.com', NULL, NULL, NULL, NULL, 'Female', NULL, 'ramsha-shahzad', NULL, 0, NULL, 1, 4, 1, 5, NULL, NULL, NULL, NULL, '2022-12-05 05:28:21', '2022-12-05 05:28:21', NULL, '1'),
(67, 'Rashid Mughal', 'rashid.mughal@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'rashid-mughal', NULL, 0, NULL, 1, 6, 1, 9, NULL, NULL, NULL, NULL, '2022-12-05 05:28:21', '2022-12-05 05:28:21', NULL, '1'),
(68, 'Rizwan Feroze', 'rizwan.feroze@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'rizwan-feroze', NULL, 0, NULL, 1, 1, 1, 1, NULL, NULL, NULL, NULL, '2022-12-05 05:28:21', '2022-12-05 05:28:21', NULL, '1'),
(69, 'Saad Khan', 'saad.khan@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'saad-khan', NULL, 0, NULL, 1, 1, 1, 1, NULL, NULL, NULL, NULL, '2022-12-05 05:28:21', '2022-12-05 05:28:21', NULL, '1'),
(70, 'Saad Zafar', 'saad.zafar@attech-ltd.com', NULL, NULL, NULL, NULL, 'Female', NULL, 'saad-zafar', NULL, 0, NULL, 1, 3, 1, 4, NULL, NULL, NULL, NULL, '2022-12-05 05:28:21', '2022-12-05 05:28:21', NULL, '1'),
(71, 'Sajeel Waien', 'sajeel.waien@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'sajeel-waien', NULL, 0, NULL, 1, 1, 1, 3, NULL, NULL, NULL, NULL, '2022-12-05 05:28:21', '2023-05-10 02:50:07', NULL, '1'),
(72, 'Saleem Haider', 'saleem.haider@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'saleem-haider', NULL, 0, NULL, 1, 1, 1, 6, NULL, NULL, NULL, NULL, '2022-12-05 05:28:21', '2022-12-05 05:28:21', NULL, '1'),
(74, 'Shabi ul Hassan', 'shabi.ul.hassan@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'shabi-ul-hassan', NULL, 0, NULL, 1, 1, 1, 1, NULL, NULL, NULL, NULL, '2022-12-05 05:28:21', '2022-12-05 05:28:21', NULL, '1'),
(75, 'Shah Khalid', 'shah.khalid@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'shah-khalid', NULL, 33, NULL, 1, 1, 1, 1, NULL, NULL, NULL, NULL, '2022-12-05 05:28:21', '2023-05-18 06:15:26', NULL, '1'),
(76, 'Shahbaz Naseer', 'shahbaz.naseer@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'shahbaz-naseer', NULL, 0, NULL, 1, 1, 1, 6, NULL, NULL, NULL, NULL, '2022-12-05 05:28:21', '2022-12-05 05:28:21', NULL, '1'),
(77, 'Shahzaib Mumtaz', 'shahzaib.mumtaz@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'shahzaib-mumtaz', NULL, 0, NULL, 1, 1, 1, 7, NULL, NULL, NULL, NULL, '2022-12-05 05:28:21', '2022-12-05 05:28:21', NULL, '1'),
(78, 'Shakeel Iqbal', 'shakeel.iqbal@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'shakeel-iqbal', NULL, 0, NULL, 1, 1, 1, 1, NULL, NULL, NULL, NULL, '2022-12-05 05:28:21', '2022-12-05 05:28:21', NULL, '1'),
(79, 'Shams Sheikh', 'shams.sheikh@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'shams-sheikh', NULL, 0, NULL, 1, 1, 1, 6, NULL, NULL, NULL, NULL, '2022-12-05 05:28:21', '2022-12-05 05:28:21', NULL, '1'),
(80, 'Shoaib Hussan', 'shoaib.hussan@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'shoaib-hussan', NULL, 0, NULL, 1, 1, 1, 7, NULL, NULL, NULL, NULL, '2022-12-05 05:28:21', '2022-12-05 05:28:21', NULL, '1'),
(81, 'Sofia Sadiq', 'sofia.sadiq@attech-ltd.com', NULL, NULL, NULL, NULL, 'Female', NULL, 'sofia-sadiq', NULL, 0, NULL, 1, 5, 1, 8, NULL, NULL, NULL, NULL, '2022-12-05 05:28:21', '2022-12-05 05:28:21', NULL, '1'),
(82, 'Sohail Akram', 'sohail.akram@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'sohail-akram', NULL, 0, NULL, 1, 5, 1, 8, NULL, NULL, NULL, NULL, '2022-12-05 05:28:21', '2022-12-05 05:28:21', NULL, '1'),
(83, 'Sohail Nawaz', 'sohail.nawaz@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'sohail-nawaz', NULL, 0, NULL, 1, 3, 1, 4, NULL, NULL, NULL, NULL, '2022-12-05 05:28:21', '2022-12-05 05:28:21', NULL, '1'),
(84, 'Sohail Sajid', 'sohail.sajid@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'sohail-sajid', NULL, 0, NULL, 1, 1, 1, 1, NULL, NULL, NULL, NULL, '2022-12-05 05:28:21', '2022-12-05 05:28:21', NULL, '1'),
(85, 'Syed Ali Musa', 'syed.ali.musa@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'syed-ali-musa', NULL, 0, NULL, 1, 1, 1, 1, NULL, NULL, NULL, NULL, '2022-12-05 05:28:21', '2022-12-05 05:28:21', NULL, '1'),
(86, 'Syed Awais Safdar', 'syed.awais.safdar@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'syed-awais-safdar', NULL, 0, NULL, 1, 4, 1, 5, NULL, NULL, NULL, NULL, '2022-12-05 05:28:21', '2022-12-05 05:28:21', NULL, '1'),
(87, 'Syed Waqar Ali', 'syed.waqar.ali@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'syed-waqar-ali', NULL, 0, NULL, 1, 1, 1, 1, NULL, NULL, NULL, NULL, '2022-12-05 05:28:21', '2022-12-05 05:28:21', NULL, '1'),
(88, 'Taimoor Khan', 'taimoor.khan@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'taimoor-khan', NULL, 0, NULL, 1, 4, 1, 5, NULL, NULL, NULL, NULL, '2022-12-05 05:28:21', '2022-12-05 05:28:21', NULL, '1'),
(89, 'Usama Javed', 'usama.javed@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'usama-javed', NULL, 0, NULL, 1, 4, 1, 5, NULL, NULL, NULL, NULL, '2022-12-05 05:28:21', '2022-12-05 05:28:21', NULL, '1'),
(90, 'Uzair Hussain', 'uzair.hussain@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'uzair-hussain', NULL, 0, NULL, 1, 1, 1, 1, NULL, NULL, NULL, NULL, '2022-12-05 05:28:21', '2022-12-05 05:28:21', NULL, '1'),
(91, 'Zahra Hasan', 'zahra.hasan@attech-ltd.com', NULL, NULL, NULL, NULL, 'Female', NULL, 'zahra-hasan', NULL, 0, NULL, 1, 3, 1, 4, NULL, NULL, NULL, NULL, '2022-12-05 05:28:21', '2022-12-05 05:28:21', NULL, '1'),
(92, 'Zeeshan Tariq', 'zeeshan.tariq@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'zeeshan-tariq', NULL, 0, NULL, 1, 1, 1, 6, NULL, NULL, NULL, NULL, '2022-12-05 05:28:21', '2022-12-05 05:28:21', NULL, '1'),
(95, 'sarahsaeedkhan', 'sarahsaeedkhan@attech-ltd.com', NULL, NULL, NULL, NULL, 'Female', NULL, 'sarahsaeedkhan', NULL, 0, NULL, 1, 1, 1, 2, NULL, NULL, NULL, NULL, '2022-12-07 00:41:11', '2022-12-07 00:41:11', NULL, '1'),
(97, 'Ayaz Hussain', 'ayaz.hussain@attech-ltd.com', NULL, NULL, NULL, NULL, 'male', NULL, 'ayaz-hussain', NULL, 0, NULL, 1, 1, 1, 2, NULL, NULL, NULL, NULL, '2023-01-10 01:58:28', '2023-01-10 01:58:28', NULL, '1'),
(98, 'Bilal Asif', 'bilal.asif@attech-ltd.com', NULL, NULL, NULL, NULL, 'male', NULL, 'bilal-asif', NULL, 0, NULL, 1, 1, 1, 3, NULL, NULL, NULL, NULL, '2023-01-10 01:58:28', '2023-01-10 01:58:28', NULL, '0'),
(99, 'Imran Ullah', 'imran.ullah@attech-ltd.com', NULL, NULL, NULL, NULL, 'male', NULL, 'imran-ullah', NULL, 0, NULL, 1, 4, 1, 5, NULL, NULL, NULL, NULL, '2023-01-10 01:58:29', '2023-01-10 01:58:29', NULL, '1'),
(100, 'nisar ahmed', 'nisar.ahmed@attech-ltd.com', NULL, NULL, NULL, NULL, 'male', NULL, 'nisar-ahmed', NULL, 0, NULL, 1, 4, 1, 5, NULL, NULL, NULL, NULL, '2023-01-10 01:58:29', '2023-01-10 01:58:29', NULL, '1'),
(102, 'Muhammad Shakeel', 'muhammad.shakeel@attech-ltd.com', NULL, NULL, NULL, NULL, 'male', NULL, 'muhammad-shakeel', NULL, 0, NULL, 1, 1, 1, 1, NULL, NULL, NULL, NULL, '2023-02-02 02:52:02', '2023-02-02 02:52:02', NULL, '1'),
(105, 'Abdullah Ishtiaq', 'abdullah.ishtiaq@attech-ltd.com', NULL, NULL, NULL, NULL, 'male', NULL, 'abdullah-ishtiaq', NULL, 0, NULL, 1, 1, 1, 6, NULL, NULL, NULL, NULL, '2023-03-03 02:48:50', '2023-03-03 02:48:50', NULL, '1'),
(107, 'Muhammad Junaid', 'muhammad.junaid@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'muhammad-junaid', NULL, 0, NULL, 1, 1, 1, 3, NULL, NULL, NULL, NULL, '2023-03-03 02:48:50', '2023-03-03 02:48:50', NULL, '1'),
(108, 'Muhammad Wasim', 'muhammad.wasim@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'muhammad-wasim', NULL, 0, NULL, 1, 6, 1, 11, NULL, NULL, NULL, NULL, '2023-03-03 02:48:50', '2023-03-03 02:48:50', NULL, '1'),
(109, 'Saleha Tanveer', 'saleha.tanveer@attech-ltd.com', NULL, NULL, NULL, NULL, 'female', NULL, 'saleha-tanveer', NULL, 0, NULL, 1, 1, 1, 2, NULL, NULL, NULL, NULL, '2023-03-03 02:48:50', '2023-03-03 02:48:50', NULL, '1'),
(110, 'Shujaat Hussain', 'shujaat.hussain@attech-ltd.com', NULL, NULL, NULL, NULL, 'male', NULL, 'shujaat-hussain', NULL, 0, NULL, 1, 6, 1, 11, NULL, NULL, NULL, NULL, '2023-03-03 02:48:50', '2023-03-03 02:48:50', NULL, '1'),
(113, 'Areeba Anwaar', 'areeba.anwaar@attech-ltd.com', NULL, NULL, NULL, NULL, 'female', NULL, 'areeba-anwaar', NULL, 0, NULL, 1, 7, 1, 10, NULL, NULL, NULL, NULL, '2023-03-07 00:41:10', '2023-03-07 00:41:10', NULL, '0'),
(114, 'Abu Bakkar', 'abu.bakkar@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'abu-bakkar', NULL, 0, NULL, 1, 1, 1, 3, NULL, NULL, NULL, NULL, '2023-04-05 02:32:36', '2023-04-05 02:32:36', NULL, '1'),
(115, 'Ghazanfar Siddique', 'ghazanfar.siddique@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'ghazanfar-siddique', NULL, 0, NULL, 1, 1, 1, 10, NULL, NULL, NULL, NULL, '2023-04-05 02:32:39', '2023-04-05 02:32:39', NULL, '0'),
(116, 'JamalMehmood', 'jamalmehmood@attech-ltd.com', NULL, NULL, NULL, NULL, 'Male', NULL, 'jamalmehmood', NULL, 0, NULL, 1, 1, 1, 1, NULL, NULL, NULL, NULL, '2023-04-05 02:32:41', '2023-04-05 02:32:41', NULL, '1'),
(117, 'Nida Khalid', 'nida.khalid@attech-ltd.com', NULL, NULL, NULL, NULL, 'Female', NULL, 'nida-khalid', NULL, 0, NULL, 1, 1, 1, 1, NULL, NULL, NULL, NULL, '2023-04-05 02:32:48', '2023-04-05 02:32:48', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `users_projects`
--

CREATE TABLE `users_projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_projects`
--

INSERT INTO `users_projects` (`id`, `user_id`, `project_id`, `role`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 6, 2, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(4, 7, 3, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(5, 7, 4, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(6, 7, 2, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(7, 8, 5, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(8, 8, 6, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(9, 8, 7, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(10, 9, 5, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(11, 10, 5, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(12, 11, 5, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(13, 11, 7, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(14, 12, 4, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(15, 13, 3, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(16, 14, 3, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(17, 14, 5, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(18, 14, 7, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(19, 15, 8, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(20, 16, 5, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(21, 17, 4, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(22, 5, 9, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(23, 5, 5, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(24, 5, 7, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(25, 18, 5, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(26, 19, 5, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(27, 20, 10, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(28, 21, 3, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(29, 21, 11, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(30, 22, 4, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(31, 23, 8, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(32, 24, 2, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(33, 25, 10, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(34, 25, 5, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(35, 26, 9, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(36, 26, 5, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(37, 27, 10, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(38, 28, 3, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(39, 28, 12, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(40, 28, 13, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(41, 28, 2, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(42, 29, 5, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(43, 30, 5, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(44, 31, 5, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(45, 31, 7, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(46, 32, 5, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(47, 33, 5, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(48, 34, 10, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(49, 35, 9, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(50, 35, 5, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(51, 36, 5, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(52, 37, 3, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(53, 37, 6, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(54, 37, 13, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(55, 37, 4, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(56, 37, 2, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(57, 38, 5, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(58, 39, 8, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(59, 40, 5, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(60, 41, 5, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(61, 41, 7, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(62, 42, 8, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(63, 43, 5, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(64, 44, 2, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(65, 45, 8, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(66, 46, 3, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(67, 46, 2, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(68, 47, 5, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(69, 47, 10, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(70, 48, 10, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(71, 49, 5, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(72, 50, 5, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(73, 51, 3, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(74, 51, 11, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(75, 52, 5, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(76, 52, 7, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(77, 53, 5, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(78, 54, 5, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(79, 55, 5, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(80, 55, 7, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(81, 56, 8, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(82, 56, 7, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(83, 57, 5, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(84, 58, 9, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(85, 58, 5, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(86, 59, 10, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(87, 60, 5, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(88, 61, 5, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(89, 1, 5, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(90, 64, 5, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(91, 64, 14, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(92, 65, 4, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(93, 66, 3, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(94, 66, 11, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(95, 67, 13, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(96, 68, 12, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(97, 69, 2, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(98, 70, 10, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(99, 70, 13, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(100, 71, 4, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(101, 72, 5, NULL, '2022-12-07 00:40:11', '2022-12-07 00:40:11', NULL),
(102, 95, 9, NULL, '2022-12-07 00:41:11', '2022-12-07 00:41:11', NULL),
(103, 95, 5, NULL, '2022-12-07 00:41:11', '2022-12-07 00:41:11', NULL),
(104, 74, 5, NULL, '2022-12-07 00:41:11', '2022-12-07 00:41:11', NULL),
(105, 75, 4, NULL, '2022-12-07 00:41:11', '2022-12-07 00:41:11', NULL),
(106, 75, 13, NULL, '2022-12-07 00:41:11', '2022-12-07 00:41:11', NULL),
(107, 76, 5, NULL, '2022-12-07 00:41:11', '2022-12-07 00:41:11', NULL),
(108, 77, 5, NULL, '2022-12-07 00:41:11', '2022-12-07 00:41:11', NULL),
(109, 78, 5, NULL, '2022-12-07 00:41:11', '2022-12-07 00:41:11', NULL),
(110, 79, 5, NULL, '2022-12-07 00:41:11', '2022-12-07 00:41:11', NULL),
(111, 80, 5, NULL, '2022-12-07 00:41:11', '2022-12-07 00:41:11', NULL),
(112, 81, 8, NULL, '2022-12-07 00:41:11', '2022-12-07 00:41:11', NULL),
(113, 82, 8, NULL, '2022-12-07 00:41:11', '2022-12-07 00:41:11', NULL),
(114, 82, 7, NULL, '2022-12-07 00:41:11', '2022-12-07 00:41:11', NULL),
(115, 83, 10, NULL, '2022-12-07 00:41:11', '2022-12-07 00:41:11', NULL),
(116, 84, 5, NULL, '2022-12-07 00:41:11', '2022-12-07 00:41:11', NULL),
(117, 85, 5, NULL, '2022-12-07 00:41:11', '2022-12-07 00:41:11', NULL),
(118, 86, 3, NULL, '2022-12-07 00:41:11', '2022-12-07 00:41:11', NULL),
(119, 86, 5, NULL, '2022-12-07 00:41:11', '2022-12-07 00:41:11', NULL),
(120, 86, 7, NULL, '2022-12-07 00:41:11', '2022-12-07 00:41:11', NULL),
(121, 87, 5, NULL, '2022-12-07 00:41:11', '2022-12-07 00:41:11', NULL),
(122, 87, 7, NULL, '2022-12-07 00:41:11', '2022-12-07 00:41:11', NULL),
(123, 88, 3, NULL, '2022-12-07 00:41:11', '2022-12-07 00:41:11', NULL),
(124, 88, 5, NULL, '2022-12-07 00:41:11', '2022-12-07 00:41:11', NULL),
(125, 88, 7, NULL, '2022-12-07 00:41:11', '2022-12-07 00:41:11', NULL),
(126, 89, 3, NULL, '2022-12-07 00:41:11', '2022-12-07 00:41:11', NULL),
(127, 90, 9, NULL, '2022-12-07 00:41:11', '2022-12-07 00:41:11', NULL),
(128, 90, 5, NULL, '2022-12-07 00:41:11', '2022-12-07 00:41:11', NULL),
(129, 4, 5, NULL, '2022-12-07 00:41:11', '2022-12-07 00:41:11', NULL),
(130, 4, 7, NULL, '2022-12-07 00:41:11', '2022-12-07 00:41:11', NULL),
(131, 91, 10, NULL, '2022-12-07 00:41:11', '2022-12-07 00:41:11', NULL),
(132, 92, 9, NULL, '2022-12-07 00:41:11', '2022-12-07 00:41:11', NULL),
(133, 92, 5, NULL, '2022-12-07 00:41:11', '2022-12-07 00:41:11', NULL),
(1322, 97, 9, NULL, '2023-01-10 01:58:28', '2023-01-10 01:58:28', NULL),
(1323, 98, 5, NULL, '2023-01-10 01:58:29', '2023-01-10 01:58:29', NULL),
(1324, 31, 6, NULL, '2023-01-10 01:58:29', '2023-01-10 01:58:29', NULL),
(1325, 99, 3, NULL, '2023-01-10 01:58:29', '2023-01-10 01:58:29', NULL),
(1326, 46, 13, NULL, '2023-01-10 01:58:29', '2023-01-10 01:58:29', NULL),
(1327, 100, 3, NULL, '2023-01-10 01:58:29', '2023-01-10 01:58:29', NULL),
(1328, 64, 9, NULL, '2023-01-10 01:58:29', '2023-01-10 01:58:29', NULL),
(1329, 68, 45, NULL, '2023-01-10 01:58:29', '2023-01-10 01:58:29', NULL),
(1330, 86, 6, NULL, '2023-01-10 01:58:29', '2023-01-10 01:58:29', NULL),
(1331, 87, 8, NULL, '2023-01-10 01:58:29', '2023-01-10 01:58:29', NULL),
(1332, 88, 10, NULL, '2023-01-10 01:58:29', '2023-01-10 01:58:29', NULL),
(1642, 1, 4, 'Advisor', NULL, NULL, NULL),
(1643, 32, 7, 'Back-end Developer', NULL, NULL, NULL),
(1644, 7, 13, NULL, '2023-02-02 02:52:02', '2023-02-02 02:52:02', NULL),
(1645, 9, 7, NULL, '2023-02-02 02:52:02', '2023-02-02 02:52:02', NULL),
(1646, 12, 2, NULL, '2023-02-02 02:52:02', '2023-02-02 02:52:02', NULL),
(1647, 12, 45, NULL, '2023-02-02 02:52:02', '2023-02-02 02:52:02', NULL),
(1648, 18, 3, NULL, '2023-02-02 02:52:02', '2023-02-02 02:52:02', NULL),
(1649, 18, 7, NULL, '2023-02-02 02:52:02', '2023-02-02 02:52:02', NULL),
(1650, 49, 7, NULL, '2023-02-02 02:52:02', '2023-02-02 02:52:02', NULL),
(1651, 51, 13, NULL, '2023-02-02 02:52:02', '2023-02-02 02:52:02', NULL),
(1652, 51, 2, NULL, '2023-02-02 02:52:02', '2023-02-02 02:52:02', NULL),
(1653, 52, 9, NULL, '2023-02-02 02:52:02', '2023-02-02 02:52:02', NULL),
(1654, 102, 2, NULL, '2023-02-02 02:52:02', '2023-02-02 02:52:02', NULL),
(1655, 60, 7, NULL, '2023-02-02 02:52:02', '2023-02-02 02:52:02', NULL),
(1656, 68, 2, NULL, '2023-02-02 02:52:02', '2023-02-02 02:52:02', NULL),
(1657, 76, 7, NULL, '2023-02-02 02:52:02', '2023-02-02 02:52:02', NULL),
(1658, 82, 5, NULL, '2023-02-02 02:52:02', '2023-02-02 02:52:02', NULL),
(3694, 14, 9, NULL, '2023-02-02 04:01:13', '2023-02-02 04:01:13', NULL),
(3695, 97, 5, NULL, '2023-02-02 04:01:13', '2023-02-02 04:01:13', NULL),
(3696, 97, 4, NULL, '2023-02-02 04:01:13', '2023-02-02 04:01:13', NULL),
(3697, 41, 9, NULL, '2023-02-02 04:01:14', '2023-02-02 04:01:14', NULL),
(3698, 79, 7, NULL, '2023-02-02 04:01:14', '2023-02-02 04:01:14', NULL),
(3699, 4, 3, NULL, '2023-02-02 04:01:14', '2023-02-02 04:01:14', NULL),
(8051, 6, 45, NULL, '2023-03-03 02:48:50', '2023-03-03 02:48:50', NULL),
(8053, 7, 45, NULL, '2023-03-03 02:48:50', '2023-03-03 02:48:50', NULL),
(8055, 105, 5, NULL, '2023-03-03 02:48:50', '2023-03-03 02:48:50', NULL),
(8058, 13, 5, NULL, '2023-03-03 02:48:50', '2023-03-03 02:48:50', NULL),
(8064, 24, 45, NULL, '2023-03-03 02:48:50', '2023-03-03 02:48:50', NULL),
(8066, 34, 5, NULL, '2023-03-03 02:48:50', '2023-03-03 02:48:50', NULL),
(8068, 37, 8, NULL, '2023-03-03 02:48:50', '2023-03-03 02:48:50', NULL),
(8069, 37, 45, NULL, '2023-03-03 02:48:50', '2023-03-03 02:48:50', NULL),
(8072, 46, 9, NULL, '2023-03-03 02:48:50', '2023-03-03 02:48:50', NULL),
(8073, 46, 5, NULL, '2023-03-03 02:48:50', '2023-03-03 02:48:50', NULL),
(8077, 53, 9, NULL, '2023-03-03 02:48:50', '2023-03-03 02:48:50', NULL),
(8079, 107, 5, NULL, '2023-03-03 02:48:50', '2023-03-03 02:48:50', NULL),
(8080, 102, 45, NULL, '2023-03-03 02:48:50', '2023-03-03 02:48:50', NULL),
(8083, 108, 229, NULL, '2023-03-03 02:48:50', '2023-03-03 02:48:50', NULL),
(8085, 66, 2, NULL, '2023-03-03 02:48:50', '2023-03-03 02:48:50', NULL),
(8087, 68, 6, NULL, '2023-03-03 02:48:50', '2023-03-03 02:48:50', NULL),
(8089, 70, 2, NULL, '2023-03-03 02:48:50', '2023-03-03 02:48:50', NULL),
(8091, 71, 5, NULL, '2023-03-03 02:48:50', '2023-03-03 02:48:50', NULL),
(8093, 109, 5, NULL, '2023-03-03 02:48:50', '2023-03-03 02:48:50', NULL),
(8096, 110, 229, NULL, '2023-03-03 02:48:50', '2023-03-03 02:48:50', NULL),
(8097, 81, 5, NULL, '2023-03-03 02:48:50', '2023-03-03 02:48:50', NULL),
(8102, 89, 2, NULL, '2023-03-03 02:48:51', '2023-03-03 02:48:51', NULL),
(8104, 4, 6, NULL, '2023-03-03 02:48:51', '2023-03-03 02:48:51', NULL),
(13957, 113, 8, NULL, '2023-03-07 00:41:10', '2023-03-07 00:41:10', NULL),
(13958, 97, 364, NULL, '2023-03-07 01:35:37', '2023-03-07 01:35:37', NULL),
(13959, 12, 364, NULL, '2023-03-07 01:42:19', '2023-03-07 01:42:19', NULL),
(13960, 7, 5, NULL, '2023-04-05 02:32:35', '2023-04-05 02:32:35', NULL),
(13961, 114, 4, NULL, '2023-04-05 02:32:36', '2023-04-05 02:32:36', NULL),
(13962, 13, 2, NULL, '2023-04-05 02:32:37', '2023-04-05 02:32:37', NULL),
(13963, 13, 13, NULL, '2023-04-05 02:32:37', '2023-04-05 02:32:37', NULL),
(13964, 21, 5, NULL, '2023-04-05 02:32:38', '2023-04-05 02:32:38', NULL),
(13965, 22, 5, NULL, '2023-04-05 02:32:38', '2023-04-05 02:32:38', NULL),
(13966, 115, 5, NULL, '2023-04-05 02:32:39', '2023-04-05 02:32:39', NULL),
(13967, 116, 2, NULL, '2023-04-05 02:32:41', '2023-04-05 02:32:41', NULL),
(13968, 51, 364, NULL, '2023-04-05 02:32:45', '2023-04-05 02:32:45', NULL),
(13969, 51, 12, NULL, '2023-04-05 02:32:45', '2023-04-05 02:32:45', NULL),
(13970, 117, 2, NULL, '2023-04-05 02:32:48', '2023-04-05 02:32:48', NULL),
(13971, 66, 13, NULL, '2023-04-05 02:32:49', '2023-04-05 02:32:49', NULL),
(13972, 68, 364, NULL, '2023-04-05 02:32:49', '2023-04-05 02:32:49', NULL),
(13973, 69, 5, NULL, '2023-04-05 02:32:49', '2023-04-05 02:32:49', NULL),
(13974, 109, 9, NULL, '2023-04-05 02:32:50', '2023-04-05 02:32:50', NULL),
(13975, 89, 13, NULL, '2023-04-05 02:32:54', '2023-04-05 02:32:54', NULL),
(13976, 89, 4, NULL, '2023-04-05 02:32:54', '2023-04-05 02:32:54', NULL),
(13977, 60, 6, NULL, '2023-04-05 02:32:57', '2023-04-05 02:32:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_sprints`
--

CREATE TABLE `users_sprints` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `sprint_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_sprints`
--

INSERT INTO `users_sprints` (`id`, `user_id`, `sprint_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 7, 1, '2023-05-09 04:13:25', '2023-05-09 04:14:10', '2023-05-09 04:14:10'),
(2, 12, 1, '2023-05-09 04:13:25', '2023-05-09 04:14:10', '2023-05-09 04:14:10'),
(3, 22, 1, '2023-05-09 04:13:25', '2023-05-09 04:14:10', '2023-05-09 04:14:10'),
(4, 37, 1, '2023-05-09 04:13:25', '2023-05-09 04:14:10', '2023-05-09 04:14:10'),
(5, 65, 1, '2023-05-09 04:13:25', '2023-05-09 04:14:10', '2023-05-09 04:14:10'),
(6, 1, 1, '2023-05-09 04:13:25', '2023-05-09 04:14:10', '2023-05-09 04:14:10'),
(7, 7, 1, '2023-05-09 04:14:10', '2023-05-09 04:14:43', '2023-05-09 04:14:43'),
(8, 22, 1, '2023-05-09 04:14:10', '2023-05-09 04:14:43', '2023-05-09 04:14:43'),
(9, 37, 1, '2023-05-09 04:14:10', '2023-05-09 04:14:43', '2023-05-09 04:14:43'),
(10, 65, 1, '2023-05-09 04:14:10', '2023-05-09 04:14:43', '2023-05-09 04:14:43'),
(11, 75, 1, '2023-05-09 04:14:10', '2023-05-09 04:14:43', '2023-05-09 04:14:43'),
(12, 1, 1, '2023-05-09 04:14:10', '2023-05-09 04:14:43', '2023-05-09 04:14:43'),
(13, 7, 1, '2023-05-09 04:14:43', '2023-05-09 04:14:43', NULL),
(14, 22, 1, '2023-05-09 04:14:43', '2023-05-09 04:14:43', NULL),
(15, 37, 1, '2023-05-09 04:14:43', '2023-05-09 04:14:43', NULL),
(16, 65, 1, '2023-05-09 04:14:43', '2023-05-09 04:14:43', NULL),
(17, 71, 1, '2023-05-09 04:14:43', '2023-05-09 04:14:43', NULL),
(18, 75, 1, '2023-05-09 04:14:43', '2023-05-09 04:14:43', NULL),
(19, 1, 1, '2023-05-09 04:14:43', '2023-05-09 04:14:43', NULL),
(20, 7, 3, '2023-05-12 02:39:22', '2023-05-12 02:39:22', NULL),
(21, 12, 3, '2023-05-12 02:39:22', '2023-05-12 02:39:22', NULL),
(22, 17, 3, '2023-05-12 02:39:22', '2023-05-12 02:39:22', NULL),
(23, 22, 3, '2023-05-12 02:39:22', '2023-05-12 02:39:22', NULL),
(24, 37, 3, '2023-05-12 02:39:22', '2023-05-12 02:39:22', NULL),
(25, 65, 3, '2023-05-12 02:39:22', '2023-05-12 02:39:22', NULL),
(26, 7, 4, '2023-05-12 04:40:07', '2023-05-12 04:40:07', NULL),
(27, 12, 4, '2023-05-12 04:40:07', '2023-05-12 04:40:07', NULL),
(28, 22, 4, '2023-05-12 04:40:07', '2023-05-12 04:40:07', NULL),
(29, 37, 4, '2023-05-12 04:40:07', '2023-05-12 04:40:07', NULL),
(30, 65, 4, '2023-05-12 04:40:07', '2023-05-12 04:40:07', NULL),
(31, 75, 4, '2023-05-12 04:40:07', '2023-05-12 04:40:07', NULL),
(32, 1, 4, '2023-05-12 04:40:07', '2023-05-12 04:40:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_userroles`
--

CREATE TABLE `users_userroles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `userrole_id` bigint(20) UNSIGNED NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_userroles`
--

INSERT INTO `users_userroles` (`id`, `user_id`, `userrole_id`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, 1, 7, '2023-05-18 11:11:52', '2023-05-18 11:11:52', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bonuscredits`
--
ALTER TABLE `bonuscredits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bonuscredits_user_id_foreign` (`user_id`),
  ADD KEY `bonuscredits_created_by_foreign` (`created_by`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_title_unique` (`title`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_user_id_foreign` (`user_id`),
  ADD KEY `cart_product_id_foreign` (`product_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cities_country_id_foreign` (`country_id`);

--
-- Indexes for table `cms`
--
ALTER TABLE `cms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cms_title_unique` (`title`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `countries_code_unique` (`code`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `departments_title_unique` (`title`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `feedbackcategories`
--
ALTER TABLE `feedbackcategories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `feedbackcategories_title_unique` (`title`);

--
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `holidays_holiday_date_unique` (`holiday_date`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderdetails_order_id_foreign` (`order_id`),
  ADD KEY `orderdetails_product_id_foreign` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pointsettings`
--
ALTER TABLE `pointsettings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pointsettings_feedbackcategory_id_foreign` (`feedbackcategory_id`),
  ADD KEY `pointsettings_project_id_foreign` (`project_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `projects_title_unique` (`title`),
  ADD KEY `projects_user_id_foreign` (`user_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_title_unique` (`title`);

--
-- Indexes for table `shopcategories`
--
ALTER TABLE `shopcategories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `shopcategories_title_unique` (`title`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `skills_title_unique` (`title`);

--
-- Indexes for table `sprints`
--
ALTER TABLE `sprints`
  ADD PRIMARY KEY (`id`),
  ADD KEY `milestones_project_id_foreign` (`project_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tickets_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `userroles`
--
ALTER TABLE `userroles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userroles_title_unique` (`title`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_country_id_foreign` (`country_id`),
  ADD KEY `users_city_id_foreign` (`city_id`),
  ADD KEY `users_department_id_foreign` (`department_id`);

--
-- Indexes for table `users_projects`
--
ALTER TABLE `users_projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_projects_user_id_foreign` (`user_id`),
  ADD KEY `users_projects_project_id_foreign` (`project_id`);

--
-- Indexes for table `users_sprints`
--
ALTER TABLE `users_sprints`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_milestones_user_id_foreign` (`user_id`),
  ADD KEY `users_milestones_milestone_id_foreign` (`sprint_id`);

--
-- Indexes for table `users_userroles`
--
ALTER TABLE `users_userroles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_userroles_user_id_foreign` (`user_id`),
  ADD KEY `users_userroles_userrole_id_foreign` (`userrole_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlist_user_id_foreign` (`user_id`),
  ADD KEY `wishlist_product_id_foreign` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bonuscredits`
--
ALTER TABLE `bonuscredits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cms`
--
ALTER TABLE `cms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedbackcategories`
--
ALTER TABLE `feedbackcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pointsettings`
--
ALTER TABLE `pointsettings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=365;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `shopcategories`
--
ALTER TABLE `shopcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sprints`
--
ALTER TABLE `sprints`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userroles`
--
ALTER TABLE `userroles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `users_projects`
--
ALTER TABLE `users_projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13978;

--
-- AUTO_INCREMENT for table `users_sprints`
--
ALTER TABLE `users_sprints`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users_userroles`
--
ALTER TABLE `users_userroles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bonuscredits`
--
ALTER TABLE `bonuscredits`
  ADD CONSTRAINT `bonuscredits_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD CONSTRAINT `orderdetails_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orderdetails_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pointsettings`
--
ALTER TABLE `pointsettings`
  ADD CONSTRAINT `pointsettings_feedbackcategory_id_foreign` FOREIGN KEY (`feedbackcategory_id`) REFERENCES `feedbackcategories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pointsettings_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users_projects`
--
ALTER TABLE `users_projects`
  ADD CONSTRAINT `users_projects_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_projects_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users_userroles`
--
ALTER TABLE `users_userroles`
  ADD CONSTRAINT `users_userroles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_userroles_userrole_id_foreign` FOREIGN KEY (`userrole_id`) REFERENCES `userroles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlist_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
