CREATE DATABASE  IF NOT EXISTS `consultorio` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `consultorio`;
-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: localhost    Database: consultorio
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
-- Table structure for table `agendamento`
--

DROP TABLE IF EXISTS `agendamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `agendamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `horario_inicial` datetime NOT NULL,
  `horario_final` datetime NOT NULL,
  `titulo` text COLLATE utf8_unicode_ci,
  `cor` text COLLATE utf8_unicode_ci,
  `observacao` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agendamento`
--

LOCK TABLES `agendamento` WRITE;
/*!40000 ALTER TABLE `agendamento` DISABLE KEYS */;
/*!40000 ALTER TABLE `agendamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contato`
--

DROP TABLE IF EXISTS `contato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contato` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `telefone` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nome_contato` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipo_contato_id` int(11) DEFAULT NULL,
  `paciente_id` int(11) DEFAULT NULL,
  `medico_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_contato_1` (`tipo_contato_id`),
  KEY `fk_contato_2` (`paciente_id`),
  KEY `fk_contato_3` (`medico_id`),
  CONSTRAINT `fk_contato_1` FOREIGN KEY (`tipo_contato_id`) REFERENCES `tipos_contato` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_contato_2` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_contato_3` FOREIGN KEY (`medico_id`) REFERENCES `medicos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contato`
--

LOCK TABLES `contato` WRITE;
/*!40000 ALTER TABLE `contato` DISABLE KEYS */;
INSERT INTO `contato` VALUES (1,'(21)99437-4001','jose.expeditor@gmail.com','O Próprio',3,NULL,1),(2,'(21)98740-4766','simone.moraes77@gmail.com','Simone Louzada Moraes Paim Santos',3,1,NULL),(3,'(21)98740-4766','simone.moraes77@gmail.com','Simone - Mãe',5,2,NULL);
/*!40000 ALTER TABLE `contato` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `convenios`
--

DROP TABLE IF EXISTS `convenios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `convenios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paciente_id` int(11) DEFAULT NULL,
  `operadora_id` int(11) NOT NULL,
  `matricula` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `plano_id` int(11) NOT NULL,
  `tipo_plano_id` int(11) NOT NULL,
  `validade` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `via_cartao` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_convenios_1` (`operadora_id`),
  KEY `fk_convenios_2` (`plano_id`),
  KEY `fk_convenios_3` (`tipo_plano_id`),
  KEY `fk_convenios_4` (`paciente_id`),
  CONSTRAINT `fk_convenios_1` FOREIGN KEY (`operadora_id`) REFERENCES `operadora` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_convenios_2` FOREIGN KEY (`plano_id`) REFERENCES `plano` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_convenios_3` FOREIGN KEY (`tipo_plano_id`) REFERENCES `tipo_plano` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_convenios_4` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `convenios`
--

LOCK TABLES `convenios` WRITE;
/*!40000 ALTER TABLE `convenios` DISABLE KEYS */;
INSERT INTO `convenios` VALUES (1,1,1,'00370000055767',2,1,'2018-10-30',1),(2,2,1,'00370000055778',2,1,'2018-10-31',1);
/*!40000 ALTER TABLE `convenios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enderecos`
--

DROP TABLE IF EXISTS `enderecos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `enderecos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cep` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `logradouro` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numero` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `complemento` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bairro` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cidade` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipo_endereco_id` int(11) DEFAULT NULL,
  `paciente_id` int(11) DEFAULT NULL,
  `medico_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_enderecos_1` (`tipo_endereco_id`),
  KEY `fk_enderecos_2` (`paciente_id`),
  KEY `fk_enderecos_3` (`medico_id`),
  CONSTRAINT `fk_enderecos_1` FOREIGN KEY (`tipo_endereco_id`) REFERENCES `tipos_enderecos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_enderecos_2` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_enderecos_3` FOREIGN KEY (`medico_id`) REFERENCES `medicos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enderecos`
--

LOCK TABLES `enderecos` WRITE;
/*!40000 ALTER TABLE `enderecos` DISABLE KEYS */;
INSERT INTO `enderecos` VALUES (1,'20021120','Avenida Franklin Roosevelt','126','Sala 911','Centro','Rio de Janeiro','RJ',2,NULL,1),(2,'25561162','Avenida Comendador Teles','1758','Lote 03 Quadra 06','Vilar dos Teles','São João de Meriti','RJ',1,1,NULL),(3,'25561162','Avenida Comendador Teles','Av Comendador Teles, 1758 L.03 Q.06','Lote 03 Quadra 06','Vilar dos Teles','São João de Meriti','RJ',1,2,NULL);
/*!40000 ALTER TABLE `enderecos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `especialidades`
--

DROP TABLE IF EXISTS `especialidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `especialidades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `especialidade` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `especialidades`
--

LOCK TABLES `especialidades` WRITE;
/*!40000 ALTER TABLE `especialidades` DISABLE KEYS */;
INSERT INTO `especialidades` VALUES (1,'Angiologista'),(2,'Alergista'),(3,'Cardiologia'),(4,'Ginecologia'),(5,'Ginecologia e obstetricia'),(6,'Otorinolaringologia'),(7,'Pediatra'),(8,'Clínica Médica');
/*!40000 ALTER TABLE `especialidades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medico_especialidades`
--

DROP TABLE IF EXISTS `medico_especialidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medico_especialidades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `especialidade_id` int(11) DEFAULT NULL,
  `medico_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_medico_especialidades_1` (`especialidade_id`),
  KEY `fk_medico_especialidades_2` (`medico_id`),
  CONSTRAINT `fk_medico_especialidades_1` FOREIGN KEY (`especialidade_id`) REFERENCES `especialidades` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_medico_especialidades_2` FOREIGN KEY (`medico_id`) REFERENCES `medicos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medico_especialidades`
--

LOCK TABLES `medico_especialidades` WRITE;
/*!40000 ALTER TABLE `medico_especialidades` DISABLE KEYS */;
INSERT INTO `medico_especialidades` VALUES (1,6,1);
/*!40000 ALTER TABLE `medico_especialidades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medicos`
--

DROP TABLE IF EXISTS `medicos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medicos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cpf` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `crm` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medicos`
--

LOCK TABLES `medicos` WRITE;
/*!40000 ALTER TABLE `medicos` DISABLE KEYS */;
INSERT INTO `medicos` VALUES (1,'José Expedito Rodrigues','022.506.247-04','52440898');
/*!40000 ALTER TABLE `medicos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `operadora`
--

DROP TABLE IF EXISTS `operadora`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `operadora` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `operadora`
--

LOCK TABLES `operadora` WRITE;
/*!40000 ALTER TABLE `operadora` DISABLE KEYS */;
INSERT INTO `operadora` VALUES (1,'Unimed Rio'),(2,'Petrobrás'),(3,'Amil Saúde');
/*!40000 ALTER TABLE `operadora` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pacientes`
--

DROP TABLE IF EXISTS `pacientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pacientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `idade` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dt_nasc` date DEFAULT NULL,
  `sexo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cpf` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado_civil` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rg` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `orgao_emissor` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nome_mae` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nome_pai` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dt_cadastro` date DEFAULT NULL,
  `dt_ult_atendimento` date DEFAULT NULL,
  `profissao` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `conjugue` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `empresa` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `responsavel` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `observacao` text COLLATE utf8_unicode_ci,
  `tipo_atendimento_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pacientes_1_idx` (`tipo_atendimento_id`),
  CONSTRAINT `fk_pacientes_1` FOREIGN KEY (`tipo_atendimento_id`) REFERENCES `tipo_atendimento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pacientes`
--

LOCK TABLES `pacientes` WRITE;
/*!40000 ALTER TABLE `pacientes` DISABLE KEYS */;
INSERT INTO `pacientes` VALUES (1,'Simone Louzada Moraes Paim Santos','44','1974-07-05','2','047.010.557-78','2','09.291.135-3','Detran','Lindinalva Louzada Moraes','Joel Almeida Moraes','2018-07-19',NULL,'Analista de Sistemas','Rui Anderson Paim Santos','SMP Technology',NULL,NULL,2),(2,'Vitor Moraes Eugenio','12','2005-11-10','1','070.441.777-43','1','9.999.999-99','Detran','Simone Louzada Moraes Paim Santos',NULL,'2018-07-19',NULL,'Estudante',NULL,NULL,'Simone Louzada Moraes',NULL,2);
/*!40000 ALTER TABLE `pacientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plano`
--

DROP TABLE IF EXISTS `plano`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plano` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plano`
--

LOCK TABLES `plano` WRITE;
/*!40000 ALTER TABLE `plano` DISABLE KEYS */;
INSERT INTO `plano` VALUES (1,'Individual'),(2,'Familiar'),(3,'Empresarial');
/*!40000 ALTER TABLE `plano` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_atendimento`
--

DROP TABLE IF EXISTS `tipo_atendimento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_atendimento` (
  `id` int(11) NOT NULL,
  `descricao` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_atendimento`
--

LOCK TABLES `tipo_atendimento` WRITE;
/*!40000 ALTER TABLE `tipo_atendimento` DISABLE KEYS */;
INSERT INTO `tipo_atendimento` VALUES (1,'Particular'),(2,'Convênio');
/*!40000 ALTER TABLE `tipo_atendimento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_plano`
--

DROP TABLE IF EXISTS `tipo_plano`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_plano` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_plano`
--

LOCK TABLES `tipo_plano` WRITE;
/*!40000 ALTER TABLE `tipo_plano` DISABLE KEYS */;
INSERT INTO `tipo_plano` VALUES (1,'Unimed Básico'),(2,'Unimed Personal'),(3,'Amil Básico'),(4,'Petrobrás Nacional');
/*!40000 ALTER TABLE `tipo_plano` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipos_contato`
--

DROP TABLE IF EXISTS `tipos_contato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipos_contato` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipos_contato`
--

LOCK TABLES `tipos_contato` WRITE;
/*!40000 ALTER TABLE `tipos_contato` DISABLE KEYS */;
INSERT INTO `tipos_contato` VALUES (1,'Residencial'),(2,'Comercial'),(3,'Celular'),(4,'Trabalho'),(5,'Recado'),(6,'Outros');
/*!40000 ALTER TABLE `tipos_contato` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipos_enderecos`
--

DROP TABLE IF EXISTS `tipos_enderecos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipos_enderecos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipos_enderecos`
--

LOCK TABLES `tipos_enderecos` WRITE;
/*!40000 ALTER TABLE `tipos_enderecos` DISABLE KEYS */;
INSERT INTO `tipos_enderecos` VALUES (1,'Residencial'),(2,'Comercial'),(3,'Trabalho'),(4,'Outros');
/*!40000 ALTER TABLE `tipos_enderecos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-07-19 13:43:57
