-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versione server:              10.4.24-MariaDB - mariadb.org binary distribution
-- S.O. server:                  Win64
-- HeidiSQL Versione:            12.1.0.6537
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
CREATE DATABASE IF NOT EXISTS `gunshopdb` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `gunshopdb`;

-- Dump della struttura di tabella gunshopdb.armi
CREATE TABLE IF NOT EXISTS `armi` (
  `nomeArma` varchar(50) NOT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `prezzo` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`nomeArma`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dump dei dati della tabella gunshopdb.armi: ~8 rows (circa)
DELETE FROM `armi`;
INSERT INTO `armi` (`nomeArma`, `tipo`, `prezzo`) VALUES
	('Ak 47', 'Fucile d\'assalto', NULL),
	('Barrett M82A1', 'Fucile di precisione semiautomatico', NULL),
	('Beretta 92FS', 'Pistola semiautomatica', NULL),
	('Beretta ARX 160', 'Fucile d\'assalto', NULL),
	('CheyTac M200', 'Fucile di precisione Bolt-Action', NULL),
	('HK G36', 'Fucile d\'assalto', NULL),
	('M4', 'Fucile d\'assalto', NULL),
	('Scar H', 'Fucile da battaglia', NULL);

-- Dump della struttura di tabella gunshopdb.compra
CREATE TABLE IF NOT EXISTS `compra` (
  `username` varchar(50) NOT NULL,
  `nomeArma` varchar(50) NOT NULL,
  KEY `FK_compra_compratori` (`username`),
  KEY `FK_compra_armi` (`nomeArma`),
  CONSTRAINT `FK_compra_armi` FOREIGN KEY (`nomeArma`) REFERENCES `armi` (`nomeArma`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_compra_compratori` FOREIGN KEY (`username`) REFERENCES `compratori` (`username`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dump dei dati della tabella gunshopdb.compra: ~7 rows (circa)
DELETE FROM `compra`;
INSERT INTO `compra` (`username`, `nomeArma`) VALUES
	('asd', 'M4'),
	('asdasd', 'Ak 47'),
	('asd', 'Scar H'),
	('asd', 'CheyTac M200'),
	('3m4', 'HK G36'),
	('tro14', 'Ak 47'),
	('asdasd', 'Beretta 92FS');

-- Dump della struttura di tabella gunshopdb.compratori
CREATE TABLE IF NOT EXISTS `compratori` (
  `nome` varchar(50) DEFAULT NULL,
  `cognome` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  PRIMARY KEY (`username`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dump dei dati della tabella gunshopdb.compratori: ~4 rows (circa)
DELETE FROM `compratori`;
INSERT INTO `compratori` (`nome`, `cognome`, `email`, `password`, `username`) VALUES
	('emanuele', 'colzani', 'emanuele.colzani@liceobanfi.eu', '123456', '3m4'),
	('Leonardo', 'Lo Iacono', '', 'asd', 'asd'),
	('Davide', 'Lugo', NULL, 'asdasd', 'asdasd'),
	('lucia', 'mondella', 'lucia.mondella@manzoni.it', 'viva', 'tro14');

-- Dump della struttura di tabella gunshopdb.vendi
CREATE TABLE IF NOT EXISTS `vendi` (
  `nomeArma` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `pezzi` int(10) unsigned DEFAULT NULL,
  KEY `FK_vendi_armi` (`nomeArma`),
  KEY `FK_vendi_venditori` (`username`),
  CONSTRAINT `FK_vendi_armi` FOREIGN KEY (`nomeArma`) REFERENCES `armi` (`nomeArma`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_vendi_venditori` FOREIGN KEY (`username`) REFERENCES `venditori` (`username`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dump dei dati della tabella gunshopdb.vendi: ~5 rows (circa)
DELETE FROM `vendi`;
INSERT INTO `vendi` (`nomeArma`, `username`, `pezzi`) VALUES
	('M4', 'GunClub', 20),
	('Ak 47', 'GunShop', 30),
	('HK G36', 'GunClub', 15),
	('Beretta ARX 160', 'GunClub', 25),
	('CheyTac M200', 'GunClub', 13);

-- Dump della struttura di tabella gunshopdb.venditori
CREATE TABLE IF NOT EXISTS `venditori` (
  `username` varchar(50) NOT NULL,
  `indirizzo` varchar(50) DEFAULT NULL,
  `codNeg` int(11) DEFAULT NULL,
  `nomeNeg` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`username`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dump dei dati della tabella gunshopdb.venditori: ~3 rows (circa)
DELETE FROM `venditori`;
INSERT INTO `venditori` (`username`, `indirizzo`, `codNeg`, `nomeNeg`) VALUES
	('armloia', 'Ornago', 12345, 'Armeria Lo Iacono'),
	('GunClub', '', 232, 'Gun Club Ornago'),
	('GunShop', NULL, 456, 'Gun Shop Vimercate');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
