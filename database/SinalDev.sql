-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: talenthub
-- ------------------------------------------------------
-- Server version	8.4.3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `administradores`
--

DROP TABLE IF EXISTS `administradores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `administradores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `criado_em` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administradores`
--

LOCK TABLES `administradores` WRITE;
/*!40000 ALTER TABLE `administradores` DISABLE KEYS */;
INSERT INTO `administradores` VALUES (1,'Suporte SinalDev','suporte@sinaldev.com','$2y$10$DhKrRtCGxVbKj8wCYO4Ol.h7NrzTB9te.JStVAqJO.GRU1QDr2BpO','2026-09-23 00:18:22');
/*!40000 ALTER TABLE `administradores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `candidatos`
--

DROP TABLE IF EXISTS `candidatos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `candidatos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `pais` varchar(100) NOT NULL DEFAULT 'Brasil',
  `estado` char(2) DEFAULT NULL,
  `cidade` varchar(150) DEFAULT NULL,
  `disponibilidade_id` int DEFAULT NULL,
  `criado_em` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `disponibilidade_id` (`disponibilidade_id`),
  CONSTRAINT `candidatos_ibfk_1` FOREIGN KEY (`disponibilidade_id`) REFERENCES `disponibilidades` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `candidatos`
--

LOCK TABLES `candidatos` WRITE;
/*!40000 ALTER TABLE `candidatos` DISABLE KEYS */;
INSERT INTO `candidatos` VALUES (2,'teste 01','teste01@candidato.com','$2y$10$J.hCfCqYtfk6PAiKFyLawuycq3jE1fXzPV9nhVGs6GP75w7sMItSK','49991919191','2001-01-01','Brasil','SC','teste 01',3,'2026-09-22 22:40:38'),(3,'teste 02','teste02@candidato2.com','$2y$10$gS0Sa/6IfWRG2ilAp0GJpuyBN..wg3rdU.8jiwo1NM6oJuDvdWMY.','49992929292','2002-02-02','Brasil','SP','teste 02',3,'2026-09-23 00:44:32');
/*!40000 ALTER TABLE `candidatos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `candidaturas`
--

DROP TABLE IF EXISTS `candidaturas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `candidaturas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `candidato_id` int NOT NULL,
  `vaga_id` int NOT NULL,
  `status_candidatura_id` int NOT NULL DEFAULT '1',
  `criado_em` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `candidato_vaga_unique` (`candidato_id`,`vaga_id`),
  KEY `vaga_id` (`vaga_id`),
  KEY `status_candidatura_id` (`status_candidatura_id`),
  CONSTRAINT `candidaturas_ibfk_1` FOREIGN KEY (`candidato_id`) REFERENCES `candidatos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `candidaturas_ibfk_2` FOREIGN KEY (`vaga_id`) REFERENCES `vagas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `candidaturas_ibfk_3` FOREIGN KEY (`status_candidatura_id`) REFERENCES `status_candidatura` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `candidaturas`
--

LOCK TABLES `candidaturas` WRITE;
/*!40000 ALTER TABLE `candidaturas` DISABLE KEYS */;
INSERT INTO `candidaturas` VALUES (1,2,2,4,'2026-09-22 23:10:13'),(2,2,1,1,'2026-09-22 23:10:21'),(10,2,3,2,'2026-09-23 00:42:28'),(11,2,4,2,'2026-09-23 00:42:34'),(12,2,5,4,'2026-09-23 00:42:35'),(13,3,6,1,'2026-09-23 00:44:47');
/*!40000 ALTER TABLE `candidaturas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `disponibilidades`
--

DROP TABLE IF EXISTS `disponibilidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `disponibilidades` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `disponibilidades`
--

LOCK TABLES `disponibilidades` WRITE;
/*!40000 ALTER TABLE `disponibilidades` DISABLE KEYS */;
INSERT INTO `disponibilidades` VALUES (1,'Presencial'),(2,'Remoto'),(3,'Híbrido');
/*!40000 ALTER TABLE `disponibilidades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empresas`
--

DROP TABLE IF EXISTS `empresas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `empresas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome_fantasia` varchar(150) NOT NULL,
  `cnpj` varchar(20) DEFAULT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `site` varchar(150) DEFAULT NULL,
  `criado_em` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `cnpj` (`cnpj`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresas`
--

LOCK TABLES `empresas` WRITE;
/*!40000 ALTER TABLE `empresas` DISABLE KEYS */;
INSERT INTO `empresas` VALUES (2,'teste1','0000000001','teste1@teste1.com','teste1','teste1.com','2026-09-14 23:28:11'),(3,'teste 01','01010101000101','teste01@empresa.com','$2y$10$KgkeVy7Q0lHbHkLzrR9ECecEdxMiMhllN/cysGWIZ8mXLqIWbMkvi','empresateste01.com','2026-09-22 22:41:21'),(4,'teste 02','02002002000102','teste02@empresa.com','$2y$10$JsrmQdu.hi16nPzuBSx.juJYO2/HvYw2EYXy4LaHYIccuwze1NQfm','empresateste02.com','2026-09-23 00:37:41');
/*!40000 ALTER TABLE `empresas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status_candidatura`
--

DROP TABLE IF EXISTS `status_candidatura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `status_candidatura` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status_candidatura`
--

LOCK TABLES `status_candidatura` WRITE;
/*!40000 ALTER TABLE `status_candidatura` DISABLE KEYS */;
INSERT INTO `status_candidatura` VALUES (1,'Pendente'),(2,'Em análise'),(3,'Aprovado'),(4,'Recusado');
/*!40000 ALTER TABLE `status_candidatura` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vagas`
--

DROP TABLE IF EXISTS `vagas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vagas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `empresa_id` int NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `descricao` text,
  `disponibilidade_id` int DEFAULT NULL,
  `estado` char(2) DEFAULT NULL,
  `cidade` varchar(150) DEFAULT NULL,
  `ativa` tinyint(1) NOT NULL DEFAULT '1',
  `criado_em` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `empresa_id` (`empresa_id`),
  KEY `disponibilidade_id` (`disponibilidade_id`),
  CONSTRAINT `vagas_ibfk_1` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `vagas_ibfk_2` FOREIGN KEY (`disponibilidade_id`) REFERENCES `disponibilidades` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vagas`
--

LOCK TABLES `vagas` WRITE;
/*!40000 ALTER TABLE `vagas` DISABLE KEYS */;
INSERT INTO `vagas` VALUES (1,2,'teste1','teste1',2,'SC','teste1',1,'2026-09-14 23:28:51'),(2,3,'teste 01 22/09','teste de cadastro de vaga/oportunidade 01 - 22/09',3,'SC','SMO',1,'2026-09-22 22:55:37'),(3,3,'teste 02 - não se candidatar','teste de situação da vaga para o candidato',1,'SC','teste 02',1,'2026-09-23 00:16:27'),(4,3,'teste 03','teste 03',2,'PR','CURITIBA',1,'2026-09-23 00:37:03'),(5,4,'teste 01','teste 01 empresa 02',2,'SP','SÃO PAULO',1,'2026-09-23 00:38:22'),(6,4,'teste 02 - não se candidatar','TESTE 02 EMPRESA 02',1,'RS','CANOAS',1,'2026-09-23 00:38:45');
/*!40000 ALTER TABLE `vagas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'talenthub'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-09-22 21:59:19
