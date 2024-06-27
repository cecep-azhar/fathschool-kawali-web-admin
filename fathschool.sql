-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 29, 2024 at 10:28 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `FathSchool`
--

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
(1, 'name', 1, 1, '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(2, 'email', 1, 2, '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
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
(21, 'guardian_photo', 1, 21, '2024-03-29 03:16:41', '2024-03-29 03:16:41');

-- --------------------------------------------------------

--
-- Table structure for table `admission_requests`
--

CREATE TABLE `admission_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `date_of_birth` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `national_identification_number` varchar(255) DEFAULT NULL,
  `blood_group` enum('A+','A-','B+','B-','O+','O-','AB+','AB-') DEFAULT NULL,
  `physical_disability` varchar(255) DEFAULT NULL,
  `previous_school_name` varchar(255) DEFAULT NULL,
  `previous_school_year_of_exist` varchar(255) DEFAULT NULL,
  `religion` varchar(255) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `bank_account_number` varchar(255) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `guardian_name` varchar(255) DEFAULT NULL,
  `guardian_email` varchar(255) DEFAULT NULL,
  `guardian_photo` varchar(255) DEFAULT NULL,
  `courses` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`courses`)),
  `documents` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`documents`)),
  `isAccept` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `has_multiple_subject` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(2, 'Indian Rupee	', 'INR', 83.7500, '₹', 1, '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(3, 'Euro', 'EUR', 0.9561, '€', 1, '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
(4, 'Bangladeshi Taka', 'BDT', 110.7500, '৳', 1, '2024-03-29 03:16:41', '2024-03-29 03:16:41');

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
(2, 'Bengali', 'bn', 'ltr', '2024-03-29 03:16:39', '2024-03-29 03:16:39'),
(3, 'Arabic', 'ar', 'rtl', '2024-03-29 03:16:39', '2024-03-29 03:16:39');

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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leave_types`
--

CREATE TABLE `leave_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_type` enum('student','staff') NOT NULL,
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
(5, 'student', 'Full Day', 'full-day', '2024-03-29 03:16:41', '2024-03-29 03:16:41');

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
(70, '2023_10_11_041618_add_rate_to_currencies_table', 1);

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
(2, 'App\\Models\\User', 3),
(3, 'App\\Models\\User', 4),
(4, 'App\\Models\\User', 5),
(5, 'App\\Models\\User', 2);

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 'welcome', 'Welcome', 'Welcome to our FathSchool App! Explore all the features and resources available to students, teachers, accountants, and parents.', '2024-03-29 03:16:41', '2024-03-29 03:16:41'),
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
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(115, 'student.dashboard', 'web', 'others', '2024-03-29 03:16:37', '2024-03-29 03:16:37');

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
(115, 4);

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
('X0HoV01ZisXQN9NPPYB5oBTSlzfEWGjEOgg7Sm0j', 1, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoicUFJMGM4ZXhPcFM0S0dtblR3Qm42WWlTdUVMSEprME81WmJkdW11RCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoyMToicGFzc3dvcmRfaGFzaF9zYW5jdHVtIjtzOjYwOiIkMnkkMTAkNzNubVVQMmVNSlBFTDFrVExhbzhqT0tJVEJMUkhYd2pKZ1I1N2U3eHFwMzVXdUJDelFSRDIiO30=', 1711704351);

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
  `principal_name` varchar(255) DEFAULT NULL,
  `app_address` varchar(255) DEFAULT NULL,
  `app_email` varchar(255) DEFAULT NULL,
  `app_phone` varchar(255) DEFAULT NULL,
  `app_currency` varchar(255) NOT NULL DEFAULT 'USD',
  `key_to_grades` text NOT NULL,
  `grade_summary` text NOT NULL,
  `over_due_days` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `app_logo_type`, `text_logo_name`, `app_name`, `school_code`, `dark_logo`, `light_logo`, `favicon_icon`, `app_description`, `principal_name`, `app_address`, `app_email`, `app_phone`, `app_currency`, `key_to_grades`, `grade_summary`, `over_due_days`, `created_at`, `updated_at`) VALUES
(1, 'image', 'FathSchool', 'FathSchool', NULL, 'images/dark_logo.png', 'images/light_logo.png', 'images/favicon.png', 'FathSchool is a constituent institution of the University of Dhaka.  Main goal  is to establish an institution of high academic standard for higher studies and research in economics and related disciplines. Different Economic based BSc, MSc & Diploma degrees are available here.,', 'FathSchool Principal', 'Dhaka, Bangladesh', 'FathSchool@mail.com', '016442290**', 'USD', 'A+: 80% and Above | A: 70% - 79% | B: 60% - 69% | C: 50% - 59% | D: 40% - 49% | F: 39% and Below', '5(A+), 4(A), 3(B), 2(C), 1(F)', 0, '2024-03-29 03:16:39', '2024-03-29 03:16:39');

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
(1, 5, 4, '2024-03-29 03:16:39', '2024-03-29 03:16:39');

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
-- Table structure for table `teacher_subjects`
--

CREATE TABLE `teacher_subjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
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
  `tour_completed` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `role`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `status`, `phone`, `address`, `department_id`, `date_of_birth`, `gender`, `account_hold`, `created_at`, `updated_at`, `tour_completed`) VALUES
(1, 'Developer', 'developer_lDpnr', 'developer@mail.com', 'Admin', NULL, '$2y$10$73nmUP2eMJPEL1kTLao8jOKITBLRHXwjJgR57e7xqp35WuBCzQRD2', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '1997-01-31', NULL, 0, '2024-03-29 03:16:38', '2024-03-29 03:20:28', 1),
(2, 'Accountant', 'accountant_AJHq2', 'accountant@mail.com', 'Accountant', NULL, '$2y$10$BTIvBzYGIEslrY/c65os0u4II.RTkHYiHyOD.tOVOVvXFpGwTFU6i', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '1997-02-01', NULL, 0, '2024-03-29 03:16:38', '2024-03-29 03:16:38', 0),
(3, 'Teacher', 'teacher_YhCEm', 'teacher@mail.com', 'Teacher', NULL, '$2y$10$dbsUwLbAFtW2RkcJwgQKk.JVjnwLhbkUGPHT3yna4Futhyqpp987S', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '1995-04-22', NULL, 0, '2024-03-29 03:16:38', '2024-03-29 03:16:57', 1),
(4, 'Parent', 'parent_65Ej9', 'parent@mail.com', 'Parent', NULL, '$2y$10$JAUBXYC6V0H8nuP1r9YMEussPaqD2CFXRIfieHTeTykocQrTSZYQa', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '1996-01-30', NULL, 0, '2024-03-29 03:16:38', '2024-03-29 03:16:38', 0),
(5, 'Student', 'student_Xr2VB', 'student@mail.com', 'Student', NULL, '$2y$10$ePYU48hzxURYWeQww/peeuLXOchRKEsRV8hXcXGy1crdY3vDNYC.m', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '1996-01-25', NULL, 0, '2024-03-29 03:16:39', '2024-03-29 03:16:39', 0);

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
(1, 5, 'STD-00000', '649q', '2023-2023', NULL, NULL, 'AB+', 'Normal', 'Test School', '2010', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', NULL, '2024-03-29 03:16:39', '2024-03-29 03:16:39'),
(2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Example Highest Degree', 'Example Institute Name', '2021', 'Scientology', 'Bangladeshi', '2024-03-29 03:16:39', '2024-03-29 03:16:39');

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
(1, 1, 1, 1, 1, 1, 1, 0, '2024-03-29 03:16:41', '2024-03-29 03:16:41');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `languages_name_unique` (`name`),
  ADD UNIQUE KEY `languages_code_unique` (`code`);

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
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

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
-- AUTO_INCREMENT for table `chat_groups`
--
ALTER TABLE `chat_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `class_routines`
--
ALTER TABLE `class_routines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_attachments`
--
ALTER TABLE `invoice_attachments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_items`
--
ALTER TABLE `invoice_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leave_types`
--
ALTER TABLE `leave_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plan_benefits`
--
ALTER TABLE `plan_benefits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `result_rules`
--
ALTER TABLE `result_rules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sms_templates`
--
ALTER TABLE `sms_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `social_links`
--
ALTER TABLE `social_links`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_attendances`
--
ALTER TABLE `student_attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_parents`
--
ALTER TABLE `student_parents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `teacher_subjects`
--
ALTER TABLE `teacher_subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `timezones`
--
ALTER TABLE `timezones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=421;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction_types`
--
ALTER TABLE `transaction_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_courses`
--
ALTER TABLE `user_courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_documents`
--
ALTER TABLE `user_documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
