-- phpMyAdmin SQL Dump
-- version 4.0.10.19
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 08, 2018 at 05:04 AM
-- Server version: 5.7.17-log
-- PHP Version: 5.4.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `userdb`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `procSaveUser`(IN `i_id` INT, IN `i_firstname` VARCHAR(50), IN `i_lastname` VARCHAR(50), IN `i_email` VARCHAR(50), IN `i_password` VARCHAR(200), IN `i_creation_time` DATETIME, IN `i_role` VARCHAR(10), IN `i_subscribe` INT(4))
BEGIN
    if(i_id=0) then
      insert into tb_user(firstname,lastname,email,password, account_creation_time, role,subscribe) values(i_firstname,i_lastname,i_email,i_password, i_creation_time, i_role, i_subscribe);
    Else
                 update tb_user set firstname=i_firstname,lastname=i_lastname,email=i_email,password=i_password,role=i_role where id=i_id;
    end if;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_feedback`
--

CREATE TABLE IF NOT EXISTS `tb_feedback` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `comments` varchar(500) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tb_feedback`
--

INSERT INTO `tb_feedback` (`id`, `firstname`, `lastname`, `email`, `comments`) VALUES
(1, 'ttdwdwd', 'yydwdwd', 'wong@hotmail.com', 'fjkmb hiun kj;no;'),
(2, 'wew', 'frgg', 'W@hotmail.com', 'defeff'),
(3, 'efefd', 'efrfr4f', 'wong@hotmail.com', 'efervrv'),
(4, 'wong', 'lee', 'ww@hotmail.com', 'complain about ...'),
(6, 'wong', 'lee', 'ww@hotmail.com', 'complain about ...');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE IF NOT EXISTS `tb_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `account_creation_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` varchar(10) NOT NULL,
  `subscribe` int(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `firstname`, `lastname`, `email`, `password`, `account_creation_time`, `role`, `subscribe`) VALUES
(5, 'Kanchi', 'Dhaya', 'kkanchi@gmail.com', '$2y$10$AmRWQnS.8hRUsjPUo74V.uBvQ7kBM0qBxati321FdFhR2C2yhIvIK', '2018-01-05 01:26:13', 'admin', 1),
(6, 'anish', 'prabakaran', 'anishsun09@gmail.com', '$2y$10$ohLibuWLgzwRVVhGX57kI.bhFOTvgJZ7XLrNNnjTakHpYIGWaXo0q', '2018-03-20 20:29:22', 'user', 1),
(16, 'sun', 'mathi', 'anusuyakathirvelu@gmail.com', '$2y$10$bZx/5u2xYAP0nqeFbPcauev6HwM8wOIb93L1RyvbnqTegfxnCI03i', '2018-03-21 16:29:30', 'user', 1),
(24, 'Tamil', 'Selvi', 'selvi@selvi.com', '$2y$10$/XCRj/VOP78BZ2vUXAqLjONY7esTWc5u/9mJF0CdrSxtuuCL/EnT2', '2018-04-01 13:41:05', 'admin', 1),
(25, 'Sun', 'mathi', 'anusuyakathirvelu1801@gmail.com', '$2y$10$1FEPU8qqoJlSHwNt7GZ/hu4bjJAyRpa5sX1y8Cr5MDkhEI5Xmav9q', '2018-04-01 18:02:20', 'user', 1),
(26, 'kiran', 'sharma', 'sharma@kiran.com', '$2y$10$kvOAzzYLPOKHRKL5vAqZoeNtbc7tjvjxTghs3lQCHbR7r2F5eZpj6', '2018-04-01 18:35:56', 'user', 1),
(28, 'aaa', 'bbb', 'aaa@bbb.com', '$2y$10$zxON.3..PThXpgxFC1CNnu9Ws/of/zwP6m6CrfkoAplSxN4ypj8Yu', '2018-04-06 16:25:44', 'user', 1),
(29, 'kamaraj', 'anusuya', 'anusuyakathirvelu08@gmail.com', '$2y$10$i9X1rB/UHf8Si26RdrjZjuBmp0hZl0wvFHwjJ2IVN0VWFKCHrQVcS', '2018-04-20 00:00:00', 'superadmin', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
