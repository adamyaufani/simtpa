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
	(1, 'admin', 'admin@site.com', '$2y$10$bz7Teu8a9JdcJ70mq1q/GO8E4.8Qy1ysGPzm/9hAuxndgLv9U.KrW', 'admin', '123456789', 1, NULL, NULL, NULL);
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;

-- Dumping structure for table sim-tpa.agreements
CREATE TABLE IF NOT EXISTS `agreements` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `year_start` date DEFAULT NULL,
  `year_end` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sim-tpa.agreements: ~0 rows (approximately)
/*!40000 ALTER TABLE `agreements` DISABLE KEYS */;
INSERT INTO `agreements` (`id`, `year_start`, `year_end`, `created_at`, `updated_at`) VALUES
	(8, '2022-08-28', '2026-08-28', '2023-08-28 06:50:48', '2023-08-28 06:50:48');
/*!40000 ALTER TABLE `agreements` ENABLE KEYS */;

-- Dumping structure for table sim-tpa.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sim-tpa.categories: ~0 rows (approximately)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `created_at`, `updated_at`, `name`, `description`) VALUES
	(1, '2023-08-10 06:12:00', '2023-08-10 06:12:00', 'Jordan Cooley', 'Incididunt accusanti');
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sim-tpa.migrations: ~15 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_100000_create_password_resets_table', 1),
	(2, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(3, '2023_05_15_062854_create_roles_table', 1),
	(4, '2023_05_16_020745_create_categories_table', 1),
	(5, '2023_05_16_062854_create_users_table', 1),
	(6, '2023_05_16_062855_create_admins_table', 1),
	(7, '2023_05_17_084334_create_trainings_table', 1),
	(8, '2023_05_17_084400_create_trainers_table', 1),
	(9, '2023_05_17_092748_create_training_trainer_table', 1),
	(10, '2023_05_19_024012_create_orders_table', 1),
	(11, '2023_05_19_025354_create_participants_table', 1),
	(12, '2023_05_19_030519_create_order_participant_table', 1),
	(13, '2023_05_19_034438_create_certificates_table', 1),
	(14, '2023_08_14_043958_create_quota_per_org_table', 2),
	(15, '2023_08_16_090532_create_agreements_table', 3),
	(17, '2023_08_16_090905_create_user_agreements_table', 4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table sim-tpa.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `payment_method` enum('Transfer','Midtrans') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `training_id` bigint(20) unsigned DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `payment_amount` bigint(20) DEFAULT NULL,
  `status_order` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_training_id_foreign` (`training_id`),
  KEY `orders_user_id_foreign` (`user_id`),
  CONSTRAINT `orders_training_id_foreign` FOREIGN KEY (`training_id`) REFERENCES `trainings` (`id`) ON DELETE CASCADE,
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sim-tpa.orders: ~3 rows (approximately)
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` (`id`, `payment_method`, `training_id`, `user_id`, `order_date`, `payment_date`, `payment_amount`, `status_order`, `transaction_id`, `created_at`, `updated_at`) VALUES
	(40, NULL, 6, 3, '2023-09-02', NULL, NULL, NULL, NULL, '2023-09-02 02:54:56', '2023-09-02 02:54:56'),
	(41, NULL, 6, 3, '2023-09-02', NULL, NULL, NULL, NULL, '2023-09-02 06:53:21', '2023-09-02 06:53:21'),
	(42, NULL, 6, 3, '2023-09-02', NULL, NULL, NULL, NULL, '2023-09-02 07:12:26', '2023-09-02 07:12:26'),
	(43, NULL, 6, 1, '2023-09-26', NULL, NULL, NULL, NULL, '2023-09-26 02:49:14', '2023-09-26 02:49:14');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;

-- Dumping structure for table sim-tpa.order_participant
CREATE TABLE IF NOT EXISTS `order_participant` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `participant_id` bigint(20) unsigned DEFAULT NULL,
  `order_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_participant_participant_id_foreign` (`participant_id`),
  KEY `order_participant_order_id_foreign` (`order_id`),
  CONSTRAINT `order_participant_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_participant_participant_id_foreign` FOREIGN KEY (`participant_id`) REFERENCES `participants` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sim-tpa.order_participant: ~11 rows (approximately)
/*!40000 ALTER TABLE `order_participant` DISABLE KEYS */;
INSERT INTO `order_participant` (`id`, `participant_id`, `order_id`, `created_at`, `updated_at`) VALUES
	(68, 77, 40, '2023-09-02 02:54:56', '2023-09-02 02:54:56'),
	(69, 78, 40, '2023-09-02 02:54:56', '2023-09-02 02:54:56'),
	(70, 79, 40, '2023-09-02 02:54:56', '2023-09-02 02:54:56'),
	(71, 80, 40, '2023-09-02 02:54:56', '2023-09-02 02:54:56'),
	(72, 81, 40, '2023-09-02 02:54:56', '2023-09-02 02:54:56'),
	(73, 82, 41, '2023-09-02 06:53:21', '2023-09-02 06:53:21'),
	(74, 83, 41, '2023-09-02 06:53:21', '2023-09-02 06:53:21'),
	(75, 84, 41, '2023-09-02 06:53:21', '2023-09-02 06:53:21'),
	(76, 85, 42, '2023-09-02 07:12:26', '2023-09-02 07:12:26'),
	(77, 86, 42, '2023-09-02 07:12:26', '2023-09-02 07:12:26'),
	(78, 87, 42, '2023-09-02 07:12:26', '2023-09-02 07:12:26'),
	(79, 88, 43, '2023-09-26 02:49:14', '2023-09-26 02:49:14'),
	(80, 89, 43, '2023-09-26 02:49:14', '2023-09-26 02:49:14'),
	(81, 90, 43, '2023-09-26 02:49:14', '2023-09-26 02:49:14'),
	(82, 91, 43, '2023-09-26 02:49:14', '2023-09-26 02:49:14'),
	(83, 92, 43, '2023-09-26 02:49:14', '2023-09-26 02:49:14'),
	(84, 93, 43, '2023-09-26 02:49:14', '2023-09-26 02:49:14');
/*!40000 ALTER TABLE `order_participant` ENABLE KEYS */;

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
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sim-tpa.participants: ~9 rows (approximately)
/*!40000 ALTER TABLE `participants` DISABLE KEYS */;
INSERT INTO `participants` (`id`, `user_id`, `fullname`, `email`, `created_at`, `updated_at`) VALUES
	(77, 3, NULL, NULL, '2023-09-02 02:54:56', '2023-09-02 02:54:56'),
	(78, 3, NULL, NULL, '2023-09-02 02:54:56', '2023-09-02 02:54:56'),
	(79, 3, NULL, NULL, '2023-09-02 02:54:56', '2023-09-02 02:54:56'),
	(80, 3, NULL, NULL, '2023-09-02 02:54:56', '2023-09-02 02:54:56'),
	(81, 3, NULL, NULL, '2023-09-02 02:54:56', '2023-09-02 02:54:56'),
	(82, 3, NULL, NULL, '2023-09-02 06:53:21', '2023-09-02 06:53:21'),
	(83, 3, NULL, NULL, '2023-09-02 06:53:21', '2023-09-02 06:53:21'),
	(84, 3, NULL, NULL, '2023-09-02 06:53:21', '2023-09-02 06:53:21'),
	(85, 3, 'Palmer Koch', 'gijihok@mailinator.com', '2023-09-02 07:12:26', '2023-09-02 09:27:17'),
	(86, 3, 'Wynne Gilbert', 'pujufo@mailinator.com', '2023-09-02 07:12:26', '2023-09-02 09:27:17'),
	(87, 3, 'Plato Spears', 'jovaqaryk@mailinator.com', '2023-09-02 07:12:26', '2023-09-02 09:27:17'),
	(88, 1, NULL, NULL, '2023-09-26 02:49:14', '2023-09-26 02:49:14'),
	(89, 1, NULL, NULL, '2023-09-26 02:49:14', '2023-09-26 02:49:14'),
	(90, 1, NULL, NULL, '2023-09-26 02:49:14', '2023-09-26 02:49:14'),
	(91, 1, NULL, NULL, '2023-09-26 02:49:14', '2023-09-26 02:49:14'),
	(92, 1, NULL, NULL, '2023-09-26 02:49:14', '2023-09-26 02:49:14'),
	(93, 1, NULL, NULL, '2023-09-26 02:49:14', '2023-09-26 02:49:14');
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
  KEY `quota_per_org_training_id_foreign` (`training_id`),
  CONSTRAINT `quota_per_org_training_id_foreign` FOREIGN KEY (`training_id`) REFERENCES `trainings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sim-tpa.quota_per_orgs: ~1 rows (approximately)
/*!40000 ALTER TABLE `quota_per_orgs` DISABLE KEYS */;
INSERT INTO `quota_per_orgs` (`id`, `created_at`, `updated_at`, `quota`, `training_id`) VALUES
	(3, '2023-08-16 06:59:31', '2023-08-16 06:59:31', NULL, 5),
	(4, '2023-09-02 02:16:22', '2023-09-02 02:16:22', 10, 6);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sim-tpa.trainers: ~0 rows (approximately)
/*!40000 ALTER TABLE `trainers` DISABLE KEYS */;
INSERT INTO `trainers` (`id`, `name`, `photo`, `description`, `email`, `job`, `created_at`, `updated_at`) VALUES
	(1, 'Buffy Mathews', NULL, 'Ea quis fugiat occae', 'fava@mailinator.com', 'Ratione deserunt ill', '2023-08-10 06:11:50', '2023-08-10 06:11:50');
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trainings_category_id_foreign` (`category_id`),
  CONSTRAINT `trainings_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sim-tpa.trainings: ~1 rows (approximately)
/*!40000 ALTER TABLE `trainings` DISABLE KEYS */;
INSERT INTO `trainings` (`id`, `category_id`, `name`, `image`, `start_date`, `end_date`, `cost`, `price_earlybird`, `price_normal`, `price_onsite`, `earlybird_end`, `place`, `type`, `description`, `quota`, `created_at`, `updated_at`) VALUES
	(5, 1, 'Bevis Wade', 'trainings/training_banner/5/dummy_absen.png', '2023-08-16 03:45:00', '2023-08-17 10:36:00', 'free', NULL, NULL, NULL, NULL, 'Aut illum et quam n', 'onsite', 'Duis occaecat consec', NULL, '2023-08-16 06:59:31', '2023-08-16 06:59:31'),
	(6, 1, 'Vincent Bowers', 'trainings/training_banner/6/dummy_absen.png', '1986-10-20 07:54:00', '2020-12-15 13:19:00', 'free', NULL, NULL, NULL, NULL, 'Molestiae ut ex accu', 'onsite', 'Molestiae aliquip si', NULL, '2023-09-02 02:16:22', '2023-09-02 02:16:22');
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sim-tpa.training_trainer: ~1 rows (approximately)
/*!40000 ALTER TABLE `training_trainer` DISABLE KEYS */;
INSERT INTO `training_trainer` (`id`, `training_id`, `trainer_id`, `created_at`, `updated_at`) VALUES
	(5, 5, 1, '2023-08-16 06:59:31', '2023-08-16 06:59:31'),
	(6, 6, 1, '2023-09-02 02:16:22', '2023-09-02 02:16:22');
/*!40000 ALTER TABLE `training_trainer` ENABLE KEYS */;

-- Dumping structure for table sim-tpa.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verification_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` bigint(20) unsigned DEFAULT '2',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verification_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sim-tpa.users: ~5 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `email`, `password`, `fullname`, `agency`, `phone`, `verification_status`, `role_id`, `remember_token`, `verification_date`, `created_at`, `updated_at`) VALUES
	(1, 'austin', 'messcarry32@gmail.com', '$2y$10$wBnJ3Gum/WNLtY7iTlgmceqHu3FEuNrXYPifKP2UqzOTIyBUVWxXO', 'Austin Wilkerson', 'asdasdasdads', '+1 (467) 669-3292', '1', 1, NULL, '2023-08-29 09:41:25', '2023-08-10 06:57:24', '2023-08-29 09:41:25'),
	(2, 'messcarry', 'messcarry323@gmail.com', '$2y$10$H220YWDJkBMI1GmPNCpPseGC97V8oOA9e0EkSLOKN4KZpYXrofzhS', 'mess', 'asdasdasdads', '2342525', '0', 1, NULL, '2023-08-11 07:10:21', '2023-08-11 02:10:22', '2023-08-11 07:10:21'),
	(3, 'mess', 'bokergaming002@gmail.com', '$2y$10$Y25JSNsZI0qsn/V1.Gzz6uG0lXg.x4MSyubMEbCvzthsKNDXqQA2e', 'messc', 'asdasdasdads', '097453745834', '1', 2, NULL, '2023-08-30 04:11:10', '2023-08-24 02:31:09', '2023-08-30 04:11:10'),
	(4, NULL, 'bokergaming003@gmail.com', '$2y$10$RbdvuKIAmzIdTdQPQXNLc.60ZDtlAzGqC7eEcTPbcgH4cbjci4T62', 'Austin Wilkerson', 'asdasdasdads', '+1 (467) 567-3292', '0', 2, NULL, NULL, '2023-08-29 02:39:54', '2023-08-29 02:39:54'),
	(5, NULL, 'Arroyan@gmail.com', '$2y$10$.avcVuV0vnHaB1wupTj49OFXD5w5xBLvxxkBk4tUvB3vQDOT7BtuK', NULL, 'TPA Sawit', NULL, '1', 2, NULL, NULL, '2023-08-29 03:11:28', '2023-08-29 03:11:28');
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
	(1, 3, 8, 1, '2023-08-31 03:19:58', '2023-08-31 03:19:58'),
	(2, 1, 8, 1, '2023-09-26 02:49:06', '2023-09-26 02:49:06');
/*!40000 ALTER TABLE `user_agreements` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
