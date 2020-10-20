-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2020 at 06:52 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vocher`
--

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
(1, '2017_12_15_112303_create_recipients_table', 1),
(2, '2017_12_15_112328_create_special_offers_table', 1),
(3, '2017_12_15_112350_create_voucher_codes_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `recipients`
--

CREATE TABLE `recipients` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `recipients`
--

INSERT INTO `recipients` (`id`, `name`, `email`, `created_at`, `updated_at`) VALUES
(1, 'John Doe', 'john@doe.com', '2020-10-20 11:25:44', '2020-10-20 11:25:44'),
(2, 'John Doe2', 'john123@doe.com', '2020-10-20 11:25:44', '2020-10-20 11:25:44'),
(3, 'Test', 'haseeb@yahoo.com', '2020-10-20 11:25:44', '2020-10-20 11:25:44'),
(4, 'ornage', 'lol@yahoo.com', '2020-10-20 11:25:44', '2020-10-20 11:25:44'),
(5, 'beak', 'lol123@yahoo.com', '2020-10-20 11:25:44', '2020-10-20 11:25:44');

-- --------------------------------------------------------

--
-- Table structure for table `special_offers`
--

CREATE TABLE `special_offers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` decimal(5,2) UNSIGNED NOT NULL,
  `expiration` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `special_offers`
--

INSERT INTO `special_offers` (`id`, `name`, `discount`, `expiration`, `created_at`, `updated_at`) VALUES
(1, 'Test1', '55.00', '2021-01-07', '2020-10-20 11:25:44', '2020-10-20 11:25:44'),
(2, 'Test2', '50.00', '2020-10-29', '2020-10-20 11:25:44', '2020-10-20 11:25:44'),
(3, 'Test3', '15.00', '2021-02-12', '2020-10-20 11:25:44', '2020-10-20 11:25:44');

-- --------------------------------------------------------

--
-- Table structure for table `voucher_codes`
--

CREATE TABLE `voucher_codes` (
  `id` int(10) UNSIGNED NOT NULL,
  `special_offer_id` int(10) UNSIGNED NOT NULL,
  `recipient_id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `used_on` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `voucher_codes`
--

INSERT INTO `voucher_codes` (`id`, `special_offer_id`, `recipient_id`, `code`, `used_on`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'gJCTklpwYSJP', NULL, '2020-10-20 11:25:44', '2020-10-20 11:25:44'),
(2, 1, 2, 'ensf86euqHRB', NULL, '2020-10-20 11:25:44', '2020-10-20 11:25:44'),
(3, 1, 3, 'VY99NfAKVr1T', NULL, '2020-10-20 11:25:44', '2020-10-20 11:25:44'),
(4, 1, 4, '267d0sY660DA', NULL, '2020-10-20 11:25:44', '2020-10-20 11:25:44'),
(5, 1, 5, 'i0gzuMc9mugm', NULL, '2020-10-20 11:25:44', '2020-10-20 11:25:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recipients`
--
ALTER TABLE `recipients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `recipients_email_unique` (`email`);

--
-- Indexes for table `special_offers`
--
ALTER TABLE `special_offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voucher_codes`
--
ALTER TABLE `voucher_codes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `recipients`
--
ALTER TABLE `recipients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `special_offers`
--
ALTER TABLE `special_offers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `voucher_codes`
--
ALTER TABLE `voucher_codes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=301;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
