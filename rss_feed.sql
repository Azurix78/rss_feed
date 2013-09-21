-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Sam 21 Septembre 2013 à 02:39
-- Version du serveur: 5.5.29
-- Version de PHP: 5.4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `rss_feed`
--

-- --------------------------------------------------------

--
-- Structure de la table `flux`
--

CREATE TABLE `flux` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `new` varchar(255) NOT NULL DEFAULT '1',
  `hot` varchar(255) NOT NULL DEFAULT '0',
  `id_user` varchar(255) NOT NULL,
  `last_msg` varchar(255) NOT NULL DEFAULT '1337',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Contenu de la table `flux`
--

INSERT INTO `flux` (`id`, `nom`, `adresse`, `new`, `hot`, `id_user`, `last_msg`) VALUES
(9, 'franceTV', 'http://www.france.fr/feeds/all/rss.xml', '0', '0', '10', '26237'),
(10, 'ile de france RSS', 'http://www.france.fr/feeds/ile-de-france/rss.xml', '0', '0', '10', '32001'),
(13, 'fr3', 'http://www.france.fr/feeds/rhone-alpes/rss.xml', '0', '0', '10', '34277'),
(23, 'lolol', 'http://feeds.feedburner.com/estheticiennesdefrance', '0', '0', '10', '-1'),
(24, 'google', 'http://www.france.fr/feeds/rhone-alpes/rss.xml', '0', '0', '10', '34277'),
(25, 'guuugle', 'http://feeds.feedburner.com/estheticiennesdefrance', '0', '0', '10', '-1');

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `membre`
--

INSERT INTO `membre` (`id`, `pseudo`, `password`) VALUES
(3, 'Polo', '$1$vzari85q$11ABmGfUS36XyCCYj994..'),
(4, 'Pola', '$1$tGPpjCnI$ePW7atVwgq1VoKnSmG6ra.'),
(7, 'Test4', '$1$qvaw1.rA$WgVqgxZqAAnXC4r5GGpmu/'),
(10, 'Nico', '$1$fGSLLTKZ$LxrL0PM.UqCBDpcCHZTsQ0'),
(11, 'Nico2', '$1$MqTP/r0k$/GKdpeH/VSVcDiNwkyAXe1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
