SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


CREATE TABLE IF NOT EXISTS `addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `address` varchar(256) NOT NULL,
  `city` varchar(256) NOT NULL,
  `zip_code` varchar(10) NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user` (`user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `password` varchar(256) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

CREATE TABLE IF NOT EXISTS `banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) NOT NULL,
  `link` varchar(256) NOT NULL,
  `blank` tinyint(1) NOT NULL,
  `priority` int(11) NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `priority` (`priority`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

CREATE TABLE IF NOT EXISTS `brands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ka_name` varchar(255) NOT NULL,
  `en_name` varchar(255) NOT NULL,
  `ru_name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `link` varchar(1024) NOT NULL,
  `priority` int(11) NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `priority` (`priority`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ka_name` varchar(255) NOT NULL,
  `en_name` varchar(255) NOT NULL,
  `ru_name` varchar(255) NOT NULL,
  `slug` varchar(180) NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=71 ;

CREATE TABLE IF NOT EXISTS `gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `product` (`product`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1039 ;

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `address` varchar(1024) NOT NULL,
  `ka_description` text NOT NULL,
  `en_description` text NOT NULL,
  `ru_description` text NOT NULL,
  `status` int(11) NOT NULL,
  `amount` decimal(20,2) NOT NULL,
  `transaction_id` varchar(200) NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `transaction_id_2` (`transaction_id`),
  KEY `user` (`user`),
  KEY `transaction_id` (`transaction_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=49 ;

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ka_title` varchar(255) NOT NULL,
  `en_title` varchar(255) NOT NULL,
  `ru_title` varchar(255) NOT NULL,
  `ka_body` text NOT NULL,
  `en_body` text NOT NULL,
  `ru_body` text NOT NULL,
  `slug` varchar(255) NOT NULL,
  `priority` int(11) NOT NULL,
  `navigation` tinyint(1) NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `slug` (`slug`),
  KEY `priority` (`priority`),
  KEY `navigation` (`navigation`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

CREATE TABLE IF NOT EXISTS `pinned_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ka_description` text NOT NULL,
  `en_description` text NOT NULL,
  `ru_description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `link` varchar(1024) NOT NULL,
  `blank` tinyint(1) NOT NULL DEFAULT '0',
  `priority` int(11) NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ka_name` varchar(255) NOT NULL,
  `en_name` varchar(255) NOT NULL,
  `ru_name` varchar(255) NOT NULL,
  `ka_description` text NOT NULL,
  `en_description` text NOT NULL,
  `ru_description` text NOT NULL,
  `brand` varchar(256) NOT NULL,
  `brand_image` varchar(256) NOT NULL,
  `price` decimal(20,2) NOT NULL,
  `ka_price_label` varchar(256) NOT NULL,
  `en_price_label` varchar(256) NOT NULL,
  `ru_price_label` varchar(256) NOT NULL,
  `in_stock` int(11) NOT NULL,
  `for_sale` tinyint(1) NOT NULL,
  `category` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `video` text NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `slug` (`slug`),
  KEY `category` (`category`),
  KEY `price` (`price`),
  KEY `in_stock` (`in_stock`),
  KEY `for_sale` (`for_sale`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=344 ;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(256) NOT NULL,
  `last_name` varchar(256) NOT NULL,
  `personal_number` varchar(20) NOT NULL,
  `email` varchar(220) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(256) NOT NULL,
  `token` varchar(256) NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `phone` (`phone`),
  KEY `token` (`token`(255))
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;


ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `gallery`
  ADD CONSTRAINT `gallery_ibfk_1` FOREIGN KEY (`product`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
