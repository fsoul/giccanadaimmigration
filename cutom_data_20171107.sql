-- MySQL dump 10.13  Distrib 5.7.17, for Linux (x86_64)
--
-- Host: localhost    Database: wp_giccanadaimmigration
-- ------------------------------------------------------
-- Server version	5.7.20-0ubuntu0.16.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `wp_attach_type`
--

DROP TABLE IF EXISTS `wp_attach_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_attach_type` (
  `att_type_id` int(11) NOT NULL,
  `att_type_code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `att_type_descr` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`att_type_id`),
  UNIQUE KEY `wp_attach_type_att_type_code_uindex` (`att_type_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wp_attachments`
--

DROP TABLE IF EXISTS `wp_attachments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_attachments` (
  `attach_id` int(11) NOT NULL AUTO_INCREMENT,
  `attach_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attach_filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attach_ext` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attach_hashname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attach_path` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attach_size` int(11) NOT NULL,
  `attach_type` int(11) DEFAULT NULL,
  PRIMARY KEY (`attach_id`),
  KEY `wp_attach_email` (`attach_email`),
  KEY `wp_attachments_type` (`attach_type`),
  CONSTRAINT `wp_attachments_type` FOREIGN KEY (`attach_type`) REFERENCES `wp_attach_type` (`att_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wp_open_case`
--

DROP TABLE IF EXISTS `wp_open_case`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_open_case` (
  `open_case_id` int(11) NOT NULL AUTO_INCREMENT,
  `open_case_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `open_case_phone` varchar(255) CHARACTER SET utf8 NOT NULL,
  `open_case_email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `open_case_country` char(2) CHARACTER SET utf8 NOT NULL,
  `open_case_lang` char(2) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`open_case_id`),
  UNIQUE KEY `open_case_email_UNIQUE` (`open_case_email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-11-07 12:31:21
