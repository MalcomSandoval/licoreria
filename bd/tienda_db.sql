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
  `key` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_general_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla tienda_db.cache: ~0 rows (aproximadamente)

-- Volcando estructura para tabla tienda_db.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla tienda_db.cache_locks: ~0 rows (aproximadamente)

-- Volcando estructura para tabla tienda_db.detalles_venta
CREATE TABLE IF NOT EXISTS `detalles_venta` (
  `id` char(36) COLLATE utf8mb4_general_ci NOT NULL,
  `venta_id` char(36) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `producto_id` char(36) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cantidad` int DEFAULT NULL,
  `precio_unitario` decimal(10,2) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  `precio_compra` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `venta_id` (`venta_id`),
  KEY `producto_id` (`producto_id`),
  CONSTRAINT `detalles_venta_ibfk_1` FOREIGN KEY (`venta_id`) REFERENCES `ventas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `detalles_venta_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla tienda_db.detalles_venta: ~4 rows (aproximadamente)
INSERT INTO `detalles_venta` (`id`, `venta_id`, `producto_id`, `cantidad`, `precio_unitario`, `subtotal`, `precio_compra`) VALUES
	('1532295a-1426-4f74-991d-960fe7e5269c', '5b16fc0b-9193-4947-ba35-938d348a9ef0', 'da6f3011-002a-4d05-b029-5887c9ce50fa', 3, 1.00, 3.00, 0.40),
	('1d47a8ea-d70b-4b34-b512-2bf1c6303036', '12b68400-a8cb-46b9-9ec6-400ebdffeb29', 'da6f3011-002a-4d05-b029-5887c9ce50fa', 11, 1.00, 11.00, 0.40),
	('20612e32-becd-4c64-9822-3d01ab53e1ac', '6c39a127-557b-4663-bf6d-37dbf6820cde', 'da6f3011-002a-4d05-b029-5887c9ce50fa', 1, 1.00, 1.00, 0.00),
	('3f370798-d0ce-4cb6-8ed8-cac76e7a1c64', 'c2edf613-a92b-4279-b135-cf1e78a1047d', 'da6f3011-002a-4d05-b029-5887c9ce50fa', 1, 1.00, 1.00, 0.50),
	('9572532a-f3d4-49bd-bffe-520a11fb9679', '9bd8beec-87e1-4475-9d27-09c5381f95a9', 'da6f3011-002a-4d05-b029-5887c9ce50fa', 1, 1.00, 1.00, 0.40),
	('fa4035eb-e040-4c5e-a818-2036c0d8b4e7', '5c49d861-e68d-464e-8e22-b539eb03bfcf', '6b3d5fd1-4cd1-4735-af06-10bad7c31ff1', 21, 1000.00, 21000.00, 500.00);

-- Volcando estructura para tabla tienda_db.productos
CREATE TABLE IF NOT EXISTS `productos` (
  `id` char(36) COLLATE utf8mb4_general_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `descripcion` text COLLATE utf8mb4_general_ci,
  `precio` decimal(10,2) DEFAULT NULL,
  `precio_compra` decimal(10,2) NOT NULL DEFAULT '0.00',
  `stock` int DEFAULT '0',
  `categoria` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `codigo_barras` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `activo` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cantidad_caja` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla tienda_db.productos: ~1 rows (aproximadamente)
INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `precio_compra`, `stock`, `categoria`, `codigo_barras`, `activo`, `created_at`, `updated_at`, `cantidad_caja`) VALUES
	('6b3d5fd1-4cd1-4735-af06-10bad7c31ff1', 'agua', NULL, 1000.00, 500.00, 458, 'Bebidas', 'awadwad', 1, '2026-04-09 23:57:17', '2026-04-09 23:57:46', 20),
	('da6f3011-002a-4d05-b029-5887c9ce50fa', 'kmsjfs', 'sg', 1.00, 0.40, 18, 'Snacks', '324252', 1, '2026-03-27 12:39:01', '2026-04-09 23:50:50', 10);

-- Volcando estructura para tabla tienda_db.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` char(36) COLLATE utf8mb4_general_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `correo` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contrasena` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `rol` varchar(50) COLLATE utf8mb4_general_ci DEFAULT 'usuario',
  `activo` tinyint DEFAULT '0',
  `codigo_verificacion` varchar(6) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `correo` (`correo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla tienda_db.usuarios: ~0 rows (aproximadamente)
INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `contrasena`, `rol`, `activo`, `codigo_verificacion`, `created_at`) VALUES
	('13648e35-197f-472c-a896-d50090561d37', 'kleverson escudero', 'escuderoparra0908@gmail.com', '$2y$12$S4I1xCgzSX41WuQYgADb.uQgFcV6usphiXS76UhAr8hqDjs65C6HC', 'usuario', 1, NULL, '2026-04-09 18:31:16'),
	('c54cbdb2-fc53-482b-8926-f55d14cb6a98', 'malcom', 'malcomsandoval04@gmail.com', '$2y$12$.7Hk64AvqAQMEGnXWZ7GD.PabIJZRspQN1UGnisWktw.nOhQniCGu', 'usuario', 1, NULL, '2026-03-27 12:41:28');

-- Volcando estructura para tabla tienda_db.ventas
CREATE TABLE IF NOT EXISTS `ventas` (
  `id` char(36) COLLATE utf8mb4_general_ci NOT NULL,
  `usuario_id` char(36) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `precio_compra` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `fecha_venta` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `metodo_pago` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `activa` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla tienda_db.ventas: ~4 rows (aproximadamente)
INSERT INTO `ventas` (`id`, `usuario_id`, `total`, `precio_compra`, `fecha_venta`, `metodo_pago`, `activa`) VALUES
	('12b68400-a8cb-46b9-9ec6-400ebdffeb29', '13648e35-197f-472c-a896-d50090561d37', 11.00, 4.400000, '2026-04-09 23:50:50', 'efectivo', 1),
	('5b16fc0b-9193-4947-ba35-938d348a9ef0', 'c54cbdb2-fc53-482b-8926-f55d14cb6a98', 3.00, 1.200000, '2026-04-09 18:34:13', 'efectivo', 1),
	('5c49d861-e68d-464e-8e22-b539eb03bfcf', '13648e35-197f-472c-a896-d50090561d37', 21000.00, 10500.000000, '2026-04-09 23:57:46', 'efectivo', 1),
	('6c39a127-557b-4663-bf6d-37dbf6820cde', 'c54cbdb2-fc53-482b-8926-f55d14cb6a98', 1.00, 0.000000, '2026-04-07 02:05:07', 'efectivo', 0),
	('9bd8beec-87e1-4475-9d27-09c5381f95a9', 'c54cbdb2-fc53-482b-8926-f55d14cb6a98', 1.00, 0.400000, '2026-04-07 22:29:05', 'efectivo', 1),
	('c2edf613-a92b-4279-b135-cf1e78a1047d', 'c54cbdb2-fc53-482b-8926-f55d14cb6a98', 1.00, 0.500000, '2026-04-07 22:26:18', 'efectivo', 1);

-- Volcando estructura para disparador tienda_db.actualizar_total_venta
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
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

-- Volcando estructura para disparador tienda_db.reducir_stock
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
DELIMITER //
CREATE TRIGGER `reducir_stock` AFTER INSERT ON `detalles_venta` FOR EACH ROW BEGIN
  UPDATE productos
  SET stock = stock - NEW.cantidad
  WHERE id = NEW.producto_id;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
