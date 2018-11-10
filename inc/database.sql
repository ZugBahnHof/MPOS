-- 1. Eine Datenbank anlegen, welche mit latin1_german1_ci kollatiert ist!
-- 2. Folgende Codeblöcke nacheinander in dieser Datenbank ausführen

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `passwort` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vorname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nachname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `passwortcode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `passwortcode_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`), UNIQUE (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


CREATE TABLE `securitytokens` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `user_id` int(10) NOT NULL,
  `identifier` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `securitytoken` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


CREATE TABLE `money` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `change_price` double NOT NULL,
  `balance` double NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;


CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE latin1_german1_ci NOT NULL,
  `description` varchar(255) COLLATE latin1_german1_ci NOT NULL,
  `barcode` int(10) unsigned NOT NULL,
  `price` double NOT NULL,
  `quantity` int(10) unsigned DEFAULT NULL,
  `color` VARCHAR( 7 ) NOT NULL,
  PRIMARY KEY (`id`), UNIQUE (`barcode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;

CREATE TABLE IF NOT EXISTS `company` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE latin1_german1_ci NOT NULL,
  `street` varchar(255) COLLATE latin1_german1_ci NOT NULL,
  `number` int(10) unsigned NOT NULL,
  `postcode` int(10) unsigned NOT NULL,
  `city` varchar(255) COLLATE latin1_german1_ci NOT NULL,
  `state` varchar(255) COLLATE latin1_german1_ci NOT NULL,
  `email` varchar(255) COLLATE latin1_german1_ci NOT NULL,
  `tel` int(10) unsigned NOT NULL,
  `logo` varchar(255) COLLATE latin1_german1_ci NOT NULL,
  PRIMARY KEY (`id`), UNIQUE (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;

INSERT INTO `MPOS`.`company` (`id`, `name`, `street`, `number`, `postcode`, `city`, `state`, `email`, `tel`, `logo`) VALUES (NULL, 'Name', 'Straße', '0', '12345', 'Stadt', 'Deutschland', 'kontakt@firma.de', '1234567890', 'logo/logo.svg');
