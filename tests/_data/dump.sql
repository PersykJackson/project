-- MySQL dump 10.13  Distrib 8.0.23, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: zagidullin_db
-- ------------------------------------------------------
-- Server version	8.0.23

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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(42) NOT NULL,
  `img` varchar(100) NOT NULL,
  `path` varchar(42) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `name`, `img`, `path`, `created_at`, `updated_at`) VALUES (4,'Мягкие игрушки','/images/categories/p_joy.jpg','/products/category?id=4','2021-02-12 09:31:43','2021-02-12 12:48:01'),(5,'Куклы','/images/categories/dolls.jpg','/products/category?id=5','2021-02-12 09:33:05','2021-02-12 12:48:37'),(6,'Машинки','/images/categories/cars.jpg','/products/category?id=6','2021-02-12 09:33:05','2021-02-12 12:48:59'),(7,'Настольные игры','/images/categories/board_games.jpeg','/products/category?id=7','2021-02-12 09:33:06','2021-02-12 12:52:56'),(8,'Наборы','/images/categories/game_packs.webp','/products/category?id=8','2021-02-12 09:33:06','2021-02-12 12:49:52'),(9,'Конструкторы','/images/categories/constr_joy.jpg','/products/category?id=9','2021-02-12 09:34:31','2021-02-12 12:50:15');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `address` text NOT NULL,
  `phone` varchar(15) NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `comment` text,
  PRIMARY KEY (`id`),
  KEY `orders_users_id_fk` (`user_id`),
  CONSTRAINT `orders_users_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` (`id`, `user_id`, `address`, `phone`, `date`, `created_at`, `updated_at`, `comment`) VALUES (23,NULL,'dasdasdsa','0990668424','2021-02-27','2021-02-19 11:21:02','2021-02-19 11:21:02','dasdsadsad'),(24,9,'dasdasdsa','0990668424','2021-02-20','2021-02-19 12:14:11','2021-02-19 12:14:11','dasdsd'),(25,9,'dasdasdsa','0990668424','2021-02-25','2021-02-20 21:39:48','2021-02-20 21:39:48','dddddd'),(26,9,'dasdasdsa','0990668424','2021-02-26','2021-02-20 21:45:34','2021-02-20 21:45:34','ddassss'),(27,9,'dasdasdsa','0990668424','2021-02-04','2021-02-20 22:06:04','2021-02-20 22:06:04','test'),(28,9,'dasdasdsa','0990668424','2021-02-01','2021-02-21 11:57:30','2021-02-21 11:57:30','123'),(29,9,'dasdasdsa','0990668421','2021-02-18','2021-02-21 14:12:04','2021-02-21 14:12:04','23232'),(30,9,'dasdasdsa','0990668424','2021-02-23','2021-02-21 14:45:02','2021-02-21 14:45:02','test'),(31,9,'dasdasdsa','0990668424','2021-02-24','2021-02-21 14:46:06','2021-02-21 14:46:06','tesst'),(32,9,'dasdasdsa','0990668424','2021-03-18','2021-03-05 21:52:27','2021-03-05 21:52:27','ddddddddddddddddddaaaaaaaaaaaaaaaaaaaaa'),(33,9,'dasdasdsa','0990668421','2021-03-25','2021-03-10 09:45:16','2021-03-10 09:45:16',''),(34,9,'','','2021-03-10','2021-03-10 09:56:11','2021-03-10 09:56:11',''),(35,9,'','','2021-03-10','2021-03-10 09:58:15','2021-03-10 09:58:15',''),(36,9,'','','2021-03-10','2021-03-10 10:00:25','2021-03-10 10:00:25',''),(37,9,'','','2021-03-10','2021-03-10 10:01:56','2021-03-10 10:01:56',''),(38,9,'','','2021-03-10','2021-03-10 10:04:24','2021-03-10 10:04:24',''),(39,9,'','','2021-03-10','2021-03-10 10:26:03','2021-03-10 10:26:03',''),(40,9,'','','2021-03-10','2021-03-10 10:34:31','2021-03-10 10:34:31',''),(41,9,'','','2021-03-10','2021-03-10 10:38:46','2021-03-10 10:38:46',''),(42,9,'','','2021-03-10','2021-03-10 10:41:02','2021-03-10 10:41:02',''),(43,9,'','','2021-03-10','2021-03-10 10:41:39','2021-03-10 10:41:39',''),(44,9,'dasdasdsa','0990668421','2021-04-01','2021-03-10 11:01:04','2021-03-10 11:01:04','d1'),(45,9,'dasdasdsa','0990668421','2021-03-10','2021-03-10 11:02:57','2021-03-10 11:02:57',''),(46,9,'dasdasdsa','0990668421','2021-03-10','2021-03-10 11:03:38','2021-03-10 11:03:38','new test'),(47,9,'dasdasdsa','0990668421','2021-03-25','2021-03-10 11:06:57','2021-03-10 11:06:57',''),(48,9,'dasdasdsa','0990668424','2021-03-10','2021-03-10 11:07:39','2021-03-10 11:07:39',''),(49,9,'dasdasdsa','0990668424','2021-03-10','2021-03-10 11:12:00','2021-03-10 11:12:00',''),(50,9,'dasdasdsa','0990668421','2021-03-10','2021-03-10 11:29:00','2021-03-10 11:29:00',''),(51,29,'dasdasdsa','0990668424','2021-03-19','2021-03-10 18:39:57','2021-03-10 18:39:57','gbljhs'),(52,29,'dasdasdsa','0990668424','2021-03-26','2021-03-12 15:16:47','2021-03-12 15:16:47','dddd'),(53,32,'dddddddddddddddddddddddddddddddd','0990668424','2021-03-26','2021-03-12 18:38:03','2021-03-12 18:38:03','testttt'),(54,32,'dasdasdsa','0990668424','2021-03-12','2021-03-12 18:42:31','2021-03-12 18:42:31','dsdsds'),(55,32,'dasdasdsa','0990668424','2021-03-19','2021-03-12 18:46:25','2021-03-12 18:46:25','asdsad'),(56,32,'dasdasdsa','0990668424','2021-04-02','2021-03-12 18:47:46','2021-03-12 18:47:46','sadsad'),(57,32,'ttttttttttttttttttt','0990668424','2021-03-26','2021-03-12 18:51:20','2021-03-12 18:51:20','tttttttttttttttttttttttt'),(58,29,'dasdasdsa','0990668424','2021-03-19','2021-03-12 20:36:25','2021-03-12 20:36:25','sssss'),(59,29,'dasdasdsa','0990668424','2021-03-25','2021-03-12 20:57:45','2021-03-12 20:57:45','dssassa'),(60,29,'dasdasdsa','0990668424','2021-03-12','2021-03-12 21:01:47','2021-03-12 21:01:47','dsad12'),(61,29,'dasdasdsa','0990668424','2021-03-12','2021-03-12 21:21:10','2021-03-12 21:21:10','sdsd'),(62,29,'dasdasdsa','0990668424','2021-03-12','2021-03-12 21:22:21','2021-03-12 21:22:21','sdasd'),(63,29,'asdsad','0990668424','2021-03-12','2021-03-12 21:24:55','2021-03-12 21:24:55','12323'),(64,29,'dsdd','0990668424','2021-03-12','2021-03-12 21:30:49','2021-03-12 21:30:49','sdsdsd'),(65,29,'dasdasdsa','0990668424','2021-03-22','2021-03-14 10:46:49','2021-03-14 10:46:49','dsdsd'),(66,29,'dasdasdsa','0990668424','2021-03-16','2021-03-15 17:25:35','2021-03-15 17:25:35','ddd');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders_products`
--

DROP TABLE IF EXISTS `orders_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders_products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `amount` int NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `orders_products_orders_id_fk` (`order_id`),
  KEY `orders_products_products_id_fk` (`product_id`),
  CONSTRAINT `orders_products_orders_id_fk` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  CONSTRAINT `orders_products_products_id_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders_products`
--

LOCK TABLES `orders_products` WRITE;
/*!40000 ALTER TABLE `orders_products` DISABLE KEYS */;
INSERT INTO `orders_products` (`id`, `order_id`, `product_id`, `amount`, `updated_at`, `created_at`) VALUES (46,23,9,1,'2021-02-19 11:21:02','2021-02-19 11:21:02'),(47,23,10,1,'2021-02-19 11:21:02','2021-02-19 11:21:02'),(48,23,11,1,'2021-02-19 11:21:02','2021-02-19 11:21:02'),(49,24,11,1,'2021-02-19 12:14:11','2021-02-19 12:14:11'),(50,24,10,1,'2021-02-19 12:14:11','2021-02-19 12:14:11'),(51,24,9,1,'2021-02-19 12:14:11','2021-02-19 12:14:11'),(52,25,11,1,'2021-02-20 21:39:49','2021-02-20 21:39:49'),(53,25,10,1,'2021-02-20 21:39:49','2021-02-20 21:39:49'),(54,25,9,1,'2021-02-20 21:39:49','2021-02-20 21:39:49'),(55,26,12,1,'2021-02-20 21:45:34','2021-02-20 21:45:34'),(56,26,13,1,'2021-02-20 21:45:34','2021-02-20 21:45:34'),(57,26,14,1,'2021-02-20 21:45:34','2021-02-20 21:45:34'),(58,27,11,1,'2021-02-20 22:06:04','2021-02-20 22:06:04'),(59,27,13,1,'2021-02-20 22:06:04','2021-02-20 22:06:04'),(60,27,14,1,'2021-02-20 22:06:04','2021-02-20 22:06:04'),(61,27,12,1,'2021-02-20 22:06:04','2021-02-20 22:06:04'),(62,28,9,1,'2021-02-21 11:57:30','2021-02-21 11:57:30'),(63,28,13,1,'2021-02-21 11:57:30','2021-02-21 11:57:30'),(64,28,12,1,'2021-02-21 11:57:30','2021-02-21 11:57:30'),(65,28,11,1,'2021-02-21 11:57:30','2021-02-21 11:57:30'),(66,29,11,1,'2021-02-21 14:12:05','2021-02-21 14:12:05'),(67,29,12,1,'2021-02-21 14:12:05','2021-02-21 14:12:05'),(68,29,13,1,'2021-02-21 14:12:05','2021-02-21 14:12:05'),(69,29,14,1,'2021-02-21 14:12:05','2021-02-21 14:12:05'),(70,30,10,4,'2021-02-21 14:45:02','2021-02-21 14:45:02'),(71,31,10,3,'2021-02-21 14:46:07','2021-02-21 14:46:07'),(72,31,9,2,'2021-02-21 14:46:07','2021-02-21 14:46:07'),(73,31,11,3,'2021-02-21 14:46:07','2021-02-21 14:46:07'),(74,32,10,1,'2021-03-05 21:52:27','2021-03-05 21:52:27'),(76,33,9,1,'2021-03-10 09:45:18','2021-03-10 09:45:18'),(77,33,10,1,'2021-03-10 09:45:18','2021-03-10 09:45:18'),(78,33,11,1,'2021-03-10 09:45:18','2021-03-10 09:45:18'),(79,33,12,1,'2021-03-10 09:45:18','2021-03-10 09:45:18'),(80,34,10,1,'2021-03-10 09:56:11','2021-03-10 09:56:11'),(81,34,11,1,'2021-03-10 09:58:15','2021-03-10 09:58:15'),(82,34,14,1,'2021-03-10 10:00:25','2021-03-10 10:00:25'),(83,34,12,1,'2021-03-10 10:01:56','2021-03-10 10:01:56'),(84,34,12,1,'2021-03-10 10:04:24','2021-03-10 10:04:24'),(85,34,14,1,'2021-03-10 10:26:03','2021-03-10 10:26:03'),(86,34,13,1,'2021-03-10 10:34:31','2021-03-10 10:34:31'),(87,34,14,1,'2021-03-10 10:38:46','2021-03-10 10:38:46'),(88,34,11,1,'2021-03-10 10:41:03','2021-03-10 10:41:03'),(89,34,12,1,'2021-03-10 10:41:39','2021-03-10 10:41:39'),(90,44,11,1,'2021-03-10 11:01:04','2021-03-10 11:01:04'),(91,44,12,1,'2021-03-10 11:01:04','2021-03-10 11:01:04'),(92,34,14,1,'2021-03-10 11:02:57','2021-03-10 11:02:57'),(93,46,9,1,'2021-03-10 11:03:38','2021-03-10 11:03:38'),(94,33,11,1,'2021-03-10 11:06:57','2021-03-10 11:06:57'),(95,34,11,1,'2021-03-10 11:07:39','2021-03-10 11:07:39'),(96,34,10,1,'2021-03-10 11:12:00','2021-03-10 11:12:00'),(97,34,11,1,'2021-03-10 11:12:00','2021-03-10 11:12:00'),(98,50,13,1,'2021-03-10 11:29:00','2021-03-10 11:29:00'),(99,50,12,1,'2021-03-10 11:29:01','2021-03-10 11:29:01'),(100,51,12,4,'2021-03-10 18:39:57','2021-03-10 18:39:57'),(101,52,11,3,'2021-03-12 15:16:48','2021-03-12 15:16:48'),(102,52,10,2,'2021-03-12 15:16:48','2021-03-12 15:16:48'),(103,53,13,3,'2021-03-12 18:38:03','2021-03-12 18:38:03'),(104,53,14,3,'2021-03-12 18:38:03','2021-03-12 18:38:03'),(105,53,9,3,'2021-03-12 18:38:03','2021-03-12 18:38:03'),(106,54,10,1,'2021-03-12 18:42:31','2021-03-12 18:42:31'),(107,54,9,1,'2021-03-12 18:42:31','2021-03-12 18:42:31'),(108,54,11,1,'2021-03-12 18:42:31','2021-03-12 18:42:31'),(109,55,12,1,'2021-03-12 18:46:25','2021-03-12 18:46:25'),(110,56,13,1,'2021-03-12 18:47:46','2021-03-12 18:47:46'),(111,56,12,1,'2021-03-12 18:47:46','2021-03-12 18:47:46'),(112,57,12,1,'2021-03-12 18:51:20','2021-03-12 18:51:20'),(113,57,11,1,'2021-03-12 18:51:20','2021-03-12 18:51:20'),(114,58,12,1,'2021-03-12 20:36:27','2021-03-12 20:36:27'),(115,59,10,1,'2021-03-12 20:57:46','2021-03-12 20:57:46'),(116,60,10,1,'2021-03-12 21:01:47','2021-03-12 21:01:47'),(117,61,9,1,'2021-03-12 21:21:10','2021-03-12 21:21:10'),(118,62,11,1,'2021-03-12 21:22:21','2021-03-12 21:22:21'),(119,63,10,1,'2021-03-12 21:24:55','2021-03-12 21:24:55'),(120,64,9,1,'2021-03-12 21:30:49','2021-03-12 21:30:49'),(121,65,9,4,'2021-03-14 10:46:50','2021-03-14 10:46:50'),(122,66,55,1,'2021-03-15 17:25:36','2021-03-15 17:25:36'),(123,66,56,1,'2021-03-15 17:25:36','2021-03-15 17:25:36'),(124,66,10,1,'2021-03-15 17:25:36','2021-03-15 17:25:36'),(125,66,11,1,'2021-03-15 17:25:36','2021-03-15 17:25:36');
/*!40000 ALTER TABLE `orders_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(42) NOT NULL,
  `img` varchar(100) NOT NULL,
  `category_id` int NOT NULL,
  `discount` int DEFAULT NULL,
  `cost` bigint NOT NULL,
  `description` longtext NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `products_categories_id_fk` (`category_id`),
  CONSTRAINT `products_categories_id_fk` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`id`, `name`, `img`, `category_id`, `discount`, `cost`, `description`, `updated_at`, `created_at`) VALUES (9,'Енот Аврора','/images/products/plush/aurora.jpg',4,20,389,'Енот Aurora 23 см, Ukraine','2021-02-19 11:14:46','2021-02-19 11:14:46'),(10,'Кукла Барби','/images/products/dolls/doll_barbie.jpg',5,0,420,'Кукла Barbie Фантазийные образы, China','2021-02-19 11:14:47','2021-02-19 11:14:47'),(11,'CHAMPION CLIMBER','/images/products/cars/CHAMPION_CLIMBER.jpg',6,0,580,'Машинка трансформер перевертыш вездеход, China','2021-02-19 11:14:47','2021-02-19 11:14:47'),(12,'Кошкина Лапка','/images/products/board/cat_paw.png',7,0,720,' Настольная игра Кошачья лапка, Ukraine','2021-02-19 11:14:47','2021-02-19 11:14:47'),(13,'Загородный Дом','/images/products/sets/house.jpg',8,0,1575,'Загородный дом - это разноцветная двухэтажная дача, в которой живут девочка и мальчик. Разноцветный двухэтажный домик скрывает в своих комнатах множество приятных сюрпризов: ярких фигурок, веселых огоньков и забавных звуков. Ukraine','2021-02-19 11:14:48','2021-02-19 11:14:48'),(14,'Lego Ocean','/images/products/constructors/lego_ocean.jpg',9,0,4020,' LEGO City Научно-исследовательский корабль. Это транспортное средство не только плавает на воде, но и имеет всё для увлекательного досуга. China','2021-02-19 11:14:48','2021-02-19 11:14:48'),(53,'Fancy Акулkа','/images/products/4/2d787c7add0d06e04b8e5e5477d2704f.jpg',4,0,699,'Мягкая игрушка «Акула» развивает у малышей воображение, координацию движений, фантазию. Игрушка изготовлена из мягкого плюша, наполнитель: пенополистирол. 85см','2021-03-15 08:06:27','2021-03-15 08:06:27'),(54,'Единорог Дейзи','/images/products/4/f837c836cde2c831bc3cf9eb987b6d0c.jpg',4,0,515,'Единорог выполнен из качественного износостойкого текстиля. Внутри игрушки находятся интерактивные датчики, которые реагируют на прикосновения и движение. Зверь способен менять свой окрас. Игрушка работает в 4 развивающих режимах для игры и 1 обучающем режиме.','2021-03-15 08:08:53','2021-03-15 08:08:53'),(55,'Barbie Мерцающая русалочка','/images/products/5/11469889dbadbf38ac1f802e5e713015.jpg',5,0,700,'Кукла просто поражает своей красотой: светлые волосы русалки украшает розовая прядка, на голове надета бирюзовая диадема, у принцессы розовый купальник и невероятный сияющий хвост.','2021-03-15 08:11:35','2021-03-15 08:11:35'),(56,'Кукла Barbie Made to Move','/images/products/5/b30a3360ecb2eaaa69852f147703fdb0.jpg',5,0,799,'Кукла Барби Блондинка из серии \"Двигайся как я\" вдохновляет на активные и ролевые игры. Барби всегда в движении и может выполнять много различных упражнений. Кукла имеет 22 точки артикуляции, поэтому с легкостью может двигать плечами, шеей, туловищем, головой, сгибать руки и ноги. Одета кукла в одежду для йоги.','2021-03-15 08:14:05','2021-03-15 08:14:05'),(57,'Машинка Sulong Toys Off road','/images/products/6/8e7759979c49c0b08ec79ac5d053fe94.jpg',6,0,997,'Автомобиль на радиоуправлении от компании «Sulong Toys» станет классным подарком для любого мальчика в возрасте от 8-ми лет.','2021-03-15 08:18:13','2021-03-15 08:18:13'),(58,'MZ Ford Mustang GT500','/images/products/6/73c89d1367fb32fd4ba04fd1d9d0635e.jpg',6,0,359,'Качественная копия известного автомобиля Ford Mustang GT500 порадует ребенка занимательной игрой, как на улице, так и дома.\n\nИгрушка выполнена из прочного и ударостойкого пластика, не содержит ПВХ, отличается долгим сроком эксплуатации.','2021-03-15 08:20:30','2021-03-15 08:20:30'),(59,'Mega Monopoly','/images/products/7/77d6f90c08ca9a0b2037f93ed994ec3a.580',7,0,1395,'Покупайте больше имущества, недвижимости и зарабатывайте еще больше денег в Мега-издании любимой семейной игры Monopoly. Огромное игровое поле получило 12 дополнительных ячеек, в том числе восемь новых улиц - по одной для каждой группы цветов. Здесь также есть небоскребы, которые вы можете построить на своих улицах, чтобы ваша арендная плата взлетела в небо. А если вы построите депо на своих железнодорожных станциях, то собирать двойную аренду! Дополнительная купюра M1000 поможет вам заплатить за все это, а Speed Die и Bus Tickets помогут быстрее двигаться по большому игровому полю. Monopoly: The Mega Edition - это быстрая и простая в освоении игра, которая предлагает новые возможности и еще большие риски.','2021-03-15 08:23:34','2021-03-15 08:23:34'),(60,'Tactic Пати Элиас','/images/products/7/b3ce82a8670a17b6b85caa4673f706c9.jpg',7,0,499,'Действительно популярных и весёлых игр для вечеринок немного и одна из них: настольная игра «Пати элиас» от финской компании «Tactic». Эту игру украинские потребители приняли очень тепло, многие её очень хорошо знают, поэтому на правилах остановимся в общих чертах. «Элиас» игра командная, поэтому играть могут минимум 4 игрока (две команды). Максимальное число игроков зависит лишь от того, сколько человек вы сможете организовать в слаженную команду.','2021-03-15 08:28:56','2021-03-15 08:28:56'),(61,'Набор-сюрприз LOL Surprise','/images/products/8/64621ae17002ecd1f993946c2bad6682.jpg',8,0,399,'Набор-сюрприз LOL Surprise Remix Hairflip W1 Музыкальный сюрприз позволит ребенку воспроизвести игру на тему музыкальных развлечений и ощутить приятные эмоции от замечательного досуга. Набор подойдет для девочек, которые любят сюрпризы, музыку и моду.','2021-03-15 08:31:22','2021-03-15 08:31:22'),(62,'Набор-сюрприз Zuru Itty bitty small','/images/products/8/8594939bc3ca2e4d861f86becb875992.jpg',8,0,399,'Игровой набор Itty Bitty Small – увлекательный подарок для девочки, в котором спрятано 13 интересных сюрпризов.\nВсе детали набора изготовлены из безопасного пластика высокого качества, выдерживают активную эксплуатацию.','2021-03-15 08:34:03','2021-03-15 08:34:03'),(63,'LEGO Technic Chevrolet Corvette','/images/products/9/19fafcdcbc4ad2da9aaaa5dd1cb35f5c.jpg',9,0,1209,'Chevrolet Corvette порадует тебя своим невероятным дизайном и крутыми техническими характеристиками. Автомобиль, который имитирует эта модель, очень быстрый и мощный. У него 4 трубы, большое заднее крыло и аутентичный корпус.','2021-03-15 08:36:45','2021-03-15 08:36:45'),(64,'LEGO City Мобильный командный центр','/images/products/9/cd4b05e453db4bc0699e418fa5f62c4e.jpg',9,0,1076,'Останови грузовик и выпусти полицейскую собаку! Сообщник помогает воришке бежать из передвижной тюрьмы. Прикрепи крюк с цепью от вездехода к дверям тюрьмы и жми на газ, чтобы выломать дверь. Спусти вниз задний пандус Мобильного командного центра и выгрузи полицейский мотоцикл, а потом догони воришек и верни их в тюрьму!','2021-03-15 08:38:22','2021-03-15 08:38:22'),(65,'Умный щенок Smart stages','/images/products/4/2831e0499d886cdfdf59be7f85d75aba.jpg',4,0,1056,'Щенок поможет изучить новые слова (про части тела), споет разные обучающие песенки (про счет, алфавит и другие), научит цветам и названиям животных. На груди у щенка есть интерактивное сердце, которое загорается в ответ на нажатия малыша (если нажать и удерживать, прозвучат 20 песенок подряд).','2021-03-15 08:40:17','2021-03-15 08:40:17');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES (1,'User','2021-03-12 15:28:14','2021-03-12 15:28:23'),(2,'Administrator','2021-03-12 15:28:14','2021-03-12 15:28:23');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `login` varchar(70) NOT NULL,
  `password` varchar(32) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `email` varchar(80) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `login`, `password`, `first_name`, `last_name`, `email`, `created_at`, `updated_at`) VALUES (9,'w1ndows1','42ce6e6592d6e1cba626e83a01e4a901','Vlad','Zagidullin','w1ndows1@mail.ru','2021-02-15 18:45:32','2021-02-15 18:45:32'),(10,'tiner10','42ce6e6592d6e1cba626e83a01e4a901','Vlad','Zagidullin','persyk32111@gmail.com','2021-02-16 09:02:13','2021-02-16 09:02:13'),(11,'liloy','42ce6e6592d6e1cba626e83a01e4a901','Vlad','Zagidullin','test@mail.ru','2021-03-01 12:47:48','2021-03-01 12:47:48'),(12,'jackf','42ce6e6592d6e1cba626e83a01e4a901','Vlad','Zagidullin','adsdsssd@mail.ru','2021-03-09 11:21:08','2021-03-09 11:21:08'),(13,'jackf','42ce6e6592d6e1cba626e83a01e4a901','Vlad','Zagidullin','adsdsssd@mail.ru','2021-03-09 11:21:29','2021-03-09 11:21:29'),(14,'jackf','42ce6e6592d6e1cba626e83a01e4a901','Vlad','Zagidullin','adsdsssd@mail.ru','2021-03-09 11:25:20','2021-03-09 11:25:20'),(15,'Jackf','42ce6e6592d6e1cba626e83a01e4a901','Vlad','Zagidullin','adsdsd@mail.ru','2021-03-09 11:27:58','2021-03-09 11:27:58'),(16,'Jackf','42ce6e6592d6e1cba626e83a01e4a901','Vlad','Zagidullin','adsdsd@mail.ru','2021-03-09 11:28:20','2021-03-09 11:28:20'),(17,'Jackf','42ce6e6592d6e1cba626e83a01e4a901','Vlad','Zagidullin','adsdsd@mail.ru','2021-03-09 11:29:22','2021-03-09 11:29:22'),(18,'Jackf','42ce6e6592d6e1cba626e83a01e4a901','Vlad','Zagidullin','adsdsd@mail.ru','2021-03-09 11:29:52','2021-03-09 11:29:52'),(19,'w1ndows11','42ce6e6592d6e1cba626e83a01e4a901','Vlad','Zagidullin','adsdsd1@mail.ru','2021-03-09 11:38:33','2021-03-09 11:38:33'),(22,'dddddddd','42ce6e6592d6e1cba626e83a01e4a901','dsd','Admin','dddddd@mdail.ru','2021-03-10 17:05:33','2021-03-10 17:05:33'),(23,'ddddddddds','42ce6e6592d6e1cba626e83a01e4a901','Vlad','Zagidullin','tests@msail.ru','2021-03-10 17:07:15','2021-03-10 17:07:15'),(24,'ssssss','42ce6e6592d6e1cba626e83a01e4a901','dsd','sss','w1ndows1@masil.ru','2021-03-10 17:08:21','2021-03-10 17:08:21'),(25,'xxxxxxxxxx','42ce6e6592d6e1cba626e83a01e4a901','dsd','Admin','xxxxxxx@mail.ru','2021-03-10 17:10:07','2021-03-10 17:10:07'),(26,'xxxxxxxxd','42ce6e6592d6e1cba626e83a01e4a901','dsd','Admin','adsdxsd@msail.ru','2021-03-10 17:12:16','2021-03-10 17:12:16'),(27,'dasdsad','42ce6e6592d6e1cba626e83a01e4a901','Admin','Admin','adsdsd@masil.ru','2021-03-10 17:16:19','2021-03-10 17:16:19'),(28,'dasdsads','42ce6e6592d6e1cba626e83a01e4a901','Admin','Admin','adsdssd@masil.ru','2021-03-10 17:17:08','2021-03-10 17:17:08'),(29,'Admin','42ce6e6592d6e1cba626e83a01e4a901','Admin','Admin','admin@gmail.ru','2021-03-10 17:19:26','2021-03-10 17:19:26'),(30,'Jack1','42ce6e6592d6e1cba626e83a01e4a901','Vlad','Zagidullin','jack@mail.ru','2021-03-12 09:03:28','2021-03-12 09:03:28'),(31,'Admind','42ce6e6592d6e1cba626e83a01e4a901','Vlad','Zagidullin','w1ndowsd1@mail.ru','2021-03-12 15:55:43','2021-03-12 15:55:43'),(32,'testt','42ce6e6592d6e1cba626e83a01e4a901','Vlad','Zagidullin','testt@mail.ru','2021-03-12 18:35:12','2021-03-12 18:35:12');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_roles`
--

DROP TABLE IF EXISTS `users_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users_roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `role_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `users_roles_roles_id_fk` (`role_id`),
  KEY `users_roles_users_id_fk` (`user_id`),
  CONSTRAINT `users_roles_roles_id_fk` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  CONSTRAINT `users_roles_users_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_roles`
--

LOCK TABLES `users_roles` WRITE;
/*!40000 ALTER TABLE `users_roles` DISABLE KEYS */;
INSERT INTO `users_roles` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES (1,28,1,'2021-03-12 15:29:49','2021-03-12 15:29:49'),(2,29,2,'2021-03-12 15:29:49','2021-03-12 15:29:49'),(3,30,1,'2021-03-12 15:29:49','2021-03-12 15:29:49'),(4,31,1,'2021-03-12 15:55:43','2021-03-12 15:55:43'),(5,32,1,'2021-03-12 18:35:13','2021-03-12 18:35:13');
/*!40000 ALTER TABLE `users_roles` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-03-15 13:56:28
