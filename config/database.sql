CREATE TABLE `tl_userlytics` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ts` int(10) unsigned NOT NULL,
  `url` varchar(255) NOT NULL,
  `os` varchar(128) NOT NULL,
  `browser` varchar(128) NOT NULL,
  `browserversion` varchar(128) NOT NULL,
  `mobile` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;