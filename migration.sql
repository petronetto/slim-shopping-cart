# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.60)
# Database: cart
# Generation Time: 2018-05-27 04:39:09 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table addresses
# ------------------------------------------------------------

DROP TABLE IF EXISTS `addresses`;

CREATE TABLE `addresses` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `address1` varchar(255) NOT NULL DEFAULT '',
  `address2` varchar(255) DEFAULT NULL,
  `city` varchar(255) NOT NULL DEFAULT '',
  `zipcode` varchar(255) NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table customers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `customers`;

CREATE TABLE `customers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table orders
# ------------------------------------------------------------

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `hash` varchar(255) NOT NULL DEFAULT '',
  `total` float NOT NULL,
  `address_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `paid` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table orders_products
# ------------------------------------------------------------

DROP TABLE IF EXISTS `orders_products`;

CREATE TABLE `orders_products` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table payments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `payments`;

CREATE TABLE `payments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `failed` tinyint(1) NOT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table products
# ------------------------------------------------------------

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `slug` varchar(255) NOT NULL DEFAULT '',
  `description` text,
  `price` float NOT NULL,
  `image` varchar(255) DEFAULT '',
  `stock` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;

INSERT INTO `products` (`id`, `title`, `slug`, `description`, `price`, `image`, `stock`, `created_at`, `updated_at`)
VALUES
	(1,'Longos - Burritos','longos-burritos','Sit amet eros suspendisse accumsan tortor quis turpis sed ante',14.42,'http://dummyimage.com/800x600.jpg/cc0000/ffffff',7,'2017-09-29 12:26:53','2018-05-21 03:00:32'),
	(2,'Eggplant Oriental','eggplant-oriental','Fermentum justo nec condimentum neque sapien placerat ante nulla justo aliquam quis turpis eget elit sodales',16.25,'http://dummyimage.com/800x600.jpg/ff4444/ffffff',18,'2017-06-03 22:18:06','2017-09-28 06:21:33'),
	(3,'Cleaner - Bleach','cleaner-bleach','Non pretium quis lectus suspendisse potenti in eleifend quam a odio in hac habitasse platea dictumst maecenas ut',22.73,'http://dummyimage.com/800x600.jpg/cc0000/ffffff',5,'2017-10-18 20:37:46','2018-03-20 07:41:52'),
	(4,'Juice - Apple','juice-apple','Vel augue vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae donec pharetra magna vestibulum aliquet',40.96,'http://dummyimage.com/800x600.jpg/dddddd/000000',39,'2017-11-07 22:07:06','2018-01-24 00:45:22'),
	(5,'Syrup - Golden','syrup-golden','Neque aenean auctor gravida sem praesent id massa id nisl venenatis lacinia aenean sit amet justo morbi',56.44,'http://dummyimage.com/800x600.jpg/dddddd/000000',27,'2018-04-26 22:59:11','2017-07-18 06:44:28'),
	(6,'Jack Daniels','jack-daniels','Magna vulputate luctus cum sociis natoque penatibus et magnis dis',35.29,'http://dummyimage.com/800x600.jpg/cc0000/ffffff',35,'2017-10-12 22:46:02','2018-05-09 06:52:30'),
	(7,'Sprouts Dikon','sprouts-dikon','Posuere cubilia curae donec pharetra magna vestibulum aliquet ultrices erat',50.69,'http://dummyimage.com/800x600.jpg/dddddd/000000',0,'2017-08-30 01:17:58','2018-01-02 04:36:01'),
	(8,'Pastry - Chocolate Chip Muffin','Pastry-chocolate-chip-muffin','curae duis faucibus accumsan odio curabitur convallis duis consequat dui',69.39,'http://dummyimage.com/800x600.jpg/dddddd/000000',19,'2017-10-11 13:50:46','2017-07-26 14:04:39'),
	(9,'Glass Clear 7 Oz Xl','glass-clear-7-oz-xl','Sapien iaculis congue vivamus metus arcu adipiscing molestie hendrerit at vulputate vitae nisl aenean lectus pellentesque',10.22,'http://dummyimage.com/800x600.jpg/ff4444/ffffff',38,'2018-02-01 10:11:14','2017-07-22 21:44:48'),
	(10,'Potatoes - Purple','potatoes-purple','Magna ac consequat metus sapien ut nunc vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere',43.27,'http://dummyimage.com/800x600.jpg/5fa2dd/ffffff',33,'2017-12-18 17:19:06','2017-11-25 18:32:51');

/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
