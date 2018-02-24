-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 27 Octobre 2015 à 15:03
-- Version du serveur :  5.6.21
-- Version de PHP :  5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `joiesducode`
--
CREATE DATABASE IF NOT EXISTS `joiesducode` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `joiesducode`;

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
`id` int(11) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `test` int(11) DEFAULT NULL,
  `creation_date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `articles`
--

INSERT INTO `articles` (`id`, `name`, `content`, `picture`, `test`, `creation_date`) VALUES
(4, 'Morbi 2', 'Sit  2 amet ipsum ut mi sodales ornare sit amet ut lacus, sit amet ipsum ut mi sodales ornare sit amet ut lacus, sit amet ipsum ut mi sodales ornare sit amet ut lacus.', '', 0, '2015-10-27 13:46:50'),
(5, 'Curabitur', 'Hendrerit nunc sit amet eros eleifend pulvinar, hendrerit nunc sit amet eros eleifend pulvinar, hendrerit nunc sit amet eros eleifend pulvinar.', NULL, 0, '2015-07-15 00:00:00'),
(6, 'Suspendisse', 'Eu justo iaculis, ullamcorper dolor a, condimentum turpis, eu justo iaculis, ullamcorper dolor a, condimentum turpis, eu justo iaculis, ullamcorper dolor a, condimentum turpis.', NULL, 0, '2015-10-15 00:00:00'),
(7, 'Curabitur', 'Sit amet sapien sed neque euismod varius quis a quam, sit amet sapien sed neque euismod varius quis a quam, sit amet sapien sed neque euismod varius quis a quam.', NULL, 0, '2015-06-10 00:00:00'),
(8, 'Nunc', 'Porttitor felis id ex condimentum congue, porttitor felis id ex condimentum congue, porttitor felis id ex condimentum congue.', NULL, 0, '2015-04-22 00:00:00'),
(9, 'Curabitur', 'Eget neque ut diam ultricies aliquet, eget neque ut diam ultricies aliquet, eget neque ut diam ultricies aliquet.', NULL, 0, '2015-03-03 00:00:00'),
(10, 'Curabitur', 'Dignissim sapien ac efficitur dignissim, dignissim sapien ac efficitur dignissim, dignissim sapien ac efficitur dignissim.', NULL, 0, '2015-02-22 00:00:00'),
(11, 'Pellentesque', 'Consequat metus eu est sagittis feugiat, consequat metus eu est sagittis feugiat, consequat metus eu est sagittis feugiat.', NULL, 0, '2015-06-01 00:00:00'),
(12, 'Lorem', 'Ipsum dolor sit amet, consectetur adipiscing elit, ipsum dolor sit amet, consectetur adipiscing elit, ipsum dolor sit amet, consectetur adipiscing elit.', NULL, 0, '2015-07-14 00:00:00'),
(13, 'Duis', 'Vulputate velit et blandit euismod, vulputate velit et blandit euismod, vulputate velit et blandit euismod.', NULL, 0, '2014-11-12 00:00:00'),
(14, 'Morbi', 'Sit amet ipsum ut mi sodales ornare sit amet ut lacus, sit amet ipsum ut mi sodales ornare sit amet ut lacus, sit amet ipsum ut mi sodales ornare sit amet ut lacus.', NULL, 0, '2015-09-15 00:00:00'),
(15, 'Curabitur', 'Hendrerit nunc sit amet eros eleifend pulvinar, hendrerit nunc sit amet eros eleifend pulvinar, hendrerit nunc sit amet eros eleifend pulvinar.', NULL, 0, '2015-05-15 00:00:00'),
(16, 'Suspendisse', 'Eu justo iaculis, ullamcorper dolor a, condimentum turpis, eu justo iaculis, ullamcorper dolor a, condimentum turpis, eu justo iaculis, ullamcorper dolor a, condimentum turpis.', NULL, 0, '2015-08-15 00:00:00'),
(17, 'Curabitur', 'Sit amet sapien sed neque euismod varius quis a quam, sit amet sapien sed neque euismod varius quis a quam, sit amet sapien sed neque euismod varius quis a quam.', NULL, 0, '2015-06-10 00:00:00'),
(18, 'Nunc', 'Porttitor felis id ex condimentum congue, porttitor felis id ex condimentum congue, porttitor felis id ex condimentum congue.', NULL, 0, '2015-04-22 00:00:00'),
(19, 'Curabitur', 'Eget neque ut diam ultricies aliquet, eget neque ut diam ultricies aliquet, eget neque ut diam ultricies aliquet.', NULL, 0, '2015-02-03 00:00:00'),
(20, 'Curabitur', 'Dignissim sapien ac efficitur dignissim, dignissim sapien ac efficitur dignissim, dignissim sapien ac efficitur dignissim.', NULL, 0, '2015-03-22 00:00:00'),
(21, 'Pellentesque', 'Consequat metus eu est sagittis feugiat, consequat metus eu est sagittis feugiat, consequat metus eu est sagittis feugiat.', NULL, 0, '2015-04-01 00:00:00'),
(22, 'fsdfds', 'dsfdsf df dfsdfsf sfds fsd fsdfsf', NULL, 0, '2015-06-18 00:00:00'),
(23, 'dfgdfg', 'dfgdfgdfg dfg dfgdfg dfgdgdgdsfgdsfg', 'logo_webforce3.png', NULL, '2015-10-09 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) unsigned NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` char(60) NOT NULL,
  `newsletter` tinyint(1) DEFAULT '0',
  `role` tinyint(1) DEFAULT '0',
  `cdate` datetime NOT NULL,
  `mdate` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `gender`, `email`, `password`, `newsletter`, `role`, `cdate`, `mdate`) VALUES
(1, 'Bob', 'Arctor', 'male', 'bob.arctor@gmail.com', '$2y$10$98Y25bk3UXuK4xQlkWzAS.oIU3vkHGtbTIp8u0bjwRnBMQi33CaMS', 0, 2, '2015-10-22 13:10:47', '0000-00-00 00:00:00');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
