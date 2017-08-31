-- --------------------------------------------------------
-- Хост:                         localhost
-- Версия сервера:               5.6.24 - MySQL Community Server (GPL)
-- ОС Сервера:                   Win32
-- HeidiSQL Версия:              9.1.0.4867
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры базы данных tm
CREATE DATABASE IF NOT EXISTS `tm` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `tm`;


-- Дамп структуры для таблица tm.projects
CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы tm.projects: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` (`id`, `name`) VALUES
	(13, 'Complete the test task for Ruby Garage'),
	(14, 'For home');
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;


-- Дамп структуры для таблица tm.tasks
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(50) NOT NULL DEFAULT '0',
  `project_id` int(11) NOT NULL DEFAULT '0',
  `name` text NOT NULL,
  `order` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы tm.tasks: ~8 rows (приблизительно)
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;
INSERT INTO `tasks` (`id`, `status`, `project_id`, `name`, `order`) VALUES
	(17, 'completed', 13, 'Open this mock-up in Adobe Fireworks', 0),
	(18, 'completed', 13, 'Attentively check the file', 1),
	(19, 'completed', 13, 'Write HTML & CSS', 2),
	(20, 'completed', 13, 'Add Javascript to implement adding / editing / removing for todo items and lists taking into account as more use cases as posible', 3),
	(22, 'uncomplited', 14, 'Buy a milk', 0),
	(23, 'completed', 14, 'Call Mam', 1),
	(24, 'completed', 14, 'Cleanthe room', 2),
	(25, 'uncompleted', 14, 'Repair the DVD Player', 3);
/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
