use beejee;

create TABLE IF NOT EXISTS `tasks` (
  `id` integer NOT NULL AUTO_INCREMENT,
  `user` text NOT NULL,
  `email` text NOT NULL,
  `task` text NOT NULL,
  `status` smallint NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `changed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;
