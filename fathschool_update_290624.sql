-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 29, 2024 at 06:11 AM
-- Server version: 10.6.16-MariaDB-0ubuntu0.22.04.1
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scho_fathschool`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `log_name` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `subject_type` varchar(255) DEFAULT NULL,
  `event` varchar(255) DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `causer_type` varchar(255) DEFAULT NULL,
  `causer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`properties`)),
  `batch_uuid` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `event`, `subject_id`, `causer_type`, `causer_id`, `properties`, `batch_uuid`, `created_at`, `updated_at`) VALUES
(81, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"16:41\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-17 09:41:32', '2024-07-17 09:41:32'),
(82, 'default', 'User Update Profile', NULL, 'updateProfile', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"16:46\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-17 09:46:21', '2024-07-17 09:46:21'),
(83, 'default', 'User Logout', NULL, 'logout', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"18:50\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-17 11:50:39', '2024-07-17 11:50:39'),
(84, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"18:50\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-17 11:50:57', '2024-07-17 11:50:57'),
(85, 'default', 'User Logout', NULL, 'logout', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"19:29\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-17 12:29:03', '2024-07-17 12:29:03'),
(86, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"19:36\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-17 12:36:07', '2024-07-17 12:36:07'),
(87, 'default', 'User Logout', NULL, 'logout', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"20:17\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-17 13:17:28', '2024-07-17 13:17:28'),
(88, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"20:18\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-17 13:18:15', '2024-07-17 13:18:15'),
(89, 'default', 'User Update Face Data', NULL, 'updateFace', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"20:19\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-17 13:19:02', '2024-07-17 13:19:02'),
(90, 'default', 'User Check In', NULL, 'checkin', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"20:26\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-17 13:26:00', '2024-07-17 13:26:00'),
(91, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"09:54\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-18 02:54:35', '2024-07-18 02:54:35'),
(92, 'default', 'User Check In', NULL, 'checkin', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"10:11\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-18 03:11:03', '2024-07-18 03:11:03'),
(93, 'default', 'User Qrin', NULL, 'Qrin', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"10:16\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-18 03:16:55', '2024-07-18 03:16:55'),
(94, 'default', 'User Qrin', NULL, 'Qrin', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"10:56\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-18 03:56:53', '2024-07-18 03:56:53'),
(95, 'default', 'User Qrout', NULL, 'Qrout', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"10:57\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-18 03:57:15', '2024-07-18 03:57:15'),
(96, 'default', 'User Logout', NULL, 'logout', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"11:25\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-18 04:25:42', '2024-07-18 04:25:42'),
(97, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"11:26\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-18 04:26:02', '2024-07-18 04:26:02'),
(98, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"11:57\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-18 04:57:11', '2024-07-18 04:57:11'),
(99, 'default', 'User Qrin', NULL, 'Qrin', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"12:04\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-18 05:04:25', '2024-07-18 05:04:25'),
(100, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"12:59\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-18 05:59:01', '2024-07-18 05:59:01'),
(101, 'default', 'User Qrin', NULL, 'Qrin', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"12:59\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-18 05:59:46', '2024-07-18 05:59:46'),
(102, 'default', 'User Qrin', NULL, 'Qrin', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"13:46\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-18 06:46:36', '2024-07-18 06:46:36'),
(103, 'default', 'User Qrout', NULL, 'Qrout', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"13:50\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-18 06:50:39', '2024-07-18 06:50:39'),
(104, 'default', 'User Logout', NULL, 'logout', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"13:55\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-18 06:55:48', '2024-07-18 06:55:48'),
(105, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"13:56\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-18 06:56:17', '2024-07-18 06:56:17'),
(106, 'default', 'User Logout', NULL, 'logout', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"14:14\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-18 07:14:11', '2024-07-18 07:14:11'),
(107, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"14:14\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-18 07:14:40', '2024-07-18 07:14:40'),
(108, 'default', 'User Update Face Data', NULL, 'updateFace', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"14:16\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-18 07:16:01', '2024-07-18 07:16:01'),
(109, 'default', 'User Check Out', NULL, 'checkout', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"14:26\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-18 07:26:14', '2024-07-18 07:26:14'),
(110, 'default', 'User Check In', NULL, 'checkin', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"14:50\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-18 07:50:06', '2024-07-18 07:50:06'),
(111, 'default', 'User Qrin', NULL, 'Qrin', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"15:17\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-18 08:17:57', '2024-07-18 08:17:57'),
(112, 'default', 'User Qrout', NULL, 'Qrout', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"15:18\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-18 08:18:28', '2024-07-18 08:18:28'),
(113, 'default', 'User Qrin', NULL, 'Qrin', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"15:19\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-18 08:19:18', '2024-07-18 08:19:18'),
(114, 'default', 'User Qrout', NULL, 'Qrout', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"15:19\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-18 08:19:34', '2024-07-18 08:19:34'),
(115, 'default', 'User Logout', NULL, 'logout', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"16:00\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-18 09:00:39', '2024-07-18 09:00:39'),
(116, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"16:01\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-18 09:01:04', '2024-07-18 09:01:04'),
(117, 'default', 'User Post Journal', NULL, 'postJournal', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"16:21\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-18 09:21:23', '2024-07-18 09:21:23'),
(118, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"13:45\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-19 06:45:47', '2024-07-19 06:45:47'),
(119, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"14:31\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-19 07:31:41', '2024-07-19 07:31:41'),
(120, 'default', 'User Check In', NULL, 'checkin', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"14:57\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-19 07:57:30', '2024-07-19 07:57:30'),
(121, 'default', 'User made a leave request', NULL, 'makePermission', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"17:59\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-19 10:59:58', '2024-07-19 10:59:58'),
(122, 'default', 'User Qrin', NULL, 'Qrin', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"18:28\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-19 11:28:19', '2024-07-19 11:28:19'),
(123, 'default', 'User Update Profile', NULL, 'updateProfile', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"20:34\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-19 13:34:11', '2024-07-19 13:34:11'),
(124, 'default', 'User Logout', NULL, 'logout', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"20:38\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-19 13:38:31', '2024-07-19 13:38:31'),
(125, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"20:51\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-19 13:51:04', '2024-07-19 13:51:04'),
(126, 'default', 'User Logout', NULL, 'logout', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"21:02\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-19 14:02:09', '2024-07-19 14:02:09'),
(127, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"21:02\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-19 14:02:38', '2024-07-19 14:02:38'),
(128, 'default', 'User Update Profile', NULL, 'updateProfile', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"21:05\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-19 14:05:55', '2024-07-19 14:05:55'),
(129, 'default', 'User Logout', NULL, 'logout', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"21:06\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-19 14:06:16', '2024-07-19 14:06:16'),
(130, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"21:06\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-19 14:06:39', '2024-07-19 14:06:39'),
(131, 'default', 'User Post Journal', NULL, 'postJournal', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"21:11\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-19 14:11:56', '2024-07-19 14:11:56'),
(132, 'default', 'User made a leave request', NULL, 'makePermission', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"21:12\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-19 14:12:56', '2024-07-19 14:12:56'),
(133, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"10:16\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-22 03:16:17', '2024-07-22 03:16:17'),
(134, 'default', 'User Check In', NULL, 'checkin', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"10:17\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-22 03:17:12', '2024-07-22 03:17:12'),
(135, 'default', 'User Qrin', NULL, 'Qrin', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"10:22\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-22 03:22:18', '2024-07-22 03:22:18'),
(136, 'default', 'User Qrout', NULL, 'Qrout', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"10:24\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-22 03:24:55', '2024-07-22 03:24:55'),
(137, 'default', 'User Update Profile', NULL, 'updateProfile', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"11:08\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-22 04:08:14', '2024-07-22 04:08:14'),
(138, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"11:18\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-22 04:18:30', '2024-07-22 04:18:30'),
(139, 'default', 'User Update Profile', NULL, 'updateProfile', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"11:19\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-22 04:19:23', '2024-07-22 04:19:23'),
(140, 'default', 'User Update Profile', NULL, 'updateProfile', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"11:22\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-22 04:22:41', '2024-07-22 04:22:41'),
(141, 'default', 'User Update Profile', NULL, 'updateProfile', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"11:24\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-22 04:24:25', '2024-07-22 04:24:25'),
(142, 'default', 'User Update Profile', NULL, 'updateProfile', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"11:32\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-22 04:32:03', '2024-07-22 04:32:03'),
(143, 'default', 'User Update Profile', NULL, 'updateProfile', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"11:32\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-22 04:32:06', '2024-07-22 04:32:06'),
(144, 'default', 'User Update Profile', NULL, 'updateProfile', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"11:42\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-22 04:42:29', '2024-07-22 04:42:29'),
(145, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"11:42\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-22 04:42:40', '2024-07-22 04:42:40'),
(146, 'default', 'User Logout', NULL, 'logout', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"11:54\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-22 04:54:58', '2024-07-22 04:54:58'),
(147, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"11:55\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-22 04:55:19', '2024-07-22 04:55:19'),
(148, 'default', 'User Update Profile', NULL, 'updateProfile', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"11:55\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-22 04:55:44', '2024-07-22 04:55:44'),
(149, 'default', 'User Update Profile', NULL, 'updateProfile', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"13:12\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-22 06:12:10', '2024-07-22 06:12:10'),
(150, 'default', 'User Logout', NULL, 'logout', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"13:12\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-22 06:12:18', '2024-07-22 06:12:18'),
(151, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"13:12\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-22 06:12:38', '2024-07-22 06:12:38'),
(152, 'default', 'User Update Profile', NULL, 'updateProfile', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"13:13\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-22 06:13:10', '2024-07-22 06:13:10'),
(153, 'default', 'User Logout', NULL, 'logout', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"13:13\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-22 06:13:13', '2024-07-22 06:13:13'),
(154, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"13:13\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-22 06:13:29', '2024-07-22 06:13:29'),
(155, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"15:18\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-22 08:18:26', '2024-07-22 08:18:26'),
(156, 'default', 'User Check In', NULL, 'checkin', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"16:34\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-22 09:34:28', '2024-07-22 09:34:28'),
(157, 'default', 'User Qrin', NULL, 'Qrin', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"16:36\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-22 09:36:17', '2024-07-22 09:36:17'),
(158, 'default', 'User Qrin', NULL, 'Qrin', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"16:36\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-22 09:36:19', '2024-07-22 09:36:19'),
(159, 'default', 'User Qrin', NULL, 'Qrin', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"16:56\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-22 09:56:54', '2024-07-22 09:56:54'),
(160, 'default', 'User Logout', NULL, 'logout', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"17:16\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-22 10:16:35', '2024-07-22 10:16:35'),
(161, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"17:17\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-22 10:17:06', '2024-07-22 10:17:06'),
(162, 'default', 'User Check Out', NULL, 'checkout', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"17:22\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-22 10:22:58', '2024-07-22 10:22:58'),
(163, 'default', 'User Qrin', NULL, 'Qrin', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"20:49\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-22 13:49:44', '2024-07-22 13:49:44'),
(164, 'default', 'User Qrin', NULL, 'Qrin', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"20:51\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-22 13:51:34', '2024-07-22 13:51:34'),
(165, 'default', 'User Qrin', NULL, 'Qrin', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"20:51\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-22 13:51:43', '2024-07-22 13:51:43'),
(166, 'default', 'User Qrin', NULL, 'Qrin', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"20:51\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-22 13:51:50', '2024-07-22 13:51:50'),
(167, 'default', 'User Qrin', NULL, 'Qrin', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"20:51\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-22 13:51:59', '2024-07-22 13:51:59'),
(168, 'default', 'User Qrin', NULL, 'Qrin', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"20:52\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-22 13:52:04', '2024-07-22 13:52:04'),
(169, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"09:45\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-23 02:45:44', '2024-07-23 02:45:44'),
(170, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 5, '{\"ip\": \"127.0.0.1\", \"time\": \"09:54\", \"user\": \"student_Xr2VB\"}', NULL, '2024-07-23 02:54:00', '2024-07-23 02:54:00'),
(171, 'default', 'User Check In', NULL, 'checkin', NULL, 'App\\Models\\User', 5, '{\"ip\": \"127.0.0.1\", \"time\": \"09:54\", \"user\": \"student_Xr2VB\"}', NULL, '2024-07-23 02:54:24', '2024-07-23 02:54:24'),
(172, 'default', 'User Check In', NULL, 'checkin', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"10:05\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-23 03:05:20', '2024-07-23 03:05:20'),
(173, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"10:07\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-23 03:07:09', '2024-07-23 03:07:09'),
(174, 'default', 'User Logout', NULL, 'logout', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"10:11\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-23 03:11:31', '2024-07-23 03:11:31'),
(175, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"10:11\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-23 03:11:53', '2024-07-23 03:11:53'),
(176, 'default', 'User Update Face Data', NULL, 'updateFace', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"10:12\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-23 03:12:24', '2024-07-23 03:12:24'),
(177, 'default', 'User Check Out', NULL, 'checkout', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"10:12\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-23 03:12:42', '2024-07-23 03:12:42'),
(178, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"10:23\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-23 03:23:12', '2024-07-23 03:23:12'),
(179, 'default', 'User Logout', NULL, 'logout', NULL, 'App\\Models\\User', 5, '{\"ip\": \"127.0.0.1\", \"time\": \"10:23\", \"user\": \"student_Xr2VB\"}', NULL, '2024-07-23 03:23:19', '2024-07-23 03:23:19'),
(180, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"10:25\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-23 03:25:07', '2024-07-23 03:25:07'),
(181, 'default', 'User Check In', NULL, 'checkin', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"10:25\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-23 03:25:17', '2024-07-23 03:25:17'),
(182, 'default', 'User Qrout', NULL, 'Qrout', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"10:26\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-23 03:26:22', '2024-07-23 03:26:22'),
(183, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"10:31\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-23 03:31:36', '2024-07-23 03:31:36'),
(184, 'default', 'User Update Profile', NULL, 'updateProfile', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"10:33\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-23 03:33:06', '2024-07-23 03:33:06'),
(185, 'default', 'User Logout', NULL, 'logout', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"10:33\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-23 03:33:11', '2024-07-23 03:33:11'),
(186, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"10:33\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-23 03:33:25', '2024-07-23 03:33:25'),
(187, 'default', 'User Logout', NULL, 'logout', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"10:37\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-23 03:37:48', '2024-07-23 03:37:48'),
(188, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 123, '{\"ip\": \"127.0.0.1\", \"time\": \"10:38\", \"user\": \"aubree-murray_5XvOt\"}', NULL, '2024-07-23 03:38:51', '2024-07-23 03:38:51'),
(189, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"10:39\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-23 03:39:17', '2024-07-23 03:39:17'),
(190, 'default', 'User Check In', NULL, 'checkin', NULL, 'App\\Models\\User', 123, '{\"ip\": \"127.0.0.1\", \"time\": \"10:48\", \"user\": \"aubree-murray_5XvOt\"}', NULL, '2024-07-23 03:48:03', '2024-07-23 03:48:03'),
(191, 'default', 'User Logout', NULL, 'logout', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"10:51\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-23 03:51:49', '2024-07-23 03:51:49'),
(192, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"10:52\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-23 03:52:05', '2024-07-23 03:52:05'),
(193, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"11:37\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-23 04:37:03', '2024-07-23 04:37:03'),
(194, 'default', 'User Logout', NULL, 'logout', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"11:55\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-23 04:55:27', '2024-07-23 04:55:27'),
(195, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"11:57\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-23 04:57:43', '2024-07-23 04:57:43'),
(196, 'default', 'User Logout', NULL, 'logout', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"13:30\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-23 06:30:01', '2024-07-23 06:30:01'),
(197, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 5, '{\"ip\": \"127.0.0.1\", \"time\": \"13:31\", \"user\": \"student_Xr2VB\"}', NULL, '2024-07-23 06:31:19', '2024-07-23 06:31:19'),
(198, 'default', 'User Update New Password', NULL, 'updatePassword', NULL, 'App\\Models\\User', 5, '{\"ip\": \"127.0.0.1\", \"time\": \"13:45\", \"user\": \"student_Xr2VB\"}', NULL, '2024-07-23 06:45:29', '2024-07-23 06:45:29'),
(199, 'default', 'User Logout', NULL, 'logout', NULL, 'App\\Models\\User', 5, '{\"ip\": \"127.0.0.1\", \"time\": \"13:50\", \"user\": \"student_Xr2VB\"}', NULL, '2024-07-23 06:50:19', '2024-07-23 06:50:19'),
(200, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 5, '{\"ip\": \"127.0.0.1\", \"time\": \"13:50\", \"user\": \"student_Xr2VB\"}', NULL, '2024-07-23 06:50:39', '2024-07-23 06:50:39'),
(201, 'default', 'User Update Profile', NULL, 'updateProfile', NULL, 'App\\Models\\User', 5, '{\"ip\": \"127.0.0.1\", \"time\": \"13:51\", \"user\": \"student_Xr2VB\"}', NULL, '2024-07-23 06:51:03', '2024-07-23 06:51:03'),
(202, 'default', 'User Logout', NULL, 'logout', NULL, 'App\\Models\\User', 5, '{\"ip\": \"127.0.0.1\", \"time\": \"13:51\", \"user\": \"student_Xr2VB\"}', NULL, '2024-07-23 06:51:08', '2024-07-23 06:51:08'),
(203, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 5, '{\"ip\": \"127.0.0.1\", \"time\": \"13:51\", \"user\": \"student_Xr2VB\"}', NULL, '2024-07-23 06:51:32', '2024-07-23 06:51:32'),
(204, 'default', 'User Logout', NULL, 'logout', NULL, 'App\\Models\\User', 123, '{\"ip\": \"127.0.0.1\", \"time\": \"13:53\", \"user\": \"aubree-murray_5XvOt\"}', NULL, '2024-07-23 06:53:16', '2024-07-23 06:53:16'),
(205, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 145, '{\"ip\": \"127.0.0.1\", \"time\": \"13:53\", \"user\": \"intisher_dGxgk\"}', NULL, '2024-07-23 06:53:42', '2024-07-23 06:53:42'),
(206, 'default', 'User Check In', NULL, 'checkin', NULL, 'App\\Models\\User', 145, '{\"ip\": \"127.0.0.1\", \"time\": \"14:05\", \"user\": \"intisher_dGxgk\"}', NULL, '2024-07-23 07:05:47', '2024-07-23 07:05:47'),
(207, 'default', 'User made a leave request', NULL, 'makePermission', NULL, 'App\\Models\\User', 5, '{\"ip\": \"127.0.0.1\", \"time\": \"14:12\", \"user\": \"student_Xr2VB\"}', NULL, '2024-07-23 07:12:39', '2024-07-23 07:12:39'),
(208, 'default', 'User made a leave request', NULL, 'makePermission', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"14:14\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-23 07:14:46', '2024-07-23 07:14:46'),
(209, 'default', 'User Logout', NULL, 'logout', NULL, 'App\\Models\\User', 5, '{\"ip\": \"127.0.0.1\", \"time\": \"14:26\", \"user\": \"student_Xr2VB\"}', NULL, '2024-07-23 07:26:06', '2024-07-23 07:26:06'),
(210, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 5, '{\"ip\": \"127.0.0.1\", \"time\": \"14:27\", \"user\": \"student_Xr2VB\"}', NULL, '2024-07-23 07:27:07', '2024-07-23 07:27:07'),
(211, 'default', 'User Update Face Data', NULL, 'updateFace', NULL, 'App\\Models\\User', 5, '{\"ip\": \"127.0.0.1\", \"time\": \"14:28\", \"user\": \"student_Xr2VB\"}', NULL, '2024-07-23 07:28:21', '2024-07-23 07:28:21'),
(212, 'default', 'User Logout', NULL, 'logout', NULL, 'App\\Models\\User', 5, '{\"ip\": \"127.0.0.1\", \"time\": \"14:29\", \"user\": \"student_Xr2VB\"}', NULL, '2024-07-23 07:29:21', '2024-07-23 07:29:21'),
(213, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 5, '{\"ip\": \"127.0.0.1\", \"time\": \"14:30\", \"user\": \"student_Xr2VB\"}', NULL, '2024-07-23 07:30:15', '2024-07-23 07:30:15'),
(214, 'default', 'User Logout', NULL, 'logout', NULL, 'App\\Models\\User', 5, '{\"ip\": \"127.0.0.1\", \"time\": \"14:51\", \"user\": \"student_OngD5\"}', NULL, '2024-07-23 07:51:57', '2024-07-23 07:51:57'),
(215, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 5, '{\"ip\": \"127.0.0.1\", \"time\": \"14:53\", \"user\": \"student_OngD5\"}', NULL, '2024-07-23 07:53:13', '2024-07-23 07:53:13'),
(216, 'default', 'User Update Face Data', NULL, 'updateFace', NULL, 'App\\Models\\User', 5, '{\"ip\": \"127.0.0.1\", \"time\": \"14:54\", \"user\": \"student_OngD5\"}', NULL, '2024-07-23 07:54:13', '2024-07-23 07:54:13'),
(217, 'default', 'User Check In', NULL, 'checkin', NULL, 'App\\Models\\User', 5, '{\"ip\": \"127.0.0.1\", \"time\": \"14:56\", \"user\": \"student_OngD5\"}', NULL, '2024-07-23 07:56:33', '2024-07-23 07:56:33'),
(218, 'default', 'User Logout', NULL, 'logout', NULL, 'App\\Models\\User', 5, '{\"ip\": \"127.0.0.1\", \"time\": \"15:02\", \"user\": \"student_OngD5\"}', NULL, '2024-07-23 08:02:10', '2024-07-23 08:02:10'),
(219, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 5, '{\"ip\": \"127.0.0.1\", \"time\": \"15:02\", \"user\": \"student_OngD5\"}', NULL, '2024-07-23 08:02:36', '2024-07-23 08:02:36'),
(220, 'default', 'User Update Face Data', NULL, 'updateFace', NULL, 'App\\Models\\User', 5, '{\"ip\": \"127.0.0.1\", \"time\": \"15:04\", \"user\": \"student_OngD5\"}', NULL, '2024-07-23 08:04:17', '2024-07-23 08:04:17'),
(221, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 5, '{\"ip\": \"127.0.0.1\", \"time\": \"15:17\", \"user\": \"student_OngD5\"}', NULL, '2024-07-23 08:17:04', '2024-07-23 08:17:04'),
(222, 'default', 'User Logout', NULL, 'logout', NULL, 'App\\Models\\User', 5, '{\"ip\": \"127.0.0.1\", \"time\": \"15:21\", \"user\": \"student_OngD5\"}', NULL, '2024-07-23 08:21:30', '2024-07-23 08:21:30'),
(223, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 5, '{\"ip\": \"127.0.0.1\", \"time\": \"15:21\", \"user\": \"student_OngD5\"}', NULL, '2024-07-23 08:21:48', '2024-07-23 08:21:48'),
(224, 'default', 'User Update Face Data', NULL, 'updateFace', NULL, 'App\\Models\\User', 5, '{\"ip\": \"127.0.0.1\", \"time\": \"15:22\", \"user\": \"student_OngD5\"}', NULL, '2024-07-23 08:22:36', '2024-07-23 08:22:36'),
(225, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"17:15\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-23 10:15:08', '2024-07-23 10:15:08'),
(226, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"17:17\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-23 10:17:56', '2024-07-23 10:17:56'),
(227, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 3, '{\"ip\": \"127.0.0.1\", \"time\": \"20:36\", \"user\": \"teacher_QXqvc\"}', NULL, '2024-07-23 13:36:03', '2024-07-23 13:36:03'),
(228, 'default', 'User made a leave request', NULL, 'makePermission', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.53.125\",\"user\":\"student_xjmkd\",\"time\":\"21:14\"}', NULL, '2024-07-23 14:14:53', '2024-07-23 14:14:53'),
(229, 'default', 'User Logout', NULL, 'logout', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.53.125\",\"user\":\"student_xjmkd\",\"time\":\"21:15\"}', NULL, '2024-07-23 14:15:52', '2024-07-23 14:15:52'),
(230, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.53.125\",\"user\":\"student_xjmkd\",\"time\":\"21:16\"}', NULL, '2024-07-23 14:16:19', '2024-07-23 14:16:19'),
(231, 'default', 'User Update Face Data', NULL, 'updateFace', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.53.125\",\"user\":\"student_xjmkd\",\"time\":\"21:17\"}', NULL, '2024-07-23 14:17:01', '2024-07-23 14:17:01'),
(232, 'default', 'User Check In', NULL, 'checkin', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.53.125\",\"user\":\"student_xjmkd\",\"time\":\"21:18\"}', NULL, '2024-07-23 14:18:10', '2024-07-23 14:18:10'),
(233, 'default', 'User Check Out', NULL, 'checkout', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.53.125\",\"user\":\"student_xjmkd\",\"time\":\"21:18\"}', NULL, '2024-07-23 14:18:33', '2024-07-23 14:18:33'),
(234, 'default', 'User Update Face Data', NULL, 'updateFace', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.53.125\",\"user\":\"teacher_QXqvc\",\"time\":\"21:24\"}', NULL, '2024-07-23 14:24:27', '2024-07-23 14:24:27'),
(235, 'default', 'User Check In', NULL, 'checkin', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.53.125\",\"user\":\"teacher_QXqvc\",\"time\":\"21:26\"}', NULL, '2024-07-23 14:26:04', '2024-07-23 14:26:04'),
(236, 'default', 'User Check Out', NULL, 'checkout', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.53.125\",\"user\":\"teacher_QXqvc\",\"time\":\"21:28\"}', NULL, '2024-07-23 14:28:14', '2024-07-23 14:28:14'),
(237, 'default', 'User Logout', NULL, 'logout', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.53.125\",\"user\":\"teacher_QXqvc\",\"time\":\"21:28\"}', NULL, '2024-07-23 14:28:51', '2024-07-23 14:28:51'),
(238, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.53.125\",\"user\":\"teacher_QXqvc\",\"time\":\"21:29\"}', NULL, '2024-07-23 14:29:38', '2024-07-23 14:29:38'),
(239, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.53.125\",\"user\":\"teacher_QXqvc\",\"time\":\"23:26\"}', NULL, '2024-07-23 16:26:13', '2024-07-23 16:26:13'),
(240, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.53.125\",\"user\":\"teacher_QXqvc\",\"time\":\"00:14\"}', NULL, '2024-07-23 17:14:16', '2024-07-23 17:14:16'),
(241, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.53.125\",\"user\":\"teacher_QXqvc\",\"time\":\"00:19\"}', NULL, '2024-07-23 17:19:14', '2024-07-23 17:19:14'),
(242, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_QXqvc\",\"time\":\"09:06\"}', NULL, '2024-07-24 02:06:26', '2024-07-24 02:06:26'),
(243, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_QXqvc\",\"time\":\"09:12\"}', NULL, '2024-07-24 02:12:23', '2024-07-24 02:12:23'),
(244, 'default', 'User Logout', NULL, 'logout', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_QXqvc\",\"time\":\"09:12\"}', NULL, '2024-07-24 02:12:52', '2024-07-24 02:12:52'),
(245, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"09:13\"}', NULL, '2024-07-24 02:13:16', '2024-07-24 02:13:16'),
(246, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"09:37\"}', NULL, '2024-07-24 02:37:39', '2024-07-24 02:37:39'),
(247, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"09:38\"}', NULL, '2024-07-24 02:38:28', '2024-07-24 02:38:28'),
(248, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"09:39\"}', NULL, '2024-07-24 02:39:13', '2024-07-24 02:39:13'),
(249, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"10:17\"}', NULL, '2024-07-24 03:17:25', '2024-07-24 03:17:25'),
(250, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"10:17\"}', NULL, '2024-07-24 03:17:48', '2024-07-24 03:17:48'),
(251, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"10:18\"}', NULL, '2024-07-24 03:18:21', '2024-07-24 03:18:21'),
(252, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"10:20\"}', NULL, '2024-07-24 03:20:39', '2024-07-24 03:20:39'),
(253, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"10:21\"}', NULL, '2024-07-24 03:21:28', '2024-07-24 03:21:28'),
(254, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"10:23\"}', NULL, '2024-07-24 03:23:44', '2024-07-24 03:23:44'),
(255, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_QXqvc\",\"time\":\"10:25\"}', NULL, '2024-07-24 03:25:03', '2024-07-24 03:25:03'),
(256, 'default', 'User Logout', NULL, 'logout', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_QXqvc\",\"time\":\"10:25\"}', NULL, '2024-07-24 03:25:32', '2024-07-24 03:25:32'),
(257, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_QXqvc\",\"time\":\"10:25\"}', NULL, '2024-07-24 03:25:52', '2024-07-24 03:25:52'),
(258, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_QXqvc\",\"time\":\"10:28\"}', NULL, '2024-07-24 03:28:50', '2024-07-24 03:28:50'),
(259, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_QXqvc\",\"time\":\"10:32\"}', NULL, '2024-07-24 03:32:17', '2024-07-24 03:32:17'),
(260, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_QXqvc\",\"time\":\"10:36\"}', NULL, '2024-07-24 03:36:15', '2024-07-24 03:36:15'),
(261, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"10:40\"}', NULL, '2024-07-24 03:40:18', '2024-07-24 03:40:18'),
(262, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"10:48\"}', NULL, '2024-07-24 03:48:34', '2024-07-24 03:48:34'),
(263, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"10:53\"}', NULL, '2024-07-24 03:53:50', '2024-07-24 03:53:50'),
(264, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"10:56\"}', NULL, '2024-07-24 03:56:20', '2024-07-24 03:56:20'),
(265, 'default', 'User Check In', NULL, 'checkin', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"10:59\"}', NULL, '2024-07-24 03:59:07', '2024-07-24 03:59:07'),
(266, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"11:23\"}', NULL, '2024-07-24 04:23:46', '2024-07-24 04:23:46'),
(267, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"11:26\"}', NULL, '2024-07-24 04:26:33', '2024-07-24 04:26:33'),
(268, 'default', 'User Logout', NULL, 'logout', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"11:31\"}', NULL, '2024-07-24 04:31:41', '2024-07-24 04:31:41'),
(269, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"12:55\"}', NULL, '2024-07-24 05:55:02', '2024-07-24 05:55:02'),
(270, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"12:56\"}', NULL, '2024-07-24 05:56:33', '2024-07-24 05:56:33'),
(271, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"13:21\"}', NULL, '2024-07-24 06:21:16', '2024-07-24 06:21:16'),
(272, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"13:22\"}', NULL, '2024-07-24 06:22:32', '2024-07-24 06:22:32'),
(273, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"13:29\"}', NULL, '2024-07-24 06:29:48', '2024-07-24 06:29:48'),
(274, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"13:32\"}', NULL, '2024-07-24 06:32:04', '2024-07-24 06:32:04'),
(275, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"13:35\"}', NULL, '2024-07-24 06:35:11', '2024-07-24 06:35:11'),
(276, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"13:39\"}', NULL, '2024-07-24 06:39:53', '2024-07-24 06:39:53'),
(277, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"13:40\"}', NULL, '2024-07-24 06:40:33', '2024-07-24 06:40:33'),
(278, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"14:06\"}', NULL, '2024-07-24 07:06:33', '2024-07-24 07:06:33'),
(279, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"14:07\"}', NULL, '2024-07-24 07:07:31', '2024-07-24 07:07:31'),
(280, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_QXqvc\",\"time\":\"14:47\"}', NULL, '2024-07-24 07:47:00', '2024-07-24 07:47:00'),
(281, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_QXqvc\",\"time\":\"14:48\"}', NULL, '2024-07-24 07:48:47', '2024-07-24 07:48:47'),
(282, 'default', 'User Check In', NULL, 'checkin', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_QXqvc\",\"time\":\"14:50\"}', NULL, '2024-07-24 07:50:23', '2024-07-24 07:50:23'),
(283, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_QXqvc\",\"time\":\"15:08\"}', NULL, '2024-07-24 08:08:26', '2024-07-24 08:08:26'),
(284, 'default', 'User Qrin', NULL, 'Qrin', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_zrBdz\",\"time\":\"15:16\"}', NULL, '2024-07-24 08:16:55', '2024-07-24 08:16:55'),
(285, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_zrBdz\",\"time\":\"15:19\"}', NULL, '2024-07-24 08:19:11', '2024-07-24 08:19:11'),
(286, 'default', 'User Qrout', NULL, 'Qrout', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_zrBdz\",\"time\":\"15:20\"}', NULL, '2024-07-24 08:20:35', '2024-07-24 08:20:35'),
(287, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_zrBdz\",\"time\":\"15:23\"}', NULL, '2024-07-24 08:23:36', '2024-07-24 08:23:36'),
(288, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_zrBdz\",\"time\":\"15:24\"}', NULL, '2024-07-24 08:24:02', '2024-07-24 08:24:02'),
(289, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_zrBdz\",\"time\":\"15:27\"}', NULL, '2024-07-24 08:27:15', '2024-07-24 08:27:15'),
(290, 'default', 'User Logout', NULL, 'logout', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_zrBdz\",\"time\":\"15:27\"}', NULL, '2024-07-24 08:27:36', '2024-07-24 08:27:36'),
(291, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"15:28\"}', NULL, '2024-07-24 08:28:39', '2024-07-24 08:28:39'),
(292, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_zrBdz\",\"time\":\"16:06\"}', NULL, '2024-07-24 09:06:26', '2024-07-24 09:06:26'),
(293, 'default', 'User Update Profile', NULL, 'updateProfile', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_zrBdz\",\"time\":\"16:07\"}', NULL, '2024-07-24 09:07:16', '2024-07-24 09:07:16'),
(294, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"16:20\"}', NULL, '2024-07-24 09:20:44', '2024-07-24 09:20:44'),
(295, 'default', 'User Post Journal', NULL, 'postJournal', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_zrBdz\",\"time\":\"17:02\"}', NULL, '2024-07-24 10:02:23', '2024-07-24 10:02:23'),
(296, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_zrBdz\",\"time\":\"17:03\"}', NULL, '2024-07-24 10:03:57', '2024-07-24 10:03:57'),
(297, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_zrBdz\",\"time\":\"18:03\"}', NULL, '2024-07-24 11:03:22', '2024-07-24 11:03:22'),
(298, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_zrBdz\",\"time\":\"18:04\"}', NULL, '2024-07-24 11:04:59', '2024-07-24 11:04:59'),
(299, 'default', 'User Update Profile', NULL, 'updateProfile', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_zrBdz\",\"time\":\"18:53\"}', NULL, '2024-07-24 11:53:51', '2024-07-24 11:53:51'),
(300, 'default', 'User Logout', NULL, 'logout', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_zrBdz\",\"time\":\"18:53\"}', NULL, '2024-07-24 11:53:53', '2024-07-24 11:53:53'),
(301, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_zrBdz\",\"time\":\"18:54\"}', NULL, '2024-07-24 11:54:16', '2024-07-24 11:54:16'),
(302, 'default', 'User Logout', NULL, 'logout', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_zrBdz\",\"time\":\"18:59\"}', NULL, '2024-07-24 11:59:46', '2024-07-24 11:59:46'),
(303, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_zrBdz\",\"time\":\"19:00\"}', NULL, '2024-07-24 12:00:04', '2024-07-24 12:00:04'),
(304, 'default', 'User Logout', NULL, 'logout', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_zrBdz\",\"time\":\"19:01\"}', NULL, '2024-07-24 12:01:09', '2024-07-24 12:01:09'),
(305, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_zrBdz\",\"time\":\"19:01\"}', NULL, '2024-07-24 12:01:38', '2024-07-24 12:01:38'),
(306, 'default', 'User Check Out', NULL, 'checkout', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_zrBdz\",\"time\":\"19:02\"}', NULL, '2024-07-24 12:02:45', '2024-07-24 12:02:45'),
(307, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_zrBdz\",\"time\":\"19:10\"}', NULL, '2024-07-24 12:10:30', '2024-07-24 12:10:30'),
(308, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"19:57\"}', NULL, '2024-07-24 12:57:15', '2024-07-24 12:57:15'),
(309, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"20:04\"}', NULL, '2024-07-24 13:04:34', '2024-07-24 13:04:34'),
(310, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"20:07\"}', NULL, '2024-07-24 13:07:13', '2024-07-24 13:07:13'),
(311, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"20:08\"}', NULL, '2024-07-24 13:08:09', '2024-07-24 13:08:09'),
(312, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_gYybp\",\"time\":\"10:45\"}', NULL, '2024-07-25 03:45:34', '2024-07-25 03:45:34'),
(313, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_gYybp\",\"time\":\"10:47\"}', NULL, '2024-07-25 03:47:41', '2024-07-25 03:47:41'),
(314, 'default', 'User Logout', NULL, 'logout', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_gYybp\",\"time\":\"10:49\"}', NULL, '2024-07-25 03:49:25', '2024-07-25 03:49:25'),
(315, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_gYybp\",\"time\":\"10:49\"}', NULL, '2024-07-25 03:49:57', '2024-07-25 03:49:57');
INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `event`, `subject_id`, `causer_type`, `causer_id`, `properties`, `batch_uuid`, `created_at`, `updated_at`) VALUES
(316, 'default', 'User Update Face Data', NULL, 'updateFace', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_gYybp\",\"time\":\"10:50\"}', NULL, '2024-07-25 03:50:42', '2024-07-25 03:50:42'),
(317, 'default', 'User Check In', NULL, 'checkin', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_gYybp\",\"time\":\"10:51\"}', NULL, '2024-07-25 03:51:33', '2024-07-25 03:51:33'),
(318, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_gYybp\",\"time\":\"14:11\"}', NULL, '2024-07-25 07:11:25', '2024-07-25 07:11:25'),
(319, 'default', 'User Logout', NULL, 'logout', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_gYybp\",\"time\":\"14:34\"}', NULL, '2024-07-25 07:34:35', '2024-07-25 07:34:35'),
(320, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_gYybp\",\"time\":\"14:45\"}', NULL, '2024-07-25 07:45:12', '2024-07-25 07:45:12'),
(321, 'default', 'User Logout', NULL, 'logout', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_gYybp\",\"time\":\"15:11\"}', NULL, '2024-07-25 08:11:56', '2024-07-25 08:11:56'),
(322, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_gYybp\",\"time\":\"15:12\"}', NULL, '2024-07-25 08:12:39', '2024-07-25 08:12:39'),
(323, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"16:06\"}', NULL, '2024-07-25 09:06:48', '2024-07-25 09:06:48'),
(324, 'default', 'User Check In', NULL, 'checkin', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"16:08\"}', NULL, '2024-07-25 09:08:35', '2024-07-25 09:08:35'),
(325, 'default', 'User Check Out', NULL, 'checkout', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"16:29\"}', NULL, '2024-07-25 09:29:28', '2024-07-25 09:29:28'),
(326, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"16:33\"}', NULL, '2024-07-25 09:33:26', '2024-07-25 09:33:26'),
(327, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"16:33\"}', NULL, '2024-07-25 09:33:50', '2024-07-25 09:33:50'),
(328, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"16:35\"}', NULL, '2024-07-25 09:35:55', '2024-07-25 09:35:55'),
(329, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_gYybp\",\"time\":\"16:38\"}', NULL, '2024-07-25 09:38:02', '2024-07-25 09:38:02'),
(330, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"16:53\"}', NULL, '2024-07-25 09:53:11', '2024-07-25 09:53:11'),
(331, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 3, '{\"ip\":\"104.28.250.135\",\"user\":\"teacher_gYybp\",\"time\":\"18:15\"}', NULL, '2024-07-25 11:15:03', '2024-07-25 11:15:03'),
(332, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 3, '{\"ip\":\"104.28.250.135\",\"user\":\"teacher_gYybp\",\"time\":\"18:21\"}', NULL, '2024-07-25 11:21:44', '2024-07-25 11:21:44'),
(333, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 3, '{\"ip\":\"104.28.250.135\",\"user\":\"teacher_gYybp\",\"time\":\"18:21\"}', NULL, '2024-07-25 11:21:52', '2024-07-25 11:21:52'),
(334, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_gYybp\",\"time\":\"10:20\"}', NULL, '2024-07-26 03:20:02', '2024-07-26 03:20:02'),
(335, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_gYybp\",\"time\":\"10:20\"}', NULL, '2024-07-26 03:20:50', '2024-07-26 03:20:50'),
(336, 'default', 'User Check In', NULL, 'checkin', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_gYybp\",\"time\":\"10:23\"}', NULL, '2024-07-26 03:23:41', '2024-07-26 03:23:41'),
(337, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_gYybp\",\"time\":\"13:49\"}', NULL, '2024-07-26 06:49:57', '2024-07-26 06:49:57'),
(338, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"14:15\"}', NULL, '2024-07-26 07:15:36', '2024-07-26 07:15:36'),
(339, 'default', 'User Check In', NULL, 'checkin', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"14:16\"}', NULL, '2024-07-26 07:16:56', '2024-07-26 07:16:56'),
(340, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_gYybp\",\"time\":\"14:20\"}', NULL, '2024-07-26 07:20:19', '2024-07-26 07:20:19'),
(341, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_gYybp\",\"time\":\"14:23\"}', NULL, '2024-07-26 07:23:21', '2024-07-26 07:23:21'),
(342, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_gYybp\",\"time\":\"14:28\"}', NULL, '2024-07-26 07:28:22', '2024-07-26 07:28:22'),
(343, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_gYybp\",\"time\":\"14:29\"}', NULL, '2024-07-26 07:29:44', '2024-07-26 07:29:44'),
(344, 'default', 'User Check Out', NULL, 'checkout', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_gYybp\",\"time\":\"14:29\"}', NULL, '2024-07-26 07:29:50', '2024-07-26 07:29:50'),
(345, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"14:39\"}', NULL, '2024-07-26 07:39:30', '2024-07-26 07:39:30'),
(346, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"14:44\"}', NULL, '2024-07-26 07:44:38', '2024-07-26 07:44:38'),
(347, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"14:46\"}', NULL, '2024-07-26 07:46:05', '2024-07-26 07:46:05'),
(348, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"14:51\"}', NULL, '2024-07-26 07:51:10', '2024-07-26 07:51:10'),
(349, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"14:51\"}', NULL, '2024-07-26 07:51:51', '2024-07-26 07:51:51'),
(350, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"14:55\"}', NULL, '2024-07-26 07:55:32', '2024-07-26 07:55:32'),
(351, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"14:58\"}', NULL, '2024-07-26 07:58:09', '2024-07-26 07:58:09'),
(352, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"15:02\"}', NULL, '2024-07-26 08:02:28', '2024-07-26 08:02:28'),
(353, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"15:05\"}', NULL, '2024-07-26 08:05:29', '2024-07-26 08:05:29'),
(354, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"15:07\"}', NULL, '2024-07-26 08:07:49', '2024-07-26 08:07:49'),
(355, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"15:12\"}', NULL, '2024-07-26 08:12:52', '2024-07-26 08:12:52'),
(356, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"15:17\"}', NULL, '2024-07-26 08:17:01', '2024-07-26 08:17:01'),
(357, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"15:19\"}', NULL, '2024-07-26 08:19:16', '2024-07-26 08:19:16'),
(358, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"15:21\"}', NULL, '2024-07-26 08:21:54', '2024-07-26 08:21:54'),
(359, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"16:11\"}', NULL, '2024-07-26 09:11:15', '2024-07-26 09:11:15'),
(360, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_gYybp\",\"time\":\"16:28\"}', NULL, '2024-07-26 09:28:24', '2024-07-26 09:28:24'),
(361, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"16:29\"}', NULL, '2024-07-26 09:29:37', '2024-07-26 09:29:37'),
(362, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"16:34\"}', NULL, '2024-07-26 09:34:39', '2024-07-26 09:34:39'),
(363, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"16:42\"}', NULL, '2024-07-26 09:42:45', '2024-07-26 09:42:45'),
(364, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"16:45\"}', NULL, '2024-07-26 09:45:28', '2024-07-26 09:45:28'),
(365, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"16:51\"}', NULL, '2024-07-26 09:51:48', '2024-07-26 09:51:48'),
(366, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 5, '{\"ip\":\"103.130.18.40\",\"user\":\"student_xjmkd\",\"time\":\"08:41\"}', NULL, '2024-07-27 01:41:07', '2024-07-27 01:41:07'),
(367, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 5, '{\"ip\":\"103.130.18.40\",\"user\":\"student_xjmkd\",\"time\":\"08:45\"}', NULL, '2024-07-27 01:45:04', '2024-07-27 01:45:04'),
(368, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 5, '{\"ip\":\"103.130.18.40\",\"user\":\"student_xjmkd\",\"time\":\"10:56\"}', NULL, '2024-07-27 03:56:11', '2024-07-27 03:56:11'),
(369, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 5, '{\"ip\":\"103.130.18.40\",\"user\":\"student_xjmkd\",\"time\":\"11:33\"}', NULL, '2024-07-27 04:33:30', '2024-07-27 04:33:30'),
(370, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 3, '{\"ip\":\"103.130.18.40\",\"user\":\"teacher_gYybp\",\"time\":\"11:42\"}', NULL, '2024-07-27 04:42:57', '2024-07-27 04:42:57'),
(371, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"14:13\"}', NULL, '2024-07-27 07:13:58', '2024-07-27 07:13:58'),
(372, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"14:15\"}', NULL, '2024-07-27 07:15:04', '2024-07-27 07:15:04'),
(373, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"14:18\"}', NULL, '2024-07-27 07:18:33', '2024-07-27 07:18:33'),
(374, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"14:30\"}', NULL, '2024-07-27 07:30:18', '2024-07-27 07:30:18'),
(375, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"14:51\"}', NULL, '2024-07-27 07:51:33', '2024-07-27 07:51:33'),
(376, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"15:09\"}', NULL, '2024-07-27 08:09:21', '2024-07-27 08:09:21'),
(377, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"10:34\"}', NULL, '2024-07-29 03:34:04', '2024-07-29 03:34:04'),
(378, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"10:38\"}', NULL, '2024-07-29 03:38:25', '2024-07-29 03:38:25'),
(379, 'default', 'User Logout', NULL, 'logout', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"10:41\"}', NULL, '2024-07-29 03:41:42', '2024-07-29 03:41:42'),
(380, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"10:42\"}', NULL, '2024-07-29 03:42:02', '2024-07-29 03:42:02'),
(381, 'default', 'User Logout', NULL, 'logout', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"10:59\"}', NULL, '2024-07-29 03:59:35', '2024-07-29 03:59:35'),
(382, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"10:59\"}', NULL, '2024-07-29 03:59:52', '2024-07-29 03:59:52'),
(383, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_gYybp\",\"time\":\"11:01\"}', NULL, '2024-07-29 04:01:35', '2024-07-29 04:01:35'),
(384, 'default', 'User Logout', NULL, 'logout', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"11:22\"}', NULL, '2024-07-29 04:22:14', '2024-07-29 04:22:14'),
(385, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"11:23\"}', NULL, '2024-07-29 04:23:06', '2024-07-29 04:23:06'),
(386, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_gYybp\",\"time\":\"11:32\"}', NULL, '2024-07-29 04:32:49', '2024-07-29 04:32:49'),
(387, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 5, '{\"ip\":\"125.163.52.140\",\"user\":\"student_xjmkd\",\"time\":\"11:35\"}', NULL, '2024-07-29 04:35:54', '2024-07-29 04:35:54'),
(388, 'default', 'User Update FCM Token', NULL, 'updateFcmToken', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_gYybp\",\"time\":\"11:36\"}', NULL, '2024-07-29 04:36:04', '2024-07-29 04:36:04'),
(389, 'default', 'User Logout', NULL, 'logout', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_gYybp\",\"time\":\"11:36\"}', NULL, '2024-07-29 04:36:12', '2024-07-29 04:36:12'),
(390, 'default', 'User Login', NULL, 'login', NULL, 'App\\Models\\User', 3, '{\"ip\":\"125.163.52.140\",\"user\":\"teacher_gYybp\",\"time\":\"11:36\"}', NULL, '2024-07-29 04:36:31', '2024-07-29 04:36:31');

-- --------------------------------------------------------

--
-- Table structure for table `admission_form_fields`
--

CREATE TABLE `admission_form_fields` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `order` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admission_form_fields`
--

INSERT INTO `admission_form_fields` (`id`, `name`, `status`, `order`, `created_at`, `updated_at`) VALUES
(1, 'name', 1, 1, '2024-03-29 03:16:41', '2024-07-27 03:35:09'),
(2, 'email', 1, 2, '2024-03-29 03:16:41', '2024-07-27 03:35:09'),
(3, 'profile_photo', 1, 3, '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(4, 'date_of_birth', 1, 4, '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(5, 'gender', 1, 5, '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(6, 'course', 1, 6, '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(7, 'phone', 1, 7, '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(8, 'address', 1, 8, '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(9, 'documents', 1, 9, '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(10, 'national_identification_number', 1, 10, '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(11, 'blood_group', 1, 11, '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(12, 'physical_disability', 1, 12, '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(13, 'previous_school_name', 1, 13, '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(14, 'previous_school_year_of_exist', 1, 14, '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(15, 'religion', 1, 15, '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(16, 'bank_name', 1, 16, '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(17, 'bank_account_number', 1, 17, '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(18, 'note', 1, 18, '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(19, 'guardian_name', 1, 19, '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(20, 'guardian_email', 1, 20, '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(21, 'guardian_photo', 1, 21, '2024-03-29 03:16:41', '2024-07-08 10:39:44');

-- --------------------------------------------------------

--
-- Table structure for table `admission_requests`
--

CREATE TABLE `admission_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `national_identification_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blood_group` enum('A+','A-','B+','B-','O+','O-','AB+','AB-') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `physical_disability` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `previous_school_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `previous_school_year_of_exist` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `religion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_account_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guardian_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guardian_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guardian_photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `courses` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `documents` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `isAccept` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `mark` int(11) NOT NULL DEFAULT 0,
  `description` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time DEFAULT NULL,
  `latlon_in` varchar(255) NOT NULL,
  `latlon_out` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `user_id`, `date`, `time_in`, `time_out`, `latlon_in`, `latlon_out`, `created_at`, `updated_at`) VALUES
(15, 5, '2024-07-23', '21:18:10', '21:18:33', '-6.9173105,107.7573945', '-6.9173101,107.7576928', '2024-07-23 14:18:10', '2024-07-23 14:18:33'),
(17, 5, '2024-07-24', '10:59:07', NULL, '-6.917395,107.757505', NULL, '2024-07-24 03:59:07', '2024-07-24 03:59:07'),
(19, 3, '2024-07-25', '10:51:33', NULL, '-6.9175267,107.7574917', NULL, '2024-07-25 03:51:33', '2024-07-25 03:51:33'),
(20, 5, '2024-07-25', '16:08:35', '16:29:28', '-6.9175585,107.7573925', '-6.91764,107.7574517', '2024-07-25 09:08:35', '2024-07-25 09:29:28'),
(21, 3, '2024-07-26', '10:23:41', '14:29:50', '-6.917482,107.7576236', '-6.9176081,107.7575081', '2024-07-26 03:23:41', '2024-07-26 07:29:50');

-- --------------------------------------------------------

--
-- Table structure for table `chat_groups`
--

CREATE TABLE `chat_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chat_groups`
--

INSERT INTO `chat_groups` (`id`, `name`, `description`, `subject_id`, `created_at`, `updated_at`) VALUES
(67, 'MATEMATIKA', 'MATEMATIKA', 67, '2024-07-24 06:21:05', '2024-07-24 06:21:05'),
(68, 'DASAR-DASAR DPIB', 'DASAR-DASAR DPIB', 68, '2024-07-24 06:21:05', '2024-07-24 06:21:05'),
(69, 'BAHASA INGGRIS', 'BAHASA INGGRIS', 69, '2024-07-24 06:21:05', '2024-07-24 06:21:05'),
(70, 'INFORMATIKA', 'INFORMATIKA', 70, '2024-07-24 06:21:05', '2024-07-24 06:21:05'),
(71, 'BK', 'BK', 71, '2024-07-24 06:21:05', '2024-07-24 06:21:05'),
(72, 'PIPAS', 'PIPAS', 72, '2024-07-24 06:21:05', '2024-07-24 06:21:05'),
(73, 'PAIBP', 'PAIBP', 73, '2024-07-24 06:21:05', '2024-07-24 06:21:05'),
(74, 'BAHASA SUNDA', 'BAHASA SUNDA', 74, '2024-07-24 06:21:05', '2024-07-24 06:21:05'),
(75, 'SEJARAH', 'SEJARAH', 75, '2024-07-24 06:21:05', '2024-07-24 06:21:05'),
(76, 'BAHASA INDONESIA', 'BAHASA INDONESIA', 76, '2024-07-24 06:21:05', '2024-07-24 06:21:05'),
(77, 'SENI BUDAYA', 'SENI BUDAYA', 77, '2024-07-24 06:21:05', '2024-07-24 06:21:05'),
(78, 'PANCASILA', 'PANCASILA', 78, '2024-07-24 06:21:05', '2024-07-24 06:21:05'),
(79, 'PJOK', 'PJOK', 79, '2024-07-24 06:21:05', '2024-07-24 06:21:05'),
(105, 'BAHASA INGGRIS', 'BAHASA INGGRIS', 105, '2024-07-24 06:27:26', '2024-07-24 06:27:26'),
(106, 'DASAR DASAR TEKNIK OTOMOTIF', 'DASAR DASAR TEKNIK OTOMOTIF', 106, '2024-07-24 06:27:26', '2024-07-24 06:27:26'),
(107, 'MATEMATIKA', 'MATEMATIKA', 107, '2024-07-24 06:27:26', '2024-07-24 06:27:26'),
(108, 'INFORMATIKA', 'INFORMATIKA', 108, '2024-07-24 06:27:26', '2024-07-24 06:27:26'),
(109, 'BK', 'BK', 109, '2024-07-24 06:27:26', '2024-07-24 06:27:26'),
(110, 'PJOK', 'PJOK', 110, '2024-07-24 06:27:26', '2024-07-24 06:27:26'),
(111, 'PAIBP', 'PAIBP', 111, '2024-07-24 06:27:26', '2024-07-24 06:27:26'),
(112, 'BAHASA INDONESIA', 'BAHASA INDONESIA', 112, '2024-07-24 06:27:26', '2024-07-24 06:27:26'),
(113, 'PIPAS', 'PIPAS', 113, '2024-07-24 06:27:26', '2024-07-24 06:27:26'),
(114, 'SEJARAH', 'SEJARAH', 114, '2024-07-24 06:27:26', '2024-07-24 06:27:26'),
(115, 'SENI BUDAYA', 'SENI BUDAYA', 115, '2024-07-24 06:27:26', '2024-07-24 06:27:26'),
(116, 'PANCASILA', 'PANCASILA', 116, '2024-07-24 06:27:26', '2024-07-24 06:27:26'),
(117, 'BAHASA SUNDA', 'BAHASA SUNDA', 117, '2024-07-24 06:27:26', '2024-07-24 06:27:26'),
(118, 'MATEMATIKA', 'MATEMATIKA', 118, '2024-07-24 06:32:37', '2024-07-24 06:32:37'),
(119, 'DASAR-DASAR TEKNIK OTOMOTIF', 'DASAR-DASAR TEKNIK OTOMOTIF', 119, '2024-07-24 06:32:37', '2024-07-24 06:32:37'),
(120, 'PJOK', 'PJOK', 120, '2024-07-24 06:32:37', '2024-07-24 06:32:37'),
(121, 'BAHASA INGGRIS', 'BAHASA INGGRIS', 121, '2024-07-24 06:32:37', '2024-07-24 06:32:37'),
(122, 'BAHASA INDONESIA', 'BAHASA INDONESIA', 122, '2024-07-24 06:32:37', '2024-07-24 06:32:37'),
(123, 'BAHASA SUNDA', 'BAHASA SUNDA', 123, '2024-07-24 06:32:37', '2024-07-24 06:32:37'),
(124, 'SEJARAH', 'SEJARAH', 124, '2024-07-24 06:32:37', '2024-07-24 06:32:37'),
(125, 'PIPAS', 'PIPAS', 125, '2024-07-24 06:32:37', '2024-07-24 06:32:37'),
(126, 'PAIBP', 'PAIBP', 126, '2024-07-24 06:32:37', '2024-07-24 06:32:37'),
(127, 'BK', 'BK', 127, '2024-07-24 06:32:37', '2024-07-24 06:32:37'),
(128, 'PANCASILA', 'PANCASILA', 128, '2024-07-24 06:32:37', '2024-07-24 06:32:37'),
(129, 'SENI BUDAYA', 'SENI BUDAYA', 129, '2024-07-24 06:32:37', '2024-07-24 06:32:37'),
(130, 'INFORMATIKA', 'INFORMATIKA', 130, '2024-07-24 06:32:37', '2024-07-24 06:32:37'),
(131, 'BAHASA INDONESIA', 'BAHASA INDONESIA', 131, '2024-07-24 06:36:55', '2024-07-24 06:36:55'),
(132, 'BAHASA SUNDA', 'BAHASA SUNDA', 132, '2024-07-24 06:36:55', '2024-07-24 06:36:55'),
(133, 'SEJARAH', 'SEJARAH', 133, '2024-07-24 06:36:55', '2024-07-24 06:36:55'),
(134, 'PANCASILA', 'PANCASILA', 134, '2024-07-24 06:36:55', '2024-07-24 06:36:55'),
(135, 'PJOK', 'PJOK', 135, '2024-07-24 06:36:55', '2024-07-24 06:36:55'),
(136, 'SENI BUDAYA', 'SENI BUDAYA', 136, '2024-07-24 06:36:55', '2024-07-24 06:36:55'),
(137, 'PAIBP', 'PAIBP', 137, '2024-07-24 06:36:55', '2024-07-24 06:36:55'),
(138, 'PIPAS', 'PIPAS', 138, '2024-07-24 06:36:55', '2024-07-24 06:36:55'),
(139, 'BK', 'BK', 139, '2024-07-24 06:36:55', '2024-07-24 06:36:55'),
(140, 'INFORMATIKA', 'INFORMATIKA', 140, '2024-07-24 06:36:55', '2024-07-24 06:36:55'),
(141, 'DASAR-DASAR TEKNIK OTOMOTIF', 'DASAR-DASAR TEKNIK OTOMOTIF', 141, '2024-07-24 06:36:55', '2024-07-24 06:36:55'),
(142, 'BAHASA INGGRIS', 'BAHASA INGGRIS', 142, '2024-07-24 06:36:55', '2024-07-24 06:36:55'),
(143, 'MATEMATIKA', 'MATEMATIKA', 143, '2024-07-24 06:36:55', '2024-07-24 06:36:55'),
(157, 'PIPAS', 'PIPAS', 157, '2024-07-24 06:45:43', '2024-07-24 06:45:43'),
(158, 'BAHASA SUNDA', 'BAHASA SUNDA', 158, '2024-07-24 06:45:43', '2024-07-24 06:45:43'),
(159, 'SEJARAH', 'SEJARAH', 159, '2024-07-24 06:45:43', '2024-07-24 06:45:43'),
(160, 'PJOK', 'PJOK', 160, '2024-07-24 06:45:43', '2024-07-24 06:45:43'),
(161, 'PANCASILA', 'PANCASILA', 161, '2024-07-24 06:45:43', '2024-07-24 06:45:43'),
(162, 'PAIBP', 'PAIBP', 162, '2024-07-24 06:45:43', '2024-07-24 06:45:43'),
(163, 'BAHASA INDONESIA', 'BAHASA INDONESIA', 163, '2024-07-24 06:45:43', '2024-07-24 06:45:43'),
(164, 'BK', 'BK', 164, '2024-07-24 06:45:43', '2024-07-24 06:45:43'),
(165, 'SENI BUDAYA', 'SENI BUDAYA', 165, '2024-07-24 06:45:43', '2024-07-24 06:45:43'),
(166, 'MATEMATIKA', 'MATEMATIKA', 166, '2024-07-24 06:45:43', '2024-07-24 06:45:43'),
(167, 'DASAR DASAR PPLG', 'DASAR DASAR PPLG', 167, '2024-07-24 06:45:43', '2024-07-24 06:45:43'),
(168, 'BAHASA INGGRIS', 'BAHASA INGGRIS', 168, '2024-07-24 06:45:43', '2024-07-24 06:45:43'),
(169, 'INFORMATIKA', 'INFORMATIKA', 169, '2024-07-24 06:45:43', '2024-07-24 06:45:43'),
(196, 'DASAR-DASAR TJKT', 'DASAR-DASAR TJKT', 196, '2024-07-24 06:58:13', '2024-07-24 06:58:13'),
(197, 'MATEMATIKA', 'MATEMATIKA', 197, '2024-07-24 06:58:13', '2024-07-24 06:58:13'),
(198, 'INFORMATIKA', 'INFORMATIKA', 198, '2024-07-24 06:58:13', '2024-07-24 06:58:13'),
(199, 'BAHASA INGGRIS', 'BAHASA INGGRIS', 199, '2024-07-24 06:58:13', '2024-07-24 06:58:13'),
(200, 'BK', 'BK', 200, '2024-07-24 06:58:13', '2024-07-24 06:58:13'),
(201, 'PAIBP', 'PAIBP', 201, '2024-07-24 06:58:13', '2024-07-24 06:58:13'),
(202, 'PANCASILA', 'PANCASILA', 202, '2024-07-24 06:58:13', '2024-07-24 06:58:13'),
(203, 'SEJARAH', 'SEJARAH', 203, '2024-07-24 06:58:13', '2024-07-24 06:58:13'),
(204, 'SENI BUDAYA', 'SENI BUDAYA', 204, '2024-07-24 06:58:13', '2024-07-24 06:58:13'),
(205, 'BAHASA INDONESIA', 'BAHASA INDONESIA', 205, '2024-07-24 06:58:13', '2024-07-24 06:58:13'),
(206, 'BAHASA SUNDA', 'BAHASA SUNDA', 206, '2024-07-24 06:58:13', '2024-07-24 06:58:13'),
(207, 'PIPAS', 'PIPAS', 207, '2024-07-24 06:58:13', '2024-07-24 06:58:13'),
(208, 'PJOK', 'PJOK', 208, '2024-07-24 06:58:13', '2024-07-24 06:58:13'),
(209, 'DASAR-DASAR TJKT', 'DASAR-DASAR TJKT', 209, '2024-07-24 07:18:28', '2024-07-24 07:18:28'),
(210, 'BAHASA INGGRIS', 'BAHASA INGGRIS', 210, '2024-07-24 07:18:28', '2024-07-24 07:18:28'),
(211, 'INFORMATIKA', 'INFORMATIKA', 211, '2024-07-24 07:18:28', '2024-07-24 07:18:28'),
(212, 'MATEMATIKA', 'MATEMATIKA', 212, '2024-07-24 07:18:28', '2024-07-24 07:18:28'),
(213, 'BK', 'BK', 213, '2024-07-24 07:18:28', '2024-07-24 07:18:28'),
(214, 'PAIBP', 'PAIBP', 214, '2024-07-24 07:18:28', '2024-07-24 07:18:28'),
(215, 'PJOK', 'PJOK', 215, '2024-07-24 07:18:28', '2024-07-24 07:18:28'),
(216, 'BAHASA SUNDA', 'BAHASA SUNDA', 216, '2024-07-24 07:18:28', '2024-07-24 07:18:28'),
(217, 'PANCASILA', 'PANCASILA', 217, '2024-07-24 07:18:28', '2024-07-24 07:18:28'),
(218, 'BAHASA INDONESIA', 'BAHASA INDONESIA', 218, '2024-07-24 07:18:28', '2024-07-24 07:18:28'),
(219, 'SENI BUDAYA', 'SENI BUDAYA', 219, '2024-07-24 07:18:28', '2024-07-24 07:18:28'),
(220, 'SEJARAH', 'SEJARAH', 220, '2024-07-24 07:18:28', '2024-07-24 07:18:28'),
(221, 'PIPAS', 'PIPAS', 221, '2024-07-24 07:18:28', '2024-07-24 07:18:28'),
(235, 'DASAR-DASAR MPLB', 'DASAR-DASAR MPLB', 235, '2024-07-24 07:25:36', '2024-07-24 07:25:36'),
(236, 'MATEMATIKA', 'MATEMATIKA', 236, '2024-07-24 07:25:36', '2024-07-24 07:25:36'),
(237, 'BAHASA INGGRIS', 'BAHASA INGGRIS', 237, '2024-07-24 07:25:36', '2024-07-24 07:25:36'),
(238, 'INFORMATIKA', 'INFORMATIKA', 238, '2024-07-24 07:25:36', '2024-07-24 07:25:36'),
(239, 'BK', 'BK', 239, '2024-07-24 07:25:36', '2024-07-24 07:25:36'),
(240, 'PJOK', 'PJOK', 240, '2024-07-24 07:25:36', '2024-07-24 07:25:36'),
(241, 'PAIBP', 'PAIBP', 241, '2024-07-24 07:25:36', '2024-07-24 07:25:36'),
(242, 'BAHASA INDONESIA', 'BAHASA INDONESIA', 242, '2024-07-24 07:25:36', '2024-07-24 07:25:36'),
(243, 'SENI BUDAYA', 'SENI BUDAYA', 243, '2024-07-24 07:25:36', '2024-07-24 07:25:36'),
(244, 'PANCASILA', 'PANCASILA', 244, '2024-07-24 07:25:36', '2024-07-24 07:25:36'),
(245, 'SEJARAH', 'SEJARAH', 245, '2024-07-24 07:25:36', '2024-07-24 07:25:36'),
(246, 'BAHASA SUNDA', 'BAHASA SUNDA', 246, '2024-07-24 07:25:36', '2024-07-24 07:25:36'),
(247, 'PIPAS', 'PIPAS', 247, '2024-07-24 07:25:36', '2024-07-24 07:25:36'),
(261, 'MATEMATIKA', 'MATEMATIKA', 261, '2024-07-24 07:33:01', '2024-07-24 07:33:01'),
(262, 'INFORMATIKA', 'INFORMATIKA', 262, '2024-07-24 07:33:01', '2024-07-24 07:33:01'),
(263, 'BAHASA INGGRIS', 'BAHASA INGGRIS', 263, '2024-07-24 07:33:01', '2024-07-24 07:33:01'),
(264, 'BAHASA INDONESIA', 'BAHASA INDONESIA', 264, '2024-07-24 07:33:01', '2024-07-24 07:33:01'),
(265, 'BAHASA SUNDA', 'BAHASA SUNDA', 265, '2024-07-24 07:33:01', '2024-07-24 07:33:01'),
(266, 'PJOK', 'PJOK', 266, '2024-07-24 07:33:01', '2024-07-24 07:33:01'),
(267, 'SENI BUDAYA', 'SENI BUDAYA', 267, '2024-07-24 07:33:01', '2024-07-24 07:33:01'),
(268, 'SEJARAH', 'SEJARAH', 268, '2024-07-24 07:33:01', '2024-07-24 07:33:01'),
(269, 'BK', 'BK', 269, '2024-07-24 07:33:01', '2024-07-24 07:33:01'),
(270, 'DASAR DASAR AKL', 'DASAR DASAR AKL', 270, '2024-07-24 07:33:01', '2024-07-24 07:33:01'),
(271, 'PIPAS', 'PIPAS', 271, '2024-07-24 07:33:01', '2024-07-24 07:33:01'),
(272, 'PANCASILA', 'PANCASILA', 272, '2024-07-24 07:33:01', '2024-07-24 07:33:01'),
(273, 'PAIBP', 'PAIBP', 273, '2024-07-24 07:33:01', '2024-07-24 07:33:01'),
(274, 'BAHAS INDONESIA', 'BAHAS INDONESIA', 274, '2024-07-24 07:33:45', '2024-07-24 07:33:45'),
(275, 'PIPAS', 'PIPAS', 275, '2024-07-24 07:33:45', '2024-07-24 07:33:45'),
(276, 'SENI BUDAYA', 'SENI BUDAYA', 276, '2024-07-24 07:33:45', '2024-07-24 07:33:45'),
(277, 'PANCASILA', 'PANCASILA', 277, '2024-07-24 07:33:45', '2024-07-24 07:33:45'),
(278, 'BAHASA SUNDA', 'BAHASA SUNDA', 278, '2024-07-24 07:33:45', '2024-07-24 07:33:45'),
(279, 'SEJARAH', 'SEJARAH', 279, '2024-07-24 07:33:45', '2024-07-24 07:33:45'),
(280, 'PJOK', 'PJOK', 280, '2024-07-24 07:33:45', '2024-07-24 07:33:45'),
(281, 'BK', 'BK', 281, '2024-07-24 07:33:45', '2024-07-24 07:33:45'),
(282, 'INFORMATIKA', 'INFORMATIKA', 282, '2024-07-24 07:33:45', '2024-07-24 07:33:45'),
(283, 'BAHASA INGGRIS', 'BAHASA INGGRIS', 283, '2024-07-24 07:33:45', '2024-07-24 07:33:45'),
(284, 'MATEMATIKA', 'MATEMATIKA', 284, '2024-07-24 07:33:45', '2024-07-24 07:33:45'),
(285, 'PAIBP', 'PAIBP', 285, '2024-07-24 07:33:45', '2024-07-24 07:33:45'),
(286, 'DASAR DASAR AKL', 'DASAR DASAR AKL', 286, '2024-07-24 07:33:45', '2024-07-24 07:33:45'),
(287, 'PAIBP', 'PAIBP', 287, '2024-07-24 07:36:42', '2024-07-24 07:36:42'),
(288, 'PJOK', 'PJOK', 288, '2024-07-24 07:36:42', '2024-07-24 07:36:42'),
(289, 'SEJARAH', 'SEJARAH', 289, '2024-07-24 07:36:42', '2024-07-24 07:36:42'),
(290, 'SENI BUDAYA', 'SENI BUDAYA', 290, '2024-07-24 07:36:42', '2024-07-24 07:36:42'),
(291, 'PANCASILA', 'PANCASILA', 291, '2024-07-24 07:36:42', '2024-07-24 07:36:42'),
(292, 'BAHASA SUNDA', 'BAHASA SUNDA', 292, '2024-07-24 07:36:42', '2024-07-24 07:36:42'),
(293, 'BAHASA INGGRIS', 'BAHASA INGGRIS', 293, '2024-07-24 07:36:42', '2024-07-24 07:36:42'),
(294, 'BAHASA INDONESIA', 'BAHASA INDONESIA', 294, '2024-07-24 07:36:42', '2024-07-24 07:36:42'),
(295, 'PIPAS', 'PIPAS', 295, '2024-07-24 07:36:42', '2024-07-24 07:36:42'),
(296, 'DASAR-DASAR SENI PERTUNJUKAN', 'DASAR-DASAR SENI PERTUNJUKAN', 296, '2024-07-24 07:36:42', '2024-07-24 07:36:42'),
(297, 'INFORMATIKA', 'INFORMATIKA', 297, '2024-07-24 07:36:42', '2024-07-24 07:36:42'),
(298, 'MATEMATIKA', 'MATEMATIKA', 298, '2024-07-24 07:36:42', '2024-07-24 07:36:42'),
(299, 'BK', 'BK', 299, '2024-07-24 07:36:42', '2024-07-24 07:36:42'),
(300, 'PAIBP', 'PAIBP', 300, '2024-07-24 07:39:59', '2024-07-24 07:39:59'),
(301, 'SENI BUDAYA', 'SENI BUDAYA', 301, '2024-07-24 07:39:59', '2024-07-24 07:39:59'),
(302, 'PJOK', 'PJOK', 302, '2024-07-24 07:39:59', '2024-07-24 07:39:59'),
(303, 'PANCASILA', 'PANCASILA', 303, '2024-07-24 07:39:59', '2024-07-24 07:39:59'),
(304, 'SEJARAH', 'SEJARAH', 304, '2024-07-24 07:39:59', '2024-07-24 07:39:59'),
(305, 'BAHASA SUNDA', 'BAHASA SUNDA', 305, '2024-07-24 07:39:59', '2024-07-24 07:39:59'),
(306, 'BAHASA INDONESIA', 'BAHASA INDONESIA', 306, '2024-07-24 07:39:59', '2024-07-24 07:39:59'),
(307, 'BAHASA INGGRIS', 'BAHASA INGGRIS', 307, '2024-07-24 07:39:59', '2024-07-24 07:39:59'),
(308, 'BK', 'BK', 308, '2024-07-24 07:39:59', '2024-07-24 07:39:59'),
(309, 'INFORMATIKA', 'INFORMATIKA', 309, '2024-07-24 07:39:59', '2024-07-24 07:39:59'),
(310, 'MATEMATIKA', 'MATEMATIKA', 310, '2024-07-24 07:39:59', '2024-07-24 07:39:59'),
(311, 'DASAR-DASAR SENI PERTUNJUKAN', 'DASAR-DASAR SENI PERTUNJUKAN', 311, '2024-07-24 07:39:59', '2024-07-24 07:39:59'),
(312, 'PIPAS', 'PIPAS', 312, '2024-07-24 07:39:59', '2024-07-24 07:39:59'),
(313, 'MATEMATIKA', 'MATEMATIKA', 313, '2024-07-24 07:40:38', '2024-07-24 07:40:38'),
(314, 'DASAR DASAR PPLG', 'DASAR DASAR PPLG', 314, '2024-07-24 07:40:38', '2024-07-24 07:40:38'),
(315, 'BAHASA INGGRIS', 'BAHASA INGGRIS', 315, '2024-07-24 07:40:38', '2024-07-24 07:40:38'),
(316, 'BK', 'BK', 316, '2024-07-24 07:40:38', '2024-07-24 07:40:38'),
(317, 'INFORMATIKA', 'INFORMATIKA', 317, '2024-07-24 07:40:38', '2024-07-24 07:40:38'),
(318, 'PJOK', 'PJOK', 318, '2024-07-24 07:40:38', '2024-07-24 07:40:38'),
(319, 'BAHASA SUNDA', 'BAHASA SUNDA', 319, '2024-07-24 07:40:38', '2024-07-24 07:40:38'),
(320, 'SEJARAH', 'SEJARAH', 320, '2024-07-24 07:40:38', '2024-07-24 07:40:38'),
(321, 'BAHASA INDONESIA', 'BAHASA INDONESIA', 321, '2024-07-24 07:40:38', '2024-07-24 07:40:38'),
(322, 'PANCASILA', 'PANCASILA', 322, '2024-07-24 07:40:38', '2024-07-24 07:40:38'),
(323, 'PAIBP', 'PAIBP', 323, '2024-07-24 07:40:38', '2024-07-24 07:40:38'),
(324, 'SENI BUDAYA', 'SENI BUDAYA', 324, '2024-07-24 07:40:38', '2024-07-24 07:40:38'),
(325, 'PIPAS', 'PIPAS', 325, '2024-07-24 07:40:38', '2024-07-24 07:40:38'),
(326, 'MATEMATIKA', 'MATEMATIKA', 326, '2024-07-24 08:11:55', '2024-07-24 08:11:55'),
(327, 'BK', 'BK', 327, '2024-07-24 08:11:55', '2024-07-24 08:11:55'),
(328, 'INFORMATIKA', 'INFORMATIKA', 328, '2024-07-24 08:11:55', '2024-07-24 08:11:55'),
(329, 'BAHASA INGGRIS', 'BAHASA INGGRIS', 329, '2024-07-24 08:11:55', '2024-07-24 08:11:55'),
(330, 'DASAR-DASAR TJKT', 'DASAR-DASAR TJKT', 330, '2024-07-24 08:11:55', '2024-07-24 08:11:55'),
(331, 'PIPAS', 'PIPAS', 331, '2024-07-24 08:11:55', '2024-07-24 08:11:55'),
(332, 'BAHASA INDONESIA', 'BAHASA INDONESIA', 332, '2024-07-24 08:11:55', '2024-07-24 08:11:55'),
(333, 'PJOK', 'PJOK', 333, '2024-07-24 08:11:55', '2024-07-24 08:11:55'),
(334, 'PAIBP', 'PAIBP', 334, '2024-07-24 08:11:55', '2024-07-24 08:11:55'),
(335, 'BAHASA SUNDA', 'BAHASA SUNDA', 335, '2024-07-24 08:11:55', '2024-07-24 08:11:55'),
(336, 'SEJARAH', 'SEJARAH', 336, '2024-07-24 08:11:55', '2024-07-24 08:11:55'),
(337, 'SENI BUDAYA', 'SENI BUDAYA', 337, '2024-07-24 08:11:55', '2024-07-24 08:11:55'),
(338, 'PANCASILA', 'PANCASILA', 338, '2024-07-24 08:11:55', '2024-07-24 08:11:55'),
(355, 'PELAJARAN PILIHAN', 'PELAJARAN PILIHAN', 355, '2024-07-24 09:21:57', '2024-07-24 09:21:57'),
(356, 'DESAIN PEMODELAN DAN INFORMASI BANGUNAN', 'DESAIN PEMODELAN DAN INFORMASI BANGUNAN', 356, '2024-07-24 09:21:57', '2024-07-24 09:21:57'),
(357, 'PJOK', 'PJOK', 357, '2024-07-24 09:21:57', '2024-07-24 09:21:57'),
(358, 'PKK', 'PKK', 358, '2024-07-24 09:21:57', '2024-07-24 09:21:57'),
(359, 'PAIBP', 'PAIBP', 359, '2024-07-24 09:21:57', '2024-07-24 09:21:57'),
(360, 'SEJARAH', 'SEJARAH', 360, '2024-07-24 09:21:57', '2024-07-24 09:21:57'),
(361, 'BAHASA INDONESIA', 'BAHASA INDONESIA', 361, '2024-07-24 09:21:57', '2024-07-24 09:21:57'),
(362, 'PANCASILA', 'PANCASILA', 362, '2024-07-24 09:21:57', '2024-07-24 09:21:57'),
(363, 'MATEMATIKA', 'MATEMATIKA', 363, '2024-07-24 09:21:57', '2024-07-24 09:21:57'),
(364, 'BAHASA SUNDA', 'BAHASA SUNDA', 364, '2024-07-24 09:21:57', '2024-07-24 09:21:57'),
(365, 'BAHASA INGGRIS', 'BAHASA INGGRIS', 365, '2024-07-24 09:21:57', '2024-07-24 09:21:57'),
(366, 'PELAJARAN PILIHAN', 'PELAJARAN PILIHAN', 366, '2024-07-24 09:27:00', '2024-07-24 09:27:00'),
(367, 'DESAIN PEMODELAN DAN INFORMASI BANGUNAN', 'DESAIN PEMODELAN DAN INFORMASI BANGUNAN', 367, '2024-07-24 09:27:00', '2024-07-24 09:27:00'),
(368, 'PKK', 'PKK', 368, '2024-07-24 09:27:00', '2024-07-24 09:27:00'),
(369, 'PJOK', 'PJOK', 369, '2024-07-24 09:27:00', '2024-07-24 09:27:00'),
(370, 'PAIBP', 'PAIBP', 370, '2024-07-24 09:27:00', '2024-07-24 09:27:00'),
(371, 'SEJARAH', 'SEJARAH', 371, '2024-07-24 09:27:00', '2024-07-24 09:27:00'),
(372, 'BAHASA INDONESIA', 'BAHASA INDONESIA', 372, '2024-07-24 09:27:00', '2024-07-24 09:27:00'),
(373, 'PANCASILA', 'PANCASILA', 373, '2024-07-24 09:27:00', '2024-07-24 09:27:00'),
(374, 'MATEMATIKA', 'MATEMATIKA', 374, '2024-07-24 09:27:00', '2024-07-24 09:27:00'),
(375, 'BAHASA SUNDA', 'BAHASA SUNDA', 375, '2024-07-24 09:27:00', '2024-07-24 09:27:00'),
(376, 'BAHASA INGGRIS', 'BAHASA INGGRIS', 376, '2024-07-24 09:27:01', '2024-07-24 09:27:01'),
(377, 'TEKNIK KENDARAAN RINGAN', 'TEKNIK KENDARAAN RINGAN', 377, '2024-07-24 09:30:59', '2024-07-24 09:30:59'),
(378, 'PELAJARAN PILIHAN', 'PELAJARAN PILIHAN', 378, '2024-07-24 09:30:59', '2024-07-24 09:30:59'),
(379, 'PJOK', 'PJOK', 379, '2024-07-24 09:30:59', '2024-07-24 09:30:59'),
(380, 'PKK', 'PKK', 380, '2024-07-24 09:30:59', '2024-07-24 09:30:59'),
(381, 'PAIBP', 'PAIBP', 381, '2024-07-24 09:30:59', '2024-07-24 09:30:59'),
(382, 'SEJARAH', 'SEJARAH', 382, '2024-07-24 09:30:59', '2024-07-24 09:30:59'),
(383, 'BAHASA INDONESIA', 'BAHASA INDONESIA', 383, '2024-07-24 09:30:59', '2024-07-24 09:30:59'),
(384, 'PANCASILA', 'PANCASILA', 384, '2024-07-24 09:30:59', '2024-07-24 09:30:59'),
(385, 'MATEMATIKA', 'MATEMATIKA', 385, '2024-07-24 09:30:59', '2024-07-24 09:30:59'),
(386, 'BAHASA SUNDA', 'BAHASA SUNDA', 386, '2024-07-24 09:30:59', '2024-07-24 09:30:59'),
(387, 'BAHASA INGGRIS', 'BAHASA INGGRIS', 387, '2024-07-24 09:30:59', '2024-07-24 09:30:59'),
(388, 'TEKNIK KENDARAAN RINGAN', 'TEKNIK KENDARAAN RINGAN', 388, '2024-07-24 09:32:35', '2024-07-24 09:32:35'),
(389, 'PELAJARAN PILIHAN', 'PELAJARAN PILIHAN', 389, '2024-07-24 09:32:35', '2024-07-24 09:32:35'),
(390, 'PJOK', 'PJOK', 390, '2024-07-24 09:32:35', '2024-07-24 09:32:35'),
(391, 'PKK', 'PKK', 391, '2024-07-24 09:32:35', '2024-07-24 09:32:35'),
(392, 'PAIBP', 'PAIBP', 392, '2024-07-24 09:32:35', '2024-07-24 09:32:35'),
(393, 'SEJARAH', 'SEJARAH', 393, '2024-07-24 09:32:35', '2024-07-24 09:32:35'),
(394, 'BAHASA INDONESIA', 'BAHASA INDONESIA', 394, '2024-07-24 09:32:35', '2024-07-24 09:32:35'),
(395, 'PANCASILA', 'PANCASILA', 395, '2024-07-24 09:32:35', '2024-07-24 09:32:35'),
(396, 'MATEMATIKA', 'MATEMATIKA', 396, '2024-07-24 09:32:35', '2024-07-24 09:32:35'),
(397, 'BAHASA SUNDA', 'BAHASA SUNDA', 397, '2024-07-24 09:32:35', '2024-07-24 09:32:35'),
(398, 'BAHASA INGGRIS', 'BAHASA INGGRIS', 398, '2024-07-24 09:32:35', '2024-07-24 09:32:35'),
(399, 'TEKNIK KENDARAAN RINGAN', 'TEKNIK KENDARAAN RINGAN', 399, '2024-07-24 09:34:14', '2024-07-24 09:34:14'),
(400, 'PELAJARAN PILIHAN', 'PELAJARAN PILIHAN', 400, '2024-07-24 09:34:14', '2024-07-24 09:34:14'),
(401, 'PJOK', 'PJOK', 401, '2024-07-24 09:34:14', '2024-07-24 09:34:14'),
(402, 'PKK', 'PKK', 402, '2024-07-24 09:34:14', '2024-07-24 09:34:14'),
(403, 'PAIBP', 'PAIBP', 403, '2024-07-24 09:34:14', '2024-07-24 09:34:14'),
(404, 'SEJARAH', 'SEJARAH', 404, '2024-07-24 09:34:14', '2024-07-24 09:34:14'),
(405, 'BAHASA INDONESIA', 'BAHASA INDONESIA', 405, '2024-07-24 09:34:14', '2024-07-24 09:34:14'),
(406, 'PANCASILA', 'PANCASILA', 406, '2024-07-24 09:34:14', '2024-07-24 09:34:14'),
(407, 'MATEMATIKA', 'MATEMATIKA', 407, '2024-07-24 09:34:14', '2024-07-24 09:34:14'),
(408, 'BAHASA SUNDA', 'BAHASA SUNDA', 408, '2024-07-24 09:34:14', '2024-07-24 09:34:14'),
(409, 'BAHASA INGGRIS', 'BAHASA INGGRIS', 409, '2024-07-24 09:34:14', '2024-07-24 09:34:14'),
(410, 'REKAYASA PERANGKAT LUNAK', 'REKAYASA PERANGKAT LUNAK', 410, '2024-07-24 09:38:09', '2024-07-24 09:38:09'),
(411, 'PELAJARAN PILIHAN', 'PELAJARAN PILIHAN', 411, '2024-07-24 09:38:09', '2024-07-24 09:38:09'),
(412, 'PJOK', 'PJOK', 412, '2024-07-24 09:38:09', '2024-07-24 09:38:09'),
(413, 'PKK', 'PKK', 413, '2024-07-24 09:38:09', '2024-07-24 09:38:09'),
(414, 'PAIBP', 'PAIBP', 414, '2024-07-24 09:38:09', '2024-07-24 09:38:09'),
(415, 'SEJARAH', 'SEJARAH', 415, '2024-07-24 09:38:09', '2024-07-24 09:38:09'),
(416, 'BAHASA INDONESIA', 'BAHASA INDONESIA', 416, '2024-07-24 09:38:09', '2024-07-24 09:38:09'),
(417, 'PANCASILA', 'PANCASILA', 417, '2024-07-24 09:38:09', '2024-07-24 09:38:09'),
(418, 'MATEMATIKA', 'MATEMATIKA', 418, '2024-07-24 09:38:09', '2024-07-24 09:38:09'),
(419, 'BAHASA SUNDA', 'BAHASA SUNDA', 419, '2024-07-24 09:38:09', '2024-07-24 09:38:09'),
(420, 'BAHASA INGGRIS', 'BAHASA INGGRIS', 420, '2024-07-24 09:38:09', '2024-07-24 09:38:09'),
(432, 'REKAYASA PERANGKAT LUNAK', 'REKAYASA PERANGKAT LUNAK', 432, '2024-07-24 09:41:56', '2024-07-24 09:41:56'),
(433, 'PELAJARAN PILIHAN', 'PELAJARAN PILIHAN', 433, '2024-07-24 09:41:56', '2024-07-24 09:41:56'),
(434, 'PJOK', 'PJOK', 434, '2024-07-24 09:41:56', '2024-07-24 09:41:56'),
(435, 'PKK', 'PKK', 435, '2024-07-24 09:41:56', '2024-07-24 09:41:56'),
(436, 'PAIBP', 'PAIBP', 436, '2024-07-24 09:41:56', '2024-07-24 09:41:56'),
(437, 'SEJARAH', 'SEJARAH', 437, '2024-07-24 09:41:56', '2024-07-24 09:41:56'),
(438, 'BAHASA INDONESIA', 'BAHASA INDONESIA', 438, '2024-07-24 09:41:56', '2024-07-24 09:41:56'),
(439, 'PANCASILA', 'PANCASILA', 439, '2024-07-24 09:41:56', '2024-07-24 09:41:56'),
(440, 'MATEMATIKA', 'MATEMATIKA', 440, '2024-07-24 09:41:56', '2024-07-24 09:41:56'),
(441, 'BAHASA SUNDA', 'BAHASA SUNDA', 441, '2024-07-24 09:41:56', '2024-07-24 09:41:56'),
(442, 'BAHASA INGGRIS', 'BAHASA INGGRIS', 442, '2024-07-24 09:41:56', '2024-07-24 09:41:56'),
(443, 'TEKNIK KOMPUTER DAN JARINGAN', 'TEKNIK KOMPUTER DAN JARINGAN', 443, '2024-07-24 09:43:40', '2024-07-24 09:43:40'),
(444, 'PELAJARAN PILIHAN', 'PELAJARAN PILIHAN', 444, '2024-07-24 09:43:40', '2024-07-24 09:43:40'),
(445, 'PJOK', 'PJOK', 445, '2024-07-24 09:43:40', '2024-07-24 09:43:40'),
(446, 'PKK', 'PKK', 446, '2024-07-24 09:43:40', '2024-07-24 09:43:40'),
(447, 'PAIBP', 'PAIBP', 447, '2024-07-24 09:43:40', '2024-07-24 09:43:40'),
(448, 'SEJARAH', 'SEJARAH', 448, '2024-07-24 09:43:40', '2024-07-24 09:43:40'),
(449, 'BAHASA INDONESIA', 'BAHASA INDONESIA', 449, '2024-07-24 09:43:40', '2024-07-24 09:43:40'),
(450, 'PANCASILA', 'PANCASILA', 450, '2024-07-24 09:43:40', '2024-07-24 09:43:40'),
(451, 'MATEMATIKA', 'MATEMATIKA', 451, '2024-07-24 09:43:40', '2024-07-24 09:43:40'),
(452, 'BAHASA SUNDA', 'BAHASA SUNDA', 452, '2024-07-24 09:43:40', '2024-07-24 09:43:40'),
(453, 'BAHASA INGGRIS', 'BAHASA INGGRIS', 453, '2024-07-24 09:43:40', '2024-07-24 09:43:40'),
(454, 'TEKNIK KOMPUTER DAN JARINGAN', 'TEKNIK KOMPUTER DAN JARINGAN', 454, '2024-07-24 09:44:57', '2024-07-24 09:44:57'),
(455, 'PELAJARAN PILIHAN', 'PELAJARAN PILIHAN', 455, '2024-07-24 09:44:57', '2024-07-24 09:44:57'),
(456, 'PJOK', 'PJOK', 456, '2024-07-24 09:44:57', '2024-07-24 09:44:57'),
(457, 'PKK', 'PKK', 457, '2024-07-24 09:44:57', '2024-07-24 09:44:57'),
(458, 'PAIBP', 'PAIBP', 458, '2024-07-24 09:44:57', '2024-07-24 09:44:57'),
(459, 'SEJARAH', 'SEJARAH', 459, '2024-07-24 09:44:57', '2024-07-24 09:44:57'),
(460, 'BAHASA INDONESIA', 'BAHASA INDONESIA', 460, '2024-07-24 09:44:57', '2024-07-24 09:44:57'),
(461, 'PANCASILA', 'PANCASILA', 461, '2024-07-24 09:44:57', '2024-07-24 09:44:57'),
(462, 'MATEMATIKA', 'MATEMATIKA', 462, '2024-07-24 09:44:57', '2024-07-24 09:44:57'),
(463, 'BAHASA SUNDA', 'BAHASA SUNDA', 463, '2024-07-24 09:44:57', '2024-07-24 09:44:57'),
(464, 'BAHASA INGGRIS', 'BAHASA INGGRIS', 464, '2024-07-24 09:44:57', '2024-07-24 09:44:57'),
(465, 'TEKNIK KOMPUTER DAN JARINGAN', 'TEKNIK KOMPUTER DAN JARINGAN', 465, '2024-07-24 09:46:24', '2024-07-24 09:46:24'),
(466, 'PELAJARAN PILIHAN', 'PELAJARAN PILIHAN', 466, '2024-07-24 09:46:24', '2024-07-24 09:46:24'),
(467, 'PJOK', 'PJOK', 467, '2024-07-24 09:46:24', '2024-07-24 09:46:24'),
(468, 'PKK', 'PKK', 468, '2024-07-24 09:46:24', '2024-07-24 09:46:24'),
(469, 'PAIBP', 'PAIBP', 469, '2024-07-24 09:46:24', '2024-07-24 09:46:24'),
(470, 'SEJARAH', 'SEJARAH', 470, '2024-07-24 09:46:24', '2024-07-24 09:46:24'),
(471, 'BAHASA INDONESIA', 'BAHASA INDONESIA', 471, '2024-07-24 09:46:24', '2024-07-24 09:46:24'),
(472, 'PANCASILA', 'PANCASILA', 472, '2024-07-24 09:46:24', '2024-07-24 09:46:24'),
(473, 'MATEMATIKA', 'MATEMATIKA', 473, '2024-07-24 09:46:24', '2024-07-24 09:46:24'),
(474, 'BAHASA SUNDA', 'BAHASA SUNDA', 474, '2024-07-24 09:46:24', '2024-07-24 09:46:24'),
(475, 'BAHASA INGGRIS', 'BAHASA INGGRIS', 475, '2024-07-24 09:46:24', '2024-07-24 09:46:24'),
(476, 'MANAJEMEN PERKANTORAN', 'MANAJEMEN PERKANTORAN', 476, '2024-07-24 09:48:23', '2024-07-24 09:48:23'),
(477, 'PELAJARAN PILIHAN', 'PELAJARAN PILIHAN', 477, '2024-07-24 09:48:23', '2024-07-24 09:48:23'),
(478, 'PJOK', 'PJOK', 478, '2024-07-24 09:48:23', '2024-07-24 09:48:23'),
(479, 'PKK', 'PKK', 479, '2024-07-24 09:48:23', '2024-07-24 09:48:23'),
(480, 'PAIBP', 'PAIBP', 480, '2024-07-24 09:48:23', '2024-07-24 09:48:23'),
(481, 'SEJARAH', 'SEJARAH', 481, '2024-07-24 09:48:23', '2024-07-24 09:48:23'),
(482, 'BAHASA INDONESIA', 'BAHASA INDONESIA', 482, '2024-07-24 09:48:23', '2024-07-24 09:48:23'),
(483, 'PANCASILA', 'PANCASILA', 483, '2024-07-24 09:48:23', '2024-07-24 09:48:23'),
(484, 'MATEMATIKA', 'MATEMATIKA', 484, '2024-07-24 09:48:23', '2024-07-24 09:48:23'),
(485, 'BAHASA SUNDA', 'BAHASA SUNDA', 485, '2024-07-24 09:48:23', '2024-07-24 09:48:23'),
(486, 'BAHASA INGGRIS', 'BAHASA INGGRIS', 486, '2024-07-24 09:48:23', '2024-07-24 09:48:23'),
(487, 'MANAJEMEN PERKANTORAN', 'MANAJEMEN PERKANTORAN', 487, '2024-07-24 09:49:48', '2024-07-24 09:49:48'),
(488, 'PELAJARAN PILIHAN', 'PELAJARAN PILIHAN', 488, '2024-07-24 09:49:48', '2024-07-24 09:49:48'),
(489, 'PJOK', 'PJOK', 489, '2024-07-24 09:49:48', '2024-07-24 09:49:48'),
(490, 'PKK', 'PKK', 490, '2024-07-24 09:49:48', '2024-07-24 09:49:48'),
(491, 'PAIBP', 'PAIBP', 491, '2024-07-24 09:49:48', '2024-07-24 09:49:48'),
(492, 'SEJARAH', 'SEJARAH', 492, '2024-07-24 09:49:48', '2024-07-24 09:49:48'),
(493, 'BAHASA INDONESIA', 'BAHASA INDONESIA', 493, '2024-07-24 09:49:48', '2024-07-24 09:49:48'),
(494, 'PANCASILA', 'PANCASILA', 494, '2024-07-24 09:49:48', '2024-07-24 09:49:48'),
(495, 'MATEMATIKA', 'MATEMATIKA', 495, '2024-07-24 09:49:48', '2024-07-24 09:49:48'),
(496, 'BAHASA SUNDA', 'BAHASA SUNDA', 496, '2024-07-24 09:49:48', '2024-07-24 09:49:48'),
(497, 'BAHASA INGGRIS', 'BAHASA INGGRIS', 497, '2024-07-24 09:49:48', '2024-07-24 09:49:48'),
(498, 'AKUNTANSI', 'AKUNTANSI', 498, '2024-07-24 09:51:44', '2024-07-24 09:51:44'),
(499, 'PELAJARAN PILIHAN', 'PELAJARAN PILIHAN', 499, '2024-07-24 09:51:44', '2024-07-24 09:51:44'),
(500, 'PJOK', 'PJOK', 500, '2024-07-24 09:51:44', '2024-07-24 09:51:44'),
(501, 'PKK', 'PKK', 501, '2024-07-24 09:51:44', '2024-07-24 09:51:44'),
(502, 'PAIBP', 'PAIBP', 502, '2024-07-24 09:51:44', '2024-07-24 09:51:44'),
(503, 'SEJARAH', 'SEJARAH', 503, '2024-07-24 09:51:44', '2024-07-24 09:51:44'),
(504, 'BAHASA INDONESIA', 'BAHASA INDONESIA', 504, '2024-07-24 09:51:44', '2024-07-24 09:51:44'),
(505, 'PANCASILA', 'PANCASILA', 505, '2024-07-24 09:51:44', '2024-07-24 09:51:44'),
(506, 'MATEMATIKA', 'MATEMATIKA', 506, '2024-07-24 09:51:44', '2024-07-24 09:51:44'),
(507, 'BAHASA SUNDA', 'BAHASA SUNDA', 507, '2024-07-24 09:51:44', '2024-07-24 09:51:44'),
(508, 'BAHASA INGGRIS', 'BAHASA INGGRIS', 508, '2024-07-24 09:51:44', '2024-07-24 09:51:44'),
(509, 'AKUNTANSI', 'AKUNTANSI', 509, '2024-07-24 09:53:36', '2024-07-24 09:53:36'),
(510, 'PELAJARAN PILIHAN', 'PELAJARAN PILIHAN', 510, '2024-07-24 09:53:36', '2024-07-24 09:53:36'),
(511, 'PJOK', 'PJOK', 511, '2024-07-24 09:53:36', '2024-07-24 09:53:36'),
(512, 'PKK', 'PKK', 512, '2024-07-24 09:53:36', '2024-07-24 09:53:36'),
(513, 'PAIBP', 'PAIBP', 513, '2024-07-24 09:53:36', '2024-07-24 09:53:36'),
(514, 'SEJARAH', 'SEJARAH', 514, '2024-07-24 09:53:36', '2024-07-24 09:53:36'),
(515, 'BAHASA INDONESIA', 'BAHASA INDONESIA', 515, '2024-07-24 09:53:36', '2024-07-24 09:53:36'),
(516, 'PANCASILA', 'PANCASILA', 516, '2024-07-24 09:53:36', '2024-07-24 09:53:36'),
(517, 'MATEMATIKA', 'MATEMATIKA', 517, '2024-07-24 09:53:36', '2024-07-24 09:53:36'),
(518, 'BAHASA SUNDA', 'BAHASA SUNDA', 518, '2024-07-24 09:53:36', '2024-07-24 09:53:36'),
(519, 'BAHASA INGGRIS', 'BAHASA INGGRIS', 519, '2024-07-24 09:53:36', '2024-07-24 09:53:36'),
(530, 'SENI KARAWITAN', 'SENI KARAWITAN', 530, '2024-07-24 09:55:13', '2024-07-24 09:55:13'),
(531, 'PELAJARAN PILIHAN', 'PELAJARAN PILIHAN', 531, '2024-07-24 09:55:13', '2024-07-24 09:55:13'),
(532, 'PJOK', 'PJOK', 532, '2024-07-24 09:55:13', '2024-07-24 09:55:13'),
(533, 'PKK', 'PKK', 533, '2024-07-24 09:55:13', '2024-07-24 09:55:13'),
(534, 'PAIBP', 'PAIBP', 534, '2024-07-24 09:55:13', '2024-07-24 09:55:13'),
(535, 'SEJARAH', 'SEJARAH', 535, '2024-07-24 09:55:13', '2024-07-24 09:55:13'),
(536, 'BAHASA INDONESIA', 'BAHASA INDONESIA', 536, '2024-07-24 09:55:13', '2024-07-24 09:55:13'),
(537, 'PANCASILA', 'PANCASILA', 537, '2024-07-24 09:55:13', '2024-07-24 09:55:13'),
(538, 'MATEMATIKA', 'MATEMATIKA', 538, '2024-07-24 09:55:13', '2024-07-24 09:55:13'),
(539, 'BAHASA SUNDA', 'BAHASA SUNDA', 539, '2024-07-24 09:55:13', '2024-07-24 09:55:13'),
(540, 'BAHASA INGGRIS', 'BAHASA INGGRIS', 540, '2024-07-24 09:55:13', '2024-07-24 09:55:13'),
(541, 'PELAJARAN PILIHAN', 'PELAJARAN PILIHAN', 541, '2024-07-25 01:43:06', '2024-07-25 01:43:06'),
(542, 'PJOK', 'PJOK', 542, '2024-07-25 01:43:06', '2024-07-25 01:43:06'),
(543, 'PKK', 'PKK', 543, '2024-07-25 01:43:06', '2024-07-25 01:43:06'),
(544, 'PAIBP', 'PAIBP', 544, '2024-07-25 01:43:06', '2024-07-25 01:43:06'),
(545, 'SEJARAH', 'SEJARAH', 545, '2024-07-25 01:43:07', '2024-07-25 01:43:07'),
(546, 'BAHASA INDONESIA', 'BAHASA INDONESIA', 546, '2024-07-25 01:43:07', '2024-07-25 01:43:07'),
(547, 'PANCASILA', 'PANCASILA', 547, '2024-07-25 01:43:07', '2024-07-25 01:43:07'),
(548, 'MATEMATIKA', 'MATEMATIKA', 548, '2024-07-25 01:43:07', '2024-07-25 01:43:07'),
(549, 'BAHASA SUNDA', 'BAHASA SUNDA', 549, '2024-07-25 01:43:07', '2024-07-25 01:43:07'),
(550, 'BAHASA INGGRIS', 'BAHASA INGGRIS', 550, '2024-07-25 01:43:07', '2024-07-25 01:43:07'),
(551, 'REKAYASA PERANGKAT LUNAK', 'REKAYASA PERANGKAT LUNAK', 551, '2024-07-25 01:43:07', '2024-07-25 01:43:07'),
(552, 'PJOK', 'PJOK', 552, '2024-07-25 04:00:37', '2024-07-25 04:00:37'),
(553, 'PAIBP', 'PAIBP', 553, '2024-07-25 04:00:37', '2024-07-25 04:00:37'),
(554, 'BAHASA INDONESIA', 'BAHASA INDONESIA', 554, '2024-07-25 04:00:37', '2024-07-25 04:00:37'),
(555, 'BAHASA SUNDA', 'BAHASA SUNDA', 555, '2024-07-25 04:00:37', '2024-07-25 04:00:37'),
(556, 'PANCASILA', 'PANCASILA', 556, '2024-07-25 04:00:37', '2024-07-25 04:00:37'),
(557, 'PIPAS', 'PIPAS', 557, '2024-07-25 04:00:37', '2024-07-25 04:00:37'),
(558, 'BK', 'BK', 558, '2024-07-25 04:00:37', '2024-07-25 04:00:37'),
(559, 'SENI BUDAYA', 'SENI BUDAYA', 559, '2024-07-25 04:00:37', '2024-07-25 04:00:37'),
(560, 'MATEMATIKA', 'MATEMATIKA', 560, '2024-07-25 04:00:38', '2024-07-25 04:00:38'),
(561, 'DASAR-DASAR MPLB', 'DASAR-DASAR MPLB', 561, '2024-07-25 04:00:38', '2024-07-25 04:00:38'),
(562, 'BAHASA INGGRIS', 'BAHASA INGGRIS', 562, '2024-07-25 04:00:38', '2024-07-25 04:00:38'),
(563, 'INFORMATIKA', 'INFORMATIKA', 563, '2024-07-25 04:00:38', '2024-07-25 04:00:38'),
(564, 'SEJARAH', 'SEJARAH', 564, '2024-07-25 04:00:38', '2024-07-25 04:00:38'),
(577, 'DASAR DASAR PPLG', 'DASAR DASAR PPLG', 577, '2024-07-25 08:15:01', '2024-07-25 08:15:01'),
(578, 'INFORMATIKA', 'INFORMATIKA', 578, '2024-07-25 08:15:01', '2024-07-25 08:15:01'),
(579, 'BAHASA INGGRIS', 'BAHASA INGGRIS', 579, '2024-07-25 08:15:01', '2024-07-25 08:15:01'),
(580, 'BK', 'BK', 580, '2024-07-25 08:15:01', '2024-07-25 08:15:01'),
(581, 'SEJARAH', 'SEJARAH', 581, '2024-07-25 08:15:01', '2024-07-25 08:15:01'),
(582, 'BAHASA INDONESIA', 'BAHASA INDONESIA', 582, '2024-07-25 08:15:01', '2024-07-25 08:15:01'),
(583, 'PAIBP', 'PAIBP', 583, '2024-07-25 08:15:01', '2024-07-25 08:15:01'),
(584, 'PJOK', 'PJOK', 584, '2024-07-25 08:15:01', '2024-07-25 08:15:01'),
(585, 'SENI BUDAYA', 'SENI BUDAYA', 585, '2024-07-25 08:15:01', '2024-07-25 08:15:01'),
(586, 'PANCASILA', 'PANCASILA', 586, '2024-07-25 08:15:01', '2024-07-25 08:15:01'),
(587, 'BAHASA SUNDA', 'BAHASA SUNDA', 587, '2024-07-25 08:15:01', '2024-07-25 08:15:01'),
(588, 'PIPAS', 'PIPAS', 588, '2024-07-25 08:15:01', '2024-07-25 08:15:01'),
(589, 'MATEMATIKA', 'MATEMATIKA', 589, '2024-07-25 08:15:01', '2024-07-25 08:15:01'),
(590, 'MATEMATIKA', 'MATEMATIKA', 590, '2024-07-25 08:31:47', '2024-07-25 08:31:47'),
(591, 'DASAR DASAR DPIB', 'DASAR DASAR DPIB', 591, '2024-07-25 08:31:47', '2024-07-25 08:31:47'),
(592, 'BK', 'BK', 592, '2024-07-25 08:31:47', '2024-07-25 08:31:47'),
(593, 'INFORMATIKA', 'INFORMATIKA', 593, '2024-07-25 08:31:47', '2024-07-25 08:31:47'),
(594, 'PJOK', 'PJOK', 594, '2024-07-25 08:31:47', '2024-07-25 08:31:47'),
(595, 'BAHASA SUNDA', 'BAHASA SUNDA', 595, '2024-07-25 08:31:47', '2024-07-25 08:31:47'),
(596, 'SENI BUDAYA', 'SENI BUDAYA', 596, '2024-07-25 08:31:47', '2024-07-25 08:31:47'),
(597, 'PAIBP', 'PAIBP', 597, '2024-07-25 08:31:47', '2024-07-25 08:31:47'),
(598, 'PIPAS', 'PIPAS', 598, '2024-07-25 08:31:47', '2024-07-25 08:31:47'),
(599, 'PANCASILA', 'PANCASILA', 599, '2024-07-25 08:31:47', '2024-07-25 08:31:47'),
(600, 'SEJARAH', 'SEJARAH', 600, '2024-07-25 08:31:47', '2024-07-25 08:31:47'),
(601, 'BAHASA INDONESIA', 'BAHASA INDONESIA', 601, '2024-07-25 08:31:47', '2024-07-25 08:31:47'),
(602, 'BAHASA INGGRIS', 'BAHASA INGGRIS', 602, '2024-07-25 08:31:47', '2024-07-25 08:31:47');

-- --------------------------------------------------------

--
-- Table structure for table `chat_group_conversations`
--

CREATE TABLE `chat_group_conversations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `chat_group_id` bigint(20) UNSIGNED NOT NULL,
  `sender_user_id` bigint(20) UNSIGNED NOT NULL,
  `message` longtext DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `file_type` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chat_group_users`
--

CREATE TABLE `chat_group_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `chat_group_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `class_attendances`
--

CREATE TABLE `class_attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date` date NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `class_lists`
--

CREATE TABLE `class_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `order` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `class_lists`
--

INSERT INTO `class_lists` (`id`, `name`, `order`, `created_at`, `updated_at`) VALUES
(1, 'XII PPLG 4', NULL, '2024-07-04 03:38:55', '2024-07-04 03:38:55'),
(2, 'XII PPLG 1', NULL, '2024-07-04 03:38:55', '2024-07-04 03:38:55'),
(3, 'DKV 3', NULL, '2024-07-06 02:39:33', '2024-07-06 02:39:33'),
(4, 'DKV 1', NULL, '2024-07-06 02:39:48', '2024-07-06 02:39:48'),
(5, 'ANM 1', NULL, '2024-07-06 02:39:48', '2024-07-06 02:39:48');

-- --------------------------------------------------------

--
-- Table structure for table `class_routines`
--

CREATE TABLE `class_routines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `weekday` varchar(255) DEFAULT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `start` date DEFAULT NULL,
  `end` date DEFAULT NULL,
  `is_recurring` tinyint(1) NOT NULL DEFAULT 1,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `notice_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `comment` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comment_replies`
--

CREATE TABLE `comment_replies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `notice_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `comment_id` bigint(20) UNSIGNED NOT NULL,
  `comment` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `qr_code_id` char(36) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `has_multiple_subject` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `qr_code_path` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `qr_code_id`, `name`, `slug`, `has_multiple_subject`, `created_at`, `updated_at`, `qr_code_path`, `photo`) VALUES
(33, 'x-rpl-1', 'X RPL 1', 'x-rpl-1', 0, '2024-07-24 04:31:40', '2024-07-24 04:31:40', 'public/qr_codes/x-rpl-1.png', 'uploads/course/1721795500_66a083acc5ba9.jpg'),
(34, 'x-rpl-2', 'X RPL 2', 'x-rpl-2', 0, '2024-07-24 04:36:50', '2024-07-24 04:36:50', 'public/qr_codes/x-rpl-2.png', 'uploads/course/1721795810_66a084e2d25d4.jpg'),
(35, 'X GIM', 'X GIM', 'x-gim', 0, '2024-07-24 04:37:41', '2024-07-24 04:37:41', 'public/qr_codes/X GIM.png', 'uploads/course/1721795861_66a08515db737.jpg'),
(36, 'x-to-1', 'X TO 1', 'x-to-1', 0, '2024-07-24 04:38:27', '2024-07-24 04:38:27', 'public/qr_codes/x-to-1.png', 'uploads/course/1721795907_66a08543d6a32.jpg'),
(37, 'x-to-2', 'X TO 2', 'x-to-2', 0, '2024-07-24 04:39:10', '2024-07-24 04:39:10', 'public/qr_codes/x-to-2.png', 'uploads/course/1721795950_66a0856e04d53.jpg'),
(38, 'x-to-3', 'X TO 3', 'x-to-3', 0, '2024-07-24 04:39:27', '2024-07-24 04:39:27', 'public/qr_codes/x-to-3.png', 'uploads/course/1721795967_66a0857f62804.jpg'),
(39, 'x-tjkt-1', 'X TJKT 1', 'x-tjkt-1', 0, '2024-07-24 04:40:02', '2024-07-24 04:40:02', 'public/qr_codes/x-tjkt-1.png', 'uploads/course/1721796002_66a085a27b30a.jpg'),
(40, 'x-tjkt-2', 'X TJKT 2', 'x-tjkt-2', 0, '2024-07-24 04:40:15', '2024-07-24 04:40:15', 'public/qr_codes/x-tjkt-2.png', 'uploads/course/1721796015_66a085afe17cd.jpg'),
(41, 'x-tjkt-3', 'X TJKT 3', 'x-tjkt-3', 0, '2024-07-24 04:40:35', '2024-07-24 04:40:35', 'public/qr_codes/x-tjkt-3.png', 'uploads/course/1721796035_66a085c37a828.jpg'),
(42, 'x-dpib-1', 'X DPIB 1', 'x-dpib-1', 0, '2024-07-24 04:41:22', '2024-07-24 04:41:22', 'public/qr_codes/x-dpib-1.png', 'uploads/course/1721796082_66a085f2954f1.jpg'),
(43, 'x-dpib-2', 'X DPIB 2', 'x-dpib-2', 0, '2024-07-24 04:42:53', '2024-07-24 04:42:53', 'public/qr_codes/x-dpib-2.png', 'uploads/course/1721796173_66a0864d0c703.jpg'),
(44, 'x-mplb-1', 'X MPLB 1', 'x-mplb-1', 0, '2024-07-24 04:43:39', '2024-07-24 04:43:39', 'public/qr_codes/x-mplb-1.png', 'uploads/course/1721796219_66a0867b898ca.jpg'),
(45, 'x-mplb-2', 'X MPLB 2', 'x-mplb-2', 0, '2024-07-24 04:43:51', '2024-07-24 04:43:51', 'public/qr_codes/x-mplb-2.png', 'uploads/course/1721796231_66a086876d55f.jpg'),
(46, 'x-ak-1', 'X AK 1', 'x-ak-1', 0, '2024-07-24 04:44:23', '2024-07-24 04:44:23', 'public/qr_codes/x-ak-1.png', 'uploads/course/1721796263_66a086a7c56ab.jpg'),
(47, 'x-ak-2', 'X AK 2', 'x-ak-2', 0, '2024-07-24 04:44:35', '2024-07-24 04:44:35', 'public/qr_codes/x-ak-2.png', 'uploads/course/1721796275_66a086b38ae09.jpg'),
(48, 'x-sp-1', 'X SP 1', 'x-sp-1', 0, '2024-07-24 04:45:00', '2024-07-24 04:45:00', 'public/qr_codes/x-sp-1.png', 'uploads/course/1721796300_66a086cc4a160.jpg'),
(49, 'x-sp-2', 'X SP 2', 'x-sp-2', 0, '2024-07-24 04:45:11', '2024-07-24 04:45:11', 'public/qr_codes/x-sp-2.png', 'uploads/course/1721796311_66a086d7ac392.jpg'),
(50, 'xi-dpib-1', 'XI DPIB 1', 'xi-dpib-1', 0, '2024-07-24 09:08:16', '2024-07-24 09:08:16', 'public/qr_codes/xi-dpib-1.png', 'uploads/course/1721812096_66a0c48064455.jpg'),
(51, 'xi-dpib-2', 'XI DPIB 2', 'xi-dpib-2', 0, '2024-07-24 09:08:27', '2024-07-24 09:08:27', 'public/qr_codes/xi-dpib-2.png', 'uploads/course/1721812107_66a0c48b7abf4.jpg'),
(52, 'xi-tkr-1', 'XI TKR 1', 'xi-tkr-1', 0, '2024-07-24 09:09:09', '2024-07-24 09:09:09', 'public/qr_codes/xi-tkr-1.png', 'uploads/course/1721812149_66a0c4b57de60.jpg'),
(53, 'xi-tkr-2', 'XI TKR 2', 'xi-tkr-2', 0, '2024-07-24 09:09:19', '2024-07-24 09:09:19', 'public/qr_codes/xi-tkr-2.png', 'uploads/course/1721812159_66a0c4bf31e6f.jpg'),
(54, 'xi-tkr-3', 'XI TKR 3', 'xi-tkr-3', 0, '2024-07-24 09:09:29', '2024-07-24 09:09:29', 'public/qr_codes/xi-tkr-3.png', 'uploads/course/1721812169_66a0c4c902cc8.jpg'),
(55, 'xi-rpl-1', 'XI RPL  1', 'xi-rpl-1', 0, '2024-07-24 09:09:54', '2024-07-24 09:09:54', 'public/qr_codes/xi-rpl-1.png', 'uploads/course/1721812194_66a0c4e273f6a.jpg'),
(56, 'xi-rpl-2', 'XI RPL  2', 'xi-rpl-2', 0, '2024-07-24 09:10:03', '2024-07-24 09:10:03', 'public/qr_codes/xi-rpl-2.png', 'uploads/course/1721812203_66a0c4ebaee14.jpg'),
(57, 'xi-rpl-3', 'XI RPL  3', 'xi-rpl-3', 0, '2024-07-24 09:10:13', '2024-07-24 09:10:13', 'public/qr_codes/xi-rpl-3.png', 'uploads/course/1721812213_66a0c4f5d127e.jpg'),
(58, 'xi-tkj-1', 'XI TKJ 1', 'xi-tkj-1', 0, '2024-07-24 09:10:53', '2024-07-24 09:10:53', 'public/qr_codes/xi-tkj-1.png', 'uploads/course/1721812253_66a0c51d19c5c.jpg'),
(59, 'xi-tkj-2', 'XI TKJ 2', 'xi-tkj-2', 0, '2024-07-24 09:11:01', '2024-07-24 09:11:01', 'public/qr_codes/xi-tkj-2.png', 'uploads/course/1721812261_66a0c525141e6.jpg'),
(60, 'xi-tkj-3', 'XI TKJ 3', 'xi-tkj-3', 0, '2024-07-24 09:11:19', '2024-07-24 09:11:19', 'public/qr_codes/xi-tkj-3.png', 'uploads/course/1721812279_66a0c537190f8.jpg'),
(61, 'xi-mp-1', 'XI MP 1', 'xi-mp-1', 0, '2024-07-24 09:11:50', '2024-07-24 09:11:50', 'public/qr_codes/xi-mp-1.png', 'uploads/course/1721812310_66a0c55689418.jpg'),
(62, 'xi-mp-2', 'XI MP 2', 'xi-mp-2', 0, '2024-07-24 09:11:58', '2024-07-24 09:11:58', 'public/qr_codes/xi-mp-2.png', 'uploads/course/1721812318_66a0c55eac2a9.jpg'),
(63, 'xi-ak-1', 'XI AK 1', 'xi-ak-1', 0, '2024-07-24 09:12:18', '2024-07-24 09:12:18', 'public/qr_codes/xi-ak-1.png', 'uploads/course/1721812338_66a0c572b50f9.jpg'),
(64, 'xi-ak-2', 'XI AK 2', 'xi-ak-2', 0, '2024-07-24 09:12:38', '2024-07-24 09:12:38', 'public/qr_codes/xi-ak-2.png', 'uploads/course/1721812358_66a0c5869c404.jpg'),
(65, 'xi-sk', 'XI SK', 'xi-sk', 0, '2024-07-24 09:13:17', '2024-07-24 09:13:17', 'public/qr_codes/xi-sk.png', 'uploads/course/1721812397_66a0c5ad1066b.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `rate` decimal(10,4) NOT NULL DEFAULT 1.0000,
  `symbol` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `code`, `rate`, `symbol`, `status`, `created_at`, `updated_at`) VALUES
(1, 'United State Dollar', 'USD', 1.0000, '$', 1, '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(5, 'Indonesia Rupiah', 'IDR', 1.0000, 'Rp', 1, '2024-06-27 03:46:43', '2024-06-27 03:46:55');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Pengajar', 'pengajar', '2024-07-04 09:24:06', '2024-07-24 07:51:54');

-- --------------------------------------------------------

--
-- Table structure for table `documentations`
--

CREATE TABLE `documentations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `video_link` varchar(255) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `documentations`
--

INSERT INTO `documentations` (`id`, `video_link`, `thumbnail`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 'https://www.youtube.com/watch?v=uD2NxGtDztI', 'fsfsf', 'sfsf', 'sfsf', NULL, NULL),
(2, 'https://www.youtube.com/watch?v=itpXevAAn6g', 'uploads/documentations/1721623116_669de24c1cc9f.jpg', 'title', 'bebas lah', '2024-07-22 18:38:36', '2024-07-22 18:38:36'),
(3, 'https://www.youtube.com/watch?v=itpXevAAn6g', 'uploads/documentations/1721623158_669de276a37c0.jpg', 'title', 'bebas lah', '2024-07-22 18:39:18', '2024-07-22 18:39:18'),
(4, 'https://www.youtube.com/watch?v=itpXevAAn6g', 'uploads/documentations/1721623306_669de30af2389.jpg', 'title', 'bebas lah', '2024-07-22 18:41:46', '2024-07-22 18:41:46'),
(5, 'https://www.youtube.com/watch?v=itpXevAAn6g', 'uploads/documentations/1721623354_669de33a6223e.jpg', 'title', 'bebas lah', '2024-07-22 18:42:34', '2024-07-22 18:42:34'),
(6, 'https://www.youtube.com/watch?v=itpXevAAn6g', 'uploads/documentations/1721623566_669de40e6d0b4.jpg', 'title', 'bebas lah', '2024-07-22 18:46:06', '2024-07-22 18:46:06'),
(7, 'https://www.youtube.com/watch?v=itpXevAAn6g', 'uploads/documentations/1721623835_669de51bc4148.jpg', 'title', 'bebas lah', '2024-07-22 18:50:35', '2024-07-22 18:50:35'),
(10, 'https://www.youtube.com/watch?v=itpXevAAn6g', 'uploads/images/1721719159_669f597774cce.jpg', 'ddad', 'ddD', '2024-07-23 21:19:19', '2024-07-23 21:19:19');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `color` varchar(255) NOT NULL DEFAULT '#FF0004',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `grade` varchar(255) NOT NULL,
  `gpa` decimal(9,2) NOT NULL,
  `description` text DEFAULT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exam_marks`
--

CREATE TABLE `exam_marks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `subject` varchar(255) NOT NULL,
  `grade` varchar(255) NOT NULL DEFAULT 'N/A',
  `marks` int(11) NOT NULL,
  `grade_remarks` varchar(255) NOT NULL DEFAULT 'N/A',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exam_results`
--

CREATE TABLE `exam_results` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` bigint(20) UNSIGNED DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `gallery_sliders`
--

CREATE TABLE `gallery_sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gallery_sliders`
--

INSERT INTO `gallery_sliders` (`id`, `image`, `created_at`, `updated_at`) VALUES
(3, 'uploads/slider/1719480287_667d2fdf7127b.png', '2024-06-27 09:24:47', '2024-06-27 09:24:47');

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `marks` varchar(255) NOT NULL,
  `grade` varchar(255) NOT NULL,
  `gpa` decimal(9,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `due_date_in` varchar(255) DEFAULT NULL COMMENT 'last paying date',
  `due_date` timestamp NULL DEFAULT NULL,
  `message` longtext DEFAULT NULL,
  `status` enum('paid','unpaid') NOT NULL DEFAULT 'unpaid',
  `amount` decimal(9,2) NOT NULL,
  `recurring` tinyint(1) NOT NULL DEFAULT 0,
  `recurring_status` tinyint(1) NOT NULL DEFAULT 0,
  `recurring_date` timestamp NULL DEFAULT NULL,
  `currency` varchar(255) NOT NULL,
  `recurring_days` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_attachments`
--

CREATE TABLE `invoice_attachments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` bigint(20) UNSIGNED NOT NULL,
  `attachment_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_items`
--

CREATE TABLE `invoice_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` bigint(20) UNSIGNED NOT NULL,
  `amount` double(8,2) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `journals`
--

CREATE TABLE `journals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `description` text NOT NULL,
  `img` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` varchar(255) NOT NULL,
  `security_code` varchar(255) NOT NULL,
  `security_code_expiration` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `journals`
--

INSERT INTO `journals` (`id`, `date`, `time`, `description`, `img`, `user_id`, `course_id`, `security_code`, `security_code_expiration`, `created_at`, `updated_at`) VALUES
(3, '2024-07-24', '17:00:00', 'test', 'journals/bDjxDb8P983dVvxdhA8kSs1DtHYhuEAEvsAQdLhl.jpg', 3, '33', '2i6o1cSviI', '2024-07-24 11:02:23', '2024-07-24 10:02:23', '2024-07-24 10:02:23');

-- --------------------------------------------------------

--
-- Table structure for table `landing_videos`
--

CREATE TABLE `landing_videos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `video_link` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `direction` enum('ltr','rtl') NOT NULL DEFAULT 'ltr',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `code`, `direction`, `created_at`, `updated_at`) VALUES
(1, 'English', 'en', 'ltr', '2024-03-29 03:16:39', '2024-03-29 03:16:39'),
(2, 'Indonesian', 'id', 'ltr', '2024-03-29 03:16:39', '2024-06-26 19:48:47');

-- --------------------------------------------------------

--
-- Table structure for table `learning_lessons`
--

CREATE TABLE `learning_lessons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `subjects_id` bigint(20) UNSIGNED NOT NULL,
  `class_lists_id` bigint(20) UNSIGNED NOT NULL,
  `time_in` time DEFAULT NULL,
  `time_out` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `leave_type_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `status` enum('pending','accepted','rejected') NOT NULL,
  `description` longtext NOT NULL,
  `rejected_cause` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `user_id`, `leave_type_id`, `title`, `start`, `end`, `status`, `description`, `rejected_cause`, `created_at`, `updated_at`, `image`) VALUES
(1, 3, 6, 'Personal Leave', '2024-07-10 08:00:00', '2024-07-10 17:00:00', 'accepted', 'Taking a personal leave day', NULL, '2024-07-08 07:07:52', '2024-07-11 02:49:14', NULL),
(2, 3, 6, 'Personal Leave', '2024-07-10 08:00:00', '2024-07-10 17:00:00', 'pending', 'Taking a personal leave day', NULL, '2024-07-16 04:49:32', '2024-07-16 04:49:32', NULL),
(3, 3, 6, 'Personal Leave', '2024-07-10 08:00:00', '2024-07-10 17:00:00', 'pending', 'Taking a personal leave day', NULL, '2024-07-16 09:37:43', '2024-07-16 09:37:43', NULL),
(4, 3, 6, 'Abis P Balap', '2024-07-19 00:00:00', '2024-07-20 00:00:00', 'rejected', 'crash', 'hoax', '2024-07-19 10:59:58', '2024-07-19 10:59:58', 'klvLsvEtFyYSRDMwGflWTWXTLkCi0HerCW2WyTHL.jpg'),
(5, 3, 6, 'waduh', '2024-07-19 00:00:00', '2024-07-20 00:00:00', 'pending', 'era digital', NULL, '2024-07-19 14:12:56', '2024-07-19 14:12:56', 'VSqEZANPYXeclByH8chfvLcbs5y9lIqRCNtz729Z.jpg'),
(6, 5, 5, 'waduh', '2024-07-23 00:00:00', '2024-07-24 00:00:00', 'pending', 'ea', NULL, '2024-07-23 07:12:39', '2024-07-23 07:12:39', 'w8AtyDeELd5e9FvHUgixNrj6bUorA5C5dFES6uLm.jpg'),
(7, 3, 6, 'ea', '2024-07-23 00:00:00', '2024-07-24 00:00:00', 'pending', 'ea', NULL, '2024-07-23 07:14:46', '2024-07-23 07:14:46', 'cs7qp2GjmYgpBH0a0pV7wNGTuTAAWRNvFGlux8cD.jpg'),
(8, 5, 4, 'mng eak', '2024-07-23 00:00:00', '2024-07-24 00:00:00', 'rejected', 'test', 'bohong', '2024-07-23 14:14:53', '2024-07-24 09:15:56', 'v0uDYSZaQ9hkYYTrJuQNm6RDJCutzqbGShbX1bgm.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `leave_types`
--

CREATE TABLE `leave_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_type` enum('student','staff','teacher') DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leave_types`
--

INSERT INTO `leave_types` (`id`, `role_type`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'staff', 'Paid', 'paid', '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(2, 'staff', 'Non Paid', 'non-paid', '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(3, 'staff', 'Others', 'others', '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(4, 'student', 'Half Day', 'half-day', '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(5, 'student', 'Full Day', 'full-day', '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(6, 'teacher', 'Sakit', 'sakit', '2024-07-08 06:28:45', '2024-07-08 06:28:45');

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'MTK', '2024-07-04 12:43:32', '2024-07-04 12:43:32'),
(2, 'B INDO', '2024-07-04 12:43:32', '2024-07-04 12:43:32');

-- --------------------------------------------------------

--
-- Table structure for table `mail_templates`
--

CREATE TABLE `mail_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `from` varchar(255) DEFAULT NULL,
  `from_name` varchar(255) DEFAULT NULL,
  `reply_to` varchar(255) DEFAULT NULL,
  `reply_to_name` varchar(255) DEFAULT NULL,
  `cc` varchar(255) DEFAULT NULL,
  `bcc` varchar(255) DEFAULT NULL,
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meetings`
--

CREATE TABLE `meetings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `meeting_id` text NOT NULL COMMENT 'zoom meeting has an id',
  `meeting_uuid` text NOT NULL COMMENT 'zoom meeting has an uuid',
  `host_id` text NOT NULL COMMENT 'zoom meeting has host_id',
  `host_email` varchar(255) NOT NULL COMMENT 'zoom meeting has host_email',
  `topic` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL COMMENT 'zoom meeting call agenda',
  `type` int(11) NOT NULL,
  `meeting_type` enum('zoom_meet','google_meet') NOT NULL DEFAULT 'zoom_meet',
  `status` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `start_time` datetime NOT NULL,
  `timezone` varchar(255) DEFAULT NULL,
  `meeting_start_url` longtext NOT NULL,
  `meeting_join_url` longtext NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `encrypted_password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meeting_attendees`
--

CREATE TABLE `meeting_attendees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `meeting_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '2014_10_10_000000_create_departments_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(5, '2019_08_19_000000_create_failed_jobs_table', 1),
(6, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(7, '2022_07_21_042106_create_sessions_table', 1),
(8, '2022_08_13_111750_create_permission_tables', 1),
(9, '2022_08_21_033635_create_notifications_table', 1),
(10, '2022_08_21_065137_create_languages_table', 1),
(11, '2022_08_22_055823_create_courses_table', 1),
(12, '2022_08_22_055824_create_plans_table', 1),
(13, '2022_08_23_055824_add_currency_column_into_plan_table', 1),
(14, '2022_08_24_102423_create_contacts_table', 1),
(15, '2022_08_26_042456_create_subjects_table', 1),
(16, '2022_08_27_061912_create_user_profiles_table', 1),
(17, '2022_09_01_023247_create_events_table', 1),
(18, '2022_09_13_043729_create_syllabi_table', 1),
(19, '2022_09_13_101215_create_assignments_table', 1),
(20, '2022_09_15_042926_create_student_attendances_table', 1),
(21, '2022_09_18_071800_create_invoices_table', 1),
(22, '2022_09_20_061429_create_grades_table', 1),
(23, '2022_09_21_041541_create_leave_types_table', 1),
(24, '2022_09_21_041541_create_leaves_table', 1),
(25, '2022_09_21_055114_create_exams_table', 1),
(26, '2022_10_02_044127_create_meetings_table', 1),
(27, '2022_10_02_103018_create_teacher_subjects_table', 1),
(28, '2022_10_04_021816_create_submitted_assignments_table', 1),
(29, '2022_10_05_031634_create_schedules_table', 1),
(30, '2022_10_06_040831_create_online_classes_table', 1),
(31, '2022_10_10_094015_create_notices_table', 1),
(32, '2022_10_11_045601_create_comments_table', 1),
(33, '2022_10_18_092424_create_class_routines_table', 1),
(34, '2022_10_24_031613_create_comment_replies_table', 1),
(35, '2022_10_26_093556_create_settings_table', 1),
(36, '2022_12_01_063850_create_orders_table', 1),
(37, '2022_12_05_055409_create_transaction_types_table', 1),
(38, '2022_12_05_055410_create_transactions_table', 1),
(39, '2022_12_05_060127_create_currencies_table', 1),
(40, '2022_12_06_104505_create_invoice_items_table', 1),
(41, '2022_12_06_104558_create_invoice_attachments_table', 1),
(42, '2022_12_27_055255_create_timezones_table', 1),
(43, '2023_01_10_081934_create_user_documents_table', 1),
(44, '2023_01_10_091907_create_chat_groups_table', 1),
(45, '2023_01_10_091928_create_chat_group_users_table', 1),
(46, '2023_01_10_091959_create_chat_group_conversations_table', 1),
(47, '2023_01_11_023912_create_admission_requests_table', 1),
(48, '2023_01_13_061355_add_description_column_into_roles_table', 1),
(49, '2023_01_17_061903_create_holidays_table', 1),
(50, '2023_01_20_095626_create_meeting_attendees_table', 1),
(51, '2023_01_20_112124_create_jobs_table', 1),
(52, '2023_01_23_043522_create_working_days_table', 1),
(53, '2023_01_25_031244_create_gallery_sliders_table', 1),
(54, '2023_02_10_071911_create_social_links_table', 1),
(55, '2023_02_23_061357_create_user_courses_table', 1),
(56, '2023_03_06_030910_create_plan_benefits_table', 1),
(57, '2023_03_13_044005_create_student_parents_table', 1),
(58, '2023_03_15_105031_create_exam_results_table', 1),
(59, '2023_03_16_092120_create_admission_form_fields_table', 1),
(60, '2023_03_16_155510_create_exam_marks_table', 1),
(61, '2023_03_22_104933_create_result_rules_table', 1),
(62, '2023_05_17_171048_add_tour_completed_column_into_users_table', 1),
(63, '2023_05_24_091106_change_setting_table_data_table', 1),
(64, '2023_05_25_123148_change_admission_request_gender_column_type_table', 1),
(65, '2023_05_25_123148_change_user_gender_column_type_table', 1),
(66, '2023_06_08_140929_create_onboardings_table', 1),
(67, '2023_06_26_090745_add_date_column_into_class_routines_table', 1),
(68, '2023_07_20_093017_create_sms_templates_table', 1),
(69, '2023_07_31_050059_add_columns_to_events_table', 1),
(70, '2023_10_11_041618_add_rate_to_currencies_table', 1),
(71, '2024_07_03_124212_create_school_table', 2),
(72, '2024_07_03_130809_create_schools_table', 3),
(73, '2024_07_03_131101_create_schools_table', 4),
(74, '2024_07_03_132851_create_permissions_attendance_table', 5),
(75, '2024_07_03_134949_create_permission_attendances_table', 6),
(76, '2024_07_04_033416_create_class_lists_table', 7),
(77, '2024_07_04_033516_create_class_attendances_table', 7),
(78, '2024_07_04_111116_add_uuid_to_class_attendances_table', 8),
(79, '2024_07_04_144055_add_new_column_to_users_table', 9),
(80, '2024_07_03_125439_create_attendance_table', 10),
(81, '2024_07_03_131420_create_attendances_table', 11),
(82, '2024_07_04_034822_create_journal_table', 11),
(83, '2024_07_04_050310_create_journals_table', 11),
(84, '2024_07_04_164834_add_column_to_table_name', 11),
(85, '2024_07_04_185629_create_lessons_table', 12),
(86, '2024_07_04_185753_create_learning_lessons_table', 12),
(87, '2024_07_04_172504_create_journals_table', 13),
(88, '2024_07_04_195514_create_activity_logs_table', 13),
(89, '2024_07_05_101738_add_column_to_table_name', 13),
(90, '2024_07_05_141238_create_student_lists_table', 14),
(91, '2024_07_05_150705_add_new_column_to_table_name', 15),
(92, '2024_07_04_170004_create_journals_table', 16),
(93, '2024_07_05_182906_create_activity_log_table', 16),
(94, '2024_07_05_182907_add_event_column_to_activity_log_table', 16),
(95, '2024_07_05_182908_add_batch_uuid_column_to_activity_log_table', 16),
(96, '2024_07_05_195133_add_code_to_users_table', 16),
(97, '2024_07_05_195424_add_code_to_password_resets_table', 17),
(98, '2024_07_05_195948_create_mail_templates_table', 18),
(99, '2024_07_05_170943_create_activity_log_table', 19),
(100, '2024_07_05_170944_add_event_column_to_activity_log_table', 19),
(101, '2024_07_05_171156_create_posts_table', 19),
(102, '2024_07_05_205509_rename_lessons_id_to_subjects_id_in_learning_lessons_table', 20),
(104, '2024_07_06_094317_add_description_to_class_lists_table', 21),
(105, '2024_07_08_130457_add_image_to_leaves_table', 22),
(106, '2024_07_08_131630_add_teacher_to_role_type_enum_in_leave_types_table', 23),
(107, '2024_07_09_140718_add_course_id_to_class_attendances_table', 24),
(108, '2024_07_09_140916_drop_class_lists_id_from_class_attendances_table', 25),
(109, '2024_07_10_140508_add_qr_code_path_to_courses_table', 26),
(110, '2024_07_16_161644_create_teacher_ratings_table', 27),
(111, '2024_07_18_105145_add_photo_to_courses_table', 28),
(112, '2024_07_18_144705_create_landing_videos_table', 29),
(113, '2024_07_19_192350_add_mobile_settings_to_settings_table', 30),
(114, '2024_07_23_195348_add_link_google_play_to_settings_table', 31);

-- --------------------------------------------------------

--
-- Table structure for table `mobile_notifications`
--

CREATE TABLE `mobile_notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'unread',
  `send_at` time NOT NULL DEFAULT '13:43:50',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mobile_notifications`
--

INSERT INTO `mobile_notifications` (`id`, `title`, `message`, `token`, `status`, `send_at`, `created_at`, `updated_at`) VALUES
(3, 'si idil', 'bau ee', 'f8kq9H70Q8CT0el606Qpp8:APA91bGuOk-bEarWppJqezZHh2MQ0y5KeHlc3nka4x8-4KhhkIVPNcyM-ZVLH_Q5imy650X703s0RCNR8yEhJnjTjU0eYJTmukuPJ89VA4UplcB99f2XYz9NUSLS2sWTddLqt950qLds', 'unread', '13:43:50', '2024-07-26 09:43:04', '2024-07-26 09:43:04'),
(4, 'Testing Fathschool', 'Tes bro', 'f8kq9H70Q8CT0el606Qpp8:APA91bGuOk-bEarWppJqezZHh2MQ0y5KeHlc3nka4x8-4KhhkIVPNcyM-ZVLH_Q5imy650X703s0RCNR8yEhJnjTjU0eYJTmukuPJ89VA4UplcB99f2XYz9NUSLS2sWTddLqt950qLds', 'unread', '13:43:50', '2024-07-26 10:47:51', '2024-07-26 10:47:51');

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 114),
(2, 'App\\Models\\User', 118),
(2, 'App\\Models\\User', 120),
(2, 'App\\Models\\User', 132),
(2, 'App\\Models\\User', 143),
(2, 'App\\Models\\User', 294),
(2, 'App\\Models\\User', 331),
(2, 'App\\Models\\User', 332),
(2, 'App\\Models\\User', 369),
(2, 'App\\Models\\User', 370),
(2, 'App\\Models\\User', 371),
(2, 'App\\Models\\User', 372),
(2, 'App\\Models\\User', 373),
(2, 'App\\Models\\User', 374),
(2, 'App\\Models\\User', 375),
(2, 'App\\Models\\User', 376),
(2, 'App\\Models\\User', 377),
(2, 'App\\Models\\User', 378),
(2, 'App\\Models\\User', 415),
(2, 'App\\Models\\User', 1182),
(2, 'App\\Models\\User', 1183),
(2, 'App\\Models\\User', 1184),
(2, 'App\\Models\\User', 1185),
(2, 'App\\Models\\User', 1186),
(2, 'App\\Models\\User', 1187),
(2, 'App\\Models\\User', 1188),
(2, 'App\\Models\\User', 1189),
(2, 'App\\Models\\User', 1190),
(2, 'App\\Models\\User', 1191),
(2, 'App\\Models\\User', 1192),
(2, 'App\\Models\\User', 1193),
(2, 'App\\Models\\User', 1194),
(2, 'App\\Models\\User', 1195),
(2, 'App\\Models\\User', 1196),
(2, 'App\\Models\\User', 1197),
(2, 'App\\Models\\User', 1198),
(2, 'App\\Models\\User', 1199),
(2, 'App\\Models\\User', 1200),
(2, 'App\\Models\\User', 1201),
(2, 'App\\Models\\User', 1202),
(2, 'App\\Models\\User', 1203),
(2, 'App\\Models\\User', 1204),
(2, 'App\\Models\\User', 1409),
(2, 'App\\Models\\User', 1410),
(2, 'App\\Models\\User', 1411),
(2, 'App\\Models\\User', 1412),
(2, 'App\\Models\\User', 1413),
(2, 'App\\Models\\User', 1414),
(2, 'App\\Models\\User', 1415),
(2, 'App\\Models\\User', 1450),
(2, 'App\\Models\\User', 1585),
(2, 'App\\Models\\User', 1791),
(2, 'App\\Models\\User', 1792),
(2, 'App\\Models\\User', 1793),
(2, 'App\\Models\\User', 1794),
(2, 'App\\Models\\User', 1795),
(2, 'App\\Models\\User', 1796),
(2, 'App\\Models\\User', 1797),
(2, 'App\\Models\\User', 1942),
(2, 'App\\Models\\User', 1981),
(2, 'App\\Models\\User', 2314),
(2, 'App\\Models\\User', 2387),
(2, 'App\\Models\\User', 2532),
(2, 'App\\Models\\User', 2534),
(2, 'App\\Models\\User', 2572),
(2, 'App\\Models\\User', 2670),
(2, 'App\\Models\\User', 2671),
(2, 'App\\Models\\User', 2673),
(2, 'App\\Models\\User', 2674),
(2, 'App\\Models\\User', 2711),
(2, 'App\\Models\\User', 2749),
(2, 'App\\Models\\User', 2750),
(2, 'App\\Models\\User', 2751),
(2, 'App\\Models\\User', 2788),
(2, 'App\\Models\\User', 2798),
(2, 'App\\Models\\User', 2799),
(2, 'App\\Models\\User', 2951),
(2, 'App\\Models\\User', 2952),
(2, 'App\\Models\\User', 2953),
(2, 'App\\Models\\User', 2990),
(2, 'App\\Models\\User', 3027),
(2, 'App\\Models\\User', 3064),
(2, 'App\\Models\\User', 3065),
(2, 'App\\Models\\User', 3139),
(2, 'App\\Models\\User', 3176),
(2, 'App\\Models\\User', 3177),
(2, 'App\\Models\\User', 3178),
(2, 'App\\Models\\User', 3179),
(2, 'App\\Models\\User', 3180),
(2, 'App\\Models\\User', 3181),
(3, 'App\\Models\\User', 4),
(3, 'App\\Models\\User', 107),
(3, 'App\\Models\\User', 109),
(3, 'App\\Models\\User', 110),
(3, 'App\\Models\\User', 111),
(3, 'App\\Models\\User', 113),
(3, 'App\\Models\\User', 115),
(3, 'App\\Models\\User', 116),
(3, 'App\\Models\\User', 119),
(3, 'App\\Models\\User', 125),
(3, 'App\\Models\\User', 126),
(3, 'App\\Models\\User', 127),
(3, 'App\\Models\\User', 128),
(3, 'App\\Models\\User', 131),
(3, 'App\\Models\\User', 134),
(3, 'App\\Models\\User', 135),
(3, 'App\\Models\\User', 137),
(3, 'App\\Models\\User', 138),
(4, 'App\\Models\\User', 5),
(4, 'App\\Models\\User', 112),
(4, 'App\\Models\\User', 123),
(4, 'App\\Models\\User', 129),
(4, 'App\\Models\\User', 130),
(4, 'App\\Models\\User', 133),
(4, 'App\\Models\\User', 136),
(4, 'App\\Models\\User', 139),
(4, 'App\\Models\\User', 140),
(4, 'App\\Models\\User', 141),
(4, 'App\\Models\\User', 142),
(4, 'App\\Models\\User', 144),
(4, 'App\\Models\\User', 145),
(4, 'App\\Models\\User', 146),
(4, 'App\\Models\\User', 147),
(4, 'App\\Models\\User', 148),
(4, 'App\\Models\\User', 149),
(4, 'App\\Models\\User', 150),
(4, 'App\\Models\\User', 151),
(4, 'App\\Models\\User', 152),
(4, 'App\\Models\\User', 153),
(4, 'App\\Models\\User', 154),
(4, 'App\\Models\\User', 155),
(4, 'App\\Models\\User', 156),
(4, 'App\\Models\\User', 157),
(4, 'App\\Models\\User', 158),
(4, 'App\\Models\\User', 159),
(4, 'App\\Models\\User', 160),
(4, 'App\\Models\\User', 161),
(4, 'App\\Models\\User', 162),
(4, 'App\\Models\\User', 163),
(4, 'App\\Models\\User', 164),
(4, 'App\\Models\\User', 165),
(4, 'App\\Models\\User', 166),
(4, 'App\\Models\\User', 167),
(4, 'App\\Models\\User', 168),
(4, 'App\\Models\\User', 169),
(4, 'App\\Models\\User', 170),
(4, 'App\\Models\\User', 171),
(4, 'App\\Models\\User', 172),
(4, 'App\\Models\\User', 173),
(4, 'App\\Models\\User', 174),
(4, 'App\\Models\\User', 175),
(4, 'App\\Models\\User', 176),
(4, 'App\\Models\\User', 177),
(4, 'App\\Models\\User', 178),
(4, 'App\\Models\\User', 179),
(4, 'App\\Models\\User', 180),
(4, 'App\\Models\\User', 181),
(4, 'App\\Models\\User', 182),
(4, 'App\\Models\\User', 183),
(4, 'App\\Models\\User', 184),
(4, 'App\\Models\\User', 185),
(4, 'App\\Models\\User', 186),
(4, 'App\\Models\\User', 187),
(4, 'App\\Models\\User', 188),
(4, 'App\\Models\\User', 189),
(4, 'App\\Models\\User', 190),
(4, 'App\\Models\\User', 191),
(4, 'App\\Models\\User', 192),
(4, 'App\\Models\\User', 193),
(4, 'App\\Models\\User', 194),
(4, 'App\\Models\\User', 195),
(4, 'App\\Models\\User', 196),
(4, 'App\\Models\\User', 197),
(4, 'App\\Models\\User', 198),
(4, 'App\\Models\\User', 199),
(4, 'App\\Models\\User', 200),
(4, 'App\\Models\\User', 201),
(4, 'App\\Models\\User', 202),
(4, 'App\\Models\\User', 203),
(4, 'App\\Models\\User', 204),
(4, 'App\\Models\\User', 205),
(4, 'App\\Models\\User', 206),
(4, 'App\\Models\\User', 207),
(4, 'App\\Models\\User', 208),
(4, 'App\\Models\\User', 209),
(4, 'App\\Models\\User', 210),
(4, 'App\\Models\\User', 211),
(4, 'App\\Models\\User', 212),
(4, 'App\\Models\\User', 213),
(4, 'App\\Models\\User', 214),
(4, 'App\\Models\\User', 215),
(4, 'App\\Models\\User', 216),
(4, 'App\\Models\\User', 217),
(4, 'App\\Models\\User', 218),
(4, 'App\\Models\\User', 219),
(4, 'App\\Models\\User', 220),
(4, 'App\\Models\\User', 221),
(4, 'App\\Models\\User', 222),
(4, 'App\\Models\\User', 223),
(4, 'App\\Models\\User', 224),
(4, 'App\\Models\\User', 225),
(4, 'App\\Models\\User', 226),
(4, 'App\\Models\\User', 227),
(4, 'App\\Models\\User', 228),
(4, 'App\\Models\\User', 229),
(4, 'App\\Models\\User', 230),
(4, 'App\\Models\\User', 231),
(4, 'App\\Models\\User', 232),
(4, 'App\\Models\\User', 233),
(4, 'App\\Models\\User', 234),
(4, 'App\\Models\\User', 235),
(4, 'App\\Models\\User', 236),
(4, 'App\\Models\\User', 237),
(4, 'App\\Models\\User', 238),
(4, 'App\\Models\\User', 239),
(4, 'App\\Models\\User', 240),
(4, 'App\\Models\\User', 241),
(4, 'App\\Models\\User', 242),
(4, 'App\\Models\\User', 243),
(4, 'App\\Models\\User', 244),
(4, 'App\\Models\\User', 245),
(4, 'App\\Models\\User', 246),
(4, 'App\\Models\\User', 247),
(4, 'App\\Models\\User', 248),
(4, 'App\\Models\\User', 249),
(4, 'App\\Models\\User', 250),
(4, 'App\\Models\\User', 251),
(4, 'App\\Models\\User', 252),
(4, 'App\\Models\\User', 253),
(4, 'App\\Models\\User', 254),
(4, 'App\\Models\\User', 255),
(4, 'App\\Models\\User', 256),
(4, 'App\\Models\\User', 257),
(4, 'App\\Models\\User', 258),
(4, 'App\\Models\\User', 259),
(4, 'App\\Models\\User', 260),
(4, 'App\\Models\\User', 261),
(4, 'App\\Models\\User', 262),
(4, 'App\\Models\\User', 263),
(4, 'App\\Models\\User', 264),
(4, 'App\\Models\\User', 265),
(4, 'App\\Models\\User', 266),
(4, 'App\\Models\\User', 267),
(4, 'App\\Models\\User', 268),
(4, 'App\\Models\\User', 269),
(4, 'App\\Models\\User', 270),
(4, 'App\\Models\\User', 271),
(4, 'App\\Models\\User', 272),
(4, 'App\\Models\\User', 273),
(4, 'App\\Models\\User', 274),
(4, 'App\\Models\\User', 275),
(4, 'App\\Models\\User', 276),
(4, 'App\\Models\\User', 277),
(4, 'App\\Models\\User', 278),
(4, 'App\\Models\\User', 279),
(4, 'App\\Models\\User', 280),
(4, 'App\\Models\\User', 281),
(4, 'App\\Models\\User', 282),
(4, 'App\\Models\\User', 283),
(4, 'App\\Models\\User', 284),
(4, 'App\\Models\\User', 285),
(4, 'App\\Models\\User', 286),
(4, 'App\\Models\\User', 287),
(4, 'App\\Models\\User', 288),
(4, 'App\\Models\\User', 289),
(4, 'App\\Models\\User', 290),
(4, 'App\\Models\\User', 291),
(4, 'App\\Models\\User', 292),
(4, 'App\\Models\\User', 293),
(4, 'App\\Models\\User', 295),
(4, 'App\\Models\\User', 296),
(4, 'App\\Models\\User', 297),
(4, 'App\\Models\\User', 298),
(4, 'App\\Models\\User', 299),
(4, 'App\\Models\\User', 300),
(4, 'App\\Models\\User', 301),
(4, 'App\\Models\\User', 302),
(4, 'App\\Models\\User', 303),
(4, 'App\\Models\\User', 304),
(4, 'App\\Models\\User', 305),
(4, 'App\\Models\\User', 306),
(4, 'App\\Models\\User', 307),
(4, 'App\\Models\\User', 308),
(4, 'App\\Models\\User', 309),
(4, 'App\\Models\\User', 310),
(4, 'App\\Models\\User', 311),
(4, 'App\\Models\\User', 312),
(4, 'App\\Models\\User', 313),
(4, 'App\\Models\\User', 314),
(4, 'App\\Models\\User', 315),
(4, 'App\\Models\\User', 316),
(4, 'App\\Models\\User', 317),
(4, 'App\\Models\\User', 318),
(4, 'App\\Models\\User', 319),
(4, 'App\\Models\\User', 320),
(4, 'App\\Models\\User', 321),
(4, 'App\\Models\\User', 322),
(4, 'App\\Models\\User', 323),
(4, 'App\\Models\\User', 324),
(4, 'App\\Models\\User', 325),
(4, 'App\\Models\\User', 326),
(4, 'App\\Models\\User', 327),
(4, 'App\\Models\\User', 328),
(4, 'App\\Models\\User', 329),
(4, 'App\\Models\\User', 330),
(4, 'App\\Models\\User', 333),
(4, 'App\\Models\\User', 334),
(4, 'App\\Models\\User', 335),
(4, 'App\\Models\\User', 336),
(4, 'App\\Models\\User', 337),
(4, 'App\\Models\\User', 338),
(4, 'App\\Models\\User', 339),
(4, 'App\\Models\\User', 340),
(4, 'App\\Models\\User', 341),
(4, 'App\\Models\\User', 342),
(4, 'App\\Models\\User', 343),
(4, 'App\\Models\\User', 344),
(4, 'App\\Models\\User', 345),
(4, 'App\\Models\\User', 346),
(4, 'App\\Models\\User', 347),
(4, 'App\\Models\\User', 348),
(4, 'App\\Models\\User', 349),
(4, 'App\\Models\\User', 350),
(4, 'App\\Models\\User', 351),
(4, 'App\\Models\\User', 352),
(4, 'App\\Models\\User', 353),
(4, 'App\\Models\\User', 354),
(4, 'App\\Models\\User', 355),
(4, 'App\\Models\\User', 356),
(4, 'App\\Models\\User', 357),
(4, 'App\\Models\\User', 358),
(4, 'App\\Models\\User', 359),
(4, 'App\\Models\\User', 360),
(4, 'App\\Models\\User', 361),
(4, 'App\\Models\\User', 362),
(4, 'App\\Models\\User', 363),
(4, 'App\\Models\\User', 364),
(4, 'App\\Models\\User', 365),
(4, 'App\\Models\\User', 366),
(4, 'App\\Models\\User', 367),
(4, 'App\\Models\\User', 368),
(4, 'App\\Models\\User', 379),
(4, 'App\\Models\\User', 380),
(4, 'App\\Models\\User', 381),
(4, 'App\\Models\\User', 382),
(4, 'App\\Models\\User', 383),
(4, 'App\\Models\\User', 384),
(4, 'App\\Models\\User', 385),
(4, 'App\\Models\\User', 386),
(4, 'App\\Models\\User', 387),
(4, 'App\\Models\\User', 388),
(4, 'App\\Models\\User', 389),
(4, 'App\\Models\\User', 390),
(4, 'App\\Models\\User', 391),
(4, 'App\\Models\\User', 392),
(4, 'App\\Models\\User', 393),
(4, 'App\\Models\\User', 394),
(4, 'App\\Models\\User', 395),
(4, 'App\\Models\\User', 396),
(4, 'App\\Models\\User', 397),
(4, 'App\\Models\\User', 398),
(4, 'App\\Models\\User', 399),
(4, 'App\\Models\\User', 400),
(4, 'App\\Models\\User', 401),
(4, 'App\\Models\\User', 402),
(4, 'App\\Models\\User', 403),
(4, 'App\\Models\\User', 404),
(4, 'App\\Models\\User', 405),
(4, 'App\\Models\\User', 406),
(4, 'App\\Models\\User', 407),
(4, 'App\\Models\\User', 408),
(4, 'App\\Models\\User', 409),
(4, 'App\\Models\\User', 410),
(4, 'App\\Models\\User', 411),
(4, 'App\\Models\\User', 412),
(4, 'App\\Models\\User', 413),
(4, 'App\\Models\\User', 414),
(4, 'App\\Models\\User', 416),
(4, 'App\\Models\\User', 417),
(4, 'App\\Models\\User', 418),
(4, 'App\\Models\\User', 419),
(4, 'App\\Models\\User', 420),
(4, 'App\\Models\\User', 421),
(4, 'App\\Models\\User', 422),
(4, 'App\\Models\\User', 423),
(4, 'App\\Models\\User', 424),
(4, 'App\\Models\\User', 425),
(4, 'App\\Models\\User', 426),
(4, 'App\\Models\\User', 427),
(4, 'App\\Models\\User', 428),
(4, 'App\\Models\\User', 429),
(4, 'App\\Models\\User', 430),
(4, 'App\\Models\\User', 431),
(4, 'App\\Models\\User', 432),
(4, 'App\\Models\\User', 433),
(4, 'App\\Models\\User', 434),
(4, 'App\\Models\\User', 435),
(4, 'App\\Models\\User', 436),
(4, 'App\\Models\\User', 437),
(4, 'App\\Models\\User', 438),
(4, 'App\\Models\\User', 439),
(4, 'App\\Models\\User', 440),
(4, 'App\\Models\\User', 441),
(4, 'App\\Models\\User', 442),
(4, 'App\\Models\\User', 443),
(4, 'App\\Models\\User', 444),
(4, 'App\\Models\\User', 445),
(4, 'App\\Models\\User', 446),
(4, 'App\\Models\\User', 447),
(4, 'App\\Models\\User', 448),
(4, 'App\\Models\\User', 449),
(4, 'App\\Models\\User', 450),
(4, 'App\\Models\\User', 451),
(4, 'App\\Models\\User', 452),
(4, 'App\\Models\\User', 453),
(4, 'App\\Models\\User', 454),
(4, 'App\\Models\\User', 455),
(4, 'App\\Models\\User', 456),
(4, 'App\\Models\\User', 457),
(4, 'App\\Models\\User', 458),
(4, 'App\\Models\\User', 459),
(4, 'App\\Models\\User', 460),
(4, 'App\\Models\\User', 461),
(4, 'App\\Models\\User', 462),
(4, 'App\\Models\\User', 463),
(4, 'App\\Models\\User', 464),
(4, 'App\\Models\\User', 465),
(4, 'App\\Models\\User', 466),
(4, 'App\\Models\\User', 467),
(4, 'App\\Models\\User', 468),
(4, 'App\\Models\\User', 469),
(4, 'App\\Models\\User', 470),
(4, 'App\\Models\\User', 471),
(4, 'App\\Models\\User', 472),
(4, 'App\\Models\\User', 473),
(4, 'App\\Models\\User', 474),
(4, 'App\\Models\\User', 475),
(4, 'App\\Models\\User', 476),
(4, 'App\\Models\\User', 477),
(4, 'App\\Models\\User', 478),
(4, 'App\\Models\\User', 479),
(4, 'App\\Models\\User', 480),
(4, 'App\\Models\\User', 481),
(4, 'App\\Models\\User', 482),
(4, 'App\\Models\\User', 483),
(4, 'App\\Models\\User', 484),
(4, 'App\\Models\\User', 485),
(4, 'App\\Models\\User', 486),
(4, 'App\\Models\\User', 487),
(4, 'App\\Models\\User', 488),
(4, 'App\\Models\\User', 489),
(4, 'App\\Models\\User', 490),
(4, 'App\\Models\\User', 491),
(4, 'App\\Models\\User', 492),
(4, 'App\\Models\\User', 493),
(4, 'App\\Models\\User', 494),
(4, 'App\\Models\\User', 495),
(4, 'App\\Models\\User', 496),
(4, 'App\\Models\\User', 497),
(4, 'App\\Models\\User', 498),
(4, 'App\\Models\\User', 499),
(4, 'App\\Models\\User', 500),
(4, 'App\\Models\\User', 501),
(4, 'App\\Models\\User', 502),
(4, 'App\\Models\\User', 503),
(4, 'App\\Models\\User', 504),
(4, 'App\\Models\\User', 505),
(4, 'App\\Models\\User', 506),
(4, 'App\\Models\\User', 507),
(4, 'App\\Models\\User', 508),
(4, 'App\\Models\\User', 509),
(4, 'App\\Models\\User', 510),
(4, 'App\\Models\\User', 511),
(4, 'App\\Models\\User', 512),
(4, 'App\\Models\\User', 513),
(4, 'App\\Models\\User', 514),
(4, 'App\\Models\\User', 515),
(4, 'App\\Models\\User', 516),
(4, 'App\\Models\\User', 517),
(4, 'App\\Models\\User', 518),
(4, 'App\\Models\\User', 519),
(4, 'App\\Models\\User', 520),
(4, 'App\\Models\\User', 521),
(4, 'App\\Models\\User', 522),
(4, 'App\\Models\\User', 523),
(4, 'App\\Models\\User', 524),
(4, 'App\\Models\\User', 525),
(4, 'App\\Models\\User', 526),
(4, 'App\\Models\\User', 527),
(4, 'App\\Models\\User', 528),
(4, 'App\\Models\\User', 529),
(4, 'App\\Models\\User', 530),
(4, 'App\\Models\\User', 531),
(4, 'App\\Models\\User', 532),
(4, 'App\\Models\\User', 533),
(4, 'App\\Models\\User', 534),
(4, 'App\\Models\\User', 535),
(4, 'App\\Models\\User', 536),
(4, 'App\\Models\\User', 537),
(4, 'App\\Models\\User', 538),
(4, 'App\\Models\\User', 539),
(4, 'App\\Models\\User', 540),
(4, 'App\\Models\\User', 541),
(4, 'App\\Models\\User', 542),
(4, 'App\\Models\\User', 543),
(4, 'App\\Models\\User', 544),
(4, 'App\\Models\\User', 545),
(4, 'App\\Models\\User', 546),
(4, 'App\\Models\\User', 547),
(4, 'App\\Models\\User', 548),
(4, 'App\\Models\\User', 549),
(4, 'App\\Models\\User', 550),
(4, 'App\\Models\\User', 551),
(4, 'App\\Models\\User', 552),
(4, 'App\\Models\\User', 553),
(4, 'App\\Models\\User', 554),
(4, 'App\\Models\\User', 555),
(4, 'App\\Models\\User', 556),
(4, 'App\\Models\\User', 557),
(4, 'App\\Models\\User', 558),
(4, 'App\\Models\\User', 559),
(4, 'App\\Models\\User', 560),
(4, 'App\\Models\\User', 561),
(4, 'App\\Models\\User', 562),
(4, 'App\\Models\\User', 563),
(4, 'App\\Models\\User', 564),
(4, 'App\\Models\\User', 565),
(4, 'App\\Models\\User', 566),
(4, 'App\\Models\\User', 567),
(4, 'App\\Models\\User', 568),
(4, 'App\\Models\\User', 569),
(4, 'App\\Models\\User', 570),
(4, 'App\\Models\\User', 571),
(4, 'App\\Models\\User', 572),
(4, 'App\\Models\\User', 573),
(4, 'App\\Models\\User', 574),
(4, 'App\\Models\\User', 575),
(4, 'App\\Models\\User', 576),
(4, 'App\\Models\\User', 577),
(4, 'App\\Models\\User', 578),
(4, 'App\\Models\\User', 579),
(4, 'App\\Models\\User', 580),
(4, 'App\\Models\\User', 581),
(4, 'App\\Models\\User', 582),
(4, 'App\\Models\\User', 583),
(4, 'App\\Models\\User', 584),
(4, 'App\\Models\\User', 585),
(4, 'App\\Models\\User', 586),
(4, 'App\\Models\\User', 587),
(4, 'App\\Models\\User', 588),
(4, 'App\\Models\\User', 589),
(4, 'App\\Models\\User', 590),
(4, 'App\\Models\\User', 591),
(4, 'App\\Models\\User', 592),
(4, 'App\\Models\\User', 593),
(4, 'App\\Models\\User', 594),
(4, 'App\\Models\\User', 595),
(4, 'App\\Models\\User', 596),
(4, 'App\\Models\\User', 597),
(4, 'App\\Models\\User', 598),
(4, 'App\\Models\\User', 599),
(4, 'App\\Models\\User', 600),
(4, 'App\\Models\\User', 601),
(4, 'App\\Models\\User', 602),
(4, 'App\\Models\\User', 603),
(4, 'App\\Models\\User', 604),
(4, 'App\\Models\\User', 605),
(4, 'App\\Models\\User', 606),
(4, 'App\\Models\\User', 607),
(4, 'App\\Models\\User', 608),
(4, 'App\\Models\\User', 609),
(4, 'App\\Models\\User', 610),
(4, 'App\\Models\\User', 611),
(4, 'App\\Models\\User', 612),
(4, 'App\\Models\\User', 613),
(4, 'App\\Models\\User', 614),
(4, 'App\\Models\\User', 615),
(4, 'App\\Models\\User', 616),
(4, 'App\\Models\\User', 617),
(4, 'App\\Models\\User', 618),
(4, 'App\\Models\\User', 619),
(4, 'App\\Models\\User', 620),
(4, 'App\\Models\\User', 621),
(4, 'App\\Models\\User', 622),
(4, 'App\\Models\\User', 623),
(4, 'App\\Models\\User', 624),
(4, 'App\\Models\\User', 625),
(4, 'App\\Models\\User', 626),
(4, 'App\\Models\\User', 627),
(4, 'App\\Models\\User', 628),
(4, 'App\\Models\\User', 629),
(4, 'App\\Models\\User', 630),
(4, 'App\\Models\\User', 631),
(4, 'App\\Models\\User', 632),
(4, 'App\\Models\\User', 633),
(4, 'App\\Models\\User', 634),
(4, 'App\\Models\\User', 635),
(4, 'App\\Models\\User', 636),
(4, 'App\\Models\\User', 637),
(4, 'App\\Models\\User', 638),
(4, 'App\\Models\\User', 639),
(4, 'App\\Models\\User', 640),
(4, 'App\\Models\\User', 641),
(4, 'App\\Models\\User', 642),
(4, 'App\\Models\\User', 643),
(4, 'App\\Models\\User', 644),
(4, 'App\\Models\\User', 645),
(4, 'App\\Models\\User', 646),
(4, 'App\\Models\\User', 647),
(4, 'App\\Models\\User', 648),
(4, 'App\\Models\\User', 649),
(4, 'App\\Models\\User', 650),
(4, 'App\\Models\\User', 651),
(4, 'App\\Models\\User', 652),
(4, 'App\\Models\\User', 653),
(4, 'App\\Models\\User', 654),
(4, 'App\\Models\\User', 655),
(4, 'App\\Models\\User', 656),
(4, 'App\\Models\\User', 657),
(4, 'App\\Models\\User', 658),
(4, 'App\\Models\\User', 659),
(4, 'App\\Models\\User', 660),
(4, 'App\\Models\\User', 661),
(4, 'App\\Models\\User', 662),
(4, 'App\\Models\\User', 663),
(4, 'App\\Models\\User', 664),
(4, 'App\\Models\\User', 665),
(4, 'App\\Models\\User', 666),
(4, 'App\\Models\\User', 667),
(4, 'App\\Models\\User', 668),
(4, 'App\\Models\\User', 669),
(4, 'App\\Models\\User', 670),
(4, 'App\\Models\\User', 671),
(4, 'App\\Models\\User', 672),
(4, 'App\\Models\\User', 673),
(4, 'App\\Models\\User', 674),
(4, 'App\\Models\\User', 675),
(4, 'App\\Models\\User', 676),
(4, 'App\\Models\\User', 677),
(4, 'App\\Models\\User', 678),
(4, 'App\\Models\\User', 679),
(4, 'App\\Models\\User', 680),
(4, 'App\\Models\\User', 681),
(4, 'App\\Models\\User', 682),
(4, 'App\\Models\\User', 683),
(4, 'App\\Models\\User', 684),
(4, 'App\\Models\\User', 685),
(4, 'App\\Models\\User', 686),
(4, 'App\\Models\\User', 687),
(4, 'App\\Models\\User', 688),
(4, 'App\\Models\\User', 689),
(4, 'App\\Models\\User', 690),
(4, 'App\\Models\\User', 691),
(4, 'App\\Models\\User', 692),
(4, 'App\\Models\\User', 693),
(4, 'App\\Models\\User', 694),
(4, 'App\\Models\\User', 695),
(4, 'App\\Models\\User', 696),
(4, 'App\\Models\\User', 697),
(4, 'App\\Models\\User', 698),
(4, 'App\\Models\\User', 699),
(4, 'App\\Models\\User', 700),
(4, 'App\\Models\\User', 701),
(4, 'App\\Models\\User', 702),
(4, 'App\\Models\\User', 703),
(4, 'App\\Models\\User', 704),
(4, 'App\\Models\\User', 705),
(4, 'App\\Models\\User', 706),
(4, 'App\\Models\\User', 707),
(4, 'App\\Models\\User', 708),
(4, 'App\\Models\\User', 709),
(4, 'App\\Models\\User', 710),
(4, 'App\\Models\\User', 711),
(4, 'App\\Models\\User', 712),
(4, 'App\\Models\\User', 713),
(4, 'App\\Models\\User', 714),
(4, 'App\\Models\\User', 715),
(4, 'App\\Models\\User', 716),
(4, 'App\\Models\\User', 717),
(4, 'App\\Models\\User', 718),
(4, 'App\\Models\\User', 719),
(4, 'App\\Models\\User', 720),
(4, 'App\\Models\\User', 721),
(4, 'App\\Models\\User', 722),
(4, 'App\\Models\\User', 723),
(4, 'App\\Models\\User', 724),
(4, 'App\\Models\\User', 725),
(4, 'App\\Models\\User', 726),
(4, 'App\\Models\\User', 727),
(4, 'App\\Models\\User', 728),
(4, 'App\\Models\\User', 729),
(4, 'App\\Models\\User', 730),
(4, 'App\\Models\\User', 731),
(4, 'App\\Models\\User', 732),
(4, 'App\\Models\\User', 733),
(4, 'App\\Models\\User', 734),
(4, 'App\\Models\\User', 735),
(4, 'App\\Models\\User', 736),
(4, 'App\\Models\\User', 737),
(4, 'App\\Models\\User', 738),
(4, 'App\\Models\\User', 739),
(4, 'App\\Models\\User', 740),
(4, 'App\\Models\\User', 741),
(4, 'App\\Models\\User', 742),
(4, 'App\\Models\\User', 743),
(4, 'App\\Models\\User', 744),
(4, 'App\\Models\\User', 745),
(4, 'App\\Models\\User', 746),
(4, 'App\\Models\\User', 747),
(4, 'App\\Models\\User', 748),
(4, 'App\\Models\\User', 749),
(4, 'App\\Models\\User', 750),
(4, 'App\\Models\\User', 751),
(4, 'App\\Models\\User', 752),
(4, 'App\\Models\\User', 753),
(4, 'App\\Models\\User', 754),
(4, 'App\\Models\\User', 755),
(4, 'App\\Models\\User', 756),
(4, 'App\\Models\\User', 757),
(4, 'App\\Models\\User', 758),
(4, 'App\\Models\\User', 759),
(4, 'App\\Models\\User', 760),
(4, 'App\\Models\\User', 761),
(4, 'App\\Models\\User', 762),
(4, 'App\\Models\\User', 763),
(4, 'App\\Models\\User', 764),
(4, 'App\\Models\\User', 765),
(4, 'App\\Models\\User', 766),
(4, 'App\\Models\\User', 767),
(4, 'App\\Models\\User', 768),
(4, 'App\\Models\\User', 769),
(4, 'App\\Models\\User', 770),
(4, 'App\\Models\\User', 771),
(4, 'App\\Models\\User', 772),
(4, 'App\\Models\\User', 773),
(4, 'App\\Models\\User', 774),
(4, 'App\\Models\\User', 775),
(4, 'App\\Models\\User', 776),
(4, 'App\\Models\\User', 777),
(4, 'App\\Models\\User', 778),
(4, 'App\\Models\\User', 779),
(4, 'App\\Models\\User', 780),
(4, 'App\\Models\\User', 781),
(4, 'App\\Models\\User', 782),
(4, 'App\\Models\\User', 783),
(4, 'App\\Models\\User', 784),
(4, 'App\\Models\\User', 785),
(4, 'App\\Models\\User', 786),
(4, 'App\\Models\\User', 787),
(4, 'App\\Models\\User', 788),
(4, 'App\\Models\\User', 789),
(4, 'App\\Models\\User', 790),
(4, 'App\\Models\\User', 791),
(4, 'App\\Models\\User', 792),
(4, 'App\\Models\\User', 793),
(4, 'App\\Models\\User', 794),
(4, 'App\\Models\\User', 795),
(4, 'App\\Models\\User', 796),
(4, 'App\\Models\\User', 797),
(4, 'App\\Models\\User', 798),
(4, 'App\\Models\\User', 799),
(4, 'App\\Models\\User', 800),
(4, 'App\\Models\\User', 801),
(4, 'App\\Models\\User', 802),
(4, 'App\\Models\\User', 803),
(4, 'App\\Models\\User', 804),
(4, 'App\\Models\\User', 805),
(4, 'App\\Models\\User', 806),
(4, 'App\\Models\\User', 807),
(4, 'App\\Models\\User', 808),
(4, 'App\\Models\\User', 809),
(4, 'App\\Models\\User', 810),
(4, 'App\\Models\\User', 811),
(4, 'App\\Models\\User', 812),
(4, 'App\\Models\\User', 813),
(4, 'App\\Models\\User', 814),
(4, 'App\\Models\\User', 815),
(4, 'App\\Models\\User', 816),
(4, 'App\\Models\\User', 817),
(4, 'App\\Models\\User', 818),
(4, 'App\\Models\\User', 819),
(4, 'App\\Models\\User', 820),
(4, 'App\\Models\\User', 821),
(4, 'App\\Models\\User', 822),
(4, 'App\\Models\\User', 823),
(4, 'App\\Models\\User', 824),
(4, 'App\\Models\\User', 825),
(4, 'App\\Models\\User', 826),
(4, 'App\\Models\\User', 827),
(4, 'App\\Models\\User', 828),
(4, 'App\\Models\\User', 829),
(4, 'App\\Models\\User', 830),
(4, 'App\\Models\\User', 831),
(4, 'App\\Models\\User', 832),
(4, 'App\\Models\\User', 833),
(4, 'App\\Models\\User', 834),
(4, 'App\\Models\\User', 835),
(4, 'App\\Models\\User', 836),
(4, 'App\\Models\\User', 837),
(4, 'App\\Models\\User', 838),
(4, 'App\\Models\\User', 839),
(4, 'App\\Models\\User', 840),
(4, 'App\\Models\\User', 841),
(4, 'App\\Models\\User', 842),
(4, 'App\\Models\\User', 843),
(4, 'App\\Models\\User', 1150),
(4, 'App\\Models\\User', 1151),
(4, 'App\\Models\\User', 1152),
(4, 'App\\Models\\User', 1153),
(4, 'App\\Models\\User', 1154),
(4, 'App\\Models\\User', 1155),
(4, 'App\\Models\\User', 1156),
(4, 'App\\Models\\User', 1157),
(4, 'App\\Models\\User', 1158),
(4, 'App\\Models\\User', 1159),
(4, 'App\\Models\\User', 1160),
(4, 'App\\Models\\User', 1161),
(4, 'App\\Models\\User', 1162),
(4, 'App\\Models\\User', 1163),
(4, 'App\\Models\\User', 1164),
(4, 'App\\Models\\User', 1165),
(4, 'App\\Models\\User', 1166),
(4, 'App\\Models\\User', 1167),
(4, 'App\\Models\\User', 1168),
(4, 'App\\Models\\User', 1169),
(4, 'App\\Models\\User', 1170),
(4, 'App\\Models\\User', 1171),
(4, 'App\\Models\\User', 1172),
(4, 'App\\Models\\User', 1173),
(4, 'App\\Models\\User', 1174),
(4, 'App\\Models\\User', 1175),
(4, 'App\\Models\\User', 1176),
(4, 'App\\Models\\User', 1177),
(4, 'App\\Models\\User', 1178),
(4, 'App\\Models\\User', 1179),
(4, 'App\\Models\\User', 1180),
(4, 'App\\Models\\User', 1181),
(4, 'App\\Models\\User', 1452),
(4, 'App\\Models\\User', 1453),
(4, 'App\\Models\\User', 1454),
(4, 'App\\Models\\User', 1455),
(4, 'App\\Models\\User', 1456),
(4, 'App\\Models\\User', 1457),
(4, 'App\\Models\\User', 1458),
(4, 'App\\Models\\User', 1459),
(4, 'App\\Models\\User', 1460),
(4, 'App\\Models\\User', 1461),
(4, 'App\\Models\\User', 1462),
(4, 'App\\Models\\User', 1463),
(4, 'App\\Models\\User', 1464),
(4, 'App\\Models\\User', 1465),
(4, 'App\\Models\\User', 1466),
(4, 'App\\Models\\User', 1467),
(4, 'App\\Models\\User', 1468),
(4, 'App\\Models\\User', 1469),
(4, 'App\\Models\\User', 1470),
(4, 'App\\Models\\User', 1471),
(4, 'App\\Models\\User', 1472),
(4, 'App\\Models\\User', 1473),
(4, 'App\\Models\\User', 1474),
(4, 'App\\Models\\User', 1475),
(4, 'App\\Models\\User', 1476),
(4, 'App\\Models\\User', 1477),
(4, 'App\\Models\\User', 1478),
(4, 'App\\Models\\User', 1479),
(4, 'App\\Models\\User', 1480),
(4, 'App\\Models\\User', 1481),
(4, 'App\\Models\\User', 1482),
(4, 'App\\Models\\User', 1483),
(4, 'App\\Models\\User', 1484),
(4, 'App\\Models\\User', 1718),
(4, 'App\\Models\\User', 1719),
(4, 'App\\Models\\User', 1720),
(4, 'App\\Models\\User', 1721),
(4, 'App\\Models\\User', 1722),
(4, 'App\\Models\\User', 1723),
(4, 'App\\Models\\User', 1724),
(4, 'App\\Models\\User', 1725),
(4, 'App\\Models\\User', 1726),
(4, 'App\\Models\\User', 1727),
(4, 'App\\Models\\User', 1728),
(4, 'App\\Models\\User', 1729),
(4, 'App\\Models\\User', 1730),
(4, 'App\\Models\\User', 1731),
(4, 'App\\Models\\User', 1732),
(4, 'App\\Models\\User', 1733),
(4, 'App\\Models\\User', 1734),
(4, 'App\\Models\\User', 1735),
(4, 'App\\Models\\User', 1736),
(4, 'App\\Models\\User', 1737),
(4, 'App\\Models\\User', 1738),
(4, 'App\\Models\\User', 1739),
(4, 'App\\Models\\User', 1740),
(4, 'App\\Models\\User', 1741),
(4, 'App\\Models\\User', 1742),
(4, 'App\\Models\\User', 1743),
(4, 'App\\Models\\User', 1744),
(4, 'App\\Models\\User', 1745),
(4, 'App\\Models\\User', 1746),
(4, 'App\\Models\\User', 1747),
(4, 'App\\Models\\User', 1748),
(4, 'App\\Models\\User', 1749),
(4, 'App\\Models\\User', 1750),
(4, 'App\\Models\\User', 1751),
(4, 'App\\Models\\User', 1752),
(4, 'App\\Models\\User', 1753),
(4, 'App\\Models\\User', 1945),
(4, 'App\\Models\\User', 1946),
(4, 'App\\Models\\User', 1947),
(4, 'App\\Models\\User', 1948),
(4, 'App\\Models\\User', 1949),
(4, 'App\\Models\\User', 1950),
(4, 'App\\Models\\User', 1951),
(4, 'App\\Models\\User', 1952),
(4, 'App\\Models\\User', 1953),
(4, 'App\\Models\\User', 1954),
(4, 'App\\Models\\User', 1955),
(4, 'App\\Models\\User', 1956),
(4, 'App\\Models\\User', 1957),
(4, 'App\\Models\\User', 1958),
(4, 'App\\Models\\User', 1959),
(4, 'App\\Models\\User', 1960),
(4, 'App\\Models\\User', 1961),
(4, 'App\\Models\\User', 1962),
(4, 'App\\Models\\User', 1963),
(4, 'App\\Models\\User', 1964),
(4, 'App\\Models\\User', 1965),
(4, 'App\\Models\\User', 1966),
(4, 'App\\Models\\User', 1967),
(4, 'App\\Models\\User', 1968),
(4, 'App\\Models\\User', 1969),
(4, 'App\\Models\\User', 1970),
(4, 'App\\Models\\User', 1971),
(4, 'App\\Models\\User', 1972),
(4, 'App\\Models\\User', 1973),
(4, 'App\\Models\\User', 1974),
(4, 'App\\Models\\User', 1975),
(4, 'App\\Models\\User', 1976),
(4, 'App\\Models\\User', 1977),
(4, 'App\\Models\\User', 1978),
(4, 'App\\Models\\User', 1979),
(4, 'App\\Models\\User', 1980),
(4, 'App\\Models\\User', 2278),
(4, 'App\\Models\\User', 2279),
(4, 'App\\Models\\User', 2280),
(4, 'App\\Models\\User', 2281),
(4, 'App\\Models\\User', 2282),
(4, 'App\\Models\\User', 2283),
(4, 'App\\Models\\User', 2284),
(4, 'App\\Models\\User', 2285),
(4, 'App\\Models\\User', 2286),
(4, 'App\\Models\\User', 2287),
(4, 'App\\Models\\User', 2288),
(4, 'App\\Models\\User', 2289),
(4, 'App\\Models\\User', 2290),
(4, 'App\\Models\\User', 2291),
(4, 'App\\Models\\User', 2292),
(4, 'App\\Models\\User', 2293),
(4, 'App\\Models\\User', 2294),
(4, 'App\\Models\\User', 2295),
(4, 'App\\Models\\User', 2296),
(4, 'App\\Models\\User', 2297),
(4, 'App\\Models\\User', 2298),
(4, 'App\\Models\\User', 2299),
(4, 'App\\Models\\User', 2300),
(4, 'App\\Models\\User', 2301),
(4, 'App\\Models\\User', 2302),
(4, 'App\\Models\\User', 2303),
(4, 'App\\Models\\User', 2304),
(4, 'App\\Models\\User', 2305),
(4, 'App\\Models\\User', 2306),
(4, 'App\\Models\\User', 2307),
(4, 'App\\Models\\User', 2308),
(4, 'App\\Models\\User', 2309),
(4, 'App\\Models\\User', 2310),
(4, 'App\\Models\\User', 2311),
(4, 'App\\Models\\User', 2312),
(4, 'App\\Models\\User', 2313),
(4, 'App\\Models\\User', 2315),
(4, 'App\\Models\\User', 2316),
(4, 'App\\Models\\User', 2317),
(4, 'App\\Models\\User', 2318),
(4, 'App\\Models\\User', 2319),
(4, 'App\\Models\\User', 2320),
(4, 'App\\Models\\User', 2321),
(4, 'App\\Models\\User', 2322),
(4, 'App\\Models\\User', 2323),
(4, 'App\\Models\\User', 2324),
(4, 'App\\Models\\User', 2325),
(4, 'App\\Models\\User', 2326),
(4, 'App\\Models\\User', 2327),
(4, 'App\\Models\\User', 2328),
(4, 'App\\Models\\User', 2329),
(4, 'App\\Models\\User', 2330),
(4, 'App\\Models\\User', 2331),
(4, 'App\\Models\\User', 2332),
(4, 'App\\Models\\User', 2333),
(4, 'App\\Models\\User', 2334),
(4, 'App\\Models\\User', 2335),
(4, 'App\\Models\\User', 2336),
(4, 'App\\Models\\User', 2337),
(4, 'App\\Models\\User', 2338),
(4, 'App\\Models\\User', 2339),
(4, 'App\\Models\\User', 2340),
(4, 'App\\Models\\User', 2341),
(4, 'App\\Models\\User', 2342),
(4, 'App\\Models\\User', 2343),
(4, 'App\\Models\\User', 2344),
(4, 'App\\Models\\User', 2345),
(4, 'App\\Models\\User', 2346),
(4, 'App\\Models\\User', 2347),
(4, 'App\\Models\\User', 2348),
(4, 'App\\Models\\User', 2349),
(4, 'App\\Models\\User', 2350),
(4, 'App\\Models\\User', 2351),
(4, 'App\\Models\\User', 2352),
(4, 'App\\Models\\User', 2353),
(4, 'App\\Models\\User', 2354),
(4, 'App\\Models\\User', 2355),
(4, 'App\\Models\\User', 2356),
(4, 'App\\Models\\User', 2357),
(4, 'App\\Models\\User', 2358),
(4, 'App\\Models\\User', 2359),
(4, 'App\\Models\\User', 2360),
(4, 'App\\Models\\User', 2361),
(4, 'App\\Models\\User', 2362),
(4, 'App\\Models\\User', 2363),
(4, 'App\\Models\\User', 2364),
(4, 'App\\Models\\User', 2365),
(4, 'App\\Models\\User', 2366),
(4, 'App\\Models\\User', 2367),
(4, 'App\\Models\\User', 2368),
(4, 'App\\Models\\User', 2369),
(4, 'App\\Models\\User', 2370),
(4, 'App\\Models\\User', 2371),
(4, 'App\\Models\\User', 2372),
(4, 'App\\Models\\User', 2373),
(4, 'App\\Models\\User', 2374),
(4, 'App\\Models\\User', 2375),
(4, 'App\\Models\\User', 2376),
(4, 'App\\Models\\User', 2377),
(4, 'App\\Models\\User', 2378),
(4, 'App\\Models\\User', 2379),
(4, 'App\\Models\\User', 2380),
(4, 'App\\Models\\User', 2381),
(4, 'App\\Models\\User', 2382),
(4, 'App\\Models\\User', 2383),
(4, 'App\\Models\\User', 2384),
(4, 'App\\Models\\User', 2385),
(4, 'App\\Models\\User', 2386),
(4, 'App\\Models\\User', 2388),
(4, 'App\\Models\\User', 2389),
(4, 'App\\Models\\User', 2390),
(4, 'App\\Models\\User', 2391),
(4, 'App\\Models\\User', 2392),
(4, 'App\\Models\\User', 2393),
(4, 'App\\Models\\User', 2394),
(4, 'App\\Models\\User', 2395),
(4, 'App\\Models\\User', 2396),
(4, 'App\\Models\\User', 2397),
(4, 'App\\Models\\User', 2398),
(4, 'App\\Models\\User', 2399),
(4, 'App\\Models\\User', 2400),
(4, 'App\\Models\\User', 2401),
(4, 'App\\Models\\User', 2402),
(4, 'App\\Models\\User', 2403),
(4, 'App\\Models\\User', 2404),
(4, 'App\\Models\\User', 2405),
(4, 'App\\Models\\User', 2406),
(4, 'App\\Models\\User', 2407),
(4, 'App\\Models\\User', 2408),
(4, 'App\\Models\\User', 2409),
(4, 'App\\Models\\User', 2410),
(4, 'App\\Models\\User', 2411),
(4, 'App\\Models\\User', 2412),
(4, 'App\\Models\\User', 2413),
(4, 'App\\Models\\User', 2414),
(4, 'App\\Models\\User', 2415),
(4, 'App\\Models\\User', 2416),
(4, 'App\\Models\\User', 2417),
(4, 'App\\Models\\User', 2418),
(4, 'App\\Models\\User', 2419),
(4, 'App\\Models\\User', 2420),
(4, 'App\\Models\\User', 2421),
(4, 'App\\Models\\User', 2422),
(4, 'App\\Models\\User', 2423),
(4, 'App\\Models\\User', 2424),
(4, 'App\\Models\\User', 2425),
(4, 'App\\Models\\User', 2426),
(4, 'App\\Models\\User', 2427),
(4, 'App\\Models\\User', 2428),
(4, 'App\\Models\\User', 2429),
(4, 'App\\Models\\User', 2430),
(4, 'App\\Models\\User', 2431),
(4, 'App\\Models\\User', 2432),
(4, 'App\\Models\\User', 2433),
(4, 'App\\Models\\User', 2434),
(4, 'App\\Models\\User', 2435),
(4, 'App\\Models\\User', 2436),
(4, 'App\\Models\\User', 2437),
(4, 'App\\Models\\User', 2438),
(4, 'App\\Models\\User', 2439),
(4, 'App\\Models\\User', 2440),
(4, 'App\\Models\\User', 2441),
(4, 'App\\Models\\User', 2442),
(4, 'App\\Models\\User', 2443),
(4, 'App\\Models\\User', 2444),
(4, 'App\\Models\\User', 2445),
(4, 'App\\Models\\User', 2446),
(4, 'App\\Models\\User', 2447),
(4, 'App\\Models\\User', 2448),
(4, 'App\\Models\\User', 2449),
(4, 'App\\Models\\User', 2450),
(4, 'App\\Models\\User', 2451),
(4, 'App\\Models\\User', 2452),
(4, 'App\\Models\\User', 2453),
(4, 'App\\Models\\User', 2454),
(4, 'App\\Models\\User', 2455),
(4, 'App\\Models\\User', 2456),
(4, 'App\\Models\\User', 2457),
(4, 'App\\Models\\User', 2458),
(4, 'App\\Models\\User', 2459),
(4, 'App\\Models\\User', 2460),
(4, 'App\\Models\\User', 2461),
(4, 'App\\Models\\User', 2462),
(4, 'App\\Models\\User', 2463),
(4, 'App\\Models\\User', 2464),
(4, 'App\\Models\\User', 2465),
(4, 'App\\Models\\User', 2466),
(4, 'App\\Models\\User', 2467),
(4, 'App\\Models\\User', 2468),
(4, 'App\\Models\\User', 2469),
(4, 'App\\Models\\User', 2470),
(4, 'App\\Models\\User', 2471),
(4, 'App\\Models\\User', 2472),
(4, 'App\\Models\\User', 2473),
(4, 'App\\Models\\User', 2474),
(4, 'App\\Models\\User', 2475),
(4, 'App\\Models\\User', 2476),
(4, 'App\\Models\\User', 2477),
(4, 'App\\Models\\User', 2478),
(4, 'App\\Models\\User', 2479),
(4, 'App\\Models\\User', 2480),
(4, 'App\\Models\\User', 2481),
(4, 'App\\Models\\User', 2482),
(4, 'App\\Models\\User', 2483),
(4, 'App\\Models\\User', 2484),
(4, 'App\\Models\\User', 2485),
(4, 'App\\Models\\User', 2486),
(4, 'App\\Models\\User', 2487),
(4, 'App\\Models\\User', 2488),
(4, 'App\\Models\\User', 2489),
(4, 'App\\Models\\User', 2490),
(4, 'App\\Models\\User', 2491),
(4, 'App\\Models\\User', 2492),
(4, 'App\\Models\\User', 2493),
(4, 'App\\Models\\User', 2494),
(4, 'App\\Models\\User', 2495),
(4, 'App\\Models\\User', 2496),
(4, 'App\\Models\\User', 2497),
(4, 'App\\Models\\User', 2498),
(4, 'App\\Models\\User', 2499),
(4, 'App\\Models\\User', 2500),
(4, 'App\\Models\\User', 2501),
(4, 'App\\Models\\User', 2502),
(4, 'App\\Models\\User', 2503),
(4, 'App\\Models\\User', 2504),
(4, 'App\\Models\\User', 2505),
(4, 'App\\Models\\User', 2506),
(4, 'App\\Models\\User', 2507),
(4, 'App\\Models\\User', 2508),
(4, 'App\\Models\\User', 2509),
(4, 'App\\Models\\User', 2510),
(4, 'App\\Models\\User', 2511),
(4, 'App\\Models\\User', 2512),
(4, 'App\\Models\\User', 2513),
(4, 'App\\Models\\User', 2514),
(4, 'App\\Models\\User', 2515),
(4, 'App\\Models\\User', 2516),
(4, 'App\\Models\\User', 2517),
(4, 'App\\Models\\User', 2518),
(4, 'App\\Models\\User', 2519),
(4, 'App\\Models\\User', 2520),
(4, 'App\\Models\\User', 2521),
(4, 'App\\Models\\User', 2522),
(4, 'App\\Models\\User', 2523),
(4, 'App\\Models\\User', 2524),
(4, 'App\\Models\\User', 2525),
(4, 'App\\Models\\User', 2526),
(4, 'App\\Models\\User', 2527),
(4, 'App\\Models\\User', 2528),
(4, 'App\\Models\\User', 2529),
(4, 'App\\Models\\User', 2530),
(4, 'App\\Models\\User', 2531),
(4, 'App\\Models\\User', 2606),
(4, 'App\\Models\\User', 2607),
(4, 'App\\Models\\User', 2608),
(4, 'App\\Models\\User', 2609),
(4, 'App\\Models\\User', 2610),
(4, 'App\\Models\\User', 2611),
(4, 'App\\Models\\User', 2612),
(4, 'App\\Models\\User', 2613),
(4, 'App\\Models\\User', 2614),
(4, 'App\\Models\\User', 2615),
(4, 'App\\Models\\User', 2616),
(4, 'App\\Models\\User', 2617),
(4, 'App\\Models\\User', 2618),
(4, 'App\\Models\\User', 2619),
(4, 'App\\Models\\User', 2620),
(4, 'App\\Models\\User', 2621),
(4, 'App\\Models\\User', 2622),
(4, 'App\\Models\\User', 2623),
(4, 'App\\Models\\User', 2624),
(4, 'App\\Models\\User', 2625),
(4, 'App\\Models\\User', 2626),
(4, 'App\\Models\\User', 2627),
(4, 'App\\Models\\User', 2628),
(4, 'App\\Models\\User', 2629),
(4, 'App\\Models\\User', 2630),
(4, 'App\\Models\\User', 2631),
(4, 'App\\Models\\User', 2632),
(4, 'App\\Models\\User', 2633),
(4, 'App\\Models\\User', 2634),
(4, 'App\\Models\\User', 2635),
(4, 'App\\Models\\User', 2636),
(4, 'App\\Models\\User', 2637),
(4, 'App\\Models\\User', 2638),
(4, 'App\\Models\\User', 2639),
(4, 'App\\Models\\User', 2640),
(4, 'App\\Models\\User', 2641),
(4, 'App\\Models\\User', 2642),
(4, 'App\\Models\\User', 2643),
(4, 'App\\Models\\User', 2644),
(4, 'App\\Models\\User', 2645),
(4, 'App\\Models\\User', 2646),
(4, 'App\\Models\\User', 2647),
(4, 'App\\Models\\User', 2648),
(4, 'App\\Models\\User', 2649),
(4, 'App\\Models\\User', 2650),
(4, 'App\\Models\\User', 2651),
(4, 'App\\Models\\User', 2652),
(4, 'App\\Models\\User', 2653),
(4, 'App\\Models\\User', 2654),
(4, 'App\\Models\\User', 2655),
(4, 'App\\Models\\User', 2656),
(4, 'App\\Models\\User', 2657),
(4, 'App\\Models\\User', 2658),
(4, 'App\\Models\\User', 2659),
(4, 'App\\Models\\User', 2660),
(4, 'App\\Models\\User', 2661),
(4, 'App\\Models\\User', 2662),
(4, 'App\\Models\\User', 2663),
(4, 'App\\Models\\User', 2664),
(4, 'App\\Models\\User', 2665),
(4, 'App\\Models\\User', 2666),
(4, 'App\\Models\\User', 2667),
(4, 'App\\Models\\User', 2668),
(4, 'App\\Models\\User', 2669),
(4, 'App\\Models\\User', 2675),
(4, 'App\\Models\\User', 2676),
(4, 'App\\Models\\User', 2677),
(4, 'App\\Models\\User', 2678),
(4, 'App\\Models\\User', 2679),
(4, 'App\\Models\\User', 2680),
(4, 'App\\Models\\User', 2681),
(4, 'App\\Models\\User', 2682),
(4, 'App\\Models\\User', 2683),
(4, 'App\\Models\\User', 2684),
(4, 'App\\Models\\User', 2685),
(4, 'App\\Models\\User', 2686),
(4, 'App\\Models\\User', 2687),
(4, 'App\\Models\\User', 2688),
(4, 'App\\Models\\User', 2689),
(4, 'App\\Models\\User', 2690),
(4, 'App\\Models\\User', 2691),
(4, 'App\\Models\\User', 2692),
(4, 'App\\Models\\User', 2693),
(4, 'App\\Models\\User', 2694),
(4, 'App\\Models\\User', 2695),
(4, 'App\\Models\\User', 2696),
(4, 'App\\Models\\User', 2697),
(4, 'App\\Models\\User', 2698),
(4, 'App\\Models\\User', 2699),
(4, 'App\\Models\\User', 2700),
(4, 'App\\Models\\User', 2701),
(4, 'App\\Models\\User', 2702),
(4, 'App\\Models\\User', 2703),
(4, 'App\\Models\\User', 2704),
(4, 'App\\Models\\User', 2705),
(4, 'App\\Models\\User', 2706),
(4, 'App\\Models\\User', 2707),
(4, 'App\\Models\\User', 2708),
(4, 'App\\Models\\User', 2709),
(4, 'App\\Models\\User', 2710),
(4, 'App\\Models\\User', 2752),
(4, 'App\\Models\\User', 2753),
(4, 'App\\Models\\User', 2754),
(4, 'App\\Models\\User', 2755),
(4, 'App\\Models\\User', 2756),
(4, 'App\\Models\\User', 2757),
(4, 'App\\Models\\User', 2758),
(4, 'App\\Models\\User', 2759),
(4, 'App\\Models\\User', 2760),
(4, 'App\\Models\\User', 2761),
(4, 'App\\Models\\User', 2762),
(4, 'App\\Models\\User', 2763),
(4, 'App\\Models\\User', 2764),
(4, 'App\\Models\\User', 2765),
(4, 'App\\Models\\User', 2766),
(4, 'App\\Models\\User', 2767),
(4, 'App\\Models\\User', 2768),
(4, 'App\\Models\\User', 2769),
(4, 'App\\Models\\User', 2770),
(4, 'App\\Models\\User', 2771),
(4, 'App\\Models\\User', 2772),
(4, 'App\\Models\\User', 2773),
(4, 'App\\Models\\User', 2774),
(4, 'App\\Models\\User', 2775),
(4, 'App\\Models\\User', 2776),
(4, 'App\\Models\\User', 2777),
(4, 'App\\Models\\User', 2778),
(4, 'App\\Models\\User', 2779),
(4, 'App\\Models\\User', 2780),
(4, 'App\\Models\\User', 2781),
(4, 'App\\Models\\User', 2782),
(4, 'App\\Models\\User', 2783),
(4, 'App\\Models\\User', 2784),
(4, 'App\\Models\\User', 2785),
(4, 'App\\Models\\User', 2786),
(4, 'App\\Models\\User', 2787),
(4, 'App\\Models\\User', 2954),
(4, 'App\\Models\\User', 2955),
(4, 'App\\Models\\User', 2956),
(4, 'App\\Models\\User', 2957),
(4, 'App\\Models\\User', 2958),
(4, 'App\\Models\\User', 2959),
(4, 'App\\Models\\User', 2960),
(4, 'App\\Models\\User', 2961),
(4, 'App\\Models\\User', 2962),
(4, 'App\\Models\\User', 2963),
(4, 'App\\Models\\User', 2964),
(4, 'App\\Models\\User', 2965),
(4, 'App\\Models\\User', 2966),
(4, 'App\\Models\\User', 2967),
(4, 'App\\Models\\User', 2968),
(4, 'App\\Models\\User', 2969),
(4, 'App\\Models\\User', 2970),
(4, 'App\\Models\\User', 2971),
(4, 'App\\Models\\User', 2972),
(4, 'App\\Models\\User', 2973),
(4, 'App\\Models\\User', 2974),
(4, 'App\\Models\\User', 2975),
(4, 'App\\Models\\User', 2976),
(4, 'App\\Models\\User', 2977),
(4, 'App\\Models\\User', 2978),
(4, 'App\\Models\\User', 2979),
(4, 'App\\Models\\User', 2980),
(4, 'App\\Models\\User', 2981),
(4, 'App\\Models\\User', 2982),
(4, 'App\\Models\\User', 2983),
(4, 'App\\Models\\User', 2984),
(4, 'App\\Models\\User', 2985),
(4, 'App\\Models\\User', 2986),
(4, 'App\\Models\\User', 2987),
(4, 'App\\Models\\User', 2988),
(4, 'App\\Models\\User', 2989),
(4, 'App\\Models\\User', 2991),
(4, 'App\\Models\\User', 2992),
(4, 'App\\Models\\User', 2993),
(4, 'App\\Models\\User', 2994),
(4, 'App\\Models\\User', 2995),
(4, 'App\\Models\\User', 2996),
(4, 'App\\Models\\User', 2997),
(4, 'App\\Models\\User', 2998),
(4, 'App\\Models\\User', 2999),
(4, 'App\\Models\\User', 3000),
(4, 'App\\Models\\User', 3001),
(4, 'App\\Models\\User', 3002),
(4, 'App\\Models\\User', 3003),
(4, 'App\\Models\\User', 3004),
(4, 'App\\Models\\User', 3005),
(4, 'App\\Models\\User', 3006),
(4, 'App\\Models\\User', 3007),
(4, 'App\\Models\\User', 3008),
(4, 'App\\Models\\User', 3009),
(4, 'App\\Models\\User', 3010),
(4, 'App\\Models\\User', 3011),
(4, 'App\\Models\\User', 3012),
(4, 'App\\Models\\User', 3013),
(4, 'App\\Models\\User', 3014),
(4, 'App\\Models\\User', 3015),
(4, 'App\\Models\\User', 3016),
(4, 'App\\Models\\User', 3017),
(4, 'App\\Models\\User', 3018),
(4, 'App\\Models\\User', 3019),
(4, 'App\\Models\\User', 3020),
(4, 'App\\Models\\User', 3021),
(4, 'App\\Models\\User', 3022),
(4, 'App\\Models\\User', 3023),
(4, 'App\\Models\\User', 3024),
(4, 'App\\Models\\User', 3025),
(4, 'App\\Models\\User', 3026),
(4, 'App\\Models\\User', 3028),
(4, 'App\\Models\\User', 3029),
(4, 'App\\Models\\User', 3030),
(4, 'App\\Models\\User', 3031),
(4, 'App\\Models\\User', 3032),
(4, 'App\\Models\\User', 3033),
(4, 'App\\Models\\User', 3034),
(4, 'App\\Models\\User', 3035),
(4, 'App\\Models\\User', 3036),
(4, 'App\\Models\\User', 3037),
(4, 'App\\Models\\User', 3038),
(4, 'App\\Models\\User', 3039),
(4, 'App\\Models\\User', 3040),
(4, 'App\\Models\\User', 3041),
(4, 'App\\Models\\User', 3042),
(4, 'App\\Models\\User', 3043),
(4, 'App\\Models\\User', 3044),
(4, 'App\\Models\\User', 3045),
(4, 'App\\Models\\User', 3046),
(4, 'App\\Models\\User', 3047),
(4, 'App\\Models\\User', 3048),
(4, 'App\\Models\\User', 3049),
(4, 'App\\Models\\User', 3050),
(4, 'App\\Models\\User', 3051),
(4, 'App\\Models\\User', 3052),
(4, 'App\\Models\\User', 3053),
(4, 'App\\Models\\User', 3054),
(4, 'App\\Models\\User', 3055),
(4, 'App\\Models\\User', 3056),
(4, 'App\\Models\\User', 3057),
(4, 'App\\Models\\User', 3058),
(4, 'App\\Models\\User', 3059),
(4, 'App\\Models\\User', 3060),
(4, 'App\\Models\\User', 3061),
(4, 'App\\Models\\User', 3062),
(4, 'App\\Models\\User', 3063),
(4, 'App\\Models\\User', 3066),
(4, 'App\\Models\\User', 3067),
(4, 'App\\Models\\User', 3068),
(4, 'App\\Models\\User', 3069),
(4, 'App\\Models\\User', 3070),
(4, 'App\\Models\\User', 3071),
(4, 'App\\Models\\User', 3072),
(4, 'App\\Models\\User', 3073),
(4, 'App\\Models\\User', 3074),
(4, 'App\\Models\\User', 3075),
(4, 'App\\Models\\User', 3076),
(4, 'App\\Models\\User', 3077),
(4, 'App\\Models\\User', 3078),
(4, 'App\\Models\\User', 3079),
(4, 'App\\Models\\User', 3080),
(4, 'App\\Models\\User', 3081),
(4, 'App\\Models\\User', 3082),
(4, 'App\\Models\\User', 3083),
(4, 'App\\Models\\User', 3084),
(4, 'App\\Models\\User', 3085),
(4, 'App\\Models\\User', 3086),
(4, 'App\\Models\\User', 3087),
(4, 'App\\Models\\User', 3088),
(4, 'App\\Models\\User', 3089),
(4, 'App\\Models\\User', 3090),
(4, 'App\\Models\\User', 3091),
(4, 'App\\Models\\User', 3092),
(4, 'App\\Models\\User', 3093),
(4, 'App\\Models\\User', 3094),
(4, 'App\\Models\\User', 3095),
(4, 'App\\Models\\User', 3096),
(4, 'App\\Models\\User', 3097),
(4, 'App\\Models\\User', 3098),
(4, 'App\\Models\\User', 3099),
(4, 'App\\Models\\User', 3100),
(4, 'App\\Models\\User', 3101),
(4, 'App\\Models\\User', 3140),
(4, 'App\\Models\\User', 3141),
(4, 'App\\Models\\User', 3142),
(4, 'App\\Models\\User', 3143),
(4, 'App\\Models\\User', 3144),
(4, 'App\\Models\\User', 3145),
(4, 'App\\Models\\User', 3146),
(4, 'App\\Models\\User', 3147),
(4, 'App\\Models\\User', 3148),
(4, 'App\\Models\\User', 3149),
(4, 'App\\Models\\User', 3150),
(4, 'App\\Models\\User', 3151),
(4, 'App\\Models\\User', 3152),
(4, 'App\\Models\\User', 3153),
(4, 'App\\Models\\User', 3154),
(4, 'App\\Models\\User', 3155),
(4, 'App\\Models\\User', 3156),
(4, 'App\\Models\\User', 3157),
(4, 'App\\Models\\User', 3158),
(4, 'App\\Models\\User', 3159),
(4, 'App\\Models\\User', 3160),
(4, 'App\\Models\\User', 3161),
(4, 'App\\Models\\User', 3162),
(4, 'App\\Models\\User', 3163),
(4, 'App\\Models\\User', 3164),
(4, 'App\\Models\\User', 3165),
(4, 'App\\Models\\User', 3166),
(4, 'App\\Models\\User', 3167),
(4, 'App\\Models\\User', 3168),
(4, 'App\\Models\\User', 3169),
(4, 'App\\Models\\User', 3170),
(4, 'App\\Models\\User', 3171),
(4, 'App\\Models\\User', 3172),
(4, 'App\\Models\\User', 3173),
(4, 'App\\Models\\User', 3174),
(4, 'App\\Models\\User', 3175),
(5, 'App\\Models\\User', 2),
(5, 'App\\Models\\User', 108),
(5, 'App\\Models\\User', 117),
(5, 'App\\Models\\User', 121),
(5, 'App\\Models\\User', 122),
(5, 'App\\Models\\User', 124);

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `status` enum('public','private') NOT NULL DEFAULT 'public',
  `pinned` tinyint(1) NOT NULL DEFAULT 0,
  `roles` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`id`, `user_id`, `title`, `slug`, `description`, `attachment`, `status`, `pinned`, `roles`, `created_at`, `updated_at`) VALUES
(9, 1, 'asd', 'asd-1722225868', 'asd', 'uploads/notice/1722225868_66a714ccd19ea.webp', 'public', 0, 'Student', '2024-07-29 04:04:28', '2024-07-29 04:04:28'),
(10, 1, 'we', 'we-1722227602', 'qwe', 'uploads/notice/1722227602_66a71b9245456.png', 'public', 0, 'Teacher', '2024-07-29 04:33:22', '2024-07-29 04:33:22'),
(11, 1, 'asdwd', 'asdwd-1722227819', 'asdsdwd', 'uploads/notice/1722227819_66a71c6be3684.jpg', 'public', 0, 'Teacher', '2024-07-29 04:36:59', '2024-07-29 04:36:59');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `onboardings`
--

CREATE TABLE `onboardings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_slug` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `onboardings`
--

INSERT INTO `onboardings` (`id`, `menu_slug`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 'welcome', 'Welcome', 'Welcome to our Schooling App! Explore all the features and resources available to students, teachers, accountants, and parents.', '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(2, 'notice_board_top_section', 'Notice Board', 'Stay up to date with the latest news, announcements, and events through the Notice Board menu.', '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(3, 'leave_request_top_section', 'Leave Request', 'Easily request time off and track the status of your leave requests through the Leave Request menu.', '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(4, 'notification', 'Notifications', 'You can easilly get your all notifications from here', '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(5, 'currency', 'Currencies', 'You can easilly change your all from here', '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(6, 'language', 'Languages', 'You can easilly change your all from here', '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(7, 'darkMode', 'Light and Dark Mode', 'Easily change your website mode from light to dark or dark to light.', '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(8, 'academic_section', 'Academic Menu', 'Access all academic resources and tools in one place, including course materials, grades, and schedules.', '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(9, 'leave_request_section', 'Leave Request', 'Easily request time off and track the status of your leave requests through the Leave Request menu.', '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(10, 'transaction_section', 'All Transactions', 'Manage your finances effectively with the All Transactions menu. View and organize all your transactions in one place.', '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(11, 'notice_board_section', 'Notice Board', 'Stay up to date with the latest news, announcements, and events through the Notice Board menu.', '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(12, 'website_settings_section', 'Website Settings', 'Customize and manage your website easily with the Website Settings feature. Update design, add pages, and optimize settings.', '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(13, 'add_transaction_section', 'Add Transaction', 'Easily add new transactions to keep track of your finances and stay organized.', '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(14, 'recurring_invoices_section', 'Recurring Invoices', 'Save time and automate your billing with recurring invoices. Set up automatic billing schedules for your customers.', '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(15, 'my_course_section', 'My Course', 'Access all of your course information in one place. View lectures, assignments, and grades, and stay up to date on course announcements.', '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(16, 'assignment_section', 'Assignment Page', 'Manage and track your course assignments, deadlines, and grades on a single page. Stay organized and never miss a deadline.', '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(17, 'online_class_section', 'Online Class', 'Join live classes, access course materials, and interact with your peers using the Online Class feature. Stay engaged and learn from anywhere.', '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(18, 'group_chat_section', 'Group Chat', 'Connect and collaborate with your classmates using Group Chat. Share ideas, ask questions, and stay in touch with the community.', '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(19, 'your_children_section', 'Your Children', 'Get started with managing your child\'s academic progress, attendance, and more with our easy-to-use Children section.', '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(20, 'unpaid_invoice_section', 'Unpaid Invoices', 'Manage your unpaid invoices easily and keep track of outstanding payments with our user-friendly interface. Stay on top of your finances and never miss a payment again.', '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(21, 'meeting', 'Meetings', 'Manage your meetings from here.', '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(22, 'event_section', 'Events', 'Manage your events from here.', '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(23, 'admission_plan_section', 'Admission Plan', 'Create a comprehensive plan for the admission process, track progress, and manage applications efficiently.', '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(24, 'student_section', 'Student Management', 'Manage your students from here.', '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(25, 'admission_section', 'Admission Section', 'Manage your admissions from here.', '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(26, 'promotion_section', 'Promotion Section', 'Manage your student promotions from here.', '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(27, 'admission_form_section', 'Admission Form Section', 'Manage your Admission form fields from here.', '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(28, 'users_section', 'User Management', 'Manage your users from here.', '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(29, 'teachers_section', 'Teacher Management', 'Manage your teachers from here.', '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(30, 'holiday_section', 'Holiday Section', 'Manage your holiday section from here.', '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(31, 'report_section', 'Report Section', 'Export your reports from here.', '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(32, 'sms_section', 'SMS Section', 'You can send sms from here to your app users', '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(33, 'syllabus_section', 'Syllabus Section', 'Manage your subject syllabus from here.', '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(34, 'my_schedule_section', 'My Schedule', 'Manage your schedule from here.', '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(35, 'attendance_section', 'Attendance Section', 'Teachers can record student attendance from here.', '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(36, 'exam_section', 'Exam Section', 'Teachers can record all exam data here.', '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(37, 'student_attendance_section', 'Student Attendance Section', 'View subject-wise attendance from here.', '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(38, 'student_result_section', 'Student Result Section', 'View your results from here.', '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(39, 'student_fees_section', 'Student Fees Section', 'View your fees information from here.', '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(40, 'topbar_section', 'Easy topbar', 'Most used settings items are listed in here, you can quickly change your settings from here', '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(41, 'sidebar_section', 'Sidelink bar', 'You can easily visit any page from here', '2024-03-29 03:16:41', '2024-03-29 03:16:41');

-- --------------------------------------------------------

--
-- Table structure for table `online_classes`
--

CREATE TABLE `online_classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_id` text NOT NULL COMMENT 'zoom meeting has an id',
  `class_uuid` text NOT NULL COMMENT 'zoom meeting has an uuid',
  `host_id` text NOT NULL COMMENT 'zoom meeting has host_id',
  `host_email` varchar(255) NOT NULL COMMENT 'zoom meeting has host_email',
  `topic` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL COMMENT 'zoom meeting call agenda',
  `type` int(11) NOT NULL,
  `status` enum('waiting','upcoming','completed') NOT NULL DEFAULT 'waiting',
  `start_time` datetime NOT NULL,
  `timezone` varchar(255) DEFAULT NULL,
  `start_url` longtext NOT NULL,
  `join_url` longtext NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `encrypted_password` varchar(255) DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_no` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `transaction_type` bigint(20) UNSIGNED NOT NULL,
  `payment_type` varchar(255) DEFAULT NULL,
  `amount` varchar(255) NOT NULL,
  `status` enum('paid','unpaid') NOT NULL,
  `type` enum('income','expense') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `phone` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`phone`, `token`, `code`, `created_at`) VALUES
('teacher@fathforce.com', NULL, '343281', '2024-07-05 12:58:20'),
('teacher@fathforce.com', NULL, '105508', '2024-07-05 13:00:35'),
('teacher@fathforce.com', NULL, '846304', '2024-07-05 13:07:27'),
('teacher@fathforce.com', NULL, '314347', '2024-07-05 13:11:28'),
('teacher@fathforce.com', NULL, '781072', '2024-07-05 13:16:48'),
('teacher@fathforce.com', NULL, '917303', '2024-07-05 13:33:42'),
('teacher@fathforce.com', NULL, '887480', '2024-07-05 14:09:18'),
('teacher@fathforce.com', NULL, '946135', '2024-07-05 14:11:34'),
('teacher@fathforce.com', NULL, '219422', '2024-07-06 09:38:14'),
('aidilmaidani@gmail.com', '$2y$10$wvuSRwdkH/z2nihsY2.YNu8T5SopSSlLqqATVChBJGDT3D2o50mza', NULL, '2024-07-08 04:49:56'),
('aidil@fathforce.com', '$2y$10$ETGtiqH.u/FL64AH/ac7FumYcxN3/zjCnt44Ujc3BAAsjGmiB1onu', NULL, '2024-07-08 04:56:15'),
('aidilllll@gmail.com', '$2y$10$DON45DHlQQp1yhWWElzeeuRRAr7HisXO10/p10LDknKdSSAiADS4a', NULL, '2024-07-08 09:56:23'),
('asdhb@gmail.com', '$2y$10$WnG4F33xD8xl65z5qkTUBOA/dGU0O6k8baLDn7do1k7QzzvZmwfNy', NULL, '2024-07-08 10:35:37'),
('sad@dffsf.com', '$2y$10$aZgROlMtWch8yfhthNeY1OtMqP0TZU/iQuqz9uXRYiQg0cJm289IS', NULL, '2024-07-08 10:53:44'),
('taek.kucing.345@gmail.com', '$2y$10$JYt4fzAeyozawnVM57Aolu2aerpeV7SaUYug7K6yncc3TGcWvTVvG', NULL, '2024-07-09 06:34:28'),
('Gilangbn23@fathforce.com', '$2y$10$pPu.ticmqOjBKT0XSZkJJO/GCXM6sgVqU9bBxIK1PrF6ySllskW7y', NULL, '2024-07-11 07:40:36'),
('088222985307', NULL, '370796', '2024-07-17 06:46:22'),
('088222985307', NULL, '223028', '2024-07-17 06:46:31'),
('088222985307', NULL, '386186', '2024-07-17 06:49:55'),
('082117310535', NULL, '828616', '2024-07-17 08:57:25'),
('088222985307', NULL, '208717', '2024-07-17 09:03:01'),
('082117310535', NULL, '208069', '2024-07-23 02:53:07'),
('082117310535', NULL, '317240', '2024-07-23 02:53:49'),
('082117310535', NULL, '532701', '2024-07-23 03:38:42'),
('082117310535', NULL, '600278', '2024-07-23 06:23:30'),
('', '$2y$10$wq52oGGnH5rWpWg3mvJ2ceqzXVliP27CId4Xp76ZDLbskGxr2DJKy', NULL, '2024-07-24 04:00:44'),
('000', '$2y$10$aeguXcYDIGJ/ATk7RpGJ6.ayHak84CqJzyeLulMRv74ABykXTGwoC', NULL, '2024-07-24 08:02:23'),
('012345', '$2y$10$bX/Mv2IVYKmlzpDDYtL4PuO0tmzWdhZ82HCeaZx1udayAsQ1BlwOe', NULL, '2024-07-24 08:08:06'),
('000', '$2y$10$YKLvkXBhtQLP0YJ9GMuCqOjB.zkZNUgdew4c/snugstdHkD2x.v5a', NULL, '2024-07-24 08:15:36'),
('000', '$2y$10$2c3PvaedSjSshxnahEUaOu5idIjQV7wz8ICxicEgCHHWR7Ls/aLDe', NULL, '2024-07-24 08:18:19'),
('09876', '$2y$10$eXkPaq5T2Afr2huze2HItOHPOW/42cSMY66kuaJZdB5K1jrlGFufy', NULL, '2024-07-24 08:23:24'),
('08976', '$2y$10$071jHnGippc/rayH1o6wG.xYxZ8FS0pXHcEfFKqH/YTK6DSnbodc.', NULL, '2024-07-24 08:31:59'),
('0896547', '$2y$10$J09Xx1f9yirfm.E4jtjsEeTy3j9DP5/3wEXJEDw53t3zu7sxocAvu', NULL, '2024-07-24 08:36:53'),
('097865', '$2y$10$hKWUjHsJDJhYPr/KW.ZHOub8/DS88NpXV.bzCF7OqTqzBn8T5fBKq', NULL, '2024-07-24 08:39:04'),
('072526474', '$2y$10$XqphA2GQsFU0khH/fnaj6ex/5DqarOfFVCfmVlmm4BRkXYFO1Qdzu', NULL, '2024-07-24 08:43:42'),
('0526378', '$2y$10$iHJ2j1CxVuJuCOdi571VwOLY102qIqxzUoUma//03pqdG.hIp1G2a', NULL, '2024-07-24 08:46:28'),
('0253681', '$2y$10$9VNVZ3LL7gpoFGUZDw7aeOXjQYa/RGUEOxrW1SNL2nV5UOLzBB8K2', NULL, '2024-07-24 08:48:44'),
('02645178', '$2y$10$EhwNwhunPoRQdl0Uo/yQLO8jL4sZjz1l/dtSsuUXRf//hgruwOCM.', NULL, '2024-07-24 08:50:32'),
('0328263', '$2y$10$u.4XDUyHVR5M9uucA4MXBugJ14Vepebw.FB8kYaPFmEcI.kjLRa7e', NULL, '2024-07-24 08:56:51'),
('0874956', '$2y$10$O8katFq/q5FIg/fm1WkK3.HsUSEkm2b88LObqPxwo0ut7RdMzMc1a', NULL, '2024-07-24 09:02:22'),
('0', '$2y$10$Wmxiq3FfQ5DHUh4ULDS9z.nZtD8lba5qUL3QbHkigFS9L0d3m6j7.', NULL, '2024-07-24 12:25:15'),
('0', '$2y$10$JbiVFo2irF4E6Otvhe.hZuUkcU4gQZ2Lm3FsVYvXWScDamSaQnKtq', NULL, '2024-07-24 12:37:44'),
('0', '$2y$10$TlQVSUqJ0Dz56znn3p504udgj3k9tsct9p05xKoFPW59p24Rf6OBa', NULL, '2024-07-24 12:46:59'),
('0', '$2y$10$yqX7cozIKbqHbj.bMB4mauLTFAiJrlsv0u7DR3Aq469nM7awGESk6', NULL, '2024-07-24 13:00:45'),
('0', '$2y$10$IWSqqe21usX9l62CpusbZ.QS4Sp8a0DCOQ1tRzoDeeh5AcuMUfzru', NULL, '2024-07-24 13:03:51'),
('0', '$2y$10$ShlVFRmNMq1VuZa6NR4u0OdcLCTdXX6SIT1xiQUQhdX22RwW6Om4G', NULL, '2024-07-24 13:06:05'),
('0', '$2y$10$.BK9f0VtUx98BsxXJmAimOEz3g2MWOd5dBfepzJy1fqzQOaTHv1dK', NULL, '2024-07-24 13:07:48'),
('0', '$2y$10$ltn7s9Hi.6Dj/pQMEg76r.YuOtnI7xcZdVWtvi35aPQ5LxqGQpA6G', NULL, '2024-07-24 13:13:31'),
('0', '$2y$10$cG2rIegrewFxjWI1I1GMy.PypdLMBDx82q5NDYdk21y5huNdOVWZe', NULL, '2024-07-24 13:16:02'),
('0', '$2y$10$aDl6thGZ5gDDm38ISIsdyunoyyRtZ0e7ZBOEPpLMvXhcvH5ODcOi6', NULL, '2024-07-24 13:20:20'),
('0', '$2y$10$d25LOwrKtaxNKPnrwYgSTOsLNYCPw9ODVL3kA7SG2uZ96cj8gPYim', NULL, '2024-07-24 13:22:43'),
('0', '$2y$10$5YHYlDNfYqVN/kAC1je4tuVJ4.FwrnEOzvFufYL4YPghigVssxMFq', NULL, '2024-07-24 13:24:25'),
('0', '$2y$10$NiITHUg62wpqfaf48eKo4eAi08lla.hundfbC.yZTpzrjsYoavApC', NULL, '2024-07-24 13:27:15'),
('0', '$2y$10$XcYUPOFex2ZEHNm/9sloUOlfHzWBtAfisMifPR0cKjv1P7D6pzlMm', NULL, '2024-07-24 13:28:49'),
('0', '$2y$10$qS.yBUBawY8A/Od/vvm7G.DpeMdWL2UzcBlrr31stqMWuNtGpzOa6', NULL, '2024-07-24 13:30:26'),
('0', '$2y$10$rgpfM.dfgc21D3mdxia02Ob6zqVqGLPY7wLvmVpG2d/pNm1juurei', NULL, '2024-07-24 13:32:40'),
('0', '$2y$10$evgHQ9icq4tqn.KlgMyyN.jVCnXc89O5E7nea6tP7o9RKQaUhNZd6', NULL, '2024-07-24 13:35:48'),
('0', '$2y$10$m/6HSuXphuKjuCK0X0h3eueS/9ICwOw.edT2k8E.eVYzjTZOhNYFm', NULL, '2024-07-24 13:39:19'),
('0', '$2y$10$ACwEouJBuIwJVmYjsMcD4uYeiXBHCHnXcfCZ.RCeojH9SLki/7Hy2', NULL, '2024-07-24 13:40:24'),
('0', '$2y$10$/aWB82iNvU1Lc4bHYaVIzuuega6DWjfqWQVnNQtMNQbqpWBp/5obq', NULL, '2024-07-24 13:48:53'),
('09825226', '$2y$10$.TktfpxX.pLF.vwwNxN5D.1EMoqAeUVQO2WG953tdtv4lKKqMZPKm', NULL, '2024-07-25 01:27:32'),
('073624716', '$2y$10$Cf1Zsw9UX8ZweTqh4ubJXupauUeS1WC6OMJ6FyFwAev0QvhY2w9ZG', NULL, '2024-07-25 01:40:01'),
('00887536', '$2y$10$Nqp13KXwxLh.R4k.zzh6HOzNhY7jBD9GcHuTLDh7AQEc41wur0IfG', NULL, '2024-07-25 01:44:45'),
('098', '$2y$10$3JswlyfDyuI4Cee3rxhNzuP93HC/cKMrYGnvKhNqH4OEIUjGOh9Am', NULL, '2024-07-25 03:28:09'),
('09878', '$2y$10$yBKaMJoW7ICImw2zfTj7qupSlkTNrjbtW/wuB3KbwS53TU6iqenC6', NULL, '2024-07-25 03:30:38'),
('088222985307', NULL, '853977', '2024-07-25 03:41:33'),
('0897', '$2y$10$4kOelQRfpyInXhy5EMxpaODIomW4u66qTD6KGcNKHYALKDbvSo5e6', NULL, '2024-07-25 03:55:55'),
('0769', '$2y$10$D2cAtW8M/ZtmyiPzSS3b4uV1XGiCwGb1acqskahVECcJxv1cKeMni', NULL, '2024-07-25 04:00:04'),
('0985', '$2y$10$9iIvE089FH95ZWfi5QbYFO5tk2ABJy8zFW5chShRZPd3Y8hgS6OS2', NULL, '2024-07-25 04:03:10'),
('08967', '$2y$10$0zx7RePQRo/sR8M1c/PQqu4aItcGgDAoYIGkOABKpOooGeZhsVPMa', NULL, '2024-07-25 04:05:05'),
('0679', '$2y$10$8aOrsmm6OLaNOHDC0I3Q3.RvhY0q11r1dgHxsnzY46ddjZvCqwAjG', NULL, '2024-07-25 04:08:27'),
('0567', '$2y$10$31IBZ.RHM6OwBrtP9A8zXexBeD1ew9qAOlTXTlIRamxx8VAGD4TBW', NULL, '2024-07-25 04:16:37'),
('099', '$2y$10$MLatCpF6rxZQIkfT0BAayOxOYhN/KEHpYFZdsQJeAkpH1lHH6qBGm', NULL, '2024-07-25 04:22:29'),
('0899', '$2y$10$DAckX.QbWjDr7gVSH3KQgeNeelfTj6VILNis3Ds4cAOhazEMDOyxa', NULL, '2024-07-25 04:30:43'),
('09867', '$2y$10$4r7kAJIoUEf8eUBwWfXSQumwV3Vcwcjv2djERkbuXHRj9RdznBwrK', NULL, '2024-07-25 04:56:06'),
('08967', '$2y$10$dmqJWKoa8VSDErInzPwFG.RkpRSUlMZOZELOI67YOWw7rs9p2iFmq', NULL, '2024-07-25 04:59:16'),
('05678', '$2y$10$Ob9vGOayy0lPTHDmqfbtGO1rPxFARn5HA0LR/38VXXJl/MzJODD5G', NULL, '2024-07-25 05:01:36'),
('067985', '$2y$10$zSZPvhtRWlcB6z3PXl2IIujWxyC77cvOSoLlsH5v9I24EPM9Nplca', NULL, '2024-07-25 05:05:57'),
('0598', '$2y$10$eW5ffDh8Q92OMRyg7nadJep8X6tRzXOQxdra21G3R5qVmuToigWk2', NULL, '2024-07-25 06:12:38'),
('08956', '$2y$10$kWU3gN.3lYL49UI1gGKixuv4uOA.xnuzfluH2lAVjn6V.va3xEcXK', NULL, '2024-07-25 06:15:19'),
('02526', '$2y$10$FQEqKFX20nxL7qVea5TgA.axyEJOcMip1WjFuauuuK0C.tZSoRmqC', NULL, '2024-07-25 06:17:35'),
('037687', '$2y$10$7qhweLh46DkY25IbIIERhuTJ12k4LYJ2Z1X1l6YoOXRmUanoxe1uK', NULL, '2024-07-25 06:27:19'),
('076543', '$2y$10$G94e51YDVR3q4aH15VBH/u4lElYMVGMS5KvsSA9mc3Pm/uuFPNvC.', NULL, '2024-07-25 06:34:32'),
('02345', '$2y$10$0C0RbhGqP0s8ld5hIIx0eeqnFEWpL/T401vdQ.hRLA6jWwk1Mry.W', NULL, '2024-07-25 06:38:42'),
('0123456', '$2y$10$zMdRo3l8GOcIvtEQ.oc3mOXO.ftMCxo4CliUlFoDpm.ySn3dQJtoa', NULL, '2024-07-25 06:41:14'),
('07654', '$2y$10$8FEkQd.QEVA5au44Gx88cu6lbhBeXCkhuXc8D0PPbm4S5aOO2vfoK', NULL, '2024-07-25 06:43:49'),
('0987654', '$2y$10$4/mLJp79tn2S.FG7BPfgmuo7AphencWCDTgzoiilDi6fde9RVr4Ba', NULL, '2024-07-25 06:47:02'),
('0899', '$2y$10$CGkqBxJ6dYS0RNxgFPWJd..FojTIgj3ohfonsIbasCQ0558tYFgRy', NULL, '2024-07-25 06:59:11'),
('088', '$2y$10$WmbNVGI8Wn/vMyWtbNklwulixH5l9z1ctCIG/kIEwcA0FKgNuR5d2', NULL, '2024-07-25 07:04:42'),
('333', '$2y$10$L6cRTTidZXXFxlxCGUqEoeKCI9CTcYpcgutnodvbXMsc2KKU0.80G', NULL, '2024-07-25 07:08:07'),
('099', '$2y$10$XAXnNxbID72wvlNEzuf9V.gPulJvv4JsYgcisRVwzljv3yuD.4lk2', NULL, '2024-07-25 07:11:34'),
('096', '$2y$10$Ca1RdEPG46uBn9mgCjoyL.j0wSxf8GBRXb/lG/WB0dqs2evKD6cQ.', NULL, '2024-07-25 07:15:00'),
('055', '$2y$10$VP2QLon7mQl448qcMUItdOmo2J7EzdCWlGelyJqF95U11cNPvXjM.', NULL, '2024-07-25 07:20:03'),
('087', '$2y$10$53oRqHV/dnrSoY.DyI9qHOR.y.cqw5QmPvNpHIS0iSIGSn/Qmh27i', NULL, '2024-07-25 07:23:08'),
('067', '$2y$10$MHvhHzoHoVdC2AfLGY8JReTvNOherDicw9B9/g28F0PPa92E9YmDe', NULL, '2024-07-25 07:25:27'),
('099', '$2y$10$K354qzCEuyh2aVWqo/4f5.3tmUZ2nkbfF37ohOXjfgN4Tdavba5sm', NULL, '2024-07-25 07:28:00'),
('067', '$2y$10$HZua40DW/ujRJ8FpfgVqY.hDJOB.Zj33kpzg1m4s.Fts4OTaH.8mO', NULL, '2024-07-25 07:32:29'),
('999', '$2y$10$AWoppUfJg3xVY0bJG4PHR.R6cqn5nAcz9kCIqpsnv268TVXkORuaq', NULL, '2024-07-25 07:36:53'),
('077', '$2y$10$8lzinTQyFaMR/6jOd/AY9uy5QkGQJdzLxKaet5gJsAA7QeLA./AQ2', NULL, '2024-07-25 07:40:10'),
('0877', '$2y$10$yAT71NHpE/6j94/gnApfnusRv4hN.faNZclSVFN.TXj2VMLpwZTBC', NULL, '2024-07-25 07:44:50'),
('087', '$2y$10$iQA2WgbCwBfe.3FO2FZlF.sRDvw2RqUZrm731xeu9qbcEiGtmOj3u', NULL, '2024-07-25 07:48:07'),
('0867', '$2y$10$6A.wduMkh6MILKOvMyG9s.AnRM/tH0x1RnC0kN3lDmYRA6tbM0OyW', NULL, '2024-07-25 07:52:10'),
('067', '$2y$10$V6R4vGebkPMHUrMU1LRjXusdFMshSURPZBSbqnbxpE2i1IHyB8AZ2', NULL, '2024-07-25 07:55:14'),
('888', '$2y$10$4n3hxukCqq4a4EMW0jOx1erZq7jFyoGU9qKiiE0WD80uY900/l9kW', NULL, '2024-07-25 08:00:55'),
('987654', '$2y$10$YKDZlaO7PS83gcxMQ0EMB.9S8SQ37bj3ubzp8ImWh0CGxwHeSC33a', NULL, '2024-07-25 08:05:21'),
('098765', '$2y$10$A4EyxILVa6JCKBuFrzYXsex6Ik2UfpYCeA.2lwJO0xTVZKrAiTF0.', NULL, '2024-07-25 08:09:32'),
('0543234567', '$2y$10$jICknCpAbtvsvpPT3cFnVeuwUulE1cDkmoYALpRtKeC6gqJFlFa86', NULL, '2024-07-25 08:12:12'),
('098765', '$2y$10$vg6kzXJv8XTtE4Lf/8kGmu7UBTCERQtT6V/43ZJCZmqtvECY.8Q62', NULL, '2024-07-25 08:17:02'),
('087654', '$2y$10$sp0PCZZhpO5ow/l0Ch0SPepfjh83AmWaV9tMulSiUDsfWa/N8r5p.', NULL, '2024-07-25 08:19:50'),
('0234567', '$2y$10$oGC4i1A9V0jc2OIrcMzg9O3UOL2lxElUD8ziOjiNuWSq5n3ct5kO2', NULL, '2024-07-25 08:23:31'),
('07234', '$2y$10$Q0FlTQdRdAOMt.0YwRw3vOOloPBt7AsHgqJiUe7VPlJjvb.sHvaxu', NULL, '2024-07-25 08:27:02'),
('06234', '$2y$10$oQG45pMNt1FV0XSz3b/cV.uigEEnzh28d2fugHxBo7aKZ8UHYfKnS', NULL, '2024-07-25 08:30:24'),
('07234565', '$2y$10$ZW0V1kjnXOlF2F.c4Q77tOwmHY2o6VGjrcBsp8QLSmZegjZ.yGBNK', NULL, '2024-07-25 08:35:05');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `created_at`, `updated_at`) VALUES
(1, 'roles.index', 'web', 'roles', '2024-03-29 03:16:35', '2024-03-29 03:16:35'),
(2, 'roles.create', 'web', 'roles', '2024-03-29 03:16:35', '2024-03-29 03:16:35'),
(3, 'roles.show', 'web', 'roles', '2024-03-29 03:16:35', '2024-03-29 03:16:35'),
(4, 'roles.edit', 'web', 'roles', '2024-03-29 03:16:35', '2024-03-29 03:16:35'),
(5, 'roles.destroy', 'web', 'roles', '2024-03-29 03:16:35', '2024-03-29 03:16:35'),
(6, 'sms', 'web', 'sms', '2024-03-29 03:16:35', '2024-03-29 03:16:35'),
(7, 'holiday.index', 'web', 'holiday', '2024-03-29 03:16:35', '2024-03-29 03:16:35'),
(8, 'holiday.create', 'web', 'holiday', '2024-03-29 03:16:35', '2024-03-29 03:16:35'),
(9, 'holiday.show', 'web', 'holiday', '2024-03-29 03:16:35', '2024-03-29 03:16:35'),
(10, 'holiday.edit', 'web', 'holiday', '2024-03-29 03:16:35', '2024-03-29 03:16:35'),
(11, 'holiday.destroy', 'web', 'holiday', '2024-03-29 03:16:35', '2024-03-29 03:16:35'),
(12, 'users.index', 'web', 'users', '2024-03-29 03:16:35', '2024-03-29 03:16:35'),
(13, 'users.create', 'web', 'users', '2024-03-29 03:16:35', '2024-03-29 03:16:35'),
(14, 'users.show', 'web', 'users', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(15, 'users.edit', 'web', 'users', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(16, 'users.destroy', 'web', 'users', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(17, 'student.promotion', 'web', 'users', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(18, 'admission.form', 'web', 'users', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(19, 'teacher.list', 'web', 'users', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(20, 'student.list', 'web', 'users', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(21, 'academic.management', 'web', 'Academic Management', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(22, 'group.chat', 'web', 'Academic Management', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(23, 'course.index', 'web', 'Course', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(24, 'course.create', 'web', 'Course', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(25, 'course.edit', 'web', 'Course', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(26, 'course.destroy', 'web', 'Course', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(27, 'subjects.index', 'web', 'subjects', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(28, 'subjects.create', 'web', 'subjects', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(29, 'subjects.show', 'web', 'subjects', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(30, 'subjects.edit', 'web', 'subjects', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(31, 'subjects.destroy', 'web', 'subjects', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(32, 'event.index', 'web', 'event', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(33, 'event.create', 'web', 'event', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(34, 'event.edit', 'web', 'event', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(35, 'event.destroy', 'web', 'event', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(36, 'request-leave.index', 'web', 'request-leave', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(37, 'request-leave.create', 'web', 'request-leave', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(38, 'request-leave.edit', 'web', 'request-leave', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(39, 'request-leave.destroy', 'web', 'request-leave', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(40, 'manage.leave-type', 'web', 'request-leave', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(41, 'online-class.index', 'web', 'Online Class', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(42, 'online-class.create', 'web', 'Online Class', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(43, 'online-class.edit', 'web', 'Online Class', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(44, 'online-class.destroy', 'web', 'Online Class', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(45, 'exam-result.index', 'web', 'Exam Result', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(46, 'exam-result.create', 'web', 'Exam Result', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(47, 'exam-result.edit', 'web', 'Exam Result', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(48, 'exam-result.destroy', 'web', 'Exam Result', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(49, 'admission.index', 'web', 'admission', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(50, 'admission.create', 'web', 'admission', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(51, 'admission.edit', 'web', 'admission', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(52, 'admission.show', 'web', 'admission', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(53, 'admission.destroy', 'web', 'admission', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(54, 'bulk.admission', 'web', 'admission', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(55, 'meeting.index', 'web', 'meeting', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(56, 'meeting.create', 'web', 'meeting', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(57, 'meeting.edit', 'web', 'meeting', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(58, 'meeting.destroy', 'web', 'meeting', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(59, 'notice-board.index', 'web', 'Notice Board', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(60, 'notice-board.create', 'web', 'Notice Board', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(61, 'notice-board.show', 'web', 'Notice Board', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(62, 'notice-board.edit', 'web', 'Notice Board', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(63, 'notice-board.destroy', 'web', 'Notice Board', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(64, 'course-schedule.index', 'web', 'class Schedule', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(65, 'course-schedule.create', 'web', 'class Schedule', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(66, 'course-schedule.edit', 'web', 'class Schedule', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(67, 'course-schedule.destroy', 'web', 'class Schedule', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(68, 'settings', 'web', 'Website Settings', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(69, 'currency', 'web', 'Website Settings', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(70, 'language', 'web', 'Website Settings', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(71, 'report.index', 'web', 'Reports', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(72, 'report.transaction', 'web', 'Reports', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(73, 'report.attendance', 'web', 'Reports', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(74, 'report.other', 'web', 'Reports', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(75, 'assignment.index', 'web', 'assignment', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(76, 'assignment.create', 'web', 'assignment', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(77, 'assignment.show', 'web', 'assignment', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(78, 'assignment.edit', 'web', 'assignment', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(79, 'assignment.destroy', 'web', 'assignment', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(80, 'attendance.index', 'web', 'attendance', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(81, 'attendance.create', 'web', 'attendance', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(82, 'attendance.edit', 'web', 'attendance', '2024-03-29 03:16:36', '2024-03-29 03:16:36'),
(83, 'attendance.destroy', 'web', 'attendance', '2024-03-29 03:16:37', '2024-03-29 03:16:37'),
(84, 'syllabus.index', 'web', 'syllabus', '2024-03-29 03:16:37', '2024-03-29 03:16:37'),
(85, 'syllabus.create', 'web', 'syllabus', '2024-03-29 03:16:37', '2024-03-29 03:16:37'),
(86, 'syllabus.edit', 'web', 'syllabus', '2024-03-29 03:16:37', '2024-03-29 03:16:37'),
(87, 'syllabus.destroy', 'web', 'syllabus', '2024-03-29 03:16:37', '2024-03-29 03:16:37'),
(88, 'transaction-type.index', 'web', 'transaction-type', '2024-03-29 03:16:37', '2024-03-29 03:16:37'),
(89, 'transaction-type.create', 'web', 'transaction-type', '2024-03-29 03:16:37', '2024-03-29 03:16:37'),
(90, 'transaction-type.edit', 'web', 'transaction-type', '2024-03-29 03:16:37', '2024-03-29 03:16:37'),
(91, 'transaction-type.destroy', 'web', 'transaction-type', '2024-03-29 03:16:37', '2024-03-29 03:16:37'),
(92, 'transaction.index', 'web', 'transaction', '2024-03-29 03:16:37', '2024-03-29 03:16:37'),
(93, 'transaction.create', 'web', 'transaction', '2024-03-29 03:16:37', '2024-03-29 03:16:37'),
(94, 'transaction.show', 'web', 'transaction', '2024-03-29 03:16:37', '2024-03-29 03:16:37'),
(95, 'transaction.edit', 'web', 'transaction', '2024-03-29 03:16:37', '2024-03-29 03:16:37'),
(96, 'transaction.destroy', 'web', 'transaction', '2024-03-29 03:16:37', '2024-03-29 03:16:37'),
(97, 'invoice.index', 'web', 'invoice', '2024-03-29 03:16:37', '2024-03-29 03:16:37'),
(98, 'invoice.create', 'web', 'invoice', '2024-03-29 03:16:37', '2024-03-29 03:16:37'),
(99, 'invoice.show', 'web', 'invoice', '2024-03-29 03:16:37', '2024-03-29 03:16:37'),
(100, 'invoice.edit', 'web', 'invoice', '2024-03-29 03:16:37', '2024-03-29 03:16:37'),
(101, 'invoice.destroy', 'web', 'invoice', '2024-03-29 03:16:37', '2024-03-29 03:16:37'),
(102, 'invoice.print', 'web', 'invoice', '2024-03-29 03:16:37', '2024-03-29 03:16:37'),
(103, 'plan.index', 'web', 'plan', '2024-03-29 03:16:37', '2024-03-29 03:16:37'),
(104, 'plan.create', 'web', 'plan', '2024-03-29 03:16:37', '2024-03-29 03:16:37'),
(105, 'plan.edit', 'web', 'plan', '2024-03-29 03:16:37', '2024-03-29 03:16:37'),
(106, 'plan.destroy', 'web', 'plan', '2024-03-29 03:16:37', '2024-03-29 03:16:37'),
(107, 'schedule.index', 'web', 'Schedule', '2024-03-29 03:16:37', '2024-03-29 03:16:37'),
(108, 'schedule.create', 'web', 'Schedule', '2024-03-29 03:16:37', '2024-03-29 03:16:37'),
(109, 'schedule.edit', 'web', 'Schedule', '2024-03-29 03:16:37', '2024-03-29 03:16:37'),
(110, 'schedule.destroy', 'web', 'Schedule', '2024-03-29 03:16:37', '2024-03-29 03:16:37'),
(111, 'admin.dashboard', 'web', 'others', '2024-03-29 03:16:37', '2024-03-29 03:16:37'),
(112, 'teacher.dashboard', 'web', 'others', '2024-03-29 03:16:37', '2024-03-29 03:16:37'),
(113, 'accountant.dashboard', 'web', 'others', '2024-03-29 03:16:37', '2024-03-29 03:16:37'),
(114, 'parent.dashboard', 'web', 'others', '2024-03-29 03:16:37', '2024-03-29 03:16:37'),
(115, 'student.dashboard', 'web', 'others', '2024-03-29 03:16:37', '2024-03-29 03:16:37'),
(116, 'courses.qr-codes', 'web', 'Class QR Codes', '2024-07-10 09:30:51', '2024-07-10 09:30:51'),
(117, 'teacher.attendance', 'web', 'Teacher Attendance', '2024-07-11 02:52:19', '2024-07-11 02:52:19');

-- --------------------------------------------------------

--
-- Table structure for table `permission_attendances`
--

CREATE TABLE `permission_attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `date_permission` date NOT NULL,
  `reason` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 3, 'auth_token', '87f1b4b9f74d78abe1174ecb4323eeb3e696a5f349ffb1f0fbe5e1702f132305', '[\"*\"]', NULL, '2024-07-01 23:24:57', '2024-07-01 23:24:57'),
(3, 'App\\Models\\User', 3, 'auth_token', '7f46b81c09041ea80aca5a517eeeaed58536733e835fce1babfa7c3fb76dec42', '[\"*\"]', '2024-07-03 20:09:45', '2024-07-03 06:47:31', '2024-07-03 20:09:45'),
(4, 'App\\Models\\User', 3, 'auth_token', '14a88a16894406b9158aff27dab6e5a2026011d769773cc1630fd49ed0054619', '[\"*\"]', '2024-07-03 07:03:18', '2024-07-03 07:02:46', '2024-07-03 07:03:18'),
(5, 'App\\Models\\User', 3, 'auth_token', '24ddb6fd00b79831e88a330747cbb11e06938eeddac86b515faa4773024309ef', '[\"*\"]', '2024-07-22 13:26:00', '2024-07-03 19:55:01', '2024-07-22 13:26:00'),
(6, 'App\\Models\\User', 3, 'auth_token', 'd7de75707fc98b39e915f3e6c6e1464766d7ea295c69d62505c63a30c5b14682', '[\"*\"]', '2024-07-05 03:33:18', '2024-07-04 05:06:30', '2024-07-05 03:33:18'),
(7, 'App\\Models\\User', 3, 'auth_token', '841ab5e07160a20a0cdd92469e0a86e119a22b8a381bd2eec9e8104ddf2f42c3', '[\"*\"]', NULL, '2024-07-04 07:25:56', '2024-07-04 07:25:56'),
(8, 'App\\Models\\User', 3, 'auth_token', 'ed74c8ce5b65e1f6927e34bac1d08d5baf013c8b391b7075775270797ab3de66', '[\"*\"]', '2024-07-06 10:20:30', '2024-07-05 04:24:09', '2024-07-06 10:20:30'),
(9, 'App\\Models\\User', 3, 'auth_token', '8d1ba50ca5003d526549c481d902fce6b36a0498770bd9fa2641237bc7e84f84', '[\"*\"]', '2024-07-05 14:00:55', '2024-07-05 13:34:29', '2024-07-05 14:00:55'),
(10, 'App\\Models\\User', 3, 'auth_token', 'ae5b85f497d441cae83f2490d772ef36229e416b55469995ebb0b2566c40276a', '[\"*\"]', NULL, '2024-07-06 01:53:37', '2024-07-06 01:53:37'),
(11, 'App\\Models\\User', 3, 'auth_token', '7973065446716407b437eb1462814f12ea73362c092888a18fb70760d93b819a', '[\"*\"]', NULL, '2024-07-06 06:15:13', '2024-07-06 06:15:13'),
(12, 'App\\Models\\User', 3, 'auth_token', '839ef79892722211817e5782201d08ef0d0a0880dbc48ba58714e9a1eea13308', '[\"*\"]', NULL, '2024-07-06 09:39:17', '2024-07-06 09:39:17'),
(13, 'App\\Models\\User', 3, 'auth_token', 'b5c127cb9ba996159b9af698adf6b7d8faf1bff443263a7fc2c491513d188939', '[\"*\"]', '2024-07-19 13:34:11', '2024-07-06 10:05:52', '2024-07-19 13:34:11'),
(14, 'App\\Models\\User', 3, 'auth_token', '9c5d2ff454c6e8ea67f20144fbce40021d55e8c0cac7e3597c8fc2204591e174', '[\"*\"]', '2024-07-16 09:41:08', '2024-07-11 07:49:23', '2024-07-16 09:41:08'),
(15, 'App\\Models\\User', 5, 'auth_token', 'd578cc3910fb9b7ec53422f3419bafee282cac8d298f4aadd15fc28e619961ce', '[\"*\"]', '2024-07-16 09:43:05', '2024-07-16 09:30:20', '2024-07-16 09:43:05'),
(16, 'App\\Models\\User', 3, 'auth_token', 'e6e25db0ea7c64cd460aa72cb3f57d952591d8ca90086021861fda9e0689b7e6', '[\"*\"]', '2024-07-17 06:52:48', '2024-07-17 06:51:20', '2024-07-17 06:52:48'),
(17, 'App\\Models\\User', 1, 'auth_token', '4d7f6018b1e1b03b63e83a27a4f1cfebfc13251eb23772a477cd751b4c712a2e', '[\"*\"]', '2024-07-23 11:56:30', '2024-07-17 08:58:12', '2024-07-23 11:56:30'),
(19, 'App\\Models\\User', 3, 'auth_token', '53963bac3090596c125e496a1d1c3ece201432e8cdd927330ad5d732bfbbe582', '[\"*\"]', '2024-07-19 14:05:54', '2024-07-17 09:08:19', '2024-07-19 14:05:54'),
(20, 'App\\Models\\User', 3, 'auth_token', '1e2e83017f361dad801ab89168cf875a8945c6186cd3187bb9fbcbe4ebc8ad9b', '[\"*\"]', NULL, '2024-07-17 09:41:32', '2024-07-17 09:41:32'),
(24, 'App\\Models\\User', 3, 'auth_token', 'f52df59035d2a0cb22c20a37679944c392359a2b07a59dc29849b66147985552', '[\"*\"]', '2024-07-19 06:52:30', '2024-07-18 02:54:35', '2024-07-19 06:52:30'),
(26, 'App\\Models\\User', 3, 'auth_token', '043a370b5185ba351c9863b7197f840c5abf8862454ce88f236057fe6b80c899', '[\"*\"]', '2024-07-23 10:37:38', '2024-07-18 04:57:11', '2024-07-23 10:37:38'),
(28, 'App\\Models\\User', 3, 'auth_token', 'b007240f6bb63704e019c878cdecf2dd06c7bcec11cfc3e42653339448cf2f71', '[\"*\"]', '2024-07-18 06:56:20', '2024-07-18 06:56:17', '2024-07-18 06:56:20'),
(31, 'App\\Models\\User', 3, 'auth_token', 'fd554be688c619cf1cca62a8bb0e057b6115a5b9eeb4675f5273b75bbe1c3d54', '[\"*\"]', '2024-07-22 07:30:58', '2024-07-19 06:45:47', '2024-07-22 07:30:58'),
(32, 'App\\Models\\User', 3, 'auth_token', '28f1ed445588b0fce12fa193418ccadbd795fa740347294f5cbbe31f3ddb5b00', '[\"*\"]', '2024-07-22 08:16:07', '2024-07-19 07:31:41', '2024-07-22 08:16:07'),
(36, 'App\\Models\\User', 3, 'auth_token', 'd4d4b5ac702208960eddaad86fa5d6652c81812f7f353d5d88d2096185d2d665', '[\"*\"]', '2024-07-22 13:52:04', '2024-07-22 03:16:17', '2024-07-22 13:52:04'),
(37, 'App\\Models\\User', 3, 'auth_token', 'f0978274f53f0de464eaf3d662b14a5b8ac5be4a2e23ea4e613c6220c060c40e', '[\"*\"]', '2024-07-22 04:30:46', '2024-07-22 04:18:30', '2024-07-22 04:30:46'),
(41, 'App\\Models\\User', 3, 'auth_token', '06690f57aedc3a1e6175320e75bc5d5f8a4386d87b15d7e1bcda3d9f68cb5a06', '[\"*\"]', '2024-07-22 07:59:22', '2024-07-22 06:13:29', '2024-07-22 07:59:22'),
(43, 'App\\Models\\User', 3, 'auth_token', 'b0aedfe6b621dcb570fb34eb0fb8dd4297e5dbd55a218241b743d19072582609', '[\"*\"]', '2024-07-23 13:03:57', '2024-07-22 10:17:06', '2024-07-23 13:03:57'),
(45, 'App\\Models\\User', 3, 'auth_token', 'c384926428355206ecb5fbca09edd8ba17f7d98993cadd496c84709e1033702c', '[\"*\"]', '2024-07-23 13:05:59', '2024-07-23 03:07:09', '2024-07-23 13:05:59'),
(51, 'App\\Models\\User', 3, 'auth_token', 'da9948ce95fb2c45096f130d6295b286c841924ed0631e7b42dce5ce79a7e7d3', '[\"*\"]', '2024-07-23 17:19:42', '2024-07-23 03:52:05', '2024-07-23 17:19:42'),
(56, 'App\\Models\\User', 145, 'auth_token', 'dd735c5565870672f0eda8106556cec1111253891db2bd959b165d17e5d4d7f9', '[\"*\"]', '2024-07-23 12:11:17', '2024-07-23 06:53:42', '2024-07-23 12:11:17'),
(62, 'App\\Models\\User', 5, 'auth_token', 'cdf8eb3c955865e4aa04a413957db668fe2e278dc41e0db04645d0bbe2e42ee4', '[\"*\"]', '2024-07-23 08:22:46', '2024-07-23 08:21:48', '2024-07-23 08:22:46'),
(66, 'App\\Models\\User', 3, 'auth_token', '34d3b7405b5db437d6cab9e9d8a870f7a7cf0dde28a319c62c273bc257eed7c9', '[\"*\"]', '2024-07-24 06:36:52', '2024-07-24 02:06:26', '2024-07-24 06:36:52'),
(67, 'App\\Models\\User', 5, 'auth_token', '9654c2919d7d0b8d242b52b4ab566b660d29737d23e0b297e4aed95c4c03ace0', '[\"*\"]', '2024-07-24 03:23:55', '2024-07-24 02:13:16', '2024-07-24 03:23:55'),
(69, 'App\\Models\\User', 3, 'auth_token', 'e425d1c3434599c624bf60a88c2778748f99c91df7c5c7324637136100d86d03', '[\"*\"]', '2024-07-24 03:36:23', '2024-07-24 03:25:52', '2024-07-24 03:36:23'),
(70, 'App\\Models\\User', 5, 'auth_token', 'dfb69eabb2eeab67fa011481483d4c465aec1bcd8315a1ab2c18f30fbccfa48c', '[\"*\"]', '2024-07-24 06:42:13', '2024-07-24 05:55:02', '2024-07-24 06:42:13'),
(71, 'App\\Models\\User', 5, 'auth_token', '0480e407df7d14d20923ee4ff547027f18b248e78ac3ea5a12bdf2ca0efb73bb', '[\"*\"]', '2024-07-24 07:06:35', '2024-07-24 07:06:33', '2024-07-24 07:06:35'),
(72, 'App\\Models\\User', 5, 'auth_token', '3905258d9c998443779ab4ee012a6f90a5eeeb1f80d4cfac49ea9996a5e357a2', '[\"*\"]', '2024-07-24 12:57:18', '2024-07-24 07:07:31', '2024-07-24 12:57:18'),
(74, 'App\\Models\\User', 5, 'auth_token', 'bcb1679d58a7d2b320af79bb46e2428934932f78e4451afba2523d44b7f377fa', '[\"*\"]', '2024-07-24 08:28:43', '2024-07-24 08:28:39', '2024-07-24 08:28:43'),
(76, 'App\\Models\\User', 5, 'auth_token', '44576bb40a8edddf7880df3e3086944d9ecbf0194b068b26f5dbf2790bb653a6', '[\"*\"]', '2024-07-24 10:03:45', '2024-07-24 09:20:44', '2024-07-24 10:03:45'),
(77, 'App\\Models\\User', 3, 'auth_token', 'e2b3b318b97266cd143afb477225abd2c452f797d541cf775657d1f2f23a1a2b', '[\"*\"]', '2024-07-24 10:04:18', '2024-07-24 10:03:57', '2024-07-24 10:04:18'),
(78, 'App\\Models\\User', 3, 'auth_token', 'd06ce3a481c2db489b6531f2c3a18c69a95fbf4470109e475b8db74917b5ddc5', '[\"*\"]', '2024-07-25 04:26:29', '2024-07-24 11:03:22', '2024-07-25 04:26:29'),
(81, 'App\\Models\\User', 3, 'auth_token', '12d2f336e29d637ea8d711faaceac3d6596799095164ab3664afe51477de3fa3', '[\"*\"]', '2024-07-24 13:47:06', '2024-07-24 12:01:38', '2024-07-24 13:47:06'),
(82, 'App\\Models\\User', 5, 'auth_token', 'f35f3a0881d58f6559e284fcd90b143e58e8bb09bb569493be972e18a52505b1', '[\"*\"]', '2024-07-24 13:05:46', '2024-07-24 13:04:34', '2024-07-24 13:05:46'),
(83, 'App\\Models\\User', 5, 'auth_token', 'f4ab1f5521165b829cd54a87d80319073b6d1ff1cf99142a3a9f3962e7e153e1', '[\"*\"]', NULL, '2024-07-24 13:07:13', '2024-07-24 13:07:13'),
(84, 'App\\Models\\User', 5, 'auth_token', 'b57c4660efa085a7d0830da4cc4108f3ffb39c89d1531525ea14f472310d458e', '[\"*\"]', '2024-07-24 13:09:41', '2024-07-24 13:08:09', '2024-07-24 13:09:41'),
(89, 'App\\Models\\User', 5, 'auth_token', '4794595f3e40967d359bb9178fd24d6dde506432db30d5a34aab149bfec76e42', '[\"*\"]', '2024-07-25 09:29:46', '2024-07-25 09:06:48', '2024-07-25 09:29:46'),
(90, 'App\\Models\\User', 5, 'auth_token', '105a492c7a8b5fa8ecfb2a3eb964b15b4912ef481a6ccdbff74d2a261facd23e', '[\"*\"]', '2024-07-25 09:33:50', '2024-07-25 09:33:26', '2024-07-25 09:33:50'),
(92, 'App\\Models\\User', 3, 'auth_token', '676aa67cc582b3bce65b0bccad799bb4a862221198e1c4fc041063c536694994', '[\"*\"]', '2024-07-26 09:28:27', '2024-07-25 09:38:02', '2024-07-26 09:28:27'),
(93, 'App\\Models\\User', 5, 'auth_token', '68ad345c206902280ceb05b8292018ae69e4786ae6948ba3c2b48da5c2b9a644', '[\"*\"]', '2024-07-25 09:53:35', '2024-07-25 09:53:11', '2024-07-25 09:53:35'),
(94, 'App\\Models\\User', 3, 'auth_token', 'c3d6009ea3b7b244a1cb5d7aca774a5edaa2bc476f7e19f1d6c7dce662166b19', '[\"*\"]', '2024-07-26 03:21:32', '2024-07-26 03:20:50', '2024-07-26 03:21:32'),
(95, 'App\\Models\\User', 5, 'auth_token', '45ce4583f0d968a10d3ca165a03b93693acd595f45965d9743c8d2c0040f2351', '[\"*\"]', '2024-07-26 07:17:38', '2024-07-26 07:15:36', '2024-07-26 07:17:38'),
(96, 'App\\Models\\User', 3, 'auth_token', '2d9d5496846a8580d673f4593a5586fe8025588e343a598d6d42755383b266b8', '[\"*\"]', '2024-07-26 07:20:19', '2024-07-26 07:20:19', '2024-07-26 07:20:19'),
(97, 'App\\Models\\User', 3, 'auth_token', '9b859a1a952f9bd31cdd8fd28836db11828a7b625552928f1e3d62fb48d9f85d', '[\"*\"]', '2024-07-26 07:24:14', '2024-07-26 07:23:21', '2024-07-26 07:24:14'),
(98, 'App\\Models\\User', 3, 'auth_token', '12212834491d08350874b5112674dad342880b62dfab4ce9a8c7d72f7945f23e', '[\"*\"]', '2024-07-26 07:30:42', '2024-07-26 07:28:22', '2024-07-26 07:30:42'),
(99, 'App\\Models\\User', 3, 'auth_token', '1594a6ee5dda942990f809e292279e81a668262db8a28c570ae835fbe351a384', '[\"*\"]', '2024-07-26 07:29:45', '2024-07-26 07:29:44', '2024-07-26 07:29:45'),
(100, 'App\\Models\\User', 5, 'auth_token', '377a251dbba348078f69cadfbf81cf3823549756a0be35fe3b6442c3a3a50c32', '[\"*\"]', '2024-07-26 08:22:01', '2024-07-26 07:39:30', '2024-07-26 08:22:01'),
(101, 'App\\Models\\User', 5, 'auth_token', '37a153ce75523a9d549cafbd90e2a10f625d8796184da8defaa15098a9b15c93', '[\"*\"]', '2024-07-26 09:11:16', '2024-07-26 09:11:15', '2024-07-26 09:11:16'),
(102, 'App\\Models\\User', 5, 'auth_token', '186642f80be7d931ddd695e54050f181b8e5d88d846fc6e40189cfd6e522bb0c', '[\"*\"]', '2024-07-26 09:51:53', '2024-07-26 09:29:37', '2024-07-26 09:51:53'),
(103, 'App\\Models\\User', 5, 'auth_token', '635ce4fecbba62da13193fcb118486d63b998636cd66e35b54a0c12912539c0b', '[\"*\"]', '2024-07-27 07:18:36', '2024-07-27 07:13:58', '2024-07-27 07:18:36'),
(104, 'App\\Models\\User', 5, 'auth_token', 'd5b757ac410303112a9d1f36f92c6886ef48871dcb287497c589e4f23d381ede', '[\"*\"]', '2024-07-27 07:51:36', '2024-07-27 07:30:18', '2024-07-27 07:51:36'),
(105, 'App\\Models\\User', 5, 'auth_token', '053d5ea86d63db41a6bec53511574d80839d932649f02a6a0daa664bd4651e92', '[\"*\"]', '2024-07-27 08:09:21', '2024-07-27 08:09:21', '2024-07-27 08:09:21'),
(108, 'App\\Models\\User', 5, 'auth_token', '3469078f2cedcc4709574b5b4e2caeac6ef3f6f0fd626d4c439bc6d86ff2f8c8', '[\"*\"]', '2024-07-29 04:35:56', '2024-07-29 04:23:06', '2024-07-29 04:35:56'),
(109, 'App\\Models\\User', 3, 'auth_token', 'd2f683cd2534dbc684874fe1f4f1f13f7e464c496b0094708a56edbd80290f1a', '[\"*\"]', '2024-07-29 04:36:32', '2024-07-29 04:36:31', '2024-07-29 04:36:32');

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `currency` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `title`, `slug`, `price`, `description`, `course_id`, `created_at`, `updated_at`, `currency`) VALUES
(7, 'SPP', 'spp', '0', 'SPP', 33, '2024-07-24 04:35:56', '2024-07-24 04:35:56', 'IDR'),
(8, 'SPP', 'spp', '0', 'SPP', 34, '2024-07-24 04:46:10', '2024-07-24 04:46:10', 'IDR'),
(9, 'SPP', 'spp', '0', 'SPP', 35, '2024-07-24 04:46:33', '2024-07-24 04:46:33', 'IDR'),
(10, 'BAJU JURUSAN', 'baju-jurusan', '0', 'BAJU JURUSAN', 36, '2024-07-24 04:47:10', '2024-07-24 04:47:10', 'IDR'),
(11, 'BAJU JURUSAN', 'baju-jurusan', '0', 'BAJU JURUSAN', 37, '2024-07-24 04:47:35', '2024-07-24 04:47:35', 'IDR'),
(12, 'BAJU JURUSAN', 'baju-jurusan', '99', 'BAJU JURUSAN', 38, '2024-07-24 04:48:08', '2024-07-24 04:48:08', 'IDR'),
(13, 'PSAS', 'psas', '0', 'PSAS', 39, '2024-07-24 04:48:53', '2024-07-24 04:48:53', 'IDR'),
(14, 'PSAS', 'psas', '0', 'PSAS', 40, '2024-07-24 04:49:21', '2024-07-24 04:49:21', 'IDR'),
(15, 'PSAS', 'psas', '0', 'PSAS', 41, '2024-07-24 04:49:55', '2024-07-24 04:49:55', 'IDR'),
(16, 'BATIK SEKOLAH', 'batik-sekolah', '0', 'BATIK SEKOLAH', 42, '2024-07-24 04:50:42', '2024-07-24 04:50:42', 'IDR'),
(17, 'BATIK SEKOLAH', 'batik-sekolah', '0', 'BATIK SEKOLAH', 43, '2024-07-24 04:51:12', '2024-07-24 04:51:12', 'IDR'),
(18, 'SCODER', 'scoder', '0', 'SCODER', 44, '2024-07-24 04:51:46', '2024-07-24 04:51:46', 'IDR'),
(19, 'SCODER', 'scoder', '0', 'SCODER', 45, '2024-07-24 04:52:11', '2024-07-24 04:52:11', 'IDR'),
(20, 'BAJU OLAHRAGA', 'baju-olahraga', '0', 'BAJU OLAHRAGA', 46, '2024-07-24 04:53:06', '2024-07-24 04:53:06', 'IDR'),
(21, 'BAJU OLAHRAGA', 'baju-olahraga', '0', 'BAJU OLAHRAGA', 47, '2024-07-24 04:53:41', '2024-07-24 04:53:41', 'IDR'),
(22, 'ALAT MUSIK', 'alat-musik', '0', 'ALAT MUSIK', 48, '2024-07-24 04:54:40', '2024-07-24 04:54:40', 'IDR'),
(23, 'ALAT MUSIK', 'alat-musik', '0', 'ALAT MUSIK', 49, '2024-07-24 04:55:03', '2024-07-24 04:55:03', 'IDR'),
(24, 'SPP', 'spp', '0', 'SPP', 50, '2024-07-24 09:55:55', '2024-07-24 09:55:55', 'IDR'),
(25, 'SPP', 'spp', '0', 'SPP', 51, '2024-07-24 09:56:22', '2024-07-24 09:56:22', 'IDR'),
(26, 'BAJU JURUSAN', 'baju-jurusan', '0', 'BAJU JURUSAN', 52, '2024-07-24 09:57:15', '2024-07-24 09:57:15', 'IDR'),
(27, 'BAJU JURUSAN', 'baju-jurusan', '0', 'BAJU JURUSAN', 53, '2024-07-24 09:57:47', '2024-07-24 09:57:47', 'IDR'),
(28, 'BAJU JURUSAN', 'baju-jurusan', '0', 'BAJU JURUSAN', 54, '2024-07-24 09:58:19', '2024-07-24 09:58:19', 'IDR'),
(29, 'JAS JURUSAN', 'jas-jurusan', '0', 'JAS JURUSAN', 55, '2024-07-24 09:58:55', '2024-07-24 09:58:55', 'IDR'),
(30, 'JAS JURUSAN', 'jas-jurusan', '0', 'JAS JURUSAN', 56, '2024-07-24 09:59:21', '2024-07-24 09:59:21', 'IDR'),
(31, 'JAS JURUSAN', 'jas-jurusan', '0', 'JAS JURUSAN', 57, '2024-07-24 09:59:53', '2024-07-24 09:59:53', 'IDR'),
(32, 'KABEL', 'kabel', '0', 'KABEL', 58, '2024-07-24 10:00:38', '2024-07-24 10:00:38', 'IDR'),
(33, 'KABEL', 'kabel', '0', 'KABEL', 59, '2024-07-24 10:01:22', '2024-07-24 10:01:22', 'IDR'),
(34, 'KABEL', 'kabel', '0', 'KABEL', 60, '2024-07-24 10:01:46', '2024-07-24 10:01:46', 'IDR'),
(35, 'KERTAS HVS', 'kertas-hvs', '0', 'KERTAS HVS', 61, '2024-07-24 10:02:26', '2024-07-24 10:02:26', 'IDR'),
(36, 'KERTAS HVS', 'kertas-hvs', '0', 'KERTAS HVS', 62, '2024-07-24 10:03:12', '2024-07-24 10:03:12', 'IDR'),
(37, 'KALKULATOR', 'kalkulator', '0', 'KALKULATOR', 63, '2024-07-24 10:03:41', '2024-07-24 10:03:41', 'IDR'),
(38, 'KALKULATOR', 'kalkulator', '0', 'KALKULATOR', 64, '2024-07-24 10:04:04', '2024-07-24 10:04:04', 'IDR'),
(39, 'GAMELAN', 'gamelan', '0', 'GAMELAN', 65, '2024-07-24 10:04:25', '2024-07-24 10:04:25', 'IDR');

-- --------------------------------------------------------

--
-- Table structure for table `plan_benefits`
--

CREATE TABLE `plan_benefits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `plan_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plan_benefits`
--

INSERT INTO `plan_benefits` (`id`, `plan_id`, `title`, `amount`, `created_at`, `updated_at`) VALUES
(7, 7, '-', '0', '2024-07-24 04:35:56', '2024-07-24 04:35:56'),
(8, 8, '-', '0', '2024-07-24 04:46:10', '2024-07-24 04:46:10'),
(9, 9, '-', '0', '2024-07-24 04:46:33', '2024-07-24 04:46:33'),
(10, 10, '-', '0', '2024-07-24 04:47:10', '2024-07-24 04:47:10'),
(11, 11, '-', '0', '2024-07-24 04:47:35', '2024-07-24 04:47:35'),
(12, 12, '-', '99', '2024-07-24 04:48:08', '2024-07-24 04:48:08'),
(13, 13, '-', '0', '2024-07-24 04:48:53', '2024-07-24 04:48:53'),
(14, 14, '-', '0', '2024-07-24 04:49:21', '2024-07-24 04:49:21'),
(15, 15, '-', '0', '2024-07-24 04:49:55', '2024-07-24 04:49:55'),
(16, 16, '-', '0', '2024-07-24 04:50:42', '2024-07-24 04:50:42'),
(17, 17, '-', '0', '2024-07-24 04:51:12', '2024-07-24 04:51:12'),
(18, 18, '-', '0', '2024-07-24 04:51:46', '2024-07-24 04:51:46'),
(19, 19, '-', '0', '2024-07-24 04:52:11', '2024-07-24 04:52:11'),
(20, 20, '-', '0', '2024-07-24 04:53:06', '2024-07-24 04:53:06'),
(22, 21, '-', '0', '2024-07-24 04:53:48', '2024-07-24 04:53:48'),
(23, 22, '-', '0', '2024-07-24 04:54:40', '2024-07-24 04:54:40'),
(24, 23, '-', '0', '2024-07-24 04:55:03', '2024-07-24 04:55:03'),
(25, 24, '-', '000', '2024-07-24 09:55:55', '2024-07-24 09:55:55'),
(26, 25, '-', '000', '2024-07-24 09:56:22', '2024-07-24 09:56:22'),
(27, 26, '-', '000', '2024-07-24 09:57:15', '2024-07-24 09:57:15'),
(28, 27, '-', '000', '2024-07-24 09:57:47', '2024-07-24 09:57:47'),
(29, 28, '-', '000', '2024-07-24 09:58:19', '2024-07-24 09:58:19'),
(30, 29, '-', '000', '2024-07-24 09:58:55', '2024-07-24 09:58:55'),
(31, 30, '-', '000', '2024-07-24 09:59:21', '2024-07-24 09:59:21'),
(32, 31, '-', '000', '2024-07-24 09:59:53', '2024-07-24 09:59:53'),
(33, 32, '-', '0', '2024-07-24 10:00:38', '2024-07-24 10:00:38'),
(34, 33, '-', '0', '2024-07-24 10:01:22', '2024-07-24 10:01:22'),
(35, 34, '-', '0', '2024-07-24 10:01:46', '2024-07-24 10:01:46'),
(36, 35, '-', '0', '2024-07-24 10:02:26', '2024-07-24 10:02:26'),
(37, 36, '-', '0', '2024-07-24 10:03:12', '2024-07-24 10:03:12'),
(38, 37, '-', '0', '2024-07-24 10:03:41', '2024-07-24 10:03:41'),
(39, 38, '-', '0', '2024-07-24 10:04:04', '2024-07-24 10:04:04'),
(40, 39, '-', '0', '2024-07-24 10:04:25', '2024-07-24 10:04:25');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quotes`
--

CREATE TABLE `quotes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quote` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quotes`
--

INSERT INTO `quotes` (`id`, `quote`, `created_at`, `updated_at`) VALUES
(1, 'Jalani harimu dengan senyuman.', '2024-07-14 01:55:36', '2024-07-14 01:55:36'),
(2, 'Salam SaJuTa!.', '2024-07-14 02:07:01', '2024-07-14 02:07:01'),
(5, 'Hidup adalah tentang belajar, berjuang, dan berkembang.', '2024-07-14 10:58:31', '2024-07-14 10:58:31'),
(6, 'Setiap langkah kecil adalah kemajuan menuju tujuan besar.', '2024-07-14 10:58:31', '2024-07-14 10:58:31'),
(7, 'Keberhasilan dimulai dari tekad dan kerja keras.', '2024-07-14 10:58:31', '2024-07-14 10:58:31'),
(8, 'Jangan pernah menyerah pada impianmu.', '2024-07-14 10:58:31', '2024-07-14 10:58:31'),
(9, 'Kegigihan adalah kunci utama kesuksesan.', '2024-07-14 10:58:31', '2024-07-14 10:58:31'),
(10, 'Hidup adalah tentang memberi arti pada setiap langkah.', '2024-07-14 10:58:31', '2024-07-14 10:58:31'),
(11, 'Percaya pada dirimu sendiri adalah langkah pertama menuju keberhasilan.', '2024-07-14 10:58:31', '2024-07-14 10:58:31'),
(12, 'Bersyukur atas apa yang kamu miliki hari ini.', '2024-07-14 10:58:31', '2024-07-14 10:58:31'),
(13, 'Jadilah alasan seseorang tersenyum hari ini.', '2024-07-14 10:58:31', '2024-07-14 10:58:31'),
(14, 'Kesuksesan dimulai dari keputusan untuk mencoba.', '2024-07-14 10:58:31', '2024-07-14 10:58:31'),
(15, 'Rencanakan, percayalah, lakukan, ulangi.', '2024-07-14 10:58:31', '2024-07-14 10:58:31'),
(16, 'Setiap hari adalah kesempatan untuk menjadi versi yang lebih baik dari dirimu sendiri.', '2024-07-14 10:58:31', '2024-07-14 10:58:31'),
(17, 'Kesuksesan bukanlah kunci kebahagiaan. Kebahagiaanlah kunci kesuksesan.', '2024-07-14 10:58:31', '2024-07-14 10:58:31'),
(18, 'Buat hari ini lebih baik dari kemarin.', '2024-07-14 10:58:31', '2024-07-14 10:58:31'),
(19, 'Semua mimpi bisa menjadi kenyataan jika kita memiliki keberanian untuk mengejarnya.', '2024-07-14 10:58:31', '2024-07-14 10:58:31'),
(20, 'Hidup ini singkat, jadilah alasan seseorang tersenyum hari ini.', '2024-07-14 10:58:31', '2024-07-14 10:58:31'),
(21, 'Kerja keras adalah kuncinya, impianmu adalah mimpimu.', '2024-07-14 10:58:31', '2024-07-14 10:58:31'),
(22, 'Tantanglah dirimu sendiri untuk menjadi lebih baik dari hari sebelumnya.', '2024-07-14 10:58:31', '2024-07-14 10:58:31'),
(23, 'Kesuksesan dimulai dengan percaya pada dirimu sendiri.', '2024-07-14 10:58:31', '2024-07-14 10:58:31'),
(24, 'Ketika tidak ada yang benar, lakukan yang benar.', '2024-07-14 10:58:31', '2024-07-14 10:58:31'),
(25, 'Saat kamu mencari alasan untuk tidak melakukannya, seseorang lain sedang mencari cara untuk melakukannya.', '2024-07-14 10:58:31', '2024-07-14 10:58:31'),
(26, 'Bersyukurlah hari ini, karena hidup adalah pilihan.', '2024-07-14 10:58:31', '2024-07-14 10:58:31'),
(27, 'Kesuksesan adalah sekolah yang tidak pernah ada ujian masuknya.', '2024-07-14 10:58:31', '2024-07-14 10:58:31'),
(28, 'Tidak ada gunanya menunggu saat yang tepat, saat yang tepat adalah sekarang.', '2024-07-14 10:58:31', '2024-07-14 10:58:31'),
(29, 'Hidup adalah apa yang kamu buat darinya.', '2024-07-14 10:58:31', '2024-07-14 10:58:31'),
(30, 'Keberhasilan dimulai dari ketidaknyamanan.', '2024-07-14 10:58:31', '2024-07-14 10:58:31'),
(31, 'Jangan pernah menyerah, karena yang kamu tanam hari ini adalah yang kamu tuai besok.', '2024-07-14 10:58:31', '2024-07-14 10:58:31'),
(32, 'Saat kamu melihat masa depan yang cerah, kamu tidak akan terlihat mundur.', '2024-07-14 10:58:31', '2024-07-14 10:58:31'),
(33, 'Jadilah alasan seseorang tersenyum hari ini, karena setiap hari adalah hari yang indah untuk tersenyum.', '2024-07-14 10:58:31', '2024-07-14 10:58:31'),
(34, 'Percaya pada dirimu sendiri adalah kuncinya, dan segalanya mungkin.', '2024-07-14 10:58:31', '2024-07-14 10:58:31'),
(35, 'Tak ada yang harus kamu buktikan, kecuali pada dirimu sendiri.', '2024-07-14 10:58:31', '2024-07-14 10:58:31'),
(36, 'Rencana hari ini untuk hari yang lebih baik besok.', '2024-07-14 10:58:31', '2024-07-14 10:58:31'),
(37, 'Impian adalah bintang-bintang dari jalan kita.', '2024-07-14 10:58:31', '2024-07-14 10:58:31'),
(38, 'Kebahagiaan adalah bagian dari perjalanan, bukan tujuan.', '2024-07-14 10:58:31', '2024-07-14 10:58:31'),
(39, 'Keberanian bukanlah keberhasilan tanpa kegagalan.', '2024-07-14 10:58:31', '2024-07-14 10:58:31'),
(40, 'Kesuksesan adalah hasil dari kemauan untuk menanggung kesulitan.', '2024-07-14 10:58:31', '2024-07-14 10:58:31'),
(41, 'Jika kamu menyelesaikan apa yang sudah kamu mulai, kamu akan mencapai lebih dari yang kamu bayangkan.', '2024-07-14 10:58:31', '2024-07-14 10:58:31'),
(42, 'Hidup adalah tentang bertumbuh melalui apa yang kamu alami.', '2024-07-14 10:58:31', '2024-07-14 10:58:31'),
(43, 'Tidak ada jalan pintas menuju sukses.', '2024-07-14 10:58:31', '2024-07-14 10:58:31'),
(44, 'Saat kamu mencari hal yang baik, hal-hal baik datang kepadamu.', '2024-07-14 10:58:31', '2024-07-14 10:58:31'),
(45, 'Bersabarlah dengan dirimu sendiri, pertumbuhan membutuhkan waktu.', '2024-07-14 10:58:31', '2024-07-14 10:58:31'),
(46, 'Hidupmu adalah cerita yang hanya kamu bisa tulis.', '2024-07-14 10:58:31', '2024-07-14 10:58:31'),
(47, 'Jadikan setiap hari sebagai kesempatan untuk membuat perbedaan.', '2024-07-14 10:58:31', '2024-07-14 10:58:31'),
(48, 'Terkadang hal terkecil bisa mengubah arah dari hari yang lebih baik.', '2024-07-14 10:58:31', '2024-07-14 10:58:31'),
(49, 'Kesuksesan adalah kunci untuk menciptakan kehidupan yang kamu inginkan.', '2024-07-14 10:58:31', '2024-07-14 10:58:31'),
(50, 'Ciptakan kesempatan, jangan menunggu kesempatan.', '2024-07-14 10:58:31', '2024-07-14 10:58:31'),
(51, 'Buat rencana, jangan harap-harapkan keberhasilan.', '2024-07-14 10:58:31', '2024-07-14 10:58:31'),
(52, 'Jangan biarkan ketakutan menghentikan impianmu.', '2024-07-14 10:58:31', '2024-07-14 10:58:31'),
(53, 'Semua yang kamu inginkan ada di luar zona nyamanmu.', '2024-07-14 10:58:31', '2024-07-14 10:58:31'),
(54, 'Hidup adalah apa yang kamu buat dari itu.', '2024-07-14 10:58:31', '2024-07-14 10:58:31');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `result_rules`
--

CREATE TABLE `result_rules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `gpa` double(8,2) NOT NULL DEFAULT 0.00,
  `min_mark` int(10) UNSIGNED NOT NULL,
  `max_mark` int(10) UNSIGNED NOT NULL,
  `grade_remark` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `description`) VALUES
(1, 'Admin', 'web', '2024-03-29 03:16:35', '2024-03-29 03:16:35', 'This is Admin Admin'),
(2, 'Teacher', 'web', '2024-03-29 03:16:35', '2024-03-29 03:16:35', 'This is Admin Teacher'),
(3, 'Parent', 'web', '2024-03-29 03:16:35', '2024-03-29 03:16:35', 'This is Admin Parent'),
(4, 'Student', 'web', '2024-03-29 03:16:35', '2024-03-29 03:16:35', 'This is Admin Student'),
(5, 'Accountant', 'web', '2024-03-29 03:16:35', '2024-03-29 03:16:35', 'This is Admin Accountant');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(7, 2),
(7, 4),
(7, 5),
(8, 1),
(8, 2),
(8, 5),
(9, 1),
(9, 2),
(9, 5),
(10, 1),
(10, 2),
(10, 5),
(11, 1),
(11, 2),
(11, 5),
(12, 1),
(13, 1),
(14, 1),
(14, 2),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 2),
(22, 4),
(29, 2),
(29, 4),
(32, 1),
(32, 2),
(32, 4),
(32, 5),
(33, 1),
(33, 2),
(33, 5),
(34, 1),
(34, 2),
(34, 5),
(35, 1),
(35, 2),
(35, 5),
(36, 1),
(36, 2),
(36, 4),
(36, 5),
(37, 1),
(37, 2),
(37, 4),
(37, 5),
(38, 1),
(39, 1),
(40, 1),
(41, 2),
(42, 2),
(43, 2),
(44, 2),
(45, 2),
(45, 3),
(45, 4),
(46, 2),
(47, 2),
(48, 2),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(55, 2),
(55, 5),
(56, 1),
(56, 2),
(56, 5),
(57, 1),
(57, 2),
(57, 5),
(58, 1),
(58, 2),
(58, 5),
(59, 1),
(59, 2),
(59, 4),
(59, 5),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 3),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(71, 2),
(71, 5),
(72, 1),
(72, 5),
(73, 1),
(73, 2),
(74, 1),
(74, 2),
(74, 5),
(75, 2),
(75, 3),
(76, 2),
(77, 2),
(77, 3),
(77, 4),
(78, 2),
(79, 2),
(80, 2),
(80, 3),
(80, 4),
(81, 2),
(82, 2),
(83, 2),
(84, 2),
(85, 2),
(86, 2),
(87, 2),
(88, 1),
(88, 5),
(89, 1),
(89, 5),
(90, 1),
(90, 5),
(91, 1),
(91, 5),
(92, 1),
(92, 3),
(92, 4),
(92, 5),
(93, 1),
(93, 5),
(94, 1),
(94, 3),
(94, 4),
(94, 5),
(95, 1),
(95, 5),
(96, 1),
(96, 5),
(97, 5),
(98, 5),
(99, 5),
(100, 5),
(101, 5),
(102, 5),
(103, 1),
(103, 5),
(104, 1),
(104, 5),
(105, 1),
(105, 5),
(106, 1),
(106, 5),
(111, 1),
(112, 2),
(113, 5),
(114, 3),
(115, 4),
(116, 1),
(117, 1);

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE `schools` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `radius` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longtitude` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `time_in` time DEFAULT NULL,
  `time_out` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`id`, `name`, `alamat`, `email`, `radius`, `latitude`, `longtitude`, `phone`, `time_in`, `time_out`, `created_at`, `updated_at`) VALUES
(1, 'Kawali', 'Ciamis', 'kawali@gmail.com', '0.30km', '732648237', '327642364', '08762654623', '14:12:11', '20:12:11', '2024-07-03 13:12:11', '2024-07-03 13:12:11');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('RFLzeggmoH3HnNPDJ9AL9Aac4jOX7uquxsMcgjsd', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibTBRZDhBNENkRXlkM1d6QU9HeEV4Zko2NkNVVERTWFJOdkdYdklvZiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMCRvN2wxbGs3RC5aVWlESGVnN1hqbzd1L1hZTVUvN2ozMXllR1ZDZ010MGg1Zm5SSnY5Q0hJcSI7fQ==', 1721287228),
('ZFragEQEn0VTyRt3DZP3O5bjhbiq3xdr6R3yjijY', NULL, '127.0.0.1', 'PostmanRuntime/7.40.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibVNHaTFpaXUyS2FDUWc0TTJnWXZ3b1VEbTZqMUV0N3VCcldWT0ozdSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1721284476);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `app_logo_type` enum('image','text') NOT NULL DEFAULT 'image',
  `text_logo_name` varchar(255) DEFAULT NULL,
  `app_name` varchar(255) DEFAULT NULL,
  `school_code` varchar(255) DEFAULT NULL,
  `dark_logo` varchar(255) DEFAULT NULL,
  `light_logo` varchar(255) DEFAULT NULL,
  `favicon_icon` varchar(255) DEFAULT NULL,
  `app_description` longtext DEFAULT NULL,
  `production_status` enum('Alpha','Beta','Production','Maintenance') NOT NULL DEFAULT 'Alpha',
  `mobile_version` varchar(255) DEFAULT NULL,
  `link_google_play` varchar(255) DEFAULT NULL,
  `principal_name` varchar(255) DEFAULT NULL,
  `app_address` varchar(255) DEFAULT NULL,
  `app_email` varchar(255) DEFAULT NULL,
  `app_phone` varchar(255) DEFAULT NULL,
  `app_currency` varchar(255) NOT NULL DEFAULT 'USD',
  `key_to_grades` text NOT NULL,
  `grade_summary` text NOT NULL,
  `over_due_days` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `radius` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longtitude` varchar(255) NOT NULL,
  `time_in` time DEFAULT NULL,
  `time_out` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `app_logo_type`, `text_logo_name`, `app_name`, `school_code`, `dark_logo`, `light_logo`, `favicon_icon`, `app_description`, `production_status`, `mobile_version`, `link_google_play`, `principal_name`, `app_address`, `app_email`, `app_phone`, `app_currency`, `key_to_grades`, `grade_summary`, `over_due_days`, `created_at`, `updated_at`, `radius`, `latitude`, `longtitude`, `time_in`, `time_out`) VALUES
(1, 'image', 'FathSchool', 'FathSchool', '4', 'uploads/images/1719456478_667cd2de7c36e.png', 'uploads/images/1719456478_667cd2de7d552.png', 'uploads/images/1719456478_667cd2de7e62f.png', 'FathSchool adalah sebuah sistem informasi terintegrasi yang dirancang untuk memenuhi seluruh kebutuhan operasional dan manajemen sekolah. Dengan fitur-fitur yang komprehensif, FathSchool memastikan bahwa setiap aspek administrasi dan kegiatan akademik di sekolah dapat dikelola dengan efisien dan efektif.', 'Alpha', '0.1', 'https://www.youtube.com/watch?v=xvFZjo5PgG0', 'Cecep Abu Azhar', 'Bandung', 'admin@fathforce.com', '6288971277852', 'USD', 'A+: 80% and Above | A: 70% - 79% | B: 60% - 69% | C: 50% - 59% | D: 40% - 49% | F: 39% and Below', '5(A+), 4(A), 3(B), 2(C), 1(F)', 0, '2024-03-28 20:16:39', '2024-07-24 03:53:25', '1', '-6.9167065846963975', '107.7574571895769', '08:00:00', '16:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sms_templates`
--

CREATE TABLE `sms_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `social_links`
--

CREATE TABLE `social_links` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_links`
--

INSERT INTO `social_links` (`id`, `name`, `url`, `icon`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Website', 'https://fathforce.com', 'uploads/social_links/1719480353_667d30213ef1f.png', 1, '2024-06-27 09:22:34', '2024-06-27 09:25:53');

-- --------------------------------------------------------

--
-- Table structure for table `student_attendances`
--

CREATE TABLE `student_attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('present','absent','late') NOT NULL,
  `late_amount` int(11) DEFAULT 0,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_attendances`
--

INSERT INTO `student_attendances` (`id`, `student_id`, `teacher_id`, `subject_id`, `status`, `late_amount`, `date`, `created_at`, `updated_at`) VALUES
(1, 5, 3, 16, 'absent', 0, '2024-07-23', '2024-07-05 04:34:15', '2024-07-05 04:34:15'),
(2, 1, 3, 16, 'absent', 0, '2024-07-01', '2024-07-05 06:51:00', '2024-07-05 06:51:00'),
(3, 5, 3, 16, 'late', 0, '2024-07-01', '2024-07-05 06:52:26', '2024-07-05 06:52:26');

-- --------------------------------------------------------

--
-- Table structure for table `student_lists`
--

CREATE TABLE `student_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `absence_number` int(11) NOT NULL,
  `class_list_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_lists`
--

INSERT INTO `student_lists` (`id`, `student_id`, `absence_number`, `class_list_id`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 1, '2024-07-05 07:32:30', '2024-07-05 07:32:30');

-- --------------------------------------------------------

--
-- Table structure for table `student_parents`
--

CREATE TABLE `student_parents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_parents`
--

INSERT INTO `student_parents` (`id`, `student_id`, `parent_id`, `created_at`, `updated_at`) VALUES
(12, 5, 4, '2024-07-23 10:17:39', '2024-07-23 10:17:39'),
(1257, 1452, 4, '2024-07-25 04:19:28', '2024-07-25 04:19:28'),
(1258, 1453, 4, '2024-07-25 04:19:28', '2024-07-25 04:19:28'),
(1259, 1454, 4, '2024-07-25 04:19:28', '2024-07-25 04:19:28'),
(1260, 1455, 4, '2024-07-25 04:19:28', '2024-07-25 04:19:28'),
(1261, 1456, 4, '2024-07-25 04:19:28', '2024-07-25 04:19:28'),
(1262, 1457, 4, '2024-07-25 04:19:28', '2024-07-25 04:19:28'),
(1263, 1458, 4, '2024-07-25 04:19:28', '2024-07-25 04:19:28'),
(1264, 1459, 4, '2024-07-25 04:19:28', '2024-07-25 04:19:28'),
(1265, 1460, 4, '2024-07-25 04:19:28', '2024-07-25 04:19:28'),
(1266, 1461, 4, '2024-07-25 04:19:28', '2024-07-25 04:19:28'),
(1267, 1462, 4, '2024-07-25 04:19:28', '2024-07-25 04:19:28'),
(1268, 1463, 4, '2024-07-25 04:19:29', '2024-07-25 04:19:29'),
(1269, 1464, 4, '2024-07-25 04:19:29', '2024-07-25 04:19:29'),
(1270, 1465, 4, '2024-07-25 04:19:29', '2024-07-25 04:19:29'),
(1271, 1466, 4, '2024-07-25 04:19:29', '2024-07-25 04:19:29'),
(1272, 1467, 4, '2024-07-25 04:19:29', '2024-07-25 04:19:29'),
(1273, 1468, 4, '2024-07-25 04:19:29', '2024-07-25 04:19:29'),
(1274, 1469, 4, '2024-07-25 04:19:29', '2024-07-25 04:19:29'),
(1275, 1470, 4, '2024-07-25 04:19:29', '2024-07-25 04:19:29'),
(1276, 1471, 4, '2024-07-25 04:19:29', '2024-07-25 04:19:29'),
(1277, 1472, 4, '2024-07-25 04:19:29', '2024-07-25 04:19:29'),
(1278, 1473, 4, '2024-07-25 04:19:29', '2024-07-25 04:19:29'),
(1279, 1474, 4, '2024-07-25 04:19:29', '2024-07-25 04:19:29'),
(1280, 1475, 4, '2024-07-25 04:19:29', '2024-07-25 04:19:29'),
(1281, 1476, 4, '2024-07-25 04:19:29', '2024-07-25 04:19:29'),
(1282, 1477, 4, '2024-07-25 04:19:29', '2024-07-25 04:19:29'),
(1283, 1478, 4, '2024-07-25 04:19:30', '2024-07-25 04:19:30'),
(1284, 1479, 4, '2024-07-25 04:19:30', '2024-07-25 04:19:30'),
(1285, 1480, 4, '2024-07-25 04:19:30', '2024-07-25 04:19:30'),
(1286, 1481, 4, '2024-07-25 04:19:30', '2024-07-25 04:19:30'),
(1287, 1482, 4, '2024-07-25 04:19:30', '2024-07-25 04:19:30'),
(1288, 1483, 4, '2024-07-25 04:19:30', '2024-07-25 04:19:30'),
(1289, 1484, 4, '2024-07-25 04:19:30', '2024-07-25 04:19:30'),
(1514, 1718, 4, '2024-07-25 04:44:39', '2024-07-25 04:44:39'),
(1515, 1719, 4, '2024-07-25 04:44:39', '2024-07-25 04:44:39'),
(1516, 1720, 4, '2024-07-25 04:44:39', '2024-07-25 04:44:39'),
(1517, 1721, 4, '2024-07-25 04:44:39', '2024-07-25 04:44:39'),
(1518, 1722, 4, '2024-07-25 04:44:39', '2024-07-25 04:44:39'),
(1519, 1723, 4, '2024-07-25 04:44:39', '2024-07-25 04:44:39'),
(1520, 1724, 4, '2024-07-25 04:44:39', '2024-07-25 04:44:39'),
(1521, 1725, 4, '2024-07-25 04:44:39', '2024-07-25 04:44:39'),
(1522, 1726, 4, '2024-07-25 04:44:39', '2024-07-25 04:44:39'),
(1523, 1727, 4, '2024-07-25 04:44:39', '2024-07-25 04:44:39'),
(1524, 1728, 4, '2024-07-25 04:44:40', '2024-07-25 04:44:40'),
(1525, 1729, 4, '2024-07-25 04:44:40', '2024-07-25 04:44:40'),
(1526, 1730, 4, '2024-07-25 04:44:40', '2024-07-25 04:44:40'),
(1527, 1731, 4, '2024-07-25 04:44:40', '2024-07-25 04:44:40'),
(1528, 1732, 4, '2024-07-25 04:44:40', '2024-07-25 04:44:40'),
(1529, 1733, 4, '2024-07-25 04:44:40', '2024-07-25 04:44:40'),
(1530, 1734, 4, '2024-07-25 04:44:40', '2024-07-25 04:44:40'),
(1531, 1735, 4, '2024-07-25 04:44:40', '2024-07-25 04:44:40'),
(1532, 1736, 4, '2024-07-25 04:44:40', '2024-07-25 04:44:40'),
(1533, 1737, 4, '2024-07-25 04:44:40', '2024-07-25 04:44:40'),
(1534, 1738, 4, '2024-07-25 04:44:40', '2024-07-25 04:44:40'),
(1535, 1739, 4, '2024-07-25 04:44:40', '2024-07-25 04:44:40'),
(1536, 1740, 4, '2024-07-25 04:44:40', '2024-07-25 04:44:40'),
(1537, 1741, 4, '2024-07-25 04:44:40', '2024-07-25 04:44:40'),
(1538, 1742, 4, '2024-07-25 04:44:41', '2024-07-25 04:44:41'),
(1539, 1743, 4, '2024-07-25 04:44:41', '2024-07-25 04:44:41'),
(1540, 1744, 4, '2024-07-25 04:44:41', '2024-07-25 04:44:41'),
(1541, 1745, 4, '2024-07-25 04:44:41', '2024-07-25 04:44:41'),
(1542, 1746, 4, '2024-07-25 04:44:41', '2024-07-25 04:44:41'),
(1543, 1747, 4, '2024-07-25 04:44:41', '2024-07-25 04:44:41'),
(1544, 1748, 4, '2024-07-25 04:44:41', '2024-07-25 04:44:41'),
(1545, 1749, 4, '2024-07-25 04:44:41', '2024-07-25 04:44:41'),
(1546, 1750, 4, '2024-07-25 04:44:41', '2024-07-25 04:44:41'),
(1547, 1751, 4, '2024-07-25 04:44:41', '2024-07-25 04:44:41'),
(1548, 1752, 4, '2024-07-25 04:44:41', '2024-07-25 04:44:41'),
(1549, 1753, 4, '2024-07-25 04:44:41', '2024-07-25 04:44:41'),
(1727, 1945, 4, '2024-07-25 06:33:54', '2024-07-25 06:33:54'),
(1728, 1946, 4, '2024-07-25 06:33:54', '2024-07-25 06:33:54'),
(1729, 1947, 4, '2024-07-25 06:33:54', '2024-07-25 06:33:54'),
(1730, 1948, 4, '2024-07-25 06:33:54', '2024-07-25 06:33:54'),
(1731, 1949, 4, '2024-07-25 06:33:54', '2024-07-25 06:33:54'),
(1732, 1950, 4, '2024-07-25 06:33:54', '2024-07-25 06:33:54'),
(1733, 1951, 4, '2024-07-25 06:33:54', '2024-07-25 06:33:54'),
(1734, 1952, 4, '2024-07-25 06:33:54', '2024-07-25 06:33:54'),
(1735, 1953, 4, '2024-07-25 06:33:54', '2024-07-25 06:33:54'),
(1736, 1954, 4, '2024-07-25 06:33:55', '2024-07-25 06:33:55'),
(1737, 1955, 4, '2024-07-25 06:33:55', '2024-07-25 06:33:55'),
(1738, 1956, 4, '2024-07-25 06:33:55', '2024-07-25 06:33:55'),
(1739, 1957, 4, '2024-07-25 06:33:55', '2024-07-25 06:33:55'),
(1740, 1958, 4, '2024-07-25 06:33:55', '2024-07-25 06:33:55'),
(1741, 1959, 4, '2024-07-25 06:33:55', '2024-07-25 06:33:55'),
(1742, 1960, 4, '2024-07-25 06:33:55', '2024-07-25 06:33:55'),
(1743, 1961, 4, '2024-07-25 06:33:55', '2024-07-25 06:33:55'),
(1744, 1962, 4, '2024-07-25 06:33:55', '2024-07-25 06:33:55'),
(1745, 1963, 4, '2024-07-25 06:33:55', '2024-07-25 06:33:55'),
(1746, 1964, 4, '2024-07-25 06:33:55', '2024-07-25 06:33:55'),
(1747, 1965, 4, '2024-07-25 06:33:55', '2024-07-25 06:33:55'),
(1748, 1966, 4, '2024-07-25 06:33:55', '2024-07-25 06:33:55'),
(1749, 1967, 4, '2024-07-25 06:33:56', '2024-07-25 06:33:56'),
(1750, 1968, 4, '2024-07-25 06:33:56', '2024-07-25 06:33:56'),
(1751, 1969, 4, '2024-07-25 06:33:56', '2024-07-25 06:33:56'),
(1752, 1970, 4, '2024-07-25 06:33:56', '2024-07-25 06:33:56'),
(1753, 1971, 4, '2024-07-25 06:33:56', '2024-07-25 06:33:56'),
(1754, 1972, 4, '2024-07-25 06:33:56', '2024-07-25 06:33:56'),
(1755, 1973, 4, '2024-07-25 06:33:56', '2024-07-25 06:33:56'),
(1756, 1974, 4, '2024-07-25 06:33:56', '2024-07-25 06:33:56'),
(1757, 1975, 4, '2024-07-25 06:33:56', '2024-07-25 06:33:56'),
(1758, 1976, 4, '2024-07-25 06:33:56', '2024-07-25 06:33:56'),
(1759, 1977, 4, '2024-07-25 06:33:56', '2024-07-25 06:33:56'),
(1760, 1978, 4, '2024-07-25 06:33:56', '2024-07-25 06:33:56'),
(1761, 1979, 4, '2024-07-25 06:33:57', '2024-07-25 06:33:57'),
(1762, 1980, 4, '2024-07-25 06:33:57', '2024-07-25 06:33:57'),
(2051, 2278, 4, '2024-07-25 06:38:20', '2024-07-25 06:38:20'),
(2052, 2279, 4, '2024-07-25 06:38:20', '2024-07-25 06:38:20'),
(2053, 2280, 4, '2024-07-25 06:38:20', '2024-07-25 06:38:20'),
(2054, 2281, 4, '2024-07-25 06:38:20', '2024-07-25 06:38:20'),
(2055, 2282, 4, '2024-07-25 06:38:21', '2024-07-25 06:38:21'),
(2056, 2283, 4, '2024-07-25 06:38:21', '2024-07-25 06:38:21'),
(2057, 2284, 4, '2024-07-25 06:38:21', '2024-07-25 06:38:21'),
(2058, 2285, 4, '2024-07-25 06:38:21', '2024-07-25 06:38:21'),
(2059, 2286, 4, '2024-07-25 06:38:21', '2024-07-25 06:38:21'),
(2060, 2287, 4, '2024-07-25 06:38:21', '2024-07-25 06:38:21'),
(2061, 2288, 4, '2024-07-25 06:38:21', '2024-07-25 06:38:21'),
(2062, 2289, 4, '2024-07-25 06:38:21', '2024-07-25 06:38:21'),
(2063, 2290, 4, '2024-07-25 06:38:21', '2024-07-25 06:38:21'),
(2064, 2291, 4, '2024-07-25 06:38:21', '2024-07-25 06:38:21'),
(2065, 2292, 4, '2024-07-25 06:38:21', '2024-07-25 06:38:21'),
(2066, 2293, 4, '2024-07-25 06:38:21', '2024-07-25 06:38:21'),
(2067, 2294, 4, '2024-07-25 06:38:21', '2024-07-25 06:38:21'),
(2068, 2295, 4, '2024-07-25 06:38:21', '2024-07-25 06:38:21'),
(2069, 2296, 4, '2024-07-25 06:38:21', '2024-07-25 06:38:21'),
(2070, 2297, 4, '2024-07-25 06:38:22', '2024-07-25 06:38:22'),
(2071, 2298, 4, '2024-07-25 06:38:22', '2024-07-25 06:38:22'),
(2072, 2299, 4, '2024-07-25 06:38:22', '2024-07-25 06:38:22'),
(2073, 2300, 4, '2024-07-25 06:38:22', '2024-07-25 06:38:22'),
(2074, 2301, 4, '2024-07-25 06:38:22', '2024-07-25 06:38:22'),
(2075, 2302, 4, '2024-07-25 06:38:22', '2024-07-25 06:38:22'),
(2076, 2303, 4, '2024-07-25 06:38:22', '2024-07-25 06:38:22'),
(2077, 2304, 4, '2024-07-25 06:38:22', '2024-07-25 06:38:22'),
(2078, 2305, 4, '2024-07-25 06:38:22', '2024-07-25 06:38:22'),
(2079, 2306, 4, '2024-07-25 06:38:22', '2024-07-25 06:38:22'),
(2080, 2307, 4, '2024-07-25 06:38:22', '2024-07-25 06:38:22'),
(2081, 2308, 4, '2024-07-25 06:38:22', '2024-07-25 06:38:22'),
(2082, 2309, 4, '2024-07-25 06:38:22', '2024-07-25 06:38:22'),
(2083, 2310, 4, '2024-07-25 06:38:22', '2024-07-25 06:38:22'),
(2084, 2311, 4, '2024-07-25 06:38:23', '2024-07-25 06:38:23'),
(2085, 2312, 4, '2024-07-25 06:38:23', '2024-07-25 06:38:23'),
(2086, 2313, 4, '2024-07-25 06:38:23', '2024-07-25 06:38:23'),
(2087, 2315, 4, '2024-07-25 06:40:28', '2024-07-25 06:40:28'),
(2088, 2316, 4, '2024-07-25 06:40:28', '2024-07-25 06:40:28'),
(2089, 2317, 4, '2024-07-25 06:40:28', '2024-07-25 06:40:28'),
(2090, 2318, 4, '2024-07-25 06:40:28', '2024-07-25 06:40:28'),
(2091, 2319, 4, '2024-07-25 06:40:28', '2024-07-25 06:40:28'),
(2092, 2320, 4, '2024-07-25 06:40:29', '2024-07-25 06:40:29'),
(2093, 2321, 4, '2024-07-25 06:40:29', '2024-07-25 06:40:29'),
(2094, 2322, 4, '2024-07-25 06:40:29', '2024-07-25 06:40:29'),
(2095, 2323, 4, '2024-07-25 06:40:29', '2024-07-25 06:40:29'),
(2096, 2324, 4, '2024-07-25 06:40:29', '2024-07-25 06:40:29'),
(2097, 2325, 4, '2024-07-25 06:40:29', '2024-07-25 06:40:29'),
(2098, 2326, 4, '2024-07-25 06:40:29', '2024-07-25 06:40:29'),
(2099, 2327, 4, '2024-07-25 06:40:29', '2024-07-25 06:40:29'),
(2100, 2328, 4, '2024-07-25 06:40:29', '2024-07-25 06:40:29'),
(2101, 2329, 4, '2024-07-25 06:40:29', '2024-07-25 06:40:29'),
(2102, 2330, 4, '2024-07-25 06:40:29', '2024-07-25 06:40:29'),
(2103, 2331, 4, '2024-07-25 06:40:29', '2024-07-25 06:40:29'),
(2104, 2332, 4, '2024-07-25 06:40:29', '2024-07-25 06:40:29'),
(2105, 2333, 4, '2024-07-25 06:40:29', '2024-07-25 06:40:29'),
(2106, 2334, 4, '2024-07-25 06:40:30', '2024-07-25 06:40:30'),
(2107, 2335, 4, '2024-07-25 06:40:30', '2024-07-25 06:40:30'),
(2108, 2336, 4, '2024-07-25 06:40:30', '2024-07-25 06:40:30'),
(2109, 2337, 4, '2024-07-25 06:40:30', '2024-07-25 06:40:30'),
(2110, 2338, 4, '2024-07-25 06:40:30', '2024-07-25 06:40:30'),
(2111, 2339, 4, '2024-07-25 06:40:30', '2024-07-25 06:40:30'),
(2112, 2340, 4, '2024-07-25 06:40:30', '2024-07-25 06:40:30'),
(2113, 2341, 4, '2024-07-25 06:40:30', '2024-07-25 06:40:30'),
(2114, 2342, 4, '2024-07-25 06:40:30', '2024-07-25 06:40:30'),
(2115, 2343, 4, '2024-07-25 06:40:30', '2024-07-25 06:40:30'),
(2116, 2344, 4, '2024-07-25 06:40:30', '2024-07-25 06:40:30'),
(2117, 2345, 4, '2024-07-25 06:40:30', '2024-07-25 06:40:30'),
(2118, 2346, 4, '2024-07-25 06:40:30', '2024-07-25 06:40:30'),
(2119, 2347, 4, '2024-07-25 06:40:30', '2024-07-25 06:40:30'),
(2120, 2348, 4, '2024-07-25 06:40:31', '2024-07-25 06:40:31'),
(2121, 2349, 4, '2024-07-25 06:40:31', '2024-07-25 06:40:31'),
(2122, 2350, 4, '2024-07-25 06:40:31', '2024-07-25 06:40:31'),
(2123, 2351, 4, '2024-07-25 06:41:09', '2024-07-25 06:41:09'),
(2124, 2352, 4, '2024-07-25 06:41:09', '2024-07-25 06:41:09'),
(2125, 2353, 4, '2024-07-25 06:41:09', '2024-07-25 06:41:09'),
(2126, 2354, 4, '2024-07-25 06:41:09', '2024-07-25 06:41:09'),
(2127, 2355, 4, '2024-07-25 06:41:09', '2024-07-25 06:41:09'),
(2128, 2356, 4, '2024-07-25 06:41:09', '2024-07-25 06:41:09'),
(2129, 2357, 4, '2024-07-25 06:41:09', '2024-07-25 06:41:09'),
(2130, 2358, 4, '2024-07-25 06:41:09', '2024-07-25 06:41:09'),
(2131, 2359, 4, '2024-07-25 06:41:09', '2024-07-25 06:41:09'),
(2132, 2360, 4, '2024-07-25 06:41:09', '2024-07-25 06:41:09'),
(2133, 2361, 4, '2024-07-25 06:41:09', '2024-07-25 06:41:09'),
(2134, 2362, 4, '2024-07-25 06:41:09', '2024-07-25 06:41:09'),
(2135, 2363, 4, '2024-07-25 06:41:09', '2024-07-25 06:41:09'),
(2136, 2364, 4, '2024-07-25 06:41:09', '2024-07-25 06:41:09'),
(2137, 2365, 4, '2024-07-25 06:41:10', '2024-07-25 06:41:10'),
(2138, 2366, 4, '2024-07-25 06:41:10', '2024-07-25 06:41:10'),
(2139, 2367, 4, '2024-07-25 06:41:10', '2024-07-25 06:41:10'),
(2140, 2368, 4, '2024-07-25 06:41:10', '2024-07-25 06:41:10'),
(2141, 2369, 4, '2024-07-25 06:41:10', '2024-07-25 06:41:10'),
(2142, 2370, 4, '2024-07-25 06:41:10', '2024-07-25 06:41:10'),
(2143, 2371, 4, '2024-07-25 06:41:10', '2024-07-25 06:41:10'),
(2144, 2372, 4, '2024-07-25 06:41:10', '2024-07-25 06:41:10'),
(2145, 2373, 4, '2024-07-25 06:41:10', '2024-07-25 06:41:10'),
(2146, 2374, 4, '2024-07-25 06:41:10', '2024-07-25 06:41:10'),
(2147, 2375, 4, '2024-07-25 06:41:10', '2024-07-25 06:41:10'),
(2148, 2376, 4, '2024-07-25 06:41:10', '2024-07-25 06:41:10'),
(2149, 2377, 4, '2024-07-25 06:41:10', '2024-07-25 06:41:10'),
(2150, 2378, 4, '2024-07-25 06:41:10', '2024-07-25 06:41:10'),
(2151, 2379, 4, '2024-07-25 06:41:11', '2024-07-25 06:41:11'),
(2152, 2380, 4, '2024-07-25 06:41:11', '2024-07-25 06:41:11'),
(2153, 2381, 4, '2024-07-25 06:41:11', '2024-07-25 06:41:11'),
(2154, 2382, 4, '2024-07-25 06:41:11', '2024-07-25 06:41:11'),
(2155, 2383, 4, '2024-07-25 06:41:11', '2024-07-25 06:41:11'),
(2156, 2384, 4, '2024-07-25 06:41:11', '2024-07-25 06:41:11'),
(2157, 2385, 4, '2024-07-25 06:41:11', '2024-07-25 06:41:11'),
(2158, 2386, 4, '2024-07-25 06:41:11', '2024-07-25 06:41:11'),
(2159, 2388, 4, '2024-07-25 06:41:21', '2024-07-25 06:41:21'),
(2160, 2389, 4, '2024-07-25 06:41:21', '2024-07-25 06:41:21'),
(2161, 2390, 4, '2024-07-25 06:41:21', '2024-07-25 06:41:21'),
(2162, 2391, 4, '2024-07-25 06:41:21', '2024-07-25 06:41:21'),
(2163, 2392, 4, '2024-07-25 06:41:22', '2024-07-25 06:41:22'),
(2164, 2393, 4, '2024-07-25 06:41:22', '2024-07-25 06:41:22'),
(2165, 2394, 4, '2024-07-25 06:41:22', '2024-07-25 06:41:22'),
(2166, 2395, 4, '2024-07-25 06:41:22', '2024-07-25 06:41:22'),
(2167, 2396, 4, '2024-07-25 06:41:22', '2024-07-25 06:41:22'),
(2168, 2397, 4, '2024-07-25 06:41:22', '2024-07-25 06:41:22'),
(2169, 2398, 4, '2024-07-25 06:41:22', '2024-07-25 06:41:22'),
(2170, 2399, 4, '2024-07-25 06:41:22', '2024-07-25 06:41:22'),
(2171, 2400, 4, '2024-07-25 06:41:22', '2024-07-25 06:41:22'),
(2172, 2401, 4, '2024-07-25 06:41:22', '2024-07-25 06:41:22'),
(2173, 2402, 4, '2024-07-25 06:41:22', '2024-07-25 06:41:22'),
(2174, 2403, 4, '2024-07-25 06:41:22', '2024-07-25 06:41:22'),
(2175, 2404, 4, '2024-07-25 06:41:22', '2024-07-25 06:41:22'),
(2176, 2405, 4, '2024-07-25 06:41:23', '2024-07-25 06:41:23'),
(2177, 2406, 4, '2024-07-25 06:41:23', '2024-07-25 06:41:23'),
(2178, 2407, 4, '2024-07-25 06:41:23', '2024-07-25 06:41:23'),
(2179, 2408, 4, '2024-07-25 06:41:23', '2024-07-25 06:41:23'),
(2180, 2409, 4, '2024-07-25 06:41:23', '2024-07-25 06:41:23'),
(2181, 2410, 4, '2024-07-25 06:41:23', '2024-07-25 06:41:23'),
(2182, 2411, 4, '2024-07-25 06:41:23', '2024-07-25 06:41:23'),
(2183, 2412, 4, '2024-07-25 06:41:23', '2024-07-25 06:41:23'),
(2184, 2413, 4, '2024-07-25 06:41:23', '2024-07-25 06:41:23'),
(2185, 2414, 4, '2024-07-25 06:41:23', '2024-07-25 06:41:23'),
(2186, 2415, 4, '2024-07-25 06:41:23', '2024-07-25 06:41:23'),
(2187, 2416, 4, '2024-07-25 06:41:23', '2024-07-25 06:41:23'),
(2188, 2417, 4, '2024-07-25 06:41:23', '2024-07-25 06:41:23'),
(2189, 2418, 4, '2024-07-25 06:41:24', '2024-07-25 06:41:24'),
(2190, 2419, 4, '2024-07-25 06:41:24', '2024-07-25 06:41:24'),
(2191, 2420, 4, '2024-07-25 06:41:24', '2024-07-25 06:41:24'),
(2192, 2421, 4, '2024-07-25 06:41:24', '2024-07-25 06:41:24'),
(2193, 2422, 4, '2024-07-25 06:41:24', '2024-07-25 06:41:24'),
(2194, 2423, 4, '2024-07-25 06:41:24', '2024-07-25 06:41:24'),
(2195, 2424, 4, '2024-07-25 06:41:34', '2024-07-25 06:41:34'),
(2196, 2425, 4, '2024-07-25 06:41:34', '2024-07-25 06:41:34'),
(2197, 2426, 4, '2024-07-25 06:41:34', '2024-07-25 06:41:34'),
(2198, 2427, 4, '2024-07-25 06:41:34', '2024-07-25 06:41:34'),
(2199, 2428, 4, '2024-07-25 06:41:34', '2024-07-25 06:41:34'),
(2200, 2429, 4, '2024-07-25 06:41:34', '2024-07-25 06:41:34'),
(2201, 2430, 4, '2024-07-25 06:41:34', '2024-07-25 06:41:34'),
(2202, 2431, 4, '2024-07-25 06:41:34', '2024-07-25 06:41:34'),
(2203, 2432, 4, '2024-07-25 06:41:34', '2024-07-25 06:41:34'),
(2204, 2433, 4, '2024-07-25 06:41:34', '2024-07-25 06:41:34'),
(2205, 2434, 4, '2024-07-25 06:41:34', '2024-07-25 06:41:34'),
(2206, 2435, 4, '2024-07-25 06:41:34', '2024-07-25 06:41:34'),
(2207, 2436, 4, '2024-07-25 06:41:35', '2024-07-25 06:41:35'),
(2208, 2437, 4, '2024-07-25 06:41:35', '2024-07-25 06:41:35'),
(2209, 2438, 4, '2024-07-25 06:41:35', '2024-07-25 06:41:35'),
(2210, 2439, 4, '2024-07-25 06:41:35', '2024-07-25 06:41:35'),
(2211, 2440, 4, '2024-07-25 06:41:35', '2024-07-25 06:41:35'),
(2212, 2441, 4, '2024-07-25 06:41:35', '2024-07-25 06:41:35'),
(2213, 2442, 4, '2024-07-25 06:41:35', '2024-07-25 06:41:35'),
(2214, 2443, 4, '2024-07-25 06:41:35', '2024-07-25 06:41:35'),
(2215, 2444, 4, '2024-07-25 06:41:35', '2024-07-25 06:41:35'),
(2216, 2445, 4, '2024-07-25 06:41:35', '2024-07-25 06:41:35'),
(2217, 2446, 4, '2024-07-25 06:41:35', '2024-07-25 06:41:35'),
(2218, 2447, 4, '2024-07-25 06:41:35', '2024-07-25 06:41:35'),
(2219, 2448, 4, '2024-07-25 06:41:35', '2024-07-25 06:41:35'),
(2220, 2449, 4, '2024-07-25 06:41:35', '2024-07-25 06:41:35'),
(2221, 2450, 4, '2024-07-25 06:41:35', '2024-07-25 06:41:35'),
(2222, 2451, 4, '2024-07-25 06:41:36', '2024-07-25 06:41:36'),
(2223, 2452, 4, '2024-07-25 06:41:36', '2024-07-25 06:41:36'),
(2224, 2453, 4, '2024-07-25 06:41:36', '2024-07-25 06:41:36'),
(2225, 2454, 4, '2024-07-25 06:41:36', '2024-07-25 06:41:36'),
(2226, 2455, 4, '2024-07-25 06:41:36', '2024-07-25 06:41:36'),
(2227, 2456, 4, '2024-07-25 06:41:36', '2024-07-25 06:41:36'),
(2228, 2457, 4, '2024-07-25 06:41:36', '2024-07-25 06:41:36'),
(2229, 2458, 4, '2024-07-25 06:41:36', '2024-07-25 06:41:36'),
(2230, 2459, 4, '2024-07-25 06:41:36', '2024-07-25 06:41:36'),
(2231, 2460, 4, '2024-07-25 06:41:48', '2024-07-25 06:41:48'),
(2232, 2461, 4, '2024-07-25 06:41:49', '2024-07-25 06:41:49'),
(2233, 2462, 4, '2024-07-25 06:41:49', '2024-07-25 06:41:49'),
(2234, 2463, 4, '2024-07-25 06:41:49', '2024-07-25 06:41:49'),
(2235, 2464, 4, '2024-07-25 06:41:49', '2024-07-25 06:41:49'),
(2236, 2465, 4, '2024-07-25 06:41:49', '2024-07-25 06:41:49'),
(2237, 2466, 4, '2024-07-25 06:41:49', '2024-07-25 06:41:49'),
(2238, 2467, 4, '2024-07-25 06:41:49', '2024-07-25 06:41:49'),
(2239, 2468, 4, '2024-07-25 06:41:49', '2024-07-25 06:41:49'),
(2240, 2469, 4, '2024-07-25 06:41:49', '2024-07-25 06:41:49'),
(2241, 2470, 4, '2024-07-25 06:41:49', '2024-07-25 06:41:49'),
(2242, 2471, 4, '2024-07-25 06:41:49', '2024-07-25 06:41:49'),
(2243, 2472, 4, '2024-07-25 06:41:49', '2024-07-25 06:41:49'),
(2244, 2473, 4, '2024-07-25 06:41:49', '2024-07-25 06:41:49'),
(2245, 2474, 4, '2024-07-25 06:41:49', '2024-07-25 06:41:49'),
(2246, 2475, 4, '2024-07-25 06:41:49', '2024-07-25 06:41:49'),
(2247, 2476, 4, '2024-07-25 06:41:50', '2024-07-25 06:41:50'),
(2248, 2477, 4, '2024-07-25 06:41:50', '2024-07-25 06:41:50'),
(2249, 2478, 4, '2024-07-25 06:41:50', '2024-07-25 06:41:50'),
(2250, 2479, 4, '2024-07-25 06:41:50', '2024-07-25 06:41:50'),
(2251, 2480, 4, '2024-07-25 06:41:50', '2024-07-25 06:41:50'),
(2252, 2481, 4, '2024-07-25 06:41:50', '2024-07-25 06:41:50'),
(2253, 2482, 4, '2024-07-25 06:41:50', '2024-07-25 06:41:50'),
(2254, 2483, 4, '2024-07-25 06:41:50', '2024-07-25 06:41:50'),
(2255, 2484, 4, '2024-07-25 06:41:50', '2024-07-25 06:41:50'),
(2256, 2485, 4, '2024-07-25 06:41:50', '2024-07-25 06:41:50'),
(2257, 2486, 4, '2024-07-25 06:41:50', '2024-07-25 06:41:50'),
(2258, 2487, 4, '2024-07-25 06:41:50', '2024-07-25 06:41:50'),
(2259, 2488, 4, '2024-07-25 06:41:50', '2024-07-25 06:41:50'),
(2260, 2489, 4, '2024-07-25 06:41:50', '2024-07-25 06:41:50'),
(2261, 2490, 4, '2024-07-25 06:41:51', '2024-07-25 06:41:51'),
(2262, 2491, 4, '2024-07-25 06:41:51', '2024-07-25 06:41:51'),
(2263, 2492, 4, '2024-07-25 06:41:51', '2024-07-25 06:41:51'),
(2264, 2493, 4, '2024-07-25 06:41:51', '2024-07-25 06:41:51'),
(2265, 2494, 4, '2024-07-25 06:41:51', '2024-07-25 06:41:51'),
(2266, 2495, 4, '2024-07-25 06:41:51', '2024-07-25 06:41:51'),
(2267, 2496, 4, '2024-07-25 06:41:59', '2024-07-25 06:41:59'),
(2268, 2497, 4, '2024-07-25 06:41:59', '2024-07-25 06:41:59'),
(2269, 2498, 4, '2024-07-25 06:42:00', '2024-07-25 06:42:00'),
(2270, 2499, 4, '2024-07-25 06:42:00', '2024-07-25 06:42:00'),
(2271, 2500, 4, '2024-07-25 06:42:00', '2024-07-25 06:42:00'),
(2272, 2501, 4, '2024-07-25 06:42:00', '2024-07-25 06:42:00'),
(2273, 2502, 4, '2024-07-25 06:42:00', '2024-07-25 06:42:00'),
(2274, 2503, 4, '2024-07-25 06:42:00', '2024-07-25 06:42:00'),
(2275, 2504, 4, '2024-07-25 06:42:00', '2024-07-25 06:42:00'),
(2276, 2505, 4, '2024-07-25 06:42:00', '2024-07-25 06:42:00'),
(2277, 2506, 4, '2024-07-25 06:42:00', '2024-07-25 06:42:00'),
(2278, 2507, 4, '2024-07-25 06:42:00', '2024-07-25 06:42:00'),
(2279, 2508, 4, '2024-07-25 06:42:00', '2024-07-25 06:42:00'),
(2280, 2509, 4, '2024-07-25 06:42:00', '2024-07-25 06:42:00'),
(2281, 2510, 4, '2024-07-25 06:42:00', '2024-07-25 06:42:00'),
(2282, 2511, 4, '2024-07-25 06:42:01', '2024-07-25 06:42:01'),
(2283, 2512, 4, '2024-07-25 06:42:01', '2024-07-25 06:42:01'),
(2284, 2513, 4, '2024-07-25 06:42:01', '2024-07-25 06:42:01'),
(2285, 2514, 4, '2024-07-25 06:42:01', '2024-07-25 06:42:01'),
(2286, 2515, 4, '2024-07-25 06:42:01', '2024-07-25 06:42:01'),
(2287, 2516, 4, '2024-07-25 06:42:01', '2024-07-25 06:42:01'),
(2288, 2517, 4, '2024-07-25 06:42:01', '2024-07-25 06:42:01'),
(2289, 2518, 4, '2024-07-25 06:42:01', '2024-07-25 06:42:01'),
(2290, 2519, 4, '2024-07-25 06:42:01', '2024-07-25 06:42:01'),
(2291, 2520, 4, '2024-07-25 06:42:01', '2024-07-25 06:42:01'),
(2292, 2521, 4, '2024-07-25 06:42:01', '2024-07-25 06:42:01'),
(2293, 2522, 4, '2024-07-25 06:42:01', '2024-07-25 06:42:01'),
(2294, 2523, 4, '2024-07-25 06:42:02', '2024-07-25 06:42:02'),
(2295, 2524, 4, '2024-07-25 06:42:02', '2024-07-25 06:42:02'),
(2296, 2525, 4, '2024-07-25 06:42:02', '2024-07-25 06:42:02'),
(2297, 2526, 4, '2024-07-25 06:42:02', '2024-07-25 06:42:02'),
(2298, 2527, 4, '2024-07-25 06:42:02', '2024-07-25 06:42:02'),
(2299, 2528, 4, '2024-07-25 06:42:02', '2024-07-25 06:42:02'),
(2300, 2529, 4, '2024-07-25 06:42:02', '2024-07-25 06:42:02'),
(2301, 2530, 4, '2024-07-25 06:42:02', '2024-07-25 06:42:02'),
(2302, 2531, 4, '2024-07-25 06:42:02', '2024-07-25 06:42:02'),
(2372, 2606, 4, '2024-07-25 07:02:38', '2024-07-25 07:02:38'),
(2373, 2607, 4, '2024-07-25 07:02:38', '2024-07-25 07:02:38'),
(2374, 2608, 4, '2024-07-25 07:02:38', '2024-07-25 07:02:38'),
(2375, 2609, 4, '2024-07-25 07:02:39', '2024-07-25 07:02:39'),
(2376, 2610, 4, '2024-07-25 07:02:39', '2024-07-25 07:02:39'),
(2377, 2611, 4, '2024-07-25 07:02:39', '2024-07-25 07:02:39'),
(2378, 2612, 4, '2024-07-25 07:02:39', '2024-07-25 07:02:39'),
(2379, 2613, 4, '2024-07-25 07:02:39', '2024-07-25 07:02:39'),
(2380, 2614, 4, '2024-07-25 07:02:39', '2024-07-25 07:02:39'),
(2381, 2615, 4, '2024-07-25 07:02:39', '2024-07-25 07:02:39'),
(2382, 2616, 4, '2024-07-25 07:02:39', '2024-07-25 07:02:39'),
(2383, 2617, 4, '2024-07-25 07:02:39', '2024-07-25 07:02:39'),
(2384, 2618, 4, '2024-07-25 07:02:39', '2024-07-25 07:02:39'),
(2385, 2619, 4, '2024-07-25 07:02:39', '2024-07-25 07:02:39'),
(2386, 2620, 4, '2024-07-25 07:02:39', '2024-07-25 07:02:39'),
(2387, 2621, 4, '2024-07-25 07:02:39', '2024-07-25 07:02:39'),
(2388, 2622, 4, '2024-07-25 07:02:40', '2024-07-25 07:02:40'),
(2389, 2623, 4, '2024-07-25 07:02:40', '2024-07-25 07:02:40'),
(2390, 2624, 4, '2024-07-25 07:02:40', '2024-07-25 07:02:40'),
(2391, 2625, 4, '2024-07-25 07:02:40', '2024-07-25 07:02:40'),
(2392, 2626, 4, '2024-07-25 07:02:40', '2024-07-25 07:02:40'),
(2393, 2627, 4, '2024-07-25 07:02:40', '2024-07-25 07:02:40'),
(2394, 2628, 4, '2024-07-25 07:02:40', '2024-07-25 07:02:40'),
(2395, 2629, 4, '2024-07-25 07:02:40', '2024-07-25 07:02:40'),
(2396, 2630, 4, '2024-07-25 07:02:40', '2024-07-25 07:02:40'),
(2397, 2631, 4, '2024-07-25 07:02:40', '2024-07-25 07:02:40'),
(2398, 2632, 4, '2024-07-25 07:02:40', '2024-07-25 07:02:40'),
(2399, 2633, 4, '2024-07-25 07:02:40', '2024-07-25 07:02:40'),
(2400, 2634, 4, '2024-07-25 07:02:40', '2024-07-25 07:02:40'),
(2401, 2635, 4, '2024-07-25 07:02:40', '2024-07-25 07:02:40'),
(2402, 2636, 4, '2024-07-25 07:02:41', '2024-07-25 07:02:41'),
(2403, 2637, 4, '2024-07-25 07:02:41', '2024-07-25 07:02:41'),
(2437, 2675, 4, '2024-07-25 07:15:57', '2024-07-25 07:15:57'),
(2438, 2676, 4, '2024-07-25 07:15:57', '2024-07-25 07:15:57'),
(2439, 2677, 4, '2024-07-25 07:15:57', '2024-07-25 07:15:57'),
(2440, 2678, 4, '2024-07-25 07:15:57', '2024-07-25 07:15:57'),
(2441, 2679, 4, '2024-07-25 07:15:57', '2024-07-25 07:15:57'),
(2442, 2680, 4, '2024-07-25 07:15:57', '2024-07-25 07:15:57'),
(2443, 2681, 4, '2024-07-25 07:15:57', '2024-07-25 07:15:57'),
(2444, 2682, 4, '2024-07-25 07:15:57', '2024-07-25 07:15:57'),
(2445, 2683, 4, '2024-07-25 07:15:58', '2024-07-25 07:15:58'),
(2446, 2684, 4, '2024-07-25 07:15:58', '2024-07-25 07:15:58'),
(2447, 2685, 4, '2024-07-25 07:15:58', '2024-07-25 07:15:58'),
(2448, 2686, 4, '2024-07-25 07:15:58', '2024-07-25 07:15:58'),
(2449, 2687, 4, '2024-07-25 07:15:58', '2024-07-25 07:15:58'),
(2450, 2688, 4, '2024-07-25 07:15:58', '2024-07-25 07:15:58'),
(2451, 2689, 4, '2024-07-25 07:15:58', '2024-07-25 07:15:58'),
(2452, 2690, 4, '2024-07-25 07:15:58', '2024-07-25 07:15:58'),
(2453, 2691, 4, '2024-07-25 07:15:58', '2024-07-25 07:15:58'),
(2454, 2692, 4, '2024-07-25 07:15:58', '2024-07-25 07:15:58'),
(2455, 2693, 4, '2024-07-25 07:15:58', '2024-07-25 07:15:58'),
(2456, 2694, 4, '2024-07-25 07:15:58', '2024-07-25 07:15:58'),
(2457, 2695, 4, '2024-07-25 07:15:58', '2024-07-25 07:15:58'),
(2458, 2696, 4, '2024-07-25 07:15:58', '2024-07-25 07:15:58'),
(2459, 2697, 4, '2024-07-25 07:15:59', '2024-07-25 07:15:59'),
(2460, 2698, 4, '2024-07-25 07:15:59', '2024-07-25 07:15:59'),
(2461, 2699, 4, '2024-07-25 07:15:59', '2024-07-25 07:15:59'),
(2462, 2700, 4, '2024-07-25 07:15:59', '2024-07-25 07:15:59'),
(2463, 2701, 4, '2024-07-25 07:15:59', '2024-07-25 07:15:59'),
(2464, 2702, 4, '2024-07-25 07:15:59', '2024-07-25 07:15:59'),
(2465, 2703, 4, '2024-07-25 07:15:59', '2024-07-25 07:15:59'),
(2466, 2704, 4, '2024-07-25 07:15:59', '2024-07-25 07:15:59'),
(2467, 2705, 4, '2024-07-25 07:15:59', '2024-07-25 07:15:59'),
(2468, 2706, 4, '2024-07-25 07:15:59', '2024-07-25 07:15:59'),
(2469, 2707, 4, '2024-07-25 07:15:59', '2024-07-25 07:15:59'),
(2470, 2708, 4, '2024-07-25 07:15:59', '2024-07-25 07:15:59'),
(2471, 2709, 4, '2024-07-25 07:15:59', '2024-07-25 07:15:59'),
(2472, 2710, 4, '2024-07-25 07:15:59', '2024-07-25 07:15:59'),
(2509, 2752, 4, '2024-07-25 07:28:05', '2024-07-25 07:28:05'),
(2510, 2753, 4, '2024-07-25 07:28:05', '2024-07-25 07:28:05'),
(2511, 2754, 4, '2024-07-25 07:28:05', '2024-07-25 07:28:05'),
(2512, 2755, 4, '2024-07-25 07:28:05', '2024-07-25 07:28:05'),
(2513, 2756, 4, '2024-07-25 07:28:06', '2024-07-25 07:28:06'),
(2514, 2757, 4, '2024-07-25 07:28:06', '2024-07-25 07:28:06'),
(2515, 2758, 4, '2024-07-25 07:28:06', '2024-07-25 07:28:06'),
(2516, 2759, 4, '2024-07-25 07:28:06', '2024-07-25 07:28:06'),
(2517, 2760, 4, '2024-07-25 07:28:06', '2024-07-25 07:28:06'),
(2518, 2761, 4, '2024-07-25 07:28:06', '2024-07-25 07:28:06'),
(2519, 2762, 4, '2024-07-25 07:28:06', '2024-07-25 07:28:06'),
(2520, 2763, 4, '2024-07-25 07:28:06', '2024-07-25 07:28:06'),
(2521, 2764, 4, '2024-07-25 07:28:06', '2024-07-25 07:28:06'),
(2522, 2765, 4, '2024-07-25 07:28:06', '2024-07-25 07:28:06'),
(2523, 2766, 4, '2024-07-25 07:28:06', '2024-07-25 07:28:06'),
(2524, 2767, 4, '2024-07-25 07:28:06', '2024-07-25 07:28:06'),
(2525, 2768, 4, '2024-07-25 07:28:06', '2024-07-25 07:28:06'),
(2526, 2769, 4, '2024-07-25 07:28:06', '2024-07-25 07:28:06'),
(2527, 2770, 4, '2024-07-25 07:28:07', '2024-07-25 07:28:07'),
(2528, 2771, 4, '2024-07-25 07:28:07', '2024-07-25 07:28:07'),
(2529, 2772, 4, '2024-07-25 07:28:07', '2024-07-25 07:28:07'),
(2530, 2773, 4, '2024-07-25 07:28:07', '2024-07-25 07:28:07'),
(2531, 2774, 4, '2024-07-25 07:28:07', '2024-07-25 07:28:07'),
(2532, 2775, 4, '2024-07-25 07:28:07', '2024-07-25 07:28:07'),
(2533, 2776, 4, '2024-07-25 07:28:07', '2024-07-25 07:28:07'),
(2534, 2777, 4, '2024-07-25 07:28:07', '2024-07-25 07:28:07'),
(2535, 2778, 4, '2024-07-25 07:28:07', '2024-07-25 07:28:07'),
(2536, 2779, 4, '2024-07-25 07:28:07', '2024-07-25 07:28:07'),
(2537, 2780, 4, '2024-07-25 07:28:07', '2024-07-25 07:28:07'),
(2538, 2781, 4, '2024-07-25 07:28:07', '2024-07-25 07:28:07'),
(2539, 2782, 4, '2024-07-25 07:28:07', '2024-07-25 07:28:07'),
(2540, 2783, 4, '2024-07-25 07:28:07', '2024-07-25 07:28:07'),
(2541, 2784, 4, '2024-07-25 07:28:07', '2024-07-25 07:28:07'),
(2542, 2785, 4, '2024-07-25 07:28:08', '2024-07-25 07:28:08'),
(2543, 2786, 4, '2024-07-25 07:28:08', '2024-07-25 07:28:08'),
(2544, 2787, 4, '2024-07-25 07:28:08', '2024-07-25 07:28:08'),
(2701, 2954, 4, '2024-07-25 07:54:42', '2024-07-25 07:54:42'),
(2702, 2955, 4, '2024-07-25 07:54:43', '2024-07-25 07:54:43'),
(2703, 2956, 4, '2024-07-25 07:54:43', '2024-07-25 07:54:43'),
(2704, 2957, 4, '2024-07-25 07:54:43', '2024-07-25 07:54:43'),
(2705, 2958, 4, '2024-07-25 07:54:43', '2024-07-25 07:54:43'),
(2706, 2959, 4, '2024-07-25 07:54:43', '2024-07-25 07:54:43'),
(2707, 2960, 4, '2024-07-25 07:54:43', '2024-07-25 07:54:43'),
(2708, 2961, 4, '2024-07-25 07:54:43', '2024-07-25 07:54:43'),
(2709, 2962, 4, '2024-07-25 07:54:43', '2024-07-25 07:54:43'),
(2710, 2963, 4, '2024-07-25 07:54:43', '2024-07-25 07:54:43'),
(2711, 2964, 4, '2024-07-25 07:54:43', '2024-07-25 07:54:43'),
(2712, 2965, 4, '2024-07-25 07:54:43', '2024-07-25 07:54:43'),
(2713, 2966, 4, '2024-07-25 07:54:43', '2024-07-25 07:54:43'),
(2714, 2967, 4, '2024-07-25 07:54:43', '2024-07-25 07:54:43'),
(2715, 2968, 4, '2024-07-25 07:54:43', '2024-07-25 07:54:43'),
(2716, 2969, 4, '2024-07-25 07:54:44', '2024-07-25 07:54:44'),
(2717, 2970, 4, '2024-07-25 07:54:44', '2024-07-25 07:54:44'),
(2718, 2971, 4, '2024-07-25 07:54:44', '2024-07-25 07:54:44'),
(2719, 2972, 4, '2024-07-25 07:54:44', '2024-07-25 07:54:44'),
(2720, 2973, 4, '2024-07-25 07:54:44', '2024-07-25 07:54:44'),
(2721, 2974, 4, '2024-07-25 07:54:44', '2024-07-25 07:54:44'),
(2722, 2975, 4, '2024-07-25 07:54:44', '2024-07-25 07:54:44'),
(2723, 2976, 4, '2024-07-25 07:54:44', '2024-07-25 07:54:44'),
(2724, 2977, 4, '2024-07-25 07:54:44', '2024-07-25 07:54:44'),
(2725, 2978, 4, '2024-07-25 07:54:44', '2024-07-25 07:54:44'),
(2726, 2979, 4, '2024-07-25 07:54:44', '2024-07-25 07:54:44'),
(2727, 2980, 4, '2024-07-25 07:54:44', '2024-07-25 07:54:44'),
(2728, 2981, 4, '2024-07-25 07:54:44', '2024-07-25 07:54:44'),
(2729, 2982, 4, '2024-07-25 07:54:45', '2024-07-25 07:54:45'),
(2730, 2983, 4, '2024-07-25 07:54:45', '2024-07-25 07:54:45'),
(2731, 2984, 4, '2024-07-25 07:54:45', '2024-07-25 07:54:45'),
(2732, 2985, 4, '2024-07-25 07:54:45', '2024-07-25 07:54:45'),
(2733, 2986, 4, '2024-07-25 07:54:45', '2024-07-25 07:54:45'),
(2734, 2987, 4, '2024-07-25 07:54:45', '2024-07-25 07:54:45'),
(2735, 2988, 4, '2024-07-25 07:54:45', '2024-07-25 07:54:45'),
(2736, 2989, 4, '2024-07-25 07:54:45', '2024-07-25 07:54:45'),
(2737, 2991, 4, '2024-07-25 08:00:17', '2024-07-25 08:00:17'),
(2738, 2992, 4, '2024-07-25 08:00:17', '2024-07-25 08:00:17'),
(2739, 2993, 4, '2024-07-25 08:00:17', '2024-07-25 08:00:17'),
(2740, 2994, 4, '2024-07-25 08:00:17', '2024-07-25 08:00:17'),
(2741, 2995, 4, '2024-07-25 08:00:17', '2024-07-25 08:00:17'),
(2742, 2996, 4, '2024-07-25 08:00:17', '2024-07-25 08:00:17'),
(2743, 2997, 4, '2024-07-25 08:00:18', '2024-07-25 08:00:18'),
(2744, 2998, 4, '2024-07-25 08:00:18', '2024-07-25 08:00:18'),
(2745, 2999, 4, '2024-07-25 08:00:18', '2024-07-25 08:00:18'),
(2746, 3000, 4, '2024-07-25 08:00:18', '2024-07-25 08:00:18'),
(2747, 3001, 4, '2024-07-25 08:00:18', '2024-07-25 08:00:18'),
(2748, 3002, 4, '2024-07-25 08:00:18', '2024-07-25 08:00:18'),
(2749, 3003, 4, '2024-07-25 08:00:18', '2024-07-25 08:00:18'),
(2750, 3004, 4, '2024-07-25 08:00:18', '2024-07-25 08:00:18'),
(2751, 3005, 4, '2024-07-25 08:00:18', '2024-07-25 08:00:18'),
(2752, 3006, 4, '2024-07-25 08:00:18', '2024-07-25 08:00:18'),
(2753, 3007, 4, '2024-07-25 08:00:18', '2024-07-25 08:00:18'),
(2754, 3008, 4, '2024-07-25 08:00:18', '2024-07-25 08:00:18'),
(2755, 3009, 4, '2024-07-25 08:00:18', '2024-07-25 08:00:18'),
(2756, 3010, 4, '2024-07-25 08:00:19', '2024-07-25 08:00:19'),
(2757, 3011, 4, '2024-07-25 08:00:19', '2024-07-25 08:00:19'),
(2758, 3012, 4, '2024-07-25 08:00:19', '2024-07-25 08:00:19'),
(2759, 3013, 4, '2024-07-25 08:00:19', '2024-07-25 08:00:19'),
(2760, 3014, 4, '2024-07-25 08:00:19', '2024-07-25 08:00:19'),
(2761, 3015, 4, '2024-07-25 08:00:19', '2024-07-25 08:00:19'),
(2762, 3016, 4, '2024-07-25 08:00:19', '2024-07-25 08:00:19'),
(2763, 3017, 4, '2024-07-25 08:00:19', '2024-07-25 08:00:19'),
(2764, 3018, 4, '2024-07-25 08:00:19', '2024-07-25 08:00:19'),
(2765, 3019, 4, '2024-07-25 08:00:19', '2024-07-25 08:00:19'),
(2766, 3020, 4, '2024-07-25 08:00:19', '2024-07-25 08:00:19'),
(2767, 3021, 4, '2024-07-25 08:00:19', '2024-07-25 08:00:19'),
(2768, 3022, 4, '2024-07-25 08:00:19', '2024-07-25 08:00:19'),
(2769, 3023, 4, '2024-07-25 08:00:20', '2024-07-25 08:00:20'),
(2770, 3024, 4, '2024-07-25 08:00:20', '2024-07-25 08:00:20'),
(2771, 3025, 4, '2024-07-25 08:00:20', '2024-07-25 08:00:20'),
(2772, 3026, 4, '2024-07-25 08:00:20', '2024-07-25 08:00:20'),
(2773, 3028, 4, '2024-07-25 08:05:00', '2024-07-25 08:05:00'),
(2774, 3029, 4, '2024-07-25 08:05:01', '2024-07-25 08:05:01'),
(2775, 3030, 4, '2024-07-25 08:05:01', '2024-07-25 08:05:01'),
(2776, 3031, 4, '2024-07-25 08:05:01', '2024-07-25 08:05:01'),
(2777, 3032, 4, '2024-07-25 08:05:01', '2024-07-25 08:05:01'),
(2778, 3033, 4, '2024-07-25 08:05:01', '2024-07-25 08:05:01'),
(2779, 3034, 4, '2024-07-25 08:05:01', '2024-07-25 08:05:01'),
(2780, 3035, 4, '2024-07-25 08:05:01', '2024-07-25 08:05:01'),
(2781, 3036, 4, '2024-07-25 08:05:01', '2024-07-25 08:05:01'),
(2782, 3037, 4, '2024-07-25 08:05:01', '2024-07-25 08:05:01'),
(2783, 3038, 4, '2024-07-25 08:05:02', '2024-07-25 08:05:02'),
(2784, 3039, 4, '2024-07-25 08:05:02', '2024-07-25 08:05:02'),
(2785, 3040, 4, '2024-07-25 08:05:02', '2024-07-25 08:05:02'),
(2786, 3041, 4, '2024-07-25 08:05:02', '2024-07-25 08:05:02'),
(2787, 3042, 4, '2024-07-25 08:05:02', '2024-07-25 08:05:02'),
(2788, 3043, 4, '2024-07-25 08:05:02', '2024-07-25 08:05:02'),
(2789, 3044, 4, '2024-07-25 08:05:02', '2024-07-25 08:05:02'),
(2790, 3045, 4, '2024-07-25 08:05:02', '2024-07-25 08:05:02'),
(2791, 3046, 4, '2024-07-25 08:05:02', '2024-07-25 08:05:02'),
(2792, 3047, 4, '2024-07-25 08:05:03', '2024-07-25 08:05:03'),
(2793, 3048, 4, '2024-07-25 08:05:03', '2024-07-25 08:05:03'),
(2794, 3049, 4, '2024-07-25 08:05:03', '2024-07-25 08:05:03'),
(2795, 3050, 4, '2024-07-25 08:05:03', '2024-07-25 08:05:03'),
(2796, 3051, 4, '2024-07-25 08:05:03', '2024-07-25 08:05:03'),
(2797, 3052, 4, '2024-07-25 08:05:03', '2024-07-25 08:05:03'),
(2798, 3053, 4, '2024-07-25 08:05:03', '2024-07-25 08:05:03'),
(2799, 3054, 4, '2024-07-25 08:05:03', '2024-07-25 08:05:03'),
(2800, 3055, 4, '2024-07-25 08:05:03', '2024-07-25 08:05:03'),
(2801, 3056, 4, '2024-07-25 08:05:03', '2024-07-25 08:05:03'),
(2802, 3057, 4, '2024-07-25 08:05:04', '2024-07-25 08:05:04'),
(2803, 3058, 4, '2024-07-25 08:05:04', '2024-07-25 08:05:04'),
(2804, 3059, 4, '2024-07-25 08:05:04', '2024-07-25 08:05:04'),
(2805, 3060, 4, '2024-07-25 08:05:04', '2024-07-25 08:05:04'),
(2806, 3061, 4, '2024-07-25 08:05:04', '2024-07-25 08:05:04'),
(2807, 3062, 4, '2024-07-25 08:05:04', '2024-07-25 08:05:04'),
(2808, 3063, 4, '2024-07-25 08:05:04', '2024-07-25 08:05:04'),
(2809, 3066, 4, '2024-07-25 08:10:01', '2024-07-25 08:10:01'),
(2810, 3067, 4, '2024-07-25 08:10:01', '2024-07-25 08:10:01'),
(2811, 3068, 4, '2024-07-25 08:10:01', '2024-07-25 08:10:01'),
(2812, 3069, 4, '2024-07-25 08:10:01', '2024-07-25 08:10:01'),
(2813, 3070, 4, '2024-07-25 08:10:02', '2024-07-25 08:10:02'),
(2814, 3071, 4, '2024-07-25 08:10:02', '2024-07-25 08:10:02'),
(2815, 3072, 4, '2024-07-25 08:10:02', '2024-07-25 08:10:02'),
(2816, 3073, 4, '2024-07-25 08:10:02', '2024-07-25 08:10:02'),
(2817, 3074, 4, '2024-07-25 08:10:02', '2024-07-25 08:10:02'),
(2818, 3075, 4, '2024-07-25 08:10:02', '2024-07-25 08:10:02'),
(2819, 3076, 4, '2024-07-25 08:10:02', '2024-07-25 08:10:02'),
(2820, 3077, 4, '2024-07-25 08:10:02', '2024-07-25 08:10:02'),
(2821, 3078, 4, '2024-07-25 08:10:03', '2024-07-25 08:10:03'),
(2822, 3079, 4, '2024-07-25 08:10:03', '2024-07-25 08:10:03'),
(2823, 3080, 4, '2024-07-25 08:10:03', '2024-07-25 08:10:03'),
(2824, 3081, 4, '2024-07-25 08:10:03', '2024-07-25 08:10:03'),
(2825, 3082, 4, '2024-07-25 08:10:03', '2024-07-25 08:10:03'),
(2826, 3083, 4, '2024-07-25 08:10:03', '2024-07-25 08:10:03'),
(2827, 3084, 4, '2024-07-25 08:10:03', '2024-07-25 08:10:03'),
(2828, 3085, 4, '2024-07-25 08:10:03', '2024-07-25 08:10:03'),
(2829, 3086, 4, '2024-07-25 08:10:03', '2024-07-25 08:10:03'),
(2830, 3087, 4, '2024-07-25 08:10:03', '2024-07-25 08:10:03'),
(2831, 3088, 4, '2024-07-25 08:10:03', '2024-07-25 08:10:03'),
(2832, 3089, 4, '2024-07-25 08:10:04', '2024-07-25 08:10:04'),
(2833, 3090, 4, '2024-07-25 08:10:04', '2024-07-25 08:10:04'),
(2834, 3091, 4, '2024-07-25 08:10:04', '2024-07-25 08:10:04'),
(2835, 3092, 4, '2024-07-25 08:10:04', '2024-07-25 08:10:04'),
(2836, 3093, 4, '2024-07-25 08:10:04', '2024-07-25 08:10:04'),
(2837, 3094, 4, '2024-07-25 08:10:04', '2024-07-25 08:10:04'),
(2838, 3095, 4, '2024-07-25 08:10:04', '2024-07-25 08:10:04'),
(2839, 3096, 4, '2024-07-25 08:10:04', '2024-07-25 08:10:04'),
(2840, 3097, 4, '2024-07-25 08:10:04', '2024-07-25 08:10:04'),
(2841, 3098, 4, '2024-07-25 08:10:04', '2024-07-25 08:10:04'),
(2842, 3099, 4, '2024-07-25 08:10:04', '2024-07-25 08:10:04'),
(2843, 3100, 4, '2024-07-25 08:10:04', '2024-07-25 08:10:04'),
(2844, 3101, 4, '2024-07-25 08:10:04', '2024-07-25 08:10:04'),
(2881, 3140, 4, '2024-07-25 08:14:30', '2024-07-25 08:14:30'),
(2882, 3141, 4, '2024-07-25 08:14:30', '2024-07-25 08:14:30'),
(2883, 3142, 4, '2024-07-25 08:14:30', '2024-07-25 08:14:30'),
(2884, 3143, 4, '2024-07-25 08:14:30', '2024-07-25 08:14:30'),
(2885, 3144, 4, '2024-07-25 08:14:30', '2024-07-25 08:14:30'),
(2886, 3145, 4, '2024-07-25 08:14:30', '2024-07-25 08:14:30'),
(2887, 3146, 4, '2024-07-25 08:14:30', '2024-07-25 08:14:30'),
(2888, 3147, 4, '2024-07-25 08:14:30', '2024-07-25 08:14:30'),
(2889, 3148, 4, '2024-07-25 08:14:30', '2024-07-25 08:14:30'),
(2890, 3149, 4, '2024-07-25 08:14:30', '2024-07-25 08:14:30'),
(2891, 3150, 4, '2024-07-25 08:14:30', '2024-07-25 08:14:30'),
(2892, 3151, 4, '2024-07-25 08:14:30', '2024-07-25 08:14:30'),
(2893, 3152, 4, '2024-07-25 08:14:30', '2024-07-25 08:14:30'),
(2894, 3153, 4, '2024-07-25 08:14:30', '2024-07-25 08:14:30'),
(2895, 3154, 4, '2024-07-25 08:14:31', '2024-07-25 08:14:31'),
(2896, 3155, 4, '2024-07-25 08:14:31', '2024-07-25 08:14:31'),
(2897, 3156, 4, '2024-07-25 08:14:31', '2024-07-25 08:14:31'),
(2898, 3157, 4, '2024-07-25 08:14:31', '2024-07-25 08:14:31'),
(2899, 3158, 4, '2024-07-25 08:14:31', '2024-07-25 08:14:31'),
(2900, 3159, 4, '2024-07-25 08:14:31', '2024-07-25 08:14:31'),
(2901, 3160, 4, '2024-07-25 08:14:31', '2024-07-25 08:14:31'),
(2902, 3161, 4, '2024-07-25 08:14:31', '2024-07-25 08:14:31'),
(2903, 3162, 4, '2024-07-25 08:14:31', '2024-07-25 08:14:31'),
(2904, 3163, 4, '2024-07-25 08:14:31', '2024-07-25 08:14:31'),
(2905, 3164, 4, '2024-07-25 08:14:31', '2024-07-25 08:14:31'),
(2906, 3165, 4, '2024-07-25 08:14:31', '2024-07-25 08:14:31'),
(2907, 3166, 4, '2024-07-25 08:14:32', '2024-07-25 08:14:32'),
(2908, 3167, 4, '2024-07-25 08:14:32', '2024-07-25 08:14:32'),
(2909, 3168, 4, '2024-07-25 08:14:32', '2024-07-25 08:14:32'),
(2910, 3169, 4, '2024-07-25 08:14:32', '2024-07-25 08:14:32'),
(2911, 3170, 4, '2024-07-25 08:14:32', '2024-07-25 08:14:32'),
(2912, 3171, 4, '2024-07-25 08:14:32', '2024-07-25 08:14:32'),
(2913, 3172, 4, '2024-07-25 08:14:32', '2024-07-25 08:14:32'),
(2914, 3173, 4, '2024-07-25 08:14:32', '2024-07-25 08:14:32'),
(2915, 3174, 4, '2024-07-25 08:14:32', '2024-07-25 08:14:32'),
(2916, 3175, 4, '2024-07-25 08:14:32', '2024-07-25 08:14:32');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `color` varchar(255) DEFAULT '#3498db',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `course_id`, `name`, `slug`, `color`, `created_at`, `updated_at`) VALUES
(67, 43, 'MATEMATIKA', 'matematikagdd', '#3498db', '2024-07-24 06:21:05', '2024-07-24 06:21:05'),
(68, 43, 'DASAR-DASAR DPIB', 'dasar-dasar-dpibnGL', '#3498db', '2024-07-24 06:21:05', '2024-07-24 06:21:05'),
(69, 43, 'BAHASA INGGRIS', 'bahasa-inggrisNoo', '#3498db', '2024-07-24 06:21:05', '2024-07-24 06:21:05'),
(70, 43, 'INFORMATIKA', 'informatikaOaz', '#3498db', '2024-07-24 06:21:05', '2024-07-24 06:21:05'),
(71, 43, 'BK', 'bkhbN', '#3498db', '2024-07-24 06:21:05', '2024-07-24 06:21:05'),
(72, 43, 'PIPAS', 'pipasjMA', '#3498db', '2024-07-24 06:21:05', '2024-07-24 06:21:05'),
(73, 43, 'PAIBP', 'paibpiT3', '#3498db', '2024-07-24 06:21:05', '2024-07-24 06:21:05'),
(74, 43, 'BAHASA SUNDA', 'bahasa-sunda382', '#3498db', '2024-07-24 06:21:05', '2024-07-24 06:21:05'),
(75, 43, 'SEJARAH', 'sejarahGQS', '#3498db', '2024-07-24 06:21:05', '2024-07-24 06:21:05'),
(76, 43, 'BAHASA INDONESIA', 'bahasa-indonesiaVt5', '#3498db', '2024-07-24 06:21:05', '2024-07-24 06:21:05'),
(77, 43, 'SENI BUDAYA', 'seni-budayatNc', '#3498db', '2024-07-24 06:21:05', '2024-07-24 06:21:05'),
(78, 43, 'PANCASILA', 'pancasilatGv', '#3498db', '2024-07-24 06:21:05', '2024-07-24 06:21:05'),
(79, 43, 'PJOK', 'pjok1qN', '#3498db', '2024-07-24 06:21:05', '2024-07-24 06:21:05'),
(105, 36, 'BAHASA INGGRIS', 'bahasa-inggrisuQq', '#3498db', '2024-07-24 06:27:26', '2024-07-24 06:27:26'),
(106, 36, 'DASAR DASAR TEKNIK OTOMOTIF', 'dasar-dasar-teknik-otomotif6ja', '#3498db', '2024-07-24 06:27:26', '2024-07-24 06:27:26'),
(107, 36, 'MATEMATIKA', 'matematikaCSe', '#3498db', '2024-07-24 06:27:26', '2024-07-24 06:27:26'),
(108, 36, 'INFORMATIKA', 'informatikaWeP', '#3498db', '2024-07-24 06:27:26', '2024-07-24 06:27:26'),
(109, 36, 'BK', 'bkt1Q', '#3498db', '2024-07-24 06:27:26', '2024-07-24 06:27:26'),
(110, 36, 'PJOK', 'pjokzsR', '#3498db', '2024-07-24 06:27:26', '2024-07-24 06:27:26'),
(111, 36, 'PAIBP', 'paibpc9k', '#3498db', '2024-07-24 06:27:26', '2024-07-24 06:27:26'),
(112, 36, 'BAHASA INDONESIA', 'bahasa-indonesiacMZ', '#3498db', '2024-07-24 06:27:26', '2024-07-24 06:27:26'),
(113, 36, 'PIPAS', 'pipasEBC', '#3498db', '2024-07-24 06:27:26', '2024-07-24 06:27:26'),
(114, 36, 'SEJARAH', 'sejarah9Vr', '#3498db', '2024-07-24 06:27:26', '2024-07-24 06:27:26'),
(115, 36, 'SENI BUDAYA', 'seni-budayaCET', '#3498db', '2024-07-24 06:27:26', '2024-07-24 06:27:26'),
(116, 36, 'PANCASILA', 'pancasilazLr', '#3498db', '2024-07-24 06:27:26', '2024-07-24 06:27:26'),
(117, 36, 'BAHASA SUNDA', 'bahasa-sundaqGF', '#3498db', '2024-07-24 06:27:26', '2024-07-24 06:27:26'),
(118, 37, 'MATEMATIKA', 'matematika4cR', '#3498db', '2024-07-24 06:32:37', '2024-07-24 06:32:37'),
(119, 37, 'DASAR-DASAR TEKNIK OTOMOTIF', 'dasar-dasar-teknik-otomotifhVn', '#3498db', '2024-07-24 06:32:37', '2024-07-24 06:32:37'),
(120, 37, 'PJOK', 'pjokmdF', '#3498db', '2024-07-24 06:32:37', '2024-07-24 06:32:37'),
(121, 37, 'BAHASA INGGRIS', 'bahasa-inggrisPZ5', '#3498db', '2024-07-24 06:32:37', '2024-07-24 06:32:37'),
(122, 37, 'BAHASA INDONESIA', 'bahasa-indonesiaZPF', '#3498db', '2024-07-24 06:32:37', '2024-07-24 06:32:37'),
(123, 37, 'BAHASA SUNDA', 'bahasa-sundaAqY', '#3498db', '2024-07-24 06:32:37', '2024-07-24 06:32:37'),
(124, 37, 'SEJARAH', 'sejarahzqq', '#3498db', '2024-07-24 06:32:37', '2024-07-24 06:32:37'),
(125, 37, 'PIPAS', 'pipas9zz', '#3498db', '2024-07-24 06:32:37', '2024-07-24 06:32:37'),
(126, 37, 'PAIBP', 'paibpKI2', '#3498db', '2024-07-24 06:32:37', '2024-07-24 06:32:37'),
(127, 37, 'BK', 'bklTz', '#3498db', '2024-07-24 06:32:37', '2024-07-24 06:32:37'),
(128, 37, 'PANCASILA', 'pancasilarJQ', '#3498db', '2024-07-24 06:32:37', '2024-07-24 06:32:37'),
(129, 37, 'SENI BUDAYA', 'seni-budayakA8', '#3498db', '2024-07-24 06:32:37', '2024-07-24 06:32:37'),
(130, 37, 'INFORMATIKA', 'informatikano4', '#3498db', '2024-07-24 06:32:37', '2024-07-24 06:32:37'),
(131, 38, 'BAHASA INDONESIA', 'bahasa-indonesiaGPW', '#3498db', '2024-07-24 06:36:55', '2024-07-24 06:36:55'),
(132, 38, 'BAHASA SUNDA', 'bahasa-sundaTAy', '#3498db', '2024-07-24 06:36:55', '2024-07-24 06:36:55'),
(133, 38, 'SEJARAH', 'sejarah8x8', '#3498db', '2024-07-24 06:36:55', '2024-07-24 06:36:55'),
(134, 38, 'PANCASILA', 'pancasilamIp', '#3498db', '2024-07-24 06:36:55', '2024-07-24 06:36:55'),
(135, 38, 'PJOK', 'pjokLoM', '#3498db', '2024-07-24 06:36:55', '2024-07-24 06:36:55'),
(136, 38, 'SENI BUDAYA', 'seni-budaya9rS', '#3498db', '2024-07-24 06:36:55', '2024-07-24 06:36:55'),
(137, 38, 'PAIBP', 'paibpBb6', '#3498db', '2024-07-24 06:36:55', '2024-07-24 06:36:55'),
(138, 38, 'PIPAS', 'pipasKOr', '#3498db', '2024-07-24 06:36:55', '2024-07-24 06:36:55'),
(139, 38, 'BK', 'bk2E6', '#3498db', '2024-07-24 06:36:55', '2024-07-24 06:36:55'),
(140, 38, 'INFORMATIKA', 'informatikakrQ', '#3498db', '2024-07-24 06:36:55', '2024-07-24 06:36:55'),
(141, 38, 'DASAR-DASAR TEKNIK OTOMOTIF', 'dasar-dasar-teknik-otomotifVUj', '#3498db', '2024-07-24 06:36:55', '2024-07-24 06:36:55'),
(142, 38, 'BAHASA INGGRIS', 'bahasa-inggrisrEX', '#3498db', '2024-07-24 06:36:55', '2024-07-24 06:36:55'),
(143, 38, 'MATEMATIKA', 'matematika427', '#3498db', '2024-07-24 06:36:55', '2024-07-24 06:36:55'),
(157, 34, 'PIPAS', 'pipasIm6', '#3498db', '2024-07-24 06:45:43', '2024-07-24 06:45:43'),
(158, 34, 'BAHASA SUNDA', 'bahasa-sundaBaK', '#3498db', '2024-07-24 06:45:43', '2024-07-24 06:45:43'),
(159, 34, 'SEJARAH', 'sejarahpTc', '#3498db', '2024-07-24 06:45:43', '2024-07-24 06:45:43'),
(160, 34, 'PJOK', 'pjok3Pe', '#3498db', '2024-07-24 06:45:43', '2024-07-24 06:45:43'),
(161, 34, 'PANCASILA', 'pancasilaseL', '#3498db', '2024-07-24 06:45:43', '2024-07-24 06:45:43'),
(162, 34, 'PAIBP', 'paibpRYw', '#3498db', '2024-07-24 06:45:43', '2024-07-24 06:45:43'),
(163, 34, 'BAHASA INDONESIA', 'bahasa-indonesiaks8', '#3498db', '2024-07-24 06:45:43', '2024-07-24 06:45:43'),
(164, 34, 'BK', 'bkSTI', '#3498db', '2024-07-24 06:45:43', '2024-07-24 06:45:43'),
(165, 34, 'SENI BUDAYA', 'seni-budayaxXd', '#3498db', '2024-07-24 06:45:43', '2024-07-24 06:45:43'),
(166, 34, 'MATEMATIKA', 'matematika0VO', '#3498db', '2024-07-24 06:45:43', '2024-07-24 06:45:43'),
(167, 34, 'DASAR DASAR PPLG', 'dasar-dasar-pplgox3', '#3498db', '2024-07-24 06:45:43', '2024-07-24 06:45:43'),
(168, 34, 'BAHASA INGGRIS', 'bahasa-inggrisUOF', '#3498db', '2024-07-24 06:45:43', '2024-07-24 06:45:43'),
(169, 34, 'INFORMATIKA', 'informatikaOoB', '#3498db', '2024-07-24 06:45:43', '2024-07-24 06:45:43'),
(196, 40, 'DASAR-DASAR TJKT', 'dasar-dasar-tjktlNO', '#3498db', '2024-07-24 06:58:13', '2024-07-24 06:58:13'),
(197, 40, 'MATEMATIKA', 'matematikavF2', '#3498db', '2024-07-24 06:58:13', '2024-07-24 06:58:13'),
(198, 40, 'INFORMATIKA', 'informatikaBmD', '#3498db', '2024-07-24 06:58:13', '2024-07-24 06:58:13'),
(199, 40, 'BAHASA INGGRIS', 'bahasa-inggrisJVQ', '#3498db', '2024-07-24 06:58:13', '2024-07-24 06:58:13'),
(200, 40, 'BK', 'bkuCW', '#3498db', '2024-07-24 06:58:13', '2024-07-24 06:58:13'),
(201, 40, 'PAIBP', 'paibpnt2', '#3498db', '2024-07-24 06:58:13', '2024-07-24 06:58:13'),
(202, 40, 'PANCASILA', 'pancasilainB', '#3498db', '2024-07-24 06:58:13', '2024-07-24 06:58:13'),
(203, 40, 'SEJARAH', 'sejarahHZ2', '#3498db', '2024-07-24 06:58:13', '2024-07-24 06:58:13'),
(204, 40, 'SENI BUDAYA', 'seni-budayaFIK', '#3498db', '2024-07-24 06:58:13', '2024-07-24 06:58:13'),
(205, 40, 'BAHASA INDONESIA', 'bahasa-indonesiavxA', '#3498db', '2024-07-24 06:58:13', '2024-07-24 06:58:13'),
(206, 40, 'BAHASA SUNDA', 'bahasa-sundaC9E', '#3498db', '2024-07-24 06:58:13', '2024-07-24 06:58:13'),
(207, 40, 'PIPAS', 'pipasE86', '#3498db', '2024-07-24 06:58:13', '2024-07-24 06:58:13'),
(208, 40, 'PJOK', 'pjoknMR', '#3498db', '2024-07-24 06:58:13', '2024-07-24 06:58:13'),
(209, 41, 'DASAR-DASAR TJKT', 'dasar-dasar-tjktzTO', '#3498db', '2024-07-24 07:18:28', '2024-07-24 07:18:28'),
(210, 41, 'BAHASA INGGRIS', 'bahasa-inggrisl86', '#3498db', '2024-07-24 07:18:28', '2024-07-24 07:18:28'),
(211, 41, 'INFORMATIKA', 'informatikakz2', '#3498db', '2024-07-24 07:18:28', '2024-07-24 07:18:28'),
(212, 41, 'MATEMATIKA', 'matematikaWfD', '#3498db', '2024-07-24 07:18:28', '2024-07-24 07:18:28'),
(213, 41, 'BK', 'bkqEN', '#3498db', '2024-07-24 07:18:28', '2024-07-24 07:18:28'),
(214, 41, 'PAIBP', 'paibpMkh', '#3498db', '2024-07-24 07:18:28', '2024-07-24 07:18:28'),
(215, 41, 'PJOK', 'pjok5ah', '#3498db', '2024-07-24 07:18:28', '2024-07-24 07:18:28'),
(216, 41, 'BAHASA SUNDA', 'bahasa-sundadsA', '#3498db', '2024-07-24 07:18:28', '2024-07-24 07:18:28'),
(217, 41, 'PANCASILA', 'pancasilaDpu', '#3498db', '2024-07-24 07:18:28', '2024-07-24 07:18:28'),
(218, 41, 'BAHASA INDONESIA', 'bahasa-indonesiadKd', '#3498db', '2024-07-24 07:18:28', '2024-07-24 07:18:28'),
(219, 41, 'SENI BUDAYA', 'seni-budayawMv', '#3498db', '2024-07-24 07:18:28', '2024-07-24 07:18:28'),
(220, 41, 'SEJARAH', 'sejarahtOg', '#3498db', '2024-07-24 07:18:28', '2024-07-24 07:18:28'),
(221, 41, 'PIPAS', 'pipas4CR', '#3498db', '2024-07-24 07:18:28', '2024-07-24 07:18:28'),
(235, 45, 'DASAR-DASAR MPLB', 'dasar-dasar-mplbjAH', '#3498db', '2024-07-24 07:25:36', '2024-07-24 07:25:36'),
(236, 45, 'MATEMATIKA', 'matematika4Hq', '#3498db', '2024-07-24 07:25:36', '2024-07-24 07:25:36'),
(237, 45, 'BAHASA INGGRIS', 'bahasa-inggrisvHq', '#3498db', '2024-07-24 07:25:36', '2024-07-24 07:25:36'),
(238, 45, 'INFORMATIKA', 'informatikaqoJ', '#3498db', '2024-07-24 07:25:36', '2024-07-24 07:25:36'),
(239, 45, 'BK', 'bkrMv', '#3498db', '2024-07-24 07:25:36', '2024-07-24 07:25:36'),
(240, 45, 'PJOK', 'pjokOIe', '#3498db', '2024-07-24 07:25:36', '2024-07-24 07:25:36'),
(241, 45, 'PAIBP', 'paibpbLo', '#3498db', '2024-07-24 07:25:36', '2024-07-24 07:25:36'),
(242, 45, 'BAHASA INDONESIA', 'bahasa-indonesiaOay', '#3498db', '2024-07-24 07:25:36', '2024-07-24 07:25:36'),
(243, 45, 'SENI BUDAYA', 'seni-budayaElu', '#3498db', '2024-07-24 07:25:36', '2024-07-24 07:25:36'),
(244, 45, 'PANCASILA', 'pancasilaD0U', '#3498db', '2024-07-24 07:25:36', '2024-07-24 07:25:36'),
(245, 45, 'SEJARAH', 'sejarahBz8', '#3498db', '2024-07-24 07:25:36', '2024-07-24 07:25:36'),
(246, 45, 'BAHASA SUNDA', 'bahasa-sundaTYp', '#3498db', '2024-07-24 07:25:36', '2024-07-24 07:25:36'),
(247, 45, 'PIPAS', 'pipasAwD', '#3498db', '2024-07-24 07:25:36', '2024-07-24 07:25:36'),
(261, 47, 'MATEMATIKA', 'matematikat28', '#3498db', '2024-07-24 07:33:01', '2024-07-24 07:33:01'),
(262, 47, 'INFORMATIKA', 'informatikauX2', '#3498db', '2024-07-24 07:33:01', '2024-07-24 07:33:01'),
(263, 47, 'BAHASA INGGRIS', 'bahasa-inggrisZ0J', '#3498db', '2024-07-24 07:33:01', '2024-07-24 07:33:01'),
(264, 47, 'BAHASA INDONESIA', 'bahasa-indonesiaoXC', '#3498db', '2024-07-24 07:33:01', '2024-07-24 07:33:01'),
(265, 47, 'BAHASA SUNDA', 'bahasa-sundaioO', '#3498db', '2024-07-24 07:33:01', '2024-07-24 07:33:01'),
(266, 47, 'PJOK', 'pjokfTn', '#3498db', '2024-07-24 07:33:01', '2024-07-24 07:33:01'),
(267, 47, 'SENI BUDAYA', 'seni-budayaUva', '#3498db', '2024-07-24 07:33:01', '2024-07-24 07:33:01'),
(268, 47, 'SEJARAH', 'sejarahuSF', '#3498db', '2024-07-24 07:33:01', '2024-07-24 07:33:01'),
(269, 47, 'BK', 'bkm22', '#3498db', '2024-07-24 07:33:01', '2024-07-24 07:33:01'),
(270, 47, 'DASAR DASAR AKL', 'dasar-dasar-aklpOB', '#3498db', '2024-07-24 07:33:01', '2024-07-24 07:33:01'),
(271, 47, 'PIPAS', 'pipas6op', '#3498db', '2024-07-24 07:33:01', '2024-07-24 07:33:01'),
(272, 47, 'PANCASILA', 'pancasila6F7', '#3498db', '2024-07-24 07:33:01', '2024-07-24 07:33:01'),
(273, 47, 'PAIBP', 'paibpcpZ', '#3498db', '2024-07-24 07:33:01', '2024-07-24 07:33:01'),
(274, 46, 'BAHAS INDONESIA', 'bahas-indonesiazr5', '#3498db', '2024-07-24 07:33:45', '2024-07-24 07:33:45'),
(275, 46, 'PIPAS', 'pipasFoH', '#3498db', '2024-07-24 07:33:45', '2024-07-24 07:33:45'),
(276, 46, 'SENI BUDAYA', 'seni-budayaGz3', '#3498db', '2024-07-24 07:33:45', '2024-07-24 07:33:45'),
(277, 46, 'PANCASILA', 'pancasilaW20', '#3498db', '2024-07-24 07:33:45', '2024-07-24 07:33:45'),
(278, 46, 'BAHASA SUNDA', 'bahasa-sundaBy2', '#3498db', '2024-07-24 07:33:45', '2024-07-24 07:33:45'),
(279, 46, 'SEJARAH', 'sejarahNrw', '#3498db', '2024-07-24 07:33:45', '2024-07-24 07:33:45'),
(280, 46, 'PJOK', 'pjokRjj', '#3498db', '2024-07-24 07:33:45', '2024-07-24 07:33:45'),
(281, 46, 'BK', 'bkHVO', '#3498db', '2024-07-24 07:33:45', '2024-07-24 07:33:45'),
(282, 46, 'INFORMATIKA', 'informatikajwv', '#3498db', '2024-07-24 07:33:45', '2024-07-24 07:33:45'),
(283, 46, 'BAHASA INGGRIS', 'bahasa-inggrisPo7', '#3498db', '2024-07-24 07:33:45', '2024-07-24 07:33:45'),
(284, 46, 'MATEMATIKA', 'matematikaxcN', '#3498db', '2024-07-24 07:33:45', '2024-07-24 07:33:45'),
(285, 46, 'PAIBP', 'paibpMCl', '#3498db', '2024-07-24 07:33:45', '2024-07-24 07:33:45'),
(286, 46, 'DASAR DASAR AKL', 'dasar-dasar-aklio5', '#3498db', '2024-07-24 07:33:45', '2024-07-24 07:33:45'),
(287, 48, 'PAIBP', 'paibpOIy', '#3498db', '2024-07-24 07:36:42', '2024-07-24 07:36:42'),
(288, 48, 'PJOK', 'pjoktyZ', '#3498db', '2024-07-24 07:36:42', '2024-07-24 07:36:42'),
(289, 48, 'SEJARAH', 'sejarah3GP', '#3498db', '2024-07-24 07:36:42', '2024-07-24 07:36:42'),
(290, 48, 'SENI BUDAYA', 'seni-budayagkb', '#3498db', '2024-07-24 07:36:42', '2024-07-24 07:36:42'),
(291, 48, 'PANCASILA', 'pancasilagTd', '#3498db', '2024-07-24 07:36:42', '2024-07-24 07:36:42'),
(292, 48, 'BAHASA SUNDA', 'bahasa-sundah7p', '#3498db', '2024-07-24 07:36:42', '2024-07-24 07:36:42'),
(293, 48, 'BAHASA INGGRIS', 'bahasa-inggris04g', '#3498db', '2024-07-24 07:36:42', '2024-07-24 07:36:42'),
(294, 48, 'BAHASA INDONESIA', 'bahasa-indonesiayfo', '#3498db', '2024-07-24 07:36:42', '2024-07-24 07:36:42'),
(295, 48, 'PIPAS', 'pipas6PM', '#3498db', '2024-07-24 07:36:42', '2024-07-24 07:36:42'),
(296, 48, 'DASAR-DASAR SENI PERTUNJUKAN', 'dasar-dasar-seni-pertunjukanFST', '#3498db', '2024-07-24 07:36:42', '2024-07-24 07:36:42'),
(297, 48, 'INFORMATIKA', 'informatika2rO', '#3498db', '2024-07-24 07:36:42', '2024-07-24 07:36:42'),
(298, 48, 'MATEMATIKA', 'matematikaEoG', '#3498db', '2024-07-24 07:36:42', '2024-07-24 07:36:42'),
(299, 48, 'BK', 'bkE42', '#3498db', '2024-07-24 07:36:42', '2024-07-24 07:36:42'),
(300, 49, 'PAIBP', 'paibpfMD', '#3498db', '2024-07-24 07:39:59', '2024-07-24 07:39:59'),
(301, 49, 'SENI BUDAYA', 'seni-budayaH2K', '#3498db', '2024-07-24 07:39:59', '2024-07-24 07:39:59'),
(302, 49, 'PJOK', 'pjokDYh', '#3498db', '2024-07-24 07:39:59', '2024-07-24 07:39:59'),
(303, 49, 'PANCASILA', 'pancasilaa3l', '#3498db', '2024-07-24 07:39:59', '2024-07-24 07:39:59'),
(304, 49, 'SEJARAH', 'sejarahWmP', '#3498db', '2024-07-24 07:39:59', '2024-07-24 07:39:59'),
(305, 49, 'BAHASA SUNDA', 'bahasa-sundaCYS', '#3498db', '2024-07-24 07:39:59', '2024-07-24 07:39:59'),
(306, 49, 'BAHASA INDONESIA', 'bahasa-indonesiaLCC', '#3498db', '2024-07-24 07:39:59', '2024-07-24 07:39:59'),
(307, 49, 'BAHASA INGGRIS', 'bahasa-inggrisIjA', '#3498db', '2024-07-24 07:39:59', '2024-07-24 07:39:59'),
(308, 49, 'BK', 'bkYO7', '#3498db', '2024-07-24 07:39:59', '2024-07-24 07:39:59'),
(309, 49, 'INFORMATIKA', 'informatika1dP', '#3498db', '2024-07-24 07:39:59', '2024-07-24 07:39:59'),
(310, 49, 'MATEMATIKA', 'matematika8hh', '#3498db', '2024-07-24 07:39:59', '2024-07-24 07:39:59'),
(311, 49, 'DASAR-DASAR SENI PERTUNJUKAN', 'dasar-dasar-seni-pertunjukanbZV', '#3498db', '2024-07-24 07:39:59', '2024-07-24 07:39:59'),
(312, 49, 'PIPAS', 'pipasNG4', '#3498db', '2024-07-24 07:39:59', '2024-07-24 07:39:59'),
(313, 33, 'MATEMATIKA', 'matematikaMEW', '#3498db', '2024-07-24 07:40:38', '2024-07-24 07:40:38'),
(314, 33, 'DASAR DASAR PPLG', 'dasar-dasar-pplg1an', '#3498db', '2024-07-24 07:40:38', '2024-07-24 07:40:38'),
(315, 33, 'BAHASA INGGRIS', 'bahasa-inggrisDM5', '#3498db', '2024-07-24 07:40:38', '2024-07-24 07:40:38'),
(316, 33, 'BK', 'bkGeo', '#3498db', '2024-07-24 07:40:38', '2024-07-24 07:40:38'),
(317, 33, 'INFORMATIKA', 'informatika6kP', '#3498db', '2024-07-24 07:40:38', '2024-07-24 07:40:38'),
(318, 33, 'PJOK', 'pjokY9N', '#3498db', '2024-07-24 07:40:38', '2024-07-24 07:40:38'),
(319, 33, 'BAHASA SUNDA', 'bahasa-sundaMq2', '#3498db', '2024-07-24 07:40:38', '2024-07-24 07:40:38'),
(320, 33, 'SEJARAH', 'sejarahi4P', '#3498db', '2024-07-24 07:40:38', '2024-07-24 07:40:38'),
(321, 33, 'BAHASA INDONESIA', 'bahasa-indonesiaCxh', '#3498db', '2024-07-24 07:40:38', '2024-07-24 07:40:38'),
(322, 33, 'PANCASILA', 'pancasilakPH', '#3498db', '2024-07-24 07:40:38', '2024-07-24 07:40:38'),
(323, 33, 'PAIBP', 'paibpBQg', '#3498db', '2024-07-24 07:40:38', '2024-07-24 07:40:38'),
(324, 33, 'SENI BUDAYA', 'seni-budayaPtc', '#3498db', '2024-07-24 07:40:38', '2024-07-24 07:40:38'),
(325, 33, 'PIPAS', 'pipasoeH', '#3498db', '2024-07-24 07:40:38', '2024-07-24 07:40:38'),
(326, 39, 'MATEMATIKA', 'matematikatGF', '#3498db', '2024-07-24 08:11:55', '2024-07-24 08:11:55'),
(327, 39, 'BK', 'bkDjo', '#3498db', '2024-07-24 08:11:55', '2024-07-24 08:11:55'),
(328, 39, 'INFORMATIKA', 'informatikaYX3', '#3498db', '2024-07-24 08:11:55', '2024-07-24 08:11:55'),
(329, 39, 'BAHASA INGGRIS', 'bahasa-inggris8qM', '#3498db', '2024-07-24 08:11:55', '2024-07-24 08:11:55'),
(330, 39, 'DASAR-DASAR TJKT', 'dasar-dasar-tjkteS9', '#3498db', '2024-07-24 08:11:55', '2024-07-24 08:11:55'),
(331, 39, 'PIPAS', 'pipaseYl', '#3498db', '2024-07-24 08:11:55', '2024-07-24 08:11:55'),
(332, 39, 'BAHASA INDONESIA', 'bahasa-indonesiaMQm', '#3498db', '2024-07-24 08:11:55', '2024-07-24 08:11:55'),
(333, 39, 'PJOK', 'pjokJkQ', '#3498db', '2024-07-24 08:11:55', '2024-07-24 08:11:55'),
(334, 39, 'PAIBP', 'paibpzWn', '#3498db', '2024-07-24 08:11:55', '2024-07-24 08:11:55'),
(335, 39, 'BAHASA SUNDA', 'bahasa-sundaZja', '#3498db', '2024-07-24 08:11:55', '2024-07-24 08:11:55'),
(336, 39, 'SEJARAH', 'sejarah0Fw', '#3498db', '2024-07-24 08:11:55', '2024-07-24 08:11:55'),
(337, 39, 'SENI BUDAYA', 'seni-budayaka9', '#3498db', '2024-07-24 08:11:55', '2024-07-24 08:11:55'),
(338, 39, 'PANCASILA', 'pancasila6pk', '#3498db', '2024-07-24 08:11:55', '2024-07-24 08:11:55'),
(355, 50, 'PELAJARAN PILIHAN', 'pelajaran-pilihan5GA', '#3498db', '2024-07-24 09:21:57', '2024-07-24 09:21:57'),
(356, 50, 'DESAIN PEMODELAN DAN INFORMASI BANGUNAN', 'desain-pemodelan-dan-informasi-bangunan8Rl', '#3498db', '2024-07-24 09:21:57', '2024-07-24 09:21:57'),
(357, 50, 'PJOK', 'pjok81g', '#3498db', '2024-07-24 09:21:57', '2024-07-24 09:21:57'),
(358, 50, 'PKK', 'pkkbqE', '#3498db', '2024-07-24 09:21:57', '2024-07-24 09:21:57'),
(359, 50, 'PAIBP', 'paibpcQI', '#3498db', '2024-07-24 09:21:57', '2024-07-24 09:21:57'),
(360, 50, 'SEJARAH', 'sejarah92Q', '#3498db', '2024-07-24 09:21:57', '2024-07-24 09:21:57'),
(361, 50, 'BAHASA INDONESIA', 'bahasa-indonesiamXM', '#3498db', '2024-07-24 09:21:57', '2024-07-24 09:21:57'),
(362, 50, 'PANCASILA', 'pancasilaIeq', '#3498db', '2024-07-24 09:21:57', '2024-07-24 09:21:57'),
(363, 50, 'MATEMATIKA', 'matematikaHZ8', '#3498db', '2024-07-24 09:21:57', '2024-07-24 09:21:57'),
(364, 50, 'BAHASA SUNDA', 'bahasa-sundapEy', '#3498db', '2024-07-24 09:21:57', '2024-07-24 09:21:57'),
(365, 50, 'BAHASA INGGRIS', 'bahasa-inggrisiWP', '#3498db', '2024-07-24 09:21:57', '2024-07-24 09:21:57'),
(366, 51, 'PELAJARAN PILIHAN', 'pelajaran-pilihaneP8', '#3498db', '2024-07-24 09:27:00', '2024-07-24 09:27:00'),
(367, 51, 'DESAIN PEMODELAN DAN INFORMASI BANGUNAN', 'desain-pemodelan-dan-informasi-bangunanSU3', '#3498db', '2024-07-24 09:27:00', '2024-07-24 09:27:00'),
(368, 51, 'PKK', 'pkkGz1', '#3498db', '2024-07-24 09:27:00', '2024-07-24 09:27:00'),
(369, 51, 'PJOK', 'pjokunA', '#3498db', '2024-07-24 09:27:00', '2024-07-24 09:27:00'),
(370, 51, 'PAIBP', 'paibpnv7', '#3498db', '2024-07-24 09:27:00', '2024-07-24 09:27:00'),
(371, 51, 'SEJARAH', 'sejarahRUC', '#3498db', '2024-07-24 09:27:00', '2024-07-24 09:27:00'),
(372, 51, 'BAHASA INDONESIA', 'bahasa-indonesiavgC', '#3498db', '2024-07-24 09:27:00', '2024-07-24 09:27:00'),
(373, 51, 'PANCASILA', 'pancasilak8y', '#3498db', '2024-07-24 09:27:00', '2024-07-24 09:27:00'),
(374, 51, 'MATEMATIKA', 'matematikaPEf', '#3498db', '2024-07-24 09:27:00', '2024-07-24 09:27:00'),
(375, 51, 'BAHASA SUNDA', 'bahasa-sundatDf', '#3498db', '2024-07-24 09:27:00', '2024-07-24 09:27:00'),
(376, 51, 'BAHASA INGGRIS', 'bahasa-inggrisVak', '#3498db', '2024-07-24 09:27:00', '2024-07-24 09:27:00'),
(377, 52, 'TEKNIK KENDARAAN RINGAN', 'teknik-kendaraan-ringanVwe', '#3498db', '2024-07-24 09:30:59', '2024-07-24 09:30:59'),
(378, 52, 'PELAJARAN PILIHAN', 'pelajaran-pilihanTm2', '#3498db', '2024-07-24 09:30:59', '2024-07-24 09:30:59'),
(379, 52, 'PJOK', 'pjok3TO', '#3498db', '2024-07-24 09:30:59', '2024-07-24 09:30:59'),
(380, 52, 'PKK', 'pkktlm', '#3498db', '2024-07-24 09:30:59', '2024-07-24 09:30:59'),
(381, 52, 'PAIBP', 'paibpNns', '#3498db', '2024-07-24 09:30:59', '2024-07-24 09:30:59'),
(382, 52, 'SEJARAH', 'sejarahwfZ', '#3498db', '2024-07-24 09:30:59', '2024-07-24 09:30:59'),
(383, 52, 'BAHASA INDONESIA', 'bahasa-indonesiaXHN', '#3498db', '2024-07-24 09:30:59', '2024-07-24 09:30:59'),
(384, 52, 'PANCASILA', 'pancasilagDI', '#3498db', '2024-07-24 09:30:59', '2024-07-24 09:30:59'),
(385, 52, 'MATEMATIKA', 'matematikaPoI', '#3498db', '2024-07-24 09:30:59', '2024-07-24 09:30:59'),
(386, 52, 'BAHASA SUNDA', 'bahasa-sundahI3', '#3498db', '2024-07-24 09:30:59', '2024-07-24 09:30:59'),
(387, 52, 'BAHASA INGGRIS', 'bahasa-inggrisOXP', '#3498db', '2024-07-24 09:30:59', '2024-07-24 09:30:59'),
(388, 53, 'TEKNIK KENDARAAN RINGAN', 'teknik-kendaraan-ringanLO6', '#3498db', '2024-07-24 09:32:35', '2024-07-24 09:32:35'),
(389, 53, 'PELAJARAN PILIHAN', 'pelajaran-pilihanOJk', '#3498db', '2024-07-24 09:32:35', '2024-07-24 09:32:35'),
(390, 53, 'PJOK', 'pjokfUZ', '#3498db', '2024-07-24 09:32:35', '2024-07-24 09:32:35'),
(391, 53, 'PKK', 'pkkYao', '#3498db', '2024-07-24 09:32:35', '2024-07-24 09:32:35'),
(392, 53, 'PAIBP', 'paibpZ6G', '#3498db', '2024-07-24 09:32:35', '2024-07-24 09:32:35'),
(393, 53, 'SEJARAH', 'sejarahHhW', '#3498db', '2024-07-24 09:32:35', '2024-07-24 09:32:35'),
(394, 53, 'BAHASA INDONESIA', 'bahasa-indonesiaNTd', '#3498db', '2024-07-24 09:32:35', '2024-07-24 09:32:35'),
(395, 53, 'PANCASILA', 'pancasilasdM', '#3498db', '2024-07-24 09:32:35', '2024-07-24 09:32:35'),
(396, 53, 'MATEMATIKA', 'matematikanc8', '#3498db', '2024-07-24 09:32:35', '2024-07-24 09:32:35'),
(397, 53, 'BAHASA SUNDA', 'bahasa-sundajmQ', '#3498db', '2024-07-24 09:32:35', '2024-07-24 09:32:35'),
(398, 53, 'BAHASA INGGRIS', 'bahasa-inggrisPzU', '#3498db', '2024-07-24 09:32:35', '2024-07-24 09:32:35'),
(399, 54, 'TEKNIK KENDARAAN RINGAN', 'teknik-kendaraan-ringanDdY', '#3498db', '2024-07-24 09:34:14', '2024-07-24 09:34:14'),
(400, 54, 'PELAJARAN PILIHAN', 'pelajaran-pilihanpmA', '#3498db', '2024-07-24 09:34:14', '2024-07-24 09:34:14'),
(401, 54, 'PJOK', 'pjokBDK', '#3498db', '2024-07-24 09:34:14', '2024-07-24 09:34:14'),
(402, 54, 'PKK', 'pkkm0I', '#3498db', '2024-07-24 09:34:14', '2024-07-24 09:34:14'),
(403, 54, 'PAIBP', 'paibpT4M', '#3498db', '2024-07-24 09:34:14', '2024-07-24 09:34:14'),
(404, 54, 'SEJARAH', 'sejarahf3l', '#3498db', '2024-07-24 09:34:14', '2024-07-24 09:34:14'),
(405, 54, 'BAHASA INDONESIA', 'bahasa-indonesia5d0', '#3498db', '2024-07-24 09:34:14', '2024-07-24 09:34:14'),
(406, 54, 'PANCASILA', 'pancasilaNFU', '#3498db', '2024-07-24 09:34:14', '2024-07-24 09:34:14'),
(407, 54, 'MATEMATIKA', 'matematikaWIs', '#3498db', '2024-07-24 09:34:14', '2024-07-24 09:34:14'),
(408, 54, 'BAHASA SUNDA', 'bahasa-sundamwW', '#3498db', '2024-07-24 09:34:14', '2024-07-24 09:34:14'),
(409, 54, 'BAHASA INGGRIS', 'bahasa-inggrisaCE', '#3498db', '2024-07-24 09:34:14', '2024-07-24 09:34:14'),
(410, 55, 'REKAYASA PERANGKAT LUNAK', 'rekayasa-perangkat-lunakJie', '#3498db', '2024-07-24 09:38:09', '2024-07-24 09:38:09'),
(411, 55, 'PELAJARAN PILIHAN', 'pelajaran-pilihaneLX', '#3498db', '2024-07-24 09:38:09', '2024-07-24 09:38:09'),
(412, 55, 'PJOK', 'pjokgQ2', '#3498db', '2024-07-24 09:38:09', '2024-07-24 09:38:09'),
(413, 55, 'PKK', 'pkkrTy', '#3498db', '2024-07-24 09:38:09', '2024-07-24 09:38:09'),
(414, 55, 'PAIBP', 'paibp9lj', '#3498db', '2024-07-24 09:38:09', '2024-07-24 09:38:09'),
(415, 55, 'SEJARAH', 'sejarahNi6', '#3498db', '2024-07-24 09:38:09', '2024-07-24 09:38:09'),
(416, 55, 'BAHASA INDONESIA', 'bahasa-indonesiaSfI', '#3498db', '2024-07-24 09:38:09', '2024-07-24 09:38:09'),
(417, 55, 'PANCASILA', 'pancasilaVgd', '#3498db', '2024-07-24 09:38:09', '2024-07-24 09:38:09'),
(418, 55, 'MATEMATIKA', 'matematikabN4', '#3498db', '2024-07-24 09:38:09', '2024-07-24 09:38:09'),
(419, 55, 'BAHASA SUNDA', 'bahasa-sundakxu', '#3498db', '2024-07-24 09:38:09', '2024-07-24 09:38:09'),
(420, 55, 'BAHASA INGGRIS', 'bahasa-inggrispI2', '#3498db', '2024-07-24 09:38:09', '2024-07-24 09:38:09'),
(432, 57, 'REKAYASA PERANGKAT LUNAK', 'rekayasa-perangkat-lunakyyr', '#3498db', '2024-07-24 09:41:56', '2024-07-24 09:41:56'),
(433, 57, 'PELAJARAN PILIHAN', 'pelajaran-pilihanGGn', '#3498db', '2024-07-24 09:41:56', '2024-07-24 09:41:56'),
(434, 57, 'PJOK', 'pjok0aI', '#3498db', '2024-07-24 09:41:56', '2024-07-24 09:41:56'),
(435, 57, 'PKK', 'pkkm96', '#3498db', '2024-07-24 09:41:56', '2024-07-24 09:41:56'),
(436, 57, 'PAIBP', 'paibpBxB', '#3498db', '2024-07-24 09:41:56', '2024-07-24 09:41:56'),
(437, 57, 'SEJARAH', 'sejarahaS4', '#3498db', '2024-07-24 09:41:56', '2024-07-24 09:41:56'),
(438, 57, 'BAHASA INDONESIA', 'bahasa-indonesiaGFs', '#3498db', '2024-07-24 09:41:56', '2024-07-24 09:41:56'),
(439, 57, 'PANCASILA', 'pancasila1v2', '#3498db', '2024-07-24 09:41:56', '2024-07-24 09:41:56'),
(440, 57, 'MATEMATIKA', 'matematikaAAk', '#3498db', '2024-07-24 09:41:56', '2024-07-24 09:41:56'),
(441, 57, 'BAHASA SUNDA', 'bahasa-sundarHI', '#3498db', '2024-07-24 09:41:56', '2024-07-24 09:41:56'),
(442, 57, 'BAHASA INGGRIS', 'bahasa-inggrisLIw', '#3498db', '2024-07-24 09:41:56', '2024-07-24 09:41:56'),
(443, 58, 'TEKNIK KOMPUTER DAN JARINGAN', 'teknik-komputer-dan-jaringanvP2', '#3498db', '2024-07-24 09:43:40', '2024-07-24 09:43:40'),
(444, 58, 'PELAJARAN PILIHAN', 'pelajaran-pilihanXNc', '#3498db', '2024-07-24 09:43:40', '2024-07-24 09:43:40'),
(445, 58, 'PJOK', 'pjokRZ9', '#3498db', '2024-07-24 09:43:40', '2024-07-24 09:43:40'),
(446, 58, 'PKK', 'pkka8w', '#3498db', '2024-07-24 09:43:40', '2024-07-24 09:43:40'),
(447, 58, 'PAIBP', 'paibpA1A', '#3498db', '2024-07-24 09:43:40', '2024-07-24 09:43:40'),
(448, 58, 'SEJARAH', 'sejarahvrX', '#3498db', '2024-07-24 09:43:40', '2024-07-24 09:43:40'),
(449, 58, 'BAHASA INDONESIA', 'bahasa-indonesialoA', '#3498db', '2024-07-24 09:43:40', '2024-07-24 09:43:40'),
(450, 58, 'PANCASILA', 'pancasilaruh', '#3498db', '2024-07-24 09:43:40', '2024-07-24 09:43:40'),
(451, 58, 'MATEMATIKA', 'matematikaNFc', '#3498db', '2024-07-24 09:43:40', '2024-07-24 09:43:40'),
(452, 58, 'BAHASA SUNDA', 'bahasa-sundaAnU', '#3498db', '2024-07-24 09:43:40', '2024-07-24 09:43:40'),
(453, 58, 'BAHASA INGGRIS', 'bahasa-inggris9Cu', '#3498db', '2024-07-24 09:43:40', '2024-07-24 09:43:40'),
(454, 59, 'TEKNIK KOMPUTER DAN JARINGAN', 'teknik-komputer-dan-jaringanT04', '#3498db', '2024-07-24 09:44:57', '2024-07-24 09:44:57'),
(455, 59, 'PELAJARAN PILIHAN', 'pelajaran-pilihanSGj', '#3498db', '2024-07-24 09:44:57', '2024-07-24 09:44:57'),
(456, 59, 'PJOK', 'pjokXzY', '#3498db', '2024-07-24 09:44:57', '2024-07-24 09:44:57'),
(457, 59, 'PKK', 'pkk3Xf', '#3498db', '2024-07-24 09:44:57', '2024-07-24 09:44:57'),
(458, 59, 'PAIBP', 'paibpO0t', '#3498db', '2024-07-24 09:44:57', '2024-07-24 09:44:57'),
(459, 59, 'SEJARAH', 'sejarahCzT', '#3498db', '2024-07-24 09:44:57', '2024-07-24 09:44:57'),
(460, 59, 'BAHASA INDONESIA', 'bahasa-indonesia3nN', '#3498db', '2024-07-24 09:44:57', '2024-07-24 09:44:57'),
(461, 59, 'PANCASILA', 'pancasilaZl0', '#3498db', '2024-07-24 09:44:57', '2024-07-24 09:44:57'),
(462, 59, 'MATEMATIKA', 'matematikaB5U', '#3498db', '2024-07-24 09:44:57', '2024-07-24 09:44:57'),
(463, 59, 'BAHASA SUNDA', 'bahasa-sundaaa3', '#3498db', '2024-07-24 09:44:57', '2024-07-24 09:44:57'),
(464, 59, 'BAHASA INGGRIS', 'bahasa-inggrispqO', '#3498db', '2024-07-24 09:44:57', '2024-07-24 09:44:57'),
(465, 60, 'TEKNIK KOMPUTER DAN JARINGAN', 'teknik-komputer-dan-jaringanH7y', '#3498db', '2024-07-24 09:46:24', '2024-07-24 09:46:24'),
(466, 60, 'PELAJARAN PILIHAN', 'pelajaran-pilihanrwt', '#3498db', '2024-07-24 09:46:24', '2024-07-24 09:46:24'),
(467, 60, 'PJOK', 'pjok0vD', '#3498db', '2024-07-24 09:46:24', '2024-07-24 09:46:24'),
(468, 60, 'PKK', 'pkkMHG', '#3498db', '2024-07-24 09:46:24', '2024-07-24 09:46:24'),
(469, 60, 'PAIBP', 'paibpxDU', '#3498db', '2024-07-24 09:46:24', '2024-07-24 09:46:24'),
(470, 60, 'SEJARAH', 'sejarahW8q', '#3498db', '2024-07-24 09:46:24', '2024-07-24 09:46:24'),
(471, 60, 'BAHASA INDONESIA', 'bahasa-indonesiabB2', '#3498db', '2024-07-24 09:46:24', '2024-07-24 09:46:24'),
(472, 60, 'PANCASILA', 'pancasilanlr', '#3498db', '2024-07-24 09:46:24', '2024-07-24 09:46:24'),
(473, 60, 'MATEMATIKA', 'matematikaCeE', '#3498db', '2024-07-24 09:46:24', '2024-07-24 09:46:24'),
(474, 60, 'BAHASA SUNDA', 'bahasa-sundaj6P', '#3498db', '2024-07-24 09:46:24', '2024-07-24 09:46:24'),
(475, 60, 'BAHASA INGGRIS', 'bahasa-inggriskSd', '#3498db', '2024-07-24 09:46:24', '2024-07-24 09:46:24'),
(476, 61, 'MANAJEMEN PERKANTORAN', 'manajemen-perkantoranIcw', '#3498db', '2024-07-24 09:48:23', '2024-07-24 09:48:23'),
(477, 61, 'PELAJARAN PILIHAN', 'pelajaran-pilihanHXU', '#3498db', '2024-07-24 09:48:23', '2024-07-24 09:48:23'),
(478, 61, 'PJOK', 'pjokcjv', '#3498db', '2024-07-24 09:48:23', '2024-07-24 09:48:23'),
(479, 61, 'PKK', 'pkkqn1', '#3498db', '2024-07-24 09:48:23', '2024-07-24 09:48:23'),
(480, 61, 'PAIBP', 'paibpan1', '#3498db', '2024-07-24 09:48:23', '2024-07-24 09:48:23'),
(481, 61, 'SEJARAH', 'sejarahsmZ', '#3498db', '2024-07-24 09:48:23', '2024-07-24 09:48:23'),
(482, 61, 'BAHASA INDONESIA', 'bahasa-indonesianvH', '#3498db', '2024-07-24 09:48:23', '2024-07-24 09:48:23'),
(483, 61, 'PANCASILA', 'pancasilal3m', '#3498db', '2024-07-24 09:48:23', '2024-07-24 09:48:23'),
(484, 61, 'MATEMATIKA', 'matematikaATm', '#3498db', '2024-07-24 09:48:23', '2024-07-24 09:48:23'),
(485, 61, 'BAHASA SUNDA', 'bahasa-sundau1E', '#3498db', '2024-07-24 09:48:23', '2024-07-24 09:48:23'),
(486, 61, 'BAHASA INGGRIS', 'bahasa-inggrisH36', '#3498db', '2024-07-24 09:48:23', '2024-07-24 09:48:23'),
(487, 62, 'MANAJEMEN PERKANTORAN', 'manajemen-perkantoranXXr', '#3498db', '2024-07-24 09:49:48', '2024-07-24 09:49:48'),
(488, 62, 'PELAJARAN PILIHAN', 'pelajaran-pilihanuGy', '#3498db', '2024-07-24 09:49:48', '2024-07-24 09:49:48'),
(489, 62, 'PJOK', 'pjokgpA', '#3498db', '2024-07-24 09:49:48', '2024-07-24 09:49:48'),
(490, 62, 'PKK', 'pkkv65', '#3498db', '2024-07-24 09:49:48', '2024-07-24 09:49:48'),
(491, 62, 'PAIBP', 'paibpqXW', '#3498db', '2024-07-24 09:49:48', '2024-07-24 09:49:48'),
(492, 62, 'SEJARAH', 'sejarah8We', '#3498db', '2024-07-24 09:49:48', '2024-07-24 09:49:48'),
(493, 62, 'BAHASA INDONESIA', 'bahasa-indonesiaOAI', '#3498db', '2024-07-24 09:49:48', '2024-07-24 09:49:48'),
(494, 62, 'PANCASILA', 'pancasilaW8K', '#3498db', '2024-07-24 09:49:48', '2024-07-24 09:49:48'),
(495, 62, 'MATEMATIKA', 'matematikaFog', '#3498db', '2024-07-24 09:49:48', '2024-07-24 09:49:48'),
(496, 62, 'BAHASA SUNDA', 'bahasa-sundaa5M', '#3498db', '2024-07-24 09:49:48', '2024-07-24 09:49:48'),
(497, 62, 'BAHASA INGGRIS', 'bahasa-inggris5Vd', '#3498db', '2024-07-24 09:49:48', '2024-07-24 09:49:48'),
(498, 63, 'AKUNTANSI', 'akuntansiDvd', '#3498db', '2024-07-24 09:51:44', '2024-07-24 09:51:44'),
(499, 63, 'PELAJARAN PILIHAN', 'pelajaran-pilihan4Cf', '#3498db', '2024-07-24 09:51:44', '2024-07-24 09:51:44'),
(500, 63, 'PJOK', 'pjokSOz', '#3498db', '2024-07-24 09:51:44', '2024-07-24 09:51:44'),
(501, 63, 'PKK', 'pkkIZN', '#3498db', '2024-07-24 09:51:44', '2024-07-24 09:51:44'),
(502, 63, 'PAIBP', 'paibpvSO', '#3498db', '2024-07-24 09:51:44', '2024-07-24 09:51:44'),
(503, 63, 'SEJARAH', 'sejarahzYs', '#3498db', '2024-07-24 09:51:44', '2024-07-24 09:51:44'),
(504, 63, 'BAHASA INDONESIA', 'bahasa-indonesia2QG', '#3498db', '2024-07-24 09:51:44', '2024-07-24 09:51:44'),
(505, 63, 'PANCASILA', 'pancasilalNX', '#3498db', '2024-07-24 09:51:44', '2024-07-24 09:51:44'),
(506, 63, 'MATEMATIKA', 'matematikaUB7', '#3498db', '2024-07-24 09:51:44', '2024-07-24 09:51:44'),
(507, 63, 'BAHASA SUNDA', 'bahasa-sundagF3', '#3498db', '2024-07-24 09:51:44', '2024-07-24 09:51:44'),
(508, 63, 'BAHASA INGGRIS', 'bahasa-inggrissAb', '#3498db', '2024-07-24 09:51:44', '2024-07-24 09:51:44'),
(509, 64, 'AKUNTANSI', 'akuntansi5Gf', '#3498db', '2024-07-24 09:53:36', '2024-07-24 09:53:36'),
(510, 64, 'PELAJARAN PILIHAN', 'pelajaran-pilihanLbu', '#3498db', '2024-07-24 09:53:36', '2024-07-24 09:53:36'),
(511, 64, 'PJOK', 'pjokm3l', '#3498db', '2024-07-24 09:53:36', '2024-07-24 09:53:36'),
(512, 64, 'PKK', 'pkkVBR', '#3498db', '2024-07-24 09:53:36', '2024-07-24 09:53:36'),
(513, 64, 'PAIBP', 'paibp88A', '#3498db', '2024-07-24 09:53:36', '2024-07-24 09:53:36'),
(514, 64, 'SEJARAH', 'sejarahLe0', '#3498db', '2024-07-24 09:53:36', '2024-07-24 09:53:36'),
(515, 64, 'BAHASA INDONESIA', 'bahasa-indonesiaGFe', '#3498db', '2024-07-24 09:53:36', '2024-07-24 09:53:36'),
(516, 64, 'PANCASILA', 'pancasilaxJn', '#3498db', '2024-07-24 09:53:36', '2024-07-24 09:53:36'),
(517, 64, 'MATEMATIKA', 'matematikaR4t', '#3498db', '2024-07-24 09:53:36', '2024-07-24 09:53:36'),
(518, 64, 'BAHASA SUNDA', 'bahasa-sundaGVx', '#3498db', '2024-07-24 09:53:36', '2024-07-24 09:53:36'),
(519, 64, 'BAHASA INGGRIS', 'bahasa-inggrisTsa', '#3498db', '2024-07-24 09:53:36', '2024-07-24 09:53:36'),
(530, 65, 'SENI KARAWITAN', 'seni-karawitanoOk', '#3498db', '2024-07-24 09:55:13', '2024-07-24 09:55:13'),
(531, 65, 'PELAJARAN PILIHAN', 'pelajaran-pilihaneZd', '#3498db', '2024-07-24 09:55:13', '2024-07-24 09:55:13'),
(532, 65, 'PJOK', 'pjokBNU', '#3498db', '2024-07-24 09:55:13', '2024-07-24 09:55:13'),
(533, 65, 'PKK', 'pkkv8F', '#3498db', '2024-07-24 09:55:13', '2024-07-24 09:55:13'),
(534, 65, 'PAIBP', 'paibpgmp', '#3498db', '2024-07-24 09:55:13', '2024-07-24 09:55:13'),
(535, 65, 'SEJARAH', 'sejarahCf8', '#3498db', '2024-07-24 09:55:13', '2024-07-24 09:55:13'),
(536, 65, 'BAHASA INDONESIA', 'bahasa-indonesia0Ae', '#3498db', '2024-07-24 09:55:13', '2024-07-24 09:55:13'),
(537, 65, 'PANCASILA', 'pancasila6li', '#3498db', '2024-07-24 09:55:13', '2024-07-24 09:55:13'),
(538, 65, 'MATEMATIKA', 'matematikaMku', '#3498db', '2024-07-24 09:55:13', '2024-07-24 09:55:13'),
(539, 65, 'BAHASA SUNDA', 'bahasa-sundaF19', '#3498db', '2024-07-24 09:55:13', '2024-07-24 09:55:13'),
(540, 65, 'BAHASA INGGRIS', 'bahasa-inggrisqHb', '#3498db', '2024-07-24 09:55:13', '2024-07-24 09:55:13'),
(541, 56, 'PELAJARAN PILIHAN', 'pelajaran-pilihan2Ez', '#3498db', '2024-07-25 01:43:06', '2024-07-25 01:43:06'),
(542, 56, 'PJOK', 'pjokETx', '#3498db', '2024-07-25 01:43:06', '2024-07-25 01:43:06'),
(543, 56, 'PKK', 'pkkFLD', '#3498db', '2024-07-25 01:43:06', '2024-07-25 01:43:06'),
(544, 56, 'PAIBP', 'paibpxbf', '#3498db', '2024-07-25 01:43:06', '2024-07-25 01:43:06'),
(545, 56, 'SEJARAH', 'sejarahNFK', '#3498db', '2024-07-25 01:43:06', '2024-07-25 01:43:06'),
(546, 56, 'BAHASA INDONESIA', 'bahasa-indonesiafJX', '#3498db', '2024-07-25 01:43:07', '2024-07-25 01:43:07'),
(547, 56, 'PANCASILA', 'pancasila65X', '#3498db', '2024-07-25 01:43:07', '2024-07-25 01:43:07'),
(548, 56, 'MATEMATIKA', 'matematikaPCJ', '#3498db', '2024-07-25 01:43:07', '2024-07-25 01:43:07'),
(549, 56, 'BAHASA SUNDA', 'bahasa-sundanE1', '#3498db', '2024-07-25 01:43:07', '2024-07-25 01:43:07'),
(550, 56, 'BAHASA INGGRIS', 'bahasa-inggrisybE', '#3498db', '2024-07-25 01:43:07', '2024-07-25 01:43:07'),
(551, 56, 'REKAYASA PERANGKAT LUNAK', 'rekayasa-perangkat-lunakBpR', '#3498db', '2024-07-25 01:43:07', '2024-07-25 01:43:07'),
(552, 44, 'PJOK', 'pjokJ0H', '#3498db', '2024-07-25 04:00:37', '2024-07-25 04:00:37'),
(553, 44, 'PAIBP', 'paibpQIz', '#3498db', '2024-07-25 04:00:37', '2024-07-25 04:00:37'),
(554, 44, 'BAHASA INDONESIA', 'bahasa-indonesiaAQc', '#3498db', '2024-07-25 04:00:37', '2024-07-25 04:00:37'),
(555, 44, 'BAHASA SUNDA', 'bahasa-sundaCP9', '#3498db', '2024-07-25 04:00:37', '2024-07-25 04:00:37'),
(556, 44, 'PANCASILA', 'pancasilanx6', '#3498db', '2024-07-25 04:00:37', '2024-07-25 04:00:37'),
(557, 44, 'PIPAS', 'pipasGph', '#3498db', '2024-07-25 04:00:37', '2024-07-25 04:00:37'),
(558, 44, 'BK', 'bkCwN', '#3498db', '2024-07-25 04:00:37', '2024-07-25 04:00:37'),
(559, 44, 'SENI BUDAYA', 'seni-budayaw02', '#3498db', '2024-07-25 04:00:37', '2024-07-25 04:00:37'),
(560, 44, 'MATEMATIKA', 'matematikavqS', '#3498db', '2024-07-25 04:00:38', '2024-07-25 04:00:38'),
(561, 44, 'DASAR-DASAR MPLB', 'dasar-dasar-mplb73b', '#3498db', '2024-07-25 04:00:38', '2024-07-25 04:00:38'),
(562, 44, 'BAHASA INGGRIS', 'bahasa-inggrisbNF', '#3498db', '2024-07-25 04:00:38', '2024-07-25 04:00:38'),
(563, 44, 'INFORMATIKA', 'informatika1bQ', '#3498db', '2024-07-25 04:00:38', '2024-07-25 04:00:38'),
(564, 44, 'SEJARAH', 'sejarahND1', '#3498db', '2024-07-25 04:00:38', '2024-07-25 04:00:38'),
(577, 35, 'DASAR DASAR PPLG', 'dasar-dasar-pplglX9', '#3498db', '2024-07-25 08:15:01', '2024-07-25 08:15:01'),
(578, 35, 'INFORMATIKA', 'informatikaEbW', '#3498db', '2024-07-25 08:15:01', '2024-07-25 08:15:01'),
(579, 35, 'BAHASA INGGRIS', 'bahasa-inggrisp5t', '#3498db', '2024-07-25 08:15:01', '2024-07-25 08:15:01'),
(580, 35, 'BK', 'bkCbA', '#3498db', '2024-07-25 08:15:01', '2024-07-25 08:15:01'),
(581, 35, 'SEJARAH', 'sejarahQQ2', '#3498db', '2024-07-25 08:15:01', '2024-07-25 08:15:01'),
(582, 35, 'BAHASA INDONESIA', 'bahasa-indonesiaVeV', '#3498db', '2024-07-25 08:15:01', '2024-07-25 08:15:01'),
(583, 35, 'PAIBP', 'paibpz91', '#3498db', '2024-07-25 08:15:01', '2024-07-25 08:15:01'),
(584, 35, 'PJOK', 'pjokSC2', '#3498db', '2024-07-25 08:15:01', '2024-07-25 08:15:01'),
(585, 35, 'SENI BUDAYA', 'seni-budayaISN', '#3498db', '2024-07-25 08:15:01', '2024-07-25 08:15:01'),
(586, 35, 'PANCASILA', 'pancasilaIEw', '#3498db', '2024-07-25 08:15:01', '2024-07-25 08:15:01'),
(587, 35, 'BAHASA SUNDA', 'bahasa-sundaOY4', '#3498db', '2024-07-25 08:15:01', '2024-07-25 08:15:01'),
(588, 35, 'PIPAS', 'pipasKn9', '#3498db', '2024-07-25 08:15:01', '2024-07-25 08:15:01'),
(589, 35, 'MATEMATIKA', 'matematika8XY', '#3498db', '2024-07-25 08:15:01', '2024-07-25 08:15:01'),
(590, 42, 'MATEMATIKA', 'matematika1Y8', '#3498db', '2024-07-25 08:31:47', '2024-07-25 08:31:47'),
(591, 42, 'DASAR DASAR DPIB', 'dasar-dasar-dpibWyQ', '#3498db', '2024-07-25 08:31:47', '2024-07-25 08:31:47'),
(592, 42, 'BK', 'bkEDr', '#3498db', '2024-07-25 08:31:47', '2024-07-25 08:31:47'),
(593, 42, 'INFORMATIKA', 'informatikaqkz', '#3498db', '2024-07-25 08:31:47', '2024-07-25 08:31:47'),
(594, 42, 'PJOK', 'pjokNoJ', '#3498db', '2024-07-25 08:31:47', '2024-07-25 08:31:47'),
(595, 42, 'BAHASA SUNDA', 'bahasa-sundaqpt', '#3498db', '2024-07-25 08:31:47', '2024-07-25 08:31:47'),
(596, 42, 'SENI BUDAYA', 'seni-budayaeZV', '#3498db', '2024-07-25 08:31:47', '2024-07-25 08:31:47'),
(597, 42, 'PAIBP', 'paibpfjp', '#3498db', '2024-07-25 08:31:47', '2024-07-25 08:31:47'),
(598, 42, 'PIPAS', 'pipas174', '#3498db', '2024-07-25 08:31:47', '2024-07-25 08:31:47'),
(599, 42, 'PANCASILA', 'pancasilahjq', '#3498db', '2024-07-25 08:31:47', '2024-07-25 08:31:47'),
(600, 42, 'SEJARAH', 'sejarah8wU', '#3498db', '2024-07-25 08:31:47', '2024-07-25 08:31:47'),
(601, 42, 'BAHASA INDONESIA', 'bahasa-indonesiaaf7', '#3498db', '2024-07-25 08:31:47', '2024-07-25 08:31:47'),
(602, 42, 'BAHASA INGGRIS', 'bahasa-inggrisgaz', '#3498db', '2024-07-25 08:31:47', '2024-07-25 08:31:47');

-- --------------------------------------------------------

--
-- Table structure for table `submitted_assignments`
--

CREATE TABLE `submitted_assignments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `assignment_id` bigint(20) UNSIGNED NOT NULL,
  `assignment` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `gained_mark` int(11) NOT NULL DEFAULT 0,
  `completed` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `syllabi`
--

CREATE TABLE `syllabi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `syllabus` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teacher_ratings`
--

CREATE TABLE `teacher_ratings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `attendance_id` bigint(20) UNSIGNED NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teacher_subjects`
--

CREATE TABLE `teacher_subjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teacher_subjects`
--

INSERT INTO `teacher_subjects` (`id`, `teacher_id`, `subject_id`, `created_at`, `updated_at`) VALUES
(236, 1204, 410, '2024-07-25 02:23:29', '2024-07-25 02:23:29'),
(237, 1204, 551, '2024-07-25 02:23:29', '2024-07-25 02:23:29'),
(238, 1204, 432, '2024-07-25 02:23:29', '2024-07-25 02:23:29'),
(296, 1203, 242, '2024-07-25 02:42:10', '2024-07-25 02:42:10'),
(297, 1203, 274, '2024-07-25 02:42:10', '2024-07-25 02:42:10'),
(298, 1203, 482, '2024-07-25 02:42:10', '2024-07-25 02:42:10'),
(299, 1203, 493, '2024-07-25 02:42:10', '2024-07-25 02:42:10'),
(300, 1202, 247, '2024-07-25 02:42:35', '2024-07-25 02:42:35'),
(301, 1202, 275, '2024-07-25 02:42:35', '2024-07-25 02:42:35'),
(302, 1202, 271, '2024-07-25 02:42:35', '2024-07-25 02:42:35'),
(303, 1201, 71, '2024-07-25 02:42:59', '2024-07-25 02:42:59'),
(305, 1201, 164, '2024-07-25 02:42:59', '2024-07-25 02:42:59'),
(306, 1201, 316, '2024-07-25 02:42:59', '2024-07-25 02:42:59'),
(308, 1200, 358, '2024-07-25 02:44:20', '2024-07-25 02:44:20'),
(309, 1198, 498, '2024-07-25 02:46:53', '2024-07-25 02:46:53'),
(310, 1198, 509, '2024-07-25 02:46:53', '2024-07-25 02:46:53'),
(311, 1197, 389, '2024-07-25 02:47:56', '2024-07-25 02:47:56'),
(312, 1197, 377, '2024-07-25 02:47:56', '2024-07-25 02:47:56'),
(313, 1197, 399, '2024-07-25 02:47:56', '2024-07-25 02:47:56'),
(314, 1197, 388, '2024-07-25 02:47:56', '2024-07-25 02:47:56'),
(315, 1197, 378, '2024-07-25 02:47:56', '2024-07-25 02:47:56'),
(316, 1196, 476, '2024-07-25 02:48:38', '2024-07-25 02:48:38'),
(317, 1196, 487, '2024-07-25 02:48:38', '2024-07-25 02:48:38'),
(318, 1195, 388, '2024-07-25 02:50:43', '2024-07-25 02:50:43'),
(319, 1195, 399, '2024-07-25 02:50:43', '2024-07-25 02:50:43'),
(320, 1195, 377, '2024-07-25 02:50:43', '2024-07-25 02:50:43'),
(321, 1195, 106, '2024-07-25 02:50:43', '2024-07-25 02:50:43'),
(332, 1194, 512, '2024-07-25 02:55:44', '2024-07-25 02:55:44'),
(333, 1194, 501, '2024-07-25 02:55:44', '2024-07-25 02:55:44'),
(334, 1193, 530, '2024-07-25 02:56:39', '2024-07-25 02:56:39'),
(340, 1192, 473, '2024-07-25 02:58:25', '2024-07-25 02:58:25'),
(341, 1192, 451, '2024-07-25 02:58:25', '2024-07-25 02:58:25'),
(342, 1192, 495, '2024-07-25 02:58:25', '2024-07-25 02:58:25'),
(343, 1192, 484, '2024-07-25 02:58:25', '2024-07-25 02:58:25'),
(344, 1192, 462, '2024-07-25 02:58:25', '2024-07-25 02:58:25'),
(345, 1191, 367, '2024-07-25 02:59:10', '2024-07-25 02:59:10'),
(347, 1191, 68, '2024-07-25 02:59:10', '2024-07-25 02:59:10'),
(348, 1191, 356, '2024-07-25 02:59:10', '2024-07-25 02:59:10'),
(349, 1190, 498, '2024-07-25 03:00:03', '2024-07-25 03:00:03'),
(350, 1190, 262, '2024-07-25 03:00:03', '2024-07-25 03:00:03'),
(351, 1190, 282, '2024-07-25 03:00:03', '2024-07-25 03:00:03'),
(352, 1190, 509, '2024-07-25 03:00:03', '2024-07-25 03:00:03'),
(353, 1189, 367, '2024-07-25 03:02:02', '2024-07-25 03:02:02'),
(355, 1189, 356, '2024-07-25 03:02:02', '2024-07-25 03:02:02'),
(356, 1189, 68, '2024-07-25 03:02:02', '2024-07-25 03:02:02'),
(358, 1188, 368, '2024-07-25 03:02:44', '2024-07-25 03:02:44'),
(359, 1188, 68, '2024-07-25 03:02:44', '2024-07-25 03:02:44'),
(363, 1187, 270, '2024-07-25 03:04:13', '2024-07-25 03:04:13'),
(364, 1187, 510, '2024-07-25 03:04:13', '2024-07-25 03:04:13'),
(365, 1187, 286, '2024-07-25 03:04:13', '2024-07-25 03:04:13'),
(366, 1186, 366, '2024-07-25 03:04:48', '2024-07-25 03:04:48'),
(368, 1186, 355, '2024-07-25 03:04:48', '2024-07-25 03:04:48'),
(369, 1186, 70, '2024-07-25 03:04:48', '2024-07-25 03:04:48'),
(370, 1185, 400, '2024-07-25 03:05:41', '2024-07-25 03:05:41'),
(371, 1184, 318, '2024-07-25 03:06:22', '2024-07-25 03:06:22'),
(372, 1184, 434, '2024-07-25 03:06:22', '2024-07-25 03:06:22'),
(374, 1184, 369, '2024-07-25 03:06:22', '2024-07-25 03:06:22'),
(375, 1184, 79, '2024-07-25 03:06:22', '2024-07-25 03:06:22'),
(376, 1184, 456, '2024-07-25 03:06:22', '2024-07-25 03:06:22'),
(378, 1184, 445, '2024-07-25 03:06:22', '2024-07-25 03:06:22'),
(379, 1184, 160, '2024-07-25 03:06:22', '2024-07-25 03:06:22'),
(380, 1184, 467, '2024-07-25 03:06:22', '2024-07-25 03:06:22'),
(381, 1184, 357, '2024-07-25 03:06:22', '2024-07-25 03:06:22'),
(382, 1183, 314, '2024-07-25 03:07:38', '2024-07-25 03:07:38'),
(383, 1182, 420, '2024-07-25 03:08:25', '2024-07-25 03:08:25'),
(384, 1182, 442, '2024-07-25 03:08:25', '2024-07-25 03:08:25'),
(385, 415, 319, '2024-07-25 03:09:13', '2024-07-25 03:09:13'),
(386, 415, 158, '2024-07-25 03:09:13', '2024-07-25 03:09:13'),
(389, 415, 74, '2024-07-25 03:09:13', '2024-07-25 03:09:13'),
(391, 415, 246, '2024-07-25 03:09:13', '2024-07-25 03:09:13'),
(392, 415, 276, '2024-07-25 03:09:13', '2024-07-25 03:09:13'),
(393, 415, 265, '2024-07-25 03:09:13', '2024-07-25 03:09:13'),
(394, 415, 419, '2024-07-25 03:09:13', '2024-07-25 03:09:13'),
(395, 415, 441, '2024-07-25 03:09:13', '2024-07-25 03:09:13'),
(396, 415, 485, '2024-07-25 03:09:13', '2024-07-25 03:09:13'),
(397, 415, 496, '2024-07-25 03:09:13', '2024-07-25 03:09:13'),
(398, 415, 518, '2024-07-25 03:09:13', '2024-07-25 03:09:13'),
(399, 415, 507, '2024-07-25 03:09:13', '2024-07-25 03:09:13'),
(400, 378, 113, '2024-07-25 03:09:48', '2024-07-25 03:09:48'),
(401, 378, 125, '2024-07-25 03:09:48', '2024-07-25 03:09:48'),
(402, 378, 138, '2024-07-25 03:09:48', '2024-07-25 03:09:48'),
(403, 378, 295, '2024-07-25 03:09:48', '2024-07-25 03:09:48'),
(404, 378, 312, '2024-07-25 03:09:48', '2024-07-25 03:09:48'),
(405, 377, 326, '2024-07-25 03:10:33', '2024-07-25 03:10:33'),
(406, 377, 197, '2024-07-25 03:10:33', '2024-07-25 03:10:33'),
(407, 377, 212, '2024-07-25 03:10:33', '2024-07-25 03:10:33'),
(408, 376, 330, '2024-07-25 03:11:13', '2024-07-25 03:11:13'),
(409, 375, 196, '2024-07-25 03:11:52', '2024-07-25 03:11:52'),
(410, 374, 115, '2024-07-25 03:12:29', '2024-07-25 03:12:29'),
(411, 374, 129, '2024-07-25 03:12:29', '2024-07-25 03:12:29'),
(412, 374, 136, '2024-07-25 03:12:29', '2024-07-25 03:12:29'),
(413, 374, 337, '2024-07-25 03:12:29', '2024-07-25 03:12:29'),
(414, 374, 204, '2024-07-25 03:12:29', '2024-07-25 03:12:29'),
(415, 374, 219, '2024-07-25 03:12:29', '2024-07-25 03:12:29'),
(416, 374, 290, '2024-07-25 03:12:29', '2024-07-25 03:12:29'),
(417, 374, 301, '2024-07-25 03:12:29', '2024-07-25 03:12:29'),
(418, 373, 283, '2024-07-25 03:12:58', '2024-07-25 03:12:58'),
(419, 373, 263, '2024-07-25 03:12:58', '2024-07-25 03:12:58'),
(420, 372, 323, '2024-07-25 03:14:39', '2024-07-25 03:14:39'),
(421, 372, 162, '2024-07-25 03:14:39', '2024-07-25 03:14:39'),
(423, 372, 414, '2024-07-25 03:14:39', '2024-07-25 03:14:39'),
(424, 372, 436, '2024-07-25 03:14:39', '2024-07-25 03:14:39'),
(425, 371, 385, '2024-07-25 03:15:35', '2024-07-25 03:15:35'),
(426, 371, 396, '2024-07-25 03:15:35', '2024-07-25 03:15:35'),
(427, 371, 407, '2024-07-25 03:15:35', '2024-07-25 03:15:35'),
(428, 371, 374, '2024-07-25 03:15:35', '2024-07-25 03:15:35'),
(429, 371, 363, '2024-07-25 03:15:35', '2024-07-25 03:15:35'),
(430, 371, 67, '2024-07-25 03:15:35', '2024-07-25 03:15:35'),
(431, 370, 325, '2024-07-25 03:17:06', '2024-07-25 03:17:06'),
(433, 370, 157, '2024-07-25 03:17:06', '2024-07-25 03:17:06'),
(435, 370, 72, '2024-07-25 03:17:06', '2024-07-25 03:17:06'),
(436, 369, 261, '2024-07-25 03:19:32', '2024-07-25 03:19:32'),
(437, 369, 310, '2024-07-25 03:19:32', '2024-07-25 03:19:32'),
(438, 369, 284, '2024-07-25 03:19:32', '2024-07-25 03:19:32'),
(439, 369, 506, '2024-07-25 03:19:32', '2024-07-25 03:19:32'),
(440, 369, 517, '2024-07-25 03:19:32', '2024-07-25 03:19:32'),
(441, 332, 161, '2024-07-25 03:20:10', '2024-07-25 03:20:10'),
(442, 332, 217, '2024-07-25 03:20:10', '2024-07-25 03:20:10'),
(443, 332, 338, '2024-07-25 03:20:10', '2024-07-25 03:20:10'),
(444, 332, 202, '2024-07-25 03:20:10', '2024-07-25 03:20:10'),
(445, 332, 322, '2024-07-25 03:20:10', '2024-07-25 03:20:10'),
(447, 332, 417, '2024-07-25 03:20:10', '2024-07-25 03:20:10'),
(448, 332, 439, '2024-07-25 03:20:10', '2024-07-25 03:20:10'),
(449, 332, 450, '2024-07-25 03:20:10', '2024-07-25 03:20:10'),
(450, 332, 461, '2024-07-25 03:20:10', '2024-07-25 03:20:10'),
(451, 332, 472, '2024-07-25 03:20:10', '2024-07-25 03:20:10'),
(453, 331, 280, '2024-07-25 03:20:44', '2024-07-25 03:20:44'),
(454, 331, 288, '2024-07-25 03:20:44', '2024-07-25 03:20:44'),
(455, 331, 240, '2024-07-25 03:20:44', '2024-07-25 03:20:44'),
(456, 331, 266, '2024-07-25 03:20:44', '2024-07-25 03:20:44'),
(457, 331, 302, '2024-07-25 03:20:44', '2024-07-25 03:20:44'),
(458, 331, 532, '2024-07-25 03:20:44', '2024-07-25 03:20:44'),
(459, 331, 478, '2024-07-25 03:20:44', '2024-07-25 03:20:44'),
(460, 331, 489, '2024-07-25 03:20:44', '2024-07-25 03:20:44'),
(461, 294, 109, '2024-07-25 03:21:19', '2024-07-25 03:21:19'),
(462, 294, 200, '2024-07-25 03:21:19', '2024-07-25 03:21:19'),
(463, 294, 139, '2024-07-25 03:21:19', '2024-07-25 03:21:19'),
(464, 294, 213, '2024-07-25 03:21:19', '2024-07-25 03:21:19'),
(465, 294, 127, '2024-07-25 03:21:19', '2024-07-25 03:21:19'),
(466, 1409, 209, '2024-07-25 03:28:09', '2024-07-25 03:28:09'),
(468, 1410, 236, '2024-07-25 03:30:38', '2024-07-25 03:30:38'),
(469, 1410, 310, '2024-07-25 03:30:38', '2024-07-25 03:30:38'),
(470, 1199, 321, '2024-07-25 03:31:31', '2024-07-25 03:31:31'),
(471, 1199, 405, '2024-07-25 03:31:31', '2024-07-25 03:31:31'),
(472, 1199, 163, '2024-07-25 03:31:31', '2024-07-25 03:31:31'),
(473, 1199, 416, '2024-07-25 03:31:31', '2024-07-25 03:31:31'),
(474, 1411, 106, '2024-07-25 03:55:55', '2024-07-25 03:55:55'),
(475, 1411, 119, '2024-07-25 03:55:55', '2024-07-25 03:55:55'),
(476, 1411, 141, '2024-07-25 03:55:55', '2024-07-25 03:55:55'),
(477, 1411, 377, '2024-07-25 03:55:55', '2024-07-25 03:55:55'),
(478, 1411, 388, '2024-07-25 03:55:55', '2024-07-25 03:55:55'),
(479, 1411, 399, '2024-07-25 03:55:55', '2024-07-25 03:55:55'),
(488, 1412, 320, '2024-07-25 04:01:13', '2024-07-25 04:01:13'),
(489, 1412, 159, '2024-07-25 04:01:13', '2024-07-25 04:01:13'),
(492, 1412, 75, '2024-07-25 04:01:13', '2024-07-25 04:01:13'),
(493, 1412, 245, '2024-07-25 04:01:13', '2024-07-25 04:01:13'),
(494, 1412, 289, '2024-07-25 04:01:13', '2024-07-25 04:01:13'),
(495, 1412, 304, '2024-07-25 04:01:13', '2024-07-25 04:01:13'),
(496, 1412, 564, '2024-07-25 04:01:13', '2024-07-25 04:01:13'),
(497, 1413, 551, '2024-07-25 04:03:10', '2024-07-25 04:03:10'),
(498, 1413, 432, '2024-07-25 04:03:10', '2024-07-25 04:03:10'),
(499, 1414, 400, '2024-07-25 04:05:05', '2024-07-25 04:05:05'),
(500, 1415, 107, '2024-07-25 04:08:27', '2024-07-25 04:08:27'),
(501, 1415, 118, '2024-07-25 04:08:27', '2024-07-25 04:08:27'),
(502, 1415, 143, '2024-07-25 04:08:27', '2024-07-25 04:08:27'),
(507, 1450, 106, '2024-07-25 04:17:51', '2024-07-25 04:17:51'),
(508, 1450, 119, '2024-07-25 04:17:51', '2024-07-25 04:17:51'),
(509, 1450, 141, '2024-07-25 04:17:51', '2024-07-25 04:17:51'),
(514, 1585, 395, '2024-07-25 04:30:43', '2024-07-25 04:30:43'),
(515, 1585, 116, '2024-07-25 04:30:43', '2024-07-25 04:30:43'),
(517, 1585, 373, '2024-07-25 04:30:43', '2024-07-25 04:30:43'),
(518, 1585, 134, '2024-07-25 04:30:43', '2024-07-25 04:30:43'),
(519, 1585, 406, '2024-07-25 04:30:43', '2024-07-25 04:30:43'),
(520, 1585, 128, '2024-07-25 04:30:43', '2024-07-25 04:30:43'),
(521, 1585, 362, '2024-07-25 04:30:43', '2024-07-25 04:30:43'),
(522, 1585, 384, '2024-07-25 04:30:43', '2024-07-25 04:30:43'),
(523, 1585, 78, '2024-07-25 04:30:43', '2024-07-25 04:30:43'),
(524, 1791, 413, '2024-07-25 04:56:05', '2024-07-25 04:56:05'),
(525, 1791, 543, '2024-07-25 04:56:05', '2024-07-25 04:56:05'),
(526, 1791, 435, '2024-07-25 04:56:05', '2024-07-25 04:56:05'),
(527, 1791, 479, '2024-07-25 04:56:05', '2024-07-25 04:56:05'),
(528, 1791, 490, '2024-07-25 04:56:05', '2024-07-25 04:56:05'),
(529, 1792, 297, '2024-07-25 04:59:16', '2024-07-25 04:59:16'),
(530, 1792, 296, '2024-07-25 04:59:16', '2024-07-25 04:59:16'),
(531, 1792, 309, '2024-07-25 04:59:16', '2024-07-25 04:59:16'),
(532, 1792, 311, '2024-07-25 04:59:16', '2024-07-25 04:59:16'),
(533, 1792, 530, '2024-07-25 04:59:16', '2024-07-25 04:59:16'),
(534, 1793, 296, '2024-07-25 05:01:36', '2024-07-25 05:01:36'),
(535, 1793, 311, '2024-07-25 05:01:36', '2024-07-25 05:01:36'),
(536, 1793, 530, '2024-07-25 05:01:36', '2024-07-25 05:01:36'),
(537, 1794, 330, '2024-07-25 05:05:57', '2024-07-25 05:05:57'),
(538, 1794, 196, '2024-07-25 05:05:57', '2024-07-25 05:05:57'),
(539, 1794, 209, '2024-07-25 05:05:57', '2024-07-25 05:05:57'),
(540, 1794, 443, '2024-07-25 05:05:57', '2024-07-25 05:05:57'),
(541, 1794, 454, '2024-07-25 05:05:57', '2024-07-25 05:05:57'),
(542, 1794, 465, '2024-07-25 05:05:57', '2024-07-25 05:05:57'),
(543, 1795, 112, '2024-07-25 06:12:38', '2024-07-25 06:12:38'),
(544, 1795, 122, '2024-07-25 06:12:38', '2024-07-25 06:12:38'),
(545, 1795, 131, '2024-07-25 06:12:38', '2024-07-25 06:12:38'),
(546, 1795, 383, '2024-07-25 06:12:38', '2024-07-25 06:12:38'),
(547, 1795, 394, '2024-07-25 06:12:38', '2024-07-25 06:12:38'),
(548, 1796, 561, '2024-07-25 06:15:19', '2024-07-25 06:15:19'),
(549, 1796, 235, '2024-07-25 06:15:19', '2024-07-25 06:15:19'),
(550, 1797, 205, '2024-07-25 06:17:35', '2024-07-25 06:17:35'),
(551, 1797, 335, '2024-07-25 06:17:35', '2024-07-25 06:17:35'),
(552, 1797, 218, '2024-07-25 06:17:35', '2024-07-25 06:17:35'),
(553, 1797, 449, '2024-07-25 06:17:35', '2024-07-25 06:17:35'),
(554, 1797, 460, '2024-07-25 06:17:35', '2024-07-25 06:17:35'),
(555, 1797, 471, '2024-07-25 06:17:35', '2024-07-25 06:17:35'),
(556, 1797, 468, '2024-07-25 06:17:35', '2024-07-25 06:17:35'),
(557, 1942, 110, '2024-07-25 06:27:19', '2024-07-25 06:27:19'),
(558, 1942, 120, '2024-07-25 06:27:19', '2024-07-25 06:27:19'),
(559, 1942, 135, '2024-07-25 06:27:19', '2024-07-25 06:27:19'),
(560, 1942, 333, '2024-07-25 06:27:19', '2024-07-25 06:27:19'),
(561, 1942, 208, '2024-07-25 06:27:19', '2024-07-25 06:27:19'),
(562, 1942, 215, '2024-07-25 06:27:19', '2024-07-25 06:27:19'),
(563, 1942, 379, '2024-07-25 06:27:19', '2024-07-25 06:27:19'),
(564, 1942, 390, '2024-07-25 06:27:19', '2024-07-25 06:27:19'),
(565, 1942, 401, '2024-07-25 06:27:19', '2024-07-25 06:27:19'),
(566, 1942, 511, '2024-07-25 06:27:19', '2024-07-25 06:27:19'),
(567, 1942, 500, '2024-07-25 06:27:19', '2024-07-25 06:27:19'),
(568, 1981, 334, '2024-07-25 06:34:32', '2024-07-25 06:34:32'),
(569, 1981, 201, '2024-07-25 06:34:32', '2024-07-25 06:34:32'),
(570, 1981, 214, '2024-07-25 06:34:32', '2024-07-25 06:34:32'),
(571, 1981, 359, '2024-07-25 06:34:32', '2024-07-25 06:34:32'),
(572, 1981, 370, '2024-07-25 06:34:32', '2024-07-25 06:34:32'),
(573, 2314, 331, '2024-07-25 06:38:41', '2024-07-25 06:38:41'),
(574, 2314, 207, '2024-07-25 06:38:41', '2024-07-25 06:38:41'),
(575, 2314, 221, '2024-07-25 06:38:41', '2024-07-25 06:38:41'),
(576, 2314, 557, '2024-07-25 06:38:41', '2024-07-25 06:38:41'),
(577, 2314, 312, '2024-07-25 06:38:41', '2024-07-25 06:38:41'),
(578, 2387, 453, '2024-07-25 06:41:14', '2024-07-25 06:41:14'),
(579, 2387, 464, '2024-07-25 06:41:14', '2024-07-25 06:41:14'),
(580, 2387, 475, '2024-07-25 06:41:14', '2024-07-25 06:41:14'),
(581, 2532, 293, '2024-07-25 06:43:49', '2024-07-25 06:43:49'),
(582, 2532, 387, '2024-07-25 06:43:49', '2024-07-25 06:43:49'),
(583, 2532, 398, '2024-07-25 06:43:49', '2024-07-25 06:43:49'),
(584, 2532, 409, '2024-07-25 06:43:49', '2024-07-25 06:43:49'),
(585, 2534, 448, '2024-07-25 06:47:02', '2024-07-25 06:47:02'),
(586, 2534, 458, '2024-07-25 06:47:02', '2024-07-25 06:47:02'),
(587, 2534, 469, '2024-07-25 06:47:02', '2024-07-25 06:47:02'),
(588, 2534, 300, '2024-07-25 06:47:02', '2024-07-25 06:47:02'),
(589, 2534, 287, '2024-07-25 06:47:02', '2024-07-25 06:47:02'),
(590, 2534, 220, '2024-07-25 06:47:02', '2024-07-25 06:47:02'),
(591, 2534, 336, '2024-07-25 06:47:02', '2024-07-25 06:47:02'),
(592, 2534, 203, '2024-07-25 06:47:02', '2024-07-25 06:47:02'),
(593, 2572, 474, '2024-07-25 06:59:11', '2024-07-25 06:59:11'),
(594, 2572, 408, '2024-07-25 06:59:11', '2024-07-25 06:59:11'),
(595, 2572, 452, '2024-07-25 06:59:11', '2024-07-25 06:59:11'),
(596, 2572, 206, '2024-07-25 06:59:11', '2024-07-25 06:59:11'),
(597, 2572, 292, '2024-07-25 06:59:11', '2024-07-25 06:59:11'),
(598, 2572, 117, '2024-07-25 06:59:11', '2024-07-25 06:59:11'),
(599, 2572, 386, '2024-07-25 06:59:11', '2024-07-25 06:59:11'),
(600, 2572, 364, '2024-07-25 06:59:11', '2024-07-25 06:59:11'),
(601, 2572, 397, '2024-07-25 06:59:11', '2024-07-25 06:59:11'),
(602, 2572, 132, '2024-07-25 06:59:11', '2024-07-25 06:59:11'),
(603, 2572, 216, '2024-07-25 06:59:11', '2024-07-25 06:59:11'),
(604, 2572, 305, '2024-07-25 06:59:11', '2024-07-25 06:59:11'),
(605, 2572, 463, '2024-07-25 06:59:11', '2024-07-25 06:59:11'),
(606, 2572, 375, '2024-07-25 06:59:11', '2024-07-25 06:59:11'),
(607, 2572, 335, '2024-07-25 06:59:11', '2024-07-25 06:59:11'),
(608, 2670, 410, '2024-07-25 07:04:42', '2024-07-25 07:04:42'),
(610, 2673, 432, '2024-07-25 07:11:34', '2024-07-25 07:11:34'),
(611, 2673, 410, '2024-07-25 07:11:34', '2024-07-25 07:11:34'),
(613, 2673, 551, '2024-07-25 07:11:34', '2024-07-25 07:11:34'),
(614, 2674, 553, '2024-07-25 07:15:00', '2024-07-25 07:15:00'),
(615, 2674, 403, '2024-07-25 07:15:00', '2024-07-25 07:15:00'),
(616, 2674, 381, '2024-07-25 07:15:00', '2024-07-25 07:15:00'),
(617, 2674, 241, '2024-07-25 07:15:00', '2024-07-25 07:15:00'),
(618, 2674, 392, '2024-07-25 07:15:00', '2024-07-25 07:15:00'),
(619, 2711, 494, '2024-07-25 07:20:03', '2024-07-25 07:20:03'),
(620, 2711, 516, '2024-07-25 07:20:03', '2024-07-25 07:20:03'),
(621, 2711, 556, '2024-07-25 07:20:03', '2024-07-25 07:20:03'),
(622, 2711, 277, '2024-07-25 07:20:03', '2024-07-25 07:20:03'),
(623, 2711, 291, '2024-07-25 07:20:03', '2024-07-25 07:20:03'),
(624, 2711, 272, '2024-07-25 07:20:03', '2024-07-25 07:20:03'),
(625, 2711, 483, '2024-07-25 07:20:03', '2024-07-25 07:20:03'),
(626, 2711, 303, '2024-07-25 07:20:03', '2024-07-25 07:20:03'),
(627, 2711, 244, '2024-07-25 07:20:03', '2024-07-25 07:20:03'),
(628, 2711, 505, '2024-07-25 07:20:03', '2024-07-25 07:20:03'),
(629, 2749, 380, '2024-07-25 07:23:08', '2024-07-25 07:23:08'),
(630, 2750, 498, '2024-07-25 07:25:27', '2024-07-25 07:25:27'),
(631, 2750, 509, '2024-07-25 07:25:27', '2024-07-25 07:25:27'),
(632, 2751, 286, '2024-07-25 07:28:00', '2024-07-25 07:28:00'),
(633, 2751, 270, '2024-07-25 07:28:00', '2024-07-25 07:28:00'),
(634, 2751, 499, '2024-07-25 07:28:00', '2024-07-25 07:28:00'),
(635, 2788, 492, '2024-07-25 07:32:29', '2024-07-25 07:32:29'),
(636, 2788, 516, '2024-07-25 07:32:29', '2024-07-25 07:32:29'),
(637, 2788, 238, '2024-07-25 07:32:29', '2024-07-25 07:32:29'),
(638, 2788, 481, '2024-07-25 07:32:29', '2024-07-25 07:32:29'),
(639, 2788, 503, '2024-07-25 07:32:29', '2024-07-25 07:32:29'),
(640, 2788, 563, '2024-07-25 07:32:29', '2024-07-25 07:32:29'),
(641, 2798, 411, '2024-07-25 07:36:53', '2024-07-25 07:36:53'),
(642, 2798, 541, '2024-07-25 07:36:53', '2024-07-25 07:36:53'),
(643, 2798, 167, '2024-07-25 07:36:53', '2024-07-25 07:36:53'),
(644, 2798, 433, '2024-07-25 07:36:53', '2024-07-25 07:36:53'),
(645, 2799, 361, '2024-07-25 07:40:10', '2024-07-25 07:40:10'),
(646, 2799, 372, '2024-07-25 07:40:10', '2024-07-25 07:40:10'),
(647, 2799, 76, '2024-07-25 07:40:10', '2024-07-25 07:40:10'),
(648, 2799, 438, '2024-07-25 07:40:10', '2024-07-25 07:40:10'),
(649, 2799, 306, '2024-07-25 07:40:10', '2024-07-25 07:40:10'),
(651, 2951, 476, '2024-07-25 07:44:50', '2024-07-25 07:44:50'),
(652, 2951, 487, '2024-07-25 07:44:50', '2024-07-25 07:44:50'),
(653, 2951, 268, '2024-07-25 07:44:50', '2024-07-25 07:44:50'),
(654, 2951, 245, '2024-07-25 07:44:50', '2024-07-25 07:44:50'),
(655, 2951, 279, '2024-07-25 07:44:50', '2024-07-25 07:44:50'),
(656, 2951, 564, '2024-07-25 07:44:50', '2024-07-25 07:44:50'),
(657, 2952, 477, '2024-07-25 07:48:07', '2024-07-25 07:48:07'),
(658, 2952, 488, '2024-07-25 07:48:07', '2024-07-25 07:48:07'),
(659, 2953, 402, '2024-07-25 07:52:10', '2024-07-25 07:52:10'),
(660, 2953, 446, '2024-07-25 07:52:10', '2024-07-25 07:52:10'),
(661, 2953, 457, '2024-07-25 07:52:10', '2024-07-25 07:52:10'),
(662, 2953, 391, '2024-07-25 07:52:10', '2024-07-25 07:52:10'),
(663, 2953, 124, '2024-07-25 07:52:10', '2024-07-25 07:52:10'),
(664, 2953, 133, '2024-07-25 07:52:10', '2024-07-25 07:52:10'),
(665, 2953, 114, '2024-07-25 07:52:10', '2024-07-25 07:52:10'),
(666, 2990, 454, '2024-07-25 07:55:14', '2024-07-25 07:55:14'),
(667, 2990, 455, '2024-07-25 07:55:14', '2024-07-25 07:55:14'),
(668, 2990, 443, '2024-07-25 07:55:14', '2024-07-25 07:55:14'),
(669, 2990, 444, '2024-07-25 07:55:14', '2024-07-25 07:55:14'),
(670, 2990, 466, '2024-07-25 07:55:14', '2024-07-25 07:55:14'),
(671, 2990, 465, '2024-07-25 07:55:14', '2024-07-25 07:55:14'),
(672, 3027, 73, '2024-07-25 08:00:55', '2024-07-25 08:00:55'),
(673, 3027, 285, '2024-07-25 08:00:55', '2024-07-25 08:00:55'),
(674, 3027, 491, '2024-07-25 08:00:55', '2024-07-25 08:00:55'),
(675, 3027, 448, '2024-07-25 08:00:55', '2024-07-25 08:00:55'),
(676, 3027, 470, '2024-07-25 08:00:55', '2024-07-25 08:00:55'),
(678, 3027, 459, '2024-07-25 08:00:55', '2024-07-25 08:00:55'),
(679, 3027, 273, '2024-07-25 08:00:55', '2024-07-25 08:00:55'),
(680, 3064, 531, '2024-07-25 08:05:21', '2024-07-25 08:05:21'),
(681, 3064, 530, '2024-07-25 08:05:21', '2024-07-25 08:05:21'),
(682, 3064, 404, '2024-07-25 08:05:21', '2024-07-25 08:05:21'),
(683, 3064, 393, '2024-07-25 08:05:21', '2024-07-25 08:05:21'),
(684, 3064, 382, '2024-07-25 08:05:21', '2024-07-25 08:05:21'),
(685, 3064, 415, '2024-07-25 08:05:21', '2024-07-25 08:05:21'),
(686, 3064, 545, '2024-07-25 08:05:21', '2024-07-25 08:05:21'),
(687, 3064, 437, '2024-07-25 08:05:21', '2024-07-25 08:05:21'),
(688, 3064, 371, '2024-07-25 08:05:21', '2024-07-25 08:05:21'),
(689, 3064, 360, '2024-07-25 08:05:21', '2024-07-25 08:05:21'),
(690, 3064, 311, '2024-07-25 08:05:21', '2024-07-25 08:05:21'),
(691, 3064, 296, '2024-07-25 08:05:21', '2024-07-25 08:05:21'),
(692, 3065, 330, '2024-07-25 08:09:32', '2024-07-25 08:09:32'),
(693, 3065, 196, '2024-07-25 08:09:32', '2024-07-25 08:09:32'),
(694, 3065, 209, '2024-07-25 08:09:32', '2024-07-25 08:09:32'),
(695, 3065, 443, '2024-07-25 08:09:32', '2024-07-25 08:09:32'),
(696, 3065, 465, '2024-07-25 08:09:32', '2024-07-25 08:09:32'),
(697, 3139, 558, '2024-07-25 08:12:12', '2024-07-25 08:12:12'),
(698, 3139, 239, '2024-07-25 08:12:12', '2024-07-25 08:12:12'),
(699, 3139, 281, '2024-07-25 08:12:12', '2024-07-25 08:12:12'),
(700, 3139, 269, '2024-07-25 08:12:12', '2024-07-25 08:12:12'),
(701, 3139, 299, '2024-07-25 08:12:12', '2024-07-25 08:12:12'),
(702, 3139, 308, '2024-07-25 08:12:12', '2024-07-25 08:12:12'),
(703, 3176, 313, '2024-07-25 08:17:02', '2024-07-25 08:17:02'),
(704, 3176, 166, '2024-07-25 08:17:02', '2024-07-25 08:17:02'),
(705, 3176, 589, '2024-07-25 08:17:02', '2024-07-25 08:17:02'),
(706, 3176, 418, '2024-07-25 08:17:02', '2024-07-25 08:17:02'),
(707, 3176, 548, '2024-07-25 08:17:02', '2024-07-25 08:17:02'),
(708, 3176, 440, '2024-07-25 08:17:02', '2024-07-25 08:17:02'),
(709, 3177, 486, '2024-07-25 08:19:50', '2024-07-25 08:19:50'),
(710, 3177, 497, '2024-07-25 08:19:50', '2024-07-25 08:19:50'),
(711, 3177, 508, '2024-07-25 08:19:50', '2024-07-25 08:19:50'),
(712, 3177, 519, '2024-07-25 08:19:50', '2024-07-25 08:19:50'),
(713, 3177, 376, '2024-07-25 08:19:50', '2024-07-25 08:19:50'),
(714, 3177, 365, '2024-07-25 08:19:50', '2024-07-25 08:19:50'),
(715, 3178, 111, '2024-07-25 08:23:31', '2024-07-25 08:23:31'),
(716, 3178, 126, '2024-07-25 08:23:31', '2024-07-25 08:23:31'),
(717, 3178, 137, '2024-07-25 08:23:31', '2024-07-25 08:23:31'),
(718, 3178, 285, '2024-07-25 08:23:31', '2024-07-25 08:23:31'),
(719, 3178, 273, '2024-07-25 08:23:31', '2024-07-25 08:23:31'),
(720, 3178, 553, '2024-07-25 08:23:31', '2024-07-25 08:23:31'),
(728, 3180, 121, '2024-07-25 08:30:24', '2024-07-25 08:30:24'),
(729, 3180, 105, '2024-07-25 08:30:24', '2024-07-25 08:30:24'),
(730, 3180, 142, '2024-07-25 08:30:24', '2024-07-25 08:30:24'),
(731, 3180, 237, '2024-07-25 08:30:24', '2024-07-25 08:30:24'),
(732, 3180, 562, '2024-07-25 08:30:24', '2024-07-25 08:30:24'),
(733, 3180, 307, '2024-07-25 08:30:24', '2024-07-25 08:30:24'),
(734, 3179, 315, '2024-07-25 08:32:46', '2024-07-25 08:32:46'),
(735, 3179, 168, '2024-07-25 08:32:46', '2024-07-25 08:32:46'),
(736, 3179, 579, '2024-07-25 08:32:46', '2024-07-25 08:32:46'),
(737, 3179, 329, '2024-07-25 08:32:46', '2024-07-25 08:32:46'),
(738, 3179, 199, '2024-07-25 08:32:46', '2024-07-25 08:32:46'),
(739, 3179, 210, '2024-07-25 08:32:46', '2024-07-25 08:32:46'),
(740, 3179, 69, '2024-07-25 08:32:46', '2024-07-25 08:32:46'),
(741, 3179, 602, '2024-07-25 08:32:46', '2024-07-25 08:32:46'),
(742, 3181, 317, '2024-07-25 08:35:05', '2024-07-25 08:35:05'),
(743, 3181, 169, '2024-07-25 08:35:05', '2024-07-25 08:35:05'),
(744, 3181, 578, '2024-07-25 08:35:05', '2024-07-25 08:35:05'),
(745, 3181, 108, '2024-07-25 08:35:05', '2024-07-25 08:35:05'),
(746, 3181, 130, '2024-07-25 08:35:05', '2024-07-25 08:35:05'),
(747, 3181, 140, '2024-07-25 08:35:05', '2024-07-25 08:35:05'),
(748, 3181, 328, '2024-07-25 08:35:05', '2024-07-25 08:35:05'),
(749, 3181, 198, '2024-07-25 08:35:05', '2024-07-25 08:35:05'),
(750, 3181, 211, '2024-07-25 08:35:05', '2024-07-25 08:35:05');

-- --------------------------------------------------------

--
-- Table structure for table `timezones`
--

CREATE TABLE `timezones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `label` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `timezones`
--

INSERT INTO `timezones` (`id`, `label`, `value`) VALUES
(1, '(GMT-11:00) Pacific, Midway', 'Pacific/Midway'),
(2, '(GMT-11:00) Pacific, Niue', 'Pacific/Niue'),
(3, '(GMT-11:00) Pacific, Pago Pago', 'Pacific/Pago_Pago'),
(4, '(GMT-10:00) Pacific, Honolulu', 'Pacific/Honolulu'),
(5, '(GMT-10:00) Pacific, Rarotonga', 'Pacific/Rarotonga'),
(6, '(GMT-10:00) Pacific, Tahiti', 'Pacific/Tahiti'),
(7, '(GMT-09:30) Pacific, Marquesas', 'Pacific/Marquesas'),
(8, '(GMT-09:00) America, Adak', 'America/Adak'),
(9, '(GMT-09:00) Pacific, Gambier', 'Pacific/Gambier'),
(10, '(GMT-08:00) America, Anchorage', 'America/Anchorage'),
(11, '(GMT-08:00) America, Juneau', 'America/Juneau'),
(12, '(GMT-08:00) America, Metlakatla', 'America/Metlakatla'),
(13, '(GMT-08:00) America, Nome', 'America/Nome'),
(14, '(GMT-08:00) America, Sitka', 'America/Sitka'),
(15, '(GMT-08:00) America, Yakutat', 'America/Yakutat'),
(16, '(GMT-08:00) Pacific, Pitcairn', 'Pacific/Pitcairn'),
(17, '(GMT-07:00) America, Creston', 'America/Creston'),
(18, '(GMT-07:00) America, Dawson', 'America/Dawson'),
(19, '(GMT-07:00) America, Dawson Creek', 'America/Dawson_Creek'),
(20, '(GMT-07:00) America, Fort Nelson', 'America/Fort_Nelson'),
(21, '(GMT-07:00) America, Hermosillo', 'America/Hermosillo'),
(22, '(GMT-07:00) America, Los Angeles', 'America/Los_Angeles'),
(23, '(GMT-07:00) America, Mazatlan', 'America/Mazatlan'),
(24, '(GMT-07:00) America, Phoenix', 'America/Phoenix'),
(25, '(GMT-07:00) America, Tijuana', 'America/Tijuana'),
(26, '(GMT-07:00) America, Vancouver', 'America/Vancouver'),
(27, '(GMT-07:00) America, Whitehorse', 'America/Whitehorse'),
(28, '(GMT-06:00) America, Bahia Banderas', 'America/Bahia_Banderas'),
(29, '(GMT-06:00) America, Belize', 'America/Belize'),
(30, '(GMT-06:00) America, Boise', 'America/Boise'),
(31, '(GMT-06:00) America, Cambridge Bay', 'America/Cambridge_Bay'),
(32, '(GMT-06:00) America, Chihuahua', 'America/Chihuahua'),
(33, '(GMT-06:00) America, Ciudad Juarez', 'America/Ciudad_Juarez'),
(34, '(GMT-06:00) America, Costa Rica', 'America/Costa_Rica'),
(35, '(GMT-06:00) America, Denver', 'America/Denver'),
(36, '(GMT-06:00) America, Edmonton', 'America/Edmonton'),
(37, '(GMT-06:00) America, El Salvador', 'America/El_Salvador'),
(38, '(GMT-06:00) America, Guatemala', 'America/Guatemala'),
(39, '(GMT-06:00) America, Inuvik', 'America/Inuvik'),
(40, '(GMT-06:00) America, Managua', 'America/Managua'),
(41, '(GMT-06:00) America, Merida', 'America/Merida'),
(42, '(GMT-06:00) America, Mexico City', 'America/Mexico_City'),
(43, '(GMT-06:00) America, Monterrey', 'America/Monterrey'),
(44, '(GMT-06:00) America, Regina', 'America/Regina'),
(45, '(GMT-06:00) America, Swift Current', 'America/Swift_Current'),
(46, '(GMT-06:00) America, Tegucigalpa', 'America/Tegucigalpa'),
(47, '(GMT-06:00) America, Yellowknife', 'America/Yellowknife'),
(48, '(GMT-06:00) Pacific, Galapagos', 'Pacific/Galapagos'),
(49, '(GMT-05:00) America, Atikokan', 'America/Atikokan'),
(50, '(GMT-05:00) America, Bogota', 'America/Bogota'),
(51, '(GMT-05:00) America, Cancun', 'America/Cancun'),
(52, '(GMT-05:00) America, Cayman', 'America/Cayman'),
(53, '(GMT-05:00) America, Chicago', 'America/Chicago'),
(54, '(GMT-05:00) America, Eirunepe', 'America/Eirunepe'),
(55, '(GMT-05:00) America, Guayaquil', 'America/Guayaquil'),
(56, '(GMT-05:00) America, Indiana, Knox', 'America/Indiana/Knox'),
(57, '(GMT-05:00) America, Indiana, Tell City', 'America/Indiana/Tell_City'),
(58, '(GMT-05:00) America, Jamaica', 'America/Jamaica'),
(59, '(GMT-05:00) America, Lima', 'America/Lima'),
(60, '(GMT-05:00) America, Matamoros', 'America/Matamoros'),
(61, '(GMT-05:00) America, Menominee', 'America/Menominee'),
(62, '(GMT-05:00) America, North Dakota, Beulah', 'America/North_Dakota/Beulah'),
(63, '(GMT-05:00) America, North Dakota, Center', 'America/North_Dakota/Center'),
(64, '(GMT-05:00) America, North Dakota, New Salem', 'America/North_Dakota/New_Salem'),
(65, '(GMT-05:00) America, Ojinaga', 'America/Ojinaga'),
(66, '(GMT-05:00) America, Panama', 'America/Panama'),
(67, '(GMT-05:00) America, Rankin Inlet', 'America/Rankin_Inlet'),
(68, '(GMT-05:00) America, Resolute', 'America/Resolute'),
(69, '(GMT-05:00) America, Rio Branco', 'America/Rio_Branco'),
(70, '(GMT-05:00) America, Winnipeg', 'America/Winnipeg'),
(71, '(GMT-05:00) Pacific, Easter', 'Pacific/Easter'),
(72, '(GMT-04:00) America, Anguilla', 'America/Anguilla'),
(73, '(GMT-04:00) America, Antigua', 'America/Antigua'),
(74, '(GMT-04:00) America, Aruba', 'America/Aruba'),
(75, '(GMT-04:00) America, Barbados', 'America/Barbados'),
(76, '(GMT-04:00) America, Blanc-Sablon', 'America/Blanc-Sablon'),
(77, '(GMT-04:00) America, Boa Vista', 'America/Boa_Vista'),
(78, '(GMT-04:00) America, Campo Grande', 'America/Campo_Grande'),
(79, '(GMT-04:00) America, Caracas', 'America/Caracas'),
(80, '(GMT-04:00) America, Cuiaba', 'America/Cuiaba'),
(81, '(GMT-04:00) America, Curacao', 'America/Curacao'),
(82, '(GMT-04:00) America, Detroit', 'America/Detroit'),
(83, '(GMT-04:00) America, Dominica', 'America/Dominica'),
(84, '(GMT-04:00) America, Grand Turk', 'America/Grand_Turk'),
(85, '(GMT-04:00) America, Grenada', 'America/Grenada'),
(86, '(GMT-04:00) America, Guadeloupe', 'America/Guadeloupe'),
(87, '(GMT-04:00) America, Guyana', 'America/Guyana'),
(88, '(GMT-04:00) America, Havana', 'America/Havana'),
(89, '(GMT-04:00) America, Indiana, Indianapolis', 'America/Indiana/Indianapolis'),
(90, '(GMT-04:00) America, Indiana, Marengo', 'America/Indiana/Marengo'),
(91, '(GMT-04:00) America, Indiana, Petersburg', 'America/Indiana/Petersburg'),
(92, '(GMT-04:00) America, Indiana, Vevay', 'America/Indiana/Vevay'),
(93, '(GMT-04:00) America, Indiana, Vincennes', 'America/Indiana/Vincennes'),
(94, '(GMT-04:00) America, Indiana, Winamac', 'America/Indiana/Winamac'),
(95, '(GMT-04:00) America, Iqaluit', 'America/Iqaluit'),
(96, '(GMT-04:00) America, Kentucky, Louisville', 'America/Kentucky/Louisville'),
(97, '(GMT-04:00) America, Kentucky, Monticello', 'America/Kentucky/Monticello'),
(98, '(GMT-04:00) America, Kralendijk', 'America/Kralendijk'),
(99, '(GMT-04:00) America, La Paz', 'America/La_Paz'),
(100, '(GMT-04:00) America, Lower Princes', 'America/Lower_Princes'),
(101, '(GMT-04:00) America, Manaus', 'America/Manaus'),
(102, '(GMT-04:00) America, Marigot', 'America/Marigot'),
(103, '(GMT-04:00) America, Martinique', 'America/Martinique'),
(104, '(GMT-04:00) America, Montserrat', 'America/Montserrat'),
(105, '(GMT-04:00) America, Nassau', 'America/Nassau'),
(106, '(GMT-04:00) America, New York', 'America/New_York'),
(107, '(GMT-04:00) America, Port of Spain', 'America/Port_of_Spain'),
(108, '(GMT-04:00) America, Port-au-Prince', 'America/Port-au-Prince'),
(109, '(GMT-04:00) America, Porto Velho', 'America/Porto_Velho'),
(110, '(GMT-04:00) America, Puerto Rico', 'America/Puerto_Rico'),
(111, '(GMT-04:00) America, Santo Domingo', 'America/Santo_Domingo'),
(112, '(GMT-04:00) America, St. Barthelemy', 'America/St_Barthelemy'),
(113, '(GMT-04:00) America, St. Kitts', 'America/St_Kitts'),
(114, '(GMT-04:00) America, St. Lucia', 'America/St_Lucia'),
(115, '(GMT-04:00) America, St. Thomas', 'America/St_Thomas'),
(116, '(GMT-04:00) America, St. Vincent', 'America/St_Vincent'),
(117, '(GMT-04:00) America, Toronto', 'America/Toronto'),
(118, '(GMT-04:00) America, Tortola', 'America/Tortola'),
(119, '(GMT-03:00) America, Araguaina', 'America/Araguaina'),
(120, '(GMT-03:00) America, Argentina, Buenos Aires', 'America/Argentina/Buenos_Aires'),
(121, '(GMT-03:00) America, Argentina, Catamarca', 'America/Argentina/Catamarca'),
(122, '(GMT-03:00) America, Argentina, Cordoba', 'America/Argentina/Cordoba'),
(123, '(GMT-03:00) America, Argentina, Jujuy', 'America/Argentina/Jujuy'),
(124, '(GMT-03:00) America, Argentina, La Rioja', 'America/Argentina/La_Rioja'),
(125, '(GMT-03:00) America, Argentina, Mendoza', 'America/Argentina/Mendoza'),
(126, '(GMT-03:00) America, Argentina, Rio Gallegos', 'America/Argentina/Rio_Gallegos'),
(127, '(GMT-03:00) America, Argentina, Salta', 'America/Argentina/Salta'),
(128, '(GMT-03:00) America, Argentina, San Juan', 'America/Argentina/San_Juan'),
(129, '(GMT-03:00) America, Argentina, San Luis', 'America/Argentina/San_Luis'),
(130, '(GMT-03:00) America, Argentina, Tucuman', 'America/Argentina/Tucuman'),
(131, '(GMT-03:00) America, Argentina, Ushuaia', 'America/Argentina/Ushuaia'),
(132, '(GMT-03:00) America, Asuncion', 'America/Asuncion'),
(133, '(GMT-03:00) America, Bahia', 'America/Bahia'),
(134, '(GMT-03:00) America, Belem', 'America/Belem'),
(135, '(GMT-03:00) America, Cayenne', 'America/Cayenne'),
(136, '(GMT-03:00) America, Fortaleza', 'America/Fortaleza'),
(137, '(GMT-03:00) America, Glace Bay', 'America/Glace_Bay'),
(138, '(GMT-03:00) America, Goose Bay', 'America/Goose_Bay'),
(139, '(GMT-03:00) America, Halifax', 'America/Halifax'),
(140, '(GMT-03:00) America, Maceio', 'America/Maceio'),
(141, '(GMT-03:00) America, Moncton', 'America/Moncton'),
(142, '(GMT-03:00) America, Montevideo', 'America/Montevideo'),
(143, '(GMT-03:00) America, Nuuk', 'America/Nuuk'),
(144, '(GMT-03:00) America, Paramaribo', 'America/Paramaribo'),
(145, '(GMT-03:00) America, Punta Arenas', 'America/Punta_Arenas'),
(146, '(GMT-03:00) America, Recife', 'America/Recife'),
(147, '(GMT-03:00) America, Santarem', 'America/Santarem'),
(148, '(GMT-03:00) America, Santiago', 'America/Santiago'),
(149, '(GMT-03:00) America, Sao Paulo', 'America/Sao_Paulo'),
(150, '(GMT-03:00) America, Thule', 'America/Thule'),
(151, '(GMT-03:00) Antarctica, Palmer', 'Antarctica/Palmer'),
(152, '(GMT-03:00) Antarctica, Rothera', 'Antarctica/Rothera'),
(153, '(GMT-03:00) Atlantic, Bermuda', 'Atlantic/Bermuda'),
(154, '(GMT-03:00) Atlantic, Stanley', 'Atlantic/Stanley'),
(155, '(GMT-02:30) America, St. Johns', 'America/St_Johns'),
(156, '(GMT-02:00) America, Miquelon', 'America/Miquelon'),
(157, '(GMT-02:00) America, Noronha', 'America/Noronha'),
(158, '(GMT-02:00) Atlantic, South Georgia', 'Atlantic/South_Georgia'),
(159, '(GMT-01:00) America, Scoresbysund', 'America/Scoresbysund'),
(160, '(GMT-01:00) Atlantic, Azores', 'Atlantic/Azores'),
(161, '(GMT-01:00) Atlantic, Cape Verde', 'Atlantic/Cape_Verde'),
(162, '(GMT) Africa, Abidjan', 'Africa/Abidjan'),
(163, '(GMT) Africa, Accra', 'Africa/Accra'),
(164, '(GMT) Africa, Bamako', 'Africa/Bamako'),
(165, '(GMT) Africa, Banjul', 'Africa/Banjul'),
(166, '(GMT) Africa, Bissau', 'Africa/Bissau'),
(167, '(GMT) Africa, Conakry', 'Africa/Conakry'),
(168, '(GMT) Africa, Dakar', 'Africa/Dakar'),
(169, '(GMT) Africa, Freetown', 'Africa/Freetown'),
(170, '(GMT) Africa, Lome', 'Africa/Lome'),
(171, '(GMT) Africa, Monrovia', 'Africa/Monrovia'),
(172, '(GMT) Africa, Nouakchott', 'Africa/Nouakchott'),
(173, '(GMT) Africa, Ouagadougou', 'Africa/Ouagadougou'),
(174, '(GMT) Africa, Sao Tome', 'Africa/Sao_Tome'),
(175, '(GMT) America, Danmarkshavn', 'America/Danmarkshavn'),
(176, '(GMT) Antarctica, Troll', 'Antarctica/Troll'),
(177, '(GMT) Atlantic, Canary', 'Atlantic/Canary'),
(178, '(GMT) Atlantic, Faroe', 'Atlantic/Faroe'),
(179, '(GMT) Atlantic, Madeira', 'Atlantic/Madeira'),
(180, '(GMT) Atlantic, Reykjavik', 'Atlantic/Reykjavik'),
(181, '(GMT) Atlantic, St. Helena', 'Atlantic/St_Helena'),
(182, '(GMT) Europe, Dublin', 'Europe/Dublin'),
(183, '(GMT) Europe, Guernsey', 'Europe/Guernsey'),
(184, '(GMT) Europe, Isle of Man', 'Europe/Isle_of_Man'),
(185, '(GMT) Europe, Jersey', 'Europe/Jersey'),
(186, '(GMT) Europe, Lisbon', 'Europe/Lisbon'),
(187, '(GMT) Europe, London', 'Europe/London'),
(188, '(GMT) UTC', 'UTC'),
(189, '(GMT+01:00) Africa, Algiers', 'Africa/Algiers'),
(190, '(GMT+01:00) Africa, Bangui', 'Africa/Bangui'),
(191, '(GMT+01:00) Africa, Brazzaville', 'Africa/Brazzaville'),
(192, '(GMT+01:00) Africa, Casablanca', 'Africa/Casablanca'),
(193, '(GMT+01:00) Africa, Ceuta', 'Africa/Ceuta'),
(194, '(GMT+01:00) Africa, Douala', 'Africa/Douala'),
(195, '(GMT+01:00) Africa, El Aaiun', 'Africa/El_Aaiun'),
(196, '(GMT+01:00) Africa, Kinshasa', 'Africa/Kinshasa'),
(197, '(GMT+01:00) Africa, Lagos', 'Africa/Lagos'),
(198, '(GMT+01:00) Africa, Libreville', 'Africa/Libreville'),
(199, '(GMT+01:00) Africa, Luanda', 'Africa/Luanda'),
(200, '(GMT+01:00) Africa, Malabo', 'Africa/Malabo'),
(201, '(GMT+01:00) Africa, Ndjamena', 'Africa/Ndjamena'),
(202, '(GMT+01:00) Africa, Niamey', 'Africa/Niamey'),
(203, '(GMT+01:00) Africa, Porto-Novo', 'Africa/Porto-Novo'),
(204, '(GMT+01:00) Africa, Tunis', 'Africa/Tunis'),
(205, '(GMT+01:00) Arctic, Longyearbyen', 'Arctic/Longyearbyen'),
(206, '(GMT+01:00) Europe, Amsterdam', 'Europe/Amsterdam'),
(207, '(GMT+01:00) Europe, Andorra', 'Europe/Andorra'),
(208, '(GMT+01:00) Europe, Belgrade', 'Europe/Belgrade'),
(209, '(GMT+01:00) Europe, Berlin', 'Europe/Berlin'),
(210, '(GMT+01:00) Europe, Bratislava', 'Europe/Bratislava'),
(211, '(GMT+01:00) Europe, Brussels', 'Europe/Brussels'),
(212, '(GMT+01:00) Europe, Budapest', 'Europe/Budapest'),
(213, '(GMT+01:00) Europe, Busingen', 'Europe/Busingen'),
(214, '(GMT+01:00) Europe, Copenhagen', 'Europe/Copenhagen'),
(215, '(GMT+01:00) Europe, Gibraltar', 'Europe/Gibraltar'),
(216, '(GMT+01:00) Europe, Ljubljana', 'Europe/Ljubljana'),
(217, '(GMT+01:00) Europe, Luxembourg', 'Europe/Luxembourg'),
(218, '(GMT+01:00) Europe, Madrid', 'Europe/Madrid'),
(219, '(GMT+01:00) Europe, Malta', 'Europe/Malta'),
(220, '(GMT+01:00) Europe, Monaco', 'Europe/Monaco'),
(221, '(GMT+01:00) Europe, Oslo', 'Europe/Oslo'),
(222, '(GMT+01:00) Europe, Paris', 'Europe/Paris'),
(223, '(GMT+01:00) Europe, Podgorica', 'Europe/Podgorica'),
(224, '(GMT+01:00) Europe, Prague', 'Europe/Prague'),
(225, '(GMT+01:00) Europe, Rome', 'Europe/Rome'),
(226, '(GMT+01:00) Europe, San Marino', 'Europe/San_Marino'),
(227, '(GMT+01:00) Europe, Sarajevo', 'Europe/Sarajevo'),
(228, '(GMT+01:00) Europe, Skopje', 'Europe/Skopje'),
(229, '(GMT+01:00) Europe, Stockholm', 'Europe/Stockholm'),
(230, '(GMT+01:00) Europe, Tirane', 'Europe/Tirane'),
(231, '(GMT+01:00) Europe, Vaduz', 'Europe/Vaduz'),
(232, '(GMT+01:00) Europe, Vatican', 'Europe/Vatican'),
(233, '(GMT+01:00) Europe, Vienna', 'Europe/Vienna'),
(234, '(GMT+01:00) Europe, Warsaw', 'Europe/Warsaw'),
(235, '(GMT+01:00) Europe, Zagreb', 'Europe/Zagreb'),
(236, '(GMT+01:00) Europe, Zurich', 'Europe/Zurich'),
(237, '(GMT+02:00) Africa, Blantyre', 'Africa/Blantyre'),
(238, '(GMT+02:00) Africa, Bujumbura', 'Africa/Bujumbura'),
(239, '(GMT+02:00) Africa, Cairo', 'Africa/Cairo'),
(240, '(GMT+02:00) Africa, Gaborone', 'Africa/Gaborone'),
(241, '(GMT+02:00) Africa, Harare', 'Africa/Harare'),
(242, '(GMT+02:00) Africa, Johannesburg', 'Africa/Johannesburg'),
(243, '(GMT+02:00) Africa, Juba', 'Africa/Juba'),
(244, '(GMT+02:00) Africa, Khartoum', 'Africa/Khartoum'),
(245, '(GMT+02:00) Africa, Kigali', 'Africa/Kigali'),
(246, '(GMT+02:00) Africa, Lubumbashi', 'Africa/Lubumbashi'),
(247, '(GMT+02:00) Africa, Lusaka', 'Africa/Lusaka'),
(248, '(GMT+02:00) Africa, Maputo', 'Africa/Maputo'),
(249, '(GMT+02:00) Africa, Maseru', 'Africa/Maseru'),
(250, '(GMT+02:00) Africa, Mbabane', 'Africa/Mbabane'),
(251, '(GMT+02:00) Africa, Tripoli', 'Africa/Tripoli'),
(252, '(GMT+02:00) Africa, Windhoek', 'Africa/Windhoek'),
(253, '(GMT+02:00) Asia, Beirut', 'Asia/Beirut'),
(254, '(GMT+02:00) Asia, Famagusta', 'Asia/Famagusta'),
(255, '(GMT+02:00) Asia, Gaza', 'Asia/Gaza'),
(256, '(GMT+02:00) Asia, Hebron', 'Asia/Hebron'),
(257, '(GMT+02:00) Asia, Jerusalem', 'Asia/Jerusalem'),
(258, '(GMT+02:00) Asia, Nicosia', 'Asia/Nicosia'),
(259, '(GMT+02:00) Europe, Athens', 'Europe/Athens'),
(260, '(GMT+02:00) Europe, Bucharest', 'Europe/Bucharest'),
(261, '(GMT+02:00) Europe, Chisinau', 'Europe/Chisinau'),
(262, '(GMT+02:00) Europe, Helsinki', 'Europe/Helsinki'),
(263, '(GMT+02:00) Europe, Kaliningrad', 'Europe/Kaliningrad'),
(264, '(GMT+02:00) Europe, Kyiv', 'Europe/Kyiv'),
(265, '(GMT+02:00) Europe, Mariehamn', 'Europe/Mariehamn'),
(266, '(GMT+02:00) Europe, Riga', 'Europe/Riga'),
(267, '(GMT+02:00) Europe, Sofia', 'Europe/Sofia'),
(268, '(GMT+02:00) Europe, Tallinn', 'Europe/Tallinn'),
(269, '(GMT+02:00) Europe, Vilnius', 'Europe/Vilnius'),
(270, '(GMT+03:00) Africa, Addis Ababa', 'Africa/Addis_Ababa'),
(271, '(GMT+03:00) Africa, Asmara', 'Africa/Asmara'),
(272, '(GMT+03:00) Africa, Dar es Salaam', 'Africa/Dar_es_Salaam'),
(273, '(GMT+03:00) Africa, Djibouti', 'Africa/Djibouti'),
(274, '(GMT+03:00) Africa, Kampala', 'Africa/Kampala'),
(275, '(GMT+03:00) Africa, Mogadishu', 'Africa/Mogadishu'),
(276, '(GMT+03:00) Africa, Nairobi', 'Africa/Nairobi'),
(277, '(GMT+03:00) Antarctica, Syowa', 'Antarctica/Syowa'),
(278, '(GMT+03:00) Asia, Aden', 'Asia/Aden'),
(279, '(GMT+03:00) Asia, Amman', 'Asia/Amman'),
(280, '(GMT+03:00) Asia, Baghdad', 'Asia/Baghdad'),
(281, '(GMT+03:00) Asia, Bahrain', 'Asia/Bahrain'),
(282, '(GMT+03:00) Asia, Damascus', 'Asia/Damascus'),
(283, '(GMT+03:00) Asia, Kuwait', 'Asia/Kuwait'),
(284, '(GMT+03:00) Asia, Qatar', 'Asia/Qatar'),
(285, '(GMT+03:00) Asia, Riyadh', 'Asia/Riyadh'),
(286, '(GMT+03:00) Europe, Istanbul', 'Europe/Istanbul'),
(287, '(GMT+03:00) Europe, Kirov', 'Europe/Kirov'),
(288, '(GMT+03:00) Europe, Minsk', 'Europe/Minsk'),
(289, '(GMT+03:00) Europe, Moscow', 'Europe/Moscow'),
(290, '(GMT+03:00) Europe, Simferopol', 'Europe/Simferopol'),
(291, '(GMT+03:00) Europe, Volgograd', 'Europe/Volgograd'),
(292, '(GMT+03:00) Indian, Antananarivo', 'Indian/Antananarivo'),
(293, '(GMT+03:00) Indian, Comoro', 'Indian/Comoro'),
(294, '(GMT+03:00) Indian, Mayotte', 'Indian/Mayotte'),
(295, '(GMT+03:30) Asia, Tehran', 'Asia/Tehran'),
(296, '(GMT+04:00) Asia, Baku', 'Asia/Baku'),
(297, '(GMT+04:00) Asia, Dubai', 'Asia/Dubai'),
(298, '(GMT+04:00) Asia, Muscat', 'Asia/Muscat'),
(299, '(GMT+04:00) Asia, Tbilisi', 'Asia/Tbilisi'),
(300, '(GMT+04:00) Asia, Yerevan', 'Asia/Yerevan'),
(301, '(GMT+04:00) Europe, Astrakhan', 'Europe/Astrakhan'),
(302, '(GMT+04:00) Europe, Samara', 'Europe/Samara'),
(303, '(GMT+04:00) Europe, Saratov', 'Europe/Saratov'),
(304, '(GMT+04:00) Europe, Ulyanovsk', 'Europe/Ulyanovsk'),
(305, '(GMT+04:00) Indian, Mahe', 'Indian/Mahe'),
(306, '(GMT+04:00) Indian, Mauritius', 'Indian/Mauritius'),
(307, '(GMT+04:00) Indian, Reunion', 'Indian/Reunion'),
(308, '(GMT+04:30) Asia, Kabul', 'Asia/Kabul'),
(309, '(GMT+05:00) Antarctica, Mawson', 'Antarctica/Mawson'),
(310, '(GMT+05:00) Asia, Aqtau', 'Asia/Aqtau'),
(311, '(GMT+05:00) Asia, Aqtobe', 'Asia/Aqtobe'),
(312, '(GMT+05:00) Asia, Ashgabat', 'Asia/Ashgabat'),
(313, '(GMT+05:00) Asia, Atyrau', 'Asia/Atyrau'),
(314, '(GMT+05:00) Asia, Dushanbe', 'Asia/Dushanbe'),
(315, '(GMT+05:00) Asia, Karachi', 'Asia/Karachi'),
(316, '(GMT+05:00) Asia, Oral', 'Asia/Oral'),
(317, '(GMT+05:00) Asia, Qyzylorda', 'Asia/Qyzylorda'),
(318, '(GMT+05:00) Asia, Samarkand', 'Asia/Samarkand'),
(319, '(GMT+05:00) Asia, Tashkent', 'Asia/Tashkent'),
(320, '(GMT+05:00) Asia, Yekaterinburg', 'Asia/Yekaterinburg'),
(321, '(GMT+05:00) Indian, Kerguelen', 'Indian/Kerguelen'),
(322, '(GMT+05:00) Indian, Maldives', 'Indian/Maldives'),
(323, '(GMT+05:30) Asia, Colombo', 'Asia/Colombo'),
(324, '(GMT+05:30) Asia, Kolkata', 'Asia/Kolkata'),
(325, '(GMT+05:45) Asia, Kathmandu', 'Asia/Kathmandu'),
(326, '(GMT+06:00) Antarctica, Vostok', 'Antarctica/Vostok'),
(327, '(GMT+06:00) Asia, Almaty', 'Asia/Almaty'),
(328, '(GMT+06:00) Asia, Bishkek', 'Asia/Bishkek'),
(329, '(GMT+06:00) Asia, Dhaka', 'Asia/Dhaka'),
(330, '(GMT+06:00) Asia, Omsk', 'Asia/Omsk'),
(331, '(GMT+06:00) Asia, Qostanay', 'Asia/Qostanay'),
(332, '(GMT+06:00) Asia, Thimphu', 'Asia/Thimphu'),
(333, '(GMT+06:00) Asia, Urumqi', 'Asia/Urumqi'),
(334, '(GMT+06:00) Indian, Chagos', 'Indian/Chagos'),
(335, '(GMT+06:30) Asia, Yangon', 'Asia/Yangon'),
(336, '(GMT+06:30) Indian, Cocos', 'Indian/Cocos'),
(337, '(GMT+07:00) Antarctica, Davis', 'Antarctica/Davis'),
(338, '(GMT+07:00) Asia, Bangkok', 'Asia/Bangkok'),
(339, '(GMT+07:00) Asia, Barnaul', 'Asia/Barnaul'),
(340, '(GMT+07:00) Asia, Ho Chi Minh', 'Asia/Ho_Chi_Minh'),
(341, '(GMT+07:00) Asia, Hovd', 'Asia/Hovd'),
(342, '(GMT+07:00) Asia, Jakarta', 'Asia/Jakarta'),
(343, '(GMT+07:00) Asia, Krasnoyarsk', 'Asia/Krasnoyarsk'),
(344, '(GMT+07:00) Asia, Novokuznetsk', 'Asia/Novokuznetsk'),
(345, '(GMT+07:00) Asia, Novosibirsk', 'Asia/Novosibirsk'),
(346, '(GMT+07:00) Asia, Phnom Penh', 'Asia/Phnom_Penh'),
(347, '(GMT+07:00) Asia, Pontianak', 'Asia/Pontianak'),
(348, '(GMT+07:00) Asia, Tomsk', 'Asia/Tomsk'),
(349, '(GMT+07:00) Asia, Vientiane', 'Asia/Vientiane'),
(350, '(GMT+07:00) Indian, Christmas', 'Indian/Christmas'),
(351, '(GMT+08:00) Asia, Brunei', 'Asia/Brunei'),
(352, '(GMT+08:00) Asia, Choibalsan', 'Asia/Choibalsan'),
(353, '(GMT+08:00) Asia, Hong Kong', 'Asia/Hong_Kong'),
(354, '(GMT+08:00) Asia, Irkutsk', 'Asia/Irkutsk'),
(355, '(GMT+08:00) Asia, Kuala Lumpur', 'Asia/Kuala_Lumpur'),
(356, '(GMT+08:00) Asia, Kuching', 'Asia/Kuching'),
(357, '(GMT+08:00) Asia, Macau', 'Asia/Macau'),
(358, '(GMT+08:00) Asia, Makassar', 'Asia/Makassar'),
(359, '(GMT+08:00) Asia, Manila', 'Asia/Manila'),
(360, '(GMT+08:00) Asia, Shanghai', 'Asia/Shanghai'),
(361, '(GMT+08:00) Asia, Singapore', 'Asia/Singapore'),
(362, '(GMT+08:00) Asia, Taipei', 'Asia/Taipei'),
(363, '(GMT+08:00) Asia, Ulaanbaatar', 'Asia/Ulaanbaatar'),
(364, '(GMT+08:00) Australia, Perth', 'Australia/Perth'),
(365, '(GMT+08:45) Australia, Eucla', 'Australia/Eucla'),
(366, '(GMT+09:00) Asia, Chita', 'Asia/Chita'),
(367, '(GMT+09:00) Asia, Dili', 'Asia/Dili'),
(368, '(GMT+09:00) Asia, Jayapura', 'Asia/Jayapura'),
(369, '(GMT+09:00) Asia, Khandyga', 'Asia/Khandyga'),
(370, '(GMT+09:00) Asia, Pyongyang', 'Asia/Pyongyang'),
(371, '(GMT+09:00) Asia, Seoul', 'Asia/Seoul'),
(372, '(GMT+09:00) Asia, Tokyo', 'Asia/Tokyo'),
(373, '(GMT+09:00) Asia, Yakutsk', 'Asia/Yakutsk'),
(374, '(GMT+09:00) Pacific, Palau', 'Pacific/Palau'),
(375, '(GMT+09:30) Australia, Darwin', 'Australia/Darwin'),
(376, '(GMT+10:00) Antarctica, DumontDUrville', 'Antarctica/DumontDUrville'),
(377, '(GMT+10:00) Asia, Ust-Nera', 'Asia/Ust-Nera'),
(378, '(GMT+10:00) Asia, Vladivostok', 'Asia/Vladivostok'),
(379, '(GMT+10:00) Australia, Brisbane', 'Australia/Brisbane'),
(380, '(GMT+10:00) Australia, Lindeman', 'Australia/Lindeman'),
(381, '(GMT+10:00) Pacific, Chuuk', 'Pacific/Chuuk'),
(382, '(GMT+10:00) Pacific, Guam', 'Pacific/Guam'),
(383, '(GMT+10:00) Pacific, Port Moresby', 'Pacific/Port_Moresby'),
(384, '(GMT+10:00) Pacific, Saipan', 'Pacific/Saipan'),
(385, '(GMT+10:30) Australia, Adelaide', 'Australia/Adelaide'),
(386, '(GMT+10:30) Australia, Broken Hill', 'Australia/Broken_Hill'),
(387, '(GMT+11:00) Antarctica, Casey', 'Antarctica/Casey'),
(388, '(GMT+11:00) Antarctica, Macquarie', 'Antarctica/Macquarie'),
(389, '(GMT+11:00) Asia, Magadan', 'Asia/Magadan'),
(390, '(GMT+11:00) Asia, Sakhalin', 'Asia/Sakhalin'),
(391, '(GMT+11:00) Asia, Srednekolymsk', 'Asia/Srednekolymsk'),
(392, '(GMT+11:00) Australia, Hobart', 'Australia/Hobart'),
(393, '(GMT+11:00) Australia, Lord Howe', 'Australia/Lord_Howe'),
(394, '(GMT+11:00) Australia, Melbourne', 'Australia/Melbourne'),
(395, '(GMT+11:00) Australia, Sydney', 'Australia/Sydney'),
(396, '(GMT+11:00) Pacific, Bougainville', 'Pacific/Bougainville'),
(397, '(GMT+11:00) Pacific, Efate', 'Pacific/Efate'),
(398, '(GMT+11:00) Pacific, Guadalcanal', 'Pacific/Guadalcanal'),
(399, '(GMT+11:00) Pacific, Kosrae', 'Pacific/Kosrae'),
(400, '(GMT+11:00) Pacific, Noumea', 'Pacific/Noumea'),
(401, '(GMT+11:00) Pacific, Pohnpei', 'Pacific/Pohnpei'),
(402, '(GMT+12:00) Asia, Anadyr', 'Asia/Anadyr'),
(403, '(GMT+12:00) Asia, Kamchatka', 'Asia/Kamchatka'),
(404, '(GMT+12:00) Pacific, Fiji', 'Pacific/Fiji'),
(405, '(GMT+12:00) Pacific, Funafuti', 'Pacific/Funafuti'),
(406, '(GMT+12:00) Pacific, Kwajalein', 'Pacific/Kwajalein'),
(407, '(GMT+12:00) Pacific, Majuro', 'Pacific/Majuro'),
(408, '(GMT+12:00) Pacific, Nauru', 'Pacific/Nauru'),
(409, '(GMT+12:00) Pacific, Norfolk', 'Pacific/Norfolk'),
(410, '(GMT+12:00) Pacific, Tarawa', 'Pacific/Tarawa'),
(411, '(GMT+12:00) Pacific, Wake', 'Pacific/Wake'),
(412, '(GMT+12:00) Pacific, Wallis', 'Pacific/Wallis'),
(413, '(GMT+13:00) Antarctica, McMurdo', 'Antarctica/McMurdo'),
(414, '(GMT+13:00) Pacific, Apia', 'Pacific/Apia'),
(415, '(GMT+13:00) Pacific, Auckland', 'Pacific/Auckland'),
(416, '(GMT+13:00) Pacific, Fakaofo', 'Pacific/Fakaofo'),
(417, '(GMT+13:00) Pacific, Kanton', 'Pacific/Kanton'),
(418, '(GMT+13:00) Pacific, Tongatapu', 'Pacific/Tongatapu'),
(419, '(GMT+13:45) Pacific, Chatham', 'Pacific/Chatham'),
(420, '(GMT+14:00) Pacific, Kiritimati', 'Pacific/Kiritimati');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_no` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `transaction_type_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `invoice_id` bigint(20) UNSIGNED DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `currency` varchar(255) DEFAULT NULL,
  `date` datetime NOT NULL,
  `due_date` timestamp NULL DEFAULT NULL,
  `paid_amount` decimal(10,2) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` enum('paid','unpaid') NOT NULL,
  `document` varchar(255) DEFAULT NULL,
  `method` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_types`
--

CREATE TABLE `transaction_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('income','expense') NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction_types`
--

INSERT INTO `transaction_types` (`id`, `type`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'income', 'From Invoice', 'from-invoice', '2024-07-08 04:56:15', '2024-07-08 04:56:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `fcm_token` varchar(255) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `account_hold` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tour_completed` tinyint(1) NOT NULL DEFAULT 0,
  `face_embedding` text DEFAULT NULL,
  `id_reference` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `role`, `email_verified_at`, `password`, `code`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `fcm_token`, `current_team_id`, `profile_photo_path`, `status`, `phone`, `address`, `department_id`, `date_of_birth`, `gender`, `account_hold`, `created_at`, `updated_at`, `tour_completed`, `face_embedding`, `id_reference`) VALUES
(1, 'Developer', 'developer_lDpnr', 'admin@fathforce.com', 'Admin', NULL, '$2y$10$czvZqdkkec.JkdrfFebvRu2jSLuN1yzOWlC70BZnX1LDO8LzBJI9u', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '082117310535', NULL, NULL, '1997-01-31', NULL, 0, '2024-03-29 03:16:38', '2024-03-29 03:20:28', 1, NULL, ''),
(2, 'Accountant', 'accountant_AJHq2', 'accountant@fathforce.com', 'Accountant', NULL, '$2y$10$BTIvBzYGIEslrY/c65os0u4II.RTkHYiHyOD.tOVOVvXFpGwTFU6i', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '1997-02-01', NULL, 0, '2024-03-29 03:16:38', '2024-03-29 03:16:38', 0, NULL, ''),
(3, 'DikerR (Teacher)', 'teacher_gYybp', 'teacher@fathforce.com', 'Teacher', NULL, '$2y$10$V7VolptK9bYRoEltUTnPS.d/dhnRCC0QooF.PApwFBX/AFExL8pxK', NULL, NULL, NULL, NULL, NULL, 'eGRqALluRRKDkIys18osLj:APA91bH1UiDN0_LpfOVpX_EZIgLtiGG0k3xVpYHlNbG6M6rPA7ka5G97l0nW28BqCMpn-TOUzppcCVuDbeAz587NLOIhX_8DwP2tN7qjmGGnHF4CR39jMjU366H6MlsWHUsezSCfUp5j', NULL, 'AcBnZAI7IUE5gR0NdrYn5vdlL3ldIc6myp7U9n7u.png', 1, '088222985307', NULL, NULL, '1995-04-22', NULL, 0, '2024-03-28 20:16:38', '2024-07-29 04:32:49', 1, '-0.009913412854075432,0.011102871969342232,-0.01211056113243103,0.0012415579985827208,-0.011022762395441532,-0.013647262938320637,0.006665652617812157,0.096102774143219,0.024758292362093925,0.16038870811462402,0.0041867089457809925,-0.0006253233295865357,0.007304886355996132,-0.011010732501745224,-0.0013146627461537719,-0.128401517868042,-0.02784734033048153,-0.013180005364120007,0.0007310988148674369,0.007369321305304766,0.31387919187545776,0.00932283978909254,-0.14428430795669556,0.006325031165033579,0.10910071432590485,0.0018969170050695539,-0.01241515576839447,0.069629967212677,0.047434572130441666,-0.08265266567468643,0.013211004436016083,-0.027362460270524025,0.10476061701774597,-0.0009780044201761484,-0.030063681304454803,-0.05967775732278824,-0.01148253120481968,0.02180493250489235,-0.007234345190227032,0.24626374244689941,-0.0035483434330672026,-0.000041979452362284064,-0.009298424236476421,-0.003469848306849599,0.0022137248888611794,0.0122773926705122,-0.25397804379463196,0.16553302109241486,0.0025279177352786064,-0.026162417605519295,-0.054738692939281464,0.0007139145745895803,-0.13189592957496643,0.0016577886417508125,0.008331616409122944,0.005249992478638887,-0.1347775161266327,0.0020871302112936974,-0.030125226825475693,0.0015951282111927867,-0.005637181922793388,-0.017886033281683922,0.003042137250304222,0.06522341072559357,-0.004687889479100704,0.025537991896271706,-0.003290980588644743,-0.020796529948711395,0.0058455439284443855,-0.004124943166971207,-0.009273562580347061,-0.4266420304775238,0.024325726553797722,0.010164466686546803,-0.01461609173566103,-0.00938671175390482,-0.008561888709664345,0.0010556874331086874,-0.11509572714567184,-0.010402868501842022,0.005456734914332628,-0.0833967849612236,-0.011132195591926575,0.16443808376789093,-0.011036005802452564,0.004931888543069363,-0.0036071287468075752,0.009604071266949177,-0.014852005988359451,0.1456679403781891,-0.16402451694011688,0.0016212996561080217,-0.013570629060268402,-0.0043078092858195305,-0.09323665499687195,0.22138234972953796,-0.02910643257200718,0.03195009380578995,-0.007814468815922737,0.011281975544989109,0.0030309532303363085,0.004452745895832777,-0.0033725786488503218,0.002384836319833994,-0.003992261365056038,0.002199165988713503,-0.021591439843177795,0.008008998818695545,-0.0010725765023380518,0.0036757534835487604,-0.052635688334703445,0.00043673301115632057,-0.003053606953471899,-0.2046358734369278,0.0034083647187799215,-0.12473595887422562,0.012200959958136082,-0.019906511530280113,0.0672605037689209,-0.07125560939311981,-0.08722550421953201,0.0032324972562491894,-0.004276744555681944,0.0008010162855498493,0.0024808996822685003,0.00525521719828248,0.004476839676499367,0.005222701001912355,0.009063677862286568,0.06280294060707092,0.0002061854029307142,0.0005917923990637064,0.003107719589024782,0.0593547523021698,0.0032033491879701614,-0.0026130308397114277,-0.08875733613967896,0.03476831689476967,-0.0034653411712497473,-0.00040857205749489367,0.0029797847382724285,-0.0007837049779482186,0.009737076237797737,-0.1848163604736328,0.061595454812049866,-0.013012414798140526,0.0019434726564213634,-0.00012124144996050745,0.005608636420220137,0.014684716239571571,-0.0009770868346095085,-0.0671667531132698,0.14804069697856903,-0.008040281012654305,0.0022179805673658848,0.004703990183770657,-0.003211831673979759,0.0025971343275159597,0.0038199229165911674,-0.002490977058187127,0.001302222372032702,0.0041821859776973724,0.009254132397472858,-0.004852617625147104,0.005173447076231241,0.0015761370304971933,-0.00037911086110398173,0.07120906561613083,-0.005721777677536011,-0.0018706847913563251,0.007546156644821167,0.03968699648976326,-0.0006098374142311513,0.05648678168654442,-0.0024273337330669165,-0.003874928690493107,-0.005670672282576561,0.0009692997555248439,-0.003948399797081947,-0.008148666471242905,-0.054973479360342026,0.20627939701080322,0.002671901136636734,0.0010990541195496917,0.004149323329329491,0.01570923626422882,0.12198898941278458,-0.01072770543396473,0.09881631284952164,0.06213197484612465,-0.018026385456323624,0.0012381542474031448', '251005'),
(4, 'Parent', 'parent_65Ej9', 'parent@fathforce.com', 'Parent', NULL, '$2y$10$JAUBXYC6V0H8nuP1r9YMEussPaqD2CFXRIfieHTeTykocQrTSZYQa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '8721338', NULL, NULL, '1996-01-30', NULL, 0, '2024-03-29 03:16:38', '2024-03-29 03:16:38', 0, NULL, ''),
(5, 'Fadjhart (Student)', 'student_xjmkd', 'student@fathforce.com', 'Student', NULL, '$2y$10$V7VolptK9bYRoEltUTnPS.d/dhnRCC0QooF.PApwFBX/AFExL8pxK', NULL, NULL, NULL, NULL, NULL, 'cih8Fdh5RMihs5WmKYvTOY:APA91bH8-8_pVbKiAeYRFTuwaHScdv5--mvB77MZ7BNAnAHS_U5uVPS9tkgsE4eksT8JmrHNkBcQkfZaHeta8dTdijSGYNorboHwA0dD6MJJ5dPFiuFCxIqmmKSsIGYpppaTzfIx-Dup', NULL, 'CeFq5AIv41MUZevL56STyFTgSor0zQ9pOFZfLRQv.jpg', 1, '', 'Mars', NULL, '1996-01-25', 'Hamburger', 0, '2024-03-29 03:16:39', '2024-07-29 03:38:25', 0, '-0.024254746735095978,0.03754187375307083,0.012477056123316288,-0.0049192639999091625,-0.058607056736946106,0.038393933326005936,-0.09834159910678864,-0.030344786122441292,-0.18464963138103485,-0.0029299771413207054,-0.015594910830259323,0.009849152527749538,0.002692000474780798,0.027436815202236176,-0.0010761064477264881,-0.054252151399850845,-0.02452601119875908,-0.007677935529500246,0.006766755133867264,0.000075300078606233,-0.13365517556667328,0.1146664172410965,-0.22151699662208557,0.013939586468040943,0.05163060873746872,0.025119557976722717,-0.04684064909815788,-0.0586036741733551,0.08222389221191406,-0.12207067012786865,0.0015854412922635674,0.12475880235433578,0.15112407505512238,-0.004681956488639116,-0.10860077291727066,0.030467787757515907,0.05155925452709198,-0.005844200495630503,-0.0023900463711470366,0.012637177482247353,0.006287001073360443,0.0020900156814604998,0.005807891022413969,-0.013471551239490509,0.009177369065582752,-0.04454588517546654,-0.054967112839221954,-0.03857718035578728,-0.008374328725039959,0.09744562953710556,-0.05510153993964195,-0.0063812583684921265,-0.25197815895080566,-0.004960439633578062,-0.03390566259622574,0.00888022780418396,-0.01439692173153162,0.0031361805740743876,-0.09085763990879059,0.030576040968298912,0.044039275497198105,-0.07712675631046295,0.054822515696287155,0.21502041816711426,-0.015836985781788826,0.008931171149015427,-0.007674576714634895,0.0017903208499774337,0.002144629368558526,0.003922434989362955,-0.03362679108977318,-0.24566616117954254,0.14410905539989471,0.010570296086370945,-0.2036774605512619,0.012777911499142647,0.0012567572994157672,-0.001076398533768952,0.18148575723171234,0.2312941551208496,-0.0018156496807932854,-0.008576412685215473,-0.012643605470657349,0.08091609925031662,-0.09263905882835388,0.00026104069547727704,0.001153283752501011,0.11429663002490997,-0.0023333625867962837,0.024779994040727615,-0.11968852579593658,0.011841144412755966,0.008984403684735298,-0.02212846465408802,-0.2287486493587494,-0.05246809497475624,-0.05356487259268761,0.13517875969409943,-0.003339954884722829,0.012737707234919071,0.0030840723775327206,-0.007370279170572758,-0.0054567609913647175,-0.0033180194441229105,0.0022663921117782593,0.007265483494848013,-0.11468599736690521,0.0003408660413697362,0.00543085066601634,0.0244290791451931,-0.03704296797513962,0.011252733878791332,0.0007286556647159159,0.10761056840419769,0.012386215850710869,-0.029448803514242172,0.004369628150016069,-0.029299098998308182,0.12724028527736664,0.0550236813724041,0.11892057210206985,0.008828507736325264,-0.048639725893735886,-0.00020908516307827085,0.00031674830825068057,0.0014197888085618615,0.008151626214385033,-0.004464303608983755,0.01008350308984518,0.004058504942804575,0.015341907739639282,0.02026309072971344,-0.005305207800120115,0.04521782696247101,0.08795711398124695,-0.013153482228517532,-0.1970568746328354,-0.06764113157987595,-0.00041114658233709633,0.00853725615888834,0.0013992775930091739,-0.0013971098233014345,0.001879713498055935,0.026367854326963425,-0.0608682818710804,0.11891821026802063,0.00407600961625576,-0.0018267009872943163,0.0061472696252167225,-0.003411991521716118,-0.019490882754325867,0.027740616351366043,0.04605230689048767,-0.03775028884410858,-0.0010657847160473466,-0.00007700316200498492,0.018921861425042152,0.01809137500822544,-0.158237025141716,-0.0030920992139726877,-0.042567744851112366,0.004885571543127298,-0.012330308556556702,-0.0030280123464763165,0.0052298191003501415,0.02171175181865692,0.015851978212594986,-0.016590727493166924,-0.008902395144104958,0.004021186847239733,0.037951283156871796,0.01231746282428503,-0.0034615756012499332,-0.05742531269788742,0.01596752367913723,0.0007228539907373488,-0.031410980969667435,-0.10477327555418015,-0.010272437706589699,0.0009071720414794981,-0.19433772563934326,0.00993937999010086,-0.0017477622022852302,-0.00532882334664464,0.10398244857788086,0.13013359904289246,0.001425368245691061,0.1335325837135315,0.1341615915298462,-0.04302165284752846,-0.06862642616033554,-0.005047240294516087', '182731298398721'),
(294, 'Drs. OMAN SURATMAN', 'drs-oman-suratman_z6EsB', '1146_tech@gmail.com', 'Teacher', NULL, '$2y$10$sBufR6wFo18L5iaArKkYi.wqS18v6dukD6By//Ghe1SPAN8jL9OBi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '000', NULL, NULL, NULL, NULL, 0, '2024-07-24 08:02:23', '2024-07-25 03:21:19', 0, NULL, NULL),
(331, 'Drs. ENCAR SETIANA, M.Pd.', 'drs-encar-setiana-mpd_1PhOx', '1145_tech@gmail.com', 'Teacher', NULL, '$2y$10$8Djen.qeG7JX3Np44oqKD.IjXAqvK/F8bQMOHqdCYOgSh9wCHACBW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '012345', NULL, NULL, NULL, NULL, 0, '2024-07-24 08:08:06', '2024-07-25 03:20:44', 0, NULL, NULL),
(332, 'Hj. EMPOY SUPARTINI, S.Pd.', 'hj-empoy-supartini-spd_s62K0', '1144_tech@gmail.com', 'Teacher', NULL, '$2y$10$JXHTna.bza64aqODItKG8.OgkOPbdP7ibOYT7ef0luJe4.bDMwM5W', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '000', NULL, NULL, NULL, NULL, 0, '2024-07-24 08:15:35', '2024-07-25 03:20:10', 0, NULL, NULL),
(369, 'ENDANG IDRIS SUKMANA, M.Pd.', 'endang-idris-sukmana-mpd_3t6nu', '1143_tech@gmail.com', 'Teacher', NULL, '$2y$10$JU8pfxUsu/n/3eJu8eh7EO0cpCGY3DlnHbirp02T45ztL4o1clZH.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '000', NULL, NULL, NULL, NULL, 0, '2024-07-24 08:18:19', '2024-07-25 03:19:32', 0, NULL, NULL),
(370, 'Drs. H. YAYAT SUDRAJAT', 'drs-h-yayat-sudrajat_MxZXg', '1142_tech@gmail.com', 'Teacher', NULL, '$2y$10$vYPS2ZI7r4QyaUXuJBXyTO21J63G2XSG2ACgck18WjWKIRg4nSIQu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '09876', NULL, NULL, NULL, NULL, 0, '2024-07-24 08:23:24', '2024-07-25 03:17:06', 0, NULL, NULL),
(371, 'ACIH SUTARSIH, M.Pd.', 'acih-sutarsih-mpd_MT6PZ', '1141_tech@gmail.com', 'Teacher', NULL, '$2y$10$0guHlEMH2z.PJ17jGUUT9.7bYyU2s8beMizP8lUAjYAJklyoLBEjy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '08976', NULL, NULL, NULL, NULL, 0, '2024-07-24 08:31:58', '2024-07-25 03:15:35', 0, NULL, NULL),
(372, 'E J I, S.Ag., M.Pd.I.', 'e-j-i-sag-mpdi_Kw1Jo', '1140_tech@gmail.com', 'Teacher', NULL, '$2y$10$lnWMx8A2B66.c801JubrluUyn0sB5ODwDVJyP/q9KvnzQxhkiINPW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '0896547', NULL, NULL, NULL, NULL, 0, '2024-07-24 08:36:53', '2024-07-25 03:14:39', 0, NULL, NULL),
(373, 'TITIEN MULYASIH, S.Pd.', 'titien-mulyasih-spd_Js3cC', '1139_tech@gmail.com', 'Teacher', NULL, '$2y$10$h.ri.MUDr7PANhu7bo6c6.5tCJyo9r9iSQruExYJisjVADmzLWFWS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '097865', NULL, NULL, NULL, NULL, 0, '2024-07-24 08:39:04', '2024-07-25 03:12:58', 0, NULL, NULL),
(374, 'DEDE HERNADI, M.Pd.', 'dede-hernadi-mpd_JGoKP', '1138_tech@gmail.com', 'Teacher', NULL, '$2y$10$rRjoqKFeQykqVCAYjCCNB.WXBTYfSZoPL00vV5GIdMsdW61cv3E6K', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '072526474', NULL, NULL, NULL, NULL, 0, '2024-07-24 08:43:42', '2024-07-25 03:12:29', 0, NULL, NULL),
(375, 'DADANG MULYANA, M.Kom.', 'dadang-mulyana-mkom_LUhFh', '1137_tech@gmail.com', 'Teacher', NULL, '$2y$10$hezJzeGvXRs/.pLMq.9wau5n5ju6mdhP..sLZwdvcG5nz0/rOI6QK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '0526378', NULL, NULL, NULL, NULL, 0, '2024-07-24 08:46:28', '2024-07-25 03:11:52', 0, NULL, NULL),
(376, 'RONI SUNANDAR, M.Kom.', 'roni-sunandar-mkom_8c40B', '1136@gmail.com', 'Teacher', NULL, '$2y$10$GGAbO/gPSyKL5LF6nYj5He.ei2/E2oLjoAsyPvZt1jv7gpLcH7djO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '0253681', NULL, NULL, NULL, NULL, 0, '2024-07-24 08:48:43', '2024-07-25 03:11:13', 0, NULL, NULL),
(377, 'ELIN HERLINA, S.Pd.', 'elin-herlina-spd_fha0V', '1135_tech@gmail.com', 'Teacher', NULL, '$2y$10$uulHuI3GeJLjq9E2Bw5zZe4NHN3MLUBoCA313lX29dehrK3TDc9ZW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '02645178', NULL, NULL, NULL, NULL, 0, '2024-07-24 08:50:32', '2024-07-25 03:10:33', 0, NULL, NULL),
(378, 'CECE NURHIDAYAT, S.Pd.', 'cece-nurhidayat-spd_6ypyd', '1134@gmail.com', 'Teacher', NULL, '$2y$10$qzypd2luJPYkUt4sqyXlvu9BLyPb8ceL2X30UGtYplQSKrwzvAL3i', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '0328263', NULL, NULL, NULL, NULL, 0, '2024-07-24 08:56:51', '2024-07-25 03:09:48', 0, NULL, NULL),
(415, 'YUSUP, S.Pd., M.Pd.', 'yusup-spd-mpd_CegkB', '1133_tech@gmail.com', 'Teacher', NULL, '$2y$10$dZsY0XxiMnfoqitrUD4vF.EOAf0iDQrXBgEVAlThJIBZXCNxWmoyW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '0874956', NULL, NULL, NULL, NULL, 0, '2024-07-24 09:02:22', '2024-07-25 03:09:13', 0, NULL, NULL),
(1182, 'TETI NOVIANTI, S.Pd.', 'teti-novianti-spd_GKSY8', '1132_tech@gmail.com', 'Teacher', NULL, '$2y$10$z8i6h5dTOxMPGLaEK8M.1.ggsCNaRwBS7ob2W/QhRh66CmQzX2oP.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '0', NULL, NULL, NULL, NULL, 0, '2024-07-24 12:25:15', '2024-07-25 03:08:25', 0, NULL, NULL),
(1183, 'JAJAT SUDRAJAT, S.ST.', 'jajat-sudrajat-sst_NhcCx', '1131_tech@gmail.com', 'Teacher', NULL, '$2y$10$eytgoQZRHW6miBZ.DJV32.jlnkGxgmqPzWpZ.96N6r2ohXCLwYjGi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '0', NULL, NULL, NULL, NULL, 0, '2024-07-24 12:37:44', '2024-07-25 03:07:38', 0, NULL, NULL),
(1184, 'ANGGA SUCIA UMBARA, S.Pd.', 'angga-sucia-umbara-spd_4dcpi', '1130_tech@gmail.com', 'Teacher', NULL, '$2y$10$/ZyO6C4Fph7MtnLxuUk/nOGaYNKtC1PCE6ZqfzWTsEqBkLVoNG/Lm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '0', NULL, NULL, NULL, NULL, 0, '2024-07-24 12:46:59', '2024-07-25 03:06:22', 0, NULL, NULL),
(1185, 'ANGGA GUMILAR, S.T.', 'angga-gumilar-st_9pkNi', '1129_tech@gmail.com', 'Teacher', NULL, '$2y$10$UpBPgLlz.ce/H23UWAok.e7G5VlYQMGkrfXoUngNoGssS5xcVr9Mu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '0', NULL, NULL, NULL, NULL, 0, '2024-07-24 13:00:45', '2024-07-25 03:05:41', 0, NULL, NULL),
(1186, 'ARIF WICAKSONO, S.Pd.', 'arif-wicaksono-spd_oWtMT', '1128_tech@gmail.com', 'Teacher', NULL, '$2y$10$dhdlsnpk9jmvbT5yiLOF7OA5jU68dSZNO4lTE6u4tpa51UZfUaDhy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '0', NULL, NULL, NULL, NULL, 0, '2024-07-24 13:03:51', '2024-07-25 03:04:48', 0, NULL, NULL),
(1187, 'ENI KUSNAENI, S.Pd., M.M.', 'eni-kusnaeni-spd-mm_GJE4v', '1127_tech@fathforce.com', 'Teacher', NULL, '$2y$10$pRTitamubpb91P67XWOPGuPiBixAQVNATos1VSTDqNeLm06anVDjC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '0', NULL, NULL, NULL, NULL, 0, '2024-07-24 13:06:05', '2024-07-25 03:04:13', 0, NULL, NULL),
(1188, 'KHOERIAH NUR WAHIDAH, S.Pd.', 'khoeriah-nur-wahidah-spd_0KFww', '1126_tech@fathforce.com', 'Teacher', NULL, '$2y$10$sIkxk88.E5jmjMlk0kJItu0vghARuQuncSQBFE3B8m1CJNSjioxAy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '0', NULL, NULL, NULL, NULL, 0, '2024-07-24 13:07:48', '2024-07-25 03:02:44', 0, NULL, NULL),
(1189, 'DADANG KADARISMAN, S.Pd.', 'dadang-kadarisman-spd_LJ7k1', '1125_tech@fathforce.com', 'Teacher', NULL, '$2y$10$eIolCXxOw2hIxaH24z1r6O35aG3kr7GcFnwIRjFcv0tN9sDhreoDO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '0', NULL, NULL, NULL, NULL, 0, '2024-07-24 13:13:31', '2024-07-25 03:02:02', 0, NULL, NULL),
(1190, 'NENG TATI ERLINA, S.Pd.', 'neng-tati-erlina-spd_QyNdS', '1124_tech@fathforce.com', 'Teacher', NULL, '$2y$10$jkkgwLGSQ08q3Txx8wG93OX6CtBIIb4Hs30EhgwPF3P7vzrgV6y9O', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '0', NULL, NULL, NULL, NULL, 0, '2024-07-24 13:16:02', '2024-07-25 03:00:03', 0, NULL, NULL),
(1191, 'ADE MAYA NELASARI, S.Pd.', 'ade-maya-nelasari-spd_PsLeN', '1123_tech@fathforce.com', 'Teacher', NULL, '$2y$10$i.1l.ECa88e66L1VNxEZxupHXjdNGdO6SMa0tW8uUgduPnqzR6uaS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '0', NULL, NULL, NULL, NULL, 0, '2024-07-24 13:20:20', '2024-07-25 02:59:10', 0, NULL, NULL),
(1192, 'MIA PRAJAWASTUTI, S.Pd.', 'mia-prajawastuti-spd_xptPH', '1122_tech@fathforce.com', 'Teacher', NULL, '$2y$10$ud6TMgYNqcYw184T3bOZWuAlewbA2a9rvTVrHjxevah2OOfmUM/Mm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '0', NULL, NULL, NULL, NULL, 0, '2024-07-24 13:22:43', '2024-07-25 02:58:25', 0, NULL, NULL),
(1193, 'DADANG NURDIANA, S.Pd.', 'dadang-nurdiana-spd_5Mm8A', '1121_tech@fathforce.com', 'Teacher', NULL, '$2y$10$7HhRoWeiwV6KwkBr.CZX0eIPY6EXBAlRy5XkIcMHx/RyFcVigSlwy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '0', NULL, NULL, NULL, NULL, 0, '2024-07-24 13:24:25', '2024-07-25 02:56:39', 0, NULL, NULL),
(1194, 'TUTI FITRIYAH, S.Pd.', 'tuti-fitriyah-spd_WK16L', '1120_tech@fathforce.com', 'Teacher', NULL, '$2y$10$1hPE6BRtT2QyIS45cUCx9uhkOzsB6ef5eh5Cg.I12cUFiTIwgWIxW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '0', NULL, NULL, NULL, NULL, 0, '2024-07-24 13:27:15', '2024-07-25 02:55:44', 0, NULL, NULL),
(1195, 'INDRA HADIDI, S.T.', 'indra-hadidi-st_Kgakd', '1110_tech@fathforce.com', 'Teacher', NULL, '$2y$10$niuqxcCu4p5DYjHSAB6F/uo47fU2bkLpvb96GUWRxTdq5QTI2B2.m', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '0', NULL, NULL, NULL, NULL, 0, '2024-07-24 13:28:49', '2024-07-25 02:50:43', 0, NULL, NULL),
(1196, 'MARIANA DWI NURMAELA, S.Pd.', 'mariana-dwi-nurmaela-spd_7w6pT', '1119_tech@fathforce.com', 'Teacher', NULL, '$2y$10$xSr4F6KBg/bR8MEE6oed/.DGnQ5bTmvnKpFYdp5FGZd24gA39Uwse', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '0', NULL, NULL, NULL, NULL, 0, '2024-07-24 13:30:26', '2024-07-25 02:48:38', 0, NULL, NULL),
(1197, 'AGUS MULYA HELIADIN, S.T.', 'agus-mulya-heliadin-st_lFwms', '1118_tech@fathforce.com', 'Teacher', NULL, '$2y$10$Ko9mzos90adCK.Pxufs1.OxUJGthEqhxL5Uf5nco7gFJT5BnSBITK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '0', NULL, NULL, NULL, NULL, 0, '2024-07-24 13:32:40', '2024-07-25 02:47:56', 0, NULL, NULL),
(1198, 'IKA RISKAWATI, S.Pd.', 'ika-riskawati-spd_vyMEz', '1117_tech@fathforce.com', 'Teacher', NULL, '$2y$10$olB2qRl7moFqjrLK7K1Dk.B5zaV4FoUSDCOUqG7j47YnppnVzlyhu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '0', NULL, NULL, NULL, NULL, 0, '2024-07-24 13:35:48', '2024-07-25 02:46:53', 0, NULL, NULL),
(1199, 'ULUS LUSDIANA, S.Pd.', 'ulus-lusdiana-spd_TBo8v', '1116_tech@fathforce.com', 'Teacher', NULL, '$2y$10$laEn0ofwPegkTgWS/PKlhuCxKs1fYUY29esSreA82RCVYiFAC4wKa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '0', NULL, NULL, NULL, NULL, 0, '2024-07-24 13:39:19', '2024-07-25 03:31:31', 0, NULL, NULL),
(1200, 'NURDIN RISMANSYAH, S.T.', 'nurdin-rismansyah-st_SPREL', '1115_tech@fathforce.com', 'Teacher', NULL, '$2y$10$CE9KVOk6HGDWXud6ix4ZUu5CJGKPxFbS63HhcfTI2CMmOOzORXehS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '0', NULL, NULL, NULL, NULL, 0, '2024-07-24 13:40:24', '2024-07-25 02:44:20', 0, NULL, NULL),
(1201, 'YAYU ZULIANTINI, S.Pd.', 'yayu-zuliantini-spd_I8wn8', '1114_tech@fathforce.com', 'Teacher', NULL, '$2y$10$Ysm0x3BAia.CXdUtFb5ouO8EF7NmkccxY67fBYgzCOn/sWpPIrPzm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '0', NULL, NULL, NULL, NULL, 0, '2024-07-24 13:48:53', '2024-07-25 02:42:59', 0, NULL, NULL),
(1202, 'YANI HANDAYANI, S.Pd.', 'yani-handayani-spd_0vuEy', '1113_tech@fathforce.com', 'Teacher', NULL, '$2y$10$fPVoB5AcgXvfkHsHCSr67ekHHBLjs.4TZp.OEqwS6to7afTMw5EWy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '09825226', NULL, NULL, NULL, NULL, 0, '2024-07-25 01:27:32', '2024-07-25 02:42:35', 0, NULL, NULL),
(1203, 'FARID MA’RUF, M.Pd.', 'farid-maruf-mpd_kib3v', '1112_tech@fathforce.com', 'Teacher', NULL, '$2y$10$CLxgOfVOrXlmOMPFvisUSep3GW9gDyUKwqGtWtX5hZUYekLKVI86C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '073624716', NULL, NULL, NULL, NULL, 0, '2024-07-25 01:40:01', '2024-07-25 02:42:10', 0, NULL, NULL),
(1204, 'YANTO SUPRIYANTO, S.Kom.', 'yanto-supriyanto-skom_Oxxwh', '1111_tech@gmail.com', 'Teacher', NULL, '$2y$10$RN4PoCnYa5.zKe3qp14mnOzLXQssdiPkgl.43eFv9cWFaboJd.zh2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '00887536', NULL, NULL, NULL, NULL, 0, '2024-07-25 01:44:45', '2024-07-25 02:23:29', 0, NULL, NULL),
(1409, 'DIAN SEDIANA, M.Kom.', 'dian-sediana-mkom_hiWgj', '1147_tech@gmail.com', 'Teacher', NULL, '$2y$10$NvOnWkw2qXlSvk7a5oG0kuZDfjliBvH49o/OS.Gd40XZbrtdeH/MS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '098', NULL, NULL, NULL, NULL, 0, '2024-07-25 03:28:09', '2024-07-25 03:28:09', 0, NULL, NULL),
(1410, 'INE SUSIYANA, S.Pd.', 'ine-susiyana-spd_kOfVq', '1148_tech@gmail.com', 'Teacher', NULL, '$2y$10$B/9btwhutMA9qWhNYJIJb.m3CtKTjomSkyt/Gl5/LzJP6LK7cpSNO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '09878', NULL, NULL, NULL, NULL, 0, '2024-07-25 03:30:38', '2024-07-25 03:30:38', 0, NULL, NULL),
(1411, 'NONO SUARNO, S.ST.', 'nono-suarno-sst_rW2Qs', '1149_tech@gmail.com', 'Teacher', NULL, '$2y$10$gd39Hxx/VOpcL5h/pFvGWuFvwrCPBdjZXfa20TGDO5z3DhfLge0Ha', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '0897', NULL, NULL, NULL, NULL, 0, '2024-07-25 03:55:55', '2024-07-25 03:55:55', 0, NULL, NULL),
(1412, 'DIAH MARGARETHA TIOFANY, M.Pd.', 'diah-margaretha-tiofany-mpd_pQV9i', '1150_tech@gmail.com', 'Teacher', NULL, '$2y$10$S4p.mvLE5S8EQqRTIo8eV.TK9d9m.g6UVae03O9Srom0iT4mt1TvC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '0769', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:00:04', '2024-07-25 04:01:13', 0, NULL, NULL),
(1413, 'AJI PRASETYA WIBISONO, S.Pd.', 'aji-prasetya-wibisono-spd_IwoRt', '1151_tech@gmail.com', 'Teacher', NULL, '$2y$10$6q7emxEW0EGk6nfJQRwPhOlHdsMcWuRWGPoH5rIfeIjKpjJ.WtsPe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '0985', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:03:10', '2024-07-25 04:03:10', 0, NULL, NULL),
(1414, 'ANGGA GUMILAR, S.T.', 'angga-gumilar-st_gZLQZ', '1152_tech@gmail.com', 'Teacher', NULL, '$2y$10$zeFS6HA3zPYrhCHnIj8ZtuPQmhYnB.rHQGhIoXVDFqkIEJz2NEtCK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '08967', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:05:05', '2024-07-25 04:05:05', 0, NULL, NULL),
(1415, 'ISYE AISYAH, S.Pd.', 'isye-aisyah-spd_1Fa6H', '1153_tech@gmail.com', 'Teacher', NULL, '$2y$10$MMDL4RsnB/m7JfaFG1rCyuyIs.KM/0k6pNqFvWwhJ/VUbtF/iiZVe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '0679', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:08:27', '2024-07-25 04:08:27', 0, NULL, NULL),
(1450, 'ABU BAKAR, S.T.', 'abu-bakar-st_Qw9ES', '1154_tech@gmail.com', 'Teacher', NULL, '$2y$10$0p6AmtNfbBlYR1hRRzF4IOfAvJTrRR5nS0rv8fLFIVzhK98j24muO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '0567', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:16:36', '2024-07-25 04:17:51', 0, NULL, NULL),
(1452, 'AFGAN FAISAL', 'afgan-faisal_aBgYv', '2143_tech@fathforce.com', 'Student', NULL, '$2y$10$qCLTHacT4qNkm6mhn7EuiuF1Jwgad82B2qzYOgSTd/OPVgZOYP8nm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:19:28', '2024-07-25 04:19:28', 0, NULL, NULL),
(1453, 'AHMAD FAHRIJI', 'ahmad-fahriji_byhIW', '2144_tech@fathforce.com', 'Student', NULL, '$2y$10$LbnaQpM/XeCWtbIs84kzSef9G91jnh5dOQUIf1svf1kPDIgu9T5fG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:19:28', '2024-07-25 04:19:28', 0, NULL, NULL),
(1454, 'ALFIN SAPUTRA', 'alfin-saputra_51Mzu', '2145_tech@fathforce.com', 'Student', NULL, '$2y$10$2s/UuvDB7FMkJGQuEURMpOZc5b9isBPYNOlP7fCfAWVkAI9sCxcdS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:19:28', '2024-07-25 04:19:28', 0, NULL, NULL),
(1455, 'ANDI AKBAR MAULANA', 'andi-akbar-maulana_uEzy8', '2146_tech@fathforce.com', 'Student', NULL, '$2y$10$FlwDiA7TaKLEnz9EFnoS0uPQAccQovANJG8.Ik1h9/fWYdu3ZfW/S', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:19:28', '2024-07-25 04:19:28', 0, NULL, NULL),
(1456, 'AZIZ AWALUDIN', 'aziz-awaludin_vygPO', '2147_tech@fathforce.com', 'Student', NULL, '$2y$10$5xDjHNUpq8uJ4ry5UfaNrO/e/ZGnhUQblZkLCst4I4Bvn1SsC6yXG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:19:28', '2024-07-25 04:19:28', 0, NULL, NULL),
(1457, 'DESFITRA DWI PURNAMA', 'desfitra-dwi-purnama_tuZyO', '2148_tech@fathforce.com', 'Student', NULL, '$2y$10$P8LXrH9V4cZQ3zNIf7Y7bOw5Z4KWeY34T20FYeIybyfe/f60D9PlS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:19:28', '2024-07-25 04:19:28', 0, NULL, NULL),
(1458, 'DEVIAN JANWAR', 'devian-janwar_xp9EI', '2149_tech@fathforce.com', 'Student', NULL, '$2y$10$6qGRsyBODeNmiP1Gw6nZnOqqWT3T/8ZixXvvoR49nSnasXG5oXbEm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:19:28', '2024-07-25 04:19:28', 0, NULL, NULL),
(1459, 'ERLANGGA', 'erlangga_0om1P', '2150_tech@fathforce.com', 'Student', NULL, '$2y$10$znyTAfWIiM9XpR1qlQ3qMOsnh6eyX9ndNgjJPw0j3II8Qb3c2sWiS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:19:28', '2024-07-25 04:19:28', 0, NULL, NULL),
(1460, 'FAIZ ISMAIL', 'faiz-ismail_S6QDb', '2151_tech@fathforce.com', 'Student', NULL, '$2y$10$MT7hecFUwveUpjFPUh/9JuQKo6nJGvXnzl8OUeoogkqzkbtkoGGx6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:19:28', '2024-07-25 04:19:28', 0, NULL, NULL),
(1461, 'HABIL NUR MUGHNIY', 'habil-nur-mughniy_QAgeC', '2152_tech@fathforce.com', 'Student', NULL, '$2y$10$uCTiii3blYQEw8vfML2OeuYnGw4PyHTJntohefXpooH5Qv0SX6NHq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:19:28', '2024-07-25 04:19:28', 0, NULL, NULL),
(1462, 'HOILUL ROHMAN', 'hoilul-rohman_he4l3', '2153_tech@fathforce.com', 'Student', NULL, '$2y$10$ADPUiiUk5Kgj7rr2ukrFn.pZY0UpHPda7krKl6HPag2WStM.sUjb.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:19:28', '2024-07-25 04:19:28', 0, NULL, NULL),
(1463, 'INTAN SYINTYA NAZWA', 'intan-syintya-nazwa_iOprh', '2154_tech@fathforce.com', 'Student', NULL, '$2y$10$XA4BZmjGMeL2xytoZlfTQ.ClUCgtBevkhtpKDuHdDvWiF8.bK09Mm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:19:29', '2024-07-25 04:19:29', 0, NULL, NULL),
(1464, 'JENI JULIANSYAH', 'jeni-juliansyah_8KROi', '2155_tech@fathforce.com', 'Student', NULL, '$2y$10$MrhRQ93OYcnFmn0oUvzam.LhAue.MOVo7hJbVzBWDMAGd29EFZmeS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:19:29', '2024-07-25 04:19:29', 0, NULL, NULL),
(1465, 'JULIA ZEFANYA AMARIA ALKATAR', 'julia-zefanya-amaria-alkatar_TLIpu', '2156_tech@fathforce.com', 'Student', NULL, '$2y$10$ZyqUJWJmA3OZ3mjaYooStO8xZs0BeTluoD2i6Co4bw1vGhmHMwsJa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:19:29', '2024-07-25 04:19:29', 0, NULL, NULL),
(1466, 'KALISA RAMADANI', 'kalisa-ramadani_4rVIh', '2157_tech@fathforce.com', 'Student', NULL, '$2y$10$6NNPbHJn7Y8Xd45ZyJEzae/82Fe7THILTm/aIpe/bf16FL92TweTW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:19:29', '2024-07-25 04:19:29', 0, NULL, NULL),
(1467, 'LUKI RAMADANA', 'luki-ramadana_FjatT', '2158_tech@fathforce.com', 'Student', NULL, '$2y$10$yhtdvIUcASIs.6bFqwEY4.DFUAeSqLAOThUay5sORW6f5XK8VuttW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:19:29', '2024-07-25 04:19:29', 0, NULL, NULL),
(1468, 'LUTFI ALFIANA', 'lutfi-alfiana_N6bUa', '2159_tech@fathforce.com', 'Student', NULL, '$2y$10$tw1jRi.uDQRNFuCg86L/9.9SLvhE4y92/EfuLhkYJd7KCmScbVk9q', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:19:29', '2024-07-25 04:19:29', 0, NULL, NULL),
(1469, 'MILA SITI BAROKAH', 'mila-siti-barokah_QWaVV', '2160_tech@fathforce.com', 'Student', NULL, '$2y$10$37fsRnaVmqmB8QhaxsGHC.pET2ogqRMa.bZ8sNBvlx.HT9eMmTDdm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:19:29', '2024-07-25 04:19:29', 0, NULL, NULL),
(1470, 'MOCH IRFAN HASAN AS\'ARI', 'moch-irfan-hasan-asari_iBqn9', '2161_tech@fathforce.com', 'Student', NULL, '$2y$10$HWiiwThn8w.J8wTXuFWg8uzs5aM00co19CVAhinn8OWtHvGZ83xHa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:19:29', '2024-07-25 04:19:29', 0, NULL, NULL),
(1471, 'MUHAMAD IQBAL ADESTIA', 'muhamad-iqbal-adestia_htBbv', 'icSb2161_tech@fathforce.com', 'Student', NULL, '$2y$10$1DI5P9Rnu0JTFOUEr4TXye0NhLmlXaUU6mt5lnsKxCGCu0dnj4Fci', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:19:29', '2024-07-25 04:19:29', 0, NULL, NULL),
(1472, 'NIDA NURWAHIDAH', 'nida-nurwahidah_yeOsG', '2162_tech@fathforce.com', 'Student', NULL, '$2y$10$1dDd5JsRnRDrmDmr0QWzLu4Rr.Zwp..pBznOZWKe4oFcA4skc68ui', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:19:29', '2024-07-25 04:19:29', 0, NULL, NULL),
(1473, 'NITA TALIA', 'nita-talia_M4vyJ', '2163_tech@fathforce.com', 'Student', NULL, '$2y$10$pm4x4udGq48znq3x5AN3luVmNDq5TpsvexweNMdW9.UkI3aXPVQ/m', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:19:29', '2024-07-25 04:19:29', 0, NULL, NULL),
(1474, 'RANI MULYANI', 'rani-mulyani_HQTA4', '2164_tech@fathforce.com', 'Student', NULL, '$2y$10$FuY9APnStUC7D9ev/ULgt.9SAX8cx0/z2NESfzYzmFZcK8dAtw6C6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:19:29', '2024-07-25 04:19:29', 0, NULL, NULL),
(1475, 'RESTI AMELIA', 'resti-amelia_1YLpL', '2165_tech@fathforce.com', 'Student', NULL, '$2y$10$zIDSbaJ13sYsT40iJpwZVuTeEyMeRoeeQOd2cozNbqd3qOfWGxi.e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:19:29', '2024-07-25 04:19:29', 0, NULL, NULL),
(1476, 'REVAN RAMADHAN', 'revan-ramadhan_iaIJ4', '2166_tech@fathforce.com', 'Student', NULL, '$2y$10$DQduiv5VPJfjCE7YC27yE.n8SlKKPwzSQZFhN0hznWHiI/mjsKOkW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:19:29', '2024-07-25 04:19:29', 0, NULL, NULL),
(1477, 'SALSA YURISA PUTRI', 'salsa-yurisa-putri_5JVBv', '2167_tech@fathforce.com', 'Student', NULL, '$2y$10$PHgAkO66P8kZQCQEfsIDTeU3DxVOv8sUEK7utWOZ7M6iGSsOcq5M6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:19:29', '2024-07-25 04:19:29', 0, NULL, NULL),
(1478, 'SALWA AULIA RAHMAH', 'salwa-aulia-rahmah_XcHIV', '2168_tech@fathforce.com', 'Student', NULL, '$2y$10$0vGwj5GVv5zlLUt/hiOHaeSFq/1I3E3MbZTqhPaY.3v5bL1Nzn8Ui', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:19:30', '2024-07-25 04:19:30', 0, NULL, NULL),
(1479, 'SEPTIYAN MUHAMMAD RAIHAN', 'septiyan-muhammad-raihan_3DNBW', '2169_tech@fathforce.com', 'Student', NULL, '$2y$10$7JZDaBcB8JzqNM9qsJ2y7uC8TpvyU32/arKV0LGm/TvPK.vBfbZd2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:19:30', '2024-07-25 04:19:30', 0, NULL, NULL),
(1480, 'SITI YOLANDASARI', 'siti-yolandasari_nI3bl', '2170_tech@fathforce.com', 'Student', NULL, '$2y$10$J8cFAx4qJ/mvJ8W94HLj6.oHbJPneWd7ZRA61D1FcTmRmCO.V2Q.i', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:19:30', '2024-07-25 04:19:30', 0, NULL, NULL),
(1481, 'SYIFA ZAHRIANI ANDESTIA', 'syifa-zahriani-andestia_1O9gb', '2171_tech@fathforce.com', 'Student', NULL, '$2y$10$kaeuDA3tgkiwkVG0x9ymbeKbjuEkhZTYwG9VDcFS/rje7vQ7t.Gtm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:19:30', '2024-07-25 04:19:30', 0, NULL, NULL),
(1482, 'YULI YULIANTI', 'yuli-yulianti_cx6dy', '2172_tech@fathforce.com', 'Student', NULL, '$2y$10$xzYUmSIMp/abhcOyInB.Q.FV0xY84xNSty3Zw.u4jDsRyAgok4yyO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:19:30', '2024-07-25 04:19:30', 0, NULL, NULL),
(1483, 'ZAHRA RAHMAWATI', 'zahra-rahmawati_DUrQv', '2173_tech@fathforce.com', 'Student', NULL, '$2y$10$AE8KRluD.kaLHkQjZw8fUuaWiDPAqo1KwIglgKA8qesSBTpTOd2Hi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:19:30', '2024-07-25 04:19:30', 0, NULL, NULL),
(1484, 'XkSv6j', 'xksv6j_MBmGs', '', 'Student', NULL, '$2y$10$ty1Vc3yPmgDM1RldrkpJZuPQ5Vn2.kxPnR/XkLhaU3QWF6DDAtbsO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nc1I7F', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:19:30', '2024-07-25 04:19:30', 0, NULL, NULL),
(1585, 'RISNA RAHMAWATI, S.Pd.', 'risna-rahmawati-spd_rxMkF', '1155_tech@fathforce.com', 'Teacher', NULL, '$2y$10$59DXcYkLxJEtS98bLm6u8u/sKg37sXXh.o7/KKcl/sHH65OBw30lS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '0899', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:30:43', '2024-07-25 04:30:43', 0, NULL, NULL),
(1718, 'ALMIRA PUTRI MAULIDIA', 'almira-putri-maulidia_x5E7U', '2174_tech@fathforce.com', 'Student', NULL, '$2y$10$blzX3Ilmqi4kLP8HlQOBHOFjcnCJxbge1drYTeZkMabLAqqSq.nIS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:44:39', '2024-07-25 04:44:39', 0, NULL, NULL),
(1719, 'ALYA YUSRIN HAMIDA', 'alya-yusrin-hamida_eYt06', '2175_tech@fathforce.com', 'Student', NULL, '$2y$10$LVJk7NiHTYn7Ycr01koI2eV/endb4N7ra5UspGxLih5nsnvJJNHfW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:44:39', '2024-07-25 04:44:39', 0, NULL, NULL),
(1720, 'AMEL NURDYANI PUTRI', 'amel-nurdyani-putri_DdvYM', '2176_tech@fathforce.com', 'Student', NULL, '$2y$10$UyujMDKwwr5k3NA0TtY3deK6FN6vGZZIL8NyC0t4mksr5fSpKn7ma', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:44:39', '2024-07-25 04:44:39', 0, NULL, NULL),
(1721, 'ANANDA DWI RACHMANIA', 'ananda-dwi-rachmania_aem8x', '2177_tech@fathforce.com', 'Student', NULL, '$2y$10$TaNFIEK7OEJkfecpP4Rpa.u.8ABErXwipUpc.frGmzROawqWamR3K', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:44:39', '2024-07-25 04:44:39', 0, NULL, NULL),
(1722, 'ANGGINIE MAULIDA ZAHRANI', 'angginie-maulida-zahrani_BjqRO', '2178_tech@fathforce.com', 'Student', NULL, '$2y$10$bV5Sa2yo.rktEpukxZcUsudnsh./ru.xHA7.ee.NxiBN/X0h45bb6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:44:39', '2024-07-25 04:44:39', 0, NULL, NULL),
(1723, 'ARISKA KHARISMAYANTI AS', 'ariska-kharismayanti-as_S9TJG', '2179_tech@fathforce.com', 'Student', NULL, '$2y$10$1XHHRpt2Dc/zXF2/BwZoXO1yK5pA3zCqpIEhUWZls14X8TctMRvE2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:44:39', '2024-07-25 04:44:39', 0, NULL, NULL),
(1724, 'ASTY SEPTIANI', 'asty-septiani_mNAng', '2180_tech@fathforce.com', 'Student', NULL, '$2y$10$zqGMjUiNSYD1UKjzfHJBgO1UdawkO8fkEmrVyaSW3oNlzHQcBaYz.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:44:39', '2024-07-25 04:44:39', 0, NULL, NULL),
(1725, 'AULIA NURFAUZIAH', 'aulia-nurfauziah_s7NnQ', '2181_tech@fathforce.com', 'Student', NULL, '$2y$10$cASd8S0nitL.zcQ88UAYN.w4QtCLkDnrrVsE0WY42AXZ0./fGfdYa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:44:39', '2024-07-25 04:44:39', 0, NULL, NULL),
(1726, 'CINTYA AURA YULIAZTIKA', 'cintya-aura-yuliaztika_oay9v', '2182_tech@fathforce.com', 'Student', NULL, '$2y$10$9Q7fq38K5bVu2z0SL97Vtu7LL8F8xfwHO5RdkYOUK0F5KWXU5SAXK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:44:39', '2024-07-25 04:44:39', 0, NULL, NULL),
(1727, 'DALPA PATIHATUL IZA', 'dalpa-patihatul-iza_hYss7', '2183_tech@fathforce.com', 'Student', NULL, '$2y$10$RQBzd0zL4Io6ANsFDgjSFuw8s0b9O.ztoUgZpDLbP2CEvdOILlM5u', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:44:39', '2024-07-25 04:44:39', 0, NULL, NULL),
(1728, 'DYA HIDAYATUL ULYA', 'dya-hidayatul-ulya_lsXhi', '2184_tech@fathforce.com', 'Student', NULL, '$2y$10$WOIDpZvOXbYuFO5JxkwN2u5j5ldsOmdZaiUth5Rd6D/lZNbaj8onm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:44:40', '2024-07-25 04:44:40', 0, NULL, NULL),
(1729, 'GEULIS FATHIAH AURA NUR RAMADHANI', 'geulis-fathiah-aura-nur-ramadhani_cKUts', '2185_tech@fathforce.com', 'Student', NULL, '$2y$10$0zJ/aoPRDI2ZZjpPALz64eyPCdp2z3MSyHkpEaHIwW9pBY682DKqW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:44:40', '2024-07-25 04:44:40', 0, NULL, NULL),
(1730, 'INEU MEILANI', 'ineu-meilani_fjwM6', '2186_tech@fathforce.com', 'Student', NULL, '$2y$10$c.mKjtwEM8Jq7qO9W4PIQ.TguUnhULDQZVlqAnDb3hCtsIMJ3w5Ey', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:44:40', '2024-07-25 04:44:40', 0, NULL, NULL),
(1731, 'KEYLA DIFANA IRAWAN', 'keyla-difana-irawan_4DshX', '2187_tech@fathforce.com', 'Student', NULL, '$2y$10$H4GF/Adl0TAoxEGsgdEhee.vhNKHv/wKJWtLMUEVR7bBYwDLLMmFe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:44:40', '2024-07-25 04:44:40', 0, NULL, NULL),
(1732, 'LIA AMELIA', 'lia-amelia_3mWIq', '2188_tech@fathforce.com', 'Student', NULL, '$2y$10$SwVCoq72Ubp9K9f0219bIupqMoSROzf9/JpeqyX/0DynJX/iGHkwK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:44:40', '2024-07-25 04:44:40', 0, NULL, NULL),
(1733, 'LISTA NURSULISTIANI', 'lista-nursulistiani_lBhvK', '2189_tech@fathforce.com', 'Student', NULL, '$2y$10$nb9eIH0JSae.91h2/oFJ0O2XGBOMJHk.iYruvsX1j3kg0QyQ2Qpg2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:44:40', '2024-07-25 04:44:40', 0, NULL, NULL),
(1734, 'MELISA', 'melisa_UL1Wy', '2190_tech@fathforce.com', 'Student', NULL, '$2y$10$svZQ6EA9CzwwdPTCzm8geuiCBPARwwzARD2FwEFLgLIeAOB4EDYAu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:44:40', '2024-07-25 04:44:40', 0, NULL, NULL),
(1735, 'MIA AMELIA', 'mia-amelia_O4dav', '2191_tech@fathforce.com', 'Student', NULL, '$2y$10$Xj9iuuDhtIaphVZgIwx2u.pJ8hyuxmrRv6rlw6ya/TDy9VZBDHU.m', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:44:40', '2024-07-25 04:44:40', 0, NULL, NULL),
(1736, 'MUTIARA ANGGRAENI', 'mutiara-anggraeni_Ujoc4', '2192_tech@fathforce.com', 'Student', NULL, '$2y$10$gDx3XnnHwZ7NRkcvWFM3HOM55IthYZcUUacC6rbgvEGe8hoy9BxWa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:44:40', '2024-07-25 04:44:40', 0, NULL, NULL),
(1737, 'NATASHA KHOERUNISA', 'natasha-khoerunisa_C56id', '2193_tech@fathforce.com', 'Student', NULL, '$2y$10$Xu6tdsFpV3z7O/G.xOkcQuIdckwe/IlEPPb1VhUBfZyD9OO4oLc.6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:44:40', '2024-07-25 04:44:40', 0, NULL, NULL),
(1738, 'NENDEN NOVEANZA', 'nenden-noveanza_CSRqe', '2194_tech@fathforce.com', 'Student', NULL, '$2y$10$a/AJF7UIljjz1PRCWuESjO8lRs64H085cXSAOmNXpgYrYvlB7byYq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:44:40', '2024-07-25 04:44:40', 0, NULL, NULL),
(1739, 'NENG SIFA NUR LAELASARI', 'neng-sifa-nur-laelasari_0sY8f', '2195_tech@fathforce.com', 'Student', NULL, '$2y$10$dH7qbvL7uh.Nw5ulQzpt2u1qMAhdTVL7oe.hQ2IVd0qsFgoPZAn8S', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:44:40', '2024-07-25 04:44:40', 0, NULL, NULL),
(1740, 'NURUL AINI', 'nurul-aini_wTrAH', '2196_tech@fathforce.com', 'Student', NULL, '$2y$10$wa7.CaOUCGThQA42RF.QSeELfon2A5I3Y0iJWkR4s90B1UvQNsrIK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:44:40', '2024-07-25 04:44:40', 0, NULL, NULL),
(1741, 'RENI INDRIANI', 'reni-indriani_EoH1W', '2197_tech@fathforce.com', 'Student', NULL, '$2y$10$V0/lL3OlX0AaZRhJfM9eCuWqdc0gVM4xmK7c7ZPRD72sSKx12n6m6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:44:40', '2024-07-25 04:44:40', 0, NULL, NULL),
(1742, 'RIMA MELATI', 'rima-melati_Tmv6F', '2198_tech@fathforce.com', 'Student', NULL, '$2y$10$NNTNK5CwgLHGtSr2Ldf0Zu4Ua8j/ukJ2xHzSb1MpK7n3sJXaq5y0S', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:44:41', '2024-07-25 04:44:41', 0, NULL, NULL),
(1743, 'RIRIN SRI MARYANI', 'ririn-sri-maryani_FZhZw', '2199_tech@fathforce.com', 'Student', NULL, '$2y$10$oxdtno8fY9p6v44AQnX6uu47HagEYub0YJexORWNLegg2gyGDOBIW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:44:41', '2024-07-25 04:44:41', 0, NULL, NULL),
(1744, 'RISA SAHARA PARIDA', 'risa-sahara-parida_B5cde', '2200_tech@fathforce.com', 'Student', NULL, '$2y$10$pY7aMiRbYcDbMPmW8VKE/O/eJtXq7NOxgZuvof.z6Tk7gqwudKpFq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:44:41', '2024-07-25 04:44:41', 0, NULL, NULL),
(1745, 'RISKA RAMADHANI', 'riska-ramadhani_XkNpg', '2201_tech@fathforce.com', 'Student', NULL, '$2y$10$m4RpNmEgHpOaHQGAky91xeksrbDjR/Jr00bBjY4Sqb7G./e5GEPVC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:44:41', '2024-07-25 04:44:41', 0, NULL, NULL),
(1746, 'SAILA MEILANI', 'saila-meilani_S519X', '2202_tech@fathforce.com', 'Student', NULL, '$2y$10$R1gIXIsE76S7LUUcErL9ouRTeHmFSb65dQDsjHYKf3sVaEguBDXlC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:44:41', '2024-07-25 04:44:41', 0, NULL, NULL),
(1747, 'SALWA RAHMAYANTI', 'salwa-rahmayanti_Ifppw', '2203_tech@fathforce.com', 'Student', NULL, '$2y$10$BhshJD9LJ3u6CYd5MdaxYen.dDfBmw.LeEU0cyStfeIPCVUU1PBmK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:44:41', '2024-07-25 04:44:41', 0, NULL, NULL),
(1748, 'SELVIAN NUR SITI SUPIANTI', 'selvian-nur-siti-supianti_ubFbk', '2204_tech@fathforce.com', 'Student', NULL, '$2y$10$LXj.Nh2ff7KzokFhIePLnOfsfpPNr4rtRTIhrQMWiMZhYl8/jOQ8K', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:44:41', '2024-07-25 04:44:41', 0, NULL, NULL),
(1749, 'SILPA FAUZIAH', 'silpa-fauziah_IIdee', '2205_tech@fathforce.com', 'Student', NULL, '$2y$10$MSfasJa2yuph9pXtKnMGtOwJCe4nB0VRYublJEDQD3gU5V2atCPOW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:44:41', '2024-07-25 04:44:41', 0, NULL, NULL),
(1750, 'SINDI YULIANTI', 'sindi-yulianti_s6Y4T', '2206_tech@fathforce.com', 'Student', NULL, '$2y$10$hBPzJLBU7FfYEQftsQWw0.DvtJpmXZTV78/drPUFB0XworBha84yO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:44:41', '2024-07-25 04:44:41', 0, NULL, NULL),
(1751, 'SITI NADYA SOLIHAH', 'siti-nadya-solihah_VjWRD', '2207_tech@fathforce.com', 'Student', NULL, '$2y$10$03k5QbiFgO1f5v6ipFRq4Ot6/UEqUywgAkqeBCOo4eLrUM45bz5Vy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:44:41', '2024-07-25 04:44:41', 0, NULL, NULL),
(1752, 'WULAN SARI', 'wulan-sari_XlDrJ', '2208_tech@fathforce.com', 'Student', NULL, '$2y$10$y7CuUvuhv8sdpJSVMLpzeet1WFGERGQLBpfQoij.f0F6itzC7E8se', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:44:41', '2024-07-25 04:44:41', 0, NULL, NULL),
(1753, 'ZAHRA RAHMAWATI', 'zahra-rahmawati_3U4ps', '2209_tech@fathforce.com', 'Student', NULL, '$2y$10$11RKYwctlGUaG.k0QWfJr.vHnYoNnJbHwnEdpsqSErEGgHfjfij3m', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:44:41', '2024-07-25 04:44:41', 0, NULL, NULL),
(1791, 'ULFA HANIFAH, S.Pd.', 'ulfa-hanifah-spd_pGrLI', '1156_tech@gmail.com', 'Teacher', NULL, '$2y$10$vfQOozN/.OVxovrJIW2Cn.phsX/DoP5e.kh9BTLAfpYevktEyumwC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '09867', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:56:05', '2024-07-25 04:56:05', 0, NULL, NULL),
(1792, 'AGUS HERI, S. Sn.', 'agus-heri-s-sn_58bpN', '1157_tech@gmail.com', 'Teacher', NULL, '$2y$10$lmujkmrY4ec/iCb6pWM78.X4JjN0U6hXMRN1QNtzQ5iFNV769DOGm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '08967', NULL, NULL, NULL, NULL, 0, '2024-07-25 04:59:16', '2024-07-25 04:59:16', 0, NULL, NULL),
(1793, 'DENI NUGRAHA SUNJAYA, S. Sn.', 'deni-nugraha-sunjaya-s-sn_OTT7G', '1158_tech@gmail.com', 'Teacher', NULL, '$2y$10$0ePIAJXi929seZ8FIK9XfuZbfy/fZDdU9vRHqkmSvloI3luN6jiKS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '05678', NULL, NULL, NULL, NULL, 0, '2024-07-25 05:01:36', '2024-07-25 05:01:36', 0, NULL, NULL),
(1794, 'GIAN DARMAWAN, S.Kom.', 'gian-darmawan-skom_1N76P', '1159_tech@gmail.com', 'Teacher', NULL, '$2y$10$2RMhHU4ogtkOhT2F.3TPKOXUDGW3kFfNVR9xRgSUqUUkNgOGv8QTy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '067985', NULL, NULL, NULL, NULL, 0, '2024-07-25 05:05:57', '2024-07-25 05:05:57', 0, NULL, NULL),
(1795, 'MUHAMAD REQOF SALAMUDIN SUJANA, S.Pd.', 'muhamad-reqof-salamudin-sujana-spd_SAL9J', '1160_tech@gmail.com', 'Teacher', NULL, '$2y$10$ERVvHVhI/97Txz6yNWBc6OUItSjS2Fi6/8mkZmMrHeluNR4JudWt6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '0598', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:12:38', '2024-07-25 06:12:38', 0, NULL, NULL),
(1796, 'NITA GUSTIANTI, S.Pd.', 'nita-gustianti-spd_nFRdI', '1161_tech@gmail.com', 'Teacher', NULL, '$2y$10$LIZFe6Myp14PP2XQO7qhuujqgZlUdInmpdxn//BAysyHBo9W0v8O6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '08956', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:15:19', '2024-07-25 06:15:19', 0, NULL, NULL),
(1797, 'NELA LISMAYA, S.Pd.', 'nela-lismaya-spd_8UGy7', '1162_tech@gmail.com', 'Teacher', NULL, '$2y$10$rJmvTuq72epebFn07FBWH.hKKmawFoZQDg2UEPNpxitKwomS1WWZO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '02526', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:17:35', '2024-07-25 06:17:35', 0, NULL, NULL),
(1942, 'RONI IRAWAN, S.Pd.', 'roni-irawan-spd_JMzwY', '1163_tech@gmail.com', 'Teacher', NULL, '$2y$10$f.W/dvme0KQ14mVzmWg8uer2EDs/eGXpf4aQbGnZJ0l4G61jBosDS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '037687', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:27:19', '2024-07-25 06:27:19', 0, NULL, NULL),
(1945, 'ADELA SARI', 'adela-sari_h3Wpj', '2247_tech@fathforce.com', 'Student', NULL, '$2y$10$glyolJixsS1FBY9Pg99mmOBAOrSGSCGkk0v8g./m7V4cDFyIu8Yi2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:33:54', '2024-07-25 06:33:54', 0, NULL, NULL),
(1946, 'ANI SRI RAHMI', 'ani-sri-rahmi_vJ9Zr', '2248_tech@fathforce.com', 'Student', NULL, '$2y$10$9rrSEB0Drq9wmI4D/mHru.jc8IOmGBGMHXmYacbjTPf1iH73ccYBi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:33:54', '2024-07-25 06:33:54', 0, NULL, NULL);
INSERT INTO `users` (`id`, `name`, `username`, `email`, `role`, `email_verified_at`, `password`, `code`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `fcm_token`, `current_team_id`, `profile_photo_path`, `status`, `phone`, `address`, `department_id`, `date_of_birth`, `gender`, `account_hold`, `created_at`, `updated_at`, `tour_completed`, `face_embedding`, `id_reference`) VALUES
(1947, 'AZ ZAHRA KAYLA PUTRI', 'az-zahra-kayla-putri_75ol5', '2249_tech@fathforce.com', 'Student', NULL, '$2y$10$A6O0SYh/lEzwgB7Ga2DDXumh4.RJZ89P4DwXwc23CusRoC04mCqyS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:33:54', '2024-07-25 06:33:54', 0, NULL, NULL),
(1948, 'FAUZIAH RAHMA', 'fauziah-rahma_WS3tG', '2250_tech@fathforce.com', 'Student', NULL, '$2y$10$1RcgnpvHkKaIhipKg/uXeuUt8JNuQDmmM4s85V1FIAp038POrAznu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:33:54', '2024-07-25 06:33:54', 0, NULL, NULL),
(1949, 'FITRI KHOERUNNISA', 'fitri-khoerunnisa_AHVxv', '2251_tech@fathforce.com', 'Student', NULL, '$2y$10$i6N97fizDI7n9dlXM2NBlubmvhi2aSvZnRleoq5HHLkDmdoujRI3i', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:33:54', '2024-07-25 06:33:54', 0, NULL, NULL),
(1950, 'GALUH SALSABILA AL ADAWIYAH', 'galuh-salsabila-al-adawiyah_yMtlg', '2252_tech@fathforce.com', 'Student', NULL, '$2y$10$2BrEQYBdMbtA2YAb2mIEKeNXmWEIIWt6/7sLkx9SaM6nfAcfbo302', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:33:54', '2024-07-25 06:33:54', 0, NULL, NULL),
(1951, 'HILMA PAUZIAH', 'hilma-pauziah_3vfzz', '2253_tech@fathforce.com', 'Student', NULL, '$2y$10$gHBT8PWYLDzirgV88u2x/uzYvTyrotaEgBL98wELaFnN8E6IN239W', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:33:54', '2024-07-25 06:33:54', 0, NULL, NULL),
(1952, 'HUSNA AMALIA', 'husna-amalia_u4i1T', '2254_tech@fathforce.com', 'Student', NULL, '$2y$10$FRPED3VnAor12XE6h/cV/.QXO8hi2PhGTMfWS5.Ij4TOV2PRG36L6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:33:54', '2024-07-25 06:33:54', 0, NULL, NULL),
(1953, 'KAEISA MAULIDIA FAUZIAH', 'kaeisa-maulidia-fauziah_CmTO0', '2255_tech@fathforce.com', 'Student', NULL, '$2y$10$txvbMPUaBS6RBt2NFGdsYeFIk1/FcHU7mfY/OW9zTnj9LnPVAHM92', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:33:54', '2024-07-25 06:33:54', 0, NULL, NULL),
(1954, 'LISNA SIFA NURAENI', 'lisna-sifa-nuraeni_NvWvB', '2256_tech@fathforce.com', 'Student', NULL, '$2y$10$mnPBY4k1dgIIDt6RbFvEd.kpcNnf.XsIeitzkDYJ1Omfuami9HEFe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:33:55', '2024-07-25 06:33:55', 0, NULL, NULL),
(1955, 'MAYANG DESTRIANI', 'mayang-destriani_5aLoh', '2257_tech@fathforce.com', 'Student', NULL, '$2y$10$cFf5rv4gbt/eKllzOGmSnuAb.LmgGkuFmel3uIQJOtaSHXSoqvJ96', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:33:55', '2024-07-25 06:33:55', 0, NULL, NULL),
(1956, 'MISNA SITI NURHASANAH', 'misna-siti-nurhasanah_7JFYe', '2258_tech@fathforce.com', 'Student', NULL, '$2y$10$/PMmac2kQAdaWep6eGu2FeFWtlw1NQ367uvcdn7oEc9a4t38uyua6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:33:55', '2024-07-25 06:33:55', 0, NULL, NULL),
(1957, 'NABILA NURAZIEZAH', 'nabila-nuraziezah_hai3S', '2259_tech@fathforce.com', 'Student', NULL, '$2y$10$ha25JpeHNGymIF5SOSZXnOLcQflkjTCMCopP8KlEtIotpvxOiSwJK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:33:55', '2024-07-25 06:33:55', 0, NULL, NULL),
(1958, 'NAILA MEILANI', 'naila-meilani_hXeP6', '2260_tech@fathforce.com', 'Student', NULL, '$2y$10$3QB8h7E2.Lm.drDJGFKSZe2Ihtgwef2TD/gw5ht9eXAMsNE4/mXyq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:33:55', '2024-07-25 06:33:55', 0, NULL, NULL),
(1959, 'NAURA EKA PUTRI', 'naura-eka-putri_66PgD', '2261_tech@fathforce.com', 'Student', NULL, '$2y$10$/Ee8btRRqbP9oiRBJA3ayOHaekmzmvX1bbj2yr3DYo95aOzkaT0xS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:33:55', '2024-07-25 06:33:55', 0, NULL, NULL),
(1960, 'NISSA GUSTINA', 'nissa-gustina_FCUT0', '2262_tech@fathforce.com', 'Student', NULL, '$2y$10$G7XpLYz0jcNuyg4uQSGdReJtOhAyaKlsbk0A6mOGjzv7x/.C0nK6.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:33:55', '2024-07-25 06:33:55', 0, NULL, NULL),
(1961, 'NUR ASKIYAH RAHMAN', 'nur-askiyah-rahman_vNZrH', '2263_tech@fathforce.com', 'Student', NULL, '$2y$10$xYnSrMRcZPhbxSy7n.whme.bTDGW4nIpaewUiA9xLAsx6.vSs7H/q', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:33:55', '2024-07-25 06:33:55', 0, NULL, NULL),
(1962, 'PUTRI ISMAYANTI', 'putri-ismayanti_ql06H', '2264_tech@fathforce.com', 'Student', NULL, '$2y$10$ws1GnOq58O0izggGJmfuneZ23CMEzfGvUv3/fQKgZLgVU8PQJA7Ma', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:33:55', '2024-07-25 06:33:55', 0, NULL, NULL),
(1963, 'RAHMA NURRAHAYU', 'rahma-nurrahayu_xYMRP', '2265_tech@fathforce.com', 'Student', NULL, '$2y$10$2YtJADVf5sxy9WBMTgNuUOttQE2XClZh0EnUTu4SkVOWfQzBMe.a2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:33:55', '2024-07-25 06:33:55', 0, NULL, NULL),
(1964, 'RAISYA TIARA PUTRI', 'raisya-tiara-putri_0uWwM', '2266_tech@fathforce.com', 'Student', NULL, '$2y$10$HHc880Dcsp8zZbDoIvFgpuJMRW2q5wWJKM3jjF9kwHo8PVedtKV8e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:33:55', '2024-07-25 06:33:55', 0, NULL, NULL),
(1965, 'RANI RAHMAYANTI', 'rani-rahmayanti_CbNdM', '2267_tech@fathforce.com', 'Student', NULL, '$2y$10$ivmbLa5iMS3QMLSVu5Rj8uem8AYaIT6huAgDfRuUWP.uU75OweBl.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:33:55', '2024-07-25 06:33:55', 0, NULL, NULL),
(1966, 'RETNA AYU SUKANINGSIH', 'retna-ayu-sukaningsih_qn6LD', '2268_tech@fathforce.com', 'Student', NULL, '$2y$10$j1.4Zb9UVyf5nM6DYugCW.IBFK.BqBUiOSWyA9/tv2LcuROKCzTby', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:33:55', '2024-07-25 06:33:55', 0, NULL, NULL),
(1967, 'RISGINA AULIA DEWI', 'risgina-aulia-dewi_5TCXG', '2269_tech@fathforce.com', 'Student', NULL, '$2y$10$Eyf4DA.CUoWSnBMLAujAMuF0czqBs8IICVpnqE2NRBMpqgYIhgOpu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:33:56', '2024-07-25 06:33:56', 0, NULL, NULL),
(1968, 'RISMA YANTI', 'risma-yanti_qi2YX', '2270_tech@fathforce.com', 'Student', NULL, '$2y$10$FQEDlukRvegWaOyqt0YFAOotgUe27A8NFyRw9av2tj0bma06cEbBe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:33:56', '2024-07-25 06:33:56', 0, NULL, NULL),
(1969, 'SALSA WIDIANTI', 'salsa-widianti_Wffkf', '2271_tech@fathforce.com', 'Student', NULL, '$2y$10$PoJcIk/wtE4HJrmD383vMezKPo30XMqoscYebrAqN/5z5sidJvJ2y', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:33:56', '2024-07-25 06:33:56', 0, NULL, NULL),
(1970, 'SARAH FAJNI', 'sarah-fajni_3XhUO', '2272_tech@fathforce.com', 'Student', NULL, '$2y$10$Fm.DBso5IW1p47LFMfpFXewfKmesLFEArkX7nF7E4dT2no22O2O1.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:33:56', '2024-07-25 06:33:56', 0, NULL, NULL),
(1971, 'SEFTIA MULYANI SAFITRI', 'seftia-mulyani-safitri_ls8KC', '2273_tech@fathforce.com', 'Student', NULL, '$2y$10$oxRLF.KITGJRC1lQB/tdNeRi.JZmxqi.d/khP0eCt5Z5/QylpQzhG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:33:56', '2024-07-25 06:33:56', 0, NULL, NULL),
(1972, 'SILFIANI', 'silfiani_dTwSy', '2274_tech@fathforce.com', 'Student', NULL, '$2y$10$K.6enNQST5opcf.PfWjDcudQu3DXaPoliMmAYVLnRfa7ajXoRE11q', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:33:56', '2024-07-25 06:33:56', 0, NULL, NULL),
(1973, 'SILVA RAHMAYANI', 'silva-rahmayani_gJjUO', '2275_tech@fathforce.com', 'Student', NULL, '$2y$10$42YcG3SKLBSWlr4QPVAONeYTbuBhuPEovJn1R1sgovvxn4Z304L7S', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:33:56', '2024-07-25 06:33:56', 0, NULL, NULL),
(1974, 'SIPA AMELIA', 'sipa-amelia_tEt44', '2276_tech@fathforce.com', 'Student', NULL, '$2y$10$Mjm.xSWLOgf90KeH.hnoVeevbB4AYfgyWkw.SSMKzh.A7oFx2AqyW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:33:56', '2024-07-25 06:33:56', 0, NULL, NULL),
(1975, 'SOPITRI MULYANI', 'sopitri-mulyani_PklJN', '2277_tech@fathforce.com', 'Student', NULL, '$2y$10$Xw4NUUSAUA1hj6A8xf5dPe8/vVLhw4htd2KhllLbdb15/qlUO7yhu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:33:56', '2024-07-25 06:33:56', 0, NULL, NULL),
(1976, 'TASYA ALIA PUTRI', 'tasya-alia-putri_5Xcl6', '2278_tech@fathforce.com', 'Student', NULL, '$2y$10$MQVDI0hjhA9UpGITISjT5e6sOhER1EnUdTvviEOH6dtvfR0HBXzWK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:33:56', '2024-07-25 06:33:56', 0, NULL, NULL),
(1977, 'TINA AGUSTIANI', 'tina-agustiani_uKn0q', '2279_tech@fathforce.com', 'Student', NULL, '$2y$10$NyIB6d2gDc8ajWXqrl/7g.bMkn5mDoUuh8aTKf3isj04jEgB35.RG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:33:56', '2024-07-25 06:33:56', 0, NULL, NULL),
(1978, 'WIDIA TRIPURWANTI', 'widia-tripurwanti_JlspS', '2280_tech@fathforce.com', 'Student', NULL, '$2y$10$aucLHxU8V56d6eBsw9YEduX2sOAFEieSS6TgB.Q6o2tMhN9khcR1u', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:33:56', '2024-07-25 06:33:56', 0, NULL, NULL),
(1979, 'YUNITA OKTAVIA', 'yunita-oktavia_haZ8Y', '2281_tech@fathforce.com', 'Student', NULL, '$2y$10$bUDK/sGAJgZtHj4v1UmadeSFfFrNHniCQICoBQuiqKNqt.okKhgbe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:33:57', '2024-07-25 06:33:57', 0, NULL, NULL),
(1980, 'YUSI NUR\'AINI', 'yusi-nuraini_owWtI', '2282_tech@fathforce.com', 'Student', NULL, '$2y$10$LvFCsfY9nOQz9vlBZzFpVO4AofvKZVlkAnZbqs.m7R8iiIJ0CHTHe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:33:57', '2024-07-25 06:33:57', 0, NULL, NULL),
(1981, 'SITI MAESAROH, S.Pd.I.', 'siti-maesaroh-spdi_3TsHa', '1164_tech@gmail.com', 'Teacher', NULL, '$2y$10$RsmaS5aRCtn7Wbqjwrm95e1rxFC1J.Vj/nhESzzmGl/PvXAGjxyQ6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '076543', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:34:32', '2024-07-25 06:34:32', 0, NULL, NULL),
(2278, 'AGUNG GUNAWAN', 'agung-gunawan_s57n2', '2463_tech@fathforce.com', 'Student', NULL, '$2y$10$qj4MbTS9NbwW.24TEgSv8u.b0.pYSzjZB45H8Ryf1DZI0BgnZhRYq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:38:20', '2024-07-25 06:38:20', 0, NULL, NULL),
(2279, 'ALI AL KHOTAMI', 'ali-al-khotami_ahQ76', '2464_tech@fathforce.com', 'Student', NULL, '$2y$10$fksWsPSdptxYGcPX7fmSGehbxRP/meGJ7zZ5SNLiFEpKCXOLvz75e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:38:20', '2024-07-25 06:38:20', 0, NULL, NULL),
(2280, 'AMELIA', 'amelia_8V7l1', '2465_tech@fathforce.com', 'Student', NULL, '$2y$10$rK7ZdaEQ3c8srDO.jyBxZe/PTUnui6QKMSnNyjc2R6VrSDY53hLcm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:38:20', '2024-07-25 06:38:20', 0, NULL, NULL),
(2281, 'ANTO HESTIAWAN', 'anto-hestiawan_HYjJn', '2466_tech@fathforce.com', 'Student', NULL, '$2y$10$LPJlEfUdFRIFBXQ3ti4ey.rTdfLZY.y1Y/4PyVU/EeKk/JoGw.rZ.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:38:20', '2024-07-25 06:38:20', 0, NULL, NULL),
(2282, 'BAGAS ANDRIAN', 'bagas-andrian_jgM5T', '2467_tech@fathforce.com', 'Student', NULL, '$2y$10$Leo2UYxZnpySHShjLtZLf.QvfKHSjz9ZZIDSqHZ.pgCJ7coaX/AYC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:38:21', '2024-07-25 06:38:21', 0, NULL, NULL),
(2283, 'CIKAL ANDRIYAN', 'cikal-andriyan_UQKap', '2468_tech@fathforce.com', 'Student', NULL, '$2y$10$miMwYI3eIPIBPKPFOH4VcuoisZMLu7gekPk5CPou1HzklrlSBiOKS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:38:21', '2024-07-25 06:38:21', 0, NULL, NULL),
(2284, 'DIMAS REZKI SAPUTRA', 'dimas-rezki-saputra_8BulF', '2469_tech@fathforce.com', 'Student', NULL, '$2y$10$83SdHXukRPwLqY1QisUn9Orf/7/20IjpdUTjQLsSAryWOumu8wPIq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:38:21', '2024-07-25 06:38:21', 0, NULL, NULL),
(2285, 'FAIDA RAHMA HERLANI', 'faida-rahma-herlani_IhMi7', '2470_tech@fathforce.com', 'Student', NULL, '$2y$10$vDu6ja6RX08i1RxkofyOie2c5PXbPBP5CPDmP.HvsUaeWtib/daYa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:38:21', '2024-07-25 06:38:21', 0, NULL, NULL),
(2286, 'FAJAR MAULANA', 'fajar-maulana_9Q6hp', '2471_tech@fathforce.com', 'Student', NULL, '$2y$10$Cm8x5VGKSTbwCYl5SghOGuw66.xRVly5N.vcsLUDcFsJUS3e0GeAC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:38:21', '2024-07-25 06:38:21', 0, NULL, NULL),
(2287, 'FINA KHOIRUN NISSA', 'fina-khoirun-nissa_8axVb', '2472_tech@fathforce.com', 'Student', NULL, '$2y$10$.eqehEQxpkcOuLjWU6UPe.41pLgGGZBv5hP2/Q1juPbqko1c4YvEq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:38:21', '2024-07-25 06:38:21', 0, NULL, NULL),
(2288, 'FUZI AL-HADAD', 'fuzi-al-hadad_haF9n', '2473_tech@fathforce.com', 'Student', NULL, '$2y$10$HNw9yud4/cW/lrnb8ZEWpu4Pbh/qhI..zpvbweKJxEH6qEqHKi3.C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:38:21', '2024-07-25 06:38:21', 0, NULL, NULL),
(2289, 'JUSTIN LEE KURNIAWAN', 'justin-lee-kurniawan_RT1I9', '2474_tech@fathforce.com', 'Student', NULL, '$2y$10$FQ8OeWLKDtCe.94Sbk/MvOpIYvAMYlRuWpEGdWRa2KwjefnuYMRGO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:38:21', '2024-07-25 06:38:21', 0, NULL, NULL),
(2290, 'KEYSA KAYLA AULIA PUTRI', 'keysa-kayla-aulia-putri_yStCj', '2475_tech@fathforce.com', 'Student', NULL, '$2y$10$05nrHiZp.GHkhzTmNAgSAOg1.a8WHXzZymo8d0ixjDcJYvc1la8cK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:38:21', '2024-07-25 06:38:21', 0, NULL, NULL),
(2291, 'LEXA ARVAREL OKTAVIANO', 'lexa-arvarel-oktaviano_LfbJr', '2476_tech@fathforce.com', 'Student', NULL, '$2y$10$U1KAuNl8vogwDnIxo4dwMOUrCOU25o9IwnrSeVxYD18KL70I/.i9a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:38:21', '2024-07-25 06:38:21', 0, NULL, NULL),
(2292, 'M. FAZRIL SAHRUL AKBAR', 'm-fazril-sahrul-akbar_veje2', '2477_tech@fathforce.com', 'Student', NULL, '$2y$10$KIYf79i3wqMRwLNE39fU9eMZFhKdOxbFNvXSOQoh0Z7F3X.fiqTL.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:38:21', '2024-07-25 06:38:21', 0, NULL, NULL),
(2293, 'MEGA NUR\'AJIJAH', 'mega-nurajijah_Iw4TG', '2478_tech@fathforce.com', 'Student', NULL, '$2y$10$5CcmCfGNrMZgFLMufg14HOfYv/kDfT52Vr4tNf8sPonADrAT8Yuue', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:38:21', '2024-07-25 06:38:21', 0, NULL, NULL),
(2294, 'MUHAMAD RIDHO NUGRAHA', 'muhamad-ridho-nugraha_Ej3Yj', '2479_tech@fathforce.com', 'Student', NULL, '$2y$10$2yEcCRH71qSpPz2Ttzs.g.UfuBv34TRZxo26k2Q9ToWSExox5g2e2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:38:21', '2024-07-25 06:38:21', 0, NULL, NULL),
(2295, 'MUHAMMAD AGIS SETIAWAN', 'muhammad-agis-setiawan_QDMv9', '2480_tech@fathforce.com', 'Student', NULL, '$2y$10$RHXDHhonSXgmUdcvPFZ64uRKvlqXkAMkMZ3jAp23EzFtiEjXDPI5m', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:38:21', '2024-07-25 06:38:21', 0, NULL, NULL),
(2296, 'MUTYARA RHAMADANI', 'mutyara-rhamadani_aIxME', '2481_tech@fathforce.com', 'Student', NULL, '$2y$10$73lDAty2pBF4JlTs1mFSuuqFeDvIcylAR0dmJCLz8Pos7WgWd3Haq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:38:21', '2024-07-25 06:38:21', 0, NULL, NULL),
(2297, 'NOVAL ROMADANI', 'noval-romadani_QtOvB', '2482_tech@fathforce.com', 'Student', NULL, '$2y$10$Kx6BJrfdLHHNJBEVfNEYDOgeRY3QN3lcIUrxv57kW803bg0PTV8O.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:38:22', '2024-07-25 06:38:22', 0, NULL, NULL),
(2298, 'RAEHAN RANA HAFFIYAN', 'raehan-rana-haffiyan_w3MNq', '2483_tech@fathforce.com', 'Student', NULL, '$2y$10$zmqDOAsZTmgPuycq325i/.c.ZzfZyp0JvEUF3/vFEgMuWvfEFRriS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:38:22', '2024-07-25 06:38:22', 0, NULL, NULL),
(2299, 'RAFI IHSAN RAMADHAN', 'rafi-ihsan-ramadhan_17mXO', '2484_tech@fathforce.com', 'Student', NULL, '$2y$10$2kvd4PEaWuBuEh.4K5zf0Oey8puHGpE8/UEGuoxutzAtCxf8WivRy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:38:22', '2024-07-25 06:38:22', 0, NULL, NULL),
(2300, 'RAMA MAULIDAN', 'rama-maulidan_3Ycu4', '2485_tech@fathforce.com', 'Student', NULL, '$2y$10$SJQb9Qqzi22q//BYL93BpeNvnHBKOo8utAjunq8o3VXCsh8C/dhlC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:38:22', '2024-07-25 06:38:22', 0, NULL, NULL),
(2301, 'RANI FITRIYANI', 'rani-fitriyani_P0shF', '2486_tech@fathforce.com', 'Student', NULL, '$2y$10$Cj2K271W2UCydj/SIP0Ype4.aTcuimWjlGBanmwZhKtZGdhaNEgWO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:38:22', '2024-07-25 06:38:22', 0, NULL, NULL),
(2302, 'REFA PUTRI NATANIA', 'refa-putri-natania_vbEYH', '2487_tech@fathforce.com', 'Student', NULL, '$2y$10$DPiqR6MFhYNayzqdbwxHp.9beKM9iB4zv9/IAI.a9nOdgmf9tXG8C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:38:22', '2024-07-25 06:38:22', 0, NULL, NULL),
(2303, 'RESTI KANIA', 'resti-kania_kNWC5', '2488_tech@fathforce.com', 'Student', NULL, '$2y$10$Nf.Pq8lzNhvRC50VAxU.lOwV7UDkkbDKeVf0DMcjgfuLkSVWTsRzq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:38:22', '2024-07-25 06:38:22', 0, NULL, NULL),
(2304, 'RESYA TRIYULIA', 'resya-triyulia_kmhZL', '2489_tech@fathforce.com', 'Student', NULL, '$2y$10$p2se0jN8DLevL6SdE5DJ9ukNDtk8fwZAgWaWktOQu5BSpMy9dG.rW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:38:22', '2024-07-25 06:38:22', 0, NULL, NULL),
(2305, 'REVAN ADITYA PRASETIAWAN', 'revan-aditya-prasetiawan_Rm8OW', '2490_tech@fathforce.com', 'Student', NULL, '$2y$10$kRajQTexuQxv1MSX9kLAvu4f5OyJSdSmOwXSeqj9xCoorxBXDcPGi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:38:22', '2024-07-25 06:38:22', 0, NULL, NULL),
(2306, 'RISMA NURMAYANTI', 'risma-nurmayanti_PYTVJ', '2491_tech@fathforce.com', 'Student', NULL, '$2y$10$HPEPNgLR4GVbvgdoaRWDc.gq2vwwBTaXPCzS.YvvcrONPq7zL9CqG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:38:22', '2024-07-25 06:38:22', 0, NULL, NULL),
(2307, 'RIZKI MAULANA', 'rizki-maulana_lVd2w', '2492_tech@fathforce.com', 'Student', NULL, '$2y$10$NBRlFJWCYEEoPOjZIEHMqeXo1GSc0n1lhvic/uZpvhOFrPoACStNe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:38:22', '2024-07-25 06:38:22', 0, NULL, NULL),
(2308, 'SENTIA DEWI RATNASARI', 'sentia-dewi-ratnasari_wJT6X', '2493_tech@fathforce.com', 'Student', NULL, '$2y$10$EWStGFWsnh2tTxFxUBOO8.taxGDdPojtwQ8f1dUX8Zt781oS3cddm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:38:22', '2024-07-25 06:38:22', 0, NULL, NULL),
(2309, 'SILVYRA NURKHOTIMAH', 'silvyra-nurkhotimah_fZ56O', '2494_tech@fathforce.com', 'Student', NULL, '$2y$10$nDQV701HcTTkLJle2vHHI.VtRv2k1D0RrjR64nAEA0vJiPV/IRY9O', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:38:22', '2024-07-25 06:38:22', 0, NULL, NULL),
(2310, 'SITI ROSMIATI', 'siti-rosmiati_U0dZR', '2495_tech@fathforce.com', 'Student', NULL, '$2y$10$tJfRlABSF3VL1feZWtGG..2jR7ITZTkobPk.u2fSi14t0tvWjdsH2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:38:22', '2024-07-25 06:38:22', 0, NULL, NULL),
(2311, 'WIRA WIJAYA KUSUMA', 'wira-wijaya-kusuma_80SRa', '2496_tech@fathforce.com', 'Student', NULL, '$2y$10$F9yDAv3/yBU63/JCF.4h0OGAu4aK/ddbRnlc515kAxJjb3qXeXU7m', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:38:23', '2024-07-25 06:38:23', 0, NULL, NULL),
(2312, 'WISNU WIJAYUDIN', 'wisnu-wijayudin_Lrygp', '2497_tech@fathforce.com', 'Student', NULL, '$2y$10$.Q.zjOEIpeBz6tV6IlUhW.98qKLyBMGKJefi0Wlzmbajnm8FgMd/C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:38:23', '2024-07-25 06:38:23', 0, NULL, NULL),
(2313, 'ZULFA JAHRA ZAITUN', 'zulfa-jahra-zaitun_MCgaz', '2498_tech@fathforce.com', 'Student', NULL, '$2y$10$Xv/QaU9.FsskB.4vkpMTtOhc//F8vpM4yrdAyUT.yYbw2ZZ.D9Qu.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:38:23', '2024-07-25 06:38:23', 0, NULL, NULL),
(2314, 'IRMA SRI SURYANTINI, S.Pd.', 'irma-sri-suryantini-spd_gQf9m', '1165_tech@gmail.com', 'Teacher', NULL, '$2y$10$2uC3UwCdxVvMp6sg4QXu4ulOwRQDVHJS8qZJFXBxXwn9iOfU1KedS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '02345', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:38:41', '2024-07-25 06:38:41', 0, NULL, NULL),
(2315, 'ADI FAHRI RIZALAH', 'adi-fahri-rizalah_OVtcn', '2499_tech@fathforce.com', 'Student', NULL, '$2y$10$Q3opoStJYvVNCb0PFWvOa.t4h3h6HDkbwfkg0N0VQAJaFy8ESIWWm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:40:28', '2024-07-25 06:40:28', 0, NULL, NULL),
(2316, 'ADIKA PERMANA', 'adika-permana_L1V0W', '2500_tech@fathforce.com', 'Student', NULL, '$2y$10$tBFVBDUanLWnbya4/YW/q.7eERVpy6i0Ln0.SpXsPBwBgZjLElvcy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:40:28', '2024-07-25 06:40:28', 0, NULL, NULL),
(2317, 'AGUM GUMELAR', 'agum-gumelar_SWpST', '2501_tech@fathforce.com', 'Student', NULL, '$2y$10$LBmkjOU2kpRDrZ0LCVa1lOBMYI9THCDyoaxynIyVztJGzPK7cZhCa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:40:28', '2024-07-25 06:40:28', 0, NULL, NULL),
(2318, 'AGUS GUSTIA', 'agus-gustia_GAcOP', '2502_tech@fathforce.com', 'Student', NULL, '$2y$10$ar.8ofJvPbvYQmgInC2R7ed/yniEKcTwFSHUQ3bl1fXrXGyTkajea', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:40:28', '2024-07-25 06:40:28', 0, NULL, NULL),
(2319, 'ALFIN', 'alfin_gfQ6u', '2503_tech@fathforce.com', 'Student', NULL, '$2y$10$7eaWdiLfKm0LlsjBCvBkHuu6fVGTtd6mEFa6Qr5pw0jwV8rusE2V6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:40:28', '2024-07-25 06:40:28', 0, NULL, NULL),
(2320, 'ANDIKA DWI RAHMAN', 'andika-dwi-rahman_GRHdb', '2504_tech@fathforce.com', 'Student', NULL, '$2y$10$YX140Ktd8QD4wgV98N2wc.4zSQanCJcjvNOGLc8dBcTjnsZur6E0q', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:40:29', '2024-07-25 06:40:29', 0, NULL, NULL),
(2321, 'ANDRI FAUZI', 'andri-fauzi_ACJzp', '2505_tech@fathforce.com', 'Student', NULL, '$2y$10$pfw/RdV9XLyZWqCmtzOXB.VRF2sDXDWXJE/tGv2mmMRfLbxq/dk5W', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:40:29', '2024-07-25 06:40:29', 0, NULL, NULL),
(2322, 'ARIF ALBAIHAQI', 'arif-albaihaqi_AcVuN', '2506_tech@fathforce.com', 'Student', NULL, '$2y$10$g88HHGF9NsIGZfs.5rO6weKVbGpGUOwlcjhJWYJPbm0zcOVa2Ya4K', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:40:29', '2024-07-25 06:40:29', 0, NULL, NULL),
(2323, 'ARYA EKA MAULANA', 'arya-eka-maulana_kiN1o', '2507_tech@fathforce.com', 'Student', NULL, '$2y$10$uEbUcfoHldT.75H2I8yRn.ly8GlfF8CwV7vM5jBfy7MEbT2f03Tqe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:40:29', '2024-07-25 06:40:29', 0, NULL, NULL),
(2324, 'ASEP MUHAMMAD PUTU AWALUDDIN', 'asep-muhammad-putu-awaluddin_D4psc', '2508_tech@fathforce.com', 'Student', NULL, '$2y$10$Lid4CQn.kQtPn4xq13eyPOxMvqN0cl9itIu1S4xYftL0llFCAoK.q', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:40:29', '2024-07-25 06:40:29', 0, NULL, NULL),
(2325, 'DAVA AGISTA', 'dava-agista_UZBSI', '2509_tech@fathforce.com', 'Student', NULL, '$2y$10$npqGRqdpDXnOMS7tO3KFPu8J8XCqG1kLkCHzfm/bunwnwqwbqJw/C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:40:29', '2024-07-25 06:40:29', 0, NULL, NULL),
(2326, 'ERIS RISDAN', 'eris-risdan_FiQQg', '2510_tech@fathforce.com', 'Student', NULL, '$2y$10$VO7f8dUMqruGrmTiKe2NN.PDRK1X1B6sGGNeXztG1EwAJJH.qjlie', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:40:29', '2024-07-25 06:40:29', 0, NULL, NULL),
(2327, 'FAHRI NURURROHMAN', 'fahri-nururrohman_YSRzP', '2511_tech@fathforce.com', 'Student', NULL, '$2y$10$smClPrP1UYXzc649/Xv4dOicM3wY2FD7bKOdMWgcDhAHRieVRNRZy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:40:29', '2024-07-25 06:40:29', 0, NULL, NULL),
(2328, 'FAIZ FAUZI', 'faiz-fauzi_hEJFa', '2512_tech@fathforce.com', 'Student', NULL, '$2y$10$L9YVaBunKC9cUgN3coGQc.PEGXdYrChy5o.u7MlNJcetwEKavoTQq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:40:29', '2024-07-25 06:40:29', 0, NULL, NULL),
(2329, 'FAJRI RAMDHANI', 'fajri-ramdhani_wZX4w', '2513_tech@fathforce.com', 'Student', NULL, '$2y$10$/Lmdev9lMfLyekVQAHWtfeV8Fz/Vt6PQZ17tdhVDKkqwgKBElYe6G', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:40:29', '2024-07-25 06:40:29', 0, NULL, NULL),
(2330, 'FAUZIL HUZNI AL AZIZ', 'fauzil-huzni-al-aziz_NOK2u', '2514_tech@fathforce.com', 'Student', NULL, '$2y$10$j0SrcgSTHJCKrDUKVLe2W.Wwsd23ca2JDPeHT8YsbwkJ4n7uLhOjG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:40:29', '2024-07-25 06:40:29', 0, NULL, NULL),
(2331, 'GALANG RAMADANI', 'galang-ramadani_q8bjW', '2515_tech@fathforce.com', 'Student', NULL, '$2y$10$prn9K89K6/bFjceimjLu5OEH6yk0HWfEfBTu.SvcqrhjgxkFx9D2m', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:40:29', '2024-07-25 06:40:29', 0, NULL, NULL),
(2332, 'HASBI AHMAD FADILAH', 'hasbi-ahmad-fadilah_IdmzD', '2516_tech@fathforce.com', 'Student', NULL, '$2y$10$fqS8lnK5526iZid/IG7HGuTO88LnkVWGhxQvlmADFhGvWKxN.88Oi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:40:29', '2024-07-25 06:40:29', 0, NULL, NULL),
(2333, 'ILHAM MAULANA', 'ilham-maulana_R0SPk', '2517_tech@fathforce.com', 'Student', NULL, '$2y$10$3jnHiGpU.leXIqW5GMD/oeqbEMOvFHMQwkXfwyn7VGORy/uqGdTG.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:40:29', '2024-07-25 06:40:29', 0, NULL, NULL),
(2334, 'INDRA REKSO PUTRA', 'indra-rekso-putra_tqd4Y', '2518_tech@fathforce.com', 'Student', NULL, '$2y$10$n3dxihMIe6iUUbsbivl6neBwy50jo0Dz.e8HwchfcUtA1M3il/9Cm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:40:30', '2024-07-25 06:40:30', 0, NULL, NULL),
(2335, 'MAULANA FAHRI', 'maulana-fahri_vgRGV', '2519_tech@fathforce.com', 'Student', NULL, '$2y$10$fq..3Mu9AnKKtK93KqKIfe76nNfXANY2iIk2Wc6jA6bj.jKBMMvk2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:40:30', '2024-07-25 06:40:30', 0, NULL, NULL),
(2336, 'MUHAMAD IQBAL', 'muhamad-iqbal_f8Lvx', '2520_tech@fathforce.com', 'Student', NULL, '$2y$10$7ZcW13RUeotc18720mMeSuTRF856s.00IX5bMPJfVFs0z4/opwC4G', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:40:30', '2024-07-25 06:40:30', 0, NULL, NULL),
(2337, 'MUHAMAD PAHRI QUSAERI', 'muhamad-pahri-qusaeri_CM2R3', '2521_tech@fathforce.com', 'Student', NULL, '$2y$10$guyvFnNmTA/FZDb2LaK41uTCiRhmlkCQgC0LAl.weZROWOpduDym.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:40:30', '2024-07-25 06:40:30', 0, NULL, NULL),
(2338, 'MUHAMMAD ADITYA ARRASYID', 'muhammad-aditya-arrasyid_PEeQX', '2522_tech@fathforce.com', 'Student', NULL, '$2y$10$uBZVEpOa8DKzMnFmKFilV.G36oFPwYUVFGS9.wi6pzs31yXZTebUy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:40:30', '2024-07-25 06:40:30', 0, NULL, NULL),
(2339, 'MUHAMMAD ALDI FAUZAN', 'muhammad-aldi-fauzan_vorlA', '2523_tech@fathforce.com', 'Student', NULL, '$2y$10$ex9YM5SWV1a36JiWBKh7oOSBmboym0xUn25eob2uJfrT1b58GkGbe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:40:30', '2024-07-25 06:40:30', 0, NULL, NULL),
(2340, 'NOVAL APRILIANA NUGRAHA', 'noval-apriliana-nugraha_yovKF', '2524_tech@fathforce.com', 'Student', NULL, '$2y$10$FPt.y3zeZnu0xQp9DVrx5epz8APGDXZOa1xKE2N/TrmCYc9VaCnXq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:40:30', '2024-07-25 06:40:30', 0, NULL, NULL),
(2341, 'RAIHAN RAHDIANA', 'raihan-rahdiana_7lYBu', '2525_tech@fathforce.com', 'Student', NULL, '$2y$10$FMk5UojNN467Qfhm6KCY8u.cRE5zLxgG25aXjkL1gDB4yYa7V/Z4a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:40:30', '2024-07-25 06:40:30', 0, NULL, NULL),
(2342, 'RIKY MAULIDAN', 'riky-maulidan_Ekujd', '2526_tech@fathforce.com', 'Student', NULL, '$2y$10$hdIvzscep6d73/HY4Kbp0.GM6clC1eID4/.muzIvRt3DCKLQK0UUa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:40:30', '2024-07-25 06:40:30', 0, NULL, NULL),
(2343, 'RIZKY SEPTIAN', 'rizky-septian_BgGKk', '2527_tech@fathforce.com', 'Student', NULL, '$2y$10$T11NgQSHXoM.7CcJQ.lDv.de1XqNOc1VIOiRMGfxWpZCpwYOOGqiq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:40:30', '2024-07-25 06:40:30', 0, NULL, NULL),
(2344, 'ROBBI ARYA RAMDANHI', 'robbi-arya-ramdanhi_g84aL', '2528_tech@fathforce.com', 'Student', NULL, '$2y$10$irB1q./DXiDJ5pj94Ft72OEJ0ZNttWszyWWEkWe1UimiBLvDAR1ba', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:40:30', '2024-07-25 06:40:30', 0, NULL, NULL),
(2345, 'SATRIA PERMANA PUTERA', 'satria-permana-putera_Xfca4', '2529_tech@fathforce.com', 'Student', NULL, '$2y$10$jGRahQkvMhbocX0H9BJCp.kGc3VkC9Va0IVPxYj1Ye6sKogKJ8x8i', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:40:30', '2024-07-25 06:40:30', 0, NULL, NULL),
(2346, 'SEPTIAN NURDIANSYAH', 'septian-nurdiansyah_DRcwb', '2530_tech@fathforce.com', 'Student', NULL, '$2y$10$uYlRxNKXe538Y8rwvJy0A.GHluJXvm5.PpAOnXKeA8w2uzVhrxZAu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:40:30', '2024-07-25 06:40:30', 0, NULL, NULL),
(2347, 'TATANG HIDAYAT', 'tatang-hidayat_6EofB', '2531_tech@fathforce.com', 'Student', NULL, '$2y$10$GTaGP/0xajiL8J5STACZE.qGa2AnTelDvLeV0T7d.VxJfODYQ1ymi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:40:30', '2024-07-25 06:40:30', 0, NULL, NULL),
(2348, 'WANDI PURNAMA', 'wandi-purnama_8ZASR', '2532_tech@fathforce.com', 'Student', NULL, '$2y$10$CPdrgITTs.bnXKjBNV3QVOfuUm16wZjFZPWXPI6rVSFLOLXQmislG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:40:31', '2024-07-25 06:40:31', 0, NULL, NULL),
(2349, 'YANUARI ANANDA AGUSTIRA', 'yanuari-ananda-agustira_eqc0q', '2533_tech@fathforce.com', 'Student', NULL, '$2y$10$jOBtuyey8pdpq1SHgqKh2u4K6ZFS8z4doX9ImHZeHR8a0zgn6pWeO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:40:31', '2024-07-25 06:40:31', 0, NULL, NULL),
(2350, 'ZULFIKAR BAHARUDDIN HAKIIM', 'zulfikar-baharuddin-hakiim_JsqPJ', '2534_tech@fathforce.com', 'Student', NULL, '$2y$10$cp35s8SmPnddNnhtePUJH.L7kfl0vlVMMHQgzV1SuFoyJI1xATDTq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:40:31', '2024-07-25 06:40:31', 0, NULL, NULL),
(2351, 'ADI ADITIA', 'adi-aditia_k9HqF', '2535_tech@fathforce.com', 'Student', NULL, '$2y$10$2sXVvRUT.OBkFSKPdAKHyugh4HlZ.3Vnr.V027bc3VaeZV/6UeMeW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:09', '2024-07-25 06:41:09', 0, NULL, NULL),
(2352, 'ADIT SEPRIANA', 'adit-sepriana_RQjI7', '2536_tech@fathforce.com', 'Student', NULL, '$2y$10$golI/k0Dd.fCdeZ/st2RfODkeur4xapNYQGe3IUlTt.wyRqcyEGGK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:09', '2024-07-25 06:41:09', 0, NULL, NULL),
(2353, 'AGUNG BAKTI GUNAWAN', 'agung-bakti-gunawan_SOdX6', '2537_tech@fathforce.com', 'Student', NULL, '$2y$10$oOJqP9VGjDKElyWTgWvR9eCwD5JzXGz1CWxRTzgCgupKabv4TWrzy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:09', '2024-07-25 06:41:09', 0, NULL, NULL),
(2354, 'ALWIN OCTA PRATAMA', 'alwin-octa-pratama_uvYm2', '2538_tech@fathforce.com', 'Student', NULL, '$2y$10$Wm1F6EGl8Dq2a4groyp/tug8cTys0z.tSFVmMKcG6.BWVyIPjDJP2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:09', '2024-07-25 06:41:09', 0, NULL, NULL),
(2355, 'ANGGA HERDIANSAH', 'angga-herdiansah_SIRE9', '2539_tech@fathforce.com', 'Student', NULL, '$2y$10$7XirFO33edrWqr3GIWKpwuxDlrtk/AoalctVRufJSzT9qFeH2XdPm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:09', '2024-07-25 06:41:09', 0, NULL, NULL),
(2356, 'ASEP RAMDANI', 'asep-ramdani_STquz', '2540_tech@fathforce.com', 'Student', NULL, '$2y$10$BVNA3q68opTTKu3mGj8jgeIBaPhz0RePSM2ReaBLxShlikRUs3Qga', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:09', '2024-07-25 06:41:09', 0, NULL, NULL),
(2357, 'AZRIL RAMADANI', 'azril-ramadani_p0ZjT', '2541_tech@fathforce.com', 'Student', NULL, '$2y$10$3.ZpIj1YBNkvyA905fJKV.Ba01HYwq6hMZr7lhXcCY/0Bgz435r5C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:09', '2024-07-25 06:41:09', 0, NULL, NULL),
(2358, 'CARLIN RAHAYU', 'carlin-rahayu_DlTNQ', '2542_tech@fathforce.com', 'Student', NULL, '$2y$10$yE/oKkSNAS/Oj1bW3Pe4V.IqLTGffUxf0ns8JRo1AJEgCv4qodv8y', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:09', '2024-07-25 06:41:09', 0, NULL, NULL),
(2359, 'DENIS KURNIAWAN', 'denis-kurniawan_tjlfW', '2543_tech@fathforce.com', 'Student', NULL, '$2y$10$yy4jLfYiwDuR7I0ivw6FUesh6X2IJVR3uOy9m6o4rbVr6dwnIMW5u', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:09', '2024-07-25 06:41:09', 0, NULL, NULL),
(2360, 'DIANDRA FAHRIJA', 'diandra-fahrija_wTrdR', '2544_tech@fathforce.com', 'Student', NULL, '$2y$10$cpLfh7ROOulmrSX9QHS0ROozruTtdbpswvLe5X5z1J3O/xi9dgPXq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:09', '2024-07-25 06:41:09', 0, NULL, NULL),
(2361, 'DIDIN SEPTIANA', 'didin-septiana_Uz9Cq', '2545_tech@fathforce.com', 'Student', NULL, '$2y$10$LjKCTfAypdnvqexqLzc90eMPeW5lA4a9vqIvnH95rjoR9Qy0GG2yG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:09', '2024-07-25 06:41:09', 0, NULL, NULL),
(2362, 'DIKA HERNANDIKA', 'dika-hernandika_XhrnN', '2546_tech@fathforce.com', 'Student', NULL, '$2y$10$UlQKGkc0.t2tyn/qGXQFveLwlqBIr.LgtICdzoHU9qJ/.BvfwtEK2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:09', '2024-07-25 06:41:09', 0, NULL, NULL),
(2363, 'DODI', 'dodi_ihhWW', '2547_tech@fathforce.com', 'Student', NULL, '$2y$10$mTxHsDdOUbnx45RBWW1ZkufcXjK5CcUpe4g9y3un7KyY1GRWviliu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:09', '2024-07-25 06:41:09', 0, NULL, NULL),
(2364, 'FARHAN PUTRA AGUSTIN', 'farhan-putra-agustin_SyJAE', '2548_tech@fathforce.com', 'Student', NULL, '$2y$10$GH05cK5Thpnt/ZaBkbE4rOq1QG9AeqWHPmFmMNDD1hBNwEpNMgupG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:09', '2024-07-25 06:41:09', 0, NULL, NULL),
(2365, 'FATIH DHIA FIRDAUS', 'fatih-dhia-firdaus_Hq98w', '2549_tech@fathforce.com', 'Student', NULL, '$2y$10$kxMejkP0VSQej4O5zSKq6u4MQw23gxxBDeqvuPJISk5VdianZ97Ie', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:10', '2024-07-25 06:41:10', 0, NULL, NULL),
(2366, 'FIKRY DWI MAULIDA APRIANSYAH', 'fikry-dwi-maulida-apriansyah_kL8nA', '2550_tech@fathforce.com', 'Student', NULL, '$2y$10$q6UIF0TLrbCWJWR7o.0x8.fe.8gkuMwY0T8nm2oE.QWkiHJg73acW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:10', '2024-07-25 06:41:10', 0, NULL, NULL),
(2367, 'FITRA JOMANTARA', 'fitra-jomantara_KSYh3', '2551_tech@fathforce.com', 'Student', NULL, '$2y$10$vujmZgpynSSdjtkn3mRuHeQx8RRZk.nQ5PVHnKr7pZm09xaybSdt2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:10', '2024-07-25 06:41:10', 0, NULL, NULL),
(2368, 'GALANG ADLIANA', 'galang-adliana_kBEA5', '2552_tech@fathforce.com', 'Student', NULL, '$2y$10$0Yw1JC8jb7WxPPjweoGJ6uPNaHyiAsWcNNr7IngSvl/m/eWSaPC1y', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:10', '2024-07-25 06:41:10', 0, NULL, NULL),
(2369, 'HARI ANGGARA', 'hari-anggara_tBlIS', '2553_tech@fathforce.com', 'Student', NULL, '$2y$10$Yn/HLa63XuovqUR3a7NkVuJWK2AI3ugI9BG2ajMW2iksU/MxukyAy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:10', '2024-07-25 06:41:10', 0, NULL, NULL),
(2370, 'JERI WILDANI', 'jeri-wildani_GWcGu', '2554_tech@fathforce.com', 'Student', NULL, '$2y$10$PVtOmHE//6s1o3RqxZOyvOgbF6eRqhDai41dLwpH.kJqh7ba5fqUe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:10', '2024-07-25 06:41:10', 0, NULL, NULL),
(2371, 'KIKI ANDIKA', 'kiki-andika_URdrd', '2555_tech@fathforce.com', 'Student', NULL, '$2y$10$74.THusBWqbuQCvpQOqZu.JOXBd7wRZz0ERw8pquYlbV/1kpPmWwG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:10', '2024-07-25 06:41:10', 0, NULL, NULL),
(2372, 'MOCHAMMAD RIZKY ANSHARI', 'mochammad-rizky-anshari_eR1ga', '2556_tech@fathforce.com', 'Student', NULL, '$2y$10$uBdv/boZOkws3P3K.G06aOkhZxR1SZBa171t0CIcYWW13bt3VU2h2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:10', '2024-07-25 06:41:10', 0, NULL, NULL),
(2373, 'MUHAMAD RANGGA DUPAR MUBAROCH', 'muhamad-rangga-dupar-mubaroch_RE01n', '2557_tech@fathforce.com', 'Student', NULL, '$2y$10$aGv5Q2RXSIy.clnTQLW8uO13BqygUzwau/xwT.H46pwhzK9keHyha', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:10', '2024-07-25 06:41:10', 0, NULL, NULL),
(2374, 'NAZRIL MUHAMMAD RAMDHANI', 'nazril-muhammad-ramdhani_nMXFw', '2558_tech@fathforce.com', 'Student', NULL, '$2y$10$3RO4OcQrXB82OehiIJhKDuaM0xDn1aLncpMdyvfGM1dM2J.Mkdq8u', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:10', '2024-07-25 06:41:10', 0, NULL, NULL),
(2375, 'NIKO JAELANI', 'niko-jaelani_i7dDo', '2559_tech@fathforce.com', 'Student', NULL, '$2y$10$nA/KRjxpvpGalRyjJUxsjOblAEsU5D.5DPY0qz1A2t1/YBOBhXcGK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:10', '2024-07-25 06:41:10', 0, NULL, NULL),
(2376, 'RAIHAN FADILLAH', 'raihan-fadillah_IH9BC', '2560_tech@fathforce.com', 'Student', NULL, '$2y$10$wDzZdRIlGksnQIKvWxVN3.AKKUnksvIqeoYGuCQvQ0s0PJmj.yLNO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:10', '2024-07-25 06:41:10', 0, NULL, NULL),
(2377, 'RENDY SAILAN PRATAMA', 'rendy-sailan-pratama_O3rbG', '2561_tech@fathforce.com', 'Student', NULL, '$2y$10$2oj2E6Ip2SgdyDT9eu21du2/GUNJ9Q.i9M5y5/FTVTF0lgPKOLFzS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:10', '2024-07-25 06:41:10', 0, NULL, NULL),
(2378, 'REZA RADITYA', 'reza-raditya_2MEi5', '2562_tech@fathforce.com', 'Student', NULL, '$2y$10$UKr3i.L4voqtlVsKrMZfJ.HBUHPyXem53S1BRdft6hRblQBSaDkeW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:10', '2024-07-25 06:41:10', 0, NULL, NULL),
(2379, 'RIFQI FIRMANSYAH', 'rifqi-firmansyah_6Xizf', '2563_tech@fathforce.com', 'Student', NULL, '$2y$10$1PcFOkEzpPxVC.fNwInCa.c6wn4iSUzvPtoiIhjCkvyyJNsRaylx.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:11', '2024-07-25 06:41:11', 0, NULL, NULL),
(2380, 'RIJWAN MAULANA', 'rijwan-maulana_oxtoH', '2564_tech@fathforce.com', 'Student', NULL, '$2y$10$i7LroZ8gzHVquEfmJyMhaOXKyUPH8ADk/5ZqzPHm1T2NdBQsWhMpO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:11', '2024-07-25 06:41:11', 0, NULL, NULL),
(2381, 'RIZAL BACHTIAR', 'rizal-bachtiar_Kc33j', '2565_tech@fathforce.com', 'Student', NULL, '$2y$10$9uVL7kOXVfc7y3Gx3tKSY.XcmDzMKpvL9UZOoIsfnHc0AEG3hx76m', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:11', '2024-07-25 06:41:11', 0, NULL, NULL),
(2382, 'RIZALUL KHOIIR RAMJANI', 'rizalul-khoiir-ramjani_PMQeD', '2566_tech@fathforce.com', 'Student', NULL, '$2y$10$38VuW1dexdo.Q.9ilh785.tglh/bULujnQXB0Pz1yXIR2pwPxbDBO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:11', '2024-07-25 06:41:11', 0, NULL, NULL),
(2383, 'SYAHRUL AL-MUQTIAN', 'syahrul-al-muqtian_ZO3O8', '2567_tech@fathforce.com', 'Student', NULL, '$2y$10$m/qFxy/h4PCYArmTNGe1n.GHSq7HbUuj7YWMipHT.gMg/JY9Dghli', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:11', '2024-07-25 06:41:11', 0, NULL, NULL),
(2384, 'UJANG AZADDAROJATUN', 'ujang-azaddarojatun_Bb62X', '2568_tech@fathforce.com', 'Student', NULL, '$2y$10$cYVOJOpOjij6Faw1Cvhscu.L9JozdaHZazjqxgbxOmvyJxvKktjWS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:11', '2024-07-25 06:41:11', 0, NULL, NULL),
(2385, 'YAZID JULIANI', 'yazid-juliani_j0QMA', '2569_tech@fathforce.com', 'Student', NULL, '$2y$10$mBwvE9VFk90YiF4B7K5kZOC9DUoGnncXaZAy6avPJn4qeo56lrVsq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:11', '2024-07-25 06:41:11', 0, NULL, NULL),
(2386, 'ZIHAN MUHAMMAD AKBAR', 'zihan-muhammad-akbar_QJnXM', '2570_tech@fathforce.com', 'Student', NULL, '$2y$10$NYCE9aqB5Nb2Uh1n.4I2P.TUPOe5nOk9Ndj8i0TEjhePvSSpaMcPG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:11', '2024-07-25 06:41:11', 0, NULL, NULL),
(2387, 'SANTI SULASTRI, S.Pd.', 'santi-sulastri-spd_wgPoC', '1166_tech@gmail.com', 'Teacher', NULL, '$2y$10$88SE/kamBeUGxiCiW97xG.aX1Mafh92yGrQ4Q46DRtVYX40rXZhH2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '0123456', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:14', '2024-07-25 06:41:14', 0, NULL, NULL),
(2388, 'ADITYA REZKY RAMDHANI', 'aditya-rezky-ramdhani_W0Why', '2571_tech@fathforce.com', 'Student', NULL, '$2y$10$ms9araj3nHQ1dNIdCBu57eJ8GJS6gsTg8N.zw0.ROllsayOiORshi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:21', '2024-07-25 06:41:21', 0, NULL, NULL),
(2389, 'AGUNG PERMANA', 'agung-permana_CXjaW', '2572_tech@fathforce.com', 'Student', NULL, '$2y$10$OjyaUS3l2GfYleIh1Az.We2OROw/hPyidRvN8vEHC6HNCFL5ZPv7u', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:21', '2024-07-25 06:41:21', 0, NULL, NULL),
(2390, 'AKMAR SIDIK', 'akmar-sidik_uhn4A', '2573_tech@fathforce.com', 'Student', NULL, '$2y$10$sAfv00WSIp0ztWTYoHOcWezKw/wENQ3/eaOA84VibQm3R/Wuyt2vW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:21', '2024-07-25 06:41:21', 0, NULL, NULL),
(2391, 'ALDI RAMADANI', 'aldi-ramadani_1if3q', '2574_tech@fathforce.com', 'Student', NULL, '$2y$10$juA1mQ623WvmCofn17yJX.YHDNN8QbpJ.rpSrV19ff.RalMd1ZRcK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:21', '2024-07-25 06:41:21', 0, NULL, NULL),
(2392, 'ALI JUMALI', 'ali-jumali_cDWuj', '2575_tech@fathforce.com', 'Student', NULL, '$2y$10$.DUseMYswww55rO8rNjdLuFPEdBTOSHQ3aAiz3iH2ItGzVWoSey0G', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:22', '2024-07-25 06:41:22', 0, NULL, NULL),
(2393, 'ANDIKA GALUH KUSUMA', 'andika-galuh-kusuma_yKPpA', '2576_tech@fathforce.com', 'Student', NULL, '$2y$10$uNR7JmWf5B4A1E6uKV0QuuEbxecKpgLLaPaXExuxxVbEFLHk4TR/i', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:22', '2024-07-25 06:41:22', 0, NULL, NULL),
(2394, 'ARI APRINZANI', 'ari-aprinzani_Quikr', '2577_tech@fathforce.com', 'Student', NULL, '$2y$10$IGZa3WjKpT7n5y/HacunK.jPdcaCBG0oAYmB0AvnKoRu/NDZVwNya', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:22', '2024-07-25 06:41:22', 0, NULL, NULL),
(2395, 'ARIS RISYANA', 'aris-risyana_xLQxa', '2578_tech@fathforce.com', 'Student', NULL, '$2y$10$eM0D.WCz2rsVuSL1idYFiu9xK7Za3wO3KANNYJWM/BDNM83Fkqoiu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:22', '2024-07-25 06:41:22', 0, NULL, NULL),
(2396, 'ASEP LEDI', 'asep-ledi_juSXS', '2579_tech@fathforce.com', 'Student', NULL, '$2y$10$vcnvXabqBBJSlypZirH2Duviu9P67CDEgbjCHFZ1BFsFsYd8muM0q', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:22', '2024-07-25 06:41:22', 0, NULL, NULL),
(2397, 'DENI KHOERUDIN AS-SIDIQ', 'deni-khoerudin-as-sidiq_1DSvX', '2580_tech@fathforce.com', 'Student', NULL, '$2y$10$CmVu5eeAwaM58lk8ZFwA1eUO2l8/PHkg1nFm60CJWeioVbBJtR4P2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:22', '2024-07-25 06:41:22', 0, NULL, NULL),
(2398, 'DESTA MAULANA SIDIQ', 'desta-maulana-sidiq_wAuDu', '2581_tech@fathforce.com', 'Student', NULL, '$2y$10$68Us/0fbHW7v2h.Wsbz51eqf1MeUWEPqiNGnDqKCiPOwRA1FehxK2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:22', '2024-07-25 06:41:22', 0, NULL, NULL);
INSERT INTO `users` (`id`, `name`, `username`, `email`, `role`, `email_verified_at`, `password`, `code`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `fcm_token`, `current_team_id`, `profile_photo_path`, `status`, `phone`, `address`, `department_id`, `date_of_birth`, `gender`, `account_hold`, `created_at`, `updated_at`, `tour_completed`, `face_embedding`, `id_reference`) VALUES
(2399, 'FAIZAL RAMDANI', 'faizal-ramdani_nYjQf', '2582_tech@fathforce.com', 'Student', NULL, '$2y$10$eUuHiz0aNjDF2guOtWvdKuv3F4H6levooLBcU7TtwaXxoIPoGT9Bm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:22', '2024-07-25 06:41:22', 0, NULL, NULL),
(2400, 'FUAD MUHAMAD HILMI', 'fuad-muhamad-hilmi_zlI58', '2583_tech@fathforce.com', 'Student', NULL, '$2y$10$N35OIFNIjlV2/AMxQz.pUexAxq2Tx49o.F5l4uvEf7iQUdDmSxLQq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:22', '2024-07-25 06:41:22', 0, NULL, NULL),
(2401, 'GIAS MUGIA PAMUNGKAS', 'gias-mugia-pamungkas_Zuj2S', '2584_tech@fathforce.com', 'Student', NULL, '$2y$10$MtHEJVaq74o2GIfbX8rMUO.8EvbQmSDKBnL8p4qA2Dtq5q7fRBfCy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:22', '2024-07-25 06:41:22', 0, NULL, NULL),
(2402, 'JAJANG NURZAMAN', 'jajang-nurzaman_D21Jb', '2585_tech@fathforce.com', 'Student', NULL, '$2y$10$Hc.3FsJ/k84kyDC6LPQe..U3yiilcYaLfegOWBM2kBxqVXqebRy66', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:22', '2024-07-25 06:41:22', 0, NULL, NULL),
(2403, 'KAKA RIZKI NURJANI', 'kaka-rizki-nurjani_0COuC', '2586_tech@fathforce.com', 'Student', NULL, '$2y$10$UMMsO1AJkZbDWDt71e7XNOBU.W5WLvwkt/u/L1Rl9tsyTgqQXZWBe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:22', '2024-07-25 06:41:22', 0, NULL, NULL),
(2404, 'KIANUL FAHMI', 'kianul-fahmi_bf6FC', '2587_tech@fathforce.com', 'Student', NULL, '$2y$10$eoyMN9UDPssJ86YpTtO5ye8QTUndiSIKvtdZ/go7v4JtJLefKi2F.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:22', '2024-07-25 06:41:22', 0, NULL, NULL),
(2405, 'MUHAMAD FARID ANUGRAH', 'muhamad-farid-anugrah_4LiDO', '2588_tech@fathforce.com', 'Student', NULL, '$2y$10$3fZuQKYIuID8PRC9RAK1zecgfPT8/uzdRRqEI3H8ZVbEYb/HDJwLy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:23', '2024-07-25 06:41:23', 0, NULL, NULL),
(2406, 'MUHAMAD RAIHAN PERMANA', 'muhamad-raihan-permana_G006G', '2589_tech@fathforce.com', 'Student', NULL, '$2y$10$ItgB4wQ6/K/s5UPPih5NO.hQOgVR7dMJ5DOt.OPZ7AaojO3PnB8am', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:23', '2024-07-25 06:41:23', 0, NULL, NULL),
(2407, 'MUHAMMAD FEBRI MUSAFA', 'muhammad-febri-musafa_tYaHm', '2590_tech@fathforce.com', 'Student', NULL, '$2y$10$RSHv55b27eoYti5Gs8FbqeRNF5zOuGHumr4edl31J433lLYlGU2oq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:23', '2024-07-25 06:41:23', 0, NULL, NULL),
(2408, 'NABIL FATHULROHMAN', 'nabil-fathulrohman_yf7lN', '2591_tech@fathforce.com', 'Student', NULL, '$2y$10$KhqLgPyqf4Qqv70Nw6bE/uwP9SJg/CQo/6OZVraPY16O4Mtxb9IuK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:23', '2024-07-25 06:41:23', 0, NULL, NULL),
(2409, 'NAZAR HABSY MUALIM', 'nazar-habsy-mualim_K0nm6', '2592_tech@fathforce.com', 'Student', NULL, '$2y$10$wXDbku1zPrT1GrATQmSqjerRsVSpKCjd/7jDRDk/KUN88/87BaUyG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:23', '2024-07-25 06:41:23', 0, NULL, NULL),
(2410, 'NICHOLA SANDI HANIF', 'nichola-sandi-hanif_fx0uV', '2593_tech@fathforce.com', 'Student', NULL, '$2y$10$M461DGJKYabijCltU.OOA.H/8M9P1xkyCqZcAGVXpGUXxO6lACVBy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:23', '2024-07-25 06:41:23', 0, NULL, NULL),
(2411, 'NOVA PAJRI DWI YAHYA', 'nova-pajri-dwi-yahya_3SDBg', '2594_tech@fathforce.com', 'Student', NULL, '$2y$10$eLK5HCp9qOMPjEospTRDuOULVPckrpx.OcHcGEg3rx4w.jc/Lea4m', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:23', '2024-07-25 06:41:23', 0, NULL, NULL),
(2412, 'NUR FARIZ', 'nur-fariz_qitpH', '2595_tech@fathforce.com', 'Student', NULL, '$2y$10$SKj2hjgrsY9DVPCmUjShae/TDES0ooCsflhMN4RVZ9Lxfxa4EQ16e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:23', '2024-07-25 06:41:23', 0, NULL, NULL),
(2413, 'PAHMI PAUZI SURATMAN', 'pahmi-pauzi-suratman_VPKhf', '2596_tech@fathforce.com', 'Student', NULL, '$2y$10$yK7rH7gyXirgTaxN/pafWuVPOdKbP5aBIBv0O5XOfGCMSYEpoUJWm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:23', '2024-07-25 06:41:23', 0, NULL, NULL),
(2414, 'RADITYA ELVAN PRATAMA', 'raditya-elvan-pratama_Sv4li', '2597_tech@fathforce.com', 'Student', NULL, '$2y$10$dlqS7idqz2hbnHuA.69Ux.Nh7oHTYaJdRH5DoN88spuSWwK.J4OEW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:23', '2024-07-25 06:41:23', 0, NULL, NULL),
(2415, 'RAFIF PRATAMA PUTRA', 'rafif-pratama-putra_FelKM', '2598_tech@fathforce.com', 'Student', NULL, '$2y$10$KyaD0TdPXKFiAEqcwekLYOGqXyu8fdRgDkpN6GLHeYey6qVMMVSJm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:23', '2024-07-25 06:41:23', 0, NULL, NULL),
(2416, 'RAJIF MUHAMMAD IHYAR', 'rajif-muhammad-ihyar_9ET0f', '2599_tech@fathforce.com', 'Student', NULL, '$2y$10$OsVWcv3qz19yB8SnBMqoF.UerdPT1HrvK10Vd63mTHE8YIqu/slom', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:23', '2024-07-25 06:41:23', 0, NULL, NULL),
(2417, 'RAKA ALGI PRADITYA', 'raka-algi-praditya_IPM8q', '2600_tech@fathforce.com', 'Student', NULL, '$2y$10$jp.t9wYclYRb8M/tBPLsM.HQg082fxDRzm01ovnZ4ITjTvyiP4Ley', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:23', '2024-07-25 06:41:23', 0, NULL, NULL),
(2418, 'RAYHAN MUHAMMAD', 'rayhan-muhammad_0QF3B', '2601_tech@fathforce.com', 'Student', NULL, '$2y$10$g9yyCwem5wuG4Vd988lyqe.afa/XQcW.Ful/BzdPXdmZmW6cC9NPe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:24', '2024-07-25 06:41:24', 0, NULL, NULL),
(2419, 'RIZKI MUHAMMAD MAULANI', 'rizki-muhammad-maulani_5uzBL', '2602_tech@fathforce.com', 'Student', NULL, '$2y$10$1X1xB6670mVg3D.qt3E3WexI4jw68WiFsXfLbvDLAzBokq.Y.YTUK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:24', '2024-07-25 06:41:24', 0, NULL, NULL),
(2420, 'SAM ARIFIN', 'sam-arifin_Tgof2', '2603_tech@fathforce.com', 'Student', NULL, '$2y$10$uWnpv0XFFzZUq3K0wiu73eeQt//a1UPwqaOwtEE4ODKyu/TIJI.sO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:24', '2024-07-25 06:41:24', 0, NULL, NULL),
(2421, 'SONI SETIAWAN', 'soni-setiawan_PvA3n', '2604_tech@fathforce.com', 'Student', NULL, '$2y$10$AZ8ld6ZKivCpszxQ6I2d/OuZq1PdqzJtaMGeaNTc9DFwPP4oUtBDG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:24', '2024-07-25 06:41:24', 0, NULL, NULL),
(2422, 'YUSRON ALI SUKMARA', 'yusron-ali-sukmara_z7ZpY', '2605_tech@fathforce.com', 'Student', NULL, '$2y$10$8/Vqp8cgUmZNpUGp1ofxv.3JbDGx3//AUeZWO.MbfW7.LkG2.aF1e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:24', '2024-07-25 06:41:24', 0, NULL, NULL),
(2423, 'ZAKY FAHRIANSYAH', 'zaky-fahriansyah_NAi3R', '2606_tech@fathforce.com', 'Student', NULL, '$2y$10$lgsrgZ/JuRCgJ7OAxSIy9OyUC5Lg0sSMFc/2p7AP3lfP87Vnx4o0.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:24', '2024-07-25 06:41:24', 0, NULL, NULL),
(2424, 'ADE ANGGA PURNAMA', 'ade-angga-purnama_RfDug', '2607_tech@fathforce.com', 'Student', NULL, '$2y$10$z3Yg4TOhWYpKZhE3mVemNOVs7eaG8i3P.GLpjSFZrpOD.B5yoj8qW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:34', '2024-07-25 06:41:34', 0, NULL, NULL),
(2425, 'ADE RAFI RAMDANI', 'ade-rafi-ramdani_kB0Vn', '2608_tech@fathforce.com', 'Student', NULL, '$2y$10$NVQAcpb.UK4gQkb9MRqCQOUgJuF1JZRKT1E5/1cBxLL8DExoB4QUe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:34', '2024-07-25 06:41:34', 0, NULL, NULL),
(2426, 'ADI ABDULLOH', 'adi-abdulloh_OdSVz', '2609_tech@fathforce.com', 'Student', NULL, '$2y$10$J3UQ4/baa6nQWDLOiyjY9.KQFzdGq56u.6lhy4T2kiLqF5iHS7ix.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:34', '2024-07-25 06:41:34', 0, NULL, NULL),
(2427, 'ALDI PIRMANSAH', 'aldi-pirmansah_nsHMl', '2610_tech@fathforce.com', 'Student', NULL, '$2y$10$Ubj7x/gG/Ouz.X6dZ3kA5.aT2nBApa25YcIc8iskAR2iZWLAU/Pd2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:34', '2024-07-25 06:41:34', 0, NULL, NULL),
(2428, 'ANDHIKA CANDRA SATRIA', 'andhika-candra-satria_oo0l1', '2611_tech@fathforce.com', 'Student', NULL, '$2y$10$hXMgW4qhJdZm7yovV0eWL.VkaNbcDSfVcwLFwDfy0tAasqQeq70fO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:34', '2024-07-25 06:41:34', 0, NULL, NULL),
(2429, 'ANDI IRAWAN', 'andi-irawan_dUW2d', '2612_tech@fathforce.com', 'Student', NULL, '$2y$10$PZ6Ovo6hjxhVVWPlGwM6GeXPALjfmayuNWsaKnTISVMDb5hyA2qke', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:34', '2024-07-25 06:41:34', 0, NULL, NULL),
(2430, 'ANIDA AMALIA FUTRI', 'anida-amalia-futri_9wF68', '2613_tech@fathforce.com', 'Student', NULL, '$2y$10$O7DYuqTsvGWo4/ObmZJ79uvl2L1uKIwcJVCdomSIVTe9.nrbexRzW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:34', '2024-07-25 06:41:34', 0, NULL, NULL),
(2431, 'ARIEL GUSMAN IMANUDDIN', 'ariel-gusman-imanuddin_f6Er8', '2614_tech@fathforce.com', 'Student', NULL, '$2y$10$xjEdN2pjoSLc5yOe7QU.we7aICd1lmnxcUfstnbOQyqamFm8.OmD6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:34', '2024-07-25 06:41:34', 0, NULL, NULL),
(2432, 'ARIK RABANI', 'arik-rabani_OW8Fn', '2615_tech@fathforce.com', 'Student', NULL, '$2y$10$Z59JiFiF0v.vIPKJhScW/u940XEgEFmb/unc/wOgM1dzQP.83FkZO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:34', '2024-07-25 06:41:34', 0, NULL, NULL),
(2433, 'ATIN HERLINA', 'atin-herlina_1I1pJ', '2616_tech@fathforce.com', 'Student', NULL, '$2y$10$.1ya68F7pbc7LsXmIwlRW.wFDYcVutSaLf8E7mm8c6/s2JFFLMR2q', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:34', '2024-07-25 06:41:34', 0, NULL, NULL),
(2434, 'AZKA ZAMALUDIN NURSYAWALI', 'azka-zamaludin-nursyawali_8Forj', '2617_tech@fathforce.com', 'Student', NULL, '$2y$10$UWctEwLor7Fqhy/VUO0xd.a2E4/TsBA0LNRfqVAcfZlTuINheUUcm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:34', '2024-07-25 06:41:34', 0, NULL, NULL),
(2435, 'DIPA NURKASTA RIANA PUTRA', 'dipa-nurkasta-riana-putra_Oe3oC', '2618_tech@fathforce.com', 'Student', NULL, '$2y$10$H2n1MxAwlAKGEmPVWKmON.DPs3VHuJVNnEOajo14OX.Za3TsFG8j.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:34', '2024-07-25 06:41:34', 0, NULL, NULL),
(2436, 'GALANG PASCA PRATAMA HIDAYAT', 'galang-pasca-pratama-hidayat_laxtO', '2619_tech@fathforce.com', 'Student', NULL, '$2y$10$z0CcN6Cyc8V62QaqxPgxdutkMFPuxsfkEFhIGEOmdBrcn3fyQ24Bq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:35', '2024-07-25 06:41:35', 0, NULL, NULL),
(2437, 'GALIH MAULANA MALIK', 'galih-maulana-malik_XmCJf', '2620_tech@fathforce.com', 'Student', NULL, '$2y$10$HpHs6XeWZNfjUvE0ulT24.8Vdz1zuiXNQWWy.YXFro3c7hDbywaKi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:35', '2024-07-25 06:41:35', 0, NULL, NULL),
(2438, 'HIKMAL HAKIM', 'hikmal-hakim_1IzaD', '2621_tech@fathforce.com', 'Student', NULL, '$2y$10$W4i1syXUZ6aH/scPEJBptOGJmAqEioWF40/h6nJCXbv7elqEVETYa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:35', '2024-07-25 06:41:35', 0, NULL, NULL),
(2439, 'HILMAN RAMADAN', 'hilman-ramadan_KkX74', '2622_tech@fathforce.com', 'Student', NULL, '$2y$10$N9JRY/abXH7cCi0iwWRhE.V9pmlKjeZ9tcy1XMjgaVHV8a5rHBIfq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:35', '2024-07-25 06:41:35', 0, NULL, NULL),
(2440, 'ISMAIL MAULANA', 'ismail-maulana_MYjEI', '2623_tech@fathforce.com', 'Student', NULL, '$2y$10$rL78wmoHHJeeJANqnaMPMeiPlZrVS.1KmqDQ73AebwDh3I/83/BQC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:35', '2024-07-25 06:41:35', 0, NULL, NULL),
(2441, 'JAKA MAULANA', 'jaka-maulana_F2h21', '2624_tech@fathforce.com', 'Student', NULL, '$2y$10$Yu5vBZhjw671QLlnla/Ns./yJxbhAh5LJmtP8mGA72LUl.C4lMJfS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:35', '2024-07-25 06:41:35', 0, NULL, NULL),
(2442, 'MUHAMAD HIBNU MAULIDAN', 'muhamad-hibnu-maulidan_m0Xz4', '2625_tech@fathforce.com', 'Student', NULL, '$2y$10$7vZBPnUgo2AN3FqF9Qf/mu/E8mNeorigGbhJ7ezza1AzARy/vhT.C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:35', '2024-07-25 06:41:35', 0, NULL, NULL),
(2443, 'MUHAMAD IQBAL NOORHOLIQ', 'muhamad-iqbal-noorholiq_K5gTy', '2626_tech@fathforce.com', 'Student', NULL, '$2y$10$iHkCNP6TtRaAXHfnZ2hg3eizRx7qHdncpSkbDi./QUUo5VhRX.73C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:35', '2024-07-25 06:41:35', 0, NULL, NULL),
(2444, 'MUHMMAD FAIZ NURUL IMAN', 'muhmmad-faiz-nurul-iman_NWYgh', '2627_tech@fathforce.com', 'Student', NULL, '$2y$10$s5TlxZLFs8A.7lbP/JItBe2CXqxKXwPSRFVKVdeKiF54QwTyuAQLS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:35', '2024-07-25 06:41:35', 0, NULL, NULL),
(2445, 'NELI NURLENI', 'neli-nurleni_NEBMW', '2628_tech@fathforce.com', 'Student', NULL, '$2y$10$QP3Rsyw.vX94TazfhgZBE.pb450fEaRIevHJuwbStRpj3Tv8huzv6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:35', '2024-07-25 06:41:35', 0, NULL, NULL),
(2446, 'NURUL MUTAQIN', 'nurul-mutaqin_iGV5P', '2629_tech@fathforce.com', 'Student', NULL, '$2y$10$Xm5tF99Gtbs8h14DpUQIg.yyWOlQtohqnU7DnoCFAOwaWzprs.1A2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:35', '2024-07-25 06:41:35', 0, NULL, NULL),
(2447, 'PEBRI DWI ANDIKA', 'pebri-dwi-andika_XfpLB', '2630_tech@fathforce.com', 'Student', NULL, '$2y$10$6QtVZMK/ppsNypaoNUQCruexVlJ0BerTNS/FXy4Bil4zbBFooFzhS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:35', '2024-07-25 06:41:35', 0, NULL, NULL),
(2448, 'PIPIT MEILANI', 'pipit-meilani_O6Ntc', '2631_tech@fathforce.com', 'Student', NULL, '$2y$10$WN.YjkvsjX4oMNZxJF56Zu4MgjnpZNebs62c0J9G/aTvI/4dHaNfS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:35', '2024-07-25 06:41:35', 0, NULL, NULL),
(2449, 'PUTERA FAEYZA PRAKARSA RAMADHAN', 'putera-faeyza-prakarsa-ramadhan_6LlIX', '2632_tech@fathforce.com', 'Student', NULL, '$2y$10$b.HhNIE81/m1kIqtQgh72O9pKmdUENx.MHcpb9zG98OeekDQbiQwG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:35', '2024-07-25 06:41:35', 0, NULL, NULL),
(2450, 'RAFLI DAHMANA PUTRA', 'rafli-dahmana-putra_M2ela', '2633_tech@fathforce.com', 'Student', NULL, '$2y$10$NZRmnsaqU4sIguCsmAqud..fvbYTCIkhRAy4pChWkkH0rBWg51MZm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:35', '2024-07-25 06:41:35', 0, NULL, NULL),
(2451, 'REVA SILVIRA', 'reva-silvira_R8FrL', '2634_tech@fathforce.com', 'Student', NULL, '$2y$10$3.xQ6mmdu0bSusa.0SRY/OLryQl47NAydoMcW3TLsk.1v69pe9DWW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:36', '2024-07-25 06:41:36', 0, NULL, NULL),
(2452, 'RIDA RAMDANI', 'rida-ramdani_GnaUD', '2635_tech@fathforce.com', 'Student', NULL, '$2y$10$bJf1WE8W26tP0P3K4Wm1YeoPhwK8M46SAw9ubQTdBdhMjlMos1X2i', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:36', '2024-07-25 06:41:36', 0, NULL, NULL),
(2453, 'RIPA RAHMAN', 'ripa-rahman_xvagM', '2636_tech@fathforce.com', 'Student', NULL, '$2y$10$GMTTgVZHMHIjOE03mvknUuDPbvuI4N5LWZi.gGQsebhPPRBw1nMcO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:36', '2024-07-25 06:41:36', 0, NULL, NULL),
(2454, 'RIZKY NURFAJAR', 'rizky-nurfajar_uKy2s', '2637_tech@fathforce.com', 'Student', NULL, '$2y$10$qF2xZJOC1PdWqqD0..FDFehiwURNtZg3Asv1XyfZcmhjDINvuydwO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:36', '2024-07-25 06:41:36', 0, NULL, NULL),
(2455, 'SALFA ALZAHRA', 'salfa-alzahra_twWvu', '2638_tech@fathforce.com', 'Student', NULL, '$2y$10$/y1psoGcdFcli4D7iDgJO.7mCadw/9.EpC9NXxhyyAMe/tU.XuTkO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:36', '2024-07-25 06:41:36', 0, NULL, NULL),
(2456, 'SITI RAHMA RAMADHANI', 'siti-rahma-ramadhani_CpMqy', '2639_tech@fathforce.com', 'Student', NULL, '$2y$10$yia6Sylf4QySN04BRxBazuhMOi2kPyAensPcuwmNYwZLAkk23Q5cK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:36', '2024-07-25 06:41:36', 0, NULL, NULL),
(2457, 'WILDAN SOLEHUDIN', 'wildan-solehudin_9Mnqs', '2640_tech@fathforce.com', 'Student', NULL, '$2y$10$gohZX/XknLZB7vQVb1HVcenXfmAkGaxFw2Fzs0OD7WUub9HjCayfe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:36', '2024-07-25 06:41:36', 0, NULL, NULL),
(2458, 'YUSUF RAHARJA', 'yusuf-raharja_0wE4o', '2641_tech@fathforce.com', 'Student', NULL, '$2y$10$2bytrL8QsZCrgFfyZQds3OlrAU4IfYfskNIyGegYDIoUuaJQ8YWtS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:36', '2024-07-25 06:41:36', 0, NULL, NULL),
(2459, 'ZIDANE FATRIA SUKMA BUANA', 'zidane-fatria-sukma-buana_5mAgh', '2642_tech@fathforce.com', 'Student', NULL, '$2y$10$Iht3Iu.nWeQZIHO7YJGk8upCTSBgLeV3gLeogmHq.r8QXae7mpCEu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:36', '2024-07-25 06:41:36', 0, NULL, NULL),
(2460, 'ADITYA NUGRAHA', 'aditya-nugraha_cGuBv', '2643_tech@fathforce.com', 'Student', NULL, '$2y$10$DEXJ0Nv9pzXPo.tloMBn9OYp5qzpMcelbSTLwANTiqZPiTxX.s7JW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:48', '2024-07-25 06:41:48', 0, NULL, NULL),
(2461, 'AHMAD RIZKIYANSYAH', 'ahmad-rizkiyansyah_xq0GO', '2644_tech@fathforce.com', 'Student', NULL, '$2y$10$4OlqrW0KlsYGpj6SsgRRS.vTztofc/IY6CTSPBdwdJLpvDSo.5wbe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:49', '2024-07-25 06:41:49', 0, NULL, NULL),
(2462, 'ANEEZKA HEXSA PURNAMA', 'aneezka-hexsa-purnama_3YLYS', '2645_tech@fathforce.com', 'Student', NULL, '$2y$10$psmDVPEOmIUgbZnMeg/Fnuftn9fEhaC0obfSFE5VQeLOIekF6dT6q', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:49', '2024-07-25 06:41:49', 0, NULL, NULL),
(2463, 'ANGGA NUGRAHA', 'angga-nugraha_vwnfZ', '2646_tech@fathforce.com', 'Student', NULL, '$2y$10$YvtLeYEoHMo8MSdRyr3uMOs6ksGHXL.hyVWw.j.Xen7IG8cfoZI76', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:49', '2024-07-25 06:41:49', 0, NULL, NULL),
(2464, 'ANISA KAILA NAJMI FADILAH', 'anisa-kaila-najmi-fadilah_xWKw9', '2647_tech@fathforce.com', 'Student', NULL, '$2y$10$FM6AP6NJcrBpu9p5/fPqa.rcC20gl8lgM0rBVAhvzvt3Fh7PJJ.uO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:49', '2024-07-25 06:41:49', 0, NULL, NULL),
(2465, 'ARYA HIDAYAT', 'arya-hidayat_anes1', '2648_tech@fathforce.com', 'Student', NULL, '$2y$10$4LTsnnj6LYKlpXGjmLVr8.XVPsjXoy.Tk.xliDnXCi11PEs3rNwl.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:49', '2024-07-25 06:41:49', 0, NULL, NULL),
(2466, 'DANISH ALTAFA SETIYAWAN', 'danish-altafa-setiyawan_Xr4BI', '2649_tech@fathforce.com', 'Student', NULL, '$2y$10$HTE7N0O0gCTFayfeKK2GqeyuVWxo9zHUwwBvnPV2sbfimbouaCusy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:49', '2024-07-25 06:41:49', 0, NULL, NULL),
(2467, 'DARIS NAUFAL', 'daris-naufal_nMgFs', '2650_tech@fathforce.com', 'Student', NULL, '$2y$10$iPIhbjAqflOqZYH1kBl5CeCBCH4AEeG92c/96GWpGqlRl/d/zr6Vq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:49', '2024-07-25 06:41:49', 0, NULL, NULL),
(2468, 'DELA LATIPAH', 'dela-latipah_ql2XF', '2651_tech@fathforce.com', 'Student', NULL, '$2y$10$CGu1ioXeVBEVadW4z/qmrOOfAUuOG2Cs..f3DIw7LcBS76cmbqcLG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:49', '2024-07-25 06:41:49', 0, NULL, NULL),
(2469, 'DIAN SELFIANA', 'dian-selfiana_OPoyS', '2652_tech@fathforce.com', 'Student', NULL, '$2y$10$.bQk5GX/.18C76tQ5toFeOfXJos5IIydNtBuxl6SCnXmqnfYuhumi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:49', '2024-07-25 06:41:49', 0, NULL, NULL),
(2470, 'DIMAS SEPTIAN RAMADHAN', 'dimas-septian-ramadhan_odBwp', '2653_tech@fathforce.com', 'Student', NULL, '$2y$10$R.f4t4tuCW8XTbAOR6c.OOSWCIkG/0fuMEvwoGZHacgd0JOkWdIVa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:49', '2024-07-25 06:41:49', 0, NULL, NULL),
(2471, 'ELIDA NOVIANTI', 'elida-novianti_rPwfR', '2654_tech@fathforce.com', 'Student', NULL, '$2y$10$77SCe2iL4wdFWa5mhAvtqe9rqwqMxPr5mu9LTTKyJFbK1SwrtmiCC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:49', '2024-07-25 06:41:49', 0, NULL, NULL),
(2472, 'ELSHA AMELIA AFIFAH', 'elsha-amelia-afifah_EgtWe', '2655_tech@fathforce.com', 'Student', NULL, '$2y$10$q7qJlP4KOs8hya8uhbz2ouVaj8CfNZll.rsNT8HrDfd7ZyuDnNdyC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:49', '2024-07-25 06:41:49', 0, NULL, NULL),
(2473, 'FARIS FATUR RACHMAN', 'faris-fatur-rachman_7jD5C', '2656_tech@fathforce.com', 'Student', NULL, '$2y$10$9ozdmftNNMGjbpXAi/tsfugPqf0kZZk6rbE6jSiFmT2Si/EvgxwsS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:49', '2024-07-25 06:41:49', 0, NULL, NULL),
(2474, 'INA NOVIYANTI', 'ina-noviyanti_UQQzn', '2657_tech@fathforce.com', 'Student', NULL, '$2y$10$8qvBJnQG98D698yVGC9tEuLqhjJhhAPEZVB4aq9XCsFO98uX8EELa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:49', '2024-07-25 06:41:49', 0, NULL, NULL),
(2475, 'INDRA JULIANA', 'indra-juliana_USk1L', '2658_tech@fathforce.com', 'Student', NULL, '$2y$10$M5ZBqrYWzjDDSME5H7lTVu.6z4T/xEMKMJe80idemnBwajDYnF3Dm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:49', '2024-07-25 06:41:49', 0, NULL, NULL),
(2476, 'INTAN ALIFFIA MAHARANI', 'intan-aliffia-maharani_4jXwo', '2659_tech@fathforce.com', 'Student', NULL, '$2y$10$ZRjlU50XEHLGzFrvehqrZ.fl0uFcvCEuip2l0ciOZJwHZATtH2Nk6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:50', '2024-07-25 06:41:50', 0, NULL, NULL),
(2477, 'INTAN SONIA', 'intan-sonia_F1eIl', '2660_tech@fathforce.com', 'Student', NULL, '$2y$10$UmvgGUoBBFOwkkTGWiOpfOW1kCkrhzrM1q2IVnY2ZA/I2wuMBgGse', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:50', '2024-07-25 06:41:50', 0, NULL, NULL),
(2478, 'LUTFI MAULANA', 'lutfi-maulana_QRxS7', '2661_tech@fathforce.com', 'Student', NULL, '$2y$10$snZV8flcrYpRixqrU0zitOoLVZG6ut9ckJV2dn.4H4X0RaG5oFD26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:50', '2024-07-25 06:41:50', 0, NULL, NULL),
(2479, 'MELLY AMELIA', 'melly-amelia_rl9e8', '2662_tech@fathforce.com', 'Student', NULL, '$2y$10$s.AlYB6sIOeI0qtQirK5mupu2rtED7dVeXUYm/.H4dqg/tIi1G83e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:50', '2024-07-25 06:41:50', 0, NULL, NULL),
(2480, 'MITA SULASTRI', 'mita-sulastri_Xmn7I', '2663_tech@fathforce.com', 'Student', NULL, '$2y$10$GmrsdjwH5XOp.S0F2I9qC.u2YpIZLa.rKZsKM.URCY7lqcF8RpRCi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:50', '2024-07-25 06:41:50', 0, NULL, NULL),
(2481, 'MUHAMAD FAUZAN ABDILAH', 'muhamad-fauzan-abdilah_YR1lk', '2664_tech@fathforce.com', 'Student', NULL, '$2y$10$FJvhMwfnWi3wSpN2ly/piOOmIhZJBE1MOX2XGSEXse8w.rN4Cj8kO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:50', '2024-07-25 06:41:50', 0, NULL, NULL),
(2482, 'NOVITA AMELIA', 'novita-amelia_dmlpL', '2665_tech@fathforce.com', 'Student', NULL, '$2y$10$aGyEuToeufCsGIFFeJkcu.Y1AgTXViAf/KFAF2UVqoO1.C6C5WSmK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:50', '2024-07-25 06:41:50', 0, NULL, NULL),
(2483, 'PUTRI FITRIANI SAFIRA', 'putri-fitriani-safira_qWSBZ', '2666_tech@fathforce.com', 'Student', NULL, '$2y$10$Dm1gF7B3i6dysp5AcsQamOVqzXLw5vdx2Key.T3kuSxbXMoQmkn7G', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:50', '2024-07-25 06:41:50', 0, NULL, NULL),
(2484, 'RASYA HIDAYAH SUKMARA', 'rasya-hidayah-sukmara_TDvfY', '2667_tech@fathforce.com', 'Student', NULL, '$2y$10$ZR2Pwh8JTTgC3oK0vB2uZOL0o9dpOoSGKBpnEYtMwJdP6DdfKReVS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:50', '2024-07-25 06:41:50', 0, NULL, NULL),
(2485, 'RAUDHOTUL JANNAH', 'raudhotul-jannah_1YnLU', '2668_tech@fathforce.com', 'Student', NULL, '$2y$10$s2iTPlLCPB4oAnIhHjkbQeFjEOsoJo9tnTaAJcY5g84sgzCNYi2B6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:50', '2024-07-25 06:41:50', 0, NULL, NULL),
(2486, 'RIKA LASTARI', 'rika-lastari_bszZc', '2669_tech@fathforce.com', 'Student', NULL, '$2y$10$sgd1JMjsqgG4/6Ey/8vPvOQ6qTm0d8PabBCUSzjE33A5VWfsCwgqi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:50', '2024-07-25 06:41:50', 0, NULL, NULL),
(2487, 'SAEPUL JIMI', 'saepul-jimi_nJZUa', '2670_tech@fathforce.com', 'Student', NULL, '$2y$10$e4OruLxL66GDWM9ZvOWBxuKDhR21rAeZaFyhiEosDkrxoTMO0Yqqe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:50', '2024-07-25 06:41:50', 0, NULL, NULL),
(2488, 'SALMAN MAULANA', 'salman-maulana_rY3K6', '2671_tech@fathforce.com', 'Student', NULL, '$2y$10$CrF8oaXNUfjp4W91R63DkOBc4/GJGQWWY8zStX9I1ry449OawSsDy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:50', '2024-07-25 06:41:50', 0, NULL, NULL),
(2489, 'SALSA HERDIANTIKA', 'salsa-herdiantika_mIGpR', '2672_tech@fathforce.com', 'Student', NULL, '$2y$10$8smNWFCk0K2LbX9zGACIE.2wTZk41pLegX8PqcgTtpY.WI1wksFOe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:50', '2024-07-25 06:41:50', 0, NULL, NULL),
(2490, 'SITI NUR FITRIANI', 'siti-nur-fitriani_NcPCR', '2673_tech@fathforce.com', 'Student', NULL, '$2y$10$7rdATOkL6b2H5METR9tao.0rWPAMn8/qQ4UzQghEcxURKgVjZO772', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:51', '2024-07-25 06:41:51', 0, NULL, NULL),
(2491, 'SOPIYANTI', 'sopiyanti_cDxWb', '2674_tech@fathforce.com', 'Student', NULL, '$2y$10$8bObk2TawPGdqzxi4k2O2O/o/9AkiUPOdcF5hcBEGndB3ph2Y5qKe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:51', '2024-07-25 06:41:51', 0, NULL, NULL),
(2492, 'SYILMI NUR SAKINAH', 'syilmi-nur-sakinah_04AW0', '2675_tech@fathforce.com', 'Student', NULL, '$2y$10$Sr/EpVnSxA9VcOwOU6K54OYU21OTp0xEvQwG3WaG66PUCvX8naFr6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:51', '2024-07-25 06:41:51', 0, NULL, NULL),
(2493, 'WIDIA AZAHRA', 'widia-azahra_xRJC8', '2676_tech@fathforce.com', 'Student', NULL, '$2y$10$lsOeA/SWHE1qAczgSf1EXepg2IsE0yj1/eIOnWRq/MB88.txfai9e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:51', '2024-07-25 06:41:51', 0, NULL, NULL),
(2494, 'WULAN HUZAEMAH', 'wulan-huzaemah_hLsmP', '2677_tech@fathforce.com', 'Student', NULL, '$2y$10$A8CawwBhuKf0ZdBMSIvhHuDzPV3Hi2O3GGCbwG62nAiyXrzf1EtGy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:51', '2024-07-25 06:41:51', 0, NULL, NULL),
(2495, 'YUDAN APRIANSYAH', 'yudan-apriansyah_aRy2J', '2678_tech@fathforce.com', 'Student', NULL, '$2y$10$Z5rfqExzWw55n5QcApgJ/.RbpIW6oaEnsMZ6RuxdsQIl8j2D7NAne', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:51', '2024-07-25 06:41:51', 0, NULL, NULL),
(2496, 'ACENG WILDAN LAKSANA', 'aceng-wildan-laksana_aVgwW', '2679_tech@fathforce.com', 'Student', NULL, '$2y$10$.1PkXCpOSDoUWqSvpPpVQefl6C0id.go1bD4mE.JoJ6ONzMg8XMCy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:59', '2024-07-25 06:41:59', 0, NULL, NULL),
(2497, 'AFGHAN GENOVA SUDRAJAT', 'afghan-genova-sudrajat_CXQIw', '2680_tech@fathforce.com', 'Student', NULL, '$2y$10$SVtOHB50PWvNwWHmzz72FeoTNiNBD/giZflgv.AMaE0rR0A1UIQSC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:41:59', '2024-07-25 06:41:59', 0, NULL, NULL),
(2498, 'AGIS RAMADANI', 'agis-ramadani_qM0qR', '2681_tech@fathforce.com', 'Student', NULL, '$2y$10$Fz2.hWZTbnD.pvHBeFwsgeHGPam0lkDTIdovIhnaSbLY6laIY2kRa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:42:00', '2024-07-25 06:42:00', 0, NULL, NULL),
(2499, 'ALIF DENIS HERDIANTO', 'alif-denis-herdianto_zndTm', '2682_tech@fathforce.com', 'Student', NULL, '$2y$10$5.rYu.1UN4ZwvCY7trP5ke8x0lUoaSx3b3o9DChhbgG2jXmcdRSsa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:42:00', '2024-07-25 06:42:00', 0, NULL, NULL),
(2500, 'ALIN JULIANI', 'alin-juliani_g3BwN', '2683_tech@fathforce.com', 'Student', NULL, '$2y$10$OpZRXmvhv/G2rPstZ42BX.sthrsIvLQPLJjHt4Ba9Ynp39AgcV0Ue', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:42:00', '2024-07-25 06:42:00', 0, NULL, NULL),
(2501, 'AULIA MARDIANA PUTRI', 'aulia-mardiana-putri_4xQpD', '2684_tech@fathforce.com', 'Student', NULL, '$2y$10$/wkJMqYFhRX/0U5po4oa2uTYJd4/sA/5Ak58WQTP1ThbLPA9gqUyy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:42:00', '2024-07-25 06:42:00', 0, NULL, NULL),
(2502, 'AULIA RAMADANI', 'aulia-ramadani_Lc63H', '2685_tech@fathforce.com', 'Student', NULL, '$2y$10$RIqh0e.ytVCr9BmzF9t6m.nXnJL/MPMvFc7ZvFVK6muYCvjYJKCbe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:42:00', '2024-07-25 06:42:00', 0, NULL, NULL),
(2503, 'AYU NURAENI', 'ayu-nuraeni_Ag9L2', '2686_tech@fathforce.com', 'Student', NULL, '$2y$10$CshCcLpI2KIDIqSs4GC9c..bdZeHkfPmU59hZvpwPJjinVY/2A57u', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:42:00', '2024-07-25 06:42:00', 0, NULL, NULL),
(2504, 'BAMBANG KAMAJAYA SURYA SAPUTRA DININGRAT', 'bambang-kamajaya-surya-saputra-diningrat_TpJdX', '2687_tech@fathforce.com', 'Student', NULL, '$2y$10$Ackimmsu3dB3ngxfBzpcAOabY55GguaJckhCK.I7DZM0/8aUKrj5q', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:42:00', '2024-07-25 06:42:00', 0, NULL, NULL),
(2505, 'CHARISTA CAMELIA', 'charista-camelia_yrFjw', '2688_tech@fathforce.com', 'Student', NULL, '$2y$10$03FOgqsOrxHLy3n/O1wyxuZ0Lxo80w16vKbhKsKFyzjOYH0wpGuE.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:42:00', '2024-07-25 06:42:00', 0, NULL, NULL),
(2506, 'DELISA YULIANTI', 'delisa-yulianti_xXnv2', '2689_tech@fathforce.com', 'Student', NULL, '$2y$10$7qQC6qmF0MGR1Y4iaQO99O5HvG1RxdbnqfmdGhd9MJLILrqiIQ7Ei', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:42:00', '2024-07-25 06:42:00', 0, NULL, NULL),
(2507, 'DEUIS SITI MUNIFAH', 'deuis-siti-munifah_8aEKo', '2690_tech@fathforce.com', 'Student', NULL, '$2y$10$0AgYcD.FhslX.mbRaZvJVOCrd8p0FdlV6RUaz2w9mCa4yy4Hd5XX.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:42:00', '2024-07-25 06:42:00', 0, NULL, NULL),
(2508, 'DINAR RESKI FAUZI', 'dinar-reski-fauzi_BWMb8', '2691_tech@fathforce.com', 'Student', NULL, '$2y$10$dy/50dGhO6Rj5pwnB8/0AezcRQv8atdh2cO.W3QvQbB4PBtZcHY6W', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:42:00', '2024-07-25 06:42:00', 0, NULL, NULL),
(2509, 'FADLIANSYAH RIZKI', 'fadliansyah-rizki_yGysG', '2692_tech@fathforce.com', 'Student', NULL, '$2y$10$9u/eK3mhfWPGyHhaj.hAKOV/0gArIHTfDjnc8bg152DmxCh5KEn9a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:42:00', '2024-07-25 06:42:00', 0, NULL, NULL),
(2510, 'FAKIH SABIKUL HOER', 'fakih-sabikul-hoer_rhm3l', '2693_tech@fathforce.com', 'Student', NULL, '$2y$10$tBn0zxbx7ZfmBG3jofE7/.DjCUH1YEmNWp8m5AylKhRgwjmWyxpKG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:42:00', '2024-07-25 06:42:00', 0, NULL, NULL),
(2511, 'HAMDAN', 'hamdan_eT4CF', '2694_tech@fathforce.com', 'Student', NULL, '$2y$10$u7j9MIXOYnJbn.DGmTet6Og/kJwG32YdTM2OczqPr.WjYVUKwANaW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:42:01', '2024-07-25 06:42:01', 0, NULL, NULL),
(2512, 'IKHSAN MULIA APRIANA', 'ikhsan-mulia-apriana_4qHVf', '2695_tech@fathforce.com', 'Student', NULL, '$2y$10$mJDSP3945pKmJl4OAXon5OGlmcvZt9/LBzyBIj2GAC0yLOPbzVM/C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:42:01', '2024-07-25 06:42:01', 0, NULL, NULL),
(2513, 'IMELDA NURCAHYANI', 'imelda-nurcahyani_sAEJZ', '2696_tech@fathforce.com', 'Student', NULL, '$2y$10$hZ.IGylqKBYh74wZDJOeseWqxR2r6XaMr3gYYYX0zpLfqrgfpk/lm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:42:01', '2024-07-25 06:42:01', 0, NULL, NULL),
(2514, 'KURNIA', 'kurnia_FY8UU', '2697_tech@fathforce.com', 'Student', NULL, '$2y$10$AhtnG9JmRVK6SAbap7qdL.cf.py98LwmCbNbikl1DjYgYD/XLraJe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:42:01', '2024-07-25 06:42:01', 0, NULL, NULL),
(2515, 'MAHESWARI RIHADATUL AISY', 'maheswari-rihadatul-aisy_evIFg', '2698_tech@fathforce.com', 'Student', NULL, '$2y$10$stn1zjtsz4Bva6hv0oEQP.u1cuj3bioT.BHBphQDdEwAngtLTBlt6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:42:01', '2024-07-25 06:42:01', 0, NULL, NULL),
(2516, 'MOCHAMAD AL FAREL DWI SEPTIAN', 'mochamad-al-farel-dwi-septian_2kqgc', '2699_tech@fathforce.com', 'Student', NULL, '$2y$10$5LjTYVj00Zyj60aFNhqqdOT8IxtJTMoSMgF5du0IN3kgEHIYoyzlO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:42:01', '2024-07-25 06:42:01', 0, NULL, NULL),
(2517, 'NABIL ALPATH ABDUL ROZAK', 'nabil-alpath-abdul-rozak_sYUHh', '2700_tech@fathforce.com', 'Student', NULL, '$2y$10$G2GnoF7GiHpu0lfenTcDrue8HZqas2rywReAYill623sE49xLt1g2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:42:01', '2024-07-25 06:42:01', 0, NULL, NULL),
(2518, 'NAZWA FITRIYANI', 'nazwa-fitriyani_Smr1t', '2701_tech@fathforce.com', 'Student', NULL, '$2y$10$eo9NVuhlQkbuiofqiBCTcO6mrMq0bOEryWr4355VJuxDOQ36kQ0/O', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:42:01', '2024-07-25 06:42:01', 0, NULL, NULL),
(2519, 'NINDY HENDAYANTY', 'nindy-hendayanty_tJKOV', '2702_tech@fathforce.com', 'Student', NULL, '$2y$10$H1OW/Gb7aCG/MiPxm5cwduxSpY5vz3cHpMHYhTHJyflI.Ss.ySpt6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:42:01', '2024-07-25 06:42:01', 0, NULL, NULL),
(2520, 'PUJI MAHARANI', 'puji-maharani_Yus1p', '2703_tech@fathforce.com', 'Student', NULL, '$2y$10$rLv7b.bCobsqkGuLNW04AeIV/MPO4LPRFetmiKpkw0KnARp/nWnaO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:42:01', '2024-07-25 06:42:01', 0, NULL, NULL),
(2521, 'RAFKA JULIAN PRATAMA', 'rafka-julian-pratama_taqf0', '2704_tech@fathforce.com', 'Student', NULL, '$2y$10$3XBNLfVb8x59TX2ZdM6wa.RqzHZtsh0nCGvluMXnqJAEfcK/JpXoS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:42:01', '2024-07-25 06:42:01', 0, NULL, NULL),
(2522, 'RARA NURUL FADHILAH', 'rara-nurul-fadhilah_WBMqH', '2705_tech@fathforce.com', 'Student', NULL, '$2y$10$0ledYujibHloTZEyBzqMAOW34ulrSIg2mrZCe841x8yS0paqha89e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:42:01', '2024-07-25 06:42:01', 0, NULL, NULL),
(2523, 'RESTI AWALIA', 'resti-awalia_BMYfd', '2706_tech@fathforce.com', 'Student', NULL, '$2y$10$xmEl/MNwMVeTb2gcOynF7.9jyB.4Tc9MVQ4p10Kic69msUvD2CB52', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:42:02', '2024-07-25 06:42:02', 0, NULL, NULL),
(2524, 'SAEPUL ANWAR', 'saepul-anwar_l1UU4', '2707_tech@fathforce.com', 'Student', NULL, '$2y$10$YbOPcdB.wzqkk3gDe2KWkeZDDb8SBNeO8.IOYgeKNL7UvZ7mMOz9W', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:42:02', '2024-07-25 06:42:02', 0, NULL, NULL),
(2525, 'SAFFIYA QOISARO RUSTENDI', 'saffiya-qoisaro-rustendi_ZXCGa', '2708_tech@fathforce.com', 'Student', NULL, '$2y$10$r5J9pF1MquPk3d68WyPPi.ikGZLpDeL3pI4B7S7ss7CiPtnv3jSdm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:42:02', '2024-07-25 06:42:02', 0, NULL, NULL),
(2526, 'SITI FARIDAH', 'siti-faridah_tup0I', '2709_tech@fathforce.com', 'Student', NULL, '$2y$10$itlxbdTe.BAi0emXFOS.0.CbWES7l0kTBGjlqyJDl4LKcYPx0tRJK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:42:02', '2024-07-25 06:42:02', 0, NULL, NULL),
(2527, 'SITI NURWAHIDAH', 'siti-nurwahidah_gVqzt', '2710_tech@fathforce.com', 'Student', NULL, '$2y$10$enLulmECc9gNYr1Bw.eB8u5Cq9tb681h0TM1MPsDYa0XbuNdT7GHa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:42:02', '2024-07-25 06:42:02', 0, NULL, NULL),
(2528, 'SYADRAH TITIK QADAR', 'syadrah-titik-qadar_lZf3q', '2711_tech@fathforce.com', 'Student', NULL, '$2y$10$0dVbzvK9Xjo.7h70VK.CnuublGD5kEet/QPRsYkSb1x6XbTkz3iGG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:42:02', '2024-07-25 06:42:02', 0, NULL, NULL),
(2529, 'TIRTA IBNU WIBOWO', 'tirta-ibnu-wibowo_XzjLT', '2712_tech@fathforce.com', 'Student', NULL, '$2y$10$afcklAzhOJrM6m0ZVlTor./r.U/SFnDQ2sZqOGC9sZfKw3djgVAY.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:42:02', '2024-07-25 06:42:02', 0, NULL, NULL),
(2530, 'YUNISHA RAMADHANI', 'yunisha-ramadhani_KtsRf', '2713_tech@fathforce.com', 'Student', NULL, '$2y$10$xTyS8NCGSRRf/gu1/IH1/uG74ovLnZcAsL3eExfnn3EGNZjPN1UNe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:42:02', '2024-07-25 06:42:02', 0, NULL, NULL),
(2531, 'ZEINA VANKA AZAHARA', 'zeina-vanka-azahara_FPOK2', '2714_tech@fathforce.com', 'Student', NULL, '$2y$10$J.QwU0RwgetyhwjnMCRZdeDe2vhSG/TgYD4iAwBnrv9dijCAbIzpq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:42:02', '2024-07-25 06:42:02', 0, NULL, NULL),
(2532, 'ADE NOPIANTI MUHAROMAH, S.Pd', 'ade-nopianti-muharomah-spd_EAXi7', '1167_tech@gmail.com', 'Teacher', NULL, '$2y$10$bosDce3mxOXhB0/0JXs4he.JE0YJiQJdU3fseofWMCKAjkaIo4M32', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '07654', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:43:49', '2024-07-25 06:43:49', 0, NULL, NULL),
(2534, 'MUMU MUBAROK, S.H.I.', 'mumu-mubarok-shi_rspMY', '1168_tech@gmail.com', 'Teacher', NULL, '$2y$10$KTYnuJyptjDDJVrl9E6az.dbepNNhBFyF0Vmq9Um2W0hSWCiIOVDa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '0987654', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:47:02', '2024-07-25 06:47:02', 0, NULL, NULL),
(2572, 'WISDIAN NUGRAHA, S.Pd.', 'wisdian-nugraha-spd_DtCEr', '1169_tech@gmail.com', 'Teacher', NULL, '$2y$10$kltmAqQ.6ljwDaAN0k2lwuyRvESpUIKh.ySU7GnhiivT7ykRazap.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '0899', NULL, NULL, NULL, NULL, 0, '2024-07-25 06:59:11', '2024-07-25 06:59:11', 0, NULL, NULL),
(2606, 'AAN ANDREANA', 'aan-andreana_NOHQ6', '2111_tech@fathforce.com', 'Student', NULL, '$2y$10$98e1CKQ7f.63SuurpNW/9.i5e52HHZztww70P7adTy55ntX168sZm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:02:38', '2024-07-25 07:02:38', 0, NULL, NULL),
(2607, 'ADITYA PRATAMA', 'aditya-pratama_hVskK', '2112_tech@fathforce.com', 'Student', NULL, '$2y$10$21RokT/tqcVJGtNwUDHhU.zZrY8lBv5H7ND.FOFqG1hKnFm.mqgTu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:02:38', '2024-07-25 07:02:38', 0, NULL, NULL),
(2608, 'AHMAD HAERUL ANWAR', 'ahmad-haerul-anwar_UDBD0', '2113_tech@fathforce.com', 'Student', NULL, '$2y$10$KiRQaRQjQgu/Y4jW9/Tu2u9mjbHHcvebRGQFfI2w2msjKg/oz1dJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:02:38', '2024-07-25 07:02:38', 0, NULL, NULL),
(2609, 'AYU LESTARI', 'ayu-lestari_FFE6p', '2114_tech@fathforce.com', 'Student', NULL, '$2y$10$LsvR5s1laHqbJLrupikVY./Cg/QThJSmZ2w6nh6o9APrpkvsvnLbS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:02:39', '2024-07-25 07:02:39', 0, NULL, NULL),
(2610, 'BELLA NABILA', 'bella-nabila_oUmZt', '2115_tech@fathforce.com', 'Student', NULL, '$2y$10$ZlljLdELJCQe6D7ReaV.h.hvDYbydW0uxBw0dw.F.3YChP5d2wewm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:02:39', '2024-07-25 07:02:39', 0, NULL, NULL),
(2611, 'Cucu Yuningsih', 'cucu-yuningsih_Df2OT', '2116_tech@fathforce.com', 'Student', NULL, '$2y$10$V/QWnUShceh2/dXMnHqWH.QmRwtz4FqZI.2t4pNe.3FjID5iJgn1m', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:02:39', '2024-07-25 07:02:39', 0, NULL, NULL),
(2612, 'DANI HIRWANSAH', 'dani-hirwansah_4HC4V', '2117_tech@fathforce.com', 'Student', NULL, '$2y$10$WTUrGAQl0eGAkor0N.rbq.P9oZrXP0GTAGcM3MiVdc1VV8RE2ibaG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:02:39', '2024-07-25 07:02:39', 0, NULL, NULL),
(2613, 'DZAHABI NURFALAH', 'dzahabi-nurfalah_t0z85', '2118_tech@fathforce.com', 'Student', NULL, '$2y$10$Cyo.862Wvv8lYSbmarTqZOLHBT8.zQu1AaInqYtKkEr0dJQMoUSvK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:02:39', '2024-07-25 07:02:39', 0, NULL, NULL),
(2614, 'ELIS ELGANA', 'elis-elgana_ROClt', '2119_tech@fathforce.com', 'Student', NULL, '$2y$10$456.BvODj7Sf3F1YOyM2R.VBHBF49QIXMXuypMm05llxq5pPJehty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:02:39', '2024-07-25 07:02:39', 0, NULL, NULL),
(2615, 'ENDANG AGUSTIANI', 'endang-agustiani_jbs2s', '2120_tech@fathforce.com', 'Student', NULL, '$2y$10$bs3PbiFWdfh54Bg9w4DjweCcIG5sSkpfyQqHQMBPy2WU7jgpeen5a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:02:39', '2024-07-25 07:02:39', 0, NULL, NULL),
(2616, 'FAREL ADITIA NUGROHO', 'farel-aditia-nugroho_xIE1S', '2121_tech@fathforce.com', 'Student', NULL, '$2y$10$snbv9AdvBhkuTwuoIuyrpu8CEnDo0LH9R.biQF5RwlI0Dw5bDUCNa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:02:39', '2024-07-25 07:02:39', 0, NULL, NULL),
(2617, 'FIKRY ADHI KURNIA', 'fikry-adhi-kurnia_FM3s4', '2122_tech@fathforce.com', 'Student', NULL, '$2y$10$T3a9/tFSltL4pxn1TTBynuDaejcazsU1NWSC3IUjuLwrCMScKLmvS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:02:39', '2024-07-25 07:02:39', 0, NULL, NULL),
(2618, 'LAILA SAFIRA', 'laila-safira_VzIWY', '2123_tech@fathforce.com', 'Student', NULL, '$2y$10$OJrCXBKS0w8Ma8xGWjJJx.j.vpr5GlCE.swP7QKTbX8t3Y0LEzUA6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:02:39', '2024-07-25 07:02:39', 0, NULL, NULL),
(2619, 'MARSHA JULIANATA', 'marsha-julianata_miFCi', '2124_tech@fathforce.com', 'Student', NULL, '$2y$10$lyr/6685CBa28PVcijJJuOGXtAPdIl6Z4MEldRooC/0rJ95ldWPfm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:02:39', '2024-07-25 07:02:39', 0, NULL, NULL),
(2620, 'MEYLANI DWIYANTI', 'meylani-dwiyanti_01IoO', '2125_tech@fathforce.com', 'Student', NULL, '$2y$10$Oh19vEMgBgfO760xCWJufOoZGXF9KxIu93RYj2Y9tbwDsAKbXswwS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:02:39', '2024-07-25 07:02:39', 0, NULL, NULL),
(2621, 'MUHAMMAD WILLY RIZQI CAESAR', 'muhammad-willy-rizqi-caesar_QCXm5', '2126_tech@fathforce.com', 'Student', NULL, '$2y$10$NJapCXWzxjCVunqE9zSxVupgXrhW4PrhDz.JlUI7OMLxHpG/SuD0K', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:02:39', '2024-07-25 07:02:39', 0, NULL, NULL),
(2622, 'RAFLI', 'rafli_qOUNW', '2127_tech@fathforce.com', 'Student', NULL, '$2y$10$wCLmpjIFCJdDPA4mUXj2teY.4.gb2c9Ze35ZfX8ZPLh2cgRWLLKxW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:02:39', '2024-07-25 07:02:39', 0, NULL, NULL),
(2623, 'RAIA HANIF SHALINI', 'raia-hanif-shalini_9rLxd', '2128_tech@fathforce.com', 'Student', NULL, '$2y$10$RYBkhdwZ1./AzrKGCkCp3uYRKxQgIAJdaU1ESOKl7gjTNnpehhK2e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:02:40', '2024-07-25 07:02:40', 0, NULL, NULL),
(2624, 'RAKHA AGIPPRATAMA', 'rakha-agippratama_Ltw3g', '2129_tech@fathforce.com', 'Student', NULL, '$2y$10$Wo7EjS5h5HouoG0koPvnZ.yghINFn/XHF4L5IiGKoinuL4CFmxyAu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:02:40', '2024-07-25 07:02:40', 0, NULL, NULL),
(2625, 'REGA APRILIAN', 'rega-aprilian_wtSvu', '2130_tech@fathforce.com', 'Student', NULL, '$2y$10$4OnGShZlXFxyA5Oks7FkTuv.C7lsrciVZQi529QsLYQw8kHmozTbq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:02:40', '2024-07-25 07:02:40', 0, NULL, NULL);
INSERT INTO `users` (`id`, `name`, `username`, `email`, `role`, `email_verified_at`, `password`, `code`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `fcm_token`, `current_team_id`, `profile_photo_path`, `status`, `phone`, `address`, `department_id`, `date_of_birth`, `gender`, `account_hold`, `created_at`, `updated_at`, `tour_completed`, `face_embedding`, `id_reference`) VALUES
(2626, 'REHAN TAHER RAMADANI', 'rehan-taher-ramadani_k7cr0', '2131_tech@fathforce.com', 'Student', NULL, '$2y$10$Qp6ibWqt3ukEne.hJMARU.oVZlwUGWd/Wp7aWjioYPY9Gm9QIcmVS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:02:40', '2024-07-25 07:02:40', 0, NULL, NULL),
(2627, 'RENI SULISTIAWATI', 'reni-sulistiawati_dH8CA', '2132_tech@fathforce.com', 'Student', NULL, '$2y$10$MPAPkkoVRXhv0eqKPAKNZe62O7Xy/fxGlqR6lJNb0mfQTz7JMNOoa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:02:40', '2024-07-25 07:02:40', 0, NULL, NULL),
(2628, 'RISKI RAMADANI', 'riski-ramadani_71oH4', '2133_tech@fathforce.com', 'Student', NULL, '$2y$10$KHALLm4EQOglN.vRSKcPM.68ZKFPpxalCmGSPz/Q14n9HRKSQk.x2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:02:40', '2024-07-25 07:02:40', 0, NULL, NULL),
(2629, 'RIZAL NURZAMAN', 'rizal-nurzaman_3Y5hZ', '2134_tech@fathforce.com', 'Student', NULL, '$2y$10$brC4l0QQ5S.m65zDr1NaxuNFNt.tXdxMorL3ctFFRGwZ891C6uGQa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:02:40', '2024-07-25 07:02:40', 0, NULL, NULL),
(2630, 'RIZIQ MAULANA', 'riziq-maulana_IftD1', '2135_tech@fathforce.com', 'Student', NULL, '$2y$10$N.da/RpIOUzxdn/RxAxgoe0MlHTeKSIoj7/9.QiqpLVhflkZpp8uC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:02:40', '2024-07-25 07:02:40', 0, NULL, NULL),
(2631, 'ROSA RAHMAWATI', 'rosa-rahmawati_Ma0uh', '2136_tech@fathforce.com', 'Student', NULL, '$2y$10$mnjliRGD5NbwsYWw8U/.3eB1hZ8cUI79UwNM3q3k8VECY9mQLYKge', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:02:40', '2024-07-25 07:02:40', 0, NULL, NULL),
(2632, 'SANSAN SUSANTI NURHALIMAH', 'sansan-susanti-nurhalimah_3P9VZ', '2137_tech@fathforce.com', 'Student', NULL, '$2y$10$K38w1bpsSihc/yyoslVsvuYKDQWuVGmTkPWrlstBKOHXoGNOH5Aa.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:02:40', '2024-07-25 07:02:40', 0, NULL, NULL),
(2633, 'SRI NUR AZIZAH', 'sri-nur-azizah_yIwCA', '2138_tech@fathforce.com', 'Student', NULL, '$2y$10$WyluLUV3EXfbsNVevPRikOJ/X8NBP9cF5w942j0WiEKseWXkq2Koy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:02:40', '2024-07-25 07:02:40', 0, NULL, NULL),
(2634, 'SUKMAWATI', 'sukmawati_AMBeI', '2139_tech@fathforce.com', 'Student', NULL, '$2y$10$qBZoe6esOTQuxuPAdi4/pupu9/1nnvRVj6nGowBEHlxBV3etLn48C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:02:40', '2024-07-25 07:02:40', 0, NULL, NULL),
(2635, 'SYITA TRI AZIZAH', 'syita-tri-azizah_e7U57', '2140_tech@fathforce.com', 'Student', NULL, '$2y$10$TSbkIOY4eU5l75US2dlw2eMW4ZWuqOo1fOa92N8iV28RtQwA/jPiG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:02:40', '2024-07-25 07:02:40', 0, NULL, NULL),
(2636, 'Zahra Ali Agustin', 'zahra-ali-agustin_sKs2q', '2141_tech@fathforce.com', 'Student', NULL, '$2y$10$Sy8kygHYHVwnArby1DAfV.x45E6jfqX2JSG9wUBXIPKu1ohlinXiG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:02:41', '2024-07-25 07:02:41', 0, NULL, NULL),
(2637, 'ZEN ROFIK FAHRUDIN', 'zen-rofik-fahrudin_q9Xf3', '2142_tech@fathforce.com', 'Student', NULL, '$2y$10$bcAI.n.uzsM2qVzXCERuSu880ZFKDPWTFiIaINJqNVfGLJhODKl2.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:02:41', '2024-07-25 07:02:41', 0, NULL, NULL),
(2670, 'ADE POPON, S.T.', 'ade-popon-st_8JKaP', '1170_tech@fathforce.com', 'Teacher', NULL, '$2y$10$b11B6eALT4uswK.DQBD2IurYxi1mkSOFqj47oodR9tuwW609hb4P6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '088', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:04:42', '2024-07-25 07:04:42', 0, NULL, NULL),
(2671, 'HENI SRI HARTATI, S.Pd.', 'heni-sri-hartati-spd_AhqUv', '1171_tech@gmail.com', 'Teacher', NULL, '$2y$10$hO5Nsb5vzSMBHIdpjUzv4.4/yywsHqMkVNXqlu.JJ1dIJs0PVMJLW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '333', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:08:07', '2024-07-25 07:08:07', 0, NULL, NULL),
(2673, 'Rd. GILANG YUDIAPUTRA, S.Kom.', 'rd-gilang-yudiaputra-skom_SOIRy', '1172_tech@gmail.com', 'Teacher', NULL, '$2y$10$UO6WqvtqXQEoETGjWcVfS.dktlcFRuzQq/8sT38XzeGU5tYj1Uh1e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '099', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:11:34', '2024-07-25 07:11:34', 0, NULL, NULL),
(2674, 'ROSLIAWATI, M.Pd.I.', 'rosliawati-mpdi_vNBGJ', '1173_tech@gmail.com', 'Teacher', NULL, '$2y$10$d/w1l4gmOkAsAm5fT5yiAeaI0lq5M8xoBU6U3TZ0BHNyc/Gvbchom', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '096', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:15:00', '2024-07-25 07:15:00', 0, NULL, NULL),
(2675, 'ADE ABDUR ROUF', 'ade-abdur-rouf_Oz5cl', '2210_tech@fathforce.com', 'Student', NULL, '$2y$10$pF8BayIavixoWlVuEpiXvevjvgorXzIU2G2gPewJfZ3jDxG2EdEPW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:15:57', '2024-07-25 07:15:57', 0, NULL, NULL),
(2676, 'AGIS PRANATA', 'agis-pranata_M48Ns', '2211_tech@fathforce.com', 'Student', NULL, '$2y$10$qnByr7frs0/TzEVxxrjPuutiDBYPZ/DUa.HxT9/g8lqV93nmUbE06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:15:57', '2024-07-25 07:15:57', 0, NULL, NULL),
(2677, 'ALFIH GARTIKA PUTRI', 'alfih-gartika-putri_T84jb', '2212_tech@fathforce.com', 'Student', NULL, '$2y$10$8a9toXGbcMIr3.fZwsfkiuALD1LAKu3NqTg/2HazsVTK66srywdTO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:15:57', '2024-07-25 07:15:57', 0, NULL, NULL),
(2678, 'ALYA PUTRI MAULIDA', 'alya-putri-maulida_PhFWD', '2213_tech@fathforce.com', 'Student', NULL, '$2y$10$dShwFphaaKr44NVqmkbAj.XK73Q0pkpxipsCoBrtBN8bYRc7sKpfW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:15:57', '2024-07-25 07:15:57', 0, NULL, NULL),
(2679, 'ASTRI MAURI', 'astri-mauri_3AWwm', '2214_tech@fathforce.com', 'Student', NULL, '$2y$10$ys6AgxuiEpW42c3w8Ma1I.g/MgeRquWNIdeWHgB/Qcwlompe.rawW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:15:57', '2024-07-25 07:15:57', 0, NULL, NULL),
(2680, 'CINDY RAHMAWATI', 'cindy-rahmawati_UzNsS', '2215_tech@fathforce.com', 'Student', NULL, '$2y$10$unlVWsfKGEejvUxI.AHW6eSaKaPJ4Sw3B.ocdUVADxTAeLPsmcx0S', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:15:57', '2024-07-25 07:15:57', 0, NULL, NULL),
(2681, 'DETRI PUTRA GANTINA', 'detri-putra-gantina_OBcna', '2216_tech@fathforce.com', 'Student', NULL, '$2y$10$XxsAS.VzpC/KtE35UC6ZAeFEDn7Aay3MotxtE1tFYVmx7Tb.cPQwm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:15:57', '2024-07-25 07:15:57', 0, NULL, NULL),
(2682, 'DIMAS', 'dimas_dEK9s', '2217_tech@fathforce.com', 'Student', NULL, '$2y$10$cqYU3u.6h0bPOE/.fFhB8.4aTZbP/buAUWPhCOhGGHsOBMDZ.aiIy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:15:57', '2024-07-25 07:15:57', 0, NULL, NULL),
(2683, 'EGA ASTUTI', 'ega-astuti_yVr3T', '2218_tech@fathforce.com', 'Student', NULL, '$2y$10$Psp/05UZ0m81R0g9DdX0dOkLMuF1KTK.zUsGI0Fy321GKecjbhyPG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:15:58', '2024-07-25 07:15:58', 0, NULL, NULL),
(2684, 'HARDIYANTI', 'hardiyanti_UGWO9', '2219_tech@fathforce.com', 'Student', NULL, '$2y$10$t9TinysF8ye3YDghaf83ve4sobF/vK/QZ8WCEmpmg36EMPCdayuPK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:15:58', '2024-07-25 07:15:58', 0, NULL, NULL),
(2685, 'INA KARLINA', 'ina-karlina_ZTUFg', '2220_tech@fathforce.com', 'Student', NULL, '$2y$10$xCGXmWTr1JS5732iFJVKIOS/5Ym3JjoJjtjQRiUdKaW0D4FwcJ.Vq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:15:58', '2024-07-25 07:15:58', 0, NULL, NULL),
(2686, 'INDRI UBAIDAH', 'indri-ubaidah_umIu1', '2221_tech@fathforce.com', 'Student', NULL, '$2y$10$e78.7Wyrilty5bWsh19STOXLo3YU3kBg/vW5cd7nozKJky2LKx08S', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:15:58', '2024-07-25 07:15:58', 0, NULL, NULL),
(2687, 'ISTI FITRIANI', 'isti-fitriani_92IMN', '2223_tech@fathforce.com', 'Student', NULL, '$2y$10$0ZK5wpMmpXVuGpfKYN34FeSuliL/az.LClIcAOVx5o0/A2znkFXdm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:15:58', '2024-07-25 07:15:58', 0, NULL, NULL),
(2688, 'KAYLA FAJRINA', 'kayla-fajrina_Evqdb', '2224_tech@fathforce.com', 'Student', NULL, '$2y$10$IApU2bGZce/okXSoYi6teOekZStKxf59wl5KRXFXRlJvNApWqWubK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:15:58', '2024-07-25 07:15:58', 0, NULL, NULL),
(2689, 'LILIS ROHAYATI', 'lilis-rohayati_DgH9R', '2225_tech@fathforce.com', 'Student', NULL, '$2y$10$WFyHb4Ej97wpN7aqJ7m7r.KVyZUos3TV1vRaJZBH90LOI/0T5nr1C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:15:58', '2024-07-25 07:15:58', 0, NULL, NULL),
(2690, 'LINDA', 'linda_7rOxG', '2226_tech@fathforce.com', 'Student', NULL, '$2y$10$tOJL9Sn.ov9Ruf/gjpVJYO4zYQkR3fwOyCBaxdDD3q.8sW/FeO08a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:15:58', '2024-07-25 07:15:58', 0, NULL, NULL),
(2691, 'MEILANI DWI RAHMAWATI', 'meilani-dwi-rahmawati_k0Tlt', '2227_tech@fathforce.com', 'Student', NULL, '$2y$10$aYM9ObDO3wBfJBZPRSQ.WuuO2W0LFmIA790y76F4LNDQOLRd55GYO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:15:58', '2024-07-25 07:15:58', 0, NULL, NULL),
(2692, 'NAILA RAMADANI', 'naila-ramadani_V2msk', '2228_tech@fathforce.com', 'Student', NULL, '$2y$10$dxiJ0Urm.3B0/QSyCdS1SOBVju0n4up3eQqP3Y9nfrd17ql7reWOK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:15:58', '2024-07-25 07:15:58', 0, NULL, NULL),
(2693, 'NANDITA SEPTIANA', 'nandita-septiana_4WH4K', '2229_tech@fathforce.com', 'Student', NULL, '$2y$10$dLEPvr66n5NDHzus1wIzx.1n3O59g.AeodZ8zkqATnUS1pxZdmdpm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:15:58', '2024-07-25 07:15:58', 0, NULL, NULL),
(2694, 'NAZIA AZAHRA NURMAULIDA', 'nazia-azahra-nurmaulida_qavEs', '2230_tech@fathforce.com', 'Student', NULL, '$2y$10$/H6oSta6QvxxHZY91euhwu8mcgsfN3tz2Cw5LihRctMkTFxpPxqsy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:15:58', '2024-07-25 07:15:58', 0, NULL, NULL),
(2695, 'NINA TSANIYAL FADLAH', 'nina-tsaniyal-fadlah_6DaRV', '2231_tech@fathforce.com', 'Student', NULL, '$2y$10$2ILiX4m79y2vptRO1FQLoOpgXjXxZ7IV0WY727VF079.qlr/HbGS2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:15:58', '2024-07-25 07:15:58', 0, NULL, NULL),
(2696, 'RAHMA ZAHRATUNNISA', 'rahma-zahratunnisa_KjZ7f', '2232_tech@fathforce.com', 'Student', NULL, '$2y$10$dp8PW3lW1bgyZdpygidDJeO9qrALEhVkFZzOHeSTVdOQb7/CcnXB6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:15:58', '2024-07-25 07:15:58', 0, NULL, NULL),
(2697, 'REISYA ALVIRA RAMADHAN', 'reisya-alvira-ramadhan_cieeU', '2233_tech@fathforce.com', 'Student', NULL, '$2y$10$D0yPlEPTYlp4.we3mUgIxuWVhewRS.JfX7sGXsmkS06iXCIAlntjK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:15:59', '2024-07-25 07:15:59', 0, NULL, NULL),
(2698, 'RENI NUR`AENI', 'reni-nuraeni_s1mZK', '2234_tech@fathforce.com', 'Student', NULL, '$2y$10$KUjovTxqg8wxNqGO/5lI0unrwtc0.cL5cYYsluL1NtBeECEepNCuW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:15:59', '2024-07-25 07:15:59', 0, NULL, NULL),
(2699, 'RESTI', 'resti_2Bk0G', '2235_tech@fathforce.com', 'Student', NULL, '$2y$10$KCBmtH468E5B2fz9IuoHz.y2l5tB8776EqTdupV3nhMzDrrmGDe9C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:15:59', '2024-07-25 07:15:59', 0, NULL, NULL),
(2700, 'RIANDA SYIFA LUTHFIYAH', 'rianda-syifa-luthfiyah_Oqe1W', '2236_tech@fathforce.com', 'Student', NULL, '$2y$10$9B1uBZA2mjnF7QimEAMdLustXJv9pQNYjyc44pBoVfb3ZH.DFlQLu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:15:59', '2024-07-25 07:15:59', 0, NULL, NULL),
(2701, 'RISKA NOPIANTI', 'riska-nopianti_ciUy6', '2237_tech@fathforce.com', 'Student', NULL, '$2y$10$fohTSmQZaFblyFxnkGwgaOYR9Fzc30uHJCKjVaAe8hmRQoJD.Xo7.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:15:59', '2024-07-25 07:15:59', 0, NULL, NULL),
(2702, 'SABRINA APRILIANI', 'sabrina-apriliani_BTezg', '2238_tech@fathforce.com', 'Student', NULL, '$2y$10$8xEijPYd01q0AFxoPdeWsOfEk16nba/iDy1//zppAHgL3MM85u2Ly', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:15:59', '2024-07-25 07:15:59', 0, NULL, NULL),
(2703, 'SANTI NOVRIYANTI', 'santi-novriyanti_aZfDg', '2239_tech@fathforce.com', 'Student', NULL, '$2y$10$5zg3m1zh0kZOTYAL4.6UK.RVwpJLf.Y/4D.kaCgY7YYvxrLcfEuou', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:15:59', '2024-07-25 07:15:59', 0, NULL, NULL),
(2704, 'SELLY LAILASARI', 'selly-lailasari_se0hb', '2240_tech@fathforce.com', 'Student', NULL, '$2y$10$.8S4ZQ54SiE2db5ZPCcMougIBLOCKBWInB40YS1nlf7RDz919JXga', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:15:59', '2024-07-25 07:15:59', 0, NULL, NULL),
(2705, 'SELVIANI ZAHRA NURSHAFA', 'selviani-zahra-nurshafa_QmKdL', '2241_tech@fathforce.com', 'Student', NULL, '$2y$10$RK0htgX/BeKejl1ko1yHBOUWj42fNHCfZTuxKVc0aGAl5wtM0i27S', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:15:59', '2024-07-25 07:15:59', 0, NULL, NULL),
(2706, 'SEPTIANI RAMADANI', 'septiani-ramadani_BiQNj', '2242_tech@fathforce.com', 'Student', NULL, '$2y$10$fJNVCWZX0UuuB1mOaVP4JepDIfcwpk5teziM1B3KsW1/vSEdCtVxi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:15:59', '2024-07-25 07:15:59', 0, NULL, NULL),
(2707, 'SHAKILLA FATMA JAMILA', 'shakilla-fatma-jamila_JY42u', '2243_tech@fathforce.com', 'Student', NULL, '$2y$10$nkCHzPVQ2jXsN1AdkWkIKu/JnsWJp6dRe6twvc8IQ7K0UbRQkYE0G', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:15:59', '2024-07-25 07:15:59', 0, NULL, NULL),
(2708, 'THATYA KHAIRUNNISA', 'thatya-khairunnisa_77U4O', '2244_tech@fathforce.com', 'Student', NULL, '$2y$10$PlxJKfYO3NFl3CdO8VpU0OvuCyCZUoM4yX0KedR8oFXPpKOJCkh56', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:15:59', '2024-07-25 07:15:59', 0, NULL, NULL),
(2709, 'WINA IVANNA LESTARI', 'wina-ivanna-lestari_Nr1Tv', '2245_tech@fathforce.com', 'Student', NULL, '$2y$10$hs9kGPw7/HaqzFphjqVvoO6Ks9dl1VK1ey2GWqmnQigEIPN5h0WLG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:15:59', '2024-07-25 07:15:59', 0, NULL, NULL),
(2710, 'YUYUN YUNINGSIH', 'yuyun-yuningsih_tuWXu', '2246_tech@fathforce.com', 'Student', NULL, '$2y$10$k64RJI1AmwzltTcV31pfVeY02TkuKi6.WLWqPchptZH61kJDj/Eui', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:15:59', '2024-07-25 07:15:59', 0, NULL, NULL),
(2711, 'SYOFIYATUL LUSIANA, M.Pd.', 'syofiyatul-lusiana-mpd_HfhVE', '1174_tech@fathforce.com', 'Teacher', NULL, '$2y$10$dZzOF4UsxA/w.MqxiVJz0Owtl2cR2ennz0Oq0pemqx9F1ulGI12cG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '055', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:20:03', '2024-07-25 07:20:03', 0, NULL, NULL),
(2749, 'ABDULLOH, S.ST.', 'abdulloh-sst_WxhbJ', '1175_tech@fathforce.com', 'Teacher', NULL, '$2y$10$inJ6UAhB4HiQDaJ21YmfKeGLhp34L/Xj3nxwBfzNab9vBKAbNVFr6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '087', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:23:08', '2024-07-25 07:23:08', 0, NULL, NULL),
(2750, 'NENI NURAENI, S.Pd.', 'neni-nuraeni-spd_MxoQC', '1176_tech@fathforce.com', 'Teacher', NULL, '$2y$10$bR.CeeTuBSP/2BETbMbR6e8N3ebcZTiFKjMyjO/LaPmnd3UwvztQy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '067', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:25:27', '2024-07-25 07:25:27', 0, NULL, NULL),
(2751, 'ADE NURAISAH, S.Pd.', 'ade-nuraisah-spd_hBypL', '1177_tech@fathforce.com', 'Teacher', NULL, '$2y$10$5T9hWw4vf8setlYeXvhio.zJTAFOq0yvEE0Ib7szw.GSxglpFlyl.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '099', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:28:00', '2024-07-25 07:28:00', 0, NULL, NULL),
(2752, 'ALINDA', 'alinda_WAMPk', '2283_tech@fathforce.com', 'Student', NULL, '$2y$10$f7zvzzZWDXF/cf6n4rsxd.GnUXCog7lWqCpCsG0prh4uzrKhplspa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:28:05', '2024-07-25 07:28:05', 0, NULL, NULL),
(2753, 'ALLYA NATASYA', 'allya-natasya_rHG67', '2284_tech@fathforce.com', 'Student', NULL, '$2y$10$aQWvGIwG.o8efN2w4HNMwuuSt/fCDssSpxjsJtXFsPPV6NXpi2yC.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:28:05', '2024-07-25 07:28:05', 0, NULL, NULL),
(2754, 'ANDINI OKTAVIANTI', 'andini-oktavianti_iZqei', '2285_tech@fathforce.com', 'Student', NULL, '$2y$10$OJ9jfzbKvHlfi7c7tnrI5eHzMDi7xHO8JVYZepz5HpcbUYOJGX1VK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:28:05', '2024-07-25 07:28:05', 0, NULL, NULL),
(2755, 'DERIA SEPTIANI', 'deria-septiani_NXVsC', '2286_tech@fathforce.com', 'Student', NULL, '$2y$10$GGSrDVJK3r09Eavk12eV9OHyZowCLb4YYk4D3kqZkuVovY9.7gzDK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:28:05', '2024-07-25 07:28:05', 0, NULL, NULL),
(2756, 'FIRDA NURROSIDAH', 'firda-nurrosidah_qaxcK', '2287_tech@fathforce.com', 'Student', NULL, '$2y$10$WEF2oKwQHJSEh8MDCt8jauEt2.bqzh/yZEPmlOyc/0OyRSeTI6Khy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:28:06', '2024-07-25 07:28:06', 0, NULL, NULL),
(2757, 'GINA FITRIA NURAENI', 'gina-fitria-nuraeni_3lEKN', '2288_tech@fathforce.com', 'Student', NULL, '$2y$10$sdJsYdjuWQkrhl1LogJvBeMPYG03Wa4dTxK8gwJaTs4vd8tly67IK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:28:06', '2024-07-25 07:28:06', 0, NULL, NULL),
(2758, 'HILDA ELVA RYANTI', 'hilda-elva-ryanti_pRcVD', '2289_tech@fathforce.com', 'Student', NULL, '$2y$10$/Xc9pwoJtl6jIQwM.p12te67LmJV.mF7lM8Oew2tqZ4RDe6L7mzDm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:28:06', '2024-07-25 07:28:06', 0, NULL, NULL),
(2759, 'IMEY MAULANI', 'imey-maulani_lezsa', '2290_tech@fathforce.com', 'Student', NULL, '$2y$10$IsJ3HkNSfwV8vWEeFt.0MOhrJIVvC3sr0xltfHYuDWvkqhtdGwvl2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:28:06', '2024-07-25 07:28:06', 0, NULL, NULL),
(2760, 'KEMALA FAJNUR IJAZI', 'kemala-fajnur-ijazi_913WY', '2291_tech@fathforce.com', 'Student', NULL, '$2y$10$xVTBiKYqRnlqTjfF3x1xZu7Twek25j5V6WHw0AXVv0gSa2Qb5Re6O', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:28:06', '2024-07-25 07:28:06', 0, NULL, NULL),
(2761, 'KHOLIFAH NUR ROHMAH', 'kholifah-nur-rohmah_ciUdt', '2292_tech@fathforce.com', 'Student', NULL, '$2y$10$eC7EXh2jZO3raHkqT8BjB.amyUn7iGdjFu7sUD.PNWWzB1krXuxJ.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:28:06', '2024-07-25 07:28:06', 0, NULL, NULL),
(2762, 'LISANI BELLA KHARISMA', 'lisani-bella-kharisma_OBdEO', '2293_tech@fathforce.com', 'Student', NULL, '$2y$10$DDwYqr8bzob6bDTnAlkh0u6w5KtbbxEE8jUJa6CcxtYLXFdWaQghG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:28:06', '2024-07-25 07:28:06', 0, NULL, NULL),
(2763, 'LISDIANI AGUSTINA', 'lisdiani-agustina_6BR0p', '2294_tech@fathforce.com', 'Student', NULL, '$2y$10$mD4xUIF78Wd9J3rAG.9p0OmM7OlFuP0nuf4ksNXITFpZ1wxBobOj2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:28:06', '2024-07-25 07:28:06', 0, NULL, NULL),
(2764, 'MAHISYA CAHYA PRADANI', 'mahisya-cahya-pradani_oEE0t', '2295_tech@fathforce.com', 'Student', NULL, '$2y$10$CYyC8boT6vz1TmAoKcHCgeO3P.sBG89CQ4AhQO7/ibvns02HK7UQC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:28:06', '2024-07-25 07:28:06', 0, NULL, NULL),
(2765, 'MELIA MELIANI', 'melia-meliani_GVKi2', '2296_tech@fathforce.com', 'Student', NULL, '$2y$10$OpdWtX.3nhnOgg0HzyviD.AGgUeIP4u3pgck.WHY2tsdMxVNhJBF.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:28:06', '2024-07-25 07:28:06', 0, NULL, NULL),
(2766, 'MEMEY MEILANI', 'memey-meilani_jAkrJ', '2297_tech@fathforce.com', 'Student', NULL, '$2y$10$tPq3HYkUKP1cVplKn6jVfueThxawM5d.tfEK///M0jjBxt4tKz5ky', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:28:06', '2024-07-25 07:28:06', 0, NULL, NULL),
(2767, 'NAZWA NAVIOLA RAMDANI', 'nazwa-naviola-ramdani_48uQ9', '2298_tech@fathforce.com', 'Student', NULL, '$2y$10$CgClOzY9RvDjqwq9nVUgcuGLnc4UerQtiXl318wXs0c1WiXqIC.ZS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:28:06', '2024-07-25 07:28:06', 0, NULL, NULL),
(2768, 'PIDA INDARIAH', 'pida-indariah_TNbP3', '2299_tech@fathforce.com', 'Student', NULL, '$2y$10$Jw52mlCVljxouvClwNqfBuydBMQwUyKUhDrX0dtsazeaV1M4xS3Ka', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:28:06', '2024-07-25 07:28:06', 0, NULL, NULL),
(2769, 'RAISYA AULIA', 'raisya-aulia_8xh9Q', '2300_tech@fathforce.com', 'Student', NULL, '$2y$10$DyaV.CG6kooAVqhP2z3ojOQAh8oYH8XEub9HSSV3k/pXhtOZW3c3y', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:28:06', '2024-07-25 07:28:06', 0, NULL, NULL),
(2770, 'REGITA CAHYANI', 'regita-cahyani_fazZN', '2301_tech@fathforce.com', 'Student', NULL, '$2y$10$v8BmIq6eqOVurlXUaMKg4e.vWKJPU3pMxoyERctt71OsWDBIyt.I.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:28:07', '2024-07-25 07:28:07', 0, NULL, NULL),
(2771, 'RENSI AURELYA SOPIAN', 'rensi-aurelya-sopian_bdSNJ', '2302_tech@fathforce.com', 'Student', NULL, '$2y$10$WnkqgCKPO0kLt3XSWCW2IubuyI66O8Dbfe/Q9J3moQSsrfgGdkXaK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:28:07', '2024-07-25 07:28:07', 0, NULL, NULL),
(2772, 'RIFA FAUZIAH ZAELANI', 'rifa-fauziah-zaelani_COKqO', '2303_tech@fathforce.com', 'Student', NULL, '$2y$10$/.on6ODfubQSu9ivuvSKmO/GYrXOWmc4S49nDWuFP8SiuTmgWqp0W', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:28:07', '2024-07-25 07:28:07', 0, NULL, NULL),
(2773, 'RINI RISMAYANTI', 'rini-rismayanti_9sljA', '2304_tech@fathforce.com', 'Student', NULL, '$2y$10$rNzp13Iz8w0vWDL0qCohiuwReoMulq7nu396Tp.ds1et4kab6x7Zy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:28:07', '2024-07-25 07:28:07', 0, NULL, NULL),
(2774, 'RISMA NURAINI', 'risma-nuraini_VAvNu', '2305_tech@fathforce.com', 'Student', NULL, '$2y$10$SjSqFipjtMmXn0Q0iPFy4.uM8bWJs9Mm36VCT1KVQPrDSRq7aZiYq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:28:07', '2024-07-25 07:28:07', 0, NULL, NULL),
(2775, 'RISYA NUR APRIANSYAH', 'risya-nur-apriansyah_XhqQD', '2306_tech@fathforce.com', 'Student', NULL, '$2y$10$VsUUzMSqEfQVqIQNqFOf7eTjuZQi5SsRysjvjKmEMa4wzwyAriY5.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:28:07', '2024-07-25 07:28:07', 0, NULL, NULL),
(2776, 'RITA GUSTIANI', 'rita-gustiani_cnBxu', '2307_tech@fathforce.com', 'Student', NULL, '$2y$10$Fa51AvRqkLPlU0u9CxVhleYxdWnWoFC2P4B2Uf6IlStZ9ku9I7qwG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:28:07', '2024-07-25 07:28:07', 0, NULL, NULL),
(2777, 'SALMA ALTOPUNISA', 'salma-altopunisa_YGPcu', '2308_tech@fathforce.com', 'Student', NULL, '$2y$10$6K6uUFG8krD.lyCEiBhedOQ2A0/yMLSDCkBJTcjkK2zw.0T5aRV36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:28:07', '2024-07-25 07:28:07', 0, NULL, NULL),
(2778, 'SANTI RAHMAN', 'santi-rahman_KGtIh', '2309_tech@fathforce.com', 'Student', NULL, '$2y$10$vo47Lix6Jk3T6CWf0tWmpeUsTJTr4ue2HwIFYXBM46KunM5OOB3CG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:28:07', '2024-07-25 07:28:07', 0, NULL, NULL),
(2779, 'SENI YUNIARTI', 'seni-yuniarti_UhsQ3', '2310_tech@fathforce.com', 'Student', NULL, '$2y$10$MOodFtuBtF/HsSWX1s9LaeiuHmgTTZCgwFkqkyvRsId6liWIKDFKW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:28:07', '2024-07-25 07:28:07', 0, NULL, NULL),
(2780, 'SEPTIYA BUNGA LINASTIYA', 'septiya-bunga-linastiya_XvHEj', '2311_tech@fathforce.com', 'Student', NULL, '$2y$10$fV0Hiv//lJ6jw7Tz6YcpUOohpI8Bm/NljfEx.H5Ii7HK09v8C4MHW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:28:07', '2024-07-25 07:28:07', 0, NULL, NULL),
(2781, 'SILVI RAHMAYANI', 'silvi-rahmayani_hiAfT', '2312_tech@fathforce.com', 'Student', NULL, '$2y$10$KIGfaPSksS9Sk5DWyPAEqe4Uz2291j55mJk96nSt6d.TL7tuAoz7W', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:28:07', '2024-07-25 07:28:07', 0, NULL, NULL),
(2782, 'SITI NURMALA', 'siti-nurmala_z4r0o', '2313_tech@fathforce.com', 'Student', NULL, '$2y$10$srkRkVtXBOnWfAdZiad0F.J9a8dW09pFiNbZTaztK0yJ2XmML2xqC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:28:07', '2024-07-25 07:28:07', 0, NULL, NULL),
(2783, 'SRI AJENG LESTARI', 'sri-ajeng-lestari_tNC5t', '2314_tech@fathforce.com', 'Student', NULL, '$2y$10$yXMQGOx/jGV/Hp93FrhU3./jpPOGQ1lpZjDVHc4rC4HlarhTVl.FS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:28:07', '2024-07-25 07:28:07', 0, NULL, NULL),
(2784, 'TAS\'YA NUR\'INDAH SARI', 'tasya-nurindah-sari_icqf4', '2315_tech@fathforce.com', 'Student', NULL, '$2y$10$nIGes7X79MMN6OiOIXi9Wer3mdUpm.P/ZtfHwfSMD9lQtK3HJZbsC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:28:07', '2024-07-25 07:28:07', 0, NULL, NULL),
(2785, 'VIRDY APRIANTI', 'virdy-aprianti_0suCU', '2316_tech@fathforce.com', 'Student', NULL, '$2y$10$hFfpVyJ9yhbbZ/W1jL9xZeA2KFFShA53YF9AHYhcI2oX8nsTCTJFi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:28:08', '2024-07-25 07:28:08', 0, NULL, NULL),
(2786, 'YULIA NOPIANTI', 'yulia-nopianti_cbUff', '2317_tech@fathforce.com', 'Student', NULL, '$2y$10$lFfb32cu4kHP62S3VbEqme8A1vZOmMb4d1SAoMRP.8t7rudei/wam', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:28:08', '2024-07-25 07:28:08', 0, NULL, NULL),
(2787, 'ZULFAA ADZRAA WARDANI', 'zulfaa-adzraa-wardani_2O0sX', '2318_tech@fathforce.com', 'Student', NULL, '$2y$10$V1Z7kaHNNEErc95xYdxGP.6ytIfXkkx7HWrCjLQ6z6txu7UtBJQK.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:28:08', '2024-07-25 07:28:08', 0, NULL, NULL),
(2788, 'TONI BELLA, S.Pd.', 'toni-bella-spd_WvzQ3', '1178_tech@fathforce.com', 'Teacher', NULL, '$2y$10$NUl2YsRycddeMx0Mquasc.3KZCDlpU0f4nVXlmemwrCzi6wDX73wK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '067', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:32:29', '2024-07-25 07:32:29', 0, NULL, NULL),
(2798, 'ACENG TAOPIK, S.Kom.', 'aceng-taopik-skom_wNOCL', '1179_tech@fathforce.com', 'Teacher', NULL, '$2y$10$BkstQwEx5N8G0BQs63M/TOb2IDiCRI5OeF3i5MCr/BOxBGgcBE82e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '999', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:36:53', '2024-07-25 07:36:53', 0, NULL, NULL),
(2799, 'KOKOM KOMALASARI, S.Pd.', 'kokom-komalasari-spd_sRLqD', '1180_tech@fathforce.com', 'Teacher', NULL, '$2y$10$jotr6jjWhtD/HHmCKARfFu5jnCliM0q.fE2JqNuX7XodDsHwXpwtS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '077', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:40:10', '2024-07-25 07:40:10', 0, NULL, NULL),
(2951, 'RITA MEILA LESTARI, S.Pd.', 'rita-meila-lestari-spd_JxIl0', '1181_tech@fathforce.com', 'Teacher', NULL, '$2y$10$Avvr35J7cib32IdtDpc.V.XBOudoP9QwOngbHRYv1se54cIcFQGt6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '0877', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:44:49', '2024-07-25 07:44:49', 0, NULL, NULL),
(2952, 'SUSI SUSILAWATI, S.Pd.', 'susi-susilawati-spd_m4gb9', '1182_tech@fathforce.com', 'Teacher', NULL, '$2y$10$JRDGwT6pCsF8Og5aK8FbRuJG0eGDXr.QObDWiXmCJTq09/3TLfAQq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '087', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:48:07', '2024-07-25 07:48:07', 0, NULL, NULL),
(2953, 'IMA RAHMAWATI, S.E., M.M.', 'ima-rahmawati-se-mm_yiJjw', '1183_tech@fathforce.com', 'Teacher', NULL, '$2y$10$8ILPvReZuaC5LQpbYnFj7evu2zkd7AdGzSKgcB1SApDkK9Mddgt/W', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '0867', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:52:10', '2024-07-25 07:52:10', 0, NULL, NULL),
(2954, 'AGUNG GUNAWAN', 'agung-gunawan_O8tw4', '1Kzw2463_tech@fathforce.com', 'Student', NULL, '$2y$10$nxnRFYCK9RYuM7AtVqOue.VwAOk3cBzdGX9jFAUtSKTEIkapThzdy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:54:42', '2024-07-25 07:54:42', 0, NULL, NULL),
(2955, 'ALI AL KHOTAMI', 'ali-al-khotami_H5MgP', '1Z7l2464_tech@fathforce.com', 'Student', NULL, '$2y$10$GJBJptOMS/pTb106eJUkEe4nUnwQ6dLewnaTMkHU2FKP0LT8QBdQ2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:54:43', '2024-07-25 07:54:43', 0, NULL, NULL),
(2956, 'AMELIA', 'amelia_09987', 'DVV62465_tech@fathforce.com', 'Student', NULL, '$2y$10$c6P0ajTuHHW4tQ.EFcCaJONcaS9LaFALKNft3oTaHyRngK0oeN4M6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:54:43', '2024-07-25 07:54:43', 0, NULL, NULL),
(2957, 'ANTO HESTIAWAN', 'anto-hestiawan_1M9jK', 'NC8o2466_tech@fathforce.com', 'Student', NULL, '$2y$10$/6IT7EAIozLvWPRGNJFs7.U8Ao9xf5uKZT4EV9mUX4tKvQUQ3WF9i', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:54:43', '2024-07-25 07:54:43', 0, NULL, NULL),
(2958, 'BAGAS ANDRIAN', 'bagas-andrian_srN85', 'iuKD2467_tech@fathforce.com', 'Student', NULL, '$2y$10$npiOpSyJBaMBd.GOgHgOIeszWoHUDx.UYD2SfdDhCww0iAFu7RrDO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:54:43', '2024-07-25 07:54:43', 0, NULL, NULL),
(2959, 'CIKAL ANDRIYAN', 'cikal-andriyan_kc7aT', 'B1Hr2468_tech@fathforce.com', 'Student', NULL, '$2y$10$sgJJU6vzUKOr8NpWLs5thurdHjWEf7EhdAtL2BnurNBzJZd2IW5DC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:54:43', '2024-07-25 07:54:43', 0, NULL, NULL),
(2960, 'DIMAS REZKI SAPUTRA', 'dimas-rezki-saputra_HUMee', 'F7mF2469_tech@fathforce.com', 'Student', NULL, '$2y$10$u2FdHVLw19iRziXmUPzUquMPOorxNhwrbLcpJuvKX9tP3Ur6duVL.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:54:43', '2024-07-25 07:54:43', 0, NULL, NULL),
(2961, 'FAIDA RAHMA HERLANI', 'faida-rahma-herlani_XshMu', 'Jmyk2470_tech@fathforce.com', 'Student', NULL, '$2y$10$iKpXMWtHkWWrM3CN1RASdO/SM7P0hDzOZHWn4OVKI4YckGFuzH3qa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:54:43', '2024-07-25 07:54:43', 0, NULL, NULL),
(2962, 'FAJAR MAULANA', 'fajar-maulana_ebf45', '2Tyf2471_tech@fathforce.com', 'Student', NULL, '$2y$10$2e1y1O7pNN1jHaXviKk0L.XjumyUCic.wMOH4Lerz7M56ayDjtpsy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:54:43', '2024-07-25 07:54:43', 0, NULL, NULL),
(2963, 'FINA KHOIRUN NISSA', 'fina-khoirun-nissa_ffkWZ', 'Kzfc2472_tech@fathforce.com', 'Student', NULL, '$2y$10$9WthqjsHSiPWQyenUiQ3GeH6WcrdDktLxMhSNLSSzUfiQnBEvEHE2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:54:43', '2024-07-25 07:54:43', 0, NULL, NULL),
(2964, 'FUZI AL-HADAD', 'fuzi-al-hadad_fgBQZ', 'p4oQ2473_tech@fathforce.com', 'Student', NULL, '$2y$10$OGhTSqmY5S8bW8xsc9hbUeKu5tjDGhS7Hu928PmuUJvG.bbGGGR4a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:54:43', '2024-07-25 07:54:43', 0, NULL, NULL),
(2965, 'JUSTIN LEE KURNIAWAN', 'justin-lee-kurniawan_nDkTG', 'W9Rl2474_tech@fathforce.com', 'Student', NULL, '$2y$10$oEqumC2XbaSbjjjiqgcgt.QAb/4nUT42td5iZEpibQW5J7uPKL7ca', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:54:43', '2024-07-25 07:54:43', 0, NULL, NULL),
(2966, 'KEYSA KAYLA AULIA PUTRI', 'keysa-kayla-aulia-putri_XK18e', 'pYVK2475_tech@fathforce.com', 'Student', NULL, '$2y$10$7iLpYvYh7Z03t2dc4wVQVewbiaU/efpFHxXDOlq8z0/i6kun.dAFi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:54:43', '2024-07-25 07:54:43', 0, NULL, NULL),
(2967, 'LEXA ARVAREL OKTAVIANO', 'lexa-arvarel-oktaviano_Q5dkP', 'TeOb2476_tech@fathforce.com', 'Student', NULL, '$2y$10$Gwybci60XUNE5oE4.Hm/6O8RLbMi6yyFa5PokbIKItU9l9PZxQ04a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:54:43', '2024-07-25 07:54:43', 0, NULL, NULL),
(2968, 'M. FAZRIL SAHRUL AKBAR', 'm-fazril-sahrul-akbar_hBESo', 'Bsq62477_tech@fathforce.com', 'Student', NULL, '$2y$10$iduXEoXrWKhUMeWxNLKOl.Uk/BzbtqfwJsAdIgep5TIk0JczZ0cmW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:54:43', '2024-07-25 07:54:43', 0, NULL, NULL),
(2969, 'MEGA NUR\'AJIJAH', 'mega-nurajijah_vVeNo', '7aIL2478_tech@fathforce.com', 'Student', NULL, '$2y$10$qwPr296Cv.vtwEaGj62qcuBcVwKXfS1Wh8GHx13NsLQ3dmJBwx92K', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:54:44', '2024-07-25 07:54:44', 0, NULL, NULL),
(2970, 'MUHAMAD RIDHO NUGRAHA', 'muhamad-ridho-nugraha_BzWSo', 'bnqs2479_tech@fathforce.com', 'Student', NULL, '$2y$10$8H7lLywE1kH9BtWqDb3QLuQ/ftuNbV1w3P2cK2Y3ia8z9b5jl3v5a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:54:44', '2024-07-25 07:54:44', 0, NULL, NULL),
(2971, 'MUHAMMAD AGIS SETIAWAN', 'muhammad-agis-setiawan_0fQUD', '7Cfs2480_tech@fathforce.com', 'Student', NULL, '$2y$10$PxR8crOWI0Pr4odLkocpKeAoRXRW6sMosJzPCbAwTjVvRnr57VtOe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:54:44', '2024-07-25 07:54:44', 0, NULL, NULL),
(2972, 'MUTYARA RHAMADANI', 'mutyara-rhamadani_vsMt7', '09dH2481_tech@fathforce.com', 'Student', NULL, '$2y$10$1Jphhb3t8tKE4ZfZJ1HU6.uTsjye0lXkXMgux2B0mCLYbh0e1AxT6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:54:44', '2024-07-25 07:54:44', 0, NULL, NULL),
(2973, 'NOVAL ROMADANI', 'noval-romadani_aO3Fs', 'Ow7g2482_tech@fathforce.com', 'Student', NULL, '$2y$10$cs6XO6WZ.nySbgCHZZ26Hetar10RQ9m17Ik9wzx4XXfr1MHE2KIWa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:54:44', '2024-07-25 07:54:44', 0, NULL, NULL),
(2974, 'RAEHAN RANA HAFFIYAN', 'raehan-rana-haffiyan_5Rwhf', 'PgiO2483_tech@fathforce.com', 'Student', NULL, '$2y$10$8FQ9lfDhWBkPNeDmtaE7tuE7YHYH7OGoVygjNZbAYH.niuuDQZMN6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:54:44', '2024-07-25 07:54:44', 0, NULL, NULL),
(2975, 'RAFI IHSAN RAMADHAN', 'rafi-ihsan-ramadhan_Jcdk3', 'i8an2484_tech@fathforce.com', 'Student', NULL, '$2y$10$/CMVI9GIKtBpOyp25oYW2.ivMZmieddjVtVS29ZUjBVdBXyjeNE9O', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:54:44', '2024-07-25 07:54:44', 0, NULL, NULL),
(2976, 'RAMA MAULIDAN', 'rama-maulidan_zSAFo', '7l802485_tech@fathforce.com', 'Student', NULL, '$2y$10$g8Cn77wNc/55PAybx9yoQe45X89bqRjC2PuFnHFg4oxOxRJEQRJKK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:54:44', '2024-07-25 07:54:44', 0, NULL, NULL),
(2977, 'RANI FITRIYANI', 'rani-fitriyani_HugLs', 'wp072486_tech@fathforce.com', 'Student', NULL, '$2y$10$HyLFzFChHX7nQUEf.rtzdeRoJvPK.ROa8zZJjZSS.bnfv8O.Ogvnu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:54:44', '2024-07-25 07:54:44', 0, NULL, NULL),
(2978, 'REFA PUTRI NATANIA', 'refa-putri-natania_PtaNJ', 'dsnm2487_tech@fathforce.com', 'Student', NULL, '$2y$10$8gCkQWxGk0KlkdZHOyc1fe0JMXIaKvqch32WLQZcElgp7Mo6Ofubq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:54:44', '2024-07-25 07:54:44', 0, NULL, NULL),
(2979, 'RESTI KANIA', 'resti-kania_bNBXN', 'yDdG2488_tech@fathforce.com', 'Student', NULL, '$2y$10$Qnte.a0hn7GzBNMj8bvrA.8R2t9Y2OFyeW7kElF1RyfGOeZNKW9YS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:54:44', '2024-07-25 07:54:44', 0, NULL, NULL),
(2980, 'RESYA TRIYULIA', 'resya-triyulia_xzlWG', 'ujXi2489_tech@fathforce.com', 'Student', NULL, '$2y$10$RwZDQbNnnAKqfq1B5olwluKY0VYpR4eEpPrila7sM/UmeFmBjF0Su', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:54:44', '2024-07-25 07:54:44', 0, NULL, NULL),
(2981, 'REVAN ADITYA PRASETIAWAN', 'revan-aditya-prasetiawan_Wa0n9', 'HPmT2490_tech@fathforce.com', 'Student', NULL, '$2y$10$EpQm.O6yTxY0c0gGOo3QCODswsmuntrqzNHEFCloOXAgij9xMlfGm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:54:44', '2024-07-25 07:54:44', 0, NULL, NULL),
(2982, 'RISMA NURMAYANTI', 'risma-nurmayanti_bFDqk', 'OAgl2491_tech@fathforce.com', 'Student', NULL, '$2y$10$lEmePHOQq7Cz/Mck/Ax9ZuL4B6LEgsvUqAD.mBFtZzT7rK7/2GsOG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:54:45', '2024-07-25 07:54:45', 0, NULL, NULL),
(2983, 'RIZKI MAULANA', 'rizki-maulana_skqXR', 'etZQ2492_tech@fathforce.com', 'Student', NULL, '$2y$10$5sy/4I22VT02SIqKczazYeh41g6n49djYBaXQlcrj9FJNxKmR1Viy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:54:45', '2024-07-25 07:54:45', 0, NULL, NULL),
(2984, 'SENTIA DEWI RATNASARI', 'sentia-dewi-ratnasari_zstIV', '6IHw2493_tech@fathforce.com', 'Student', NULL, '$2y$10$I.gey772.cf6Ci24nNz1geGurqjt/HeCwnZWQQ.SXFxloPDjGepIO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:54:45', '2024-07-25 07:54:45', 0, NULL, NULL),
(2985, 'SILVYRA NURKHOTIMAH', 'silvyra-nurkhotimah_ldCB7', 'h9YL2494_tech@fathforce.com', 'Student', NULL, '$2y$10$xojGaB2lbUJSFyvdcpkJ2OffETuYoAvIto72id44/2d3b9qsZ5dMC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:54:45', '2024-07-25 07:54:45', 0, NULL, NULL),
(2986, 'SITI ROSMIATI', 'siti-rosmiati_rNFDp', 'v6ab2495_tech@fathforce.com', 'Student', NULL, '$2y$10$viY8VETzhORpf28xIx8pVegxSWqN0YLlBI/qSCj7KCN7IY49Qtgmu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:54:45', '2024-07-25 07:54:45', 0, NULL, NULL),
(2987, 'WIRA WIJAYA KUSUMA', 'wira-wijaya-kusuma_h40LN', 'Z8Cy2496_tech@fathforce.com', 'Student', NULL, '$2y$10$Je2kXnumQBRRBZlzRN4TJuCrimHZJm//wzwYYSVyH0uTygpYqDB6q', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:54:45', '2024-07-25 07:54:45', 0, NULL, NULL),
(2988, 'WISNU WIJAYUDIN', 'wisnu-wijayudin_icATL', 'XEEV2497_tech@fathforce.com', 'Student', NULL, '$2y$10$r3FMAdeT3s6IQvuy3h8mguaIDneI6H0zKsN4TktrC6qTFSiUazpnO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:54:45', '2024-07-25 07:54:45', 0, NULL, NULL),
(2989, 'ZULFA JAHRA ZAITUN', 'zulfa-jahra-zaitun_A2Wn1', 'jbFe2498_tech@fathforce.com', 'Student', NULL, '$2y$10$uHWlcE9tQSNmwb0ro0247./mp.MiUZELRDQ.gNCSNKKEUF4v6jtne', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:54:45', '2024-07-25 07:54:45', 0, NULL, NULL),
(2990, 'ANAS ANSHORI SAFARI, S.Pd.', 'anas-anshori-safari-spd_iX0iT', '1184_tech@fathforce.com', 'Teacher', NULL, '$2y$10$bk7ayEd9Yexmh36MhHqUKu74Y5LOFkhw57hvtKrO6Wg7dN2EzpQsi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '067', NULL, NULL, NULL, NULL, 0, '2024-07-25 07:55:14', '2024-07-25 07:55:14', 0, NULL, NULL),
(2991, 'ADITIA MAULANA MANSUR', 'aditia-maulana-mansur_DmXv0', '2427_tech@fathforce.com', 'Student', NULL, '$2y$10$lKD.7M3BptHSu0cOd47NI.TMFGnAv6FgbtU/jMFYOKHqxDMEUG/rW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:00:17', '2024-07-25 08:00:17', 0, NULL, NULL),
(2992, 'AKMAL NUR IKSAN', 'akmal-nur-iksan_DFuS2', '2428_tech@fathforce.com', 'Student', NULL, '$2y$10$Jd5AvgtLj/QjxEeOEpYwEev3giAP5BODyYnEt1.DWnzRTaQoOpnQG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:00:17', '2024-07-25 08:00:17', 0, NULL, NULL),
(2993, 'ALI HUSAINI', 'ali-husaini_H2ybH', '2429_tech@fathforce.com', 'Student', NULL, '$2y$10$DKnnwx.UELj60KulwshbteQIxOSdW5CZzbgOG2ba48ztk6fFsKAPS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:00:17', '2024-07-25 08:00:17', 0, NULL, NULL),
(2994, 'ALIFA SALSABILA', 'alifa-salsabila_I8lmf', '2430_tech@fathforce.com', 'Student', NULL, '$2y$10$FqoCpatx0WLxrPzRmMeEAOaAJKnmB1574Om2F7k9uORABlND5LTJG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:00:17', '2024-07-25 08:00:17', 0, NULL, NULL),
(2995, 'ASHRIYAH USWATUN HASANAH', 'ashriyah-uswatun-hasanah_7CvZF', '2431_tech@fathforce.com', 'Student', NULL, '$2y$10$hi6KUk7Yc2gIWNgAB7yotu/29/Psu.mLX6LD2RZrHfsEnsEgzYili', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:00:17', '2024-07-25 08:00:17', 0, NULL, NULL),
(2996, 'CHANDRA ADITYANA SUHENDAR', 'chandra-adityana-suhendar_691kZ', '2432_tech@fathforce.com', 'Student', NULL, '$2y$10$bX8OmTscTKJsJgTzlRsctOfCJFr0yDZX4cyERNt/I.Af7QHrR/wA6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:00:17', '2024-07-25 08:00:17', 0, NULL, NULL),
(2997, 'FAJAR WAHYU PRIADI', 'fajar-wahyu-priadi_Unetr', '2433_tech@fathforce.com', 'Student', NULL, '$2y$10$SllsyNpMqVGd/yZbhUCho.DRsuBm23WFvn75If3H1KE.UFHKkKasO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:00:18', '2024-07-25 08:00:18', 0, NULL, NULL),
(2998, 'DANI RAMDANI', 'dani-ramdani_UNoAa', '2434_tech@fathforce.com', 'Student', NULL, '$2y$10$bMc49HABIJjlgRK2m5udYu9ZdicZUZfooapWYvIuaE.twY4ZroTj6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:00:18', '2024-07-25 08:00:18', 0, NULL, NULL),
(2999, 'DAVIT FEBRIAN GHIFARI', 'davit-febrian-ghifari_Dggtd', '2435_tech@fathforce.com', 'Student', NULL, '$2y$10$QZng5wUU79EjIiXOIxZBseaITQ34Z6Q9S.UsrCNOLgupS5lOF/X2u', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:00:18', '2024-07-25 08:00:18', 0, NULL, NULL),
(3000, 'DENDRA ARYA SAPUTRA', 'dendra-arya-saputra_9S7gm', '2436_tech@fathforce.com', 'Student', NULL, '$2y$10$6.pFd2oCYJ/g9GFUwhN5he4BqVmfyU5dyhSUXYrlvetFb97GjtsFi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:00:18', '2024-07-25 08:00:18', 0, NULL, NULL),
(3001, 'ERIK KASTORI', 'erik-kastori_weS8W', '2437_tech@fathforce.com', 'Student', NULL, '$2y$10$Faf7TMcAKyjU06VTlGYfKOrUuNPKic.sFKfvS2aOT35eVUkY9LUfK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:00:18', '2024-07-25 08:00:18', 0, NULL, NULL),
(3002, 'HAIKAL LUTFIANA FAHMI', 'haikal-lutfiana-fahmi_e70SP', '2438_tech@fathforce.com', 'Student', NULL, '$2y$10$lz57.RGF5G2uuVA1qvEi8eyBAbmOQ3iO5EB6Losq8HT.CeNACSu4W', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:00:18', '2024-07-25 08:00:18', 0, NULL, NULL),
(3003, 'HELGA SEPTIAN RAMADHAN', 'helga-septian-ramadhan_VJUDC', '2439_tech@fathforce.com', 'Student', NULL, '$2y$10$SIAaHB44GVzhXl02L1f7b.RzVvXvAtfn7.Vdcmde2ZNBTt.qOHwmW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:00:18', '2024-07-25 08:00:18', 0, NULL, NULL),
(3004, 'HILDA FAUZIAH', 'hilda-fauziah_ue4Xi', '2440_tech@fathforce.com', 'Student', NULL, '$2y$10$cmGL9k.8B1O.hFUja4TW2OBFF/i9iV7.TcnEWMqXccuX2LAm8OOQK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:00:18', '2024-07-25 08:00:18', 0, NULL, NULL),
(3005, 'JANI KURNIA', 'jani-kurnia_BZJ3Z', '2441_tech@fathforce.com', 'Student', NULL, '$2y$10$patAGBQ6QhdFkwKnZV1ODOvxKFhgPU9y7k6G7OFUNxF1K/sdB0f26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:00:18', '2024-07-25 08:00:18', 0, NULL, NULL),
(3006, 'LEVIANA', 'leviana_2q4tC', '2442_tech@fathforce.com', 'Student', NULL, '$2y$10$b//.6SVicDkKgGHR6DAcwOrVrTmRXgM.akS3TpHogKS69GTT18cRi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:00:18', '2024-07-25 08:00:18', 0, NULL, NULL),
(3007, 'M RIZKY MAULADANI', 'm-rizky-mauladani_WlZf4', '2443_tech@fathforce.com', 'Student', NULL, '$2y$10$Z1AtUDJRiG5DAYUgC5gDnOwhlQjwEwO3zs0jP2k.1iy/8bkvt3/zC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:00:18', '2024-07-25 08:00:18', 0, NULL, NULL),
(3008, 'MUHAMAD AZHAR ADYA ULHAQ', 'muhamad-azhar-adya-ulhaq_lsRhv', '2444_tech@fathforce.com', 'Student', NULL, '$2y$10$CaOmC/Ha6GFJewV5sd8k3uSJ6XBzkT9jp8DCfQuhGrnFtlx0NfvTC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:00:18', '2024-07-25 08:00:18', 0, NULL, NULL),
(3009, 'MUHAMMAD HILMI', 'muhammad-hilmi_QEkkp', '2445_tech@fathforce.com', 'Student', NULL, '$2y$10$7nzP9J5SQTAMUIC/HdDneOzx78kbnFD.aV7gcxO9HZIIb2Wwa6GrC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:00:18', '2024-07-25 08:00:18', 0, NULL, NULL),
(3010, 'MUHAMMAD MEILKY SATYANENDAR', 'muhammad-meilky-satyanendar_dW4SG', '2446_tech@fathforce.com', 'Student', NULL, '$2y$10$/PKJcVs0fP8ZHzNbNYrbP.IxkP5i7P3I58yDC3CY.Gh9Ajzc/GAFi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:00:18', '2024-07-25 08:00:18', 0, NULL, NULL),
(3011, 'NAUFAL DARIS FAUZAN', 'naufal-daris-fauzan_5jqL3', '2447_tech@fathforce.com', 'Student', NULL, '$2y$10$N6JzkKecDNvIvp2zv6D/wuc37DPobjvirklOUqnXxMrXrGuHDw/i6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:00:19', '2024-07-25 08:00:19', 0, NULL, NULL);
INSERT INTO `users` (`id`, `name`, `username`, `email`, `role`, `email_verified_at`, `password`, `code`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `fcm_token`, `current_team_id`, `profile_photo_path`, `status`, `phone`, `address`, `department_id`, `date_of_birth`, `gender`, `account_hold`, `created_at`, `updated_at`, `tour_completed`, `face_embedding`, `id_reference`) VALUES
(3012, 'NAZWA KAMILATUNNISA', 'nazwa-kamilatunnisa_GXDo1', '2448_tech@fathforce.com', 'Student', NULL, '$2y$10$/7uE4dIptMjKFcx2g2rmUu1N4PVJpLF9Kl3sMdaRLRq8qk7n..gYu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:00:19', '2024-07-25 08:00:19', 0, NULL, NULL),
(3013, 'NISA ZAKIA', 'nisa-zakia_0y9kg', '2449_tech@fathforce.com', 'Student', NULL, '$2y$10$69JosLaKMLt5vzb4qBlVkeLRVJm3j4kBW2fscbOZrJ2E.DAZ41QMi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:00:19', '2024-07-25 08:00:19', 0, NULL, NULL),
(3014, 'NOVA', 'nova_e9Z5S', '2450_tech@fathforce.com', 'Student', NULL, '$2y$10$aUZlW3.p0WvAPw1Dnj8wWO3eUqK7yaCfgaVj7iO5BheY1NijXvKwq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:00:19', '2024-07-25 08:00:19', 0, NULL, NULL),
(3015, 'PASYA GUSTA PURWANDHA', 'pasya-gusta-purwandha_YB1Ab', '2451_tech@fathforce.com', 'Student', NULL, '$2y$10$2zSVxmM8ZmXg/ENuOV4Pt.NRsMlwZ6YWg6MbNno29by/YasZJ8.Q6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:00:19', '2024-07-25 08:00:19', 0, NULL, NULL),
(3016, 'PINA PADILAH', 'pina-padilah_2cRv3', '2452_tech@fathforce.com', 'Student', NULL, '$2y$10$y.PZfa/luNG4RwseCk0bwuy.wOUBTquMfbQve5RZjME3oZFMmaQXW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:00:19', '2024-07-25 08:00:19', 0, NULL, NULL),
(3017, 'RANI KURNIAWATI', 'rani-kurniawati_cGqMk', '2453_tech@fathforce.com', 'Student', NULL, '$2y$10$SZZ3xjUpHYsP67VxdrcG4eM81g7OE.IWBewAAaw.H9mkiZFYq0ZSu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:00:19', '2024-07-25 08:00:19', 0, NULL, NULL),
(3018, 'RIJAL', 'rijal_qjb3u', '2454_tech@fathforce.com', 'Student', NULL, '$2y$10$wm/waKTe0ceLdGxRCS3rMO9kLz2HvRyHsEhuQgqIp/K2wRt4.tk2W', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:00:19', '2024-07-25 08:00:19', 0, NULL, NULL),
(3019, 'RIZKY MAULANA', 'rizky-maulana_gkBbl', '2455_tech@fathforce.com', 'Student', NULL, '$2y$10$wIa98IOSTqdSl1y1Liop2OrcZZefRdcWF/gW48/hA87zOTcRKipES', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:00:19', '2024-07-25 08:00:19', 0, NULL, NULL),
(3020, 'SALMA NURFAZRIAH', 'salma-nurfazriah_k8Gny', '2456_tech@fathforce.com', 'Student', NULL, '$2y$10$g/nngm5.SIAfn1skdwNrtu6JGld6b5zr2hCBGqdmygphvugA0M/Eu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:00:19', '2024-07-25 08:00:19', 0, NULL, NULL),
(3021, 'SELI SISILIANI', 'seli-sisiliani_DiGdp', '2457_tech@fathforce.com', 'Student', NULL, '$2y$10$i2te2gAbWx9ujTPCsPSQ9uQYzMHAvUpZtvXtzY4b65o75zRNKqm4e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:00:19', '2024-07-25 08:00:19', 0, NULL, NULL),
(3022, 'SITI ZAHRA', 'siti-zahra_XUkCZ', '2458_tech@fathforce.com', 'Student', NULL, '$2y$10$QOBegwpsyn5ZwNzESnaxtOTgpZZGEF78Gec/OU9iUUKmrTa0eYwtm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:00:19', '2024-07-25 08:00:19', 0, NULL, NULL),
(3023, 'SOFIYATUN LUMELA', 'sofiyatun-lumela_3r8yO', '2459_tech@fathforce.com', 'Student', NULL, '$2y$10$/0kpgHW4C2EhCSePI0/52ud5A7VXf/bHOyRbnHSOiwiX2CBSxKCR.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:00:20', '2024-07-25 08:00:20', 0, NULL, NULL),
(3024, 'TIA FEBRIANTI', 'tia-febrianti_ZcPLH', '2460_tech@fathforce.com', 'Student', NULL, '$2y$10$INYbxmzw53IWu6z3Do7QHOpEtFyJcfeidIs/YRZCHdwiy7hLsVpwO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:00:20', '2024-07-25 08:00:20', 0, NULL, NULL),
(3025, 'VANI RAHMAYANTI', 'vani-rahmayanti_MJVwb', '2461_tech@fathforce.com', 'Student', NULL, '$2y$10$ZaDFYyqhr2V6ewQxTMHleuwCYrPZBTmYVbQJy2oWLMTMOF2zuvIDK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:00:20', '2024-07-25 08:00:20', 0, NULL, NULL),
(3026, 'YUNI MULYANI', 'yuni-mulyani_jwLNZ', '2462_tech@fathforce.com', 'Student', NULL, '$2y$10$8UCjfI0EmvkaZAboW6ylYOWUUriFBXGZ/RKDDf2hNTD5I6zWRJCOW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:00:20', '2024-07-25 08:00:20', 0, NULL, NULL),
(3027, 'KHOERUL UMAM AL AWAHIR, S.Pd.', 'khoerul-umam-al-awahir-spd_wpdvk', '1185_tech@fathforce.com', 'Teacher', NULL, '$2y$10$NASQwys4J8ka2hrvRh9xd.mWNVfEdmrYx9yHJ.B4W9ecWctAcTzv.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '888', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:00:55', '2024-07-25 08:00:55', 0, NULL, NULL),
(3028, 'ADIS SEFTI ROSTIANTY', 'adis-sefti-rostianty_UPHPY', '2391_tech@fathforce.com', 'Student', NULL, '$2y$10$gRvjdmhPpX9ctz9vOkVdL.L8GNz4eowF1ZeHxf8FFD2MPvNCRf2e.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:05:00', '2024-07-25 08:05:00', 0, NULL, NULL),
(3029, 'ANDIKA DWI NUGRAHA', 'andika-dwi-nugraha_G2G7M', '2392_tech@fathforce.com', 'Student', NULL, '$2y$10$sR7KUgifyDOakJ/7DK5Lr.ajKKJkVgYq5ZHS7aBByVKU/9g1rtPRS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:05:01', '2024-07-25 08:05:01', 0, NULL, NULL),
(3030, 'ANDRE REZAL FEBRIAN NUGRAHA', 'andre-rezal-febrian-nugraha_8xV4j', '2393_tech@fathforce.com', 'Student', NULL, '$2y$10$r3yCPP8yBsEWW2fnqIb/Ge05ibqbrVnEEwWuYAV4Z8vlsKOaW0Meq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:05:01', '2024-07-25 08:05:01', 0, NULL, NULL),
(3031, 'AZIZ RACHMAN', 'aziz-rachman_A0DW5', '2394_tech@fathforce.com', 'Student', NULL, '$2y$10$75KVT/A2IhFrN/WZVDzDFejZ3XaMz08bVG3bRA7JehJzMnP2j6oee', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:05:01', '2024-07-25 08:05:01', 0, NULL, NULL),
(3032, 'CEILA APRILIA', 'ceila-aprilia_hw5KK', '2395_tech@fathforce.com', 'Student', NULL, '$2y$10$.ZowoatVlqu/IlXkWIzz9eJgiVSjJbpdFzYhtieiYxPQYeFkblqsC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:05:01', '2024-07-25 08:05:01', 0, NULL, NULL),
(3033, 'DEANDRA AZIM GHANIE', 'deandra-azim-ghanie_3g8ud', '2396_tech@fathforce.com', 'Student', NULL, '$2y$10$oDxAY/LxJZB2Tj5Nf47vWOCiKSQMn6PO5YUAEIhh7JrW9ev8hxIoy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:05:01', '2024-07-25 08:05:01', 0, NULL, NULL),
(3034, 'DEVI AULIA AFRIDA', 'devi-aulia-afrida_4wLqh', '2397_tech@fathforce.com', 'Student', NULL, '$2y$10$Bdg2h3iYaezhUU.SsCWbPu5MYQpkd/364TyzA3yMjSWJFdC4HP3uu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:05:01', '2024-07-25 08:05:01', 0, NULL, NULL),
(3035, 'DWI KHARISMA FUTRI', 'dwi-kharisma-futri_odx3b', '2398_tech@fathforce.com', 'Student', NULL, '$2y$10$GTmgAndlXUFhGQ8vPJN9t.1GMKtqScta4IWB9tPk/vRKW4DoSBZIe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:05:01', '2024-07-25 08:05:01', 0, NULL, NULL),
(3036, 'ERVINA RIZKI APRILIANI', 'ervina-rizki-apriliani_9XyzG', '2399_tech@fathforce.com', 'Student', NULL, '$2y$10$gCi6pP6YH.yhimqOrI.4x.dfJxd0HRK3vUap0mmleWy3RZfQpHTAG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:05:01', '2024-07-25 08:05:01', 0, NULL, NULL),
(3037, 'GILANG FEBRIANSYAH', 'gilang-febriansyah_Q5sYi', '2400_tech@fathforce.com', 'Student', NULL, '$2y$10$883iVlJOZIt8tfyDQkCT7.6bCvrRU4itZul1rzZ/c6UYfSEzo1XX.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:05:01', '2024-07-25 08:05:01', 0, NULL, NULL),
(3038, 'INTANA OCTAVIANA', 'intana-octaviana_9tznG', '2401_tech@fathforce.com', 'Student', NULL, '$2y$10$ebQlkMxoZx.TAkMIfO9it.HUEN29MHVWxvhH/kVUtTGizqh7Xzcoq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:05:02', '2024-07-25 08:05:02', 0, NULL, NULL),
(3039, 'ISMA AISYAH', 'isma-aisyah_U11YT', '2402_tech@fathforce.com', 'Student', NULL, '$2y$10$dAyNVGa3g2vhY2RJxByBmOR7H7m0yfOo3MNmSWXoz8KQKoDql.7ee', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:05:02', '2024-07-25 08:05:02', 0, NULL, NULL),
(3040, 'KAKA DRIANSYAH', 'kaka-driansyah_LZYsV', '2403_tech@fathforce.com', 'Student', NULL, '$2y$10$UrNaTsJ6vGuJLiOsgz4gSOPsj5ZCBjkO2BU0hUdNKy0qCWcv1qafy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:05:02', '2024-07-25 08:05:02', 0, NULL, NULL),
(3041, 'LUTFI APRILIANSYAH', 'lutfi-apriliansyah_c2z6g', '2404_tech@fathforce.com', 'Student', NULL, '$2y$10$YLTewpAbvU2VMegRdxzCXue.4WQ0BWx3E9nEsiWEOAHQF0hhbyMi6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:05:02', '2024-07-25 08:05:02', 0, NULL, NULL),
(3042, 'MALIKA HILMI HUDAYA', 'malika-hilmi-hudaya_MAKPD', '2405_tech@fathforce.com', 'Student', NULL, '$2y$10$wOqPjAILzVU.wihVsyk8MeWKOPfescFpdyauNvjMeUdTqfGrD1SfC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:05:02', '2024-07-25 08:05:02', 0, NULL, NULL),
(3043, 'MUHAMAD ANGGI FAUZI', 'muhamad-anggi-fauzi_3hNlB', '2406_tech@fathforce.com', 'Student', NULL, '$2y$10$AcIxMJZ.CBqqygOrIPOsve0pONvu.YJcK5R6ylbMNQPr9Vaz46cky', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:05:02', '2024-07-25 08:05:02', 0, NULL, NULL),
(3044, 'MUKHLIS', 'mukhlis_upskW', '2407_tech@fathforce.com', 'Student', NULL, '$2y$10$AdDJ2GzYV8f.PVNuVUKbUOydd6MAVWh4WMCYOX1KjZ8YFNw80GIbu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:05:02', '2024-07-25 08:05:02', 0, NULL, NULL),
(3045, 'N IAN SUMI HARYANI', 'n-ian-sumi-haryani_wXpJn', '2408_tech@fathforce.com', 'Student', NULL, '$2y$10$EX01b0cV4SphBmbRCD9N1OmqAFfenl.Hmcb1kcRqF7xrXKQDE1lW2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:05:02', '2024-07-25 08:05:02', 0, NULL, NULL),
(3046, 'NABILA PUTRI KUSMAENI', 'nabila-putri-kusmaeni_Ntoul', '2409_tech@fathforce.com', 'Student', NULL, '$2y$10$z7yqy4EM8/BnRqZM4kfO7u4dZvLn9XxdUEFGmCYdQadW/nshaQWKC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:05:02', '2024-07-25 08:05:02', 0, NULL, NULL),
(3047, 'NAILA FITRI MULYANTI', 'naila-fitri-mulyanti_MswiG', '2410_tech@fathforce.com', 'Student', NULL, '$2y$10$5SRVi14RC/YbZ/MxSkwhwePBB0wMe60EmuLi2cWmFUvZO.YrUijTq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:05:03', '2024-07-25 08:05:03', 0, NULL, NULL),
(3048, 'NOUFAL FARRO FAZHLIANSYAH', 'noufal-farro-fazhliansyah_BZDga', '2411_tech@fathforce.com', 'Student', NULL, '$2y$10$iq4504TLz3gZhY6un3vbiuexyHI16qOOvKkUh4PoYNQSXynPiNgg.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:05:03', '2024-07-25 08:05:03', 0, NULL, NULL),
(3049, 'PERI SETIAWAN', 'peri-setiawan_xc0c4', '2412_tech@fathforce.com', 'Student', NULL, '$2y$10$4ZfWzd1FaVxnS9fifN3wGuzLnSb8hCc.06EcT9NXC..Uc4xFED/ha', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:05:03', '2024-07-25 08:05:03', 0, NULL, NULL),
(3050, 'RADIT ADITIA APRILIAN', 'radit-aditia-aprilian_wYaRc', '2413_tech@fathforce.com', 'Student', NULL, '$2y$10$FgUuzBQnnUKPObgzFwn9XupB.BHhzLIMA1oxNGhCYNe1qFEt2VFIm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:05:03', '2024-07-25 08:05:03', 0, NULL, NULL),
(3051, 'RAISYA KAMIL', 'raisya-kamil_gTHM8', '2414_tech@fathforce.com', 'Student', NULL, '$2y$10$1rfZ5mqouLvUaN9PI4yC5OfcHS4fpnOKU6ioPspOygVh86DL1C7Xq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:05:03', '2024-07-25 08:05:03', 0, NULL, NULL),
(3052, 'RAKHA PRANATA SUTARDI', 'rakha-pranata-sutardi_ikLnU', '2415_tech@fathforce.com', 'Student', NULL, '$2y$10$Xch0uW7dUUxBylGuedq1OeYt6J2OI43OkoRAAvkaA4nQSmv5nFFz6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:05:03', '2024-07-25 08:05:03', 0, NULL, NULL),
(3053, 'RENA NURHASANAH', 'rena-nurhasanah_k1Ag6', '2416_tech@fathforce.com', 'Student', NULL, '$2y$10$gDJjWzGdm257gqdG2oT8XOM/fY4FcRbP0GDc6ncPjF87d2plZn6xG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:05:03', '2024-07-25 08:05:03', 0, NULL, NULL),
(3054, 'RESYA NURDIANSYAH', 'resya-nurdiansyah_MrBcS', '2417_tech@fathforce.com', 'Student', NULL, '$2y$10$X.Av4NAH/nBsb/Ss2yxpg.QG4rX5cBSwJfNh6lnFzmVruytOVBbwG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:05:03', '2024-07-25 08:05:03', 0, NULL, NULL),
(3055, 'RIDWAN', 'ridwan_byYls', '2418_tech@fathforce.com', 'Student', NULL, '$2y$10$rQOlosI.D2sxdjUB7jdWFu.ZXPBnet8s5eyhq82VE/lSJVDqXrUru', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:05:03', '2024-07-25 08:05:03', 0, NULL, NULL),
(3056, 'RISKI ABDILAH', 'riski-abdilah_zi4GF', '2419_tech@fathforce.com', 'Student', NULL, '$2y$10$NJHaxrEXRVEVmTeABINwKehBT.PT.QNQfo/nM57h7GBCLEtWGPPsa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:05:03', '2024-07-25 08:05:03', 0, NULL, NULL),
(3057, 'RISVA FELIANI', 'risva-feliani_tFRHY', '2420_tech@fathforce.com', 'Student', NULL, '$2y$10$BZklI57jbXNsWo1FdF2RBekTipYPiV0DVwDKcW.ZvrZV1Lg4i8XeK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:05:04', '2024-07-25 08:05:04', 0, NULL, NULL),
(3058, 'RIZAL JAELANI AHMAD', 'rizal-jaelani-ahmad_yKDnt', '2421_tech@fathforce.com', 'Student', NULL, '$2y$10$bGdhRZ5J3P0us2nNBa27NezmOpmw8NHUOz6Hi8wajjYB9en.uvcUK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:05:04', '2024-07-25 08:05:04', 0, NULL, NULL),
(3059, 'RIZQI KURNIAWAN', 'rizqi-kurniawan_Bbxj5', '2422_tech@fathforce.com', 'Student', NULL, '$2y$10$yRIJnsFSTrv6Um3GnSDbG.t.q71Yr8JyUkAO5jp2hztj35iHKQYg6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:05:04', '2024-07-25 08:05:04', 0, NULL, NULL),
(3060, 'SEIRA AZZAHRA', 'seira-azzahra_zkysz', '2423_tech@fathforce.com', 'Student', NULL, '$2y$10$9lTrIRkVDAhVquo1PtUMUOfXa32bBPyAAtde5JIm.J1e14elOrIM6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:05:04', '2024-07-25 08:05:04', 0, NULL, NULL),
(3061, 'SERLI DWI ANGGRAENI', 'serli-dwi-anggraeni_WKP2d', '2424_tech@fathforce.com', 'Student', NULL, '$2y$10$tbhICIWgVMpp6AXBre8leOZPUrjJMBu2ub8ZYZRPA5rmZC0chvGAC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:05:04', '2024-07-25 08:05:04', 0, NULL, NULL),
(3062, 'YUDA', 'yuda_d9mZg', '2425_tech@fathforce.com', 'Student', NULL, '$2y$10$xWQArhOFIWsAx4Gy.UW.iO1Th2Zzsnhdnc4mIjkjAE3e878vjZjOG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:05:04', '2024-07-25 08:05:04', 0, NULL, NULL),
(3063, 'ZAHRA AMELIA', 'zahra-amelia_67VNc', '2426_tech@fathforce.com', 'Student', NULL, '$2y$10$R9K8WdL0lSyWTmUvsB5M2O2bNDKogekpXDMwMM/Zb7fsoZipQ6u3C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:05:04', '2024-07-25 08:05:04', 0, NULL, NULL),
(3064, 'AHMAD FAKHRI RAMADHAN, S.Sn.', 'ahmad-fakhri-ramadhan-ssn_LausW', '1186_tech@gmail.com', 'Teacher', NULL, '$2y$10$zmIRTvrAGiK1xwBWcalojuaRcK5/j3ZVAD55CMGA6oIuFHYFz7j1.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '987654', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:05:21', '2024-07-25 08:05:21', 0, NULL, NULL),
(3065, 'DIAN SUDIANA, S.Kom.', 'dian-sudiana-skom_UZRU2', '1187_tech@gmail.com', 'Teacher', NULL, '$2y$10$.ubwN2LSzwDFfWq/IzEEhuKLBzLNNTBkuhXj2KWhJ9sBBh2Nsn6dK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '098765', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:09:32', '2024-07-25 08:09:32', 0, NULL, NULL),
(3066, 'ADE RIYAN PUTRA', 'ade-riyan-putra_JvURu', '2319_tech@fathforce.com', 'Student', NULL, '$2y$10$cf4UiN59ZvTUHvpBeb9Yo.pz/iqJLgiAjHjMvwmc372./P7MhqL/6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:10:01', '2024-07-25 08:10:01', 0, NULL, NULL),
(3067, 'ADE WAHYU MAULANA', 'ade-wahyu-maulana_NK8w0', '2320_tech@fathforce.com', 'Student', NULL, '$2y$10$diNSwCeBTDUjPp72B7puZuyKqbHCPgzIU2/Wr29bAAl6.yCwKiImW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:10:01', '2024-07-25 08:10:01', 0, NULL, NULL),
(3068, 'AHMAD MIFTAH FAIZ', 'ahmad-miftah-faiz_h6b6l', '2321_tech@fathforce.com', 'Student', NULL, '$2y$10$NjPbOGmPtItxZypA1S8zrOmFNyCQmwl3xCcJuYIHXDqwHUvNvH7Cm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:10:01', '2024-07-25 08:10:01', 0, NULL, NULL),
(3069, 'ALDI PIRMANSAH', 'aldi-pirmansah_LGnwq', '2322_tech@fathforce.com', 'Student', NULL, '$2y$10$hNOhu3pmDc/r6opgC7E4feuXIu4mbLePsSPRCMZ7vy5K.vr/CXK0i', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:10:01', '2024-07-25 08:10:01', 0, NULL, NULL),
(3070, 'ALIF LUKMAN NUR HAKIM', 'alif-lukman-nur-hakim_D6gd1', '2323_tech@fathforce.com', 'Student', NULL, '$2y$10$Kupp3CA.EiqSlobHiNwXguVx8AAJJE8A8LIz51Dux1AquFvnJT7.K', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:10:02', '2024-07-25 08:10:02', 0, NULL, NULL),
(3071, 'ANDRI HERMAWAN', 'andri-hermawan_5pheV', '2324_tech@fathforce.com', 'Student', NULL, '$2y$10$7s9CpC374beq33uhyDPile8PL5HlF2Pj/lsIT686rjeh5EVg5KZ4W', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:10:02', '2024-07-25 08:10:02', 0, NULL, NULL),
(3072, 'ARIS ARDIANSAH', 'aris-ardiansah_MIF1H', '2325_tech@fathforce.com', 'Student', NULL, '$2y$10$gPf6hvIdqa6b4arGOeQR5OZvwqMGp7VfGcABPnMUG6Q2nKevnWAZG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:10:02', '2024-07-25 08:10:02', 0, NULL, NULL),
(3073, 'ATEP NURHIDAYAT', 'atep-nurhidayat_Npvmc', '2326_tech@fathforce.com', 'Student', NULL, '$2y$10$YGDvyfm3TptJ3Zmmo4Xmfu1zMjdyZBQQr2eajo15Y51M4b/chjRdm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:10:02', '2024-07-25 08:10:02', 0, NULL, NULL),
(3074, 'AYU SITI DALPAH', 'ayu-siti-dalpah_EHTEg', '2327_tech@fathforce.com', 'Student', NULL, '$2y$10$3swOxd5Lww3colhnrB8yWevX9lnoWHfEpxEZiBQlFmSjrVCWUY7Jy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:10:02', '2024-07-25 08:10:02', 0, NULL, NULL),
(3075, 'CASILLA VINANDA', 'casilla-vinanda_wTO36', '2328_tech@fathforce.com', 'Student', NULL, '$2y$10$aLENu8bqj7nrpZ1sL59.UOJpxxlvEeJ1ocR9H9onOHwBzW2rpGZHa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:10:02', '2024-07-25 08:10:02', 0, NULL, NULL),
(3076, 'DESI MULYANI', 'desi-mulyani_4W3vQ', '2329_tech@fathforce.com', 'Student', NULL, '$2y$10$y2cjnaFuP4.ySGkQ8lNNYOR2WbwU5rzJgXqTqGg9.ZJd0kXPPkRIu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:10:02', '2024-07-25 08:10:02', 0, NULL, NULL),
(3077, 'FARID PUTRA KOSDIANA', 'farid-putra-kosdiana_jZMpf', '2330_tech@fathforce.com', 'Student', NULL, '$2y$10$57blMBC08T.O8vj4ZXeR9uxQ8TFv6Csh9sOjc0vGfMy8ZB.wGss.S', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:10:02', '2024-07-25 08:10:02', 0, NULL, NULL),
(3078, 'IPHAM MUHAMMAD GINAN', 'ipham-muhammad-ginan_iRymq', '2331_tech@fathforce.com', 'Student', NULL, '$2y$10$peis5DFB8laakkO8.z9aUeAh4Xj9iVLC7AsdXJJOoDlfIMtq0wPF6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:10:03', '2024-07-25 08:10:03', 0, NULL, NULL),
(3079, 'KRISNO SEPTIAN RAMDANI', 'krisno-septian-ramdani_j6TQI', '2332_tech@fathforce.com', 'Student', NULL, '$2y$10$hIJxk7oN6HGmBk9UPH8DMOcT3wQ8QEZi7Yt.8kbzND60r/yPk4WDS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:10:03', '2024-07-25 08:10:03', 0, NULL, NULL),
(3080, 'LINDA RIJKI JULIA', 'linda-rijki-julia_9Pk6q', '2333_tech@fathforce.com', 'Student', NULL, '$2y$10$j//oB.tevA9bI5U/qMXCJeRwM8j2oEkg8.0BmhifOFjLQ1Pw4VDAm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:10:03', '2024-07-25 08:10:03', 0, NULL, NULL),
(3081, 'MAULIDIA SAHLA RIZKIA', 'maulidia-sahla-rizkia_w2W3b', '2334_tech@fathforce.com', 'Student', NULL, '$2y$10$gAMKa1FSq2ks33avX1wsfeQqxjkaDUwyqZ4J6CkPUO8/MZW6455iO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:10:03', '2024-07-25 08:10:03', 0, NULL, NULL),
(3082, 'MUHAMAD NIZAR ALI', 'muhamad-nizar-ali_7Trc4', '2335_tech@fathforce.com', 'Student', NULL, '$2y$10$yTd/gBFIQTHsYSvHaH8/ye2Y5/J5uj39CpnNNO/E/YugNaRl6MoR2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:10:03', '2024-07-25 08:10:03', 0, NULL, NULL),
(3083, 'MUHAMMAD FARREL', 'muhammad-farrel_A9NWB', '2336_tech@fathforce.com', 'Student', NULL, '$2y$10$TN9TeUg7YzUS89OLrsvag.wYDfisFb4C1mdbyZDeLFlc4sOV0c9X6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:10:03', '2024-07-25 08:10:03', 0, NULL, NULL),
(3084, 'MUKHLISIN PRATAMA SUKMARA', 'mukhlisin-pratama-sukmara_Co6M7', '2337_tech@fathforce.com', 'Student', NULL, '$2y$10$HXS38sNyrxa.6thGrD7Jl.xusW.d8aAJVtyCJlgUlYFXMU7MMELVG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:10:03', '2024-07-25 08:10:03', 0, NULL, NULL),
(3085, 'NAILA AULIA SYAHRANJANI', 'naila-aulia-syahranjani_OpVPu', '2338_tech@fathforce.com', 'Student', NULL, '$2y$10$HY5twa8vAoz2gh/3cw/XMONaV0uE47ifPCcYTsA8HA4Q9JNo7vZtK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:10:03', '2024-07-25 08:10:03', 0, NULL, NULL),
(3086, 'NAZHA SUCI NURAZIZAH', 'nazha-suci-nurazizah_3DNzy', '2339_tech@fathforce.com', 'Student', NULL, '$2y$10$b7XtX9DOzg0KD.uSCHCQ4uXrSG2Uy5TsB71A7S5BZ0okdpngLNAL6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:10:03', '2024-07-25 08:10:03', 0, NULL, NULL),
(3087, 'PADLI PADILAH', 'padli-padilah_AcUlK', '2340_tech@fathforce.com', 'Student', NULL, '$2y$10$BiKSs.2E7aE71da/zb4NSO5.UwyZyla0Dr.gsQyWIttM4e7/4GxE6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:10:03', '2024-07-25 08:10:03', 0, NULL, NULL),
(3088, 'PAHMI ANJANI', 'pahmi-anjani_11LPC', '2341_tech@fathforce.com', 'Student', NULL, '$2y$10$updndaC6MKWPdL.UczXnJujcOSyyfWreXzpzMcwnGJoBuz/t31ejK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:10:03', '2024-07-25 08:10:03', 0, NULL, NULL),
(3089, 'PUPUT RIZKIA RAHAYU', 'puput-rizkia-rahayu_5gRpk', '2342_tech@fathforce.com', 'Student', NULL, '$2y$10$7Tr8n3HjGhpQwua2KqaFTOUzxz3uhuv19SUppIVFzDsNqLHHGoTG2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:10:03', '2024-07-25 08:10:03', 0, NULL, NULL),
(3090, 'RAFI FIRDAUS', 'rafi-firdaus_ioP7A', '2343_tech@fathforce.com', 'Student', NULL, '$2y$10$gli62EpjGNtPcRiMc3UBM.tfuefs6W6A4YaI0mkQGMPGMmac3I4o6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:10:04', '2024-07-25 08:10:04', 0, NULL, NULL),
(3091, 'RAINA ANZANI', 'raina-anzani_8geGe', '2344_tech@fathforce.com', 'Student', NULL, '$2y$10$fBGOwqpJiB0D7EpAcBwEf.oKAW.QGmgWyuhL3ncJpOZkT7U/dRpuK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:10:04', '2024-07-25 08:10:04', 0, NULL, NULL),
(3092, 'RESTU AQILA MAULANA', 'restu-aqila-maulana_aXS60', '2345_tech@fathforce.com', 'Student', NULL, '$2y$10$ipGNFlIj4i5skVj9mF1FGuXnBvzXh2YNADYgsPlU0Qd8Qp0ojY/bS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:10:04', '2024-07-25 08:10:04', 0, NULL, NULL),
(3093, 'RIPKA PEBRIANI', 'ripka-pebriani_XLYok', '2346_tech@fathforce.com', 'Student', NULL, '$2y$10$sqR0Zg2nIv.zT6ZJnoS.Xu9ok8/UhWKCBh2HulhsexOeLbOBlS0VO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:10:04', '2024-07-25 08:10:04', 0, NULL, NULL),
(3094, 'RIZKY AL AZHAR', 'rizky-al-azhar_9hO6t', '2347_tech@fathforce.com', 'Student', NULL, '$2y$10$PcloJ0XJcJeq/ISvGFUwA.ilySDoLJhM5zlGGsFWx7TNd1D3yyTH.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:10:04', '2024-07-25 08:10:04', 0, NULL, NULL),
(3095, 'SALMA LUTFIA MALIHA', 'salma-lutfia-maliha_cfRtD', '2348_tech@fathforce.com', 'Student', NULL, '$2y$10$CbrGLs2Zjo3HVjrkjQBLCuUe2Hbd4O0DF02ZKWfCkf.wYOU.qGiDO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:10:04', '2024-07-25 08:10:04', 0, NULL, NULL),
(3096, 'SILVIA RAHMAWATI', 'silvia-rahmawati_zRvsJ', '2349_tech@fathforce.com', 'Student', NULL, '$2y$10$vdj/ew84iHNb3U.6EERHN.nkPSzE.kETkdQIZrx.QO6OUX5OqTpAq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:10:04', '2024-07-25 08:10:04', 0, NULL, NULL),
(3097, 'SYAHRUL GUNAWAN', 'syahrul-gunawan_Y5nlO', '2350_tech@fathforce.com', 'Student', NULL, '$2y$10$RG1QAwMr63knX2hI94zJteQw12T.Dcs4OIPbwTbDPVBSybHg0yebe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:10:04', '2024-07-25 08:10:04', 0, NULL, NULL),
(3098, 'TIRANI SILA ANJANI', 'tirani-sila-anjani_aF4eL', '2351_tech@fathforce.com', 'Student', NULL, '$2y$10$qxPXVqVBoqOokAGzBHRFKOcWgEOxZkhG71x2OloO0KTZBHa0MPrrG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:10:04', '2024-07-25 08:10:04', 0, NULL, NULL),
(3099, 'WAFA SOHIBUL WAFA', 'wafa-sohibul-wafa_qcG8H', '2352_tech@fathforce.com', 'Student', NULL, '$2y$10$HZAy3VclrcsQq.eW2hq68ejMwilTcYaciDLNS84OUpL6WDVDJYhwW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:10:04', '2024-07-25 08:10:04', 0, NULL, NULL),
(3100, 'ZAYYAN ZAINUL MUTTAQIN', 'zayyan-zainul-muttaqin_YaXsv', '2353_tech@fathforce.com', 'Student', NULL, '$2y$10$JXDJcsMa0s3DQiihmzJ0ieTgxQMyC1.r4cHAmSPcq4Ez.U3QkCC2G', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:10:04', '2024-07-25 08:10:04', 0, NULL, NULL),
(3101, 'ZULFA TAZQIYATURRAMADANI', 'zulfa-tazqiyaturramadani_UVXuM', '2354_tech@fathforce.com', 'Student', NULL, '$2y$10$NYmOfKbL93d66qSPjO.NLeqU4IVR1C0QjkT7H8y/B.fgnh3T05oFW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:10:04', '2024-07-25 08:10:04', 0, NULL, NULL),
(3139, 'BUNGA APRILIA HESTININGRUM, S.Psi.', 'bunga-aprilia-hestiningrum-spsi_HhjFi', '1188_tech@gmail.com', 'Teacher', NULL, '$2y$10$e6lqoFGy6o8wG5gvFs94Qe2fOibE1prhvkMz6sB4k/mKZHi6dTVce', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '0543234567', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:12:12', '2024-07-25 08:12:12', 0, NULL, NULL),
(3140, 'ADE PARIZ MAULANA', 'ade-pariz-maulana_uC40I', '2355_tech@fathforce.com', 'Student', NULL, '$2y$10$nm.KjXRC9ZN4oTHJiAoNG.fT5SHlWhhLccYkKeHQo.0jvjqQeRcGq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:14:30', '2024-07-25 08:14:30', 0, NULL, NULL),
(3141, 'ADE VIRA RAHMANIA PUTRI', 'ade-vira-rahmania-putri_YGBWg', '2356_tech@fathforce.com', 'Student', NULL, '$2y$10$2sCLUW64YwWXMa5F4ZW15OkKzqDscuqI7nFHnxOl7fOQUdd4JxWK2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:14:30', '2024-07-25 08:14:30', 0, NULL, NULL),
(3142, 'ADITYA NURFAZRI', 'aditya-nurfazri_5EiyY', '2357_tech@fathforce.com', 'Student', NULL, '$2y$10$hgE7jEyljagDrDig12eYOe3nHUchdH14IQIVGKaFMak.//1y8BwWy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:14:30', '2024-07-25 08:14:30', 0, NULL, NULL),
(3143, 'ALDI', 'aldi_NgZnp', '2358_tech@fathforce.com', 'Student', NULL, '$2y$10$xxisuDXh6WZ4jOlo6lRgeOp6zMCdHujsODQr2NIrP0dkgIBxv1QfG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:14:30', '2024-07-25 08:14:30', 0, NULL, NULL),
(3144, 'ALI MUHLISIN', 'ali-muhlisin_CWuZh', '2359_tech@fathforce.com', 'Student', NULL, '$2y$10$gd.IYCsnRf72UkGsa3OVbObRnaDqUmLJDsksROEcXZWCxphShciPC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:14:30', '2024-07-25 08:14:30', 0, NULL, NULL),
(3145, 'ANDRIAN MAULANA RAMADHAN', 'andrian-maulana-ramadhan_Cpboy', '2360_tech@fathforce.com', 'Student', NULL, '$2y$10$TWW4bzp7SMs0UIulco9THOfy6wduV5EHITGjMsfcGQIxRa7y7Oi0y', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:14:30', '2024-07-25 08:14:30', 0, NULL, NULL),
(3146, 'ARINI NURHAKIMAH', 'arini-nurhakimah_c8MJA', '2361_tech@fathforce.com', 'Student', NULL, '$2y$10$xXt/I9jR51HVa3apX2.xTOnZaVT7mLrSShbMMRuUiTFmIc7lr9Rt.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:14:30', '2024-07-25 08:14:30', 0, NULL, NULL),
(3147, 'AYI MUHAMMAD RAMDHAN', 'ayi-muhammad-ramdhan_3hqmz', '2362_tech@fathforce.com', 'Student', NULL, '$2y$10$RMMv5u.Q5QzIFitjmYAuquKnvsPzrbBNuj8YuqF/t3G.pFLTUSE6S', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:14:30', '2024-07-25 08:14:30', 0, NULL, NULL),
(3148, 'AYU ROHIMATUL AULIA', 'ayu-rohimatul-aulia_aGGdN', '2363_tech@fathforce.com', 'Student', NULL, '$2y$10$39tehz4fRCZsAGq5UUqlSeAlwnBKCPRawB5.3ZjFL913OBZHvVGAS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:14:30', '2024-07-25 08:14:30', 0, NULL, NULL),
(3149, 'DAFA ZULFA ARIFIN', 'dafa-zulfa-arifin_LTb0a', '2364_tech@fathforce.com', 'Student', NULL, '$2y$10$8Xqy9qICfVEuENrBoigKtusnCg1tScYe5qrfN32hmg3A627/pD27a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:14:30', '2024-07-25 08:14:30', 0, NULL, NULL),
(3150, 'DIMAS NURDIANSAH', 'dimas-nurdiansah_8trWM', '2365_tech@fathforce.com', 'Student', NULL, '$2y$10$DOhgUWMAQpQ/B0c9DSXYvuYzbx2iAEjGq149uET3dS9di4YK54UcS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:14:30', '2024-07-25 08:14:30', 0, NULL, NULL),
(3151, 'DIRA MUHAMMAD RAMDHANI', 'dira-muhammad-ramdhani_9u3NR', '2366_tech@fathforce.com', 'Student', NULL, '$2y$10$e0.qKNUe8WS741BW0h8pguMO.0vpBjuMuoeF9R3xfoAXmYI69/Xee', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:14:30', '2024-07-25 08:14:30', 0, NULL, NULL),
(3152, 'EFUL SAEFUL JAMIL', 'eful-saeful-jamil_Eg817', '2367_tech@fathforce.com', 'Student', NULL, '$2y$10$.t6y8REXNR3Zjf8XFjQfE.6tQJysHNrPbS4lYlmQtqrXgjP.tag/i', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:14:30', '2024-07-25 08:14:30', 0, NULL, NULL),
(3153, 'EPAN PERMANA', 'epan-permana_cuO2C', '2368_tech@fathforce.com', 'Student', NULL, '$2y$10$soTS6ath5vqg3YE6lHPlW.r.nCPuBGpMXkcJOMnmq519rxtU3mAWC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:14:30', '2024-07-25 08:14:30', 0, NULL, NULL),
(3154, 'FAJAR FIRMANZAH', 'fajar-firmanzah_4LvgC', '2369_tech@fathforce.com', 'Student', NULL, '$2y$10$Y6sjSbjyLJ0hTtzkf5NlduFySZBsulov.HM.64BVCDcGPUCQVV//K', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:14:31', '2024-07-25 08:14:31', 0, NULL, NULL),
(3155, 'FIKRI PATUROHMAN', 'fikri-paturohman_Y0PvG', '2370_tech@fathforce.com', 'Student', NULL, '$2y$10$lSQIR98xEI3ZObOjAcA4gu0AF0MMtzDTY8oEoqMahVF1QAPSMBQqq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:14:31', '2024-07-25 08:14:31', 0, NULL, NULL),
(3156, 'GHANI RUSYDA', 'ghani-rusyda_qU2Ld', '2371_tech@fathforce.com', 'Student', NULL, '$2y$10$YhViTu8aaNuP8H5eg6XfaemBWXbaVLO6xcPkn7z1rkqgIgpmzzKoW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:14:31', '2024-07-25 08:14:31', 0, NULL, NULL),
(3157, 'GILAR TRESNA PAMUNGKAS', 'gilar-tresna-pamungkas_4hBXS', '2372_tech@fathforce.com', 'Student', NULL, '$2y$10$5PmuzzEvgULf3T8N2mQWyOqXPDY7Pig/QF3J79XDa/jEhP.J09tv6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:14:31', '2024-07-25 08:14:31', 0, NULL, NULL),
(3158, 'HAMDAN FAUZAN', 'hamdan-fauzan_AV3nI', '2373_tech@fathforce.com', 'Student', NULL, '$2y$10$wrc4KPE1rLV9zL/CDqGcOe2cLvX/o2aOzzO8qOIKTijsf2cRqM0ee', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:14:31', '2024-07-25 08:14:31', 0, NULL, NULL),
(3159, 'LISNAWATI', 'lisnawati_kgC8w', '2374_tech@fathforce.com', 'Student', NULL, '$2y$10$t5qA9OrOqB8xq9AQg77fSO8dfoU6x3gMfH4gA/mcP/Okl2eLXCf6q', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:14:31', '2024-07-25 08:14:31', 0, NULL, NULL),
(3160, 'M RAGIL GUNAWAN', 'm-ragil-gunawan_GOeQy', '2375_tech@fathforce.com', 'Student', NULL, '$2y$10$ay7Ed1rVnFuxlk9FyywgIuD.MD.ObJNYJwr8XhL0j0lQToe3krysG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:14:31', '2024-07-25 08:14:31', 0, NULL, NULL),
(3161, 'MUHAMMAD AZKA NUGRAHA', 'muhammad-azka-nugraha_XnTok', '2376_tech@fathforce.com', 'Student', NULL, '$2y$10$rhI44B5kwnqLN8rjRJb2IuqTcMjY4B5AsOi53.rGl.Piwza6g1IIe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:14:31', '2024-07-25 08:14:31', 0, NULL, NULL),
(3162, 'NABIL RAHMAN AL ISLAMI', 'nabil-rahman-al-islami_EDbB7', '2377_tech@fathforce.com', 'Student', NULL, '$2y$10$YrA/pWB15Rfxd2IvKjdVxuKur1YksX2e5pu.crOmM.kyGh26B9Nbe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:14:31', '2024-07-25 08:14:31', 0, NULL, NULL),
(3163, 'NADIA HUSNA AL KHOERIAH', 'nadia-husna-al-khoeriah_c2LSB', '2378_tech@fathforce.com', 'Student', NULL, '$2y$10$6vNj0HQiaMKEUHEV8PI9..0H4F482mvnbuICAqKpH2GJaFgEsmyg6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:14:31', '2024-07-25 08:14:31', 0, NULL, NULL),
(3164, 'NAWFAL HANIF NASUTION', 'nawfal-hanif-nasution_1D320', '2379_tech@fathforce.com', 'Student', NULL, '$2y$10$6nJl0uRc1UW3gsWsCS3qFuHTTSxnrmz/0fnQq4YIvDr57nvfPxJyO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:14:31', '2024-07-25 08:14:31', 0, NULL, NULL),
(3165, 'NINDI', 'nindi_1b6qw', '2380_tech@fathforce.com', 'Student', NULL, '$2y$10$26yJbcYyeB85YgbWPYRJ/OSMHd4SVZDlPc/YndkEScloarBDMbYeW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:14:31', '2024-07-25 08:14:31', 0, NULL, NULL),
(3166, 'PAHRI RAMA RUSTADI', 'pahri-rama-rustadi_goYm3', '2381_tech@fathforce.com', 'Student', NULL, '$2y$10$i/AORji8daogszMI0difx.Ci.Y3ohuk6gZUwrD2Xv/YPBYmAv3ZWS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:14:32', '2024-07-25 08:14:32', 0, NULL, NULL),
(3167, 'PAUJAN SHRUN NAJMUDIN', 'paujan-shrun-najmudin_0dIvL', '2382_tech@fathforce.com', 'Student', NULL, '$2y$10$tLLPLWvt/6YuNE/bKUbqoe1fWSstKsjMCPQTdJsIcGQJTrSheZ11y', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:14:32', '2024-07-25 08:14:32', 0, NULL, NULL),
(3168, 'PUTRI LUTVIANI', 'putri-lutviani_VCbH4', '2383_tech@fathforce.com', 'Student', NULL, '$2y$10$ijnGAHcrsWpBVPv2Ke0gx.uFW2ZV6fTLffDIY6GPvIg3/AbMaw/Zm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:14:32', '2024-07-25 08:14:32', 0, NULL, NULL),
(3169, 'RAFI MULYAWAN', 'rafi-mulyawan_N7CjK', '2384_tech@fathforce.com', 'Student', NULL, '$2y$10$vVbCSVnfLLcquQlx.O/9rO3/pQBgykrp.vuBFMd5rlVuLur0MaM9G', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:14:32', '2024-07-25 08:14:32', 0, NULL, NULL),
(3170, 'RIRIN SRI WIDIAWATI', 'ririn-sri-widiawati_a6TJj', '2385_tech@fathforce.com', 'Student', NULL, '$2y$10$9mqwWgJrTaph1EGJfcRroeKKSed.kVz3kXQ/eJ0eVWgvclHgWj6zy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:14:32', '2024-07-25 08:14:32', 0, NULL, NULL),
(3171, 'RISKA PUTRI YULIANTI', 'riska-putri-yulianti_jhPQj', '2386_tech@fathforce.com', 'Student', NULL, '$2y$10$NhgLj6q5hRo.rtUf4RMuB.QZGFEOcT3y2auL9SX7QBMtGFmH.yhiK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:14:32', '2024-07-25 08:14:32', 0, NULL, NULL),
(3172, 'TIARA WULANDARI', 'tiara-wulandari_Bcj2e', '2387_tech@fathforce.com', 'Student', NULL, '$2y$10$7GJmo7zZsPm1iUcm.2YKJO2Q3ZPDBhQyo7SnGKI/9m2t5GTCDPT3m', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:14:32', '2024-07-25 08:14:32', 0, NULL, NULL),
(3173, 'WINDY AGUSTINA HERMAWAN', 'windy-agustina-hermawan_QuADK', '2388_tech@fathforce.com', 'Student', NULL, '$2y$10$5SoNMSQ0Hj9skQbadslrkeyIjkNsnJiTuE4bnytTBTTVM909fTMp6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:14:32', '2024-07-25 08:14:32', 0, NULL, NULL),
(3174, 'ZAKIA SUKANAH', 'zakia-sukanah_WUIfL', '2389_tech@fathforce.com', 'Student', NULL, '$2y$10$q/FPTX9.KVTQ877dkN0Pj.MIQeJGFLFvMuvq4wAI/J8aHXJgBOyhK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:14:32', '2024-07-25 08:14:32', 0, NULL, NULL),
(3175, 'ZIZA HAMZAH', 'ziza-hamzah_o60AQ', '2390_tech@fathforce.com', 'Student', NULL, '$2y$10$M6YoL3rWV8yJFnL6zqJr0e/q8/QQ3.H26trk2AC3kNNCg7yw6ryuO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2082394893248', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:14:32', '2024-07-25 08:14:32', 0, NULL, NULL),
(3176, 'MUHAMAD GOJALI, S.Pd.', 'muhamad-gojali-spd_iA5QW', '1189_tech@gmail.com', 'Teacher', NULL, '$2y$10$/Xr1AEHzxAGd9KABXi8IC.47v14sInJKgojOL2U034Nwj8ae9FFfC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '098765', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:17:02', '2024-07-25 08:17:02', 0, NULL, NULL),
(3177, 'GISSA FIRDA HASBIA, S.Pd.', 'gissa-firda-hasbia-spd_lgZUh', '1190_tech@gmail.com', 'Teacher', NULL, '$2y$10$F0foTPZnWI0iqflQbVRuz.SCha9MQT4wj2fTDKi/hO8q9.Xbw1fOy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '087654', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:19:50', '2024-07-25 08:19:50', 0, NULL, NULL),
(3178, 'NOVI SARIFAH, S.Pd.I.', 'novi-sarifah-spdi_V96ia', '1191_tech@gmail.com', 'Teacher', NULL, '$2y$10$8SnAvJSLr2u6XxAPxFJrZOdVfrTdzFVQH1gcFWWK6e7WIZa0xwzcy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '0234567', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:23:31', '2024-07-25 08:23:31', 0, NULL, NULL),
(3179, 'YANTI APRILIANI, S.Pd', 'yanti-apriliani-spd_5vFdC', '1192_tech@gmail.com', 'Teacher', NULL, '$2y$10$7WWCvvnR/fOrWv/dVwlPp.lX1J0mDRDXBV/sqZq/6OBqYe5.dBAH6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '07234', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:27:02', '2024-07-25 08:32:46', 0, NULL, NULL),
(3180, 'RIKA MUSTIKA, S.Pd.', 'rika-mustika-spd_f0bh1', '1193_tech@gmail.com', 'Teacher', NULL, '$2y$10$M0mzPxazvNXzmDkOqPj7a.LBpp6DeONGVSYqAt7KMXhoSrlEO13Ti', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '06234', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:30:24', '2024-07-25 08:30:24', 0, NULL, NULL),
(3181, 'SUCI RAMDANIA, S.Pd.', 'suci-ramdania-spd_m93CJ', '1194_tech@gmail.com', 'Teacher', NULL, '$2y$10$jVZVlOP//DkiV27epMG5W.Xn1ywUVNDXwh0hWdmHhq581zoRTpsi6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '07234565', NULL, NULL, NULL, NULL, 0, '2024-07-25 08:35:05', '2024-07-25 08:35:05', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_courses`
--

CREATE TABLE `user_courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `is_passed` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_courses`
--

INSERT INTO `user_courses` (`id`, `user_id`, `course_id`, `is_passed`, `created_at`, `updated_at`) VALUES
(1256, 1452, 48, 0, '2024-07-25 04:19:28', '2024-07-25 04:19:28'),
(1257, 1453, 48, 0, '2024-07-25 04:19:28', '2024-07-25 04:19:28'),
(1258, 1454, 48, 0, '2024-07-25 04:19:28', '2024-07-25 04:19:28'),
(1259, 1455, 48, 0, '2024-07-25 04:19:28', '2024-07-25 04:19:28'),
(1260, 1456, 48, 0, '2024-07-25 04:19:28', '2024-07-25 04:19:28'),
(1261, 1457, 48, 0, '2024-07-25 04:19:28', '2024-07-25 04:19:28'),
(1262, 1458, 48, 0, '2024-07-25 04:19:28', '2024-07-25 04:19:28'),
(1263, 1459, 48, 0, '2024-07-25 04:19:28', '2024-07-25 04:19:28'),
(1264, 1460, 48, 0, '2024-07-25 04:19:28', '2024-07-25 04:19:28'),
(1265, 1461, 48, 0, '2024-07-25 04:19:28', '2024-07-25 04:19:28'),
(1266, 1462, 48, 0, '2024-07-25 04:19:28', '2024-07-25 04:19:28'),
(1267, 1463, 48, 0, '2024-07-25 04:19:29', '2024-07-25 04:19:29'),
(1268, 1464, 48, 0, '2024-07-25 04:19:29', '2024-07-25 04:19:29'),
(1269, 1465, 48, 0, '2024-07-25 04:19:29', '2024-07-25 04:19:29'),
(1270, 1466, 48, 0, '2024-07-25 04:19:29', '2024-07-25 04:19:29'),
(1271, 1467, 48, 0, '2024-07-25 04:19:29', '2024-07-25 04:19:29'),
(1272, 1468, 48, 0, '2024-07-25 04:19:29', '2024-07-25 04:19:29'),
(1273, 1469, 48, 0, '2024-07-25 04:19:29', '2024-07-25 04:19:29'),
(1274, 1470, 48, 0, '2024-07-25 04:19:29', '2024-07-25 04:19:29'),
(1275, 1471, 48, 0, '2024-07-25 04:19:29', '2024-07-25 04:19:29'),
(1276, 1472, 48, 0, '2024-07-25 04:19:29', '2024-07-25 04:19:29'),
(1277, 1473, 48, 0, '2024-07-25 04:19:29', '2024-07-25 04:19:29'),
(1278, 1474, 48, 0, '2024-07-25 04:19:29', '2024-07-25 04:19:29'),
(1279, 1475, 48, 0, '2024-07-25 04:19:29', '2024-07-25 04:19:29'),
(1280, 1476, 48, 0, '2024-07-25 04:19:29', '2024-07-25 04:19:29'),
(1281, 1477, 48, 0, '2024-07-25 04:19:29', '2024-07-25 04:19:29'),
(1282, 1478, 48, 0, '2024-07-25 04:19:30', '2024-07-25 04:19:30'),
(1283, 1479, 48, 0, '2024-07-25 04:19:30', '2024-07-25 04:19:30'),
(1284, 1480, 48, 0, '2024-07-25 04:19:30', '2024-07-25 04:19:30'),
(1285, 1481, 48, 0, '2024-07-25 04:19:30', '2024-07-25 04:19:30'),
(1286, 1482, 48, 0, '2024-07-25 04:19:30', '2024-07-25 04:19:30'),
(1287, 1483, 48, 0, '2024-07-25 04:19:30', '2024-07-25 04:19:30'),
(1288, 1484, 61, 0, '2024-07-25 04:19:30', '2024-07-25 04:19:30'),
(1513, 1718, 47, 0, '2024-07-25 04:44:39', '2024-07-25 04:44:39'),
(1514, 1719, 47, 0, '2024-07-25 04:44:39', '2024-07-25 04:44:39'),
(1515, 1720, 47, 0, '2024-07-25 04:44:39', '2024-07-25 04:44:39'),
(1516, 1721, 47, 0, '2024-07-25 04:44:39', '2024-07-25 04:44:39'),
(1517, 1722, 47, 0, '2024-07-25 04:44:39', '2024-07-25 04:44:39'),
(1518, 1723, 47, 0, '2024-07-25 04:44:39', '2024-07-25 04:44:39'),
(1519, 1724, 47, 0, '2024-07-25 04:44:39', '2024-07-25 04:44:39'),
(1520, 1725, 47, 0, '2024-07-25 04:44:39', '2024-07-25 04:44:39'),
(1521, 1726, 47, 0, '2024-07-25 04:44:39', '2024-07-25 04:44:39'),
(1522, 1727, 47, 0, '2024-07-25 04:44:39', '2024-07-25 04:44:39'),
(1523, 1728, 47, 0, '2024-07-25 04:44:40', '2024-07-25 04:44:40'),
(1524, 1729, 47, 0, '2024-07-25 04:44:40', '2024-07-25 04:44:40'),
(1525, 1730, 47, 0, '2024-07-25 04:44:40', '2024-07-25 04:44:40'),
(1526, 1731, 47, 0, '2024-07-25 04:44:40', '2024-07-25 04:44:40'),
(1527, 1732, 47, 0, '2024-07-25 04:44:40', '2024-07-25 04:44:40'),
(1528, 1733, 47, 0, '2024-07-25 04:44:40', '2024-07-25 04:44:40'),
(1529, 1734, 47, 0, '2024-07-25 04:44:40', '2024-07-25 04:44:40'),
(1530, 1735, 47, 0, '2024-07-25 04:44:40', '2024-07-25 04:44:40'),
(1531, 1736, 47, 0, '2024-07-25 04:44:40', '2024-07-25 04:44:40'),
(1532, 1737, 47, 0, '2024-07-25 04:44:40', '2024-07-25 04:44:40'),
(1533, 1738, 47, 0, '2024-07-25 04:44:40', '2024-07-25 04:44:40'),
(1534, 1739, 47, 0, '2024-07-25 04:44:40', '2024-07-25 04:44:40'),
(1535, 1740, 47, 0, '2024-07-25 04:44:40', '2024-07-25 04:44:40'),
(1536, 1741, 47, 0, '2024-07-25 04:44:40', '2024-07-25 04:44:40'),
(1537, 1742, 47, 0, '2024-07-25 04:44:41', '2024-07-25 04:44:41'),
(1538, 1743, 47, 0, '2024-07-25 04:44:41', '2024-07-25 04:44:41'),
(1539, 1744, 47, 0, '2024-07-25 04:44:41', '2024-07-25 04:44:41'),
(1540, 1745, 47, 0, '2024-07-25 04:44:41', '2024-07-25 04:44:41'),
(1541, 1746, 47, 0, '2024-07-25 04:44:41', '2024-07-25 04:44:41'),
(1542, 1747, 47, 0, '2024-07-25 04:44:41', '2024-07-25 04:44:41'),
(1543, 1748, 47, 0, '2024-07-25 04:44:41', '2024-07-25 04:44:41'),
(1544, 1749, 47, 0, '2024-07-25 04:44:41', '2024-07-25 04:44:41'),
(1545, 1750, 47, 0, '2024-07-25 04:44:41', '2024-07-25 04:44:41'),
(1546, 1751, 47, 0, '2024-07-25 04:44:41', '2024-07-25 04:44:41'),
(1547, 1752, 47, 0, '2024-07-25 04:44:41', '2024-07-25 04:44:41'),
(1548, 1753, 47, 0, '2024-07-25 04:44:41', '2024-07-25 04:44:41'),
(1726, 1945, 45, 0, '2024-07-25 06:33:54', '2024-07-25 06:33:54'),
(1727, 1946, 45, 0, '2024-07-25 06:33:54', '2024-07-25 06:33:54'),
(1728, 1947, 45, 0, '2024-07-25 06:33:54', '2024-07-25 06:33:54'),
(1729, 1948, 45, 0, '2024-07-25 06:33:54', '2024-07-25 06:33:54'),
(1730, 1949, 45, 0, '2024-07-25 06:33:54', '2024-07-25 06:33:54'),
(1731, 1950, 45, 0, '2024-07-25 06:33:54', '2024-07-25 06:33:54'),
(1732, 1951, 45, 0, '2024-07-25 06:33:54', '2024-07-25 06:33:54'),
(1733, 1952, 45, 0, '2024-07-25 06:33:54', '2024-07-25 06:33:54'),
(1734, 1953, 45, 0, '2024-07-25 06:33:54', '2024-07-25 06:33:54'),
(1735, 1954, 45, 0, '2024-07-25 06:33:55', '2024-07-25 06:33:55'),
(1736, 1955, 45, 0, '2024-07-25 06:33:55', '2024-07-25 06:33:55'),
(1737, 1956, 45, 0, '2024-07-25 06:33:55', '2024-07-25 06:33:55'),
(1738, 1957, 45, 0, '2024-07-25 06:33:55', '2024-07-25 06:33:55'),
(1739, 1958, 45, 0, '2024-07-25 06:33:55', '2024-07-25 06:33:55'),
(1740, 1959, 45, 0, '2024-07-25 06:33:55', '2024-07-25 06:33:55'),
(1741, 1960, 45, 0, '2024-07-25 06:33:55', '2024-07-25 06:33:55'),
(1742, 1961, 45, 0, '2024-07-25 06:33:55', '2024-07-25 06:33:55'),
(1743, 1962, 45, 0, '2024-07-25 06:33:55', '2024-07-25 06:33:55'),
(1744, 1963, 45, 0, '2024-07-25 06:33:55', '2024-07-25 06:33:55'),
(1745, 1964, 45, 0, '2024-07-25 06:33:55', '2024-07-25 06:33:55'),
(1746, 1965, 45, 0, '2024-07-25 06:33:55', '2024-07-25 06:33:55'),
(1747, 1966, 45, 0, '2024-07-25 06:33:55', '2024-07-25 06:33:55'),
(1748, 1967, 45, 0, '2024-07-25 06:33:56', '2024-07-25 06:33:56'),
(1749, 1968, 45, 0, '2024-07-25 06:33:56', '2024-07-25 06:33:56'),
(1750, 1969, 45, 0, '2024-07-25 06:33:56', '2024-07-25 06:33:56'),
(1751, 1970, 45, 0, '2024-07-25 06:33:56', '2024-07-25 06:33:56'),
(1752, 1971, 45, 0, '2024-07-25 06:33:56', '2024-07-25 06:33:56'),
(1753, 1972, 45, 0, '2024-07-25 06:33:56', '2024-07-25 06:33:56'),
(1754, 1973, 45, 0, '2024-07-25 06:33:56', '2024-07-25 06:33:56'),
(1755, 1974, 45, 0, '2024-07-25 06:33:56', '2024-07-25 06:33:56'),
(1756, 1975, 45, 0, '2024-07-25 06:33:56', '2024-07-25 06:33:56'),
(1757, 1976, 45, 0, '2024-07-25 06:33:56', '2024-07-25 06:33:56'),
(1758, 1977, 45, 0, '2024-07-25 06:33:56', '2024-07-25 06:33:56'),
(1759, 1978, 45, 0, '2024-07-25 06:33:56', '2024-07-25 06:33:56'),
(1760, 1979, 45, 0, '2024-07-25 06:33:57', '2024-07-25 06:33:57'),
(1761, 1980, 45, 0, '2024-07-25 06:33:57', '2024-07-25 06:33:57'),
(2050, 2278, 34, 0, '2024-07-25 06:38:20', '2024-07-25 06:38:20'),
(2051, 2279, 64, 0, '2024-07-25 06:38:20', '2024-07-25 06:38:20'),
(2052, 2280, 52, 0, '2024-07-25 06:38:20', '2024-07-25 06:38:20'),
(2053, 2281, 41, 0, '2024-07-25 06:38:20', '2024-07-25 06:38:20'),
(2054, 2282, 65, 0, '2024-07-25 06:38:21', '2024-07-25 06:38:21'),
(2055, 2283, 42, 0, '2024-07-25 06:38:21', '2024-07-25 06:38:21'),
(2056, 2284, 38, 0, '2024-07-25 06:38:21', '2024-07-25 06:38:21'),
(2057, 2285, 40, 0, '2024-07-25 06:38:21', '2024-07-25 06:38:21'),
(2058, 2286, 52, 0, '2024-07-25 06:38:21', '2024-07-25 06:38:21'),
(2059, 2287, 57, 0, '2024-07-25 06:38:21', '2024-07-25 06:38:21'),
(2060, 2288, 33, 0, '2024-07-25 06:38:21', '2024-07-25 06:38:21'),
(2061, 2289, 57, 0, '2024-07-25 06:38:21', '2024-07-25 06:38:21'),
(2062, 2290, 35, 0, '2024-07-25 06:38:21', '2024-07-25 06:38:21'),
(2063, 2291, 39, 0, '2024-07-25 06:38:21', '2024-07-25 06:38:21'),
(2064, 2292, 64, 0, '2024-07-25 06:38:21', '2024-07-25 06:38:21'),
(2065, 2293, 40, 0, '2024-07-25 06:38:21', '2024-07-25 06:38:21'),
(2066, 2294, 54, 0, '2024-07-25 06:38:21', '2024-07-25 06:38:21'),
(2067, 2295, 57, 0, '2024-07-25 06:38:21', '2024-07-25 06:38:21'),
(2068, 2296, 63, 0, '2024-07-25 06:38:21', '2024-07-25 06:38:21'),
(2069, 2297, 36, 0, '2024-07-25 06:38:22', '2024-07-25 06:38:22'),
(2070, 2298, 33, 0, '2024-07-25 06:38:22', '2024-07-25 06:38:22'),
(2071, 2299, 44, 0, '2024-07-25 06:38:22', '2024-07-25 06:38:22'),
(2072, 2300, 45, 0, '2024-07-25 06:38:22', '2024-07-25 06:38:22'),
(2073, 2301, 44, 0, '2024-07-25 06:38:22', '2024-07-25 06:38:22'),
(2074, 2302, 45, 0, '2024-07-25 06:38:22', '2024-07-25 06:38:22'),
(2075, 2303, 40, 0, '2024-07-25 06:38:22', '2024-07-25 06:38:22'),
(2076, 2304, 48, 0, '2024-07-25 06:38:22', '2024-07-25 06:38:22'),
(2077, 2305, 54, 0, '2024-07-25 06:38:22', '2024-07-25 06:38:22'),
(2078, 2306, 47, 0, '2024-07-25 06:38:22', '2024-07-25 06:38:22'),
(2079, 2307, 33, 0, '2024-07-25 06:38:22', '2024-07-25 06:38:22'),
(2080, 2308, 65, 0, '2024-07-25 06:38:22', '2024-07-25 06:38:22'),
(2081, 2309, 33, 0, '2024-07-25 06:38:22', '2024-07-25 06:38:22'),
(2082, 2310, 33, 0, '2024-07-25 06:38:22', '2024-07-25 06:38:22'),
(2083, 2311, 35, 0, '2024-07-25 06:38:23', '2024-07-25 06:38:23'),
(2084, 2312, 50, 0, '2024-07-25 06:38:23', '2024-07-25 06:38:23'),
(2085, 2313, 41, 0, '2024-07-25 06:38:23', '2024-07-25 06:38:23'),
(2086, 2315, 38, 0, '2024-07-25 06:40:28', '2024-07-25 06:40:28'),
(2087, 2316, 38, 0, '2024-07-25 06:40:28', '2024-07-25 06:40:28'),
(2088, 2317, 38, 0, '2024-07-25 06:40:28', '2024-07-25 06:40:28'),
(2089, 2318, 38, 0, '2024-07-25 06:40:28', '2024-07-25 06:40:28'),
(2090, 2319, 38, 0, '2024-07-25 06:40:28', '2024-07-25 06:40:28'),
(2091, 2320, 38, 0, '2024-07-25 06:40:29', '2024-07-25 06:40:29'),
(2092, 2321, 38, 0, '2024-07-25 06:40:29', '2024-07-25 06:40:29'),
(2093, 2322, 38, 0, '2024-07-25 06:40:29', '2024-07-25 06:40:29'),
(2094, 2323, 38, 0, '2024-07-25 06:40:29', '2024-07-25 06:40:29'),
(2095, 2324, 38, 0, '2024-07-25 06:40:29', '2024-07-25 06:40:29'),
(2096, 2325, 38, 0, '2024-07-25 06:40:29', '2024-07-25 06:40:29'),
(2097, 2326, 38, 0, '2024-07-25 06:40:29', '2024-07-25 06:40:29'),
(2098, 2327, 38, 0, '2024-07-25 06:40:29', '2024-07-25 06:40:29'),
(2099, 2328, 38, 0, '2024-07-25 06:40:29', '2024-07-25 06:40:29'),
(2100, 2329, 38, 0, '2024-07-25 06:40:29', '2024-07-25 06:40:29'),
(2101, 2330, 38, 0, '2024-07-25 06:40:29', '2024-07-25 06:40:29'),
(2102, 2331, 38, 0, '2024-07-25 06:40:29', '2024-07-25 06:40:29'),
(2103, 2332, 38, 0, '2024-07-25 06:40:29', '2024-07-25 06:40:29'),
(2104, 2333, 61, 0, '2024-07-25 06:40:29', '2024-07-25 06:40:29'),
(2105, 2334, 38, 0, '2024-07-25 06:40:30', '2024-07-25 06:40:30'),
(2106, 2335, 38, 0, '2024-07-25 06:40:30', '2024-07-25 06:40:30'),
(2107, 2336, 38, 0, '2024-07-25 06:40:30', '2024-07-25 06:40:30'),
(2108, 2337, 38, 0, '2024-07-25 06:40:30', '2024-07-25 06:40:30'),
(2109, 2338, 38, 0, '2024-07-25 06:40:30', '2024-07-25 06:40:30'),
(2110, 2339, 38, 0, '2024-07-25 06:40:30', '2024-07-25 06:40:30'),
(2111, 2340, 38, 0, '2024-07-25 06:40:30', '2024-07-25 06:40:30'),
(2112, 2341, 38, 0, '2024-07-25 06:40:30', '2024-07-25 06:40:30'),
(2113, 2342, 38, 0, '2024-07-25 06:40:30', '2024-07-25 06:40:30'),
(2114, 2343, 38, 0, '2024-07-25 06:40:30', '2024-07-25 06:40:30'),
(2115, 2344, 38, 0, '2024-07-25 06:40:30', '2024-07-25 06:40:30'),
(2116, 2345, 38, 0, '2024-07-25 06:40:30', '2024-07-25 06:40:30'),
(2117, 2346, 38, 0, '2024-07-25 06:40:30', '2024-07-25 06:40:30'),
(2118, 2347, 38, 0, '2024-07-25 06:40:30', '2024-07-25 06:40:30'),
(2119, 2348, 38, 0, '2024-07-25 06:40:31', '2024-07-25 06:40:31'),
(2120, 2349, 38, 0, '2024-07-25 06:40:31', '2024-07-25 06:40:31'),
(2121, 2350, 38, 0, '2024-07-25 06:40:31', '2024-07-25 06:40:31'),
(2122, 2351, 37, 0, '2024-07-25 06:41:09', '2024-07-25 06:41:09'),
(2123, 2352, 37, 0, '2024-07-25 06:41:09', '2024-07-25 06:41:09'),
(2124, 2353, 37, 0, '2024-07-25 06:41:09', '2024-07-25 06:41:09'),
(2125, 2354, 37, 0, '2024-07-25 06:41:09', '2024-07-25 06:41:09'),
(2126, 2355, 37, 0, '2024-07-25 06:41:09', '2024-07-25 06:41:09'),
(2127, 2356, 37, 0, '2024-07-25 06:41:09', '2024-07-25 06:41:09'),
(2128, 2357, 37, 0, '2024-07-25 06:41:09', '2024-07-25 06:41:09'),
(2129, 2358, 37, 0, '2024-07-25 06:41:09', '2024-07-25 06:41:09'),
(2130, 2359, 37, 0, '2024-07-25 06:41:09', '2024-07-25 06:41:09'),
(2131, 2360, 37, 0, '2024-07-25 06:41:09', '2024-07-25 06:41:09'),
(2132, 2361, 37, 0, '2024-07-25 06:41:09', '2024-07-25 06:41:09'),
(2133, 2362, 37, 0, '2024-07-25 06:41:09', '2024-07-25 06:41:09'),
(2134, 2363, 37, 0, '2024-07-25 06:41:09', '2024-07-25 06:41:09'),
(2135, 2364, 37, 0, '2024-07-25 06:41:10', '2024-07-25 06:41:10'),
(2136, 2365, 37, 0, '2024-07-25 06:41:10', '2024-07-25 06:41:10'),
(2137, 2366, 37, 0, '2024-07-25 06:41:10', '2024-07-25 06:41:10'),
(2138, 2367, 37, 0, '2024-07-25 06:41:10', '2024-07-25 06:41:10'),
(2139, 2368, 37, 0, '2024-07-25 06:41:10', '2024-07-25 06:41:10'),
(2140, 2369, 37, 0, '2024-07-25 06:41:10', '2024-07-25 06:41:10'),
(2141, 2370, 37, 0, '2024-07-25 06:41:10', '2024-07-25 06:41:10'),
(2142, 2371, 37, 0, '2024-07-25 06:41:10', '2024-07-25 06:41:10'),
(2143, 2372, 37, 0, '2024-07-25 06:41:10', '2024-07-25 06:41:10'),
(2144, 2373, 37, 0, '2024-07-25 06:41:10', '2024-07-25 06:41:10'),
(2145, 2374, 37, 0, '2024-07-25 06:41:10', '2024-07-25 06:41:10'),
(2146, 2375, 37, 0, '2024-07-25 06:41:10', '2024-07-25 06:41:10'),
(2147, 2376, 37, 0, '2024-07-25 06:41:10', '2024-07-25 06:41:10'),
(2148, 2377, 37, 0, '2024-07-25 06:41:10', '2024-07-25 06:41:10'),
(2149, 2378, 37, 0, '2024-07-25 06:41:10', '2024-07-25 06:41:10'),
(2150, 2379, 37, 0, '2024-07-25 06:41:11', '2024-07-25 06:41:11'),
(2151, 2380, 37, 0, '2024-07-25 06:41:11', '2024-07-25 06:41:11'),
(2152, 2381, 37, 0, '2024-07-25 06:41:11', '2024-07-25 06:41:11'),
(2153, 2382, 37, 0, '2024-07-25 06:41:11', '2024-07-25 06:41:11'),
(2154, 2383, 37, 0, '2024-07-25 06:41:11', '2024-07-25 06:41:11'),
(2155, 2384, 37, 0, '2024-07-25 06:41:11', '2024-07-25 06:41:11'),
(2156, 2385, 37, 0, '2024-07-25 06:41:11', '2024-07-25 06:41:11'),
(2157, 2386, 37, 0, '2024-07-25 06:41:11', '2024-07-25 06:41:11'),
(2158, 2388, 36, 0, '2024-07-25 06:41:21', '2024-07-25 06:41:21'),
(2159, 2389, 36, 0, '2024-07-25 06:41:21', '2024-07-25 06:41:21'),
(2160, 2390, 36, 0, '2024-07-25 06:41:21', '2024-07-25 06:41:21'),
(2161, 2391, 36, 0, '2024-07-25 06:41:21', '2024-07-25 06:41:21'),
(2162, 2392, 36, 0, '2024-07-25 06:41:22', '2024-07-25 06:41:22'),
(2163, 2393, 36, 0, '2024-07-25 06:41:22', '2024-07-25 06:41:22'),
(2164, 2394, 36, 0, '2024-07-25 06:41:22', '2024-07-25 06:41:22'),
(2165, 2395, 36, 0, '2024-07-25 06:41:22', '2024-07-25 06:41:22'),
(2166, 2396, 36, 0, '2024-07-25 06:41:22', '2024-07-25 06:41:22'),
(2167, 2397, 36, 0, '2024-07-25 06:41:22', '2024-07-25 06:41:22'),
(2168, 2398, 36, 0, '2024-07-25 06:41:22', '2024-07-25 06:41:22'),
(2169, 2399, 36, 0, '2024-07-25 06:41:22', '2024-07-25 06:41:22'),
(2170, 2400, 36, 0, '2024-07-25 06:41:22', '2024-07-25 06:41:22'),
(2171, 2401, 36, 0, '2024-07-25 06:41:22', '2024-07-25 06:41:22'),
(2172, 2402, 36, 0, '2024-07-25 06:41:22', '2024-07-25 06:41:22'),
(2173, 2403, 36, 0, '2024-07-25 06:41:22', '2024-07-25 06:41:22'),
(2174, 2404, 36, 0, '2024-07-25 06:41:23', '2024-07-25 06:41:23'),
(2175, 2405, 36, 0, '2024-07-25 06:41:23', '2024-07-25 06:41:23'),
(2176, 2406, 36, 0, '2024-07-25 06:41:23', '2024-07-25 06:41:23'),
(2177, 2407, 36, 0, '2024-07-25 06:41:23', '2024-07-25 06:41:23'),
(2178, 2408, 36, 0, '2024-07-25 06:41:23', '2024-07-25 06:41:23'),
(2179, 2409, 36, 0, '2024-07-25 06:41:23', '2024-07-25 06:41:23'),
(2180, 2410, 36, 0, '2024-07-25 06:41:23', '2024-07-25 06:41:23'),
(2181, 2411, 36, 0, '2024-07-25 06:41:23', '2024-07-25 06:41:23'),
(2182, 2412, 36, 0, '2024-07-25 06:41:23', '2024-07-25 06:41:23'),
(2183, 2413, 36, 0, '2024-07-25 06:41:23', '2024-07-25 06:41:23'),
(2184, 2414, 36, 0, '2024-07-25 06:41:23', '2024-07-25 06:41:23'),
(2185, 2415, 36, 0, '2024-07-25 06:41:23', '2024-07-25 06:41:23'),
(2186, 2416, 36, 0, '2024-07-25 06:41:23', '2024-07-25 06:41:23'),
(2187, 2417, 36, 0, '2024-07-25 06:41:23', '2024-07-25 06:41:23'),
(2188, 2418, 36, 0, '2024-07-25 06:41:24', '2024-07-25 06:41:24'),
(2189, 2419, 36, 0, '2024-07-25 06:41:24', '2024-07-25 06:41:24'),
(2190, 2420, 36, 0, '2024-07-25 06:41:24', '2024-07-25 06:41:24'),
(2191, 2421, 36, 0, '2024-07-25 06:41:24', '2024-07-25 06:41:24'),
(2192, 2422, 36, 0, '2024-07-25 06:41:24', '2024-07-25 06:41:24'),
(2193, 2423, 36, 0, '2024-07-25 06:41:24', '2024-07-25 06:41:24'),
(2194, 2424, 35, 0, '2024-07-25 06:41:34', '2024-07-25 06:41:34'),
(2195, 2425, 35, 0, '2024-07-25 06:41:34', '2024-07-25 06:41:34'),
(2196, 2426, 35, 0, '2024-07-25 06:41:34', '2024-07-25 06:41:34'),
(2197, 2427, 35, 0, '2024-07-25 06:41:34', '2024-07-25 06:41:34'),
(2198, 2428, 35, 0, '2024-07-25 06:41:34', '2024-07-25 06:41:34'),
(2199, 2429, 35, 0, '2024-07-25 06:41:34', '2024-07-25 06:41:34'),
(2200, 2430, 35, 0, '2024-07-25 06:41:34', '2024-07-25 06:41:34'),
(2201, 2431, 35, 0, '2024-07-25 06:41:34', '2024-07-25 06:41:34'),
(2202, 2432, 35, 0, '2024-07-25 06:41:34', '2024-07-25 06:41:34'),
(2203, 2433, 35, 0, '2024-07-25 06:41:34', '2024-07-25 06:41:34'),
(2204, 2434, 35, 0, '2024-07-25 06:41:34', '2024-07-25 06:41:34'),
(2205, 2435, 35, 0, '2024-07-25 06:41:34', '2024-07-25 06:41:34'),
(2206, 2436, 35, 0, '2024-07-25 06:41:35', '2024-07-25 06:41:35'),
(2207, 2437, 35, 0, '2024-07-25 06:41:35', '2024-07-25 06:41:35'),
(2208, 2438, 35, 0, '2024-07-25 06:41:35', '2024-07-25 06:41:35'),
(2209, 2439, 35, 0, '2024-07-25 06:41:35', '2024-07-25 06:41:35'),
(2210, 2440, 35, 0, '2024-07-25 06:41:35', '2024-07-25 06:41:35'),
(2211, 2441, 35, 0, '2024-07-25 06:41:35', '2024-07-25 06:41:35'),
(2212, 2442, 35, 0, '2024-07-25 06:41:35', '2024-07-25 06:41:35'),
(2213, 2443, 35, 0, '2024-07-25 06:41:35', '2024-07-25 06:41:35'),
(2214, 2444, 35, 0, '2024-07-25 06:41:35', '2024-07-25 06:41:35'),
(2215, 2445, 35, 0, '2024-07-25 06:41:35', '2024-07-25 06:41:35'),
(2216, 2446, 35, 0, '2024-07-25 06:41:35', '2024-07-25 06:41:35'),
(2217, 2447, 35, 0, '2024-07-25 06:41:35', '2024-07-25 06:41:35'),
(2218, 2448, 35, 0, '2024-07-25 06:41:35', '2024-07-25 06:41:35'),
(2219, 2449, 35, 0, '2024-07-25 06:41:35', '2024-07-25 06:41:35'),
(2220, 2450, 35, 0, '2024-07-25 06:41:35', '2024-07-25 06:41:35'),
(2221, 2451, 35, 0, '2024-07-25 06:41:36', '2024-07-25 06:41:36'),
(2222, 2452, 35, 0, '2024-07-25 06:41:36', '2024-07-25 06:41:36'),
(2223, 2453, 35, 0, '2024-07-25 06:41:36', '2024-07-25 06:41:36'),
(2224, 2454, 35, 0, '2024-07-25 06:41:36', '2024-07-25 06:41:36'),
(2225, 2455, 35, 0, '2024-07-25 06:41:36', '2024-07-25 06:41:36'),
(2226, 2456, 35, 0, '2024-07-25 06:41:36', '2024-07-25 06:41:36'),
(2227, 2457, 35, 0, '2024-07-25 06:41:36', '2024-07-25 06:41:36'),
(2228, 2458, 35, 0, '2024-07-25 06:41:36', '2024-07-25 06:41:36'),
(2229, 2459, 35, 0, '2024-07-25 06:41:36', '2024-07-25 06:41:36'),
(2230, 2460, 34, 0, '2024-07-25 06:41:48', '2024-07-25 06:41:48'),
(2231, 2461, 34, 0, '2024-07-25 06:41:49', '2024-07-25 06:41:49'),
(2232, 2462, 34, 0, '2024-07-25 06:41:49', '2024-07-25 06:41:49'),
(2233, 2463, 34, 0, '2024-07-25 06:41:49', '2024-07-25 06:41:49'),
(2234, 2464, 34, 0, '2024-07-25 06:41:49', '2024-07-25 06:41:49'),
(2235, 2465, 34, 0, '2024-07-25 06:41:49', '2024-07-25 06:41:49'),
(2236, 2466, 34, 0, '2024-07-25 06:41:49', '2024-07-25 06:41:49'),
(2237, 2467, 34, 0, '2024-07-25 06:41:49', '2024-07-25 06:41:49'),
(2238, 2468, 34, 0, '2024-07-25 06:41:49', '2024-07-25 06:41:49'),
(2239, 2469, 34, 0, '2024-07-25 06:41:49', '2024-07-25 06:41:49'),
(2240, 2470, 34, 0, '2024-07-25 06:41:49', '2024-07-25 06:41:49'),
(2241, 2471, 34, 0, '2024-07-25 06:41:49', '2024-07-25 06:41:49'),
(2242, 2472, 34, 0, '2024-07-25 06:41:49', '2024-07-25 06:41:49'),
(2243, 2473, 34, 0, '2024-07-25 06:41:49', '2024-07-25 06:41:49'),
(2244, 2474, 34, 0, '2024-07-25 06:41:49', '2024-07-25 06:41:49'),
(2245, 2475, 34, 0, '2024-07-25 06:41:49', '2024-07-25 06:41:49'),
(2246, 2476, 34, 0, '2024-07-25 06:41:50', '2024-07-25 06:41:50'),
(2247, 2477, 34, 0, '2024-07-25 06:41:50', '2024-07-25 06:41:50'),
(2248, 2478, 34, 0, '2024-07-25 06:41:50', '2024-07-25 06:41:50'),
(2249, 2479, 34, 0, '2024-07-25 06:41:50', '2024-07-25 06:41:50'),
(2250, 2480, 34, 0, '2024-07-25 06:41:50', '2024-07-25 06:41:50'),
(2251, 2481, 34, 0, '2024-07-25 06:41:50', '2024-07-25 06:41:50'),
(2252, 2482, 34, 0, '2024-07-25 06:41:50', '2024-07-25 06:41:50'),
(2253, 2483, 34, 0, '2024-07-25 06:41:50', '2024-07-25 06:41:50'),
(2254, 2484, 34, 0, '2024-07-25 06:41:50', '2024-07-25 06:41:50'),
(2255, 2485, 34, 0, '2024-07-25 06:41:50', '2024-07-25 06:41:50'),
(2256, 2486, 34, 0, '2024-07-25 06:41:50', '2024-07-25 06:41:50'),
(2257, 2487, 34, 0, '2024-07-25 06:41:50', '2024-07-25 06:41:50'),
(2258, 2488, 34, 0, '2024-07-25 06:41:50', '2024-07-25 06:41:50'),
(2259, 2489, 34, 0, '2024-07-25 06:41:50', '2024-07-25 06:41:50'),
(2260, 2490, 34, 0, '2024-07-25 06:41:51', '2024-07-25 06:41:51'),
(2261, 2491, 34, 0, '2024-07-25 06:41:51', '2024-07-25 06:41:51'),
(2262, 2492, 34, 0, '2024-07-25 06:41:51', '2024-07-25 06:41:51'),
(2263, 2493, 34, 0, '2024-07-25 06:41:51', '2024-07-25 06:41:51'),
(2264, 2494, 34, 0, '2024-07-25 06:41:51', '2024-07-25 06:41:51'),
(2265, 2495, 34, 0, '2024-07-25 06:41:51', '2024-07-25 06:41:51'),
(2266, 2496, 33, 0, '2024-07-25 06:41:59', '2024-07-25 06:41:59'),
(2267, 2497, 33, 0, '2024-07-25 06:41:59', '2024-07-25 06:41:59'),
(2268, 2498, 33, 0, '2024-07-25 06:42:00', '2024-07-25 06:42:00'),
(2269, 2499, 33, 0, '2024-07-25 06:42:00', '2024-07-25 06:42:00'),
(2270, 2500, 33, 0, '2024-07-25 06:42:00', '2024-07-25 06:42:00'),
(2271, 2501, 33, 0, '2024-07-25 06:42:00', '2024-07-25 06:42:00'),
(2272, 2502, 33, 0, '2024-07-25 06:42:00', '2024-07-25 06:42:00'),
(2273, 2503, 33, 0, '2024-07-25 06:42:00', '2024-07-25 06:42:00'),
(2274, 2504, 33, 0, '2024-07-25 06:42:00', '2024-07-25 06:42:00'),
(2275, 2505, 33, 0, '2024-07-25 06:42:00', '2024-07-25 06:42:00'),
(2276, 2506, 33, 0, '2024-07-25 06:42:00', '2024-07-25 06:42:00'),
(2277, 2507, 33, 0, '2024-07-25 06:42:00', '2024-07-25 06:42:00'),
(2278, 2508, 33, 0, '2024-07-25 06:42:00', '2024-07-25 06:42:00'),
(2279, 2509, 33, 0, '2024-07-25 06:42:00', '2024-07-25 06:42:00'),
(2280, 2510, 33, 0, '2024-07-25 06:42:00', '2024-07-25 06:42:00'),
(2281, 2511, 33, 0, '2024-07-25 06:42:01', '2024-07-25 06:42:01'),
(2282, 2512, 33, 0, '2024-07-25 06:42:01', '2024-07-25 06:42:01'),
(2283, 2513, 33, 0, '2024-07-25 06:42:01', '2024-07-25 06:42:01'),
(2284, 2514, 33, 0, '2024-07-25 06:42:01', '2024-07-25 06:42:01'),
(2285, 2515, 33, 0, '2024-07-25 06:42:01', '2024-07-25 06:42:01'),
(2286, 2516, 33, 0, '2024-07-25 06:42:01', '2024-07-25 06:42:01'),
(2287, 2517, 33, 0, '2024-07-25 06:42:01', '2024-07-25 06:42:01'),
(2288, 2518, 33, 0, '2024-07-25 06:42:01', '2024-07-25 06:42:01'),
(2289, 2519, 33, 0, '2024-07-25 06:42:01', '2024-07-25 06:42:01'),
(2290, 2520, 33, 0, '2024-07-25 06:42:01', '2024-07-25 06:42:01'),
(2291, 2521, 33, 0, '2024-07-25 06:42:01', '2024-07-25 06:42:01'),
(2292, 2522, 33, 0, '2024-07-25 06:42:01', '2024-07-25 06:42:01'),
(2293, 2523, 33, 0, '2024-07-25 06:42:02', '2024-07-25 06:42:02'),
(2294, 2524, 33, 0, '2024-07-25 06:42:02', '2024-07-25 06:42:02'),
(2295, 2525, 33, 0, '2024-07-25 06:42:02', '2024-07-25 06:42:02'),
(2296, 2526, 33, 0, '2024-07-25 06:42:02', '2024-07-25 06:42:02'),
(2297, 2527, 33, 0, '2024-07-25 06:42:02', '2024-07-25 06:42:02'),
(2298, 2528, 33, 0, '2024-07-25 06:42:02', '2024-07-25 06:42:02'),
(2299, 2529, 33, 0, '2024-07-25 06:42:02', '2024-07-25 06:42:02'),
(2300, 2530, 33, 0, '2024-07-25 06:42:02', '2024-07-25 06:42:02'),
(2301, 2531, 33, 0, '2024-07-25 06:42:02', '2024-07-25 06:42:02'),
(2371, 2606, 49, 0, '2024-07-25 07:02:38', '2024-07-25 07:02:38'),
(2372, 2607, 49, 0, '2024-07-25 07:02:38', '2024-07-25 07:02:38'),
(2373, 2608, 49, 0, '2024-07-25 07:02:38', '2024-07-25 07:02:38'),
(2374, 2609, 49, 0, '2024-07-25 07:02:39', '2024-07-25 07:02:39'),
(2375, 2610, 49, 0, '2024-07-25 07:02:39', '2024-07-25 07:02:39'),
(2376, 2611, 49, 0, '2024-07-25 07:02:39', '2024-07-25 07:02:39'),
(2377, 2612, 49, 0, '2024-07-25 07:02:39', '2024-07-25 07:02:39'),
(2378, 2613, 49, 0, '2024-07-25 07:02:39', '2024-07-25 07:02:39'),
(2379, 2614, 49, 0, '2024-07-25 07:02:39', '2024-07-25 07:02:39'),
(2380, 2615, 49, 0, '2024-07-25 07:02:39', '2024-07-25 07:02:39'),
(2381, 2616, 49, 0, '2024-07-25 07:02:39', '2024-07-25 07:02:39'),
(2382, 2617, 49, 0, '2024-07-25 07:02:39', '2024-07-25 07:02:39'),
(2383, 2618, 49, 0, '2024-07-25 07:02:39', '2024-07-25 07:02:39'),
(2384, 2619, 49, 0, '2024-07-25 07:02:39', '2024-07-25 07:02:39'),
(2385, 2620, 49, 0, '2024-07-25 07:02:39', '2024-07-25 07:02:39'),
(2386, 2621, 49, 0, '2024-07-25 07:02:39', '2024-07-25 07:02:39'),
(2387, 2622, 49, 0, '2024-07-25 07:02:40', '2024-07-25 07:02:40'),
(2388, 2623, 49, 0, '2024-07-25 07:02:40', '2024-07-25 07:02:40'),
(2389, 2624, 49, 0, '2024-07-25 07:02:40', '2024-07-25 07:02:40'),
(2390, 2625, 49, 0, '2024-07-25 07:02:40', '2024-07-25 07:02:40'),
(2391, 2626, 49, 0, '2024-07-25 07:02:40', '2024-07-25 07:02:40'),
(2392, 2627, 49, 0, '2024-07-25 07:02:40', '2024-07-25 07:02:40'),
(2393, 2628, 49, 0, '2024-07-25 07:02:40', '2024-07-25 07:02:40'),
(2394, 2629, 49, 0, '2024-07-25 07:02:40', '2024-07-25 07:02:40'),
(2395, 2630, 49, 0, '2024-07-25 07:02:40', '2024-07-25 07:02:40'),
(2396, 2631, 49, 0, '2024-07-25 07:02:40', '2024-07-25 07:02:40'),
(2397, 2632, 49, 0, '2024-07-25 07:02:40', '2024-07-25 07:02:40'),
(2398, 2633, 49, 0, '2024-07-25 07:02:40', '2024-07-25 07:02:40'),
(2399, 2634, 49, 0, '2024-07-25 07:02:40', '2024-07-25 07:02:40'),
(2400, 2635, 49, 0, '2024-07-25 07:02:40', '2024-07-25 07:02:40'),
(2401, 2636, 49, 0, '2024-07-25 07:02:41', '2024-07-25 07:02:41'),
(2402, 2637, 49, 0, '2024-07-25 07:02:41', '2024-07-25 07:02:41'),
(2436, 2675, 46, 0, '2024-07-25 07:15:57', '2024-07-25 07:15:57'),
(2437, 2676, 46, 0, '2024-07-25 07:15:57', '2024-07-25 07:15:57'),
(2438, 2677, 46, 0, '2024-07-25 07:15:57', '2024-07-25 07:15:57'),
(2439, 2678, 46, 0, '2024-07-25 07:15:57', '2024-07-25 07:15:57'),
(2440, 2679, 46, 0, '2024-07-25 07:15:57', '2024-07-25 07:15:57'),
(2441, 2680, 46, 0, '2024-07-25 07:15:57', '2024-07-25 07:15:57'),
(2442, 2681, 46, 0, '2024-07-25 07:15:57', '2024-07-25 07:15:57'),
(2443, 2682, 46, 0, '2024-07-25 07:15:57', '2024-07-25 07:15:57'),
(2444, 2683, 46, 0, '2024-07-25 07:15:58', '2024-07-25 07:15:58'),
(2445, 2684, 46, 0, '2024-07-25 07:15:58', '2024-07-25 07:15:58'),
(2446, 2685, 46, 0, '2024-07-25 07:15:58', '2024-07-25 07:15:58'),
(2447, 2686, 46, 0, '2024-07-25 07:15:58', '2024-07-25 07:15:58'),
(2448, 2687, 46, 0, '2024-07-25 07:15:58', '2024-07-25 07:15:58'),
(2449, 2688, 46, 0, '2024-07-25 07:15:58', '2024-07-25 07:15:58'),
(2450, 2689, 46, 0, '2024-07-25 07:15:58', '2024-07-25 07:15:58'),
(2451, 2690, 46, 0, '2024-07-25 07:15:58', '2024-07-25 07:15:58'),
(2452, 2691, 46, 0, '2024-07-25 07:15:58', '2024-07-25 07:15:58'),
(2453, 2692, 46, 0, '2024-07-25 07:15:58', '2024-07-25 07:15:58'),
(2454, 2693, 46, 0, '2024-07-25 07:15:58', '2024-07-25 07:15:58'),
(2455, 2694, 46, 0, '2024-07-25 07:15:58', '2024-07-25 07:15:58'),
(2456, 2695, 46, 0, '2024-07-25 07:15:58', '2024-07-25 07:15:58'),
(2457, 2696, 46, 0, '2024-07-25 07:15:58', '2024-07-25 07:15:58'),
(2458, 2697, 46, 0, '2024-07-25 07:15:59', '2024-07-25 07:15:59'),
(2459, 2698, 46, 0, '2024-07-25 07:15:59', '2024-07-25 07:15:59'),
(2460, 2699, 46, 0, '2024-07-25 07:15:59', '2024-07-25 07:15:59'),
(2461, 2700, 46, 0, '2024-07-25 07:15:59', '2024-07-25 07:15:59'),
(2462, 2701, 46, 0, '2024-07-25 07:15:59', '2024-07-25 07:15:59'),
(2463, 2702, 46, 0, '2024-07-25 07:15:59', '2024-07-25 07:15:59'),
(2464, 2703, 46, 0, '2024-07-25 07:15:59', '2024-07-25 07:15:59'),
(2465, 2704, 46, 0, '2024-07-25 07:15:59', '2024-07-25 07:15:59'),
(2466, 2705, 46, 0, '2024-07-25 07:15:59', '2024-07-25 07:15:59'),
(2467, 2706, 46, 0, '2024-07-25 07:15:59', '2024-07-25 07:15:59'),
(2468, 2707, 46, 0, '2024-07-25 07:15:59', '2024-07-25 07:15:59'),
(2469, 2708, 46, 0, '2024-07-25 07:15:59', '2024-07-25 07:15:59'),
(2470, 2709, 46, 0, '2024-07-25 07:15:59', '2024-07-25 07:15:59'),
(2471, 2710, 46, 0, '2024-07-25 07:15:59', '2024-07-25 07:15:59'),
(2508, 2752, 44, 0, '2024-07-25 07:28:05', '2024-07-25 07:28:05'),
(2509, 2753, 44, 0, '2024-07-25 07:28:05', '2024-07-25 07:28:05'),
(2510, 2754, 44, 0, '2024-07-25 07:28:05', '2024-07-25 07:28:05'),
(2511, 2755, 44, 0, '2024-07-25 07:28:05', '2024-07-25 07:28:05'),
(2512, 2756, 44, 0, '2024-07-25 07:28:06', '2024-07-25 07:28:06'),
(2513, 2757, 44, 0, '2024-07-25 07:28:06', '2024-07-25 07:28:06'),
(2514, 2758, 44, 0, '2024-07-25 07:28:06', '2024-07-25 07:28:06'),
(2515, 2759, 44, 0, '2024-07-25 07:28:06', '2024-07-25 07:28:06'),
(2516, 2760, 44, 0, '2024-07-25 07:28:06', '2024-07-25 07:28:06'),
(2517, 2761, 44, 0, '2024-07-25 07:28:06', '2024-07-25 07:28:06'),
(2518, 2762, 44, 0, '2024-07-25 07:28:06', '2024-07-25 07:28:06'),
(2519, 2763, 44, 0, '2024-07-25 07:28:06', '2024-07-25 07:28:06'),
(2520, 2764, 44, 0, '2024-07-25 07:28:06', '2024-07-25 07:28:06'),
(2521, 2765, 44, 0, '2024-07-25 07:28:06', '2024-07-25 07:28:06'),
(2522, 2766, 44, 0, '2024-07-25 07:28:06', '2024-07-25 07:28:06'),
(2523, 2767, 44, 0, '2024-07-25 07:28:06', '2024-07-25 07:28:06'),
(2524, 2768, 44, 0, '2024-07-25 07:28:06', '2024-07-25 07:28:06'),
(2525, 2769, 44, 0, '2024-07-25 07:28:06', '2024-07-25 07:28:06'),
(2526, 2770, 44, 0, '2024-07-25 07:28:07', '2024-07-25 07:28:07'),
(2527, 2771, 44, 0, '2024-07-25 07:28:07', '2024-07-25 07:28:07'),
(2528, 2772, 44, 0, '2024-07-25 07:28:07', '2024-07-25 07:28:07'),
(2529, 2773, 44, 0, '2024-07-25 07:28:07', '2024-07-25 07:28:07'),
(2530, 2774, 44, 0, '2024-07-25 07:28:07', '2024-07-25 07:28:07'),
(2531, 2775, 44, 0, '2024-07-25 07:28:07', '2024-07-25 07:28:07'),
(2532, 2776, 44, 0, '2024-07-25 07:28:07', '2024-07-25 07:28:07'),
(2533, 2777, 44, 0, '2024-07-25 07:28:07', '2024-07-25 07:28:07'),
(2534, 2778, 44, 0, '2024-07-25 07:28:07', '2024-07-25 07:28:07'),
(2535, 2779, 44, 0, '2024-07-25 07:28:07', '2024-07-25 07:28:07'),
(2536, 2780, 44, 0, '2024-07-25 07:28:07', '2024-07-25 07:28:07'),
(2537, 2781, 44, 0, '2024-07-25 07:28:07', '2024-07-25 07:28:07'),
(2538, 2782, 44, 0, '2024-07-25 07:28:07', '2024-07-25 07:28:07'),
(2539, 2783, 44, 0, '2024-07-25 07:28:07', '2024-07-25 07:28:07'),
(2540, 2784, 44, 0, '2024-07-25 07:28:07', '2024-07-25 07:28:07'),
(2541, 2785, 44, 0, '2024-07-25 07:28:08', '2024-07-25 07:28:08'),
(2542, 2786, 44, 0, '2024-07-25 07:28:08', '2024-07-25 07:28:08'),
(2543, 2787, 44, 0, '2024-07-25 07:28:08', '2024-07-25 07:28:08'),
(2696, 2954, 39, 0, '2024-07-25 07:54:42', '2024-07-25 07:54:42'),
(2697, 2955, 39, 0, '2024-07-25 07:54:43', '2024-07-25 07:54:43'),
(2698, 2956, 39, 0, '2024-07-25 07:54:43', '2024-07-25 07:54:43'),
(2699, 2957, 39, 0, '2024-07-25 07:54:43', '2024-07-25 07:54:43'),
(2700, 2958, 39, 0, '2024-07-25 07:54:43', '2024-07-25 07:54:43'),
(2701, 2959, 39, 0, '2024-07-25 07:54:43', '2024-07-25 07:54:43'),
(2702, 2960, 39, 0, '2024-07-25 07:54:43', '2024-07-25 07:54:43'),
(2703, 2961, 39, 0, '2024-07-25 07:54:43', '2024-07-25 07:54:43'),
(2704, 2962, 39, 0, '2024-07-25 07:54:43', '2024-07-25 07:54:43'),
(2705, 2963, 39, 0, '2024-07-25 07:54:43', '2024-07-25 07:54:43'),
(2706, 2964, 39, 0, '2024-07-25 07:54:43', '2024-07-25 07:54:43'),
(2707, 2965, 39, 0, '2024-07-25 07:54:43', '2024-07-25 07:54:43'),
(2708, 2966, 39, 0, '2024-07-25 07:54:43', '2024-07-25 07:54:43'),
(2709, 2967, 39, 0, '2024-07-25 07:54:43', '2024-07-25 07:54:43'),
(2710, 2968, 39, 0, '2024-07-25 07:54:43', '2024-07-25 07:54:43'),
(2711, 2969, 39, 0, '2024-07-25 07:54:44', '2024-07-25 07:54:44'),
(2712, 2970, 39, 0, '2024-07-25 07:54:44', '2024-07-25 07:54:44'),
(2713, 2971, 39, 0, '2024-07-25 07:54:44', '2024-07-25 07:54:44'),
(2714, 2972, 39, 0, '2024-07-25 07:54:44', '2024-07-25 07:54:44'),
(2715, 2973, 39, 0, '2024-07-25 07:54:44', '2024-07-25 07:54:44'),
(2716, 2974, 39, 0, '2024-07-25 07:54:44', '2024-07-25 07:54:44'),
(2717, 2975, 39, 0, '2024-07-25 07:54:44', '2024-07-25 07:54:44'),
(2718, 2976, 39, 0, '2024-07-25 07:54:44', '2024-07-25 07:54:44'),
(2719, 2977, 39, 0, '2024-07-25 07:54:44', '2024-07-25 07:54:44'),
(2720, 2978, 39, 0, '2024-07-25 07:54:44', '2024-07-25 07:54:44'),
(2721, 2979, 39, 0, '2024-07-25 07:54:44', '2024-07-25 07:54:44'),
(2722, 2980, 39, 0, '2024-07-25 07:54:44', '2024-07-25 07:54:44'),
(2723, 2981, 39, 0, '2024-07-25 07:54:44', '2024-07-25 07:54:44'),
(2724, 2982, 39, 0, '2024-07-25 07:54:45', '2024-07-25 07:54:45'),
(2725, 2983, 39, 0, '2024-07-25 07:54:45', '2024-07-25 07:54:45'),
(2726, 2984, 39, 0, '2024-07-25 07:54:45', '2024-07-25 07:54:45'),
(2727, 2985, 39, 0, '2024-07-25 07:54:45', '2024-07-25 07:54:45'),
(2728, 2986, 39, 0, '2024-07-25 07:54:45', '2024-07-25 07:54:45'),
(2729, 2987, 39, 0, '2024-07-25 07:54:45', '2024-07-25 07:54:45'),
(2730, 2988, 39, 0, '2024-07-25 07:54:45', '2024-07-25 07:54:45'),
(2731, 2989, 39, 0, '2024-07-25 07:54:45', '2024-07-25 07:54:45'),
(2732, 2991, 40, 0, '2024-07-25 08:00:17', '2024-07-25 08:00:17'),
(2733, 2992, 40, 0, '2024-07-25 08:00:17', '2024-07-25 08:00:17'),
(2734, 2993, 40, 0, '2024-07-25 08:00:17', '2024-07-25 08:00:17'),
(2735, 2994, 40, 0, '2024-07-25 08:00:17', '2024-07-25 08:00:17'),
(2736, 2995, 40, 0, '2024-07-25 08:00:17', '2024-07-25 08:00:17'),
(2737, 2996, 40, 0, '2024-07-25 08:00:17', '2024-07-25 08:00:17'),
(2738, 2997, 40, 0, '2024-07-25 08:00:18', '2024-07-25 08:00:18'),
(2739, 2998, 40, 0, '2024-07-25 08:00:18', '2024-07-25 08:00:18'),
(2740, 2999, 40, 0, '2024-07-25 08:00:18', '2024-07-25 08:00:18'),
(2741, 3000, 40, 0, '2024-07-25 08:00:18', '2024-07-25 08:00:18'),
(2742, 3001, 40, 0, '2024-07-25 08:00:18', '2024-07-25 08:00:18'),
(2743, 3002, 40, 0, '2024-07-25 08:00:18', '2024-07-25 08:00:18'),
(2744, 3003, 40, 0, '2024-07-25 08:00:18', '2024-07-25 08:00:18'),
(2745, 3004, 40, 0, '2024-07-25 08:00:18', '2024-07-25 08:00:18'),
(2746, 3005, 40, 0, '2024-07-25 08:00:18', '2024-07-25 08:00:18'),
(2747, 3006, 40, 0, '2024-07-25 08:00:18', '2024-07-25 08:00:18'),
(2748, 3007, 40, 0, '2024-07-25 08:00:18', '2024-07-25 08:00:18'),
(2749, 3008, 40, 0, '2024-07-25 08:00:18', '2024-07-25 08:00:18'),
(2750, 3009, 40, 0, '2024-07-25 08:00:18', '2024-07-25 08:00:18'),
(2751, 3010, 40, 0, '2024-07-25 08:00:19', '2024-07-25 08:00:19'),
(2752, 3011, 40, 0, '2024-07-25 08:00:19', '2024-07-25 08:00:19'),
(2753, 3012, 40, 0, '2024-07-25 08:00:19', '2024-07-25 08:00:19'),
(2754, 3013, 40, 0, '2024-07-25 08:00:19', '2024-07-25 08:00:19'),
(2755, 3014, 40, 0, '2024-07-25 08:00:19', '2024-07-25 08:00:19'),
(2756, 3015, 40, 0, '2024-07-25 08:00:19', '2024-07-25 08:00:19'),
(2757, 3016, 40, 0, '2024-07-25 08:00:19', '2024-07-25 08:00:19'),
(2758, 3017, 40, 0, '2024-07-25 08:00:19', '2024-07-25 08:00:19'),
(2759, 3018, 40, 0, '2024-07-25 08:00:19', '2024-07-25 08:00:19'),
(2760, 3019, 40, 0, '2024-07-25 08:00:19', '2024-07-25 08:00:19'),
(2761, 3020, 40, 0, '2024-07-25 08:00:19', '2024-07-25 08:00:19'),
(2762, 3021, 40, 0, '2024-07-25 08:00:19', '2024-07-25 08:00:19'),
(2763, 3022, 40, 0, '2024-07-25 08:00:20', '2024-07-25 08:00:20'),
(2764, 3023, 40, 0, '2024-07-25 08:00:20', '2024-07-25 08:00:20'),
(2765, 3024, 40, 0, '2024-07-25 08:00:20', '2024-07-25 08:00:20'),
(2766, 3025, 40, 0, '2024-07-25 08:00:20', '2024-07-25 08:00:20'),
(2767, 3026, 40, 0, '2024-07-25 08:00:20', '2024-07-25 08:00:20'),
(2768, 3028, 41, 0, '2024-07-25 08:05:00', '2024-07-25 08:05:00'),
(2769, 3029, 41, 0, '2024-07-25 08:05:01', '2024-07-25 08:05:01'),
(2770, 3030, 41, 0, '2024-07-25 08:05:01', '2024-07-25 08:05:01'),
(2771, 3031, 41, 0, '2024-07-25 08:05:01', '2024-07-25 08:05:01'),
(2772, 3032, 41, 0, '2024-07-25 08:05:01', '2024-07-25 08:05:01'),
(2773, 3033, 41, 0, '2024-07-25 08:05:01', '2024-07-25 08:05:01'),
(2774, 3034, 41, 0, '2024-07-25 08:05:01', '2024-07-25 08:05:01'),
(2775, 3035, 41, 0, '2024-07-25 08:05:01', '2024-07-25 08:05:01'),
(2776, 3036, 41, 0, '2024-07-25 08:05:01', '2024-07-25 08:05:01'),
(2777, 3037, 41, 0, '2024-07-25 08:05:01', '2024-07-25 08:05:01'),
(2778, 3038, 41, 0, '2024-07-25 08:05:02', '2024-07-25 08:05:02'),
(2779, 3039, 41, 0, '2024-07-25 08:05:02', '2024-07-25 08:05:02'),
(2780, 3040, 41, 0, '2024-07-25 08:05:02', '2024-07-25 08:05:02'),
(2781, 3041, 41, 0, '2024-07-25 08:05:02', '2024-07-25 08:05:02'),
(2782, 3042, 41, 0, '2024-07-25 08:05:02', '2024-07-25 08:05:02'),
(2783, 3043, 41, 0, '2024-07-25 08:05:02', '2024-07-25 08:05:02'),
(2784, 3044, 41, 0, '2024-07-25 08:05:02', '2024-07-25 08:05:02'),
(2785, 3045, 41, 0, '2024-07-25 08:05:02', '2024-07-25 08:05:02'),
(2786, 3046, 41, 0, '2024-07-25 08:05:02', '2024-07-25 08:05:02'),
(2787, 3047, 41, 0, '2024-07-25 08:05:03', '2024-07-25 08:05:03'),
(2788, 3048, 41, 0, '2024-07-25 08:05:03', '2024-07-25 08:05:03'),
(2789, 3049, 41, 0, '2024-07-25 08:05:03', '2024-07-25 08:05:03'),
(2790, 3050, 41, 0, '2024-07-25 08:05:03', '2024-07-25 08:05:03'),
(2791, 3051, 41, 0, '2024-07-25 08:05:03', '2024-07-25 08:05:03'),
(2792, 3052, 41, 0, '2024-07-25 08:05:03', '2024-07-25 08:05:03'),
(2793, 3053, 41, 0, '2024-07-25 08:05:03', '2024-07-25 08:05:03'),
(2794, 3054, 41, 0, '2024-07-25 08:05:03', '2024-07-25 08:05:03'),
(2795, 3055, 41, 0, '2024-07-25 08:05:03', '2024-07-25 08:05:03'),
(2796, 3056, 41, 0, '2024-07-25 08:05:03', '2024-07-25 08:05:03'),
(2797, 3057, 41, 0, '2024-07-25 08:05:04', '2024-07-25 08:05:04'),
(2798, 3058, 41, 0, '2024-07-25 08:05:04', '2024-07-25 08:05:04'),
(2799, 3059, 41, 0, '2024-07-25 08:05:04', '2024-07-25 08:05:04'),
(2800, 3060, 41, 0, '2024-07-25 08:05:04', '2024-07-25 08:05:04'),
(2801, 3061, 41, 0, '2024-07-25 08:05:04', '2024-07-25 08:05:04'),
(2802, 3062, 41, 0, '2024-07-25 08:05:04', '2024-07-25 08:05:04'),
(2803, 3063, 41, 0, '2024-07-25 08:05:04', '2024-07-25 08:05:04'),
(2804, 3066, 43, 0, '2024-07-25 08:10:01', '2024-07-25 08:10:01'),
(2805, 3067, 43, 0, '2024-07-25 08:10:01', '2024-07-25 08:10:01'),
(2806, 3068, 43, 0, '2024-07-25 08:10:01', '2024-07-25 08:10:01'),
(2807, 3069, 43, 0, '2024-07-25 08:10:01', '2024-07-25 08:10:01'),
(2808, 3070, 43, 0, '2024-07-25 08:10:02', '2024-07-25 08:10:02'),
(2809, 3071, 43, 0, '2024-07-25 08:10:02', '2024-07-25 08:10:02'),
(2810, 3072, 43, 0, '2024-07-25 08:10:02', '2024-07-25 08:10:02'),
(2811, 3073, 43, 0, '2024-07-25 08:10:02', '2024-07-25 08:10:02'),
(2812, 3074, 43, 0, '2024-07-25 08:10:02', '2024-07-25 08:10:02'),
(2813, 3075, 43, 0, '2024-07-25 08:10:02', '2024-07-25 08:10:02'),
(2814, 3076, 43, 0, '2024-07-25 08:10:02', '2024-07-25 08:10:02'),
(2815, 3077, 43, 0, '2024-07-25 08:10:02', '2024-07-25 08:10:02'),
(2816, 3078, 43, 0, '2024-07-25 08:10:03', '2024-07-25 08:10:03'),
(2817, 3079, 43, 0, '2024-07-25 08:10:03', '2024-07-25 08:10:03'),
(2818, 3080, 43, 0, '2024-07-25 08:10:03', '2024-07-25 08:10:03'),
(2819, 3081, 43, 0, '2024-07-25 08:10:03', '2024-07-25 08:10:03'),
(2820, 3082, 43, 0, '2024-07-25 08:10:03', '2024-07-25 08:10:03'),
(2821, 3083, 43, 0, '2024-07-25 08:10:03', '2024-07-25 08:10:03'),
(2822, 3084, 43, 0, '2024-07-25 08:10:03', '2024-07-25 08:10:03'),
(2823, 3085, 43, 0, '2024-07-25 08:10:03', '2024-07-25 08:10:03'),
(2824, 3086, 43, 0, '2024-07-25 08:10:03', '2024-07-25 08:10:03'),
(2825, 3087, 43, 0, '2024-07-25 08:10:03', '2024-07-25 08:10:03'),
(2826, 3088, 43, 0, '2024-07-25 08:10:03', '2024-07-25 08:10:03'),
(2827, 3089, 43, 0, '2024-07-25 08:10:04', '2024-07-25 08:10:04'),
(2828, 3090, 43, 0, '2024-07-25 08:10:04', '2024-07-25 08:10:04'),
(2829, 3091, 43, 0, '2024-07-25 08:10:04', '2024-07-25 08:10:04'),
(2830, 3092, 43, 0, '2024-07-25 08:10:04', '2024-07-25 08:10:04'),
(2831, 3093, 43, 0, '2024-07-25 08:10:04', '2024-07-25 08:10:04'),
(2832, 3094, 43, 0, '2024-07-25 08:10:04', '2024-07-25 08:10:04'),
(2833, 3095, 43, 0, '2024-07-25 08:10:04', '2024-07-25 08:10:04'),
(2834, 3096, 43, 0, '2024-07-25 08:10:04', '2024-07-25 08:10:04'),
(2835, 3097, 43, 0, '2024-07-25 08:10:04', '2024-07-25 08:10:04'),
(2836, 3098, 43, 0, '2024-07-25 08:10:04', '2024-07-25 08:10:04'),
(2837, 3099, 43, 0, '2024-07-25 08:10:04', '2024-07-25 08:10:04'),
(2838, 3100, 43, 0, '2024-07-25 08:10:04', '2024-07-25 08:10:04'),
(2839, 3101, 43, 0, '2024-07-25 08:10:04', '2024-07-25 08:10:04'),
(2876, 3140, 42, 0, '2024-07-25 08:14:30', '2024-07-25 08:14:30'),
(2877, 3141, 42, 0, '2024-07-25 08:14:30', '2024-07-25 08:14:30'),
(2878, 3142, 42, 0, '2024-07-25 08:14:30', '2024-07-25 08:14:30'),
(2879, 3143, 42, 0, '2024-07-25 08:14:30', '2024-07-25 08:14:30'),
(2880, 3144, 42, 0, '2024-07-25 08:14:30', '2024-07-25 08:14:30'),
(2881, 3145, 42, 0, '2024-07-25 08:14:30', '2024-07-25 08:14:30'),
(2882, 3146, 42, 0, '2024-07-25 08:14:30', '2024-07-25 08:14:30'),
(2883, 3147, 42, 0, '2024-07-25 08:14:30', '2024-07-25 08:14:30'),
(2884, 3148, 42, 0, '2024-07-25 08:14:30', '2024-07-25 08:14:30'),
(2885, 3149, 42, 0, '2024-07-25 08:14:30', '2024-07-25 08:14:30'),
(2886, 3150, 42, 0, '2024-07-25 08:14:30', '2024-07-25 08:14:30'),
(2887, 3151, 42, 0, '2024-07-25 08:14:30', '2024-07-25 08:14:30'),
(2888, 3152, 42, 0, '2024-07-25 08:14:30', '2024-07-25 08:14:30'),
(2889, 3153, 42, 0, '2024-07-25 08:14:30', '2024-07-25 08:14:30'),
(2890, 3154, 42, 0, '2024-07-25 08:14:31', '2024-07-25 08:14:31'),
(2891, 3155, 42, 0, '2024-07-25 08:14:31', '2024-07-25 08:14:31'),
(2892, 3156, 42, 0, '2024-07-25 08:14:31', '2024-07-25 08:14:31'),
(2893, 3157, 42, 0, '2024-07-25 08:14:31', '2024-07-25 08:14:31'),
(2894, 3158, 42, 0, '2024-07-25 08:14:31', '2024-07-25 08:14:31'),
(2895, 3159, 42, 0, '2024-07-25 08:14:31', '2024-07-25 08:14:31'),
(2896, 3160, 42, 0, '2024-07-25 08:14:31', '2024-07-25 08:14:31'),
(2897, 3161, 42, 0, '2024-07-25 08:14:31', '2024-07-25 08:14:31'),
(2898, 3162, 42, 0, '2024-07-25 08:14:31', '2024-07-25 08:14:31'),
(2899, 3163, 42, 0, '2024-07-25 08:14:31', '2024-07-25 08:14:31'),
(2900, 3164, 42, 0, '2024-07-25 08:14:31', '2024-07-25 08:14:31'),
(2901, 3165, 42, 0, '2024-07-25 08:14:31', '2024-07-25 08:14:31'),
(2902, 3166, 42, 0, '2024-07-25 08:14:32', '2024-07-25 08:14:32'),
(2903, 3167, 42, 0, '2024-07-25 08:14:32', '2024-07-25 08:14:32'),
(2904, 3168, 42, 0, '2024-07-25 08:14:32', '2024-07-25 08:14:32'),
(2905, 3169, 42, 0, '2024-07-25 08:14:32', '2024-07-25 08:14:32'),
(2906, 3170, 42, 0, '2024-07-25 08:14:32', '2024-07-25 08:14:32'),
(2907, 3171, 42, 0, '2024-07-25 08:14:32', '2024-07-25 08:14:32'),
(2908, 3172, 42, 0, '2024-07-25 08:14:32', '2024-07-25 08:14:32'),
(2909, 3173, 42, 0, '2024-07-25 08:14:32', '2024-07-25 08:14:32'),
(2910, 3174, 42, 0, '2024-07-25 08:14:32', '2024-07-25 08:14:32'),
(2911, 3175, 42, 0, '2024-07-25 08:14:32', '2024-07-25 08:14:32');

-- --------------------------------------------------------

--
-- Table structure for table `user_documents`
--

CREATE TABLE `user_documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `file_url` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE `user_profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `student_id` varchar(255) DEFAULT NULL,
  `roll_no` varchar(255) DEFAULT NULL,
  `session` varchar(255) DEFAULT NULL,
  `plan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `note` text DEFAULT NULL,
  `blood_group` enum('A+','A-','B+','B-','O+','O-','AB+','AB-') DEFAULT NULL,
  `physical_disability` varchar(255) DEFAULT NULL,
  `previous_school_name` varchar(255) DEFAULT NULL,
  `previous_school_year_of_exist` varchar(255) DEFAULT NULL,
  `national_identification_number` varchar(255) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `bank_account_number` varchar(255) DEFAULT NULL,
  `highest_degree_name` text DEFAULT NULL,
  `institute_name` text DEFAULT NULL,
  `passing_year` text DEFAULT NULL,
  `religion` text DEFAULT NULL,
  `nationality` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_profiles`
--

INSERT INTO `user_profiles` (`id`, `user_id`, `student_id`, `roll_no`, `session`, `plan_id`, `note`, `blood_group`, `physical_disability`, `previous_school_name`, `previous_school_year_of_exist`, `national_identification_number`, `bank_name`, `bank_account_number`, `highest_degree_name`, `institute_name`, `passing_year`, `religion`, `nationality`, `created_at`, `updated_at`) VALUES
(1, 5, 'STD-00000', 'magwou5', '0', NULL, '123', 'AB+', 'Normal', 'Test School', '2010', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', NULL, '2024-03-29 03:16:39', '2024-07-23 10:17:39'),
(158, 294, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2020', 'Islam', 'Indonesian', '2024-07-24 08:02:23', '2024-07-25 03:21:19'),
(195, 331, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2021', 'islam', 'Indonesian', '2024-07-24 08:08:06', '2024-07-25 03:20:44'),
(196, 332, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2020', 'islam', 'Indonesian', '2024-07-24 08:15:35', '2024-07-25 03:20:10'),
(233, 369, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2021', 'islam', 'Indonesian', '2024-07-24 08:18:19', '2024-07-25 03:19:32'),
(234, 370, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2022', 'islam', 'Indonesian', '2024-07-24 08:23:24', '2024-07-25 03:17:06'),
(235, 371, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2020', 'islam', 'Indonesian', '2024-07-24 08:31:59', '2024-07-25 03:15:35'),
(236, 372, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2020', 'Islam', 'Indonesian', '2024-07-24 08:36:53', '2024-07-25 03:14:39'),
(237, 373, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2020', 'islam', 'Indonesian', '2024-07-24 08:39:04', '2024-07-25 03:12:58'),
(238, 374, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2025', 'islam', 'Indonesian', '2024-07-24 08:43:42', '2024-07-25 03:12:29'),
(239, 375, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2026', 'islam', 'Indonesian', '2024-07-24 08:46:28', '2024-07-25 03:11:52'),
(240, 376, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2028', 'islam', 'Indonesian', '2024-07-24 08:48:43', '2024-07-25 03:11:13'),
(241, 377, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2021', 'islam', 'Indonesian', '2024-07-24 08:50:32', '2024-07-25 03:10:33'),
(242, 378, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2022', 'islam', 'Indonesian', '2024-07-24 08:56:51', '2024-07-25 03:09:48'),
(279, 415, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2025', 'islam', 'Indonesian', '2024-07-24 09:02:22', '2024-07-25 03:09:13'),
(1037, 1182, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2024', NULL, NULL, '2024-07-24 12:25:15', '2024-07-25 03:08:25'),
(1038, 1183, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2024', NULL, NULL, '2024-07-24 12:37:44', '2024-07-25 03:07:38'),
(1039, 1184, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2024', NULL, NULL, '2024-07-24 12:46:59', '2024-07-25 03:06:22'),
(1040, 1185, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2024', NULL, NULL, '2024-07-24 13:00:45', '2024-07-25 03:05:41'),
(1041, 1186, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2024', NULL, NULL, '2024-07-24 13:03:51', '2024-07-25 03:04:48'),
(1042, 1187, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2024', 'islam', 'Indonesian', '2024-07-24 13:06:05', '2024-07-25 03:04:13'),
(1043, 1188, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2024', NULL, NULL, '2024-07-24 13:07:48', '2024-07-25 03:02:44'),
(1044, 1189, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2024', NULL, NULL, '2024-07-24 13:13:31', '2024-07-25 03:02:02'),
(1045, 1190, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2024', 'islam', 'Indonesian', '2024-07-24 13:16:02', '2024-07-25 03:00:03'),
(1046, 1191, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2024', 'islam', 'Indonesian', '2024-07-24 13:20:20', '2024-07-25 02:59:10'),
(1047, 1192, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2024', NULL, NULL, '2024-07-24 13:22:43', '2024-07-25 02:58:25'),
(1048, 1193, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2024', NULL, NULL, '2024-07-24 13:24:25', '2024-07-25 02:56:39'),
(1049, 1194, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2024', NULL, NULL, '2024-07-24 13:27:15', '2024-07-25 02:55:44'),
(1050, 1195, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2024', NULL, NULL, '2024-07-24 13:28:49', '2024-07-25 02:50:43'),
(1051, 1196, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2024', NULL, NULL, '2024-07-24 13:30:26', '2024-07-25 02:48:38'),
(1052, 1197, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2024', NULL, NULL, '2024-07-24 13:32:40', '2024-07-25 02:47:56'),
(1053, 1198, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2024', NULL, NULL, '2024-07-24 13:35:48', '2024-07-25 02:46:53'),
(1054, 1199, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2024', 'islam', 'Indonesian', '2024-07-24 13:39:19', '2024-07-25 03:31:31'),
(1055, 1200, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2024', 'islam', NULL, '2024-07-24 13:40:24', '2024-07-25 02:44:20'),
(1056, 1201, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2024', 'islam', 'Indonesian', '2024-07-24 13:48:53', '2024-07-25 02:42:59'),
(1057, 1202, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2019', 'islam', 'Indonesian', '2024-07-25 01:27:32', '2024-07-25 02:42:35'),
(1058, 1203, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2029', 'islam', 'Indonesian', '2024-07-25 01:40:01', '2024-07-25 02:42:10'),
(1059, 1204, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2025', 'islam', 'Indonesian', '2024-07-25 01:44:45', '2024-07-25 02:23:29'),
(1258, 1409, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2020', 'islam', 'Indonesian', '2024-07-25 03:28:09', '2024-07-25 03:28:09'),
(1259, 1410, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2020', 'islam', 'Indonesian', '2024-07-25 03:30:38', '2024-07-25 03:30:38'),
(1260, 1411, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2020', 'islam', 'Indonesian', '2024-07-25 03:55:55', '2024-07-25 03:55:55'),
(1261, 1412, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2020', 'islam', 'Indonesian', '2024-07-25 04:00:04', '2024-07-25 04:01:13'),
(1262, 1413, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2020', 'islam', 'Indonesian', '2024-07-25 04:03:10', '2024-07-25 04:03:10'),
(1263, 1414, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2020', 'islam', 'Indonesian', '2024-07-25 04:05:05', '2024-07-25 04:05:05'),
(1264, 1415, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2020', 'islam', 'Indonesian', '2024-07-25 04:08:27', '2024-07-25 04:08:27'),
(1298, 1450, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2020', 'islam', 'Indonesian', '2024-07-25 04:16:37', '2024-07-25 04:17:51'),
(1300, 1452, 'STD-00001', '343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:19:28', '2024-07-25 04:19:28'),
(1301, 1453, 'STD-00002', '343433n43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:19:28', '2024-07-25 04:19:28'),
(1302, 1454, 'STD-00003', '343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:19:28', '2024-07-25 04:19:28'),
(1303, 1455, 'STD-00004', '343b34344', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:19:28', '2024-07-25 04:19:28'),
(1304, 1456, 'STD-00005', '343b34345', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:19:28', '2024-07-25 04:19:28'),
(1305, 1457, 'STD-00006', '343b34346', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:19:28', '2024-07-25 04:19:28'),
(1306, 1458, 'STD-00007', '343b34347', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:19:28', '2024-07-25 04:19:28'),
(1307, 1459, 'STD-00008', '343b34348', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:19:28', '2024-07-25 04:19:28'),
(1308, 1460, 'STD-00009', '343b34349', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:19:28', '2024-07-25 04:19:28'),
(1309, 1461, 'STD-00010', '343b34350', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:19:28', '2024-07-25 04:19:28'),
(1310, 1462, 'STD-00011', '343b34351', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:19:28', '2024-07-25 04:19:28'),
(1311, 1463, 'STD-00012', '343b34352', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:19:29', '2024-07-25 04:19:29'),
(1312, 1464, 'STD-00013', '343b34353', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:19:29', '2024-07-25 04:19:29'),
(1313, 1465, 'STD-00014', '343b34354', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:19:29', '2024-07-25 04:19:29'),
(1314, 1466, 'STD-00015', '343b34355', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:19:29', '2024-07-25 04:19:29'),
(1315, 1467, 'STD-00016', '343b34356', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:19:29', '2024-07-25 04:19:29'),
(1316, 1468, 'STD-00017', '343b34357', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:19:29', '2024-07-25 04:19:29'),
(1317, 1469, 'STD-00018', '343b34358', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:19:29', '2024-07-25 04:19:29'),
(1318, 1470, 'STD-00019', '343b34359', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:19:29', '2024-07-25 04:19:29'),
(1319, 1471, 'STD-00020', '343b34360', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:19:29', '2024-07-25 04:19:29'),
(1320, 1472, 'STD-00021', '343b34361', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:19:29', '2024-07-25 04:19:29'),
(1321, 1473, 'STD-00022', '343b34362', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:19:29', '2024-07-25 04:19:29'),
(1322, 1474, 'STD-00023', '343b34363', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:19:29', '2024-07-25 04:19:29'),
(1323, 1475, 'STD-00024', '343b34364', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:19:29', '2024-07-25 04:19:29'),
(1324, 1476, 'STD-00025', '343b34365', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:19:29', '2024-07-25 04:19:29'),
(1325, 1477, 'STD-00026', '343b34366', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:19:29', '2024-07-25 04:19:29'),
(1326, 1478, 'STD-00027', '343b34367', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:19:30', '2024-07-25 04:19:30'),
(1327, 1479, 'STD-00028', '343b34368', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:19:30', '2024-07-25 04:19:30'),
(1328, 1480, 'STD-00029', '343b34369', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:19:30', '2024-07-25 04:19:30'),
(1329, 1481, 'STD-00030', '343b34370', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:19:30', '2024-07-25 04:19:30'),
(1330, 1482, 'STD-00031', '343b34371', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:19:30', '2024-07-25 04:19:30'),
(1331, 1483, 'STD-00032', '343b34372', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:19:30', '2024-07-25 04:19:30'),
(1332, 1484, 'STD-00033', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:19:30', '2024-07-25 04:19:30'),
(1430, 1585, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2020', 'islam', 'Indonesian', '2024-07-25 04:30:43', '2024-07-25 04:30:43'),
(1559, 1718, 'STD-00034', 'zuKx343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:44:39', '2024-07-25 04:44:39'),
(1560, 1719, 'STD-00035', 'ngcR343433n43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:44:39', '2024-07-25 04:44:39'),
(1561, 1720, 'STD-00036', 'EpkZ343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:44:39', '2024-07-25 04:44:39'),
(1562, 1721, 'STD-00037', 'UaXo343b34344', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:44:39', '2024-07-25 04:44:39'),
(1563, 1722, 'STD-00038', '31kx343b34345', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:44:39', '2024-07-25 04:44:39'),
(1564, 1723, 'STD-00039', '3NUJ343b34346', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:44:39', '2024-07-25 04:44:39'),
(1565, 1724, 'STD-00040', 'oGio343b34347', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:44:39', '2024-07-25 04:44:39'),
(1566, 1725, 'STD-00041', 'is68343b34348', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:44:39', '2024-07-25 04:44:39'),
(1567, 1726, 'STD-00042', '35rs343b34349', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:44:39', '2024-07-25 04:44:39'),
(1568, 1727, 'STD-00043', 'LYu4343b34350', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:44:39', '2024-07-25 04:44:39'),
(1569, 1728, 'STD-00044', 'QA5v343b34351', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:44:40', '2024-07-25 04:44:40'),
(1570, 1729, 'STD-00045', '4NKy343b34352', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:44:40', '2024-07-25 04:44:40'),
(1571, 1730, 'STD-00046', '0yca343b34353', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:44:40', '2024-07-25 04:44:40'),
(1572, 1731, 'STD-00047', 'iJRJ343b34354', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:44:40', '2024-07-25 04:44:40'),
(1573, 1732, 'STD-00048', 'qSgm343b34355', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:44:40', '2024-07-25 04:44:40'),
(1574, 1733, 'STD-00049', 'k5fP343b34356', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:44:40', '2024-07-25 04:44:40'),
(1575, 1734, 'STD-00050', 'j3PL343b34357', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:44:40', '2024-07-25 04:44:40'),
(1576, 1735, 'STD-00051', '7atl343b34358', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:44:40', '2024-07-25 04:44:40'),
(1577, 1736, 'STD-00052', 'N9bB343b34359', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:44:40', '2024-07-25 04:44:40'),
(1578, 1737, 'STD-00053', '0A8I343b34360', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:44:40', '2024-07-25 04:44:40'),
(1579, 1738, 'STD-00054', 'LLZg343b34361', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:44:40', '2024-07-25 04:44:40'),
(1580, 1739, 'STD-00055', 'TknV343b34362', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:44:40', '2024-07-25 04:44:40'),
(1581, 1740, 'STD-00056', 'DDzl343b34363', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:44:40', '2024-07-25 04:44:40'),
(1582, 1741, 'STD-00057', '2bQ8343b34364', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:44:40', '2024-07-25 04:44:40'),
(1583, 1742, 'STD-00058', 'cLcs343b34365', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:44:41', '2024-07-25 04:44:41'),
(1584, 1743, 'STD-00059', 'Z6Mg343b34366', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:44:41', '2024-07-25 04:44:41'),
(1585, 1744, 'STD-00060', 'W2NW343b34367', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:44:41', '2024-07-25 04:44:41'),
(1586, 1745, 'STD-00061', 'FDcf343b34368', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:44:41', '2024-07-25 04:44:41'),
(1587, 1746, 'STD-00062', 'BVSm343b34369', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:44:41', '2024-07-25 04:44:41'),
(1588, 1747, 'STD-00063', 'xD9h343b34370', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:44:41', '2024-07-25 04:44:41'),
(1589, 1748, 'STD-00064', 'ev7C343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:44:41', '2024-07-25 04:44:41'),
(1590, 1749, 'STD-00065', '343433n44', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:44:41', '2024-07-25 04:44:41'),
(1591, 1750, 'STD-00066', 'Jsxs343b34371', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:44:41', '2024-07-25 04:44:41'),
(1592, 1751, 'STD-00067', 'Afnm343b34372', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:44:41', '2024-07-25 04:44:41'),
(1593, 1752, 'STD-00068', '343b34373', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:44:41', '2024-07-25 04:44:41'),
(1594, 1753, 'STD-00069', '343b34374', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:44:41', '2024-07-25 04:44:41'),
(1631, 1791, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2020', 'islam', 'Indonesian', '2024-07-25 04:56:05', '2024-07-25 04:56:05'),
(1632, 1792, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2020', 'islam', 'Indonesian', '2024-07-25 04:59:16', '2024-07-25 04:59:16'),
(1633, 1793, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2020', 'islam', 'Indonesian', '2024-07-25 05:01:36', '2024-07-25 05:01:36'),
(1634, 1794, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2020', 'islam', 'Indonesian', '2024-07-25 05:05:57', '2024-07-25 05:05:57'),
(1635, 1795, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2020', 'islam', 'Indonesian', '2024-07-25 06:12:38', '2024-07-25 06:12:38'),
(1636, 1796, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2020', 'islam', 'Indonesian', '2024-07-25 06:15:19', '2024-07-25 06:15:19'),
(1637, 1797, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2020', 'islam', 'Indonesian', '2024-07-25 06:17:35', '2024-07-25 06:17:35'),
(1778, 1942, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2020', 'islam', 'Indonesian', '2024-07-25 06:27:19', '2024-07-25 06:27:19'),
(1780, 1945, 'STD-00070', 'TkmK343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:33:54', '2024-07-25 06:33:54'),
(1781, 1946, 'STD-00071', 'wfXF343433n43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:33:54', '2024-07-25 06:33:54'),
(1782, 1947, 'STD-00072', 'QWgJ343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:33:54', '2024-07-25 06:33:54'),
(1783, 1948, 'STD-00073', '7FjF343b34344', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:33:54', '2024-07-25 06:33:54'),
(1784, 1949, 'STD-00074', '1XAS343b34345', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:33:54', '2024-07-25 06:33:54'),
(1785, 1950, 'STD-00075', 'pZgS343b34346', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:33:54', '2024-07-25 06:33:54'),
(1786, 1951, 'STD-00076', '64WJ343b34347', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:33:54', '2024-07-25 06:33:54'),
(1787, 1952, 'STD-00077', 'mhlW343b34348', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:33:54', '2024-07-25 06:33:54'),
(1788, 1953, 'STD-00078', 'SBCv343b34349', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:33:54', '2024-07-25 06:33:54'),
(1789, 1954, 'STD-00079', 'BNYJ343b34350', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:33:55', '2024-07-25 06:33:55'),
(1790, 1955, 'STD-00080', '66Am343b34351', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:33:55', '2024-07-25 06:33:55'),
(1791, 1956, 'STD-00081', 'l0IM343b34352', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:33:55', '2024-07-25 06:33:55'),
(1792, 1957, 'STD-00082', 'ybu5343b34353', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:33:55', '2024-07-25 06:33:55'),
(1793, 1958, 'STD-00083', 'f0SX343b34354', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:33:55', '2024-07-25 06:33:55'),
(1794, 1959, 'STD-00084', 'sdfg343b34355', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:33:55', '2024-07-25 06:33:55'),
(1795, 1960, 'STD-00085', '0Zkw343b34356', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:33:55', '2024-07-25 06:33:55'),
(1796, 1961, 'STD-00086', 'ZUJE343b34357', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:33:55', '2024-07-25 06:33:55'),
(1797, 1962, 'STD-00087', 'fLcw343b34358', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:33:55', '2024-07-25 06:33:55'),
(1798, 1963, 'STD-00088', 'iorh343b34359', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:33:55', '2024-07-25 06:33:55'),
(1799, 1964, 'STD-00089', 'Tn1o343b34360', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:33:55', '2024-07-25 06:33:55'),
(1800, 1965, 'STD-00090', '4i8O343b34361', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:33:55', '2024-07-25 06:33:55'),
(1801, 1966, 'STD-00091', 'pk2Z343b34362', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:33:55', '2024-07-25 06:33:55'),
(1802, 1967, 'STD-00092', '6Qwg343b34363', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:33:56', '2024-07-25 06:33:56'),
(1803, 1968, 'STD-00093', 'VAEt343b34364', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:33:56', '2024-07-25 06:33:56'),
(1804, 1969, 'STD-00094', 'sZnr343b34365', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:33:56', '2024-07-25 06:33:56'),
(1805, 1970, 'STD-00095', 'Hd4X343b34366', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:33:56', '2024-07-25 06:33:56'),
(1806, 1971, 'STD-00096', 'NOXl343b34367', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:33:56', '2024-07-25 06:33:56'),
(1807, 1972, 'STD-00097', '4NfE343b34368', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:33:56', '2024-07-25 06:33:56'),
(1808, 1973, 'STD-00098', '8dz3343b34369', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:33:56', '2024-07-25 06:33:56'),
(1809, 1974, 'STD-00099', 'cMaV343b34370', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:33:56', '2024-07-25 06:33:56'),
(1810, 1975, 'STD-00100', 'bNWx343b34371', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:33:56', '2024-07-25 06:33:56'),
(1811, 1976, 'STD-00101', 'VDng343b34372', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:33:56', '2024-07-25 06:33:56'),
(1812, 1977, 'STD-00102', 'SgVB343b34373', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:33:56', '2024-07-25 06:33:56'),
(1813, 1978, 'STD-00103', 'edgy343b34374', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:33:56', '2024-07-25 06:33:56'),
(1814, 1979, 'STD-00104', '343b34375', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:33:57', '2024-07-25 06:33:57'),
(1815, 1980, 'STD-00105', '343b34376', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:33:57', '2024-07-25 06:33:57'),
(1816, 1981, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2020', 'islam', 'Indonesian', '2024-07-25 06:34:32', '2024-07-25 06:34:32'),
(2105, 2278, 'STD-00106', 'Bbos343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:38:20', '2024-07-25 06:38:20'),
(2106, 2279, 'STD-00107', 'YfSc343433n43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:38:20', '2024-07-25 06:38:20'),
(2107, 2280, 'STD-00108', 'MnAT343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:38:20', '2024-07-25 06:38:20'),
(2108, 2281, 'STD-00109', 'mbSv343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:38:20', '2024-07-25 06:38:20'),
(2109, 2282, 'STD-00110', 'Gdhr343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:38:21', '2024-07-25 06:38:21'),
(2110, 2283, 'STD-00111', 'e2fG343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:38:21', '2024-07-25 06:38:21'),
(2111, 2284, 'STD-00112', 'JXgH343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:38:21', '2024-07-25 06:38:21'),
(2112, 2285, 'STD-00113', '6wFe343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:38:21', '2024-07-25 06:38:21'),
(2113, 2286, 'STD-00114', 'I0Ou343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:38:21', '2024-07-25 06:38:21'),
(2114, 2287, 'STD-00115', 'UC1H343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:38:21', '2024-07-25 06:38:21'),
(2115, 2288, 'STD-00116', 'U9IY343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:38:21', '2024-07-25 06:38:21'),
(2116, 2289, 'STD-00117', 'Q26d343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:38:21', '2024-07-25 06:38:21'),
(2117, 2290, 'STD-00118', 'q8B8343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:38:21', '2024-07-25 06:38:21'),
(2118, 2291, 'STD-00119', 'mXRv343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:38:21', '2024-07-25 06:38:21'),
(2119, 2292, 'STD-00120', '3In4343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:38:21', '2024-07-25 06:38:21'),
(2120, 2293, 'STD-00121', 'H3Qt343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:38:21', '2024-07-25 06:38:21'),
(2121, 2294, 'STD-00122', 'C87c343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:38:21', '2024-07-25 06:38:21'),
(2122, 2295, 'STD-00123', 'iai4343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:38:21', '2024-07-25 06:38:21'),
(2123, 2296, 'STD-00124', 'AmTF343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:38:21', '2024-07-25 06:38:21'),
(2124, 2297, 'STD-00125', 'AwSj343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:38:22', '2024-07-25 06:38:22'),
(2125, 2298, 'STD-00126', '2yBZ343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:38:22', '2024-07-25 06:38:22'),
(2126, 2299, 'STD-00127', 'QPMW343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:38:22', '2024-07-25 06:38:22'),
(2127, 2300, 'STD-00128', 'Z4AR343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:38:22', '2024-07-25 06:38:22'),
(2128, 2301, 'STD-00129', 'd7qB343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:38:22', '2024-07-25 06:38:22'),
(2129, 2302, 'STD-00130', '88B8343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:38:22', '2024-07-25 06:38:22'),
(2130, 2303, 'STD-00131', '0zA2343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:38:22', '2024-07-25 06:38:22'),
(2131, 2304, 'STD-00132', 'QaXZ343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:38:22', '2024-07-25 06:38:22'),
(2132, 2305, 'STD-00133', 'oQpu343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:38:22', '2024-07-25 06:38:22'),
(2133, 2306, 'STD-00134', 'uMEV343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:38:22', '2024-07-25 06:38:22'),
(2134, 2307, 'STD-00135', 'maI6343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:38:22', '2024-07-25 06:38:22'),
(2135, 2308, 'STD-00136', 'jiKg343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:38:22', '2024-07-25 06:38:22'),
(2136, 2309, 'STD-00137', '0Sbb343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:38:22', '2024-07-25 06:38:22'),
(2137, 2310, 'STD-00138', 'kfO5343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:38:22', '2024-07-25 06:38:22'),
(2138, 2311, 'STD-00139', 'NKUW343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:38:23', '2024-07-25 06:38:23'),
(2139, 2312, 'STD-00140', 'O2xu343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:38:23', '2024-07-25 06:38:23'),
(2140, 2313, 'STD-00141', 'vbRt343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:38:23', '2024-07-25 06:38:23'),
(2141, 2314, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2020', 'islam', 'Indonesian', '2024-07-25 06:38:41', '2024-07-25 06:38:41'),
(2142, 2315, 'STD-00142', 'vuSd343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:40:28', '2024-07-25 06:40:28'),
(2143, 2316, 'STD-00143', 'DSk3343433n43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:40:28', '2024-07-25 06:40:28'),
(2144, 2317, 'STD-00144', 'ns5q343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:40:28', '2024-07-25 06:40:28'),
(2145, 2318, 'STD-00145', 'gGHY343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:40:28', '2024-07-25 06:40:28'),
(2146, 2319, 'STD-00146', '073H343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:40:28', '2024-07-25 06:40:28'),
(2147, 2320, 'STD-00147', 'xwff343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:40:29', '2024-07-25 06:40:29'),
(2148, 2321, 'STD-00148', '1OQM343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:40:29', '2024-07-25 06:40:29'),
(2149, 2322, 'STD-00149', 'YRIq343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:40:29', '2024-07-25 06:40:29'),
(2150, 2323, 'STD-00150', 'LbWk343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:40:29', '2024-07-25 06:40:29'),
(2151, 2324, 'STD-00151', 'vMYp343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:40:29', '2024-07-25 06:40:29'),
(2152, 2325, 'STD-00152', 'yydU343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:40:29', '2024-07-25 06:40:29'),
(2153, 2326, 'STD-00153', 'xw5l343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:40:29', '2024-07-25 06:40:29'),
(2154, 2327, 'STD-00154', '8b3x343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:40:29', '2024-07-25 06:40:29'),
(2155, 2328, 'STD-00155', 'P1K2343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:40:29', '2024-07-25 06:40:29'),
(2156, 2329, 'STD-00156', '81lk343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:40:29', '2024-07-25 06:40:29'),
(2157, 2330, 'STD-00157', 'OM6B343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:40:29', '2024-07-25 06:40:29'),
(2158, 2331, 'STD-00158', 'zQfB343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:40:29', '2024-07-25 06:40:29'),
(2159, 2332, 'STD-00159', 'i0OC343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:40:29', '2024-07-25 06:40:29'),
(2160, 2333, 'STD-00160', '5b6t343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:40:29', '2024-07-25 06:40:29'),
(2161, 2334, 'STD-00161', 'wytZ343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:40:30', '2024-07-25 06:40:30'),
(2162, 2335, 'STD-00162', 'zng3343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:40:30', '2024-07-25 06:40:30'),
(2163, 2336, 'STD-00163', 'ppuO343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:40:30', '2024-07-25 06:40:30'),
(2164, 2337, 'STD-00164', 'Ncs9343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:40:30', '2024-07-25 06:40:30'),
(2165, 2338, 'STD-00165', 'tbUk343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:40:30', '2024-07-25 06:40:30'),
(2166, 2339, 'STD-00166', 'SlZm343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:40:30', '2024-07-25 06:40:30'),
(2167, 2340, 'STD-00167', 'bGdJ343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:40:30', '2024-07-25 06:40:30'),
(2168, 2341, 'STD-00168', 'PTZQ343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:40:30', '2024-07-25 06:40:30'),
(2169, 2342, 'STD-00169', 'DMj4343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:40:30', '2024-07-25 06:40:30'),
(2170, 2343, 'STD-00170', 'ji5R343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:40:30', '2024-07-25 06:40:30'),
(2171, 2344, 'STD-00171', '0HCu343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:40:30', '2024-07-25 06:40:30'),
(2172, 2345, 'STD-00172', 'wMHl343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:40:30', '2024-07-25 06:40:30'),
(2173, 2346, 'STD-00173', 'IzkJ343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:40:30', '2024-07-25 06:40:30'),
(2174, 2347, 'STD-00174', 'Mw1x343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:40:30', '2024-07-25 06:40:30'),
(2175, 2348, 'STD-00175', 'cKy8343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:40:31', '2024-07-25 06:40:31'),
(2176, 2349, 'STD-00176', 'NNix343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:40:31', '2024-07-25 06:40:31'),
(2177, 2350, 'STD-00177', 'FW8Z343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:40:31', '2024-07-25 06:40:31'),
(2178, 2351, 'STD-00178', '9tQA343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:09', '2024-07-25 06:41:09'),
(2179, 2352, 'STD-00179', 'kSO7343433n43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:09', '2024-07-25 06:41:09'),
(2180, 2353, 'STD-00180', 'sC7z343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:09', '2024-07-25 06:41:09'),
(2181, 2354, 'STD-00181', 'sJLu343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:09', '2024-07-25 06:41:09'),
(2182, 2355, 'STD-00182', 'GJrM343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:09', '2024-07-25 06:41:09'),
(2183, 2356, 'STD-00183', 'YBUl343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:09', '2024-07-25 06:41:09'),
(2184, 2357, 'STD-00184', 'JaRx343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:09', '2024-07-25 06:41:09'),
(2185, 2358, 'STD-00185', 'ixRt343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:09', '2024-07-25 06:41:09'),
(2186, 2359, 'STD-00186', 'MX8g343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:09', '2024-07-25 06:41:09'),
(2187, 2360, 'STD-00187', 'bsxy343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:09', '2024-07-25 06:41:09'),
(2188, 2361, 'STD-00188', 'EcG1343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:09', '2024-07-25 06:41:09'),
(2189, 2362, 'STD-00189', 'i0QK343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:09', '2024-07-25 06:41:09'),
(2190, 2363, 'STD-00190', 'FfRk343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:09', '2024-07-25 06:41:09'),
(2191, 2364, 'STD-00191', 'YuW0343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:10', '2024-07-25 06:41:10'),
(2192, 2365, 'STD-00192', '2jKd343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:10', '2024-07-25 06:41:10'),
(2193, 2366, 'STD-00193', 'gue8343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:10', '2024-07-25 06:41:10'),
(2194, 2367, 'STD-00194', 'qbvv343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:10', '2024-07-25 06:41:10'),
(2195, 2368, 'STD-00195', 'w2Ut343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:10', '2024-07-25 06:41:10'),
(2196, 2369, 'STD-00196', 'BAAM343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:10', '2024-07-25 06:41:10'),
(2197, 2370, 'STD-00197', 'z8VK343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:10', '2024-07-25 06:41:10'),
(2198, 2371, 'STD-00198', 'Gxzr343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:10', '2024-07-25 06:41:10'),
(2199, 2372, 'STD-00199', 'kwEo343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:10', '2024-07-25 06:41:10'),
(2200, 2373, 'STD-00200', 'MxlI343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:10', '2024-07-25 06:41:10'),
(2201, 2374, 'STD-00201', 'GdF8343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:10', '2024-07-25 06:41:10'),
(2202, 2375, 'STD-00202', 'zm33343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:10', '2024-07-25 06:41:10'),
(2203, 2376, 'STD-00203', 'IUji343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:10', '2024-07-25 06:41:10'),
(2204, 2377, 'STD-00204', 'LOmv343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:10', '2024-07-25 06:41:10'),
(2205, 2378, 'STD-00205', '9ijl343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:10', '2024-07-25 06:41:10'),
(2206, 2379, 'STD-00206', 'ucj3343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:11', '2024-07-25 06:41:11'),
(2207, 2380, 'STD-00207', '7TZB343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:11', '2024-07-25 06:41:11'),
(2208, 2381, 'STD-00208', 'OXbb343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:11', '2024-07-25 06:41:11'),
(2209, 2382, 'STD-00209', 'dBmm343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:11', '2024-07-25 06:41:11'),
(2210, 2383, 'STD-00210', 'h49S343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:11', '2024-07-25 06:41:11'),
(2211, 2384, 'STD-00211', '9DtW343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:11', '2024-07-25 06:41:11'),
(2212, 2385, 'STD-00212', '3W5P343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:11', '2024-07-25 06:41:11'),
(2213, 2386, 'STD-00213', 'ITzS343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:11', '2024-07-25 06:41:11'),
(2214, 2387, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2020', 'islam', 'Indonesian', '2024-07-25 06:41:14', '2024-07-25 06:41:14'),
(2215, 2388, 'STD-00214', '7ZwZ343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:21', '2024-07-25 06:41:21'),
(2216, 2389, 'STD-00215', 'JmTF343433n43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:21', '2024-07-25 06:41:21'),
(2217, 2390, 'STD-00216', 'AGhu343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:21', '2024-07-25 06:41:21'),
(2218, 2391, 'STD-00217', 'SbBv343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:21', '2024-07-25 06:41:21'),
(2219, 2392, 'STD-00218', '3NbL343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:22', '2024-07-25 06:41:22'),
(2220, 2393, 'STD-00219', 'hxZI343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:22', '2024-07-25 06:41:22'),
(2221, 2394, 'STD-00220', 'v3mj343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:22', '2024-07-25 06:41:22'),
(2222, 2395, 'STD-00221', 'Jd4U343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:22', '2024-07-25 06:41:22'),
(2223, 2396, 'STD-00222', 'kdug343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:22', '2024-07-25 06:41:22'),
(2224, 2397, 'STD-00223', 'oBlo343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:22', '2024-07-25 06:41:22'),
(2225, 2398, 'STD-00224', 'komx343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:22', '2024-07-25 06:41:22');
INSERT INTO `user_profiles` (`id`, `user_id`, `student_id`, `roll_no`, `session`, `plan_id`, `note`, `blood_group`, `physical_disability`, `previous_school_name`, `previous_school_year_of_exist`, `national_identification_number`, `bank_name`, `bank_account_number`, `highest_degree_name`, `institute_name`, `passing_year`, `religion`, `nationality`, `created_at`, `updated_at`) VALUES
(2226, 2399, 'STD-00225', 'cQ64343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:22', '2024-07-25 06:41:22'),
(2227, 2400, 'STD-00226', 'JVG9343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:22', '2024-07-25 06:41:22'),
(2228, 2401, 'STD-00227', 'Y79f343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:22', '2024-07-25 06:41:22'),
(2229, 2402, 'STD-00228', '2WhI343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:22', '2024-07-25 06:41:22'),
(2230, 2403, 'STD-00229', 'xzdf343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:22', '2024-07-25 06:41:22'),
(2231, 2404, 'STD-00230', '17Ra343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:23', '2024-07-25 06:41:23'),
(2232, 2405, 'STD-00231', 'bguA343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:23', '2024-07-25 06:41:23'),
(2233, 2406, 'STD-00232', 'lmBO343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:23', '2024-07-25 06:41:23'),
(2234, 2407, 'STD-00233', '3Zux343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:23', '2024-07-25 06:41:23'),
(2235, 2408, 'STD-00234', '528a343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:23', '2024-07-25 06:41:23'),
(2236, 2409, 'STD-00235', 'lx28343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:23', '2024-07-25 06:41:23'),
(2237, 2410, 'STD-00236', 'wa4C343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:23', '2024-07-25 06:41:23'),
(2238, 2411, 'STD-00237', '2OUH343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:23', '2024-07-25 06:41:23'),
(2239, 2412, 'STD-00238', 'b4rT343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:23', '2024-07-25 06:41:23'),
(2240, 2413, 'STD-00239', 'NIg9343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:23', '2024-07-25 06:41:23'),
(2241, 2414, 'STD-00240', '8SWI343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:23', '2024-07-25 06:41:23'),
(2242, 2415, 'STD-00241', '67Pm343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:23', '2024-07-25 06:41:23'),
(2243, 2416, 'STD-00242', 'rjQ6343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:23', '2024-07-25 06:41:23'),
(2244, 2417, 'STD-00243', 'jrPE343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:23', '2024-07-25 06:41:23'),
(2245, 2418, 'STD-00244', '9MAS343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:24', '2024-07-25 06:41:24'),
(2246, 2419, 'STD-00245', '23Fi343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:24', '2024-07-25 06:41:24'),
(2247, 2420, 'STD-00246', 'kRmn343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:24', '2024-07-25 06:41:24'),
(2248, 2421, 'STD-00247', 'B8rk343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:24', '2024-07-25 06:41:24'),
(2249, 2422, 'STD-00248', 'SorH343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:24', '2024-07-25 06:41:24'),
(2250, 2423, 'STD-00249', 'gAmu343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:24', '2024-07-25 06:41:24'),
(2251, 2424, 'STD-00250', 'NzCC343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:34', '2024-07-25 06:41:34'),
(2252, 2425, 'STD-00251', 'Ug4i343433n43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:34', '2024-07-25 06:41:34'),
(2253, 2426, 'STD-00252', '1H2K343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:34', '2024-07-25 06:41:34'),
(2254, 2427, 'STD-00253', 'ruu9343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:34', '2024-07-25 06:41:34'),
(2255, 2428, 'STD-00254', 'FP2o343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:34', '2024-07-25 06:41:34'),
(2256, 2429, 'STD-00255', 'oQPH343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:34', '2024-07-25 06:41:34'),
(2257, 2430, 'STD-00256', 'JwyK343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:34', '2024-07-25 06:41:34'),
(2258, 2431, 'STD-00257', 'LP7V343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:34', '2024-07-25 06:41:34'),
(2259, 2432, 'STD-00258', 'w1QO343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:34', '2024-07-25 06:41:34'),
(2260, 2433, 'STD-00259', 'g98p343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:34', '2024-07-25 06:41:34'),
(2261, 2434, 'STD-00260', 'LnZU343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:34', '2024-07-25 06:41:34'),
(2262, 2435, 'STD-00261', 'Kcb3343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:34', '2024-07-25 06:41:34'),
(2263, 2436, 'STD-00262', 'R3UJ343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:35', '2024-07-25 06:41:35'),
(2264, 2437, 'STD-00263', 'yXlA343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:35', '2024-07-25 06:41:35'),
(2265, 2438, 'STD-00264', 'jr0k343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:35', '2024-07-25 06:41:35'),
(2266, 2439, 'STD-00265', 'pE0I343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:35', '2024-07-25 06:41:35'),
(2267, 2440, 'STD-00266', 'DonB343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:35', '2024-07-25 06:41:35'),
(2268, 2441, 'STD-00267', '5z98343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:35', '2024-07-25 06:41:35'),
(2269, 2442, 'STD-00268', 'VrXc343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:35', '2024-07-25 06:41:35'),
(2270, 2443, 'STD-00269', 'cCrY343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:35', '2024-07-25 06:41:35'),
(2271, 2444, 'STD-00270', 'x34o343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:35', '2024-07-25 06:41:35'),
(2272, 2445, 'STD-00271', 'Xc1M343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:35', '2024-07-25 06:41:35'),
(2273, 2446, 'STD-00272', 'Bmwf343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:35', '2024-07-25 06:41:35'),
(2274, 2447, 'STD-00273', '3iVX343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:35', '2024-07-25 06:41:35'),
(2275, 2448, 'STD-00274', 'praM343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:35', '2024-07-25 06:41:35'),
(2276, 2449, 'STD-00275', '5Sbq343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:35', '2024-07-25 06:41:35'),
(2277, 2450, 'STD-00276', 'Bd8Q343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:35', '2024-07-25 06:41:35'),
(2278, 2451, 'STD-00277', '6Bsf343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:36', '2024-07-25 06:41:36'),
(2279, 2452, 'STD-00278', 'HsQA343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:36', '2024-07-25 06:41:36'),
(2280, 2453, 'STD-00279', 'LSTu343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:36', '2024-07-25 06:41:36'),
(2281, 2454, 'STD-00280', '5w1y343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:36', '2024-07-25 06:41:36'),
(2282, 2455, 'STD-00281', 'GbQT343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:36', '2024-07-25 06:41:36'),
(2283, 2456, 'STD-00282', 'RRjk343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:36', '2024-07-25 06:41:36'),
(2284, 2457, 'STD-00283', 'BvUw343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:36', '2024-07-25 06:41:36'),
(2285, 2458, 'STD-00284', '4SLb343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:36', '2024-07-25 06:41:36'),
(2286, 2459, 'STD-00285', 'k9o2343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:36', '2024-07-25 06:41:36'),
(2287, 2460, 'STD-00286', 'MwwH343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:48', '2024-07-25 06:41:48'),
(2288, 2461, 'STD-00287', '9vKS343433n43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:49', '2024-07-25 06:41:49'),
(2289, 2462, 'STD-00288', 'IRYS343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:49', '2024-07-25 06:41:49'),
(2290, 2463, 'STD-00289', 'QeAR343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:49', '2024-07-25 06:41:49'),
(2291, 2464, 'STD-00290', 'rvDN343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:49', '2024-07-25 06:41:49'),
(2292, 2465, 'STD-00291', 'Ue2M343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:49', '2024-07-25 06:41:49'),
(2293, 2466, 'STD-00292', 'xBF3343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:49', '2024-07-25 06:41:49'),
(2294, 2467, 'STD-00293', 'H3az343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:49', '2024-07-25 06:41:49'),
(2295, 2468, 'STD-00294', 'jxni343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:49', '2024-07-25 06:41:49'),
(2296, 2469, 'STD-00295', 'kYwH343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:49', '2024-07-25 06:41:49'),
(2297, 2470, 'STD-00296', 'sx2i343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:49', '2024-07-25 06:41:49'),
(2298, 2471, 'STD-00297', 'W5V1343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:49', '2024-07-25 06:41:49'),
(2299, 2472, 'STD-00298', 'QuzX343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:49', '2024-07-25 06:41:49'),
(2300, 2473, 'STD-00299', 'gjhW343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:49', '2024-07-25 06:41:49'),
(2301, 2474, 'STD-00300', '1KNj343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:49', '2024-07-25 06:41:49'),
(2302, 2475, 'STD-00301', 'pwtD343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:49', '2024-07-25 06:41:49'),
(2303, 2476, 'STD-00302', 'A5D6343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:50', '2024-07-25 06:41:50'),
(2304, 2477, 'STD-00303', 'QVrK343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:50', '2024-07-25 06:41:50'),
(2305, 2478, 'STD-00304', 'mYPB343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:50', '2024-07-25 06:41:50'),
(2306, 2479, 'STD-00305', 'GCIk343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:50', '2024-07-25 06:41:50'),
(2307, 2480, 'STD-00306', 'ui1X343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:50', '2024-07-25 06:41:50'),
(2308, 2481, 'STD-00307', 'VIO4343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:50', '2024-07-25 06:41:50'),
(2309, 2482, 'STD-00308', 'ElSj343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:50', '2024-07-25 06:41:50'),
(2310, 2483, 'STD-00309', 'AY2Y343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:50', '2024-07-25 06:41:50'),
(2311, 2484, 'STD-00310', 'YJ6W343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:50', '2024-07-25 06:41:50'),
(2312, 2485, 'STD-00311', 'wZ6q343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:50', '2024-07-25 06:41:50'),
(2313, 2486, 'STD-00312', 'enej343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:50', '2024-07-25 06:41:50'),
(2314, 2487, 'STD-00313', 'ypSp343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:50', '2024-07-25 06:41:50'),
(2315, 2488, 'STD-00314', 'uu5d343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:50', '2024-07-25 06:41:50'),
(2316, 2489, 'STD-00315', 'ISB4343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:50', '2024-07-25 06:41:50'),
(2317, 2490, 'STD-00316', 'RlwA343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:51', '2024-07-25 06:41:51'),
(2318, 2491, 'STD-00317', '0TPm343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:51', '2024-07-25 06:41:51'),
(2319, 2492, 'STD-00318', 'qAzM343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:51', '2024-07-25 06:41:51'),
(2320, 2493, 'STD-00319', 'oJDk343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:51', '2024-07-25 06:41:51'),
(2321, 2494, 'STD-00320', 'P4S7343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:51', '2024-07-25 06:41:51'),
(2322, 2495, 'STD-00321', 'wkwr343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:51', '2024-07-25 06:41:51'),
(2323, 2496, 'STD-00322', 'kKqF343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:59', '2024-07-25 06:41:59'),
(2324, 2497, 'STD-00323', 'GPbj343433n43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:41:59', '2024-07-25 06:41:59'),
(2325, 2498, 'STD-00324', 'WAfU343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:42:00', '2024-07-25 06:42:00'),
(2326, 2499, 'STD-00325', 'lMbt343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:42:00', '2024-07-25 06:42:00'),
(2327, 2500, 'STD-00326', 'qnC5343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:42:00', '2024-07-25 06:42:00'),
(2328, 2501, 'STD-00327', '9MoQ343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:42:00', '2024-07-25 06:42:00'),
(2329, 2502, 'STD-00328', 'Bfdq343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:42:00', '2024-07-25 06:42:00'),
(2330, 2503, 'STD-00329', 'HTX3343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:42:00', '2024-07-25 06:42:00'),
(2331, 2504, 'STD-00330', 'n139343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:42:00', '2024-07-25 06:42:00'),
(2332, 2505, 'STD-00331', 'aDyo343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:42:00', '2024-07-25 06:42:00'),
(2333, 2506, 'STD-00332', 'QUl2343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:42:00', '2024-07-25 06:42:00'),
(2334, 2507, 'STD-00333', 'q2n2343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:42:00', '2024-07-25 06:42:00'),
(2335, 2508, 'STD-00334', 'TNqV343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:42:00', '2024-07-25 06:42:00'),
(2336, 2509, 'STD-00335', 'o5mF343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:42:00', '2024-07-25 06:42:00'),
(2337, 2510, 'STD-00336', 'QX2I343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:42:00', '2024-07-25 06:42:00'),
(2338, 2511, 'STD-00337', 'DIX8343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:42:01', '2024-07-25 06:42:01'),
(2339, 2512, 'STD-00338', 'ephL343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:42:01', '2024-07-25 06:42:01'),
(2340, 2513, 'STD-00339', 'uZhX343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:42:01', '2024-07-25 06:42:01'),
(2341, 2514, 'STD-00340', 'NRef343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:42:01', '2024-07-25 06:42:01'),
(2342, 2515, 'STD-00341', 'LFNL343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:42:01', '2024-07-25 06:42:01'),
(2343, 2516, 'STD-00342', 'GHir343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:42:01', '2024-07-25 06:42:01'),
(2344, 2517, 'STD-00343', 'vQlG343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:42:01', '2024-07-25 06:42:01'),
(2345, 2518, 'STD-00344', 'LGum343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:42:01', '2024-07-25 06:42:01'),
(2346, 2519, 'STD-00345', '9p7t343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:42:01', '2024-07-25 06:42:01'),
(2347, 2520, 'STD-00346', 'ANnd343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:42:01', '2024-07-25 06:42:01'),
(2348, 2521, 'STD-00347', 'ualT343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:42:01', '2024-07-25 06:42:01'),
(2349, 2522, 'STD-00348', '4VoR343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:42:01', '2024-07-25 06:42:01'),
(2350, 2523, 'STD-00349', 'UhD4343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:42:02', '2024-07-25 06:42:02'),
(2351, 2524, 'STD-00350', 'P9Xq343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:42:02', '2024-07-25 06:42:02'),
(2352, 2525, 'STD-00351', '6yVI343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:42:02', '2024-07-25 06:42:02'),
(2353, 2526, 'STD-00352', 'me5o343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:42:02', '2024-07-25 06:42:02'),
(2354, 2527, 'STD-00353', 'umTz343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:42:02', '2024-07-25 06:42:02'),
(2355, 2528, 'STD-00354', 'KF7a343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:42:02', '2024-07-25 06:42:02'),
(2356, 2529, 'STD-00355', 'odGz343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:42:02', '2024-07-25 06:42:02'),
(2357, 2530, 'STD-00356', 'ytWP343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:42:02', '2024-07-25 06:42:02'),
(2358, 2531, 'STD-00357', 'N8vl343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 06:42:02', '2024-07-25 06:42:02'),
(2359, 2532, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2020', 'islam', 'Indonesian', '2024-07-25 06:43:49', '2024-07-25 06:43:49'),
(2361, 2534, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2020', 'islam', 'Indonesian', '2024-07-25 06:47:02', '2024-07-25 06:47:02'),
(2398, 2572, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2020', 'islam', 'Indonesian', '2024-07-25 06:59:11', '2024-07-25 06:59:11'),
(2431, 2606, 'STD-00358', '6NTJ343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:02:38', '2024-07-25 07:02:38'),
(2432, 2607, 'STD-00359', 'Xh2z343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:02:38', '2024-07-25 07:02:38'),
(2433, 2608, 'STD-00360', 'a8H8343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:02:38', '2024-07-25 07:02:38'),
(2434, 2609, 'STD-00361', 'QgFa343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:02:39', '2024-07-25 07:02:39'),
(2435, 2610, 'STD-00362', 'S7hZ343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:02:39', '2024-07-25 07:02:39'),
(2436, 2611, 'STD-00363', 'IEVg343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:02:39', '2024-07-25 07:02:39'),
(2437, 2612, 'STD-00364', '73uu343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:02:39', '2024-07-25 07:02:39'),
(2438, 2613, 'STD-00365', 'pPuf343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:02:39', '2024-07-25 07:02:39'),
(2439, 2614, 'STD-00366', 'ZTQI343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:02:39', '2024-07-25 07:02:39'),
(2440, 2615, 'STD-00367', 'at8g343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:02:39', '2024-07-25 07:02:39'),
(2441, 2616, 'STD-00368', '6VIz343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:02:39', '2024-07-25 07:02:39'),
(2442, 2617, 'STD-00369', 'HzL9343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:02:39', '2024-07-25 07:02:39'),
(2443, 2618, 'STD-00370', 'XXxN343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:02:39', '2024-07-25 07:02:39'),
(2444, 2619, 'STD-00371', 'GQu2343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:02:39', '2024-07-25 07:02:39'),
(2445, 2620, 'STD-00372', 'YaAi343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:02:39', '2024-07-25 07:02:39'),
(2446, 2621, 'STD-00373', 'zU7x343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:02:39', '2024-07-25 07:02:39'),
(2447, 2622, 'STD-00374', 'QOpp343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:02:40', '2024-07-25 07:02:40'),
(2448, 2623, 'STD-00375', 'gPpy343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:02:40', '2024-07-25 07:02:40'),
(2449, 2624, 'STD-00376', 'JCup343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:02:40', '2024-07-25 07:02:40'),
(2450, 2625, 'STD-00377', 'xLGJ343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:02:40', '2024-07-25 07:02:40'),
(2451, 2626, 'STD-00378', '2XNw343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:02:40', '2024-07-25 07:02:40'),
(2452, 2627, 'STD-00379', '7L2Y343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:02:40', '2024-07-25 07:02:40'),
(2453, 2628, 'STD-00380', 'UWw7343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:02:40', '2024-07-25 07:02:40'),
(2454, 2629, 'STD-00381', '4aus343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:02:40', '2024-07-25 07:02:40'),
(2455, 2630, 'STD-00382', 'J6Xe343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:02:40', '2024-07-25 07:02:40'),
(2456, 2631, 'STD-00383', 'kX5L343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:02:40', '2024-07-25 07:02:40'),
(2457, 2632, 'STD-00384', 'hX3k343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:02:40', '2024-07-25 07:02:40'),
(2458, 2633, 'STD-00385', 'wQAP343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:02:40', '2024-07-25 07:02:40'),
(2459, 2634, 'STD-00386', '1YwW343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:02:40', '2024-07-25 07:02:40'),
(2460, 2635, 'STD-00387', 'OnAy343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:02:40', '2024-07-25 07:02:40'),
(2461, 2636, 'STD-00388', '5TKA343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:02:41', '2024-07-25 07:02:41'),
(2462, 2637, 'STD-00389', '4bTm343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:02:41', '2024-07-25 07:02:41'),
(2495, 2670, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2020', 'islam', 'Indonesian', '2024-07-25 07:04:42', '2024-07-25 07:04:42'),
(2496, 2671, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2024', 'islam', 'Indonesian', '2024-07-25 07:08:07', '2024-07-25 07:08:07'),
(2498, 2673, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2020', 'islam', 'Indonesian', '2024-07-25 07:11:34', '2024-07-25 07:11:34'),
(2499, 2674, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2020', 'islam', 'Indonesian', '2024-07-25 07:15:00', '2024-07-25 07:15:00'),
(2500, 2675, 'STD-00422', 'yAtK343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:15:57', '2024-07-25 07:15:57'),
(2501, 2676, 'STD-00423', 'syPh343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:15:57', '2024-07-25 07:15:57'),
(2502, 2677, 'STD-00424', '0JlE343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:15:57', '2024-07-25 07:15:57'),
(2503, 2678, 'STD-00425', '4OMI343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:15:57', '2024-07-25 07:15:57'),
(2504, 2679, 'STD-00426', 'Ucdb343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:15:57', '2024-07-25 07:15:57'),
(2505, 2680, 'STD-00427', 'nIqd343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:15:57', '2024-07-25 07:15:57'),
(2506, 2681, 'STD-00428', 'KQ9p343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:15:57', '2024-07-25 07:15:57'),
(2507, 2682, 'STD-00429', 'oxiF343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:15:57', '2024-07-25 07:15:57'),
(2508, 2683, 'STD-00430', 'o7Gy343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:15:58', '2024-07-25 07:15:58'),
(2509, 2684, 'STD-00431', 'ug9d343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:15:58', '2024-07-25 07:15:58'),
(2510, 2685, 'STD-00432', 'qOPV343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:15:58', '2024-07-25 07:15:58'),
(2511, 2686, 'STD-00433', 'rmCd343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:15:58', '2024-07-25 07:15:58'),
(2512, 2687, 'STD-00434', 'YUxP343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:15:58', '2024-07-25 07:15:58'),
(2513, 2688, 'STD-00435', 'Xv0J343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:15:58', '2024-07-25 07:15:58'),
(2514, 2689, 'STD-00436', 'XtIp343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:15:58', '2024-07-25 07:15:58'),
(2515, 2690, 'STD-00437', 'oyVZ343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:15:58', '2024-07-25 07:15:58'),
(2516, 2691, 'STD-00438', 'cuL6343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:15:58', '2024-07-25 07:15:58'),
(2517, 2692, 'STD-00439', 'bsL8343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:15:58', '2024-07-25 07:15:58'),
(2518, 2693, 'STD-00440', '84L6343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:15:58', '2024-07-25 07:15:58'),
(2519, 2694, 'STD-00441', 'DN0w343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:15:58', '2024-07-25 07:15:58'),
(2520, 2695, 'STD-00442', 'BDA2343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:15:58', '2024-07-25 07:15:58'),
(2521, 2696, 'STD-00443', 'QYTh343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:15:58', '2024-07-25 07:15:58'),
(2522, 2697, 'STD-00444', '0lTl343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:15:59', '2024-07-25 07:15:59'),
(2523, 2698, 'STD-00445', 'w9jK343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:15:59', '2024-07-25 07:15:59'),
(2524, 2699, 'STD-00446', 'EQ2J343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:15:59', '2024-07-25 07:15:59'),
(2525, 2700, 'STD-00447', 'jrk7343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:15:59', '2024-07-25 07:15:59'),
(2526, 2701, 'STD-00448', 'G2d7343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:15:59', '2024-07-25 07:15:59'),
(2527, 2702, 'STD-00449', 'jo6I343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:15:59', '2024-07-25 07:15:59'),
(2528, 2703, 'STD-00450', 'lUTn343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:15:59', '2024-07-25 07:15:59'),
(2529, 2704, 'STD-00451', 'V2W1343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:15:59', '2024-07-25 07:15:59'),
(2530, 2705, 'STD-00452', '3JMK343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:15:59', '2024-07-25 07:15:59'),
(2531, 2706, 'STD-00453', 'Rbz3343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:15:59', '2024-07-25 07:15:59'),
(2532, 2707, 'STD-00454', 'Jzyw343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:15:59', '2024-07-25 07:15:59'),
(2533, 2708, 'STD-00455', 'kub2343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:15:59', '2024-07-25 07:15:59'),
(2534, 2709, 'STD-00456', '75CE343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:15:59', '2024-07-25 07:15:59'),
(2535, 2710, 'STD-00457', 'ES0d343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:15:59', '2024-07-25 07:15:59'),
(2536, 2711, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2023', 'islam', 'Indonesian', '2024-07-25 07:20:03', '2024-07-25 07:20:03'),
(2573, 2749, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2021', 'islam', 'Indonesian', '2024-07-25 07:23:08', '2024-07-25 07:23:08'),
(2574, 2750, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2022', 'islam', 'Indonesian', '2024-07-25 07:25:27', '2024-07-25 07:25:27'),
(2575, 2751, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2023', 'islam', 'Indonesian', '2024-07-25 07:28:00', '2024-07-25 07:28:00'),
(2576, 2752, 'STD-00458', 'OYzY343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:28:05', '2024-07-25 07:28:05'),
(2577, 2753, 'STD-00459', 'uAj3343433n43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:28:05', '2024-07-25 07:28:05'),
(2578, 2754, 'STD-00460', 'rI4C343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:28:05', '2024-07-25 07:28:05'),
(2579, 2755, 'STD-00461', 'LBiw343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:28:05', '2024-07-25 07:28:05'),
(2580, 2756, 'STD-00462', 'oyAx343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:28:06', '2024-07-25 07:28:06'),
(2581, 2757, 'STD-00463', 'xLly343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:28:06', '2024-07-25 07:28:06'),
(2582, 2758, 'STD-00464', 'dNyo343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:28:06', '2024-07-25 07:28:06'),
(2583, 2759, 'STD-00465', 'k0FA343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:28:06', '2024-07-25 07:28:06'),
(2584, 2760, 'STD-00466', '9Bus343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:28:06', '2024-07-25 07:28:06'),
(2585, 2761, 'STD-00467', 'XGgm343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:28:06', '2024-07-25 07:28:06'),
(2586, 2762, 'STD-00468', 'LezT343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:28:06', '2024-07-25 07:28:06'),
(2587, 2763, 'STD-00469', 'giKM343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:28:06', '2024-07-25 07:28:06'),
(2588, 2764, 'STD-00470', 'XVCx343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:28:06', '2024-07-25 07:28:06'),
(2589, 2765, 'STD-00471', 'zGVN343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:28:06', '2024-07-25 07:28:06'),
(2590, 2766, 'STD-00472', 'zhXZ343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:28:06', '2024-07-25 07:28:06'),
(2591, 2767, 'STD-00473', 'H8ne343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:28:06', '2024-07-25 07:28:06'),
(2592, 2768, 'STD-00474', 'gmts343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:28:06', '2024-07-25 07:28:06'),
(2593, 2769, 'STD-00475', '5e1H343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:28:06', '2024-07-25 07:28:06'),
(2594, 2770, 'STD-00476', 'xvg7343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:28:07', '2024-07-25 07:28:07'),
(2595, 2771, 'STD-00477', 'Vi9u343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:28:07', '2024-07-25 07:28:07'),
(2596, 2772, 'STD-00478', 'e9pj343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:28:07', '2024-07-25 07:28:07'),
(2597, 2773, 'STD-00479', 'QUDg343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:28:07', '2024-07-25 07:28:07'),
(2598, 2774, 'STD-00480', 'fh4b343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:28:07', '2024-07-25 07:28:07'),
(2599, 2775, 'STD-00481', 'iURu343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:28:07', '2024-07-25 07:28:07'),
(2600, 2776, 'STD-00482', 'AzPx343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:28:07', '2024-07-25 07:28:07'),
(2601, 2777, 'STD-00483', '4IPJ343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:28:07', '2024-07-25 07:28:07'),
(2602, 2778, 'STD-00484', 'Eh4v343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:28:07', '2024-07-25 07:28:07'),
(2603, 2779, 'STD-00485', 'gvKY343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:28:07', '2024-07-25 07:28:07'),
(2604, 2780, 'STD-00486', '0Ahe343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:28:07', '2024-07-25 07:28:07'),
(2605, 2781, 'STD-00487', 'gFBA343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:28:07', '2024-07-25 07:28:07'),
(2606, 2782, 'STD-00488', 'Cbvr343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:28:07', '2024-07-25 07:28:07'),
(2607, 2783, 'STD-00489', 'YVve343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:28:07', '2024-07-25 07:28:07'),
(2608, 2784, 'STD-00490', 'VRsa343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:28:07', '2024-07-25 07:28:07'),
(2609, 2785, 'STD-00491', 'yHDM343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:28:08', '2024-07-25 07:28:08'),
(2610, 2786, 'STD-00492', 'l6kg343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:28:08', '2024-07-25 07:28:08'),
(2611, 2787, 'STD-00493', '8zrl343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:28:08', '2024-07-25 07:28:08'),
(2612, 2788, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2027', 'islam', 'Indonesian', '2024-07-25 07:32:29', '2024-07-25 07:32:29'),
(2622, 2798, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2020', 'islam', 'Indonesian', '2024-07-25 07:36:53', '2024-07-25 07:36:53'),
(2623, 2799, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2021', 'islam', 'Indonesian', '2024-07-25 07:40:10', '2024-07-25 07:40:10'),
(2771, 2951, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2023', 'islam', 'Indonesian', '2024-07-25 07:44:50', '2024-07-25 07:44:50'),
(2772, 2952, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2026', 'islam', 'Indonesian', '2024-07-25 07:48:07', '2024-07-25 07:48:07'),
(2773, 2953, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2021', 'islam', 'Indonesian', '2024-07-25 07:52:10', '2024-07-25 07:52:10'),
(2774, 2954, 'STD-00494', 'p4Ew343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:54:42', '2024-07-25 07:54:42'),
(2775, 2955, 'STD-00495', 'QH4p343433n43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:54:43', '2024-07-25 07:54:43'),
(2776, 2956, 'STD-00496', 'e3p2343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:54:43', '2024-07-25 07:54:43'),
(2777, 2957, 'STD-00497', 'gwWC343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:54:43', '2024-07-25 07:54:43'),
(2778, 2958, 'STD-00498', '74iG343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:54:43', '2024-07-25 07:54:43'),
(2779, 2959, 'STD-00499', 'QS4H343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:54:43', '2024-07-25 07:54:43'),
(2780, 2960, 'STD-00500', 'FP6D343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:54:43', '2024-07-25 07:54:43'),
(2781, 2961, 'STD-00501', '32kU343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:54:43', '2024-07-25 07:54:43'),
(2782, 2962, 'STD-00502', 'mfSy343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:54:43', '2024-07-25 07:54:43'),
(2783, 2963, 'STD-00503', 'ITT5343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:54:43', '2024-07-25 07:54:43'),
(2784, 2964, 'STD-00504', '5ICo343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:54:43', '2024-07-25 07:54:43'),
(2785, 2965, 'STD-00505', 'oTfl343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:54:43', '2024-07-25 07:54:43'),
(2786, 2966, 'STD-00506', 'TpNb343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:54:43', '2024-07-25 07:54:43'),
(2787, 2967, 'STD-00507', '4knD343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:54:43', '2024-07-25 07:54:43'),
(2788, 2968, 'STD-00508', 'pgq2343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:54:43', '2024-07-25 07:54:43'),
(2789, 2969, 'STD-00509', 'pXcW343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:54:44', '2024-07-25 07:54:44'),
(2790, 2970, 'STD-00510', '4WL1343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:54:44', '2024-07-25 07:54:44'),
(2791, 2971, 'STD-00511', 'vwqs343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:54:44', '2024-07-25 07:54:44'),
(2792, 2972, 'STD-00512', 'C93c343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:54:44', '2024-07-25 07:54:44'),
(2793, 2973, 'STD-00513', 'Zpgt343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:54:44', '2024-07-25 07:54:44'),
(2794, 2974, 'STD-00514', 'Hnio343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:54:44', '2024-07-25 07:54:44'),
(2795, 2975, 'STD-00515', 'ZyJU343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:54:44', '2024-07-25 07:54:44'),
(2796, 2976, 'STD-00516', 'ICJN343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:54:44', '2024-07-25 07:54:44'),
(2797, 2977, 'STD-00517', 'AYk4343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:54:44', '2024-07-25 07:54:44');
INSERT INTO `user_profiles` (`id`, `user_id`, `student_id`, `roll_no`, `session`, `plan_id`, `note`, `blood_group`, `physical_disability`, `previous_school_name`, `previous_school_year_of_exist`, `national_identification_number`, `bank_name`, `bank_account_number`, `highest_degree_name`, `institute_name`, `passing_year`, `religion`, `nationality`, `created_at`, `updated_at`) VALUES
(2798, 2978, 'STD-00518', 'JrG9343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:54:44', '2024-07-25 07:54:44'),
(2799, 2979, 'STD-00519', 'aVGD343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:54:44', '2024-07-25 07:54:44'),
(2800, 2980, 'STD-00520', '9RYC343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:54:44', '2024-07-25 07:54:44'),
(2801, 2981, 'STD-00521', 'KR0N343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:54:44', '2024-07-25 07:54:44'),
(2802, 2982, 'STD-00522', 'XzMZ343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:54:45', '2024-07-25 07:54:45'),
(2803, 2983, 'STD-00523', 'lEu1343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:54:45', '2024-07-25 07:54:45'),
(2804, 2984, 'STD-00524', 'BoOw343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:54:45', '2024-07-25 07:54:45'),
(2805, 2985, 'STD-00525', 'Lbn4343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:54:45', '2024-07-25 07:54:45'),
(2806, 2986, 'STD-00526', 'DAzh343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:54:45', '2024-07-25 07:54:45'),
(2807, 2987, 'STD-00527', 'TgR0343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:54:45', '2024-07-25 07:54:45'),
(2808, 2988, 'STD-00528', 'tV5A343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:54:45', '2024-07-25 07:54:45'),
(2809, 2989, 'STD-00529', 'nxGt343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 07:54:45', '2024-07-25 07:54:45'),
(2810, 2990, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2026', 'islam', 'Indonesian', '2024-07-25 07:55:14', '2024-07-25 07:55:14'),
(2811, 2991, 'STD-00530', 'DhpW343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:00:17', '2024-07-25 08:00:17'),
(2812, 2992, 'STD-00531', 'Bzwh343433n43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:00:17', '2024-07-25 08:00:17'),
(2813, 2993, 'STD-00532', 'BvRh343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:00:17', '2024-07-25 08:00:17'),
(2814, 2994, 'STD-00533', 'njo0343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:00:17', '2024-07-25 08:00:17'),
(2815, 2995, 'STD-00534', 'cpIS343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:00:17', '2024-07-25 08:00:17'),
(2816, 2996, 'STD-00535', 'ohSq343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:00:17', '2024-07-25 08:00:17'),
(2817, 2997, 'STD-00536', 'aBht343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:00:18', '2024-07-25 08:00:18'),
(2818, 2998, 'STD-00537', 'CQ49343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:00:18', '2024-07-25 08:00:18'),
(2819, 2999, 'STD-00538', 'oYQN343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:00:18', '2024-07-25 08:00:18'),
(2820, 3000, 'STD-00539', '27vf343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:00:18', '2024-07-25 08:00:18'),
(2821, 3001, 'STD-00540', '5AFG343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:00:18', '2024-07-25 08:00:18'),
(2822, 3002, 'STD-00541', 'yMAt343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:00:18', '2024-07-25 08:00:18'),
(2823, 3003, 'STD-00542', 'gl6Z343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:00:18', '2024-07-25 08:00:18'),
(2824, 3004, 'STD-00543', '0KyL343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:00:18', '2024-07-25 08:00:18'),
(2825, 3005, 'STD-00544', 'KbIY343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:00:18', '2024-07-25 08:00:18'),
(2826, 3006, 'STD-00545', 'w8m7343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:00:18', '2024-07-25 08:00:18'),
(2827, 3007, 'STD-00546', '27nO343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:00:18', '2024-07-25 08:00:18'),
(2828, 3008, 'STD-00547', 'pTV8343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:00:18', '2024-07-25 08:00:18'),
(2829, 3009, 'STD-00548', 'HcXf343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:00:18', '2024-07-25 08:00:18'),
(2830, 3010, 'STD-00549', 'wy8B343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:00:19', '2024-07-25 08:00:19'),
(2831, 3011, 'STD-00550', 'vZC5343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:00:19', '2024-07-25 08:00:19'),
(2832, 3012, 'STD-00551', '8aPl343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:00:19', '2024-07-25 08:00:19'),
(2833, 3013, 'STD-00552', 'JOUM343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:00:19', '2024-07-25 08:00:19'),
(2834, 3014, 'STD-00553', 'vRE8343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:00:19', '2024-07-25 08:00:19'),
(2835, 3015, 'STD-00554', 'pKc7343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:00:19', '2024-07-25 08:00:19'),
(2836, 3016, 'STD-00555', 'ljsE343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:00:19', '2024-07-25 08:00:19'),
(2837, 3017, 'STD-00556', 'PPu3343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:00:19', '2024-07-25 08:00:19'),
(2838, 3018, 'STD-00557', 'vvDT343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:00:19', '2024-07-25 08:00:19'),
(2839, 3019, 'STD-00558', 'LCPv343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:00:19', '2024-07-25 08:00:19'),
(2840, 3020, 'STD-00559', 'yXKw343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:00:19', '2024-07-25 08:00:19'),
(2841, 3021, 'STD-00560', 'bhvb343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:00:19', '2024-07-25 08:00:19'),
(2842, 3022, 'STD-00561', 'Qzy5343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:00:19', '2024-07-25 08:00:19'),
(2843, 3023, 'STD-00562', 'MCuH343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:00:20', '2024-07-25 08:00:20'),
(2844, 3024, 'STD-00563', 'muDj343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:00:20', '2024-07-25 08:00:20'),
(2845, 3025, 'STD-00564', 'IQW0343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:00:20', '2024-07-25 08:00:20'),
(2846, 3026, 'STD-00565', 'EBTd343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:00:20', '2024-07-25 08:00:20'),
(2847, 3027, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2021', 'islam', 'Indonesian', '2024-07-25 08:00:55', '2024-07-25 08:00:55'),
(2848, 3028, 'STD-00566', 'iFfE343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:05:00', '2024-07-25 08:05:00'),
(2849, 3029, 'STD-00567', 'JEtk343433n43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:05:01', '2024-07-25 08:05:01'),
(2850, 3030, 'STD-00568', 'Be5A343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:05:01', '2024-07-25 08:05:01'),
(2851, 3031, 'STD-00569', 'KFSf343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:05:01', '2024-07-25 08:05:01'),
(2852, 3032, 'STD-00570', 'ScSi343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:05:01', '2024-07-25 08:05:01'),
(2853, 3033, 'STD-00571', 'Pa9T343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:05:01', '2024-07-25 08:05:01'),
(2854, 3034, 'STD-00572', '6yiN343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:05:01', '2024-07-25 08:05:01'),
(2855, 3035, 'STD-00573', '8fS1343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:05:01', '2024-07-25 08:05:01'),
(2856, 3036, 'STD-00574', 'HREa343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:05:01', '2024-07-25 08:05:01'),
(2857, 3037, 'STD-00575', 'x7I3343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:05:01', '2024-07-25 08:05:01'),
(2858, 3038, 'STD-00576', 'LIFL343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:05:02', '2024-07-25 08:05:02'),
(2859, 3039, 'STD-00577', '6Xhb343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:05:02', '2024-07-25 08:05:02'),
(2860, 3040, 'STD-00578', 'mb0H343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:05:02', '2024-07-25 08:05:02'),
(2861, 3041, 'STD-00579', 'ZpBu343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:05:02', '2024-07-25 08:05:02'),
(2862, 3042, 'STD-00580', 'xHRL343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:05:02', '2024-07-25 08:05:02'),
(2863, 3043, 'STD-00581', 'WE23343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:05:02', '2024-07-25 08:05:02'),
(2864, 3044, 'STD-00582', 'VqJM343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:05:02', '2024-07-25 08:05:02'),
(2865, 3045, 'STD-00583', 'QJ9n343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:05:02', '2024-07-25 08:05:02'),
(2866, 3046, 'STD-00584', 'vdhh343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:05:02', '2024-07-25 08:05:02'),
(2867, 3047, 'STD-00585', 'acd5343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:05:03', '2024-07-25 08:05:03'),
(2868, 3048, 'STD-00586', 'b2KM343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:05:03', '2024-07-25 08:05:03'),
(2869, 3049, 'STD-00587', 'X1ZR343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:05:03', '2024-07-25 08:05:03'),
(2870, 3050, 'STD-00588', 'lzRa343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:05:03', '2024-07-25 08:05:03'),
(2871, 3051, 'STD-00589', 'h3Nt343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:05:03', '2024-07-25 08:05:03'),
(2872, 3052, 'STD-00590', 'AbzA343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:05:03', '2024-07-25 08:05:03'),
(2873, 3053, 'STD-00591', 'V0WT343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:05:03', '2024-07-25 08:05:03'),
(2874, 3054, 'STD-00592', 'HMZF343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:05:03', '2024-07-25 08:05:03'),
(2875, 3055, 'STD-00593', 'H1yr343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:05:03', '2024-07-25 08:05:03'),
(2876, 3056, 'STD-00594', '9fWH343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:05:03', '2024-07-25 08:05:03'),
(2877, 3057, 'STD-00595', 'j7fx343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:05:04', '2024-07-25 08:05:04'),
(2878, 3058, 'STD-00596', '4Ctg343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:05:04', '2024-07-25 08:05:04'),
(2879, 3059, 'STD-00597', 'H6Fd343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:05:04', '2024-07-25 08:05:04'),
(2880, 3060, 'STD-00598', 'upRy343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:05:04', '2024-07-25 08:05:04'),
(2881, 3061, 'STD-00599', 'xOvk343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:05:04', '2024-07-25 08:05:04'),
(2882, 3062, 'STD-00600', 'hM1S343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:05:04', '2024-07-25 08:05:04'),
(2883, 3063, 'STD-00601', 'k4rt343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:05:04', '2024-07-25 08:05:04'),
(2884, 3064, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2020', 'islam', 'Indonesian', '2024-07-25 08:05:21', '2024-07-25 08:05:21'),
(2885, 3065, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2020', 'islam', 'Indonesian', '2024-07-25 08:09:32', '2024-07-25 08:09:32'),
(2886, 3066, 'STD-00602', 'F2so343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:10:01', '2024-07-25 08:10:01'),
(2887, 3067, 'STD-00603', 'IBUF343433n43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:10:01', '2024-07-25 08:10:01'),
(2888, 3068, 'STD-00604', 'uIOp343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:10:01', '2024-07-25 08:10:01'),
(2889, 3069, 'STD-00605', 'hZGJ343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:10:01', '2024-07-25 08:10:01'),
(2890, 3070, 'STD-00606', '6r4f343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:10:02', '2024-07-25 08:10:02'),
(2891, 3071, 'STD-00607', 'gHAE343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:10:02', '2024-07-25 08:10:02'),
(2892, 3072, 'STD-00608', '8o6q343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:10:02', '2024-07-25 08:10:02'),
(2893, 3073, 'STD-00609', 'Q8Tl343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:10:02', '2024-07-25 08:10:02'),
(2894, 3074, 'STD-00610', '9J62343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:10:02', '2024-07-25 08:10:02'),
(2895, 3075, 'STD-00611', 'csT3343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:10:02', '2024-07-25 08:10:02'),
(2896, 3076, 'STD-00612', '4Lgq343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:10:02', '2024-07-25 08:10:02'),
(2897, 3077, 'STD-00613', '8j20343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:10:02', '2024-07-25 08:10:02'),
(2898, 3078, 'STD-00614', '5eXE343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:10:03', '2024-07-25 08:10:03'),
(2899, 3079, 'STD-00615', 'X5Uj343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:10:03', '2024-07-25 08:10:03'),
(2900, 3080, 'STD-00616', 'zDwP343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:10:03', '2024-07-25 08:10:03'),
(2901, 3081, 'STD-00617', 'Gl8o343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:10:03', '2024-07-25 08:10:03'),
(2902, 3082, 'STD-00618', 'pOrh343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:10:03', '2024-07-25 08:10:03'),
(2903, 3083, 'STD-00619', 'PKh1343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:10:03', '2024-07-25 08:10:03'),
(2904, 3084, 'STD-00620', '1xkf343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:10:03', '2024-07-25 08:10:03'),
(2905, 3085, 'STD-00621', 'qFYh343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:10:03', '2024-07-25 08:10:03'),
(2906, 3086, 'STD-00622', 'vG0u343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:10:03', '2024-07-25 08:10:03'),
(2907, 3087, 'STD-00623', 'fZGX343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:10:03', '2024-07-25 08:10:03'),
(2908, 3088, 'STD-00624', 'zPmd343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:10:03', '2024-07-25 08:10:03'),
(2909, 3089, 'STD-00625', 'iUoa343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:10:04', '2024-07-25 08:10:04'),
(2910, 3090, 'STD-00626', 'zjKF343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:10:04', '2024-07-25 08:10:04'),
(2911, 3091, 'STD-00627', '7ArJ343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:10:04', '2024-07-25 08:10:04'),
(2912, 3092, 'STD-00628', 'cLVn343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:10:04', '2024-07-25 08:10:04'),
(2913, 3093, 'STD-00629', 'uYBW343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:10:04', '2024-07-25 08:10:04'),
(2914, 3094, 'STD-00630', 'Esae343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:10:04', '2024-07-25 08:10:04'),
(2915, 3095, 'STD-00631', 'Qi3y343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:10:04', '2024-07-25 08:10:04'),
(2916, 3096, 'STD-00632', 'Z42z343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:10:04', '2024-07-25 08:10:04'),
(2917, 3097, 'STD-00633', 'vvw8343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:10:04', '2024-07-25 08:10:04'),
(2918, 3098, 'STD-00634', 'HkM8343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:10:04', '2024-07-25 08:10:04'),
(2919, 3099, 'STD-00635', 'CWlF343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:10:04', '2024-07-25 08:10:04'),
(2920, 3100, 'STD-00636', 'Mk7g343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:10:04', '2024-07-25 08:10:04'),
(2921, 3101, 'STD-00637', '4f97343b34343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:10:04', '2024-07-25 08:10:04'),
(2958, 3139, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2020', 'islam', 'Indonesian', '2024-07-25 08:12:12', '2024-07-25 08:12:12'),
(2959, 3140, 'STD-00638', 'xJ4h343433n43ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:14:30', '2024-07-25 08:14:30'),
(2960, 3141, 'STD-00639', 'IaDi343433n43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:14:30', '2024-07-25 08:14:30'),
(2961, 3142, 'STD-00640', 'opml343433n43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:14:30', '2024-07-25 08:14:30'),
(2962, 3143, 'STD-00641', 'WhyU343433n43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:14:30', '2024-07-25 08:14:30'),
(2963, 3144, 'STD-00642', 'M9Ul343433n43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:14:30', '2024-07-25 08:14:30'),
(2964, 3145, 'STD-00643', 'MByz343433n43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:14:30', '2024-07-25 08:14:30'),
(2965, 3146, 'STD-00644', 'LkxF343433n43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:14:30', '2024-07-25 08:14:30'),
(2966, 3147, 'STD-00645', 'CHLb343433n43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:14:30', '2024-07-25 08:14:30'),
(2967, 3148, 'STD-00646', 'UOUP343433n43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:14:30', '2024-07-25 08:14:30'),
(2968, 3149, 'STD-00647', 'dbmA343433n43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:14:30', '2024-07-25 08:14:30'),
(2969, 3150, 'STD-00648', 'fl0n343433n43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:14:30', '2024-07-25 08:14:30'),
(2970, 3151, 'STD-00649', 'XxCd343433n43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:14:30', '2024-07-25 08:14:30'),
(2971, 3152, 'STD-00650', 't3uS343433n43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:14:30', '2024-07-25 08:14:30'),
(2972, 3153, 'STD-00651', 'CXZg343433n43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:14:30', '2024-07-25 08:14:30'),
(2973, 3154, 'STD-00652', 'TIee343433n43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:14:31', '2024-07-25 08:14:31'),
(2974, 3155, 'STD-00653', '74jR343433n43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:14:31', '2024-07-25 08:14:31'),
(2975, 3156, 'STD-00654', 'K1HR343433n43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:14:31', '2024-07-25 08:14:31'),
(2976, 3157, 'STD-00655', 'MTDO343433n43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:14:31', '2024-07-25 08:14:31'),
(2977, 3158, 'STD-00656', 'zwve343433n43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:14:31', '2024-07-25 08:14:31'),
(2978, 3159, 'STD-00657', 'DX0X343433n43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:14:31', '2024-07-25 08:14:31'),
(2979, 3160, 'STD-00658', 'smaw343433n43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:14:31', '2024-07-25 08:14:31'),
(2980, 3161, 'STD-00659', 'tsKM343433n43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:14:31', '2024-07-25 08:14:31'),
(2981, 3162, 'STD-00660', '3Ej3343433n43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:14:31', '2024-07-25 08:14:31'),
(2982, 3163, 'STD-00661', '3myA343433n43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:14:31', '2024-07-25 08:14:31'),
(2983, 3164, 'STD-00662', 'dG8M343433n43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:14:31', '2024-07-25 08:14:31'),
(2984, 3165, 'STD-00663', 'mXE8343433n43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:14:31', '2024-07-25 08:14:31'),
(2985, 3166, 'STD-00664', 'IbqL343433n43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:14:32', '2024-07-25 08:14:32'),
(2986, 3167, 'STD-00665', 'mi5m343433n43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:14:32', '2024-07-25 08:14:32'),
(2987, 3168, 'STD-00666', 's6Or343433n43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:14:32', '2024-07-25 08:14:32'),
(2988, 3169, 'STD-00667', 'sAH2343433n43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:14:32', '2024-07-25 08:14:32'),
(2989, 3170, 'STD-00668', 'y6kX343433n43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:14:32', '2024-07-25 08:14:32'),
(2990, 3171, 'STD-00669', 'z5DM343433n43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:14:32', '2024-07-25 08:14:32'),
(2991, 3172, 'STD-00670', 'wWiT343433n43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:14:32', '2024-07-25 08:14:32'),
(2992, 3173, 'STD-00671', 'tyc0343433n43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:14:32', '2024-07-25 08:14:32'),
(2993, 3174, 'STD-00672', 'GZjv343433n43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:14:32', '2024-07-25 08:14:32'),
(2994, 3175, 'STD-00673', 'UllU343433n43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 08:14:32', '2024-07-25 08:14:32'),
(2995, 3176, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2020', 'islam', 'Indonesian', '2024-07-25 08:17:02', '2024-07-25 08:17:02'),
(2996, 3177, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2020', 'islam', 'Indonesian', '2024-07-25 08:19:50', '2024-07-25 08:19:50'),
(2997, 3178, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2020', 'islam', 'Indonesian', '2024-07-25 08:23:31', '2024-07-25 08:23:31'),
(2998, 3179, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2020', 'islam', 'Indonesian', '2024-07-25 08:27:02', '2024-07-25 08:32:46'),
(2999, 3180, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2020', 'islam', 'Indonesian', '2024-07-25 08:30:24', '2024-07-25 08:30:24'),
(3000, 3181, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '2020', 'islam', 'Indonesian', '2024-07-25 08:35:05', '2024-07-25 08:35:05');

-- --------------------------------------------------------

--
-- Table structure for table `working_days`
--

CREATE TABLE `working_days` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `monday` tinyint(1) NOT NULL DEFAULT 1,
  `tuesday` tinyint(1) NOT NULL DEFAULT 1,
  `wednesday` tinyint(1) NOT NULL DEFAULT 1,
  `thursday` tinyint(1) NOT NULL DEFAULT 1,
  `friday` tinyint(1) NOT NULL DEFAULT 1,
  `saturday` tinyint(1) NOT NULL DEFAULT 1,
  `sunday` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `working_days`
--

INSERT INTO `working_days` (`id`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`, `sunday`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, '2024-03-29 03:16:41', '2024-03-29 03:16:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject` (`subject_type`,`subject_id`),
  ADD KEY `causer` (`causer_type`,`causer_id`),
  ADD KEY `activity_log_log_name_index` (`log_name`);

--
-- Indexes for table `admission_form_fields`
--
ALTER TABLE `admission_form_fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admission_requests`
--
ALTER TABLE `admission_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `assignments_title_unique` (`title`),
  ADD UNIQUE KEY `assignments_slug_unique` (`slug`),
  ADD KEY `assignments_user_id_foreign` (`user_id`),
  ADD KEY `assignments_subject_id_foreign` (`subject_id`),
  ADD KEY `assignments_course_id_foreign` (`course_id`);

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendances_user_id_foreign` (`user_id`);

--
-- Indexes for table `chat_groups`
--
ALTER TABLE `chat_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat_groups_subject_id_foreign` (`subject_id`);

--
-- Indexes for table `chat_group_conversations`
--
ALTER TABLE `chat_group_conversations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat_group_conversations_chat_group_id_foreign` (`chat_group_id`);

--
-- Indexes for table `chat_group_users`
--
ALTER TABLE `chat_group_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat_group_users_chat_group_id_foreign` (`chat_group_id`),
  ADD KEY `chat_group_users_user_id_foreign` (`user_id`);

--
-- Indexes for table `class_attendances`
--
ALTER TABLE `class_attendances`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `class_attendances_uuid_unique` (`uuid`),
  ADD KEY `class_attendances_user_id_foreign` (`user_id`);

--
-- Indexes for table `class_lists`
--
ALTER TABLE `class_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_routines`
--
ALTER TABLE `class_routines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_routines_course_id_foreign` (`course_id`),
  ADD KEY `class_routines_teacher_id_foreign` (`teacher_id`),
  ADD KEY `class_routines_subject_id_foreign` (`subject_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_notice_id_foreign` (`notice_id`),
  ADD KEY `comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `comment_replies`
--
ALTER TABLE `comment_replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comment_replies_notice_id_foreign` (`notice_id`),
  ADD KEY `comment_replies_user_id_foreign` (`user_id`),
  ADD KEY `comment_replies_comment_id_foreign` (`comment_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contacts_user_id_foreign` (`user_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `courses_name_unique` (`name`);

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
  ADD UNIQUE KEY `departments_name_unique` (`name`),
  ADD UNIQUE KEY `departments_slug_unique` (`slug`);

--
-- Indexes for table `documentations`
--
ALTER TABLE `documentations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exams_course_id_foreign` (`course_id`);

--
-- Indexes for table `exam_marks`
--
ALTER TABLE `exam_marks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_marks_user_id_foreign` (`user_id`),
  ADD KEY `exam_marks_exam_id_foreign` (`exam_id`);

--
-- Indexes for table `exam_results`
--
ALTER TABLE `exam_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_results_exam_id_foreign` (`exam_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `gallery_sliders`
--
ALTER TABLE `gallery_sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoices_user_id_foreign` (`user_id`);

--
-- Indexes for table `invoice_attachments`
--
ALTER TABLE `invoice_attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_attachments_invoice_id_foreign` (`invoice_id`);

--
-- Indexes for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_items_invoice_id_foreign` (`invoice_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `journals`
--
ALTER TABLE `journals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `landing_videos`
--
ALTER TABLE `landing_videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `languages_name_unique` (`name`),
  ADD UNIQUE KEY `languages_code_unique` (`code`);

--
-- Indexes for table `learning_lessons`
--
ALTER TABLE `learning_lessons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `learning_lessons_user_id_foreign` (`user_id`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leaves_leave_type_id_foreign` (`leave_type_id`);

--
-- Indexes for table `leave_types`
--
ALTER TABLE `leave_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `leave_types_name_unique` (`name`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mail_templates`
--
ALTER TABLE `mail_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meetings`
--
ALTER TABLE `meetings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `meetings_user_id_foreign` (`user_id`);

--
-- Indexes for table `meeting_attendees`
--
ALTER TABLE `meeting_attendees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `meeting_attendees_meeting_id_foreign` (`meeting_id`),
  ADD KEY `meeting_attendees_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mobile_notifications`
--
ALTER TABLE `mobile_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notices_user_id_foreign` (`user_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `onboardings`
--
ALTER TABLE `onboardings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `online_classes`
--
ALTER TABLE `online_classes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `online_classes_subject_id_foreign` (`subject_id`),
  ADD KEY `online_classes_course_id_foreign` (`course_id`),
  ADD KEY `online_classes_teacher_id_foreign` (`teacher_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`phone`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `permission_attendances`
--
ALTER TABLE `permission_attendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_attendances_user_id_foreign` (`user_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plans_course_id_foreign` (`course_id`);

--
-- Indexes for table `plan_benefits`
--
ALTER TABLE `plan_benefits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plan_benefits_plan_id_foreign` (`plan_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotes`
--
ALTER TABLE `quotes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ratings_user_id_foreign` (`user_id`),
  ADD KEY `ratings_teacher_id_foreign` (`teacher_id`);

--
-- Indexes for table `result_rules`
--
ALTER TABLE `result_rules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `schedules_user_id_foreign` (`user_id`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_templates`
--
ALTER TABLE `sms_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_links`
--
ALTER TABLE `social_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_attendances`
--
ALTER TABLE `student_attendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_lists`
--
ALTER TABLE `student_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_parents`
--
ALTER TABLE `student_parents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_parents_student_id_foreign` (`student_id`),
  ADD KEY `student_parents_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subjects_course_id_foreign` (`course_id`);

--
-- Indexes for table `submitted_assignments`
--
ALTER TABLE `submitted_assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `submitted_assignments_student_id_foreign` (`student_id`),
  ADD KEY `submitted_assignments_assignment_id_foreign` (`assignment_id`);

--
-- Indexes for table `syllabi`
--
ALTER TABLE `syllabi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `syllabi_user_id_foreign` (`user_id`),
  ADD KEY `syllabi_subject_id_foreign` (`subject_id`),
  ADD KEY `syllabi_course_id_foreign` (`course_id`);

--
-- Indexes for table `teacher_ratings`
--
ALTER TABLE `teacher_ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_ratings_student_id_foreign` (`student_id`),
  ADD KEY `teacher_ratings_teacher_id_foreign` (`teacher_id`),
  ADD KEY `teacher_ratings_course_id_foreign` (`course_id`),
  ADD KEY `teacher_ratings_attendance_id_foreign` (`attendance_id`);

--
-- Indexes for table `teacher_subjects`
--
ALTER TABLE `teacher_subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_subjects_teacher_id_foreign` (`teacher_id`),
  ADD KEY `teacher_subjects_subject_id_foreign` (`subject_id`);

--
-- Indexes for table `timezones`
--
ALTER TABLE `timezones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transactions_transaction_no_unique` (`transaction_no`),
  ADD KEY `transactions_transaction_type_id_foreign` (`transaction_type_id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`),
  ADD KEY `transactions_invoice_id_foreign` (`invoice_id`);

--
-- Indexes for table `transaction_types`
--
ALTER TABLE `transaction_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transaction_types_name_unique` (`name`),
  ADD UNIQUE KEY `transaction_types_slug_unique` (`slug`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_department_id_foreign` (`department_id`);

--
-- Indexes for table `user_courses`
--
ALTER TABLE `user_courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_courses_user_id_foreign` (`user_id`),
  ADD KEY `user_courses_course_id_foreign` (`course_id`);

--
-- Indexes for table `user_documents`
--
ALTER TABLE `user_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_documents_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_profiles_student_id_unique` (`student_id`),
  ADD UNIQUE KEY `user_profiles_roll_no_unique` (`roll_no`),
  ADD KEY `user_profiles_user_id_foreign` (`user_id`),
  ADD KEY `user_profiles_plan_id_foreign` (`plan_id`);

--
-- Indexes for table `working_days`
--
ALTER TABLE `working_days`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=391;

--
-- AUTO_INCREMENT for table `admission_form_fields`
--
ALTER TABLE `admission_form_fields`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `admission_requests`
--
ALTER TABLE `admission_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `chat_groups`
--
ALTER TABLE `chat_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=606;

--
-- AUTO_INCREMENT for table `chat_group_conversations`
--
ALTER TABLE `chat_group_conversations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat_group_users`
--
ALTER TABLE `chat_group_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `class_attendances`
--
ALTER TABLE `class_attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `class_lists`
--
ALTER TABLE `class_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `class_routines`
--
ALTER TABLE `class_routines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comment_replies`
--
ALTER TABLE `comment_replies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `documentations`
--
ALTER TABLE `documentations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `exam_marks`
--
ALTER TABLE `exam_marks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam_results`
--
ALTER TABLE `exam_results`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gallery_sliders`
--
ALTER TABLE `gallery_sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `invoice_attachments`
--
ALTER TABLE `invoice_attachments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_items`
--
ALTER TABLE `invoice_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `journals`
--
ALTER TABLE `journals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `landing_videos`
--
ALTER TABLE `landing_videos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `learning_lessons`
--
ALTER TABLE `learning_lessons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `leave_types`
--
ALTER TABLE `leave_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `mail_templates`
--
ALTER TABLE `mail_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meetings`
--
ALTER TABLE `meetings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meeting_attendees`
--
ALTER TABLE `meeting_attendees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `mobile_notifications`
--
ALTER TABLE `mobile_notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `onboardings`
--
ALTER TABLE `onboardings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `online_classes`
--
ALTER TABLE `online_classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `permission_attendances`
--
ALTER TABLE `permission_attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `plan_benefits`
--
ALTER TABLE `plan_benefits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quotes`
--
ALTER TABLE `quotes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `result_rules`
--
ALTER TABLE `result_rules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sms_templates`
--
ALTER TABLE `sms_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `social_links`
--
ALTER TABLE `social_links`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_attendances`
--
ALTER TABLE `student_attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student_lists`
--
ALTER TABLE `student_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_parents`
--
ALTER TABLE `student_parents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2917;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=606;

--
-- AUTO_INCREMENT for table `submitted_assignments`
--
ALTER TABLE `submitted_assignments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `syllabi`
--
ALTER TABLE `syllabi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teacher_ratings`
--
ALTER TABLE `teacher_ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teacher_subjects`
--
ALTER TABLE `teacher_subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=751;

--
-- AUTO_INCREMENT for table `timezones`
--
ALTER TABLE `timezones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=421;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `transaction_types`
--
ALTER TABLE `transaction_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3182;

--
-- AUTO_INCREMENT for table `user_courses`
--
ALTER TABLE `user_courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2912;

--
-- AUTO_INCREMENT for table `user_documents`
--
ALTER TABLE `user_documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3001;

--
-- AUTO_INCREMENT for table `working_days`
--
ALTER TABLE `working_days`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignments`
--
ALTER TABLE `assignments`
  ADD CONSTRAINT `assignments_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `assignments_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `assignments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `attendances_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chat_groups`
--
ALTER TABLE `chat_groups`
  ADD CONSTRAINT `chat_groups_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chat_group_conversations`
--
ALTER TABLE `chat_group_conversations`
  ADD CONSTRAINT `chat_group_conversations_chat_group_id_foreign` FOREIGN KEY (`chat_group_id`) REFERENCES `chat_groups` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chat_group_users`
--
ALTER TABLE `chat_group_users`
  ADD CONSTRAINT `chat_group_users_chat_group_id_foreign` FOREIGN KEY (`chat_group_id`) REFERENCES `chat_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chat_group_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `class_attendances`
--
ALTER TABLE `class_attendances`
  ADD CONSTRAINT `class_attendances_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `class_routines`
--
ALTER TABLE `class_routines`
  ADD CONSTRAINT `class_routines_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `class_routines_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `class_routines_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_notice_id_foreign` FOREIGN KEY (`notice_id`) REFERENCES `notices` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comment_replies`
--
ALTER TABLE `comment_replies`
  ADD CONSTRAINT `comment_replies_comment_id_foreign` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_replies_notice_id_foreign` FOREIGN KEY (`notice_id`) REFERENCES `notices` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_replies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exams`
--
ALTER TABLE `exams`
  ADD CONSTRAINT `exams_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exam_marks`
--
ALTER TABLE `exam_marks`
  ADD CONSTRAINT `exam_marks_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exam_marks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exam_results`
--
ALTER TABLE `exam_results`
  ADD CONSTRAINT `exam_results_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invoice_attachments`
--
ALTER TABLE `invoice_attachments`
  ADD CONSTRAINT `invoice_attachments_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD CONSTRAINT `invoice_items_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `learning_lessons`
--
ALTER TABLE `learning_lessons`
  ADD CONSTRAINT `learning_lessons_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `leaves`
--
ALTER TABLE `leaves`
  ADD CONSTRAINT `leaves_leave_type_id_foreign` FOREIGN KEY (`leave_type_id`) REFERENCES `leave_types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `meetings`
--
ALTER TABLE `meetings`
  ADD CONSTRAINT `meetings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `meeting_attendees`
--
ALTER TABLE `meeting_attendees`
  ADD CONSTRAINT `meeting_attendees_meeting_id_foreign` FOREIGN KEY (`meeting_id`) REFERENCES `meetings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `meeting_attendees_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notices`
--
ALTER TABLE `notices`
  ADD CONSTRAINT `notices_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `online_classes`
--
ALTER TABLE `online_classes`
  ADD CONSTRAINT `online_classes_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `online_classes_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `online_classes_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permission_attendances`
--
ALTER TABLE `permission_attendances`
  ADD CONSTRAINT `permission_attendances_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `plans`
--
ALTER TABLE `plans`
  ADD CONSTRAINT `plans_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `plan_benefits`
--
ALTER TABLE `plan_benefits`
  ADD CONSTRAINT `plan_benefits_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `schedules_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_parents`
--
ALTER TABLE `student_parents`
  ADD CONSTRAINT `student_parents_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `student_parents_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `subjects_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `submitted_assignments`
--
ALTER TABLE `submitted_assignments`
  ADD CONSTRAINT `submitted_assignments_assignment_id_foreign` FOREIGN KEY (`assignment_id`) REFERENCES `assignments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `submitted_assignments_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `syllabi`
--
ALTER TABLE `syllabi`
  ADD CONSTRAINT `syllabi_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `syllabi_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `syllabi_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `teacher_ratings`
--
ALTER TABLE `teacher_ratings`
  ADD CONSTRAINT `teacher_ratings_attendance_id_foreign` FOREIGN KEY (`attendance_id`) REFERENCES `class_attendances` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `teacher_ratings_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `teacher_ratings_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `teacher_ratings_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `teacher_subjects`
--
ALTER TABLE `teacher_subjects`
  ADD CONSTRAINT `teacher_subjects_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `teacher_subjects_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_transaction_type_id_foreign` FOREIGN KEY (`transaction_type_id`) REFERENCES `transaction_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_courses`
--
ALTER TABLE `user_courses`
  ADD CONSTRAINT `user_courses_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_courses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_documents`
--
ALTER TABLE `user_documents`
  ADD CONSTRAINT `user_documents_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD CONSTRAINT `user_profiles_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
