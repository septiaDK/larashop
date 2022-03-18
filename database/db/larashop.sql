-- Adminer 4.8.1 MySQL 5.7.33 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `books`;
CREATE TABLE `books` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `publisher` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double(8,2) NOT NULL,
  `views` int(10) unsigned NOT NULL DEFAULT '0',
  `stock` int(10) unsigned NOT NULL DEFAULT '0',
  `status` enum('PUBLISH','DRAFT') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `books` (`id`, `title`, `slug`, `description`, `author`, `publisher`, `cover`, `price`, `views`, `stock`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	'The Book I',	'the-book',	'Description about the book',	'Muhammad Azamuddin',	'Indie',	'',	199000.00,	0,	190,	'PUBLISH',	1,	1,	NULL,	'2020-12-15 02:22:07',	'2020-12-15 02:39:57',	NULL),
(2,	'How to be Ninja Developer',	'how-to-be-ninja-developer',	'The description',	'Muhammad Azamuddin',	'Indie',	'',	299000.00,	0,	1,	'PUBLISH',	1,	1,	NULL,	'2020-12-15 03:44:34',	'2021-11-24 05:33:53',	NULL),
(4,	'How to be Rockstar Developer',	'how-to-be-rockstar-developer',	'The description about the book',	'Muhammad Azamuddin',	'Indie',	'',	290000.00,	0,	99,	'PUBLISH',	1,	1,	NULL,	'2020-12-15 03:46:40',	'2021-11-24 05:33:59',	NULL),
(5,	'Pejuang Programmer Edit',	'pejuang-programmer-edit',	'buku tentang certia pejuang programmer lembur',	'Septia',	'Septia',	NULL,	100000.00,	0,	0,	'PUBLISH',	6,	6,	NULL,	'2021-11-27 23:05:19',	'2021-11-27 23:16:47',	NULL);

DROP TABLE IF EXISTS `book_category`;
CREATE TABLE `book_category` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `book_id` bigint(20) unsigned DEFAULT NULL,
  `category_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `book_category_book_id_foreign` (`book_id`),
  KEY `book_category_category_id_foreign` (`category_id`),
  CONSTRAINT `book_category_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
  CONSTRAINT `book_category_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `book_category` (`id`, `book_id`, `category_id`, `created_at`, `updated_at`) VALUES
(2,	1,	1,	NULL,	NULL),
(3,	2,	1,	NULL,	NULL),
(4,	4,	1,	NULL,	NULL),
(5,	5,	1,	NULL,	NULL);

DROP TABLE IF EXISTS `book_order`;
CREATE TABLE `book_order` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) unsigned NOT NULL,
  `book_id` bigint(20) unsigned NOT NULL,
  `quantity` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `book_order_order_id_foreign` (`order_id`),
  KEY `book_order_book_id_foreign` (`book_id`),
  CONSTRAINT `book_order_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
  CONSTRAINT `book_order_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `book_order` (`id`, `order_id`, `book_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1,	1,	2,	1,	NULL,	NULL),
(2,	2,	4,	2,	NULL,	NULL);

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'berisi nama file image saja tanpa path',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `categories` (`id`, `name`, `slug`, `image`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1,	'Sepatu New Edition',	'sepatu-new-edition',	'category_images/eXPOcxhWmf5amVnVeCpTTktFxowCr6hSnqx3KbGU.png',	1,	1,	NULL,	NULL,	'2020-12-14 09:46:08',	'2021-11-25 08:00:57');

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1,	'2014_10_12_000000_create_users_table',	1),
(2,	'2014_10_12_100000_create_password_resets_table',	1),
(3,	'2019_08_19_000000_create_failed_jobs_table',	1),
(4,	'2020_12_14_021856_penyesuaian_table_users',	2),
(6,	'2020_12_14_092710_create_categories',	3),
(7,	'2020_12_14_115414_create_books_table',	4),
(10,	'2020_12_14_115606_create_book_category_table',	5),
(11,	'2020_12_15_031924_create_orders_table',	6),
(12,	'2020_12_15_032159_create_book_order_table',	7);

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `total_price` double(8,2) unsigned NOT NULL,
  `invoice_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('SUBMIT','PROCESS','FINISH','CANCEL') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_user_id_foreign` (`user_id`),
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `orders` (`id`, `user_id`, `total_price`, `invoice_number`, `status`, `created_at`, `updated_at`) VALUES
(1,	4,	299000.00,	'202012140001',	'FINISH',	'2020-12-12 11:01:50',	NULL),
(2,	5,	580000.00,	'202012250002',	'PROCESS',	'2020-12-25 11:01:57',	NULL);

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('ACTIVE','INACTIVE') COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `username`, `roles`, `address`, `phone`, `avatar`, `status`) VALUES
(1,	'Site Administrator',	'administrator@larashop.test',	NULL,	'$2y$10$bVkzcLNUybkPB/87HSAhAundk.pqAv3u8t4jPeEX96ucKL9BR92hO',	NULL,	'2020-12-14 02:29:07',	'2020-12-14 03:29:39',	'administrator',	'[\"ADMIN\"]',	'Sarmili, Bintaro, Tangerang Selatan',	NULL,	'',	'ACTIVE'),
(2,	'Muhammad Azamuddin',	'mas.azamuddin@gmail.com',	NULL,	'$2y$10$P7zYNFgcKVip77/.5k/dTup5mMCRq7cm7qg6nBWLOP7YLaIaYSDzG',	NULL,	'2020-12-14 03:20:07',	'2020-12-14 03:20:07',	'azamuddin',	'[\"CUSTOMER\"]',	'Jl Cempaka Sari III Jakarta Pusat\r\nKemayoran',	'085781107766',	'',	'ACTIVE'),
(4,	'Nadia N M',	'nadia.nm@gmail.com',	NULL,	'$2y$10$C3TgyddwCXcoca.m676Y9Osm//Qdc91FmK2nG8/3d9JULdEEYTOSq',	NULL,	'2020-12-15 03:48:42',	'2020-12-15 03:48:42',	'nadia.nm',	'[\"CUSTOMER\"]',	NULL,	'085781107755',	'',	'ACTIVE'),
(5,	'Johan Z D',	'johan.zd@gmail.com',	NULL,	'$2y$10$AKuoCook1Fuka8x10TyZwuLpxV4kB2I0JXPyFE0cpfQsqjgZQ1Pji',	NULL,	'2020-12-15 03:49:51',	'2021-11-25 07:22:43',	'johan.zd',	'[\"CUSTOMER\"]',	'sumbang rt 05/01, banyumas',	'08578110744',	'',	'ACTIVE'),
(6,	'Septia Dwi Kurniawan',	'septia@gmail.com',	NULL,	'$2y$10$CZ5LOKbsx7ej1/2W5eyLOOCl13FzDOzrR9Ux0TKzqWZJy7KPGKeoO',	NULL,	'2021-11-25 07:12:42',	'2021-11-25 07:12:42',	'septia',	'[\"STAFF\"]',	'Karangcegak RT 05/01',	'082133846582',	NULL,	'ACTIVE');

-- 2021-11-28 08:02:04
