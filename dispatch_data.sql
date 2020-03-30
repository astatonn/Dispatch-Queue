-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 30-Mar-2020 às 23:36
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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
