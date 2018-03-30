-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2018 at 11:07 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `docq`
--

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE IF NOT EXISTS `answer` (
  `ansid` int(255) NOT NULL AUTO_INCREMENT,
  `qid` int(255) NOT NULL,
  `id` int(255) NOT NULL,
  `answer` mediumtext NOT NULL,
  `upvote` int(255) NOT NULL DEFAULT '0',
  `downvote` int(255) NOT NULL DEFAULT '0',
  `upload_date` date NOT NULL,
  PRIMARY KEY (`ansid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE IF NOT EXISTS `blog` (
  `bid` int(255) NOT NULL AUTO_INCREMENT,
  `id` int(255) NOT NULL,
  `title` varchar(1000) NOT NULL,
  `blog` mediumtext NOT NULL,
  `upvote` int(255) NOT NULL DEFAULT '0',
  `downvote` int(255) NOT NULL DEFAULT '0',
  `topic` varchar(30) NOT NULL,
  `upload_date` date NOT NULL,
  PRIMARY KEY (`bid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `docters_details`
--

CREATE TABLE IF NOT EXISTS `docters_details` (
  `did` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(255) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `liscense` varchar(100) NOT NULL,
  `bio` varchar(1000) NOT NULL,
  `image1` longblob NOT NULL,
  `experience1` varchar(100) NOT NULL,
  `experience2` varchar(100) NOT NULL,
  `experience3` varchar(100) NOT NULL,
  `university1` varchar(100) NOT NULL,
  `university2` varchar(100) NOT NULL,
  `university3` varchar(100) NOT NULL,
  `year_passout1` varchar(100) NOT NULL,
  `year_passout2` varchar(100) NOT NULL,
  `year_passout3` varchar(100) NOT NULL,
  `specialization1` varchar(100) NOT NULL,
  `specialization2` varchar(100) NOT NULL,
  `specialization3` varchar(100) NOT NULL,
  `award1` varchar(100) NOT NULL,
  `award2` varchar(100) NOT NULL,
  `award3` varchar(100) NOT NULL,
  `clinic_mobile` varchar(100) NOT NULL,
  `clinic_address` varchar(1000) NOT NULL,
  `research_title` varchar(100) NOT NULL,
  `abstract` varchar(1000) NOT NULL,
  `topic` varchar(1000) NOT NULL,
  `started` date NOT NULL,
  PRIMARY KEY (`did`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `qid` int(255) NOT NULL AUTO_INCREMENT,
  `id` int(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `question` varchar(1000) NOT NULL,
  `description` varchar(5000) NOT NULL,
  `topic` varchar(20) NOT NULL,
  `no_ans` int(255) NOT NULL DEFAULT '0',
  `upload_date` date NOT NULL,
  PRIMARY KEY (`qid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `research_details`
--

CREATE TABLE IF NOT EXISTS `research_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `abstract` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE IF NOT EXISTS `user_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(256) NOT NULL,
  `type` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
