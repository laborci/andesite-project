CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `password` char(128) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `groups` set('visitor','admin') COLLATE utf8_hungarian_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `index_groups` (`groups`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci COMMENT='';