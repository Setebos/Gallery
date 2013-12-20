-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Ven 20 Décembre 2013 à 10:05
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `jsgallery`
--
CREATE DATABASE IF NOT EXISTS `jsgallery` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `jsgallery`;

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Chatons'),
(2, 'Tortues'),
(3, 'Tanks'),
(4, 'Chatortue'),
(6, 'Licornes'),
(7, 'Rainbow');

-- --------------------------------------------------------

--
-- Structure de la table `gallery`
--

CREATE TABLE IF NOT EXISTS `gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `gallery`
--

INSERT INTO `gallery` (`id`, `name`, `description`) VALUES
(1, 'Galerie 1', 'Ceci est une galerie test. Cette description est palpitante. La méthode Coué est efficace.'),
(2, 'Galerie 2', 'Hear Me Roar'),
(4, 'Galerie Gifs', 'Des gifs pour toute la famille');

-- --------------------------------------------------------

--
-- Structure de la table `gallery_options`
--

CREATE TABLE IF NOT EXISTS `gallery_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `show_entire_gallery` tinyint(1) NOT NULL,
  `diaporama_width` int(11) NOT NULL,
  `nb_images_per_line` int(11) NOT NULL,
  `display_duration` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `gallery_options`
--

INSERT INTO `gallery_options` (`id`, `show_entire_gallery`, `diaporama_width`, `nb_images_per_line`, `display_duration`) VALUES
(1, 0, 1000, 3, 2000);

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `location` varchar(255) NOT NULL,
  `location_miniature` varchar(255) DEFAULT NULL,
  `location_thumbnail` varchar(255) DEFAULT NULL,
  `position` int(11) NOT NULL,
  `gallery_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `gallery_id` (`gallery_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=147 ;

--
-- Contenu de la table `image`
--

INSERT INTO `image` (`id`, `title`, `description`, `location`, `location_miniature`, `location_thumbnail`, `position`, `gallery_id`) VALUES
(132, 'Chaton 1', 'Oh, un chaton !', 'app/img/1386927792_Chaton 1.jpg', 'app/img/1386927792_Chaton 1-miniature.jpg', 'app/img/1386927792_Chaton 1-thumbnail.jpg', 1, 1),
(133, 'Chaton 2', 'Oh c''est kromeugnon !', 'app/img/1386927818_Chaton 2.jpg', 'app/img/1386927818_Chaton 2-miniature.jpg', 'app/img/1386927818_Chaton 2-thumbnail.jpg', 2, 1),
(134, 'Chaton 3', 'Oh il a un bonnet hiiiiiiii !', 'app/img/1386927840_Chaton 3.jpg', 'app/img/1386927840_Chaton 3-miniature.jpg', 'app/img/1386927840_Chaton 3-thumbnail.jpg', 3, 1),
(135, 'Chaton 4', 'Non.', 'app/img/1386927864_Chaton 4.jpg', 'app/img/1386927864_Chaton 4-miniature.jpg', 'app/img/1386927864_Chaton 4-thumbnail.jpg', 4, 1),
(136, 'Chaton 5', 'Bat-chaton. Ce n''est pas le chaton que Gotham mérite, mais celui dont elle a besoin maintenant.', 'app/img/1386927897_Chaton 5.jpg', 'app/img/1386927897_Chaton 5-miniature.jpg', 'app/img/1386927897_Chaton 5-thumbnail.jpg', 5, 1),
(137, 'Tortue 1', 'OMNOMNOMNOM', 'app/img/1386927926_Tortue 1.jpg', 'app/img/1386927926_Tortue 1-miniature.jpg', 'app/img/1386927926_Tortue 1-thumbnail.jpg', 1, 2),
(138, 'Tortue 2', 'Bonjour, je suis une tortue.', 'app/img/1386927961_Tortue 2.jpg', 'app/img/1386927961_Tortue 2-miniature.jpg', 'app/img/1386927961_Tortue 2-thumbnail.jpg', 2, 2),
(139, 'Un chat sur une tortue', 'Weeeeeeeee', 'app/img/1386927990_Un chat sur une tortue.jpg', 'app/img/1386927990_Un chat sur une tortue-miniature.jpg', 'app/img/1386927990_Un chat sur une tortue-thumbnail.jpg', 6, 1),
(140, 'Un autre chat sur une autre tortue', 'Youpiiiiiii !', 'app/img/1386928018_Un autre chat sur une autre tortue.jpg', 'app/img/1386928018_Un autre chat sur une autre tortue-miniature.jpg', 'app/img/1386928018_Un autre chat sur une autre tortue-thumbnail.jpg', 7, 1),
(141, 'Fat Unicorn', 'OMNOMNOMNOM', 'app/img/1387526920_Fat Unicorn.jpg', 'app/img/1387526920_Fat Unicorn-miniature.jpg', 'app/img/1387526920_Fat Unicorn-thumbnail.jpg', 3, 2),
(142, 'Les licornes sont nos amies', 'Il faut les aimer aussi.', 'app/img/1387527374_Les licornes sont nos amies.jpg', 'app/img/1387527374_Les licornes sont nos amies-miniature.jpg', 'app/img/1387527374_Les licornes sont nos amies-thumbnail.jpg', 4, 2),
(143, 'Fabulous Unicorn', 'Fabulous unicorn is fabulous.', 'app/img/1387527561_Fabulous Unicorn.jpg', 'app/img/1387527561_Fabulous Unicorn-miniature.jpg', 'app/img/1387527561_Fabulous Unicorn-thumbnail.jpg', 5, 2),
(144, 'Graou', 'Le futur logo de la Metro-Goldwyn-Mayer', 'app/img/1387527935_Graou.gif', 'app/img/1387527935_Graou-miniature.gif', 'app/img/1387527935_Graou-thumbnail.gif', 1, 4),
(146, 'Skill', 'D''une pierre deux coups', 'app/img/1387528668_Skill.gif', 'app/img/1387528668_Skill-miniature.gif', 'app/img/1387528668_Skill-thumbnail.gif', 2, 4);

-- --------------------------------------------------------

--
-- Structure de la table `image_category`
--

CREATE TABLE IF NOT EXISTS `image_category` (
  `image_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`image_id`,`category_id`),
  KEY `image_id` (`image_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `image_category`
--

INSERT INTO `image_category` (`image_id`, `category_id`) VALUES
(132, 1),
(133, 1),
(134, 1),
(135, 1),
(136, 1),
(137, 2),
(138, 2),
(139, 4),
(140, 4),
(141, 6),
(141, 7),
(142, 6),
(142, 7),
(143, 6),
(143, 7),
(144, 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `login`, `password`) VALUES
(1, 'login', 'password');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`gallery_id`) REFERENCES `gallery` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `image_category`
--
ALTER TABLE `image_category`
  ADD CONSTRAINT `image_category_ibfk_1` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `image_category_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
