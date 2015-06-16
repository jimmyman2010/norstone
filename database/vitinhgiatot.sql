/*
SQLyog Ultimate v11.42 (64 bit)
MySQL - 5.6.24 : Database - norstone
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
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

insert  into `session`(`id`,`expire`,`data`) values ('0i4l4c906sbrsl17g1mmvl6103',1434430639,'__flash|a:0:{}__id|i:88;');

/*Table structure for table `tbl_category` */

DROP TABLE IF EXISTS `tbl_category`;

CREATE TABLE `tbl_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `slug` varchar(128) NOT NULL,
  `description` varchar(2048) DEFAULT NULL,
  `cat_type` int(11) NOT NULL DEFAULT '0',
  `seo_title` varchar(128) DEFAULT NULL,
  `seo_keyword` varchar(128) DEFAULT NULL,
  `seo_description` varchar(256) DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `sorting` int(11) NOT NULL DEFAULT '0',
  `activated` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=305 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_category` */

insert  into `tbl_category`(`id`,`name`,`slug`,`description`,`cat_type`,`seo_title`,`seo_keyword`,`seo_description`,`parent_id`,`sorting`,`activated`,`deleted`) values (230,'Laptop cũ','','<p>Vi T&iacute;nh Duy T&acirc;n cam kết b&aacute;n h&agrave;ng laptop cũ ch&iacute;nh h&atilde;ng, c&ograve;n nguy&ecirc;n zin, kh&ocirc;ng b&aacute;n h&agrave;ng đ&atilde; bung, đ&atilde; qua sửa chửa</p>\n<p>&nbsp;</p>\n<p>tag: <a href=\"http://vitinhgiatot.com/san-pham/230/laptop-cu.html\">laptop cũ gi&aacute; rẻ</a>, <a href=\"http://vitinhgiatot.com/san-pham/230/laptop-cu.html\">laptop dell</a>, <a href=\"http://vitinhgiatot.com/san-pham/230/laptop-cu.html\">laptop hp</a>, <a href=\"http://vitinhgiatot.com/san-pham/230/laptop-cu.html\">laptop cu gia re</a>, <a href=\"http://vitinhgiatot.com/san-pham/230/laptop-cu.html\">may tinh xach tay</a>, <a href=\"http://vitinhgiatot.com/san-pham/230/laptop-cu.html\">may tinh xach tay cu</a>, </p>',0,'Laptop cũ giá rẻ || máy tính xách tay cũ || DTC chuyên cung cấp latop cu gia re','laptop cũ giá rẻ, laptop cu gia re, laptop cu dell, laptop cũ Dell','Duy Tân Computer chuyên cung cấp laptop cũ giá rẻ, chất lượng nhất của các hãng Dell, Asus, Acer, Hp-Compaq, Sony Vaio,... Hotline 0906176671',0,10,1,0),(233,'Màn hình LCD cũ','','<p style=\"text-align: center;\"><b><span style=\"color: rgb(255, 102, 0);\"><span style=\"font-size: medium;\">&nbsp;</span></span></b><b><span style=\"color: rgb(255, 102, 0);\"><span style=\"font-size: medium;\">M&agrave;n h&igrave;nh lcd cũ gi&aacute; rẻ, m&agrave;n h&igrave;nh m&aacute;y t&iacute;nh cũ</span></span></b><span style=\"color: rgb(255, 102, 0);\"><span style=\"font-size: medium;\"> - Vi t&iacute;nh Duy T&acirc;n</span></span></p>\r\n<p style=\"text-align: justify;\">&nbsp;</p>\r\n<p style=\"text-align: justify;\">&nbsp; &nbsp; &nbsp; &nbsp;<span style=\"font-size: medium;\"> &nbsp;- <b>M&agrave;n h&igrave;nh lcd cũ gi&aacute; rẻ</b> kh&ocirc;ng lỗi ( kh&ocirc;ng bầm, kh&ocirc;ng điểm chết hoặc điểm chết từ 3 trở xuống theo quy định của nh&agrave; sản xuất ) . &nbsp;Đảm bảo h&agrave;ng ch&iacute;nh h&atilde;ng 100%( c&oacute; xuất xứ v&agrave; model r&otilde; r&agrave;ng ), kh&ocirc;ng phải h&agrave;ng dựng hoặc k&eacute;o lại nh&aacute;i h&agrave;ng h&atilde;ng.</span></p>\r\n<p style=\"text-align: justify;\"><span style=\"font-size: medium;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;- Đặc biệt tất cả <b>m&agrave;n h&igrave;nh lcd cũ</b> đều nguy&ecirc;n zin, kh&ocirc;ng qua sửa chữa</span></p>\r\n<p style=\"text-align: justify;\"><span style=\"font-size: medium;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;- Xem hướng dẫn test v&agrave; <b>mua &nbsp;m&agrave;n h&igrave;nh lcd cũ</b> </span><a href=\"http://vitinhgiatot.com/tin-tuc-xem/10/man-hinh-may-tinh-cu-gia-re-va-huong-dan-test-va-chon-mua-man-hinh-may-tinh-cu-gia-re.html\"><span style=\"font-size: medium;\">tại đ&acirc;y</span></a></p>\r\n<p style=\"text-align: justify;\">&nbsp;</p>\r\n<p style=\"text-align: justify;\"><span style=\"font-size: large;\">Vi t&iacute;nh Duy T&acirc;n </span><span style=\"font-size: medium;\">bảo h&agrave;nh 3 th&aacute;ng cho tất cả <b>m&agrave;n h&igrave;nh lcd cũ </b>b&aacute;n ra cho kh&aacute;ch h&agrave;ng. Vui l&ograve;ng gọi trước khi đến để x&aacute;c nhận số lượng h&agrave;ng. Đảm bảo gi&aacute; tốt nhất tại khu vực Tp Hcm</span></p>\r\n<p style=\"text-align: justify;\"',0,'Màn hình LCD cũ giá rẻ ||Màn hình máy tính cũ|| DTC chuyên cung cấp màn hình LCD cũ giá rẻ chất lượng','màn hinh lcd cũ, màn hình lcd cũ gia rẻ, man hinh lcd cu, man hinh lcd cu gia re','Vi tính Duy Tân chuyên cung cấp các loại màn hình LCD cũ giá rẻ chất lượng nhất từ các hãng Samsung, LG, Del, HP,.. đem lại trải nghiệm hình ảnh tốt nhất cho bạn tại tp hcm',0,7,1,0),(239,'Thiết bị mạng','','',0,'Thiết bị mạng giá rẻ || Duy Tân Computer chuyen cung cấp thiết bị mạng giá rẻ, chất lượng','Thiết bị mạng, thiet bi mang, thiết bị mạng giá rẻ, thiet bi mang gia re','Duy Tân Computer chuyên cung cấp thiết bị mạng, bộ thu phát sóng wifi giá rẻ, chất lượng đến từ các hãng cũng cấp thiết bị chất lượng nhất.',0,9,0,0),(261,'Máy bộ Dell','','<h1><b><span style=\"color: rgb(255, 102, 0);\">M&aacute;y bộ Dell cũ gi&aacute; rẻ</span></b><span style=\"color: rgb(255, 102, 0);\"> ,<b> m&aacute;y t&iacute;nh để b&agrave;n Dell gi&aacute; rẻ</b> - Vi t&iacute;nh Duy t&acirc;n</span></h1>\r\n<p style=\"margin-left: 40px;\">&nbsp;Vi t&iacute;nh Duy T&acirc;n chuy&ecirc;n <b>b&aacute;n&nbsp;m&aacute;y t&iacute;nh để b&agrave;n Dell </b>với cấu h&igrave;nh từ thấp đến cao, cam kết đ&uacute;ng h&agrave;ng Dell nguy&ecirc;n bản, kh&ocirc;ng lai tạp linh kiện ngo&agrave;i.</p>\r\n<p style=\"margin-left: 40px;\"><b>M&aacute;y t&iacute;nh hiệu Del</b>l được nhập từ Nhật v&agrave; Mỹ, m&aacute;y đ&atilde; qua sử dụng.</p>\r\n<p style=\"margin-left: 40px;\">Ch&uacute;ng t&ocirc;i c&oacute; 2 g&oacute;i bảo h&agrave;nh l&agrave; 3 th&aacute;ng v&agrave; 12 th&aacute;ng, với chế độ bảo h&agrave;nh&nbsp; 1 đổi 1, tạo cho qu&yacute; kh&aacute;ch tin tưởng tuyệt đối v&agrave;o sản phẩm của ch&uacute;ng t&ocirc;i.</p>\r\n<p>Ch&uacute;ng t&ocirc;i cung cấp những d&ograve;ng <b>m&aacute;y bộ Dell cũ</b> ch&iacute;nh như sau:&nbsp;</p>\r\n<p style=\"margin-left: 40px;\">- <b>M&aacute;y bộ&nbsp;Dell Vostro</b></p>\r\n<p style=\"margin-left: 40px;\">- <b>M&aacute;y t&iacute;nh để b&agrave;n&nbsp;Dell Optiplex</b></p>\r\n<p style=\"margin-left: 40px;\">- <b>M&aacute;y t&iacute;nh để b&agrave;n&nbsp;Dell Inspiron</b></p>\r\n<p style=\"margin-left: 40px;\">- <b>M&aacute;y bộ&nbsp;Dell Workstation&nbsp;</b></p>\r\n<p>&nbsp; Với nhiều cấu h&igrave;nh như: m&aacute;y bộ dell dual core, m&aacute;y bộ dell core 2 duo, m&aacute;y bộ dell core i3, m&aacute;y bộ dell core i5, m&aacute;y bộ dell core i7.. v&agrave; với nhiều gi&aacute; hợp t&uacute;i tiền cho qu&yacute; kh&aacute;ch dể lựa chọn.&nbsp;</p>\r\n<p>&nbsp;Tất cả c&aacute;c d&ograve;ng <b>m&aacute;y t&iacute;nh để b&agrave;n Del</b>l&nbsp; đều được thiết kế với mẩu m&atilde; sang trọng, cực kỳ đẹp , v&agrave; kh&ocirc;ng k&eacute;m phần chắc chắn .</p>\r\n<p>&nbsp; Vỏ m&aacute;y được thiết bằng 2 lớp ( khung sắt đứng vững, vỏ nhựa an to&agrave;n, bền đẹp ), chỉ c&oacut',0,'Máy bộ dell giá rẻ || Máy tính để bàn Dell ||bán máy bộ dell cũ giá rẻ || Vi tính Duy Tân','máy bộ dell, máy bộ dell giá rẻ, may bo dell, may bo dell gia re, may bo dell optilex, máy tính để bàn dell, may tinh de ban del','Vi tính Duy Tân chuyên cung cấp máy bộ dell giá rẻ nhất, bán máy bộ dell cũ chất lượng nhất đáp ứng mọi nhu cầu học tập, làm việc và giải trí của bạn.',0,2,1,0),(262,'Máy bộ HP','may-bo-hp.html','<p style=\"margin: 0px; outline: 0px; padding: 0px; font-family: Arial, Helvetica, sans-serif;\"><span style=\"font-size: medium;\">&nbsp;Vi t&iacute;nh Duy T&acirc;n chuy&ecirc;n cung cấp&nbsp;<b style=\"margin: 0px; outline: 0px; padding: 0px;\">m&aacute;y t&iacute;nh để b&agrave;n HP</b>&nbsp;với cấu h&igrave;nh đa dạng , cam kết đ&uacute;ng h&agrave;ng HP nguy&ecirc;n bản, kh&ocirc;ng lai tạp linh kiện ngo&agrave;i.</span></p>\r\n<p style=\"margin: 0px; outline: 0px; padding: 0px; font-family: Arial, Helvetica, sans-serif;\">&nbsp;</p>\r\n<p style=\"margin: 0px; outline: 0px; padding: 0px; font-family: Arial, Helvetica, sans-serif;\"><span style=\"font-size: medium;\">Ch&uacute;ng t&ocirc;i c&oacute; 2 g&oacute;i bảo h&agrave;nh l&agrave; 3 th&aacute;ng v&agrave; 12 th&aacute;ng, với chế độ bảo h&agrave;nh&nbsp; 1 đổi 1, tạo cho qu&yacute; kh&aacute;ch tin tưởng tuyệt đối v&agrave;o sản phẩm của ch&uacute;ng t&ocirc;i.</span></p>\r\n<p style=\"margin: 0px; outline: 0px; padding: 0px; font-family: Arial, Helvetica, sans-serif;\"><span style=\"font-size: medium;\">Ch&uacute;ng t&ocirc;i cung cấp những d&ograve;ng :</span></p>\r\n<p style=\"margin: 0px; outline: 0px; padding: 0px; font-family: Arial, Helvetica, sans-serif;\"><span style=\"font-size: medium;\">- <b>M&aacute;y t&iacute;nh để b&agrave;n&nbsp;HP DC</b></span></p>\r\n<p style=\"margin: 0px; outline: 0px; padding: 0px; font-family: Arial, Helvetica, sans-serif;\"><span style=\"font-size: medium;\">- &nbsp;<b>M&aacute;y bộ&nbsp;HP DX</b></span></p>\r\n<p style=\"margin: 0px; outline: 0px; padding: 0px; font-family: Arial, Helvetica, sans-serif;\"><span style=\"font-size: medium;\">- &nbsp;<b>M&aacute;y bộ&nbsp;HP Pro</b><br />\r\n</span></p>\r\n<p style=\"margin: 0px; outline: 0px; padding: 0px; font-family: Arial, Helvetica, sans-serif;\"><span style=\"font-size: medium;\">Gồm c&aacute;c d&ograve;ng <b>m&aacute;y t&iacute;nh để b&agrave;n HP</b> v&iacute; dụ như: Hp dc7700, hp dc7800, &nbsp;hp dc7900, hp dx7510, hp dx2100...vv</span></p>\r\n<p style=\"margin: 0px; outline: 0px; padding: 0px; font-fami',0,'Máy bộ hp giá rẻ | Máy bộ Hp cũ| May bo Hp i5','máy bộ hp, máy bộ hp giá rẻ, may bo hp, may bo hp gia re,','Vi tính Duy Tân chuyên cung cấp máy bộ hp giá rẻ nhất,  máy bộ hp cũ giá rẻ và chất lượng nhất đáp ứng mọi nhu cầu học tập, làm việc và giải trí của bạn.',0,1,1,0),(264,'Máy tính cũ giá rẻ','','',0,'Máy tính cũ giá rẻ || DTC chuyên cung cấp máy tính cũ giá rẻ, chất lượng','máy tính cũ giá rẻ, máy tính để bàn giá rẻ, máy tính cũ, may tinh cu gia re, may tinh de ban cu','Vi tính Duy Tân chuyên cung cấp máy tính giá rẻ nhất,  máy tính cũ chất lượng nhất đáp ứng mọi nhu cầu học tập, làm việc và giải trí của bạn.',0,5,1,0),(271,'Bộ phát wifi giá rẻ','','',0,'Bộ phát wifi giá rẻ || DTC chuyên cung cấp bộ phát wifi giá rẻ, bộ phát wifi tenda, Tplink','bo phat wifi, bộ phát wifi, bo phat wifi gia re, bộ phát wifi giá rẻ, bo phat wifi tenda, bộ phát wifi tenda','Duy Tân Comuter chuyên cung cấp thiết bị mạng, bộ phát wifi giá rẻ đáp của các hãng nổi tiếng trên thị trường như bộ phát wifi tenda, bộ phát wifi Tplink, đáp ứng mọi nhu cầu làm việc và học tập của bạn.',239,0,1,0),(272,'Bộ thu sóng wifi','','<h1>&nbsp;<a href=\"http://vitinhgiatot.com\">vitinhgiatot.com</a> cung cấp usb thu s&oacute;ng wifi gi&aacute; rẻ&nbsp;</h1>\r\n<p>Bạn đang sử dụng m&aacute;y vi t&iacute;nh để b&agrave;n? bạn đang sử dụng m&aacute;y t&iacute;nh x&aacute;ch tay m&agrave; kh&ocirc;ng c&oacute; chức năng <strong>thu wifi</strong> ?</p>\r\n<p>Nhưng bạn kh&ocirc;ng muốn k&eacute;o d&acirc;y mạng đi khắp nh&agrave;, <strong>USB thu s&oacute;ng wifi </strong>sẽ giải quyết vấn đề đ&oacute; cho bạn, với một thiết bị như một USB lư trữ th&ocirc;ng thường, nhỏ gọn, nhưng c&oacute; chức năng thu wifi.&nbsp;</p>\r\n<p>Lợi &iacute;ch của việc sử dụng <strong>USB thu s&oacute;ng wifi</strong> l&agrave; rất dể di chuyển , kh&ocirc;ng đi d&acirc;y mạng chằng chịt trong nh&agrave;, kh&ocirc;ng mất thẩm mỹ cho ng&ocirc;i nh&agrave; hoặc căn ph&ograve;ng của bạn, c&oacute; thể x&agrave;i trong ph&ograve;ng m&aacute;y lạnh k&iacute;n kh&ocirc;ng c&oacute; chổ k&eacute;o d&acirc;y mạng,&nbsp;</p>\r\n<p>&nbsp;</p>',0,'Bộ thu sóng wifi giá rẻ || Duy Tân Computer chuyên cung cấp bộ thu sóng wifi giá rẻ, chất lượng','bo thu song wifi, bộ thu sóng wifi, bộ thu sóng wifi giá rẻ, bo thu song wifi gia re','Duy Tân Computer chuyên cung cấp thiết bị mạng, bộ thu phát sóng wifi giá rẻ và chất lượng nhất.',239,11,1,0),(280,'Máy bộ  Fujitsu, Acer, Nec...','','',0,'Máy bộ Fujitsu || Vi tính Duy Tân chuyên cung cấp máy tính để bàn Fujitsu','máy bộ fujitsu, máy tính để bàn Fujitsu, máy bộ Fujitsu giá rẻ, may tinh de ban fujitsu, máy tính đồng bộ Fujitsu','cung cấp máy tính để bàn Fujitsu, máy bộ Fujitsu cũ, giá rẻ và chất lượng nhất,đáp ứng được được nhu cầu công việc và giải trí của quý khách',0,4,1,0),(282,'Chuột không dây','','<p><span id=\"docs-internal-guid-64eb56bf-80a6-dbfd-f54d-0bd23afcf723\"> </span></p>\n<h1><a href=\"http://vitinhgiatot.com\">Vitinhgiatot.com</a> cung cấp chuột kh&ocirc;ng d&acirc;y, chuột m&aacute;y t&iacute;nh gi&aacute; rẻ</h1>\n<p dir=\"ltr\" style=\"line-height:1.15;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 15px; font-family: Arial; vertical-align: baseline; white-space: pre-wrap;\">Ng&agrave;y nay c&ocirc;ng ngh&ecirc; n&acirc;ng cao,<em><strong> chuột m&aacute;y t&iacute;nh</strong></em> l&agrave; thiết bị kh&ocirc;ng thể thiếu đối với 1 bộ m&aacute;y t&iacute;nh, laptop.., nhu cầu sử dụng thiết bị di động, &iacute;t d&acirc;y nhợ, &iacute;t vướng v&iacute;u, <em><strong>chuột kh&ocirc;ng d&acirc;y</strong></em> ra đời để phục vụ cho một trong những nhu cầu đ&oacute;.</span></p>\n<p dir=\"ltr\" style=\"line-height:1.15;margin-top:0pt;margin-bottom:0pt;\">&nbsp;</p>\n<p dir=\"ltr\" style=\"line-height:1.15;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 15px; font-family: Arial; vertical-align: baseline; white-space: pre-wrap;\">Bạn c&oacute; thể d&ugrave;ng chuột kh&ocirc;ng d&acirc;y để thuyết tr&igrave;nh, xem phim, chơi game từ xa rất tiện lợi.</span></p>\n<p dir=\"ltr\" style=\"line-height:1.15;margin-top:0pt;margin-bottom:0pt;\">&nbsp;</p>\n<p dir=\"ltr\" style=\"line-height:1.15;margin-top:0pt;margin-bottom:0pt;\"><strong><span style=\"font-size: 15px; font-family: Arial; vertical-align: baseline; white-space: pre-wrap;\">Vitinhgiatot.com</span></strong><span style=\"font-size: 15px; font-family: Arial; vertical-align: baseline; white-space: pre-wrap;\"> cam kết chỉ b&aacute;n h&agrave;ng <em><strong>chuột m&aacute;y t&iacute;nh </strong></em>ch&iacute;nh h&atilde;ng, tiết kiệm pin tối đa cho qu&yacute; kh&aacute;ch, bảo h&agrave;nh chu đ&aacute;o.</span></p>\n<p dir=\"ltr\" style=\"line-height:1.15;margin-top:0pt;margin-bottom:0pt;\">&nbsp;</p>\n<p dir=\"ltr\" style=\"line-height:1.15;margin-top:0pt;margin-bottom:0pt;\"><strong><span style=\"font-size: 15px; font-family: Arial; vertical-align: baseline; white-spac',0,'Chuột không dây giá rẻ||Mouse không dây || Duy Tân computer chuyên cung cấp chuột không dây giá rẻ','','',0,7,0,0),(283,'Bàn phím không dây','','',0,'','','',0,8,0,0),(284,'Cáp HDMI','','',0,'cáp HDMI || cable HDMI|| DTC chuyên cáp HDMI chất lượng giá rẻ','','',0,9,0,0),(285,'Máy bộ game và đồ họa','','',0,'','','',0,5,1,0),(288,'Máy tính để bàn lắp ráp','','',0,'','','',0,11,0,0),(290,'MÁY BỘ DELL OPTIPLEX','','<p>M&Aacute;Y BỘ DELL OPTIPLEX</p>',0,'MÁY BỘ DELL OPTIPLEX','MÁY BỘ DELL OPTIPLEX','MÁY BỘ DELL OPTIPLEX',261,0,0,0),(291,'MÁY BỘ DELL VOSTRO','','<p>M&Aacute;Y BỘ DELL VOSTRO</p>',0,'MÁY BỘ DELL VOSTRO','MÁY BỘ DELL VOSTRO','MÁY BỘ DELL VOSTRO',261,1,0,0),(292,'Máy bộ HP DC 7900','','',0,'','','',262,0,1,0),(293,'Máy bộ Hp DC 7700','','',0,'','','',262,1,1,0),(294,'máy bộ HP DC7800','','',0,'','','',262,2,1,0),(295,'Máy bộ HP 6000 Pro','','',0,'','','',262,3,1,0),(296,'máy bộ Dell Optiplex 740','','',0,'','','',261,2,1,0),(297,'Máy bộ Dell Optiplex 755','','',0,'','','',261,3,1,0),(298,'Máy bộ Dell Optiplex 760','','',0,'','','',261,4,1,0),(299,'Máy bộ Dell Optiplex 780','','<p>&nbsp;</p>\r\n<h1 style=\"text-align: center;\"><span style=\"color: rgb(255, 102, 0);\">M&aacute;y t&iacute;nh đồng bộ Dell Optiplex 780 gi&aacute; rẻ&nbsp;</span></h1>\r\n<h2 style=\"margin-left: 40px;\"><span style=\"font-size: large;\">* C&aacute;c đặc điểm nổi bật của m&aacute;y bộ Dell OPtiplex 780</span></h2>\r\n<p><span style=\"font-size: medium;\">&nbsp;-&nbsp;<strong>M&aacute;y bộ Dell Optiplex 780&nbsp;</strong>sử dụng chipset Q45. Hỗ trợ gần hết c&aacute;c d&ograve;ng CPU socket 755 từ core 2 duo đến core 2 quad &nbsp;. <strong><span style=\"color: rgb(255, 153, 0);\">Sử dụng bộ nhớ DDR3</span></strong> gi&uacute;p tăng tố độ xử l&yacute; dữ liệu l&ecirc;n nhiều lần. Ngo&agrave;i ra&nbsp;<strong>m&aacute;y bộ dell Optiplex 780&nbsp;</strong>c&ograve;n được t&iacute;ch hợp card đồ họa onboarb GMA 4500HD l&ecirc;n đến 1GB, <strong>Dell optiplex 780</strong>&nbsp;hỗ trợ tốt cho người d&ugrave;ng với c&aacute;c nhu cầu giải tr&iacute; như xem phim HD, chơi c&aacute;c game nhẹ, xử l&yacute; đồ họa Photsshop, Autocad.&nbsp;</span></p>\r\n<h2 style=\"margin-left: 40px;\">&nbsp;</h2>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>',0,'','','',261,5,1,0),(300,'Máy bộ Dell Optiplex 790 ( Core i3, i5, i7)','','',0,'','','',261,6,1,0),(301,'Máy bộ Dell Optiplex 960','','',0,'','','',261,7,1,0),(302,'Máy bộ Dell Vostro / Inpiron','','',0,'','','',261,8,1,0),(303,'Máy bộ Dell XPS / Studio','','',0,'','','',261,9,1,0),(304,'Máy bộ Dell Optiplex 380','','',0,'','','',261,10,1,0);

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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_file` */

/*Table structure for table `tbl_product` */

DROP TABLE IF EXISTS `tbl_product`;

CREATE TABLE `tbl_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `slug` varchar(128) NOT NULL,
  `category_id` int(11) NOT NULL,
  `image_id` int(11) DEFAULT NULL,
  `description` varchar(1024) DEFAULT NULL,
  `general` text,
  `info_tech` text,
  `price` decimal(10,0) NOT NULL DEFAULT '0',
  `price_new` decimal(10,0) DEFAULT NULL,
  `percent` int(11) DEFAULT NULL,
  `viewed` int(11) DEFAULT NULL,
  `status` enum('draft','waiting','published') DEFAULT NULL,
  `seo_title` varchar(128) DEFAULT NULL,
  `seo_keyword` varchar(128) DEFAULT NULL,
  `seo_description` varchar(256) DEFAULT NULL,
  `published_date` int(10) NOT NULL DEFAULT '0',
  `created_date` int(10) NOT NULL,
  `created_by` varchar(32) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_product` */

/*Table structure for table `tbl_product_file` */

DROP TABLE IF EXISTS `tbl_product_file`;

CREATE TABLE `tbl_product_file` (
  `product_id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`product_id`,`file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tbl_product_file` */

/*Table structure for table `tbl_product_related` */

DROP TABLE IF EXISTS `tbl_product_related`;

CREATE TABLE `tbl_product_related` (
  `product_id` int(11) NOT NULL,
  `related_id` int(11) NOT NULL,
  `sorting` int(11) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`product_id`,`related_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tbl_product_related` */

/*Table structure for table `tbl_product_tag` */

DROP TABLE IF EXISTS `tbl_product_tag`;

CREATE TABLE `tbl_product_tag` (
  `product_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`product_id`,`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tbl_product_tag` */

/*Table structure for table `tbl_tag` */

DROP TABLE IF EXISTS `tbl_tag`;

CREATE TABLE `tbl_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `slug` varchar(128) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_tag` */

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
