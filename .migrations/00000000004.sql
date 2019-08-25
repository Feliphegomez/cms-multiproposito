-- --------------------------------------------------------
-- Host:                         181.129.103.141
-- Versión del servidor:         5.7.27-0ubuntu0.18.04.1 - (Ubuntu)
-- SO del servidor:              Linux
-- HeidiSQL Versión:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para admin_cms
CREATE DATABASE IF NOT EXISTS `admin_cms` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `admin_cms`;

-- Volcando estructura para tabla admin_cms.conversations
CREATE TABLE IF NOT EXISTS `conversations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` int(1) DEFAULT '0',
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_conversations_conversations_status` (`status`),
  CONSTRAINT `FK_conversations_conversations_status` FOREIGN KEY (`status`) REFERENCES `conversations_status` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_cms.conversations_groups
CREATE TABLE IF NOT EXISTS `conversations_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `conversation` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_conversations_groups_conversations` (`conversation`),
  KEY `FK_conversations_groups_users_login` (`user`),
  CONSTRAINT `FK_conversations_groups_conversations` FOREIGN KEY (`conversation`) REFERENCES `conversations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_conversations_groups_users_login` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_cms.conversations_replys
CREATE TABLE IF NOT EXISTS `conversations_replys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reply` json NOT NULL,
  `conversation` int(11) NOT NULL,
  `status` int(11) DEFAULT '0',
  `user` int(11) DEFAULT '0',
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_conversations_replys_users_login` (`user`),
  KEY `FK_conversations_replys_conversations` (`conversation`),
  CONSTRAINT `FK_conversations_replys_conversations` FOREIGN KEY (`conversation`) REFERENCES `conversations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_conversations_replys_users_login` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_cms.conversations_status
CREATE TABLE IF NOT EXISTS `conversations_status` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_cms.garden_comun_names
CREATE TABLE IF NOT EXISTS `garden_comun_names` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `garden` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_garden_comun_names_garden` (`garden`),
  CONSTRAINT `FK_garden_comun_names_garden` FOREIGN KEY (`garden`) REFERENCES `nodes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_cms.garden_fields
CREATE TABLE IF NOT EXISTS `garden_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL DEFAULT 'text',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_cms.garden_items
CREATE TABLE IF NOT EXISTS `garden_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `garden` int(11) NOT NULL,
  `field` int(11) NOT NULL,
  `value` mediumtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_garden_items_garden_fields` (`field`),
  KEY `FK_garden_items_garden` (`garden`),
  CONSTRAINT `FK_garden_items_garden` FOREIGN KEY (`garden`) REFERENCES `nodes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_garden_items_garden_fields` FOREIGN KEY (`field`) REFERENCES `garden_fields` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=291 DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_cms.geo_citys
CREATE TABLE IF NOT EXISTS `geo_citys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `department` int(2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `departamento_id` (`department`),
  KEY `id` (`id`),
  CONSTRAINT `FK_geo_citys_geo_departments` FOREIGN KEY (`department`) REFERENCES `geo_departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1101 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_cms.geo_departments
CREATE TABLE IF NOT EXISTS `geo_departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_cms.identifications_types
CREATE TABLE IF NOT EXISTS `identifications_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `code` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_cms.logs
CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `action` varchar(50) DEFAULT NULL,
  `tableDB` varchar(150) DEFAULT NULL,
  `data` mediumtext,
  `url` mediumtext,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_logs_users` (`user`),
  CONSTRAINT `FK_logs_users` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1898 DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_cms.media
CREATE TABLE IF NOT EXISTS `media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `type` varchar(50) NOT NULL,
  `size` varchar(50) NOT NULL,
  `path_full` text NOT NULL,
  `path_short` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_cms.menus
CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `slug` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_cms.menus_items
CREATE TABLE IF NOT EXISTS `menus_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu` int(11) NOT NULL,
  `title` varchar(150) DEFAULT '',
  `parent` int(11) DEFAULT '0',
  `tag_id` varchar(150) DEFAULT NULL,
  `tag_class` varchar(50) DEFAULT '',
  `tag_href` varchar(250) DEFAULT '#',
  `icon` varchar(50) DEFAULT '',
  `public` int(1) DEFAULT '0',
  `alls` int(1) DEFAULT '0',
  `guest` int(1) DEFAULT '0',
  `permision_controller` varchar(50) DEFAULT 'Usuarios',
  `permission_action` varchar(50) DEFAULT 'index',
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_nodes_items_menus` (`menu`),
  CONSTRAINT `menus_items_ibfk_1` FOREIGN KEY (`menu`) REFERENCES `menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_cms.nodes
CREATE TABLE IF NOT EXISTS `nodes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `subtitle` varchar(250) DEFAULT NULL,
  `path_url` mediumtext,
  `description` mediumtext,
  `type` int(11) DEFAULT NULL,
  `picture` int(11) DEFAULT NULL,
  `guests` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `Columna 1` (`id`),
  KEY `FK_garden_pictures` (`picture`),
  KEY `FK_nodes_nodes_types` (`type`),
  CONSTRAINT `FK_garden_pictures` FOREIGN KEY (`picture`) REFERENCES `pictures` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_nodes_nodes_types` FOREIGN KEY (`type`) REFERENCES `nodes_types` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_cms.nodes_items
CREATE TABLE IF NOT EXISTS `nodes_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_cms.nodes_types
CREATE TABLE IF NOT EXISTS `nodes_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `template` varchar(50) NOT NULL,
  `view` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_cms.options
CREATE TABLE IF NOT EXISTS `options` (
  `id` int(11) NOT NULL,
  `node` int(11) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `FK_options_nodes` (`node`),
  CONSTRAINT `FK_options_nodes` FOREIGN KEY (`node`) REFERENCES `nodes` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_cms.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `data` json NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_cms.pictures
CREATE TABLE IF NOT EXISTS `pictures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `size` int(32) NOT NULL,
  `data` mediumtext NOT NULL,
  `type` varchar(50) NOT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_cms.requests
CREATE TABLE IF NOT EXISTS `requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL,
  `identification_type` int(11) NOT NULL,
  `identification_number` varchar(50) NOT NULL,
  `names` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `department` int(11) NOT NULL,
  `city` int(11) NOT NULL,
  `address` text NOT NULL,
  `points_reference` text,
  `email` varchar(250) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `request` varchar(1000) NOT NULL,
  `status` int(1) DEFAULT '1',
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_requests_requests_types` (`type`),
  KEY `FK_requests_identifications_types` (`identification_type`),
  KEY `FK_requests_geo_departments` (`department`),
  KEY `FK_requests_geo_citys` (`city`),
  KEY `FK_requests_requests_status` (`status`),
  CONSTRAINT `FK_requests_geo_citys` FOREIGN KEY (`city`) REFERENCES `geo_citys` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_requests_geo_departments` FOREIGN KEY (`department`) REFERENCES `geo_departments` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_requests_identifications_types` FOREIGN KEY (`identification_type`) REFERENCES `identifications_types` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_requests_requests_status` FOREIGN KEY (`status`) REFERENCES `requests_status` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_requests_requests_types` FOREIGN KEY (`type`) REFERENCES `requests_types` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_cms.requests_status
CREATE TABLE IF NOT EXISTS `requests_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `progress` float NOT NULL,
  `close` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_cms.requests_types
CREATE TABLE IF NOT EXISTS `requests_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `subtitle` varchar(50) DEFAULT NULL,
  `description` text NOT NULL,
  `highlight` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_cms.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `names` varchar(50) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `email` varchar(150) NOT NULL,
  `password` mediumtext NOT NULL,
  `permissions` int(11) DEFAULT NULL,
  `avatar` int(11) DEFAULT NULL,
  `registered` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_connection` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE_username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `id` (`id`),
  KEY `FK_username` (`username`),
  KEY `FK_users_login_permissions` (`permissions`),
  KEY `email_key` (`email`),
  KEY `FK_users_pictures` (`avatar`),
  CONSTRAINT `FK_users_login_permissions` FOREIGN KEY (`permissions`) REFERENCES `permissions` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_users_pictures` FOREIGN KEY (`avatar`) REFERENCES `pictures` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_cms.users_requests
CREATE TABLE IF NOT EXISTS `users_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) DEFAULT NULL,
  `request` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_users_requests_users` (`user`),
  KEY `FK_users_requests_requests` (`request`),
  CONSTRAINT `FK_users_requests_requests` FOREIGN KEY (`request`) REFERENCES `requests` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_users_requests_users` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

