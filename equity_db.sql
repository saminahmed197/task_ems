-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2025 at 11:57 AM
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
-- Database: `equity_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `client_holding_user`
--

CREATE TABLE `client_holding_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `holding_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` varchar(5) NOT NULL DEFAULT 'Y',
  `is_delete` varchar(5) NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client_holding_user`
--

INSERT INTO `client_holding_user` (`id`, `holding_id`, `user_id`, `created_at`, `updated_at`, `is_active`, `is_delete`) VALUES
(1, 1, 5, '2025-07-13 10:45:32', '2025-07-13 10:45:32', 'Y', 'N'),
(2, 2, 4, '2025-07-13 10:46:16', '2025-07-13 13:15:15', 'Y', 'N'),
(3, 2, 5, '2025-07-13 10:46:16', '2025-07-13 13:15:15', 'Y', 'N'),
(4, 10, 5, NULL, '2025-07-13 23:23:50', 'Y', 'N'),
(5, 14, 4, '2025-07-14 02:12:46', '2025-07-14 02:27:53', 'Y', 'N'),
(6, 14, 5, '2025-07-14 02:12:46', '2025-07-14 02:27:53', 'Y', 'N');

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
-- Table structure for table `holdings`
--

CREATE TABLE `holdings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `stock_symbol` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `buy_price` decimal(20,2) NOT NULL,
  `purchase_date` date NOT NULL DEFAULT current_timestamp(),
  `sector` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` varchar(10) DEFAULT NULL,
  `is_active` varchar(5) NOT NULL DEFAULT 'Y',
  `is_delete` varchar(5) NOT NULL DEFAULT 'N',
  `current_price` decimal(20,2) DEFAULT NULL,
  `last_price_updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `holdings`
--

INSERT INTO `holdings` (`id`, `company_name`, `user_id`, `stock_symbol`, `quantity`, `buy_price`, `purchase_date`, `sector`, `created_at`, `updated_at`, `updated_by`, `is_active`, `is_delete`, `current_price`, `last_price_updated_at`) VALUES
(1, 'APPLE', 5, 'AAPL', 20, 5000000000.00, '2025-07-13', 'TECHNOLOGY', '2025-07-13 10:45:32', '2025-07-14 01:47:11', NULL, 'Y', 'N', 5000.45, '2025-07-14 02:27:53'),
(2, 'AMAZON', 4, 'AMZ', 3, 100009.00, '2025-07-01', NULL, '2025-07-13 10:46:16', '2025-07-13 13:21:37', '2', 'Y', 'N', NULL, '2025-07-14 02:27:53'),
(4, 'APPLE INC.', 0, 'AAPL', 30, 600150.00, '2025-07-14', NULL, '2025-07-13 15:05:56', '2025-07-14 02:04:03', '2', 'Y', 'N', 5000.45, '2025-07-14 02:27:53'),
(5, 'TESLA MOTORS', 0, 'TSLA', 5, 700.00, '2025-07-14', NULL, '2025-07-13 15:05:56', '2025-07-14 01:47:11', NULL, 'Y', 'N', 720.30, '2025-07-14 02:27:53'),
(6, 'AMAZON.COM', 0, 'AMZN', 8, 125.00, '2025-07-14', NULL, '2025-07-13 15:05:56', '2025-07-14 01:47:11', NULL, 'Y', 'N', 130.20, '2025-07-14 02:27:53'),
(8, 'TESLA MOTORS', 0, 'TSLA', 5, 700.00, '2025-07-14', NULL, '2025-07-13 15:13:21', '2025-07-14 01:47:11', NULL, 'Y', 'N', 720.30, '2025-07-14 02:27:53'),
(9, 'AMAZON.COM', 0, 'AMZN', 8, 125.00, '2025-07-14', NULL, '2025-07-13 15:13:21', '2025-07-14 01:47:11', NULL, 'Y', 'N', 130.20, '2025-07-14 02:27:53'),
(10, 'APPLE INC.', 0, 'AAPL', 5, 150000.00, '2025-07-14', NULL, '2025-07-13 15:23:18', '2025-07-14 01:47:11', NULL, 'Y', 'N', 5000.45, '2025-07-14 02:27:53'),
(11, 'TESLA MOTORS', 0, 'TSLA', 6, 700000.00, '2025-07-14', NULL, '2025-07-13 15:23:18', '2025-07-14 01:47:11', NULL, 'Y', 'N', 720.30, '2025-07-14 02:27:53'),
(12, 'AMAZON.COM', 0, 'AMZN', 7, 125000.00, '2025-07-14', NULL, '2025-07-13 15:23:18', '2025-07-14 01:47:11', NULL, 'Y', 'N', 130.20, '2025-07-14 02:27:53'),
(13, 'DESCO', 0, 'DSC', 40, 3000.00, '2025-07-14', 'ENERGY', '2025-07-14 02:04:03', '2025-07-14 02:04:03', NULL, 'Y', 'N', NULL, '2025-07-14 02:27:53'),
(14, 'Desco power supply', 4, 'DSC', 5, 40.00, '2025-07-13', 'ENERGY', '2025-07-15 02:12:46', '2025-07-14 02:27:53', NULL, 'Y', 'N', NULL, '2025-07-14 02:27:53');

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
(6, '2025_07_13_123253_create_client_holdings_table', 3),
(7, '2025_07_13_164157_create_holdings_table', 4),
(8, '2025_07_13_164218_create_client_holding_user_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('samin.ahmed@northsouth.edu', 'kl26zvrrWbQru5qXkZ6g4sTp8xnDbKUE77BDqcz8', '2025-07-14 01:31:49');

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
(0, 'sample', 'manager@gmail.com', '', 4, NULL, '$2y$10$2yW0Yafa3KytC/c4z2xGD.ca5QISOoZPlcuds9ib0n3zAmrrX7whW', NULL, '2023-08-05 05:32:56', '2025-07-13 12:50:01', 3, 'YES', '', 'Y', 'N'),
(1, 'sam', 'sample@gmail.com', '', 0, NULL, '$2y$10$2yW0Yafa3KytC/c4z2xGD.ca5QISOoZPlcuds9ib0n3zAmrrX7whW', NULL, '2023-08-05 05:32:56', '2025-07-13 12:50:01', 0, 'YES', '', 'Y', 'N'),
(2, 'admin', 'samin.ahmed@northsouth.edu', '', 1, NULL, '$2y$10$NRaMjONnWs2Yl4u0MkZGKuOPUx0zyh1NCSSHL4TtzynbhNTD.8sSy', NULL, '2023-08-05 05:38:28', '2023-08-05 05:38:28', 1, 'YES', '', 'Y', 'N'),
(3, 'Analyst', 'analyst@gmail.com', '', 2, NULL, '$2y$10$NRaMjONnWs2Yl4u0MkZGKuOPUx0zyh1NCSSHL4TtzynbhNTD.8sSy', NULL, '2023-08-05 05:38:28', '2023-08-05 05:38:28', 2, 'YES', '', 'Y', 'N'),
(4, 'Client', 'client@gmail.com', '01631982235', 3, NULL, '$2y$10$r8dmRcymfHk9huvnzcppIOX4PVtCSdSylw6K9IMQnUNHhsO5aNpk2', NULL, '2025-07-13 03:48:28', '2025-07-13 10:45:42', 3, 'YES', '2', 'Y', 'N'),
(5, 'Ekram', 'ek@gmail.com', '01631982235', 3, NULL, '$2y$10$QDETavXIEDWJW6yXvGruW.kR6INs1Io7ZzfLz69.SD28.TH9.2LbC', NULL, '2025-07-13 04:05:14', '2025-07-13 06:21:05', 3, 'YES', '2', 'Y', 'N');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client_holding_user`
--
ALTER TABLE `client_holding_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_holding_user_holding_id_foreign` (`holding_id`),
  ADD KEY `client_holding_user_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `holdings`
--
ALTER TABLE `holdings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `holdings_user_id_foreign` (`user_id`);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client_holding_user`
--
ALTER TABLE `client_holding_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `holdings`
--
ALTER TABLE `holdings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `client_holding_user`
--
ALTER TABLE `client_holding_user`
  ADD CONSTRAINT `client_holding_user_holding_id_foreign` FOREIGN KEY (`holding_id`) REFERENCES `holdings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `client_holding_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `holdings`
--
ALTER TABLE `holdings`
  ADD CONSTRAINT `holdings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
