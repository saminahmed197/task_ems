-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2025 at 03:55 PM
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
-- Database: `equity_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `questions_id` int(11) NOT NULL,
  `answer` varchar(500) NOT NULL,
  `is_correct` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `questions_id`, `answer`, `is_correct`, `created_at`, `updated_at`) VALUES
(2, 1, 'Second answer', 0, '2023-10-24 12:21:24', '2024-06-01 11:55:22'),
(4, 2, 'First ans', 0, '2023-11-02 16:25:29', '2023-11-02 16:25:29'),
(5, 2, 'Second ans', 1, '2023-11-02 16:25:29', '2023-11-02 16:25:29'),
(6, 2, 'Third ans', 0, '2023-11-02 16:25:29', '2023-11-02 16:25:29'),
(109, 51, '111', 0, '2023-11-04 18:15:25', '2023-11-04 18:15:25'),
(110, 51, '12', 1, '2023-11-04 18:15:25', '2023-11-04 18:15:25'),
(111, 51, '13', 0, '2023-11-04 18:15:25', '2023-11-04 18:15:25'),
(112, 52, 'cbl', 0, '2023-11-10 14:04:13', '2023-11-10 14:04:13'),
(113, 52, 'citytouch', 1, '2023-11-10 14:04:13', '2023-11-10 14:04:13'),
(114, 52, 'farmer', 0, '2023-11-10 14:04:13', '2023-11-10 14:04:13'),
(115, 53, 'No', 0, '2023-11-10 15:13:20', '2023-11-10 15:13:20'),
(116, 53, 'Yes', 1, '2023-11-10 15:13:20', '2023-11-10 15:13:20'),
(127, 1, 'new 1', 1, '2024-06-01 17:52:04', '2024-06-01 11:55:22'),
(173, 64, 'list tag', 0, '2024-06-08 16:42:21', '2024-06-08 16:42:21'),
(174, 64, 'nl tag', 0, '2024-06-08 16:42:21', '2024-06-08 16:42:21'),
(175, 64, 'ul tag', 1, '2024-06-08 16:42:21', '2024-06-08 16:42:21'),
(176, 64, 'ol tag', 0, '2024-06-08 16:42:21', '2024-06-08 16:42:21'),
(177, 65, 'SRC', 0, '2024-06-08 16:42:21', '2024-06-08 16:42:21'),
(178, 65, 'LINK', 0, '2024-06-08 16:42:21', '2024-06-08 16:42:21'),
(179, 65, 'CELLPADDING', 1, '2024-06-08 16:42:21', '2024-06-08 16:42:21'),
(180, 65, 'BOLD', 0, '2024-06-08 16:42:21', '2024-06-08 16:42:21'),
(181, 65, 'None', 0, '2024-06-08 16:42:21', '2024-06-08 16:42:21'),
(182, 65, 'IMG', 0, '2024-06-08 16:42:21', '2024-06-08 16:42:21'),
(183, 66, 'Ending tag', 0, '2024-06-08 16:42:21', '2024-06-08 10:43:33'),
(184, 66, 'Starting tag', 1, '2024-06-08 16:42:21', '2024-06-08 10:43:33'),
(185, 66, 'Closed tag', 0, '2024-06-08 16:42:21', '2024-06-08 10:43:33'),
(186, 66, 'Pair tags', 0, '2024-06-08 16:42:21', '2024-06-08 10:43:33'),
(187, 66, 'Table tag', 0, '2024-06-08 16:42:21', '2024-06-08 10:43:33');

-- --------------------------------------------------------

--
-- Table structure for table `client_holdings`
--

CREATE TABLE `client_holdings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `stock_symbol` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `buy_price` decimal(10,2) NOT NULL,
  `purchase_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` int(11) NOT NULL,
  `exam_name` varchar(255) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `attempt` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `exam_name`, `subject_id`, `date`, `time`, `attempt`, `created_at`, `updated_at`) VALUES
(1, 'Half Yearly', 1, '2024-06-08', '11:44', 1, '2023-10-18 17:44:42', '2024-06-01 10:54:21'),
(2, 'First Class Test', 1, '2023-10-20', '11:00', 0, '2023-10-18 17:54:54', '2023-10-18 17:54:54'),
(4, 'Half Yearly', 2, '2023-11-11', '10:00', 0, '2023-10-19 15:39:40', '2023-10-19 15:39:40'),
(5, 'First Class Test', 4, '2023-11-10', '16:01', 2, '2023-10-24 10:01:26', '2023-10-24 04:07:13'),
(6, 'Test', 2, '2023-11-25', '15:05', 3, '2023-11-03 21:02:49', '2023-11-03 21:02:49');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_07_13_115916_create_jobs_table', 2),
(6, '2025_07_13_123253_create_client_holdings_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
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
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `created_at`, `updated_at`) VALUES
(1, 'First Question changed?', '2023-10-24 12:21:24', '2024-06-01 11:55:22'),
(2, 'Second question?', '2023-11-02 16:25:29', '2023-11-02 16:25:29'),
(51, 'ok', '2023-11-04 18:15:25', '2023-11-04 18:15:25'),
(52, 'city bank app', '2023-11-10 14:04:13', '2023-11-10 14:04:13'),
(53, 'Remove button working?', '2023-11-10 15:13:20', '2023-11-10 15:13:20'),
(64, 'How can you make a bulleted list?', '2024-06-08 16:42:21', '2024-06-08 16:42:21'),
(65, 'Which of the following is an attribute of <Table> tag?', '2024-06-08 16:42:21', '2024-06-08 16:42:21'),
(66, 'Opening tag of HTML is called', '2024-06-08 16:42:21', '2024-06-08 10:43:33');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `subject` varchar(256) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject`, `created_at`, `updated_at`) VALUES
(1, 'English', '2023-09-08 19:49:17', '2023-10-01 10:26:23'),
(2, 'Math', '2023-10-01 17:04:11', '2023-10-01 17:04:11'),
(4, 'Physics', '2023-10-01 17:04:40', '2023-10-01 17:04:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `request_role` tinyint(4) NOT NULL,
  `request_decision` varchar(5) NOT NULL,
  `request_decision_by` varchar(20) DEFAULT NULL,
  `is_active` varchar(5) NOT NULL,
  `is_delete` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `is_admin`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `request_role`, `request_decision`, `request_decision_by`, `is_active`, `is_delete`) VALUES
(1, 'sam', 'manager@gmail.com', '', 0, NULL, '$2y$10$34BctJy4VQh0qlzskHK3VOQ9RfFapBhlmp0cqGV6m6qiRhDEWPwz6', NULL, '2023-08-05 05:32:56', '2023-10-18 10:59:16', 0, 'YES', '', 'Y', 'N'),
(2, 'admin', 'a@gmail.com', '', 1, NULL, '$2y$10$NRaMjONnWs2Yl4u0MkZGKuOPUx0zyh1NCSSHL4TtzynbhNTD.8sSy', NULL, '2023-08-05 05:38:28', '2023-08-05 05:38:28', 1, 'YES', '', 'Y', 'N'),
(3, 'Analyst', 'analyst@gmail.com', '', 2, NULL, '$2y$10$NRaMjONnWs2Yl4u0MkZGKuOPUx0zyh1NCSSHL4TtzynbhNTD.8sSy', NULL, '2023-08-05 05:38:28', '2023-08-05 05:38:28', 2, 'YES', '', 'Y', 'N'),
(4, 'Client', 'client@gmail.com', '01631982235', 3, NULL, '$2y$10$r8dmRcymfHk9huvnzcppIOX4PVtCSdSylw6K9IMQnUNHhsO5aNpk2', NULL, '2025-07-13 03:48:28', '2025-07-13 03:48:28', 3, 'NO', NULL, 'N', 'Y'),
(5, 'Ekram', 'ek@gmail.com', '01631982235', 3, NULL, '$2y$10$QDETavXIEDWJW6yXvGruW.kR6INs1Io7ZzfLz69.SD28.TH9.2LbC', NULL, '2025-07-13 04:05:14', '2025-07-13 06:21:05', 3, 'YES', '2', 'Y', 'N');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_holdings`
--
ALTER TABLE `client_holdings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_holdings_user_id_foreign` (`user_id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;

--
-- AUTO_INCREMENT for table `client_holdings`
--
ALTER TABLE `client_holdings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `client_holdings`
--
ALTER TABLE `client_holdings`
  ADD CONSTRAINT `client_holdings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
