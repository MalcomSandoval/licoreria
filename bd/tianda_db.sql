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
CREATE DATABASE IF NOT EXISTS `tienda_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `tienda_db`;

-- Volcando estructura para tabla tienda_db.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla tienda_db.cache: ~0 rows (aproximadamente)

-- Volcando estructura para tabla tienda_db.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla tienda_db.cache_locks: ~0 rows (aproximadamente)

-- Volcando estructura para tabla tienda_db.detalles_venta
CREATE TABLE IF NOT EXISTS `detalles_venta` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `venta_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `producto_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tipo_venta` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
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

-- Volcando datos para la tabla tienda_db.detalles_venta: ~76 rows (aproximadamente)
INSERT INTO `detalles_venta` (`id`, `venta_id`, `producto_id`, `tipo_venta`, `cantidad`, `precio_unitario`, `subtotal`, `precio_compra`) VALUES
	('023280f4-32d4-4991-ace0-463d265f992f', '745aa577-81e5-4330-882e-94fdfbed8cc9', '833c2f57-5778-4847-981f-36ae02cff973', 'unidad', 2, 220000.00, 440000.00, 140000.00),
	('023e6e94-0698-4f4a-9137-992eb4ad2038', '15412484-3801-4e03-ab0c-7e13939c4076', '4c4723ae-b1e5-4921-8441-19e5ba3be02e', 'unidad', 1, 155500.00, 155500.00, 100600.00),
	('0499164e-8837-498e-b15d-b6d124985778', '0082595c-9df7-4ce9-9b77-d00af640213f', '01c30cdf-906a-421f-b066-d2bf6d893e97', 'unidad', 3, 75500.00, 226500.00, 49200.00),
	('0a73a63d-9514-43e6-a01b-92ed3a732707', '1220935b-93fa-4efc-b740-f154ef345fa5', '8a432d19-82c6-4234-b74b-67b7cfc61ced', 'unidad', 1, 12000.00, 12000.00, 7800.00),
	('0f424036-d6db-44a3-aae5-ef817d8993e0', '52afe421-7958-4958-a2f8-6b4a75fdbae4', '75d31fa0-3206-445e-8ab2-216dadab64fc', 'unidad', 1, 183500.00, 183500.00, 120200.00),
	('127dcd41-e736-4d70-b48b-b567d040f6cd', '38bfcd76-c1d1-4052-bde9-0eb548f5eb1d', '147a55c2-9a7a-41ca-8f39-c9bd814c0227', 'unidad', 2, 20500.00, 41000.00, 12400.00),
	('16bf2173-0838-4d9d-8a01-165999bd4e62', '745aa577-81e5-4330-882e-94fdfbed8cc9', 'f0423c63-a537-46eb-bc70-fea7b31848c0', 'unidad', 1, 6500.00, 6500.00, 4200.00),
	('175fb6b8-e4c8-44c5-919c-2f6145c501c8', 'a2b868ee-0455-4193-a0b6-8fce56d1248a', '6f33f089-96c9-492e-87c3-686befd2d724', 'unidad', 2, 129000.00, 258000.00, 89000.00),
	('21ea2aab-ace7-423e-8bb4-d04b147cd4a4', '38bfcd76-c1d1-4052-bde9-0eb548f5eb1d', '50bcde6d-6b8b-4fae-9c27-6966729de242', 'unidad', 2, 217000.00, 434000.00, 140400.00),
	('28f98589-7fab-4ace-8c66-d222fb60c37c', '05beca71-2c55-499e-9b41-5b38650f85d2', '01b2802b-f3bd-436f-8de4-b927a2dfecdc', 'unidad', 2, 108500.00, 217000.00, 70600.00),
	('2d369ab0-8922-4a7c-80cd-94b77f20a968', 'f34bc589-1337-4838-88f8-2de219cab285', '6e67d4c9-1150-41d5-83e2-c0b442714d01', 'unidad', 2, 16700.00, 33400.00, 10600.00),
	('2d9f7b54-d366-45da-a139-c330c4d8630f', 'e0ad90c6-aca0-44f3-a19b-3dafef4fdea9', '0274cfed-bec6-40d6-b5b3-318f735eec6f', 'unidad', 3, 250000.00, 750000.00, 160000.00),
	('32c349a5-aa0a-4e61-976d-ca2fb9d5a03b', '52afe421-7958-4958-a2f8-6b4a75fdbae4', '01b2802b-f3bd-436f-8de4-b927a2dfecdc', 'unidad', 2, 108500.00, 217000.00, 70600.00),
	('363af18d-13d1-44c0-9807-5e6ce05068b5', 'e56719d8-2ffe-4f2e-a27d-53d97e5511a5', '789a0fa0-7b03-4728-bcbb-76a16aebefdc', 'unidad', 3, 5000.00, 15000.00, 2500.00),
	('3c64385c-238e-4355-950c-2274e57c06c6', '293da453-57e8-4fdd-94a2-c0befd988aad', '7539dde0-8423-4b94-941d-7803f2ab56d3', 'unidad', 2, 32000.00, 64000.00, 20500.00),
	('41c11b69-146a-4436-af1a-940c6813a210', 'af589043-4e19-4db3-8a65-52e7d7c632b1', '523111e4-5a48-427e-9575-d5dcf92357ca', 'unidad', 2, 4800.00, 9600.00, 3000.00),
	('47580e79-e01b-4ffd-a4c6-178bd7753d75', '10503689-222e-43c0-9bf2-06d741194dd1', '47b4c242-4221-4596-a03b-c078ddc79617', 'unidad', 2, 31500.00, 63000.00, 20200.00),
	('4e7409ae-909c-4567-93b2-6eb0461b6d2a', 'af589043-4e19-4db3-8a65-52e7d7c632b1', '833c2f57-5778-4847-981f-36ae02cff973', 'unidad', 2, 220000.00, 440000.00, 140000.00),
	('517f8456-79fc-44a1-8954-12170d4191b8', '10503689-222e-43c0-9bf2-06d741194dd1', 'ceffd026-4dee-4270-9774-570cc69587a8', 'unidad', 2, 8500.00, 17000.00, 5500.00),
	('5339d61d-5363-415f-97fe-271476a4002d', '10503689-222e-43c0-9bf2-06d741194dd1', 'a9d0a340-ce42-4c9d-bcef-fca1f45a5715', 'unidad', 3, 13500.00, 40500.00, 8600.00),
	('57e2b966-5e08-4d92-ad1f-fa920587552a', 'b6bb81f1-0d9b-4441-8f8e-f0a4281e0306', '5f9ef785-63f6-4dd0-8ac3-0c37cc15ffd0', 'unidad', 2, 195500.00, 391000.00, 126600.00),
	('592df3e8-6dc7-4553-9f6e-1a7f0139c710', '1721ff31-2c1a-4f80-994b-ddfa7b439c12', 'a530e2af-777e-4747-9705-a26abd8ae075', 'unidad', 3, 135500.00, 406500.00, 88200.00),
	('59375487-33c7-458f-bda2-322fd68c1053', '61dbee5a-124a-4e90-8cfe-a95fc56918d6', '7ca5ae63-cb87-4b35-b7a7-a698da80b341', 'unidad', 1, 8300.00, 8300.00, 5200.00),
	('5e159215-ffa6-4e94-a320-d8c35bb90845', 'a2b868ee-0455-4193-a0b6-8fce56d1248a', '8f031d81-b14c-4c82-b6dc-b989fc7b1f20', 'unidad', 1, 145000.00, 145000.00, 94000.00),
	('6006f20f-8eff-4392-aa23-c961b782781c', '15412484-3801-4e03-ab0c-7e13939c4076', '6a0a77c6-f012-4dff-b1e3-fdee87e432c7', 'unidad', 1, 105500.00, 105500.00, 68600.00),
	('67eb932a-b947-4d5a-90c1-472338a37a42', '3a71ed2b-58b7-48ef-8ce2-dcea53804471', 'b2ec2350-be64-482c-b072-eb69f749c14a', 'unidad', 1, 48500.00, 48500.00, 30600.00),
	('6b491ef3-481d-4d6c-b4c6-91c4b6a7bedb', 'b408bb2d-7ede-4205-8997-40a2f3cc9f9a', '3297fa29-5969-437e-8252-aff1ef16be16', 'unidad', 2, 220500.00, 441000.00, 142600.00),
	('6c9ff504-e13c-48c4-a936-49b4cdaf125c', 'a4ee4248-adf9-451c-9453-87258a643854', '523111e4-5a48-427e-9575-d5dcf92357ca', 'unidad', 1, 4800.00, 4800.00, 3000.00),
	('6eb44968-d89f-42de-bf0c-f97a5591ba66', '5cada5c5-7a3d-4f92-b9f4-6f7a1d762923', '7ca5ae63-cb87-4b35-b7a7-a698da80b341', 'unidad', 3, 8300.00, 24900.00, 5200.00),
	('715392f9-93f7-4f85-8aea-8e03e0e4840e', '1de3fbaf-9d1c-4f9a-a010-fc07047b4b39', '0274cfed-bec6-40d6-b5b3-318f735eec6f', 'unidad', 3, 250000.00, 750000.00, 160000.00),
	('72dd8476-afbb-46e0-8614-e0d51f3f3a34', '0082595c-9df7-4ce9-9b77-d00af640213f', '3297fa29-5969-437e-8252-aff1ef16be16', 'unidad', 3, 220500.00, 661500.00, 142600.00),
	('73c99f7b-56b2-4518-a6f6-c8b01cb08d67', '61dbee5a-124a-4e90-8cfe-a95fc56918d6', '518e3bf7-671e-4046-adef-79aa43c46c77', 'unidad', 1, 23500.00, 23500.00, 14200.00),
	('765c0abf-49df-4fdf-adb1-bf69e2943798', '1de3fbaf-9d1c-4f9a-a010-fc07047b4b39', '523111e4-5a48-427e-9575-d5dcf92357ca', 'unidad', 2, 4800.00, 9600.00, 3000.00),
	('767fb974-1b72-4111-9e50-708fb34bfe1e', 'b6bb81f1-0d9b-4441-8f8e-f0a4281e0306', 'ceffd026-4dee-4270-9774-570cc69587a8', 'unidad', 2, 8500.00, 17000.00, 5500.00),
	('7a7feb81-9291-41ea-bfc3-f84a26038068', 'b408bb2d-7ede-4205-8997-40a2f3cc9f9a', '6df6c00b-6dc1-43b8-92ee-aae74a997725', 'unidad', 1, 105500.00, 105500.00, 68600.00),
	('812619fa-8a9d-418b-9ecf-a15bdd38f4e6', 'd0cf1201-8438-4e6c-959f-e486437516ec', 'd4779357-b291-4417-a14e-f39bb7534d29', 'unidad', 1, 22000.00, 22000.00, 14000.00),
	('82bcf1fe-9cfd-419e-8159-0af379e565a5', 'b408bb2d-7ede-4205-8997-40a2f3cc9f9a', '416c0502-954e-4489-9e5c-ba7242a78dfa', 'unidad', 3, 15000.00, 45000.00, 9600.00),
	('887a2452-cb76-4a55-82b9-d4a6a6a5bedd', 'a4ee4248-adf9-451c-9453-87258a643854', '0325ba11-8291-4546-8253-e720544a1973', 'unidad', 3, 35500.00, 106500.00, 22700.00),
	('8b4e7ee1-949e-48d2-a31b-6b4390e2b35c', 'af589043-4e19-4db3-8a65-52e7d7c632b1', '0274cfed-bec6-40d6-b5b3-318f735eec6f', 'unidad', 1, 250000.00, 250000.00, 160000.00),
	('8db7aac1-434a-4c54-8c3b-38daa6ec3f44', 'd0cf1201-8438-4e6c-959f-e486437516ec', '6df6c00b-6dc1-43b8-92ee-aae74a997725', 'unidad', 1, 105500.00, 105500.00, 68600.00),
	('8ecc8477-448f-4958-b90f-eb6c3eb7fd65', 'b6bd84e7-31aa-44c0-abb1-942755768c13', '10f18cdd-19f8-4b8e-8f62-db80e5140014', 'unidad', 3, 71500.00, 214500.00, 46200.00),
	('8f1b1113-761d-4ad3-9c5e-f6151f9f029c', '50a7aea3-d6bb-4d25-ad05-350135d49af4', '7c1457f4-780b-4087-a8db-3d494d36e016', 'unidad', 2, 95000.00, 190000.00, 62000.00),
	('915485da-3177-42cf-b18c-a09189e6225f', '73417739-dda2-499e-9412-4650f3bf4920', '058c8e7a-5774-4045-9e54-3e21229a4961', 'unidad', 1, 9700.00, 9700.00, 6200.00),
	('94ded8e4-fa98-40dc-ab6e-73ec63125db5', '25424b09-5b96-4f0b-afa4-b01288059bfc', '0274cfed-bec6-40d6-b5b3-318f735eec6f', 'unidad', 1, 250000.00, 250000.00, 160000.00),
	('95006705-4652-4f72-8868-46d487a1570a', 'b6bb81f1-0d9b-4441-8f8e-f0a4281e0306', 'b2bb1c9d-7a74-4bc7-bd14-e5f963a954c7', 'unidad', 2, 13200.00, 26400.00, 8400.00),
	('98640358-1f5e-4890-8a53-5875d3eb6d86', 'a2b868ee-0455-4193-a0b6-8fce56d1248a', '7b23025f-e380-40e1-86d9-3975767452a7', 'unidad', 3, 25000.00, 75000.00, 15400.00),
	('9a972179-56b5-42f3-aa5c-89b58671eaf2', '993e7efb-70c3-4188-824c-d6bf2acb08b4', '01c30cdf-906a-421f-b066-d2bf6d893e97', 'unidad', 2, 75500.00, 151000.00, 49200.00),
	('9acbead0-7161-4a5c-ac6d-77e8b472a725', '50a7aea3-d6bb-4d25-ad05-350135d49af4', '416c0502-954e-4489-9e5c-ba7242a78dfa', 'unidad', 1, 15000.00, 15000.00, 9600.00),
	('a7305692-c980-441a-ad94-2d35c1f226bd', 'a4ee4248-adf9-451c-9453-87258a643854', 'b2bb1c9d-7a74-4bc7-bd14-e5f963a954c7', 'unidad', 1, 13200.00, 13200.00, 8400.00),
	('acfbebd1-7960-4a0d-b5d1-2b5a929f3349', '1220935b-93fa-4efc-b740-f154ef345fa5', '10f18cdd-19f8-4b8e-8f62-db80e5140014', 'unidad', 2, 71500.00, 143000.00, 46200.00),
	('ad4c3446-a3ea-40af-9460-9fb03a35f153', '1721ff31-2c1a-4f80-994b-ddfa7b439c12', '247bd56e-2e9a-4a4b-aa0b-bda86c89639b', 'unidad', 3, 139000.00, 417000.00, 90400.00),
	('aeba8bcf-99c7-4c96-b790-719078a5db6c', 'd098c692-ce76-480a-a96a-8b88ec62a057', '6df6c00b-6dc1-43b8-92ee-aae74a997725', 'unidad', 2, 105500.00, 211000.00, 68600.00),
	('b43cfb3d-10dd-4345-b491-903151b1da1f', '25424b09-5b96-4f0b-afa4-b01288059bfc', '7c1457f4-780b-4087-a8db-3d494d36e016', 'unidad', 1, 95000.00, 95000.00, 62000.00),
	('b58a31d7-0706-4e30-bdc4-0bf6d97217a5', 'b6bd84e7-31aa-44c0-abb1-942755768c13', '33ea659b-fb07-467e-8926-2de25da249f4', 'unidad', 3, 38000.00, 114000.00, 24000.00),
	('b628e9e0-877d-4cad-8962-d807d3b16055', '38bfcd76-c1d1-4052-bde9-0eb548f5eb1d', '8a432d19-82c6-4234-b74b-67b7cfc61ced', 'unidad', 2, 12000.00, 24000.00, 7800.00),
	('b6cfb02d-3b91-440f-989b-3f6ec5587785', '293da453-57e8-4fdd-94a2-c0befd988aad', '7286bfe2-03f9-4bd6-813c-9db0253e932c', 'unidad', 2, 117000.00, 234000.00, 75400.00),
	('c1425a06-61bd-47dc-9593-399a0fcb67fb', '86faf673-f657-4a44-b077-aa1c17b6488f', '058c8e7a-5774-4045-9e54-3e21229a4961', 'unidad', 1, 9700.00, 9700.00, 6200.00),
	('c262f853-eea3-44d0-b0f9-71bebc06e5dd', 'd0cf1201-8438-4e6c-959f-e486437516ec', '6e67d4c9-1150-41d5-83e2-c0b442714d01', 'unidad', 2, 16700.00, 33400.00, 10600.00),
	('c272937c-3153-447c-9463-f5e7a9266996', '745aa577-81e5-4330-882e-94fdfbed8cc9', 'e4f30060-cdaf-468d-8468-4a0b7d32c097', 'unidad', 3, 30000.00, 90000.00, 19000.00),
	('c390236b-bc79-439d-8f5d-143007778388', '61dbee5a-124a-4e90-8cfe-a95fc56918d6', '62712229-a5cb-4b4b-b95c-49333314d044', 'unidad', 1, 95000.00, 95000.00, 62000.00),
	('c6549eb7-62be-48d6-91af-3f038646fee1', 'a4ee4248-adf9-451c-9453-87258a643854', 'f0423c63-a537-46eb-bc70-fea7b31848c0', 'unidad', 2, 6500.00, 13000.00, 4200.00),
	('cad555ef-d614-409d-92fe-7375a4fbd86f', 'b6bb81f1-0d9b-4441-8f8e-f0a4281e0306', 'afc5ac28-0618-4489-9d87-dc945ef3a869', 'unidad', 3, 152000.00, 456000.00, 98400.00),
	('cb4b0647-ce94-4130-a65f-117e05d9ea42', '032f410a-6a10-49f8-90f7-6f57a458d9c8', '7e809341-7bfe-4c55-9b38-5219b6e200b6', 'unidad', 3, 18000.00, 54000.00, 11500.00),
	('d0018482-9da6-447b-a624-656afba1adfa', '38bfcd76-c1d1-4052-bde9-0eb548f5eb1d', '584c588b-c97a-4ec5-9648-c28917aa1a09', 'unidad', 3, 101500.00, 304500.00, 66200.00),
	('dc5a557c-32dd-44b2-b2ed-764640422df7', '2de2ea7d-d0d9-4eff-ad68-acc5c72c58e2', '2619ec02-337e-4b2f-a51d-d80310389b82', 'unidad', 1, 18500.00, 18500.00, 11800.00),
	('e107b2d1-69a8-41f4-831d-114d189a209c', '032f410a-6a10-49f8-90f7-6f57a458d9c8', 'e1173595-7aec-4850-b4bb-763f17ac147c', 'unidad', 2, 9700.00, 19400.00, 6200.00),
	('e4fd276c-cc4a-4b3c-8b90-84ee45299dda', '4f6cd4f2-c49e-45e6-a6a0-6f32bc81eab2', '25f74204-649d-42a0-94f1-c39cf4cbc3c9', 'unidad', 1, 180000.00, 180000.00, 118000.00),
	('ecb0394e-0082-48f6-be2f-8a5481ebfb2f', 'af589043-4e19-4db3-8a65-52e7d7c632b1', '16fea9d6-580e-460c-b077-d394f440f25f', 'unidad', 2, 110000.00, 220000.00, 71000.00),
	('ecb57bb1-8e11-4e73-9d7b-65874d92ebbd', '6704e238-9034-4a45-a776-4840b1a63511', 'b8d67891-0476-44ec-9f44-63c6c4cb80f7', 'unidad', 1, 148500.00, 148500.00, 96200.00),
	('ed55c3d5-6ae3-4f21-9a7b-5e913a8acf9f', '52afe421-7958-4958-a2f8-6b4a75fdbae4', '0325ba11-8291-4546-8253-e720544a1973', 'unidad', 1, 35500.00, 35500.00, 22700.00),
	('f5a135ff-b3b0-438d-82f1-178542d65d3a', '032f410a-6a10-49f8-90f7-6f57a458d9c8', '37064786-f92c-444a-b148-f125fa2bb59f', 'unidad', 1, 82500.00, 82500.00, 53600.00),
	('f72cfc0f-c58a-45ab-aa27-c58365dab283', 'fabb7aca-c026-4ebe-8dd8-30a2a97f2e9c', '62712229-a5cb-4b4b-b95c-49333314d044', 'unidad', 2, 95000.00, 190000.00, 62000.00),
	('f97f5770-97ea-447b-a040-e99a2ba3aee5', 'a2b868ee-0455-4193-a0b6-8fce56d1248a', '3ce6f83e-3fe0-4cfd-8866-bc74802b21a1', 'unidad', 1, 17000.00, 17000.00, 10800.00),
	('fbb33fb6-5bdd-4eb1-90d3-83fb6b89fc5e', '61dbee5a-124a-4e90-8cfe-a95fc56918d6', 'bbc44f6c-4d89-4404-8cb3-6333cf09578a', 'unidad', 2, 98000.00, 196000.00, 64000.00),
	('ff015e33-39b9-4a3a-a984-c66d5dd60f5b', '293da453-57e8-4fdd-94a2-c0befd988aad', '7b23025f-e380-40e1-86d9-3975767452a7', 'unidad', 3, 25000.00, 75000.00, 15400.00),
	('ffead3bb-e14c-4abd-bcea-a49e753ba011', '52afe421-7958-4958-a2f8-6b4a75fdbae4', '01c30cdf-906a-421f-b066-d2bf6d893e97', 'unidad', 1, 75500.00, 75500.00, 49200.00);

-- Volcando estructura para tabla tienda_db.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla tienda_db.migrations: ~0 rows (aproximadamente)

-- Volcando estructura para tabla tienda_db.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla tienda_db.password_reset_tokens: ~0 rows (aproximadamente)

-- Volcando estructura para tabla tienda_db.productos
CREATE TABLE IF NOT EXISTS `productos` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `stock` int DEFAULT '0',
  `stock_critico` int DEFAULT '10',
  `precio` decimal(10,2) DEFAULT NULL,
  `precio_compra` decimal(10,2) NOT NULL DEFAULT '0.00',
  `precio_venta_caja` decimal(10,2) DEFAULT NULL,
  `precio_caja` decimal(10,2) DEFAULT NULL,
  `cantidad_caja` int DEFAULT NULL,
  `categoria` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'General',
  `proveedor_id` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `codigo_barras` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `activo` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla tienda_db.productos: ~151 rows (aproximadamente)
INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `stock`, `stock_critico`, `precio`, `precio_compra`, `precio_venta_caja`, `precio_caja`, `cantidad_caja`, `categoria`, `proveedor_id`, `codigo_barras`, `activo`, `created_at`, `updated_at`) VALUES
	('01b2802b-f3bd-436f-8de4-b927a2dfecdc', 'Licor Baileys 1L', 'Presentación 1L', 1, 8, 108500.00, 70600.00, 1302000.00, 1302000.00, 12, 'Licores de Crema', 'prov-005', '5011013001004', 1, '2026-06-30 19:43:13', '2026-06-30 15:19:49'),
	('01c30cdf-906a-421f-b066-d2bf6d893e97', 'Ron Bacardí 375ml', 'Presentación 375ml', 2, 9, 75500.00, 49200.00, 906000.00, 906000.00, 12, 'Ron', 'prov-002', '80480001002', 1, '2026-06-30 19:43:13', '2026-06-30 15:19:49'),
	('0274cfed-bec6-40d6-b5b3-318f735eec6f', 'Tequila Don Julio 750ml', 'Presentación 750ml', 3, 8, 250000.00, 160000.00, 3000000.00, 3000000.00, 12, 'Tequila', 'prov-002', '81127001002', 1, '2026-06-30 19:43:13', '2026-06-30 15:19:49'),
	('0325ba11-8291-4546-8253-e720544a1973', 'Aguardiente Cristal 375ml', 'Presentación 375ml', 4, 4, 35500.00, 22700.00, 426000.00, 426000.00, 12, 'Aguardiente', 'prov-004', '7702065001002', 1, '2026-06-30 19:43:13', '2026-06-30 15:19:49'),
	('058c8e7a-5774-4045-9e54-3e21229a4961', 'Sprite 1.5L', 'Presentación 1.5L', 2, 5, 9700.00, 6200.00, 116400.00, 116400.00, 12, 'Gaseosas', 'prov-003', '7791813001005', 1, '2026-06-30 19:43:13', '2026-06-30 15:19:49'),
	('06d9628a-e40e-4101-8c58-5de863042835', 'Aguardiente Cristal 250ml', 'Presentación 250ml', 3, 5, 39000.00, 24900.00, 468000.00, 468000.00, 12, 'Aguardiente', 'prov-004', '7702065001003', 1, '2026-06-30 19:43:13', '2026-06-30 15:19:49'),
	('0879ae15-cec7-463b-ab15-5668679db843', 'Ron Medellín 250ml', 'Presentación 250ml', 1, 9, 75000.00, 48400.00, 900000.00, 900000.00, 12, 'Ron', 'prov-002', '7702065001005', 1, '2026-06-30 19:43:13', '2026-06-30 15:19:49'),
	('0cde8750-14a2-45f1-b190-2881f2acc2cf', 'Gin Bombay Sapphire 1L', 'Presentación 1L', 15, 10, 135500.00, 87600.00, 1626000.00, 1626000.00, 12, 'Gin', 'prov-005', '5000299001006', 0, '2026-06-30 19:43:13', '2026-06-30 15:17:30'),
	('0d69f0c6-7b25-4769-9de3-f7f837cc0c97', 'Licor Kahlúa 750ml', 'Presentación 750ml', 4, 4, 90000.00, 59000.00, 1080000.00, 1080000.00, 12, 'Licores', 'prov-005', '5011013001003', 1, '2026-06-30 19:43:13', '2026-06-30 15:19:49'),
	('10f18cdd-19f8-4b8e-8f62-db80e5140014', 'Ron Medellín 375ml', 'Presentación 375ml', 2, 4, 71500.00, 46200.00, 858000.00, 858000.00, 12, 'Ron', 'prov-002', '7702065001004', 1, '2026-06-30 19:43:13', '2026-06-30 15:19:49'),
	('1267ba42-89c3-465e-88a6-ab99240baab3', 'Coca-Cola Zero 400ml', 'Presentación 400ml', 3, 5, 6500.00, 4200.00, 78000.00, 78000.00, 12, 'Gaseosas', 'prov-003', '7791813001002', 1, '2026-06-30 19:43:13', '2026-06-30 15:19:50'),
	('147a55c2-9a7a-41ca-8f39-c9bd814c0227', 'Cerveza Corona Botella 330ml', 'Presentación Botella 330ml', 1, 6, 20500.00, 12400.00, 246000.00, 246000.00, 12, 'Cervezas', 'prov-001', '7501064001002', 1, '2026-06-30 19:43:13', '2026-06-30 15:19:50'),
	('1564f2bf-5b63-4a9b-90bc-df1be798919d', 'Vino Concha y Toro Rosado 750ml', 'Presentación Rosado 750ml', 4, 8, 45000.00, 28400.00, 540000.00, 540000.00, 12, 'Vino', 'prov-006', '7804320001004', 1, '2026-06-30 19:43:13', '2026-06-30 15:19:50'),
	('15bb1c45-f434-4e85-9d07-2aa3b5865696', 'Sprite 6-pack', 'Presentación 6-pack', 2, 5, 16700.00, 10600.00, 200400.00, 200400.00, 12, 'Gaseosas', 'prov-003', '7791813001007', 1, '2026-06-30 19:43:13', '2026-06-30 15:19:50'),
	('16fea9d6-580e-460c-b077-d394f440f25f', 'Gin Beefeater 750ml', 'Presentación 750ml', 3, 5, 110000.00, 71000.00, 1320000.00, 1320000.00, 12, 'Gin', 'prov-005', '5000299001002', 1, '2026-06-30 19:43:13', '2026-06-30 15:19:50'),
	('1769bb36-b4cc-4b72-965a-2fd10ec06fcc', 'Cerveza Aguila Lata 500ml', 'Presentación Lata 500ml', 1, 10, 19000.00, 12200.00, 228000.00, 228000.00, 12, 'Cervezas', 'prov-001', '7702020001003', 1, '2026-06-30 19:43:13', '2026-06-30 15:19:50'),
	('182c93da-7931-4e4d-955d-6bb77d65925d', 'Tequila Herradura 375ml', 'Presentación 375ml', 15, 7, 223500.00, 142200.00, 2682000.00, 2682000.00, 12, 'Tequila', 'prov-002', '81127001004', 0, '2026-06-30 19:43:13', '2026-06-30 15:17:30'),
	('1d442f56-a38f-423f-9535-771445ca0f8d', 'Tequila Herradura 1L', 'Presentación 1L', 4, 10, 230500.00, 146600.00, 2766000.00, 2766000.00, 12, 'Tequila', 'prov-002', '81127001006', 1, '2026-06-30 19:43:13', '2026-06-30 15:19:50'),
	('2275cd39-f434-49fd-b1a1-99b4dab5495a', 'Tequila Don Julio 250ml', 'Presentación 250ml', 2, 5, 257000.00, 164400.00, 3084000.00, 3084000.00, 12, 'Tequila', 'prov-002', '81127001004', 1, '2026-06-30 19:43:13', '2026-06-30 15:19:50'),
	('23ca4147-fbab-489c-b33d-503e08e5befb', 'Pepsi 400ml', 'Presentación 400ml', 3, 4, 6200.00, 4000.00, 74400.00, 74400.00, 12, 'Gaseosas', 'prov-003', '7791813001003', 1, '2026-06-30 19:43:13', '2026-06-30 15:19:50'),
	('24153c49-880d-47ca-9b53-ba1e06a98f82', 'Cerveza Aguila Botella 1L', 'Presentación Botella 1L', 1, 6, 22500.00, 14400.00, 270000.00, 270000.00, 12, 'Cervezas', 'prov-001', '7702020001004', 1, '2026-06-30 19:43:13', '2026-06-30 15:19:50'),
	('247bd56e-2e9a-4a4b-aa0b-bda86c89639b', 'Whisky Buchanan’s 250ml', 'Presentación 250ml', 4, 10, 139000.00, 90400.00, 1668000.00, 1668000.00, 12, 'Whisky', 'prov-002', '5000267001003', 1, '2026-06-30 19:43:13', '2026-06-30 15:19:51'),
	('25f74204-649d-42a0-94f1-c39cf4cbc3c9', 'Vodka Grey Goose 750ml', 'Presentación 750ml', 2, 10, 180000.00, 118000.00, 2160000.00, 2160000.00, 12, 'Vodka', 'prov-005', '7312040001003', 1, '2026-06-30 19:43:13', '2026-06-30 15:19:51'),
	('2619ec02-337e-4b2f-a51d-d80310389b82', 'Cerveza Poker Lata 500ml', 'Presentación Lata 500ml', 3, 7, 18500.00, 11800.00, 222000.00, 222000.00, 12, 'Cervezas', 'prov-001', '7702020001004', 1, '2026-06-30 19:43:13', '2026-06-30 15:19:51'),
	('2cc1070e-ba31-46cd-bbcf-056a50ef6a01', 'Brandy Cardenal Mendoza 700ml', 'Brandy español premium', 1, 4, 185000.00, 120000.00, 2220000.00, 2220000.00, 12, 'Brandy', 'prov-005', '8410010000001', 1, '2026-06-30 19:43:13', '2026-06-30 15:19:51'),
	('2e0f81f1-6032-44e7-a87f-5b19eb7b1df1', 'Vodka Grey Goose 250ml', 'Presentación 250ml', 4, 4, 187000.00, 122400.00, 2244000.00, 2244000.00, 12, 'Vodka', 'prov-005', '7312040001005', 1, '2026-06-30 19:43:13', '2026-06-30 15:19:51'),
	('305e0996-0460-49de-bba5-3635da62ce45', 'Vodka Stolichnaya 250ml', 'Presentación 250ml', 2, 5, 105000.00, 68400.00, 1260000.00, 1260000.00, 12, 'Vodka', 'prov-005', '7312040001004', 1, '2026-06-30 19:43:13', '2026-06-30 15:19:51'),
	('306cd02f-f3ed-4288-8874-c2f9e5d05d5c', 'Agua Cristal 600ml', 'Agua purificada', 3, 15, 2500.00, 1500.00, 30000.00, 30000.00, 12, 'Agua', 'prov-003', '7791813000002', 1, '2026-06-30 19:43:13', '2026-06-30 15:19:51'),
	('30cf048d-9cf5-4d52-be8b-2ccbca5a29f3', 'Vino Casillero del Diablo Tinto', 'Botella 750 ml', 1, 8, 45000.00, 30000.00, 540000.00, 540000.00, 12, 'Vino', 'prov-006', '7804320000001', 1, '2026-06-30 19:43:13', '2026-06-30 15:19:51'),
	('31631261-526c-45be-b35a-1e19e036ea28', 'Vino Santa Helena 1L', 'Presentación 1L', 4, 6, 38500.00, 24600.00, 462000.00, 462000.00, 12, 'Vino', 'prov-006', '7804320001004', 1, '2026-06-30 19:43:13', '2026-06-30 15:19:51'),
	('3297fa29-5969-437e-8252-aff1ef16be16', 'Whisky Chivas Regal 1L', 'Presentación 1L', 2, 10, 220500.00, 142600.00, 2646000.00, 2646000.00, 12, 'Whisky', 'prov-002', '5000299001004', 1, '2026-06-30 19:43:13', '2026-06-30 15:19:51'),
	('333f74cd-a413-4885-a9ae-30e4ce3ed651', 'Pepsi 1.5L', 'Presentación 1.5L', 3, 7, 9700.00, 6200.00, 116400.00, 116400.00, 12, 'Gaseosas', 'prov-003', '7791813001004', 1, '2026-06-30 19:43:13', '2026-06-30 15:19:51'),
	('33ea659b-fb07-467e-8926-2de25da249f4', 'Vino Concha y Toro Tinto 750ml', 'Presentación Tinto 750ml', 33, 6, 38000.00, 24000.00, 456000.00, 456000.00, 12, 'Vino', 'prov-006', '7804320001002', 0, '2026-06-30 19:43:13', '2026-06-30 15:19:51'),
	('37064786-f92c-444a-b148-f125fa2bb59f', 'Ron Bacardí 100ml', 'Presentación 100ml', 16, 10, 82500.00, 53600.00, 990000.00, 990000.00, 12, 'Ron', 'prov-002', '80480001004', 0, '2026-06-30 19:43:13', '2026-06-30 15:19:51'),
	('3879d8e7-336e-4fd8-be8f-7bbe9f650af8', 'Licor Jägermeister 375ml', 'Presentación 375ml', 57, 7, 98500.00, 64200.00, 1182000.00, 1182000.00, 12, 'Licores', 'prov-005', '5011013001003', 0, '2026-06-30 19:43:13', '2026-06-30 15:19:51'),
	('3bd3874f-258b-4509-82c9-ecf041001475', 'Aguardiente Cristal 100ml', 'Presentación 100ml', 40, 5, 42500.00, 27100.00, 510000.00, 510000.00, 12, 'Aguardiente', 'prov-004', '7702065001004', 0, '2026-06-30 19:43:13', '2026-06-30 15:19:52'),
	('3c1bc0e0-caf9-4f57-83af-60164cd6a3cd', 'Vodka Grey Goose 1L', 'Presentación 1L', 60, 9, 190500.00, 124600.00, 2286000.00, 2286000.00, 12, 'Vodka', 'prov-005', '7312040001006', 0, '2026-06-30 19:43:13', '2026-06-30 15:19:52'),
	('3ce6f83e-3fe0-4cfd-8866-bc74802b21a1', 'Coca-Cola Zero 6-pack', 'Presentación 6-pack', 18, 8, 17000.00, 10800.00, 204000.00, 204000.00, 12, 'Gaseosas', 'prov-003', '7791813001005', 0, '2026-06-30 19:43:13', '2026-06-30 15:19:52'),
	('3d75d8b8-81b2-4b31-9fcc-373d46bbfb43', 'Tequila Don Julio 1L', 'Presentación 1L', 24, 7, 260500.00, 166600.00, 3126000.00, 3126000.00, 12, 'Tequila', 'prov-002', '81127001005', 0, '2026-06-30 19:43:13', '2026-06-30 15:19:52'),
	('416c0502-954e-4489-9e5c-ba7242a78dfa', 'Cerveza Poker Botella 330ml', 'Presentación Botella 330ml', 50, 9, 15000.00, 9600.00, 180000.00, 180000.00, 12, 'Cervezas', 'prov-001', '7702020001003', 0, '2026-06-30 19:43:13', '2026-06-30 15:19:52'),
	('41c65dcf-bae5-458e-aa51-f0638cba9a4c', 'Cerveza Poker Lata 330ml', 'Presentación Lata 330ml', 23, 10, 11500.00, 7400.00, 138000.00, 138000.00, 12, 'Cervezas', 'prov-001', '7702020001002', 0, '2026-06-30 19:43:13', '2026-06-30 15:19:52'),
	('43d8e87d-8e02-4140-918b-ee394ad37c5b', 'Aguardiente Llanero 375ml', 'Presentación 375ml', 16, 5, 33500.00, 21200.00, 402000.00, 402000.00, 12, 'Aguardiente', 'prov-004', '7702065001003', 0, '2026-06-30 19:43:13', '2026-06-30 15:19:52'),
	('47b4c242-4221-4596-a03b-c078ddc79617', 'Vino Santa Helena Blanco 750ml', 'Presentación Blanco 750ml', 17, 5, 31500.00, 20200.00, 378000.00, 378000.00, 12, 'Vino', 'prov-006', '7804320001002', 0, '2026-06-30 19:43:13', '2026-06-30 15:19:52'),
	('47e1ba37-6b1f-4ca6-bee5-a6da3b733799', 'Vodka Absolut 375ml', 'Presentación 375ml', 37, 8, 98500.00, 64200.00, 1182000.00, 1182000.00, 12, 'Vodka', 'prov-005', '7312040001002', 0, '2026-06-30 19:43:13', '2026-06-30 15:19:52'),
	('4c4723ae-b1e5-4921-8441-19e5ba3be02e', 'Whisky Jack Daniels 1L', 'Presentación 1L', 23, 10, 155500.00, 100600.00, 1866000.00, 1866000.00, 12, 'Whisky', 'prov-002', '82184001004', 0, '2026-06-30 19:43:13', '2026-06-30 15:19:52'),
	('50bcde6d-6b8b-4fae-9c27-6966729de242', 'Whisky Chivas Regal 250ml', 'Presentación 250ml', 31, 10, 217000.00, 140400.00, 2604000.00, 2604000.00, 12, 'Whisky', 'prov-002', '5000299001003', 0, '2026-06-30 19:43:13', '2026-06-30 15:19:52'),
	('518e3bf7-671e-4046-adef-79aa43c46c77', 'Cerveza Heineken Lata 500ml', 'Presentación Lata 500ml', 37, 10, 23500.00, 14200.00, 282000.00, 282000.00, 12, 'Cervezas', 'prov-001', '8711000001003', 0, '2026-06-30 19:43:13', '2026-06-30 15:19:52'),
	('52174c8a-953d-4945-a25f-4d68345d3b57', 'Cerveza Heineken Botella 330ml', 'Presentación Botella 330ml', 19, 10, 20000.00, 12000.00, 240000.00, 240000.00, 12, 'Cervezas', 'prov-001', '8711000001002', 0, '2026-06-30 19:43:13', '2026-06-30 15:19:52'),
	('523111e4-5a48-427e-9575-d5dcf92357ca', 'Postobón 400ml', 'Presentación 400ml', 69, 7, 4800.00, 3000.00, 57600.00, 57600.00, 12, 'Gaseosas', 'prov-003', '7791813001005', 0, '2026-06-30 19:43:13', '2026-06-30 15:19:53'),
	('563033e0-8286-4b42-b61c-fc2892c58895', 'Vino Concha y Toro Blanco 750ml', 'Presentación Blanco 750ml', 71, 9, 41500.00, 26200.00, 498000.00, 498000.00, 12, 'Vino', 'prov-006', '7804320001003', 0, '2026-06-30 19:43:13', '2026-06-30 15:19:53'),
	('57367f21-dbc6-4713-aaa5-9650c0e89d58', 'Vino Santa Helena Tinto 750ml', 'Presentación Tinto 750ml', 78, 9, 28000.00, 18000.00, 336000.00, 336000.00, 12, 'Vino', 'prov-006', '7804320001001', 0, '2026-06-30 19:43:13', '2026-06-30 15:19:53'),
	('584c588b-c97a-4ec5-9648-c28917aa1a09', 'Vodka Stolichnaya 375ml', 'Presentación 375ml', 77, 10, 101500.00, 66200.00, 1218000.00, 1218000.00, 12, 'Vodka', 'prov-005', '7312040001003', 0, '2026-06-30 19:43:13', '2026-06-30 15:19:53'),
	('5b6e9a8a-66b7-4162-b207-e9add2b0fbfd', 'Whisky Buchanan’s 1L', 'Presentación 1L', 51, 7, 142500.00, 92600.00, 1710000.00, 1710000.00, 12, 'Whisky', 'prov-002', '5000267001004', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('5df0a0b3-8522-4708-a064-40e7a7a177d3', 'Aguardiente Llanero 250ml', 'Presentación 250ml', 66, 5, 37000.00, 23400.00, 444000.00, 444000.00, 12, 'Aguardiente', 'prov-004', '7702065001004', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('5f9ef785-63f6-4dd0-8ac3-0c37cc15ffd0', 'Whisky Johnnie Walker Black 1L', 'Presentación 1L', 53, 9, 195500.00, 126600.00, 2346000.00, 2346000.00, 12, 'Whisky', 'prov-002', '5000267001006', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('60a25208-4bc3-4ef7-8c1a-30d2ef869928', 'Gin Beefeater 1L', 'Presentación 1L', 71, 9, 120500.00, 77600.00, 1446000.00, 1446000.00, 12, 'Gin', 'prov-005', '5000299001005', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('62712229-a5cb-4b4b-b95c-49333314d044', 'Vodka Absolut 750ml', 'Presentación 750ml', 58, 8, 95000.00, 62000.00, 1140000.00, 1140000.00, 12, 'Vodka', 'prov-005', '7312040001001', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('67e10486-f58d-4375-a89b-152a9974ccce', 'Whisky Johnnie Walker Black 375ml', 'Presentación 375ml', 32, 9, 188500.00, 122200.00, 2262000.00, 2262000.00, 12, 'Whisky', 'prov-002', '5000267001004', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('6880c6db-9107-4fe2-a1d7-1e47f8fe04f2', 'Gin Hendrick’s 750ml', 'Presentación 750ml', 47, 6, 150000.00, 98000.00, 1800000.00, 1800000.00, 12, 'Gin', 'prov-005', '5000299001004', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('6a0a77c6-f012-4dff-b1e3-fdee87e432c7', 'Licor Jägermeister 1L', 'Presentación 1L', 29, 8, 105500.00, 68600.00, 1266000.00, 1266000.00, 12, 'Licores', 'prov-005', '5011013001005', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('6d547024-1208-4b64-92ee-d5b93b0587fb', 'Gin Bombay Sapphire 250ml', 'Presentación 250ml', 12, 5, 132000.00, 85400.00, 1584000.00, 1584000.00, 12, 'Gin', 'prov-005', '5000299001005', 0, '2026-06-30 19:43:13', '2026-06-30 15:17:29'),
	('6d6b4081-e03f-4aad-8fb7-f901aed7f6e0', 'Seven Up 6-pack', 'Presentación 6-pack', 26, 6, 16700.00, 10600.00, 200400.00, 200400.00, 12, 'Gaseosas', 'prov-003', '7791813001009', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('6dce0fe5-3aa1-43de-82f1-d6e961368adb', 'Postobón 2.5L', 'Presentación 2.5L', 16, 8, 11800.00, 7400.00, 141600.00, 141600.00, 12, 'Gaseosas', 'prov-003', '7791813001007', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('6df6c00b-6dc1-43b8-92ee-aae74a997725', 'Vodka Absolut 1L', 'Presentación 1L', 59, 8, 105500.00, 68600.00, 1266000.00, 1266000.00, 12, 'Vodka', 'prov-005', '7312040001004', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('6e67d4c9-1150-41d5-83e2-c0b442714d01', 'Pepsi 6-pack', 'Presentación 6-pack', 70, 6, 16700.00, 10600.00, 200400.00, 200400.00, 12, 'Gaseosas', 'prov-003', '7791813001006', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('6ef8da95-269d-4791-ac91-d7b2aca54828', 'Vino Don Simón Blanco 750ml', 'Presentación Blanco 750ml', 66, 9, 21500.00, 13200.00, 258000.00, 258000.00, 12, 'Vino', 'prov-006', '8410261001002', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('6f17b9b0-b83c-4ab9-b525-65ecbc179e17', 'Vodka Stolichnaya 1L', 'Presentación 1L', 53, 5, 108500.00, 70600.00, 1302000.00, 1302000.00, 12, 'Vodka', 'prov-005', '7312040001005', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('6f33f089-96c9-492e-87c3-686befd2d724', 'Whisky Old Parr 12 años', 'Botella de 750 ml', 45, 8, 129000.00, 89000.00, 1548000.00, 1548000.00, 12, 'Whisky', 'prov-002', '5000267000001', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('7214d617-ddb1-4399-9463-f5f7175c8f7f', 'Gin Bombay Sapphire 750ml', 'Presentación 750ml', 27, 5, 125000.00, 81000.00, 1500000.00, 1500000.00, 12, 'Gin', 'prov-005', '5000299001003', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('72616dc8-cb32-47a4-a428-de292a229e6c', 'Seven Up 2.5L', 'Presentación 2.5L', 29, 5, 13200.00, 8400.00, 158400.00, 158400.00, 12, 'Gaseosas', 'prov-003', '7791813001008', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('7286bfe2-03f9-4bd6-813c-9db0253e932c', 'Gin Beefeater 250ml', 'Presentación 250ml', 13, 7, 117000.00, 75400.00, 1404000.00, 1404000.00, 12, 'Gin', 'prov-005', '5000299001004', 0, '2026-06-30 19:43:13', '2026-06-30 15:17:29'),
	('73bf6a93-44b7-4f5a-a541-e7148316d8cd', 'Whisky Johnnie Walker Red 375ml', 'Presentación 375ml', 20, 7, 118500.00, 76200.00, 1422000.00, 1422000.00, 12, 'Whisky', 'prov-002', '5000267001003', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('7539dde0-8423-4b94-941d-7803f2ab56d3', 'Aguardiente Cristal 750ml', 'Presentación 750ml', 80, 6, 32000.00, 20500.00, 384000.00, 384000.00, 12, 'Aguardiente', 'prov-004', '7702065001001', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('75d31fa0-3206-445e-8ab2-216dadab64fc', 'Vodka Grey Goose 375ml', 'Presentación 375ml', 80, 10, 183500.00, 120200.00, 2202000.00, 2202000.00, 12, 'Vodka', 'prov-005', '7312040001004', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('789a0fa0-7b03-4728-bcbb-76a16aebefdc', 'Hielo en Bolsa 2kg', 'Hielo para consumo', 25, 5, 5000.00, 2500.00, 60000.00, 60000.00, 12, 'Congelados', 'prov-006', '7701000000001', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('7b23025f-e380-40e1-86d9-3975767452a7', 'Vino Don Simón Rosado 750ml', 'Presentación Rosado 750ml', 44, 4, 25000.00, 15400.00, 300000.00, 300000.00, 12, 'Vino', 'prov-006', '8410261001003', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('7c1457f4-780b-4087-a8db-3d494d36e016', 'Licor Jägermeister 750ml', 'Presentación 750ml', 58, 8, 95000.00, 62000.00, 1140000.00, 1140000.00, 12, 'Licores', 'prov-005', '5011013001002', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('7ca5ae63-cb87-4b35-b7a7-a698da80b341', 'Postobón 1.5L', 'Presentación 1.5L', 34, 8, 8300.00, 5200.00, 99600.00, 99600.00, 12, 'Gaseosas', 'prov-003', '7791813001006', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('7d23a3c7-0350-4f35-b58f-1e1f7d5845d7', 'Ron Cacique 1L', 'Botella de ron blanco 1 litro', 60, 10, 42000.00, 28000.00, 504000.00, 504000.00, 12, 'Ron', 'prov-002', '7702065000001', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('7e809341-7bfe-4c55-9b38-5219b6e200b6', 'Cerveza Costeña Lata 500ml', 'Presentación Lata 500ml', 69, 4, 18000.00, 11500.00, 216000.00, 216000.00, 12, 'Cervezas', 'prov-001', '7702020001005', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('833c2f57-5778-4847-981f-36ae02cff973', 'Tequila Herradura 750ml', 'Presentación 750ml', 54, 8, 220000.00, 140000.00, 2640000.00, 2640000.00, 12, 'Tequila', 'prov-002', '81127001003', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('86a2647d-7d37-4ea0-b794-329ab207bb27', 'Vodka Absolut 250ml', 'Presentación 250ml', 16, 10, 102000.00, 66400.00, 1224000.00, 1224000.00, 12, 'Vodka', 'prov-005', '7312040001003', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('8724e7af-ed3b-4869-bb01-46312cffd04a', 'Sprite 400ml', 'Presentación 400ml', 49, 10, 6200.00, 4000.00, 74400.00, 74400.00, 12, 'Gaseosas', 'prov-003', '7791813001004', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('88d94b05-7943-4ad5-be54-df6f9961ff85', 'Aguardiente Llanero 100ml', 'Presentación 100ml', 22, 6, 40500.00, 25600.00, 486000.00, 486000.00, 12, 'Aguardiente', 'prov-004', '7702065001005', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('894919d2-afef-4b90-a1fc-bf1434ed42c9', 'Ron Captain Morgan 375ml', 'Presentación 375ml', 26, 8, 88500.00, 57200.00, 1062000.00, 1062000.00, 12, 'Ron', 'prov-002', '82000001002', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('895e4097-0a38-48ec-ad7e-94ebe9a6bbb8', 'Pepsi 2.5L', 'Presentación 2.5L', 80, 10, 13200.00, 8400.00, 158400.00, 158400.00, 12, 'Gaseosas', 'prov-003', '7791813001005', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('8a427cde-6e13-4cac-af3a-0b7571b21c8d', 'Licor Jägermeister 250ml', 'Presentación 250ml', 73, 9, 102000.00, 66400.00, 1224000.00, 1224000.00, 12, 'Licores', 'prov-005', '5011013001004', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('8a432d19-82c6-4234-b74b-67b7cfc61ced', 'Cerveza Aguila Lata 330ml', 'Presentación Lata 330ml', 12, 4, 12000.00, 7800.00, 144000.00, 144000.00, 12, 'Cervezas', 'prov-001', '7702020001001', 0, '2026-06-30 19:43:13', '2026-06-30 15:17:29'),
	('8d4417b1-3ee0-4244-a5a4-70b9e642762a', 'Whisky Johnnie Walker Red 1L', 'Presentación 1L', 17, 5, 125500.00, 80600.00, 1506000.00, 1506000.00, 12, 'Whisky', 'prov-002', '5000267001005', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('8eb42538-6d64-4eaf-9927-c2e943d058d0', 'Ron Bacardí 750ml', 'Presentación 750ml', 27, 4, 72000.00, 47000.00, 864000.00, 864000.00, 12, 'Ron', 'prov-002', '80480001001', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('8f031d81-b14c-4c82-b6dc-b989fc7b1f20', 'Whisky Jack Daniels 750ml', 'Presentación 750ml', 59, 5, 145000.00, 94000.00, 1740000.00, 1740000.00, 12, 'Whisky', 'prov-002', '82184001001', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('925f157a-8126-47f1-8a5b-dadb3e53bf51', 'Cerveza Aguila Botella 330ml', 'Presentación Botella 330ml', 64, 6, 15500.00, 10000.00, 186000.00, 186000.00, 12, 'Cervezas', 'prov-001', '7702020001002', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('936bd478-8d36-4e92-afb6-66137cf31bc7', 'Tequila José Cuervo Gold', 'Tequila reposado 750 ml', 20, 4, 98000.00, 65000.00, 1176000.00, 1176000.00, 12, 'Tequila', 'prov-002', '0081127000001', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('99c56ac0-9e2c-4adf-bdcc-47fdd4764b33', 'Ron Captain Morgan 750ml', 'Presentación 750ml', 21, 9, 85000.00, 55000.00, 1020000.00, 1020000.00, 12, 'Ron', 'prov-002', '82000001001', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('9cf3943d-bf9e-436d-a70d-ed78c5132173', 'Gin Hendrick’s 375ml', 'Presentación 375ml', 14, 5, 153500.00, 100200.00, 1842000.00, 1842000.00, 12, 'Gin', 'prov-005', '5000299001005', 0, '2026-06-30 19:43:13', '2026-06-30 15:17:29'),
	('9d2ff242-7784-473d-aed3-8940e6b4ff43', 'Gin Beefeater 375ml', 'Presentación 375ml', 62, 8, 113500.00, 73200.00, 1362000.00, 1362000.00, 12, 'Gin', 'prov-005', '5000299001003', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('a1a68254-40d3-4a03-ae9b-8e0bc367758c', 'Whisky Chivas Regal 375ml', 'Presentación 375ml', 66, 5, 213500.00, 138200.00, 2562000.00, 2562000.00, 12, 'Whisky', 'prov-002', '5000299001002', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('a1d8aa19-2eb5-419b-935a-299946968e42', 'Tequila Herradura 250ml', 'Presentación 250ml', 13, 4, 227000.00, 144400.00, 2724000.00, 2724000.00, 12, 'Tequila', 'prov-002', '81127001005', 0, '2026-06-30 19:43:13', '2026-06-30 15:17:29'),
	('a530e2af-777e-4747-9705-a26abd8ae075', 'Whisky Buchanan’s 375ml', 'Presentación 375ml', 59, 5, 135500.00, 88200.00, 1626000.00, 1626000.00, 12, 'Whisky', 'prov-002', '5000267001002', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('a81fa3e5-79c0-43c8-9e08-86990b3e8c8c', 'Cerveza Poker Botella 1L', 'Presentación Botella 1L', 29, 4, 22000.00, 14000.00, 264000.00, 264000.00, 12, 'Cervezas', 'prov-001', '7702020001005', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('a8fec075-1991-41fc-bf6e-d2cae3168e90', 'Licor Kahlúa 375ml', 'Presentación 375ml', 35, 9, 93500.00, 61200.00, 1122000.00, 1122000.00, 12, 'Licores', 'prov-005', '5011013001004', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('a9d0a340-ce42-4c9d-bcef-fca1f45a5715', 'Coca-Cola Zero 2.5L', 'Presentación 2.5L', 23, 5, 13500.00, 8600.00, 162000.00, 162000.00, 12, 'Gaseosas', 'prov-003', '7791813001004', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('abb33de4-3055-4871-a5dd-525c70a47cab', 'Cerveza Corona Lata 500ml', 'Presentación Lata 500ml', 57, 8, 24000.00, 14600.00, 288000.00, 288000.00, 12, 'Cervezas', 'prov-001', '7501064001003', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('af2c1094-4916-4df3-b92b-99315a8afbe1', 'Whisky Chivas Regal 750ml', 'Presentación 750ml', 64, 8, 210000.00, 136000.00, 2520000.00, 2520000.00, 12, 'Whisky', 'prov-002', '5000299001001', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('af698f82-ecee-4333-9d98-ddfd3cfba2c8', 'Vino Don Simón 1L', 'Presentación 1L', 55, 7, 28500.00, 17600.00, 342000.00, 342000.00, 12, 'Vino', 'prov-006', '8410261001004', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('afc5ac28-0618-4489-9d87-dc945ef3a869', 'Whisky Jack Daniels 250ml', 'Presentación 250ml', 15, 5, 152000.00, 98400.00, 1824000.00, 1824000.00, 12, 'Whisky', 'prov-002', '82184001003', 0, '2026-06-30 19:43:13', '2026-06-30 15:17:30'),
	('b215cf44-c689-4bf8-9cf8-cfbc7904f7fd', 'Tónica Schweppes 250ml', 'Mezclador ideal para gin', 50, 8, 4500.00, 2800.00, 54000.00, 54000.00, 12, 'Mezcladores', 'prov-003', '5449000000001', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('b2bb1c9d-7a74-4bc7-bd14-e5f963a954c7', 'Sprite 2.5L', 'Presentación 2.5L', 39, 6, 13200.00, 8400.00, 158400.00, 158400.00, 12, 'Gaseosas', 'prov-003', '7791813001006', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('b2ec2350-be64-482c-b072-eb69f749c14a', 'Vino Concha y Toro 1L', 'Presentación 1L', 63, 5, 48500.00, 30600.00, 582000.00, 582000.00, 12, 'Vino', 'prov-006', '7804320001005', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('b4a9df58-1d4b-4072-a570-a927b68f5b76', 'Whisky Buchanan’s 750ml', 'Presentación 750ml', 30, 5, 132000.00, 86000.00, 1584000.00, 1584000.00, 12, 'Whisky', 'prov-002', '5000267001001', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('b530f804-800f-4f76-8d97-6f451dfcebca', 'Ron Captain Morgan 250ml', 'Presentación 250ml', 18, 8, 92000.00, 59400.00, 1104000.00, 1104000.00, 12, 'Ron', 'prov-002', '82000001003', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('b8d67891-0476-44ec-9f44-63c6c4cb80f7', 'Whisky Jack Daniels 375ml', 'Presentación 375ml', 32, 9, 148500.00, 96200.00, 1782000.00, 1782000.00, 12, 'Whisky', 'prov-002', '82184001002', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('b94e75a5-416d-4f88-ba9e-fa1094fb34bb', 'Tequila Don Julio 375ml', 'Presentación 375ml', 38, 10, 253500.00, 162200.00, 3042000.00, 3042000.00, 12, 'Tequila', 'prov-002', '81127001003', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('ba3b1993-f2fd-4524-b479-02076094faa4', 'Licor Kahlúa 250ml', 'Presentación 250ml', 34, 6, 97000.00, 63400.00, 1164000.00, 1164000.00, 12, 'Licores', 'prov-005', '5011013001005', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('ba5ce1f4-e943-4371-951c-90b439701ca4', 'Vino Don Simón Tinto 750ml', 'Presentación Tinto 750ml', 29, 4, 18000.00, 11000.00, 216000.00, 216000.00, 12, 'Vino', 'prov-006', '8410261001001', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('bbc44f6c-4d89-4404-8cb3-6333cf09578a', 'Vodka Stolichnaya 750ml', 'Presentación 750ml', 66, 6, 98000.00, 64000.00, 1176000.00, 1176000.00, 12, 'Vodka', 'prov-005', '7312040001002', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('c1401c74-e178-471d-b5b7-645ee4497939', 'Ron Medellín 100ml', 'Presentación 100ml', 36, 6, 78500.00, 50600.00, 942000.00, 942000.00, 12, 'Ron', 'prov-002', '7702065001006', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('c2a5e66c-e57e-433f-87a6-435e58a15e22', 'Licor Baileys 750ml', 'Presentación 750ml', 24, 7, 98000.00, 64000.00, 1176000.00, 1176000.00, 12, 'Licores de Crema', 'prov-005', '5011013001001', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('c358b943-4c52-440d-9d17-e9bf34e947a5', 'Cerveza Corona Lata 330ml', 'Presentación Lata 330ml', 60, 4, 17000.00, 10200.00, 204000.00, 204000.00, 12, 'Cervezas', 'prov-001', '7501064001001', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('c50b087b-10a8-4097-8a43-040942a499a3', 'Cerveza Heineken Lata 330ml', 'Presentación Lata 330ml', 61, 7, 16500.00, 9800.00, 198000.00, 198000.00, 12, 'Cervezas', 'prov-001', '8711000001001', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('c55b3d5a-11df-44c8-839d-6518867ce0b1', 'Cerveza Costeña Botella 330ml', 'Presentación Botella 330ml', 58, 5, 14500.00, 9300.00, 174000.00, 174000.00, 12, 'Cervezas', 'prov-001', '7702020001004', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('cdc0d9c2-ae61-4f0c-a780-4857284d4dad', 'Cerveza Heineken Botella 1L', 'Presentación Botella 1L', 51, 5, 27000.00, 16400.00, 324000.00, 324000.00, 12, 'Cervezas', 'prov-001', '8711000001004', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('ce0add0d-5d42-482f-89d3-afac1f2c5e6b', 'Whisky Johnnie Walker Black 750ml', 'Presentación 750ml', 68, 4, 185000.00, 120000.00, 2220000.00, 2220000.00, 12, 'Whisky', 'prov-002', '5000267001003', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('ceffd026-4dee-4270-9774-570cc69587a8', 'Red Bull 250ml', 'Bebida energizante', 30, 6, 8500.00, 5500.00, 102000.00, 102000.00, 12, 'Energizantes', 'prov-006', '9002490000001', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('cfdd777c-ba27-43a7-af02-0eefa9b848b3', 'Licor Baileys 250ml', 'Presentación 250ml', 42, 5, 105000.00, 68400.00, 1260000.00, 1260000.00, 12, 'Licores de Crema', 'prov-005', '5011013001003', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('d1e937f4-975d-44e8-9e02-d5b9e7b1d837', 'Cerveza Corona Botella 1L', 'Presentación Botella 1L', 22, 4, 27500.00, 16800.00, 330000.00, 330000.00, 12, 'Cervezas', 'prov-001', '7501064001004', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('d1ff34c0-64c9-4c64-a8e1-c808dc5c1cdb', 'Gin Bombay Sapphire 375ml', 'Presentación 375ml', 14, 8, 128500.00, 83200.00, 1542000.00, 1542000.00, 12, 'Gin', 'prov-005', '5000299001004', 0, '2026-06-30 19:43:13', '2026-06-30 15:17:30'),
	('d4779357-b291-4417-a14e-f39bb7534d29', 'Cerveza Polar Pilsen (Caja)', 'Caja de 24 unidades', 120, 20, 22000.00, 14000.00, 528000.00, 528000.00, 24, 'Cervezas', 'prov-001', '7702020000011', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('d7f89095-ca8f-4c54-9a97-3431bd778cbb', 'Cerveza Costeña Botella 1L', 'Presentación Botella 1L', 74, 4, 21500.00, 13700.00, 258000.00, 258000.00, 12, 'Cervezas', 'prov-001', '7702020001006', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('d9361ccc-aa4f-4c8a-822a-13e0894dd724', 'Seven Up 400ml', 'Presentación 400ml', 77, 7, 6200.00, 4000.00, 74400.00, 74400.00, 12, 'Gaseosas', 'prov-003', '7791813001006', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('d9b7f0b4-5f34-4bb6-86d3-b2ddde991f03', 'Ron Captain Morgan 100ml', 'Presentación 100ml', 69, 5, 95500.00, 61600.00, 1146000.00, 1146000.00, 12, 'Ron', 'prov-002', '82000001004', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('e0208fa3-2c1e-47f0-9f6c-66f2eaf98ca1', 'Licor Baileys 375ml', 'Presentación 375ml', 61, 7, 101500.00, 66200.00, 1218000.00, 1218000.00, 12, 'Licores de Crema', 'prov-005', '5011013001002', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('e088cc66-92d8-4959-8f12-e829c0a0b055', 'Gin Tanqueray 750ml', 'Gin premium inglés', 25, 5, 118000.00, 78000.00, 1416000.00, 1416000.00, 12, 'Gin', 'prov-005', '5000291000001', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('e1173595-7aec-4850-b4bb-763f17ac147c', 'Seven Up 1.5L', 'Presentación 1.5L', 17, 9, 9700.00, 6200.00, 116400.00, 116400.00, 12, 'Gaseosas', 'prov-003', '7791813001007', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('e27af704-bddf-4f0b-ae51-b84020ad44eb', 'Cerveza Costeña Lata 330ml', 'Presentación Lata 330ml', 56, 6, 11000.00, 7100.00, 132000.00, 132000.00, 12, 'Cervezas', 'prov-001', '7702020001003', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('e2b1a42d-deb8-4698-b40b-58e8fdeb76b5', 'Ron Medellín 750ml', 'Presentación 750ml', 30, 7, 68000.00, 44000.00, 816000.00, 816000.00, 12, 'Ron', 'prov-002', '7702065001003', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('e3d6d4b7-cbba-4cee-9bd4-a915ca697c00', 'Ron Bacardí 250ml', 'Presentación 250ml', 48, 9, 79000.00, 51400.00, 948000.00, 948000.00, 12, 'Ron', 'prov-002', '80480001003', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('e4f30060-cdaf-468d-8468-4a0b7d32c097', 'Aguardiente Llanero 750ml', 'Presentación 750ml', 42, 7, 30000.00, 19000.00, 360000.00, 360000.00, 12, 'Aguardiente', 'prov-004', '7702065001002', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('e5951fbf-93a2-48f3-96fe-a440185fe095', 'Vodka Smirnoff 750ml', 'Vodka premium', 35, 6, 76000.00, 49000.00, 912000.00, 912000.00, 12, 'Vodka', 'prov-005', '0082000000001', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('e7175b5a-32c5-4a39-ba90-2fdcf586ef9a', 'Whisky Johnnie Walker Red 750ml', 'Presentación 750ml', 25, 5, 115000.00, 74000.00, 1380000.00, 1380000.00, 12, 'Whisky', 'prov-002', '5000267001002', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('eb6c0914-a4de-4c5d-bc12-9b794f808b19', 'Aguardiente Antioqueño 750ml', 'Aguardiente tradicional 750 ml', 55, 10, 34000.00, 22000.00, 408000.00, 408000.00, 12, 'Aguardiente', 'prov-004', '7702065000002', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('ec7d0409-f03d-4dd5-8fd5-c13fe4c8a8f0', 'Vino Santa Helena Rosado 750ml', 'Presentación Rosado 750ml', 71, 10, 35000.00, 22400.00, 420000.00, 420000.00, 12, 'Vino', 'prov-006', '7804320001003', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('ef235d3a-44f7-4745-a397-3007d022bcb5', 'Gin Hendrick’s 1L', 'Presentación 1L', 59, 7, 160500.00, 104600.00, 1926000.00, 1926000.00, 12, 'Gin', 'prov-005', '5000299001007', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('efd15dbb-2332-498e-9117-204467f83860', 'Champaña Cook’s Brut', 'Vino espumoso 750 ml', 18, 4, 42000.00, 27000.00, 504000.00, 504000.00, 12, 'Espumosos', 'prov-006', '0085000000001', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('f0423c63-a537-46eb-bc70-fea7b31848c0', 'Coca-Cola 1.5L', 'Gaseosa PET 1.5 litros', 80, 15, 6500.00, 4200.00, 78000.00, 78000.00, 12, 'Gaseosas', 'prov-003', '7791813000001', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('f0509d28-a0ea-426c-be30-94817bc750a7', 'Gin Hendrick’s 250ml', 'Presentación 250ml', 24, 8, 157000.00, 102400.00, 1884000.00, 1884000.00, 12, 'Gin', 'prov-005', '5000299001006', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('f156e594-5295-4938-bdec-848ed574452c', 'Postobón 6-pack', 'Presentación 6-pack', 43, 7, 15300.00, 9600.00, 183600.00, 183600.00, 12, 'Gaseosas', 'prov-003', '7791813001008', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('f55b6131-7095-4d6b-8fc6-614e57ab2390', 'Whisky Johnnie Walker Red 250ml', 'Presentación 250ml', 55, 6, 122000.00, 78400.00, 1464000.00, 1464000.00, 12, 'Whisky', 'prov-002', '5000267001004', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('fc4b149d-89dd-4680-b5c4-df19c452878d', 'Coca-Cola Zero 1.5L', 'Presentación 1.5L', 64, 5, 10000.00, 6400.00, 120000.00, 120000.00, 12, 'Gaseosas', 'prov-003', '7791813001003', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('fcfbf462-36da-4702-adbf-72f70d7d8a44', 'Licor Kahlúa 1L', 'Presentación 1L', 31, 5, 100500.00, 65600.00, 1206000.00, 1206000.00, 12, 'Licores', 'prov-005', '5011013001006', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('fd8625aa-2411-4746-a675-0c648a50be2c', 'Whisky Johnnie Walker Black 250ml', 'Presentación 250ml', 34, 10, 192000.00, 124400.00, 2304000.00, 2304000.00, 12, 'Whisky', 'prov-002', '5000267001005', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13');

-- Volcando estructura para tabla tienda_db.proveedores
CREATE TABLE IF NOT EXISTS `proveedores` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `empresa` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telefono` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `link_web` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `direccion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `frecuencia_visita` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla tienda_db.proveedores: ~6 rows (aproximadamente)
INSERT INTO `proveedores` (`id`, `nombre`, `empresa`, `telefono`, `email`, `link_web`, `direccion`, `frecuencia_visita`, `activo`, `created_at`, `updated_at`) VALUES
	('prov-001', 'Carlos Martínez', 'Distribuidora Bavaria', '3001234567', 'ventas@bavaria.com.co', NULL, 'Calle 94 # 15-46, Bogotá', 'Semanal', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('prov-002', 'Andrés Gómez', 'Diageo Colombia', '3109876543', 'andres.gomez@diageo.com', NULL, 'Av. El Dorado # 69C-03, Bogotá', 'Quincenal', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('prov-003', 'Patricia Ríos', 'Casa Luker / Postobón', '3157654321', 'patricia.rios@postobon.com.co', NULL, 'Carrera 43A # 1-50, Medellín', 'Semanal', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('prov-004', 'Roberto Cárdenas', 'Industrias Licoreras de Caldas', '3204567890', 'rcardenas@ilc.gov.co', NULL, 'Carrera 23 # 18-03, Manizales', 'Mensual', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('prov-005', 'Juliana Torres', 'Pernod Ricard Colombia', '3012345678', 'jtorres@pernod-ricard.com', NULL, 'Calle 100 # 8A-55, Bogotá', 'Quincenal', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13'),
	('prov-006', 'Miguel Salazar', 'Distribuidora La Bodega', '3168901234', 'msalazar@labodega.com.co', NULL, 'Carrera 50 # 12-30, Cali', 'Semanal', 1, '2026-06-30 19:43:13', '2026-06-30 19:43:13');

-- Volcando estructura para tabla tienda_db.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla tienda_db.sessions: ~0 rows (aproximadamente)

-- Volcando estructura para tabla tienda_db.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla tienda_db.users: ~0 rows (aproximadamente)

-- Volcando estructura para tabla tienda_db.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `correo` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contrasena` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `rol` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'usuario',
  `activo` tinyint DEFAULT '0',
  `codigo_verificacion` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `correo` (`correo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla tienda_db.usuarios: ~4 rows (aproximadamente)
INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `contrasena`, `rol`, `activo`, `codigo_verificacion`, `created_at`) VALUES
	('009ae21e-a7f0-4c5a-8165-cac8da15ff0d', 'Silvio Bolaño', 'david5557h@gmail.com', '$2y$12$92C0rlEHWbTGEaLBJY6wi.K9NeJwGiPh77nQCw69XgaUke/K0uFcW', 'usuario', 1, NULL, '2026-06-30 15:08:48'),
	('6e1f2767-3115-4c0e-919d-974a043b8294', 'Adanis Coronado', 'camilacervantes100907@gmail.com', '$2y$12$R5lZ3mx3WpeMzIMl4Yyt3uC996v8OUjBal7in5x4Z5V7iGGzp1pue', 'usuario', 1, NULL, '2026-06-30 15:08:48'),
	('944df5b3-2367-442d-9e2f-406eee0f241b', 'Kleverson Escudero', 'kleversondealexandro150908@gmail.com', '$2y$12$DPlv7uIW6MPuATjI1o.Z2OI9m8gmPCqriKKfDHhOTCEIfs.O8A8qC', 'usuario', 1, NULL, '2026-06-30 15:08:50'),
	('c0bb6037-a26a-4931-a576-0633d4d20526', 'Malcom Sandoval', 'malcomsandoval04@gmail.com', '$2y$12$YQ1Ifm.oWflvQq9k7q/Z/egv4NwvoT6ycFYpKWl02QqlBjfwkBNS6', 'usuario', 1, NULL, '2026-06-30 15:08:49');

-- Volcando estructura para tabla tienda_db.ventas
CREATE TABLE IF NOT EXISTS `ventas` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `usuario_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `precio_compra` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `fecha_venta` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `metodo_pago` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'efectivo',
  `activa` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla tienda_db.ventas: ~35 rows (aproximadamente)
INSERT INTO `ventas` (`id`, `usuario_id`, `total`, `precio_compra`, `fecha_venta`, `metodo_pago`, `activa`) VALUES
	('0082595c-9df7-4ce9-9b77-d00af640213f', NULL, 888000.00, 575400.000000, '2026-06-20 16:56:17', 'Pago Móvil', 1),
	('032f410a-6a10-49f8-90f7-6f57a458d9c8', NULL, 155900.00, 100500.000000, '2026-06-22 20:58:18', 'Tarjeta', 1),
	('05beca71-2c55-499e-9b41-5b38650f85d2', NULL, 217000.00, 141200.000000, '2026-06-23 02:07:15', 'Efectivo', 1),
	('10503689-222e-43c0-9bf2-06d741194dd1', NULL, 120500.00, 77200.000000, '2026-04-09 16:38:17', 'Efectivo', 1),
	('1220935b-93fa-4efc-b740-f154ef345fa5', NULL, 155000.00, 100200.000000, '2026-05-25 15:38:16', 'Transferencia', 1),
	('15412484-3801-4e03-ab0c-7e13939c4076', NULL, 261000.00, 169200.000000, '2026-06-05 15:38:14', 'Efectivo', 1),
	('1721ff31-2c1a-4f80-994b-ddfa7b439c12', NULL, 823500.00, 535800.000000, '2026-05-06 23:10:19', 'Tarjeta', 1),
	('1de3fbaf-9d1c-4f9a-a010-fc07047b4b39', NULL, 759600.00, 486000.000000, '2026-06-01 05:00:18', 'Pago Móvil', 1),
	('25424b09-5b96-4f0b-afa4-b01288059bfc', NULL, 345000.00, 222000.000000, '2026-04-15 00:24:17', 'Transferencia', 1),
	('293da453-57e8-4fdd-94a2-c0befd988aad', NULL, 373000.00, 238000.000000, '2026-05-07 19:04:15', 'Pago Móvil', 1),
	('2de2ea7d-d0d9-4eff-ad68-acc5c72c58e2', NULL, 18500.00, 11800.000000, '2026-04-08 23:13:18', 'Pago Móvil', 1),
	('38bfcd76-c1d1-4052-bde9-0eb548f5eb1d', NULL, 803500.00, 519800.000000, '2026-05-04 07:28:14', 'Pago Móvil', 1),
	('3a71ed2b-58b7-48ef-8ce2-dcea53804471', NULL, 48500.00, 30600.000000, '2026-06-26 19:12:17', 'Efectivo', 1),
	('4f6cd4f2-c49e-45e6-a6a0-6f32bc81eab2', NULL, 180000.00, 118000.000000, '2026-05-27 19:52:18', 'Tarjeta', 1),
	('50a7aea3-d6bb-4d25-ad05-350135d49af4', NULL, 205000.00, 133600.000000, '2026-05-24 11:26:18', 'Tarjeta', 1),
	('52afe421-7958-4958-a2f8-6b4a75fdbae4', NULL, 511500.00, 333300.000000, '2026-04-11 12:43:14', 'Tarjeta', 1),
	('5cada5c5-7a3d-4f92-b9f4-6f7a1d762923', NULL, 24900.00, 15600.000000, '2026-05-11 08:17:16', 'Tarjeta', 1),
	('61dbee5a-124a-4e90-8cfe-a95fc56918d6', NULL, 322800.00, 209400.000000, '2026-04-02 14:09:15', 'Transferencia', 1),
	('6704e238-9034-4a45-a776-4840b1a63511', NULL, 148500.00, 96200.000000, '2026-05-10 10:33:17', 'Pago Móvil', 1),
	('73417739-dda2-499e-9412-4650f3bf4920', NULL, 9700.00, 6200.000000, '2026-04-18 12:56:18', 'Pago Móvil', 1),
	('745aa577-81e5-4330-882e-94fdfbed8cc9', NULL, 536500.00, 341200.000000, '2026-05-31 12:05:16', 'Efectivo', 1),
	('86faf673-f657-4a44-b077-aa1c17b6488f', NULL, 9700.00, 6200.000000, '2026-05-29 13:39:14', 'Tarjeta', 1),
	('993e7efb-70c3-4188-824c-d6bf2acb08b4', NULL, 151000.00, 98400.000000, '2026-05-25 15:42:16', 'Efectivo', 1),
	('a2b868ee-0455-4193-a0b6-8fce56d1248a', NULL, 495000.00, 329000.000000, '2026-04-27 01:53:15', 'Tarjeta', 1),
	('a4ee4248-adf9-451c-9453-87258a643854', NULL, 137500.00, 87900.000000, '2026-06-23 15:47:16', 'Tarjeta', 1),
	('af589043-4e19-4db3-8a65-52e7d7c632b1', NULL, 919600.00, 588000.000000, '2026-06-25 11:46:14', 'Efectivo', 1),
	('b408bb2d-7ede-4205-8997-40a2f3cc9f9a', NULL, 591500.00, 382600.000000, '2026-05-15 11:43:16', 'Tarjeta', 1),
	('b6bb81f1-0d9b-4441-8f8e-f0a4281e0306', NULL, 890400.00, 576200.000000, '2026-05-05 22:53:18', 'Pago Móvil', 1),
	('b6bd84e7-31aa-44c0-abb1-942755768c13', NULL, 328500.00, 210600.000000, '2026-05-28 20:22:16', 'Pago Móvil', 1),
	('d098c692-ce76-480a-a96a-8b88ec62a057', NULL, 211000.00, 137200.000000, '2026-05-01 04:07:14', 'Tarjeta', 1),
	('d0cf1201-8438-4e6c-959f-e486437516ec', NULL, 160900.00, 103800.000000, '2026-05-12 15:16:16', 'Tarjeta', 1),
	('e0ad90c6-aca0-44f3-a19b-3dafef4fdea9', NULL, 750000.00, 480000.000000, '2026-04-01 23:39:17', 'Pago Móvil', 1),
	('e56719d8-2ffe-4f2e-a27d-53d97e5511a5', NULL, 15000.00, 7500.000000, '2026-05-22 15:45:19', 'Tarjeta', 1),
	('f34bc589-1337-4838-88f8-2de219cab285', NULL, 33400.00, 21200.000000, '2026-04-25 07:28:15', 'Transferencia', 1),
	('fabb7aca-c026-4ebe-8dd8-30a2a97f2e9c', NULL, 190000.00, 124000.000000, '2026-05-14 18:59:18', 'Pago Móvil', 1);

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

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
