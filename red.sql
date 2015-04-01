/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for redone
CREATE DATABASE IF NOT EXISTS `red` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `red`;


-- Dumping structure for table redone.back_accounts
CREATE TABLE IF NOT EXISTS `back_accounts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `active` enum('yes','no') DEFAULT NULL,
  `id_position` int(10) unsigned DEFAULT NULL,
  `id_back_users` int(11) unsigned DEFAULT NULL,
  `update` datetime NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `created` datetime NOT NULL,
  `address` varchar(255) NOT NULL,
  `discount` int(11) DEFAULT '0',
  `second_name` varchar(50) DEFAULT NULL,
  `id_departments` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

-- Dumping data for table redone.back_accounts: ~13 rows (approximately)
DELETE FROM `back_accounts`;
/*!40000 ALTER TABLE `back_accounts` DISABLE KEYS */;
INSERT INTO `back_accounts` (`id`, `first_name`, `active`, `id_position`, `id_back_users`, `update`, `last_name`, `city`, `phone_number`, `created`, `address`, `discount`, `second_name`, `id_departments`) VALUES
	(1, 'Любомир', 'yes', 0, 1, '2015-03-05 17:40:07', 'Пельо', 'Київ', '+306868686', '2015-03-05 17:40:23', 'Україна, Київська обл., м.Буча, вул.маляровська 233/122', 30, NULL, NULL),
	(2, 'Андрій', 'yes', 0, 2, '2015-03-05 14:12:23', 'Припін', 'Київ', '+306767676', '2015-03-05 14:23:13', 'Україна, Київська обл., м.Буча, вул. Нітішинська 900/121', 30, NULL, NULL),
	(3, 'Святослав', 'yes', NULL, 3, '2015-03-24 00:24:49', 'Кузьма', 'Київ', '0965096979', '2015-03-05 17:43:42', 'Україна, Київська обл., м.Буча, вул. Закарпатська 233/124', NULL, '', NULL),
	(4, 'Олег', 'yes', 0, 4, '2015-03-05 17:44:23', 'Петрущак', 'Житомир', '+306565666', '2015-03-05 17:44:45', 'Україна, м.Житомир, вул. Москаленка 238/234', 0, NULL, NULL),
	(5, 'Артем', 'yes', 0, 5, '2015-03-05 17:45:23', 'Войтович', 'Запоріжжя', '+309898998', '2015-03-05 17:45:48', 'Україна, м.Запоріжжя,вул.Виїзна 454/123', 0, NULL, NULL),
	(6, 'Віталій', 'yes', 0, 6, '2015-03-05 17:46:38', 'Зарічний', 'Львів', '+309495959', '2015-03-05 17:47:00', 'Україна, м.Львів, вул.героїв УПА 562/127', 10, NULL, NULL),
	(7, 'Леонід', 'yes', 0, 7, '2015-03-05 17:47:41', 'Вишнівецький', 'Рівне', '+306777766', '2015-03-05 17:47:58', 'Україна, м.Рівне, вул. Прометеївська 321/265', 0, NULL, NULL),
	(8, 'Володимир', 'yes', 0, 8, '2015-03-05 17:48:44', 'Бондаренко', 'Луцьк', '+306334432', '2015-03-05 17:49:14', 'Україна, м.Луцьк, вул.Княжівська 543/324', 0, NULL, NULL),
	(9, 'Віталій', 'yes', 0, 9, '2015-03-05 17:52:11', 'Ропяк', 'Львів', '+309896621', '2015-03-05 17:52:24', 'Україна, м.Львів, вул.Гетьманівська 745/351', 10, NULL, NULL),
	(10, 'Артур', 'yes', 0, 10, '2015-03-05 17:53:15', 'Москаленко', 'Київ', '+302343112', '2015-03-05 17:53:34', 'Україна, м.Київ, вул.Горішня 879/124', 0, NULL, NULL),
	(32, 'Юля', 'yes', 0, 14, '0000-00-00 00:00:00', 'Семенюк', 'Київ', '+380000000', '2015-03-05 23:26:00', 'Україна, м.Київ', 0, NULL, NULL),
	(38, 'John', 'yes', 2, 16, '2015-03-21 23:34:48', 'Carmack', 'New York', '0965096979', '2015-03-21 22:14:54', 'Parkins Str. 234', NULL, '', NULL),
	(41, 'Lubomyr', 'yes', NULL, 25, '2015-04-01 22:37:28', 'Pelo', 'Ternopil\'', '380965096979', '2015-03-23 23:37:02', 'Ternopil\', lvivska str.', NULL, '', NULL);
/*!40000 ALTER TABLE `back_accounts` ENABLE KEYS */;


-- Dumping structure for table redone.back_accounts_history
CREATE TABLE IF NOT EXISTS `back_accounts_history` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `active` enum('yes','no') DEFAULT NULL,
  `id_position` int(10) unsigned DEFAULT NULL,
  `id_back_users` int(11) unsigned DEFAULT NULL,
  `update` datetime NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `created` datetime NOT NULL,
  `address` varchar(255) NOT NULL,
  `discount` int(11) DEFAULT '0',
  `second_name` varchar(50) DEFAULT NULL,
  `id_departments` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

-- Dumping data for table redone.back_accounts_history: ~3 rows (approximately)
DELETE FROM `back_accounts_history`;
/*!40000 ALTER TABLE `back_accounts_history` DISABLE KEYS */;
INSERT INTO `back_accounts_history` (`id`, `first_name`, `active`, `id_position`, `id_back_users`, `update`, `last_name`, `city`, `phone_number`, `created`, `address`, `discount`, `second_name`, `id_departments`) VALUES
	(42, 'Lubomyr', 'yes', NULL, 25, '2015-04-01 21:50:09', 'Pelo', 'Ternopil\'', '380965096979', '2015-03-23 23:37:02', 'Ternopil\', lvivska str.', NULL, '', NULL),
	(43, 'Lubomyr', 'yes', NULL, 25, '2015-04-01 21:52:36', 'Pelo', 'Ternopil\'', '380965096979', '2015-03-23 23:37:02', 'Ternopil\', lvivska str.', NULL, '', NULL),
	(44, 'Lubomyr', 'no', NULL, 25, '2015-04-01 22:03:52', 'Pelo', 'Ternopil\'', '380965096929', '2015-03-23 23:37:02', 'Ternopil\', lvivska str.', NULL, '', NULL),
	(45, 'Lubomyr', 'yes', NULL, 25, '2015-04-01 22:29:08', 'Pelo', 'Ternopil\'', '380965096979', '2015-03-23 23:37:02', 'Ternopil\', lvivska str.', NULL, '', NULL),
	(46, 'Lubomyr', 'yes', NULL, 25, '2015-04-01 22:31:03', 'Pelo', 'Ternopil\'', '380965096979', '2015-03-23 23:37:02', 'Ternopil\', lvivska str.', NULL, '', NULL),
	(47, 'Lubomyr', 'yes', NULL, 25, '2015-04-01 22:37:28', 'Pelo', 'Ternopil\'', '380965096979', '2015-03-23 23:37:02', 'Ternopil\', lvivska str.', NULL, '', NULL);
/*!40000 ALTER TABLE `back_accounts_history` ENABLE KEYS */;


-- Dumping structure for table redone.back_accounts_password_history
CREATE TABLE IF NOT EXISTS `back_accounts_password_history` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_users` int(10) unsigned NOT NULL,
  `id_users_responsible` int(10) unsigned NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table redone.back_accounts_password_history: ~0 rows (approximately)
DELETE FROM `back_accounts_password_history`;
/*!40000 ALTER TABLE `back_accounts_password_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `back_accounts_password_history` ENABLE KEYS */;

-- Dumping structure for table redone.back_departments
CREATE TABLE IF NOT EXISTS `back_departments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hide` enum('yes','no') NOT NULL,
  `created` datetime NOT NULL,
  `update` datetime NOT NULL,
  `id_parent` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table redone.back_departments: ~5 rows (approximately)
DELETE FROM `back_departments`;
/*!40000 ALTER TABLE `back_departments` DISABLE KEYS */;
INSERT INTO `back_departments` (`id`, `hide`, `created`, `update`, `id_parent`, `title`) VALUES
	(1, 'no', '2015-03-15 15:55:05', '2015-03-18 22:31:26', NULL, 'Виконавчий'),
	(2, 'no', '2015-03-15 21:17:48', '2015-03-15 21:17:48', 1, 'Керівництво'),
	(3, 'no', '2015-03-18 22:17:58', '2015-03-18 22:17:58', NULL, 'Developers'),
	(4, 'no', '2015-03-18 22:18:16', '2015-03-18 22:18:16', NULL, 'QA'),
	(5, 'no', '2015-03-18 22:18:30', '2015-03-24 00:44:47', NULL, 'Marketing');
/*!40000 ALTER TABLE `back_departments` ENABLE KEYS */;

-- Dumping structure for table redone.back_positions
CREATE TABLE IF NOT EXISTS `back_positions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `update` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Dumping data for table redone.back_positions: ~8 rows (approximately)
DELETE FROM `back_positions`;
/*!40000 ALTER TABLE `back_positions` DISABLE KEYS */;
INSERT INTO `back_positions` (`id`, `title`, `created`, `update`) VALUES
	(1, 'Виконавчий директор', '2015-03-16 22:14:10', '2015-03-18 22:14:10'),
	(2, 'Senior Software Engineer', '2015-03-18 22:14:38', '2015-03-18 22:14:38'),
	(3, 'CEO', '2015-03-18 22:14:52', '2015-03-18 22:14:52'),
	(4, 'Бухгалтер', '2015-03-18 22:15:04', '2015-03-18 22:15:04'),
	(5, 'QA Software Engineer', '2015-03-18 22:15:19', '2015-03-18 22:15:19'),
	(6, 'Software Engineer', '2015-03-18 22:15:34', '2015-03-18 22:15:34'),
	(7, 'Database Engineer', '2015-03-18 22:16:16', '2015-03-18 22:17:06'),
	(8, 'DevOps', '2015-03-18 22:17:23', '2015-03-24 00:47:50');
/*!40000 ALTER TABLE `back_positions` ENABLE KEYS */;


-- Dumping structure for table redone.back_users
CREATE TABLE IF NOT EXISTS `back_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(45) NOT NULL,
  `id_type` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- Dumping data for table redone.back_users: ~8 rows (approximately)
DELETE FROM `back_users`;
/*!40000 ALTER TABLE `back_users` DISABLE KEYS */;
INSERT INTO `back_users` (`id`, `email`, `password`, `id_type`) VALUES
	(1, 'some.love@email.com', '8679be54310af4dbf7e3e3c4767d018b', 1),
	(2, 'prypinan@gmail.com', '4a8a14e19a97dec2af30e6ff113965bb', 1),
	(3, 'sviat.kuzma@gmail.com', 'caec9d2f46c7f8989a9d0ea0d8581a7c', 1),
	(12, 'critmassandriy@hotmail.com', 'f8337563cb6c9fed57d750ed18bb10b2', 1),
	(13, 'dr.john@gmail.com', '0a7ef74274c7a7de8f4d788cca3b8357', 3),
	(14, 'yulya.semenyuk@gmail.com', 'c292d26cedd498277659093e7ccd5d3b', 1),
	(16, 'john.carmack@gmail.com', '0a7ef74274c7a7de8f4d788cca3b8357', 3),
	(25, 'liubomyr.pelo.orestovuch@gmail.com', '0a7ef74274c7a7de8f4d788cca3b8357', 3);
/*!40000 ALTER TABLE `back_users` ENABLE KEYS */;


-- Dumping structure for table redone.back_users_type
CREATE TABLE IF NOT EXISTS `back_users_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table redone.back_users_type: ~3 rows (approximately)
DELETE FROM `back_users_type`;
/*!40000 ALTER TABLE `back_users_type` DISABLE KEYS */;
INSERT INTO `back_users_type` (`id`, `title`) VALUES
	(1, 'admin'),
	(2, 'client'),
	(3, 'user');
/*!40000 ALTER TABLE `back_users_type` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
