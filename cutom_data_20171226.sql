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
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
  UNIQUE KEY `wp_open_case_email_unique` (`open_case_email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wp_partner_education`
--

DROP TABLE IF EXISTS `wp_partner_education`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_partner_education` (
  `ped_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ped_partner_id` bigint(20) unsigned NOT NULL,
  `ped_education_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ped_speciality` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ped_country` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ped_level` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ped_certificate_type` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ped_type` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ped_from` date DEFAULT NULL,
  `ped_to` date DEFAULT NULL,
  PRIMARY KEY (`ped_id`),
  KEY `fk_ped_user_idx` (`ped_partner_id`),
  CONSTRAINT `wp_ped_upi_upi_fk` FOREIGN KEY (`ped_partner_id`) REFERENCES `wp_user_partner_info` (`upi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wp_partner_work`
--

DROP TABLE IF EXISTS `wp_partner_work`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_partner_work` (
  `pw_id` int(11) NOT NULL AUTO_INCREMENT,
  `pw_partner_id` bigint(20) unsigned NOT NULL,
  `pw_company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pw_company_country` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pw_company_position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pw_company_from` date DEFAULT NULL,
  `pw_company_to` date DEFAULT NULL,
  `pw_company_requirement` varchar(1024) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`pw_id`),
  KEY `fk_pw_user_idx` (`pw_partner_id`),
  CONSTRAINT `fk_pw_partner` FOREIGN KEY (`pw_partner_id`) REFERENCES `wp_user_partner_info` (`upi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wp_user_child`
--

DROP TABLE IF EXISTS `wp_user_child`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_user_child` (
  `uc_id` bigint(10) NOT NULL AUTO_INCREMENT,
  `uc_user_id` bigint(10) unsigned NOT NULL,
  `uc_surname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uc_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uc_birthday` date DEFAULT NULL,
  PRIMARY KEY (`uc_id`),
  KEY `wp_uc_user` (`uc_user_id`),
  CONSTRAINT `wp_uc_user` FOREIGN KEY (`uc_user_id`) REFERENCES `wp_users` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wp_user_common_info`
--

DROP TABLE IF EXISTS `wp_user_common_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_user_common_info` (
  `uci_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uci_userid` bigint(20) unsigned NOT NULL,
  `uci_birth_date` date DEFAULT NULL,
  `uci_sex` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uci_family_status` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uci_citizenship` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uci_country_residence` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uci_country_residence_from` int(11) DEFAULT NULL,
  `uci_status_residence` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uci_native_lang` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uci_passport_num` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uci_passport_exp_date` date DEFAULT NULL,
  `uci_passport_country` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uci_ass_phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uci_future_province` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uci_future_city` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uci_studied_at_canada` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uci_partner_studied_at_canada` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uci_partner_worked_at_canada` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uci_worked_at_canada` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`uci_id`),
  KEY `fk_uci_users_idx` (`uci_userid`),
  CONSTRAINT `fk_uci_users` FOREIGN KEY (`uci_userid`) REFERENCES `wp_users` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wp_user_education`
--

DROP TABLE IF EXISTS `wp_user_education`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_user_education` (
  `ued_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ued_user_id` bigint(20) unsigned NOT NULL,
  `ued_education_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ued_speciality` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ued_country` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ued_level` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ued_certificate_type` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ued_type` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ued_from` date DEFAULT NULL,
  `ued_to` date DEFAULT NULL,
  PRIMARY KEY (`ued_id`),
  KEY `fk_ued_user_idx` (`ued_user_id`),
  CONSTRAINT `fk_ued_user` FOREIGN KEY (`ued_user_id`) REFERENCES `wp_users` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wp_user_lang`
--

DROP TABLE IF EXISTS `wp_user_lang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_user_lang` (
  `ul_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ul_user_id` bigint(20) unsigned NOT NULL,
  `ul_fr_listening` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ul_fr_writing` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ul_fr_reading` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ul_fr_speaking` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ul_en_listening` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ul_en_writing` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ul_en_reading` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ul_en_speaking` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ul_id`),
  KEY `fk_ul_user_idx` (`ul_user_id`),
  CONSTRAINT `fk_ul_user` FOREIGN KEY (`ul_user_id`) REFERENCES `wp_users` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wp_user_partner_info`
--

DROP TABLE IF EXISTS `wp_user_partner_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_user_partner_info` (
  `upi_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `upi_user_id` bigint(20) unsigned NOT NULL,
  `upi_last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `upi_first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `upi_birthday` date DEFAULT NULL,
  `upi_sex` char(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `upi_status` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `upi_relation_type` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `upi_relation_from` date DEFAULT NULL,
  `upi_relation_to` date DEFAULT NULL,
  PRIMARY KEY (`upi_id`),
  KEY `fk_upi_users_idx` (`upi_user_id`),
  CONSTRAINT `fk_upi_users` FOREIGN KEY (`upi_user_id`) REFERENCES `wp_users` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Информация о партнере';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wp_user_payment`
--

DROP TABLE IF EXISTS `wp_user_payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_user_payment` (
  `usp_id` bigint(10) unsigned NOT NULL AUTO_INCREMENT,
  `usp_user_id` bigint(10) unsigned NOT NULL,
  `usp_type` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`usp_id`),
  KEY `wp_usp_user` (`usp_user_id`),
  CONSTRAINT `wp_usp_user` FOREIGN KEY (`usp_user_id`) REFERENCES `wp_users` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wp_user_relatives`
--

DROP TABLE IF EXISTS `wp_user_relatives`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_user_relatives` (
  `ur_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ur_user_id` bigint(20) unsigned NOT NULL,
  `ur_rel_with` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ur_first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ur_last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ur_status` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ur_province` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ur_id`),
  KEY `fk_ur_user_idx` (`ur_user_id`),
  CONSTRAINT `fk_ur_user` FOREIGN KEY (`ur_user_id`) REFERENCES `wp_users` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wp_user_work`
--

DROP TABLE IF EXISTS `wp_user_work`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_user_work` (
  `uw_id` int(11) NOT NULL AUTO_INCREMENT,
  `uw_user_id` bigint(20) unsigned NOT NULL,
  `uw_company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uw_company_country` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uw_company_position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uw_company_from` date DEFAULT NULL,
  `uw_company_to` date DEFAULT NULL,
  `uw_company_requirement` varchar(1024) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`uw_id`),
  KEY `fk_uw_user_idx` (`uw_user_id`),
  CONSTRAINT `fk_uw_user` FOREIGN KEY (`uw_user_id`) REFERENCES `wp_users` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-12-26 16:40:18
