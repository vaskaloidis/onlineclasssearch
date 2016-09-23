CREATE TABLE IF NOT EXISTS `email` (
	  `rowid` bigint(20) NOT NULL AUTO_INCREMENT,
	  `id` char(36) COLLATE latin1_general_ci NOT NULL,
  `fname` varchar() COLLATE latin1_general_ci DEFAULT NULL,
  `lname` varchar() COLLATE latin1_general_ci DEFAULT NULL,
  `email` varchar() COLLATE latin1_general_ci DEFAULT NULL,
  `phone` varchar() COLLATE latin1_general_ci DEFAULT NULL,
  `date_entered`  datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified`  datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_user_id`  bigint(20) COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  `created_by`   bigint(20) COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  `deleted` tinyint(1) COLLATE latin1_general_ci DEFAULT '0',
   PRIMARY KEY (`rowid`)
	) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;