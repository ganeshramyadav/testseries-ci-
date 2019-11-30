/*
SQLyog Ultimate v11.11 (32 bit)
MySQL - 5.5.5-10.1.29-MariaDB : Database - suraj_exam_main
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`suraj_exam_main` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `suraj_exam_main`;

/*Table structure for table `category` */

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `category` */

insert  into `category`(`id`,`name`,`created_at`,`updated_at`,`active`,`created_by`) values (1,'maths_new','2019-10-19 09:33:15','2019-11-18 12:30:33',1,1),(2,'computer',NULL,NULL,1,1),(3,'physics',NULL,NULL,1,1),(4,'hindi',NULL,NULL,1,1),(5,'english',NULL,NULL,1,1),(6,'net','2019-11-13 10:40:36','2019-11-13 15:10:36',0,1),(7,'general knowledge','2019-11-17 09:36:26','2019-11-17 14:06:26',1,1);

/*Table structure for table `ci_sessions` */

DROP TABLE IF EXISTS `ci_sessions`;

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ci_sessions` */

/*Table structure for table `exam` */

DROP TABLE IF EXISTS `exam`;

CREATE TABLE `exam` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `institute_id` int(11) DEFAULT NULL,
  `title` varchar(200) NOT NULL,
  `duration` int(11) DEFAULT NULL COMMENT 'mintes',
  `active` tinyint(1) DEFAULT '0',
  `category_id` int(11) DEFAULT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `no_of_question` int(11) DEFAULT NULL,
  `year` int(4) DEFAULT NULL,
  `image_url` text,
  `created_by` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `institute_id` (`institute_id`),
  KEY `created_by` (`created_by`),
  CONSTRAINT `exam_ibfk_1` FOREIGN KEY (`institute_id`) REFERENCES `institute` (`id`),
  CONSTRAINT `exam_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `exam` */

insert  into `exam`(`id`,`institute_id`,`title`,`duration`,`active`,`category_id`,`subcategory_id`,`no_of_question`,`year`,`image_url`,`created_by`,`created_at`,`updated_at`) values (1,13,'railway',30,1,1,1,4,2019,NULL,1,'2019-11-14 12:50:57',NULL),(2,13,'psc',35,1,2,2,6,2019,NULL,1,'2019-11-14 12:51:45','2019-11-18 17:11:04'),(8,13,'bank',5,1,3,3,5,2018,'assets/content/examination_image/8/42427e2446e0638c772d7f742258201c.jpg',1,'2019-11-29 18:11:28','2019-11-30 08:44:37');

/*Table structure for table `exam_category` */

DROP TABLE IF EXISTS `exam_category`;

CREATE TABLE `exam_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `active` tinyint(1) DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `exam_category` */

insert  into `exam_category`(`id`,`name`,`active`,`created_by`,`created_at`,`updated_at`) values (1,'railway',1,1,'2019-11-13 19:20:30','2019-11-18 12:32:40'),(2,'psc',1,1,'2019-11-13 19:21:02','2019-11-13 19:21:02'),(3,'bank',1,1,'2019-11-18 12:49:08','2019-11-18 17:19:08');

/*Table structure for table `exam_question` */

DROP TABLE IF EXISTS `exam_question`;

CREATE TABLE `exam_question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) DEFAULT NULL,
  `exam_id` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `institute_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `question_id` (`question_id`),
  KEY `exam_question_ibfk_1` (`exam_id`),
  KEY `institute_id` (`institute_id`),
  CONSTRAINT `exam_question_ibfk_1` FOREIGN KEY (`exam_id`) REFERENCES `exam` (`id`),
  CONSTRAINT `exam_question_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`),
  CONSTRAINT `exam_question_ibfk_3` FOREIGN KEY (`institute_id`) REFERENCES `institute` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

/*Data for the table `exam_question` */

insert  into `exam_question`(`id`,`question_id`,`exam_id`,`active`,`created_at`,`updated_at`,`institute_id`) values (1,16,1,1,'2019-11-14 23:46:43',NULL,1),(20,15,1,1,'2019-11-16 23:56:51','2019-11-16 23:56:51',1),(44,27,2,1,'2019-11-24 10:50:11','2019-11-24 15:20:11',1),(45,26,2,1,'2019-11-24 10:51:27','2019-11-24 15:21:27',1),(46,25,2,1,'2019-11-24 10:51:33','2019-11-24 15:21:33',1),(47,24,2,1,'2019-11-24 10:52:41','2019-11-24 15:22:41',1);

/*Table structure for table `exam_subcategory` */

DROP TABLE IF EXISTS `exam_subcategory`;

CREATE TABLE `exam_subcategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `exam_subcategory` */

insert  into `exam_subcategory`(`id`,`name`,`category_id`,`active`,`created_by`,`created_at`,`updated_at`) values (1,'railway',1,1,1,'2019-11-14 12:53:11','2019-11-18 12:32:49'),(2,'psc',2,1,1,'2019-11-14 12:53:19','2019-11-14 12:53:19'),(3,'bankpo',3,1,1,'2019-11-18 12:50:00','2019-11-18 17:20:00');

/*Table structure for table `favorite` */

DROP TABLE IF EXISTS `favorite`;

CREATE TABLE `favorite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `favorite` */

insert  into `favorite`(`id`,`user_id`,`product_id`,`created_at`,`updated_at`,`name`) values (1,1,1,'2019-11-06 19:56:07','2019-11-06 19:56:07',NULL),(2,1,2,'2019-11-06 19:56:11','2019-11-06 19:56:11',NULL),(10,1,32,'2019-11-06 19:58:07','2019-11-06 19:58:07',NULL),(12,1,9,'2019-11-07 00:22:00','2019-11-07 00:22:00',NULL);

/*Table structure for table `institute` */

DROP TABLE IF EXISTS `institute`;

CREATE TABLE `institute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `gstn` varchar(100) DEFAULT NULL,
  `mobile` varchar(10) NOT NULL,
  `address_line_1` varchar(100) DEFAULT NULL,
  `address_line_2` varchar(100) DEFAULT NULL,
  `address_city` varchar(100) DEFAULT NULL,
  `address_state` varchar(100) DEFAULT NULL,
  `address_country` varchar(100) DEFAULT NULL,
  `address_pincode` varchar(100) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `institute_id_IDX` (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

/*Data for the table `institute` */

insert  into `institute`(`id`,`user_id`,`name`,`email`,`gstn`,`mobile`,`address_line_1`,`address_line_2`,`address_city`,`address_state`,`address_country`,`address_pincode`,`status`) values (1,0,'BhilaiClube','',NULL,'','bhilai','bhilai','bhilai','Chhattisgarh','India','490006',1),(2,0,'Bhilai','',NULL,'','Bhiali','Bhilai','Bhilai','Chhattisgarh','India','490004',1),(13,14,'ganesh','jony@gmail.com','dsfdf5462','8888888888','bhilai',NULL,NULL,NULL,NULL,NULL,1),(14,15,'dddddd','abc_office@abc.com','dsfsdfd5412df','8888888888','dsdddddddd',NULL,NULL,NULL,NULL,NULL,1);

/*Table structure for table `institute_subscription` */

DROP TABLE IF EXISTS `institute_subscription`;

CREATE TABLE `institute_subscription` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `subscription_id` int(11) DEFAULT NULL,
  `advanced_credit_limit` int(11) DEFAULT '0',
  `institute_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `institute_subscription_FK_1` (`subscription_id`),
  CONSTRAINT `institue_duration_FK` FOREIGN KEY (`id`) REFERENCES `institute` (`id`),
  CONSTRAINT `institue_duration_FK_1` FOREIGN KEY (`subscription_id`) REFERENCES `subscription` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `institute_subscription` */

/*Table structure for table `order_items` */

DROP TABLE IF EXISTS `order_items`;

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `institute_id` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_items_FK` (`product_id`),
  KEY `order_items_FK_1` (`order_id`),
  CONSTRAINT `order_items_FK` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `order_items_FK_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

/*Data for the table `order_items` */

insert  into `order_items`(`id`,`order_id`,`product_id`,`active`,`institute_id`,`price`) values (30,7,13,NULL,2,0),(31,7,7,NULL,2,200),(32,7,1,NULL,1,100),(33,7,7,NULL,2,200),(34,7,1,NULL,1,100),(35,7,1,NULL,1,100),(36,7,1,NULL,1,100),(37,7,1,NULL,1,100),(38,7,1,NULL,1,100),(39,7,1,NULL,1,100),(40,7,1,NULL,1,100),(41,7,1,NULL,1,100);

/*Table structure for table `orders` */

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `order_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `amount` double DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '0 -> cancelled , 1 =>created',
  `discount_amount` double DEFAULT NULL,
  `promotion_code` varchar(100) DEFAULT NULL,
  `tax` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_FK` (`user_id`),
  CONSTRAINT `orders_FK` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `orders` */

insert  into `orders`(`id`,`user_id`,`order_date`,`amount`,`status`,`discount_amount`,`promotion_code`,`tax`) values (7,1,'2019-11-02 09:37:43',1300,1,0,'',0),(8,1,'2019-11-03 13:37:50',0,1,0,'',0);

/*Table structure for table `payment` */

DROP TABLE IF EXISTS `payment`;

CREATE TABLE `payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `amount` double DEFAULT NULL,
  `created_at` date NOT NULL,
  `payment_date` date DEFAULT NULL,
  `transaction_id` varchar(100) DEFAULT NULL,
  `payment_status` varchar(100) DEFAULT NULL,
  `institute_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payment_FK` (`institute_id`),
  KEY `payment_FK_1` (`user_id`),
  KEY `payment_FK_2` (`order_id`),
  CONSTRAINT `payment_FK` FOREIGN KEY (`institute_id`) REFERENCES `institute` (`id`),
  CONSTRAINT `payment_FK_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `payment_FK_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payment` */

/*Table structure for table `product` */

DROP TABLE IF EXISTS `product`;

CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `url` text,
  `isPublic` tinyint(1) DEFAULT '0',
  `price` double DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) DEFAULT NULL,
  `study_material` tinyint(1) DEFAULT '0',
  `video` tinyint(1) DEFAULT '0',
  `current_affairs` tinyint(1) DEFAULT '0',
  `year` varchar(100) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `institute_id` int(11) NOT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `description` text,
  `image_url` text,
  PRIMARY KEY (`id`),
  KEY `product_FK` (`category_id`),
  KEY `product_FK_1` (`subcategory_id`),
  KEY `product_FK_2` (`institute_id`),
  CONSTRAINT `product_FK` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  CONSTRAINT `product_FK_1` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategory` (`id`),
  CONSTRAINT `product_FK_2` FOREIGN KEY (`institute_id`) REFERENCES `institute` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

/*Data for the table `product` */

insert  into `product`(`id`,`name`,`url`,`isPublic`,`price`,`created_at`,`updated_at`,`active`,`study_material`,`video`,`current_affairs`,`year`,`category_id`,`subcategory_id`,`institute_id`,`createdBy`,`description`,`image_url`) values (1,'aaaaaaa_new','http://localhost/apis/codeigniter/suraj_exam/assets/content/studymaterial/institute/1/89c6d567d43c6318f4f4bcc8af4bc96c.pdf',1,100,'2019-10-19 00:00:00','2019-10-23 11:02:52',1,1,0,0,'2019',1,1,1,1,'ddddddddddddddddddnew',NULL),(2,'fffffff','http://localhost/apis/codeigniter/suraj_exam/assets/content/studymaterial/institute/2/26bcfd0a72d4f5dcf2d0d7c11bcee6b6.pdf',1,200,'2019-10-21 15:43:10','2019-10-23 11:15:30',1,1,0,0,'2014',1,1,2,1,NULL,NULL),(5,'fffffff','http://localhost/apis/codeigniter/suraj_exam/assets/content/studymaterial/institute/5/d2fb8373f0fd0eee1e98da3e0debc422.pdf',1,200,'2019-10-21 17:07:51','2019-10-23 11:16:16',1,1,0,0,'2014',1,1,2,1,NULL,NULL),(6,'fffffff','http://localhost/apis/codeigniter/suraj_exam/assets/content/studymaterial/institute/6/9d0decf63c9cd1eee5a74d1708453186.pdf',1,200,'2019-10-21 17:09:08','2019-10-21 13:39:08',1,1,0,0,'2014',1,1,2,1,NULL,NULL),(7,'fffffff','http://localhost/apis/codeigniter/suraj_exam/assets/content/studymaterial/institute/7/9d0decf63c9cd1eee5a74d1708453186.pdf',1,200,'2019-10-21 17:10:01','2019-10-21 13:40:01',1,1,0,0,'2014',1,1,2,1,NULL,NULL),(8,'dddddddddd','http://localhost/apis/codeigniter/suraj_exam/assets/content/currentaffairs/public/8/9d0decf63c9cd1eee5a74d1708453186.pdf',0,0,'2019-10-21 17:52:35','2019-10-21 14:22:35',1,0,0,1,'2015',1,1,2,1,NULL,NULL),(9,'dfsdfsdfsd','http://localhost/apis/codeigniter/suraj_exam/assets/content/studymaterial/public/9/9d0decf63c9cd1eee5a74d1708453186.pdf',0,0,'2019-10-21 18:57:12','2019-10-21 15:27:12',1,1,0,0,'2015',1,2,2,1,NULL,NULL),(10,'dfdfdfdfdf','http://localhost/apis/codeigniter/suraj_exam/assets/content/currentaffairs/public/10/335a23de354396b21d8caa318ee7dad3.pdf',0,0,'2019-10-21 19:26:54','2019-10-21 15:56:54',0,0,0,1,'2016',1,1,1,1,NULL,NULL),(13,'videos','http://localhost/apis/codeigniter/suraj_exam/assets/content/video/public/13/70e6ea1a9a4c28bd15c95244e99653fb.wmv',1,0,'2019-10-24 01:18:29','2019-11-06 12:11:01',1,0,1,0,'2222',2,8,2,1,'ddddddddddddddddddd','assets/content/video/institute/13/thumb_131.png'),(14,'ganesh_study_material','http://localhost/apis/codeigniter/suraj_exam/assets/content/studymaterial/public/14/1a2cd7fcb668ae31bfc3b27709319397.pdf',0,0,'2019-10-25 00:21:51','2019-10-24 20:51:52',1,1,0,0,'2018',2,8,13,14,NULL,NULL),(15,'maths','http://localhost/apis/codeigniter/suraj_exam/assets/content/video/public/15/45d2e51aba69df59e4f5a16bba7cd8ec.wmv',0,0,'2019-11-06 16:55:58','2019-11-06 12:25:59',1,0,1,0,'2019',1,3,2,1,NULL,NULL),(30,'computer','http://localhost/apis/codeigniter/suraj_exam/assets/content/video/public/30/c38d5d0806aa94c62747ba8315b0578d.mp4',0,0,'2019-11-06 17:20:19','2019-11-06 12:50:19',1,0,1,0,'2018',2,8,13,1,'dfdsfsdf','assets/content/video/public/30/02a133f0c78f36f0326dd396009a2241.jpg'),(31,'computer','http://localhost/apis/codeigniter/suraj_exam/assets/content/video/public/31/e673e30add1ed330ab93c4a1fdc495f7.mp4',0,0,'2019-11-06 17:28:35','2019-11-06 12:58:35',1,0,1,0,'2018',2,8,13,1,'dfdsfsdf','assets/content/video/public/31/4f0c82644419f6979da0d8ff1ca2d9b1.jpg'),(32,'computer','assets/content/video/public/32/6d6499d2fe87a58e7ed64ea487c7c51e.mp4',0,0,'2019-11-06 17:31:43','2019-11-06 13:01:43',1,0,1,0,'2018',2,8,13,1,'dfdsfsdf','assets/content/video/public/32/780a1045e0ee734cd94b853209a2c2d7.jpg');

/*Table structure for table `questions` */

DROP TABLE IF EXISTS `questions`;

CREATE TABLE `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` text,
  `answers` text,
  `correct_answer` text,
  `desc` text,
  `category_id` int(11) DEFAULT NULL,
  `sub_category_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `questions_FK` (`category_id`),
  KEY `questions_FK_1` (`sub_category_id`),
  KEY `questions_FK_2` (`created_by`),
  CONSTRAINT `questions_FK` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  CONSTRAINT `questions_FK_1` FOREIGN KEY (`sub_category_id`) REFERENCES `subcategory` (`id`),
  CONSTRAINT `questions_FK_2` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

/*Data for the table `questions` */

insert  into `questions`(`id`,`question`,`answers`,`correct_answer`,`desc`,`category_id`,`sub_category_id`,`created_by`,`created_at`) values (7,'<p><img src=\"https://www.basic-mathematics.com/images/adding-fractions-formula.gif\" style=\"margin:0px; width:293px\" /></p>\r\n\r\n<p>sdfsdf</p>\r\n\r\n<p>sdf</p>\r\n\r\n<p>sdfdsfsd sdf df sdf sdfsd&nbsp;</p>\r\n','{\"option_1\":\"<p><img src=\\\"https:\\/\\/www.basic-mathematics.com\\/images\\/adding-fractions-formula.gif\\\" xss=removed><\\/p>\\r\\n\",\"option_2\":\"<p><img src=\\\"https:\\/\\/www.basic-mathematics.com\\/images\\/adding-fractions-formula.gif\\\" xss=removed><\\/p>\\r\\n\",\"option_3\":\"<p><img src=\\\"https:\\/\\/www.basic-mathematics.com\\/images\\/adding-fractions-formula.gif\\\" xss=removed><\\/p>\\r\\n\",\"option_4\":\"<p><img src=\\\"https:\\/\\/www.basic-mathematics.com\\/images\\/adding-fractions-formula.gif\\\" xss=removed><\\/p>\\r\\n\",\"correct_answer\":\"option_4\"}',NULL,'<p><img src=\"https://www.basic-mathematics.com/images/adding-fractions-formula.gif\" xss=removed></p>\r\n',1,1,1,'2019-11-08 19:41:17'),(8,'<p><img src=\"https://www.basic-mathematics.com/images/adding-fractions-formula.gif\" style=\"margin:0px; width:293px\" /></p>\r\n\r\n<p>sdfsdf</p>\r\n\r\n<p>sdf</p>\r\n\r\n<p>sdfdsfsd sdf df sdf sdfsd&nbsp;</p>\r\n','{\"option_1\":\"<p><img src=\\\"https:\\/\\/www.basic-mathematics.com\\/images\\/adding-fractions-formula.gif\\\" xss=removed><\\/p>\\r\\n\",\"option_2\":\"<p><img src=\\\"https:\\/\\/www.basic-mathematics.com\\/images\\/adding-fractions-formula.gif\\\" xss=removed><\\/p>\\r\\n\",\"option_3\":\"<p><img src=\\\"https:\\/\\/www.basic-mathematics.com\\/images\\/adding-fractions-formula.gif\\\" xss=removed><\\/p>\\r\\n\",\"option_4\":\"<p><img src=\\\"https:\\/\\/www.basic-mathematics.com\\/images\\/adding-fractions-formula.gif\\\" xss=removed><\\/p>\\r\\n\",\"correct_answer\":\"option_4\"}',NULL,'<p><img src=\"https://www.basic-mathematics.com/images/adding-fractions-formula.gif\" xss=removed></p>\r\n',1,1,1,'2019-11-08 19:41:17'),(11,'<p><img src=\"https://www.basic-mathematics.com/images/adding-fractions-formula.gif\" style=\"margin:0px; width:293px\" /></p>\r\n\r\n<p>sdfsdf</p>\r\n\r\n<p>sdf</p>\r\n\r\n<p>sdfdsfsd sdf df sdf sdfsd&nbsp;</p>\r\n','{\"option_1\":\"<p><img src=\\\"https:\\/\\/www.basic-mathematics.com\\/images\\/adding-fractions-formula.gif\\\" xss=removed><\\/p>\\r\\n\",\"option_2\":\"<p><img src=\\\"https:\\/\\/www.basic-mathematics.com\\/images\\/adding-fractions-formula.gif\\\" xss=removed><\\/p>\\r\\n\",\"option_3\":\"<p><img src=\\\"https:\\/\\/www.basic-mathematics.com\\/images\\/adding-fractions-formula.gif\\\" xss=removed><\\/p>\\r\\n\",\"option_4\":\"<p><img src=\\\"https:\\/\\/www.basic-mathematics.com\\/images\\/adding-fractions-formula.gif\\\" xss=removed><\\/p>\\r\\n\",\"correct_answer\":\"option_4\"}',NULL,'<p><img src=\"https://www.basic-mathematics.com/images/adding-fractions-formula.gif\" xss=removed></p>\r\n',1,1,1,'2019-11-08 19:41:17'),(15,'<p><img src=\"https://www.basic-mathematics.com/images/adding-fractions-formula.gif\" style=\"margin:0px; width:293px\" /></p>\r\n\r\n<p>sdfsdf</p>\r\n\r\n<p>sdf</p>\r\n\r\n<p>sdfdsfsd sdf df sdf sdfsd&nbsp;</p>\r\n','{\"option_1\":\"<p><img src=\\\"https:\\/\\/www.basic-mathematics.com\\/images\\/adding-fractions-formula.gif\\\" xss=removed><\\/p>\\r\\n\",\"option_2\":\"<p><img src=\\\"https:\\/\\/www.basic-mathematics.com\\/images\\/adding-fractions-formula.gif\\\" xss=removed><\\/p>\\r\\n\",\"option_3\":\"<p><img src=\\\"https:\\/\\/www.basic-mathematics.com\\/images\\/adding-fractions-formula.gif\\\" xss=removed><\\/p>\\r\\n\",\"option_4\":\"<p><img src=\\\"https:\\/\\/www.basic-mathematics.com\\/images\\/adding-fractions-formula.gif\\\" xss=removed><\\/p>\\r\\n\",\"correct_answer\":\"option_4\"}',NULL,'<p><img src=\"https://www.basic-mathematics.com/images/adding-fractions-formula.gif\" xss=removed></p>\r\n',1,1,1,'2019-11-08 19:41:17'),(16,'<p><img src=\"https://www.basic-mathematics.com/images/adding-fractions-formula.gif\" style=\"margin:0px; width:293px\" /></p>\r\n\r\n<p>sdfsdf</p>\r\n\r\n<p>sdf</p>\r\n\r\n<p>sdfdsfsd sdf df sdf sdfsd&nbsp;</p>\r\n','{\"option_1\":\"<p><img src=\\\"https:\\/\\/www.basic-mathematics.com\\/images\\/adding-fractions-formula.gif\\\" xss=removed><\\/p>\\r\\n\",\"option_2\":\"<p><img src=\\\"https:\\/\\/www.basic-mathematics.com\\/images\\/adding-fractions-formula.gif\\\" xss=removed><\\/p>\\r\\n\",\"option_3\":\"<p><img src=\\\"https:\\/\\/www.basic-mathematics.com\\/images\\/adding-fractions-formula.gif\\\" xss=removed><\\/p>\\r\\n\",\"option_4\":\"<p><img src=\\\"https:\\/\\/www.basic-mathematics.com\\/images\\/adding-fractions-formula.gif\\\" xss=removed><\\/p>\\r\\n\",\"correct_answer\":\"option_4\"}',NULL,'<p><img src=\"https://www.basic-mathematics.com/images/adding-fractions-formula.gif\" xss=removed></p>\r\n',1,1,1,'2019-11-08 19:41:17'),(17,'<p>Who has been appointed as the new chairman of Central Board of Indirect taxes and Customs (CBIC)?</p>\r\n','{\"option_1\":\"<p>Johnjoseph<\\/p>\\r\\n\",\"option_2\":\"<p>VanajaN.Sarna<\\/p>\\r\\n\",\"option_3\":\"<p>MahenderSingh<\\/p>\\r\\n\",\"option_4\":\"<p>S Ramesh<\\/p>\\r\\n\",\"correct_answer\":\"option_4\"}',NULL,'',7,18,1,'2019-11-17 09:39:11'),(18,'<p>Who has been appointed as the acting Chairman of the Union Public Service Commission (UPSC)?</p>\r\n','{\"option_1\":\"<p>ArvindSaxena<\\/p>\\r\\n\",\"option_2\":\"<p>SudhaJain<\\/p>\\r\\n\",\"option_3\":\"<p>KirtiKumar<\\/p>\\r\\n\",\"option_4\":\"<p>Omi Agrawal<\\/p>\\r\\n\",\"correct_answer\":\"option_1\"}',NULL,'',7,18,1,'2019-11-17 09:40:16'),(19,'<p>Pappu Karki, the popular Kumaoni folk singer has passed away. He was native of which state?</p>\r\n','{\"option_1\":\"<p>Jammu&Kashmir<\\/p>\\r\\n\\r\\n<p>\\u00a0<\\/p>\\r\\n\",\"option_2\":\"<p>HimachalPradesh<\\/p>\\r\\n\\r\\n<p>\\u00a0<\\/p>\\r\\n\",\"option_3\":\"<p>Uttarakhand<\\/p>\\r\\n\\r\\n<p>\\u00a0<\\/p>\\r\\n\",\"option_4\":\"<p>Assam<\\/p>\\r\\n\\r\\n<p>\\u00a0<\\/p>\\r\\n\\r\\n<p>\\u00a0<\\/p>\\r\\n\",\"correct_answer\":\"option_3\"}',NULL,'',7,18,1,'2019-11-17 09:41:15'),(20,'<p>India&rsquo;s first-ever national police museum will establish in which city?</p>\r\n','{\"option_1\":\"<p>Chennai<\\/p>\\r\\n\",\"option_2\":\"<p>Delhi<\\/p>\\r\\n\",\"option_3\":\"<p>Nagpur<\\/p>\\r\\n\",\"option_4\":\"<p>Kolkata<\\/p>\\r\\n\",\"correct_answer\":\"option_2\"}',NULL,'',7,18,1,'2019-11-17 09:42:52'),(21,'<p>The Central Vigilance Commission (CVC) is in news for appointing Sharad Kumar as new Vigilance Commissioner. As per which committee&rsquo;s recommendations, the CVC was set up?</p>\r\n','{\"option_1\":\"<p>NittoorSrinivasaRaucommiittee<\\/p>\\r\\n\",\"option_2\":\"<p>TejendraMohanBhasincommiittee<\\/p>\\r\\n\",\"option_3\":\"<p>KVChowdarycommiittee<\\/p>\\r\\n\",\"option_4\":\"<p>K Santhanam commiittee<\\/p>\\r\\n\",\"correct_answer\":\"option_4\"}',NULL,'',7,18,1,'2019-11-17 09:43:45'),(22,'<p>Which country will host the 45th G7 summit 2019?</p>\r\n','{\"option_1\":\"<p>Italy<\\/p>\\r\\n\",\"option_2\":\"<p>Germany<\\/p>\\r\\n\",\"option_3\":\"<p>France<\\/p>\\r\\n\",\"option_4\":\"<p>Canada<\\/p>\\r\\n\",\"correct_answer\":\"option_3\"}',NULL,'',7,18,1,'2019-11-17 09:44:55'),(23,'<p>Which country&rsquo;s women cricket team has clinched the Asia Cup Twenty-20 tournament 2018?</p>\r\n','{\"option_1\":\"<p>SouthKorea<\\/p>\\r\\n\",\"option_2\":\"<p>Bangladesh<\\/p>\\r\\n\",\"option_3\":\"<p>India<\\/p>\\r\\n\",\"option_4\":\"<p>Pakistan<\\/p>\\r\\n\",\"correct_answer\":\"option_2\"}',NULL,'',7,18,1,'2019-11-17 09:46:14'),(24,'<p>Who has won the men&rsquo;s singles French Open tennis tournament 2018?</p>\r\n','{\"option_1\":\"<p>NovakDjokovic<\\/p>\\r\\n\",\"option_2\":\"<p>DominicThiem<\\/p>\\r\\n\",\"option_3\":\"<p>RogerFederer<\\/p>\\r\\n\",\"option_4\":\"<p>Rafael Nadal<\\/p>\\r\\n\",\"correct_answer\":\"option_4\"}',NULL,'',7,18,1,'2019-11-17 09:47:23'),(25,'<p>Which country&rsquo;s football team has lifted the 2018 Intercontinental Cup football title?</p>\r\n','{\"option_1\":\"<p>India<\\/p>\\r\\n\",\"option_2\":\"<p>SriLanka<\\/p>\\r\\n\",\"option_3\":\"<p>Kenya<\\/p>\\r\\n\",\"option_4\":\"<p>Argentina<\\/p>\\r\\n\",\"correct_answer\":\"option_1\"}',NULL,'',7,18,1,'2019-11-17 09:48:13'),(26,'<p>Shantaram Laxman Naik, who passed away recently, was the former Congress chief of which state?</p>\r\n','{\"option_1\":\"<p>Maharashtra<\\/p>\\r\\n\",\"option_2\":\"<p>Goa<\\/p>\\r\\n\",\"option_3\":\"<p>Bihar<\\/p>\\r\\n\",\"option_4\":\"<p>Karnataka<\\/p>\\r\\n\",\"correct_answer\":\"option_2\"}',NULL,'',7,18,1,'2019-11-17 09:49:04'),(27,'<p>Shantaram Laxman Naik, who passed away recently, was the former Congress chief of which state?</p>\r\n','{\"option_1\":\"<p>Maharashtra<\\/p>\\r\\n\",\"option_2\":\"<p>Goa<\\/p>\\r\\n\",\"option_3\":\"<p>Bihar<\\/p>\\r\\n\",\"option_4\":\"<p>Karnataka<\\/p>\\r\\n\",\"correct_answer\":\"option_2\"}',NULL,'',7,18,1,'2019-11-17 09:49:04');

/*Table structure for table `shopping_cart` */

DROP TABLE IF EXISTS `shopping_cart`;

CREATE TABLE `shopping_cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `shopping_cart_FK_1` (`product_id`),
  KEY `shopping_cart_FK` (`user_id`),
  CONSTRAINT `shopping_cart_FK` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `shopping_cart_FK_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `shopping_cart` */

insert  into `shopping_cart`(`id`,`name`,`user_id`,`product_id`,`created_at`,`updated_at`) values (1,'fffffff',1,2,'2019-11-06 22:55:34','2019-11-06 22:55:34'),(2,'fffffff',1,5,'2019-11-06 22:55:38','2019-11-06 22:55:38'),(3,'fffffff',1,6,'2019-11-06 22:55:41','2019-11-06 22:55:41'),(4,'null',1,1,'2019-11-06 23:53:38','2019-11-06 23:53:38'),(5,'videos',1,13,'2019-11-07 15:22:29','2019-11-07 15:22:29');

/*Table structure for table `subcategory` */

DROP TABLE IF EXISTS `subcategory`;

CREATE TABLE `subcategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `active` tinyint(1) DEFAULT '0',
  `category_id` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subcategory_FK` (`category_id`),
  CONSTRAINT `subcategory_FK` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

/*Data for the table `subcategory` */

insert  into `subcategory`(`id`,`name`,`created_at`,`updated_at`,`active`,`category_id`,`created_by`) values (1,'a',NULL,'2019-11-18 12:29:56',1,1,1),(2,'b',NULL,NULL,1,1,NULL),(3,'c',NULL,NULL,1,1,NULL),(4,'d',NULL,NULL,1,1,NULL),(5,'e',NULL,NULL,1,1,NULL),(7,'f',NULL,NULL,1,2,NULL),(8,'g',NULL,NULL,1,2,NULL),(9,'physics_new',NULL,'2019-11-13 09:19:21',1,3,1),(10,'i',NULL,NULL,1,2,NULL),(11,'j',NULL,NULL,1,3,NULL),(12,'k',NULL,NULL,1,3,NULL),(13,'l',NULL,NULL,1,4,NULL),(14,'m',NULL,NULL,1,4,NULL),(15,'n',NULL,NULL,1,5,NULL),(16,'o',NULL,NULL,1,5,NULL),(17,'jon_phy','2019-11-13 10:40:09',NULL,0,3,1),(18,'general awareness gk','2019-11-17 09:37:39',NULL,1,7,1);

/*Table structure for table `subscription` */

DROP TABLE IF EXISTS `subscription`;

CREATE TABLE `subscription` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `no_of_days` int(11) NOT NULL,
  `credit_limit` int(11) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `subscription` */

insert  into `subscription`(`id`,`name`,`no_of_days`,`credit_limit`,`active`) values (1,'free',10,NULL,1),(2,'silver',30,NULL,1),(3,'gold',40,NULL,1),(4,'premium',60,NULL,1);

/*Table structure for table `tbl_last_login` */

DROP TABLE IF EXISTS `tbl_last_login`;

CREATE TABLE `tbl_last_login` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `userId` bigint(20) NOT NULL,
  `sessionData` varchar(2048) NOT NULL,
  `machineIp` varchar(1024) NOT NULL,
  `userAgent` varchar(128) NOT NULL,
  `agentString` varchar(1024) NOT NULL,
  `platform` varchar(128) NOT NULL,
  `createdDtm` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_last_login` */

insert  into `tbl_last_login`(`id`,`userId`,`sessionData`,`machineIp`,`userAgent`,`agentString`,`platform`,`createdDtm`) values (28,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-10-24 14:00:06'),(29,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-10-24 14:00:48'),(31,14,'{\"role\":\"2\",\"roleText\":\"Institute\",\"name\":\" \",\"instId\":\"13\",\"gstn\":\"dsfdf5462\",\"instEmail\":\"jony@gmail.com\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-10-24 16:51:09'),(32,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-10-24 17:44:54'),(33,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-10-24 17:50:23'),(34,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-10-24 17:50:27'),(35,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-10-24 22:22:04'),(36,14,'{\"role\":\"2\",\"roleText\":\"Institute\",\"name\":\" \"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-10-24 23:33:33'),(37,14,'{\"role\":\"2\",\"roleText\":\"Institute\",\"name\":\" \"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-10-24 23:45:35'),(38,14,'{\"role\":\"2\",\"roleText\":\"Institute\",\"name\":\" \",\"instId\":\"13\",\"gstn\":\"dsfdf5462\",\"instEmail\":\"jony@gmail.com\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-10-24 23:54:41'),(39,14,'{\"role\":\"2\",\"roleText\":\"Institute\",\"name\":\" \",\"instId\":\"13\",\"gstn\":\"dsfdf5462\",\"instEmail\":\"jony@gmail.com\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-10-25 00:46:49'),(40,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-10-25 21:22:59'),(41,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-10-26 16:44:23'),(42,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-10-26 20:16:33'),(43,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-10-26 20:16:41'),(44,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-10-27 16:17:09'),(45,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-10-27 17:37:25'),(46,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-10-29 15:36:19'),(47,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-10-31 14:47:56'),(48,15,'{\"role\":\"2\",\"roleText\":\"Institute\",\"name\":\" \",\"instId\":\"14\",\"gstn\":\"dsfsdfd5412df\",\"instEmail\":\"abc_office@abc.com\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-10-31 15:36:54'),(49,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-10-31 20:52:41'),(50,14,'{\"role\":\"2\",\"roleText\":\"Institute\",\"name\":\" \",\"instId\":\"13\",\"gstn\":\"dsfdf5462\",\"instEmail\":\"jony@gmail.com\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-10-31 21:44:06'),(51,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-01 12:38:23'),(52,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-01 20:01:23'),(53,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-01 22:25:05'),(54,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-02 08:52:20'),(55,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-03 10:43:32'),(56,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-03 12:56:31'),(57,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-03 15:02:42'),(58,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-04 13:15:06'),(59,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-04 15:37:17'),(60,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-04 18:35:46'),(61,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-05 13:10:13'),(62,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-05 20:21:47'),(63,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-06 16:34:05'),(64,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-06 19:58:23'),(65,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-06 22:45:52'),(66,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-07 14:26:07'),(67,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-08 12:14:53'),(68,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-08 15:38:02'),(69,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-08 20:11:33'),(70,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-08 21:28:36'),(71,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-09 13:10:17'),(72,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-09 19:15:25'),(73,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-09 22:30:53'),(74,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-10 13:38:21'),(75,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-10 19:12:19'),(76,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-11 18:36:44'),(77,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-12 18:49:36'),(78,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-12 23:23:47'),(79,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-13 13:08:20'),(80,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-13 18:55:32'),(81,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-14 22:10:39'),(82,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-15 14:36:30'),(83,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-15 16:23:23'),(84,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-15 20:02:25'),(85,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-15 22:03:59'),(86,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-16 13:12:47'),(87,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-16 13:50:51'),(88,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-16 17:02:17'),(89,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-16 19:09:00'),(90,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-16 19:20:43'),(91,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-16 19:20:51'),(92,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-16 22:12:58'),(93,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-17 12:33:11'),(94,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-17 16:21:23'),(95,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-17 20:13:28'),(96,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-17 21:55:07'),(97,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-18 13:46:08'),(98,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-19 12:51:59'),(99,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-20 12:35:40'),(100,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-20 20:02:04'),(101,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-21 13:15:01'),(102,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-21 13:15:03'),(103,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-21 17:10:04'),(104,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-21 23:07:53'),(105,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-22 12:09:28'),(106,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-22 12:09:28'),(107,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-22 12:09:39'),(108,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-22 22:10:02'),(109,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-23 13:50:31'),(110,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-24 12:34:38'),(111,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-24 17:38:30'),(112,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-24 23:00:32'),(113,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-25 17:29:20'),(114,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-26 13:01:09'),(115,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-26 22:18:10'),(116,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-27 13:49:26'),(117,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-27 19:51:42'),(118,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-28 21:46:00'),(119,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 77.0.3865.120','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','Windows 7','2019-11-29 16:56:01'),(120,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 78.0.3904.108','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36','Windows 7','2019-11-29 17:49:54'),(121,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 78.0.3904.108','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36','Windows 7','2019-11-29 19:22:06'),(122,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 78.0.3904.108','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36','Windows 7','2019-11-29 23:02:31'),(123,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 78.0.3904.108','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36','Windows 7','2019-11-30 12:41:12'),(124,1,'{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"admin admin\"}','::1','Chrome 78.0.3904.108','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36','Windows 7','2019-11-30 15:46:45');

/*Table structure for table `tbl_reset_password` */

DROP TABLE IF EXISTS `tbl_reset_password`;

CREATE TABLE `tbl_reset_password` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `email` varchar(128) NOT NULL,
  `activation_id` varchar(32) NOT NULL,
  `agent` varchar(512) NOT NULL,
  `client_ip` varchar(32) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `createdBy` bigint(20) NOT NULL DEFAULT '1',
  `createdDtm` datetime NOT NULL,
  `updatedBy` bigint(20) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_reset_password` */

insert  into `tbl_reset_password`(`id`,`email`,`activation_id`,`agent`,`client_ip`,`isDeleted`,`createdBy`,`createdDtm`,`updatedBy`,`updatedDtm`) values (1,'admin@example.com','B98RbsqcizxZe0C','Chrome 76.0.3809.132','::1',0,1,'2019-09-24 11:50:01',NULL,NULL),(2,'admin@example.com','IorPLRZXU4qvkAl','Chrome 76.0.3809.132','::1',0,1,'2019-09-24 11:50:18',NULL,NULL);

/*Table structure for table `tbl_roles` */

DROP TABLE IF EXISTS `tbl_roles`;

CREATE TABLE `tbl_roles` (
  `roleId` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'role id',
  `role` varchar(50) NOT NULL COMMENT 'role text',
  PRIMARY KEY (`roleId`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_roles` */

insert  into `tbl_roles`(`roleId`,`role`) values (1,'System Administrator'),(2,'Institute'),(3,'Students');

/*Table structure for table `test_exam` */

DROP TABLE IF EXISTS `test_exam`;

CREATE TABLE `test_exam` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exam_id` int(11) DEFAULT NULL,
  `test_series_id` int(11) DEFAULT NULL,
  `institute_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `exam_id` (`exam_id`),
  KEY `test_series_id` (`test_series_id`),
  KEY `institute_id` (`institute_id`),
  CONSTRAINT `Test_exam_FK` FOREIGN KEY (`exam_id`) REFERENCES `exam` (`id`),
  CONSTRAINT `Test_exam_FK_1` FOREIGN KEY (`test_series_id`) REFERENCES `testseries` (`id`),
  CONSTRAINT `test_exam_ibfk_1` FOREIGN KEY (`institute_id`) REFERENCES `institute` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `test_exam` */

insert  into `test_exam`(`id`,`exam_id`,`test_series_id`,`institute_id`,`created_at`) values (1,1,1,1,NULL),(2,2,3,1,NULL);

/*Table structure for table `testseries` */

DROP TABLE IF EXISTS `testseries`;

CREATE TABLE `testseries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) DEFAULT NULL,
  `institute_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `isPublic` tinyint(1) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `image_url` text,
  `no_of_exam` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `TestSeries_FK` (`institute_id`),
  KEY `TestSeries_FK_1` (`created_by`),
  CONSTRAINT `TestSeries_FK` FOREIGN KEY (`institute_id`) REFERENCES `institute` (`id`),
  CONSTRAINT `TestSeries_FK_1` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `testseries` */

insert  into `testseries`(`id`,`Name`,`institute_id`,`created_by`,`isPublic`,`price`,`image_url`,`no_of_exam`,`created_at`,`updated_at`) values (1,'series',1,1,0,200,'http://localhost/apis/codeigniter/suraj_exam/assets/images/pdf.jpg',2,'2019-11-20 21:04:36',NULL),(2,'series1111',1,1,0,200,'http://localhost/apis/codeigniter/suraj_exam/assets/images/pdf.jpg',2,'2019-11-20 21:04:36',NULL),(3,'series5555',1,1,0,500,'assets/content/testseries/institute/3/e7b8f7c2d6d09614ef0ab93a1ea13ffc.jpg',2,'2019-11-20 21:04:36','2019-11-21 13:26:57'),(4,'new test series',1,1,0,100,'assets/content/testseries/public/4/54422f03ee6ce7e716d68fdf0dc6b41b.jpg',20,'2019-11-21 14:12:36','2019-11-21 14:12:36'),(6,'new test series555',1,1,0,5000,'assets/content/testseries/public/6/a357562a6c398643ebaa9855b2113ead.jpg',5,'2019-11-21 14:33:03','2019-11-21 14:33:03'),(7,'new test series555',1,1,0,50000,'assets/content/testseries/public/7/11a6b742b5fab29179b0449a32214367.jpg',5,'2019-11-21 14:33:14','2019-11-21 14:33:14'),(8,'new test series555',1,1,0,5000,'assets/content/testseries/public/8/5a51fc6ef6d38389a89fc29bb6f74688.jpg',5,'2019-11-21 14:41:35','2019-11-21 14:41:35'),(10,'gallerycontroller',1,1,1,0,'assets/content/testseries/public/10/d45c1b80a80d8a47936ffd4c979e2339.jpg',2,'2019-11-21 14:43:47','2019-11-21 14:43:47');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `active` tinyint(1) DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL,
  `shipping_address_line_1` varchar(100) DEFAULT NULL,
  `shipping_address_line_2` varchar(100) DEFAULT NULL,
  `shipping_address_state` varchar(100) DEFAULT NULL,
  `shipping_address_city` varchar(100) DEFAULT NULL,
  `shipping_address_pincode` varchar(100) DEFAULT NULL,
  `mobile_phone` varchar(10) NOT NULL,
  `password` varchar(200) NOT NULL,
  `roleId` tinyint(1) NOT NULL DEFAULT '0',
  `isDeleted` tinyint(1) DEFAULT '0',
  `createdBy` int(11) DEFAULT NULL,
  `gender` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

/*Data for the table `user` */

insert  into `user`(`id`,`first_name`,`last_name`,`email`,`active`,`created_at`,`updated_at`,`shipping_address_line_1`,`shipping_address_line_2`,`shipping_address_state`,`shipping_address_city`,`shipping_address_pincode`,`mobile_phone`,`password`,`roleId`,`isDeleted`,`createdBy`,`gender`) values (1,'admin','admin','admin@example.com',1,'2019-10-18 23:14:20','0000-00-00 00:00:00','Ruabandha Sector','Bhilai','Chhattisgarh','Bhilai','490006','9890098900','$2y$10$6NOKhXKiR2SAgpFF2WpCkuRgYKlSqFJaqM0NgIM3PT1gKHEM5/SM6',1,0,1,NULL),(2,'institute','institute','manager@example.com',1,'2019-10-18 23:14:56','0000-00-00 00:00:00','Ruabandha Sector','Bhilai','Chhattisgarh','Bhilai','490006','9827612857','$2y$10$quODe6vkNma30rcxbAHbYuKYAZQqUaflBgc4YpV9/90ywd.5Koklm',2,0,1,NULL),(3,'Students','Students','employee@example.com',1,'2019-10-19 09:41:23','0000-00-00 00:00:00','Ruabandha Sector','Bhilai','Chhattisgarh','Bhilai','490006','9827564123','$2y$10$UYsH1G7MkDg1cutOdgl2Q.ZbXjyX.CSjsdgQKvGzAgl60RXZxpB5u',3,0,1,NULL),(14,'',NULL,'ganesh@example.com',1,'2019-10-24 16:51:09','0000-00-00 00:00:00',NULL,NULL,NULL,NULL,NULL,'9999999999','$2y$10$xbK0G4HvZgn0przghFNQUOZfLvQzL8718xBvxOUCkQqtxvA6IdDZ2',2,0,14,NULL),(15,'',NULL,'abc@abc.com',1,'2019-10-31 15:36:54','0000-00-00 00:00:00',NULL,NULL,NULL,NULL,NULL,'9999999999','$2y$10$wLZU7mPdR1YlJp3m0C/Jaeca4kSDCoJGTeuC/faIu2efQKY0YXZQu',2,0,15,NULL);

/*Table structure for table `user_institute` */

DROP TABLE IF EXISTS `user_institute`;

CREATE TABLE `user_institute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `institute_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `subscription_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_institute_FK_1` (`institute_id`),
  CONSTRAINT `user_institute_FK` FOREIGN KEY (`id`) REFERENCES `user` (`id`),
  CONSTRAINT `user_institute_FK_1` FOREIGN KEY (`institute_id`) REFERENCES `institute` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `user_institute` */

insert  into `user_institute`(`id`,`user_id`,`institute_id`,`active`,`start_date`,`end_date`,`subscription_id`,`created_at`,`updated_at`) values (1,2,1,1,'2019-10-19','0000-00-00',NULL,'2019-10-23 23:29:02','2019-10-23 23:29:02');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
