-- MySQL dump 10.13  Distrib 8.0.13, for osx10.14 (x86_64)
--
-- Host: localhost    Database: smartadmin_db
-- ------------------------------------------------------
-- Server version	8.0.13

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8mb4 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `access_tokens`
--

DROP TABLE IF EXISTS `access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `access_tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `user_id` int(11) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_access_tokens_created_at` (`created_at`) USING BTREE,
  KEY `idx_access_tokens_updated_at` (`updated_at`) USING BTREE,
  KEY `idx_access_tokens_active` (`active`) USING BTREE,
  KEY `idx_access_tokens_token` (`token`) USING BTREE,
  KEY `FK_access_tokens_users` (`user_id`) USING BTREE,
  CONSTRAINT `FK_access_tokens_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `access_tokens`
--

LOCK TABLES `access_tokens` WRITE;
/*!40000 ALTER TABLE `access_tokens` DISABLE KEYS */;
INSERT INTO `access_tokens` VALUES (1,1,1,'6d108cfbe24dce39cc407a87aa0de9ce811c2e23','2019-07-03 12:54:30','2019-07-03 12:54:30');
/*!40000 ALTER TABLE `access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `api_requests`
--

DROP TABLE IF EXISTS `api_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `api_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `token_id` int(11) NOT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `latency` float DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `method` varchar(255) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `user_agent` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `body` longtext,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_api_requests_created_at` (`created_at`) USING BTREE,
  KEY `idx_api_requests_updated_at` (`updated_at`) USING BTREE,
  KEY `idx_api_requests_status` (`status`) USING BTREE,
  KEY `FK_api_requests_access_tokens` (`token_id`) USING BTREE,
  CONSTRAINT `FK_api_requests_access_tokens` FOREIGN KEY (`token_id`) REFERENCES `access_tokens` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `api_requests`
--

LOCK TABLES `api_requests` WRITE;
/*!40000 ALTER TABLE `api_requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `api_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `user_id` int(11) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `cookie_token` varchar(255) DEFAULT NULL,
  `platform` tinyint(4) DEFAULT '1' COMMENT 'web/api',
  `active_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_sessions_active` (`active`) USING BTREE,
  KEY `idx_sessions_cookie_token` (`cookie_token`) USING BTREE,
  KEY `idx_sessions_platform` (`platform`) USING BTREE,
  KEY `idx_sessions_token` (`token`) USING BTREE,
  KEY `FK_sessions_sessions_users` (`user_id`) USING BTREE,
  KEY `idx_sessions_created_at` (`created_at`) USING BTREE,
  KEY `idx_sessions_updated_at` (`updated_at`) USING BTREE,
  KEY `idx_active_at` (`active_at`) USING BTREE,
  CONSTRAINT `FK_sessions_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(128) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` mediumtext,
  `password_salt` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(128) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_users_active` (`active`) USING BTREE,
  KEY `idx_users_created-at` (`created_at`) USING BTREE,
  KEY `idx_users_email` (`email`) USING BTREE,
  KEY `idx_users_username` (`username`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,'lodev09@smartadminwebapp.com','3174562564','lodev09','$2y$10$7.RaXPrQDtt23o2St/0AguMuX.Fo8HtzjXIPxQgXI3W3bD1U66MTK','AkUASubedBLlmfyM','Codex','Lantern','2019-07-03 05:37:50','2019-07-04 21:25:12'),(2,1,'oliver.kopyov@smartadminwebapp.com','3134611347','oliver',NULL,NULL,'Oliver','Kopyov','2019-07-03 05:38:31','2019-07-03 05:44:33'),(3,1,'sesha.gray@smartadminwebapp.com','13137791347','sesha',NULL,NULL,'Sesha','Gray','2019-07-03 05:39:19','2019-07-03 05:44:42'),(4,1,'john.cook@smartadminwebapp.com','3137793314','john',NULL,NULL,'John','Cook','2019-07-03 05:39:57','2019-07-03 05:44:50'),(5,1,'jim.ketty@smartadminwebapp.com','3137798134','jim',NULL,NULL,'Jim','Ketty','2019-07-03 05:41:00','2019-07-03 05:44:57'),(6,1,'sarah.mcbrook@smartadminwebapp.com','3137797613','sarah',NULL,NULL,'Sarah','McBrook','2019-07-03 05:42:08','2019-07-03 05:45:04'),(7,1,'jimmy.fellan@smartadminwebapp.com','3137794314','jimmy',NULL,NULL,'Jimmy','Fellan','2019-07-03 05:42:39','2019-07-03 05:45:11'),(8,1,'arica.grace@smartadminwebapp.com','3137793347','arica',NULL,NULL,'Arica','Grace','2019-07-03 05:43:08','2019-07-03 05:45:23');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-07-05  8:00:50
