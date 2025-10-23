/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `abandoned_cargos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `abandoned_cargos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_id` bigint(20) unsigned DEFAULT NULL,
  `status` enum('pending','accepted') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `abandoned_cargos_order_id_foreign` (`order_id`),
  CONSTRAINT `abandoned_cargos_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `about_booking_dates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `about_booking_dates` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `about_booking_dates_date_unique` (`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `booking_date_containers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `booking_date_containers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `booking_date_id` bigint(20) unsigned NOT NULL,
  `container_id` bigint(20) unsigned NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `container_check_reason_id` bigint(20) unsigned DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `booking_date_containers_booking_date_id_foreign` (`booking_date_id`),
  KEY `booking_date_containers_container_id_foreign` (`container_id`),
  KEY `booking_date_containers_container_check_reason_id_foreign` (`container_check_reason_id`),
  CONSTRAINT `booking_date_containers_booking_date_id_foreign` FOREIGN KEY (`booking_date_id`) REFERENCES `booking_dates` (`id`) ON DELETE CASCADE,
  CONSTRAINT `booking_date_containers_container_check_reason_id_foreign` FOREIGN KEY (`container_check_reason_id`) REFERENCES `container_check_reasons` (`id`) ON DELETE SET NULL,
  CONSTRAINT `booking_date_containers_container_id_foreign` FOREIGN KEY (`container_id`) REFERENCES `containers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `booking_date_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `booking_date_payments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `entry_to_warehouse_date` date NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `booking_date_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `booking_date_payments_booking_date_id_foreign` (`booking_date_id`),
  CONSTRAINT `booking_date_payments_booking_date_id_foreign` FOREIGN KEY (`booking_date_id`) REFERENCES `booking_dates` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `booking_date_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `booking_date_statuses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `booking_date_id` bigint(20) unsigned NOT NULL,
  `status_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `booking_date_statuses_booking_date_id_foreign` (`booking_date_id`),
  KEY `booking_date_statuses_status_id_foreign` (`status_id`),
  CONSTRAINT `booking_date_statuses_booking_date_id_foreign` FOREIGN KEY (`booking_date_id`) REFERENCES `booking_dates` (`id`) ON DELETE CASCADE,
  CONSTRAINT `booking_date_statuses_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `booking_dates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `booking_dates` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `last_payment_date` date DEFAULT NULL,
  `count` int(11) DEFAULT NULL,
  `price` decimal(8,2) DEFAULT NULL,
  `total_price` decimal(8,2) DEFAULT NULL,
  `total_cbm` decimal(8,2) DEFAULT NULL,
  `remainder_cbm` decimal(8,2) DEFAULT NULL,
  `remainder_count` int(11) DEFAULT NULL,
  `vendor_id` bigint(20) unsigned NOT NULL,
  `container_type_id` bigint(20) unsigned NOT NULL,
  `station_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `remainder` decimal(8,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `booking_dates_vendor_id_foreign` (`vendor_id`),
  KEY `booking_dates_container_type_id_foreign` (`container_type_id`),
  KEY `booking_dates_station_id_foreign` (`station_id`),
  CONSTRAINT `booking_dates_container_type_id_foreign` FOREIGN KEY (`container_type_id`) REFERENCES `container_types` (`id`) ON DELETE CASCADE,
  CONSTRAINT `booking_dates_station_id_foreign` FOREIGN KEY (`station_id`) REFERENCES `stations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `booking_dates_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `bookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bookings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `order_item_id` bigint(20) unsigned NOT NULL,
  `container_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bookings_order_item_id_foreign` (`order_item_id`),
  KEY `bookings_container_id_foreign` (`container_id`),
  CONSTRAINT `bookings_container_id_foreign` FOREIGN KEY (`container_id`) REFERENCES `containers` (`id`) ON DELETE SET NULL,
  CONSTRAINT `bookings_order_item_id_foreign` FOREIGN KEY (`order_item_id`) REFERENCES `order_items` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `branches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `branches` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `sort` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `branches_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `car_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `car_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `car_types_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `cities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cities` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `comment_reads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment_reads` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `comment_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comment_reads_comment_id_foreign` (`comment_id`),
  KEY `comment_reads_user_id_foreign` (`user_id`),
  CONSTRAINT `comment_reads_comment_id_foreign` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comment_reads_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `text` text COLLATE utf8mb4_unicode_ci,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `order_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_user_id_foreign` (`user_id`),
  KEY `comments_order_id_foreign` (`order_id`),
  CONSTRAINT `comments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `container_check_reasons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `container_check_reasons` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `sort` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `container_check_reasons_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `container_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `container_images` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `container_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `container_images_container_id_foreign` (`container_id`),
  CONSTRAINT `container_images_container_id_foreign` FOREIGN KEY (`container_id`) REFERENCES `containers` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `container_prices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `container_prices` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `price` decimal(8,2) DEFAULT NULL,
  `container_type_id` bigint(20) unsigned NOT NULL,
  `station_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `container_prices_container_type_id_foreign` (`container_type_id`),
  KEY `container_prices_station_id_foreign` (`station_id`),
  CONSTRAINT `container_prices_container_type_id_foreign` FOREIGN KEY (`container_type_id`) REFERENCES `container_types` (`id`) ON DELETE CASCADE,
  CONSTRAINT `container_prices_station_id_foreign` FOREIGN KEY (`station_id`) REFERENCES `stations` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `container_rejects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `container_rejects` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `note` text COLLATE utf8mb4_unicode_ci,
  `container_id` bigint(20) unsigned NOT NULL,
  `reject_reason_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `container_rejects_container_id_foreign` (`container_id`),
  KEY `container_rejects_reject_reason_id_foreign` (`reject_reason_id`),
  CONSTRAINT `container_rejects_container_id_foreign` FOREIGN KEY (`container_id`) REFERENCES `containers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `container_rejects_reject_reason_id_foreign` FOREIGN KEY (`reject_reason_id`) REFERENCES `reject_reasons` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `container_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `container_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `max_car_count` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `container_types_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `containers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `containers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_type` enum('purchase','rent') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `count` int(11) DEFAULT NULL,
  `price` decimal(8,2) DEFAULT NULL,
  `price_currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `volume` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','accepted','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `last_payment_date` date DEFAULT NULL,
  `vendor_id` bigint(20) unsigned DEFAULT NULL,
  `container_type_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `empty_volume` decimal(8,2) DEFAULT NULL,
  `packed_volume` decimal(8,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `containers_vendor_id_foreign` (`vendor_id`),
  KEY `containers_container_type_id_foreign` (`container_type_id`),
  CONSTRAINT `containers_container_type_id_foreign` FOREIGN KEY (`container_type_id`) REFERENCES `container_types` (`id`) ON DELETE SET NULL,
  CONSTRAINT `containers_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `countries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `sort` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `countries_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `currencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `currencies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `currencies_name_unique` (`name`),
  UNIQUE KEY `currencies_code_unique` (`code`),
  UNIQUE KEY `currencies_symbol_unique` (`symbol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `currency_calculators`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `currency_calculators` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `index` decimal(8,2) NOT NULL,
  `currency_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `currency_calculators_currency_id_foreign` (`currency_id`),
  CONSTRAINT `currency_calculators_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `customer_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_files` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_files_customer_id_foreign` (`customer_id`),
  CONSTRAINT `customer_files_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `customer_properties`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_properties` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `voen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `legal_address` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `factical_address` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_voen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agent_account` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `swift` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `director` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sector_id` bigint(20) unsigned DEFAULT NULL,
  `customer_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_properties_sector_id_foreign` (`sector_id`),
  KEY `customer_properties_customer_id_foreign` (`customer_id`),
  CONSTRAINT `customer_properties_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `customer_properties_sector_id_foreign` FOREIGN KEY (`sector_id`) REFERENCES `sectors` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serial_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `voen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('physical','owner','legal') COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('male','female') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `contract` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contract_start_date` date DEFAULT NULL,
  `contract_end_date` date DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `source_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customers_user_id_foreign` (`user_id`),
  KEY `customers_source_id_foreign` (`source_id`),
  CONSTRAINT `customers_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `sources` (`id`) ON DELETE SET NULL,
  CONSTRAINT `customers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `customs_clearances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customs_clearances` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customs_clearances_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `districts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `districts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `city_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `districts_name_city_id_unique` (`name`,`city_id`),
  KEY `districts_city_id_foreign` (`city_id`),
  CONSTRAINT `districts_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `document_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `document_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `document_types_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `education`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `education` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `sort` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `education_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `expense_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expense_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `sort` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `expense_categories_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `expense_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expense_payments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` decimal(8,2) DEFAULT NULL,
  `payment_method` enum('cash','bank') COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expense_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `expense_payments_expense_id_foreign` (`expense_id`),
  CONSTRAINT `expense_payments_expense_id_foreign` FOREIGN KEY (`expense_id`) REFERENCES `expenses` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `expense_sub_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expense_sub_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `sort` int(11) DEFAULT NULL,
  `expense_category_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `expense_sub_categories_name_unique` (`name`),
  KEY `expense_sub_categories_expense_category_id_foreign` (`expense_category_id`),
  CONSTRAINT `expense_sub_categories_expense_category_id_foreign` FOREIGN KEY (`expense_category_id`) REFERENCES `expense_categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `expense_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expense_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `service_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `expense_types_name_unique` (`name`),
  KEY `expense_types_service_id_foreign` (`service_id`),
  CONSTRAINT `expense_types_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `expenses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expenses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `log_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_price` decimal(15,2) NOT NULL DEFAULT '0.00',
  `pay_price` decimal(15,2) NOT NULL DEFAULT '0.00',
  `remainder` decimal(15,2) NOT NULL DEFAULT '0.00',
  `last_payment_date` date DEFAULT NULL,
  `currency` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expense_type` enum('one-time','recurring') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `factory` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `order_id` bigint(20) unsigned DEFAULT NULL,
  `expense_category_id` bigint(20) unsigned DEFAULT NULL,
  `expense_sub_category_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `expenses_order_id_foreign` (`order_id`),
  KEY `expenses_expense_category_id_foreign` (`expense_category_id`),
  KEY `expenses_expense_sub_category_id_foreign` (`expense_sub_category_id`),
  CONSTRAINT `expenses_expense_category_id_foreign` FOREIGN KEY (`expense_category_id`) REFERENCES `expense_categories` (`id`) ON DELETE SET NULL,
  CONSTRAINT `expenses_expense_sub_category_id_foreign` FOREIGN KEY (`expense_sub_category_id`) REFERENCES `expense_sub_categories` (`id`) ON DELETE SET NULL,
  CONSTRAINT `expenses_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `factories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `factories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `factory_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `factory_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cube` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_point` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `box_count` int(11) NOT NULL DEFAULT '0',
  `palette_count` int(11) NOT NULL DEFAULT '0',
  `car_count` int(11) DEFAULT NULL,
  `vin_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `product_type_id` bigint(20) unsigned DEFAULT NULL,
  `order_factory_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `factory_details_product_type_id_foreign` (`product_type_id`),
  KEY `factory_details_order_factory_id_foreign` (`order_factory_id`),
  CONSTRAINT `factory_details_order_factory_id_foreign` FOREIGN KEY (`order_factory_id`) REFERENCES `order_factories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `factory_details_product_type_id_foreign` FOREIGN KEY (`product_type_id`) REFERENCES `product_types` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `factory_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `factory_files` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `contract` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `packing_list` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_customer_upload` tinyint(1) NOT NULL DEFAULT '0',
  `order_factory_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `factory_files_order_factory_id_foreign` (`order_factory_id`),
  CONSTRAINT `factory_files_order_factory_id_foreign` FOREIGN KEY (`order_factory_id`) REFERENCES `order_factories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `factory_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `factory_products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_factory_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `factory_products_order_factory_id_foreign` (`order_factory_id`),
  KEY `factory_products_product_id_foreign` (`product_id`),
  CONSTRAINT `factory_products_order_factory_id_foreign` FOREIGN KEY (`order_factory_id`) REFERENCES `order_factories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `factory_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `factory_vin_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `factory_vin_codes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `vin_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_factory_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `factory_vin_codes_order_factory_id_foreign` (`order_factory_id`),
  CONSTRAINT `factory_vin_codes_order_factory_id_foreign` FOREIGN KEY (`order_factory_id`) REFERENCES `order_factories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `incoterms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `incoterms` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `sort` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `incoterms_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `mix_fulls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mix_fulls` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mix_fulls_name_unique` (`name`),
  UNIQUE KEY `mix_fulls_short_name_unique` (`short_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) unsigned NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `order_expenses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_expenses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remainder` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expense_type_id` bigint(20) unsigned NOT NULL,
  `vendor_id` bigint(20) unsigned NOT NULL,
  `payment_type_id` bigint(20) unsigned NOT NULL,
  `order_id` bigint(20) unsigned NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_expenses_expense_type_id_foreign` (`expense_type_id`),
  KEY `order_expenses_vendor_id_foreign` (`vendor_id`),
  KEY `order_expenses_payment_type_id_foreign` (`payment_type_id`),
  KEY `order_expenses_order_id_foreign` (`order_id`),
  CONSTRAINT `order_expenses_expense_type_id_foreign` FOREIGN KEY (`expense_type_id`) REFERENCES `expense_types` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_expenses_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_expenses_payment_type_id_foreign` FOREIGN KEY (`payment_type_id`) REFERENCES `payment_types` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_expenses_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `order_factories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_factories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `factory_id` bigint(20) unsigned NOT NULL,
  `order_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_factories_factory_id_foreign` (`factory_id`),
  KEY `order_factories_order_id_foreign` (`order_id`),
  CONSTRAINT `order_factories_factory_id_foreign` FOREIGN KEY (`factory_id`) REFERENCES `factories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_factories_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `order_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_files` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_files_order_id_foreign` (`order_id`),
  CONSTRAINT `order_files_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `order_item_declarations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_item_declarations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `order_item_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_item_declarations_order_item_id_foreign` (`order_item_id`),
  CONSTRAINT `order_item_declarations_order_item_id_foreign` FOREIGN KEY (`order_item_id`) REFERENCES `order_items` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `order_item_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_item_images` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_item_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_item_images_order_item_id_foreign` (`order_item_id`),
  CONSTRAINT `order_item_images_order_item_id_foreign` FOREIGN KEY (`order_item_id`) REFERENCES `order_items` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `order_item_railway_bills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_item_railway_bills` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `order_item_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `notified_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_item_railway_bills_order_item_id_foreign` (`order_item_id`),
  CONSTRAINT `order_item_railway_bills_order_item_id_foreign` FOREIGN KEY (`order_item_id`) REFERENCES `order_items` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `order_item_railway_status_changes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_item_railway_status_changes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_item_railway_bill_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_railway_bill` (`order_item_railway_bill_id`),
  CONSTRAINT `fk_railway_bill` FOREIGN KEY (`order_item_railway_bill_id`) REFERENCES `order_item_railway_bills` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `order_item_short_declarations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_item_short_declarations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_item_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_item_short_declarations_order_item_id_foreign` (`order_item_id`),
  CONSTRAINT `order_item_short_declarations_order_item_id_foreign` FOREIGN KEY (`order_item_id`) REFERENCES `order_items` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `order_item_status_changes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_item_status_changes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `status` enum('draft','confirmed','execute','finished','rejected') COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_item_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_item_status_changes_order_item_id_foreign` (`order_item_id`),
  CONSTRAINT `order_item_status_changes_order_item_id_foreign` FOREIGN KEY (`order_item_id`) REFERENCES `order_items` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `order_item_warehouses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_item_warehouses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `arrival_date` date DEFAULT NULL,
  `order_item_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_item_warehouses_order_item_id_foreign` (`order_item_id`),
  CONSTRAINT `order_item_warehouses_order_item_id_foreign` FOREIGN KEY (`order_item_id`) REFERENCES `order_items` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) unsigned NOT NULL,
  `vin_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cbm` decimal(8,2) DEFAULT NULL,
  `status` enum('draft','confirmed','execute','finished','rejected') COLLATE utf8mb4_unicode_ci NOT NULL,
  `handover` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_items_order_id_foreign` (`order_id`),
  CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `order_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_payments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `percent` decimal(8,2) DEFAULT '0.00',
  `remainder` decimal(8,2) DEFAULT '0.00',
  `first_date` date DEFAULT NULL,
  `last_date` date DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `payment_type_id` bigint(20) unsigned DEFAULT NULL,
  `order_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_payments_payment_type_id_foreign` (`payment_type_id`),
  KEY `order_payments_order_id_foreign` (`order_id`),
  CONSTRAINT `order_payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_payments_payment_type_id_foreign` FOREIGN KEY (`payment_type_id`) REFERENCES `payment_types` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `order_price_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_price_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `price` decimal(8,2) DEFAULT NULL,
  `price_currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price_type_id` bigint(20) unsigned NOT NULL,
  `order_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'AZN',
  PRIMARY KEY (`id`),
  KEY `order_price_types_price_type_id_foreign` (`price_type_id`),
  KEY `order_price_types_order_id_foreign` (`order_id`),
  CONSTRAINT `order_price_types_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_price_types_price_type_id_foreign` FOREIGN KEY (`price_type_id`) REFERENCES `price_types` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `order_prices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_prices` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `order_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'AZN',
  PRIMARY KEY (`id`),
  KEY `order_prices_order_id_foreign` (`order_id`),
  KEY `order_prices_user_id_foreign` (`user_id`),
  CONSTRAINT `order_prices_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_prices_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `order_reads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_reads` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` bigint(20) unsigned NOT NULL,
  `order_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_reads_user_id_foreign` (`user_id`),
  KEY `order_reads_order_id_foreign` (`order_id`),
  CONSTRAINT `order_reads_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_reads_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `order_rejects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_rejects` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `note` text COLLATE utf8mb4_unicode_ci,
  `reject_reason_id` bigint(20) unsigned NOT NULL,
  `order_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_rejects_reject_reason_id_foreign` (`reject_reason_id`),
  KEY `order_rejects_order_id_foreign` (`order_id`),
  KEY `order_rejects_user_id_foreign` (`user_id`),
  CONSTRAINT `order_rejects_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_rejects_reject_reason_id_foreign` FOREIGN KEY (`reject_reason_id`) REFERENCES `reject_reasons` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_rejects_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `order_services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_services` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `purchase_price` decimal(8,2) DEFAULT NULL,
  `sale_price` decimal(8,2) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `last_payment_date` date DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `document_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_id` bigint(20) unsigned DEFAULT NULL,
  `expense_type_id` bigint(20) unsigned DEFAULT NULL,
  `vendor_id` bigint(20) unsigned DEFAULT NULL,
  `order_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `purchase_currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sale_currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_services_service_id_foreign` (`service_id`),
  KEY `order_services_expense_type_id_foreign` (`expense_type_id`),
  KEY `order_services_vendor_id_foreign` (`vendor_id`),
  KEY `order_services_order_id_foreign` (`order_id`),
  CONSTRAINT `order_services_expense_type_id_foreign` FOREIGN KEY (`expense_type_id`) REFERENCES `expense_types` (`id`) ON DELETE SET NULL,
  CONSTRAINT `order_services_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_services_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE SET NULL,
  CONSTRAINT `order_services_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `order_sizes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_sizes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `width` decimal(8,2) DEFAULT NULL,
  `height` decimal(8,2) DEFAULT NULL,
  `length` decimal(8,2) DEFAULT NULL,
  `order_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_sizes_order_id_foreign` (`order_id`),
  CONSTRAINT `order_sizes_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `order_status_changes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_status_changes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `status` enum('draft','confirmed','execute','finished','rejected') COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_status_changes_order_id_foreign` (`order_id`),
  CONSTRAINT `order_status_changes_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apply_date` date DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price_currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cube` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referrer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `loading_point` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `note` text COLLATE utf8mb4_unicode_ci,
  `security_mode` tinyint(1) DEFAULT '1',
  `ready_status` tinyint(1) DEFAULT NULL,
  `stackable` tinyint(1) DEFAULT NULL,
  `number_of_places` int(11) DEFAULT NULL,
  `width` decimal(8,2) DEFAULT NULL,
  `height` decimal(8,2) DEFAULT NULL,
  `length` decimal(8,2) DEFAULT NULL,
  `msds` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_car_count` int(11) DEFAULT NULL,
  `second_car_count` int(11) DEFAULT NULL,
  `is_evaluate` tinyint(1) DEFAULT '1',
  `internal_transport` tinyint(1) DEFAULT NULL,
  `status` enum('draft','confirmed','execute','finished','rejected') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mix_full` enum('mix','full','automobile') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cbm` decimal(8,2) DEFAULT NULL,
  `customs_clearance_id` bigint(20) unsigned DEFAULT NULL,
  `incoterm_id` bigint(20) unsigned DEFAULT NULL,
  `container_type_id` bigint(20) unsigned DEFAULT NULL,
  `warehouse_id` bigint(20) unsigned DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `city_id` bigint(20) unsigned DEFAULT NULL,
  `district_id` bigint(20) unsigned DEFAULT NULL,
  `about_booking_date_id` bigint(20) unsigned DEFAULT NULL,
  `transportation_type_id` bigint(20) unsigned DEFAULT NULL,
  `transportation_service_id` bigint(20) unsigned DEFAULT NULL,
  `transportation_id` bigint(20) unsigned DEFAULT NULL,
  `first_car_type_id` bigint(20) unsigned DEFAULT NULL,
  `second_car_type_id` bigint(20) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `customer_id` bigint(20) unsigned DEFAULT NULL,
  `handover` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exportable` tinyint(1) DEFAULT '0',
  `tax_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_customs_clearance_id_foreign` (`customs_clearance_id`),
  KEY `orders_incoterm_id_foreign` (`incoterm_id`),
  KEY `orders_container_type_id_foreign` (`container_type_id`),
  KEY `orders_warehouse_id_foreign` (`warehouse_id`),
  KEY `orders_user_id_foreign` (`user_id`),
  KEY `orders_city_id_foreign` (`city_id`),
  KEY `orders_district_id_foreign` (`district_id`),
  KEY `orders_about_booking_date_id_foreign` (`about_booking_date_id`),
  KEY `orders_transportation_type_id_foreign` (`transportation_type_id`),
  KEY `orders_transportation_service_id_foreign` (`transportation_service_id`),
  KEY `orders_transportation_id_foreign` (`transportation_id`),
  KEY `orders_first_car_type_id_foreign` (`first_car_type_id`),
  KEY `orders_second_car_type_id_foreign` (`second_car_type_id`),
  KEY `orders_customer_id_foreign` (`customer_id`),
  CONSTRAINT `orders_about_booking_date_id_foreign` FOREIGN KEY (`about_booking_date_id`) REFERENCES `about_booking_dates` (`id`) ON DELETE SET NULL,
  CONSTRAINT `orders_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE SET NULL,
  CONSTRAINT `orders_container_type_id_foreign` FOREIGN KEY (`container_type_id`) REFERENCES `container_types` (`id`) ON DELETE SET NULL,
  CONSTRAINT `orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE SET NULL,
  CONSTRAINT `orders_customs_clearance_id_foreign` FOREIGN KEY (`customs_clearance_id`) REFERENCES `customs_clearances` (`id`) ON DELETE SET NULL,
  CONSTRAINT `orders_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`) ON DELETE SET NULL,
  CONSTRAINT `orders_first_car_type_id_foreign` FOREIGN KEY (`first_car_type_id`) REFERENCES `car_types` (`id`) ON DELETE SET NULL,
  CONSTRAINT `orders_incoterm_id_foreign` FOREIGN KEY (`incoterm_id`) REFERENCES `incoterms` (`id`) ON DELETE SET NULL,
  CONSTRAINT `orders_second_car_type_id_foreign` FOREIGN KEY (`second_car_type_id`) REFERENCES `car_types` (`id`) ON DELETE SET NULL,
  CONSTRAINT `orders_transportation_id_foreign` FOREIGN KEY (`transportation_id`) REFERENCES `transportations` (`id`) ON DELETE SET NULL,
  CONSTRAINT `orders_transportation_service_id_foreign` FOREIGN KEY (`transportation_service_id`) REFERENCES `transportation_services` (`id`) ON DELETE SET NULL,
  CONSTRAINT `orders_transportation_type_id_foreign` FOREIGN KEY (`transportation_type_id`) REFERENCES `transportation_types` (`id`) ON DELETE SET NULL,
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `orders_warehouse_id_foreign` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `payment_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `sort` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
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
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `price_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `price_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `sort` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `price_types_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `product_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_types_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `receive_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `receive_payments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(8,2) DEFAULT NULL,
  `payment_method` enum('cash','bank') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `receive_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `receive_payments_receive_id_foreign` (`receive_id`),
  CONSTRAINT `receive_payments_receive_id_foreign` FOREIGN KEY (`receive_id`) REFERENCES `receives` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `receives`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `receives` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice_date` date DEFAULT NULL,
  `last_payment_date` date DEFAULT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(8,2) DEFAULT NULL,
  `vat` decimal(8,2) DEFAULT NULL,
  `total_price` decimal(8,2) DEFAULT NULL,
  `initial_payment` decimal(8,2) DEFAULT NULL,
  `remainder` decimal(8,2) DEFAULT NULL,
  `status` enum('pending','paid','not_paid') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `order_id` bigint(20) unsigned DEFAULT NULL,
  `country_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `receives_customer_id_foreign` (`customer_id`),
  KEY `receives_order_id_foreign` (`order_id`),
  KEY `receives_country_id_foreign` (`country_id`),
  CONSTRAINT `receives_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE SET NULL,
  CONSTRAINT `receives_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE SET NULL,
  CONSTRAINT `receives_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `reject_reasons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reject_reasons` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `reject_reasons_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `responsible_people`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `responsible_people` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_property_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `responsible_people_customer_property_id_foreign` (`customer_property_id`),
  CONSTRAINT `responsible_people_customer_property_id_foreign` FOREIGN KEY (`customer_property_id`) REFERENCES `customer_properties` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `sectors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sectors` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sectors_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `service_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `service_details_service_id_foreign` (`service_id`),
  CONSTRAINT `service_details_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `services` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `sort` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `services_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value_az` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value_zh` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `value_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `sources`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sources` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sources_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `stations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `stations_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `statuses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('pending','accepted','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `status` tinyint(1) NOT NULL,
  `sort` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `statuses_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `transportation_services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transportation_services` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `transportation_type_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `transportation_services_name_transportation_type_id_unique` (`name`,`transportation_type_id`),
  KEY `transportation_services_transportation_type_id_foreign` (`transportation_type_id`),
  CONSTRAINT `transportation_services_transportation_type_id_foreign` FOREIGN KEY (`transportation_type_id`) REFERENCES `transportation_types` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `transportation_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transportation_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `sort` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `transportation_types_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `transportations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transportations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `transportation_service_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `transportations_name_transportation_service_id_unique` (`name`,`transportation_service_id`),
  KEY `transportations_transportation_service_id_foreign` (`transportation_service_id`),
  CONSTRAINT `transportations_transportation_service_id_foreign` FOREIGN KEY (`transportation_service_id`) REFERENCES `transportation_services` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `user_payroll_advance_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_payroll_advance_files` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_payroll_advance_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_payroll_advance_files_user_payroll_advance_id_foreign` (`user_payroll_advance_id`),
  CONSTRAINT `user_payroll_advance_files_user_payroll_advance_id_foreign` FOREIGN KEY (`user_payroll_advance_id`) REFERENCES `user_payroll_advances` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `user_payroll_advances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_payroll_advances` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `payment_method` enum('bank','cash') COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(8,2) DEFAULT NULL,
  `user_payroll_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_payroll_advances_user_payroll_id_foreign` (`user_payroll_id`),
  CONSTRAINT `user_payroll_advances_user_payroll_id_foreign` FOREIGN KEY (`user_payroll_id`) REFERENCES `user_payrolls` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `user_payrolls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_payrolls` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cash_payment` decimal(8,2) DEFAULT NULL,
  `bank_payment` decimal(8,2) DEFAULT NULL,
  `government_payment` decimal(8,2) DEFAULT NULL,
  `withholding_payment` decimal(8,2) DEFAULT NULL,
  `bonus` decimal(8,2) DEFAULT NULL,
  `last_payment_date` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cash_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `payment_method` enum('cash','bank') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_payrolls_user_id_foreign` (`user_id`),
  CONSTRAINT `user_payrolls_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mmc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('male','female') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gross_salary` decimal(8,2) DEFAULT NULL,
  `cash` decimal(8,2) DEFAULT NULL,
  `bank` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `government_payment` decimal(8,2) DEFAULT NULL,
  `net_salary` decimal(8,2) DEFAULT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `education_id` bigint(20) unsigned DEFAULT NULL,
  `branch_id` bigint(20) unsigned DEFAULT NULL,
  `country_id` bigint(20) unsigned DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_education_id_foreign` (`education_id`),
  KEY `users_branch_id_foreign` (`branch_id`),
  KEY `users_country_id_foreign` (`country_id`),
  CONSTRAINT `users_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE SET NULL,
  CONSTRAINT `users_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE SET NULL,
  CONSTRAINT `users_education_id_foreign` FOREIGN KEY (`education_id`) REFERENCES `education` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `vendor_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vendor_files` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vendor_files_vendor_id_foreign` (`vendor_id`),
  CONSTRAINT `vendor_files_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `vendors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vendors` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `vendor_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_type` enum('physical','legal') COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chinese_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `voen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `legal_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `factical_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_voen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agent_account` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `swift` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `director` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `warehouses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `warehouses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `warehouses_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (1,'2014_10_12_000000_create_users_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (2,'2014_10_12_100000_create_password_reset_tokens_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (3,'2019_08_19_000000_create_failed_jobs_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (4,'2019_12_14_000001_create_personal_access_tokens_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (5,'2025_02_13_102336_create_permission_tables',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (6,'2025_02_17_114025_create_incoterms_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (7,'2025_02_17_122845_create_sources_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (8,'2025_02_17_134707_create_customers_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (9,'2025_02_17_135433_create_container_types_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (10,'2025_02_17_135752_create_customs_clearances_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (11,'2025_02_19_081930_create_reject_reasons_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (12,'2025_02_19_141005_create_factories_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (13,'2025_02_20_165025_create_warehourses_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (14,'2025_02_20_184211_create_currencies_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (15,'2025_02_21_093231_create_transportation_types_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (16,'2025_02_21_093412_create_transportation_services_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (17,'2025_02_21_094739_create_transportations_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (18,'2025_02_21_153219_create_cities_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (19,'2025_02_21_153659_create_districts_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (20,'2025_02_21_191519_create_about_booking_dates_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (21,'2025_02_22_101543_create_mix_fulls_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (22,'2025_02_22_115454_create_car_types_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (23,'2025_02_22_143449_create_orders_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (24,'2025_02_22_143509_create_order_rejects_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (25,'2025_02_22_164107_create_order_prices_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (26,'2025_02_22_181713_create_order_factories_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (27,'2025_02_24_151837_create_product_types_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (28,'2025_02_24_171827_create_factory_files_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (29,'2025_02_24_173316_create_factory_details_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (30,'2025_02_24_174326_create_products_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (31,'2025_02_24_174421_create_factory_products_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (32,'2025_02_24_181652_create_payment_types_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (33,'2025_02_24_183000_create_order_payments_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (34,'2025_02_26_232137_create_vendors_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (35,'2025_02_26_232820_create_vendor_files_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (36,'2025_02_27_004922_create_expense_types_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (37,'2025_02_27_010420_create_order_expenses_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (38,'2025_02_27_020129_create_containers_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (39,'2025_02_27_041502_create_container_rejects_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (40,'2025_02_27_045233_create_order_bookings_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (41,'2025_02_27_072341_create_container_images_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (42,'2025_02_27_074204_create_stations_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (43,'2025_02_27_093046_create_container_prices_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (44,'2025_02_27_135547_create_abandoned_cargos_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (45,'2025_03_03_092226_create_price_types_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (46,'2025_03_03_101606_create_statuses_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (47,'2025_03_03_122240_create_order_railway_bills_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (48,'2025_03_03_122422_create_order_declarations_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (49,'2025_03_03_122542_create_order_images_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (50,'2025_03_04_100149_create_order_price_types_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (51,'2025_03_04_102002_create_booking_dates_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (52,'2025_03_04_124143_create_booking_date_containers_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (53,'2025_03_04_144008_add_votes_to_customers_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (54,'2025_03_05_085113_create_comments_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (55,'2025_03_05_092218_create_comment_reads_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (56,'2025_03_06_092346_create_order_status_changes_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (57,'2025_03_06_122614_create_order_files_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (58,'2025_03_12_095510_create_document_types_table',2);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (59,'2025_03_12_104212_create_order_services_table',3);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (60,'2025_03_19_104707_create_customers_table',4);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (61,'2025_03_19_113245_create_customer_files_table',4);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (62,'2025_03_19_113508_create_sectors_table',4);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (63,'2025_03_19_113609_create_customer_properties_table',4);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (64,'2025_03_19_114907_create_responsible_people_table',4);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (65,'2025_03_19_120621_add_customer_id_to_orders_table',4);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (66,'2025_03_27_123758_create_order_reads_table',5);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (67,'2025_03_17_124456_create_booking_date_statuses_table',6);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (68,'2025_04_01_153835_add_votes_to_booking_dates_table',7);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (69,'2025_04_01_171346_create_booking_date_payments_table',8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (70,'2025_04_02_081027_add_sort_to_roles_table',9);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (71,'2025_04_02_083645_add_group_to_permissions_table',10);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (73,'2025_04_04_024520_create_countries_table',11);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (74,'2025_04_04_025647_create_branches_table',12);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (75,'2025_04_04_031442_create_education_table',13);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (76,'2025_04_04_032306_add_votes_to_users_table',14);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (77,'2025_04_18_125558_create_order_sizes_table',15);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (78,'2025_04_18_152929_add_car_count_to_factory_details_table',16);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (79,'2025_04_18_164402_create_factory_vin_codes_table',17);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (82,'2025_04_21_104807_create_order_items_table',18);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (83,'2025_04_21_113404_create_bookings_table',19);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (84,'2025_04_21_115334_create_order_item_railway_bills_table',19);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (85,'2025_04_21_115649_create_order_item_declarations_table',19);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (86,'2025_04_21_115809_create_order_item_images_table',19);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (87,'2025_04_21_154408_create_order_item_status_changes_table',20);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (88,'2025_04_22_082847_add_handover_to_orders_table',20);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (89,'2025_04_23_114209_create_services_table',21);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (90,'2025_04_23_121621_create_service_details_table',22);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (91,'2025_04_23_142228_create_order_services_table',23);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (92,'2025_04_24_113209_add_service_id_to_expense_types_table',24);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (93,'2025_04_25_082326_create_order_item_railway_status_changes_table',25);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (94,'2025_04_25_084415_add_max_car_count_to_container_types_table',26);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (95,'2025_04_29_103754_create_currency_calculators_table',27);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (96,'2025_04_29_113434_add_currencies_to_order_services_table',28);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (97,'2025_05_05_091224_add_file_to_order_item_railway_status_changes_table',29);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (98,'2025_05_06_125001_add_columns_to_containers_table',30);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (99,'2025_05_07_122419_add_votes_to_order_prices_table',31);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (100,'2025_05_07_141740_add_votes_to_order_price_types_table',32);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (101,'2025_05_08_110846_add_votes_to_order_items_table',33);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (102,'2025_05_08_151214_create_order_item_status_changes_table',34);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (103,'2025_05_10_094313_add_handover_to_order_items_table',35);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (104,'2025_05_21_084918_add_exportable_to_orders_table',36);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (105,'2025_05_21_100758_create_container_check_reasons_table',37);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (106,'2025_05_21_104005_add_votes_to_booking_date_containers_table',38);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (107,'2025_05_22_113013_create_notifications_table',39);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (108,'2025_05_22_115050_add_last_notified_at_to_order_item_railway_bills_table',40);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (109,'2025_05_22_145535_create_order_item_warehouses_table',41);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (110,'2025_06_03_083640_create_order_item_short_declarations_table',42);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (111,'2025_06_03_140607_add_votes_to_users_table',43);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (114,'2025_06_03_203713_create_user_payrolls_table',44);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (115,'2025_06_04_024504_add_payment_method_to_user_payrolls_table',45);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (116,'2025_06_04_024844_create_user_payroll_advances_table',46);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (117,'2025_06_04_024849_create_user_payroll_advance_files_table',46);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (118,'2025_06_10_082454_create_expense_categories_table',47);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (119,'2025_06_10_082559_create_expense_sub_categories_table',47);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (120,'2025_06_10_091414_create_expenses_table',48);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (121,'2025_06_10_122855_create_expense_payments_table',49);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (122,'2025_07_17_120744_create_receives_table',50);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (123,'2025_07_17_125836_create_receive_payments_table',50);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (124,'2025_07_18_102839_add_votes_to_receives_table',51);
