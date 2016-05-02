-- MySQL dump 10.13  Distrib 5.5.47, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: projmanager
-- ------------------------------------------------------
-- Server version	5.5.47-0ubuntu0.14.04.1

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
-- Table structure for table `pm_customer`
--

DROP TABLE IF EXISTS `pm_customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pm_customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nickname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pm_customer`
--

LOCK TABLES `pm_customer` WRITE;
/*!40000 ALTER TABLE `pm_customer` DISABLE KEYS */;
INSERT INTO `pm_customer` VALUES (2,'Iago Oliveira','Iago','silva.io@outlook.com','000000','New York'),(4,'Drmjg','drmjg','drmjg@livecoding.tv','000000','FL');
/*!40000 ALTER TABLE `pm_customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pm_product`
--

DROP TABLE IF EXISTS `pm_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pm_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` double NOT NULL,
  `estimatedHours` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7ACFB1A4166D1F9C` (`project_id`),
  CONSTRAINT `FK_7ACFB1A4166D1F9C` FOREIGN KEY (`project_id`) REFERENCES `pm_project` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pm_product`
--

LOCK TABLES `pm_product` WRITE;
/*!40000 ALTER TABLE `pm_product` DISABLE KEYS */;
INSERT INTO `pm_product` VALUES (1,'Projects Module','System module for managing projects and products.',600,6,3),(2,'User Report','User report module, with user statistics.',100.24,2,3);
/*!40000 ALTER TABLE `pm_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pm_project`
--

DROP TABLE IF EXISTS `pm_project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pm_project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `shortDescription` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `startingDate` date NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_863665E79395C3F3` (`customer_id`),
  CONSTRAINT `FK_863665E79395C3F3` FOREIGN KEY (`customer_id`) REFERENCES `pm_customer` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pm_project`
--

LOCK TABLES `pm_project` WRITE;
/*!40000 ALTER TABLE `pm_project` DISABLE KEYS */;
INSERT INTO `pm_project` VALUES (3,'ProjectManager Github','My own project management system, open source.','2016-05-01',2);
/*!40000 ALTER TABLE `pm_project` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sio_role`
--

DROP TABLE IF EXISTS `sio_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sio_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sio_role`
--

LOCK TABLES `sio_role` WRITE;
/*!40000 ALTER TABLE `sio_role` DISABLE KEYS */;
INSERT INTO `sio_role` VALUES (1,'Administrador','ADMIN');
/*!40000 ALTER TABLE `sio_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sio_user`
--

DROP TABLE IF EXISTS `sio_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sio_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` char(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'A',
  `last_login` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_B6E5ACECF85E0677` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sio_user`
--

LOCK TABLES `sio_user` WRITE;
/*!40000 ALTER TABLE `sio_user` DISABLE KEYS */;
INSERT INTO `sio_user` VALUES (1,'admin',sha1('admin'),'A','2016-05-01 23:27:04');
/*!40000 ALTER TABLE `sio_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sio_user_roles`
--

DROP TABLE IF EXISTS `sio_user_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sio_user_roles` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `IDX_C825589DA76ED395` (`user_id`),
  KEY `IDX_C825589DD60322AC` (`role_id`),
  CONSTRAINT `FK_C825589DD60322AC` FOREIGN KEY (`role_id`) REFERENCES `sio_role` (`id`),
  CONSTRAINT `FK_C825589DA76ED395` FOREIGN KEY (`user_id`) REFERENCES `sio_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sio_user_roles`
--

LOCK TABLES `sio_user_roles` WRITE;
/*!40000 ALTER TABLE `sio_user_roles` DISABLE KEYS */;
INSERT INTO `sio_user_roles` VALUES (1,1);
/*!40000 ALTER TABLE `sio_user_roles` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-05-02  6:16:47
