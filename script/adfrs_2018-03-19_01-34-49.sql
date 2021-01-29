-- MySQL dump 10.16  Distrib 10.1.21-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: localhost
-- ------------------------------------------------------
-- Server version	10.1.21-MariaDB

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
-- Table structure for table `gago`
--

DROP TABLE IF EXISTS `gago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gago` (
  `gagi_id` int(11) NOT NULL AUTO_INCREMENT,
  `gago ako` varchar(255) NOT NULL,
  PRIMARY KEY (`gagi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gago`
--

LOCK TABLES `gago` WRITE;
/*!40000 ALTER TABLE `gago` DISABLE KEYS */;
/*!40000 ALTER TABLE `gago` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_activity`
--

DROP TABLE IF EXISTS `t_activity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_activity` (
  `activity_id` int(25) NOT NULL AUTO_INCREMENT,
  `activity` varchar(500) NOT NULL,
  `bill_id` int(11) DEFAULT NULL,
  `incoming_id` int(11) DEFAULT NULL,
  `outgoing_id` int(11) DEFAULT NULL,
  `voucher_id` int(25) DEFAULT NULL,
  `file_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`activity_id`),
  KEY `bill_id` (`bill_id`),
  KEY `t_activity_ibfk_2` (`file_id`),
  KEY `voucher_id` (`voucher_id`),
  KEY `incoming_id` (`incoming_id`),
  KEY `outgoing_id` (`outgoing_id`),
  CONSTRAINT `t_activity_ibfk_1` FOREIGN KEY (`bill_id`) REFERENCES `t_bill_info` (`bill_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `t_activity_ibfk_2` FOREIGN KEY (`file_id`) REFERENCES `t_files` (`file_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `t_activity_ibfk_3` FOREIGN KEY (`voucher_id`) REFERENCES `t_voucher_info` (`voucher_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `t_activity_ibfk_4` FOREIGN KEY (`incoming_id`) REFERENCES `t_incoming` (`incoming_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `t_activity_ibfk_5` FOREIGN KEY (`outgoing_id`) REFERENCES `t_outgoing` (`outgoing_id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=689 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_activity`
--

LOCK TABLES `t_activity` WRITE;
/*!40000 ALTER TABLE `t_activity` DISABLE KEYS */;
INSERT INTO `t_activity` VALUES (673,'Nora Alvarez just Logged in ',NULL,NULL,NULL,NULL,NULL),(674,'Nora Alvarez backed up the database ',NULL,NULL,NULL,NULL,NULL),(675,'Nora Alvarez just Logged in ',NULL,NULL,NULL,NULL,NULL),(676,'Nora Alvarez has logged out',NULL,NULL,NULL,NULL,NULL),(677,'Nora Alvarez just Logged in ',NULL,NULL,NULL,NULL,NULL),(678,'Nora Alvarez just Logged in ',NULL,NULL,NULL,NULL,NULL),(679,'Nora Alvarez backed up the database ',NULL,NULL,NULL,NULL,NULL),(680,'Nora Alvarez just Logged in ',NULL,NULL,NULL,NULL,NULL),(681,'Nora Alvarez added a new bill with an attachment, LEYECO for the month of March year 2018',3,NULL,NULL,NULL,162),(682,'Nora Alvarez backed up the database ',NULL,NULL,NULL,NULL,NULL),(683,'Nora Alvarez backed up the database ',NULL,NULL,NULL,NULL,NULL),(684,'Nora Alvarez backed up the database ',NULL,NULL,NULL,NULL,NULL),(685,'Nora Alvarez backed up the database ',NULL,NULL,NULL,NULL,NULL),(686,'Nora Alvarez backed up the database ',NULL,NULL,NULL,NULL,NULL),(687,'Nora Alvarez backed up the database ',NULL,NULL,NULL,NULL,NULL),(688,'Nora Alvarez backed up the database ',NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `t_activity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_administrator_code`
--

DROP TABLE IF EXISTS `t_administrator_code`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_administrator_code` (
  `administrator_code_id` int(11) NOT NULL AUTO_INCREMENT,
  `administrator_code` varchar(255) NOT NULL,
  PRIMARY KEY (`administrator_code_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_administrator_code`
--

LOCK TABLES `t_administrator_code` WRITE;
/*!40000 ALTER TABLE `t_administrator_code` DISABLE KEYS */;
INSERT INTO `t_administrator_code` VALUES (2,'$2y$10$9dEarxp6NxcGwQZ.Hi6Kgu5RDI5f5znTmXl95f2oHhLCdDKqRo78S');
/*!40000 ALTER TABLE `t_administrator_code` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_bill_info`
--

DROP TABLE IF EXISTS `t_bill_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_bill_info` (
  `bill_id` int(11) NOT NULL AUTO_INCREMENT,
  `payee` varchar(255) NOT NULL,
  `bill_month` varchar(255) NOT NULL,
  `bill_year` year(4) NOT NULL,
  `date_receive` date NOT NULL,
  `bill_amount` int(11) NOT NULL,
  `due_date` date NOT NULL,
  `receipt_no` varchar(255) NOT NULL,
  `status_id` int(25) NOT NULL,
  PRIMARY KEY (`bill_id`),
  KEY `status_id` (`status_id`),
  CONSTRAINT `t_bill_info_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `t_bill_status` (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_bill_info`
--

LOCK TABLES `t_bill_info` WRITE;
/*!40000 ALTER TABLE `t_bill_info` DISABLE KEYS */;
INSERT INTO `t_bill_info` VALUES (1,'LMWD','March',2018,'2018-03-16',3900,'2018-03-30','',2),(2,'JRS','March',2018,'2018-03-19',600,'2018-04-06','',2),(3,'LEYECO','March',2018,'2018-03-19',4800,'2018-03-30','',2);
/*!40000 ALTER TABLE `t_bill_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_bill_status`
--

DROP TABLE IF EXISTS `t_bill_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_bill_status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_bill_status`
--

LOCK TABLES `t_bill_status` WRITE;
/*!40000 ALTER TABLE `t_bill_status` DISABLE KEYS */;
INSERT INTO `t_bill_status` VALUES (1,'paid'),(2,'unpaid');
/*!40000 ALTER TABLE `t_bill_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_files`
--

DROP TABLE IF EXISTS `t_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_files` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `bill_id` int(11) DEFAULT NULL,
  `incoming_id` int(11) DEFAULT NULL,
  `outgoing_id` int(11) DEFAULT NULL,
  `voucher_id` int(11) DEFAULT NULL,
  `filename` varchar(255) NOT NULL,
  `filetype` varchar(20) NOT NULL,
  `filesize` int(11) NOT NULL,
  `filepath` varchar(255) NOT NULL,
  PRIMARY KEY (`file_id`),
  KEY `t_files_ibfk_1` (`bill_id`),
  KEY `voucher_id` (`voucher_id`),
  KEY `incoming_id` (`incoming_id`),
  KEY `outgoing_id` (`outgoing_id`),
  CONSTRAINT `t_files_ibfk_1` FOREIGN KEY (`bill_id`) REFERENCES `t_bill_info` (`bill_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `t_files_ibfk_2` FOREIGN KEY (`voucher_id`) REFERENCES `t_voucher_info` (`voucher_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `t_files_ibfk_3` FOREIGN KEY (`incoming_id`) REFERENCES `t_incoming` (`incoming_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `t_files_ibfk_4` FOREIGN KEY (`outgoing_id`) REFERENCES `t_outgoing` (`outgoing_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=163 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_files`
--

LOCK TABLES `t_files` WRITE;
/*!40000 ALTER TABLE `t_files` DISABLE KEYS */;
INSERT INTO `t_files` VALUES (155,NULL,12,NULL,NULL,'Rizon Repunte-Certificate.pdf','application/pdf',68106,'../system/files/5aabc43e797287.46770718.pdf'),(157,NULL,14,NULL,NULL,'Bills.pdf','application/pdf',66475,'../system/files/5aae1ca8e54279.06326273.pdf'),(158,1,NULL,NULL,NULL,'Application letter ni Rizon.pdf','application/pdf',210642,'../system/files/5aae1edca9eb23.53810902.pdf'),(160,NULL,NULL,1,NULL,'ROMEL REPUNTE.pdf','application/pdf',93232,'../system/files/5aae91ee097886.72453244.pdf'),(161,2,NULL,NULL,NULL,'Bills.pdf','application/pdf',66475,'../system/files/5aaf5bf6cc55a8.33271058.pdf'),(162,3,NULL,NULL,NULL,'DFD_over_Flowcharts.pdf','application/pdf',61726,'../system/files/5aafa781acb8a4.14647136.pdf');
/*!40000 ALTER TABLE `t_files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_incoming`
--

DROP TABLE IF EXISTS `t_incoming`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_incoming` (
  `incoming_id` int(11) NOT NULL AUTO_INCREMENT,
  `incoming_sender` varchar(255) NOT NULL,
  `incoming_addressee` varchar(255) NOT NULL,
  `date_received` date NOT NULL,
  `scheduled_event` date NOT NULL,
  `incoming_reference_number` int(11) NOT NULL,
  `incoming_remarks` varchar(500) NOT NULL,
  PRIMARY KEY (`incoming_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_incoming`
--

LOCK TABLES `t_incoming` WRITE;
/*!40000 ALTER TABLE `t_incoming` DISABLE KEYS */;
INSERT INTO `t_incoming` VALUES (12,'DENR','NBI','2018-03-08','2018-03-17',45556666,'Tree Planting Activity'),(14,'DENR','NBI','2018-03-18','2018-03-19',45577777,'Tree Planting');
/*!40000 ALTER TABLE `t_incoming` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_logs`
--

DROP TABLE IF EXISTS `t_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_logs` (
  `log_id` int(25) NOT NULL AUTO_INCREMENT,
  `user_id` int(25) NOT NULL,
  `activity_id` int(25) NOT NULL,
  `log_date` date NOT NULL,
  `log_time` time NOT NULL,
  PRIMARY KEY (`log_id`),
  KEY `user_id` (`user_id`),
  KEY `activity_id` (`activity_id`),
  CONSTRAINT `t_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `t_user` (`user_id`),
  CONSTRAINT `t_logs_ibfk_2` FOREIGN KEY (`activity_id`) REFERENCES `t_activity` (`activity_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=499 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_logs`
--

LOCK TABLES `t_logs` WRITE;
/*!40000 ALTER TABLE `t_logs` DISABLE KEYS */;
INSERT INTO `t_logs` VALUES (483,1,673,'2018-03-19','07:46:29'),(484,1,674,'2018-03-19','07:49:42'),(485,1,675,'2018-03-19','07:52:46'),(486,1,676,'2018-03-19','07:52:56'),(487,1,677,'2018-03-19','07:53:12'),(488,1,678,'2018-03-19','07:53:12'),(489,1,679,'2018-03-19','07:54:54'),(490,1,680,'2018-03-19','08:01:21'),(491,1,681,'2018-03-19','08:05:21'),(492,1,682,'2018-03-19','08:08:09'),(493,1,683,'2018-03-19','08:16:20'),(494,1,684,'2018-03-19','08:17:05'),(495,1,685,'2018-03-19','08:17:38'),(496,1,686,'2018-03-19','08:21:10'),(497,1,687,'2018-03-19','08:26:27'),(498,1,688,'2018-03-19','08:29:43');
/*!40000 ALTER TABLE `t_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_outgoing`
--

DROP TABLE IF EXISTS `t_outgoing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_outgoing` (
  `outgoing_id` int(25) NOT NULL AUTO_INCREMENT,
  `outgoing_sender` varchar(255) NOT NULL,
  `outgoing_addressee` varchar(255) NOT NULL,
  `date_released` date NOT NULL,
  `outgoing_reference_number` int(11) NOT NULL,
  `outgoing_remarks` varchar(500) NOT NULL,
  PRIMARY KEY (`outgoing_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_outgoing`
--

LOCK TABLES `t_outgoing` WRITE;
/*!40000 ALTER TABLE `t_outgoing` DISABLE KEYS */;
INSERT INTO `t_outgoing` VALUES (1,'NBI','City hall','2018-03-16',45778888,'Meeting with the City mayor of tacloban');
/*!40000 ALTER TABLE `t_outgoing` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_role`
--

DROP TABLE IF EXISTS `t_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_type` varchar(25) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_role`
--

LOCK TABLES `t_role` WRITE;
/*!40000 ALTER TABLE `t_role` DISABLE KEYS */;
INSERT INTO `t_role` VALUES (1,'Administrator'),(2,'User');
/*!40000 ALTER TABLE `t_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_status`
--

DROP TABLE IF EXISTS `t_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_status` (
  `user_status_id` int(25) NOT NULL AUTO_INCREMENT,
  `user_status` varchar(255) NOT NULL,
  PRIMARY KEY (`user_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_status`
--

LOCK TABLES `t_status` WRITE;
/*!40000 ALTER TABLE `t_status` DISABLE KEYS */;
INSERT INTO `t_status` VALUES (1,'active'),(2,'inactive');
/*!40000 ALTER TABLE `t_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_user`
--

DROP TABLE IF EXISTS `t_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `office_position` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `user_status_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `role_id` (`role_id`),
  KEY `user_status_id` (`user_status_id`),
  CONSTRAINT `t_user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `t_role` (`role_id`),
  CONSTRAINT `t_user_ibfk_2` FOREIGN KEY (`user_status_id`) REFERENCES `t_status` (`user_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_user`
--

LOCK TABLES `t_user` WRITE;
/*!40000 ALTER TABLE `t_user` DISABLE KEYS */;
INSERT INTO `t_user` VALUES (1,'admin','21232f297a57a5a743894a0e4a801fc3','Nora','C.','Alvarez','Administrative Office Clerk',1,1),(12,'rizon','ba1be7dfbbf9d125a30d1a500ecca305','Rizon','Ercilla','Repunte','Technician',2,1),(22,'errol','3c373db6a5cad964a0289a1765d577d9','Errol','Operaria','Abella','Technician',2,1),(24,'sieg','6ae357dc98f739341238fc52aea9d00d','Siegfried','Caande','Quimbo','Administrative Office Clerk',2,1);
/*!40000 ALTER TABLE `t_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_voucher_info`
--

DROP TABLE IF EXISTS `t_voucher_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_voucher_info` (
  `voucher_id` int(25) NOT NULL AUTO_INCREMENT,
  `payee` varchar(255) NOT NULL,
  `invoice_date` date NOT NULL,
  `invoice_amount` int(25) NOT NULL,
  `particulars` varchar(300) NOT NULL,
  PRIMARY KEY (`voucher_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_voucher_info`
--

LOCK TABLES `t_voucher_info` WRITE;
/*!40000 ALTER TABLE `t_voucher_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_voucher_info` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-03-19 20:34:49
