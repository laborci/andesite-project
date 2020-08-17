SET FOREIGN_KEY_CHECKS = 0;
--run up.table.*.sql
--run up.view.*.sql
INSERT  INTO `user` (`name`, `email`, `password`, `groups`)  VALUE('Rock Star', 'rock@star.com', '$2y$10$fqWJsZL6avdgPXsjD6ziEO0h.d0d01G6TTsMQtKhUq8EtLXphsriG', 'visitor,admin');
SET FOREIGN_KEY_CHECKS = 1;
