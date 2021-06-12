-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2021 at 07:16 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `softify`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `image`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Nazmul Hoque', 'nazmul@gmail.com', '84117-60bbb124865a9.png', '$2y$10$Plr7GxWEq2UZTvDrSz32ouRnpQ9D95qWFuPBSFdTD6PF2krPSURB2', NULL, NULL, '2021-06-05 12:07:14'),
(2, 'Anamul Hoque', 'anamul@gmail.com', NULL, '$2y$10$e.Xe5LTjjD9IFspS7efjd.cfhm0mV0MIJtTGKhGW5XdLVarbBBjIC', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_06_05_135647_create_admins_table', 1),
(6, '2021_06_06_043003_create_products_table', 2),
(7, '2021_06_06_085343_create_carts_table', 3),
(8, '2014_10_12_000000_create_users_table', 4),
(9, '2021_06_08_075049_create_shippingaddresses_table', 5),
(10, '2021_06_09_033753_create_orders_table', 6),
(11, '2021_06_09_034747_create_orders_products_table', 7),
(12, '2021_06_10_071750_create_order_statuses_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_charge` double(8,2) DEFAULT NULL,
  `order_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_gateway` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_price` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `email`, `phone`, `address`, `shipping_charge`, `order_status`, `payment_method`, `payment_gateway`, `total_price`, `created_at`, `updated_at`) VALUES
(1, 1, 'Nazmul Hoque', 'nazmul@gmail.com', '0123434', 'Panthapath, Kolabagan Dhaka', 0.00, 'New', 'COD', 'COD', 880.00, '2021-06-09 03:31:02', '2021-06-09 03:31:02'),
(2, 1, 'Anamul Hoque', 'anamul@gmail.com', '01694834', 'Bbaraia Bangladesh', 0.00, 'New', 'Prepaid', 'Paypal', 1400.00, '2021-06-09 03:46:26', '2021-06-09 03:46:26'),
(3, 1, 'Nazmul Hoque', 'nazmul@gmail.com', '0123434', 'Panthapath, Kolabagan Dhaka', 0.00, 'New', 'COD', 'COD', 600.00, '2021-06-09 07:49:59', '2021-06-09 07:49:59'),
(4, 1, 'Nazmul Hoque', 'nazmul@gmail.com', '0123434', 'Panthapath, Kolabagan Dhaka', 0.00, 'New', 'COD', 'COD', 1840.00, '2021-06-09 07:58:55', '2021-06-09 07:58:55'),
(5, 1, 'Nazmul Hoque', 'nazmul@gmail.com', '0123434', 'Panthapath, Kolabagan Dhaka', 0.00, 'Shipped', 'COD', 'COD', 1440.00, '2021-06-09 11:20:17', '2021-06-10 02:13:03'),
(6, 1, 'Nazmul Hoque', 'nazmul@gmail.com', '0123434', 'Panthapath, Kolabagan Dhaka', 0.00, 'Pending', 'COD', 'COD', 31150.00, '2021-06-10 08:18:45', '2021-06-10 08:20:09');

-- --------------------------------------------------------

--
-- Table structure for table `orders_products`
--

CREATE TABLE `orders_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_color` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` double(8,2) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders_products`
--

INSERT INTO `orders_products` (`id`, `user_id`, `order_id`, `product_id`, `product_name`, `product_code`, `product_color`, `product_price`, `product_quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'T-shirt', 'T-oo56', 'Green', 240.00, 2, '2021-06-09 03:31:02', '2021-06-09 03:31:02'),
(2, 1, 1, 7, 'Womens Braslate', 'ert', 'Gray', 200.00, 2, '2021-06-09 03:31:02', '2021-06-09 03:31:02'),
(3, 1, 2, 6, 'Womens Braslate', 'wqwe', 'Gray', 200.00, 4, '2021-06-09 03:46:26', '2021-06-09 03:46:26'),
(4, 1, 2, 5, 'Womens Braslate', '4354', 'Gray', 200.00, 3, '2021-06-09 03:46:26', '2021-06-09 03:46:26'),
(5, 1, 3, 7, 'Womens Braslate', 'ert', 'Gray', 200.00, 2, '2021-06-09 07:49:59', '2021-06-09 07:49:59'),
(6, 1, 3, 5, 'Womens Braslate', '4354', 'Gray', 200.00, 1, '2021-06-09 07:49:59', '2021-06-09 07:49:59'),
(7, 1, 4, 1, 'T-shirt', 'T-oo56', 'Green', 240.00, 1, '2021-06-09 07:58:55', '2021-06-09 07:58:55'),
(8, 1, 4, 5, 'Womens Braslate', '4354', 'Gray', 200.00, 8, '2021-06-09 07:58:55', '2021-06-09 07:58:55'),
(9, 1, 5, 1, 'T-shirt', 'T-oo56', 'Green', 240.00, 1, '2021-06-09 11:20:17', '2021-06-09 11:20:17'),
(10, 1, 5, 5, 'Womens Braslate', '4354', 'Gray', 200.00, 1, '2021-06-09 11:20:17', '2021-06-09 11:20:17'),
(11, 1, 5, 6, 'Womens Braslate', 'wqwe', 'Gray', 200.00, 2, '2021-06-09 11:20:17', '2021-06-09 11:20:17'),
(12, 1, 5, 7, 'Womens Braslate', 'ert', 'Gray', 200.00, 3, '2021-06-09 11:20:17', '2021-06-09 11:20:17'),
(13, 1, 6, 14, 'Silicon Cover', 'wqwe', 'Blue', 450.00, 1, '2021-06-10 08:18:45', '2021-06-10 08:18:45'),
(14, 1, 6, 9, 'MObile Phone', 'MO-2890', 'Gray', 30000.00, 1, '2021-06-10 08:18:45', '2021-06-10 08:18:45'),
(15, 1, 6, 13, 'Suzuki Bike', 'MO-2890', 'Gray', 300.00, 1, '2021-06-10 08:18:45', '2021-06-10 08:18:45'),
(16, 1, 6, 16, 'Suzuki Bike', '4354', 'Blue', 200.00, 2, '2021-06-10 08:18:45', '2021-06-10 08:18:45');

-- --------------------------------------------------------

--
-- Table structure for table `order_statuses`
--

CREATE TABLE `order_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_statuses`
--

INSERT INTO `order_statuses` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'New', 1, NULL, NULL),
(2, 'Pending', 1, NULL, NULL),
(3, 'In Process', 1, NULL, NULL),
(4, 'Cancelled', 1, NULL, NULL),
(5, 'Paid', 1, NULL, NULL),
(6, 'Shipped', 1, NULL, NULL),
(7, 'Deliverd', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_color` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` double(8,2) NOT NULL,
  `product_stock` int(5) DEFAULT NULL,
  `product_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_code`, `product_color`, `product_price`, `product_stock`, `product_image`, `created_at`, `updated_at`) VALUES
(1, 'T-shirt', 'T-oo56', 'Green', 240.00, 3, '26263-60bc5f871ed33.jpeg', NULL, '2021-06-05 23:39:19'),
(3, 'Casual T-shirt', 'T-oo56', 'Green', 240.00, 20, '50027-60bc5f9657e30.jpeg', NULL, '2021-06-05 23:39:34'),
(5, 'Womens Braslate', '4354', 'Gray', 200.00, 10, '68073-60bc5faeda3ae.jpeg', '2021-06-05 23:29:39', '2021-06-05 23:39:59'),
(6, 'Womens Braslate', 'wqwe', 'Gray', 200.00, 90, '42010-60bc5fb8ae79b.jpeg', '2021-06-05 23:30:36', '2021-06-05 23:40:08'),
(7, 'Womens Braslate', 'ert', 'Gray', 200.00, 5, '62055-60bc5fca5dd18.jpeg', '2021-06-05 23:37:12', '2021-06-05 23:40:26'),
(8, 'Suzuki Bike', 'SU-Bike-2090', 'Gray', 150000.00, 54, '3972-60c1ea54a1e68.jpeg', '2021-06-10 04:32:53', '2021-06-10 08:16:28'),
(9, 'MObile Phone', 'MO-2890', 'Gray', 30000.00, 55, '33238-60c1ea9776d1d.jpeg', '2021-06-10 04:33:59', '2021-06-10 08:15:55'),
(10, 'Suzuki Bike', 'MO-2890', 'Gray', 200.00, 20, '86579-60c1eab99886e.jpeg', '2021-06-10 04:34:33', '2021-06-10 08:16:03'),
(11, 'Womens Braslate', '4354', 'Gray', 200.00, NULL, '61939-60c1eada3ffe0.jpeg', '2021-06-10 04:35:06', '2021-06-10 04:35:06'),
(12, 'Suzuki Bike', 'MO-2890', 'Gray', 150000.00, 56, '41420-60c1eaf1b7f9a.jpeg', '2021-06-10 04:35:30', '2021-06-10 08:16:18'),
(13, 'Suzuki Bike', 'MO-2890', 'Gray', 300.00, 20, '73586-60c1eb2d140a2.jpg', '2021-06-10 04:36:29', '2021-06-10 08:16:10'),
(14, 'Silicon Cover', 'wqwe', 'Blue', 450.00, NULL, '3989-60c1eb5539d39.jpg', '2021-06-10 04:37:09', '2021-06-10 04:37:09'),
(15, 'Womens Braslate', 'MO-2890', 'Blue', 200.00, 56, '63752-60c20650b3a34.jpg', '2021-06-10 06:32:17', '2021-06-10 08:15:48'),
(16, 'Suzuki Bike', '4354', 'Blue', 200.00, 20, '66968-60c206756e58f.jpg', '2021-06-10 06:32:43', '2021-06-10 08:15:40'),
(17, 'Womens Braslate', 'MO-2890', 'Gray', 200.00, 56, '91156-60c21eda25999.jpg', '2021-06-10 08:16:58', '2021-06-10 08:16:58'),
(18, 'Suzuki Bike', '4354', 'Gray', 200.00, 56, '43684-60c21f0266412.jpeg', '2021-06-10 08:17:38', '2021-06-10 08:17:38');

-- --------------------------------------------------------

--
-- Table structure for table `shippingaddresses`
--

CREATE TABLE `shippingaddresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(5) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shippingaddresses`
--

INSERT INTO `shippingaddresses` (`id`, `user_id`, `name`, `email`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(1, 0, 'Nazmul Hoque', 'nazmul@gmail.com', '012---3434', 'Panthapath, Kolabagan Dhaka', NULL, NULL),
(2, 1, 'Anamul Hoque', 'anamul@gmail.com', '01694834', 'Bbaraia Bangladesh', NULL, '2021-06-08 06:37:17'),
(3, 1, 'Nazmul Hoque', 'nazmul@gmail.com', '0123434', 'Panthapath, Kolabagan Dhaka', NULL, '2021-06-08 11:33:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `google_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `google_id`, `facebook_id`, `status`, `image`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Nazmul Hoque', 'nazmul@gmail.com', NULL, NULL, '$2y$10$6ogpLkHrIqTU1pMjXZl8zOC2TywFp.wimtH4nOlSDhlNi43YhnzzW', NULL, NULL, 1, NULL, NULL, '2021-06-08 04:24:42', '2021-06-08 04:24:42'),
(2, 'Nazmul Hoque', 'nazmuldiu8@gmail.com', NULL, NULL, '$2y$10$rbJAtLWJ2JLakudRCNuU3ezUwclIiFGpkrE.1txUvsehyhUkEU3iu', NULL, NULL, 1, NULL, NULL, '2021-06-08 04:25:10', '2021-06-08 04:25:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_products`
--
ALTER TABLE `orders_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_statuses`
--
ALTER TABLE `order_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shippingaddresses`
--
ALTER TABLE `shippingaddresses`
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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders_products`
--
ALTER TABLE `orders_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `order_statuses`
--
ALTER TABLE `order_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `shippingaddresses`
--
ALTER TABLE `shippingaddresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
