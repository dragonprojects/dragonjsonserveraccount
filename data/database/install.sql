CREATE TABLE `accounts` (
	`account_id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	`created` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
	`name` VARCHAR(255) NOT NULL,
	`language` CHAR(2) NOT NULL,
	`betakey` CHAR(32) NULL,
	PRIMARY KEY (`account_id`),
	UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `sessions` (
	`session_id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	`modified` TIMESTAMP NOT NULL DEFAULT NOW() ON UPDATE NOW(),
	`created` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
	`account_id` BIGINT(20) UNSIGNED NOT NULL,
	`sessionhash` CHAR(32) NOT NULL,
	`data` TEXT NOT NULL,
	PRIMARY KEY (`session_id`),
	UNIQUE KEY `sessionhash` (`sessionhash`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `betakeys` (
	`betakey_id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	`betakey` CHAR(32) NOT NULL,
	PRIMARY KEY (`betakey_id`),
	UNIQUE KEY `betakey` (`betakey`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
