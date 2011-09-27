-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 27, 2011 at 09:06 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `clubcontenidos`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id_category` int(11) NOT NULL AUTO_INCREMENT,
  `id_parent` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `description` text,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id_category`, `id_parent`, `name`, `description`) VALUES
(1, 0, 'Antivirus', NULL),
(2, 0, 'Educación y Ciencia', NULL),
(3, 2, 'Geografia', NULL),
(4, 2, 'Mapas', NULL),
(5, 2, 'Música', NULL),
(6, 2, 'Ordenadores', NULL),
(7, 0, 'Imagen y Diseño', NULL),
(8, 7, 'Diseño 3D', NULL),
(9, 7, 'Diseño Web', NULL),
(10, 7, 'Editores Graficos', NULL),
(11, 0, 'Juegos', NULL),
(12, 11, 'Aventura', NULL),
(13, 11, 'Clásicos', NULL),
(14, 11, 'Deportes', NULL),
(15, 11, 'Emuladores', NULL),
(16, 11, 'Estrategia', NULL),
(17, 11, 'Rol', NULL),
(18, 0, 'Utilidades', NULL),
(19, 18, 'Análisis y Optimización', NULL),
(20, 18, 'Archivos', NULL),
(21, 18, 'CD / DVD', NULL),
(22, 18, 'Mantenimiento', NULL),
(23, 18, 'PDF', NULL),
(24, 18, 'Personalizar PC', NULL),
(25, 18, 'Componentes', NULL);
