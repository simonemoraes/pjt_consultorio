-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: localhost    Database: consultorio_permission
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
-- Table structure for table `system_group`
--

DROP TABLE IF EXISTS `system_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system_group` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_group`
--

LOCK TABLES `system_group` WRITE;
/*!40000 ALTER TABLE `system_group` DISABLE KEYS */;
INSERT INTO `system_group` VALUES (1,'Admin'),(2,'Standard'),(3,'Cadastros Básicos'),(4,'Pessoas');
/*!40000 ALTER TABLE `system_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `system_group_program`
--

DROP TABLE IF EXISTS `system_group_program`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system_group_program` (
  `id` int(11) NOT NULL,
  `system_group_id` int(11) DEFAULT NULL,
  `system_program_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sys_group_program_program_idx` (`system_program_id`),
  KEY `sys_group_program_group_idx` (`system_group_id`),
  CONSTRAINT `system_group_program_ibfk_1` FOREIGN KEY (`system_group_id`) REFERENCES `system_group` (`id`),
  CONSTRAINT `system_group_program_ibfk_2` FOREIGN KEY (`system_program_id`) REFERENCES `system_program` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_group_program`
--

LOCK TABLES `system_group_program` WRITE;
/*!40000 ALTER TABLE `system_group_program` DISABLE KEYS */;
INSERT INTO `system_group_program` VALUES (1,1,1),(2,1,2),(3,1,3),(4,1,4),(5,1,5),(6,1,6),(7,1,8),(8,1,9),(9,1,11),(10,1,14),(11,1,15),(12,2,10),(13,2,12),(14,2,13),(15,2,16),(16,2,17),(17,2,18),(18,2,19),(19,2,20),(20,1,21),(21,2,22),(22,2,23),(23,2,24),(24,2,25),(25,1,26),(26,1,27),(27,1,28),(28,1,29),(29,2,30),(30,1,31),(31,1,32),(32,1,33),(33,1,34),(46,4,47),(47,4,48),(48,4,49),(49,4,50),(50,3,35),(51,3,36),(52,3,37),(53,3,38),(54,3,39),(55,3,40),(56,3,41),(57,3,42),(58,3,43),(59,3,44),(60,3,45),(61,3,46);
/*!40000 ALTER TABLE `system_group_program` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `system_preference`
--

DROP TABLE IF EXISTS `system_preference`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system_preference` (
  `id` text COLLATE utf8_unicode_ci,
  `preference` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_preference`
--

LOCK TABLES `system_preference` WRITE;
/*!40000 ALTER TABLE `system_preference` DISABLE KEYS */;
/*!40000 ALTER TABLE `system_preference` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `system_program`
--

DROP TABLE IF EXISTS `system_program`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system_program` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `controller` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_program`
--

LOCK TABLES `system_program` WRITE;
/*!40000 ALTER TABLE `system_program` DISABLE KEYS */;
INSERT INTO `system_program` VALUES (1,'System Group Form','SystemGroupForm'),(2,'System Group List','SystemGroupList'),(3,'System Program Form','SystemProgramForm'),(4,'System Program List','SystemProgramList'),(5,'System User Form','SystemUserForm'),(6,'System User List','SystemUserList'),(7,'Common Page','CommonPage'),(8,'System PHP Info','SystemPHPInfoView'),(9,'System ChangeLog View','SystemChangeLogView'),(10,'Welcome View','WelcomeView'),(11,'System Sql Log','SystemSqlLogList'),(12,'System Profile View','SystemProfileView'),(13,'System Profile Form','SystemProfileForm'),(14,'System SQL Panel','SystemSQLPanel'),(15,'System Access Log','SystemAccessLogList'),(16,'System Message Form','SystemMessageForm'),(17,'System Message List','SystemMessageList'),(18,'System Message Form View','SystemMessageFormView'),(19,'System Notification List','SystemNotificationList'),(20,'System Notification Form View','SystemNotificationFormView'),(21,'System Document Category List','SystemDocumentCategoryFormList'),(22,'System Document Form','SystemDocumentForm'),(23,'System Document Upload Form','SystemDocumentUploadForm'),(24,'System Document List','SystemDocumentList'),(25,'System Shared Document List','SystemSharedDocumentList'),(26,'System Unit Form','SystemUnitForm'),(27,'System Unit List','SystemUnitList'),(28,'System Access stats','SystemAccessLogStats'),(29,'System Preference form','SystemPreferenceForm'),(30,'System Support form','SystemSupportForm'),(31,'System PHP Error','SystemPHPErrorLogView'),(32,'System Database Browser','SystemDatabaseExplorer'),(33,'System Table List','SystemTableList'),(34,'System Data Browser','SystemDataBrowser'),(35,'Operadoras','OperadoraList'),(36,'Plano','PlanoList'),(37,'Tipo de plano','TipoPlanoList'),(38,'Tipos de Telefone','TiposTelefoneList'),(39,'Tipos de  Endereço','TiposEnderecoList'),(40,'Especialidades','EspecialidadeList'),(41,'Cadastro de plano','PlanoForm'),(42,'Cadastro de Tipos de  Telefone','TipoTelefoneForm'),(43,'Cadastro de Tipos de  Endereço','TipoEnderecoForm'),(44,'Cadastro de operadora','OperadoraForm'),(45,'Cadastro de tipo plano','TipoPlanoForm'),(46,'Cadastro de especialidade','EspecialidadeForm'),(47,'Médico','MedicosList'),(48,'Paciente','PacientesList'),(49,'Cadastro de Médico','MedicoForm'),(50,'Cadastro de paciente','PacientesForm');
/*!40000 ALTER TABLE `system_program` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `system_unit`
--

DROP TABLE IF EXISTS `system_unit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system_unit` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_unit`
--

LOCK TABLES `system_unit` WRITE;
/*!40000 ALTER TABLE `system_unit` DISABLE KEYS */;
/*!40000 ALTER TABLE `system_unit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `system_user_group`
--

DROP TABLE IF EXISTS `system_user_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system_user_group` (
  `id` int(11) NOT NULL,
  `system_user_id` int(11) DEFAULT NULL,
  `system_group_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sys_user_group_group_idx` (`system_group_id`),
  KEY `sys_user_group_user_idx` (`system_user_id`),
  CONSTRAINT `system_user_group_ibfk_1` FOREIGN KEY (`system_user_id`) REFERENCES `system_users` (`id`),
  CONSTRAINT `system_user_group_ibfk_2` FOREIGN KEY (`system_group_id`) REFERENCES `system_group` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_user_group`
--

LOCK TABLES `system_user_group` WRITE;
/*!40000 ALTER TABLE `system_user_group` DISABLE KEYS */;
INSERT INTO `system_user_group` VALUES (1,1,1),(2,2,2),(3,1,2),(4,1,3),(5,1,4);
/*!40000 ALTER TABLE `system_user_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `system_user_program`
--

DROP TABLE IF EXISTS `system_user_program`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system_user_program` (
  `id` int(11) NOT NULL,
  `system_user_id` int(11) DEFAULT NULL,
  `system_program_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sys_user_program_program_idx` (`system_program_id`),
  KEY `sys_user_program_user_idx` (`system_user_id`),
  CONSTRAINT `system_user_program_ibfk_1` FOREIGN KEY (`system_user_id`) REFERENCES `system_users` (`id`),
  CONSTRAINT `system_user_program_ibfk_2` FOREIGN KEY (`system_program_id`) REFERENCES `system_program` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_user_program`
--

LOCK TABLES `system_user_program` WRITE;
/*!40000 ALTER TABLE `system_user_program` DISABLE KEYS */;
INSERT INTO `system_user_program` VALUES (1,2,7);
/*!40000 ALTER TABLE `system_user_program` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `system_user_unit`
--

DROP TABLE IF EXISTS `system_user_unit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system_user_unit` (
  `id` int(11) NOT NULL,
  `system_user_id` int(11) DEFAULT NULL,
  `system_unit_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `system_user_id` (`system_user_id`),
  KEY `system_unit_id` (`system_unit_id`),
  CONSTRAINT `system_user_unit_ibfk_1` FOREIGN KEY (`system_user_id`) REFERENCES `system_users` (`id`),
  CONSTRAINT `system_user_unit_ibfk_2` FOREIGN KEY (`system_unit_id`) REFERENCES `system_unit` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_user_unit`
--

LOCK TABLES `system_user_unit` WRITE;
/*!40000 ALTER TABLE `system_user_unit` DISABLE KEYS */;
/*!40000 ALTER TABLE `system_user_unit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `system_users`
--

DROP TABLE IF EXISTS `system_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system_users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `login` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `frontpage_id` int(11) DEFAULT NULL,
  `system_unit_id` int(11) DEFAULT NULL,
  `active` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sys_user_program_idx` (`frontpage_id`),
  CONSTRAINT `system_users_ibfk_1` FOREIGN KEY (`frontpage_id`) REFERENCES `system_program` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_users`
--

LOCK TABLES `system_users` WRITE;
/*!40000 ALTER TABLE `system_users` DISABLE KEYS */;
INSERT INTO `system_users` VALUES (1,'Administrator','admin','21232f297a57a5a743894a0e4a801fc3','admin@admin.net',10,NULL,'Y'),(2,'User','user','ee11cbb19052e40b07aac0ca060c23ee','user@user.net',7,NULL,'Y');
/*!40000 ALTER TABLE `system_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-07-19 13:47:19
