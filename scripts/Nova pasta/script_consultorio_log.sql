CREATE DATABASE  IF NOT EXISTS `consultorio_log` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `consultorio_log`;
-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: localhost    Database: consultorio_log
-- ------------------------------------------------------
-- Server version	5.7.12-log

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
-- Table structure for table `system_access_log`
--

DROP TABLE IF EXISTS `system_access_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system_access_log` (
  `id` int(11) NOT NULL,
  `sessionid` text COLLATE utf8_unicode_ci,
  `login` text COLLATE utf8_unicode_ci,
  `login_time` datetime DEFAULT NULL,
  `logout_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_access_log`
--

LOCK TABLES `system_access_log` WRITE;
/*!40000 ALTER TABLE `system_access_log` DISABLE KEYS */;
INSERT INTO `system_access_log` VALUES (1,'pci0kmcjn6dms04i59lfpthe78','admin','2018-06-26 00:23:03',NULL),(2,'65b59hfjrqtv9giepo0hvqp6e4','admin','2018-06-28 16:03:36',NULL),(3,'s6fn5ur25j3d23ct2km22qiepo','admin','2018-07-03 10:39:23',NULL),(4,'alontec3m0kdfp9edht394ndhj','admin','2018-07-09 15:18:01',NULL),(5,'po4u4b4qbo37q8jbp8hhvr78u2','admin','2018-07-10 15:02:33',NULL),(6,'ho7l0cmb18u7l4ke2ftee3s5a0','admin','2018-07-11 13:52:54','2018-07-11 16:30:47'),(7,'88avusjolqlvr42sptdojq6mi9','admin','2018-07-11 16:30:56',NULL),(8,'f52mrbter0s5ncqhme6oeqnvqd','admin','2018-07-12 11:20:34',NULL),(9,'2vtu51f0f6effrd96j3l0ln60q','admin','2018-07-14 10:57:31',NULL),(10,'itj4pd3l5hrhvkompojhf4qtjk','admin','2018-07-17 10:15:03','2018-07-17 23:35:55'),(11,'tpbtk7ctsh25ov2mol1blii5u2','admin','2018-07-18 13:01:37',NULL),(12,'jon74976hgkvhjeq141usbq9qn','admin','2018-07-18 18:19:24','2018-07-18 18:43:47'),(13,'arr43p454on53afm4388fjmrr4','admin','2018-07-18 18:43:55','2018-07-18 18:52:06'),(14,'vbvao63k0hfufob5co0h5p6nlr','admin','2018-07-18 18:52:16','2018-07-18 18:57:00'),(15,'v9e36n33gs2actnh8eu1k1b916','admin','2018-07-18 18:57:06','2018-07-18 19:28:46'),(16,'rdbugu1eaqm4poo402mmhg6uma','admin','2018-07-18 19:28:54','2018-07-18 19:45:47'),(17,'o2s3bgmnhaitnn8blu6eiop6bv','admin','2018-07-18 19:45:52',NULL),(18,'ijtjo9pu5ipohg1700do8jhhoh','admin','2018-07-18 20:00:33',NULL),(19,'c6cavi219erduverg7avcajhd0','admin','2018-07-19 11:23:52',NULL);
/*!40000 ALTER TABLE `system_access_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `system_change_log`
--

DROP TABLE IF EXISTS `system_change_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system_change_log` (
  `id` int(11) NOT NULL,
  `logdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `login` text COLLATE utf8_unicode_ci,
  `tablename` text COLLATE utf8_unicode_ci,
  `primarykey` text COLLATE utf8_unicode_ci,
  `pkvalue` text COLLATE utf8_unicode_ci,
  `operation` text COLLATE utf8_unicode_ci,
  `columnname` text COLLATE utf8_unicode_ci,
  `oldvalue` text COLLATE utf8_unicode_ci,
  `newvalue` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_change_log`
--

LOCK TABLES `system_change_log` WRITE;
/*!40000 ALTER TABLE `system_change_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `system_change_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `system_sql_log`
--

DROP TABLE IF EXISTS `system_sql_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system_sql_log` (
  `id` int(11) NOT NULL,
  `logdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `login` text COLLATE utf8_unicode_ci,
  `database_name` text COLLATE utf8_unicode_ci,
  `sql_command` text COLLATE utf8_unicode_ci,
  `statement_type` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_sql_log`
--

LOCK TABLES `system_sql_log` WRITE;
/*!40000 ALTER TABLE `system_sql_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `system_sql_log` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-07-19 13:46:03
