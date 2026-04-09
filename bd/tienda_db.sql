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

CREATE DATABASE IF NOT EXISTS `tienda_db`
DEFAULT CHARACTER SET utf8mb4
COLLATE utf8mb4_general_ci;

USE `tienda_db`;

SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `productos` (
  `id` char(36) NOT NULL,
  `nombre` varchar(255),
  `descripcion` text,
  `precio` decimal(10,2),
  `precio_compra` decimal(10,2) NOT NULL DEFAULT '0.00',
  `stock` int DEFAULT 0,
  `categoria` varchar(100),
  `codigo_barras` varchar(100),
  `activo` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `productos` VALUES
('da6f3011-002a-4d05-b029-5887c9ce50fa','kmsjfs','sg',1.00,0.40,40,'Snacks','324252',1,'2026-03-27 12:39:01','2026-04-09 18:34:28');

CREATE TABLE `usuarios` (
  `id` char(36) NOT NULL,
  `nombre` varchar(100),
  `correo` varchar(150),
  `contrasena` varchar(255),
  `rol` varchar(50) DEFAULT 'usuario',
  `activo` tinyint DEFAULT 0,
  `codigo_verificacion` varchar(6),
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `correo` (`correo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `usuarios` VALUES
('c54cbdb2-fc53-482b-8926-f55d14cb6a98','malcom','malcomsandoval04@gmail.com','$2y$12$.7Hk64AvqAQMEGnXWZ7GD.PabIJZRspQN1UGnisWktw.nOhQniCGu','usuario',1,NULL,'2026-03-27 12:41:28');

CREATE TABLE `ventas` (
  `id` char(36) NOT NULL,
  `usuario_id` char(36),
  `total` decimal(10,2),
  `precio_compra` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `fecha_venta` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `metodo_pago` varchar(50),
  `activa` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `ventas` VALUES
('5b16fc0b-9193-4947-ba35-938d348a9ef0','c54cbdb2-fc53-482b-8926-f55d14cb6a98',3.00,1.200000,'2026-04-09 18:34:13','efectivo',1),
('6c39a127-557b-4663-bf6d-37dbf6820cde','c54cbdb2-fc53-482b-8926-f55d14cb6a98',1.00,0.000000,'2026-04-07 02:05:07','efectivo',0),
('9bd8beec-87e1-4475-9d27-09c5381f95a9','c54cbdb2-fc53-482b-8926-f55d14cb6a98',1.00,0.400000,'2026-04-07 22:29:05','efectivo',1),
('c2edf613-a92b-4279-b135-cf1e78a1047d','c54cbdb2-fc53-482b-8926-f55d14cb6a98',1.00,0.500000,'2026-04-07 22:26:18','efectivo',1);

CREATE TABLE `detalles_venta` (
  `id` char(36) NOT NULL,
  `venta_id` char(36),
  `producto_id` char(36),
  `cantidad` int,
  `precio_unitario` decimal(10,2),
  `subtotal` decimal(10,2),
  `precio_compra` decimal(10,2),
  PRIMARY KEY (`id`),
  KEY `venta_id` (`venta_id`),
  KEY `producto_id` (`producto_id`),
  CONSTRAINT `detalles_venta_ibfk_1`
    FOREIGN KEY (`venta_id`) REFERENCES `ventas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `detalles_venta_ibfk_2`
    FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `detalles_venta` VALUES
('1532295a-1426-4f74-991d-960fe7e5269c','5b16fc0b-9193-4947-ba35-938d348a9ef0','da6f3011-002a-4d05-b029-5887c9ce50fa',3,1.00,3.00,0.40),
('20612e32-becd-4c64-9822-3d01ab53e1ac','6c39a127-557b-4663-bf6d-37dbf6820cde','da6f3011-002a-4d05-b029-5887c9ce50fa',1,1.00,1.00,0.00),
('3f370798-d0ce-4cb6-8ed8-cac76e7a1c64','c2edf613-a92b-4279-b135-cf1e78a1047d','da6f3011-002a-4d05-b029-5887c9ce50fa',1,1.00,1.00,0.50),
('9572532a-f3d4-49bd-bffe-520a11fb9679','9bd8beec-87e1-4475-9d27-09c5381f95a9','da6f3011-002a-4d05-b029-5887c9ce50fa',1,1.00,1.00,0.40);

DELIMITER //

CREATE TRIGGER `actualizar_total_venta`
AFTER INSERT ON `detalles_venta`
FOR EACH ROW
BEGIN
  UPDATE ventas
  SET total = (
    SELECT SUM(subtotal)
    FROM detalles_venta
    WHERE venta_id = NEW.venta_id
  )
  WHERE id = NEW.venta_id;
END//

CREATE TRIGGER `reducir_stock`
AFTER INSERT ON `detalles_venta`
FOR EACH ROW
BEGIN
  UPDATE productos
  SET stock = stock - NEW.cantidad
  WHERE id = NEW.producto_id;
END//

DELIMITER ;

SET FOREIGN_KEY_CHECKS=1;