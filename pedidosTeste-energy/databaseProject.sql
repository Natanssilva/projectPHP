-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.0.34 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.5.0.6677
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para pedidos_energy
CREATE DATABASE IF NOT EXISTS `pedidos_energy` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `pedidos_energy`;

-- Copiando estrutura para tabela pedidos_energy.cliente
CREATE TABLE IF NOT EXISTS `cliente` (
  `cod_cliente` varchar(15) NOT NULL,
  `nom_cliente` varchar(36) NOT NULL,
  PRIMARY KEY (`cod_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela pedidos_energy.cliente: ~7 rows (aproximadamente)
INSERT INTO `cliente` (`cod_cliente`, `nom_cliente`) VALUES
	('1', 'Natan'),
	('2', 'Lucas'),
	('3', 'Luis'),
	('4', 'Silvio'),
	('5', 'Luisa'),
	('6', 'Diogo'),
	('7', 'Diana');

-- Copiando estrutura para tabela pedidos_energy.item
CREATE TABLE IF NOT EXISTS `item` (
  `cod_item` int NOT NULL DEFAULT (0),
  `den_item` varchar(36) NOT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`cod_item`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela pedidos_energy.item: ~12 rows (aproximadamente)
INSERT INTO `item` (`cod_item`, `den_item`, `valor`) VALUES
	(1, 'Caderno do SantosFC', 9.90),
	(2, 'caneca do homem aranha', 10.90),
	(3, 'camisa do flamengo', 10.90),
	(4, 'iphone 14 pro max', 4750.50),
	(5, 'SmartWatch Haylou Solar Plus', 389.00),
	(6, 'Camisa da Polo', 120.00),
	(7, 'Tenis Vans Old School', 380.90),
	(8, 'Fone de ouvido', 30.00),
	(9, 'Capa de celular', 50.00),
	(10, 'Jbl', 890.00),
	(11, 'Corsa', 55200.99),
	(12, 'Camaro', 100000.00);

-- Copiando estrutura para tabela pedidos_energy.item_pedido
CREATE TABLE IF NOT EXISTS `item_pedido` (
  `num_pedido` decimal(6,0) NOT NULL,
  `num_seq_item` decimal(9,0) NOT NULL,
  `cod_item` varchar(15) NOT NULL,
  `qtd_solicitada` decimal(12,3) NOT NULL,
  `pre_unitario` decimal(17,6) NOT NULL,
  PRIMARY KEY (`num_pedido`,`num_seq_item`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela pedidos_energy.item_pedido: ~14 rows (aproximadamente)
INSERT INTO `item_pedido` (`num_pedido`, `num_seq_item`, `cod_item`, `qtd_solicitada`, `pre_unitario`) VALUES
	(99, 6, '4', 1.000, 4750.500000),
	(99, 7, '5', 3.000, 389.000000),
	(99, 8, '6', 4.000, 120.000000),
	(99, 26, '1', 1.000, 4750.500000),
	(99, 35, '12', 1.000, 100000.000000),
	(99, 36, '11', 1.000, 55200.990000),
	(430, 27, '7', 2.000, 380.900000),
	(430, 28, '10', 1.000, 890.000000),
	(430, 29, '9', 3.000, 50.000000),
	(523, 37, '8', 2.000, 30.000000),
	(523, 38, '6', 9.000, 120.000000),
	(523, 39, '10', 1.000, 890.000000),
	(524, 40, '5', 1.000, 389.000000),
	(524, 41, '12', 1.000, 100000.000000);

-- Copiando estrutura para tabela pedidos_energy.pedido
CREATE TABLE IF NOT EXISTS `pedido` (
  `num_pedido` int NOT NULL AUTO_INCREMENT,
  `cod_cliente` varchar(15) NOT NULL,
  PRIMARY KEY (`num_pedido`)
) ENGINE=InnoDB AUTO_INCREMENT=532 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela pedidos_energy.pedido: ~4 rows (aproximadamente)
INSERT INTO `pedido` (`num_pedido`, `cod_cliente`) VALUES
	(99, '2'),
	(430, '5'),
	(523, '1'),
	(524, '6');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
