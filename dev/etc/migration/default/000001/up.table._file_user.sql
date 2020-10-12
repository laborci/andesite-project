CREATE TABLE `_file_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ownerId` int(11) unsigned NOT NULL,
  `category` varchar(16) NOT NULL DEFAULT '',
  `filename` varchar(255) NOT NULL DEFAULT '',
  `sequence` int(11) unsigned NOT NULL,
  `meta` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique` (`filename`,`category`,`ownerId`),
  KEY `search` (`ownerId`,`category`,`sequence`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;