-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2016 at 12:05 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_roles`
--

CREATE TABLE `admin_roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_deleted` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin_roles`
--

INSERT INTO `admin_roles` (`id`, `name`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Super Administrator', '0', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `role_id`, `username`, `email`, `name`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, 1, 'cordia92', 'keebler.devin@goldner.com', 'Prof. Carroll Metz', '$2y$10$PtXiHCSQwda755UavFRguemdV3/av.XhXev6VZagit5K2fMafBhUG', NULL, '1971-06-27 05:34:38', NULL),
(5, 1, 'danny.douglas', 'qkeeling@durgan.com', 'Ramiro Gutkowski', '$2y$10$B2l0lMGPYV2Kb/YwAK/DBu9WSZZX5.owKcRbsI4debb/XR6Ilze1G', NULL, '1975-03-10 15:30:26', NULL),
(6, 1, 'mckenzie.kris', 'kabbott@glover.com', 'Marie Hackett', '$2y$10$olgPJu2fC4Xvrc19iRJfuOcePGZX5C29BRKQi01hC/vD5QDf9KazS', NULL, '1982-10-01 04:59:17', NULL),
(7, 1, 'schroeder.dovie', 'herta.lueilwitz@rolfson.com', 'Reid Weimann IV', '$2y$10$5zCzBp23wUVhaPRnn9wEpeFEQpDI9dUD2u3k3oGfyEP.EDRsXvcNm', NULL, '1992-11-14 00:29:28', NULL),
(8, 1, 'qgraham', 'harvey.keagan@kuhlman.biz', 'Sheridan Predovic', '$2y$10$rJ0mAc1foeZOwgxy0FlrmeSfHBn9l1cCPsOAxt0qjKuXfWxeHvENG', NULL, '1991-04-07 20:09:33', NULL),
(9, 1, 'vern59', 'dledner@gmail.com', 'Mr. Horace Koss PhD', '$2y$10$DuyfJ75Fser2lHoi97lF6uxdird9FG3emoYvKhUvUueuuWaTCitIO', NULL, '1978-02-14 03:03:36', NULL),
(10, 1, 'mspencer', 'tamia.kutch@hagenes.com', 'Juliet Yundt', '$2y$10$lp0dKg77mrSqMQ/48eFef./HrsKc.zl1zSpYABKT.lZHlqEm0CeaC', NULL, '1992-04-11 07:10:31', NULL),
(11, 1, 'floyd60', 'sid.nitzsche@crist.com', 'Kaitlyn Schinner', '$2y$10$CuYl6EnKnuhiBvdj3XvNnOFQTt/Hlz1u/ioXgMdEF68LutKDpVeC.', NULL, '1990-05-26 07:14:58', NULL),
(12, 1, 'morar.helga', 'leonor47@wilderman.com', 'Carleton Dicki DVM', '$2y$10$9Yw5hygxla1NvdFsWzL8Puiy.BACTihonvkDlVa2fo17YGg1odWl2', NULL, '1986-07-08 12:25:01', NULL),
(13, 1, 'vlockman', 'kenneth.fadel@rosenbaum.com', 'Austin Waters', '$2y$10$jhEM4oVJsnkkEakr5kbr3eBo3QO1xs4V8BfWJYxpTCF1ew/Nn94M.', NULL, '1977-09-15 05:25:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_06_07_035351_create_admin_users_table', 1),
('2016_06_07_042057_create_admin_role_table', 1),
('2016_06_07_095016_create_admin_users_table', 2),
('2016_06_10_040327_create_admin_users_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_roles`
--
ALTER TABLE `admin_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_users_username_unique` (`username`),
  ADD UNIQUE KEY `admin_users_email_unique` (`email`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

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
-- AUTO_INCREMENT for table `admin_roles`
--
ALTER TABLE `admin_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
