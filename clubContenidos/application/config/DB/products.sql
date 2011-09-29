-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 29, 2011 at 07:45 PM
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
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(128) NOT NULL,
  `descripcion` text,
  `categoria_id` int(11) NOT NULL,
  `foto` varchar(64) NOT NULL,
  `text_alt` varchar(64) NOT NULL,
  `creditos_nec` int(11) NOT NULL,
  `url_link` varchar(256) NOT NULL,
  `downloads` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `titulo`, `descripcion`, `categoria_id`, `foto`, `text_alt`, `creditos_nec`, `url_link`, `downloads`) VALUES
(1, 'Messi Barcelona FC', '1024 x 768', 2, 'img1.jpg', 'Messi', 25, 'linkdescarga', 30),
(2, 'Sale el Sol', 'Shakira', 1, 'video1.jpg', 'shakira', 15, 'linkdescarga', 20),
(3, 'NombreVideo2', 'ArtistaVideo', 1, 'video2.jpg', 'video2', 12, 'linkdescarga2', 5),
(4, 'NombreVideo3', 'ArtistaVideo', 1, 'video3.jpg', 'video3', 10, 'linkdescarga3', 6),
(7, 'NombreVideo4', 'ArtistaVideo', 1, 'video4.jpg', 'video4', 12, 'linkdescarga4', 13),
(8, 'NombreVideo5', 'ArtistaVideo', 1, 'video5.jpg', 'video5', 15, 'linkdescarga5', 18),
(9, 'NombreVideo6', 'ArtistaVideo6', 1, 'video6.jpg', 'video6', 8, 'linkdescarga6', 15),
(10, 'Glowing', '1024 x 768', 2, 'glowing.jpg', 'glowing', 10, 'linkdescarga', 7),
(11, 'img2', '1024 x 768', 2, 'img2.jpg', 'glowing', 14, 'linkdescarga', 15),
(12, 'img3', '1024 x 768', 2, 'img3.jpg', 'imagen3', 10, 'linkdescarga', 10),
(13, 'Irises', '1024 x 768', 2, 'Irises_89.jpg', 'Irises', 20, 'linkdescarga', 16),
(14, 'Leopard', '1024 x 768', 2, 'leopard.jpg', 'leopard', 5, 'linkdescarga', 12);
