CREATE TABLE IF NOT EXISTS `users` (
	  `rowid` bigint(20) NOT NULL AUTO_INCREMENT,
	  `id` char(36) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `usergroupid` char(36) DEFAULT NULL,
  `active` char(1) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `conf_password` varchar(100) DEFAULT NULL,
  `date_entered`  datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified`  datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_user_id`  bigint(20) NOT NULL DEFAULT '0',
  `created_by`   bigint(20) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
   PRIMARY KEY (`rowid`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;