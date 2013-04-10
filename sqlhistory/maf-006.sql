-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2013 at 08:36 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

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
-- Table structure for table `char_leveling`
--

DROP TABLE IF EXISTS `char_leveling`;
CREATE TABLE IF NOT EXISTS `char_leveling` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exp_from` int(11) NOT NULL,
  `exp_to` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `timestamp` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `char_leveling`
--

INSERT INTO `char_leveling` (`id`, `exp_from`, `exp_to`, `level`, `title`, `timestamp`) VALUES
(1, 0, 99, 1, 'Baby Gangsta', 1365514705),
(2, 100, 299, 2, 'Child playing shooters', 1365514786),
(3, 300, 699, 3, 'Training teen', 1365514847),
(4, 700, 1499, 4, 'Kind of terrifyer', 1365514882),
(5, 1500, 3099, 5, 'Mafia school student', 1365514924),
(6, 3100, 6299, 6, 'Graduating mafia school', 1365514956),
(7, 6300, 12699, 7, 'Beginner assassin', 1365514991),
(8, 12700, 25499, 8, 'Intermediate killer', 1365515027),
(9, 25500, 51099, 9, 'Serial killer', 1365515053),
(10, 51100, 102299, 10, 'Potential mindblower', 1365515079),
(11, 102300, 204699, 11, 'Perfect shooter', 1365515109),
(12, 204700, 409499, 12, 'Mafia team leader', 1365515174),
(13, 409500, 819099, 13, 'King of Family', 1365515211),
(14, 819100, 1638299, 14, 'Regional Mafia leader', 1365515273),
(15, 1638300, 3276699, 15, 'King of the Kings - only few have reached this level!', 1365515332);

-- --------------------------------------------------------

--
-- Table structure for table `char_points`
--

DROP TABLE IF EXISTS `char_points`;
CREATE TABLE IF NOT EXISTS `char_points` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `char_id` int(11) NOT NULL,
  `melee_damage` int(11) NOT NULL,
  `distance_damage` int(11) NOT NULL,
  `melee_resistance` int(11) NOT NULL,
  `distance_resistance` int(11) NOT NULL,
  `special_damage` int(11) NOT NULL,
  `ultimate_damage` int(11) NOT NULL,
  `building_speed` int(11) NOT NULL,
  `building_energy_multiplicator` float NOT NULL,
  `timestamp` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `char_id` (`char_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `char_points`
--

INSERT INTO `char_points` (`id`, `char_id`, `melee_damage`, `distance_damage`, `melee_resistance`, `distance_resistance`, `special_damage`, `ultimate_damage`, `building_speed`, `building_energy_multiplicator`, `timestamp`) VALUES
(1, 1, 35, 45, 60, 35, 120, 350, 10, 0.8, 1365574147),
(2, 2, 50, 20, 20, 25, 500, 300, 2, 2.6, 1365574147);

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
(1, 'demo', '89e495e7941cf9e40e6980d14a16bf023ccd4c91', '', '', '', 0, 0, '1365506589', 1, 1),
(4, 'test', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'test@test.lv', 'John', 'Tester', 20, 0, 'u6pl5g46sd06qtf0ude8m90h32', 1, 1364379835),
(5, 'test2', '109f4b3c50d7b0df729d299bc6f8e9ef9066971f', 'test2@test.lv', 'Jack', 'Tester', 21, 0, 'aqmccnno2e8lrjhku2k2i89227', 1, 1364379887);

-- --------------------------------------------------------

--
-- Table structure for table `user_chars`
--

DROP TABLE IF EXISTS `user_chars`;
CREATE TABLE IF NOT EXISTS `user_chars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `char_id` int(11) NOT NULL,
  `current_hp` float NOT NULL,
  `hp_update_timestamp` int(11) NOT NULL,
  `char_exp` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `char_id` (`char_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user_chars`
--

INSERT INTO `user_chars` (`id`, `user_id`, `char_id`, `current_hp`, `hp_update_timestamp`, `char_exp`, `timestamp`) VALUES
(1, 1, 1, 100, 1364454727, 0, 1364454727),
(2, 4, 2, 100, 1365507793, 56, 1364454753);

-- --------------------------------------------------------

--
-- Table structure for table `user_energies`
--

DROP TABLE IF EXISTS `user_energies`;
CREATE TABLE IF NOT EXISTS `user_energies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `energy_level` float NOT NULL,
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
(2, 4, 100, 2000, 1365502256, 5, 1364454884);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `char_points`
--
ALTER TABLE `char_points`
  ADD CONSTRAINT `char_points_ibfk_1` FOREIGN KEY (`char_id`) REFERENCES `chars` (`id`);

--
-- Constraints for table `user_chars`
--
ALTER TABLE `user_chars`
  ADD CONSTRAINT `user_chars_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_chars_ibfk_2` FOREIGN KEY (`char_id`) REFERENCES `chars` (`id`);

--
-- Constraints for table `user_energies`
--
ALTER TABLE `user_energies`
  ADD CONSTRAINT `user_energies_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
