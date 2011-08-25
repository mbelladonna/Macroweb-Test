-- phpMyAdmin SQL Dump
-- version 3.3.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 25, 2011 at 02:52 PM
-- Server version: 5.1.54
-- PHP Version: 5.3.5-1ubuntu7.2

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
  `pin` varchar(15) NOT NULL,
  `check_pin_response` varchar(64) NOT NULL,
  KEY `request_id` (`request_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `check_user_requests`
--

CREATE TABLE IF NOT EXISTS `check_user_requests` (
  `request_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `check_user_response` varchar(64) NOT NULL,
  KEY `request_id` (`request_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE IF NOT EXISTS `requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `origen_subno` varchar(255) NOT NULL,
  `password` varchar(20) NOT NULL,
  `destino_subno` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Requests de envio de mensajes';

-- --------------------------------------------------------

--
-- Stand-in structure for view `requests_view`
--
CREATE TABLE IF NOT EXISTS `requests_view` (
`id` int(11)
,`date` timestamp
,`origen_subno` varchar(255)
,`password` varchar(20)
,`destino_subno` varchar(255)
,`message` varchar(255)
,`check_user_response_date` timestamp
,`check_user_response` varchar(64)
,`send_pin_response_date` timestamp
,`send_pin_response` varchar(64)
,`check_pin_response_date` timestamp
,`pin` varchar(15)
,`check_pin_response` varchar(64)
,`send_message_response_date` timestamp
,`send_message_response` varchar(64)
);
-- --------------------------------------------------------

--
-- Table structure for table `send_message_requests`
--

CREATE TABLE IF NOT EXISTS `send_message_requests` (
  `request_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `send_message_response` varchar(64) NOT NULL,
  KEY `request_id` (`request_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `send_pin_requests`
--

CREATE TABLE IF NOT EXISTS `send_pin_requests` (
  `request_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `send_pin_response` varchar(64) NOT NULL,
  KEY `request_id` (`request_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure for view `requests_view`
--
DROP TABLE IF EXISTS `requests_view`;

CREATE VIEW `requests_view` AS select `R`.`id` AS `id`,`R`.`date` AS `date`,`R`.`origen_subno` AS `origen_subno`,`R`.`password` AS `password`,`R`.`destino_subno` AS `destino_subno`,`R`.`message` AS `message`,`CUR`.`date` AS `check_user_response_date`,`CUR`.`check_user_response` AS `check_user_response`,`SPR`.`date` AS `send_pin_response_date`,`SPR`.`send_pin_response` AS `send_pin_response`,`CPR`.`date` AS `check_pin_response_date`,`CPR`.`pin` AS `pin`,`CPR`.`check_pin_response` AS `check_pin_response`,`SMR`.`date` AS `send_message_response_date`,`SMR`.`send_message_response` AS `send_message_response` from ((((`requests` `R` left join `check_user_requests` `CUR` on((`R`.`id` = `CUR`.`request_id`))) left join `send_pin_requests` `SPR` on((`R`.`id` = `SPR`.`request_id`))) left join `check_pin_requests` `CPR` on((`R`.`id` = `CPR`.`request_id`))) left join `send_message_requests` `SMR` on((`R`.`id` = `SMR`.`request_id`)));
