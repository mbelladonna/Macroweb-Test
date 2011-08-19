-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 19, 2011 at 05:20 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `smsender`
--

-- --------------------------------------------------------

--
-- Table structure for table `check_pin_requests`
--

CREATE TABLE IF NOT EXISTS `check_pin_requests` (
  `request_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pin` int(11) NOT NULL,
  `check_pin_response` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `check_user_requests`
--

CREATE TABLE IF NOT EXISTS `check_user_requests` (
  `request_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `check_user_response` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE IF NOT EXISTS `requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `origen_subno` varchar(255) NOT NULL,
  `password` varchar(8) NOT NULL,
  `destino_subno` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `send_pin_response` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Requests de envio de mensajes';

-- --------------------------------------------------------

--
-- Table structure for table `send_message_requests`
--

CREATE TABLE IF NOT EXISTS `send_message_requests` (
  `request_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `send_message_response` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `send_pin_requests`
--

CREATE TABLE IF NOT EXISTS `send_pin_requests` (
  `request_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `send_pin_response` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
