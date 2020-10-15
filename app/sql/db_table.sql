CREATE DATABASE `travel` /*!40100 DEFAULT CHARACTER SET utf8 */ /*!80016 DEFAULT ENCRYPTION='N' */;

CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(32) DEFAULT NULL,
  `pass` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `roleid` int(11) DEFAULT NULL,
  `avatar` mediumblob,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`),
  KEY `roleid` (`roleid`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`roleid`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(64) DEFAULT NULL,
  `country_img` varchar(255) DEFAULT NULL,
  `country_info` varchar(4000) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `country` (`country`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city` varchar(64) DEFAULT NULL,
  `countryid` int(11) DEFAULT NULL,
  `cities_info` mediumtext,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ucity` (`city`,`countryid`),
  KEY `countryid` (`countryid`),
  CONSTRAINT `cities_ibfk_1` FOREIGN KEY (`countryid`) REFERENCES `countries` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `hotels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hotel` varchar(64) DEFAULT NULL,
  `cityid` int(11) DEFAULT NULL,
  `countryid` int(11) DEFAULT NULL,
  `stars` int(11) DEFAULT NULL,
  `cost` int(11) DEFAULT NULL,
  `info` mediumtext,
  `full_info` mediumtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cityid` (`cityid`),
  KEY `countryid` (`countryid`),
  CONSTRAINT `hotels_ibfk_1` FOREIGN KEY (`cityid`) REFERENCES `cities` (`id`) ON DELETE CASCADE,
  CONSTRAINT `hotels_ibfk_2` FOREIGN KEY (`countryid`) REFERENCES `countries` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `imagepath` varchar(255) DEFAULT NULL,
  `hotelid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hotelid` (`hotelid`),
  CONSTRAINT `images_ibfk_1` FOREIGN KEY (`hotelid`) REFERENCES `hotels` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `comments` (
  `id_msg` int(11) NOT NULL auto_increment,
  `hotel_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `puttime` varchar(45) NOT NULL,
  `msg` varchar(500) NOT NULL,
  `hide` enum('show','hide') DEFAULT 'show',
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id_msg`),
  KEY `hotel_id` (`hotel_id`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`) ON DELETE CASCADE,
  KEY `user_id` (`user_id`),
  CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;