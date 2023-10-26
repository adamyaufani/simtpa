-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.18 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table sim-tpa.administrators
CREATE TABLE IF NOT EXISTS `administrators` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `director` bigint(20) unsigned DEFAULT NULL,
  `vice_director` bigint(20) unsigned DEFAULT NULL,
  `secretary` bigint(20) unsigned DEFAULT NULL,
  `treasurer` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `administrators_user_id_foreign` (`user_id`),
  KEY `administrators_director_foreign` (`director`),
  KEY `administrators_vice_director_foreign` (`vice_director`),
  KEY `administrators_secretary_foreign` (`secretary`),
  KEY `administrators_treasurer_foreign` (`treasurer`),
  CONSTRAINT `administrators_director_foreign` FOREIGN KEY (`director`) REFERENCES `staffs` (`id`) ON DELETE CASCADE,
  CONSTRAINT `administrators_secretary_foreign` FOREIGN KEY (`secretary`) REFERENCES `staffs` (`id`) ON DELETE CASCADE,
  CONSTRAINT `administrators_treasurer_foreign` FOREIGN KEY (`treasurer`) REFERENCES `staffs` (`id`) ON DELETE CASCADE,
  CONSTRAINT `administrators_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `administrators_vice_director_foreign` FOREIGN KEY (`vice_director`) REFERENCES `staffs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sim-tpa.administrators: ~0 rows (approximately)
/*!40000 ALTER TABLE `administrators` DISABLE KEYS */;
INSERT INTO `administrators` (`id`, `created_at`, `updated_at`, `user_id`, `director`, `vice_director`, `secretary`, `treasurer`) VALUES
	(1, '2023-10-10 09:56:28', '2023-10-10 09:56:28', 1, NULL, NULL, NULL, NULL),
	(2, '2023-10-12 10:34:18', '2023-10-12 10:34:18', 2, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `administrators` ENABLE KEYS */;

-- Dumping structure for table sim-tpa.admins
CREATE TABLE IF NOT EXISTS `admins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` bigint(20) unsigned DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`),
  KEY `admins_role_id_foreign` (`role_id`),
  CONSTRAINT `admins_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sim-tpa.admins: ~0 rows (approximately)
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` (`id`, `username`, `email`, `password`, `fullname`, `phone`, `role_id`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'admin@site.com', '$2y$10$kdHYzU.nPQoU.OQJnxPLX.INYQ3IxWjxCXbK8kgXnf1C0DYu9oJiW', 'admin', '123456789', 1, NULL, NULL, NULL);
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;

-- Dumping structure for table sim-tpa.agreements
CREATE TABLE IF NOT EXISTS `agreements` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `year_start` date DEFAULT NULL,
  `year_end` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sim-tpa.agreements: ~0 rows (approximately)
/*!40000 ALTER TABLE `agreements` DISABLE KEYS */;
INSERT INTO `agreements` (`id`, `year_start`, `year_end`, `created_at`, `updated_at`) VALUES
	(1, '2023-10-09', '2024-10-09', '2023-10-09 09:12:47', '2023-10-09 09:12:47');
/*!40000 ALTER TABLE `agreements` ENABLE KEYS */;

-- Dumping structure for table sim-tpa.carts
CREATE TABLE IF NOT EXISTS `carts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `training_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `carts_user_id_foreign` (`user_id`),
  KEY `carts_training_id_foreign` (`training_id`),
  CONSTRAINT `carts_training_id_foreign` FOREIGN KEY (`training_id`) REFERENCES `trainings` (`id`) ON DELETE CASCADE,
  CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sim-tpa.carts: ~0 rows (approximately)
/*!40000 ALTER TABLE `carts` DISABLE KEYS */;
/*!40000 ALTER TABLE `carts` ENABLE KEYS */;

-- Dumping structure for table sim-tpa.cart_items
CREATE TABLE IF NOT EXISTS `cart_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cart_id` bigint(20) unsigned DEFAULT NULL,
  `student_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cart_items_cart_id_foreign` (`cart_id`),
  KEY `cart_items_student_id_foreign` (`student_id`),
  CONSTRAINT `cart_items_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `cart_items_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sim-tpa.cart_items: ~0 rows (approximately)
/*!40000 ALTER TABLE `cart_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `cart_items` ENABLE KEYS */;

-- Dumping structure for table sim-tpa.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sim-tpa.categories: ~0 rows (approximately)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `created_at`, `updated_at`, `name`, `description`) VALUES
	(1, '2023-10-09 09:11:58', '2023-10-09 09:11:58', 'lomba', 'asdasda'),
	(2, '2023-10-14 04:28:05', '2023-10-14 04:28:05', 'outbound', 'asdasd');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Dumping structure for table sim-tpa.certificates
CREATE TABLE IF NOT EXISTS `certificates` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) unsigned DEFAULT NULL,
  `participant_id` bigint(20) unsigned DEFAULT NULL,
  `bg_image` text COLLATE utf8mb4_unicode_ci,
  `template` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `certificates_order_id_foreign` (`order_id`),
  KEY `certificates_participant_id_foreign` (`participant_id`),
  CONSTRAINT `certificates_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `certificates_participant_id_foreign` FOREIGN KEY (`participant_id`) REFERENCES `participants` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sim-tpa.certificates: ~0 rows (approximately)
/*!40000 ALTER TABLE `certificates` DISABLE KEYS */;
/*!40000 ALTER TABLE `certificates` ENABLE KEYS */;

-- Dumping structure for table sim-tpa.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sim-tpa.migrations: ~20 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_100000_create_password_resets_table', 1),
	(2, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(3, '2023_05_15_062854_create_roles_table', 1),
	(4, '2023_05_16_020745_create_categories_table', 1),
	(5, '2023_05_16_062854_create_users_table', 1),
	(6, '2023_05_16_062855_create_admins_table', 1),
	(7, '2023_05_16_062855_create_students_table', 1),
	(8, '2023_05_17_084334_create_trainings_table', 1),
	(9, '2023_05_17_084400_create_trainers_table', 1),
	(10, '2023_05_17_092748_create_training_trainer_table', 1),
	(11, '2023_05_19_024012_create_orders_table', 1),
	(12, '2023_05_19_025354_create_participants_table', 1),
	(13, '2023_05_19_030519_create_order_participants_table', 1),
	(14, '2023_05_19_034438_create_certificates_table', 1),
	(15, '2023_08_14_043958_create_quota_per_orgs_table', 1),
	(16, '2023_08_16_090532_create_agreements_table', 1),
	(17, '2023_08_16_090905_create_user_agreements_table', 1),
	(18, '2023_09_26_085425_create_user_profiles_table', 1),
	(19, '2023_09_28_074059_create_villages_table', 1),
	(20, '2023_09_30_021948_create_staffs_table', 1),
	(21, '2023_09_30_022138_create_administrators_table', 1),
	(22, '2023_10_09_032039_create_carts_table', 1),
	(23, '2023_10_09_090519_create_cart_items_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table sim-tpa.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `transaction_id` bigint(20) DEFAULT NULL,
  `payment_method` enum('Transfer','Midtrans') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `training_id` bigint(20) unsigned DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `payment_amount` bigint(20) DEFAULT NULL,
  `status_order` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_training_id_foreign` (`training_id`),
  KEY `orders_user_id_foreign` (`user_id`),
  KEY `transaction_id` (`transaction_id`),
  CONSTRAINT `orders_training_id_foreign` FOREIGN KEY (`training_id`) REFERENCES `trainings` (`id`) ON DELETE CASCADE,
  CONSTRAINT `orders_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sim-tpa.orders: ~2 rows (approximately)
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;

-- Dumping structure for table sim-tpa.order_participants
CREATE TABLE IF NOT EXISTS `order_participants` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint(20) unsigned DEFAULT NULL,
  `order_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_participants_student_id_foreign` (`student_id`),
  KEY `order_participants_order_id_foreign` (`order_id`),
  CONSTRAINT `order_participants_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_participants_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sim-tpa.order_participants: ~5 rows (approximately)
/*!40000 ALTER TABLE `order_participants` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_participants` ENABLE KEYS */;

-- Dumping structure for table sim-tpa.participants
CREATE TABLE IF NOT EXISTS `participants` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `participants_user_id_foreign` (`user_id`),
  CONSTRAINT `participants_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sim-tpa.participants: ~0 rows (approximately)
/*!40000 ALTER TABLE `participants` DISABLE KEYS */;
/*!40000 ALTER TABLE `participants` ENABLE KEYS */;

-- Dumping structure for table sim-tpa.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sim-tpa.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table sim-tpa.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sim-tpa.personal_access_tokens: ~0 rows (approximately)
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- Dumping structure for table sim-tpa.quota_per_orgs
CREATE TABLE IF NOT EXISTS `quota_per_orgs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `quota` int(11) DEFAULT NULL,
  `training_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quota_per_orgs_training_id_foreign` (`training_id`),
  CONSTRAINT `quota_per_orgs_training_id_foreign` FOREIGN KEY (`training_id`) REFERENCES `trainings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sim-tpa.quota_per_orgs: ~0 rows (approximately)
/*!40000 ALTER TABLE `quota_per_orgs` DISABLE KEYS */;
/*!40000 ALTER TABLE `quota_per_orgs` ENABLE KEYS */;

-- Dumping structure for table sim-tpa.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sim-tpa.roles: ~2 rows (approximately)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `role`) VALUES
	(1, 'admin'),
	(2, 'user');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Dumping structure for table sim-tpa.staffs
CREATE TABLE IF NOT EXISTS `staffs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employment_status` enum('pns','non pns') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `civil_registration_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_formal_education` enum('Tidak memiliki pendidikan formal','SD/MI/Sederajat','SMP/MTs/Sederajat','SMA/MA/Sederajat','D1','D2','D3','S1/D4','S2','S3') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `length_of_islamic_education` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `core_competency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `staffs_user_id_foreign` (`user_id`),
  CONSTRAINT `staffs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sim-tpa.staffs: ~0 rows (approximately)
/*!40000 ALTER TABLE `staffs` DISABLE KEYS */;
/*!40000 ALTER TABLE `staffs` ENABLE KEYS */;

-- Dumping structure for table sim-tpa.students
CREATE TABLE IF NOT EXISTS `students` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('laki-laki','perempuan') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_place` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `school` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `join_date` date DEFAULT NULL,
  `status` enum('lulus','belum lulus') COLLATE utf8mb4_unicode_ci DEFAULT 'belum lulus',
  `ability_level_upon_entry` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_certificate` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `students_user_id_foreign` (`user_id`),
  CONSTRAINT `students_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sim-tpa.students: ~5 rows (approximately)
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` (`id`, `created_at`, `updated_at`, `user_id`, `name`, `gender`, `birth_place`, `birth_date`, `address`, `father_name`, `mother_name`, `phone`, `school`, `join_date`, `status`, `ability_level_upon_entry`, `birth_certificate`) VALUES
	(1, '2023-10-09 09:14:19', '2023-10-09 09:14:19', 1, 'Thaddeus Fitzpatrick', 'perempuan', 'Ipsum eos natus quis', '1975-11-28', 'Illum amet deserun', 'Dexter Weaver', 'Rhoda Douglas', '+1 (518) 622-5132', 'Exercitation ipsum m', '1990-06-13', 'belum lulus', 'Praesentium in praes', 'users/birth_certificate/1/bae8f15c-66f0-4ad9-b9a7-af27f9e19f93.jpg'),
	(2, '2023-10-09 09:14:26', '2023-10-09 09:14:26', 1, 'Brennan Barr', 'laki-laki', 'Laudantium dolor qu', '1997-08-04', 'Doloribus repellendu', 'Jocelyn Baker', 'Ruth Slater', '+1 (392) 779-1571', 'Est similique volup', '2020-11-21', 'lulus', 'Quo omnis anim dolor', 'users/birth_certificate/1/bae8f15c-66f0-4ad9-b9a7-af27f9e19f93.jpg'),
	(3, '2023-10-09 09:14:31', '2023-10-09 09:14:31', 1, 'Blaine Faulkner', 'perempuan', 'Qui voluptatem Fugi', '2008-09-10', 'Eveniet et consequa', 'Nichole Griffith', 'Martena Faulkner', '+1 (726) 864-9132', 'Nihil quia dignissim', '2017-05-21', 'lulus', 'Consectetur veniam', 'users/birth_certificate/1/bae8f15c-66f0-4ad9-b9a7-af27f9e19f93.jpg'),
	(4, '2023-10-13 03:14:27', '2023-10-13 03:14:28', 2, 'Ray Barry', 'perempuan', 'Omnis nostrud culpa', '2011-04-22', 'Nobis ea sed et odit', 'Chanda Thomas', 'Leila Gross', '+1 (153) 592-3055', 'Nihil nostrum totam', '2018-04-16', 'belum lulus', 'Ipsa molestiae vita', 'users/birth_certificate/2/dummy Copy.jpg'),
	(5, '2023-10-13 03:14:35', '2023-10-13 03:14:36', 2, 'Sarah Hester', 'laki-laki', 'Est dolore in moles', '1978-04-16', 'Consequat Sed eos m', 'Nora Page', 'Doris Bentley', '+1 (695) 883-8634', 'Labore architecto ad', '1977-03-26', 'lulus', 'Incidunt aperiam ha', 'users/birth_certificate/2/bae8f15c-66f0-4ad9-b9a7-af27f9e19f93.jpg');
/*!40000 ALTER TABLE `students` ENABLE KEYS */;

-- Dumping structure for table sim-tpa.trainers
CREATE TABLE IF NOT EXISTS `trainers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sim-tpa.trainers: ~0 rows (approximately)
/*!40000 ALTER TABLE `trainers` DISABLE KEYS */;
/*!40000 ALTER TABLE `trainers` ENABLE KEYS */;

-- Dumping structure for table sim-tpa.trainings
CREATE TABLE IF NOT EXISTS `trainings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `cost` enum('paid','free') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price_earlybird` bigint(20) DEFAULT NULL,
  `price_normal` bigint(20) DEFAULT NULL,
  `price_onsite` bigint(20) DEFAULT NULL,
  `earlybird_end` date DEFAULT NULL,
  `place` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('online','onsite') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `quota` bigint(20) DEFAULT NULL,
  `gender_requirement` enum('laki-laki','perempuan','laki-laki dan perempuan') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth_requirement` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trainings_category_id_foreign` (`category_id`),
  CONSTRAINT `trainings_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sim-tpa.trainings: ~4 rows (approximately)
/*!40000 ALTER TABLE `trainings` DISABLE KEYS */;
/*!40000 ALTER TABLE `trainings` ENABLE KEYS */;

-- Dumping structure for table sim-tpa.training_trainer
CREATE TABLE IF NOT EXISTS `training_trainer` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `training_id` bigint(20) unsigned DEFAULT NULL,
  `trainer_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `training_trainer_training_id_foreign` (`training_id`),
  KEY `training_trainer_trainer_id_foreign` (`trainer_id`),
  CONSTRAINT `training_trainer_trainer_id_foreign` FOREIGN KEY (`trainer_id`) REFERENCES `trainers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `training_trainer_training_id_foreign` FOREIGN KEY (`training_id`) REFERENCES `trainings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sim-tpa.training_trainer: ~0 rows (approximately)
/*!40000 ALTER TABLE `training_trainer` DISABLE KEYS */;
/*!40000 ALTER TABLE `training_trainer` ENABLE KEYS */;

-- Dumping structure for table sim-tpa.transactions
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `payment_method` enum('Transfer','Midtrans') DEFAULT NULL,
  `transaction_date` datetime DEFAULT NULL,
  `payment_date` datetime DEFAULT NULL,
  `payment_amount` bigint(20) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `transaction_id` bigint(20) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transactions_user_id_foreign` (`user_id`),
  CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- Dumping data for table sim-tpa.transactions: ~0 rows (approximately)
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;

-- Dumping structure for table sim-tpa.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verification_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verification_date` timestamp NULL DEFAULT NULL,
  `role_id` bigint(20) unsigned DEFAULT '2',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sim-tpa.users: ~0 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `email`, `password`, `verification_status`, `verification_date`, `role_id`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, NULL, 'dono@mailinator.com', '$2y$10$P0GMLcHqoPGtvALaWEWoHeCloMk4FvYihYADexXtIHhH2ohjFtOsC', '1', '2023-10-09 09:11:20', 2, NULL, '2023-10-09 09:10:47', '2023-10-09 09:11:20'),
	(2, NULL, 'wiworojati@gmail.com', '$2y$10$AitwJPWm93.gpUQLwPWQG.tkGZ0gY3dr9//BZ05lNNmHNBVbFOKyi', '1', '2023-10-12 09:45:24', 2, NULL, '2023-10-12 09:45:12', '2023-10-12 09:45:24');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table sim-tpa.user_agreements
CREATE TABLE IF NOT EXISTS `user_agreements` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `agreement_id` bigint(20) unsigned DEFAULT NULL,
  `sign` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_agreements_user_id_foreign` (`user_id`),
  KEY `user_agreements_agreement_id_foreign` (`agreement_id`),
  CONSTRAINT `user_agreements_agreement_id_foreign` FOREIGN KEY (`agreement_id`) REFERENCES `agreements` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_agreements_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sim-tpa.user_agreements: ~0 rows (approximately)
/*!40000 ALTER TABLE `user_agreements` DISABLE KEYS */;
INSERT INTO `user_agreements` (`id`, `user_id`, `agreement_id`, `sign`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 1, '2023-10-11 02:27:23', '2023-10-11 02:27:23'),
	(2, 2, 1, 1, '2023-10-12 10:34:35', '2023-10-12 10:34:35');
/*!40000 ALTER TABLE `user_agreements` ENABLE KEYS */;

-- Dumping structure for table sim-tpa.user_profiles
CREATE TABLE IF NOT EXISTS `user_profiles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `institution_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nspq_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supervisory_institution_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `years_of_establishment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `village` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tiktok` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gmap_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sk_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sk_number_starting_date` date DEFAULT NULL,
  `sk_number_ending_date` date DEFAULT NULL,
  `sk_file` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_profiles_user_id_foreign` (`user_id`),
  CONSTRAINT `user_profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sim-tpa.user_profiles: ~0 rows (approximately)
/*!40000 ALTER TABLE `user_profiles` DISABLE KEYS */;
INSERT INTO `user_profiles` (`id`, `user_id`, `institution_name`, `nspq_number`, `supervisory_institution_name`, `years_of_establishment`, `address`, `village`, `postal_code`, `phone_number`, `facebook`, `instagram`, `twitter`, `website`, `youtube`, `tiktok`, `gmap_address`, `sk_number`, `sk_number_starting_date`, `sk_number_ending_date`, `sk_file`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Kennedy Moses', NULL, NULL, NULL, 'Qui iusto consequatu', '4', NULL, '+1 (858) 107-9876', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-10-09 09:10:47', '2023-10-09 09:10:47'),
	(2, 2, 'Wiworojati', NULL, NULL, NULL, 'gonjen', '1', NULL, '085624567890', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-10-12 09:45:12', '2023-10-12 09:45:12');
/*!40000 ALTER TABLE `user_profiles` ENABLE KEYS */;

-- Dumping structure for table sim-tpa.villages
CREATE TABLE IF NOT EXISTS `villages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `village_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sim-tpa.villages: ~4 rows (approximately)
/*!40000 ALTER TABLE `villages` DISABLE KEYS */;
INSERT INTO `villages` (`id`, `village_name`, `created_at`, `updated_at`) VALUES
	(1, 'Tamantirto', NULL, NULL),
	(2, 'Tirtonirmolo', NULL, NULL),
	(3, 'Ngestiharjo', NULL, NULL),
	(4, 'Bangunjiwo', NULL, NULL);
/*!40000 ALTER TABLE `villages` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
