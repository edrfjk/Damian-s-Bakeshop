-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2026 at 02:13 AM
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
-- Database: `marjorie_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `subtotal` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cart_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `image`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'Bread', 'bread', 'Freshly baked breads and rolls', NULL, 1, 1, '2026-02-20 23:41:45', '2026-02-20 23:41:45'),
(2, 'Pastries', 'pastries', 'Delicious sweet and savory pastries', NULL, 1, 2, '2026-02-20 23:41:45', '2026-02-20 23:41:45'),
(3, 'Cakes', 'cakes', 'Celebration and specialty cakes', NULL, 1, 3, '2026-02-20 23:41:45', '2026-02-20 23:41:45'),
(4, 'Desserts', 'desserts', 'Sweet treats like cookies, muffins, and more', NULL, 1, 4, '2026-02-20 23:41:45', '2026-02-20 23:41:45');

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
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
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
(1, '0001_01_01_000001_create_cache_table', 1),
(2, '0001_01_01_000002_create_jobs_table', 1),
(3, '2026_02_15_084648_create_categories_table', 1),
(4, '2026_02_15_084648_create_users_table', 1),
(5, '2026_02_15_084649_create_orders_table', 1),
(6, '2026_02_15_084649_create_products_table', 1),
(7, '2026_02_15_084650_create_carts_table', 1),
(8, '2026_02_15_084650_create_order_items_table', 1),
(9, '2026_02_15_084651_create_cart_items_table', 1),
(10, '2026_02_21_065105_add_subtotal_to_carts_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('pending','confirmed','processing','shipped','delivered','cancelled') NOT NULL DEFAULT 'pending',
  `payment_method` enum('cod','bank_transfer','online') NOT NULL DEFAULT 'cod',
  `payment_status` enum('pending','paid','failed') NOT NULL DEFAULT 'pending',
  `subtotal` decimal(10,2) NOT NULL,
  `tax` decimal(10,2) NOT NULL DEFAULT 0.00,
  `shipping_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `discount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total` decimal(10,2) NOT NULL,
  `shipping_name` varchar(255) NOT NULL,
  `shipping_email` varchar(255) NOT NULL,
  `shipping_phone` varchar(255) NOT NULL,
  `shipping_address` text NOT NULL,
  `shipping_city` varchar(255) NOT NULL,
  `shipping_postal_code` varchar(255) NOT NULL,
  `notes` text DEFAULT NULL,
  `confirmed_at` timestamp NULL DEFAULT NULL,
  `shipped_at` timestamp NULL DEFAULT NULL,
  `delivered_at` timestamp NULL DEFAULT NULL,
  `cancelled_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_sku` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `short_description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `compare_price` decimal(10,2) DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `sku` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`images`)),
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `views` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `description`, `short_description`, `price`, `compare_price`, `stock`, `sku`, `image`, `images`, `is_featured`, `is_active`, `views`, `created_at`, `updated_at`) VALUES
(1, 1, 'Pandesal', 'pandesal', 'Soft, warm, and slightly sweet bread rolls perfect for breakfast or snacks.', 'Classic Filipino breakfast bread rolls', 5.00, NULL, 200, 'PRD-AI9LYYVG', 'https://upload.wikimedia.org/wikipedia/commons/2/21/Pandesal.jpg', NULL, 1, 1, 0, '2026-02-20 23:41:45', '2026-02-20 23:41:45'),
(2, 1, 'Banana Bread', 'banana-bread', 'Rich, moist, and full of banana flavor. Perfect with coffee or tea.', 'Moist banana bread loaf', 120.00, NULL, 50, 'PRD-V62YEWJZ', 'https://upload.wikimedia.org/wikipedia/commons/4/4a/Banana_bread_with_sliced_bananas.jpg', NULL, 1, 1, 0, '2026-02-20 23:41:45', '2026-02-20 23:41:45'),
(3, 1, 'Ciabatta', 'ciabatta', 'Crusty exterior with soft airy interior, perfect for sandwiches.', 'Italian white bread with crispy crust', 150.00, NULL, 30, 'PRD-JOANARN3', 'https://upload.wikimedia.org/wikipedia/commons/8/87/Ciabatta_bread.jpg', NULL, 0, 1, 0, '2026-02-20 23:41:45', '2026-02-20 23:41:45'),
(4, 2, 'Ensaymada', 'ensaymada', 'Fluffy, buttery, and topped with sugar and cheese. A Filipino classic.', 'Soft and sweet brioche pastry topped with cheese', 35.00, NULL, 100, 'PRD-Z3SAPVPC', 'https://upload.wikimedia.org/wikipedia/commons/5/5c/Ensaymada_bread.jpg', NULL, 1, 1, 1, '2026-02-20 23:41:45', '2026-02-21 00:00:30'),
(5, 2, 'Chocolate Croissant', 'chocolate-croissant', 'Golden, buttery, and filled with rich chocolate. Perfect for breakfast or dessert.', 'Flaky pastry filled with chocolate', 50.00, NULL, 60, 'PRD-8UE9DWFV', 'https://upload.wikimedia.org/wikipedia/commons/b/b2/Chocolate_croissant.jpg', NULL, 1, 1, 0, '2026-02-20 23:41:45', '2026-02-20 23:41:45'),
(6, 2, 'Apple Turnover', 'apple-turnover', 'Delicious baked pastry with sweet apple and cinnamon filling.', 'Flaky pastry with apple filling', 45.00, NULL, 40, 'PRD-Q9LML49Q', 'https://upload.wikimedia.org/wikipedia/commons/7/7d/Apple_turnovers.jpg', NULL, 0, 1, 0, '2026-02-20 23:41:45', '2026-02-20 23:41:45'),
(7, 2, 'Danish Pastry', 'danish-pastry', 'Flaky pastry layered and topped with fruit or custard filling.', 'Layered sweet pastry with fruit topping', 60.00, NULL, 55, 'PRD-MLWYP56Y', 'https://upload.wikimedia.org/wikipedia/commons/9/94/Danish_pastry.jpg', NULL, 1, 1, 0, '2026-02-20 23:41:45', '2026-02-20 23:41:45'),
(8, 3, 'Ube Cake', 'ube-cake', 'Soft and moist cake made with ube, perfect for birthdays and special occasions.', 'Filipino purple yam cake', 750.00, NULL, 20, 'PRD-E4RODWJN', 'products/5YiBvFqL1Ls7s1PmlzXG6FiwrMFajk4zVOQ96XaE.jpg', NULL, 1, 1, 1, '2026-02-20 23:41:46', '2026-02-21 00:01:38'),
(9, 3, 'Chocolate Cake', 'chocolate-cake', 'Classic chocolate cake with chocolate frosting, perfect for celebrations.', 'Rich chocolate layered cake', 800.00, NULL, 25, 'PRD-AWAPTRBZ', 'https://upload.wikimedia.org/wikipedia/commons/4/44/Chocolate_cake_slice.jpg', NULL, 1, 1, 0, '2026-02-20 23:41:46', '2026-02-20 23:41:46'),
(10, 3, 'Cheesecake', 'cheesecake', 'Smooth, rich, and creamy cheesecake with graham cracker crust.', 'Creamy New York style cheesecake', 900.00, NULL, 15, 'PRD-UQMHDUN2', 'https://upload.wikimedia.org/wikipedia/commons/4/4b/Classic_cheesecake.jpg', NULL, 1, 1, 0, '2026-02-20 23:41:46', '2026-02-20 23:41:46'),
(11, 3, 'Red Velvet Cake', 'red-velvet-cake', 'Moist and soft red velvet cake topped with sweet cream cheese frosting.', 'Velvety red cake with cream cheese frosting', 850.00, NULL, 18, 'PRD-VAMYAINQ', 'https://upload.wikimedia.org/wikipedia/commons/8/87/Red_Velvet_Cake.jpg', NULL, 0, 1, 0, '2026-02-20 23:41:46', '2026-02-20 23:41:46'),
(12, 4, 'Chocolate Chip Cookies', 'chocolate-chip-cookies', 'Classic cookies loaded with chocolate chips. Perfect with milk or coffee.', 'Crispy outside, chewy inside', 15.00, NULL, 150, 'PRD-0VVK182R', 'https://upload.wikimedia.org/wikipedia/commons/6/6f/Chocolate_Chip_Cookies_-_kimberlykv.jpg', NULL, 1, 1, 0, '2026-02-20 23:41:46', '2026-02-20 23:41:46'),
(13, 4, 'Blueberry Muffin', 'blueberry-muffin', 'Delicious and fluffy muffin filled with fresh blueberries.', 'Soft muffin packed with blueberries', 40.00, NULL, 80, 'PRD-4LERH98Q', 'https://upload.wikimedia.org/wikipedia/commons/1/15/Blueberry_muffin.jpg', NULL, 0, 1, 0, '2026-02-20 23:41:46', '2026-02-20 23:41:46'),
(14, 4, 'Carrot Cupcake', 'carrot-cupcake', 'Delicious carrot cupcake topped with smooth cream cheese frosting.', 'Moist carrot cupcake with cream cheese frosting', 55.00, NULL, 60, 'PRD-85BOM2BS', 'https://upload.wikimedia.org/wikipedia/commons/7/70/Carrot_cupcake.jpg', NULL, 1, 1, 0, '2026-02-20 23:41:46', '2026-02-20 23:41:46'),
(15, 4, 'Macarons', 'macarons', 'Delicate and colorful macarons with assorted flavors.', 'Colorful French meringue cookies', 120.00, NULL, 45, 'PRD-KHUFCVC9', 'https://upload.wikimedia.org/wikipedia/commons/a/ab/Macarons_colorful.jpg', NULL, 0, 1, 0, '2026-02-20 23:41:46', '2026-02-20 23:41:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('customer','admin') NOT NULL DEFAULT 'customer',
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `postal_code` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `phone`, `address`, `city`, `postal_code`, `avatar`, `is_active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'admin@example.com', NULL, '$2y$12$H/lTcru.jAR3N5/Ymj6JKOvP3rQAh2R2x0jcqGa1J0MogbqluIlsS', 'admin', '+63 912 345 6789', '123 Admin Street, La Union', 'San Fernando', '2500', NULL, 1, NULL, '2026-02-20 23:41:45', '2026-02-20 23:41:45'),
(2, 'John Customer', 'customer@example.com', NULL, '$2y$12$OYHAAmxyhAkWhrn4ByW6qeil1E./22.eXqnTsDaNIln4q1UZ//lUu', 'customer', '+63 998 765 4321', '456 Customer Ave, La Union', 'San Fernando', '2500', NULL, 1, NULL, '2026-02-20 23:41:45', '2026-02-20 23:41:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_session_id_index` (`user_id`,`session_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cart_items_cart_id_product_id_unique` (`cart_id`,`product_id`),
  ADD KEY `cart_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

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
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_number_unique` (`order_number`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD UNIQUE KEY `products_sku_unique` (`sku`),
  ADD KEY `products_category_id_foreign` (`category_id`);

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
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
