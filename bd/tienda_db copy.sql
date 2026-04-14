-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.30 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para tienda_db
CREATE DATABASE IF NOT EXISTS `tienda_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `tienda_db`;

-- Volcando estructura para tabla tienda_db.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla tienda_db.cache: ~0 rows (aproximadamente)

-- Volcando estructura para tabla tienda_db.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla tienda_db.cache_locks: ~0 rows (aproximadamente)

-- Volcando estructura para tabla tienda_db.detalles_venta
CREATE TABLE IF NOT EXISTS `detalles_venta` (
  `id` char(36) NOT NULL,
  `venta_id` char(36) DEFAULT NULL,
  `producto_id` char(36) DEFAULT NULL,
  `tipo_venta` varchar(50) DEFAULT NULL,
  `cantidad` int DEFAULT NULL,
  `precio_unitario` decimal(10,2) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  `precio_compra` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `venta_id` (`venta_id`),
  KEY `producto_id` (`producto_id`),
  CONSTRAINT `detalles_venta_ibfk_1` FOREIGN KEY (`venta_id`) REFERENCES `ventas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `detalles_venta_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla tienda_db.detalles_venta: ~1 rows (aproximadamente)
INSERT INTO `detalles_venta` (`id`, `venta_id`, `producto_id`, `tipo_venta`, `cantidad`, `precio_unitario`, `subtotal`, `precio_compra`) VALUES
	('2b269d33-87f7-4105-8f0f-b05647138a31', 'f45fe939-6951-41a9-a4ca-85b76a574e43', '3855d501-f81d-474f-bd47-d5d088fa370b', 'unidad', 20, 1000.00, 20000.00, 500.00),
	('41919864-b8af-490b-aabf-2069e4ed53b9', '111d903a-4a5b-4192-b633-dfa8d3c3e424', '3855d501-f81d-474f-bd47-d5d088fa370b', 'unidad', 10, 1000.00, 10000.00, 500.00),
	('60abb7a3-3bca-4e94-8ff5-d2d27b65176d', '91d89ca9-f7c1-492b-a06d-96fba6f95f51', '3855d501-f81d-474f-bd47-d5d088fa370b', 'unidad', 10, 1000.00, 10000.00, 500.00);

-- Volcando estructura para tabla tienda_db.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla tienda_db.migrations: ~1 rows (aproximadamente)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '2026_04_14_172007_create_proveedors_table', 2);

-- Volcando estructura para tabla tienda_db.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla tienda_db.password_reset_tokens: ~0 rows (aproximadamente)

-- Volcando estructura para tabla tienda_db.productos
CREATE TABLE IF NOT EXISTS `productos` (
  `id` char(36) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `descripcion` text,
  `stock` int DEFAULT '0',
  `precio` decimal(10,2) DEFAULT NULL,
  `precio_compra` decimal(10,2) NOT NULL DEFAULT '0.00',
  `precio_venta_caja` decimal(10,2) DEFAULT NULL,
  `precio_caja` decimal(10,2) DEFAULT NULL,
  `cantidad_caja` int DEFAULT NULL,
  `categoria` varchar(100) DEFAULT 'General',
  `codigo_barras` varchar(100) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla tienda_db.productos: ~0 rows (aproximadamente)
INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `stock`, `precio`, `precio_compra`, `precio_venta_caja`, `precio_caja`, `cantidad_caja`, `categoria`, `codigo_barras`, `activo`, `created_at`, `updated_at`) VALUES
	('3855d501-f81d-474f-bd47-d5d088fa370b', 'agua', NULL, 411, 1000.00, 500.00, 5000.00, 10000.00, 20, 'General', 'awadwad', 1, '2026-04-14 16:54:14', '2026-04-14 22:13:58');

-- Volcando estructura para tabla tienda_db.proveedores
CREATE TABLE IF NOT EXISTS `proveedores` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `empresa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion` text COLLATE utf8mb4_unicode_ci,
  `frecuencia_visita` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla tienda_db.proveedores: ~0 rows (aproximadamente)

-- Volcando estructura para tabla tienda_db.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla tienda_db.sessions: ~0 rows (aproximadamente)

-- Volcando estructura para tabla tienda_db.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla tienda_db.users: ~0 rows (aproximadamente)

-- Volcando estructura para tabla tienda_db.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` char(36) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `correo` varchar(150) DEFAULT NULL,
  `contrasena` varchar(255) DEFAULT NULL,
  `rol` varchar(50) DEFAULT 'usuario',
  `activo` tinyint DEFAULT '0',
  `codigo_verificacion` varchar(6) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `correo` (`correo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla tienda_db.usuarios: ~2 rows (aproximadamente)
INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `contrasena`, `rol`, `activo`, `codigo_verificacion`, `created_at`) VALUES
	('13648e35-197f-472c-a896-d50090561d37', 'kleverson escudero', 'escuderoparra0908@gmail.com', '$2y$12$S4I1xCgzSX41WuQYgADb.uQgFcV6usphiXS76UhAr8hqDjs65C6HC', 'usuario', 1, NULL, '2026-04-09 23:31:16'),
	('c54cbdb2-fc53-482b-8926-f55d14cb6a98', 'malcom', 'malcomsandoval04@gmail.com', '$2y$12$.7Hk64AvqAQMEGnXWZ7GD.PabIJZRspQN1UGnisWktw.nOhQniCGu', 'usuario', 1, NULL, '2026-03-27 17:41:28');

-- Volcando estructura para tabla tienda_db.ventas
CREATE TABLE IF NOT EXISTS `ventas` (
  `id` char(36) NOT NULL,
  `usuario_id` char(36) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `precio_compra` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `fecha_venta` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `metodo_pago` varchar(50) DEFAULT 'efectivo',
  `activa` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla tienda_db.ventas: ~1 rows (aproximadamente)
INSERT INTO `ventas` (`id`, `usuario_id`, `total`, `precio_compra`, `fecha_venta`, `metodo_pago`, `activa`) VALUES
	('111d903a-4a5b-4192-b633-dfa8d3c3e424', 'c54cbdb2-fc53-482b-8926-f55d14cb6a98', 10000.00, 5000.000000, '2026-04-14 22:11:11', 'efectivo', 0),
	('91d89ca9-f7c1-492b-a06d-96fba6f95f51', 'c54cbdb2-fc53-482b-8926-f55d14cb6a98', 10000.00, 5000.000000, '2026-04-14 21:56:45', 'efectivo', 0),
	('9af81bbc-4e54-4efb-b2d0-11e683267ee9', '13648e35-197f-472c-a896-d50090561d37', 6000.00, 1000.000000, '2026-04-13 08:06:12', 'efectivo', 0),
	('f45fe939-6951-41a9-a4ca-85b76a574e43', 'c54cbdb2-fc53-482b-8926-f55d14cb6a98', 20000.00, 10000.000000, '2026-04-14 22:13:58', 'efectivo', 1);

-- Volcando estructura para disparador tienda_db.actualizar_total_venta
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `actualizar_total_venta` AFTER INSERT ON `detalles_venta` FOR EACH ROW BEGIN
  UPDATE ventas
  SET total = (
    SELECT SUM(subtotal)
    FROM detalles_venta
    WHERE venta_id = NEW.venta_id
  )
  WHERE id = NEW.venta_id;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
