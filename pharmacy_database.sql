-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 04, 2022 at 01:14 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pharmacy_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `photo`, `password`, `created_at`, `updated_at`, `name`) VALUES
(1, 'admin@gmail.com', NULL, '$2y$10$xioByEBf5D3I5Of.QoMLoeri5YzBqKz8wVqdArrVbAs7Q9xBF0nt2', '2022-05-08 14:50:10', '2022-05-08 14:50:10', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `statuse` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `details`, `statuse`, `created_at`, `updated_at`, `photo`) VALUES
(1, 'ابر', 'ابر', 1, '2022-05-07 05:52:15', '2022-05-08 09:14:16', '/assets/admin/images/categories/REWKEcjAVD56dXgGTJOVRvuThiqyBP23XslsVyPs.jpg'),
(2, 'مضادات حيوية', 'مضادات حيوية', 0, '2022-05-07 06:17:28', '2022-05-15 13:22:03', '/assets/admin/images/categories/fMOll0LWlvXxqU0YWrYsiCHMLjHQ8z607An3ctVW.jpg'),
(3, 'مغذية', 'مغذية', 1, '2022-05-07 06:24:55', '2022-05-15 13:21:21', '/assets/admin/images/categories/kFlvSkWxnCPuPRlgv9LM75uXBhtIY0htqC2WWjit.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medications`
--

DROP TABLE IF EXISTS `medications`;
CREATE TABLE IF NOT EXISTS `medications` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `trade_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `scientific_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `made_in` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `medications`
--

INSERT INTO `medications` (`id`, `trade_name`, `scientific_name`, `made_in`, `active`, `created_at`, `updated_at`, `photo`, `user_id`) VALUES
(4, 'pandoul', 'test_pandoul', 'yemen', 1, '2022-05-27 22:52:59', '2022-05-27 22:52:59', '/assets/admin/images/medications/M8jVI9dyT1PqZTUieOLBMtjfu0jG8IsL85Lb4Wc6.jpg', '1'),
(5, 'moxlen', 'test_moxclen', 'indonsyai', 1, '2022-05-27 22:57:50', '2022-05-27 22:57:50', '/assets/admin/images/medications/puFWY7YvbdAwSJZNzs9lpwnAdqeQJSozdcn8dDYA.jpg', '1'),
(6, 'parmoule', 'test_parmol', 'yemen', 1, '2022-05-27 22:59:04', '2022-05-27 22:59:04', '/assets/admin/images/medications/u8QBIc0fY9DfeKeR0WoxSbozLXRjBkGG6QUlDLPk.jpg', '2');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_03_28_234331_create_mypharmacy_table', 1),
(6, '2022_03_29_002516_create_medication_table', 1),
(7, '2022_03_29_003027_create_categories_table', 1),
(8, '2022_03_30_043248_update_create_medication_table', 1),
(9, '2022_04_02_200927_rename_medication_', 1),
(10, '2022_04_02_201621_rename_mypharmacy', 1),
(11, '2022_04_02_202121_create_medication_mypharmacys', 1),
(12, '2022_04_03_224345_create_phones_table', 1),
(13, '2022_05_04_174619_create_admins_table', 1),
(14, '2022_05_05_121254_adde_coloum_admin_', 1),
(15, '2022_05_06_151720_adde_coloum_category', 1),
(16, '2022_05_08_174753_adde_coloum_status_user', 2),
(17, '2022_05_12_105607_adde_coloum_to_pharmacy', 3),
(18, '2022_05_12_224318_adde_phone_sochail_coloum_to_pharmacy', 4),
(19, '2022_05_13_010631_adde_photo_coloum_to_pharmacy', 5),
(20, '2022_05_13_075538_update_create_mypharmacys_taple', 6),
(21, '2022_05_15_141033_adde_coloum_photo_to_medications_table', 7),
(22, '2022_05_15_141909_adde_coloum_user_id_to_medications_table', 8),
(23, '2022_05_17_231816_adde_coloum_price_to_medications_table', 9),
(24, '2022_05_20_101322_adde_coloum_user_id_to_medication_mypharmacys_table', 10),
(25, '2022_05_22_065453_droup_coloum_status_to_medications_table', 11),
(26, '2022_05_22_070224_adde_coloum_quntity_and_status_to_medication_mypharmacys_table', 12),
(27, '2022_05_22_071727_droup_coloum_price_to_medications_table', 13),
(28, '2022_05_22_074249_adde_coloum_production_date_and_expiry_date__to_medication_mypharmacys_table', 14),
(29, '2022_05_22_074539_droup_coloum_production_date_and_expiry_date_to_medications', 15),
(30, '2022_05_22_083007_droup_coloum_categorie_id_to_medications', 16),
(31, '2022_05_22_083329_adde_coloum_categorie_id_to_medication_mypharmacys_table', 17);

-- --------------------------------------------------------

--
-- Table structure for table `mypharmacys`
--

DROP TABLE IF EXISTS `mypharmacys`;
CREATE TABLE IF NOT EXISTS `mypharmacys` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile1` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile2` varchar(9) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_media` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pdf_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `statuse` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mypharmacys`
--

INSERT INTO `mypharmacys` (`id`, `name`, `address`, `mobile1`, `mobile2`, `social_media`, `user_id`, `photo`, `pdf_path`, `statuse`, `created_at`, `updated_at`) VALUES
(3, 'حياتي', 'السنينة', '73689556', '789125647', 'ww.come.com', '2', '/assets/admin/images/users/oPnYBTBXYDMHcesK6kexuLkf56HLRvkOAFfPW5dy.jpg', '/assets/admin/pdf/cves/3NHgQgrjjELRkJlfEAnfPpyb2Th4IiuYsUxQV8HO.pdf', 1, '2022-06-03 05:35:23', '2022-06-03 05:35:23'),
(2, 'الحياني', '20street', '735219591', '789734567', 'ww.come.com', '1', '/assets/admin/images/users/vam9NGbcq0JOxL1nDDMqnuRtHXuydc9tYM2sc04E.jpg', '/assets/admin/pdf/cves/RoeXeYtyV44Ju29ELvQXerSC9RPniTxDsuDA6l2B.pdf', 1, '2022-05-22 10:34:07', '2022-05-22 10:34:07');

-- --------------------------------------------------------

--
-- Table structure for table `mypharmacy_medication`
--

DROP TABLE IF EXISTS `mypharmacy_medication`;
CREATE TABLE IF NOT EXISTS `mypharmacy_medication` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `mypharmacy_id` int(11) NOT NULL,
  `medication_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quntity` int(11) NOT NULL,
  `price` double NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `production_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  `categorie_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mypharmacy_medication`
--

INSERT INTO `mypharmacy_medication` (`id`, `mypharmacy_id`, `medication_id`, `created_at`, `updated_at`, `user_id`, `quntity`, `price`, `status`, `production_date`, `expiry_date`, `categorie_id`) VALUES
(2, 2, 5, '2022-06-01 12:46:50', '2022-06-01 12:46:50', '1', 45, 2500, 1, '2022-06-01', '2022-06-25', '1'),
(3, 3, 4, '2022-06-03 05:36:35', '2022-06-03 05:36:35', '2', 45, 2500, 1, '2022-06-17', '2022-07-01', '1'),
(4, 2, 4, '2022-06-03 10:31:47', '2022-06-03 10:31:47', '1', 8, 23, 1, '2022-06-24', '2022-07-06', '3');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('yassen.770355274@gmail.com', '$2y$10$nU.2/q20NA8XoiaHL2il1eW3qSbmQW33lOJIhhFpurWpFbDaDYOeS', '2022-05-11 09:09:53');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `statuse` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `statuse`) VALUES
(1, 'yassen', 'yassen.770355274@gmail.com', NULL, '$2y$10$W6M3lYNrEWv7bnC2Dq6DX.6e0RN.IKCsxZBv9eMuPFnvNf5wcUUdS', NULL, '2022-05-08 15:00:34', '2022-05-14 18:17:33', 1),
(2, 'reanad', 'renad@gmail.com', NULL, '$2y$10$W6M3lYNrEWv7bnC2Dq6DX.6e0RN.IKCsxZBv9eMuPFnvNf5wcUUdS', NULL, '2022-05-09 06:51:33', '2022-05-22 21:40:02', 1),
(3, 'adell', 'adell@gmail.com', NULL, '$2y$10$5dJy8a9GZVctyY7iwL7j.utR4L7L3I4jpmNaj/K/Z.sqefd8R5mYa', NULL, '2022-05-10 13:48:02', '2022-05-10 13:52:02', 1),
(4, 'yy', 'yy@gmail.com', NULL, '$2y$10$9YT.FBWidj9jwZYq3zk0KuBUpG05nmQG6OmxuFe3PZuHENWa12x7y', NULL, '2022-05-11 08:49:44', '2022-05-11 08:49:44', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
