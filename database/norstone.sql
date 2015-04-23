/*
SQLyog Community v11.31 (64 bit)
MySQL - 5.6.21 : Database - norstone
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`norstone` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `norstone`;

/*Table structure for table `article` */

DROP TABLE IF EXISTS `article`;

CREATE TABLE `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `summary` text COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `article_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `article` */

/*Table structure for table `auth_assignment` */

DROP TABLE IF EXISTS `auth_assignment`;

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `auth_assignment` */

insert  into `auth_assignment`(`item_name`,`user_id`,`created_at`) values ('admin',87,2147483647),('admin',88,NULL);

/*Table structure for table `auth_item` */

DROP TABLE IF EXISTS `auth_item`;

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `auth_item` */

insert  into `auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('admin',1,'Administrator of this application',NULL,NULL,1427867249,1427867249),('adminArticle',2,'Allows admin+ roles to manage articles',NULL,NULL,1427867248,1427867248),('createArticle',2,'Allows editor+ roles to create articles',NULL,NULL,1427867248,1427867248),('deleteArticle',2,'Allows admin+ roles to delete articles',NULL,NULL,1427867248,1427867248),('editor',1,'Editor of this application',NULL,NULL,1427867248,1427867248),('manageUsers',2,'Allows admin+ roles to manage users',NULL,NULL,1427867248,1427867248),('member',1,'Registered users, members of this site',NULL,NULL,1427867248,1427867248),('premium',1,'Premium members. They have more permissions than normal members',NULL,NULL,1427867248,1427867248),('support',1,'Support staff',NULL,NULL,1427867248,1427867248),('theCreator',1,'You!',NULL,NULL,1427867249,1427867249),('updateArticle',2,'Allows editor+ roles to update articles',NULL,NULL,1427867248,1427867248),('updateOwnArticle',2,'Update own article','isAuthor',NULL,1427867248,1427867248),('usePremiumContent',2,'Allows premium+ roles to use premium content',NULL,NULL,1427867247,1427867247);

/*Table structure for table `auth_item_child` */

DROP TABLE IF EXISTS `auth_item_child`;

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `auth_item_child` */

insert  into `auth_item_child`(`parent`,`child`) values ('theCreator','admin'),('editor','adminArticle'),('editor','createArticle'),('admin','deleteArticle'),('admin','editor'),('admin','manageUsers'),('support','member'),('support','premium'),('editor','support'),('admin','updateArticle'),('updateOwnArticle','updateArticle'),('editor','updateOwnArticle'),('premium','usePremiumContent');

/*Table structure for table `auth_rule` */

DROP TABLE IF EXISTS `auth_rule`;

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `auth_rule` */

insert  into `auth_rule`(`name`,`data`,`created_at`,`updated_at`) values ('isAuthor','O:28:\"common\\rbac\\rules\\AuthorRule\":3:{s:4:\"name\";s:8:\"isAuthor\";s:9:\"createdAt\";i:1427867247;s:9:\"updatedAt\";i:1427867247;}',1427867247,1427867247);

/*Table structure for table `migration` */

DROP TABLE IF EXISTS `migration`;

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `migration` */

insert  into `migration`(`version`,`apply_time`) values ('m000000_000000_base',1427866981),('m141022_115823_create_user_table',1427866985),('m141022_115912_create_rbac_tables',1427866987),('m141022_115922_create_session_table',1427866987),('m150104_153617_create_article_table',1427866988);

/*Table structure for table `session` */

DROP TABLE IF EXISTS `session`;

CREATE TABLE `session` (
  `id` char(64) COLLATE utf8_unicode_ci NOT NULL,
  `expire` int(11) NOT NULL,
  `data` longblob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `session` */

insert  into `session`(`id`,`expire`,`data`) values ('3u85dideg5srtu91qv846b1hl6',1429791691,'__flash|a:0:{}__captcha/site/captcha|s:7:\"gctipos\";__captcha/site/captchacount|i:1;'),('9bg5425u8ivhut7qu3j3ahkri2',1429787724,'__flash|a:0:{}__id|i:88;');

/*Table structure for table `tbl_color` */

DROP TABLE IF EXISTS `tbl_color`;

CREATE TABLE `tbl_color` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_color` */

insert  into `tbl_color`(`id`,`name`,`deleted`) values (2,'red',0),(3,'green',0),(4,'blue',0);

/*Table structure for table `tbl_file` */

DROP TABLE IF EXISTS `tbl_file`;

CREATE TABLE `tbl_file` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `caption` varchar(1024) DEFAULT NULL,
  `media` enum('image','document','audio','video') NOT NULL,
  `show_url` varchar(128) NOT NULL,
  `directory` varchar(128) NOT NULL,
  `dimension` varchar(16) DEFAULT NULL,
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `file_name` varchar(64) NOT NULL,
  `file_type` varchar(16) NOT NULL,
  `file_size` varchar(16) NOT NULL,
  `file_ext` varchar(8) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_file` */

insert  into `tbl_file`(`id`,`name`,`caption`,`media`,`show_url`,`directory`,`dimension`,`width`,`height`,`file_name`,`file_type`,`file_size`,`file_ext`,`deleted`) values (61,'alberteinstein-jpg-3',NULL,'image','/uploads/images/alberteinstein-jpg-3/','\\images\\alberteinstein-jpg-3\\','5333x3333',5333,3333,'alberteinstein-jpg-3','image/jpeg','','jpg',0),(62,'bargain-jpg-3',NULL,'image','/uploads/images/bargain-jpg-3/','\\images\\bargain-jpg-3\\','402x263',402,263,'bargain-jpg-3','image/jpeg','','jpg',0),(63,'basement-jpg-3',NULL,'image','/uploads/images/basement-jpg-3/','\\images\\basement-jpg-3\\','259x194',259,194,'basement-jpg-3','image/jpeg','','jpg',0);

/*Table structure for table `tbl_gallery` */

DROP TABLE IF EXISTS `tbl_gallery`;

CREATE TABLE `tbl_gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `slug` varchar(128) NOT NULL,
  `product_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  `application` tinyint(1) NOT NULL DEFAULT '1',
  `image_id` int(11) DEFAULT NULL,
  `intro` varchar(1024) DEFAULT NULL,
  `description` text,
  `lean_more_link` varchar(128) DEFAULT NULL,
  `seo_keyword` varchar(128) DEFAULT NULL,
  `seo_description` varchar(256) DEFAULT NULL,
  `status` enum('draft','waiting','published') NOT NULL,
  `publish_date` int(10) NOT NULL DEFAULT '0',
  `created_date` int(10) NOT NULL,
  `created_by` varchar(32) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_gallery` */

insert  into `tbl_gallery`(`id`,`name`,`slug`,`product_id`,`color_id`,`application`,`image_id`,`intro`,`description`,`lean_more_link`,`seo_keyword`,`seo_description`,`status`,`publish_date`,`created_date`,`created_by`,`deleted`) values (9,'this is the name','this-is-the-name',1,4,1,61,'this is the introduction','<p>this is the description</p>\r\n','','picture','picture is picture','published',1428963763,1428963763,'admin',0),(10,'gallery 2','gallery-2',1,3,0,NULL,'gallery 2','<p>gallery 2</p>\r\n','','','','published',1429251934,1429251934,'admin',0),(11,'gallery 3','gallery-3',1,3,1,NULL,'gallery 3','<p>gallery 3</p>\r\n','','','','published',1429251951,1429251951,'admin',0),(12,'gallery 4','gallery-4',1,4,1,NULL,'gallery 4','<p>gallery 4</p>\r\n','','','','published',1429251967,1429251967,'admin',0),(13,'gallery 5','gallery-5',1,2,1,NULL,'gallery 5','<p>gallery 5</p>\r\n','','','','published',1429251979,1429251979,'admin',0),(14,'gallery 6','gallery-6',1,3,1,NULL,'gallery 6','<p>gallery 6</p>\r\n','','','','published',1429593731,1429593731,'admin',0),(15,'gallery 7','gallery-7',1,3,1,NULL,'gallery 7','<p>gallery 7</p>\r\n','','','','published',1429593786,1429593786,'admin',0),(16,'gallery 8','gallery-8',1,3,0,NULL,'gallery 8','<p>gallery 8</p>\r\n','','','','published',1429594054,1429594054,'admin',0),(17,'gallery 9','gallery-9',1,2,0,NULL,'gallery 9','<p>gallery 9</p>\r\n','','','','published',1429594116,1429594116,'admin',0),(18,'gallery 10','gallery-10',1,2,0,NULL,'gallery 10','<p>gallery 10</p>\r\n','','','','published',1429594170,1429594170,'admin',0),(19,'gallery 12','gallery-12',1,4,0,NULL,'gallery 12','<p>gallery 12</p>\r\n','','','','published',1429685019,1429685019,'admin',0),(20,'gallery 11','gallery-11',1,3,1,NULL,'gallery 11','<p>gallery 11</p>\r\n','','','','published',1429685314,1429685314,'admin',0),(21,'gallery 22','gallery-22',1,2,1,NULL,'gallery 22','<p>gallery 22</p>\r\n','','','','published',1429763305,1429763268,'admin',0),(22,'gallery 22','gallery-221',1,2,1,NULL,'gallery 22','<p>gallery 22</p>\r\n','','','','draft',0,1429764898,'admin',0),(23,'gallery 23','gallery-222',1,4,1,NULL,'gallery 23','<p>gallery 23</p>\r\n','','','','draft',0,1429764921,'admin',0),(24,'gallery d','gallery-d',1,3,1,NULL,'sdf sd fsd','<p>sdf sdf sdf</p>\r\n','','','','draft',0,1429766698,'admin',0);

/*Table structure for table `tbl_gallery_file` */

DROP TABLE IF EXISTS `tbl_gallery_file`;

CREATE TABLE `tbl_gallery_file` (
  `gallery_id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`gallery_id`,`file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tbl_gallery_file` */

insert  into `tbl_gallery_file`(`gallery_id`,`file_id`,`deleted`) values (9,61,0),(9,62,0),(9,63,0);

/*Table structure for table `tbl_gallery_related` */

DROP TABLE IF EXISTS `tbl_gallery_related`;

CREATE TABLE `tbl_gallery_related` (
  `gallery_id` int(11) NOT NULL,
  `related_id` int(11) NOT NULL,
  `sorting` int(11) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`gallery_id`,`related_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tbl_gallery_related` */

insert  into `tbl_gallery_related`(`gallery_id`,`related_id`,`sorting`,`deleted`) values (9,10,0,1),(9,11,0,1),(9,12,2,0),(9,13,1,0),(9,14,0,0),(9,15,2,1),(9,16,1,1),(10,11,1,0),(10,12,0,0),(10,13,0,1),(11,16,0,0),(11,17,2,0),(11,18,1,0);

/*Table structure for table `tbl_gallery_tag` */

DROP TABLE IF EXISTS `tbl_gallery_tag`;

CREATE TABLE `tbl_gallery_tag` (
  `gallery_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`gallery_id`,`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tbl_gallery_tag` */

insert  into `tbl_gallery_tag`(`gallery_id`,`tag_id`,`deleted`) values (9,2,1),(9,3,0),(9,4,1),(9,5,0),(10,2,0);

/*Table structure for table `tbl_product` */

DROP TABLE IF EXISTS `tbl_product`;

CREATE TABLE `tbl_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_product` */

insert  into `tbl_product`(`id`,`name`,`deleted`) values (1,'Ochre Rock Panels',0);

/*Table structure for table `tbl_tag` */

DROP TABLE IF EXISTS `tbl_tag`;

CREATE TABLE `tbl_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `slug` varchar(128) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_tag` */

insert  into `tbl_tag`(`id`,`name`,`slug`,`deleted`) values (2,'Lightroom','lightroom',0),(3,'Man','man',0),(4,'Cute','cute',0),(5,'Minh','minh',0);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_activation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `user` */

insert  into `user`(`id`,`username`,`email`,`password_hash`,`status`,`auth_key`,`password_reset_token`,`account_activation_token`,`created_at`,`updated_at`) values (87,'mantran','tranduyminhman@gmail.com','$2y$13$A1XhmseCZoj1pgXjmAfBV.38b4K0KtVQXEvK3AmqTU8W3czOBnamy',10,'mxHNRKro_qwyQ1j8purisSFeAPDwR0EZ',NULL,NULL,1427867082,1428218485),(88,'admin','man.tran@axonactive.vn','$2y$13$pOo2.QX2L0wIEA2MDrvUuuKqbuGAciRMZcDU8Wn2aoErErTfj4RV.',10,'LUgN3Apv1cflayw6gtG6DqphRJdCS-Ow',NULL,NULL,1428218361,1428218361);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
