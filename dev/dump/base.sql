-- 2020-01-31T16:40:15+01:00 - mysql:dbname=zenit;host=localhost
SET FOREIGN_KEY_CHECKS = 0;

-- Table structure for table `user`

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `password` char(128) COLLATE utf8_hungarian_ci DEFAULT NULL COMMENT 'password',
  `groups` set('Visitor','Admin') COLLATE utf8_hungarian_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- Dumping data for table `user`

LOCK TABLES `user` WRITE;
INSERT INTO `user` VALUES (1,'Spock','spock@vulcan','$2y$10$7tdLZM0PyNxfS2G8qNGQL.tA7tsLPH/dNs/EN/X16E6L2dTqIotsS','Admin');
UNLOCK TABLES;
SET FOREIGN_KEY_CHECKS = 1;

-- Completed on: 2020-01-31T16:40:15+01:00
