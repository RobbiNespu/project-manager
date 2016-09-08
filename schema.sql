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
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_F84CB318A76ED395` (`user_id`),
  CONSTRAINT `FK_F84CB318A76ED395` FOREIGN KEY (`user_id`) REFERENCES `sio_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pm_customer`
--

LOCK TABLES `pm_customer` WRITE;
/*!40000 ALTER TABLE `pm_customer` DISABLE KEYS */;
INSERT INTO `pm_customer` VALUES (2,'Iago Oliveira','Iago','silva.io@outlook.com','000000','New York',NULL);
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
  `paid` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7ACFB1A4166D1F9C` (`project_id`),
  CONSTRAINT `FK_7ACFB1A4166D1F9C` FOREIGN KEY (`project_id`) REFERENCES `pm_project` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pm_product`
--

LOCK TABLES `pm_product` WRITE;
/*!40000 ALTER TABLE `pm_product` DISABLE KEYS */;
INSERT INTO `pm_product` VALUES (8,'Users Module','User management module',0,1,8,1),(9,'Customers Module','Customers module',0,1,8,1),(10,'Projects Module','Projects module with projects and products.',0,2,8,1),(11,'Reports Module','Module with graphs and other reports',0,3,8,0),(12,'Documentation','Project documentation.',0,1,8,1),(13,'Documentation','Project documentation.',0,1,8,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pm_project`
--

LOCK TABLES `pm_project` WRITE;
/*!40000 ALTER TABLE `pm_project` DISABLE KEYS */;
INSERT INTO `pm_project` VALUES (8,'Project Manager','Open Source project management system.','2016-05-02',2);
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sio_role`
--

LOCK TABLES `sio_role` WRITE;
/*!40000 ALTER TABLE `sio_role` DISABLE KEYS */;
INSERT INTO `sio_role` VALUES (1,'Administrador','ADMIN'),(2,'Customer','CUSTOMER');
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sio_user`
--

LOCK TABLES `sio_user` WRITE;
/*!40000 ALTER TABLE `sio_user` DISABLE KEYS */;
INSERT INTO `sio_user` VALUES (1,'iago','08b3ee9e6b18a12a2e38b65d7c8561c9337dccee','A','2016-05-03 15:33:02'),(2,'test','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','X','2016-05-01 23:26:53'),(3,'admin','d033e22ae348aeb5660fc2140aec35850c4da997','A','2016-05-03 17:26:16');
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
  CONSTRAINT `FK_C825589DD60322AC` FOREIGN KEY (`role_id`) REFERENCES `sio_role` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_C825589DA76ED395` FOREIGN KEY (`user_id`) REFERENCES `sio_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sio_user_roles`
--

LOCK TABLES `sio_user_roles` WRITE;
/*!40000 ALTER TABLE `sio_user_roles` DISABLE KEYS */;
INSERT INTO `sio_user_roles` VALUES (1,1),(3,1);
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

-- Dump completed on 2016-05-03 21:35:25
