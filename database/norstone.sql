/*
SQLyog Community v9.60 Beta2
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

insert  into `session`(`id`,`expire`,`data`) values ('088gtlfg1hcj2ciruojshijhf3',1428386340,'__flash|a:0:{}'),('322lkba0the9jao5iid06updk2',1428774609,'__flash|a:0:{}__returnUrl|s:7:\"/admin/\";__id|i:88;'),('3s1gspp5dpovao1o19648do8n4',1428385381,'__flash|a:0:{}__returnUrl|s:7:\"/admin/\";__id|i:88;'),('4iji31gm8r564r0f6plgeh9cd4',1428686574,'__flash|a:0:{}'),('50hjlqiqjvod0v0m2dittgm1r1',1428471823,'__flash|a:0:{}__id|i:88;'),('5heilphn1br5juoau0g60v5qf2',1428774065,'__flash|a:0:{}'),('7r6j907bejf96s8vg5i6gpi460',1428692408,'__flash|a:0:{}'),('9vpbvbds3ue83nta0j5bq7uku5',1428386229,'__flash|a:0:{}__returnUrl|s:18:\"/admin/site/logout\";__id|i:88;'),('a7dkq94bnhdtbsgnc81asmslt0',1428388228,'__flash|a:0:{}__id|i:88;'),('bm4gp99et377jjmskla9d1jtn2',1428595175,'__flash|a:0:{}'),('dfq3d13l2j0jor989ppl39ld54',1428688076,'__flash|a:0:{}'),('dgpffc77p4n9ucnmgksd91lk31',1428386221,'__flash|a:0:{}'),('it243f4nqs45h4km7vh6oipae7',1428546623,'__flash|a:0:{}'),('k6gpffmskrf83keb8m5m49h7u0',1428473012,'__flash|a:0:{}'),('kt386c8cg88vmqvslpo0o76bg6',1428595170,'__flash|a:0:{}__id|i:88;'),('llor2fr6jd4sdlob2nhcq0jkm7',1428648447,'__flash|a:0:{}__id|i:88;'),('nd0p4mpltqldin3nfvf8enksl4',1428648450,'__flash|a:0:{}'),('q9vr707l0f80b21bdq5v0ag4h6',1428774201,'__flash|a:0:{}'),('ruubs7lqrh0fe6mqdrt63u8gk6',1428686585,'__flash|a:0:{}__returnUrl|s:7:\"/admin/\";__id|i:88;'),('s5ejn41qn85cb79eutgaqmf8f4',1428473007,'__flash|a:0:{}__id|i:88;'),('sdbqsm09jgjntmdmfcbudjnda3',1428562533,'__flash|a:0:{}__id|i:88;'),('svch5m1liheic8nrms3vcna130',1428595175,'__flash|a:0:{}'),('v4hfc9trt1epjl7v3ggm0n4tc1',1428385458,'__flash|a:0:{}'),('vg3m74kb5l5r57dievs2vu9650',1428385463,'__flash|a:0:{}__returnUrl|s:7:\"/admin/\";__id|i:88;');

/*Table structure for table `tbl_color` */

DROP TABLE IF EXISTS `tbl_color`;

CREATE TABLE `tbl_color` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_color` */

insert  into `tbl_color`(`id`,`name`,`deleted`) values (2,'red',0),(3,'green',1),(4,'blue',0);

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
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_file` */

/*Table structure for table `tbl_gallery` */

DROP TABLE IF EXISTS `tbl_gallery`;

CREATE TABLE `tbl_gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `product_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  `application` tinyint(1) NOT NULL DEFAULT '1',
  `intro` varchar(1024) DEFAULT NULL,
  `description` text,
  `lean_more_link` varchar(128) DEFAULT NULL,
  `status` enum('draft','waiting','published') NOT NULL,
  `publish_date` int(10) NOT NULL DEFAULT '0',
  `created_date` int(10) NOT NULL,
  `created_by` varchar(32) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_gallery` */

insert  into `tbl_gallery`(`id`,`name`,`product_id`,`color_id`,`application`,`intro`,`description`,`lean_more_link`,`status`,`publish_date`,`created_date`,`created_by`,`deleted`) values (1,'this is the name',1,4,1,'this is the intro','<p>this is the description</p>\r\n','','published',1428186223,1428186223,'mantran',0),(2,'sdfds',1,2,1,'sd fds f','<p>sd fsdf sd</p>\r\n','','published',1428252708,1428252708,'admin',0);

/*Table structure for table `tbl_gallery_file` */

DROP TABLE IF EXISTS `tbl_gallery_file`;

CREATE TABLE `tbl_gallery_file` (
  `gallery_id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`gallery_id`,`file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tbl_gallery_file` */

/*Table structure for table `tbl_gallery_tag` */

DROP TABLE IF EXISTS `tbl_gallery_tag`;

CREATE TABLE `tbl_gallery_tag` (
  `gallery_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`gallery_id`,`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tbl_gallery_tag` */

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
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_tag` */

insert  into `tbl_tag`(`id`,`name`,`deleted`) values (2,'lightroom',0);

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
