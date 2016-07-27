-- MySQL dump 10.16  Distrib 10.2.1-MariaDB, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: sams_db
-- ------------------------------------------------------
-- Server version	10.2.1-MariaDB-1~trusty

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
-- Table structure for table `allocations`
--

DROP TABLE IF EXISTS `allocations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `allocations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `remaining` int(11) DEFAULT NULL,
  `expired_on` datetime DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `allocations`
--

LOCK TABLES `allocations` WRITE;
/*!40000 ALTER TABLE `allocations` DISABLE KEYS */;
/*!40000 ALTER TABLE `allocations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `announcement`
--

DROP TABLE IF EXISTS `announcement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `announcement` (
  `marquee_id` int(10) NOT NULL AUTO_INCREMENT,
  `marquee_text` varchar(200) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`marquee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `announcement`
--

LOCK TABLES `announcement` WRITE;
/*!40000 ALTER TABLE `announcement` DISABLE KEYS */;
INSERT INTO `announcement` VALUES (2,'lorem','ed nec dui et risus ullamcorper venenatis. Pellentesque suscipit, nunc ut gravida malesuada'),(3,'The Lorem Ipsum Text','amet magna fierent vel ne, graeci incorrupte eos ei. Verear oporteat ne vix, eos vide dicant ea, et vix utinam gloriatur'),(4,'The Lorem Ipsum Text','amet magna fierent vel ne, graeci incorrupte '),(11,'The Lorem Ipsum Text','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed nec dui et risus ullamcorper venenatis. Pellentesque suscipit, nunc ut gravida malesuada, libero purus ultrices risus, id tempus massa neque sed mi. Etiam a libero quis nunc venenatis cursus. Sed finibus auctor nunc, a consequat justo dignissim nec. Sed sodales porta fermentum. Ut ut congue augue. Fusce efficitur eu nunc eu bibendum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec finibus viverra neque vitae efficitur. Phasellus at feugiat tellus, eu tincidunt justo. Integer dapibus ac neque vel semper. Ut eget tortor auctor, mattis tortor et, vulputate felis. Nunc at convallis sem. Nam urna urna, egestas vel aliquet sodales, euismod ut felis. Vestibulum ut orci nunc.\r\n\r\nCurabitur ipsum magna, molestie sit amet aliquam quis, tempor sit amet nibh. Curabitur vitae aliquet turpis. Vivamus dapibus vehicula nisi, rhoncus scelerisque urna venenatis at. Phasellus lobortis maximus lorem ut tempor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sem massa, luctus ultrices ultricies ut, condimentum quis lectus. Nulla ac tristique turpis. Pellentesque ac volutpat turpis. Sed pharetra congue dui. Nunc at blandit orci, vel porttitor ante. Integer eget convallis velit. Nam lobortis ac magna nec fringilla. Mauris sit amet purus diam. Fusce et eros ligula. Maecenas vel ex nec ipsum vulputate tempus nec nec nulla.\r\n\r\nNam dictum volutpat interdum. Nullam in consectetur erat. Aliquam in fringilla lectus. Vivamus nec eros tempor mi lobortis porta nec ut mi. Proin fringilla orci quis pretium pharetra. Nulla facilisi. Nulla aliquam faucibus mauris, a facilisis eros finibus ac. Donec iaculis lorem velit, id fermentum dui varius in. Donec eu dui eros.\r\n\r\nPhasellus felis dui, condimentum eget libero vitae, gravida mollis turpis. Maecenas sit amet odio ut sem ultrices pulvinar dapibus vitae turpis. Fusce vitae eros lacus. Donec mattis, urna laoreet vulputate dictum, felis dui consequat ex, et pellentesque velit magna sed erat. Duis quis luctus est, vitae malesuada ex. Morbi congue nisl tortor, eget finibus ex convallis eget. Aenean tristique leo odio, et malesuada ligula lobortis sit amet. Morbi vel sodales urna, id auctor erat. Nam non erat quis quam feugiat bibendum vitae non mi. Nulla odio libero, rhoncus a molestie ac, rhoncus eu elit. In dictum velit vitae erat accumsan, sed bibendum nunc convallis. Donec mauris felis, molestie nec purus a, suscipit volutpat orci.\r\n\r\nProin auctor, nibh in finibus varius, orci nulla tristique neque, in pellentesque nisi sapien varius quam. Donec sapien ligula, tristique in mi eget, pretium volutpat ligula. Curabitur vel arcu in purus bibendum elementum. Nulla blandit, velit ut vehicula mattis, dui odio molestie purus, eu fermentum turpis nibh sed purus. Nullam eget libero sit amet lorem suscipit lobortis vel sed orci. Nunc vitae semper libero. Donec et velit eget augue aliquam sagittis non sed velit. Duis mollis lacus at mauris laoreet rutrum. Sed diam urna, tempus a placerat convallis, convallis quis odio.');
/*!40000 ALTER TABLE `announcement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `change_number_logs`
--

DROP TABLE IF EXISTS `change_number_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `change_number_logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `stud_no` varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
  `msisdn` varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `change_number_logs`
--

LOCK TABLES `change_number_logs` WRITE;
/*!40000 ALTER TABLE `change_number_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `change_number_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `codes`
--

DROP TABLE IF EXISTS `codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `codes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pattern_id` int(11) NOT NULL,
  `code` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `codes`
--

LOCK TABLES `codes` WRITE;
/*!40000 ALTER TABLE `codes` DISABLE KEYS */;
INSERT INTO `codes` VALUES (1,1,'groupmsg'),(2,1,'g'),(3,2,'outs'),(4,4,'poll'),(5,5,'reg'),(6,3,'help'),(7,6,'rep'),(8,7,'help reply'),(9,8,'help vote'),(10,9,'nick'),(11,10,'reboot'),(12,11,'restart kannel'),(13,12,'accnt');
/*!40000 ALTER TABLE `codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dtr`
--

DROP TABLE IF EXISTS `dtr`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dtr` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(11) DEFAULT NULL,
  `datein` date DEFAULT NULL,
  `timein` time DEFAULT NULL,
  `dateout` date DEFAULT NULL,
  `timeout` time DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dtr`
--

LOCK TABLES `dtr` WRITE;
/*!40000 ALTER TABLE `dtr` DISABLE KEYS */;
/*!40000 ALTER TABLE `dtr` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dtr_log`
--

DROP TABLE IF EXISTS `dtr_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dtr_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(11) DEFAULT NULL,
  `timelog` datetime DEFAULT NULL,
  `mode` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dtr_log`
--

LOCK TABLES `dtr_log` WRITE;
/*!40000 ALTER TABLE `dtr_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `dtr_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dtr_sending_config`
--

DROP TABLE IF EXISTS `dtr_sending_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dtr_sending_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `config` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `enabled` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dtr_sending_config`
--

LOCK TABLES `dtr_sending_config` WRITE;
/*!40000 ALTER TABLE `dtr_sending_config` DISABLE KEYS */;
INSERT INTO `dtr_sending_config` VALUES (1,'A','A preset message will be automatically sent to corresponding mobile no. for first in and last out transaction of students (everyday)',1),(2,'B','A preset message will be automatically sent to corresponding mobile no. only for students with late in, late out and early out transactions on weekdays, first in and last out transaction on weekends',0),(3,'C','A preset message will be automatically sent to corresponding mobile no. for every transaction of students',0);
/*!40000 ALTER TABLE `dtr_sending_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dtr_time_settings`
--

DROP TABLE IF EXISTS `dtr_time_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dtr_time_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `time_from` time NOT NULL,
  `time_to` time NOT NULL,
  `presetmsg_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `time_from` (`time_from`,`time_to`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dtr_time_settings`
--

LOCK TABLES `dtr_time_settings` WRITE;
/*!40000 ALTER TABLE `dtr_time_settings` DISABLE KEYS */;
INSERT INTO `dtr_time_settings` VALUES (1,'LATE_IN','07:01:00','12:00:00',1),(2,'LATE_OUT','17:01:00','21:00:00',2),(3,'EARLY_OUT','10:00:00','15:19:59',3),(4,'NORMAL_IN','01:00:00','07:00:00',4),(5,'NORMAL_OUT','16:00:00','17:00:59',5),(6,'GENERIC','00:00:00','00:00:00',6);
/*!40000 ALTER TABLE `dtr_time_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group_members`
--

DROP TABLE IF EXISTS `group_members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `group_members` (
  `group_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  PRIMARY KEY (`group_id`,`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group_members`
--

LOCK TABLES `group_members` WRITE;
/*!40000 ALTER TABLE `group_members` DISABLE KEYS */;
INSERT INTO `group_members` VALUES (1,1),(1,3),(1,4),(1,5),(1,6),(1,7),(1,9),(1,10),(1,11),(2,7),(2,9),(3,5),(4,1),(5,1),(5,3),(5,6);
/*!40000 ALTER TABLE `group_members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `groups_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `groups_name` text COLLATE utf8_unicode_ci NOT NULL,
  `groups_description` text COLLATE utf8_unicode_ci NOT NULL,
  `groups_code` text COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `removed_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `removed_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`groups_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'Group I','','group-i',1,NULL,NULL,'2016-07-16 20:22:29','0000-00-00 00:00:00',NULL),(2,'Group II','','group-ii',1,NULL,NULL,'2016-07-16 20:22:32','0000-00-00 00:00:00',NULL),(3,'Group III','','group-iii',1,NULL,NULL,'2016-07-16 20:22:55','0000-00-00 00:00:00',NULL),(4,'Group IV','','group-iv',1,NULL,NULL,'2016-07-16 20:23:00','0000-00-00 00:00:00',NULL),(5,'Grade 1 Michael','Section Michael','grade-1-michael',1,1,NULL,'2016-07-20 12:36:26','2016-07-20 12:37:24',NULL);
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inbox`
--

DROP TABLE IF EXISTS `inbox`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inbox` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `folder_id` int(11) DEFAULT NULL,
  `msisdn` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `smsc` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `charset` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `removed_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `removed_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inbox`
--

LOCK TABLES `inbox` WRITE;
/*!40000 ALTER TABLE `inbox` DISABLE KEYS */;
INSERT INTO `inbox` VALUES (1,NULL,'09985382274','smart','nick, Ferdz','UTF-8',NULL,NULL,NULL,'2016-07-20 12:29:47','0000-00-00 00:00:00',NULL),(2,NULL,'09068796092','smart','NICK,Vhino','UTF-8',NULL,NULL,NULL,'2016-07-20 12:30:13','0000-00-00 00:00:00',NULL),(3,NULL,'09985382274','smart','nick,Ferdz','UTF-8',NULL,NULL,NULL,'2016-07-20 12:33:28','0000-00-00 00:00:00',NULL),(4,NULL,'09255537425','smart','NICK, JERICK','UTF-8',NULL,NULL,NULL,'2016-07-20 12:33:36','0000-00-00 00:00:00',NULL),(5,NULL,'09351050172','smart','NICK EDJE','UTF-8',NULL,NULL,NULL,'2016-07-20 12:33:37','0000-00-00 00:00:00',NULL),(6,NULL,'09985382274','smart','help','UTF-8',NULL,NULL,NULL,'2016-07-20 12:44:11','0000-00-00 00:00:00',NULL),(7,NULL,'09351050172','smart','Nick,Edje','UTF-8',NULL,NULL,NULL,'2016-07-20 12:44:12','0000-00-00 00:00:00',NULL),(8,NULL,'09351050172','smart','Help','UTF-8',NULL,NULL,NULL,'2016-07-20 12:44:25','0000-00-00 00:00:00',NULL);
/*!40000 ALTER TABLE `inbox` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `levels`
--

DROP TABLE IF EXISTS `levels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `levels` (
  `levels_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `levels_name` text COLLATE utf8_unicode_ci NOT NULL,
  `levels_description` text COLLATE utf8_unicode_ci NOT NULL,
  `levels_code` text COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `removed_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `removed_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`levels_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `levels`
--

LOCK TABLES `levels` WRITE;
/*!40000 ALTER TABLE `levels` DISABLE KEYS */;
INSERT INTO `levels` VALUES (1,'Level I','','level-i',NULL,NULL,NULL,'2016-07-16 20:22:03','2016-07-16 20:23:44',NULL),(2,'Level II','','level-ii',NULL,NULL,NULL,'2016-07-16 20:22:17','2016-07-16 20:24:08',NULL);
/*!40000 ALTER TABLE `levels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `members` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nick` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `stud_no` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `firstname` text COLLATE utf8_unicode_ci NOT NULL,
  `middlename` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` text COLLATE utf8_unicode_ci NOT NULL,
  `level` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_blockno` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_street` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_brgy` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_city` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_zip` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `telephone` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `msisdn` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `groups` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `removed_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `removed_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` VALUES (1,'','2006142','John Lioneil','Palanas','Dionisio','2','2','Block 15 Lot 27','Catleya Street','Roseville Heights Sto. Tomas','San Jose City','3112','092-350 0343','09055420838','john.dionisio1@gmail.com','1,4,5',NULL,1,1,0,'2016-07-01 11:50:30','2016-07-20 12:37:24',NULL),(3,'Ferdz','2006141','Ferdie','Barrios','Santiago','2',NULL,'Block 15 Lot 27','Catleya Street','Roseville Heights Sto. Tomas','Pasig City','3112','092-350 0343','09985382274','jpj@ledzep.com','1,5',NULL,1,1,0,'2016-07-01 12:02:56','2016-07-20 12:37:24',NULL),(4,'Malou04','2006143','Maria Loudes','Antonio','Santiago','2','1','','Catleya Street','Roseville Heights Sto. Tomas','San Jose City','3112','098-765 4321','09237473204','rp@ledzep.com','1',NULL,1,1,0,'2016-07-01 13:36:48','2016-07-18 16:30:58',NULL),(5,'','2006146','Aliudin','','Macalawi',NULL,NULL,'Block 15 Lot 27','Catleya Street','Roseville Heights Sto. Tomas','San Jose City','3112','099-876 5432','09985686307','jpe@senate.com.ph','1,3',NULL,1,1,0,'2016-07-03 11:22:38','2016-07-18 16:23:00',NULL),(6,'JERICK','2006144','Jerick','','Cruz','1','2','Block 15 Lot 27','Street cred','hola subd','Gotham City','6988','092-345 6789','09255537425','jerickvcruz@gmail.com','1,5',NULL,1,1,0,'2016-07-03 11:23:53','2016-07-20 12:38:07',NULL),(7,'Edje','2006145','Edje','','Ambas','2','2','Block 15 Lot 27','Catleya Street','Roseville Heights Sto. Tomas','San Jose City','3112','098-765 4312','09351050172','edjeambas@gmail.com','1,2',NULL,1,1,0,'2016-07-03 11:27:03','2016-07-20 12:44:12',NULL),(8,'','','Nikki','Puki','Malacci','4','3','','Catleya Street','Roseville Heights Sto. Tomas','San Jose City','3112','034-567 8987','09256489876','bigppnikki@gmail.com','2,4,6',NULL,1,1,1,'2016-07-03 11:28:20','2016-07-20 10:39:56','2016-07-20 10:39:56'),(9,'','2006146','Jenel','','Gular','2','2','Block 15 Lot 27','Catleya Street','Roseville Heights Sto. Tomas','San Jose City','3112','093-456 7765','09399323327','fasfsd@gmail.com','1,2',NULL,1,1,0,'2016-07-03 11:29:16','2016-07-20 12:23:08',NULL),(10,'Vhino','2006147','Alvin','','Cera','1','2','Block 15 Lot 27','Catleya Street','Roseville Heights Sto. Tomas','San Jose City','3112','023-456 7887','09068796092','superboybob@funnycomics.co','1',NULL,1,1,0,'2016-07-03 11:29:58','2016-07-20 12:30:13',NULL),(11,'','2006148','April','','Tuazon','1','2','Block 15 Lot 27','Catleya Street','Roseville Heights Sto. Tomas','San Jose City','3112','092-345 6788','09065331164','johndelacruz@yahoo.com','1',NULL,1,1,0,'2016-07-03 11:30:42','2016-07-20 12:25:59',NULL),(27,'1','','2006149','IMPORT','IMPORT','IMPORT','2','2','Block 15 Lot 27','Catleya Street','Roseville Heights Sto. Tomas','San Jose City','3112','092-350 0343','9055420838','john.dionisio1@gmail.com','1,4,5',0,1,1,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `message` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `msisdn` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (1,'WELCOME TO SJSP Line.Your no. is now officially registered to this service.update ur nickname txt NICK,yournickname','09055420838','1','2016-07-20 12:28:25'),(2,'WELCOME TO SJSP Line.Your no. is now officially registered to this service.update ur nickname txt NICK,yournickname','09985382274','1','2016-07-20 12:28:25'),(3,'WELCOME TO SJSP Line.Your no. is now officially registered to this service.update ur nickname txt NICK,yournickname','09237473204','1','2016-07-20 12:28:25'),(4,'WELCOME TO SJSP Line.Your no. is now officially registered to this service.update ur nickname txt NICK,yournickname','09985686307','1','2016-07-20 12:28:26'),(5,'WELCOME TO SJSP Line.Your no. is now officially registered to this service.update ur nickname txt NICK,yournickname','09255537425','1','2016-07-20 12:28:26'),(6,'WELCOME TO SJSP Line.Your no. is now officially registered to this service.update ur nickname txt NICK,yournickname','09351050172','1','2016-07-20 12:28:26'),(7,'WELCOME TO SJSP Line.Your no. is now officially registered to this service.update ur nickname txt NICK,yournickname','09399323327','1','2016-07-20 12:28:26'),(8,'WELCOME TO SJSP Line.Your no. is now officially registered to this service.update ur nickname txt NICK,yournickname','09068796092','1','2016-07-20 12:28:26'),(9,'WELCOME TO SJSP Line.Your no. is now officially registered to this service.update ur nickname txt NICK,yournickname','09065331164','1','2016-07-20 12:28:26'),(10,'Your nickname \"Ferdz\" has successfully updated.Thank you!.   ',NULL,'auto-response','2016-07-20 12:29:47'),(11,'Your nickname \"Vhino\" has successfully updated.Thank you!.   ',NULL,'auto-response','2016-07-20 12:30:13'),(12,'Your nickname \"Ferdz\" has successfully updated.Thank you!.   ',NULL,'auto-response','2016-07-20 12:33:28'),(13,'Your nickname \"JERICK\" has successfully updated.Thank you!.   ',NULL,'auto-response','2016-07-20 12:33:36'),(14,'to register txt REG,EMPNO,FIRSTNAME,LASTNAME,MIDDLENAME,GROUP\r\n\r\nNOTE GROUPCODE: PSEMP,GSEMP,HSEMP',NULL,'auto-response','2016-07-20 12:44:11'),(15,'Your nickname \"Edje\" has successfully updated.Thank you!.   ',NULL,'auto-response','2016-07-20 12:44:12'),(16,'to register txt REG,EMPNO,FIRSTNAME,LASTNAME,MIDDLENAME,GROUP\r\n\r\nNOTE GROUPCODE: PSEMP,GSEMP,HSEMP',NULL,'auto-response','2016-07-20 12:44:25');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (20160730120511);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modules`
--

DROP TABLE IF EXISTS `modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `removed_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `removed_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modules`
--

LOCK TABLES `modules` WRITE;
/*!40000 ALTER TABLE `modules` DISABLE KEYS */;
INSERT INTO `modules` VALUES (1,'Members','members','Members list function',NULL,NULL,NULL,'2016-07-16 16:10:13','0000-00-00 00:00:00',NULL),(2,'List Members','members/listing','Members list function',NULL,NULL,NULL,'2016-07-16 16:10:13','0000-00-00 00:00:00',NULL),(3,'Add Members','members/add','Members add function',NULL,NULL,NULL,'2016-07-16 16:10:13','0000-00-00 00:00:00',NULL),(4,'Edit Members','members/edit','Members edit function',NULL,NULL,NULL,'2016-07-16 16:10:14','0000-00-00 00:00:00',NULL),(5,'Update Members','members/update','Members update function',NULL,NULL,NULL,'2016-07-16 16:10:14','0000-00-00 00:00:00',NULL),(6,'Remove Members','members/remove','Members remove function',NULL,NULL,NULL,'2016-07-16 16:10:14','0000-00-00 00:00:00',NULL),(7,'Restore Members','members/restore','Members restore function',NULL,NULL,NULL,'2016-07-16 16:10:14','0000-00-00 00:00:00',NULL),(8,'Export Members','members/export','Members export function',NULL,NULL,NULL,'2016-07-16 16:10:14','0000-00-00 00:00:00',NULL),(9,'Import Members','members/import','Members import function',NULL,NULL,NULL,'2016-07-16 16:10:14','0000-00-00 00:00:00',NULL),(10,'Groups','groups','Groups list function',NULL,NULL,NULL,'2016-07-16 16:10:14','0000-00-00 00:00:00',NULL),(11,'List Groups','groups/listing','Groups list function',NULL,NULL,NULL,'2016-07-16 16:10:14','0000-00-00 00:00:00',NULL),(12,'Add Groups','groups/add','Groups add function',NULL,NULL,NULL,'2016-07-16 16:10:14','0000-00-00 00:00:00',NULL),(13,'Edit Groups','groups/edit','Groups edit function',NULL,NULL,NULL,'2016-07-16 16:10:14','0000-00-00 00:00:00',NULL),(14,'Update Groups','groups/update','Groups update function',NULL,NULL,NULL,'2016-07-16 16:10:14','0000-00-00 00:00:00',NULL),(15,'Remove Groups','groups/remove','Groups remove function',NULL,NULL,NULL,'2016-07-16 16:10:14','0000-00-00 00:00:00',NULL),(16,'Restore Groups','groups/restore','Groups restore function',NULL,NULL,NULL,'2016-07-16 16:10:14','0000-00-00 00:00:00',NULL),(17,'Export Groups','groups/export','Groups export function',NULL,NULL,NULL,'2016-07-16 16:10:14','0000-00-00 00:00:00',NULL),(18,'Import Groups','groups/import','Groups import function',NULL,NULL,NULL,'2016-07-16 16:10:14','0000-00-00 00:00:00',NULL),(19,'Types','types','Types list function',NULL,NULL,NULL,'2016-07-16 16:10:14','0000-00-00 00:00:00',NULL),(20,'List Types','types/listing','Types list function',NULL,NULL,NULL,'2016-07-16 16:10:14','0000-00-00 00:00:00',NULL),(21,'Add Types','types/add','Types add function',NULL,NULL,NULL,'2016-07-16 16:10:14','0000-00-00 00:00:00',NULL),(22,'Edit Types','types/edit','Types edit function',NULL,NULL,NULL,'2016-07-16 16:10:14','0000-00-00 00:00:00',NULL),(23,'Update Types','types/update','Types update function',NULL,NULL,NULL,'2016-07-16 16:10:14','0000-00-00 00:00:00',NULL),(24,'Remove Types','types/remove','Types remove function',NULL,NULL,NULL,'2016-07-16 16:10:14','0000-00-00 00:00:00',NULL),(25,'Restore Types','types/restore','Types restore function',NULL,NULL,NULL,'2016-07-16 16:10:14','0000-00-00 00:00:00',NULL),(26,'Export Types','types/export','Types export function',NULL,NULL,NULL,'2016-07-16 16:10:14','0000-00-00 00:00:00',NULL),(27,'Import Types','types/import','Types import function',NULL,NULL,NULL,'2016-07-16 16:10:14','0000-00-00 00:00:00',NULL),(28,'Levels','levels','Levels list function',NULL,NULL,NULL,'2016-07-16 16:10:14','0000-00-00 00:00:00',NULL),(29,'List Levels','levels/listing','Levels list function',NULL,NULL,NULL,'2016-07-16 16:10:14','0000-00-00 00:00:00',NULL),(30,'Add Levels','levels/add','Levels add function',NULL,NULL,NULL,'2016-07-16 16:10:14','0000-00-00 00:00:00',NULL),(31,'Edit Levels','levels/edit','Levels edit function',NULL,NULL,NULL,'2016-07-16 16:10:14','0000-00-00 00:00:00',NULL),(32,'Update Levels','levels/update','Levels update function',NULL,NULL,NULL,'2016-07-16 16:10:14','0000-00-00 00:00:00',NULL),(33,'Remove Levels','levels/remove','Levels remove function',NULL,NULL,NULL,'2016-07-16 16:10:15','0000-00-00 00:00:00',NULL),(34,'Restore Levels','levels/restore','Levels restore function',NULL,NULL,NULL,'2016-07-16 16:10:15','0000-00-00 00:00:00',NULL),(35,'Export Levels','levels/export','Levels export function',NULL,NULL,NULL,'2016-07-16 16:10:15','0000-00-00 00:00:00',NULL),(36,'Import Levels','levels/import','Levels import function',NULL,NULL,NULL,'2016-07-16 16:10:15','0000-00-00 00:00:00',NULL),(37,'Messaging','messaging','Messaging list function',NULL,NULL,NULL,'2016-07-16 16:10:15','0000-00-00 00:00:00',NULL),(38,'List Messaging','messaging/listing','Messaging list function',NULL,NULL,NULL,'2016-07-16 16:10:15','0000-00-00 00:00:00',NULL),(39,'Add Messaging','messaging/add','Messaging add function',NULL,NULL,NULL,'2016-07-16 16:10:15','0000-00-00 00:00:00',NULL),(40,'Edit Messaging','messaging/edit','Messaging edit function',NULL,NULL,NULL,'2016-07-16 16:10:15','0000-00-00 00:00:00',NULL),(41,'Update Messaging','messaging/update','Messaging update function',NULL,NULL,NULL,'2016-07-16 16:10:15','0000-00-00 00:00:00',NULL),(42,'Remove Messaging','messaging/remove','Messaging remove function',NULL,NULL,NULL,'2016-07-16 16:10:15','0000-00-00 00:00:00',NULL),(43,'Restore Messaging','messaging/restore','Messaging restore function',NULL,NULL,NULL,'2016-07-16 16:10:15','0000-00-00 00:00:00',NULL),(44,'Export Messaging','messaging/export','Messaging export function',NULL,NULL,NULL,'2016-07-16 16:10:15','0000-00-00 00:00:00',NULL),(45,'Import Messaging','messaging/import','Messaging import function',NULL,NULL,NULL,'2016-07-16 16:10:15','0000-00-00 00:00:00',NULL),(46,'Privilege','privileges','Privilege list function',NULL,NULL,NULL,'2016-07-16 16:10:15','0000-00-00 00:00:00',NULL),(47,'List Privilege','privileges/listing','Privilege list function',NULL,NULL,NULL,'2016-07-16 16:10:15','0000-00-00 00:00:00',NULL),(48,'Add Privilege','privileges/add','Privilege add function',NULL,NULL,NULL,'2016-07-16 16:10:15','0000-00-00 00:00:00',NULL),(49,'Edit Privilege','privileges/edit','Privilege edit function',NULL,NULL,NULL,'2016-07-16 16:10:15','0000-00-00 00:00:00',NULL),(50,'Update Privilege','privileges/update','Privilege update function',NULL,NULL,NULL,'2016-07-16 16:10:15','0000-00-00 00:00:00',NULL),(51,'Remove Privilege','privileges/remove','Privilege remove function',NULL,NULL,NULL,'2016-07-16 16:10:15','0000-00-00 00:00:00',NULL),(52,'Restore Privilege','privileges/restore','Privilege restore function',NULL,NULL,NULL,'2016-07-16 16:10:15','0000-00-00 00:00:00',NULL),(53,'Export Privilege','privileges/export','Privilege export function',NULL,NULL,NULL,'2016-07-16 16:10:15','0000-00-00 00:00:00',NULL),(54,'Import Privilege','privileges/import','Privilege import function',NULL,NULL,NULL,'2016-07-16 16:10:15','0000-00-00 00:00:00',NULL),(55,'Privileges Level','privileges-levels','Privileges Level list function',NULL,NULL,NULL,'2016-07-16 16:10:15','0000-00-00 00:00:00',NULL),(56,'List Privileges Level','privileges-levels/listing','Privileges Level list function',NULL,NULL,NULL,'2016-07-16 16:10:15','0000-00-00 00:00:00',NULL),(57,'Add Privileges Level','privileges-levels/add','Privileges Level add function',NULL,NULL,NULL,'2016-07-16 16:10:16','0000-00-00 00:00:00',NULL),(58,'Edit Privileges Level','privileges-levels/edit','Privileges Level edit function',NULL,NULL,NULL,'2016-07-16 16:10:16','0000-00-00 00:00:00',NULL),(59,'Update Privileges Level','privileges-levels/update','Privileges Level update function',NULL,NULL,NULL,'2016-07-16 16:10:16','0000-00-00 00:00:00',NULL),(60,'Remove Privileges Level','privileges-levels/remove','Privileges Level remove function',NULL,NULL,NULL,'2016-07-16 16:10:16','0000-00-00 00:00:00',NULL),(61,'Restore Privileges Level','privileges-levels/restore','Privileges Level restore function',NULL,NULL,NULL,'2016-07-16 16:10:16','0000-00-00 00:00:00',NULL),(62,'Export Privileges Level','privileges-levels/export','Privileges Level export function',NULL,NULL,NULL,'2016-07-16 16:10:16','0000-00-00 00:00:00',NULL),(63,'Import Privileges Level','privileges-levels/import','Privileges Level import function',NULL,NULL,NULL,'2016-07-16 16:10:16','0000-00-00 00:00:00',NULL);
/*!40000 ALTER TABLE `modules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `outbox`
--

DROP TABLE IF EXISTS `outbox`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `outbox` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `message_id` bigint(20) DEFAULT NULL,
  `folder_id` bigint(20) DEFAULT NULL,
  `member_id` bigint(20) DEFAULT NULL,
  `group_id` bigint(20) DEFAULT NULL,
  `msisdn` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `smsc` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `extra` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `removed_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `removed_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `outbox`
--

LOCK TABLES `outbox` WRITE;
/*!40000 ALTER TABLE `outbox` DISABLE KEYS */;
INSERT INTO `outbox` VALUES (1,1,NULL,1,NULL,'09055420838','globe','success','0: Accepted for delivery',1,NULL,NULL,'2016-07-20 12:28:25','2016-07-20 12:28:29',NULL),(2,2,NULL,3,NULL,'09985382274','auto','success','0: Accepted for delivery',1,NULL,NULL,'2016-07-20 12:28:25','2016-07-20 12:29:13',NULL),(3,3,NULL,4,NULL,'09237473204','sun','success','0: Accepted for delivery',1,NULL,NULL,'2016-07-20 12:28:25','2016-07-20 12:28:34',NULL),(4,4,NULL,5,NULL,'09985686307','auto','success','0: Accepted for delivery',1,NULL,NULL,'2016-07-20 12:28:26','2016-07-20 12:28:41',NULL),(5,5,NULL,6,NULL,'09255537425','globe','success','0: Accepted for delivery',1,NULL,NULL,'2016-07-20 12:28:26','2016-07-20 12:28:46',NULL),(6,6,NULL,7,NULL,'09351050172','globe','success','0: Accepted for delivery',1,NULL,NULL,'2016-07-20 12:28:26','2016-07-20 12:28:52',NULL),(7,7,NULL,9,NULL,'09399323327','smart','success','0: Accepted for delivery',1,NULL,NULL,'2016-07-20 12:28:26','2016-07-20 12:28:58',NULL),(8,8,NULL,10,NULL,'09068796092','globe','success','0: Accepted for delivery',1,NULL,NULL,'2016-07-20 12:28:26','2016-07-20 12:29:03',NULL),(9,9,NULL,11,NULL,'09065331164','globe','success','0: Accepted for delivery',1,NULL,NULL,'2016-07-20 12:28:26','2016-07-20 12:29:08',NULL),(10,12,NULL,3,NULL,'09985382274','smart','success','0: Accepted for delivery',NULL,NULL,NULL,'2016-07-20 12:33:28','2016-07-20 12:33:36',NULL),(11,13,NULL,6,NULL,'09255537425','smart','success','0: Accepted for delivery',NULL,NULL,NULL,'2016-07-20 12:33:36','2016-07-20 12:33:41',NULL),(12,14,NULL,3,NULL,'09985382274','smart','success','0: Accepted for delivery',NULL,NULL,NULL,'2016-07-20 12:44:11','2016-07-20 12:44:25',NULL),(13,15,NULL,7,NULL,'09351050172','smart','success','0: Accepted for delivery',NULL,NULL,NULL,'2016-07-20 12:44:12','2016-07-20 12:44:17',NULL),(14,16,NULL,7,NULL,'09351050172','smart','success','0: Accepted for delivery',NULL,NULL,NULL,'2016-07-20 12:44:25','2016-07-20 12:44:30',NULL);
/*!40000 ALTER TABLE `outbox` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `patterns`
--

DROP TABLE IF EXISTS `patterns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patterns` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `format` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `type` varchar(100) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patterns`
--

LOCK TABLES `patterns` WRITE;
/*!40000 ALTER TABLE `patterns` DISABLE KEYS */;
INSERT INTO `patterns` VALUES (1,'grpmsg','GROUPMSG1','Send Message to group CODE, GROUPNAME, MESSAGE','system','2008-11-15 16:56:13'),(2,'balance','OUTSTANDING','Inquire Outstanding Balance \r\nCODE, STUDENTNO ','system','2008-11-15 16:56:29'),(3,'help','HELP','Need Help \r\n<CODE>help','system','2009-12-29 09:15:05'),(4,'poll','','Conducts SMS Voting campaign\n<CODE, POLL_CODE, POLL_OPTION_CODE> ','system','2009-09-04 04:13:52'),(5,'reg','','Conducts SMS Voting campaign\r\n<CODE, FIRSTNAME, LASTNAME,MIDDLENAME>','system','2009-11-15 14:10:43'),(6,'rep','','To reply with the sender\r\n<CODE,sender_id,Messsage>\r\n','system','2009-12-29 15:30:32'),(7,'help reply','',' to know how to reply to sender\r\n<HELP REPLY>','system','2009-12-30 03:33:47'),(8,'help vote','','To conduct Vote\r\n<HELP VOTE>','','2009-12-30 03:33:30'),(9,'nick','','to change nickname\r\n(CODE,NICK)','','2009-12-30 05:09:14'),(10,'reboot','','','','2010-12-15 08:58:17'),(11,'restart kannel','','','','2010-12-22 05:56:57'),(12,'gisaccnt','gisaccnt','Get the username and password for GIS System','','2013-08-31 16:56:36');
/*!40000 ALTER TABLE `patterns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prefixes`
--

DROP TABLE IF EXISTS `prefixes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prefixes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `access` text NOT NULL,
  `network` varchar(50) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prefixes`
--

LOCK TABLES `prefixes` WRITE;
/*!40000 ALTER TABLE `prefixes` DISABLE KEYS */;
INSERT INTO `prefixes` VALUES (1,'222,2870,0905,0906,0915,0916,0917,0925,0926,0927,0935,0936,0937,0996,0997','globe','2010-12-19 16:29:21'),(2,'0248,214,258,808,0907,0908,0909,0910,0912,0918,0919,0920,0921,0928,0929,0930,0938,0939,0989,0999,0948,0949','smart','2011-08-16 04:17:58'),(3,'0922,0923,0932,0933','sun','2011-09-27 12:50:08');
/*!40000 ALTER TABLE `prefixes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `preset_messages`
--

DROP TABLE IF EXISTS `preset_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `preset_messages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  `created_by` varchar(50) NOT NULL,
  `creation_date` datetime NOT NULL,
  `modified_by` varchar(50) NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `preset_messages`
--

LOCK TABLES `preset_messages` WRITE;
/*!40000 ALTER TABLE `preset_messages` DISABLE KEYS */;
INSERT INTO `preset_messages` VALUES (1,'<DATE> YOUR CHILD (<STUD_NAME>/ <STUD_NO>) ENTERED THE HIGH SCHOOL CAMPUS LATE AT <TIME>.',1,'','2009-07-16 16:43:12','ferdie','2012-04-23 06:01:06'),(2,'<DATE> YOUR CHILD (<STUD_NAME>/ <STUD_NO>) LEFT THE HIGH SCHOOL CAMPUS LATE AT <TIME>.',1,'','2009-07-16 16:43:22','ferdie','2012-04-23 06:01:27'),(3,'<DATE> YOUR CHILD (<STUD_NAME>/ <STUD_NO>) LEFT THE HIGH SCHOOL CAMPUS EARLY AT <TIME>.',1,'ferdie','2009-07-18 01:46:13','ferdie','2012-04-23 06:03:06'),(4,'<DATE> YOUR CHILD (<STUD_NAME>/ <STUD_NO>) ENTERED THE HIGH SCHOOL CAMPUS AT <TIME>.',1,'ferdie','2009-07-18 01:46:37','ferdie','2012-04-23 06:01:37'),(5,'<DATE> YOUR CHILD (<STUD_NAME>/ <STUD_NO>) LEFT THE HIGH SCHOOL CAMPUS AT <TIME>.',1,'ferdie','2009-07-18 01:47:00','ferdie','2012-04-23 06:01:44'),(6,'<DATE> YOUR CHILD (<STUD_NAME>/ <STUD_NO>) LEFT/ENTERED THE HIGH SCHOOL CAMPUS AT <TIME>.',1,'ferdie','2009-07-18 01:47:23','ferdie','2012-04-23 06:01:48');
/*!40000 ALTER TABLE `preset_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `privileges`
--

DROP TABLE IF EXISTS `privileges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `privileges` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `level` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `removed_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `removed_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `privileges`
--

LOCK TABLES `privileges` WRITE;
/*!40000 ALTER TABLE `privileges` DISABLE KEYS */;
INSERT INTO `privileges` VALUES (1,'Super Admin','super-admin','Super Admin Privilege',1,1,NULL,NULL,'2016-07-16 16:10:16','0000-00-00 00:00:00',NULL);
/*!40000 ALTER TABLE `privileges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `privileges_levels`
--

DROP TABLE IF EXISTS `privileges_levels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `privileges_levels` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `code` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `modules` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `removed_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `removed_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `privileges_levels`
--

LOCK TABLES `privileges_levels` WRITE;
/*!40000 ALTER TABLE `privileges_levels` DISABLE KEYS */;
INSERT INTO `privileges_levels` VALUES (1,'Level -1','super-admin-level','Super Admin Privilege Level','1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63',1,NULL,NULL,'2016-07-16 16:10:16','0000-00-00 00:00:00',NULL);
/*!40000 ALTER TABLE `privileges_levels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `scheduler`
--

DROP TABLE IF EXISTS `scheduler`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `scheduler` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `message` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `member_ids` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `group_ids` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `smsc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `msisdn` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `interval` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `send_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `removed_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `removed_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `scheduler`
--

LOCK TABLES `scheduler` WRITE;
/*!40000 ALTER TABLE `scheduler` DISABLE KEYS */;
INSERT INTO `scheduler` VALUES (1,'',NULL,NULL,'auto','09055420838','sent','','2016-07-17 06:10:00',1,NULL,NULL,'2016-07-16 22:00:38','2016-07-16 22:10:02',NULL),(2,'Schedules Message',NULL,NULL,'auto','09985382274','sent','','2016-07-17 06:12:00',1,NULL,NULL,'2016-07-16 22:11:22','2016-07-16 22:12:01',NULL),(3,'Schedules Message',NULL,NULL,'auto','09055420838','sent','','2016-07-17 06:12:00',1,NULL,NULL,'2016-07-16 22:11:22','2016-07-16 22:12:01',NULL);
/*!40000 ALTER TABLE `scheduler` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `templates`
--

DROP TABLE IF EXISTS `templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `templates` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `template` text NOT NULL,
  `activate` tinyint(1) NOT NULL DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `type` (`activate`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `templates`
--

LOCK TABLES `templates` WRITE;
/*!40000 ALTER TABLE `templates` DISABLE KEYS */;
INSERT INTO `templates` VALUES (1,'balance','Your outstanding balance is ::balance:: Pesos',1,'2008-11-15 18:09:29'),(2,'group_does_not_exist','Group \"::group::\" does not exist!',1,'2008-11-15 18:44:00'),(3,'group_send_ok','Finished sending message to ::group::',1,'2008-11-15 18:49:59'),(4,'help_group','Good news now you can broadcast a msg to ::group_name:: members in just one txt.just txt G,::group_name::,(your message)send 2 this no.P1 per txt',1,'2010-12-15 01:12:22'),(5,'help_vote','POLL,POLL CODE,(POLL OPTIONS)',1,'2010-06-16 22:34:54'),(6,'invalid','This is a Text Messaging System. you are using an Invalid Text Format.',1,'2010-06-01 10:09:07'),(7,'invalid_group','GroupCode ::group_name:: is not available. Please try again.Thank you!',1,'2009-12-28 17:25:31'),(8,'invalid_pattern','You use an invalid pattern.To register txt REG,(EMPNO),(FIRSTNAME),(LASTNAME),(MIDDLENAME),(GROUPCODE) ex: REG,2006141,JUAN,DELA CRUZ,B.,GROUPCODE send to ds no.',1,'2013-06-11 02:44:12'),(9,'member_exist','This number is already registered to ::group_name:: group. Thank you and enjoy this service.',1,'2009-12-28 07:17:25'),(10,'registration','WELCOME TO MCSLINE you are now registered to ::group_name:: group.Your no. is now officially registered to this service.update ur nickname txt NICK,yournickname',1,'2012-06-04 05:47:42'),(11,'stud_does_not_exist','Employee No. ::student_no:: does not exist!',1,'2013-08-31 16:44:59'),(12,'sender_id_does_not_exist','Sender ID \"::senderid::\" does not exist!',1,'2009-12-29 15:23:48'),(13,'vote_exsist','Pasensya na ikaw ay nakaboto na.',1,'2011-08-26 16:51:42'),(14,'thank_u_4voting','Maraming salamat sa pag boto ng \"::code::\".',1,'2011-08-26 16:51:17'),(15,'invalid_voting_pattern','Invalid  pattern. To vote\r\n(CODE, POLL_CODE, POLL_OPTION_CODE) and send to this no.txt HELP VOTE for more details.',1,'2009-12-30 03:49:45'),(16,'invalid_reply','Invalid  pattern. To reply\r\n<REP,SENDER_ID, Youre Message> and send to this no.ex:REP,17,Hello. FYI:SENDER_ID can be found beside the name of sender.Thank you!',1,'2009-12-30 03:29:25'),(17,'helprep',' To reply txt\r\n(REP,SENDER_ID, Youre Message) and send to this no.ex:REP,17,Hello. FYI:SENDER_ID can be found beside the name of sender.Thank you!',1,'2009-12-30 03:27:15'),(18,'success_nick_update','Your nickname \"::nick::\" has successfully updated.Thank you!.   ',1,'2009-12-30 05:21:39'),(19,'help','to register txt REG,EMPNO,FIRSTNAME,LASTNAME,MIDDLENAME,GROUP\r\n\r\nNOTE GROUPCODE: PSEMP,GSEMP,HSEMP',1,'2013-06-11 02:46:12'),(20,'fullypaid_notifs','Welcome to Marikina Catholic School, you are officially enrolled (date), this will be the school<92>s official mobile number. God Bless\r\n',1,'2010-06-13 04:53:42'),(21,'reboot','System is now restarting.',1,'2010-12-15 09:24:09'),(22,'restart_kannel','Kannel is now Restarting...',1,'2010-12-22 05:58:17'),(23,'accnt','::empname::, ::empno:: Your username/password  ::uname::/::pass:: ::server::',1,'2013-09-01 02:12:04');
/*!40000 ALTER TABLE `templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `types`
--

DROP TABLE IF EXISTS `types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `types` (
  `types_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `types_name` text COLLATE utf8_unicode_ci NOT NULL,
  `types_description` text COLLATE utf8_unicode_ci NOT NULL,
  `types_code` text COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `removed_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `removed_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`types_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `types`
--

LOCK TABLES `types` WRITE;
/*!40000 ALTER TABLE `types` DISABLE KEYS */;
INSERT INTO `types` VALUES (1,'Student','','student',NULL,NULL,NULL,'2016-07-16 20:23:23','0000-00-00 00:00:00',NULL),(2,'Employee','','employee',NULL,NULL,NULL,'2016-07-16 20:23:29','0000-00-00 00:00:00',NULL);
/*!40000 ALTER TABLE `types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uploads`
--

DROP TABLE IF EXISTS `uploads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uploads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `video_source` varchar(200) NOT NULL,
  `video_title` varchar(100) NOT NULL,
  `video_poster` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uploads`
--

LOCK TABLES `uploads` WRITE;
/*!40000 ALTER TABLE `uploads` DISABLE KEYS */;
INSERT INTO `uploads` VALUES (1,'assets/video/big_buck_bunny2.mp4','Video 1',''),(2,'assets/video/big_buck_bunny3.mp4','Video 2','');
/*!40000 ALTER TABLE `uploads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `middlename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` int(11) NOT NULL,
  `privilege` int(11) NOT NULL,
  `privilege_level` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `removed_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `removed_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','$2y$10$shMHEIM6WrjdchkShwq/DO2zdldiHU.w9oGFz6ijhW2T2gc80m05i','john.dionisio1@gmail.com','John Lioneil','Palanas','Dionisio',1,1,1,NULL,NULL,NULL,'2016-07-16 16:10:16','0000-00-00 00:00:00',NULL),(2,'foxtrot','$2y$10$F5gl5yAaOOxaXylE6KAvpOFihbYE1n.A8ABYBkqMYw0p1VAyCwv8e','ferdiesan060116@gmail.com','Ferdie','','Santiago',1,1,1,NULL,NULL,NULL,'2016-07-16 16:10:16','0000-00-00 00:00:00',NULL),(3,'tango','$2y$10$gBGV5Lq5bKEThhNtgSjWNueKLSMjFVUvoFEWpPPGv4eIuIjsDjKCy','amacalawi@gmail.com','Aliudin','','Macalawi',1,1,1,NULL,NULL,NULL,'2016-07-16 16:10:16','0000-00-00 00:00:00',NULL);
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

-- Dump completed on 2016-07-20 21:05:57
