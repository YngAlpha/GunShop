-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versione server:              10.4.28-MariaDB - mariadb.org binary distribution
-- S.O. server:                  Win64
-- HeidiSQL Versione:            12.5.0.6677
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dump della struttura del database gunshopdb
CREATE DATABASE IF NOT EXISTS `gunshopdb` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `gunshopdb`;

-- Dump della struttura di tabella gunshopdb.armi
CREATE TABLE IF NOT EXISTS `armi` (
  `nomeArma` varchar(50) NOT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `prezzo` int(11) DEFAULT NULL,
  PRIMARY KEY (`nomeArma`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dump dei dati della tabella gunshopdb.armi: ~0 rows (circa)

-- Dump della struttura di tabella gunshopdb.compra
CREATE TABLE IF NOT EXISTS `compra` (
  `username` varchar(50) NOT NULL,
  `nomeArma` varchar(50) NOT NULL,
  KEY `FK_compra_compratori` (`username`),
  KEY `FK_compra_armi` (`nomeArma`),
  CONSTRAINT `FK_compra_armi` FOREIGN KEY (`nomeArma`) REFERENCES `armi` (`nomeArma`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_compra_compratori` FOREIGN KEY (`username`) REFERENCES `compratori` (`username`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dump dei dati della tabella gunshopdb.compra: ~0 rows (circa)

-- Dump della struttura di tabella gunshopdb.compratori
CREATE TABLE IF NOT EXISTS `compratori` (
  `nome` varchar(50) DEFAULT NULL,
  `cognome` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  PRIMARY KEY (`username`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dump dei dati della tabella gunshopdb.compratori: ~2 rows (circa)
INSERT INTO `compratori` (`nome`, `cognome`, `email`, `password`, `username`) VALUES
	('Leonardo', 'Lo Iacono', NULL, 'asd', 'asd'),
	('Davide', 'Lugo', NULL, 'asdasd', 'asdasd');

-- Dump della struttura di tabella gunshopdb.vendi
CREATE TABLE IF NOT EXISTS `vendi` (
  `nomeArma` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  KEY `FK_vendi_armi` (`nomeArma`),
  KEY `FK_vendi_venditori` (`username`),
  CONSTRAINT `FK_vendi_armi` FOREIGN KEY (`nomeArma`) REFERENCES `armi` (`nomeArma`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_vendi_venditori` FOREIGN KEY (`username`) REFERENCES `venditori` (`username`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dump dei dati della tabella gunshopdb.vendi: ~0 rows (circa)

-- Dump della struttura di tabella gunshopdb.venditori
CREATE TABLE IF NOT EXISTS `venditori` (
  `username` varchar(50) NOT NULL,
  `indirizzo` varchar(50) DEFAULT NULL,
  `codNeg` int(11) DEFAULT NULL,
  PRIMARY KEY (`username`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dump dei dati della tabella gunshopdb.venditori: ~1 rows (circa)
INSERT INTO `venditori` (`username`, `indirizzo`, `codNeg`) VALUES
	('GunClub', NULL, 232);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
