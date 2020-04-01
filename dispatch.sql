-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 01-Abr-2020 às 23:04
-- Versão do servidor: 5.7.26
-- versão do PHP: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dispatch`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `dispatch_data`
--

DROP TABLE IF EXISTS `dispatch_data`;
CREATE TABLE IF NOT EXISTS `dispatch_data` (
  `codAcess` bigint(16) NOT NULL,
  `PG` int(11) NOT NULL,
  `NOME` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `FUNCAO` int(11) NOT NULL,
  PRIMARY KEY (`codAcess`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `dispatch_data`
--

INSERT INTO `dispatch_data` (`codAcess`, `PG`, `NOME`, `FUNCAO`) VALUES
(1673677276156920, 10, 'SOUZA LIMA', 9),
(1927971627201060, 0, 'FARIAS', 52),
(2147964913138230, 5, 'EDUARDO', 22),
(3107126560595630, 8, 'ELIAS', 50),
(7966627410346820, 0, 'JASON', 52);

-- --------------------------------------------------------

--
-- Estrutura da tabela `dispatch_queue`
--

DROP TABLE IF EXISTS `dispatch_queue`;
CREATE TABLE IF NOT EXISTS `dispatch_queue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codAcess` bigint(16) NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`codAcess`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `dispatch_queue`
--

INSERT INTO `dispatch_queue` (`id`, `codAcess`, `description`, `status`) VALUES
(1, 1673677276156920, 'a', 1);

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `dispatch_queue`
--
ALTER TABLE `dispatch_queue`
  ADD CONSTRAINT `fk_codAcess` FOREIGN KEY (`codAcess`) REFERENCES `dispatch_data` (`codAcess`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
