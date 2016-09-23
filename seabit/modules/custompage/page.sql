CREATE TABLE IF NOT EXISTS `page` (
	  `rowid` bigint(20) NOT NULL AUTO_INCREMENT,
	  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `date_entered`  datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified`  datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_user_id`  bigint(20) NOT NULL DEFAULT '0',
  `created_by`   bigint(20) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
   PRIMARY KEY (`rowid`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;