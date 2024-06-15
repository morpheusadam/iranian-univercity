-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 08, 2024 at 04:14 AM
-- Server version: 5.7.24
-- PHP Version: 8.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `university`
--

-- --------------------------------------------------------

--
-- Table structure for table `classrooms`
--

CREATE TABLE `classrooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lesson_id` bigint(20) UNSIGNED DEFAULT NULL,
  `professor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `week_day` enum('شنبه','یکشنبه','دوشنبه','سه شنبه','چهارشنبه') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_period_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('ثابت','چرخشی') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eg_id` bigint(20) UNSIGNED DEFAULT NULL,
  `entry_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `term_id` bigint(20) UNSIGNED DEFAULT NULL,
  `collages_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `classrooms`
--

INSERT INTO `classrooms` (`id`, `lesson_id`, `professor_id`, `week_day`, `time_period_id`, `status`, `eg_id`, `entry_id`, `created_at`, `updated_at`, `term_id`, `collages_id`) VALUES
(1, 2, 1, 'شنبه', 1, 'ثابت', 1, 2, '2024-04-24 20:09:49', '2024-04-24 20:09:49', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `classroom_location_term`
--

CREATE TABLE `classroom_location_term` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `classroom_id` bigint(20) UNSIGNED DEFAULT NULL,
  `location_id` bigint(20) UNSIGNED DEFAULT NULL,
  `term_id` bigint(20) UNSIGNED DEFAULT NULL,
  `collages_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `classroom_location_term`
--

INSERT INTO `classroom_location_term` (`id`, `classroom_id`, `location_id`, `term_id`, `collages_id`) VALUES
(1, 1, NULL, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `collages`
--

CREATE TABLE `collages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `collages`
--

INSERT INTO `collages` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'مدیریت', NULL, NULL),
(2, 'دانشکده مهندسی نفت', NULL, NULL),
(3, 'داشکده فیزیک', NULL, NULL),
(4, 'دانشکده شیمی', '2024-05-29 11:43:55', '2024-05-29 11:43:55');

-- --------------------------------------------------------

--
-- Table structure for table `educational_groups`
--

CREATE TABLE `educational_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `initials` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `term_id` bigint(20) UNSIGNED DEFAULT NULL,
  `collages_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `educational_groups`
--

INSERT INTO `educational_groups` (`id`, `name`, `initials`, `created_at`, `updated_at`, `term_id`, `collages_id`) VALUES
(1, 'گروه کامپیوتر', 'گ ک', '2024-04-24 20:08:09', '2024-04-24 20:08:09', NULL, NULL),
(2, 'گروه برق', 'گ ب', '2024-04-24 20:08:23', '2024-04-24 20:08:23', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `entries`
--

CREATE TABLE `entries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `year` int(11) NOT NULL,
  `term_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `entries`
--

INSERT INTO `entries` (`id`, `year`, `term_id`) VALUES
(1, 1400, NULL),
(2, 1401, NULL),
(3, 1403, NULL),
(4, 1404, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `term_id` bigint(20) UNSIGNED DEFAULT NULL,
  `collages_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`id`, `name`, `code`, `group`, `created_at`, `updated_at`, `term_id`, `collages_id`) VALUES
(2, 'ساختمان داده ها', '140056', '1', '2024-04-24 20:06:53', '2024-04-24 20:06:53', NULL, NULL),
(3, 'علیششش', '79863', 'کامپیوتر', '2024-05-02 11:43:13', '2024-05-02 11:43:13', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `number` int(11) NOT NULL,
  `term_id` bigint(20) UNSIGNED DEFAULT NULL,
  `collages_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `number`, `term_id`, `collages_id`) VALUES
(1, 402, NULL, NULL),
(2, 503, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2024_02_03_165236_create_terms_table', 1),
(5, '2024_02_03_165237_create_lessons_table', 1),
(6, '2024_02_03_165258_create_professors_table', 1),
(7, '2024_02_03_165343_create_educational_groups_table', 1),
(8, '2024_02_03_165357_create_entries_table', 1),
(9, '2024_02_04_121816_create_locations_table', 1),
(10, '2024_02_04_140335_create_time_periods_table', 1),
(11, '2024_02_05_165415_create_classrooms_table', 1),
(12, '2024_03_18_210708_create_class_location_term_tabel', 1),
(13, '2024_03_31_172848_create_presence_and_absences_table', 1),
(14, '2024_04_26_202908_create_permission_tables', 2),
(15, '2024_05_02_162547_alter_classrooms_table', 3),
(16, '2024_05_24_131105_alter_user', 4),
(17, '2024_05_26_131024_add_collgae_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_fa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `name_fa`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'lessions', 'دروس', 'web', NULL, NULL),
(2, 'profrssors', 'استاید', 'web', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
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
-- Table structure for table `presence_and_absences`
--

CREATE TABLE `presence_and_absences` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `term_id` bigint(20) UNSIGNED DEFAULT NULL,
  `classroom_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('created','not_created','empty') COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `presence_and_absences`
--

INSERT INTO `presence_and_absences` (`id`, `term_id`, `classroom_id`, `status`, `date`) VALUES
(1, 2, 1, 'created', '2024-05-02'),
(5, 2, 1, 'created', '2024-05-09'),
(14, 2, 1, 'created', '2024-05-09');

-- --------------------------------------------------------

--
-- Table structure for table `professors`
--

CREATE TABLE `professors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `term_id` bigint(20) UNSIGNED DEFAULT NULL,
  `collages_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `professors`
--

INSERT INTO `professors` (`id`, `name`, `created_at`, `updated_at`, `term_id`, `collages_id`) VALUES
(1, 'علی مولائی', '2024-04-24 20:07:08', '2024-04-24 20:07:08', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_fa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `name_fa`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'مدیر', 'web', NULL, NULL),
(2, 'مدیر گروه', NULL, 'web', '2024-05-02 11:36:00', '2024-05-02 11:36:00'),
(3, 'آسیه', NULL, 'web', '2024-05-02 11:36:23', '2024-05-02 11:36:23'),
(4, 'علی', NULL, 'web', '2024-05-02 11:37:50', '2024-05-02 11:37:50'),
(5, 'علی زارع', NULL, 'web', '2024-05-02 11:39:50', '2024-05-02 11:39:50'),
(6, 'سس', NULL, 'web', '2024-05-07 11:00:22', '2024-05-07 11:00:22'),
(7, 'مدیر سیستم', NULL, 'web', '2024-05-07 11:02:10', '2024-05-07 11:02:10'),
(8, 'علی مولائیشش', NULL, 'web', '2024-05-07 11:03:07', '2024-05-07 11:03:07'),
(9, 'علی حسینی9999999999999999', NULL, 'web', '2024-05-07 15:28:18', '2024-05-07 15:28:18');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--

CREATE TABLE `terms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `terms`
--

INSERT INTO `terms` (`id`, `number`) VALUES
(1, 4022),
(2, 4031);

-- --------------------------------------------------------

--
-- Table structure for table `time_periods`
--

CREATE TABLE `time_periods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `period` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `term_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `time_periods`
--

INSERT INTO `time_periods` (`id`, `period`, `created_at`, `updated_at`, `term_id`) VALUES
(1, '7.5-9', '2024-04-24 20:07:28', '2024-04-24 20:07:28', NULL),
(2, '10-12.5', '2024-04-24 20:07:34', '2024-04-24 20:07:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` tinyint(3) UNSIGNED DEFAULT NULL,
  `collages_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `role`, `collages_id`) VALUES
(1, 'مدیر سیستم', 'admin', '$2y$12$GyrXpgNHx9VTEGhpqXzB3./HxsND/2o2um4.Njzo5RbK9M3FcYzdC', 123, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classrooms`
--
ALTER TABLE `classrooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `classrooms_lesson_id_foreign` (`lesson_id`),
  ADD KEY `classrooms_professor_id_foreign` (`professor_id`),
  ADD KEY `classrooms_time_period_id_foreign` (`time_period_id`),
  ADD KEY `classrooms_eg_id_foreign` (`eg_id`),
  ADD KEY `classrooms_entry_id_foreign` (`entry_id`),
  ADD KEY `classrooms_term_id_index` (`term_id`),
  ADD KEY `classrooms_collages_id_index` (`collages_id`);

--
-- Indexes for table `classroom_location_term`
--
ALTER TABLE `classroom_location_term`
  ADD PRIMARY KEY (`id`),
  ADD KEY `classroom_location_term_classroom_id_foreign` (`classroom_id`),
  ADD KEY `classroom_location_term_location_id_foreign` (`location_id`),
  ADD KEY `classroom_location_term_term_id_foreign` (`term_id`),
  ADD KEY `classroom_location_term_collages_id_index` (`collages_id`);

--
-- Indexes for table `collages`
--
ALTER TABLE `collages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `educational_groups`
--
ALTER TABLE `educational_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `educational_groups_name_unique` (`name`),
  ADD UNIQUE KEY `educational_groups_initials_unique` (`initials`),
  ADD KEY `educational_groups_term_id_index` (`term_id`),
  ADD KEY `educational_groups_collages_id_index` (`collages_id`);

--
-- Indexes for table `entries`
--
ALTER TABLE `entries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `entries_year_unique` (`year`),
  ADD KEY `entries_term_id_index` (`term_id`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lessons_term_id_index` (`term_id`),
  ADD KEY `lessons_collages_id_index` (`collages_id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `locations_number_unique` (`number`),
  ADD KEY `locations_term_id_index` (`term_id`),
  ADD KEY `locations_collages_id_index` (`collages_id`);

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
-- Indexes for table `presence_and_absences`
--
ALTER TABLE `presence_and_absences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `presence_and_absences_term_id_foreign` (`term_id`),
  ADD KEY `presence_and_absences_classroom_id_foreign` (`classroom_id`);

--
-- Indexes for table `professors`
--
ALTER TABLE `professors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `professors_name_unique` (`name`),
  ADD KEY `professors_term_id_index` (`term_id`),
  ADD KEY `professors_collages_id_index` (`collages_id`);

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
-- Indexes for table `terms`
--
ALTER TABLE `terms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `terms_number_unique` (`number`);

--
-- Indexes for table `time_periods`
--
ALTER TABLE `time_periods`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `time_periods_period_unique` (`period`),
  ADD KEY `time_periods_term_id_index` (`term_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD KEY `users_collages_id_index` (`collages_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classrooms`
--
ALTER TABLE `classrooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `classroom_location_term`
--
ALTER TABLE `classroom_location_term`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `collages`
--
ALTER TABLE `collages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `educational_groups`
--
ALTER TABLE `educational_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `entries`
--
ALTER TABLE `entries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `presence_and_absences`
--
ALTER TABLE `presence_and_absences`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `professors`
--
ALTER TABLE `professors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `terms`
--
ALTER TABLE `terms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `time_periods`
--
ALTER TABLE `time_periods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `classrooms`
--
ALTER TABLE `classrooms`
  ADD CONSTRAINT `classrooms_collages_id_foreign` FOREIGN KEY (`collages_id`) REFERENCES `collages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `classrooms_eg_id_foreign` FOREIGN KEY (`eg_id`) REFERENCES `educational_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `classrooms_entry_id_foreign` FOREIGN KEY (`entry_id`) REFERENCES `entries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `classrooms_lesson_id_foreign` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `classrooms_professor_id_foreign` FOREIGN KEY (`professor_id`) REFERENCES `professors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `classrooms_term_id_foreign` FOREIGN KEY (`term_id`) REFERENCES `terms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `classrooms_time_period_id_foreign` FOREIGN KEY (`time_period_id`) REFERENCES `time_periods` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `classroom_location_term`
--
ALTER TABLE `classroom_location_term`
  ADD CONSTRAINT `classroom_location_term_classroom_id_foreign` FOREIGN KEY (`classroom_id`) REFERENCES `classrooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `classroom_location_term_collages_id_foreign` FOREIGN KEY (`collages_id`) REFERENCES `collages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `classroom_location_term_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `classroom_location_term_term_id_foreign` FOREIGN KEY (`term_id`) REFERENCES `terms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `educational_groups`
--
ALTER TABLE `educational_groups`
  ADD CONSTRAINT `educational_groups_collages_id_foreign` FOREIGN KEY (`collages_id`) REFERENCES `collages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `educational_groups_term_id_foreign` FOREIGN KEY (`term_id`) REFERENCES `terms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `entries`
--
ALTER TABLE `entries`
  ADD CONSTRAINT `entries_term_id_foreign` FOREIGN KEY (`term_id`) REFERENCES `terms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `lessons_collages_id_foreign` FOREIGN KEY (`collages_id`) REFERENCES `collages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lessons_term_id_foreign` FOREIGN KEY (`term_id`) REFERENCES `terms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `locations`
--
ALTER TABLE `locations`
  ADD CONSTRAINT `locations_collages_id_foreign` FOREIGN KEY (`collages_id`) REFERENCES `collages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `locations_term_id_foreign` FOREIGN KEY (`term_id`) REFERENCES `terms` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `presence_and_absences`
--
ALTER TABLE `presence_and_absences`
  ADD CONSTRAINT `presence_and_absences_classroom_id_foreign` FOREIGN KEY (`classroom_id`) REFERENCES `classrooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `presence_and_absences_term_id_foreign` FOREIGN KEY (`term_id`) REFERENCES `terms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `professors`
--
ALTER TABLE `professors`
  ADD CONSTRAINT `professors_collages_id_foreign` FOREIGN KEY (`collages_id`) REFERENCES `collages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `professors_term_id_foreign` FOREIGN KEY (`term_id`) REFERENCES `terms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `time_periods`
--
ALTER TABLE `time_periods`
  ADD CONSTRAINT `time_periods_term_id_foreign` FOREIGN KEY (`term_id`) REFERENCES `terms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_collages_id_foreign` FOREIGN KEY (`collages_id`) REFERENCES `collages` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
