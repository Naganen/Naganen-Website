DROP TABLE IF EXISTS `ban_list`;
CREATE TABLE `ban_list` (
  `account` varchar(12) CHARACTER SET latin1 DEFAULT NULL,
  `reason` varchar(64) CHARACTER SET latin1 DEFAULT NULL,
  `source` varchar(12) CHARACTER SET latin1 DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `action` enum('ban','unban') CHARACTER SET latin1 DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

ALTER TABLE `account` ADD `email_onay` varchar(855) NOT NULL;
ALTER TABLE `account` ADD `ban_sure` varchar(855) NOT NULL;
ALTER TABLE `account` ADD `ban_time` varchar(855) NOT NULL;
ALTER TABLE `account` ADD `kim_banlamis` varchar(855) NOT NULL;
