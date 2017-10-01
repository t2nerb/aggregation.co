CREATE DATABASE IF NOT EXISTS project1;
USE project1;

CREATE TABLE IF NOT EXISTS `feeds` (

	`id` int(11) NOT NULL,

	`displayColumn` int(11) NOT NULL,

	`link` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL

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

INSERT INTO feeds (id, displayColumn, link) VALUES (1, 1, 'http://feeds.denverpost.com/dp-news-breaking-local');
INSERT INTO feeds (id, displayColumn, link) VALUES (2, 2, 'http://www.espn.com/espn/rss/news');
INSERT INTO feeds (id, displayColumn, link) VALUES (3, 3, 'https://www.wired.com/feed/rss');
