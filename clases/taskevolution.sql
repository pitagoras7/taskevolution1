CREATE DATABASE  IF NOT EXISTS `taskevolution` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `taskevolution`;
-- MySQL dump 10.13  Distrib 5.5.49, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: taskevolution
-- ------------------------------------------------------
-- Server version	5.5.49-0+deb8u1

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
-- Table structure for table `config`
--

DROP TABLE IF EXISTS `config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `config` (
  `cfgid` int(11) NOT NULL AUTO_INCREMENT,
  `cfgpad` int(11) DEFAULT NULL,
  `cfgden` varchar(140) DEFAULT NULL,
  `cfgext` varchar(140) DEFAULT NULL,
  `cfgnum` double DEFAULT '0',
  `cfgreg` datetime DEFAULT NULL,
  `cfguse` int(11) DEFAULT NULL,
  `cfgobs` text,
  `cfgest` char(1) DEFAULT 't',
  PRIMARY KEY (`cfgid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `config`
--

LOCK TABLES `config` WRITE;
/*!40000 ALTER TABLE `config` DISABLE KEYS */;
/*!40000 ALTER TABLE `config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log` (
  `logid` int(11) NOT NULL AUTO_INCREMENT,
  `logden` varchar(140) DEFAULT NULL,
  `logsql` text,
  `logreg` varchar(20) DEFAULT NULL,
  `logusu` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`logid`)
) ENGINE=InnoDB AUTO_INCREMENT=211 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log`
--

LOCK TABLES `log` WRITE;
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
INSERT INTO `log` VALUES (8,'inicio',NULL,'2016-10-23 11:38:15',NULL),(9,'inicio',NULL,'2016-10-23 11:40:18',NULL),(10,'inicio',NULL,'2016-10-23 11:41:43',NULL),(11,'inicio',NULL,'2016-10-23 11:42:12',NULL),(12,'inicio',NULL,'2016-10-23 11:42:36',NULL),(13,'inicio',NULL,'2016-10-23 11:43:26',NULL),(14,'inicio',NULL,'2016-10-23 11:43:32',NULL),(15,'inicio',NULL,'2016-10-23 11:43:59',NULL),(16,'inicio',NULL,'2016-10-23 11:45:35',NULL),(17,'inicio',NULL,'2016-10-23 11:45:46',NULL),(18,'inicio',NULL,'2016-10-23 11:46:25',NULL),(19,'inicio',NULL,'2016-10-23 11:46:50',NULL),(20,'inicio',NULL,'2016-10-23 11:47:26',NULL),(21,'inicio',NULL,'2016-10-23 11:49:55',NULL),(22,'inicio',NULL,'2016-10-23 12:14:32',NULL),(23,'inicio',NULL,'2016-10-23 12:15:43',''),(24,'inicio',NULL,'2016-10-23 12:16:03',''),(25,'inicioss',NULL,'2016-10-23 12:16:14',''),(26,'inicioss',NULL,'2016-10-23 12:26:18',''),(27,'inicioss',NULL,'2016-10-24 06:16:45',''),(28,'inicioss',NULL,'2016-10-24 19:24:06',''),(29,'inicioss',NULL,'2016-10-25 20:39:26',''),(30,'inicioss',NULL,'2016-10-26 17:15:07',''),(31,'inicioss',NULL,'2016-10-26 17:35:26',''),(32,'inicioss',NULL,'2016-10-26 18:55:43',''),(33,'inicioss',NULL,'2016-10-26 18:56:13',''),(34,'inicioss',NULL,'2016-10-26 18:56:35',''),(35,'inicioss',NULL,'2016-10-27 15:23:04',''),(36,'inicioss',NULL,'2016-11-14 23:22:49',''),(37,'inicioss',NULL,'2017-03-07 16:08:04',''),(38,'inicioss',NULL,'2017-03-09 10:46:26',''),(39,'inicioss',NULL,'2017-06-29 15:41:09',''),(40,'inicioss',NULL,'2017-06-29 16:53:27',''),(41,'inicioss',NULL,'2017-06-29 17:09:28',''),(42,'inicioss',NULL,'2017-06-29 17:15:33',''),(43,'inicioss',NULL,'2017-06-29 17:20:45',''),(44,'inicioss',NULL,'2017-06-29 17:21:08',''),(45,'inicioss',NULL,'2017-06-29 17:24:18',''),(46,'inicioss',NULL,'2017-06-29 17:36:44',''),(47,'inicioss',NULL,'2017-06-29 18:34:46',''),(48,'inicioss',NULL,'2017-06-29 18:35:31',''),(49,'inicioss',NULL,'2017-06-29 21:58:34',''),(50,'inicioss',NULL,'2017-06-30 01:24:05',''),(51,'inicioss',NULL,'2017-06-30 01:56:58',''),(52,'inicioss',NULL,'2017-06-30 01:57:11',''),(53,'inicioss',NULL,'2017-06-30 01:57:52',''),(54,'inicioss',NULL,'2017-06-30 02:01:28',''),(55,'inicioss',NULL,'2017-06-30 02:01:35',''),(56,'inicioss',NULL,'2017-06-30 02:01:40',''),(57,'inicioss',NULL,'2017-06-30 02:02:10',''),(58,'inicioss',NULL,'2017-06-30 02:02:31',''),(59,'inicioss',NULL,'2017-06-30 02:03:14',''),(60,'inicioss',NULL,'2017-06-30 02:04:00',''),(61,'inicioss',NULL,'2017-06-30 02:14:30',''),(62,'inicioss',NULL,'2017-06-30 02:18:53',''),(63,'inicioss',NULL,'2017-06-30 02:24:42',''),(64,'inicioss',NULL,'2017-06-30 02:30:57',''),(65,'inicioss',NULL,'2017-06-30 02:31:05',''),(66,'inicioss',NULL,'2017-06-30 02:31:57',''),(67,'inicioss',NULL,'2017-06-30 02:32:22',''),(68,'inicioss',NULL,'2017-06-30 02:32:42',''),(69,'inicioss',NULL,'2017-06-30 02:33:18',''),(70,'inicioss',NULL,'2017-06-30 02:33:55',''),(71,'inicioss',NULL,'2017-06-30 02:35:06',''),(72,'inicioss',NULL,'2017-06-30 02:36:00',''),(73,'inicioss',NULL,'2017-06-30 02:36:19',''),(74,'inicioss',NULL,'2017-06-30 02:36:29',''),(75,'inicioss',NULL,'2017-06-30 02:36:42',''),(76,'inicioss',NULL,'2017-06-30 02:37:11',''),(77,'inicioss',NULL,'2017-06-30 02:38:19',''),(78,'inicioss',NULL,'2017-06-30 02:38:33',''),(79,'inicioss',NULL,'2017-06-30 02:38:56',''),(80,'inicioss',NULL,'2017-06-30 02:39:00',''),(81,'inicioss',NULL,'2017-06-30 02:39:26',''),(82,'inicioss',NULL,'2017-06-30 02:39:47',''),(83,'inicioss',NULL,'2017-06-30 02:40:00',''),(84,'inicioss',NULL,'2017-06-30 02:40:11',''),(85,'inicioss',NULL,'2017-06-30 02:40:16',''),(86,'inicioss',NULL,'2017-06-30 02:40:34',''),(87,'inicioss',NULL,'2017-06-30 02:41:27',''),(88,'inicioss',NULL,'2017-06-30 02:41:40',''),(89,'inicioss',NULL,'2017-06-30 02:42:04',''),(90,'inicioss',NULL,'2017-06-30 02:49:04',''),(91,'inicioss',NULL,'2017-06-30 02:49:25',''),(92,'inicioss',NULL,'2017-06-30 02:50:25',''),(93,'inicioss',NULL,'2017-06-30 02:50:55',''),(94,'inicioss',NULL,'2017-06-30 02:51:28',''),(95,'inicioss',NULL,'2017-06-30 02:53:01',''),(96,'inicioss',NULL,'2017-06-30 02:53:58',''),(97,'inicioss',NULL,'2017-06-30 02:55:23',''),(98,'inicioss',NULL,'2017-06-30 02:55:43',''),(99,'inicioss',NULL,'2017-06-30 02:56:22',''),(100,'inicioss',NULL,'2017-06-30 02:56:31',''),(101,'inicioss',NULL,'2017-06-30 02:56:48',''),(102,'inicioss',NULL,'2017-06-30 02:57:28',''),(103,'inicioss',NULL,'2017-06-30 02:57:39',''),(104,'inicioss',NULL,'2017-06-30 02:57:53',''),(105,'inicioss',NULL,'2017-06-30 02:58:07',''),(106,'inicioss',NULL,'2017-06-30 02:58:24',''),(107,'inicioss',NULL,'2017-06-30 02:58:48',''),(108,'inicioss',NULL,'2017-06-30 02:59:27',''),(109,'inicioss',NULL,'2017-06-30 02:59:48',''),(110,'inicioss',NULL,'2017-06-30 03:00:04',''),(111,'inicioss',NULL,'2017-06-30 03:00:59',''),(112,'inicioss',NULL,'2017-06-30 03:07:05',''),(113,'inicioss',NULL,'2017-06-30 03:08:08',''),(114,'inicioss',NULL,'2017-06-30 03:08:35',''),(115,'inicioss',NULL,'2017-06-30 03:09:18',''),(116,'inicioss',NULL,'2017-06-30 03:09:54',''),(117,'inicioss',NULL,'2017-06-30 03:10:25',''),(118,'inicioss',NULL,'2017-06-30 03:10:45',''),(119,'inicioss',NULL,'2017-06-30 03:12:03',''),(120,'inicioss',NULL,'2017-06-30 03:12:07',''),(121,'inicioss',NULL,'2017-06-30 03:14:04',''),(122,'inicioss',NULL,'2017-06-30 03:15:09',''),(123,'inicioss',NULL,'2017-06-30 03:16:10',''),(124,'inicioss',NULL,'2017-06-30 04:53:46','1'),(125,'inicioss',NULL,'2017-06-30 04:54:32','1'),(126,'inicioss',NULL,'2017-06-30 06:17:03',''),(127,'inicioss',NULL,'2017-06-30 06:17:48',''),(128,'inicioss',NULL,'2017-06-30 06:18:00',''),(129,'inicioss',NULL,'2017-06-30 06:19:57','1'),(130,'inicioss',NULL,'2017-06-30 06:20:24','3'),(131,'inicioss',NULL,'2017-06-30 06:21:25','3'),(132,'inicioss',NULL,'2017-06-30 06:22:32','3'),(133,'inicioss',NULL,'2017-06-30 06:23:29','3'),(134,'inicioss',NULL,'2017-06-30 06:25:10','3'),(135,'inicioss',NULL,'2017-06-30 06:25:31','3'),(136,'inicioss',NULL,'2017-06-30 06:25:53','3'),(137,'inicioss',NULL,'2017-06-30 06:26:41','3'),(138,'inicioss',NULL,'2017-06-30 06:26:57','3'),(139,'inicioss',NULL,'2017-06-30 06:27:14','3'),(140,'inicioss',NULL,'2017-06-30 06:27:48','3'),(141,'inicioss',NULL,'2017-06-30 06:28:12','3'),(142,'inicioss',NULL,'2017-06-30 06:29:08','3'),(143,'inicioss',NULL,'2017-06-30 06:30:54','3'),(144,'inicioss',NULL,'2017-06-30 06:31:44','3'),(145,'inicioss',NULL,'2017-06-30 06:32:23','3'),(146,'inicioss',NULL,'2017-06-30 06:33:48','3'),(147,'inicioss',NULL,'2017-06-30 06:34:08','3'),(148,'inicioss',NULL,'2017-06-30 06:34:39','3'),(149,'inicioss',NULL,'2017-06-30 06:35:19','3'),(150,'inicioss',NULL,'2017-06-30 06:41:13','28'),(151,'inicioss',NULL,'2017-06-30 06:42:05','29'),(152,'inicioss',NULL,'2017-06-30 06:44:38','29'),(153,'inicioss',NULL,'2017-06-30 06:47:20','30'),(154,'inicioss',NULL,'2017-06-30 06:48:20','30'),(155,'inicioss',NULL,'2017-06-30 06:48:45','30'),(156,'inicioss',NULL,'2017-06-30 06:49:19','30'),(157,'inicioss',NULL,'2017-06-30 09:18:04','31'),(158,'inicioss',NULL,'2017-06-30 09:19:39','31'),(159,'inicioss',NULL,'2017-06-30 09:20:56','31'),(160,'inicioss',NULL,'2017-06-30 09:24:38','31'),(161,'inicioss',NULL,'2017-06-30 09:28:24','31'),(162,'inicioss',NULL,'2017-06-30 09:30:06','31'),(163,'inicioss',NULL,'2017-06-30 09:31:07','31'),(164,'inicioss',NULL,'2017-06-30 09:31:12','31'),(165,'inicioss',NULL,'2017-06-30 09:31:12','31'),(166,'inicioss',NULL,'2017-06-30 09:31:46','31'),(167,'inicioss',NULL,'2017-06-30 09:32:10','31'),(168,'inicioss',NULL,'2017-06-30 09:32:27','31'),(169,'inicioss',NULL,'2017-06-30 09:32:50','31'),(170,'inicioss',NULL,'2017-06-30 09:33:20','31'),(171,'inicioss',NULL,'2017-06-30 09:33:24','31'),(172,'inicioss',NULL,'2017-06-30 09:33:40','31'),(173,'inicioss',NULL,'2017-06-30 09:33:40','31'),(174,'inicioss',NULL,'2017-06-30 09:34:05','31'),(175,'inicioss',NULL,'2017-06-30 09:34:38','31'),(176,'inicioss',NULL,'2017-06-30 09:35:04','31'),(177,'inicioss',NULL,'2017-06-30 09:35:18','31'),(178,'inicioss',NULL,'2017-06-30 09:35:31','31'),(179,'inicioss',NULL,'2017-06-30 09:35:43','31'),(180,'inicioss',NULL,'2017-06-30 09:37:06','31'),(181,'inicioss',NULL,'2017-06-30 09:49:17','31'),(182,'inicioss',NULL,'2017-06-30 09:50:41','31'),(183,'inicioss',NULL,'2017-06-30 09:51:06','31'),(184,'inicioss',NULL,'2017-06-30 09:51:22','31'),(185,'inicioss',NULL,'2017-06-30 09:51:32','31'),(186,'inicioss',NULL,'2017-06-30 09:51:58','31'),(187,'inicioss',NULL,'2017-06-30 09:52:06','31'),(188,'inicioss',NULL,'2017-06-30 09:52:16','31'),(189,'inicioss',NULL,'2017-06-30 09:52:39','31'),(190,'inicioss',NULL,'2017-06-30 09:52:52','31'),(191,'inicioss',NULL,'2017-06-30 09:53:01','31'),(192,'inicioss',NULL,'2017-06-30 09:53:22','31'),(193,'inicioss',NULL,'2017-06-30 09:54:45','31'),(194,'inicioss',NULL,'2017-06-30 09:58:23','31'),(195,'inicioss',NULL,'2017-06-30 09:59:13','31'),(196,'inicioss',NULL,'2017-06-30 09:59:43','31'),(197,'inicioss',NULL,'2017-06-30 10:00:10','31'),(198,'inicioss',NULL,'2017-06-30 10:00:55','31'),(199,'inicioss',NULL,'2017-06-30 10:04:43','31'),(200,'inicioss',NULL,'2017-06-30 10:04:51','31'),(201,'inicioss',NULL,'2017-06-30 10:05:11','31'),(202,'inicioss',NULL,'2017-06-30 10:05:35','31'),(203,'inicioss',NULL,'2017-06-30 10:05:54','31'),(204,'inicioss',NULL,'2017-06-30 10:06:09','31'),(205,'inicioss',NULL,'2017-06-30 10:06:47','31'),(206,'inicioss',NULL,'2017-06-30 10:07:01','31'),(207,'inicioss',NULL,'2017-06-30 10:07:18','31'),(208,'inicioss',NULL,'2017-06-30 10:07:26','31'),(209,'inicioss',NULL,'2017-06-30 10:09:12','31'),(210,'inicioss',NULL,'2017-06-30 10:10:36','31');
/*!40000 ALTER TABLE `log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task`
--

DROP TABLE IF EXISTS `task`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `task` (
  `tskid` int(11) NOT NULL AUTO_INCREMENT,
  `tskden` text,
  `tskest` varchar(1) DEFAULT 't',
  `tskven` varchar(20) DEFAULT NULL,
  `tskpri` varchar(20) DEFAULT NULL,
  `tskusu` int(11) DEFAULT NULL,
  `tskreg` varchar(20) DEFAULT 'NOW()',
  `tskedo` varchar(10) DEFAULT 'WAITING',
  PRIMARY KEY (`tskid`),
  KEY `fk_task_1_idx` (`tskusu`),
  CONSTRAINT `fk_task_1` FOREIGN KEY (`tskusu`) REFERENCES `user` (`usuid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task`
--

LOCK TABLES `task` WRITE;
/*!40000 ALTER TABLE `task` DISABLE KEYS */;
INSERT INTO `task` VALUES (0,'0','t','','',0,'','');
/*!40000 ALTER TABLE `task` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `usuid` int(11) NOT NULL AUTO_INCREMENT,
  `usunom` varchar(45) DEFAULT NULL,
  `usuced` int(11) DEFAULT NULL,
  `usucar` varchar(45) DEFAULT NULL,
  `usugen` varchar(3) DEFAULT NULL,
  `usucor` varchar(100) DEFAULT NULL,
  `usulog` varchar(45) DEFAULT NULL,
  `usupas` varchar(45) DEFAULT NULL,
  `usureg` datetime DEFAULT NULL,
  `usuest` char(1) DEFAULT NULL,
  `usuusuid` int(11) DEFAULT NULL,
  `usugruid` int(11) DEFAULT NULL,
  `usudir` text,
  `usuing` varchar(45) NOT NULL,
  `usuimg` varchar(140) DEFAULT NULL,
  PRIMARY KEY (`usuid`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (0,'Template',0,'','','','','','0000-00-00 00:00:00','t',0,0,'','',''),(31,'developer.projas@gmail.com',0,'UserCar','M','developer.projas@gmail.com','developer.projas@gmail.com','7747fe52cab585b37223380fb3dd4d94','2017-06-30 00:00:00','t',0,0,'','','');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-06-30 10:52:46
