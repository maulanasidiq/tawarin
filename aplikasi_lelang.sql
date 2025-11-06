-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 06, 2025 at 06:13 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aplikasi_lelang`
--

-- --------------------------------------------------------

--
-- Table structure for table `auctions`
--

CREATE TABLE `auctions` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `starting_price` decimal(12,2) NOT NULL,
  `current_price` decimal(12,2) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_time` timestamp NOT NULL,
  `end_time` timestamp NOT NULL,
  `status` enum('pending','active','closed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `winner_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `auctions`
--

INSERT INTO `auctions` (`id`, `user_id`, `title`, `description`, `starting_price`, `current_price`, `image`, `start_time`, `end_time`, `status`, `created_at`, `updated_at`, `winner_id`) VALUES
(9, 1, 'Infinix Gt 20 Pro', 'Bekas', '3000000.00', '3500000.00', NULL, '2025-10-20 00:45:00', '2025-10-21 02:00:00', 'closed', '2025-10-19 16:45:54', '2025-10-22 18:11:59', 4),
(10, 1, 'Iphone 15', 'Bekas Pemakaian 1 Tahun', '9000000.00', '10000000.00', NULL, '2025-10-21 01:00:00', '2025-10-22 02:50:00', 'closed', '2025-10-20 17:52:34', '2025-10-21 19:34:34', NULL),
(11, 4, 'Rexus Standing Deks', 'Bekas Pemakaian 2 Tahun', '2000000.00', '2000000.00', NULL, '2025-10-21 01:00:00', '2025-10-22 02:00:00', 'closed', '2025-10-20 17:55:58', '2025-10-21 22:39:33', NULL),
(12, 4, 'Tes', 'Tes', '1000000.00', '1499000.00', NULL, '2025-10-23 01:00:00', '2025-10-23 02:00:00', 'closed', '2025-10-22 17:27:09', '2025-10-22 17:29:47', NULL),
(13, 1, 'Tes', 'Tes', '500000.00', '700000.00', NULL, '2025-10-23 01:50:00', '2025-10-24 01:50:00', 'closed', '2025-10-22 17:51:04', '2025-10-22 17:52:38', NULL),
(14, 1, 'Tes', 'Tes', '1000000.00', '1500000.00', NULL, '2025-10-23 01:58:00', '2025-10-24 01:58:00', 'closed', '2025-10-22 17:58:17', '2025-10-22 18:02:03', NULL),
(15, 4, 'tes', 'Tes', '1000.00', '10000.00', NULL, '2025-10-23 03:07:00', '2025-10-24 03:07:00', 'closed', '2025-10-22 19:07:36', '2025-10-22 23:07:20', 1),
(16, 4, 'tes', 'tes', '1000.00', '3000.00', NULL, '2025-10-23 03:30:00', '2025-10-24 03:30:00', 'closed', '2025-10-22 19:30:55', '2025-10-22 19:58:43', 4),
(17, 1, 'Iphone', 'Bekas', '10000000.00', '12000000.00', NULL, '2025-10-29 05:30:00', '2025-10-29 07:00:00', 'active', '2025-10-28 21:48:07', '2025-10-28 21:48:47', NULL),
(18, 4, 'meja', 'meja bekas', '100000.00', '151000.00', NULL, '2025-11-04 06:48:00', '2025-11-05 07:50:00', 'active', '2025-11-03 22:50:12', '2025-11-03 22:52:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auction_images`
--

CREATE TABLE `auction_images` (
  `id` bigint UNSIGNED NOT NULL,
  `auction_id` bigint UNSIGNED NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `auction_images`
--

INSERT INTO `auction_images` (`id`, `auction_id`, `image_path`, `created_at`, `updated_at`) VALUES
(1, 9, 'auction_images/NBKr9rJ25Wd4QctgFtqchn4jVIRXB89RZinOocSF.jpg', '2025-10-19 16:45:55', '2025-10-19 16:45:55'),
(2, 9, 'auction_images/uwfIbj8eLGlBzVeOcFInrIXPX48WXTOkuohlQ22N.jpg', '2025-10-19 16:45:55', '2025-10-19 16:45:55'),
(3, 10, 'auction_images/NO93mdHVeWY0jRw0BB1pLxTOF4WvrVeQcR3PGgHq.jpg', '2025-10-20 17:52:35', '2025-10-20 17:52:35'),
(4, 10, 'auction_images/75i5oVKZRe1mSCD5c3fkHJva88JXNNycgJWIZgYy.jpg', '2025-10-20 17:52:35', '2025-10-20 17:52:35'),
(5, 10, 'auction_images/zzMVt0b0enqVmURVfOhvdtwXaw5y8W6TlgPUujrb.jpg', '2025-10-20 17:52:35', '2025-10-20 17:52:35'),
(6, 10, 'auction_images/9GP2DHNWqa0w1iz87N3oNVc2wQihfrqmM6phavX2.jpg', '2025-10-20 17:52:35', '2025-10-20 17:52:35'),
(7, 10, 'auction_images/mnc9SoPFgRXci0szt36CYEgbq4dxHH5Qffg0cKYZ.jpg', '2025-10-20 17:52:35', '2025-10-20 17:52:35'),
(8, 11, 'auction_images/2DVT35lZoUYo4cWOzCngJHQLV4GWwYWr7A0cbprd.png', '2025-10-20 17:55:58', '2025-10-20 17:55:58'),
(9, 11, 'auction_images/5wYv2HUZJgQT1sBSY1nN3P0qBam3crCHQG31X1bm.png', '2025-10-20 17:55:58', '2025-10-20 17:55:58'),
(10, 11, 'auction_images/zxF71WLbOj5nBoQpXCYuwvRACDCYcwUPHeL2404r.jpg', '2025-10-20 17:55:58', '2025-10-20 17:55:58'),
(11, 12, 'auction_images/4stKCDgCK8Z8eE7AIVKFsa2JLRwRgxRstAhgKF5L.png', '2025-10-22 17:27:09', '2025-10-22 17:27:09'),
(12, 13, 'auction_images/jMt5mI4cDrehreBziNK9btptReYwzU4S1Qhf9IJP.jpg', '2025-10-22 17:51:05', '2025-10-22 17:51:05'),
(13, 14, 'auction_images/1saoEMwawpxImIupje30wSa4nQORJPNqvmGN74CY.png', '2025-10-22 17:58:17', '2025-10-22 17:58:17'),
(14, 15, 'auction_images/YGInEMpCu3Hwyt4Yc6HL1cwTSbnEbzymdhD5mdsU.png', '2025-10-22 19:07:37', '2025-10-22 19:07:37'),
(15, 16, 'auction_images/vajd19B5pTDWt4DDG06bXyQS86PlZLl5AP7n1FSX.png', '2025-10-22 19:30:56', '2025-10-22 19:30:56'),
(16, 16, 'auction_images/A7qe5aGV0Z9LwPoVkmBb8GFZxA09WbQZAdFgvAFo.jpg', '2025-10-22 19:30:56', '2025-10-22 19:30:56'),
(17, 17, 'auction_images/brlEqbomKpjMxIAFHBO8UKmFvDKAzf2ZxSMQ5Ok3.jpg', '2025-10-28 21:48:08', '2025-10-28 21:48:08'),
(18, 17, 'auction_images/1XJdggJ7LRziOu2iqvPeA85niiW67M3La8hv0Oxw.jpg', '2025-10-28 21:48:08', '2025-10-28 21:48:08'),
(19, 17, 'auction_images/f0mV9W4IYkwr9i1UIEDyMh9JGmklaJZ7TvQbltOW.jpg', '2025-10-28 21:48:08', '2025-10-28 21:48:08'),
(20, 18, 'auction_images/4SWLwD1xcaaScadJHhsPk2UzQy12bPiDm9XkHBQQ.png', '2025-11-03 22:50:12', '2025-11-03 22:50:12'),
(21, 18, 'auction_images/FjLUMRbbngPahOdUuJw2vdpN26xwx4N22mIwayjY.png', '2025-11-03 22:50:12', '2025-11-03 22:50:12');

-- --------------------------------------------------------

--
-- Table structure for table `bids`
--

CREATE TABLE `bids` (
  `id` bigint UNSIGNED NOT NULL,
  `auction_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `is_winner` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bids`
--

INSERT INTO `bids` (`id`, `auction_id`, `user_id`, `amount`, `is_winner`, `created_at`, `updated_at`) VALUES
(13, 9, 4, '3001000.00', 0, '2025-10-19 16:49:46', '2025-10-19 16:49:46'),
(14, 9, 4, '3500000.00', 1, '2025-10-19 16:50:02', '2025-10-22 18:27:07'),
(15, 10, 4, '10000000.00', 0, '2025-10-21 19:10:48', '2025-10-21 19:10:48'),
(16, 12, 1, '1001000.00', 0, '2025-10-22 17:27:42', '2025-10-22 17:27:42'),
(17, 12, 1, '1499000.00', 0, '2025-10-22 17:28:30', '2025-10-22 17:28:30'),
(18, 13, 4, '700000.00', 0, '2025-10-22 17:51:53', '2025-10-22 17:51:53'),
(19, 14, 4, '1500000.00', 0, '2025-10-22 17:58:52', '2025-10-22 17:58:52'),
(20, 15, 1, '10000.00', 0, '2025-10-22 19:08:31', '2025-10-22 19:08:31'),
(21, 16, 1, '2000.00', 0, '2025-10-22 19:31:23', '2025-10-22 19:31:23'),
(22, 16, 1, '3000.00', 1, '2025-10-22 19:31:26', '2025-10-22 23:15:54'),
(23, 17, 4, '12000000.00', 0, '2025-10-28 21:48:47', '2025-10-28 21:48:47'),
(24, 18, 1, '150000.00', 0, '2025-11-03 22:50:52', '2025-11-03 22:50:52'),
(25, 18, 5, '151000.00', 0, '2025-11-03 22:52:16', '2025-11-03 22:52:16');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_09_22_003235_create_auctions_table', 2),
(6, '2025_09_22_003347_create_bids_table', 2),
(7, '2025_09_23_072000_add_role_to_users_table', 3),
(8, '2025_09_30_062145_create_notifications_table', 4),
(9, '2025_10_01_030150_add_is_winner_to_bids_table', 5),
(10, '2025_10_08_064437_add_winner_id_to_auctions_table', 6),
(11, '2025_10_16_065532_create_auction_images_table', 7),
(12, '2025_10_21_063551_add_profile_photo_to_users_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('1f902177-0622-4044-8ada-a126a2f9d552', 'App\\Notifications\\AuctionWonNotification', 'App\\Models\\User', 1, '{\"title\":\"\\ud83c\\udf89 Selamat!\",\"message\":\"Anda memenangkan lelang Sepeda.\",\"auction_id\":4,\"url\":\"http:\\/\\/localhost\\/won-auctions\\/4\"}', '2025-10-01 19:17:27', '2025-10-01 19:16:44', '2025-10-01 19:17:27'),
('51061d9d-e33d-4f92-b266-90d2e42d2d29', 'App\\Notifications\\AuctionWonNotification', 'App\\Models\\User', 1, '{\"auction_id\":4,\"title\":\"Sepeda\",\"message\":\"Selamat! Kamu memenangkan lelang \\\"Sepeda\\\".\",\"url\":\"http:\\/\\/localhost\\/won-auctions\\/4\"}', '2025-10-07 22:02:12', '2025-10-07 21:35:14', '2025-10-07 22:02:12'),
('623df19a-1c72-4b7e-b6e5-e0b3dd9b07fe', 'App\\Notifications\\AuctionWonNotification', 'App\\Models\\User', 1, '{\"auction_id\":4,\"title\":\"Sepeda\",\"message\":\"Selamat! Kamu memenangkan lelang \\\"Sepeda\\\".\",\"url\":\"http:\\/\\/localhost\\/won-auctions\\/4\"}', '2025-10-07 22:02:12', '2025-10-07 22:00:38', '2025-10-07 22:02:12'),
('8affbe1a-f405-46f0-a1f9-b64b63f586bf', 'App\\Notifications\\AuctionWonNotification', 'App\\Models\\User', 1, '{\"auction_id\":5,\"title\":\"Sepeda\",\"message\":\"Selamat! Kamu memenangkan lelang \\\"Sepeda\\\".\",\"url\":\"http:\\/\\/localhost\\/won-auctions\\/5\"}', '2025-10-07 22:02:12', '2025-10-07 21:42:15', '2025-10-07 22:02:12');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('admin@tawarin.test', '$2y$12$a6NWJJWu0yDn5Fr3Rpi/6.7jgiumsYXnFSXDr6riACSqfTFHezO/2', '2025-10-15 21:40:37');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
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
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `profile_photo`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'Sidiq', 'lana@gmail.com', 'profile_photos/Db9Bvb7eiACA1K4N1500GXIHMIK0I8xlLh5795El.jpg', NULL, '$2y$12$kc/RJIBZQO7JWEpjx8I6DujDQeAk6n3Mm4yRYrGU.d00x9pdVuNtS', 'PhKeHFOlnwfK1LzqIt6G9SVJqT9AamxYOGXQYu0Fx5SQBDkYmXQmcsVDRNEE', '2025-09-21 16:52:42', '2025-10-21 18:43:02', 'user'),
(3, 'Admin Tawarin', 'admin@tawarin.test', NULL, NULL, '$2y$12$nruZhD1C8LJ50//NTrKgT.c/pZx9CW8mDTbGGCAmLRiH/Z4vNLsTq', NULL, '2025-09-22 23:48:53', '2025-09-22 23:48:53', 'admin'),
(4, 'Sebastian', 'sebas123@gmail.com', 'profile_photos/cDSJgHPJMC9NB7U4YB1ptI5PeTciVON7Efas0IA1.jpg', NULL, '$2y$12$lu4CUX6sSWCqHCUQpqGzzuBv7GpCKPaNI98XRWi9gx1t3JmjjcYAS', 'VcBZQmP47Wxv1tQGWBhn2PmL2dbxornYhjlwGcj8OYvjyHF2q8qb4FPN334M', '2025-10-15 21:20:11', '2025-10-21 18:30:15', 'user'),
(5, 'sidiq', 'sidiq1234@gmail.com', NULL, NULL, '$2y$12$mXq0Zo/pfD1yhV/10fjbUOk7A9dx/f5gzW.KRqCR.kISCMQU77FzS', NULL, '2025-11-03 22:51:45', '2025-11-03 22:51:45', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auctions`
--
ALTER TABLE `auctions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auctions_user_id_foreign` (`user_id`),
  ADD KEY `auctions_winner_id_foreign` (`winner_id`);

--
-- Indexes for table `auction_images`
--
ALTER TABLE `auction_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auction_images_auction_id_foreign` (`auction_id`);

--
-- Indexes for table `bids`
--
ALTER TABLE `bids`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bids_auction_id_foreign` (`auction_id`),
  ADD KEY `bids_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

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
-- AUTO_INCREMENT for table `auctions`
--
ALTER TABLE `auctions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `auction_images`
--
ALTER TABLE `auction_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `bids`
--
ALTER TABLE `bids`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auctions`
--
ALTER TABLE `auctions`
  ADD CONSTRAINT `auctions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auctions_winner_id_foreign` FOREIGN KEY (`winner_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `auction_images`
--
ALTER TABLE `auction_images`
  ADD CONSTRAINT `auction_images_auction_id_foreign` FOREIGN KEY (`auction_id`) REFERENCES `auctions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bids`
--
ALTER TABLE `bids`
  ADD CONSTRAINT `bids_auction_id_foreign` FOREIGN KEY (`auction_id`) REFERENCES `auctions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bids_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
