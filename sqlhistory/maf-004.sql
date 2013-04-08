-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2013 at 02:04 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `maf`
--

-- --------------------------------------------------------

--
-- Table structure for table `chars`
--

DROP TABLE IF EXISTS `chars`;
CREATE TABLE IF NOT EXISTS `chars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `char_type` int(11) NOT NULL,
  `char_name` varchar(128) NOT NULL,
  `char_max_hp` int(11) NOT NULL,
  `char_hp_recovery_time` int(11) NOT NULL,
  `char_hp_recovery_amount` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `chars`
--

INSERT INTO `chars` (`id`, `char_type`, `char_name`, `char_max_hp`, `char_hp_recovery_time`, `char_hp_recovery_amount`, `timestamp`) VALUES
(1, 1, 'Godfather', 200, 120, 10, 1364454598),
(2, 2, 'Spy', 125, 150, 12, 1364454637);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `name` varchar(128) NOT NULL,
  `surname` varchar(128) NOT NULL,
  `age` int(11) NOT NULL,
  `refered_by` int(11) NOT NULL,
  `session_id` varchar(128) NOT NULL,
  `user_type` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `name`, `surname`, `age`, `refered_by`, `session_id`, `user_type`, `timestamp`) VALUES
(1, 'demo', '89e495e7941cf9e40e6980d14a16bf023ccd4c91', '', '', '', 0, 0, '1364471943', 1, 1),
(4, 'test', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'test@test.lv', 'John', 'Tester', 20, 0, '69giglvkm2aaai89bd714083f7', 1, 1364379835),
(5, 'test2', '109f4b3c50d7b0df729d299bc6f8e9ef9066971f', 'test2@test.lv', 'Jack', 'Tester', 21, 0, '1364383629', 1, 1364379887);

-- --------------------------------------------------------

--
-- Table structure for table `user_chars`
--

DROP TABLE IF EXISTS `user_chars`;
CREATE TABLE IF NOT EXISTS `user_chars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `char_id` int(11) NOT NULL,
  `current_hp` int(11) NOT NULL,
  `hp_update_timestamp` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `char_id` (`char_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user_chars`
--

INSERT INTO `user_chars` (`id`, `user_id`, `char_id`, `current_hp`, `hp_update_timestamp`, `timestamp`) VALUES
(1, 1, 1, 100, 1364454727, 1364454727),
(2, 4, 2, 100, 1364454753, 1364454753);

-- --------------------------------------------------------

--
-- Table structure for table `user_energies`
--

DROP TABLE IF EXISTS `user_energies`;
CREATE TABLE IF NOT EXISTS `user_energies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `energy_level` int(11) NOT NULL,
  `energy_max` int(11) NOT NULL,
  `energy_update_timestamp` int(11) NOT NULL,
  `energy_update_amount` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user_energies`
--

INSERT INTO `user_energies` (`id`, `user_id`, `energy_level`, `energy_max`, `energy_update_timestamp`, `energy_update_amount`, `timestamp`) VALUES
(1, 1, 100, 2000, 1364454813, 5, 1364454813),
(2, 4, 100, 2000, 1364475479, 5, 1364454884);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_chars`
--
ALTER TABLE `user_chars`
  ADD CONSTRAINT `user_chars_ibfk_2` FOREIGN KEY (`char_id`) REFERENCES `chars` (`id`),
  ADD CONSTRAINT `user_chars_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_energies`
--
ALTER TABLE `user_energies`
  ADD CONSTRAINT `user_energies_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
