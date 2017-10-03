CREATE DATABASE IF NOT EXISTS project1;
USE project1;

CREATE TABLE IF NOT EXISTS `feeds` (

	`id` int(11) AUTO_INCREMENT,

	`displayColumn` int(11) NOT NULL,

	`link` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,

    PRIMARY KEY (`id`)

) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `items` (

	`id` int(11) NOT NULL,

	`feedTitle` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,

	`feedLink` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,

	`itemTitle` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,

	`itemPubDate` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,

	`itemLink` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,

	`itemDesc` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL

) ENGINE=MyISAM DEFAULT CHARSET=utf8;
