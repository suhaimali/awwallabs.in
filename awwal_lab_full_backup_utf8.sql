-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: awwal_lab
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `appointments`
--

DROP TABLE IF EXISTS `appointments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `appointments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` bigint(20) unsigned NOT NULL,
  `doctor_name` varchar(255) NOT NULL,
  `test_name` varchar(255) DEFAULT NULL,
  `test_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `discount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `balance` decimal(10,2) NOT NULL DEFAULT 0.00,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  `reason` text DEFAULT NULL,
  `total_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `appointments_patient_id_foreign` (`patient_id`),
  CONSTRAINT `appointments_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `appointments`
--

LOCK TABLES `appointments` WRITE;
/*!40000 ALTER TABLE `appointments` DISABLE KEYS */;
INSERT INTO `appointments` VALUES (1,1,'Dr. Safwan','cbc',500.00,0.00,500.00,'2026-06-11','22:06:00','Completed',NULL,500.00,NULL,'2026-06-11 16:36:21','2026-06-11 16:40:19'),(2,2,'Self','cbc',500.00,0.00,500.00,'2026-06-12','08:13:00','Pending',NULL,500.00,NULL,'2026-06-12 02:43:58','2026-06-12 02:43:58'),(3,3,'Self','cbc',500.00,0.00,500.00,'2026-06-12','09:33:00','Pending',NULL,500.00,NULL,'2026-06-12 04:03:41','2026-06-12 04:03:41'),(4,4,'Self','cbc',500.00,0.00,500.00,'2026-06-12','09:33:00','Pending',NULL,500.00,NULL,'2026-06-12 04:03:42','2026-06-12 04:03:42');
/*!40000 ALTER TABLE `appointments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'hemotolagy','2026-06-11 16:36:58','2026-06-11 16:36:58',NULL),(8,'1','2026-06-12 03:43:36','2026-06-12 03:43:36',NULL),(9,'q','2026-06-12 03:44:14','2026-06-12 03:44:14',NULL),(10,'ddd','2026-06-12 03:51:05','2026-06-12 03:51:05',NULL);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctors`
--

DROP TABLE IF EXISTS `doctors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctors` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `qualification` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctors`
--

LOCK TABLES `doctors` WRITE;
/*!40000 ALTER TABLE `doctors` DISABLE KEYS */;
INSERT INTO `doctors` VALUES (1,'Dr. Suhaim Soft','MBBS, MD','+91 8891479505','suhaim@suhaimsoft.com','2026-06-11 11:43:33','2026-06-11 11:43:33'),(2,'Dr. Safwan','MBBS, MD (Pathology)','+91 7034250209','safwan@suhaimsoft.com','2026-06-11 11:43:33','2026-06-11 11:43:33'),(3,'Self','','',NULL,'2026-06-11 11:43:33','2026-06-11 11:43:33');
/*!40000 ALTER TABLE `doctors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `flag_templates`
--

DROP TABLE IF EXISTS `flag_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `flag_templates` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `flag_templates_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `flag_templates`
--

LOCK TABLES `flag_templates` WRITE;
/*!40000 ALTER TABLE `flag_templates` DISABLE KEYS */;
INSERT INTO `flag_templates` VALUES (1,'1','2026-06-11 16:37:34','2026-06-11 16:37:34');
/*!40000 ALTER TABLE `flag_templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lab_tests`
--

DROP TABLE IF EXISTS `lab_tests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lab_tests` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lab_tests`
--

LOCK TABLES `lab_tests` WRITE;
/*!40000 ALTER TABLE `lab_tests` DISABLE KEYS */;
INSERT INTO `lab_tests` VALUES (1,'cbc',500.00,NULL,'2026-06-11 16:35:52','2026-06-11 16:35:52','Cash');
/*!40000 ALTER TABLE `lab_tests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'2026_05_10_123806_create_patients_table',1),(4,'2026_05_10_124303_add_phone_to_patients_table',1),(5,'2026_05_10_125134_add_reference_dr_to_patients_table',1),(6,'2026_05_10_125430_add_status_to_patients_table',1),(7,'2026_05_10_143713_create_lab_reports_table',1),(8,'2026_05_10_145504_create_appointments_table',1),(9,'2026_05_10_151146_create_laboratories_table',1),(10,'2026_05_10_151451_add_role_to_users_table',1),(11,'2026_05_10_151732_add_role_to_users_table',1),(12,'2026_05_10_153341_finalize_multi_tenancy_columns',1),(13,'2026_05_10_162226_create_lab_tests_table',1),(14,'2026_05_10_162248_add_details_to_appointments_table',1),(15,'2026_05_10_162256_create_appointment_test_table',1),(16,'2026_05_10_163951_add_test_fields_to_appointments_table',1),(17,'2026_05_10_170208_create_test_reports_table',1),(18,'2026_05_10_172628_create_payments_table',1),(19,'2026_05_10_180914_add_discount_to_appointments_table',1),(20,'2026_05_10_182411_add_financial_columns_to_patients_table',1),(21,'2026_05_10_184247_drop_appointment_test_table',1),(22,'2026_05_11_075349_create_categories_table',1),(23,'2026_05_11_085929_drop_categories_and_laboratories_tables',1),(24,'2026_05_11_153107_add_status_to_test_reports_table',1),(25,'2026_05_12_105814_create_categories_table',1),(26,'2026_05_12_105814_create_sub_categories_table',1),(27,'2026_05_12_110303_add_category_to_lab_tests_table',1),(28,'2026_05_13_134518_add_description_to_categories_and_sub_categories_tables',1),(29,'2026_05_13_135025_create_reference_intervals_table',1),(30,'2026_05_13_135117_add_reference_intervals_to_lab_tests_table',1),(31,'2026_05_13_135858_create_master_data_tables',1),(32,'2026_05_13_140127_create_test_parameters_table',1),(33,'2026_05_14_063902_add_bio_ref_to_test_parameters_table',1),(34,'2026_05_15_213615_create_doctors_table',1),(35,'2026_05_16_112539_create_labs_table',1),(36,'2026_05_16_112812_add_signature_path_to_labs_table',1),(37,'2026_05_16_190000_add_name_to_categories_table',1),(38,'2026_05_29_220000_normalize_report_and_reference_data',1),(39,'2026_06_06_000001_create_report_signatures_table',1),(40,'2026_06_07_075632_add_columns_to_payments_table',1),(41,'2026_06_07_113849_make_email_nullable_in_patients_table',1),(42,'2026_06_07_134553_create_flag_templates_table',1),(43,'2026_06_07_134553_create_reference_templates_table',1),(44,'2026_06_08_064727_add_age_type_to_patients_table',1),(45,'2026_06_08_071540_add_age_type_to_reference_intervals_table',1),(46,'2026_06_08_075520_add_sidebar_collapsed_to_users_table',1),(47,'2026_06_08_223828_add_payment_method_to_lab_tests_table',1),(48,'2026_06_11_085813_add_payment_method_to_patients_table',1),(49,'2026_06_11_130450_create_vital_signs_table',1),(50,'2026_06_11_133556_add_temp_unit_to_vital_signs_table',1),(51,'2026_06_11_223703_drop_unused_lab_reports_and_labs_tables',2),(52,'2026_06_12_025000_remove_unique_and_nullable_email_in_patients_table',3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `patients`
--

DROP TABLE IF EXISTS `patients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `age_type` varchar(15) NOT NULL DEFAULT 'Years',
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `reference_dr` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active',
  `total_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `discount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `balance` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `patients_patient_id_unique` (`patient_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patients`
--

LOCK TABLES `patients` WRITE;
/*!40000 ALTER TABLE `patients` DISABLE KEYS */;
INSERT INTO `patients` VALUES (1,'2026-0001','suhaim','soft','Male',19,'Years','08891479505','edevenna malappuram','alivpsuahim@gmail.com','Dr. Safwan','Active',500.00,0.00,500.00,'2026-06-11 16:36:21','2026-06-11 16:36:21','Cash'),(2,'2026-0002','suhaim','soft','Male',1,'Years','08891479505','edevenna malappuram',NULL,'Self','Active',500.00,0.00,500.00,'2026-06-12 02:43:58','2026-06-12 02:43:58','Cash'),(3,'2026-0003','suhaim','soft','Male',1,'Years','08891479505','edevenna malappuram',NULL,'Self','Active',500.00,0.00,500.00,'2026-06-12 04:03:41','2026-06-12 04:03:41','Card'),(4,'2026-0004','suhaim','soft','Male',1,'Years','08891479505','edevenna malappuram',NULL,'Self','Active',500.00,0.00,500.00,'2026-06-12 04:03:42','2026-06-12 04:03:42','Card');
/*!40000 ALTER TABLE `patients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `patient_id` bigint(20) unsigned NOT NULL,
  `total_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `discount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `advance_paid` decimal(10,2) NOT NULL DEFAULT 0.00,
  `net_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `balance_due` decimal(10,2) NOT NULL DEFAULT 0.00,
  `payment_status` varchar(255) NOT NULL DEFAULT 'Unpaid',
  `payment_method` varchar(255) DEFAULT NULL,
  `bill_date` date DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payments_patient_id_foreign` (`patient_id`),
  CONSTRAINT `payments_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reference_intervals`
--

DROP TABLE IF EXISTS `reference_intervals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reference_intervals` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `lab_test_id` bigint(20) unsigned DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `age_min` smallint(5) unsigned NOT NULL DEFAULT 0,
  `age_max` smallint(5) unsigned DEFAULT NULL,
  `age_type` varchar(255) DEFAULT NULL,
  `reference_text` text DEFAULT NULL,
  `min_value` decimal(10,2) DEFAULT NULL,
  `max_value` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reference_intervals_lab_test_id_foreign` (`lab_test_id`),
  CONSTRAINT `reference_intervals_lab_test_id_foreign` FOREIGN KEY (`lab_test_id`) REFERENCES `lab_tests` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reference_intervals`
--

LOCK TABLES `reference_intervals` WRITE;
/*!40000 ALTER TABLE `reference_intervals` DISABLE KEYS */;
/*!40000 ALTER TABLE `reference_intervals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reference_templates`
--

DROP TABLE IF EXISTS `reference_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reference_templates` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `reference_templates_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reference_templates`
--

LOCK TABLES `reference_templates` WRITE;
/*!40000 ALTER TABLE `reference_templates` DISABLE KEYS */;
INSERT INTO `reference_templates` VALUES (1,'1','2026-06-11 16:37:30','2026-06-11 16:37:30');
/*!40000 ALTER TABLE `reference_templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `report_signatures`
--

DROP TABLE IF EXISTS `report_signatures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `report_signatures` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `pin_hash` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `report_signatures`
--

LOCK TABLES `report_signatures` WRITE;
/*!40000 ALTER TABLE `report_signatures` DISABLE KEYS */;
INSERT INTO `report_signatures` VALUES (1,'suhaim oft','report-signatures/dWmncbhYsETcggXq6xq4O9SXeYSWOVn4KrFTzJBo.png','$2y$12$wNhFcSJCH/b.hBmP/i39P.1hTK.afwvIXQKX05AhdWwAf.TQfXnaG','2026-06-11 16:35:07','2026-06-11 16:39:12');
/*!40000 ALTER TABLE `report_signatures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `result_templates`
--

DROP TABLE IF EXISTS `result_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `result_templates` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `result_templates_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `result_templates`
--

LOCK TABLES `result_templates` WRITE;
/*!40000 ALTER TABLE `result_templates` DISABLE KEYS */;
INSERT INTO `result_templates` VALUES (1,'1','2026-06-11 16:37:25','2026-06-11 16:37:25');
/*!40000 ALTER TABLE `result_templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('WhhZ4ugquvHmXRGERLKPSK1SqBQNpUVeBhe0xfxf',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36','ZXlKcGRpSTZJa3NyU1ZOaFZsZG1WWEJuVHpkSFVVZEpkVEpRT0VFOVBTSXNJblpoYkhWbElqb2lWemxZZVUxdFVWUnBObEJJVDNaVlUyUXlUakJKTUZsVFp6TTFOVTFhYW01c1RHOXZUekJxZW1aUGJrOWFSM2R5ZUVGUlNtbzBVbVZQYld4R01saFVjbWx5ZEhsTFpFTjROa2xpWkZkcmRWRjJRV3RhWVRWYVFtMU5NelkyZENzelpUSkVTVTVaWlVWMWNYaFJWM2RoYkVaQlZYbElZelpWVUhaamNEWnRTR2hVWW5RMU0wVnpSWG8yVFZsc1kyZGlNR0ZuUWpWc2FGbE5UR1ZVU3l0SE5IWTRTalowYW5Fd1JtMVJLM2d3UkV0c1RUZ3pTVWxVWWsxTk9YUkRWVkJXZGxwVEwzVkhWa2c0UkU5Tk1tUkxkelpZYlZWRE5XTlpObVEzVGtSdVJUVjRhbEZHU1dGbUwwd3JSV3BoUlZSaUswTlpRM1Z5ZVU5aFlWVTFMek4wVVVkYVJrcFZWWE5DZGtKeVIwSlNZVkpQYTBkV2NHdFVaRlZEVVdkNUx5OUdRV055VlVSbGVGa3ZPR3R3VGxCeWVtUkhURW94VTJ0WlYwdzBWbTFqTkRRdldWZHNjVEpZTVM5UU1qQm1ZVzV0Y0d4WlFXUkhXVTk1ZEhaUGVFTklRWG96U0VkUWREbENZbEZ6YTNwSWFuTkZVSFZYVnk4MFYwNTBhbWhHYTFwa0lpd2liV0ZqSWpvaU56TTVOMkZqTVRVM1pqVm1NbUUzTWpSbU1XVmlNVFZrTmpZNVpEWm1NamxqTUdKbFpEWXhaR001TW1Kak4ySXpZamczTmpFeU16bG1ZV1F3TnpSa01TSXNJblJoWnlJNklpSjk=',1781238061);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sub_categories`
--

DROP TABLE IF EXISTS `sub_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sub_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sub_categories_category_id_foreign` (`category_id`),
  CONSTRAINT `sub_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sub_categories`
--

LOCK TABLES `sub_categories` WRITE;
/*!40000 ALTER TABLE `sub_categories` DISABLE KEYS */;
INSERT INTO `sub_categories` VALUES (1,1,'lipd profile',NULL,'2026-06-11 16:37:13','2026-06-11 16:37:13');
/*!40000 ALTER TABLE `sub_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test_parameters`
--

DROP TABLE IF EXISTS `test_parameters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test_parameters` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `lab_test_id` bigint(20) unsigned NOT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `male_reference` text DEFAULT NULL,
  `female_reference` text DEFAULT NULL,
  `biological_reference` text DEFAULT NULL,
  `male_min` decimal(10,2) DEFAULT NULL,
  `male_max` decimal(10,2) DEFAULT NULL,
  `female_min` decimal(10,2) DEFAULT NULL,
  `female_max` decimal(10,2) DEFAULT NULL,
  `critical_low` decimal(10,2) DEFAULT NULL,
  `critical_high` decimal(10,2) DEFAULT NULL,
  `is_immunoassay` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `test_parameters_lab_test_id_unique` (`lab_test_id`),
  CONSTRAINT `test_parameters_lab_test_id_foreign` FOREIGN KEY (`lab_test_id`) REFERENCES `lab_tests` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test_parameters`
--

LOCK TABLES `test_parameters` WRITE;
/*!40000 ALTER TABLE `test_parameters` DISABLE KEYS */;
/*!40000 ALTER TABLE `test_parameters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test_report_audits`
--

DROP TABLE IF EXISTS `test_report_audits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test_report_audits` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `test_report_id` bigint(20) unsigned DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `old_data` longtext DEFAULT NULL,
  `new_data` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `test_report_audits_user_id_foreign` (`user_id`),
  KEY `test_report_audits_test_report_id_action_index` (`test_report_id`,`action`),
  CONSTRAINT `test_report_audits_test_report_id_foreign` FOREIGN KEY (`test_report_id`) REFERENCES `test_reports` (`id`) ON DELETE SET NULL,
  CONSTRAINT `test_report_audits_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test_report_audits`
--

LOCK TABLES `test_report_audits` WRITE;
/*!40000 ALTER TABLE `test_report_audits` DISABLE KEYS */;
INSERT INTO `test_report_audits` VALUES (1,1,1,'created',NULL,'{\"report\":{\"id\":1,\"patient_id\":1,\"doctor_name\":\"Self\",\"sample_received_on\":\"2026-06-11T16:39:00.000000Z\",\"report_released_on\":\"2026-06-11T16:39:00.000000Z\",\"barcode\":\"602048\",\"status\":\"Completed\",\"notes\":null,\"report_signature_id\":1},\"signature\":{\"id\":1,\"name\":\"suhaim oft\",\"image_path\":\"report-signatures\\/dWmncbhYsETcggXq6xq4O9SXeYSWOVn4KrFTzJBo.png\"},\"results\":[{\"category\":\"hemotolagy\",\"subcategory\":\"lipd profile\",\"name\":\"cbc\",\"observed_value\":\"1\",\"unit\":\"\",\"normal_value\":\"1\",\"biological_reference\":\"1\",\"flag\":\"H\"}]}','2026-06-11 16:40:19','2026-06-11 16:40:19');
/*!40000 ALTER TABLE `test_report_audits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test_report_items`
--

DROP TABLE IF EXISTS `test_report_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test_report_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `test_report_id` bigint(20) unsigned NOT NULL,
  `lab_test_id` bigint(20) unsigned DEFAULT NULL,
  `category` varchar(255) NOT NULL DEFAULT 'General',
  `subcategory` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `observed_value` varchar(255) NOT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `normal_value` text DEFAULT NULL,
  `biological_reference` text DEFAULT NULL,
  `flag` varchar(10) DEFAULT NULL,
  `sort_order` int(10) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `test_report_items_lab_test_id_foreign` (`lab_test_id`),
  KEY `test_report_items_test_report_id_sort_order_index` (`test_report_id`,`sort_order`),
  KEY `test_report_items_name_observed_value_index` (`name`,`observed_value`),
  KEY `test_report_items_flag_index` (`flag`),
  CONSTRAINT `test_report_items_lab_test_id_foreign` FOREIGN KEY (`lab_test_id`) REFERENCES `lab_tests` (`id`) ON DELETE SET NULL,
  CONSTRAINT `test_report_items_test_report_id_foreign` FOREIGN KEY (`test_report_id`) REFERENCES `test_reports` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test_report_items`
--

LOCK TABLES `test_report_items` WRITE;
/*!40000 ALTER TABLE `test_report_items` DISABLE KEYS */;
INSERT INTO `test_report_items` VALUES (1,1,1,'hemotolagy','lipd profile','cbc','1','','1','1','H',0,'2026-06-11 16:40:19','2026-06-11 16:40:19');
/*!40000 ALTER TABLE `test_report_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test_reports`
--

DROP TABLE IF EXISTS `test_reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test_reports` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` bigint(20) unsigned NOT NULL,
  `doctor_name` varchar(255) DEFAULT NULL,
  `sample_received_on` datetime DEFAULT NULL,
  `report_released_on` datetime DEFAULT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Completed',
  `notes` text DEFAULT NULL,
  `report_signature_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `test_reports_patient_id_foreign` (`patient_id`),
  KEY `test_reports_report_signature_id_foreign` (`report_signature_id`),
  CONSTRAINT `test_reports_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE,
  CONSTRAINT `test_reports_report_signature_id_foreign` FOREIGN KEY (`report_signature_id`) REFERENCES `report_signatures` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test_reports`
--

LOCK TABLES `test_reports` WRITE;
/*!40000 ALTER TABLE `test_reports` DISABLE KEYS */;
INSERT INTO `test_reports` VALUES (1,1,'Self','2026-06-11 22:09:00','2026-06-11 22:09:00','602048','Completed',NULL,1,'2026-06-11 16:40:19','2026-06-11 16:40:19',NULL);
/*!40000 ALTER TABLE `test_reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `units`
--

DROP TABLE IF EXISTS `units`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `units` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `units_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `units`
--

LOCK TABLES `units` WRITE;
/*!40000 ALTER TABLE `units` DISABLE KEYS */;
INSERT INTO `units` VALUES (1,'1','2026-06-11 16:37:21','2026-06-11 16:37:21');
/*!40000 ALTER TABLE `units` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sidebar_collapsed` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Safwan','lab@gmail.com',NULL,'$2y$12$ADHvZzkmj8ZAPxaS7MUedea.e3yJ5XsFqFJ.QK8T10z1Q0zqwbore','k981ss1g2op1GDudSZSaDObH8u37mcERYQFRNzdCXUOwTNUNP1Lo6wTh5jIR','2026-06-11 11:43:32','2026-06-11 11:43:32',0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vital_signs`
--

DROP TABLE IF EXISTS `vital_signs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vital_signs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` bigint(20) unsigned NOT NULL,
  `temperature` decimal(4,1) DEFAULT NULL,
  `temp_unit` varchar(1) NOT NULL DEFAULT 'F',
  `pulse` int(11) DEFAULT NULL,
  `respiratory_rate` int(11) DEFAULT NULL,
  `blood_pressure` varchar(20) DEFAULT NULL,
  `spo2` int(11) DEFAULT NULL,
  `weight` decimal(5,2) DEFAULT NULL,
  `height` decimal(5,2) DEFAULT NULL,
  `bmi` decimal(4,1) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vital_signs_patient_id_foreign` (`patient_id`),
  CONSTRAINT `vital_signs_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vital_signs`
--

LOCK TABLES `vital_signs` WRITE;
/*!40000 ALTER TABLE `vital_signs` DISABLE KEYS */;
/*!40000 ALTER TABLE `vital_signs` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-06-12 10:03:16
