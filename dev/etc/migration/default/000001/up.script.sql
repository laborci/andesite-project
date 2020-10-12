SET FOREIGN_KEY_CHECKS = 0;
--run up.table.*.sql
--run up.view.*.sql
INSERT INTO `user` (`id`, `email`, `password`, `name`, `group`)
VALUES
	(1, 'spock@vulcan.vu', '$2y$10$Hu/gNpRIJITsbVGcCaR0FOwcVamBIvv09NlFcZBwUOWmiMBXJAWFO', 'elvis', 'admin');

SET FOREIGN_KEY_CHECKS = 1;
