-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2017 at 11:19 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `suggestion`
--

-- --------------------------------------------------------

--
-- Table structure for table `suggestion`
--

CREATE TABLE IF NOT EXISTS `suggestion` (
`num` int(11) NOT NULL,
  `author` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `content` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `visable` tinyint(1) NOT NULL,
  `rating` int(11) NOT NULL,
  `checked` tinyint(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=105 ;

--
-- Dumping data for table `suggestion`
--

INSERT INTO `suggestion` (`num`, `author`, `type`, `content`, `visable`, `rating`, `checked`) VALUES
(104, 'Alex Boxall', 'Hardware', 'this is a suggestion', 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `votes_today` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `votes_expiry` date NOT NULL,
  `suggestions_today` int(20) NOT NULL,
  `suggestions_expiry` date NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `set_password` tinyint(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `pass`, `name`, `votes_today`, `votes_expiry`, `suggestions_today`, `suggestions_expiry`, `admin`, `set_password`) VALUES
(1, 'test', '$2y$10$en/cXNZYXOryQsbrOjI.ReR.f8MMtoM.mOoQiFoEUpTu1AArqxL4C.', 'Test', '5', '2016-06-10', 1, '2017-07-24', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `suggestion`
--
ALTER TABLE `suggestion`
 ADD PRIMARY KEY (`num`), ADD UNIQUE KEY `sugestion_num` (`num`), ADD UNIQUE KEY `sugestion_num_2` (`num`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `suggestion`
--
ALTER TABLE `suggestion`
MODIFY `num` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=105;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
