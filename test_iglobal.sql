-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2020 at 09:17 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test_iglobal`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8_unicode_ci NOT NULL,
  `queue` text COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(254) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(8, '2014_10_12_000000_create_users_table', 1),
(9, '2014_10_12_100000_create_password_resets_table', 1),
(10, '2019_08_19_000000_create_failed_jobs_table', 1),
(11, '2020_12_23_071941_create_ms_dokter_table', 1),
(12, '2020_12_23_072002_create_ts_booking_table', 1),
(13, '2020_12_23_122751_add_field_soft_deleted_to_table_dokter', 1),
(14, '2020_12_23_171414_add_field_soft_deleted_to_ts_booking', 1),
(19, '2020_12_29_075616_add_field_telp_certificate_id_to_ms_dokter', 2),
(20, '2020_12_29_080457_create_table_ms_certificate', 2),
(21, '2020_12_29_084128_create_table_ts_review', 3),
(22, '2020_12_29_100817_create_table_ts_user_reserve_dokter', 4),
(23, '2020_12_29_121212_create_ms_roles_table', 5),
(24, '2020_12_29_121237_create_user_role_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `ms_certificate`
--

CREATE TABLE `ms_certificate` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dokter_id` bigint(20) UNSIGNED NOT NULL,
  `certificate_number` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ms_certificate`
--

INSERT INTO `ms_certificate` (`id`, `dokter_id`, `certificate_number`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, '23572819472617648291', NULL, NULL, NULL),
(2, 2, '24152364423215132323', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ms_dokter`
--

CREATE TABLE `ms_dokter` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_dokter` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `telp` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ms_dokter`
--

INSERT INTO `ms_dokter` (`id`, `nama_dokter`, `created_at`, `updated_at`, `deleted_at`, `telp`) VALUES
(1, 'Gunawan', '2020-12-29 00:43:05', '2020-12-29 22:02:40', NULL, '12736273'),
(2, 'Darmawan', NULL, '2020-12-29 07:05:50', NULL, '112233'),
(3, 'tes', '2020-12-29 20:53:26', '2020-12-29 22:10:44', '2020-12-29 22:10:44', '123');

-- --------------------------------------------------------

--
-- Table structure for table `ms_roles`
--

CREATE TABLE `ms_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ms_roles`
--

INSERT INTO `ms_roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'user', '2020-12-29 12:00:00', NULL),
(2, 'admin', '2020-12-29 12:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(254) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(254) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ts_booking`
--

CREATE TABLE `ts_booking` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_pasien` varchar(254) COLLATE utf8_unicode_ci NOT NULL,
  `telepon` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `id_dokter` bigint(20) UNSIGNED NOT NULL,
  `tanggal_kunjungan` date NOT NULL,
  `jam_kunjungan` time NOT NULL,
  `pesan` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ts_dokter_pasien`
--

CREATE TABLE `ts_dokter_pasien` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dokter_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal_kunjungan` date NOT NULL,
  `jam_kunjungan` time NOT NULL,
  `pesan` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ts_dokter_pasien`
--

INSERT INTO `ts_dokter_pasien` (`id`, `dokter_id`, `user_id`, `tanggal_kunjungan`, `jam_kunjungan`, `pesan`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2020-12-30', '10:00:00', 'konsultasi', NULL, NULL),
(2, 1, 4, '2020-12-30', '11:00:00', 'MCU', NULL, NULL),
(3, 2, 4, '2020-12-31', '13:00:00', 'MCU', NULL, NULL),
(4, 1, 5, '2020-12-30', '09:00:00', 'mcu dok', '2020-12-29 07:01:31', '2020-12-29 07:01:31'),
(5, 1, 4, '2021-01-01', '11:00:00', 'tes', '2020-12-30 00:57:44', '2020-12-30 00:57:44');

-- --------------------------------------------------------

--
-- Table structure for table `ts_review`
--

CREATE TABLE `ts_review` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dokter_id` bigint(20) UNSIGNED NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ts_review`
--

INSERT INTO `ts_review` (`id`, `dokter_id`, `content`, `created_at`, `updated_at`) VALUES
(1, 1, 'Dokternya baik, penjelasannya detail', '2020-12-29 07:00:00', NULL),
(2, 1, 'Dokternya ramah, mantap', '2020-11-29 03:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(254) COLLATE utf8_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(254) COLLATE utf8_unicode_ci NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `role_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Eko Darmawan', 'ekodeko', 'tes@tes.com', NULL, '$2y$10$5w0XgSZAo9V52ctsnG7xz.t6oCjArdKt3vVCne2xnZJbJP6nmLR4C', 1, NULL, '2020-12-29 00:42:43', '2020-12-29 00:42:43'),
(2, 'admin', 'admin', 'admin@example.com', NULL, '$2y$10$O2vhfA0qrIYeZvoaz6B46.g./LE08Ify5igSCjYmVuiVIP1tEapB6', 2, NULL, '2020-12-29 05:17:09', '2020-12-29 05:17:09'),
(3, 'Gunawan', 'gunawan', 'gunawan@email.com', NULL, '$2y$10$NlbarLN4FdVXp6gVb2bOuezl5Vj2Q7A.zaQz1k7uMoF.IJVSukw/W', 1, NULL, '2020-12-29 05:17:46', '2020-12-29 05:17:46'),
(4, 'employee', 'employee', 'employee@email.com', NULL, '$2y$10$e7pvybJlVcRZKZlEbeQQOeBMlR.Uuu.YYAhMw.xAFFVwspYz/fbPS', 1, NULL, '2020-12-29 05:18:14', '2020-12-29 05:18:14'),
(5, 'pasien baru', 'pasien1', 'pasien@email.com', NULL, '$2y$10$khB8Xb6lNyksrg53hlQTtOjZoN1C/XXvuCLmmwhJxBMio2GXwGDkq', 1, NULL, '2020-12-29 06:57:38', '2020-12-29 06:57:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ms_certificate`
--
ALTER TABLE `ms_certificate`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ms_certificate_certificate_number_unique` (`certificate_number`),
  ADD KEY `ms_certificate_dokter_id_foreign` (`dokter_id`);

--
-- Indexes for table `ms_dokter`
--
ALTER TABLE `ms_dokter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ms_roles`
--
ALTER TABLE `ms_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `ts_booking`
--
ALTER TABLE `ts_booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ts_dokter_pasien`
--
ALTER TABLE `ts_dokter_pasien`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ts_user_reserve_dokter_dokter_id_foreign` (`dokter_id`),
  ADD KEY `ts_user_reserve_dokter_user_id_foreign` (`user_id`);

--
-- Indexes for table `ts_review`
--
ALTER TABLE `ts_review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ts_review_dokter_id_foreign` (`dokter_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `ms_certificate`
--
ALTER TABLE `ms_certificate`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ms_dokter`
--
ALTER TABLE `ms_dokter`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ms_roles`
--
ALTER TABLE `ms_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ts_booking`
--
ALTER TABLE `ts_booking`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ts_dokter_pasien`
--
ALTER TABLE `ts_dokter_pasien`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ts_review`
--
ALTER TABLE `ts_review`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ms_certificate`
--
ALTER TABLE `ms_certificate`
  ADD CONSTRAINT `ms_certificate_dokter_id_foreign` FOREIGN KEY (`dokter_id`) REFERENCES `ms_dokter` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ts_dokter_pasien`
--
ALTER TABLE `ts_dokter_pasien`
  ADD CONSTRAINT `ts_user_reserve_dokter_dokter_id_foreign` FOREIGN KEY (`dokter_id`) REFERENCES `ms_dokter` (`id`),
  ADD CONSTRAINT `ts_user_reserve_dokter_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `ts_review`
--
ALTER TABLE `ts_review`
  ADD CONSTRAINT `ts_review_dokter_id_foreign` FOREIGN KEY (`dokter_id`) REFERENCES `ms_dokter` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `ms_roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
