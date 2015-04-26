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
-- CREATE DATABASE /*!32312 IF NOT EXISTS*/`norstone` /*!40100 DEFAULT CHARACTER SET utf8 */;
--
-- USE `norstone`;

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

insert  into `session`(`id`,`expire`,`data`) values ('06ffejselkdjleb47rvq4oons1',1430014026,'__flash|a:0:{}'),('0qm58enoge9otgl14gt58atug6',1429852757,'__flash|a:0:{}'),('21fe0hbiv81t0v0sqk0c0d3116',1429852755,'__flash|a:0:{}'),('4lqkr04up81t8l3981lndl0a91',1429860682,'__flash|a:0:{}'),('6s2igce1jggvgda83o3ldbd454',1429992913,'__flash|a:0:{}'),('88obn3ttl47tu1orr5licklmd4',1430012942,'__flash|a:0:{}__id|i:88;'),('8obaedeuuq4p863k7irjck27m2',1429849798,'__flash|a:0:{}'),('8tl55me900bmb9pd62kbnaui14',1429849790,'__flash|a:0:{}'),('93v0usrg9jk69jjcgmhv82j0s3',1429993347,'__flash|a:0:{}'),('9rvsusb0nqc825mvj3ko6cs671',1429851247,'__flash|a:0:{}'),('a48a0rlkpujohblrr50neaadv6',1429847921,'__flash|a:0:{}'),('alehcldo7cb54ej7f6d73idja7',1429851109,'__flash|a:0:{}'),('b0u1aufnk0b4cu5984eji6b2e2',1429849791,'__flash|a:0:{}'),('bhqrmk8iii23vov5te6th0gmb2',1429993505,'__flash|a:0:{}'),('cjvdni7ni3m9n3tb11dd922835',1429992905,'__flash|a:0:{}'),('euv0vn97qbohltrp1mv2hnh386',1429848258,'__flash|a:0:{}'),('kae0pg5t0l0okgubf072mrhgm6',1429992905,'__flash|a:0:{}'),('kc5o8m8q25lo48su1sgtlnbfl6',1429851235,'__flash|a:0:{}'),('kgvns0uqgjc3phn66846rb77s3',1429992550,'__flash|a:0:{}'),('kkoi99vufjqnh1to803ovh95h4',1429850963,'__flash|a:0:{}'),('lpvtq9infaurlba6lh3nfd7982',1429992913,'__flash|a:0:{}'),('n7etuett4tu73kr10k0bilr4b2',1429993347,'__flash|a:0:{}'),('o9mra8g9at1sp5kc498i3jois6',1429993435,'__flash|a:0:{}'),('qgab7a6nl0eubsn9il9aa2j2d3',1429993368,'__flash|a:0:{}'),('qo7776dhiee1jcln6i6t2hlq63',1429852526,'__flash|a:0:{}__id|i:88;'),('qootdnkqnvroe6ukg1dirvdf75',1429852746,'__flash|a:0:{}'),('rtgc64hdvlb3hq0m4ogr7nocp6',1429993370,'__flash|a:0:{}'),('uh91aqk170iaemq705robini17',1429850948,'__flash|a:0:{}'),('vfa0231og6dnpg8atpul028n12',1429852759,'__flash|a:0:{}__captcha/site/captcha|s:6:\"vilayd\";__captcha/site/captchacount|i:1;');

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
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_file` */

insert  into `tbl_file`(`id`,`name`,`caption`,`media`,`show_url`,`directory`,`dimension`,`width`,`height`,`file_name`,`file_type`,`file_size`,`file_ext`,`deleted`) values (52,'img-1067-jpg',NULL,'image','/uploads/images/img-1067-jpg/','\\images\\img-1067-jpg\\','2592x1936',2592,1936,'img-1067-jpg','image/jpeg','','jpg',0),(53,'img-1075-jpg','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.','image','/uploads/images/img-1075-jpg/','\\images\\img-1075-jpg\\','2592x1936',2592,1936,'img-1075-jpg','image/jpeg','','jpg',0),(54,'img-1046-jpg',NULL,'image','/uploads/images/img-1046-jpg/','\\images\\img-1046-jpg\\','2592x1936',2592,1936,'img-1046-jpg','image/jpeg','','jpg',0),(55,'dsc-0155-jpg','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,','image','/uploads/images/dsc-0155-jpg/','\\images\\dsc-0155-jpg\\','4288x2848',4288,2848,'dsc-0155-jpg','image/jpeg','','jpg',0);

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

insert  into `tbl_gallery`(`id`,`name`,`slug`,`product_id`,`color_id`,`application`,`image_id`,`intro`,`description`,`lean_more_link`,`seo_keyword`,`seo_description`,`status`,`publish_date`,`created_date`,`created_by`,`deleted`) values (9,'this is the name','this-is-the-name',1,4,1,53,'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,','<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s,</p>\r\n','','picture','picture is picture','published',1428963763,1428963763,'admin',0),(10,'gallery 2','gallery-2',1,3,0,52,'gallery 2','<p>gallery 2</p>\r\n','','','','published',1429251934,1429251934,'admin',0),(11,'gallery 3','gallery-3',1,3,1,54,'gallery 3','<p>gallery 3</p>\r\n','','','','published',1429251951,1429251951,'admin',0),(12,'gallery 4','gallery-4',1,4,1,NULL,'gallery 4','<p>gallery 4</p>\r\n','','','','published',1429251967,1429251967,'admin',0),(13,'gallery 5','gallery-5',1,2,1,NULL,'gallery 5','<p>gallery 5</p>\r\n','','','','published',1429251979,1429251979,'admin',1),(14,'gallery 6','gallery-6',1,3,1,NULL,'gallery 6','<p>gallery 6</p>\r\n','','','','published',1429593731,1429593731,'admin',0),(15,'gallery 7','gallery-7',1,3,1,NULL,'gallery 7','<p>gallery 7</p>\r\n','','','','published',1429593786,1429593786,'admin',0),(16,'gallery 8','gallery-8',1,3,0,NULL,'gallery 8','<p>gallery 8</p>\r\n','','','','published',1429594054,1429594054,'admin',0),(17,'gallery 9','gallery-9',1,2,0,NULL,'gallery 9','<p>gallery 9</p>\r\n','','','','published',1429594116,1429594116,'admin',0),(18,'gallery 10','gallery-10',1,2,0,NULL,'gallery 10','<p>gallery 10</p>\r\n','','','','published',1429594170,1429594170,'admin',0),(19,'gallery 12','gallery-12',1,4,0,NULL,'gallery 12','<p>gallery 12</p>\r\n','','','','published',1429685019,1429685019,'admin',0),(20,'gallery 11','gallery-11',1,3,1,NULL,'gallery 11','<p>gallery 11</p>\r\n','','','','published',1429685314,1429685314,'admin',0),(21,'gallery 22','gallery-22',1,2,1,NULL,'gallery 22','<p>gallery 22</p>\r\n','','','','published',1429763305,1429763268,'admin',0),(22,'gallery 22','gallery-221',1,2,1,NULL,'gallery 22','<p>gallery 22</p>\r\n','','','','draft',0,1429764898,'admin',0),(23,'gallery 23','gallery-222',1,4,1,NULL,'gallery 23','<p>gallery 23</p>\r\n','','','','draft',0,1429764921,'admin',0),(24,'gallery d','gallery-d',1,3,1,NULL,'sdf sd fsd','<p>sdf sdf sdf</p>\r\n','','','','draft',0,1429766698,'admin',0);

/*Table structure for table `tbl_gallery_file` */

DROP TABLE IF EXISTS `tbl_gallery_file`;

CREATE TABLE `tbl_gallery_file` (
  `gallery_id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`gallery_id`,`file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tbl_gallery_file` */

insert  into `tbl_gallery_file`(`gallery_id`,`file_id`,`deleted`) values (9,53,0),(9,55,0),(10,52,0),(11,54,0);

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

insert  into `tbl_gallery_related`(`gallery_id`,`related_id`,`sorting`,`deleted`) values (9,10,0,1),(9,11,0,1),(9,12,1,0),(9,13,1,1),(9,14,0,0),(9,15,2,1),(9,16,1,1),(10,11,1,0),(10,12,0,0),(10,13,0,1),(11,16,0,0),(11,17,2,0),(11,18,1,0);

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
